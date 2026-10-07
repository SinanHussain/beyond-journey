<?php
/**
 * Holiday packages: a "Packages" section in the dashboard, the package details box, and the package list used by the
 * homepage cards and the Packages page.
 *
 * @package Beyond_Journey
 */

defined( 'ABSPATH' ) || exit;

/** Package detail fields: label, help text and input type ('text', 'textarea' or 'select'), in display order. */
function bj_package_fields() {
	return array(
		'location'   => array( __( 'Location', 'beyond-journey' ), __( 'Shown under the name, e.g. "Tbilisi, Georgia".', 'beyond-journey' ), 'text' ),
		'country'    => array( __( 'Country', 'beyond-journey' ), __( 'Used for the country filter on the Packages page, e.g. "Georgia".', 'beyond-journey' ), 'text' ),
		'price'      => array( __( 'Starting price (AED)', 'beyond-journey' ), __( 'Numbers only, e.g. 1490. Shown as "Starting AED 1,490*".', 'beyond-journey' ), 'text' ),
		'price_note' => array( __( 'Price note', 'beyond-journey' ), __( 'Shown after the price, e.g. "per adult".', 'beyond-journey' ), 'text' ),
		'duration'   => array( __( 'Duration', 'beyond-journey' ), __( 'e.g. 3N – 4D', 'beyond-journey' ), 'text' ),
		'hotel'      => array( __( 'Hotel', 'beyond-journey' ), __( 'e.g. 4* Hotel Accommodation', 'beyond-journey' ), 'text' ),
		'inclusions' => array( __( 'Inclusions', 'beyond-journey' ), __( 'e.g. Transfers and Excursions', 'beyond-journey' ), 'text' ),
		'badge'      => array( __( 'Label', 'beyond-journey' ), __( 'Optional label on the photo.', 'beyond-journey' ), 'select' ),
		'dates'      => array( __( 'Travel dates', 'beyond-journey' ), __( 'Optional, for fixed group departures, e.g. "24 – 28 Oct 2026".', 'beyond-journey' ), 'text' ),
		'summary'    => array( __( 'Short description', 'beyond-journey' ), __( 'One or two sentences, shown in the showcase and at the top of the package page.', 'beyond-journey' ), 'textarea' ),
		'about'      => array( __( 'About the place', 'beyond-journey' ), __( 'A general overview of the country or city (not the sights). Shown under Overview on the package page.', 'beyond-journey' ), 'textarea' ),
		'itinerary'  => array( __( 'Day-by-day plan', 'beyond-journey' ), __( 'One day per line, e.g. "Day 1 – Arrival: Meet and greet at the airport, transfer to the hotel." Leave empty to invite visitors to ask for the plan.', 'beyond-journey' ), 'textarea' ),
		'includes'   => array( __( "What's included", 'beyond-journey' ), __( 'One item per line. Leave empty to use the Hotel and Inclusions above.', 'beyond-journey' ), 'textarea' ),
		'excludes'   => array( __( 'Not included', 'beyond-journey' ), __( 'One item per line (optional).', 'beyond-journey' ), 'textarea' ),
		'hotels'     => array( __( 'Hotel details', 'beyond-journey' ), __( 'One hotel per line, e.g. "Tbilisi: 4* city hotel or similar" (optional).', 'beyond-journey' ), 'textarea' ),
	);
}

/** Labels that can be shown on a package photo. */
function bj_package_badges() {
	return array(
		''                => __( 'No label', 'beyond-journey' ),
		'Best Seller'     => __( 'Best Seller', 'beyond-journey' ),
		'New'             => __( 'New', 'beyond-journey' ),
		'Group Departure' => __( 'Group Departure', 'beyond-journey' ),
		'Limited Offer'   => __( 'Limited Offer', 'beyond-journey' ),
		'Sold Out'        => __( 'Sold Out', 'beyond-journey' ),
	);
}

/**
 * Whether a package field holds several lines.
 *
 * @param string $key Field key.
 * @return bool
 */
function bj_package_is_multiline( $key ) {
	$fields = bj_package_fields();
	return isset( $fields[ $key ] ) && 'textarea' === $fields[ $key ][2];
}

