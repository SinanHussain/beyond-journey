<?php
/**
 * Contact card: details on the left, enquiry form on the right.
 *
 * @package Beyond_Journey
 */

defined( 'ABSPATH' ) || exit;

$c = $args;

// Result of a plain (no JavaScript) form submission.
$bj_status = isset( $_GET['bj_enquiry'] ) ? sanitize_key( wp_unslash( $_GET['bj_enquiry'] ) ) : ''; // phpcs:ignore WordPress.Security.NonceVerification.Recommended -- display only.

$bj_label = 'mb-1 block text-xs font-medium text-brand-heading';
$bj_input = 'w-full rounded-lg border border-gray-200 bg-brand-surface px-3.5 py-2 text-sm text-brand-heading placeholder-brand-gray-light transition-all focus:border-brand-blue focus:bg-white focus:outline-none focus:ring-2 focus:ring-brand-blue/20';

$bj_field = static function ( $id, $label, $type, $placeholder, $required = false, $extra = '' ) use ( $bj_label, $bj_input ) {
	printf(
		'<div><label for="%1$s" class="%2$s">%3$s%4$s</label><input type="%5$s" id="%1$s" name="%1$s"%6$s placeholder="%7$s" class="%8$s"%9$s></div>',
		esc_attr( $id ),
		esc_attr( $bj_label ),
		esc_html( $label ),
		$required ? ' *' : '',
		esc_attr( $type ),
		$required ? ' required' : '',
		esc_attr( $placeholder ),
		esc_attr( $bj_input ),
		$extra // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped -- static attributes.
	);
};

$bj_row = static function ( $href, $icon, $label, $external = false ) {
	printf(
		'<li><a href="%1$s"%2$s class="flex items-center gap-2.5 transition-colors hover:text-brand-blue">%3$s<span class="whitespace-nowrap">%4$s</span></a></li>',
		esc_url( $href ),
		$external ? ' target="_blank" rel="noopener noreferrer"' : '',
		$icon, // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped -- static SVG.
		esc_html( $label )
	);
};

