<?php
/**
 * Destinations carousel.
 *
 * @package Beyond_Journey
 */

defined( 'ABSPATH' ) || exit;

$c               = $args;
$bj_arrow_button = 'absolute top-[42%] z-20 flex h-10 w-10 -translate-y-1/2 items-center justify-center rounded-full bg-white text-brand-heading shadow-lg ring-1 ring-brand-blue/10 transition-all duration-200 hover:scale-105 hover:text-brand-blue hover:shadow-xl disabled:pointer-events-none disabled:opacity-0 sm:h-11 sm:w-11';
?>
<section id="destinations" class="relative overflow-hidden bg-gradient-to-b from-white via-brand-blue-mist to-brand-blue-pale pb-8 pt-14 lg:pb-10 lg:pt-16"><?php bj_glow(); ?>
	<div class="relative z-10 mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
		<?php bj_heading( $c['eyebrow'], bj_title( $c['title'], $c['highlight'] ), $c['lead'], 'mb-9' ); ?>
	</div>
	<div class="relative z-10"><div class="relative mx-auto max-w-7xl">
		<button type="button" data-carousel="prev" aria-label="<?php esc_attr_e( 'Previous destination', 'beyond-journey' ); ?>" class="<?php echo esc_attr( $bj_arrow_button ); ?> left-0 sm:left-2 lg:left-6">
			<?php echo bj_svg( 'caret-left', 'h-5 w-5', 2 ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped -- static SVG. ?></button>
		<button type="button" data-carousel="next" aria-label="<?php esc_attr_e( 'Next destination', 'beyond-journey' ); ?>" class="<?php echo esc_attr( $bj_arrow_button ); ?> right-0 sm:right-2 lg:right-6">
			<?php echo bj_svg( 'caret-right', 'h-5 w-5', 2 ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped -- static SVG. ?></button>
		<div class="dest-scroller scrollbar-hide flex gap-4 overflow-x-auto px-4 pb-6 pt-2 sm:gap-5 sm:px-6 lg:px-8" role="region" aria-label="<?php esc_attr_e( 'Destinations carousel', 'beyond-journey' ); ?>" tabindex="0">
			<?php foreach ( (array) $c['destinations'] as $bj_dest ) : ?>
				<div data-dest-card data-active="false" class="dest-card w-[72vw] flex-shrink-0 sm:w-[44vw] md:w-[32vw] lg:w-[24vw] xl:w-[20vw] min-w-[230px] max-w-[320px]">
					<?php
					get_template_part(
						'template-parts/dest-card',
						null,
						array(
							'dest' => $bj_dest,
							'href' => $c['card_url'],
						)
					);
					?>
				</div>
			<?php endforeach; ?>
		</div>
	</div></div>
	<?php if ( '' !== trim( $c['button_text'] ) ) : ?>
		<div class="relative z-10 mx-auto mt-3 max-w-3xl px-4 text-center sm:px-6">
			<?php bj_button( $c['button_text'], $c['button_url'], 'group mt-5 inline-flex items-center gap-2 rounded-lg bg-brand-blue px-6 py-3 text-sm font-semibold text-white transition-all duration-300 hover:-translate-y-0.5 hover:bg-brand-blue-dark hover:shadow-lg hover:shadow-brand-blue/20', true ); ?>
		</div>
	<?php endif; ?>
</section>
