<?php
/**
 * Key numbers on the brand blue background.
 *
 * @package Beyond_Journey
 */

defined( 'ABSPATH' ) || exit;

$c = $args;
?>
<section class="relative overflow-hidden bg-brand-blue py-12 lg:py-14"><?php bj_glow_blue(); ?>
	<div class="relative z-10 mx-auto max-w-7xl px-4 sm:px-6 lg:px-8"><div class="grid grid-cols-2 gap-3 sm:gap-4 lg:grid-cols-4">
		<?php
		foreach ( array_values( (array) $c['indicators'] ) as $bj_i => $bj_item ) :
			$bj_item = wp_parse_args( (array) $bj_item, array( 'value' => '', 'icon' => 'globe', 'label' => '' ) );
			?>
			<div class="aos" data-delay="<?php echo (int) $bj_i * 80; ?>"><div class="group flex h-full flex-col items-start gap-3 rounded-2xl bg-white p-4 shadow-[0_10px_28px_-14px_rgb(8_40_66_/_0.55)] ring-1 ring-white/40 transition-all duration-300 hover:-translate-y-0.5 hover:shadow-[0_18px_38px_-16px_rgb(8_40_66_/_0.65)] sm:p-5 lg:p-6">
				<span class="flex h-10 w-10 flex-shrink-0 items-center justify-center rounded-xl bg-brand-blue/10 text-brand-blue transition-colors duration-300 group-hover:bg-brand-blue group-hover:text-white [&_svg]:h-5 [&_svg]:w-5 sm:h-12 sm:w-12 sm:[&_svg]:h-6 sm:[&_svg]:w-6"><?php echo bj_icon( $bj_item['icon'] ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped -- static SVG. ?></span>
				<div>
					<?php
					bj_p( $bj_item['value'], 'text-2xl font-bold leading-none text-brand-heading sm:text-3xl lg:text-[2.5rem]' );
					bj_p( $bj_item['label'], 'mt-1.5 text-xs font-medium leading-snug text-brand-gray sm:text-[13px] lg:text-sm' );
					?>
				</div>
			</div></div>
		<?php endforeach; ?>
	</div></div>
</section>
