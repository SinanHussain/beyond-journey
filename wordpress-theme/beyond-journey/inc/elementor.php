<?php
/**
 * Elementor integration: a "Beyond Journey" widget for every section, and the page layout builder.
 *
 * @package Beyond_Journey
 */

defined( 'ABSPATH' ) || exit;

/**
 * Field definition helper for bj_widget_schemas().
 *
 * @param string $type  text, textarea, lines, url, media, switcher, select or repeater.
 * @param string $label Panel label.
 * @param array  $extra Extra keys (options, fields, title, description).
 * @return array
 */
function bj_field( $type, $label, $extra = array() ) {
	return array_merge(
		array(
			'type'  => $type,
			'label' => $label,
		),
		$extra
	);
}

/**
 * Editable fields of every section widget, grouped into panel sections. Defaults come from bj_section_defaults().
 *
 * @return array[]
 */
function bj_widget_schemas() {
	static $schemas = null;
	if ( null !== $schemas ) {
		return $schemas;
	}

	$bg_light  = array(
		'bg-white'           => __( 'White', 'beyond-journey' ),
		'bg-brand-surface'   => __( 'Light grey', 'beyond-journey' ),
		'bg-brand-blue-mist' => __( 'Blue mist', 'beyond-journey' ),
		'bg-brand-blue-pale' => __( 'Pale blue', 'beyond-journey' ),
	);
	$bg_dark   = array(
		'bg-brand-blue'      => __( 'Brand blue', 'beyond-journey' ),
		'bg-brand-blue-dark' => __( 'Dark blue', 'beyond-journey' ),
	);
	$icons     = array(
		'sun'      => __( 'Sun', 'beyond-journey' ),
		'building' => __( 'Buildings', 'beyond-journey' ),
		'plane'    => __( 'Plane', 'beyond-journey' ),
		'hotel'    => __( 'Hotel', 'beyond-journey' ),
		'id-card'  => __( 'ID card', 'beyond-journey' ),
		'truck'    => __( 'Transport', 'beyond-journey' ),
		'pin'      => __( 'Map pin', 'beyond-journey' ),
		'support'  => __( 'Support chat', 'beyond-journey' ),
		'grid'     => __( 'Grid', 'beyond-journey' ),
		'user'     => __( 'Person', 'beyond-journey' ),
		'users'    => __( 'Group', 'beyond-journey' ),
		'user-group' => __( 'Team', 'beyond-journey' ),
		'clock'    => __( 'Clock', 'beyond-journey' ),
		'language' => __( 'Languages', 'beyond-journey' ),
		'chat'     => __( 'Chat', 'beyond-journey' ),
		'eye'      => __( 'Eye', 'beyond-journey' ),
		'shield'   => __( 'Shield', 'beyond-journey' ),
		'globe'    => __( 'Globe', 'beyond-journey' ),
		'heart'    => __( 'Heart', 'beyond-journey' ),
		'bolt'     => __( 'Lightning', 'beyond-journey' ),
		'rocket'   => __( 'Rocket', 'beyond-journey' ),
		'phone'    => __( 'Phone', 'beyond-journey' ),
		'mail'     => __( 'Email', 'beyond-journey' ),
		'check'    => __( 'Check mark', 'beyond-journey' ),
	);
	$positions = array(
		'object-center'       => __( 'Center', 'beyond-journey' ),
		'object-[60%_center]' => __( 'Center right', 'beyond-journey' ),
		'object-[70%_center]' => __( 'Right', 'beyond-journey' ),
		'object-[78%_center]' => __( 'Far right', 'beyond-journey' ),
		'object-[68%_45%]'    => __( 'Right, upper', 'beyond-journey' ),
		'object-[62%_45%]'    => __( 'Right, slightly up', 'beyond-journey' ),
		'object-[62%_58%]'    => __( 'Right, slightly down', 'beyond-journey' ),
		'object-[65%_60%]'    => __( 'Right, lower', 'beyond-journey' ),
	);

	$text     = static function ( $label, $extra = array() ) {
		return bj_field( 'text', $label, $extra );
	};
	$area     = static function ( $label, $extra = array() ) {
		return bj_field( 'textarea', $label, $extra );
	};
	$link     = static function ( $label ) {
		return bj_field( 'url', $label );
	};
	$photo    = static function ( $label = '' ) {
		return bj_field( 'media', $label ? $label : __( 'Photo', 'beyond-journey' ) );
	};
	$alt      = $text( __( 'Photo description (for screen readers and Google)', 'beyond-journey' ) );
	$toggle   = static function ( $label ) {
		return bj_field( 'switcher', $label );
	};
	$eyebrow  = $text( __( 'Small label above the title', 'beyond-journey' ) );
	$title    = $text( __( 'Title', 'beyond-journey' ) );
	$blue     = $text( __( 'Title, blue part', 'beyond-journey' ) );
	$orange   = $text( __( 'Title, orange part', 'beyond-journey' ) );
	$lead     = $area( __( 'Intro text', 'beyond-journey' ) );
	$bg       = bj_field( 'select', __( 'Background', 'beyond-journey' ), array( 'options' => $bg_light ) );
	$icon     = bj_field( 'select', __( 'Icon', 'beyond-journey' ), array( 'options' => $icons ) );
	$dest_rep = bj_field(
		'repeater',
		__( 'Destinations', 'beyond-journey' ),
		array(
			'title'  => 'name',
			'fields' => array(
				'name'        => $text( __( 'Name', 'beyond-journey' ) ),
				'region'      => $text( __( 'Region', 'beyond-journey' ) ),
				'description' => $area( __( 'Short description', 'beyond-journey' ) ),
				'image'       => $photo(),
				'alt'         => $alt,
			),
		)
	);
	$lists    = __( 'One item per line.', 'beyond-journey' );

	$schemas = array(
		'hero'                   => array(
			'title'  => __( 'Home Hero Slideshow', 'beyond-journey' ),
			'icon'   => 'eicon-slider-full-screen',
			'groups' => array(
				__( 'Text', 'beyond-journey' )      => array(
					'eyebrow'   => $eyebrow,
					'title'     => $title,
					'highlight' => $text( __( 'Title, second line (orange)', 'beyond-journey' ) ),
					'text'      => $area( __( 'Text', 'beyond-journey' ) ),
				),
				__( 'Buttons', 'beyond-journey' )   => array(
					'button1_text' => $text( __( 'Orange button text', 'beyond-journey' ) ),
					'button1_url'  => $link( __( 'Orange button link', 'beyond-journey' ) ),
					'button2_text' => $text( __( 'Second button text', 'beyond-journey' ) ),
					'button2_url'  => $link( __( 'Second button link', 'beyond-journey' ) ),
				),
				__( 'Slideshow', 'beyond-journey' ) => array(
					'scroll_text' => $text( __( 'Scroll-down label', 'beyond-journey' ), array( 'description' => __( 'Leave empty to hide the arrow under the banner.', 'beyond-journey' ) ) ),
					'slides'      => bj_field(
						'repeater',
						__( 'Photos', 'beyond-journey' ),
						array(
							'title'  => 'alt',
							'fields' => array(
								'image' => $photo(),
								'alt'   => $alt,
								'crop'  => bj_field(
									'select',
									__( 'Photo focus', 'beyond-journey' ),
									array(
										'options' => array(
											''  => __( 'Centre', 'beyond-journey' ),
											'1' => __( 'Focus 1', 'beyond-journey' ),
											'2' => __( 'Focus 2', 'beyond-journey' ),
											'4' => __( 'Focus 4', 'beyond-journey' ),
											'5' => __( 'Focus 5', 'beyond-journey' ),
											'6' => __( 'Focus 6', 'beyond-journey' ),
											'7' => __( 'Focus 7', 'beyond-journey' ),
											'8' => __( 'Focus 8', 'beyond-journey' ),
											'9' => __( 'Focus 9', 'beyond-journey' ),
											'10' => __( 'Focus 10', 'beyond-journey' ),
										),
									)
								),
							),
						)
					),
				),
			),
		),
		'page-hero'              => array(
			'title'  => __( 'Page Banner', 'beyond-journey' ),
			'icon'   => 'eicon-header',
			'groups' => array(
				__( 'Banner', 'beyond-journey' ) => array(
					'title'     => $title,
					'highlight' => $orange,
					'subtitle'  => $area( __( 'Text', 'beyond-journey' ) ),
					'slides'    => bj_field(
						'repeater',
						__( 'Photos', 'beyond-journey' ),
						array(
							'title'       => 'alt',
							'description' => __( 'Several photos crossfade. While the default photos are used, the page\'s Featured Image replaces them when one is set.', 'beyond-journey' ),
							'fields'      => array(
								'image'    => $photo(),
								'alt'      => $alt,
								'position' => bj_field( 'select', __( 'Photo focus', 'beyond-journey' ), array( 'options' => $positions ) ),
							),
						)
					),
				),
			),
		),
		'about-intro'            => array(
			'title'  => __( 'About Intro', 'beyond-journey' ),
			'icon'   => 'eicon-info-box',
			'groups' => array(
				__( 'Text', 'beyond-journey' )    => array(
					'eyebrow'   => $eyebrow,
					'title'     => $title,
					'highlight' => $text( __( 'Title, second line (blue)', 'beyond-journey' ) ),
					'lead'      => $area( __( 'First paragraph', 'beyond-journey' ) ),
					'text'      => $area( __( 'Second paragraph', 'beyond-journey' ) ),
					'tagline'   => $text( __( 'Closing line', 'beyond-journey' ) ),
				),
				__( 'Buttons', 'beyond-journey' ) => array(
					'button1_text' => $text( __( 'Blue button text', 'beyond-journey' ) ),
					'button1_url'  => $link( __( 'Blue button link', 'beyond-journey' ) ),
					'button2_text' => $text( __( 'White button text', 'beyond-journey' ) ),
					'button2_url'  => $link( __( 'White button link', 'beyond-journey' ) ),
				),
				__( 'Photo', 'beyond-journey' )   => array(
					'image'       => $photo(),
					'alt'         => $alt,
				),
			),
		),
		'inbound'                => array(
			'title'  => __( 'Inbound & Outbound', 'beyond-journey' ),
			'icon'   => 'eicon-exchange',
			'groups' => array(
				__( 'Heading', 'beyond-journey' ) => array(
					'eyebrow'   => $eyebrow,
					'title'     => $title,
					'highlight' => $blue,
					'lead'      => $lead,
				),
				__( 'Cards', 'beyond-journey' )   => array(
					'cards' => bj_field(
						'repeater',
						__( 'Cards', 'beyond-journey' ),
						array(
							'title'  => 'title',
							'fields' => array(
								'tag'       => $text( __( 'Badge', 'beyond-journey' ) ),
								'direction' => bj_field( 'select', __( 'Badge arrow', 'beyond-journey' ), array( 'options' => array( 'arrow-down' => __( 'Down (inbound)', 'beyond-journey' ), 'arrow-up' => __( 'Up (outbound)', 'beyond-journey' ) ) ) ),
								'title'     => $title,
								'text'      => $area( __( 'Text', 'beyond-journey' ) ),
								'points'    => bj_field( 'lines', __( 'Bullet list', 'beyond-journey' ), array( 'description' => $lists ) ),
								'link_text' => $text( __( 'Link text', 'beyond-journey' ) ),
								'link_url'  => $link( __( 'Link', 'beyond-journey' ) ),
								'image'     => $photo(),
								'alt'       => $alt,
							),
						)
					),
				),
				__( 'Layout', 'beyond-journey' )  => array( 'bg' => $bg ),
			),
		),
		'services'               => array(
			'title'  => __( 'Services', 'beyond-journey' ),
			'icon'   => 'eicon-gallery-grid',
			'groups' => array(
				__( 'Heading', 'beyond-journey' )  => array(
					'show_heading' => $toggle( __( 'Show heading', 'beyond-journey' ) ),
					'eyebrow'      => $eyebrow,
					'title'        => $title,
					'highlight'    => $blue,
					'lead'         => $lead,
				),
				__( 'Services', 'beyond-journey' ) => array(
					'layout'     => bj_field(
						'select',
						__( 'Layout', 'beyond-journey' ),
						array(
							'options' => array(
								'grid'    => __( 'Grid', 'beyond-journey' ),
								'grouped' => __( 'Grouped by category', 'beyond-journey' ),
								'pillars' => __( 'Three photo cards', 'beyond-journey' ),
							),
						)
					),
					'services'   => bj_field(
						'repeater',
						__( 'Services', 'beyond-journey' ),
						array(
							'title'  => 'title',
							'fields' => array(
								'title'       => $title,
								'category'    => $text( __( 'Category (for the grouped layout)', 'beyond-journey' ) ),
								'description' => $area( __( 'Description', 'beyond-journey' ) ),
								'image'       => $photo(),
								'alt'         => $alt,
							),
						)
					),
					'tile_url'   => $link( __( 'Where a service tile links to', 'beyond-journey' ) ),
					'categories' => bj_field(
						'repeater',
						__( 'Categories (grouped layout)', 'beyond-journey' ),
						array(
							'title'  => 'name',
							'fields' => array(
								'name'  => $text( __( 'Name', 'beyond-journey' ) ),
								'blurb' => $area( __( 'Short text', 'beyond-journey' ) ),
							),
						)
					),
				),
				__( 'Photo cards', 'beyond-journey' ) => array(
					'pillars'    => bj_field(
						'repeater',
						__( 'Photo cards', 'beyond-journey' ),
						array(
							'title'       => 'title',
							'description' => __( 'Used by the "Three photo cards" layout. Each card lists the services whose category matches.', 'beyond-journey' ),
							'fields'      => array(
								'step'        => $text( __( 'Small label', 'beyond-journey' ) ),
								'title'       => $title,
								'category'    => $text( __( 'Category to list', 'beyond-journey' ) ),
								'description' => $area( __( 'Description', 'beyond-journey' ) ),
								'image'       => $photo(),
								'alt'         => $alt,
							),
						)
					),
					'pillar_cta' => $text( __( 'Button text', 'beyond-journey' ) ),
					'pillar_url' => $link( __( 'Button link', 'beyond-journey' ) ),
				),
				__( 'Button', 'beyond-journey' )   => array(
					'show_cta' => $toggle( __( 'Show button', 'beyond-journey' ) ),
					'cta_text' => $text( __( 'Button text', 'beyond-journey' ) ),
					'cta_url'  => $link( __( 'Button link', 'beyond-journey' ) ),
				),
				__( 'Layout', 'beyond-journey' )   => array( 'bg' => $bg ),
			),
		),
		'why-us'                 => array(
			'title'  => __( 'Why Us', 'beyond-journey' ),
			'icon'   => 'eicon-check-circle',
			'groups' => array(
				__( 'Heading', 'beyond-journey' ) => array(
					'show_heading' => $toggle( __( 'Show heading', 'beyond-journey' ) ),
					'eyebrow'      => $eyebrow,
					'title'        => $title,
					'highlight'    => $orange,
					'lead'         => $lead,
				),
				__( 'Reasons', 'beyond-journey' ) => array(
					'features' => bj_field(
						'repeater',
						__( 'Reasons', 'beyond-journey' ),
						array(
							'title'  => 'title',
							'fields' => array(
								'number'      => $text( __( 'Number', 'beyond-journey' ) ),
								'icon'        => $icon,
								'title'       => $title,
								'description' => $area( __( 'Description', 'beyond-journey' ) ),
							),
						)
					),
				),
				__( 'Button', 'beyond-journey' )  => array(
					'show_cta' => $toggle( __( 'Show button', 'beyond-journey' ) ),
					'cta_text' => $text( __( 'Button text', 'beyond-journey' ) ),
					'cta_url'  => $link( __( 'Button link', 'beyond-journey' ) ),
				),
				__( 'Layout', 'beyond-journey' )  => array( 'bg' => bj_field( 'select', __( 'Background', 'beyond-journey' ), array( 'options' => $bg_dark ) ) ),
			),
		),
		'dmc'                    => array(
			'title'  => __( 'DMC & Ground Handling', 'beyond-journey' ),
			'icon'   => 'eicon-map-pin',
			'groups' => array(
				__( 'Text', 'beyond-journey' )    => array(
					'eyebrow'   => $eyebrow,
					'title'     => $title,
					'highlight' => $text( __( 'Title, second line (blue)', 'beyond-journey' ) ),
					'text1'     => $area( __( 'First paragraph', 'beyond-journey' ) ),
					'text2'     => $area( __( 'Second paragraph', 'beyond-journey' ) ),
					'text3'     => $area( __( 'Third paragraph', 'beyond-journey' ) ),
				),
				__( 'Lists', 'beyond-journey' )   => array(
					'items'              => bj_field( 'lines', __( 'Services checklist', 'beyond-journey' ), array( 'description' => $lists ) ),
					'multilingual_title' => $text( __( 'Multilingual heading', 'beyond-journey' ) ),
					'multilingual_text'  => $area( __( 'Multilingual text', 'beyond-journey' ) ),
				),
				__( 'Buttons', 'beyond-journey' ) => array(
					'button1_text' => $text( __( 'Orange button text', 'beyond-journey' ) ),
					'button1_url'  => $link( __( 'Orange button link', 'beyond-journey' ) ),
					'show_button2' => $toggle( __( 'Show white button', 'beyond-journey' ) ),
					'button2_text' => $text( __( 'White button text', 'beyond-journey' ) ),
					'button2_url'  => $link( __( 'White button link', 'beyond-journey' ) ),
				),
				__( 'Photo', 'beyond-journey' )   => array(
					'image'       => $photo( __( 'Photo (a cut-out PNG or WebP with a transparent background works best)', 'beyond-journey' ) ),
					'alt'         => $alt,
					'badge_title' => $text( __( 'Badge title', 'beyond-journey' ) ),
					'badge_text'  => $area( __( 'Badge text', 'beyond-journey' ) ),
				),
			),
		),
		'destinations'           => array(
			'title'  => __( 'Destinations Carousel', 'beyond-journey' ),
			'icon'   => 'eicon-slider-push',
			'groups' => array(
				__( 'Heading', 'beyond-journey' )      => array(
					'eyebrow'   => $eyebrow,
					'title'     => $title,
					'highlight' => $blue,
					'lead'      => $lead,
				),
				__( 'Destinations', 'beyond-journey' ) => array(
					'destinations' => $dest_rep,
					'card_url'     => $link( __( 'Cards link to', 'beyond-journey' ) ),
				),
				__( 'Button', 'beyond-journey' )       => array(
					'button_text' => $text( __( 'Button text', 'beyond-journey' ) ),
					'button_url'  => $link( __( 'Button link', 'beyond-journey' ) ),
				),
			),
		),
		'hotels'                 => array(
			'title'  => __( 'Premium Hotels', 'beyond-journey' ),
			'icon'   => 'eicon-posts-carousel',
			'groups' => array(
				__( 'Text', 'beyond-journey' )   => array(
					'eyebrow'     => $eyebrow,
					'title'       => $title,
					'highlight'   => $blue,
					'text'        => $area( __( 'Text', 'beyond-journey' ) ),
					'button_text' => $text( __( 'Button text', 'beyond-journey' ) ),
					'button_url'  => $link( __( 'Button link', 'beyond-journey' ) ),
				),
				__( 'Hotels', 'beyond-journey' ) => array(
					'hotels'   => bj_field(
						'repeater',
						__( 'Hotels', 'beyond-journey' ),
						array(
							'title'  => 'name',
							'fields' => array(
								'name'     => $text( __( 'Hotel name', 'beyond-journey' ) ),
								'location' => $text( __( 'Location', 'beyond-journey' ) ),
								'image'    => $photo(),
								'alt'      => $alt,
								'features' => bj_field( 'lines', __( 'Features', 'beyond-journey' ), array( 'description' => $lists ) ),
							),
						)
					),
					'card_url' => $link( __( 'Cards link to', 'beyond-journey' ) ),
				),
			),
		),
		'process'                => array(
			'title'  => __( 'How We Work', 'beyond-journey' ),
			'icon'   => 'eicon-number-field',
			'groups' => array(
				__( 'Heading', 'beyond-journey' ) => array(
					'eyebrow'   => $eyebrow,
					'title'     => $title,
					'highlight' => $blue,
				),
				__( 'Steps', 'beyond-journey' )   => array(
					'steps' => bj_field(
						'repeater',
						__( 'Steps', 'beyond-journey' ),
						array(
							'title'  => 'title',
							'fields' => array(
								'number'      => $text( __( 'Number', 'beyond-journey' ) ),
								'title'       => $title,
								'description' => $area( __( 'Description', 'beyond-journey' ) ),
							),
						)
					),
				),
				__( 'Layout', 'beyond-journey' )  => array( 'bg' => $bg ),
			),
		),
		'vision-mission'         => array(
			'title'  => __( 'Vision & Mission', 'beyond-journey' ),
			'icon'   => 'eicon-flip-box',
			'groups' => array(
				__( 'Cards', 'beyond-journey' )  => array(
					'pillars' => bj_field(
						'repeater',
						__( 'Cards', 'beyond-journey' ),
						array(
							'title'  => 'title',
							'fields' => array(
								'eyebrow' => $eyebrow,
								'color'   => bj_field( 'select', __( 'Colour', 'beyond-journey' ), array( 'options' => array( 'orange' => __( 'Orange', 'beyond-journey' ), 'blue' => __( 'Blue', 'beyond-journey' ) ) ) ),
								'icon'    => $icon,
								'title'   => $title,
								'text'    => $area( __( 'Text', 'beyond-journey' ) ),
							),
						)
					),
				),
				__( 'Layout', 'beyond-journey' ) => array( 'bg' => $bg ),
			),
		),
		'core-values'            => array(
			'title'  => __( 'Core Values', 'beyond-journey' ),
			'icon'   => 'eicon-star',
			'groups' => array(
				__( 'Heading', 'beyond-journey' ) => array(
					'eyebrow'   => $eyebrow,
					'title'     => $title,
					'highlight' => $orange,
					'lead'      => $lead,
				),
				__( 'Values', 'beyond-journey' )  => array(
					'values' => bj_field(
						'repeater',
						__( 'Values', 'beyond-journey' ),
						array(
							'title'  => 'title',
							'fields' => array(
								'title'       => $title,
								'color'       => bj_field( 'select', __( 'Colour', 'beyond-journey' ), array( 'options' => array( 'blue' => __( 'Blue', 'beyond-journey' ), 'orange' => __( 'Orange', 'beyond-journey' ), 'blue-light' => __( 'Light blue', 'beyond-journey' ), 'orange-light' => __( 'Light orange', 'beyond-journey' ) ) ) ),
								'icon'        => $icon,
								'description' => $area( __( 'Description', 'beyond-journey' ) ),
							),
						)
					),
				),
			),
		),
		'team'                   => array(
			'title'  => __( 'Our Team', 'beyond-journey' ),
			'icon'   => 'eicon-person',
			'groups' => array(
				__( 'Text', 'beyond-journey' )   => array(
					'eyebrow'   => $eyebrow,
					'title'     => $title,
					'highlight' => $text( __( 'Title, second line (blue)', 'beyond-journey' ) ),
					'text1'     => $area( __( 'First paragraph', 'beyond-journey' ) ),
					'text2'     => $area( __( 'Second paragraph', 'beyond-journey' ) ),
					'tagline'   => $text( __( 'Closing line', 'beyond-journey' ) ),
				),
				__( 'Photo', 'beyond-journey' )  => array(
					'image' => $photo(),
					'alt'   => $alt,
				),
				__( 'Layout', 'beyond-journey' ) => array( 'bg' => $bg ),
			),
		),
		'growth'                 => array(
			'title'  => __( 'Looking Ahead', 'beyond-journey' ),
			'icon'   => 'eicon-text',
			'groups' => array(
				__( 'Text', 'beyond-journey' )   => array(
					'eyebrow'   => $eyebrow,
					'title'     => $title,
					'highlight' => $blue,
					'text1'     => $area( __( 'First paragraph', 'beyond-journey' ) ),
					'text2'     => $area( __( 'Second paragraph', 'beyond-journey' ) ),
				),
				__( 'Layout', 'beyond-journey' ) => array( 'bg' => $bg ),
			),
		),
		'commitment'             => array(
			'title'  => __( 'Our Commitment', 'beyond-journey' ),
			'icon'   => 'eicon-quote-right',
			'groups' => array(
				__( 'Text', 'beyond-journey' )   => array(
					'eyebrow'   => $eyebrow,
					'title'     => $text( __( 'Title, first part', 'beyond-journey' ) ),
					'highlight' => $blue,
					'text'      => $area( __( 'Text', 'beyond-journey' ) ),
				),
				__( 'Layout', 'beyond-journey' ) => array( 'bg' => $bg ),
			),
		),
		'stats'                  => array(
			'title'  => __( 'Key Numbers', 'beyond-journey' ),
			'icon'   => 'eicon-counter',
			'groups' => array(
				__( 'Numbers', 'beyond-journey' ) => array(
					'indicators' => bj_field(
						'repeater',
						__( 'Numbers', 'beyond-journey' ),
						array(
							'title'  => 'label',
							'fields' => array(
								'value' => $text( __( 'Figure', 'beyond-journey' ) ),
								'icon'  => $icon,
								'label' => $text( __( 'Label', 'beyond-journey' ) ),
							),
						)
					),
				),
			),
		),
		'final-cta'              => array(
			'title'  => __( 'Call to Action', 'beyond-journey' ),
			'icon'   => 'eicon-call-to-action',
			'groups' => array(
				__( 'Text', 'beyond-journey' )    => array(
					'eyebrow' => $eyebrow,
					'title'   => $text( __( 'Title, first line', 'beyond-journey' ) ),
					'title2'  => $text( __( 'Title, second line', 'beyond-journey' ) ),
					'text'    => $area( __( 'Text', 'beyond-journey' ) ),
				),
				__( 'Buttons', 'beyond-journey' ) => array(
					'button_text'   => $text( __( 'Orange button text', 'beyond-journey' ) ),
					'button_url'    => $link( __( 'Orange button link', 'beyond-journey' ) ),
					'show_whatsapp' => $toggle( __( 'Show WhatsApp button', 'beyond-journey' ) ),
					'whatsapp_text' => $text( __( 'WhatsApp button text', 'beyond-journey' ), array( 'description' => __( 'The number is set in Appearance > Customize > Beyond Journey Settings.', 'beyond-journey' ) ) ),
				),
				__( 'Photo', 'beyond-journey' )   => array(
					'image' => $photo( __( 'Background photo', 'beyond-journey' ) ),
					'alt'   => $alt,
				),
			),
		),
		'contact'                => array(
			'title'  => __( 'Contact & Enquiry Form', 'beyond-journey' ),
			'icon'   => 'eicon-form-horizontal',
			'groups' => array(
				__( 'Text', 'beyond-journey' ) => array(
					'eyebrow'   => $eyebrow,
					'title'     => $title,
					'highlight' => $text( __( 'Title, second line (blue)', 'beyond-journey' ) ),
					'text'      => $area( __( 'Text', 'beyond-journey' ), array( 'description' => __( 'Phone, WhatsApp, email, location and website come from Appearance > Customize > Beyond Journey Settings.', 'beyond-journey' ) ) ),
				),
				__( 'Form', 'beyond-journey' ) => array(
					'form_title'   => $text( __( 'Form title', 'beyond-journey' ) ),
					'form_text'    => $text( __( 'Form subtitle', 'beyond-journey' ) ),
					'button_text'  => $text( __( 'Send button text', 'beyond-journey' ) ),
					'done_title'   => $text( __( 'Thank-you title', 'beyond-journey' ) ),
					'done_text'    => $area( __( 'Thank-you text', 'beyond-journey' ) ),
				),
			),
		),
		'packages'               => array(
			'title'  => __( 'Holiday Packages (cards)', 'beyond-journey' ),
			'icon'   => 'eicon-gallery-grid',
			'groups' => array(
				__( 'Heading', 'beyond-journey' ) => array(
					'eyebrow'   => $eyebrow,
					'title'     => $title,
					'highlight' => $blue,
					'lead'      => $lead,
				),
				__( 'Cards', 'beyond-journey' )   => array(
					'limit'        => $text( __( 'Number of packages', 'beyond-journey' ), array( 'description' => __( 'The packages are added and edited in Dashboard > Packages. Tick "Show this package on the homepage" there to choose which ones appear.', 'beyond-journey' ) ) ),
					'enquire_text' => $text( __( 'Card button text', 'beyond-journey' ) ),
				),
				__( 'Button', 'beyond-journey' )  => array(
					'button_text' => $text( __( 'Button text', 'beyond-journey' ) ),
					'button_url'  => $link( __( 'Button link', 'beyond-journey' ) ),
					'note'        => $area( __( 'Small print under the button', 'beyond-journey' ) ),
				),
			),
		),
		'packages-showcase'      => array(
			'title'  => __( 'Holiday Packages (showcase page)', 'beyond-journey' ),
			'icon'   => 'eicon-slider-album',
			'groups' => array(
				__( 'Packages', 'beyond-journey' )     => array(
					'packages' => bj_field(
						'repeater',
						__( 'Packages', 'beyond-journey' ),
						array(
							'title'       => 'name',
							'description' => __( 'Add, edit, reorder (drag) or remove packages here. When you click Update, Dashboard > Packages is updated too, and the homepage cards follow. Removed packages are kept as drafts in the dashboard.', 'beyond-journey' ),
							'fields'      => array(
								'name'       => $text( __( 'Package name', 'beyond-journey' ) ),
								'location'   => $text( __( 'Location', 'beyond-journey' ) ),
								'price'      => $text( __( 'Starting price (AED, numbers only)', 'beyond-journey' ) ),
								'price_note' => $text( __( 'Price note (e.g. per adult)', 'beyond-journey' ) ),
								'duration'   => $text( __( 'Duration (e.g. 3N – 4D)', 'beyond-journey' ) ),
								'hotel'      => $text( __( 'Hotel (e.g. 4* Hotel Accommodation)', 'beyond-journey' ) ),
								'inclusions' => $text( __( 'Inclusions', 'beyond-journey' ) ),
								'summary'    => $area( __( 'Short description', 'beyond-journey' ) ),
								'country'    => $text( __( 'Country (for the filter)', 'beyond-journey' ) ),
								'badge'      => bj_field( 'select', __( 'Label on the photo', 'beyond-journey' ), array( 'options' => bj_package_badges() ) ),
								'dates'      => $text( __( 'Travel dates (optional)', 'beyond-journey' ) ),
								'about'      => $area( __( 'About the place (overview of the country or city)', 'beyond-journey' ) ),
								'itinerary'  => $area( __( 'Day-by-day plan (one day per line, "Day 1 – Arrival: details")', 'beyond-journey' ) ),
								'includes'   => $area( __( "What's included (one per line)", 'beyond-journey' ) ),
								'excludes'   => $area( __( 'Not included (one per line)', 'beyond-journey' ) ),
								'hotels'     => $area( __( 'Hotel details (one per line)', 'beyond-journey' ) ),
								'image'      => $photo(),
								'alt'        => $alt,
								'home'       => $toggle( __( 'Show on the homepage', 'beyond-journey' ) ),
							),
						)
					),
				),
				__( 'All packages', 'beyond-journey' ) => array(
					'grid_eyebrow'   => $eyebrow,
					'grid_title'     => $title,
					'grid_highlight' => $blue,
					'grid_lead'      => $lead,
					'note'           => $area( __( 'Small print under the cards', 'beyond-journey' ) ),
				),
			),
		),
		'site-footer'            => array(
			'title'  => __( 'Site Footer', 'beyond-journey' ),
			'icon'   => 'eicon-footer',
			'groups' => array(
				__( 'About', 'beyond-journey' )          => array(
					'about'      => $area( __( 'Text under the logo', 'beyond-journey' ), array( 'description' => __( 'The logo, phone, WhatsApp, email, location and social links are set in Appearance > Customize > Beyond Journey Settings.', 'beyond-journey' ) ) ),
					'show_icons' => $toggle( __( 'Show the contact and social icons', 'beyond-journey' ) ),
				),
				__( 'Column headings', 'beyond-journey' ) => array(
					'links_title'    => $text( __( 'Links column', 'beyond-journey' ), array( 'description' => __( 'The links are the main menu (Appearance > Menus > Primary Menu).', 'beyond-journey' ) ) ),
					'services_title' => $text( __( 'Services column', 'beyond-journey' ), array( 'description' => __( 'The links are the Footer Services menu (Appearance > Menus).', 'beyond-journey' ) ) ),
					'contact_title'  => $text( __( 'Contact column', 'beyond-journey' ) ),
				),
				__( 'Bottom bar', 'beyond-journey' )     => array(
					'copyright'         => $text( __( 'Copyright text', 'beyond-journey' ), array( 'description' => __( '{year} shows the current year.', 'beyond-journey' ) ) ),
					'credit_text'       => $text( __( 'Credit text', 'beyond-journey' ) ),
					'credit_name'       => $text( __( 'Credit name (green link)', 'beyond-journey' ), array( 'description' => __( 'Leave empty to hide the credit.', 'beyond-journey' ) ) ),
					'credit_url'        => $link( __( 'Credit link', 'beyond-journey' ) ),
					'show_bottom_links' => $toggle( __( 'Show the website and Contact Us links', 'beyond-journey' ) ),
				),
				__( 'Background', 'beyond-journey' )     => array(
					'show_skyline' => $toggle( __( 'Show the Dubai skyline', 'beyond-journey' ) ),
				),
			),
		),
		'destinations-directory' => array(
			'title'  => __( 'Destinations List & Regions', 'beyond-journey' ),
			'icon'   => 'eicon-posts-grid',
			'groups' => array(
				__( 'Heading', 'beyond-journey' )      => array(
					'eyebrow'   => $text( __( 'Small label above the title', 'beyond-journey' ), array( 'description' => __( '{count} shows the number of destinations.', 'beyond-journey' ) ) ),
					'title'     => $title,
					'highlight' => $blue,
					'lead'      => $lead,
				),
				__( 'Destinations', 'beyond-journey' ) => array(
					'destinations' => $dest_rep,
					'card_url'     => $link( __( 'Cards link to', 'beyond-journey' ) ),
				),
				__( 'Regions', 'beyond-journey' )      => array(
					'regions_eyebrow'   => $eyebrow,
					'regions_title'     => $title,
					'regions_highlight' => $blue,
					'region_order'      => bj_field( 'lines', __( 'Region order', 'beyond-journey' ), array( 'description' => __( 'One region per line. Regions not listed are shown after these.', 'beyond-journey' ) ) ),
					'region_colors'     => bj_field( 'lines', __( 'Region card colours', 'beyond-journey' ), array( 'description' => __( 'One hex colour per line, used in the same order as the region cards.', 'beyond-journey' ) ) ),
					'note'              => $area( __( 'Note', 'beyond-journey' ) ),
					'button_text'       => $text( __( 'Button text', 'beyond-journey' ) ),
					'button_url'        => $link( __( 'Button link', 'beyond-journey' ) ),
				),
			),
		),
		'dmc-groups'             => array(
			'title'  => __( 'DMC Services Groups', 'beyond-journey' ),
			'icon'   => 'eicon-bullet-list',
			'groups' => array(
				__( 'Heading', 'beyond-journey' ) => array(
					'eyebrow'   => $eyebrow,
					'title'     => $title,
					'highlight' => $blue,
					'lead'      => $lead,
				),
				__( 'Groups', 'beyond-journey' )  => array(
					'groups' => bj_field(
						'repeater',
						__( 'Groups', 'beyond-journey' ),
						array(
							'title'  => 'title',
							'fields' => array(
								'title' => $title,
								'icon'  => $icon,
								'tint'  => $text( __( 'Tile colour (hex)', 'beyond-journey' ), array( 'description' => __( 'The pastel square behind the icon, for example #FDE7D6.', 'beyond-journey' ) ) ),
								'ink'   => $text( __( 'Icon colour (hex)', 'beyond-journey' ), array( 'description' => __( 'Also the card outline, for example #F47B20.', 'beyond-journey' ) ) ),
								'items' => bj_field( 'lines', __( 'Items', 'beyond-journey' ), array( 'description' => $lists ) ),
							),
						)
					),
				),
			),
		),
		'dmc-partners'           => array(
			'title'  => __( 'DMC Partners', 'beyond-journey' ),
			'icon'   => 'eicon-handshake',
			'groups' => array(
				__( 'Text', 'beyond-journey' ) => array(
					'eyebrow'   => $eyebrow,
					'title'     => $title,
					'highlight' => $blue,
					'text1'     => $area( __( 'First paragraph', 'beyond-journey' ) ),
					'text2'     => $area( __( 'Second paragraph', 'beyond-journey' ) ),
					'text3'     => $area( __( 'Third paragraph', 'beyond-journey' ) ),
				),
				__( 'Card', 'beyond-journey' ) => array(
					'multilingual_title' => $text( __( 'Multilingual heading', 'beyond-journey' ) ),
					'multilingual_text'  => $area( __( 'Multilingual text', 'beyond-journey' ) ),
					'contact_label'      => $text( __( 'Second heading', 'beyond-journey' ) ),
					'contact_text'       => $area( __( 'Second text', 'beyond-journey' ) ),
				),
			),
		),
	);

	return $schemas;
}

