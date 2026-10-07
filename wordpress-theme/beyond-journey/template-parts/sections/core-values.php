<?php
/**
 * Core values: glass cards on the scenic blue background.
 *
 * @package Beyond_Journey
 */

defined( 'ABSPATH' ) || exit;

$c         = $args;
$bj_accent = array(
	'blue'         => 'bg-brand-blue',
	'orange'       => 'bg-brand-orange',
	'blue-light'   => 'bg-brand-blue-light',
	'orange-light' => 'bg-brand-orange-light',
);
?>
<section class="relative overflow-hidden bg-brand-blue py-16 lg:py-24"><?php bj_scenic(); ?><?php bj_glow_blue(); ?>
	<div aria-hidden="true" class="pointer-events-none absolute inset-x-0 top-0 z-[2] h-24 bg-gradient-to-b from-white/90 via-white/25 to-transparent lg:h-32"></div>
	<div class="relative z-10 mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
		<?php bj_heading( $c['eyebrow'], bj_title( $c['title'], $c['highlight'], 'text-brand-orange-light' ), $c['lead'], 'mb-12 lg:mb-14', 'on-blue' ); ?>
		<div class="grid gap-4 sm:grid-cols-2 lg:grid-cols-4 lg:gap-5">
			<?php
			foreach ( array_values( (array) $c['values'] ) as $bj_i => $bj_value ) :
				$bj_value = wp_parse_args( (array) $bj_value, array( 'title' => '', 'color' => 'blue', 'icon' => 'globe', 'description' => '' ) );
				$bj_bar   = isset( $bj_accent[ $bj_value['color'] ] ) ? $bj_accent[ $bj_value['color'] ] : $bj_accent['blue'];
				?>
				<div class="aos" data-delay="<?php echo (int) $bj_i * 90; ?>"><div class="group relative flex h-full flex-col overflow-hidden rounded-2xl border border-white/25 bg-[#0B2A44]/45 p-6 shadow-[0_14px_38px_-18px_rgb(4_24_42_/_0.75)] transition-all duration-300 hover:-translate-y-1.5 hover:border-white/40 hover:bg-[#0B2A44]/55 lg:p-7">
					<span aria-hidden="true" class="pointer-events-none absolute inset-x-0 top-0 h-24 bg-gradient-to-b from-white/15 to-transparent"></span>
					<span aria-hidden="true" class="absolute left-0 top-0 z-10 h-1 w-16 rounded-br-full <?php echo esc_attr( $bj_bar ); ?> transition-all duration-500 group-hover:w-full"></span>
					<span class="relative mb-5 mt-2 flex h-14 w-14 items-center justify-center rounded-2xl border border-white/25 bg-white/15 text-white transition-transform duration-300 group-hover:scale-105 [&_svg]:h-7 [&_svg]:w-7"><?php echo bj_icon( $bj_value['icon'] ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped -- static SVG. ?></span>
					<h3 class="relative mb-2 flex items-center gap-2 text-xl font-bold text-white"><?php echo esc_html( $bj_value['title'] ); ?><span aria-hidden="true" class="h-1.5 w-1.5 rounded-full bg-brand-orange opacity-0 transition-opacity duration-300 group-hover:opacity-100"></span></h3>
					<?php bj_p( $bj_value['description'], 'relative text-sm leading-relaxed text-white/85' ); ?>
				</div></div>
			<?php endforeach; ?>
		</div>
	</div>
</section>
