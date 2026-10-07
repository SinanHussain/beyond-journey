<?php
/**
 * How we work.
 *
 * @package Beyond_Journey
 */

defined( 'ABSPATH' ) || exit;

$c        = $args;
$bj_steps = array_values( (array) $c['steps'] );
$bj_last  = count( $bj_steps ) - 1;
?>
<section class="pb-6 pt-14 lg:pb-8 lg:pt-16 <?php echo esc_attr( $c['bg'] ); ?>"><div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
	<?php bj_heading( $c['eyebrow'], bj_title( $c['title'], $c['highlight'] ) ); ?>
	<div class="grid gap-6 sm:grid-cols-2 lg:grid-cols-4 lg:gap-5">
		<?php
		foreach ( $bj_steps as $bj_i => $bj_step ) :
			$bj_step = wp_parse_args( (array) $bj_step, array( 'number' => '', 'title' => '', 'description' => '' ) );
			?>
			<div class="aos" data-delay="<?php echo (int) $bj_i * 100; ?>"><div class="relative text-center">
				<?php if ( $bj_i < $bj_last ) : ?>
					<div aria-hidden="true" class="absolute left-[calc(50%+42px)] top-9 hidden h-0.5 w-[calc(100%-84px)] bg-gradient-to-r from-brand-blue/30 to-brand-blue/10 lg:block"></div>
				<?php endif; ?>
				<div class="relative mb-4 inline-flex h-[4.5rem] w-[4.5rem] items-center justify-center rounded-full border-[3px] border-brand-blue/45 bg-white shadow-md shadow-brand-blue/5">
					<span class="absolute -inset-1 rounded-full border-2 border-brand-blue/20"></span>
					<span class="text-xl font-bold text-brand-blue"><?php echo esc_html( $bj_step['number'] ); ?></span></div>
				<h3 class="mb-2 text-lg font-bold text-brand-heading"><?php echo esc_html( $bj_step['title'] ); ?></h3>
				<?php bj_p( $bj_step['description'], 'text-sm leading-relaxed text-brand-gray' ); ?>
			</div></div>
		<?php endforeach; ?>
	</div>
</div></section>
