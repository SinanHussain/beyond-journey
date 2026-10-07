<?php
/**
 * Site footer, enquiry popup and closing tags.
 *
 * @package Beyond_Journey
 */

defined( 'ABSPATH' ) || exit;

?>
</main>

<?php bj_render_footer(); ?>

<?php
// No floating buttons or popup inside the Elementor editor preview. The popup setting
// only decides whether the form opens by itself; the buttons always open it on request.
if ( ! bj_is_elementor_preview() ) {
	get_template_part( 'template-parts/float-actions' );
	get_template_part( 'template-parts/enquiry-modal' );
}
wp_footer();
?>
</body>
</html>
