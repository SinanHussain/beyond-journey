<?php
/**
 * Destination card. Args: dest (name, region, description, image, alt), href (link value).
 *
 * @package Beyond_Journey
 */

defined( 'ABSPATH' ) || exit;

$bj_dest = wp_parse_args( (array) $args['dest'], array( 'name' => '', 'region' => '', 'description' => '', 'image' => '', 'alt' => '' ) );
?>
<a<?php echo bj_link_attrs( $args['href'] ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped -- escaped in bj_link_attrs(). ?> class="group flex h-full flex-col rounded-[1.75rem] bg-white p-3 shadow-[0_6px_24px_-10px_rgb(23_82_125_/_0.25)] ring-1 ring-brand-blue/5 transition-all duration-500 hover:-translate-y-1.5 hover:shadow-[0_22px_50px_-16px_rgb(23_82_125_/_0.35)] hover:ring-brand-blue/15">
	<div class="relative overflow-hidden rounded-[1.35rem]"><div class="aspect-[4/5]">
		<img src="<?php echo esc_url( bj_media_src( $bj_dest['image'], 700, 75, 0.8 ) ); ?>" alt="<?php echo esc_attr( bj_media_alt( $bj_dest['image'], $bj_dest['alt'] ) ); ?>" loading="lazy" decoding="async" class="h-full w-full object-cover transition-transform duration-[900ms] ease-out group-hover:scale-[1.07]"></div>
		<div class="absolute inset-x-0 top-0 h-24 bg-gradient-to-b from-black/35 to-transparent"></div>
		<?php if ( '' !== trim( $bj_dest['region'] ) ) : ?>
			<span class="absolute left-3 top-3 inline-flex items-center gap-1.5 rounded-full bg-white px-3 py-1.5 text-[11px] font-semibold text-brand-heading shadow-sm">
				<?php echo bj_svg( 'pin', 'h-3.5 w-3.5 text-brand-orange', 2 ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped -- static SVG. ?><?php echo esc_html( $bj_dest['region'] ); ?></span>
		<?php endif; ?>
	</div>
	<div class="flex flex-1 flex-col px-3 pb-2 pt-4">
		<h3 class="text-xl font-bold leading-tight text-brand-heading transition-colors group-hover:text-brand-blue"><?php echo esc_html( $bj_dest['name'] ); ?></h3>
		<?php bj_p( $bj_dest['description'], 'clamp-2 mt-1.5 text-[13px] leading-relaxed text-brand-gray' ); ?>
		<div class="mt-auto flex items-center justify-between pt-4">
			<span class="inline-flex items-center gap-1.5 text-[11px] font-semibold uppercase tracking-[0.14em] text-brand-gray-light">
				<?php echo bj_svg( 'plane', 'h-3.5 w-3.5 text-brand-blue', 1.8 ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped -- static SVG. ?><?php esc_html_e( 'Plan this trip', 'beyond-journey' ); ?></span>
			<span aria-hidden="true" class="flex h-9 w-9 items-center justify-center rounded-full bg-brand-blue-pale text-brand-blue transition-all duration-300 group-hover:bg-brand-orange group-hover:text-white">
				<?php echo bj_svg( 'arrow-right', 'h-4 w-4 transition-transform duration-300 group-hover:translate-x-0.5', 2 ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped -- static SVG. ?></span>
		</div>
	</div>
</a>
