<?php
/**
 * Floating buttons: open the enquiry form, or start a WhatsApp chat.
 *
 * @package Beyond_Journey
 */

defined( 'ABSPATH' ) || exit;
?>
<div class="fixed bottom-5 right-4 z-40 flex flex-col items-end gap-3 sm:bottom-6 sm:right-6">
	<button type="button" id="float-enquiry" class="group flex items-center gap-2.5 rounded-full bg-[#0B2A44] py-2.5 pl-2.5 pr-5 text-sm font-semibold text-white shadow-lg shadow-black/25 transition-all duration-300 hover:-translate-y-0.5 hover:bg-[#123f63]">
		<span class="flex h-9 w-9 flex-shrink-0 items-center justify-center rounded-full bg-white/10">
			<?php echo bj_svg( 'chat', 'h-5 w-5', 1.7 ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped -- static SVG. ?></span><?php echo esc_html__( 'Start your journey', 'beyond-journey' ); ?>
	</button>
	<a href="<?php echo esc_url( bj_whatsapp_url() ); ?>" target="_blank" rel="noopener noreferrer" aria-label="<?php esc_attr_e( 'Chat with Beyond Journey Tourism on WhatsApp', 'beyond-journey' ); ?>" class="flex h-14 w-14 items-center justify-center rounded-full bg-[#25D366] text-white shadow-lg shadow-black/25 transition-transform duration-300 hover:-translate-y-0.5 hover:scale-105">
		<?php echo bj_whatsapp_svg( 'h-7 w-7' ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped -- static SVG. ?></a>
</div>