/** The packages the site starts with (also shown when no package has been added in the dashboard). */
function bj_package_defaults() {
	$credit = static function ( $artist, $license, $page ) {
		return array( 'artist' => $artist, 'license' => $license, 'page' => $page );
	};
	return array(
		array(
			'name'       => 'Georgios Georgia',
			'location'   => 'Georgia',
			'country'    => 'Georgia',
			'price'      => '1490',
			'price_note' => 'per adult',
			'duration'   => '3N – 4D',
			'hotel'      => '4* Hotel Accommodation',
			'inclusions' => 'Transfers and Excursions',
			'summary'    => 'Georgia sits where Europe meets Asia, between the Caucasus mountains and the Black Sea.',
			'about'      => 'Georgia sits where Europe meets Asia, between the Caucasus mountains and the Black Sea. It is known for its warm hospitality, an ancient wine-making tradition and hearty home-style food, and its mild seasons and short flight time make it an easy getaway from the UAE for most of the year.',
			'image'      => 'georgia.webp',
			'alt'        => 'The Ananuri fortress and its churches below green mountains, Georgia',
			'home'       => true,
			'credit'     => $credit( 'Bernard Gagnon', 'CC BY 4.0', 'https://commons.wikimedia.org/wiki/File:Ananuri_Fortress_02.jpg' ),
		),
		array(
			'name'       => 'Mesmerizing Maldives',
			'location'   => 'Maldives',
			'country'    => 'Maldives',
			'price'      => '4999',
			'price_note' => 'per adult',
			'duration'   => '4N – 5D',
			'hotel'      => '4* Hotel Accommodation',
			'inclusions' => 'Transfers and Excursions',
			'summary'    => 'The Maldives is an island nation in the Indian Ocean, made up of more than a thousand coral islands grouped into atolls.',
			'about'      => 'The Maldives is an island nation in the Indian Ocean, made up of more than a thousand coral islands grouped into atolls. Clear turquoise water, soft white sand and an unhurried pace make it one of the world\'s favourite places to unwind, whether for a honeymoon, a family break or a quiet escape.',
			'image'      => 'maldives.webp',
			'alt'        => 'A wooden walkway leading to overwater villas at sunrise in the Maldives',
			'home'       => true,
			'credit'     => $credit( 'Martin Falbisoner', 'CC BY-SA 4.0', 'https://commons.wikimedia.org/wiki/File:Diamonds_Thudufushi_Beach_and_Water_Villas,_May_2017_-14.jpg' ),
		),
		array(
			'name'       => 'Sri Lanka',
			'location'   => 'Sri Lanka',
			'country'    => 'Sri Lanka',
			'price'      => '1390',
			'price_note' => 'per adult',
			'duration'   => '3N – 4D',
			'hotel'      => '3* Hotel Accommodation',
			'inclusions' => 'Transfers and Excursions',
			'summary'    => 'Sri Lanka is a tropical island in the Indian Ocean, just south of India.',
			'about'      => 'Sri Lanka is a tropical island in the Indian Ocean, just south of India. In a short trip you can move from palm-lined beaches to cool green hill country, with a deep Buddhist heritage, rich wildlife, flavourful cuisine and famously warm hospitality along the way.',
			'image'      => 'sri-lanka.webp',
			'alt'        => 'The Nine Arch Bridge surrounded by forest in Ella, Sri Lanka',
			'home'       => true,
			'credit'     => $credit( 'Ishan shanuka', 'CC BY-SA 4.0', 'https://commons.wikimedia.org/wiki/File:Nine_arch_bridge,_Ella,_Sri_lanka.jpg' ),
		),
		array(
			'name'       => 'Armenia - Yerevan',
			'location'   => 'Yerevan, Armenia',
			'country'    => 'Armenia',
			'price'      => '1950',
			'price_note' => 'per adult',
			'duration'   => '3N – 4D',
			'hotel'      => '4* Hotel Accommodation',
			'inclusions' => 'Transfers and Excursions',
			'summary'    => 'Armenia is a small, mountainous country in the South Caucasus with one of the oldest cultural histories in the world, and Yerevan is its lively capital.',
			'about'      => 'Armenia is a small, mountainous country in the South Caucasus with one of the oldest cultural histories in the world, and Yerevan is its lively capital. It was the first nation to adopt Christianity as its state religion, and today it pairs ancient traditions with a relaxed café culture and generous hospitality.',
			'image'      => 'armenia.webp',
			'alt'        => 'The Garni Temple on a green hillside in Armenia',
			'home'       => false,
			'credit'     => $credit( 'Diego Delso', 'CC BY-SA 4.0', 'https://commons.wikimedia.org/wiki/File:Templo_de_Garni,_Armenia,_2016-10-02,_DD_03.jpg' ),
		),
		array(
			'name'       => 'Thailand Phuket',
			'location'   => 'Phuket, Thailand',
			'country'    => 'Thailand',
			'price'      => '1299',
			'price_note' => 'per adult',
			'duration'   => '3N – 4D',
			'hotel'      => '4* Hotel Accommodation',
			'inclusions' => 'Transfers and Excursions',
			'summary'    => 'Phuket is Thailand\'s largest island, set in the Andaman Sea off the country\'s south-west coast.',
			'about'      => 'Phuket is Thailand\'s largest island, set in the Andaman Sea off the country\'s south-west coast. It is known for long sandy beaches, warm water all year, easy-going island life and excellent Thai food, and it is the gateway to many of the smaller islands nearby.',
			'image'      => 'phuket.webp',
			'alt'        => 'Limestone cliffs around a turquoise bay at Phi Phi Leh, Thailand',
			'home'       => false,
			'credit'     => $credit( 'Diego Delso', 'CC BY-SA 3.0', 'https://commons.wikimedia.org/wiki/File:Isla_Phi_Phi_Lay,_Tailandia,_2013-08-19,_DD_04.JPG' ),
		),
		array(
			'name'       => 'Amazing Azerbaijan - Baku',
			'location'   => 'Baku, Azerbaijan',
			'country'    => 'Azerbaijan',
			'price'      => '1430',
			'price_note' => 'per adult',
			'duration'   => '3N – 4D',
			'hotel'      => '4* Hotel Accommodation',
			'inclusions' => 'Transfers and Excursions',
			'summary'    => 'Baku is the capital of Azerbaijan, on the western shore of the Caspian Sea.',
			'about'      => 'Baku is the capital of Azerbaijan, on the western shore of the Caspian Sea. The city blends a centuries-old walled heart with bold modern architecture, and the country, known as the Land of Fire, offers rich cuisine, a strong tea culture and a short, easy flight from the UAE.',
			'image'      => 'baku.webp',
			'alt'        => 'The Maiden Tower and old city courtyards in Baku, Azerbaijan',
			'home'       => false,
			'credit'     => $credit( 'Diego Delso', 'CC BY-SA 4.0', 'https://commons.wikimedia.org/wiki/File:Baku,_Azerbaiy%C3%A1n,_2016-09-26,_DD_211.jpg' ),
		),
		array(
			'name'       => 'Best of Japan – Tokyo and Osaka',
			'location'   => 'Tokyo & Osaka, Japan',
			'country'    => 'Japan',
			'price'      => '7999',
			'price_note' => 'per adult',
			'duration'   => '5N – 6D',
			'hotel'      => '4* Hotel Accommodation',
			'inclusions' => 'Transfers and Excursions',
			'summary'    => 'Japan is an island nation in East Asia where centuries-old traditions sit alongside some of the world\'s most modern cities.',
			'about'      => 'Japan is an island nation in East Asia where centuries-old traditions sit alongside some of the world\'s most modern cities. It is known for its punctual trains, outstanding food, spotless streets and the care given to every detail, which makes it rewarding for first-time and returning visitors alike.',
			'image'      => 'japan.webp',
			'alt'        => 'The Shibuya Crossing and its neon screens at night in Tokyo, Japan',
			'home'       => true,
			'credit'     => $credit( 'David Kernan', 'CC BY 4.0', 'https://commons.wikimedia.org/wiki/File:Shibuya_Crossing,_Aerial.jpg' ),
		),
	);
}

