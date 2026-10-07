<?php
/**
 * Beyond Journey theme bootstrap.
 *
 * @package Beyond_Journey
 */

defined( 'ABSPATH' ) || exit;

define( 'BJ_VERSION', '1.4.1' );
define( 'BJ_DIR', get_template_directory() );
define( 'BJ_URI', get_template_directory_uri() );

require BJ_DIR . '/inc/icons.php';
require BJ_DIR . '/inc/helpers.php';
require BJ_DIR . '/inc/content.php';
require BJ_DIR . '/inc/customizer.php';
require BJ_DIR . '/inc/setup.php';
require BJ_DIR . '/inc/navigation.php';
require BJ_DIR . '/inc/enquiries.php';
require BJ_DIR . '/inc/packages.php';
require BJ_DIR . '/inc/activation.php';
require BJ_DIR . '/inc/elementor.php';
require BJ_DIR . '/inc/footer-template.php';
