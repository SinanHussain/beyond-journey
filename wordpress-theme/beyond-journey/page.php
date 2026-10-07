<?php
/**
 * Any other page (for example Privacy Policy): banner plus the editor content.
 * Pages built with Elementor are shown full width between the site header and footer.
 *
 * @package Beyond_Journey
 */

defined( 'ABSPATH' ) || exit;

get_header();

while ( have_posts() ) :
	the_post();
	if ( bj_is_elementor_page() ) {
		the_content();
		continue;
	}
	bj_section(
		'page-hero',
		array(
			'title' => get_the_title(),
			'image' => 'https://images.unsplash.com/photo-1593182440709-4b7b56482c55',
			'pos'   => 'object-[78%_center]',
		)
	);
	?>
	<section class="bg-white py-14 lg:py-16"><div class="mx-auto max-w-3xl px-4 sm:px-6 lg:px-8">
		<div class="bj-content"><?php the_content(); ?></div>
		<?php wp_link_pages(); ?>
	</div></section>
	<?php
endwhile;

get_footer();
