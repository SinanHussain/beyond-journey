<?php
/**
 * Enquiries: saves both enquiry forms in the dashboard and emails them.
 *
 * @package Beyond_Journey
 */

defined( 'ABSPATH' ) || exit;

/** Enquiry fields and their labels, in display order. */
function bj_enquiry_fields() {
	return array(
		'name'        => __( 'Name', 'beyond-journey' ),
		'email'       => __( 'Email', 'beyond-journey' ),
		'phone'       => __( 'Phone / WhatsApp', 'beyond-journey' ),
		'travel_type' => __( 'Travel type', 'beyond-journey' ),
		'destination' => __( 'Destination', 'beyond-journey' ),
		'travellers'  => __( 'Travellers', 'beyond-journey' ),
		'message'     => __( 'Message', 'beyond-journey' ),
		'source'      => __( 'Form', 'beyond-journey' ),
		'page'        => __( 'Sent from', 'beyond-journey' ),
	);
}

/** Registers the dashboard-only Enquiries post type. */
function bj_register_enquiries() {
	register_post_type(
		'bj_enquiry',
		array(
			'labels'              => array(
				'name'               => __( 'Enquiries', 'beyond-journey' ),
				'singular_name'      => __( 'Enquiry', 'beyond-journey' ),
				'all_items'          => __( 'All Enquiries', 'beyond-journey' ),
				'edit_item'          => __( 'Enquiry', 'beyond-journey' ),
				'search_items'       => __( 'Search Enquiries', 'beyond-journey' ),
				'not_found'          => __( 'No enquiries yet.', 'beyond-journey' ),
				'not_found_in_trash' => __( 'No enquiries in the trash.', 'beyond-journey' ),
			),
			'public'              => false,
			'publicly_queryable'  => false,
			'exclude_from_search' => true,
			'show_ui'             => true,
			'show_in_menu'        => true,
			'show_in_rest'        => false,
			'menu_position'       => 26,
			'menu_icon'           => 'dashicons-email-alt',
			'supports'            => array( 'title' ),
			'capability_type'     => 'post',
			'capabilities'        => array( 'create_posts' => 'do_not_allow' ),
			'map_meta_cap'        => true,
			'query_var'           => false,
			'rewrite'             => false,
		)
	);
}
add_action( 'init', 'bj_register_enquiries' );

/** Where enquiry emails go. */
function bj_enquiry_recipient() {
	foreach ( array( bj_setting( 'enquiry_email' ), bj_setting( 'email' ), get_option( 'admin_email' ) ) as $address ) {
		if ( is_email( $address ) ) {
			return $address;
		}
	}
	return get_option( 'admin_email' );
}

/**
 * Hidden fields shared by both forms: action, source, page, honeypot and (for logged-in users) a nonce.
 *
 * @param string $source 'contact' or 'popup'.
 */
function bj_enquiry_hidden_fields( $source ) {
	echo '<input type="hidden" name="action" value="bj_enquiry">';
	echo '<input type="hidden" name="bj_source" value="' . esc_attr( $source ) . '">';
	echo '<input type="hidden" name="bj_page" value="">';
	if ( is_user_logged_in() ) {
		wp_nonce_field( 'bj_enquiry', 'bj_nonce', false );
	}
	echo '<div aria-hidden="true" style="position:absolute;left:-9999px;width:1px;height:1px;overflow:hidden"><label>Company <input type="text" name="bj_company" value="" tabindex="-1" autocomplete="off"></label></div>';
}

/**
 * Validates, stores and emails one enquiry.
 *
 * @param array $data Unslashed request data.
 * @return true|WP_Error
 */
