<?php
/**
 * About introduction.
 *
 * @package Beyond_Journey
 */

defined( 'ABSPATH' ) || exit;

$c = $args;
?>
<section id="about" class="about-sec bg-white py-14 lg:py-16"><div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
	<div class="grid items-center gap-10 lg:grid-cols-2 lg:gap-16">
		<div class="aos">
			<?php bj_p( $c['eyebrow'], BJ_EYEBROW ); ?>
			<h2 class="<?php echo esc_attr( BJ_H2 ); ?>"><?php echo bj_title( $c['title'], $c['highlight'], 'text-brand-heading-soft', true ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped -- escaped in bj_title(). ?></h2>
			<span class="section-accent"></span>
			<?php
			bj_p( $c['lead'], 'mt-5 text-lg leading-relaxed text-brand-gray' );
			bj_p( $c['text'], 'mt-4 leading-relaxed text-brand-gray' );
			bj_p( $c['tagline'], 'mt-5 text-lg font-semibold leading-snug text-brand-heading' );
			?>
			<div class="mt-7 flex flex-col gap-3 sm:flex-row sm:items-center">
				<?php
				bj_button( $c['button1_text'], $c['button1_url'], 'group inline-flex items-center justify-center gap-2 ' . BJ_BTN_BLUE, true );
				bj_button( $c['button2_text'], $c['button2_url'], 'inline-flex items-center justify-center gap-2 ' . BJ_BTN_GHOST );
				?>
			</div>
		</div>
		<?php // The photo runs to the right edge of the page with a wavy left side and bottom. ?>
		<div class="aos about-bleed" data-delay="150"><div class="about-wave-wrap" data-motion="about">
			<div class="about-wave"><img src="<?php echo esc_url( bj_media_src( $c['image'], 1400, 75, 1.4 ) ); ?>" alt="<?php echo esc_attr( bj_media_alt( $c['image'], $c['alt'] ) ); ?>" width="1400" height="1000" loading="lazy" decoding="async"></div>
		</div></div>
	</div>
</div></section>