/** Widget class names, keyed by section. */
function bj_elementor_widget_classes() {
	$classes = array();
	foreach ( array_keys( bj_widget_schemas() ) as $section ) {
		$classes[ $section ] = 'BJ_Widget_' . str_replace( ' ', '_', ucwords( str_replace( '-', ' ', $section ) ) );
	}
	return $classes;
}

/**
 * Converts a stored value to the format of an Elementor control.
 *
 * @param array $field Field definition.
 * @param mixed $value Stored value.
 * @return mixed
 */
function bj_elementor_value( $field, $value ) {
	switch ( $field['type'] ) {
		case 'url':
			return is_array( $value ) ? $value : array(
				'url'         => (string) $value,
				'is_external' => '',
				'nofollow'    => '',
			);
		case 'media':
			return is_array( $value ) ? $value : array(
				'url' => (string) $value,
				'id'  => '',
			);
		case 'switcher':
			return ( 'yes' === $value || true === $value ) ? 'yes' : '';
		case 'lines':
			return is_array( $value ) ? implode( "\n", $value ) : (string) $value;
		case 'repeater':
			$rows = array();
			foreach ( (array) $value as $item ) {
				$row = array( '_id' => bj_elementor_id() );
				foreach ( $field['fields'] as $key => $sub ) {
					$row[ $key ] = bj_elementor_value( $sub, isset( $item[ $key ] ) ? $item[ $key ] : '' );
				}
				$rows[] = $row;
			}
			return $rows;
		default:
			return is_scalar( $value ) ? (string) $value : '';
	}
}

