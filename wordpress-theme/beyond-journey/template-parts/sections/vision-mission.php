<?php
/**
 * Vision and mission.
 *
 * @package Beyond_Journey
 */

defined( 'ABSPATH' ) || exit;

$c         = $args;
$bj_colors = array(
	'orange' => array( 'text-brand-orange', 'bg-brand-orange/10 text-brand-orange' ),
	'blue'   => array( 'text-brand-blue', 'bg-brand-blue/10 text-brand-blue' ),
);
?>
<section class="py-14 lg:py-16 <?php echo esc_attr( $c['bg'] ); ?>"><div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
	<div class="grid gap-5 lg:grid-cols-2 lg:gap-6">
		<?php
		foreach ( array_values( (array) $c['pillars'] ) as $bj_i => $bj_pillar ) :
			$bj_pillar = wp_parse_args( (array) $bj_pillar, array( 'eyebrow' => '', 'color' => 'blue', 'icon' => 'eye', 'title' => '', 'text' => '' ) );
			$bj_color  = isset( $bj_colors[ $bj_pillar['color'] ] ) ? $bj_colors[ $bj_pillar['color'] ] : $bj_colors['blue'];
			?>
			<div class="aos" data-delay="<?php echo (int) $bj_i * 120; ?>"><div class="relative h-full overflow-hidden rounded-2xl border border-brand-blue/25 bg-brand-blue-mist p-7 transition-all duration-300 hover:border-brand-blue/45 hover:shadow-[0_18px_40px_-22px_rgb(23_82_125_/_0.45)] lg:p-8">
				<span aria-hidden="true" class="absolute inset-x-0 top-0 h-1 <?php echo 0 === $bj_i ? 'bg-brand-orange' : 'bg-brand-blue'; ?>"></span>
				<span class="mb-5 flex items-center justify-center rounded-2xl <?php echo esc_attr( $bj_color[1] ); ?> [&_svg]:h-6 [&_svg]:w-6" style="width:3.25rem;height:3.25rem"><?php echo bj_icon( $bj_pillar['icon'] ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped -- static SVG. ?></span>
				<?php bj_p( $bj_pillar['eyebrow'], 'mb-2 text-xs font-semibold uppercase tracking-[0.18em] sm:text-sm ' . $bj_color[0] ); ?>
				<h2 class="mb-3 text-2xl font-bold leading-tight text-brand-heading sm:text-[1.75rem]"><?php echo esc_html( $bj_pillar['title'] ); ?></h2>
				<?php bj_p( $bj_pillar['text'], 'leading-relaxed text-brand-gray' ); ?>
			</div></div>
		<?php endforeach; ?>
	</div>
</div></section>
