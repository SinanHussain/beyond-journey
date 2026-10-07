<?php
/**
 * Header, mobile and footer navigation.
 *
 * @package Beyond_Journey
 */

defined( 'ABSPATH' ) || exit;

/**
 * Slug of the page being viewed: '' on the front page, null outside pages.
 *
 * @return string|null
 */
function bj_current_slug() {
	if ( is_front_page() ) {
		return '';
	}
	if ( is_page() ) {
		$post = get_queried_object();
		return $post instanceof WP_Post ? $post->post_name : null;
	}
	return null;
}

/**
 * Items of the menu assigned to a location, or null when no menu is assigned.
 * Top-level items carry their sub-items in 'children' (one level deep).
 *
 * @param string $location Menu location.
 * @return array[]|null Items with label, url, active, home, target and children keys.
 */
function bj_menu_items( $location ) {
	$locations = get_nav_menu_locations();
	$menu      = ! empty( $locations[ $location ] ) ? wp_get_nav_menu_items( $locations[ $location ] ) : false;
	if ( false === $menu ) {
		return null;
	}

	$home    = untrailingslashit( home_url( '/' ) );
	$front   = (int) get_option( 'page_on_front' );
	$queried = get_queried_object_id();
	$items   = array();
	$sub     = array();
	foreach ( (array) $menu as $entry ) {
		$is_page = 'post_type' === $entry->type;
		$is_home = untrailingslashit( $entry->url ) === $home || ( $is_page && $front && (int) $entry->object_id === $front );
		$item    = array(
			'label'    => $entry->title,
			'url'      => $entry->url,
			'active'   => ( $is_page && (int) $entry->object_id === $queried && ! is_home() ) || ( $is_home && is_front_page() )
				|| ( $is_page && is_singular( 'bj_package' ) && 'packages' === get_post_field( 'post_name', (int) $entry->object_id ) ),
			'home'     => $is_home,
			'target'   => $entry->target,
			'desc'     => trim( (string) $entry->description ),
			'children' => array(),
		);
		if ( (int) $entry->menu_item_parent ) {
			$sub[ (int) $entry->menu_item_parent ][] = $item;
		} else {
			$items[ (int) $entry->ID ] = $item;
		}
	}
	foreach ( $sub as $parent => $children ) {
		if ( isset( $items[ $parent ] ) ) {
			$items[ $parent ]['children'] = $children;
		}
	}
	return array_values( $items );
}

/**
 * Main navigation: the Primary menu, or the default pages when no menu is assigned.
 * Services and Destinations get their dropdown lists automatically when the menu gives them no sub-items.
 *
 * @return array[]
 */
function bj_nav_items() {
	static $items = null;
	if ( null !== $items ) {
		return $items;
	}

	$items = bj_menu_items( 'primary' );
	if ( null === $items ) {
		$items   = array();
		$current = bj_current_slug();
		foreach ( bj_nav_defaults() as $nav ) {
			$children = array();
			foreach ( isset( $nav['children'] ) ? $nav['children'] : array() as $child ) {
				$children[] = array(
					'label'    => $child['label'],
					'url'      => bj_url( $child['slug'] ),
					'active'   => ( null !== $current && $current === $child['slug'] ),
					'home'     => false,
					'target'   => '',
					'desc'     => '',
					'children' => array(),
				);
			}
			$items[] = array(
				'label'    => $nav['label'],
				'url'      => bj_url( $nav['slug'] ),
				'active'   => ( null !== $current && $current === $nav['slug'] ),
				'home'     => ( '' === $nav['slug'] ),
				'target'   => '',
				'children' => $children,
			);
		}
	}

	foreach ( $items as $i => $item ) {
		$slug = bj_nav_slug( $item['url'] );
		if ( empty( $item['children'] ) && in_array( $slug, array( 'services', 'destinations' ), true ) ) {
			$labels = 'services' === $slug ? wp_list_pluck( bj_services(), 'title' ) : array_merge( bj_region_order(), array( __( 'All Destinations', 'beyond-journey' ) ) );
			foreach ( $labels as $label ) {
				$items[ $i ]['children'][] = array(
					'label'    => $label,
					'url'      => $item['url'],
					'active'   => false,
					'home'     => false,
					'target'   => '',
					'desc'     => '',
					'children' => array(),
				);
			}
		}
		foreach ( $items[ $i ]['children'] as $c => $child ) {
			list( $icon, $desc ) = bj_nav_info( $child['label'] );
			$items[ $i ]['children'][ $c ]['icon'] = $icon;
			if ( empty( $child['desc'] ) ) {
				$items[ $i ]['children'][ $c ]['desc'] = $desc;
			}
		}
		// A parent counts as current when one of its sub-pages is being viewed.
		foreach ( $items[ $i ]['children'] as $child ) {
			if ( $child['active'] ) {
				$items[ $i ]['active'] = true;
			}
		}
	}
	return $items;
}