function bj_process_enquiry( $data ) {
	// Bots fill the hidden honeypot field: accept silently, store nothing.
	if ( ! empty( $data['bj_company'] ) ) {
		return true;
	}

	// Logged-in visitors bypass page caches, so their nonce is always fresh.
	if ( is_user_logged_in() && ! wp_verify_nonce( isset( $data['bj_nonce'] ) ? $data['bj_nonce'] : '', 'bj_enquiry' ) ) {
		return new WP_Error( 'bj_nonce', __( 'Your session has expired. Please reload the page and try again.', 'beyond-journey' ) );
	}

	$get = static function ( $key ) use ( $data ) {
		return isset( $data[ $key ] ) && is_string( $data[ $key ] ) ? $data[ $key ] : '';
	};

	$fields = array(
		'name'        => sanitize_text_field( $get( 'name' ) ),
		'email'       => sanitize_email( $get( 'email' ) ),
		'phone'       => sanitize_text_field( $get( 'phone' ) ),
		'travel_type' => sanitize_text_field( $get( 'travel-type' ) ),
		'destination' => sanitize_text_field( $get( 'destination' ) ),
		'travellers'  => sanitize_text_field( $get( 'travellers' ) ),
		'message'     => sanitize_textarea_field( $get( 'message' ) ),
		'source'      => 'popup' === $get( 'bj_source' ) ? __( 'Popup', 'beyond-journey' ) : __( 'Contact form', 'beyond-journey' ),
		'page'        => esc_url_raw( $get( 'bj_page' ) ? $get( 'bj_page' ) : (string) wp_get_referer() ),
	);

	foreach ( $fields as $key => $value ) {
		$fields[ $key ] = mb_substr( $value, 0, 'message' === $key ? 5000 : 200 );
	}

	if ( '' === $fields['name'] ) {
		return new WP_Error( 'bj_name', __( 'Please enter your name.', 'beyond-journey' ) );
	}
	if ( '' !== trim( $get( 'email' ) ) && ! is_email( $fields['email'] ) ) {
		return new WP_Error( 'bj_email', __( 'Please enter a valid email address.', 'beyond-journey' ) );
	}
	if ( '' === $fields['email'] && '' === $fields['phone'] ) {
		return new WP_Error( 'bj_contact', __( 'Please enter an email address or phone number.', 'beyond-journey' ) );
	}

	// At most 5 enquiries per visitor IP every 10 minutes.
	$ip    = isset( $_SERVER['REMOTE_ADDR'] ) ? sanitize_text_field( wp_unslash( $_SERVER['REMOTE_ADDR'] ) ) : '';
	$limit = 'bj_enquiry_' . md5( $ip );
	$count = (int) get_transient( $limit );
	if ( $count >= 5 ) {
		return new WP_Error( 'bj_rate', __( 'Too many enquiries in a short time. Please try again later, or contact us on WhatsApp.', 'beyond-journey' ) );
	}
	set_transient( $limit, $count + 1, 10 * MINUTE_IN_SECONDS );

	$post_id = wp_insert_post(
		array(
			'post_type'   => 'bj_enquiry',
			'post_status' => 'publish',
			'post_title'  => $fields['name'] . ( $fields['destination'] ? ' — ' . $fields['destination'] : '' ),
		),
		true
	);
	if ( is_wp_error( $post_id ) ) {
		return new WP_Error( 'bj_save', __( 'Sorry, your enquiry could not be saved. Please try again, or contact us on WhatsApp.', 'beyond-journey' ) );
	}
	foreach ( $fields as $key => $value ) {
		update_post_meta( $post_id, '_bj_' . $key, $value );
	}

	// Whether each email was handed to the mail server is kept with the enquiry, for checking delivery later.
	update_post_meta( $post_id, '_bj_mail_team', bj_email_enquiry( $fields ) ? 'sent' : 'failed' );
	if ( is_email( $fields['email'] ) ) {
		update_post_meta( $post_id, '_bj_mail_visitor', bj_email_enquiry_confirmation( $fields ) ? 'sent' : 'failed' );
	}
	return true;
}

/**
 * Address the enquiry emails are sent from: no-reply@ on the site's own domain, so the domain's SPF/DMARC
 * records can vouch for it.
 *
 * @return string
 */
function bj_enquiry_from() {
	$host = preg_replace( '/^www\./i', '', (string) wp_parse_url( home_url(), PHP_URL_HOST ) );
	return 'no-reply@' . $host;
}

/**
 * Sends one email from the site's own address, with the envelope sender matching the From address
 * (needed for the domain's DMARC check to pass).
 *
 * @param string   $to      Recipient.
 * @param string   $subject Subject.
 * @param string   $body    Plain-text body.
 * @param string[] $headers Extra headers.
 * @return bool
 */
