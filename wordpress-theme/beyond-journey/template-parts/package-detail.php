<?php
/**
 * One package's page: photo banner, overview, day-by-day plan, what's included, hotels, a price box with the
 * enquiry buttons, and other packages. Args: pkg (package).
 *
 * @package Beyond_Journey
 */

defined( 'ABSPATH' ) || exit;

$p         = $args['pkg'];
$bj_badge  = trim( (string) $p['badge'] );
$bj_days   = bj_package_itinerary( $p );
$bj_inc    = bj_package_includes( $p );
$bj_exc    = bj_lines( $p['excludes'] );
$bj_hotels = bj_lines( $p['hotels'] );
$bj_price  = bj_package_price( $p['price'] );
/* translators: %s: package name. */
$bj_wa     = bj_whatsapp_url() . '?text=' . rawurlencode( sprintf( __( 'Hi Beyond Journey, I am interested in the %s package.', 'beyond-journey' ), $p['name'] ) );
$bj_others = array_slice(
	array_values(
		array_filter(
			bj_packages(),
			static function ( $other ) use ( $p ) {
				return (int) $other['id'] !== (int) $p['id'];
			}
		)
	),
	0,
	4
);
$bj_rows   = array(
	array( 'clock', __( 'Duration', 'beyond-journey' ), $p['duration'] ),
	array( 'hotel', __( 'Stay', 'beyond-journey' ), $p['hotel'] ),
	array( 'check', __( 'Included', 'beyond-journey' ), $p['inclusions'] ),
	array( 'plane', __( 'Travel dates', 'beyond-journey' ), $p['dates'] ),
);
?>
<section class="pkgd-hero">
	<img src="<?php echo esc_url( $p['full'] ); ?>" alt="<?php echo esc_attr( $p['alt'] ); ?>" fetchpriority="high" decoding="async" class="pkgd-hero-img">
	<div class="pkgd-hero-shade" aria-hidden="true"></div>
	<div class="pkgd-hero-inner mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
		<nav class="pkgd-crumbs" aria-label="<?php esc_attr_e( 'Breadcrumb', 'beyond-journey' ); ?>">
			<a href="<?php echo esc_url( bj_url( 'packages' ) ); ?>"><?php esc_html_e( 'Packages', 'beyond-journey' ); ?></a>
			<?php if ( '' !== trim( $p['country'] ) ) : ?>
				<span aria-hidden="true">/</span><span><?php echo esc_html( $p['country'] ); ?></span>
			<?php endif; ?>
		</nav>
		<?php if ( '' !== $bj_badge ) : ?>
			<span class="pkg-badge pkg-badge-<?php echo esc_attr( bj_package_badge_class( $bj_badge ) ); ?>"><?php echo esc_html( $bj_badge ); ?></span>
		<?php endif; ?>
		<h1 class="pkgd-title"><?php echo esc_html( $p['name'] ); ?></h1>
		<ul class="pkg-show-facts">
			<?php if ( '' !== trim( $p['duration'] ) ) : ?>
				<li><?php echo bj_svg( 'clock', 'h-4 w-4', 1.8 ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped -- static SVG. ?><?php echo esc_html( $p['duration'] ); ?></li>
			<?php endif; ?>
			<?php if ( '' !== trim( $p['hotel'] ) ) : ?>
				<li><?php echo bj_svg( 'hotel', 'h-4 w-4', 1.8 ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped -- static SVG. ?><?php echo esc_html( $p['hotel'] ); ?></li>
			<?php endif; ?>
			<?php if ( '' !== trim( $p['dates'] ) ) : ?>
				<li><?php echo bj_svg( 'plane', 'h-4 w-4', 1.8 ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped -- static SVG. ?><?php echo esc_html( $p['dates'] ); ?></li>
			<?php endif; ?>
		</ul>
	</div>
</section>

<section class="pkgd-body bg-white">
	<div class="pkgd-grid mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
		<div class="pkgd-main">
			<?php $bj_about = '' !== trim( $p['about'] ) ? $p['about'] : $p['summary']; ?>
			<?php if ( '' !== trim( $bj_about ) ) : ?>
				<div class="aos pkgd-block">
					<h2 class="pkgd-h"><?php esc_html_e( 'Overview', 'beyond-journey' ); ?></h2>
					<p class="pkgd-lead"><?php echo esc_html( $bj_about ); ?></p>
				</div>
			<?php endif; ?>

			<div class="aos pkgd-block">
				<h2 class="pkgd-h"><?php esc_html_e( 'Day-by-Day Plan', 'beyond-journey' ); ?></h2>
				<?php if ( $bj_days ) : ?>
					<ol class="pkgd-days">
						<?php foreach ( $bj_days as $bj_i => $bj_day ) : ?>
							<li>
								<details<?php echo 0 === $bj_i ? ' open' : ''; ?>>
									<summary><span class="pkgd-day"><?php echo esc_html( $bj_day['day'] ); ?></span><span class="pkgd-day-title"><?php echo esc_html( $bj_day['title'] ); ?></span><?php echo bj_svg( 'chevron-down', 'pkgd-caret h-4 w-4', 2 ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped -- static SVG. ?></summary>
									<?php bj_p( $bj_day['text'], 'pkgd-day-text' ); ?>
								</details>
							</li>
						<?php endforeach; ?>
					</ol>
				<?php else : ?>
					<div class="pkgd-empty">
						<span class="pkgd-empty-icon"><?php echo bj_svg( 'mail', 'h-5 w-5', 1.8 ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped -- static SVG. ?></span>
						<div>
							<p class="pkgd-empty-title"><?php esc_html_e( 'Get the full day-by-day plan', 'beyond-journey' ); ?></p>
							<p class="pkgd-empty-text"><?php esc_html_e( 'Tell us your travel dates and who is travelling, and we will send the complete itinerary with your quote.', 'beyond-journey' ); ?></p>
							<button type="button" class="pkgd-link-btn" data-enquire="<?php echo esc_attr( $p['name'] ); ?>"><?php esc_html_e( 'Request the itinerary', 'beyond-journey' ); ?><?php echo bj_svg( 'arrow-right', 'h-4 w-4', 2 ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped -- static SVG. ?></button>
						</div>
					</div>
				<?php endif; ?>
			</div>

			<?php if ( $bj_inc || $bj_exc ) : ?>
				<div class="aos pkgd-block pkgd-lists<?php echo $bj_exc ? '' : ' pkgd-lists-one'; ?>">
					<?php if ( $bj_inc ) : ?>
						<div>
							<h2 class="pkgd-h"><?php esc_html_e( "What's Included", 'beyond-journey' ); ?></h2>
							<ul class="pkgd-inc">
								<?php foreach ( $bj_inc as $bj_line ) : ?>
									<li><?php echo bj_svg( 'check', 'h-4 w-4', 2.2 ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped -- static SVG. ?><?php echo esc_html( $bj_line ); ?></li>
								<?php endforeach; ?>
							</ul>
						</div>
					<?php endif; ?>
					<?php if ( $bj_exc ) : ?>
						<div>
							<h2 class="pkgd-h"><?php esc_html_e( 'Not Included', 'beyond-journey' ); ?></h2>
							<ul class="pkgd-exc">
								<?php foreach ( $bj_exc as $bj_line ) : ?>
									<li><?php echo bj_svg( 'close', 'h-4 w-4', 2.2 ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped -- static SVG. ?><?php echo esc_html( $bj_line ); ?></li>
								<?php endforeach; ?>
							</ul>
						</div>
					<?php endif; ?>
				</div>
			<?php endif; ?>

			<?php if ( $bj_hotels ) : ?>
				<div class="aos pkgd-block">
					<h2 class="pkgd-h"><?php esc_html_e( 'Hotels', 'beyond-journey' ); ?></h2>
					<ul class="pkgd-hotels">
						<?php foreach ( $bj_hotels as $bj_line ) : ?>
							<li><span class="pkgd-hotel-icon"><?php echo bj_svg( 'hotel', 'h-5 w-5', 1.6 ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped -- static SVG. ?></span><?php echo esc_html( $bj_line ); ?></li>
						<?php endforeach; ?>
					</ul>
				</div>
			<?php endif; ?>
		</div>

		<aside class="pkgd-side">
			<div class="pkgd-card">
				<?php if ( '' !== $bj_price ) : ?>
					<p class="pkgd-card-label"><?php esc_html_e( 'Starting from', 'beyond-journey' ); ?></p>
					<p class="pkgd-price">AED <?php echo esc_html( $bj_price ); ?>*<?php if ( '' !== trim( $p['price_note'] ) ) : ?> <span><?php echo esc_html( $p['price_note'] ); ?></span><?php endif; ?></p>
				<?php endif; ?>
				<dl class="pkgd-rows">
					<?php foreach ( $bj_rows as $bj_row ) : ?>
						<?php if ( '' !== trim( (string) $bj_row[2] ) ) : ?>
							<div><dt><?php echo bj_svg( $bj_row[0], 'h-4 w-4', 1.8 ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped -- static SVG. ?><?php echo esc_html( $bj_row[1] ); ?></dt><dd><?php echo esc_html( $bj_row[2] ); ?></dd></div>
						<?php endif; ?>
					<?php endforeach; ?>
				</dl>
				<button type="button" class="pkgd-btn" data-enquire="<?php echo esc_attr( $p['name'] ); ?>"><?php esc_html_e( 'Enquire Now', 'beyond-journey' ); ?><?php echo bj_svg( 'arrow-right', 'h-4 w-4', 2 ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped -- static SVG. ?></button>
				<a class="pkgd-wa" href="<?php echo esc_url( $bj_wa ); ?>" target="_blank" rel="noopener noreferrer"><?php echo bj_whatsapp_svg( 'h-4 w-4' ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped -- static SVG. ?><?php esc_html_e( 'Ask on WhatsApp', 'beyond-journey' ); ?></a>
				<p class="pkgd-fine"><?php esc_html_e( '*Starting price, subject to availability and travel dates. Flights and visas can be added on request.', 'beyond-journey' ); ?></p>
			</div>
		</aside>
	</div>
</section>

<?php if ( $bj_others ) : ?>
<section class="bg-brand-surface py-14 lg:py-16"><div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
	<?php bj_heading( __( 'More Holidays', 'beyond-journey' ), bj_title( __( 'You May Also', 'beyond-journey' ), __( 'Like', 'beyond-journey' ) ), '', 'mb-9' ); ?>
	<div class="pkg-grid">
		<?php foreach ( $bj_others as $bj_i => $bj_other ) : ?>
			<?php get_template_part( 'template-parts/package-tile', null, array( 'pkg' => $bj_other, 'delay' => $bj_i * 60 ) ); ?>
		<?php endforeach; ?>
	</div>
	<div class="aos mt-9 text-center"><?php bj_button( __( 'View All Packages', 'beyond-journey' ), bj_url( 'packages' ), 'group inline-flex items-center gap-2 ' . BJ_BTN_BLUE, true ); ?></div>
	<?php bj_package_credits( array_merge( array( $p ), $bj_others ) ); ?>
</div></section>
<?php endif; ?>
