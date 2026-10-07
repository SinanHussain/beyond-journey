<?php
/**
 * Homepage packages: photo cards with the name and price over the photo and a glass "Enquire" bar.
 * The packages come from Dashboard > Packages (the ones ticked for the homepage).
 *
 * @package Beyond_Journey
 */

defined( 'ABSPATH' ) || exit;

$c            = $args;
$bj_packages  = bj_packages( true, max( 1, (int) $c['limit'] ) );
$bj_enquire_t = '' !== trim( (string) $c['enquire_text'] ) ? $c['enquire_text'] : __( 'Enquire now', 'beyond-journey' );
if ( ! $bj_packages ) {
	return;
}
?>
<section id="packages" class="pkg-sec relative overflow-hidden bg-white py-14 lg:py-16">
	<div class="relative z-10 mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
		<?php bj_heading( $c['eyebrow'], bj_title( $c['title'], $c['highlight'] ), $c['lead'], 'mb-9' ); ?>
		<div class="pkg-row">
			<?php foreach ( $bj_packages as $bj_i => $bj_pkg ) : ?>
				<article class="aos pkg-card" data-motion="pkg" data-delay="<?php echo (int) $bj_i * 80; ?>">
					<img src="<?php echo esc_url( $bj_pkg['image'] ); ?>" alt="<?php echo esc_attr( $bj_pkg['alt'] ); ?>" loading="lazy" decoding="async" class="pkg-card-img">
					<div class="pkg-card-shade" aria-hidden="true"></div>
					<?php if ( ! empty( $bj_pkg['url'] ) ) : ?>
						<a class="pkg-card-link" href="<?php echo esc_url( $bj_pkg['url'] ); ?>" aria-label="<?php echo esc_attr( sprintf( /* translators: %s: package name. */ __( 'View the %s package', 'beyond-journey' ), $bj_pkg['name'] ) ); ?>"></a>
					<?php endif; ?>
					<?php if ( '' !== trim( (string) $bj_pkg['badge'] ) ) : ?>
						<span class="pkg-badge pkg-badge-<?php echo esc_attr( bj_package_badge_class( $bj_pkg['badge'] ) ); ?>"><?php echo esc_html( $bj_pkg['badge'] ); ?></span>
					<?php endif; ?>
					<?php if ( '' !== trim( $bj_pkg['duration'] ) ) : ?>
						<span class="pkg-chip"><?php echo bj_svg( 'clock', 'h-3.5 w-3.5', 2 ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped -- static SVG. ?><?php echo esc_html( $bj_pkg['duration'] ); ?></span>
					<?php endif; ?>
					<div class="pkg-card-body">
						<h3 class="pkg-card-title"><?php echo esc_html( $bj_pkg['name'] ); ?></h3>
						<p class="pkg-card-meta">
							<?php if ( '' !== trim( $bj_pkg['hotel'] ) ) : ?>
								<span class="pkg-pill"><?php echo bj_svg( 'hotel', 'h-3.5 w-3.5', 1.8 ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped -- static SVG. ?><?php echo esc_html( preg_replace( '/\s*Accommodation$/i', '', $bj_pkg['hotel'] ) ); ?></span>
							<?php endif; ?>
							<span class="pkg-card-price"><?php echo bj_package_price_html( $bj_pkg ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped -- escaped in bj_package_price_html(). ?></span>
						</p>
						<button type="button" class="pkg-glass" data-enquire="<?php echo esc_attr( $bj_pkg['name'] ); ?>">
							<span><?php echo esc_html( $bj_enquire_t ); ?></span>
							<span class="pkg-glass-go" aria-hidden="true"><?php echo bj_svg( 'arrow-right', 'h-4 w-4', 2 ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped -- static SVG. ?></span>
						</button>
					</div>
				</article>
			<?php endforeach; ?>
		</div>
		<div class="aos pkg-foot">
			<?php bj_button( $c['button_text'], $c['button_url'], 'group inline-flex items-center gap-2 ' . BJ_BTN_BLUE, true ); ?>
			<?php bj_p( $c['note'], 'pkg-note' ); ?>
			<?php if ( array_filter( wp_list_pluck( $bj_packages, 'credit' ) ) ) : ?>
				<a class="pkg-credit-link" href="<?php echo esc_url( bj_url( 'packages' ) . '#photo-credits' ); ?>"><?php esc_html_e( 'Photo credits', 'beyond-journey' ); ?></a>
			<?php endif; ?>
		</div>
	</div>
</section>
