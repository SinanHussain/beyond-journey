<?php
/**
 * Services: a staggered gallery of rounded photo cards, grouped by category, or the three photo cards ("pillars").
 * Services whose category is not listed are shown last in the grouped layout.
 *
 * @package Beyond_Journey
 */

defined( 'ABSPATH' ) || exit;

$c        = $args;
$bj_items = array();
foreach ( (array) $c['services'] as $bj_service ) {
	$bj_items[] = wp_parse_args( (array) $bj_service, array( 'title' => '', 'category' => '', 'description' => '', 'image' => '', 'alt' => '' ) );
}

$bj_in_category = static function ( $items, $category ) {
	$found = array();
	foreach ( $items as $item ) {
		if ( 0 === strcasecmp( trim( $item['category'] ), trim( $category ) ) ) {
			$found[] = $item;
		}
	}
	return $found;
};

// Rounded photo card; the row staggers card heights (see .svc-row in theme.css).
$bj_card = static function ( $service, $delay ) use ( $c ) {
	$src = bj_media_src( $service['image'], 560, 75, 0.72 );
	printf(
		'<div class="aos" data-delay="%1$d"><a%2$s class="svc-card">%3$s<span class="svc-card-body"><h3>%4$s</h3><p>%5$s</p><span class="svc-card-cta">%6$s%7$s</span></span></a></div>',
		(int) $delay,
		bj_link_attrs( $c['tile_url'] ), // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped -- escaped in bj_link_attrs().
		'' !== $src ? '<img src="' . esc_url( $src ) . '" alt="' . esc_attr( bj_media_alt( $service['image'], $service['alt'] ) ) . '" loading="lazy" decoding="async">' : '', // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped -- escaped here.
		esc_html( $service['title'] ),
		esc_html( $service['description'] ),
		esc_html__( 'Enquire', 'beyond-journey' ),
		bj_arrow_svg() // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped -- static SVG.
	);
};

