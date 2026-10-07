<?php
/**
 * Packages page: a large showcase (the selected package fills the background, the others wait as cards on the right),
 * then every package as a card. The packages come from Dashboard > Packages.
 *
 * @package Beyond_Journey
 */

defined( 'ABSPATH' ) || exit;

$c           = $args;
// While the page is open in Elementor the widget's own list is shown, so the preview follows the edits.
$bj_packages = bj_is_elementor_preview() && ! empty( $c['packages'] ) && is_array( $c['packages'] ) ? bj_packages_from_rows( $c['packages'] ) : bj_packages();
if ( ! $bj_packages ) {
	return;
}
$bj_first = $bj_packages[0];
$bj_total = count( $bj_packages );
$bj_pad   = static function ( $n ) {
	return str_pad( (string) $n, 2, '0', STR_PAD_LEFT );
};
?>
<section class="pkg-show" data-pkg-show data-motion="pkgshow" aria-roledescription="carousel" aria-label="<?php esc_attr_e( 'Holiday packages', 'beyond-journey' ); ?>">
	<div class="pkg-show-bg" aria-hidden="true">
		<?php foreach ( $bj_packages as $bj_i => $bj_pkg ) : ?>
			<img src="<?php echo esc_url( $bj_pkg['full'] ); ?>" alt="" <?php echo $bj_i ? 'loading="lazy" ' : 'fetchpriority="high" '; ?>decoding="async" class="pkg-show-layer<?php echo $bj_i ? '' : ' is-on'; ?>">
		<?php endforeach; ?>
	</div>
	<div class="pkg-show-shade" aria-hidden="true"></div>
	<div class="pkg-show-inner mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
		<div class="pkg-show-text" aria-live="polite">
			<p class="pkg-show-script"><?php esc_html_e( 'Holiday Packages', 'beyond-journey' ); ?></p>
			<h1 class="pkg-show-title" data-f="name"><?php echo esc_html( $bj_first['name'] ); ?></h1>
			<div class="pkg-show-cta">
				<button type="button" class="pkg-show-btn" data-enquire="<?php echo esc_attr( $bj_first['name'] ); ?>">
					<?php esc_html_e( 'Enquire Now', 'beyond-journey' ); ?><?php echo bj_svg( 'arrow-right', 'h-4 w-4', 2 ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped -- static SVG. ?></button>
				<a class="pkg-show-view" href="<?php echo esc_url( $bj_first['url'] ? $bj_first['url'] : '#' ); ?>"<?php echo $bj_first['url'] ? '' : ' hidden'; ?>><?php esc_html_e( 'View Package', 'beyond-journey' ); ?></a>
			</div>
		</div>
		<div class="pkg-show-side">
			<div class="pkg-show-track scrollbar-hide" role="group" aria-label="<?php esc_attr_e( 'Choose a package', 'beyond-journey' ); ?>">
				<?php foreach ( $bj_packages as $bj_i => $bj_pkg ) : ?>
					<button type="button" class="pkg-thumb" aria-pressed="<?php echo $bj_i ? 'false' : 'true'; ?>"
						data-name="<?php echo esc_attr( $bj_pkg['name'] ); ?>"
						data-summary="<?php echo esc_attr( $bj_pkg['summary'] ); ?>"
						data-duration="<?php echo esc_attr( $bj_pkg['duration'] ); ?>"
						data-hotel="<?php echo esc_attr( $bj_pkg['hotel'] ); ?>"
						data-inclusions="<?php echo esc_attr( $bj_pkg['inclusions'] ); ?>"
						data-url="<?php echo esc_url( $bj_pkg['url'] ); ?>"
						data-price="<?php echo esc_attr( bj_package_price_html( $bj_pkg ) ); ?>">
						<span class="pkg-thumb-img"><img src="<?php echo esc_url( $bj_pkg['image'] ); ?>" alt="<?php echo esc_attr( $bj_pkg['alt'] ); ?>" loading="lazy" decoding="async"></span>
						<span class="pkg-thumb-cap"><span class="pkg-thumb-name"><?php echo esc_html( $bj_pkg['name'] ); ?></span></span>
					</button>
				<?php endforeach; ?>
			</div>
			<div class="pkg-show-nav">
				<button type="button" class="pkg-nav-btn" data-pkg="prev" aria-label="<?php esc_attr_e( 'Previous package', 'beyond-journey' ); ?>"><?php echo bj_svg( 'caret-left', 'h-4 w-4', 2 ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped -- static SVG. ?></button>
				<button type="button" class="pkg-nav-btn" data-pkg="next" aria-label="<?php esc_attr_e( 'Next package', 'beyond-journey' ); ?>"><?php echo bj_svg( 'caret-right', 'h-4 w-4', 2 ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped -- static SVG. ?></button>
				<span class="pkg-nav-line" aria-hidden="true"><span class="pkg-nav-fill" style="width:<?php echo esc_attr( round( 100 / $bj_total, 2 ) ); ?>%"></span></span>
				<span class="pkg-nav-count"><span data-f="index">01</span><span class="pkg-nav-total"> / <?php echo esc_html( $bj_pad( $bj_total ) ); ?></span></span>
			</div>
		</div>
	</div>
</section>

<section class="bg-white py-14 lg:py-16"><div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
	<?php bj_heading( $c['grid_eyebrow'], bj_title( $c['grid_title'], $c['grid_highlight'] ), $c['grid_lead'] ); ?>
	<?php
	// Country filter: one tab per country that has a package.
	$bj_countries = array();
	foreach ( $bj_packages as $bj_pkg ) {
		$bj_country = trim( (string) $bj_pkg['country'] );
		if ( '' !== $bj_country ) {
			$bj_countries[ sanitize_title( $bj_country ) ] = $bj_country;
		}
	}
	?>
	<?php if ( count( $bj_countries ) > 1 ) : ?>
		<div class="aos pkg-filter" role="group" aria-label="<?php esc_attr_e( 'Filter packages by country', 'beyond-journey' ); ?>" data-pkg-filter>
			<button type="button" class="pkg-filter-btn" data-filter="all" aria-pressed="true"><?php esc_html_e( 'All', 'beyond-journey' ); ?></button>
			<?php foreach ( $bj_countries as $bj_slug => $bj_country ) : ?>
				<button type="button" class="pkg-filter-btn" data-filter="<?php echo esc_attr( $bj_slug ); ?>" aria-pressed="false"><?php echo esc_html( $bj_country ); ?></button>
			<?php endforeach; ?>
		</div>
	<?php endif; ?>
	<div class="pkg-grid" data-pkg-grid>
		<?php foreach ( $bj_packages as $bj_i => $bj_pkg ) : ?>
			<?php get_template_part( 'template-parts/package-tile', null, array( 'pkg' => $bj_pkg, 'delay' => $bj_i < 8 ? $bj_i * 60 : 0 ) ); ?>
		<?php endforeach; ?>
	</div>
	<div class="aos mx-auto mt-9 max-w-3xl text-center">
		<?php bj_p( $c['note'], 'pkg-note' ); ?>
		<?php bj_package_credits( $bj_packages ); ?>
	</div>
</div></section>