function bj_enquiry_mail( $to, $subject, $body, $headers = array() ) {
	$from      = bj_enquiry_from();
	$from_addr = static function () use ( $from ) {
		return $from;
	};
	$from_name = static function () {
		return 'Beyond Journey Tourism';
	};
	$sender    = static function ( $phpmailer ) use ( $from ) {
		$phpmailer->Sender = $from; // phpcs:ignore WordPress.NamingConventions.ValidVariableName.UsedPropertyNotSnakeCase -- PHPMailer property.
	};
	add_filter( 'wp_mail_from', $from_addr );
	add_filter( 'wp_mail_from_name', $from_name );
	add_action( 'phpmailer_init', $sender );
	$sent = wp_mail( $to, $subject, $body, $headers );
	remove_filter( 'wp_mail_from', $from_addr );
	remove_filter( 'wp_mail_from_name', $from_name );
	remove_action( 'phpmailer_init', $sender );
	return (bool) $sent;
}

/**
 * Emails an enquiry to the configured address.
 *
 * @param array $fields Sanitized enquiry fields.
 * @return bool
 */
function bj_email_enquiry( $fields ) {
	$lines = array();
	foreach ( bj_enquiry_fields() as $key => $label ) {
		// Which form was used stays in the dashboard record only; it isn't useful in the email.
		if ( 'source' !== $key && '' !== $fields[ $key ] ) {
			$lines[] = $label . ': ' . $fields[ $key ];
		}
	}
	$lines[] = '';
	$lines[] = __( 'All enquiries:', 'beyond-journey' ) . ' ' . admin_url( 'edit.php?post_type=bj_enquiry' );

	$headers = array();
	if ( is_email( $fields['email'] ) ) {
		$reply_name = trim( preg_replace( '/[^\p{L}\p{N} .\'-]/u', '', $fields['name'] ) );
		$headers[]  = 'Reply-To: ' . ( $reply_name ? $reply_name . ' ' : '' ) . '<' . $fields['email'] . '>';
	}

	/* translators: %s: visitor name. */
	$subject = sprintf( __( 'New enquiry from %s', 'beyond-journey' ), $fields['name'] );
	return bj_enquiry_mail( bj_enquiry_recipient(), $subject, implode( "\n", $lines ), $headers );
}

/**
 * "We received your enquiry" email to the visitor (when they gave an email address). Replies go to the business.
 *
 * @param array $fields Sanitized enquiry fields.
 * @return bool
 */
function bj_email_enquiry_confirmation( $fields ) {
	if ( ! is_email( $fields['email'] ) ) {
		return false;
	}
	$name  = '' !== $fields['name'] ? $fields['name'] : __( 'there', 'beyond-journey' );
	$lines = array(
		/* translators: %s: visitor name. */
		sprintf( __( 'Hi %s,', 'beyond-journey' ), $name ),
		'',
		__( 'Thank you for contacting Beyond Journey Tourism. We have received your enquiry and a member of our team will get back to you shortly with suitable options.', 'beyond-journey' ),
		'',
		__( 'Your details:', 'beyond-journey' ),
	);
	foreach ( array( 'name', 'email', 'phone', 'travel_type', 'destination', 'travellers', 'message' ) as $key ) {
		if ( '' !== $fields[ $key ] ) {
			$labels  = bj_enquiry_fields();
			$lines[] = $labels[ $key ] . ': ' . $fields[ $key ];
		}
	}
	$lines[] = '';
	$lines[] = __( 'Need anything sooner? Reply to this email, or reach us here:', 'beyond-journey' );
	$lines[] = __( 'Phone:', 'beyond-journey' ) . ' ' . bj_setting( 'phone' );
	$lines[] = __( 'WhatsApp:', 'beyond-journey' ) . ' ' . bj_whatsapp_url();
	$lines[] = __( 'Email:', 'beyond-journey' ) . ' ' . bj_enquiry_recipient();
	$lines[] = '';
	$lines[] = 'Beyond Journey Tourism';
	$lines[] = home_url( '/' );

	$headers = array( 'Reply-To: Beyond Journey Tourism <' . bj_enquiry_recipient() . '>' );
	return bj_enquiry_mail( $fields['email'], __( 'We received your enquiry – Beyond Journey Tourism', 'beyond-journey' ), implode( "\n", $lines ), $headers );
}