/**
 * Page slug of a site URL ('' for the home page, null for other sites).
 *
 * @param string $url URL.
 * @return string|null
 */
function bj_nav_slug( $url ) {
	$home = untrailingslashit( home_url( '/' ) );
	if ( 0 !== strpos( untrailingslashit( $url ), $home ) ) {
		return null;
	}
	return trim( (string) wp_parse_url( substr( $url, strlen( $home ) ), PHP_URL_PATH ), '/' );
}

/**
 * Icon and short line for a dropdown link. Regions get a pin and their first few countries.
 * A description set on the menu item in Appearance > Menus replaces the short line.
 *
 * @param string $label Link label.
 * @return array Icon name and short line.
 */
function bj_nav_info( $label ) {
	$info = array(
		'About Us' => array( 'user', __( 'Our story and the team behind it', 'beyond-journey' ) ),
		'Why Choose Us' => array( 'shield', __( 'What sets our planning apart', 'beyond-journey' ) ),
		'DMC & Ground Handling' => array( 'building-office', __( 'Ground services across the UAE', 'beyond-journey' ) ),
		'Holiday Packages & Tours' => array( 'sun', __( 'Tailor-made trips worldwide', 'beyond-journey' ) ),
		'UAE Tours & Attractions' => array( 'building', __( 'Desert, city and theme park days', 'beyond-journey' ) ),
		'Hotel Reservations' => array( 'hotel', __( 'Handpicked stays for every budget', 'beyond-journey' ) ),
		'Visa Services' => array( 'id-card', __( 'Tourist and business visas', 'beyond-journey' ) ),
		'Travel Insurance' => array( 'insurance', __( 'Cover for every kind of trip', 'beyond-journey' ) ),
		'Transfers, Transport & Rail' => array( 'truck', __( 'Airport, car and train travel', 'beyond-journey' ) ),
		'Corporate Travel & MICE' => array( 'briefcase', __( 'Business trips and events', 'beyond-journey' ) ),
		'24/7 Customer Support' => array( 'support', __( 'Help at any hour of your trip', 'beyond-journey' ) ),
		'All Destinations' => array( 'globe', __( 'Every country we cover', 'beyond-journey' ) ),
	);
	if ( isset( $info[ $label ] ) ) {
		return $info[ $label ];
	}
	$names = array();
	foreach ( bj_destinations() as $dest ) {
		if ( isset( $dest['region'] ) && $dest['region'] === $label ) {
			$names[] = $dest['name'];
		}
	}
	return $names ? array( 'pin', implode( ', ', array_slice( $names, 0, 3 ) ) ) : array( 'grid', '' );
}

/**
 * Link attributes shared by every nav renderer.
 *
 * @param array $item Nav item.
 * @return string
 */
function bj_nav_attrs( $item ) {
	$attrs = ' href="' . esc_url( $item['url'] ) . '"';
	if ( ! empty( $item['active'] ) ) {
		$attrs .= ' aria-current="page"';
	}
	if ( ! empty( $item['target'] ) ) {
		$attrs .= ' target="' . esc_attr( $item['target'] ) . '" rel="noopener noreferrer"';
	}
	return $attrs;
}

/** Desktop header links with icon dropdowns and the Plan Your Journey button. */
function bj_desktop_nav() {
	$tints = array( '#F9A15A', '#6FC3FF', '#7EE0B5', '#C9A7FF', '#FFD36E', '#FF8F7A' );
	echo '<div class="nav-links">';
	foreach ( bj_nav_items() as $item ) {
		$children = $item['children'];
		$link     = '<a' . bj_nav_attrs( $item ) . ' class="bj-nav-link relative px-3 py-2 text-sm font-medium rounded-lg transition-colors">' .
			esc_html( $item['label'] ) .
			( $children ? bj_svg( 'chevron-down', 'nav-caret', 2.2 ) : '' ) .
			( $item['active'] ? '<span aria-hidden="true" class="absolute left-3 right-3 -bottom-0.5 h-0.5 rounded-full bg-brand-orange"></span>' : '' ) .
			'</a>';
		if ( ! $children ) {
			echo '<div class="nav-item">' . $link . '</div>'; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped -- escaped above.
			continue;
		}
		echo '<div class="nav-item has-drop' . ( count( $children ) > 4 ? ' nav-drop-wide' : '' ) . '">' . $link . '<div class="nav-drop"><div class="nav-drop-inner"><div class="nav-drop-links">'; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped -- escaped above.
		foreach ( array_values( $children ) as $c => $child ) {
			echo '<a' . bj_nav_attrs( $child ) . ' class="nav-drop-link">' . // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped -- attributes are escaped in bj_nav_attrs().
				'<span class="nav-drop-ico" style="--c:' . esc_attr( $tints[ $c % count( $tints ) ] ) . '">' . bj_svg( $child['icon'], '', 1.8 ) . '</span>' . // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped -- static SVG.
				'<span><span class="nav-drop-name">' . esc_html( $child['label'] ) . '</span>' .
				( '' !== $child['desc'] ? '<span class="nav-drop-desc">' . esc_html( $child['desc'] ) . '</span>' : '' ) . '</span></a>';
		}
		echo '</div></div></div></div>';
	}
	echo '</div>';
	echo '<a href="' . esc_url( bj_url( 'contact' ) ) . '" class="nav-cta"><span class="nav-cta-icon">' . bj_svg( 'plane', '', 1.8 ) . '</span>' . esc_html__( 'Plan Your Journey', 'beyond-journey' ) . '</a>'; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped -- static SVG.
}

