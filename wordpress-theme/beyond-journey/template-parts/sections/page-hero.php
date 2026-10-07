<?php
/**
 * Inner page banner: one photo, or several that crossfade.
 * A featured image on the page replaces the photos, unless a photo was chosen in the widget.
 *
 * @package Beyond_Journey
 */

defined( 'ABSPATH' ) || exit;

$c         = $args;
$bj_chosen = false;
$bj_slides = array();
foreach ( (array) $c['slides'] as $bj_slide ) {
	$bj_src = isset( $bj_slide['image'] ) ? bj_media_src( $bj_slide['image'], 1920, 78 ) : '';
	if ( '' === $bj_src ) {
		continue;
	}
	if ( is_array( $bj_slide['image'] ) && ! empty( $bj_slide['image']['id'] ) ) {
		$bj_chosen = true;
	}
	$bj_slides[] = array(
		'src'      => $bj_src,
		'alt'      => bj_media_alt( $bj_slide['image'], isset( $bj_slide['alt'] ) ? $bj_slide['alt'] : '' ),
		'position' => ! empty( $bj_slide['position'] ) ? $bj_slide['position'] : 'object-[70%_center]',
	);
}

if ( ! $bj_chosen && is_singular() && has_post_thumbnail() ) {
	$bj_slides = array(
		array(
			'src'      => get_the_post_thumbnail_url( null, 'full' ),
			'alt'      => (string) get_post_meta( get_post_thumbnail_id(), '_wp_attachment_image_alt', true ),
			'position' => 'object-center',
		),
	);
}
?>
<section class="relative overflow-hidden pt-20">
	<div class="absolute inset-0 bg-brand-blue-dark">
		<?php foreach ( $bj_slides as $bj_i => $bj_slide ) : ?>
			<div class="hero-slide absolute inset-0" data-hero-slide data-active="<?php echo 0 === $bj_i ? 'true' : 'false'; ?>" aria-hidden="<?php echo 0 === $bj_i ? 'false' : 'true'; ?>">
				<img src="<?php echo esc_url( $bj_slide['src'] ); ?>" alt="<?php echo esc_attr( $bj_slide['alt'] ); ?>" <?php echo 0 === $bj_i ? 'fetchpriority="high"' : 'loading="lazy"'; ?> decoding="async" class="hero-img h-full w-full object-cover <?php echo esc_attr( $bj_slide['position'] ); ?>">
			</div>
		<?php endforeach; ?>
		<div class="hero-blue absolute inset-0 z-[1]"></div><div class="hero-shade absolute inset-0 z-[1]"></div>
	</div>
	<div class="relative z-10 mx-auto max-w-7xl px-4 py-14 sm:px-6 lg:px-8 lg:py-20">
		<nav aria-label="<?php esc_attr_e( 'Breadcrumb', 'beyond-journey' ); ?>" class="mb-5 flex items-center gap-2 text-sm text-white/65">
			<a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="transition-colors hover:text-white"><?php esc_html_e( 'Home', 'beyond-journey' ); ?></a>
			<?php echo bj_svg( 'chevron', 'h-3.5 w-3.5', 2 ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped -- static SVG. ?>
			<span class="text-white/90" aria-current="page"><?php echo esc_html( '' !== trim( (string) $c['highlight'] ) ? $c['highlight'] : $c['title'] ); ?></span>
		</nav>
		<h1 class="max-w-3xl text-[2rem] font-bold leading-[1.12] text-white sm:text-4xl lg:text-[3rem]"><?php echo bj_title( $c['title'], $c['highlight'], 'bg-gradient-to-r from-brand-orange to-brand-orange-light bg-clip-text text-transparent' ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped -- escaped in bj_title(). ?></h1>
		<?php bj_p( $c['subtitle'], 'mt-4 max-w-2xl leading-relaxed text-white/80 sm:text-lg' ); ?>
	</div>
</section>
