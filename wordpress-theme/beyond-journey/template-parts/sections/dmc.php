<?php
/**
 * DMC & ground handling.
 *
 * @package Beyond_Journey
 */

defined( 'ABSPATH' ) || exit;

$c        = $args;
$bj_items = bj_lines( $c['items'] );
?>
<section id="dmc" class="relative overflow-hidden bg-gradient-to-br from-brand-blue-pale via-brand-blue-mist to-white py-14 lg:py-16">
	<div class="pointer-events-none absolute -right-24 -top-24 h-72 w-72 rounded-full bg-brand-blue/5"></div>
	<div class="pointer-events-none absolute -bottom-20 -left-20 h-52 w-52 rounded-full bg-brand-orange/5"></div>
	<div class="relative z-10 mx-auto max-w-7xl px-4 sm:px-6 lg:px-8"><div class="grid items-center gap-10 lg:grid-cols-2 lg:gap-14">
		<div class="aos">
			<?php bj_p( $c['eyebrow'], BJ_EYEBROW ); ?>
			<h2 class="<?php echo esc_attr( BJ_H2 ); ?>"><?php echo bj_title( $c['title'], $c['highlight'], 'text-brand-heading-soft', true ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped -- escaped in bj_title(). ?></h2>
			<span class="section-accent"></span>
			<?php
			bj_p( $c['text1'], 'mt-5 leading-relaxed text-brand-gray' );
			bj_p( $c['text2'], 'mt-4 leading-relaxed text-brand-gray' );
			bj_p( $c['text3'], 'mt-4 leading-relaxed text-brand-gray' );
			?>
			<?php if ( $bj_items ) : ?>
				<ul class="mt-6 grid gap-2 sm:grid-cols-2">
					<?php foreach ( $bj_items as $bj_item ) : ?>
						<li class="flex items-start gap-2"><?php echo bj_check_svg(); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped -- static SVG. ?><span class="text-sm text-brand-gray"><?php echo esc_html( $bj_item ); ?></span></li>
					<?php endforeach; ?>
				</ul>
			<?php endif; ?>
			<?php if ( '' !== trim( $c['multilingual_title'] . $c['multilingual_text'] ) ) : ?>
				<div class="mt-6">
					<?php if ( '' !== trim( $c['multilingual_title'] ) ) : ?>
						<h3 class="mb-2 text-sm font-bold uppercase tracking-[0.16em] text-brand-heading"><?php echo esc_html( $c['multilingual_title'] ); ?></h3>
					<?php endif; ?>
					<?php bj_p( $c['multilingual_text'], 'mb-3 max-w-md text-sm leading-relaxed text-brand-gray' ); ?>
				</div>
			<?php endif; ?>
			<div class="mt-7 flex flex-col gap-3 sm:flex-row sm:items-center">
				<?php
				bj_button( $c['button1_text'], $c['button1_url'], 'group inline-flex items-center justify-center gap-2 ' . BJ_BTN_BLUE, true );
				if ( ! empty( $c['show_button2'] ) ) {
					bj_button( $c['button2_text'], $c['button2_url'], 'inline-flex items-center justify-center gap-2 ' . BJ_BTN_GHOST );
				}
				?>
			</div>
		</div>
		<?php // A cut-out traveller leaping from a phone, over a soft blue glow. ?>
		<div class="aos" data-delay="150"><div class="dmc-cutout mx-auto" style="max-width:520px" data-motion="leap">
			<img src="<?php echo esc_url( bj_media_src( $c['image'], 1150, 85 ) ); ?>" alt="<?php echo esc_attr( bj_media_alt( $c['image'], $c['alt'] ) ); ?>" width="1150" height="1020" loading="lazy" decoding="async">
			<?php if ( '' !== trim( $c['badge_title'] . $c['badge_text'] ) ) : ?>
				<div class="dmc-badge absolute -bottom-5 -right-3 max-w-[230px] rounded-xl border border-brand-blue/10 bg-white p-5 shadow-lg sm:-right-5">
					<?php
					bj_p( $c['badge_title'], 'mb-1 text-sm font-semibold text-brand-heading' );
					bj_p( $c['badge_text'], 'text-xs leading-relaxed text-brand-gray' );
					?>
				</div>
			<?php endif; ?>
		</div></div>
	</div></div>
</section>
