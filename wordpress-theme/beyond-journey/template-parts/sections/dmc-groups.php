<?php
/**
 * DMC page: what we handle, as pastel icon tiles.
 *
 * @package Beyond_Journey
 */

defined( 'ABSPATH' ) || exit;

$c = $args;
?>
<section class="bg-white py-14 lg:py-16"><div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
	<?php bj_heading( $c['eyebrow'], bj_title( $c['title'], $c['highlight'] ), $c['lead'] ); ?>
	<div class="handle-grid">
		<?php
		foreach ( array_values( (array) $c['groups'] ) as $bj_i => $bj_group ) :
			$bj_group = wp_parse_args( (array) $bj_group, array( 'title' => '', 'icon' => 'pin', 'tint' => '#E3ECF4', 'ink' => '#1B7FBF', 'items' => '' ) );
			$bj_items = bj_lines( $bj_group['items'] );
			?>
			<div class="aos" data-delay="<?php echo (int) $bj_i * 80; ?>"><div class="handle-card" style="--tint:<?php echo esc_attr( bj_color( $bj_group['tint'] ) ); ?>;--ink:<?php echo esc_attr( bj_color( $bj_group['ink'] ) ); ?>">
				<div class="handle-tile"><?php echo bj_svg( $bj_group['icon'], '', 1.4 ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped -- static SVG. ?></div>
				<h3 class="handle-title"><?php echo esc_html( $bj_group['title'] ); ?></h3>
				<p class="handle-count">
					<?php
					/* translators: %d: number of services. */
					echo esc_html( sprintf( _n( '%d service', '%d services', count( $bj_items ), 'beyond-journey' ), count( $bj_items ) ) );
					?>
				</p>
				<ul class="handle-list">
					<?php foreach ( $bj_items as $bj_item ) : ?>
						<li><?php echo esc_html( $bj_item ); ?></li>
					<?php endforeach; ?>
				</ul>
			</div></div>
		<?php endforeach; ?>
	</div>
</div></section>