/** Random element ID in Elementor's format. */
function bj_elementor_id() {
	return substr( md5( wp_generate_uuid4() ), 0, 7 );
}

/**
 * Flat field list of a section schema.
 *
 * @param string $section Section name.
 * @return array
 */
function bj_widget_fields( $section ) {
	$schemas = bj_widget_schemas();
	$fields  = array();
	foreach ( $schemas[ $section ]['groups'] as $group ) {
		$fields = array_merge( $fields, $group );
	}
	return $fields;
}

/**
 * Builds the Elementor layout of the designed pages from bj_page_layouts().
 *
 * @param bool $force Rebuild pages that already have an Elementor layout.
 * @return array|WP_Error Result per page.
 */
function bj_elementor_build_pages( $force = false ) {
	if ( ! bj_elementor_ready() ) {
		return new WP_Error( 'bj_no_elementor', __( 'Elementor is not active.', 'beyond-journey' ) );
	}

	$schemas = bj_widget_schemas();
	$report  = array();
	foreach ( bj_page_layouts() as $slug => $layout ) {
		$page = get_page_by_path( $slug );
		if ( ! $page ) {
			$report[ $slug ] = 'page not found';
			continue;
		}
		$document = \Elementor\Plugin::$instance->documents->get( $page->ID, false );
		if ( ! $document ) {
			$report[ $slug ] = 'no Elementor document';
			continue;
		}
		if ( ! $force && $document->is_built_with_elementor() && $document->get_elements_data() ) {
			$report[ $slug ] = 'kept (already has an Elementor layout)';
			continue;
		}

		$elements = array();
		foreach ( $layout as $block ) {
			list( $section, $overrides ) = $block;
			$fields   = bj_widget_fields( $section );
			$settings = array();
			foreach ( $overrides as $key => $value ) {
				if ( isset( $fields[ $key ] ) ) {
					$settings[ $key ] = bj_elementor_value( $fields[ $key ], $value );
				}
			}
			$elements[] = array(
				'id'       => bj_elementor_id(),
				'elType'   => 'container',
				'isInner'  => false,
				'settings' => array(
					'_title'         => $schemas[ $section ]['title'],
					'content_width'  => 'full',
					'flex_direction' => 'column',
					'flex_gap'       => array(
						'unit'     => 'px',
						'size'     => 0,
						'column'   => '0',
						'row'      => '0',
						'isLinked' => true,
					),
					'padding'        => array(
						'unit'     => 'px',
						'top'      => '0',
						'right'    => '0',
						'bottom'   => '0',
						'left'     => '0',
						'isLinked' => true,
					),
				),
				'elements' => array(
					array(
						'id'         => bj_elementor_id(),
						'elType'     => 'widget',
						'widgetType' => 'bj-' . $section,
						'settings'   => $settings,
						'elements'   => array(),
					),
				),
			);
		}

		// Saving the elements does not mark the page as an Elementor page; the editor does that separately.
		$document->set_is_built_with_elementor( true );
		$saved           = $document->save( array( 'elements' => $elements ) );
		$report[ $slug ] = $saved ? count( $elements ) . ' sections' : 'save failed';
	}
	return $report;
}

