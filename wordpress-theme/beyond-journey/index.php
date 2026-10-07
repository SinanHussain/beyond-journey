<?php
/**
 * Fallback for posts, the blog, archives and search.
 *
 * @package Beyond_Journey
 */

defined( 'ABSPATH' ) || exit;

get_header();

// Posts built with Elementor are shown full width between the site header and footer.
if ( is_singular() && bj_is_elementor_page() ) {
	while ( have_posts() ) {
		the_post();
		the_content();
	}
	get_footer();
	return;
}

if ( is_singular() ) {
	$bj_title = single_post_title( '', false );
} elseif ( is_search() ) {
	/* translators: %s: search terms. */
	$bj_title = sprintf( __( 'Search results for "%s"', 'beyond-journey' ), get_search_query( false ) );
} elseif ( is_home() ) {
	$bj_title = get_option( 'page_for_posts' ) ? get_the_title( get_option( 'page_for_posts' ) ) : __( 'Blog', 'beyond-journey' );
} else {
	$bj_title = wp_strip_all_tags( get_the_archive_title() );
}

bj_section(
	'page-hero',
	array(
		'title' => $bj_title,
		'image' => 'https://images.unsplash.com/photo-1593182440709-4b7b56482c55',
		'pos'   => 'object-[78%_center]',
	)
);
?>
<section class="bg-white py-14 lg:py-16"><div class="mx-auto max-w-3xl px-4 sm:px-6 lg:px-8">
	<?php if ( ! have_posts() ) : ?>
		<p class="text-center text-brand-gray"><?php esc_html_e( 'Nothing found.', 'beyond-journey' ); ?></p>
	<?php elseif ( is_singular() ) : ?>
		<?php the_post(); ?>
		<article <?php post_class( 'bj-content' ); ?>>
			<?php if ( 'post' === get_post_type() ) : ?>
				<p class="text-sm text-brand-gray-light"><?php echo esc_html( get_the_date() ); ?></p>
			<?php endif; ?>
			<?php the_content(); ?>
		</article>
		<?php wp_link_pages(); ?>
	<?php else : ?>
		<div class="space-y-10">
			<?php
			while ( have_posts() ) :
				the_post();
				?>
				<article <?php post_class( 'border-b border-brand-blue/10 pb-8' ); ?>>
					<p class="text-sm text-brand-gray-light"><?php echo esc_html( get_the_date() ); ?></p>
					<h2 class="mt-1 text-2xl font-bold text-brand-heading"><a href="<?php the_permalink(); ?>" class="transition-colors hover:text-brand-blue"><?php the_title(); ?></a></h2>
					<div class="mt-3 leading-relaxed text-brand-gray"><?php the_excerpt(); ?></div>
					<a href="<?php the_permalink(); ?>" class="group mt-4 inline-flex items-center gap-2 font-semibold text-brand-blue"><?php esc_html_e( 'Read more', 'beyond-journey' ); ?><?php echo bj_arrow_svg(); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped -- static SVG. ?></a>
				</article>
			<?php endwhile; ?>
		</div>
		<div class="bj-pagination mt-10"><?php the_posts_pagination(); ?></div>
	<?php endif; ?>
</div></section>
<?php
get_footer();
