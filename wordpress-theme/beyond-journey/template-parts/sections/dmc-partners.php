<?php
/**
 * DMC page: for travel agents and partners.
 *
 * @package Beyond_Journey
 */

defined( 'ABSPATH' ) || exit;

$c          = $args;
?>
<section class="relative overflow-hidden bg-brand-blue-pale py-14 lg:py-16">
	<div class="pointer-events-none absolute inset-x-0 top-0 h-16 bg-gradient-to-b from-white to-transparent"></div>
	<div class="relative z-10 mx-auto max-w-7xl px-4 sm:px-6 lg:px-8"><div class="grid gap-8 lg:grid-cols-2 lg:gap-12">
		<div class="aos">
			<?php bj_p( $c['eyebrow'], BJ_EYEBROW ); ?>
			<h2 class="text-[1.75rem] font-bold leading-[1.15] text-brand-heading sm:text-3xl"><?php echo bj_title( $c['title'], $c['highlight'] ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped -- escaped in bj_title(). ?></h2>
			<span class="section-accent"></span>
			<?php
			bj_p( $c['text1'], 'mt-5 leading-relaxed text-brand-gray' );
			bj_p( $c['text2'], 'mt-4 leading-relaxed text-brand-gray' );
			bj_p( $c['text3'], 'mt-4 leading-relaxed text-brand-gray' );
			?>
		</div>
		<?php // Two matching rows: an icon tile, a title and left-aligned text. ?>
		<div class="aos" data-delay="140"><div class="pcard">
			<?php if ( '' !== trim( $c['multilingual_title'] . $c['multilingual_text'] ) ) : ?>
				<div class="pcard-row"><span class="pcard-ico"><?php echo bj_svg( 'user-group', '', 1.8 ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped -- static SVG. ?></span><div>
					<?php if ( '' !== trim( $c['multilingual_title'] ) ) : ?><h3 class="pcard-title"><?php echo esc_html( $c['multilingual_title'] ); ?></h3><?php endif; ?>
					<?php bj_p( $c['multilingual_text'], 'pcard-text' ); ?>
				</div></div>
			<?php endif; ?>
			<?php if ( '' !== trim( $c['contact_label'] . $c['contact_text'] ) ) : ?>
				<div class="pcard-row"><span class="pcard-ico"><?php echo bj_svg( 'support', '', 1.8 ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped -- static SVG. ?></span><div>
					<?php if ( '' !== trim( $c['contact_label'] ) ) : ?><h3 class="pcard-title"><?php echo esc_html( $c['contact_label'] ); ?></h3><?php endif; ?>
					<?php bj_p( $c['contact_text'], 'pcard-text' ); ?>
				</div></div>
			<?php endif; ?>
		</div></div>
	</div></div>
</section>
