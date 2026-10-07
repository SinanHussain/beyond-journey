<?php
/**
 * Customizer: contact details, enquiry recipient and popup options.
 *
 * @package Beyond_Journey
 */

defined( 'ABSPATH' ) || exit;

/** Default values for the theme settings. */
function bj_setting_defaults() {
	return array(
		'phone'         => '+971 58 671 1699',
		'whatsapp'      => '971586711699',
		'email'         => 'info@beyondjourneys.net',
		'enquiry_email' => '',
		'location'      => 'Dubai, United Arab Emirates',
		'website'       => 'https://beyondjourney.net',
		'instagram'     => '',
		'facebook'      => 'https://www.facebook.com/profile.php?id=61595255666095',
		'x'             => 'https://x.com/Beyond__Journey',
		'linkedin'      => 'https://www.linkedin.com/company/beyond-journey-travels/',
		'tiktok'        => '',
		'popup_enabled' => true,
		'popup_delay'   => 1800,
	);
}

/**
 * Reads a theme setting. Empty text settings fall back to their default.
 *
 * @param string $key Setting key without the bj_ prefix.
 * @return mixed
 */
function bj_setting( $key ) {
	$defaults = bj_setting_defaults();
	$default  = isset( $defaults[ $key ] ) ? $defaults[ $key ] : '';
	$value    = get_theme_mod( 'bj_' . $key, $default );

	if ( is_string( $value ) && '' === trim( $value ) && is_string( $default ) ) {
		return $default;
	}
	return $value;
}

/**
 * Keeps digits only.
 *
 * @param string $value Raw value.
 * @return string
 */
function bj_sanitize_digits( $value ) {
	return preg_replace( '/\D/', '', (string) $value );
}

/**
 * Checkbox sanitizer.
 *
 * @param mixed $value Raw value.
 * @return bool
 */
function bj_sanitize_checkbox( $value ) {
	return (bool) $value;
}

/**
 * Registers the Beyond Journey Settings section.
 *
 * @param WP_Customize_Manager $wp_customize Customizer manager.
 */
function bj_customize_register( $wp_customize ) {
	$wp_customize->add_section(
		'bj_settings',
		array(
			'title'       => __( 'Beyond Journey Settings', 'beyond-journey' ),
			'priority'    => 30,
			'description' => __( 'Contact details shown across the site, where enquiries are emailed, and the enquiry popup.', 'beyond-journey' ),
		)
	);

	$fields = array(
		'phone'         => array( __( 'Phone number', 'beyond-journey' ), 'text', 'sanitize_text_field', '' ),
		'whatsapp'      => array( __( 'WhatsApp number', 'beyond-journey' ), 'text', 'bj_sanitize_digits', __( 'Digits only, with country code, e.g. 971586711699.', 'beyond-journey' ) ),
		'email'         => array( __( 'Public email', 'beyond-journey' ), 'email', 'sanitize_email', '' ),
		'enquiry_email' => array( __( 'Send enquiries to', 'beyond-journey' ), 'email', 'sanitize_email', __( 'Leave empty to use the public email. Every enquiry is also saved under Enquiries in the dashboard.', 'beyond-journey' ) ),
		'location'      => array( __( 'Location', 'beyond-journey' ), 'text', 'sanitize_text_field', '' ),
		'website'       => array( __( 'Website address', 'beyond-journey' ), 'url', 'esc_url_raw', '' ),
		'instagram'     => array( __( 'Instagram link', 'beyond-journey' ), 'url', 'esc_url_raw', __( 'Full link to the profile. Leave empty to hide the icon in the footer.', 'beyond-journey' ) ),
		'facebook'      => array( __( 'Facebook link', 'beyond-journey' ), 'url', 'esc_url_raw', __( 'Leave empty to hide the icon in the footer.', 'beyond-journey' ) ),
		'x'             => array( __( 'X (Twitter) link', 'beyond-journey' ), 'url', 'esc_url_raw', __( 'Leave empty to hide the icon in the footer.', 'beyond-journey' ) ),
		'linkedin'      => array( __( 'LinkedIn link', 'beyond-journey' ), 'url', 'esc_url_raw', __( 'Leave empty to hide the icon in the footer.', 'beyond-journey' ) ),
		'tiktok'        => array( __( 'TikTok link', 'beyond-journey' ), 'url', 'esc_url_raw', __( 'Leave empty to hide the icon in the footer.', 'beyond-journey' ) ),
		'popup_enabled' => array( __( 'Show the enquiry popup once per visit', 'beyond-journey' ), 'checkbox', 'bj_sanitize_checkbox', '' ),
		'popup_delay'   => array( __( 'Popup delay (milliseconds)', 'beyond-journey' ), 'number', 'absint', '' ),
	);

	$wp_customize->add_setting(
		'bj_logo_light',
		array(
			'default'           => '',
			'sanitize_callback' => 'esc_url_raw',
		)
	);
	$wp_customize->add_control(
		new WP_Customize_Image_Control(
			$wp_customize,
			'bj_logo_light',
			array(
				'label'       => __( 'Light logo', 'beyond-journey' ),
				'description' => __( 'Shown in the header over the banner photo, before the page is scrolled. Leave empty to use the theme\'s light logo.', 'beyond-journey' ),
				'section'     => 'bj_settings',
			)
		)
	);

	$defaults = bj_setting_defaults();
	foreach ( $fields as $key => $field ) {
		list( $label, $type, $sanitize, $description ) = $field;

		$wp_customize->add_setting(
			'bj_' . $key,
			array(
				'default'           => $defaults[ $key ],
				'sanitize_callback' => $sanitize,
			)
		);
		$wp_customize->add_control(
			'bj_' . $key,
			array(
				'label'       => $label,
				'description' => $description,
				'section'     => 'bj_settings',
				'type'        => $type,
			)
		);
	}
}
add_action( 'customize_register', 'bj_customize_register' );
