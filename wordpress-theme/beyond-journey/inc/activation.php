<?php
/**
 * First activation: creates the site pages, the static front page, the menus and (with Elementor) the page layouts.
 * Existing pages, reading settings, menus and Elementor layouts are left as they are.
 *
 * @package Beyond_Journey
 */

defined( 'ABSPATH' ) || exit;

/** Pages the designed layouts belong to, keyed by slug. */
function bj_site_pages() {
	return array(
		'home'         => __( 'Home', 'beyond-journey' ),
		'about'        => __( 'About', 'beyond-journey' ),
		'services'     => __( 'Services', 'beyond-journey' ),
		'destinations' => __( 'Destinations', 'beyond-journey' ),
		'packages'     => __( 'Packages', 'beyond-journey' ),
		'dmc'          => __( 'DMC', 'beyond-journey' ),
		'why-us'       => __( 'Why Us', 'beyond-journey' ),
		'contact'      => __( 'Contact', 'beyond-journey' ),
	);
}

/**
 * Creates the site pages that do not exist yet.
 *
 * @return int[] Page IDs keyed by slug.
 */
function bj_create_site_pages() {
	$ids = array();
	foreach ( bj_site_pages() as $slug => $title ) {
		$page = get_page_by_path( $slug );
		if ( $page && 'trash' !== $page->post_status ) {
			$ids[ $slug ] = $page->ID;
			continue;
		}
		$page_id = wp_insert_post(
			array(
				'post_type'    => 'page',
				'post_status'  => 'publish',
				'post_title'   => $title,
				'post_name'    => $slug,
				'post_content' => '',
			)
		);
		if ( $page_id && ! is_wp_error( $page_id ) ) {
			$ids[ $slug ] = $page_id;
		}
	}
	return $ids;
}

/**
 * Creates and assigns the Primary, Footer Services and Footer Destinations menus where no menu is assigned yet.
 *
 * @param int[] $ids Page IDs keyed by slug.
 */
function bj_seed_menus( $ids ) {
	$plans = array(
		'primary'             => array( 'Primary Menu', array() ),
		'footer_services'     => array( 'Footer Services', array() ),
	);
	foreach ( array_keys( bj_site_pages() ) as $slug ) {
		if ( ! empty( $ids[ $slug ] ) ) {
			$plans['primary'][1][] = array( $ids[ $slug ], get_the_title( $ids[ $slug ] ) );
		}
	}
	foreach ( array( 'services' => 'footer_services' ) as $slug => $location ) {
		if ( ! empty( $ids[ $slug ] ) ) {
			foreach ( bj_footer_defaults( $slug ) as $link ) {
				$plans[ $location ][1][] = array( $ids[ $slug ], $link['label'] );
			}
		}
	}

	$locations = get_theme_mod( 'nav_menu_locations', array() );
	foreach ( $plans as $location => $plan ) {
		list( $name, $items ) = $plan;
		if ( ! empty( $locations[ $location ] ) || ! $items ) {
			continue;
		}
		$menu = wp_get_nav_menu_object( $name );
		if ( $menu ) {
			$menu_id = $menu->term_id;
		} else {
			$menu_id = wp_create_nav_menu( $name );
			if ( is_wp_error( $menu_id ) ) {
				continue;
			}
			foreach ( $items as $position => $item ) {
				wp_update_nav_menu_item(
					$menu_id,
					0,
					array(
						'menu-item-title'     => $item[1],
						'menu-item-object'    => 'page',
						'menu-item-object-id' => $item[0],
						'menu-item-type'      => 'post_type',
						'menu-item-status'    => 'publish',
						'menu-item-position'  => $position + 1,
					)
				);
			}
		}
		$locations[ $location ] = $menu_id;
	}
	set_theme_mod( 'nav_menu_locations', $locations );
}

/** Runs once after the theme is activated. */
function bj_activate() {
	$ids = bj_create_site_pages();

	// Only switch a site that still shows the latest posts on its front page.
	if ( 'posts' === get_option( 'show_on_front' ) && ! empty( $ids['home'] ) ) {
		update_option( 'show_on_front', 'page' );
		update_option( 'page_on_front', $ids['home'] );
	}

	bj_seed_menus( $ids );

	if ( bj_elementor_ready() && current_user_can( 'edit_pages' ) ) {
		bj_elementor_build_pages();
	}
}
add_action( 'after_switch_theme', 'bj_activate' );