/** Handles both forms: JSON for the JavaScript submit, redirect for the plain HTML fallback. */
function bj_handle_enquiry() {
	$result = bj_process_enquiry( wp_unslash( $_POST ) ); // phpcs:ignore WordPress.Security.NonceVerification.Missing -- verified inside for logged-in users; public form uses a honeypot and rate limit.

	if ( wp_doing_ajax() ) {
		if ( is_wp_error( $result ) ) {
			wp_send_json_error( array( 'message' => $result->get_error_message() ), 400 );
		}
		wp_send_json_success();
	}

	$back = wp_get_referer();
	$back = remove_query_arg( 'bj_enquiry', $back ? $back : home_url( '/' ) );
	wp_safe_redirect( add_query_arg( 'bj_enquiry', is_wp_error( $result ) ? 'error' : 'sent', $back ) . '#contact' );
	exit;
}
add_action( 'wp_ajax_bj_enquiry', 'bj_handle_enquiry' );
add_action( 'wp_ajax_nopriv_bj_enquiry', 'bj_handle_enquiry' );
add_action( 'admin_post_bj_enquiry', 'bj_handle_enquiry' );
add_action( 'admin_post_nopriv_bj_enquiry', 'bj_handle_enquiry' );

/**
 * Enquiry list columns.
 *
 * @param string[] $columns Default columns.
 * @return string[]
 */
function bj_enquiry_columns( $columns ) {
	return array(
		'cb'             => $columns['cb'],
		'title'          => __( 'Enquiry', 'beyond-journey' ),
		'bj_email'       => __( 'Email', 'beyond-journey' ),
		'bj_phone'       => __( 'Phone / WhatsApp', 'beyond-journey' ),
		'bj_travel_type' => __( 'Travel type', 'beyond-journey' ),
		'bj_source'      => __( 'Form', 'beyond-journey' ),
		'date'           => $columns['date'],
	);
}
add_filter( 'manage_bj_enquiry_posts_columns', 'bj_enquiry_columns' );

/**
 * Enquiry list cell.
 *
 * @param string $column  Column key.
 * @param int    $post_id Enquiry ID.
 */
function bj_enquiry_column( $column, $post_id ) {
	if ( 0 === strpos( $column, 'bj_' ) ) {
		echo esc_html( get_post_meta( $post_id, '_' . $column, true ) );
	}
}
add_action( 'manage_bj_enquiry_posts_custom_column', 'bj_enquiry_column', 10, 2 );

/** Details box on the enquiry screen. */
function bj_enquiry_meta_box() {
	add_meta_box( 'bj_enquiry_details', __( 'Enquiry details', 'beyond-journey' ), 'bj_enquiry_details_box', 'bj_enquiry', 'normal', 'high' );
}
add_action( 'add_meta_boxes', 'bj_enquiry_meta_box' );

/**
 * Renders the details box.
 *
 * @param WP_Post $post Enquiry.
 */
function bj_enquiry_details_box( $post ) {
	echo '<table class="widefat striped"><tbody>';
	foreach ( bj_enquiry_fields() as $key => $label ) {
		$value = (string) get_post_meta( $post->ID, '_bj_' . $key, true );
		if ( '' === $value ) {
			continue;
		}
		if ( 'email' === $key ) {
			$cell = '<a href="' . esc_url( 'mailto:' . $value ) . '">' . esc_html( $value ) . '</a>';
		} elseif ( 'phone' === $key ) {
			$cell = '<a href="' . esc_url( 'tel:' . preg_replace( '/[^0-9+]/', '', $value ) ) . '">' . esc_html( $value ) . '</a>';
		} elseif ( 'page' === $key ) {
			$cell = '<a href="' . esc_url( $value ) . '" target="_blank" rel="noopener noreferrer">' . esc_html( $value ) . '</a>';
		} else {
			$cell = nl2br( esc_html( $value ) );
		}
		echo '<tr><th scope="row" style="width:180px">' . esc_html( $label ) . '</th><td>' . $cell . '</td></tr>'; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped -- $cell is escaped above.
	}
	echo '</tbody></table>';
}