/** Registers the Packages post type. Each package has its own page at /package/<name>/. */
function bj_register_packages() {
	register_post_type(
		'bj_package',
		array(
			'labels'              => array(
				'name'               => __( 'Packages', 'beyond-journey' ),
				'singular_name'      => __( 'Package', 'beyond-journey' ),
				'add_new'            => __( 'Add New Package', 'beyond-journey' ),
				'add_new_item'       => __( 'Add New Package', 'beyond-journey' ),
				'all_items'          => __( 'All Packages', 'beyond-journey' ),
				'edit_item'          => __( 'Edit Package', 'beyond-journey' ),
				'new_item'           => __( 'New Package', 'beyond-journey' ),
				'search_items'       => __( 'Search Packages', 'beyond-journey' ),
				'not_found'          => __( 'No packages yet.', 'beyond-journey' ),
				'not_found_in_trash' => __( 'No packages in the trash.', 'beyond-journey' ),
				'featured_image'     => __( 'Package photo', 'beyond-journey' ),
				'set_featured_image' => __( 'Set package photo', 'beyond-journey' ),
			),
			'public'              => true,
			'publicly_queryable'  => true,
			'exclude_from_search' => false,
			'show_in_nav_menus'   => false,
			'has_archive'         => false,
			'show_ui'             => true,
			'show_in_menu'        => true,
			'show_in_rest'        => false,
			'menu_position'       => 25,
			'menu_icon'           => 'dashicons-palmtree',
			'supports'            => array( 'title', 'thumbnail', 'page-attributes' ),
			'capability_type'     => 'post',
			'map_meta_cap'        => true,
			'rewrite'             => array(
				'slug'       => 'package',
				'with_front' => false,
			),
		)
	);
}
add_action( 'init', 'bj_register_packages' );