$bj_blue_icon = 'h-5 w-5 flex-shrink-0 text-brand-blue';
?>
<section id="contact" class="bg-brand-surface py-14 lg:py-16"><div class="contact-wrap mx-auto px-4 sm:px-6 lg:px-8">
	<div class="aos pop contact-card overflow-hidden rounded-2xl border border-brand-blue/25 bg-white shadow-[0_18px_50px_-30px_rgb(23_82_125_/_0.6)]">
		<div class="grid lg:grid-cols-5">
			<div class="grid-lines contact-photo-bg relative flex flex-col bg-brand-blue-mist p-7 sm:p-9 lg:col-span-2">
				<img class="cf-bg" src="<?php echo esc_url( bj_img( BJ_MODAL_IMAGE, 800, 72 ) ); ?>" alt="" aria-hidden="true" loading="lazy" decoding="async"><span class="cf-veil" aria-hidden="true"></span>
				<span aria-hidden="true" class="pointer-events-none absolute inset-y-0 left-0 w-1 bg-gradient-to-b from-brand-blue to-brand-blue-light"></span>
				<?php bj_p( $c['eyebrow'], BJ_EYEBROW ); ?>
				<h2 class="text-[1.75rem] font-bold leading-[1.15] text-brand-heading sm:text-3xl lg:text-[2.25rem]"><?php echo bj_title( $c['title'], $c['highlight'] ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped -- escaped in bj_title(). ?></h2>
				<span class="section-accent"></span>
				<?php bj_p( $c['text'], 'mt-5 leading-relaxed text-brand-gray' ); ?>
				<ul class="contact-list mt-7 space-y-3 border-t border-brand-blue/15 pt-6 text-sm text-brand-gray lg:mt-auto">
					<?php
					$bj_row( bj_tel_url(), bj_svg( 'phone', $bj_blue_icon ), bj_setting( 'phone' ) );
					$bj_row( bj_whatsapp_url(), bj_whatsapp_svg( 'h-5 w-5 flex-shrink-0 text-green-600' ), __( 'WhatsApp', 'beyond-journey' ), true );
					$bj_row( 'mailto:' . bj_setting( 'email' ), bj_svg( 'mail', $bj_blue_icon ), bj_setting( 'email' ) );
					?>
					<li class="flex items-center gap-2.5"><?php echo bj_svg( 'pin', $bj_blue_icon ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped -- static SVG. ?><span class="whitespace-nowrap"><?php echo esc_html( bj_setting( 'location' ) ); ?></span></li>
					<?php $bj_row( bj_setting( 'website' ), bj_svg( 'globe', $bj_blue_icon ), bj_website_label() ); ?>
				</ul>
				<?php bj_social_row( __( 'Follow us', 'beyond-journey' ) ); ?>
			</div>
			<div class="contact-form-col p-5 sm:p-7 lg:col-span-3">
				<div class="contact-form-box cf-v2 border border-brand-blue/30 p-5 sm:p-7">
					<div class="cf-head"><span class="cf-head-icon"><?php echo bj_svg( 'plane', '', 1.6 ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped -- static SVG. ?></span>
						<div><p class="cf-head-title"><?php echo esc_html( $c['form_title'] ); ?></p><?php bj_p( $c['form_text'], 'cf-head-sub' ); ?></div></div>
					<form id="enquiry-form" class="<?php echo 'sent' === $bj_status ? ' hidden' : ''; ?>" method="post" action="<?php echo esc_url( admin_url( 'admin-post.php' ) ); ?>" data-bj-enquiry data-done="#enquiry-done">
						<?php $bj_field( 'name', 'Full Name', 'text', 'Your name', true, ' maxlength="200" autocomplete="name"' ); ?>
						<div class="grid gap-4 sm:grid-cols-2">
							<?php
							$bj_field( 'email', 'Email Address', 'email', 'your@email.com', false, ' maxlength="200" autocomplete="email"' );
							$bj_field( 'phone', 'Phone / WhatsApp', 'tel', '+971 XX XXX XXXX', true, ' maxlength="200" autocomplete="tel"' );
							?>
						</div>
						<?php $bj_field( 'destination', 'Destination', 'text', 'Where would you like to go?', false, ' maxlength="200"' ); ?>
						<div class="contact-msg"><label for="message" class="<?php echo esc_attr( $bj_label ); ?>"><?php esc_html_e( 'Travel Dates or Requirements', 'beyond-journey' ); ?></label>
							<textarea id="message" name="message" rows="2" maxlength="5000" placeholder="<?php esc_attr_e( 'Travel dates, number of travellers, preferences...', 'beyond-journey' ); ?>" class="<?php echo esc_attr( $bj_input ); ?> resize-none"></textarea></div>
						<p data-bj-error role="alert" class="rounded-lg bg-red-50 px-3 py-2 text-xs text-red-700"<?php echo 'error' === $bj_status ? '' : ' hidden'; ?>><?php echo 'error' === $bj_status ? esc_html__( 'Sorry, your enquiry could not be sent. Please check the form and try again, or contact us on WhatsApp.', 'beyond-journey' ) : ''; ?></p>
						<button type="submit" class="cf-btn"><?php echo esc_html( $c['button_text'] ); ?><span class="cf-btn-arrow" aria-hidden="true"><?php echo bj_svg( 'arrow-right', '', 2 ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped -- static SVG. ?></span></button>
						<?php bj_enquiry_hidden_fields( 'contact' ); ?>
					</form>
					<div id="enquiry-done" class="<?php echo 'sent' === $bj_status ? '' : 'hidden '; ?>py-6 text-center" role="status">
						<div class="mx-auto mb-3.5 flex h-14 w-14 items-center justify-center rounded-full bg-green-100 text-green-600">
							<?php echo bj_svg( 'check', 'w-7 h-7', 2 ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped -- static SVG. ?></div>
						<h3 class="mb-1.5 text-lg font-bold text-brand-heading"><?php echo esc_html( $c['done_title'] ); ?></h3>
						<?php bj_p( $c['done_text'], 'text-sm text-brand-gray' ); ?>
					</div>
				</div>
			</div>
		</div>
	</div>
</div></section>
