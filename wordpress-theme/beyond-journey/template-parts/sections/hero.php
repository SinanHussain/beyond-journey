<?php
/**
 * Home hero carousel. The slides crossfade every few seconds (assets/js/theme.js).
 *
 * @package Beyond_Journey
 */

defined( 'ABSPATH' ) || exit;

$c         = $args;
$bj_slides = array();
foreach ( (array) $c['slides'] as $bj_slide ) {
	$bj_src = isset( $bj_slide['image'] ) ? bj_media_src( $bj_slide['image'], 1920, 80 ) : '';
	if ( '' !== $bj_src ) {
		$bj_slides[] = array(
			'src'  => $bj_src,
			'alt'  => bj_media_alt( $bj_slide['image'], isset( $bj_slide['alt'] ) ? $bj_slide['alt'] : '' ),
			'crop' => isset( $bj_slide['crop'] ) ? (int) $bj_slide['crop'] : 0,
		);
	}
}
?>
<section class="hero-home relative flex items-center overflow-hidden" aria-roledescription="carousel" aria-label="<?php esc_attr_e( 'Beyond Journey travel highlights', 'beyond-journey' ); ?>">
	<div class="absolute inset-0">
		<?php foreach ( $bj_slides as $bj_i => $bj_slide ) : ?>
			<div class="hero-slide absolute inset-0" data-hero-slide data-active="<?php echo 0 === $bj_i ? 'true' : 'false'; ?>" aria-hidden="<?php echo 0 === $bj_i ? 'false' : 'true'; ?>">
				<img src="<?php echo esc_url( $bj_slide['src'] ); ?>" alt="<?php echo esc_attr( $bj_slide['alt'] ); ?>" class="hero-img<?php echo $bj_slide['crop'] ? ' hero-img-' . (int) $bj_slide['crop'] : ''; ?>" <?php echo 0 === $bj_i ? 'fetchpriority="high"' : 'loading="lazy"'; ?> decoding="async">
			</div>
		<?php endforeach; ?>
		<div class="hero-overlay-h absolute inset-0 z-[1]"></div>
		<div class="hero-overlay-v absolute inset-0 z-[1]"></div>
	</div>
	<div class="relative z-10 mx-auto w-full max-w-7xl px-4 pb-24 pt-28 sm:px-6 lg:px-8 lg:pb-28 lg:pt-32">
		<div class="max-w-xl text-center lg:max-w-2xl lg:text-left">
			<?php bj_p( $c['eyebrow'], 'hero-animate-1 mb-4 text-xs font-semibold uppercase tracking-[0.25em] text-brand-orange sm:text-sm' ); ?>
			<h1 class="hero-animate-2 mb-5 text-[2rem] font-bold leading-[1.1] text-white sm:text-[2.75rem] lg:text-[3.25rem]"><?php echo bj_title( $c['title'], $c['highlight'], 'text-white', true ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped -- escaped in bj_title(). ?></h1>
			<?php bj_p( $c['text'], 'hero-animate-3 max-w-xl text-base leading-relaxed text-white/90 sm:text-lg' ); ?>
		</div>
	</div>
</section>
<?php // Quick services bar: a white card overlapping the bottom of the banner. ?>
<div class="quick-bar"><div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8"><div class="aos quick-bar-card" role="region" aria-label="<?php esc_attr_e( 'Our services', 'beyond-journey' ); ?>"><div class="quick-viewport"><div class="quick-track">
	<?php // Four copies so the loop never shows a gap; only the first copy is read out. ?>
	<?php for ( $bj_copy = 0; $bj_copy < 4; $bj_copy++ ) : ?>
		<?php foreach ( bj_quick_services() as $bj_quick ) : ?>
			<span class="quick-item"<?php echo $bj_copy ? ' aria-hidden="true"' : ''; ?>><span class="quick-ico"><?php echo bj_svg( $bj_quick[1], '', 1.8 ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped -- static SVG. ?></span><span class="quick-label"><?php echo esc_html( $bj_quick[0] ); ?></span></span>
		<?php endforeach; ?>
	<?php endfor; ?>
</div></div></div></div></div>