/** Adds the package details box. */
function bj_package_meta_box() {
	add_meta_box( 'bj-package-details', __( 'Package details', 'beyond-journey' ), 'bj_package_meta_box_html', 'bj_package', 'normal', 'high' );
}
add_action( 'add_meta_boxes', 'bj_package_meta_box' );

/**
 * Package details box.
 *
 * @param WP_Post $post Package.
 */
function bj_package_meta_box_html( $post ) {
	wp_nonce_field( 'bj_package_save', 'bj_package_nonce' );
	echo '<table class="form-table" role="presentation"><tbody>';
	foreach ( bj_package_fields() as $key => $field ) {
		$value = get_post_meta( $post->ID, '_bj_' . $key, true );
		if ( '' === $value && 'price_note' === $key && 'auto-draft' === $post->post_status ) {
			$value = 'per adult';
		}
		echo '<tr><th scope="row"><label for="bj-' . esc_attr( $key ) . '">' . esc_html( $field[0] ) . '</label></th><td>';
		if ( 'textarea' === $field[2] ) {
			echo '<textarea id="bj-' . esc_attr( $key ) . '" name="bj_package[' . esc_attr( $key ) . ']" rows="' . ( 'summary' === $key ? 3 : 6 ) . '" class="large-text">' . esc_textarea( $value ) . '</textarea>';
		} elseif ( 'select' === $field[2] ) {
			echo '<select id="bj-' . esc_attr( $key ) . '" name="bj_package[' . esc_attr( $key ) . ']">';
			foreach ( bj_package_badges() as $option => $label ) {
				echo '<option value="' . esc_attr( $option ) . '"' . selected( $value, $option, false ) . '>' . esc_html( $label ) . '</option>';
			}
			echo '</select>';
		} else {
			echo '<input id="bj-' . esc_attr( $key ) . '" name="bj_package[' . esc_attr( $key ) . ']" type="text" class="regular-text" value="' . esc_attr( $value ) . '">';
		}
		echo '<p class="description">' . esc_html( $field[1] ) . '</p></td></tr>';
	}
	$home = get_post_meta( $post->ID, '_bj_home', true );
	echo '<tr><th scope="row">' . esc_html__( 'Homepage', 'beyond-journey' ) . '</th><td><label><input type="checkbox" name="bj_package[home]" value="1"' . checked( '1', $home, false ) . '> ' .
		esc_html__( 'Show this package on the homepage (the first 4 ticked packages are shown)', 'beyond-journey' ) . '</label></td></tr>';
	echo '</tbody></table>';
	echo '<p>' . esc_html__( 'Set the photo with "Package photo" on the right. Change the order with "Order" (lower numbers come first).', 'beyond-journey' ) . '</p>';
}

/**
 * Saves the package details box.
 *
 * @param int $post_id Package ID.
 */
function bj_package_save( $post_id ) {
	if ( ! isset( $_POST['bj_package_nonce'] ) || ! wp_verify_nonce( sanitize_key( $_POST['bj_package_nonce'] ), 'bj_package_save' ) ) {
		return;
	}
	if ( ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) || ! current_user_can( 'edit_post', $post_id ) ) {
		return;
	}
	$data = isset( $_POST['bj_package'] ) ? (array) wp_unslash( $_POST['bj_package'] ) : array(); // phpcs:ignore WordPress.Security.ValidatedSanitizedInput.InputNotSanitized -- sanitized per field below.
	foreach ( array_keys( bj_package_fields() ) as $key ) {
		$value = isset( $data[ $key ] ) ? $data[ $key ] : '';
		$value = bj_package_is_multiline( $key ) ? sanitize_textarea_field( $value ) : sanitize_text_field( $value );
		if ( 'price' === $key ) {
			$value = preg_replace( '/[^0-9.]/', '', $value );
		}
		update_post_meta( $post_id, '_bj_' . $key, $value );
	}
	update_post_meta( $post_id, '_bj_home', empty( $data['home'] ) ? '' : '1' );
}
add_action( 'save_post_bj_package', 'bj_package_save' );

/**
 * Adds the price and homepage columns to the package list.
 *
 * @param string[] $columns Columns.
 * @return string[]
 */
function bj_package_columns( $columns ) {
	$date = isset( $columns['date'] ) ? $columns['date'] : '';
	unset( $columns['date'] );
	$columns['bj_price'] = __( 'Starting price', 'beyond-journey' );
	$columns['bj_home']  = __( 'Homepage', 'beyond-journey' );
	if ( $date ) {
		$columns['date'] = $date;
	}
	return $columns;
}
add_filter( 'manage_bj_package_posts_columns', 'bj_package_columns' );

