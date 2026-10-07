<?php
/**
 * Theme setup, assets and head tags.
 *
 * @package Beyond_Journey
 */

defined( 'ABSPATH' ) || exit;

/** Theme supports and menu locations. */
function bj_setup() {
	load_theme_textdomain( 'beyond-journey', BJ_DIR . '/languages' );

	add_theme_support( 'title-tag' );
	add_theme_support( 'post-thumbnails' );
	add_theme_support( 'automatic-feed-links' );
	add_theme_support( 'responsive-embeds' );
	add_theme_support( 'html5', array( 'search-form', 'comment-form', 'comment-list', 'gallery', 'caption', 'style', 'script', 'navigation-widgets' ) );
	add_theme_support(
		'custom-logo',
		array(
			'width'       => 640,
			'height'      => 247,
			'flex-width'  => true,
			'flex-height' => true,
		)
	);

	register_nav_menus(
		array(
			'primary'             => __( 'Primary Menu', 'beyond-journey' ),
			'footer_services'     => __( 'Footer: Our Services', 'beyond-journey' ),
		)
	);
}
add_action( 'after_setup_theme', 'bj_setup' );

/**
 * Cache-busting version from the file's modification time.
 *
 * @param string $relative Path inside the theme.
 * @return string
 */
function bj_asset_version( $relative ) {
	$path = BJ_DIR . '/' . $relative;
	return file_exists( $path ) ? (string) filemtime( $path ) : BJ_VERSION;
}

/** Styles and scripts. */
function bj_assets() {
	wp_enqueue_style( 'bj-fonts', 'https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap', array(), null ); // phpcs:ignore WordPress.WP.EnqueuedResourceParameters.MissingVersion
	// Brush-script font for the package location on the Packages page showcase.
	if ( is_page( 'packages' ) || is_singular( 'bj_package' ) ) {
		wp_enqueue_style( 'bj-script-font', 'https://fonts.googleapis.com/css2?family=Kaushan+Script&display=swap', array(), null ); // phpcs:ignore WordPress.WP.EnqueuedResourceParameters.MissingVersion
	}
	wp_enqueue_style( 'bj-tailwind', BJ_URI . '/assets/css/tailwind.css', array(), bj_asset_version( 'assets/css/tailwind.css' ) );
	wp_enqueue_style( 'bj-theme', BJ_URI . '/assets/css/theme.css', array( 'bj-tailwind' ), bj_asset_version( 'assets/css/theme.css' ) );

	wp_enqueue_script(
		'bj-theme',
		BJ_URI . '/assets/js/theme.js',
		array(),
		bj_asset_version( 'assets/js/theme.js' ),
		array(
			'in_footer' => true,
			'strategy'  => 'defer',
		)
	);
	wp_add_inline_script(
		'bj-theme',
		'window.bjTheme = ' . wp_json_encode(
			array(
				'ajaxUrl'    => admin_url( 'admin-ajax.php' ),
				'popup'      => (bool) bj_setting( 'popup_enabled' ),
				'popupDelay' => (int) bj_setting( 'popup_delay' ),
				'errorText'  => __( 'Sorry, your enquiry could not be sent. Please try again, or contact us on WhatsApp.', 'beyond-journey' ),
				'openMenu'   => __( 'Open menu', 'beyond-journey' ),
				'closeMenu'  => __( 'Close menu', 'beyond-journey' ),
			)
		) . ';',
		'before'
	);

	// The designed pages contain no blocks, so skip the block editor styles there.
	if ( bj_is_designed() ) {
		wp_dequeue_style( 'wp-block-library' );
		wp_dequeue_style( 'wp-block-library-theme' );
		wp_dequeue_style( 'classic-theme-styles' );
		wp_dequeue_style( 'global-styles' );
	}
}
add_action( 'wp_enqueue_scripts', 'bj_assets', 20 );

/**
 * Layout classes the original site set on <body>.
 *
 * @param string[] $classes Body classes.
 * @return string[]
 */
function bj_body_class( $classes ) {
	return array_merge( $classes, array( 'flex', 'min-h-screen', 'flex-col' ) );
}
add_filter( 'body_class', 'bj_body_class' );

/** "Page | Site" titles, like the original site. */
function bj_title_separator() {
	return '|';
}
add_filter( 'document_title_separator', 'bj_title_separator' );

/** Home page meta description, unless an SEO plugin handles it. */
function bj_meta_description() {
	if ( ! is_front_page() || defined( 'WPSEO_VERSION' ) || defined( 'RANK_MATH_VERSION' ) || defined( 'AIOSEO_VERSION' ) || defined( 'SEOPRESS_VERSION' ) ) {
		return;
	}
	$description = 'Dubai-based travel and tourism company offering destination management, outbound tours, holiday packages, visa services, corporate travel & more. Explore beyond boundaries with Beyond Journey Tourism.';
	echo '<meta name="description" content="' . esc_attr( $description ) . '">' . "\n";
}
add_action( 'wp_head', 'bj_meta_description', 1 );

/** Uses the logo as the favicon until a Site Icon is set. */
function bj_favicon() {
	if ( has_site_icon() ) {
		return;
	}
	echo '<link rel="icon" href="' . esc_url( bj_logo_url() ) . '">' . "\n";
}
add_action( 'wp_head', 'bj_favicon', 2 );
