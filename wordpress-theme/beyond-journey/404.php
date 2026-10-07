<?php
/**
 * Page not found.
 *
 * @package Beyond_Journey
 */

defined( 'ABSPATH' ) || exit;

bj_is_designed( true );
get_header();

bj_section(
	'page-hero',
	array(
		'title'     => 'Page',
		'highlight' => 'Not Found',
		'subtitle'  => "The page you are looking for doesn't exist or has moved.",
		'image'     => 'https://images.unsplash.com/photo-1464822759023-fed622ff2c3b',
		'pos'       => 'object-[62%_45%]',
	)
);
?>
<section class="bg-white py-14 lg:py-16"><div class="mx-auto flex max-w-3xl flex-col items-center gap-3 px-4 text-center sm:flex-row sm:justify-center sm:px-6 lg:px-8">
	<a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="group inline-flex items-center justify-center gap-2 <?php echo esc_attr( BJ_BTN_BLUE ); ?>">Back to Home<?php echo bj_arrow_svg(); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped -- static SVG. ?></a>
	<a href="<?php echo esc_url( bj_url( 'contact' ) ); ?>" class="inline-flex items-center justify-center gap-2 <?php echo esc_attr( BJ_BTN_GHOST ); ?>">Contact Us</a>
</div></section>
<?php
get_footer();