/**
 * Package list column values.
 *
 * @param string $column  Column key.
 * @param int    $post_id Package ID.
 */
function bj_package_column( $column, $post_id ) {
	if ( 'bj_price' === $column ) {
		$price = get_post_meta( $post_id, '_bj_price', true );
		echo esc_html( '' !== $price ? 'AED ' . bj_package_price( $price ) : '—' );
	} elseif ( 'bj_home' === $column ) {
		echo get_post_meta( $post_id, '_bj_home', true ) ? '&#10003;' : '';
	}
}
add_action( 'manage_bj_package_posts_custom_column', 'bj_package_column', 10, 2 );

/**
 * Price with thousands separators.
 *
 * @param string $price Price as typed.
 * @return string
 */
function bj_package_price( $price ) {
	$price = preg_replace( '/[^0-9.]/', '', (string) $price );
	if ( '' === $price ) {
		return '';
	}
	return number_format( (float) $price, floor( (float) $price ) == (float) $price ? 0 : 2 ); // phpcs:ignore Universal.Operators.StrictComparisons.LooseEqual -- comparing a float with its floor.
}

/** Adds the starting packages to the dashboard once, so they can be edited there. */
function bj_seed_packages() {
	if ( get_option( 'bj_packages_seeded' ) ) {
		return;
	}
	update_option( 'bj_packages_seeded', 1, false );
	$existing = get_posts(
		array(
			'post_type'      => 'bj_package',
			'post_status'    => 'any',
			'posts_per_page' => 1,
			'fields'         => 'ids',
		)
	);
	if ( $existing ) {
		return;
	}
	foreach ( bj_package_defaults() as $order => $pkg ) {
		$id = wp_insert_post(
			array(
				'post_type'   => 'bj_package',
				'post_status' => 'publish',
				'post_title'  => $pkg['name'],
				'menu_order'  => $order + 1,
			)
		);
		if ( ! $id || is_wp_error( $id ) ) {
			continue;
		}
		foreach ( array_keys( bj_package_fields() ) as $key ) {
			update_post_meta( $id, '_bj_' . $key, $pkg[ $key ] );
		}
		update_post_meta( $id, '_bj_home', $pkg['home'] ? '1' : '' );
		update_post_meta( $id, '_bj_image', $pkg['image'] );
		update_post_meta( $id, '_bj_alt', $pkg['alt'] );
		update_post_meta( $id, '_bj_credit', $pkg['credit'] );
	}
}
add_action( 'init', 'bj_seed_packages', 20 );

/**
 * URL of a bundled package photo.
 *
 * @param string $file File name in assets/images/packages.
 * @return string
 */
function bj_package_image_url( $file ) {
	$file = (string) $file;
	if ( '' === $file || false !== strpos( $file, '://' ) ) {
		return $file; // A full photo URL saved from Elementor.
	}
	return BJ_URI . '/assets/images/packages/' . rawurlencode( basename( $file ) );
}

/**
 * One package as shown on the site.
 *
 * @param WP_Post $post Package.
 * @return array
 */
function bj_package_item( $post ) {
	$item = array(
		'id'   => $post->ID,
		'name' => get_the_title( $post ),
		'url'  => 'publish' === $post->post_status ? (string) get_permalink( $post ) : '',
	);
	foreach ( array_keys( bj_package_fields() ) as $key ) {
		$item[ $key ] = (string) get_post_meta( $post->ID, '_bj_' . $key, true );
	}
	$item['home']     = (bool) get_post_meta( $post->ID, '_bj_home', true );
	$item['credit']   = array();
	$item['thumb_id'] = (int) get_post_thumbnail_id( $post );
	if ( has_post_thumbnail( $post ) ) {
		$item['image'] = (string) get_the_post_thumbnail_url( $post, 'large' );
		$item['full']  = (string) get_the_post_thumbnail_url( $post, 'full' );
		$item['alt']   = (string) get_post_meta( get_post_thumbnail_id( $post ), '_wp_attachment_image_alt', true );
	} else {
		$item['image']  = bj_package_image_url( get_post_meta( $post->ID, '_bj_image', true ) );
		$item['full']   = $item['image'];
		$item['alt']    = (string) get_post_meta( $post->ID, '_bj_alt', true );
		$item['credit'] = bj_package_credit_for( $item['image'] );
	}
	if ( '' === $item['alt'] ) {
		$item['alt'] = $item['name'];
	}
	return $item;
}

