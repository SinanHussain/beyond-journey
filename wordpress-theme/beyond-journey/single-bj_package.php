<?php
/**
 * One holiday package's page (/package/<name>/).
 *
 * @package Beyond_Journey
 */

defined( 'ABSPATH' ) || exit;

bj_is_designed( true );
get_header();
while ( have_posts() ) {
	the_post();
	get_template_part( 'template-parts/package-detail', null, array( 'pkg' => bj_package_item( get_post() ) ) );
}
get_footer();
