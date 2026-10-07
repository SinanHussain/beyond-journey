<?php
/**
 * Closing call to action.
 *
 * @package Beyond_Journey
 */

defined( 'ABSPATH' ) || exit;

$c        = $args;
$bj_lines = array_filter( array( trim( (string) $c['title'] ), trim( (string) $c['title2'] ) ), 'strlen' );
?>
<section class="relative overflow-hidden py-16 lg:py-20">
	<div class="absolute inset-0">
		<img src="<?php echo esc_url( bj_media_src( $c['image'], 1920, 78 ) ); ?>" alt="<?php echo esc_attr( bj_media_alt( $c['image'], $c['alt'] ) ); ?>" loading="lazy" decoding="async" class="h-full w-full object-cover object-[60%_center]">
		<div class="absolute inset-0 bg-gradient-to-r from-[#0B2A44]/90 via-[#0E2E4A]/80 to-[#12344F]/60"></div>
	</div>
	<div class="relative z-10 mx-auto max-w-4xl px-4 text-center sm:px-6 lg:px-8"><div class="aos">
		<?php bj_p( $c['eyebrow'], 'mb-3 text-xs font-semibold uppercase tracking-[0.25em] text-brand-orange sm:text-sm' ); ?>
		<h2 class="mb-5 text-[2rem] font-bold leading-[1.12] text-white sm:text-4xl lg:text-[3rem]"><?php echo implode( '<br>', array_map( 'esc_html', $bj_lines ) ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped -- escaped per line. ?></h2>
		<?php bj_p( $c['text'], 'mx-auto mb-8 max-w-2xl leading-relaxed text-white/80 sm:text-lg' ); ?>
		<div class="flex flex-col items-stretch justify-center gap-3 sm:flex-row sm:items-center">
			<?php bj_button( $c['button_text'], $c['button_url'], BJ_BTN_ORANGE ); ?>
			<?php if ( ! empty( $c['show_whatsapp'] ) && '' !== trim( $c['whatsapp_text'] ) ) : ?>
				<a href="<?php echo esc_url( bj_whatsapp_url() ); ?>" target="_blank" rel="noopener noreferrer" class="inline-flex items-center justify-center gap-2 rounded-lg border border-white/30 bg-white/15 px-7 py-3.5 font-medium text-white transition-all duration-300 hover:-translate-y-0.5 hover:bg-white/20">
					<?php echo bj_whatsapp_svg( 'h-5 w-5' ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped -- static SVG. ?><?php echo esc_html( $c['whatsapp_text'] ); ?></a>
			<?php endif; ?>
		</div>
	</div></div>
</section>
