<?php
/**
 * Our commitment: one centred statement.
 *
 * @package Beyond_Journey
 */

defined( 'ABSPATH' ) || exit;

$c = $args;

// Dashed flight route with a plane flying along it, drawn behind the text.
// assets/js/theme.js rescales the path to the section's real size.
$bj_path = 'M -20 360 C 20 300 120 280 260 268 S 440 240 560 175 S 760 70 900 52 S 1100 30 1150 10 S 1240 5 1270 14';
?>
<section class="relative overflow-hidden py-14 lg:py-16 <?php echo esc_attr( $c['bg'] ); ?>">
	<svg class="flight-bg" viewBox="0 0 1200 330" preserveAspectRatio="none" aria-hidden="true" focusable="false">
		<path class="flight-route route-dash" d="<?php echo esc_attr( $bj_path ); ?>" fill="none" stroke="#1B7FBF" stroke-opacity=".28" stroke-width="2" stroke-linecap="round" stroke-dasharray="2 10"/>
		<g class="route-plane"><g transform="translate(-12 -12)">
			<path d="M21 12c0-.8-.7-1.3-1.5-1.3H14L9.5 3H7.8l2.3 7.7H5.4L3.8 8.5H2.5l1 3.5-1 3.5h1.3l1.6-2.2h4.7L7.8 21h1.7l4.5-7.7h5.5c.8 0 1.5-.5 1.5-1.3z" fill="#1B7FBF"/>
		</g><animateMotion dur="16s" repeatCount="indefinite" rotate="auto" path="<?php echo esc_attr( $bj_path ); ?>"/></g>
	</svg>
	<div class="relative mx-auto max-w-4xl px-4 text-center sm:px-6 lg:px-8"><div class="aos">
	<?php bj_p( $c['eyebrow'], BJ_EYEBROW ); ?>
	<h2 class="text-[1.75rem] font-bold leading-[1.15] text-brand-heading sm:text-3xl lg:text-[2.25rem]"><?php echo bj_title( $c['title'], $c['highlight'] ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped -- escaped in bj_title(). ?></h2>
	<span class="section-accent-center"></span>
	<?php bj_p( $c['text'], 'mx-auto mt-5 max-w-3xl leading-relaxed text-brand-gray' ); ?>
</div></div></section>
