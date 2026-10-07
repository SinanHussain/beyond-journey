<?php
/**
 * Inbound / outbound cards.
 *
 * @package Beyond_Journey
 */

defined( 'ABSPATH' ) || exit;

$c = $args;
?>
<section class="inbound-sec py-16 lg:py-24 <?php echo esc_attr( $c['bg'] ); ?>"><div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
	<?php bj_heading( $c['eyebrow'], bj_title( $c['title'], $c['highlight'] ), $c['lead'], 'mb-12 lg:mb-14' ); ?>
	<div class="grid gap-5 md:grid-cols-2">
		<?php
		foreach ( array_values( (array) $c['cards'] ) as $bj_i => $bj_card ) :
			$bj_card = wp_parse_args(
				(array) $bj_card,
				array( 'tag' => '', 'direction' => 'arrow-down', 'title' => '', 'text' => '', 'points' => '', 'link_text' => '', 'link_url' => '', 'image' => '', 'alt' => '' )
			);
			$bj_icon   = 'arrow-up' === $bj_card['direction'] ? 'arrow-up' : 'arrow-down';
			?>
			<div class="aos <?php echo $bj_i ? 'slide-right' : 'slide-left'; ?> h-full" data-delay="<?php echo (int) $bj_i * 140; ?>"><div class="group relative h-full overflow-hidden rounded-2xl shadow-lg transition-shadow duration-500 hover:shadow-2xl">
				<img src="<?php echo esc_url( bj_media_src( $bj_card['image'], 900, 75, 0.8 ) ); ?>" alt="<?php echo esc_attr( bj_media_alt( $bj_card['image'], $bj_card['alt'] ) ); ?>" loading="lazy" decoding="async" class="absolute inset-0 h-full w-full object-cover transition-transform duration-700 group-hover:scale-105">
				<div class="absolute inset-0 bg-gradient-to-t from-[#0B2A44]/95 via-[#0B2A44]/60 to-[#0B2A44]/10"></div>
				<div class="inb-body relative flex h-full flex-col justify-end p-7 sm:p-9 lg:p-10">
					<?php if ( '' !== trim( $bj_card['tag'] ) ) : ?>
						<div class="mb-3 inline-flex w-fit items-center gap-2 rounded-full bg-white/25 px-3 py-1.5 text-[11px] font-semibold uppercase tracking-[0.14em] text-white">
							<?php echo bj_svg( $bj_icon, 'h-3.5 w-3.5', 2 ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped -- static SVG. ?><?php echo esc_html( $bj_card['tag'] ); ?></div>
					<?php endif; ?>
					<h3 class="mb-3 text-[1.75rem] font-bold leading-[1.12] tracking-tight text-white sm:text-[2rem] lg:text-[2.25rem]"><?php echo esc_html( $bj_card['title'] ); ?></h3>
					<span aria-hidden="true" class="mb-4 block h-1 w-14 rounded-full bg-brand-orange"></span>
					<?php bj_p( $bj_card['text'], 'inb-text mb-5 max-w-md text-[15px] leading-relaxed text-white/90 sm:text-base' ); ?>
					<?php bj_button( $bj_card['link_text'], $bj_card['link_url'], 'group inline-flex items-center gap-2 font-semibold text-brand-orange transition-colors hover:text-brand-orange-light', true ); ?>
				</div>
			</div></div>
		<?php endforeach; ?>
	</div>
</div></section>
