<?php
/**
 * Package card (Packages page grid and "You may also like"). Args: pkg (package), delay (reveal delay in ms).
 *
 * @package Beyond_Journey
 */

defined( 'ABSPATH' ) || exit;

$bj_pkg   = $args['pkg'];
$bj_url   = isset( $bj_pkg['url'] ) ? (string) $bj_pkg['url'] : '';
$bj_badge = isset( $bj_pkg['badge'] ) ? trim( (string) $bj_pkg['badge'] ) : '';
$bj_open  = $bj_url ? '<a href="' . esc_url( $bj_url ) . '"' : '<div';
$bj_close = $bj_url ? '</a>' : '</div>';
?>
<article class="aos pkg-tile" data-country="<?php echo esc_attr( sanitize_title( isset( $bj_pkg['country'] ) ? $bj_pkg['country'] : '' ) ); ?>" data-delay="<?php echo (int) ( isset( $args['delay'] ) ? $args['delay'] : 0 ); ?>">
	<?php echo $bj_open; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped -- escaped above. ?> class="pkg-tile-img"<?php echo $bj_url ? ' tabindex="-1" aria-hidden="true"' : ''; ?>>
		<img src="<?php echo esc_url( $bj_pkg['image'] ); ?>" alt="<?php echo esc_attr( $bj_pkg['alt'] ); ?>" loading="lazy" decoding="async">
		<?php if ( '' !== $bj_badge ) : ?>
			<span class="pkg-badge pkg-badge-<?php echo esc_attr( bj_package_badge_class( $bj_badge ) ); ?>"><?php echo esc_html( $bj_badge ); ?></span>
		<?php endif; ?>
	<?php echo $bj_close; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped -- static markup. ?>
	<div class="pkg-tile-body">
		<h3 class="pkg-tile-title"><?php echo $bj_url ? '<a href="' . esc_url( $bj_url ) . '">' . esc_html( $bj_pkg['name'] ) . '</a>' : esc_html( $bj_pkg['name'] ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped -- escaped here. ?></h3>
		<?php bj_p( $bj_pkg['dates'], 'pkg-tile-loc' ); ?>
		<?php // Price, duration, stay and inclusions are shown on the package page (View details). ?>
		<div class="pkg-tile-actions">
			<?php if ( $bj_url ) : ?>
				<a class="pkg-tile-more" href="<?php echo esc_url( $bj_url ); ?>"><?php esc_html_e( 'View details', 'beyond-journey' ); ?></a>
			<?php endif; ?>
			<button type="button" class="pkg-tile-btn" data-enquire="<?php echo esc_attr( $bj_pkg['name'] ); ?>"><?php esc_html_e( 'Enquire', 'beyond-journey' ); ?><?php echo bj_svg( 'arrow-right', 'h-4 w-4', 2 ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped -- static SVG. ?></button>
		</div>
	</div>
</article>