/**
 * The packages to show, in order.
 *
 * @param bool $home_only Only the packages ticked for the homepage (falls back to the first ones).
 * @param int  $limit     Maximum number, 0 for all.
 * @return array[] id, name, url, the detail fields, image (URL), full, alt, credit, home.
 */
function bj_packages( $home_only = false, $limit = 0 ) {
	$items = array();
	$posts = get_posts(
		array(
			'post_type'        => 'bj_package',
			'post_status'      => 'publish',
			'posts_per_page'   => 100,
			'orderby'          => array(
				'menu_order' => 'ASC',
				'date'       => 'ASC',
			),
			'suppress_filters' => false,
		)
	);
	if ( $posts ) {
		foreach ( $posts as $post ) {
			$items[] = bj_package_item( $post );
		}
	} else {
		foreach ( bj_package_defaults() as $pkg ) {
			$pkg          = array_merge( array_fill_keys( array_keys( bj_package_fields() ), '' ), $pkg );
			$pkg['id']    = 0;
			$pkg['url']   = '';
			$pkg['image'] = bj_package_image_url( $pkg['image'] );
			$pkg['full']  = $pkg['image'];
			$items[]      = $pkg;
		}
	}

	if ( $home_only ) {
		$ticked = array_values(
			array_filter(
				$items,
				static function ( $item ) {
					return ! empty( $item['home'] );
				}
			)
		);
		$items  = $ticked ? $ticked : $items;
	}
	return $limit > 0 ? array_slice( $items, 0, $limit ) : $items;
}

/**
 * What's included: the typed list, or the Hotel and Inclusions fields split into items.
 *
 * @param array $pkg Package.
 * @return string[]
 */
function bj_package_includes( $pkg ) {
	$lines = bj_lines( isset( $pkg['includes'] ) ? $pkg['includes'] : '' );
	if ( $lines ) {
		return $lines;
	}
	if ( '' !== trim( $pkg['hotel'] ) ) {
		$lines[] = trim( $pkg['hotel'] );
	}
	foreach ( preg_split( '/\s*(?:,|&|\band\b)\s*/i', (string) $pkg['inclusions'] ) as $part ) {
		if ( '' !== trim( $part ) ) {
			$lines[] = ucfirst( trim( $part ) );
		}
	}
	return $lines;
}

/**
 * Day-by-day plan: "Day 1 – Arrival: details" lines as day, title and text.
 *
 * @param array $pkg Package.
 * @return array[]
 */
function bj_package_itinerary( $pkg ) {
	$days = array();
	foreach ( bj_lines( isset( $pkg['itinerary'] ) ? $pkg['itinerary'] : '' ) as $i => $line ) {
		$head = $line;
		$text = '';
		if ( false !== strpos( $line, ':' ) ) {
			list( $head, $text ) = array_map( 'trim', explode( ':', $line, 2 ) );
		}
		$day   = sprintf( /* translators: %d: day number. */ __( 'Day %d', 'beyond-journey' ), $i + 1 );
		$title = $head;
		if ( preg_match( '/^(day\s*\d+)\s*[–—-]?\s*(.*)$/iu', $head, $m ) ) {
			$day   = ucfirst( strtolower( preg_replace( '/\s+/', ' ', $m[1] ) ) );
			$title = $m[2];
		}
		$days[] = array(
			'day'   => $day,
			'title' => $title,
			'text'  => $text,
		);
	}
	return $days;
}

/**
 * CSS class suffix of a label, e.g. "sold-out".
 *
 * @param string $badge Label.
 * @return string
 */
function bj_package_badge_class( $badge ) {
	return sanitize_title( $badge );
}

/**
 * "Starting AED 1,490*" price line parts.
 *
 * @param array $pkg Package.
 * @return string Price HTML (escaped), or ''.
 */
function bj_package_price_html( $pkg ) {
	$price = bj_package_price( $pkg['price'] );
	if ( '' === $price ) {
		return '';
	}
	return esc_html__( 'Starting', 'beyond-journey' ) . ' <strong>AED ' . esc_html( $price ) . '*</strong>' .
		( '' !== trim( $pkg['price_note'] ) ? ' ' . esc_html( $pkg['price_note'] ) : '' );
}

/**
 * Photo credits for the bundled package photos in use.
 *
 * @param array[] $packages Packages.
 */