/**
 * Registers the widget category.
 *
 * @param \Elementor\Elements_Manager $elements_manager Elements manager.
 */
function bj_elementor_category( $elements_manager ) {
	$elements_manager->add_category(
		'beyond-journey',
		array(
			'title' => __( 'Beyond Journey', 'beyond-journey' ),
			'icon'  => 'eicon-globe',
		)
	);
}
add_action( 'elementor/elements/categories_registered', 'bj_elementor_category' );

/**
 * Registers the section widgets.
 *
 * @param \Elementor\Widgets_Manager $widgets_manager Widgets manager.
 */
function bj_elementor_widgets( $widgets_manager ) {
	require_once BJ_DIR . '/inc/elementor-widgets.php';
	foreach ( bj_elementor_widget_classes() as $class ) {
		if ( class_exists( $class ) ) {
			$widgets_manager->register( new $class() );
		}
	}
}
add_action( 'elementor/widgets/register', 'bj_elementor_widgets' );

/** Dashboard notice offering to build the Elementor layouts of designed pages that have none. */
function bj_elementor_notice() {
	if ( ! bj_elementor_ready() || ! current_user_can( 'edit_pages' ) || get_user_meta( get_current_user_id(), 'bj_hide_elementor_notice', true ) ) {
		return;
	}
	$screen = get_current_screen();
	if ( ! $screen || ! in_array( $screen->id, array( 'dashboard', 'edit-page', 'themes' ), true ) ) {
		return;
	}
	$missing = array();
	foreach ( array_keys( bj_page_layouts() ) as $slug ) {
		$page = get_page_by_path( $slug );
		if ( $page && ! bj_is_elementor_page( $page->ID ) ) {
			$missing[] = get_the_title( $page );
		}
	}
	if ( ! $missing ) {
		return;
	}
	$url = admin_url( 'admin-post.php?action=bj_build_elementor' );
	printf(
		'<div class="notice notice-info"><p>%1$s</p><p><a class="button button-primary" href="%2$s">%3$s</a> <a class="button" href="%4$s">%5$s</a></p></div>',
		/* translators: %s: page titles. */
		esc_html( sprintf( __( 'Beyond Journey: these pages can be made editable in Elementor with the theme\'s section widgets: %s.', 'beyond-journey' ), implode( ', ', $missing ) ) ),
		esc_url( wp_nonce_url( $url, 'bj_build_elementor' ) ),
		esc_html__( 'Build Elementor layouts', 'beyond-journey' ),
		esc_url( wp_nonce_url( add_query_arg( 'hide', '1', $url ), 'bj_build_elementor' ) ),
		esc_html__( 'Hide this message', 'beyond-journey' )
	);
}
add_action( 'admin_notices', 'bj_elementor_notice' );

