<?php
/**
 * Why Beyond Journey.
 *
 * @package Beyond_Journey
 */

defined( 'ABSPATH' ) || exit;

$c = $args;
?>
<section id="why-us" class="relative py-14 lg:py-16 <?php echo esc_attr( $c['bg'] ); ?>"><div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
	<?php
	if ( ! empty( $c['show_heading'] ) ) {
		bj_heading( $c['eyebrow'], bj_title( $c['title'], $c['highlight'], 'text-brand-heading-soft' ), $c['lead'] );
	}
	?>
	<?php // Five centred cards in a row on desktop, two per row on tablets, one on phones. ?>
	<div class="why-grid">
		<?php
		foreach ( array_values( (array) $c['features'] ) as $bj_i => $bj_feature ) :
			$bj_feature = wp_parse_args( (array) $bj_feature, array( 'number' => '', 'icon' => 'grid', 'title' => '', 'description' => '' ) );
			?>
			<div class="aos" data-delay="<?php echo (int) $bj_i * 70; ?>"><div class="why-card">
				<span aria-hidden="true" class="why-card-dots"></span>
				<span class="why-card-icon"><?php echo bj_icon( $bj_feature['icon'] ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped -- static SVG. ?></span>
				<h3 class="why-card-title"><?php echo esc_html( $bj_feature['title'] ); ?></h3>
				<span aria-hidden="true" class="why-card-line"></span>
				<?php bj_p( $bj_feature['description'], 'why-card-text' ); ?>
			</div></div>
		<?php endforeach; ?>
	</div>
	<?php if ( ! empty( $c['show_cta'] ) ) : ?>
		<div class="aos mt-9 text-center"><?php bj_button( $c['cta_text'], $c['cta_url'], 'group inline-flex items-center gap-2 ' . BJ_BTN_BLUE, true ); ?></div>
	<?php endif; ?>
</div></section>
