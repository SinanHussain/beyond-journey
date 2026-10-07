<?php
/**
 * Premium hotel stays: a card carousel of hotels beside a text panel.
 *
 * @package Beyond_Journey
 */

defined( 'ABSPATH' ) || exit;

$c = $args;

// Feature icon, picked from the feature wording (beach, spa, butler, water/lake/sea, heritage/palace).
$bj_feature_icon = static function ( $label ) {
	$paths = array(
		'beach'    => 'M12 3v2.25m6.364.386l-1.591 1.591M21 12h-2.25m-.386 6.364l-1.591-1.591M12 18.75V21m-4.773-4.227l-1.591 1.591M5.25 12H3m4.227-4.773L5.636 5.636M15.75 12a3.75 3.75 0 11-7.5 0 3.75 3.75 0 017.5 0z',
		'spa'      => 'M9.813 15.904L9 18.75l-.813-2.846a4.5 4.5 0 00-3.09-3.09L2.25 12l2.846-.813a4.5 4.5 0 003.09-3.09L9 5.25l.813 2.846a4.5 4.5 0 003.09 3.09L15.75 12l-2.846.813a4.5 4.5 0 00-3.09 3.09z',
		'butler'   => 'M15.75 5.25a3 3 0 013 3m3 0a6 6 0 01-7.029 5.912c-.563-.097-1.159.026-1.563.43L10.5 17.25H8.25v2.25H6v2.25H2.25v-2.818c0-.597.237-1.17.659-1.591l6.499-6.499c.404-.404.527-1 .43-1.563A6 6 0 1121.75 8.25z',
		'water'    => 'M2.25 13.5c1.5 1.2 3 1.2 4.5 0s3-1.2 4.5 0 3 1.2 4.5 0 3-1.2 4.5 0M2.25 18c1.5 1.2 3 1.2 4.5 0s3-1.2 4.5 0 3 1.2 4.5 0 3-1.2 4.5 0M9 9.75a3 3 0 116 0',
		'heritage' => 'M12 21v-8.25M15.75 21v-8.25M8.25 21v-8.25M3 9l9-6 9 6m-1.5 12V10.332A48.36 48.36 0 0012 9.75c-2.551 0-5.056.2-7.5.582V21M3 21h18M12 6.75h.008v.008H12V6.75z',
	);
	$l   = strtolower( $label );
	$key = 'spa';
	if ( preg_match( '/beach|sun/', $l ) ) {
		$key = 'beach';
	} elseif ( preg_match( '/butler|concierge|service/', $l ) ) {
		$key = 'butler';
	} elseif ( preg_match( '/water|lake|sea|pool|ocean|river/', $l ) ) {
		$key = 'water';
	} elseif ( preg_match( '/heritage|palace|histor|suite/', $l ) ) {
		$key = 'heritage';
	}
	return '<svg fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.6" aria-hidden="true"><path stroke-linecap="round" stroke-linejoin="round" d="' . $paths[ $key ] . '"/></svg>';
};
$bj_star = '<svg viewBox="0 0 20 20" fill="currentColor" aria-hidden="true"><path d="M10 1.5l2.6 5.3 5.9.9-4.3 4.1 1 5.8L10 14.8l-5.2 2.8 1-5.8L1.5 7.7l5.9-.9L10 1.5z"/></svg>';
?>
<section id="hotels" class="bg-white py-14 lg:py-16"><div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
	<div class="hotels-panel aos">
		<div class="hotels-intro">
			<?php bj_p( $c['eyebrow'], BJ_EYEBROW ); ?>
			<h2 class="<?php echo esc_attr( BJ_H2 ); ?>"><?php echo bj_title( $c['title'], $c['highlight'] ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped -- escaped in bj_title(). ?></h2>
			<span class="section-accent"></span>
			<?php bj_p( $c['text'], 'mt-5 leading-relaxed text-brand-gray' ); ?>
			<div class="hotels-actions">
				<?php bj_button( $c['button_text'], $c['button_url'], 'group inline-flex items-center justify-center gap-2 ' . BJ_BTN_BLUE, true ); ?>
				<div class="hotels-arrows">
					<button type="button" data-hotels="prev" aria-label="<?php esc_attr_e( 'Previous hotel', 'beyond-journey' ); ?>"><?php echo bj_svg( 'caret-left', '', 2 ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped -- static SVG. ?></button>
					<button type="button" data-hotels="next" aria-label="<?php esc_attr_e( 'Next hotel', 'beyond-journey' ); ?>"><?php echo bj_svg( 'caret-right', '', 2 ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped -- static SVG. ?></button>
				</div>
			</div>
		</div>
		<div class="hotels-track scrollbar-hide" role="region" aria-label="<?php esc_attr_e( 'Premium hotels', 'beyond-journey' ); ?>" tabindex="0">
			<?php
			foreach ( (array) $c['hotels'] as $bj_hotel ) :
				$bj_hotel = wp_parse_args( (array) $bj_hotel, array( 'name' => '', 'location' => '', 'image' => '', 'alt' => '', 'features' => '' ) );
				?>
				<a<?php echo bj_link_attrs( $c['card_url'] ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped -- escaped in bj_link_attrs(). ?> class="hotel-card" aria-label="<?php echo esc_attr( sprintf( /* translators: %s: hotel name. */ __( 'Enquire about %s', 'beyond-journey' ), $bj_hotel['name'] ) ); ?>">
					<div class="hotel-card-img"><img src="<?php echo esc_url( bj_media_src( $bj_hotel['image'], 640, 78, 1.3 ) ); ?>" alt="<?php echo esc_attr( bj_media_alt( $bj_hotel['image'], $bj_hotel['alt'] ) ); ?>" loading="lazy" decoding="async"></div>
					<div class="hotel-card-body">
						<div class="hotel-card-meta">
							<span class="hotel-card-loc"><?php echo bj_svg( 'pin', '', 1.8 ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped -- static SVG. ?><?php echo esc_html( $bj_hotel['location'] ); ?></span>
							<span class="hotel-card-stars" role="img" aria-label="<?php esc_attr_e( '5-star hotel', 'beyond-journey' ); ?>"><?php echo str_repeat( $bj_star, 5 ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped -- static SVG. ?></span>
						</div>
						<h3 class="hotel-card-name"><?php echo esc_html( $bj_hotel['name'] ); ?></h3>
						<ul class="hotel-card-features">
							<?php foreach ( bj_lines( $bj_hotel['features'] ) as $bj_feature ) : ?>
								<li><?php echo $bj_feature_icon( $bj_feature ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped -- static SVG. ?><?php echo esc_html( $bj_feature ); ?></li>
							<?php endforeach; ?>
						</ul>
					</div>
				</a>
			<?php endforeach; ?>
		</div>
	</div>
</div></section>
