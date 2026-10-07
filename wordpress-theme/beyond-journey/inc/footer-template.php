<?php
/**
 * Footer editable in Elementor: the footer is an Elementor template ("Site Footer", under Templates) holding the
 * "Site Footer" widget. Appearance > Edit Footer opens it. Without it (or without Elementor) the built-in footer shows.
 *
 * @package Beyond_Journey
 */

defined( 'ABSPATH' ) || exit;

/** ID of the published Elementor footer template, or 0. */
function bj_footer_template_id() {
	$id = (int) get_option( 'bj_footer_template' );
	if ( ! $id || 'elementor_library' !== get_post_type( $id ) || 'publish' !== get_post_status( $id ) ) {
		return 0;
	}
	return $id;
}

/** Prints the footer: the Elementor footer template when there is one, otherwise the built-in footer. */
function bj_render_footer() {
	$id = bj_footer_template_id();
	if ( $id && bj_elementor_ready() ) {
		// While the footer template itself is open in Elementor, it is already the page content.
		if ( is_singular( 'elementor_library' ) ) {
			return;
		}
		$html = \Elementor\Plugin::$instance->frontend->get_builder_content_for_display( $id, true );
		if ( '' !== trim( (string) $html ) ) {
			echo $html; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped -- Elementor output.
			return;
		}
	}
	bj_section( 'site-footer' );
}

/**
 * Creates the Elementor footer template (one container with the Site Footer widget) when it does not exist yet.
 *
 * @return int Template ID, or 0.
 */
function bj_create_footer_template() {
	$id = bj_footer_template_id();
	if ( $id || ! bj_elementor_ready() ) {
		return $id;
	}
	$id = wp_insert_post(
		array(
			'post_type'   => 'elementor_library',
			'post_status' => 'publish',
			'post_title'  => __( 'Site Footer', 'beyond-journey' ),
		)
	);
	if ( ! $id || is_wp_error( $id ) ) {
		return 0;
	}
	$elements = array(
		array(
			'id'       => bj_elementor_id(),
			'elType'   => 'container',
			'isInner'  => false,
			'settings' => array(
				'_title'         => __( 'Site Footer', 'beyond-journey' ),
				'content_width'  => 'full',
				'flex_direction' => 'column',
				'flex_gap'       => array( 'unit' => 'px', 'size' => 0, 'column' => '0', 'row' => '0', 'isLinked' => true ),
				'padding'        => array( 'unit' => 'px', 'top' => '0', 'right' => '0', 'bottom' => '0', 'left' => '0', 'isLinked' => true ),
			),
			'elements' => array(
				array(
					'id'         => bj_elementor_id(),
					'elType'     => 'widget',
					'widgetType' => 'bj-site-footer',
					'settings'   => array(),
					'elements'   => array(),
				),
			),
		),
	);
	update_post_meta( $id, '_elementor_edit_mode', 'builder' );
	update_post_meta( $id, '_elementor_template_type', 'page' );
	update_post_meta( $id, '_wp_page_template', 'elementor_canvas' );
	update_post_meta( $id, '_elementor_data', wp_slash( wp_json_encode( $elements ) ) );
	if ( defined( 'ELEMENTOR_VERSION' ) ) {
		update_post_meta( $id, '_elementor_version', ELEMENTOR_VERSION );
	}
	wp_set_object_terms( $id, 'page', 'elementor_library_type' );
	update_option( 'bj_footer_template', $id, false );
	return $id;
}

/** Appearance > Edit Footer: opens the footer in Elementor (creating it the first time). */
function bj_footer_admin_menu() {
	add_theme_page( __( 'Edit Footer', 'beyond-journey' ), __( 'Edit Footer', 'beyond-journey' ), 'edit_theme_options', 'bj-edit-footer', 'bj_footer_admin_page' );
}
add_action( 'admin_menu', 'bj_footer_admin_menu' );

/** Sends the user to the Elementor editor of the footer, or explains why it cannot. */
function bj_footer_admin_redirect() {
	if ( ! is_admin() || ! isset( $_GET['page'] ) || 'bj-edit-footer' !== $_GET['page'] || ! current_user_can( 'edit_theme_options' ) ) { // phpcs:ignore WordPress.Security.NonceVerification.Recommended -- read-only screen switch.
		return;
	}
	$id = bj_create_footer_template();
	if ( $id ) {
		wp_safe_redirect( admin_url( 'post.php?post=' . $id . '&action=elementor' ) );
		exit;
	}
}
add_action( 'admin_init', 'bj_footer_admin_redirect' );

/** Shown only when Elementor is not active. */
function bj_footer_admin_page() {
	echo '<div class="wrap"><h1>' . esc_html__( 'Edit Footer', 'beyond-journey' ) . '</h1><p>' .
		esc_html__( 'Activate the Elementor plugin to edit the footer. Contact details and social links can be changed in Appearance > Customize > Beyond Journey Settings.', 'beyond-journey' ) . '</p></div>';
}