$bj_group = static function ( $category, $items ) use ( $bj_card ) {
	echo '<div class="svc-group">';
	if ( '' !== trim( $category['name'] ) ) {
		echo '<div class="aos svc-group-head"><h3>' . esc_html( $category['name'] ) . '</h3>';
		if ( '' !== trim( $category['blurb'] ) ) {
			echo '<p>' . esc_html( $category['blurb'] ) . '</p>';
		}
		echo '</div>';
	}
	echo '<div class="svc-row">';
	foreach ( array_values( $items ) as $bj_i => $bj_service ) {
		$bj_card( $bj_service, $bj_i * 60 );
	}
	echo '</div></div>';
};
?>
<section id="services" class="relative overflow-hidden py-14 lg:py-16 <?php echo esc_attr( $c['bg'] ); ?>"><?php bj_glow(); ?><div class="relative z-10 mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
	<?php
	if ( ! empty( $c['show_heading'] ) ) {
		bj_heading( $c['eyebrow'], bj_title( $c['title'], $c['highlight'] ), $c['lead'] );
	}
	?>
	<?php if ( 'grouped' === $c['layout'] ) : ?>
		<div class="space-y-10">
			<?php
			$bj_groups = array();
			$bj_listed = array();
			foreach ( (array) $c['categories'] as $bj_category ) {
				$bj_category = wp_parse_args( (array) $bj_category, array( 'name' => '', 'blurb' => '' ) );
				$bj_found    = $bj_in_category( $bj_items, $bj_category['name'] );
				$bj_listed   = array_merge( $bj_listed, $bj_found );
				if ( $bj_found ) {
					$bj_groups[ $bj_category['name'] ] = array( 'category' => $bj_category, 'items' => $bj_found );
				}
			}
			$bj_other = array_udiff(
				$bj_items,
				$bj_listed,
				static function ( $a, $b ) {
					return strcmp( $a['title'] . $a['description'], $b['title'] . $b['description'] );
				}
			);
			if ( $bj_other ) {
				$bj_groups[] = array( 'category' => array( 'name' => '', 'blurb' => '' ), 'items' => $bj_other );
			}

			// Travel Essentials fills a row of its own; DMC & Support and Leisure share the next one.
			$bj_wide = 'Travel Essentials & Corporate Services';
			$bj_pair = array( 'DMC & Support', 'Leisure & Experiences' );
			if ( isset( $bj_groups[ $bj_wide ], $bj_groups[ $bj_pair[0] ], $bj_groups[ $bj_pair[1] ] ) ) {
				$bj_group( $bj_groups[ $bj_wide ]['category'], $bj_groups[ $bj_wide ]['items'] );
				echo '<div class="svc-pair">';
				foreach ( $bj_pair as $bj_name ) {
					$bj_group( $bj_groups[ $bj_name ]['category'], $bj_groups[ $bj_name ]['items'] );
				}
				echo '</div>';
				foreach ( array( $bj_wide, $bj_pair[0], $bj_pair[1] ) as $bj_name ) {
					unset( $bj_groups[ $bj_name ] );
				}
			}
			foreach ( $bj_groups as $bj_entry ) {
				$bj_group( $bj_entry['category'], $bj_entry['items'] );
			}
			?>
		</div>
	<?php elseif ( 'pillars' === $c['layout'] ) : ?>
		<div class="grid gap-5 lg:grid-cols-3 lg:gap-6">
			<?php
			foreach ( array_values( (array) $c['pillars'] ) as $bj_i => $bj_pillar ) :
				$bj_pillar = wp_parse_args( (array) $bj_pillar, array( 'step' => '', 'title' => '', 'category' => '', 'description' => '', 'image' => '', 'alt' => '' ) );
				$bj_chips  = $bj_in_category( $bj_items, $bj_pillar['category'] );
				?>
				<div class="aos h-full md:mx-auto md:w-full md:max-w-2xl lg:max-w-none" data-delay="<?php echo (int) $bj_i * 110; ?>">
					<article class="group relative flex h-full min-h-[24rem] flex-col overflow-hidden rounded-2xl shadow-[0_14px_38px_-22px_rgb(8_40_66_/_0.65)] transition-all duration-300 hover:-translate-y-1.5 hover:shadow-[0_28px_56px_-26px_rgb(8_40_66_/_0.7)] lg:min-h-[27rem]">
						<img src="<?php echo esc_url( bj_media_src( $bj_pillar['image'], 700, 75, 0.8 ) ); ?>" alt="<?php echo esc_attr( bj_media_alt( $bj_pillar['image'], $bj_pillar['alt'] ) ); ?>" loading="lazy" decoding="async" class="absolute inset-0 h-full w-full object-cover transition-transform duration-700 group-hover:scale-105">
						<div aria-hidden="true" class="absolute inset-0 bg-gradient-to-tr from-[#0B2A44]/95 via-[#0B2A44]/75 to-[#0B2A44]/35"></div>
						<div class="relative flex h-full flex-1 flex-col p-6 lg:p-7">
							<?php bj_p( $bj_pillar['step'], 'mb-2 text-xs font-bold uppercase tracking-[0.22em] text-brand-orange-light' ); ?>
							<h3 class="mb-3 text-2xl font-bold leading-tight text-white lg:min-h-[4rem] xl:min-h-0"><?php echo esc_html( $bj_pillar['title'] ); ?></h3>
							<?php bj_p( $bj_pillar['description'], 'mb-5 text-[15px] leading-relaxed text-white/85 lg:min-h-[7.5rem] xl:min-h-[6rem]' ); ?>
							<ul class="mb-6 space-y-2 text-[13px] leading-snug text-white/85">
								<?php foreach ( $bj_chips as $bj_chip ) : ?>
									<li class="flex items-start gap-2.5"><span aria-hidden="true" class="mt-[6px] h-1.5 w-1.5 flex-shrink-0 rounded-full bg-white/50"></span><?php echo esc_html( $bj_chip['title'] ); ?></li>
								<?php endforeach; ?>
							</ul>
							<?php bj_button( $c['pillar_cta'], $c['pillar_url'], 'btn-tap mt-auto inline-flex w-fit items-center gap-2 rounded-full bg-white/25 px-5 py-2.5 text-sm font-semibold text-white', true ); ?>
						</div>
					</article></div>
			<?php endforeach; ?>
		</div>
	<?php else : ?>
		<div class="svc-row">
			<?php
			foreach ( $bj_items as $bj_i => $bj_service ) {
				$bj_card( $bj_service, $bj_i < 8 ? $bj_i * 50 : 0 );
			}
			?>
		</div>
	<?php endif; ?>
	<?php if ( ! empty( $c['show_cta'] ) ) : ?>
		<div class="aos mt-9 text-center"><?php bj_button( $c['cta_text'], $c['cta_url'], 'group inline-flex items-center gap-2 ' . BJ_BTN_BLUE, true ); ?></div>
	<?php endif; ?>
</div></section>
