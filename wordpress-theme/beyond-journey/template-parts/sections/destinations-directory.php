<?php
/**
 * Destinations page: all destinations, then the destinations grouped by region.
 *
 * @package Beyond_Journey
 */

defined( 'ABSPATH' ) || exit;

$c        = $args;
$bj_dests = array();
foreach ( (array) $c['destinations'] as $bj_dest ) {
	$bj_dests[] = wp_parse_args( (array) $bj_dest, array( 'name' => '', 'region' => '', 'description' => '', 'image' => '', 'alt' => '' ) );
}

// Regions in the chosen order first, then any other region in the order it appears.
$bj_regions = array_fill_keys( bj_lines( $c['region_order'] ), array() );
foreach ( $bj_dests as $bj_dest ) {
	$bj_region = trim( $bj_dest['region'] );
	if ( '' !== $bj_region && '' !== trim( $bj_dest['name'] ) ) {
		$bj_regions[ $bj_region ][] = $bj_dest['name'];
	}
}
$bj_regions = array_filter( $bj_regions );
?>
<section class="bg-white py-14 lg:py-16"><div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
	<?php bj_heading( str_replace( '{count}', (string) count( $bj_dests ), $c['eyebrow'] ), bj_title( $c['title'], $c['highlight'] ), $c['lead'] ); ?>
	<div class="dest-grid">
		<?php foreach ( $bj_dests as $bj_i => $bj_dest ) : ?>
			<div class="aos bloom-card" data-delay="<?php echo $bj_i < 8 ? (int) $bj_i * 60 : 0; ?>">
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
</div></section>

<?php if ( $bj_regions ) : ?>
<section class="relative overflow-hidden bg-brand-blue-pale py-14 lg:py-16">
	<div class="pointer-events-none absolute inset-x-0 top-0 h-16 bg-gradient-to-b from-white to-transparent"></div>
	<div class="relative z-10 mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
		<?php bj_heading( $c['regions_eyebrow'], bj_title( $c['regions_title'], $c['regions_highlight'] ), '', 'mb-9' ); ?>
		<?php $bj_colors = bj_lines( $c['region_colors'] ); ?>
		<div class="region-grid">
			<?php $bj_i = 0; ?>
			<?php foreach ( $bj_regions as $bj_region => $bj_names ) : ?>
				<div class="aos" data-delay="<?php echo (int) $bj_i * 70; ?>"><div class="region-card" style="--rc:<?php echo esc_attr( bj_color( $bj_colors ? $bj_colors[ $bj_i % count( $bj_colors ) ] : '' ) ); ?>">
					<span class="region-icon"><?php echo bj_svg( 'pin', '', 1.8 ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped -- static SVG. ?></span>
					<h3 class="region-title"><?php echo esc_html( $bj_region ); ?></h3>
					<ul class="region-list">
						<?php foreach ( $bj_names as $bj_name ) : ?>
							<li><?php echo esc_html( $bj_name ); ?></li>
						<?php endforeach; ?>
					</ul>
				</div></div>
				<?php ++$bj_i; ?>
			<?php endforeach; ?>
		</div>
		<div class="aos mx-auto mt-9 max-w-2xl text-center">
			<?php
			bj_p( $c['note'], 'text-sm leading-relaxed text-brand-gray' );
			bj_button( $c['button_text'], $c['button_url'], 'group mt-5 inline-flex items-center gap-2 ' . BJ_BTN_BLUE, true );
			?>
		</div>
	</div>
</section>
<?php endif; ?>