/** Mobile menu: links with expandable sub-lists, the Plan Your Journey button, then call and WhatsApp. */
function bj_mobile_nav() {
	foreach ( bj_nav_items() as $i => $item ) {
		$link = '<a' . bj_nav_attrs( $item ) . ' class="m-link">' . esc_html( $item['label'] ) . '</a>';
		if ( ! $item['children'] ) {
			echo $link; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped -- escaped above.
			continue;
		}
		/* translators: %s: menu item label. */
		$label = sprintf( __( 'Show %s links', 'beyond-journey' ), $item['label'] );
		echo '<div><div class="m-row">' . $link . // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped -- escaped above.
			'<button type="button" class="m-toggle" aria-expanded="false" aria-controls="m-sub-' . (int) $i . '" aria-label="' . esc_attr( $label ) . '">' . bj_svg( 'chevron-down', '', 2.2 ) . '</button></div>' . // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped -- static SVG.
			'<div id="m-sub-' . (int) $i . '" class="m-sub" hidden>';
		foreach ( $item['children'] as $child ) {
			echo '<a' . bj_nav_attrs( $child ) . ' class="m-sub-link">' . esc_html( $child['label'] ) . '</a>'; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped -- attributes are escaped in bj_nav_attrs().
		}
		echo '</div></div>';
	}
	echo '<a href="' . esc_url( bj_url( 'contact' ) ) . '" class="m-cta">' . bj_svg( 'plane', '', 1.8 ) . esc_html__( 'Plan Your Journey', 'beyond-journey' ) . '</a>'; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped -- static SVG.
	echo '<div class="m-quick"><a href="' . esc_url( bj_tel_url() ) . '" class="m-call">' . bj_svg( 'phone', '', 1.8 ) . esc_html__( 'Call Us', 'beyond-journey' ) . '</a>' . // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped -- static SVG.
		'<a href="' . esc_url( bj_whatsapp_url() ) . '" target="_blank" rel="noopener noreferrer" class="m-wa">' . bj_whatsapp_svg( '' ) . esc_html__( 'WhatsApp', 'beyond-journey' ) . '</a></div>'; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped -- static SVG.
}

/** Footer quick links: every page in the main navigation except Home, including dropdown pages, each once. */
function bj_footer_links() {
	$seen = array();
	foreach ( bj_nav_items() as $item ) {
		foreach ( array_merge( array( $item ), $item['children'] ) as $link ) {
			$key = untrailingslashit( $link['url'] );
			if ( $link['home'] || isset( $seen[ $key ] ) ) {
				continue;
			}
			$seen[ $key ] = true;
			echo '<li><a' . bj_nav_attrs( $link ) . ' class="group inline-flex items-center gap-1.5 text-sm text-white/85 transition-colors hover:text-white">' .
				bj_svg( 'chevron', 'h-3 w-3 -translate-x-2 text-brand-orange-light opacity-0 transition-all group-hover:translate-x-0 group-hover:opacity-100', 2 ) .
				esc_html( $link['label'] ) . '</a></li>'; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped -- static SVG, escaped attributes.
		}
	}
}

/**
 * Footer list from a menu location, or the given default links when no menu is assigned.
 *
 * @param string $location Menu location.
 * @param array  $fallback Default items (label, url).
 */
function bj_footer_list( $location, $fallback ) {
	$items = bj_menu_items( $location );
	if ( null === $items ) {
		$items = $fallback;
	}
	foreach ( $items as $item ) {
		echo '<li><a' . bj_nav_attrs( $item ) . ' class="text-sm text-white/85 transition-colors hover:text-white">' . esc_html( $item['label'] ) . '</a></li>'; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped -- attributes are escaped in bj_nav_attrs().
	}
}

/**
 * Default footer links.
 *
 * @param string $list 'services' or 'destinations'.
 * @return array[]
 */
function bj_footer_defaults( $list ) {
	$labels = 'services' === $list ? wp_list_pluck( bj_services(), 'title' ) : wp_list_pluck( bj_destinations(), 'name' );
	$items  = array();
	foreach ( array_slice( $labels, 0, 9 ) as $label ) {
		$items[] = array(
			'label' => $label,
			'url'   => bj_url( $list ),
		);
	}
	return $items;
}
