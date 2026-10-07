<?php
/**
 * Enquiry popup, shown once per visit by assets/js/theme.js.
 *
 * @package Beyond_Journey
 */

defined( 'ABSPATH' ) || exit;

$bj_input = 'w-full rounded-lg border border-gray-200 bg-brand-surface px-3.5 py-2 text-sm text-brand-heading placeholder-brand-gray-light transition-all focus:border-brand-blue focus:bg-white focus:outline-none focus:ring-2 focus:ring-brand-blue/20';
$bj_label = 'mb-1 block text-xs font-medium text-brand-heading';
?>
<div id="enquiry-modal" class="fixed inset-0 z-[60] hidden items-end justify-center p-0 sm:items-center sm:p-4">
	<button type="button" id="enquiry-backdrop" aria-label="<?php esc_attr_e( 'Close enquiry form', 'beyond-journey' ); ?>"
			class="absolute inset-0 h-full w-full cursor-default bg-brand-dark/70"></button>

	<div id="enquiry-dialog" role="dialog" aria-modal="true" aria-labelledby="enquiry-modal-title"
		class="relative max-h-[92dvh] w-full max-w-3xl overflow-hidden overflow-y-auto rounded-t-2xl bg-white shadow-2xl sm:rounded-2xl">
		<div class="h-1 w-full bg-gradient-to-r from-brand-blue via-brand-blue-light to-brand-orange"></div>

		<button type="button" id="enquiry-close" aria-label="<?php esc_attr_e( 'Close enquiry form', 'beyond-journey' ); ?>"
				class="absolute right-2.5 top-3 flex h-8 w-8 items-center justify-center rounded-lg text-brand-gray transition-colors hover:bg-brand-blue-mist hover:text-brand-heading">
			<?php echo bj_svg( 'close', 'h-5 w-5', 2 ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped -- static SVG. ?>
		</button>

		<div class="grid md:grid-cols-[minmax(0,0.85fr)_minmax(0,1fr)]">
			<div aria-hidden="true" class="relative hidden md:block">
				<img id="enquiry-panel-img" src="<?php echo esc_url( bj_img( BJ_MODAL_IMAGE, 700, 72 ) ); ?>" alt="" loading="lazy" decoding="async" class="absolute inset-0 h-full w-full object-cover object-[38%_center]">
				<div class="absolute inset-0 bg-gradient-to-t from-[#0B2A44]/85 via-[#0B2A44]/35 to-[#0B2A44]/10"></div>
				<div class="absolute inset-x-0 bottom-0 p-6">
					<p class="mb-1 text-[11px] font-semibold uppercase tracking-[0.2em] text-brand-orange-light"><?php esc_html_e( 'Beyond Journey Tourism', 'beyond-journey' ); ?></p>
					<p class="text-lg font-bold leading-snug text-white"><?php esc_html_e( 'Every Journey. Every Direction. One Standard of Care.', 'beyond-journey' ); ?></p>
				</div>
			</div>

			<div class="px-5 py-5 sm:px-7 sm:py-6">
				<div id="enquiry-body">
					<p class="mb-1.5 text-xs font-semibold uppercase tracking-[0.18em] text-brand-orange"><?php esc_html_e( 'Plan Your Journey', 'beyond-journey' ); ?></p>
					<h2 id="enquiry-modal-title" class="text-xl font-bold leading-tight text-brand-heading">Tell Us Where You&rsquo;d <span class="text-brand-heading-soft">Like to Go</span></h2>
					<p class="mt-1.5 text-[13px] leading-relaxed text-brand-gray"><?php esc_html_e( 'Share a few details and our team will come back to you with suitable options.', 'beyond-journey' ); ?></p>

					<form id="enquiry-modal-form" class="mt-4 space-y-3" method="post" action="<?php echo esc_url( admin_url( 'admin-post.php' ) ); ?>" data-bj-enquiry data-hide="#enquiry-body" data-done="#enquiry-done-modal">
						<div class="grid gap-3 sm:grid-cols-2">
							<div><label for="modal-name" class="<?php echo esc_attr( $bj_label ); ?>"><?php esc_html_e( 'Full Name *', 'beyond-journey' ); ?></label>
								<input id="modal-name" name="name" type="text" required maxlength="200" autocomplete="name" placeholder="<?php esc_attr_e( 'Your name', 'beyond-journey' ); ?>" class="<?php echo esc_attr( $bj_input ); ?>"></div>
							<div><label for="modal-phone" class="<?php echo esc_attr( $bj_label ); ?>"><?php esc_html_e( 'Phone / WhatsApp *', 'beyond-journey' ); ?></label>
								<input id="modal-phone" name="phone" type="tel" required maxlength="200" autocomplete="tel" placeholder="+971 XX XXX XXXX" class="<?php echo esc_attr( $bj_input ); ?>"></div>
						</div>
						<div class="grid gap-3 sm:grid-cols-2">
							<div><label for="modal-email" class="<?php echo esc_attr( $bj_label ); ?>"><?php esc_html_e( 'Email Address', 'beyond-journey' ); ?></label>
								<input id="modal-email" name="email" type="email" maxlength="200" autocomplete="email" placeholder="your@email.com" class="<?php echo esc_attr( $bj_input ); ?>"></div>
							<div><label for="modal-destination" class="<?php echo esc_attr( $bj_label ); ?>"><?php esc_html_e( 'Destination', 'beyond-journey' ); ?></label>
								<input id="modal-destination" name="destination" type="text" maxlength="200" placeholder="<?php esc_attr_e( 'Where would you like to go?', 'beyond-journey' ); ?>" class="<?php echo esc_attr( $bj_input ); ?>"></div>
						</div>
						<div><label for="modal-message" class="<?php echo esc_attr( $bj_label ); ?>"><?php esc_html_e( 'Travel Dates or Requirements', 'beyond-journey' ); ?></label>
							<textarea id="modal-message" name="message" rows="2" maxlength="5000" placeholder="<?php esc_attr_e( 'Travel dates, number of travellers, preferences...', 'beyond-journey' ); ?>" class="<?php echo esc_attr( $bj_input ); ?> resize-none"></textarea></div>
						<p data-bj-error hidden role="alert" class="rounded-lg bg-red-50 px-3 py-2 text-xs text-red-700"></p>
						<button type="submit" class="w-full rounded-lg bg-brand-orange px-6 py-2.5 text-sm font-semibold text-white transition-all duration-300 hover:bg-brand-orange-dark hover:shadow-lg hover:shadow-brand-orange/25 disabled:cursor-wait disabled:opacity-60"><?php esc_html_e( 'Send Enquiry', 'beyond-journey' ); ?></button>
						<?php bj_enquiry_hidden_fields( 'popup' ); ?>
					</form>

					<div class="mt-3.5 flex flex-wrap items-center justify-center gap-x-4 gap-y-1 border-t border-brand-blue/10 pt-3.5 text-xs text-brand-gray">
						<span><?php esc_html_e( 'Or reach us directly:', 'beyond-journey' ); ?></span>
						<a href="<?php echo esc_url( bj_tel_url() ); ?>" class="font-semibold text-brand-blue hover:text-brand-blue-dark"><?php echo esc_html( bj_setting( 'phone' ) ); ?></a>
						<a href="<?php echo esc_url( bj_whatsapp_url() ); ?>" target="_blank" rel="noopener noreferrer" class="font-semibold text-green-600 hover:text-green-700"><?php esc_html_e( 'WhatsApp', 'beyond-journey' ); ?></a>
					</div>
				</div>

				<div id="enquiry-done-modal" class="hidden py-6 text-center" role="status">
					<div class="mx-auto mb-3.5 flex h-14 w-14 items-center justify-center rounded-full bg-green-100 text-green-600">
						<?php echo bj_svg( 'check', 'h-7 w-7', 2 ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped -- static SVG. ?>
					</div>
					<h2 class="mb-1.5 text-lg font-bold text-brand-heading"><?php esc_html_e( 'Thank You!', 'beyond-journey' ); ?></h2>
					<p class="text-sm text-brand-gray"><?php esc_html_e( 'We have received your enquiry and will get back to you shortly.', 'beyond-journey' ); ?></p>
					<button type="button" id="enquiry-continue" class="mt-5 rounded-lg bg-brand-blue px-5 py-2 text-sm font-semibold text-white transition-colors hover:bg-brand-blue-dark"><?php esc_html_e( 'Continue Browsing', 'beyond-journey' ); ?></button>
				</div>
			</div>
		</div>
	</div>
</div>
