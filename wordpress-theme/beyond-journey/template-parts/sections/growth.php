<?php
/**
 * Looking ahead.
 *
 * @package Beyond_Journey
 */

defined( 'ABSPATH' ) || exit;

$c = $args;
?>
<section class="py-14 lg:py-16 <?php echo esc_attr( $c['bg'] ); ?>"><div class="mx-auto max-w-3xl px-4 sm:px-6 lg:px-8">
	<?php bj_heading( $c['eyebrow'], bj_title( $c['title'], $c['highlight'] ), '', 'mb-6' ); ?>
	<div class="aos text-center">
		<?php
		bj_p( $c['text1'], 'leading-relaxed text-brand-gray' );
		bj_p( $c['text2'], 'mt-4 leading-relaxed text-brand-gray' );
		?>
	</div>
</div></section>