function bj_package_credits( $packages ) {
	$parts = array();
	foreach ( $packages as $pkg ) {
		if ( empty( $pkg['credit']['artist'] ) ) {
			continue;
		}
		$parts[] = esc_html( $pkg['name'] ) . ': <a href="' . esc_url( $pkg['credit']['page'] ) . '" target="_blank" rel="noopener">' .
			esc_html( $pkg['credit']['artist'] ) . '</a> (' . esc_html( $pkg['credit']['license'] ) . ')';
	}
	if ( $parts ) {
		echo '<p id="photo-credits" class="pkg-credits">' . esc_html__( 'Photos via Wikimedia Commons', 'beyond-journey' ) . ' &middot; ' . implode( ' &middot; ', $parts ) . '</p>'; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped -- escaped above.
	}
}

/**
 * Photo credit of a bundled package photo, looked up by its file name.
 *
 * @param string $url Photo URL or file name.
 * @return array artist, license, page — or empty.
 */
function bj_package_credit_for( $url ) {
	$url = (string) $url;
	if ( false === strpos( $url, '/assets/images/packages/' ) && false !== strpos( $url, '/' ) ) {
		return array();
	}
	$file = basename( (string) wp_parse_url( $url, PHP_URL_PATH ) );
	foreach ( bj_package_defaults() as $pkg ) {
		if ( $pkg['image'] === $file ) {
			return $pkg['credit'];
		}
	}
	return array();
}

/**
 * The packages as rows of the Elementor "Packages" list (the Packages page widget).
 *
 * @return array[]
 */
function bj_package_rows() {
	$rows = array();
	foreach ( bj_packages() as $pkg ) {
		$row = array();
		foreach ( array_merge( array( 'name' ), array_keys( bj_package_fields() ), array( 'alt' ) ) as $key ) {
			$row[ $key ] = isset( $pkg[ $key ] ) ? (string) $pkg[ $key ] : '';
		}
		$row['image'] = array(
			'url' => $pkg['full'],
			'id'  => ! empty( $pkg['thumb_id'] ) ? (int) $pkg['thumb_id'] : '',
		);
		$row['home']  = empty( $pkg['home'] ) ? '' : 'yes';
		$rows[]       = $row;
	}
	return $rows;
}

/**
 * Packages from the Elementor list (used while editing, so the preview follows the changes).
 *
 * @param array[] $rows List rows.
 * @return array[] Same shape as bj_packages().
 */
function bj_packages_from_rows( $rows ) {
	$items = array();
	foreach ( (array) $rows as $row ) {
		if ( ! is_array( $row ) || '' === trim( isset( $row['name'] ) ? (string) $row['name'] : '' ) ) {
			continue;
		}
		$item = array(
			'id'   => 0,
			'url'  => '',
			'name' => (string) $row['name'],
		);
		foreach ( array_keys( bj_package_fields() ) as $key ) {
			$item[ $key ] = isset( $row[ $key ] ) ? (string) $row[ $key ] : '';
		}
		$media = isset( $row['image'] ) ? $row['image'] : '';
		$full  = bj_media_src( $media, 1920 );
		$item['image'] = bj_media_src( $media, 900 );
		$item['full']   = $full ? $full : $item['image'];
		$item['alt']    = bj_media_alt( $media, isset( $row['alt'] ) ? $row['alt'] : '' );
		$item['alt']    = '' !== $item['alt'] ? $item['alt'] : $item['name'];
		$item['home']   = isset( $row['home'] ) && 'yes' === $row['home'];
		$item['credit'] = ( is_array( $media ) && ! empty( $media['id'] ) ) ? array() : bj_package_credit_for( $item['image'] );
		$items[]        = $item;
	}
	return $items;
}

/**
 * Saves the Elementor package list to Dashboard > Packages (same order). Packages removed from the list are
 * switched to Draft, never deleted.
 *
 * @param array[] $rows List rows.
 */
