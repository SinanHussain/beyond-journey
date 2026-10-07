<?php
/**
 * Site header: see-through over the banner photo, a white floating bar once the page is scrolled.
 *
 * @package Beyond_Journey
 */

defined( 'ABSPATH' ) || exit;
?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1">
<?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<?php wp_body_open(); ?>

<a href="#main" class="skip-link"><?php esc_html_e( 'Skip to main content', 'beyond-journey' ); ?></a>

<header id="site-header" class="fixed top-0 left-0 right-0 z-50">
	<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
		<div class="nav-shell flex items-center justify-between">
			<a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="brand-logo-box relative block flex-shrink-0" aria-label="<?php esc_attr_e( 'Beyond Journey Tourism — home', 'beyond-journey' ); ?>">
				<img id="brand-logo-light" src="<?php echo esc_url( bj_logo_url( 'light' ) ); ?>" alt="" aria-hidden="true" class="brand-logo-img absolute inset-0 w-auto transition-opacity duration-300">
				<img id="brand-logo" src="<?php echo esc_url( bj_logo_url() ); ?>" alt="<?php esc_attr_e( 'Beyond Journey Tourism', 'beyond-journey' ); ?>" class="brand-logo-img w-auto opacity-0 transition-opacity duration-300">
			</a>
			<nav id="desktop-nav" class="hidden lg:flex items-center gap-0.5" aria-label="<?php esc_attr_e( 'Main', 'beyond-journey' ); ?>"><?php bj_desktop_nav(); ?></nav>
			<button id="menu-btn" type="button" class="nav-menu-btn"
					aria-label="<?php esc_attr_e( 'Open menu', 'beyond-journey' ); ?>" aria-expanded="false" aria-controls="mobile-nav">
				<svg id="icon-open" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2" aria-hidden="true"><?php echo bj_icon_paths( 'menu' ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped -- static SVG. ?></svg>
				<svg id="icon-close" class="w-5 h-5 hidden" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2" aria-hidden="true"><?php echo bj_icon_paths( 'close' ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped -- static SVG. ?></svg>
			</button>
		</div>
	</div>
</header>

<?php // The panel sits outside <header>: a filter on the header would otherwise collapse a fixed child. ?>
<div id="mobile-nav" class="mobile-nav-panel lg:hidden hidden">
	<nav id="mobile-nav-list" class="flex flex-col gap-0.5 p-4" aria-label="<?php esc_attr_e( 'Mobile', 'beyond-journey' ); ?>"><?php bj_mobile_nav(); ?></nav>
</div>

<main id="main" class="flex-1">