/** Handles the notice buttons. */
function bj_elementor_notice_action() {
	check_admin_referer( 'bj_build_elementor' );
	if ( ! current_user_can( 'edit_pages' ) ) {
		wp_die( esc_html__( 'Sorry, you are not allowed to do that.', 'beyond-journey' ) );
	}
	if ( ! empty( $_GET['hide'] ) ) {
		update_user_meta( get_current_user_id(), 'bj_hide_elementor_notice', 1 );
	} else {
		bj_elementor_build_pages();
	}
	$back = wp_get_referer();
	wp_safe_redirect( $back ? $back : admin_url() );
	exit;
}
add_action( 'admin_post_bj_build_elementor', 'bj_elementor_notice_action' );

if ( defined( 'WP_CLI' ) && WP_CLI ) {
	/**
	 * Builds the Elementor layouts of the designed pages.
	 *
	 * ## OPTIONS
	 *
	 * [--force]
	 * : Rebuild pages that already have an Elementor layout.
	 *
	 * ## EXAMPLES
	 *
	 *     wp bj build-elementor-pages --user=1
	 */
	WP_CLI::add_command(
		'bj build-elementor-pages',
		static function ( $args, $assoc_args ) {
			$result = bj_elementor_build_pages( ! empty( $assoc_args['force'] ) );
			if ( is_wp_error( $result ) ) {
				WP_CLI::error( $result->get_error_message() );
			}
			foreach ( $result as $slug => $status ) {
				WP_CLI::log( $slug . ': ' . $status );
			}
			WP_CLI::success( 'Done.' );
		}
	);
}