function bj_package_sync_rows( $rows ) {
	$rows = array_values(
		array_filter(
			(array) $rows,
			static function ( $row ) {
				return is_array( $row ) && '' !== trim( isset( $row['name'] ) ? (string) $row['name'] : '' );
			}
		)
	);
	if ( ! $rows ) {
		return; // An empty list never hides every package.
	}
	$posts = get_posts(
		array(
			'post_type'      => 'bj_package',
			'post_status'    => 'publish',
			'posts_per_page' => -1,
			'orderby'        => array(
				'menu_order' => 'ASC',
				'date'       => 'ASC',
			),
		)
	);
	foreach ( $rows as $i => $row ) {
		$args = array(
			'post_type'   => 'bj_package',
			'post_status' => 'publish',
			'post_title'  => sanitize_text_field( $row['name'] ),
			'menu_order'  => $i + 1,
		);
		if ( isset( $posts[ $i ] ) ) {
			$args['ID'] = $posts[ $i ]->ID;
			$id         = wp_update_post( $args );
		} else {
			$id = wp_insert_post( $args );
		}
		if ( ! $id || is_wp_error( $id ) ) {
			continue;
		}
		foreach ( array_keys( bj_package_fields() ) as $key ) {
			$value = isset( $row[ $key ] ) ? (string) $row[ $key ] : '';
			$value = bj_package_is_multiline( $key ) ? sanitize_textarea_field( $value ) : sanitize_text_field( $value );
			if ( 'price' === $key ) {
				$value = preg_replace( '/[^0-9.]/', '', $value );
			}
			update_post_meta( $id, '_bj_' . $key, $value );
		}
		update_post_meta( $id, '_bj_home', ( isset( $row['home'] ) && 'yes' === $row['home'] ) ? '1' : '' );
		update_post_meta( $id, '_bj_alt', sanitize_text_field( isset( $row['alt'] ) ? $row['alt'] : '' ) );
		$media = isset( $row['image'] ) ? $row['image'] : array();
		if ( is_array( $media ) && ! empty( $media['id'] ) ) {
			set_post_thumbnail( $id, (int) $media['id'] );
		} else {
			delete_post_thumbnail( $id );
			$url = is_array( $media ) ? ( isset( $media['url'] ) ? (string) $media['url'] : '' ) : (string) $media;
			update_post_meta( $id, '_bj_image', false !== strpos( $url, '/assets/images/packages/' ) ? basename( (string) wp_parse_url( $url, PHP_URL_PATH ) ) : esc_url_raw( $url ) );
		}
	}
	$count = count( $posts );
	for ( $j = count( $rows ); $j < $count; $j++ ) {
		wp_update_post(
			array(
				'ID'          => $posts[ $j ]->ID,
				'post_status' => 'draft',
			)
		);
	}
}

/**
 * After an Elementor save: copies the Packages page widget's list into Dashboard > Packages, then drops the copy
 * from the page so the list always opens with the current packages.
 *
 * @param \Elementor\Core\Base\Document $document Saved document.
 */
function bj_package_elementor_sync( $document ) {
	$post = $document->get_post();
	if ( ! $post || 'publish' !== $post->post_status || wp_is_post_revision( $post ) || wp_is_post_autosave( $post ) ) {
		return;
	}
	$elements = $document->get_elements_data();
	$found    = false;
	$walk     = static function ( &$els ) use ( &$walk, &$found ) {
		foreach ( $els as &$el ) {
			if ( isset( $el['widgetType'] ) && 'bj-packages-showcase' === $el['widgetType'] && isset( $el['settings']['packages'] ) ) {
				bj_package_sync_rows( $el['settings']['packages'] );
				unset( $el['settings']['packages'] );
				$found = true;
			}
			if ( ! empty( $el['elements'] ) ) {
				$walk( $el['elements'] );
			}
		}
	};
	$walk( $elements );
	if ( $found ) {
		update_post_meta( $post->ID, '_elementor_data', wp_slash( wp_json_encode( $elements ) ) );
		delete_post_meta( $post->ID, '_elementor_element_cache' );
	}
}
add_action( 'elementor/document/after_save', 'bj_package_elementor_sync' );

/**
 * Opens the Packages page widget's list with the current packages.
 *
 * @param array  $defaults Widget defaults.
 * @param string $section  Section name.
 * @return array
 */
function bj_package_widget_defaults( $defaults, $section ) {
	if ( 'packages-showcase' === $section ) {
		$defaults['packages'] = bj_package_rows();
	}
	return $defaults;
}
add_filter( 'bj_widget_defaults', 'bj_package_widget_defaults', 10, 2 );

/** Elementor editor link of the Packages page, or ''. */
function bj_packages_elementor_url() {
	$page = get_page_by_path( 'packages' );
	if ( ! $page || ! bj_elementor_ready() ) {
		return '';
	}
	return admin_url( 'post.php?post=' . (int) $page->ID . '&action=elementor' );
}

/** "Edit with Elementor" button above the package list in the dashboard. */
function bj_packages_admin_notice() {
	$screen = function_exists( 'get_current_screen' ) ? get_current_screen() : null;
	if ( ! $screen || 'bj_package' !== $screen->post_type ) {
		return;
	}
	$url = bj_packages_elementor_url();
	if ( ! $url ) {
		return;
	}
	echo '<div class="notice notice-info"><p>' . esc_html__( 'You can also edit all packages on the Packages page with Elementor (open the "Holiday Packages (showcase page)" widget > Packages). Changes saved there update this list.', 'beyond-journey' ) .
		' <a class="button button-primary" href="' . esc_url( $url ) . '">' . esc_html__( 'Edit with Elementor', 'beyond-journey' ) . '</a></p></div>';
}
add_action( 'admin_notices', 'bj_packages_admin_notice' );
