<?php
/**
 * Our team.
 *
 * @package Beyond_Journey
 */

defined( 'ABSPATH' ) || exit;

$c = $args;
?>
<section class="py-16 lg:py-24 <?php echo esc_attr( $c['bg'] ); ?>"><div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
	<div class="grid items-center gap-10 lg:grid-cols-2 lg:gap-14">
		<div class="aos"><div class="relative">
			<div class="aspect-[4/3] overflow-hidden rounded-2xl shadow-[0_24px_60px_-26px_rgb(23_82_125_/_0.5)]">
				<img src="<?php echo esc_url( bj_media_src( $c['image'], 900, 75, 4 / 3 ) ); ?>" alt="<?php echo esc_attr( bj_media_alt( $c['image'], $c['alt'] ) ); ?>" loading="lazy" decoding="async" class="h-full w-full object-cover"></div>
		</div></div>
		<div class="aos" data-delay="150">
			<?php bj_p( $c['eyebrow'], BJ_EYEBROW ); ?>
			<h2 class="<?php echo esc_attr( BJ_H2 ); ?>"><?php echo bj_title( $c['title'], $c['highlight'], 'text-brand-heading-soft', true ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped -- escaped in bj_title(). ?></h2>
			<span class="section-accent"></span>
			<?php
			bj_p( $c['text1'], 'mt-5 leading-relaxed text-brand-gray' );
			bj_p( $c['text2'], 'mt-4 leading-relaxed text-brand-gray' );
			bj_p( $c['tagline'], 'mt-5 text-sm italic text-brand-gray-light' );
			?>
		</div>
	</div>
</div></section>
