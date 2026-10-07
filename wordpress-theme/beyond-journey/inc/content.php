<?php
/**
 * Site content: default text, images and lists for every section, and the section order of each page.
 * The Elementor widgets use these values as their defaults.
 *
 * @package Beyond_Journey
 */

defined( 'ABSPATH' ) || exit;

const BJ_FOOTER_IMAGE  = 'https://images.unsplash.com/photo-1572994384812-d66fea58513f';
const BJ_DMC_IMAGE     = 'https://images.unsplash.com/photo-1650728768250-29d1061bf84b';
const BJ_DMC_IMAGE_ALT = 'The Museum of the Future lit at night on Sheikh Zayed Road, with the Dubai skyline behind';
const BJ_MODAL_IMAGE   = 'https://images.unsplash.com/photo-1747909743208-f4fee35ef9ce';

/** Quick services bar under the home banner: label, icon name and short line. */
function bj_quick_services() {
	return array(
		array( 'Holidays', 'sun', 'Tailor-made trips' ),
		array( 'UAE Tours', 'building', 'Desert and city days' ),
		array( 'Hotels', 'hotel', 'Stays worldwide' ),
		array( 'Visa', 'id-card', 'Tourist and business' ),
		array( 'Transfers', 'truck', 'Airport, car and rail' ),
	);
}

/** Default navigation, used until a menu is assigned to the Primary location. */
function bj_nav_defaults() {
	return array(
		array( 'label' => 'Home', 'slug' => '' ),
		array(
			'label'    => 'About',
			'slug'     => 'about',
			'children' => array(
				array( 'label' => 'About Us', 'slug' => 'about' ),
				array( 'label' => 'Why Choose Us', 'slug' => 'why-us' ),
				array( 'label' => 'DMC & Ground Handling', 'slug' => 'dmc' ),
			),
		),
		array( 'label' => 'Services', 'slug' => 'services' ),
		array( 'label' => 'Destinations', 'slug' => 'destinations' ),
		array( 'label' => 'Contact', 'slug' => 'contact' ),
	);
}

/** Banner photos and text for each inner page, keyed by slug. */
function bj_page_heroes() {
	return array(
		'about'        => array(
			'title'     => 'About',
			'highlight' => 'Beyond Journey',
			'subtitle'  => 'A UAE-based travel and tourism company creating well-planned, seamless, and memorable travel experiences — inbound to the UAE and outbound to the world.',
			'slides'    => array(
				array( 'image' => 'https://images.unsplash.com/photo-1496588152823-86ff7695e68f', 'alt' => 'Brooklyn Bridge and the Manhattan skyline, New York', 'position' => 'object-[50%_50%]' ),
				array( 'image' => 'https://images.unsplash.com/photo-1605130284535-11dd9eedc58a', 'alt' => 'The Statue of Liberty with the Manhattan skyline behind', 'position' => 'object-[50%_50%]' ),
			),
		),
		'services'     => array(
			'title'     => 'Complete Travel',
			'highlight' => 'Solutions',
			'subtitle'  => 'A journey rarely needs just one service. Tours, holiday packages, accommodation, visas, transport, and experiences are brought together into one coordinated travel solution — with flights arranged as part of the trip.',
			'slides'    => array(
				array( 'image' => 'https://images.unsplash.com/photo-1610641818989-c2051b5e2cfd', 'alt' => 'Palm trees around a resort swimming pool', 'position' => 'object-[50%_55%]' ),
				array( 'image' => 'https://images.unsplash.com/photo-1782067127381-6770e7e871ee', 'alt' => 'A vehicle on a winding road through a green mountain valley', 'position' => 'object-[50%_55%]' ),
				array( 'image' => 'https://images.unsplash.com/photo-1597656303066-85eb659aeb29', 'alt' => 'Camel riding across the desert dunes', 'position' => 'object-[50%_55%]' ),
				array( 'image' => 'https://images.unsplash.com/photo-1784904338266-f5b736d00533', 'alt' => 'A guided group outside a landmark building', 'position' => 'object-[50%_45%]' ),
			),
		),
		'destinations' => array(
			'title'     => 'Destinations',
			'highlight' => '',
			'subtitle'  => 'Holiday packages, tours, and tailor-made itineraries for UAE residents across a growing portfolio of carefully selected destinations.',
			'slides'    => array(
				array( 'image' => 'https://images.unsplash.com/photo-1704797389166-c7dac99fc633', 'alt' => 'A traveller looking out of a train window through the green hills of Sri Lanka', 'position' => 'object-[50%_55%]' ),
				array( 'image' => 'https://images.unsplash.com/photo-1767767765385-eaef0b63396e', 'alt' => 'Hikers on a mountain ridge overlooking a valley in Georgia', 'position' => 'object-[50%_55%]' ),
				array( 'image' => 'https://images.unsplash.com/photo-1708341782739-976b35caebf8', 'alt' => 'People strolling along the Baku waterfront, Azerbaijan', 'position' => 'object-[50%_55%]' ),
				array( 'image' => 'https://images.unsplash.com/photo-1596879857570-7b6b9018bcb6', 'alt' => 'Visitors on a longtail boat at a beach in Thailand', 'position' => 'object-[50%_55%]' ),
				array( 'image' => 'https://images.unsplash.com/photo-1741074782786-2226cf9edb44', 'alt' => 'A bright blue wadi between canyon walls in Oman', 'position' => 'object-[50%_55%]' ),
				array( 'image' => 'https://images.unsplash.com/photo-1709403108621-66fe97132946', 'alt' => 'Safari guests spotting a lion in the grass in Kenya', 'position' => 'object-[50%_55%]' ),
			),
		),
		'dmc'          => array(
			'title'     => 'Your Trusted UAE',
			'highlight' => 'Destination Partner',
			'subtitle'  => 'Comprehensive ground-handling services in the UAE for international visitors, groups, and travel partners.',
			'slides'    => array(
				array( 'image' => 'https://images.unsplash.com/photo-1755114421815-873d0755faae', 'alt' => 'A modern domed building standing over the water', 'position' => 'object-[50%_55%]' ),
				array( 'image' => 'https://images.unsplash.com/photo-1714379270163-8a9832bba0aa', 'alt' => 'A lake surrounded by mountains', 'position' => 'object-[50%_55%]' ),
				array( 'image' => 'https://images.unsplash.com/photo-1650435331525-b97ee2590c3a', 'alt' => 'A bridge over the water with the city skyline behind', 'position' => 'object-[50%_55%]' ),
			),
		),
		'why-us'       => array(
			'title'     => 'More Than a Booking.',
			'highlight' => 'A Better-Planned Journey.',
			'subtitle'  => 'The difference between a booking and a journey lies in the thought, coordination, and care behind it.',
			'slides'    => array(
				array( 'image' => 'https://images.unsplash.com/photo-1530047139082-5435ca3c4614', 'alt' => 'Two friends smiling together on the beach', 'position' => 'object-[50%_40%]' ),
				array( 'image' => 'https://images.unsplash.com/photo-1580825175616-77f8df1bb507', 'alt' => 'A group leaping together on the sand', 'position' => 'object-[50%_50%]' ),
			),
		),
		'contact'      => array(
			'title'     => "Let's Plan Your",
			'highlight' => 'Next Journey',
			'subtitle'  => 'Share your destination, travel dates, number of travellers, and what matters most to you — our team will take it from there.',
			'slides'    => array(
				array( 'image' => 'https://images.unsplash.com/photo-1663767117072-a97deef95956', 'alt' => 'A travel consultant at a desk with a laptop and phone', 'position' => 'object-[50%_45%]' ),
				array( 'image' => 'https://images.unsplash.com/photo-1785607290437-313582b617c9', 'alt' => 'Sunset over the ocean with distant land on the horizon', 'position' => 'object-[50%_55%]' ),
				array( 'image' => 'https://images.unsplash.com/photo-1725958977969-f6c5c3d42fbc', 'alt' => 'The sun setting over a city skyline', 'position' => 'object-[50%_55%]' ),
			),
		),
	);
}

/**
 * URL of a photo shipped with the theme.
 *
 * @param string $file File name in assets/images.
 * @return string
 */
function bj_theme_image( $file ) {
	return BJ_URI . '/assets/images/' . $file;
}

/** Home page slideshow. "crop" picks the stored focus point for that photo. */
function bj_hero_slides() {
	return array(
		array( 'image' => bj_theme_image( 'hero-resort.webp' ), 'crop' => '8', 'alt' => 'Sun loungers and white parasols beside an infinity pool at a palm-fringed beach resort' ),
		array( 'image' => 'https://images.unsplash.com/photo-1464822759023-fed622ff2c3b', 'crop' => '4', 'alt' => 'Snow-capped mountain range above a forested valley' ),
		array( 'image' => bj_theme_image( 'hero-taj.webp' ), 'crop' => '9', 'alt' => 'The Taj Mahal in Agra framed by trees and its landscaped gardens' ),
		array( 'image' => 'https://images.unsplash.com/photo-1567994200289-a98293394b69', 'crop' => '7', 'alt' => 'Hot air balloons rising over the rock valleys of Cappadocia at dawn' ),
		array( 'image' => bj_theme_image( 'hero-camp.webp' ), 'crop' => '10', 'alt' => 'Lantern-lit tent with Arabic floor cushions at a desert camp at sunset' ),
	);
}

/** Figures shown by the "Key Numbers" section. */
function bj_indicators() {
	return array(
		array( 'value' => '15+', 'icon' => 'clock', 'label' => 'Years of Combined Tourism Experience' ),
		array( 'value' => '6+', 'icon' => 'user-group', 'label' => 'Dedicated Team Members' ),
		array( 'value' => '5', 'icon' => 'language', 'label' => 'Languages Spoken' ),
		array( 'value' => '10+', 'icon' => 'globe', 'label' => 'International Destinations' ),
	);
}

/** Destinations. */
/** Premium hotels on the homepage (photos: Unsplash). Features: one per line. */
function bj_hotels() {
	return array(
		array( 'name' => 'lebua at State Tower', 'location' => 'Bangkok, Thailand', 'image' => 'https://images.unsplash.com/photo-1698613714373-1cbff9ec9d96', 'alt' => 'lebua at State Tower with its golden dome in Bangkok', 'features' => "Rooftop dining\nRiver views\nSuites" ),
		array( 'name' => 'The Taj Mahal Palace', 'location' => 'Mumbai, India', 'image' => 'https://images.unsplash.com/photo-1660145416818-b9a2b1a1f193', 'alt' => 'The Taj Mahal Palace hotel in Mumbai', 'features' => "Heritage\nSea views\nSpa" ),
		array( 'name' => 'W Maldives', 'location' => 'Maldives', 'image' => 'https://images.unsplash.com/photo-1602002418679-43121356bf41', 'alt' => 'An overwater villa at W Maldives', 'features' => "Overwater villas\nPrivate beach\nSpa" ),
		array( 'name' => 'Fairmont Baku, Flame Towers', 'location' => 'Baku, Azerbaijan', 'image' => 'https://images.unsplash.com/photo-1704955568698-e65cd5896b3e', 'alt' => 'The Fairmont Baku Flame Towers seen from Baku Boulevard', 'features' => "Caspian Sea views\nSpa\nSkyline suites" ),
		array( 'name' => 'The Chedi Muscat', 'location' => 'Muscat, Oman', 'image' => 'https://images.unsplash.com/photo-1650965171703-087486b3a1b0', 'alt' => 'The long pool at The Chedi Muscat', 'features' => "Long pool\nPrivate beach\nSpa" ),
	);
}

function bj_destinations() {
	return array(
		array( 'name' => 'Sri Lanka', 'region' => 'South Asia', 'description' => 'Beaches, hill country, cultural attractions, and wildlife experiences.', 'image' => 'https://images.unsplash.com/photo-1580889240912-c39ecefd3d95', 'alt' => 'Sigiriya Lion Rock fortress rising above the plains in Sri Lanka' ),
		array( 'name' => 'Georgia', 'region' => 'Caucasus', 'description' => 'Mountain landscapes, historic cities, wine regions, and cultural experiences.', 'image' => 'https://images.unsplash.com/photo-1563284223-333497472e88', 'alt' => 'Gergeti Trinity Church on a green hill below snow-capped Caucasus peaks in Georgia' ),
		array( 'name' => 'India', 'region' => 'South Asia', 'description' => 'Multi-city holidays, cultural journeys, family travel, and pilgrimage experiences.', 'image' => 'https://images.unsplash.com/photo-1524492412937-b28074a5d7da', 'alt' => 'The Taj Mahal reflected in its watercourse at sunrise in India' ),
		array( 'name' => 'Azerbaijan', 'region' => 'Caucasus', 'description' => 'Baku city breaks, cultural attractions, and Caucasus experiences.', 'image' => 'https://images.unsplash.com/photo-1596306499300-0b7b1689b9f6', 'alt' => 'The Flame Towers rising above the Baku skyline at sunset in Azerbaijan' ),
		array( 'name' => 'Armenia', 'region' => 'Caucasus', 'description' => 'Historic Yerevan, monasteries, cultural heritage, and mountain landscapes.', 'image' => 'https://images.unsplash.com/photo-1600758208050-a22f17dc5bb9', 'alt' => 'Yerevan cityscape at dusk with Mount Ararat rising behind it in Armenia' ),
		array( 'name' => 'Thailand', 'region' => 'Southeast Asia', 'description' => 'Tropical beaches, islands, city experiences, and leisure holidays.', 'image' => 'https://images.unsplash.com/photo-1528181304800-259b08848526', 'alt' => 'Golden Buddhist temple with ornate rooftops and palm trees in Thailand' ),
		array( 'name' => 'Russia', 'region' => 'Eurasia', 'description' => 'Moscow, St. Petersburg, cultural landmarks, and classic Russian experiences.', 'image' => 'https://images.unsplash.com/photo-1513326738677-b964603b136d', 'alt' => "Saint Basil's Cathedral on Red Square in Moscow, Russia" ),
		array( 'name' => 'Oman', 'region' => 'Arabian Peninsula', 'description' => 'Desert landscapes, coastline, culture, and convenient short breaks from the UAE.', 'image' => 'https://images.unsplash.com/photo-1606813332135-228593b6e201', 'alt' => 'Muscat waterfront and surrounding mountains at dusk in Oman' ),
		array( 'name' => 'Maldives', 'region' => 'Indian Ocean', 'description' => 'Luxury island escapes, overwater resorts, romantic holidays, and honeymoon experiences.', 'image' => 'https://images.unsplash.com/photo-1514282401047-d79a71a590e8', 'alt' => 'Overwater villas above a turquoise lagoon in the Maldives' ),
		array( 'name' => 'Kenya', 'region' => 'East Africa', 'description' => 'Wildlife and safari experiences.', 'image' => 'https://images.unsplash.com/photo-1547471080-7cc2caa01a7e', 'alt' => 'Acacia tree silhouetted against the savannah at sunset in Kenya' ),
		array( 'name' => 'Japan', 'region' => 'East Asia', 'description' => 'Culture, heritage, modern cities, seasonal experiences, and immersive travel.', 'image' => 'https://images.unsplash.com/photo-1493976040374-85c8e12f0c0e', 'alt' => 'Traditional pagoda above a historic street with visitors in kimono in Japan' ),
	);
}

/** Region order on the Destinations page. */
function bj_region_order() {
	return array( 'South Asia', 'Caucasus', 'Southeast Asia', 'East Asia', 'Arabian Peninsula', 'Indian Ocean', 'East Africa', 'Eurasia' );
}

/** Service groups. */
function bj_service_categories() {
	return array(
		array( 'name' => 'Leisure & Experiences', 'blurb' => 'Travel designed around how our customers want to travel.' ),
		array( 'name' => 'Travel Essentials & Corporate Services', 'blurb' => 'Everything you need for a seamless journey, coordinated by one team.' ),
		array( 'name' => 'DMC & Support', 'blurb' => 'Destination management in the UAE, and support throughout the journey.' ),
	);
}

/** The core services, each with the photo shown on its tile. */
function bj_services() {
	return array(
		array( 'title' => 'Holiday Packages & Tours', 'category' => 'Leisure & Experiences', 'description' => 'Tailor-made leisure itineraries for individuals, couples, families, and groups.', 'image' => 'https://images.unsplash.com/photo-1603477849227-705c424d1d80', 'alt' => 'Palm trees leaning over a white-sand tropical beach' ),
		array( 'title' => 'UAE Tours & Attractions', 'category' => 'Leisure & Experiences', 'description' => 'City tours, desert experiences, attractions, sightseeing, and activities across the Emirates.', 'image' => 'https://images.unsplash.com/photo-1695878868496-fcbd6ef47f57', 'alt' => 'Dune buggies driving through the desert on a safari' ),
		array( 'title' => 'Hotel Reservations', 'category' => 'Travel Essentials & Corporate Services', 'description' => 'Accommodation options worldwide based on destination, location, budget, and traveller requirements.', 'image' => 'https://images.unsplash.com/photo-1611892440504-42a792e24d32', 'alt' => 'Warmly lit hotel bedroom with a wooden bed' ),
		array( 'title' => 'Visa Services', 'category' => 'Travel Essentials & Corporate Services', 'description' => 'Guidance, documentation support, application processing, and tracking.', 'image' => 'https://images.unsplash.com/photo-1655722725332-9925c96dd627', 'alt' => 'Open passport full of colourful visa stamps' ),
		array( 'title' => 'Travel Insurance', 'category' => 'Travel Essentials & Corporate Services', 'description' => 'Travel insurance solutions arranged alongside travel bookings, including cover for visa requirements.', 'image' => 'https://images.unsplash.com/photo-1547378352-6b09c0a74c8d', 'alt' => 'Traveller with a suitcase silhouetted against sunlit airport windows' ),
		array( 'title' => 'Transfers, Transport & Rail', 'category' => 'Travel Essentials & Corporate Services', 'description' => 'Airport transfers, private transportation, chauffeur services, group transportation, and rail reservations.', 'image' => 'https://images.unsplash.com/photo-1728458664292-ac6d6034e78d', 'alt' => 'Luxury car parked in front of a city skyline' ),
		array( 'title' => 'Corporate Travel & MICE', 'category' => 'Travel Essentials & Corporate Services', 'description' => 'Business travel, meetings, incentives, conferences, exhibitions, and group travel management.', 'image' => 'https://images.unsplash.com/photo-1517048676732-d65bc937f952', 'alt' => 'Colleagues in a business meeting around a table' ),
		array( 'title' => 'DMC & Ground Handling', 'category' => 'DMC & Support', 'description' => 'Professional destination management and ground-handling services for inbound visitors and groups travelling to the UAE.', 'image' => 'https://images.unsplash.com/photo-1532968899863-5b52ef155913', 'alt' => 'Travellers walking through a sunlit airport terminal' ),
		array( 'title' => '24/7 Customer Support', 'category' => 'DMC & Support', 'description' => "Responsive assistance throughout the traveller's journey, whenever you need us.", 'image' => 'https://images.unsplash.com/photo-1766066014237-00645c74e9c6', 'alt' => 'Smiling support agent wearing a headset at her computer' ),
	);
}

/** DMC services checklist. */
function bj_dmc_services() {
	return array( 'Airport meet and greet', 'Airport transfers', 'Local transportation', 'Professional guides', 'Hotel reservations', 'Tours and activity bookings', 'Attraction arrangements', 'Group coordination', 'Ground-handling services', 'Travel agent coordination', 'Consolidated group documentation', 'Direct communication with the ground team', 'On-ground issue resolution' );
}

/**
 * Default content of a section. Lists edited as "one item per line" are stored as newline-separated text.
 *
 * @param string $section Section name.
 * @return array
 */
function bj_section_defaults( $section ) {
	static $all = null;

	if ( null === $all ) {
		$all = array(
			'hero'                   => array(
				'eyebrow'      => 'Dubai, United Arab Emirates',
				'title'        => 'Explore Beyond',
				'highlight'    => 'Boundaries',
				'text'         => 'Tours, holiday packages, and tailor-made travel experiences — inbound to the UAE and outbound to the world. One reliable team planning the whole journey, not just one booking.',
				'button1_text' => 'Explore Destinations',
				'button1_url'  => '/destinations/',
				'button2_text' => 'Plan Your Journey',
				'button2_url'  => '/contact/',
				'scroll_text'  => 'Discover',
				'slides'       => bj_hero_slides(),
			),
			'page-hero'              => array(
				'title'     => 'Page',
				'highlight' => 'Title',
				'subtitle'  => '',
				'slides'    => array(
					array( 'image' => 'https://images.unsplash.com/photo-1593182440709-4b7b56482c55', 'alt' => 'Aircraft wing above a sea of clouds at sunrise', 'position' => 'object-[70%_center]' ),
				),
			),
			'about-intro'            => array(
				'eyebrow'      => 'About Us',
				'title'        => 'Your Journey Begins',
				'highlight'    => 'Beyond the Ordinary',
				'lead'         => 'Beyond Journey is a UAE-based tourism company created by a group of passionate travel professionals with 15+ years of combined expertise in the tourism sector.',
				'text'         => 'Born from a shared love for travel, discovery, and creating memorable experiences, Beyond Journey brings together industry knowledge and personal travel experiences to offer thoughtfully designed journeys for both inbound and outbound travelers.',
				'tagline'      => 'With our experience, destination knowledge, and strong passion for tourism, we aim to make every journey seamless, inspiring, and memorable.',
				'button1_text' => 'More About Us',
				'button1_url'  => '/about/',
				'button2_text' => 'Discover What We Do',
				'button2_url'  => '/services/',
				'image'        => 'https://images.unsplash.com/photo-1777924985545-d72b63a5924a',
				'alt'          => 'A traditional abra boat carrying passengers across Dubai Creek',
			),
			'inbound'                => array(
				'bg'        => 'bg-gradient-to-b from-brand-blue-pale via-brand-surface to-brand-surface',
				'eyebrow'   => 'Inbound & Outbound Tourism',
				'title'     => 'One Team. Two Directions.',
				'highlight' => 'One Standard of Service.',
				'lead'      => 'Beyond Journey operates as destination management and Outbound Tourism, providing a comprehensive range of travel solutions for individuals, families, groups, and corporate clients.',
				'cards'     => array(
					array(
						'tag'       => 'Inbound',
						'direction' => 'arrow-down',
						'title'     => 'Discover Dubai & UAE',
						'text'      => 'We welcome travellers from around the world and showcase the best of Dubai and United Arab Emirates.',
						'points'    => "Dubai & UAE packages\nHotel accommodation\nTransfers, City tours and sightseeing\nFIT and Group travel\nCorporate travel & events\nCustomized UAE itineraries\nUAE visa services\n24/7 Customer Support",
						'link_text' => 'Explore DMC Services',
						'link_url'  => '/dmc/',
						'image'     => 'https://images.unsplash.com/photo-1518684079-3c830dcef090',
						'alt'       => 'The Burj Al Arab hotel on the Dubai coastline in the UAE',
					),
					array(
						'tag'       => 'Outbound',
						'direction' => 'arrow-up',
						'title'     => 'Explore the World Beyond',
						'text'      => 'Our outbound division creates memorable international travel experiences tailored to different interests, budgets, and travel styles.',
						'points'    => "International holiday packages\nCustomized itineraries\nFIT and Group tours\nVisa assistance\nHotel & resort bookings\nTransfers and sightseeing\nFlights and travel arrangements\n24/7 Customer Support",
						'link_text' => 'View Destinations',
						'link_url'  => '/destinations/',
						'image'     => 'https://images.unsplash.com/photo-1729707690998-1d4c5d755c0f',
						'alt'       => 'Aerial view of a resort swimming pool framed by palm trees',
					),
				),
			),
			'services'               => array(
				'bg'           => 'bg-white',
				'show_heading' => 'yes',
				'eyebrow'      => 'What We Do',
				'title'        => 'Complete Travel Solutions.',
				'highlight'    => 'One Reliable Partner.',
				'lead'         => 'A journey rarely needs just one service. Tours, holiday packages, accommodation, visas, transport, and experiences are brought together into one coordinated travel solution — with flights arranged as part of the trip.',
				'layout'       => 'grid',
				'services'     => bj_services(),
				'tile_url'     => '/contact/',
				'categories'   => bj_service_categories(),
				'pillars'      => array(
					array( 'step' => 'Discover', 'title' => 'Where You’ll Go', 'category' => 'Leisure & Experiences', 'description' => 'Holiday packages and tours and UAE attractions — planned around how you want to travel.', 'image' => 'https://images.unsplash.com/photo-1721840432289-d0041522103d', 'alt' => "Travellers walking together along a beach at the water's edge" ),
					array( 'step' => 'Arrange', 'title' => 'How You’ll Travel', 'category' => 'Travel Essentials & Corporate Services', 'description' => 'Hotels, visas, insurance, transfers, rail, corporate travel, and flights — the arrangements behind the trip.', 'image' => 'https://images.unsplash.com/photo-1758193783649-13371d7fb8dd', 'alt' => 'A modern hotel lobby with a reception desk and seating' ),
					array( 'step' => 'Experience', 'title' => 'Who Looks After You', 'category' => 'DMC & Support', 'description' => 'UAE destination management, ground handling for inbound groups and partners, and support throughout the journey.', 'image' => 'https://images.unsplash.com/photo-1506645728556-ac574e628eca', 'alt' => 'A four-wheel-drive vehicle on the dunes during a desert tour' ),
				),
				'pillar_cta'   => 'Enquire Now',
				'pillar_url'   => '/contact/',
				'show_cta'     => '',
				'cta_text'     => 'See All Services in Detail',
				'cta_url'      => '/services/',
			),
			'why-us'                 => array(
				'bg'           => 'bg-white',
				'show_heading' => 'yes',
				'eyebrow'      => 'Why Beyond Journey',
				'title'        => 'More Than a Booking.',
				'highlight'    => 'A Better-Planned Journey.',
				'lead'         => 'The difference between a booking and a journey lies in the thought, coordination, and care behind it.',
				'features'     => array(
					array( 'number' => '01', 'icon' => 'grid', 'title' => '15+ Years of Industry Experience', 'description' => 'Our team brings more than 15 years of tourism-sector experience, giving us valuable knowledge of destinations, travel trends, customer expectations, and industry operations.' ),
					array( 'number' => '02', 'icon' => 'heart', 'title' => 'Passion for Travel', 'description' => 'We are travellers ourselves. Our recommendations are shaped not only by professional knowledge but also by our own experiences and passion for discovering the world.' ),
					array( 'number' => '03', 'icon' => 'user', 'title' => 'Personalized Experiences', 'description' => 'No two travellers are the same. We create flexible travel solutions based on individual preferences, interests, and budgets.' ),
					array( 'number' => '04', 'icon' => 'support', 'title' => 'Reliable Service', 'description' => 'From the first enquiry to the end of the journey, our team is committed to providing responsive and professional service.' ),
					array( 'number' => '05', 'icon' => 'globe', 'title' => 'Beyond the Ordinary', 'description' => 'We aim to go beyond standard packages and create experiences that become lasting memories.' ),
				),
				'show_cta'     => '',
				'cta_text'     => 'Start Planning With Us',
				'cta_url'      => '/contact/',
			),
			'dmc'                    => array(
				'eyebrow'            => 'DMC & Ground Handling',
				'title'              => 'Your Trusted UAE',
				'highlight'          => 'Destination Partner',
				'text1'              => 'Beyond Journey Tourism operates as a Destination Management Company, providing comprehensive ground-handling services in the UAE for international visitors, groups, and travel partners.',
				'text2'              => 'Our DMC operations are supported by a UAE-based team with local knowledge and on-ground coordination. We work closely with travel agents and international partners so inbound travellers receive a seamless experience from arrival to departure.',
				'text3'              => 'As we grow, we continue to welcome travellers from new inbound source markets — keeping the same standards of service, reliability, and local support.',
				'items'              => implode( "\n", bj_dmc_services() ),
				'multilingual_title' => 'Multilingual',
				'multilingual_text'  => 'Travel is easier when communication feels natural. Our multilingual team helps travellers receive clear guidance and assistance throughout the journey.',
				'button1_text'       => 'Partner With Us',
				'button1_url'        => '/contact/',
				'show_button2'       => 'yes',
				'button2_text'       => 'See Full DMC Services',
				'button2_url'        => '/dmc/',
				'image'              => bj_theme_image( 'dmc-runner.webp' ),
				'alt'                => 'A smiling traveller with a red suitcase leaping out of a phone screen',
				'badge_title'        => 'One Point of Contact',
				'badge_text'         => 'One accountable team from booking confirmation to departure.',
			),
			'destinations'           => array(
				'eyebrow'      => 'Tours & Holiday Packages',
				'title'        => 'Destinations',
				'highlight'    => '',
				'lead'         => '',
				'card_url'     => '/destinations/',
				'destinations' => bj_destinations(),
				'button_text'  => 'Browse All Destinations',
				'button_url'   => '/destinations/',
			),
			'hotels'                 => array(
				'eyebrow'     => 'Premium Hotel Stays',
				'title'       => 'Handpicked',
				'highlight'   => 'Five-Star Stays',
				'text'        => 'Iconic landmarks, palace hotels and beachfront resorts. We book the stay that suits your trip, from a special-occasion splurge to a family holiday, and arrange it together with your flights, transfers and tours.',
				'button_text' => 'Explore Hotels',
				'button_url'  => '/contact/',
				'card_url'    => '/contact/',
				'hotels'      => bj_hotels(),
			),
			'process'                => array(
				'bg'        => 'bg-brand-surface',
				'eyebrow'   => 'How We Work',
				'title'     => 'A Simple, Transparent',
				'highlight' => 'Travel Process',
				'steps'     => array(
					array( 'number' => '01', 'title' => 'Understand', 'description' => 'We begin by understanding the purpose of the journey, who is travelling, preferred travel dates, budget, interests, and priorities.' ),
					array( 'number' => '02', 'title' => 'Plan', 'description' => 'Our team develops suitable travel options and itineraries, clearly explaining available choices, inclusions, and costs.' ),
					array( 'number' => '03', 'title' => 'Confirm', 'description' => 'Once the preferred option is selected, we coordinate and confirm bookings, documentation, insurance, and other arrangements.' ),
					array( 'number' => '04', 'title' => 'Support', 'description' => 'We remain available throughout the journey to assist with travel changes, delays, questions, and on-ground requirements.' ),
				),
			),
			'vision-mission'         => array(
				'bg'      => 'bg-white',
				'pillars' => array(
					array( 'eyebrow' => 'Our Vision', 'color' => 'orange', 'icon' => 'eye', 'title' => 'A Trusted and Innovative Tourism Partner', 'text' => 'To become a trusted and innovative tourism partner in UAE, connecting travelers with extraordinary destinations and experiences around the world. We aspire to build a travel brand that goes beyond conventional tourism by inspiring people to explore beyond boundaries.' ),
					array( 'eyebrow' => 'Our Mission', 'color' => 'blue', 'icon' => 'rocket', 'title' => 'Personalized, Reliable, Memorable Journeys', 'text' => 'Our mission is to deliver personalized, reliable, and memorable travel experiences through professional service and destination expertise. We strive to understand every traveler’s needs and transform them into journeys that are carefully planned, competitively priced, and professionally managed from start to finish.' ),
				),
			),
			'core-values'            => array(
				'eyebrow'   => 'Our Core Values',
				'title'     => 'What We',
				'highlight' => 'Stand For',
				'lead'      => 'Four principles that guide every journey we plan and every relationship we build.',
				'values'    => array(
					array( 'title' => 'Discovery', 'color' => 'blue', 'icon' => 'globe', 'description' => 'Every journey should have a purpose. Rather than relying on standard itineraries, we take time to understand what makes a trip meaningful, then build it around destinations and experiences worth remembering.' ),
					array( 'title' => 'Trust', 'color' => 'orange', 'icon' => 'shield', 'description' => 'Trust is at the heart of every successful journey. Transparent pricing, accurate information, dependable arrangements, and clear communication — what we promise, we strive to deliver.' ),
					array( 'title' => 'Care', 'color' => 'blue-light', 'icon' => 'heart', 'description' => 'Every traveller deserves personal attention. From the first enquiry to the completion of the journey, we stay attentive and available — to travellers and travel partners alike.' ),
					array( 'title' => 'Agility', 'color' => 'orange-light', 'icon' => 'bolt', 'description' => 'Travel can change quickly, and our service should be equally responsive. From urgent requests and itinerary changes to schedule disruptions and on-ground challenges, we work quickly to keep the journey moving.' ),
				),
			),
			'team'                   => array(
				'bg'        => 'bg-gradient-to-b from-brand-blue-pale via-brand-surface to-brand-surface',
				'eyebrow'   => 'Our Team',
				'title'     => 'People Who',
				'highlight' => 'Understand Travel',
				'text1'     => 'Beyond Journey Tourism was founded by a group of friends with a shared passion for travel and a collective background in the tourism industry.',
				'text2'     => 'With more than 15 years of combined tourism experience, our founders bring practical industry knowledge together with a genuine understanding of the traveller’s perspective. We believe that the best travel experiences are created by people who understand what travellers expect, what can go wrong, and how important reliable support can be throughout a journey.',
				'tagline'   => 'People who have been travellers. Now planning for you.',
				'image'     => 'https://images.unsplash.com/photo-1522071820081-009f0129c71c',
				'alt'       => 'Travel professionals collaborating around a desk',
			),
			'growth'                 => array(
				'bg'        => 'bg-white',
				'eyebrow'   => 'Looking Ahead',
				'title'     => 'Expanding the Possibilities',
				'highlight' => 'for Every Journey',
				'text1'     => 'Beyond Journey Tourism is focused on building a strong and sustainable presence across the travel industry. Over the coming years, we aim to strengthen our position as a leading DMC and outbound tour operator while expanding our international destination network and developing new source markets.',
				'text2'     => 'Our growth will be driven by strong partnerships, destination expertise, customer-focused service, and a commitment to delivering consistently high standards. We are not simply expanding our destinations — we are expanding the possibilities for every journey.',
			),
			'commitment'             => array(
				'bg'        => 'bg-brand-blue-mist',
				'eyebrow'   => 'Our Commitment',
				'title'     => 'To make every journey easier, more inspiring,',
				'highlight' => 'and more memorable.',
				'text'      => 'Whether you are discovering the wonders of Dubai, planning your next international escape, travelling with family and friends, or organizing a corporate journey, our team is here to turn your travel plans into meaningful experiences.',
			),
			'stats'                  => array(
				'indicators' => bj_indicators(),
			),
			'final-cta'              => array(
				'eyebrow'       => 'Start Planning',
				'title'         => 'Let’s Plan Your',
				'title2'        => 'Next Journey',
				'text'          => 'Every memorable journey starts with the right plan. Whether you are planning an international holiday, a family vacation, a honeymoon, a group tour, a corporate trip, or a UAE experience — we are ready to help.',
				'button_text'   => 'Plan Your Journey',
				'button_url'    => '/contact/',
				'show_whatsapp' => 'yes',
				'whatsapp_text' => 'WhatsApp Us',
				'image'         => 'https://images.unsplash.com/photo-1476514525535-07fb3b4ae5f1',
				'alt'           => 'Wooden boat on an alpine lake surrounded by mountains',
			),
			'contact'                => array(
				'eyebrow'      => 'Get in Touch',
				'title'        => 'Let’s Plan Your',
				'highlight'    => 'Next Journey',
				'text'         => 'Share your destination, travel dates, number of travellers, and what matters most to you. Our team will work with you to develop suitable options and coordinate the arrangements.',
				'form_title'   => 'Plan Your Journey',
				'form_text'    => 'Share a few details and our team will get back to you.',
				'button_text'  => 'Send Enquiry',
				'done_title'   => 'Thank You!',
				'done_text'    => 'We have received your enquiry and will get back to you shortly.',
			),
			'packages'               => array(
				'eyebrow'      => 'Holiday Packages',
				'title'        => 'Popular',
				'highlight'    => 'Packages',
				'lead'         => 'Ready-made holidays with hotel, transfers and excursions included. Tell us your dates and we will tailor the rest.',
				'limit'        => '4',
				'enquire_text' => 'Enquire now',
				'button_text'  => 'View All Packages',
				'button_url'   => '/packages/',
				'note'         => '*Starting prices per adult, subject to availability and travel dates.',
			),
			'packages-showcase'      => array(
				'grid_eyebrow'   => 'All Packages',
				'grid_title'     => 'Choose Your',
				'grid_highlight' => 'Next Holiday',
				'grid_lead'      => 'Every package includes hotel stay, transfers and excursions. Send an enquiry and our team will confirm availability for your dates.',
				'note'           => '*Starting prices per adult, subject to availability and travel dates. Flights and visas can be added on request.',
			),
			'site-footer'            => array(
				'about'             => 'Tours, holidays and complete travel services — inbound to the UAE and outbound to the world, planned by one reliable team in Dubai.',
				'show_icons'        => 'yes',
				'links_title'       => 'Quick Links',
				'services_title'    => 'Our Services',
				'contact_title'     => 'Get in Touch',
				'show_skyline'      => 'yes',
				'copyright'         => '© Copyright {year} Beyond Journey Tourism. All rights reserved.',
				'credit_text'       => 'Powered By',
				'credit_name'       => 'Skybookdigital',
				'credit_url'        => array(
					'url'         => 'https://skybookdigital.com',
					'is_external' => 'on',
					'nofollow'    => '',
				),
				'show_bottom_links' => 'yes',
			),
			'destinations-directory' => array(
				'eyebrow'           => '{count} Destinations',
				'title'             => 'Where We Can',
				'highlight'         => 'Take You',
				'lead'              => 'Every destination below is planned directly by our team or through carefully selected local DMC and destination partners.',
				'card_url'          => '/contact/',
				'destinations'      => bj_destinations(),
				'regions_eyebrow'   => 'Browse by Region',
				'regions_title'     => 'A Growing',
				'regions_highlight' => 'Destination Network',
				'region_order'      => implode( "\n", bj_region_order() ),
				'region_colors'     => implode( "\n", array( '#F47B20', '#7C5CC4', '#1FA2B8', '#3BA55C', '#1B7FBF', '#E0533D', '#D4A017', '#2E6FD8' ) ),
				'note'              => 'Our destination coverage is delivered directly or through carefully selected local DMC and destination partners, chosen for quality, reliability, and expertise.',
				'button_text'       => 'Enquire About a Destination',
				'button_url'        => '/contact/',
			),
			'dmc-groups'             => array(
				'eyebrow'   => 'What We Handle',
				'title'     => 'Ground Handling,',
				'highlight' => 'End to End',
				'lead'      => 'From arrival to departure, one accountable team coordinates every element on the ground.',
				// "tint" is the pastel tile behind the icon, "ink" the icon and outline colour.
				'groups'    => array(
					array( 'title' => 'Arrival & Transport', 'icon' => 'plane', 'tint' => '#FDE7D6', 'ink' => '#F47B20', 'items' => "Airport meet and greet\nAirport transfers\nLocal transportation" ),
					array( 'title' => 'Stay & Experiences', 'icon' => 'building-office', 'tint' => '#DDF0E3', 'ink' => '#2E9E62', 'items' => "Hotel reservations\nTours and activity bookings\nAttraction arrangements\nProfessional guides" ),
					array( 'title' => 'Groups & MICE', 'icon' => 'users', 'tint' => '#E3ECF4', 'ink' => '#1B7FBF', 'items' => "Group coordination\nConsolidated group documentation\nGround-handling services" ),
					array( 'title' => 'Partner Support', 'icon' => 'support', 'tint' => '#F6E1EB', 'ink' => '#C04A86', 'items' => "Travel agent coordination\nDirect communication with the ground team\nOn-ground issue resolution" ),
				),
			),
			'dmc-partners'           => array(
				'eyebrow'            => 'For Travel Agents & Partners',
				'title'              => 'One Accountable Team',
				'highlight'          => 'on the Ground',
				'text1'              => 'Travel agents, tour operators and corporate partners can rely on one local team for their UAE arrangements — arrival transfers, hotels, tours, guides and event logistics.',
				'text2'              => 'We confirm services promptly, share clear itineraries and keep you informed while your travellers are on the ground.',
				'text3'              => 'Whether it is a small private group or a large incentive programme, every arrangement is coordinated end to end.',
				'multilingual_title' => 'Dedicated Coordination',
				'multilingual_text'  => 'Each booking is handled by a coordinator who knows the details, so you and your travellers always have someone to talk to.',
				'contact_label'      => 'One Point of Contact',
				'contact_text'       => 'One accountable team from booking confirmation to departure, with on-ground issue resolution whenever plans change.',
			),
		);
	}

	return isset( $all[ $section ] ) ? $all[ $section ] : array();
}

/**
 * Section order of each designed page, with the settings that differ from the section defaults.
 *
 * @return array[] Slug => list of array( section, overrides ).
 */
function bj_page_layouts() {
	$heroes = bj_page_heroes();

	return array(
		'home'         => array(
			array( 'hero', array() ),
			array( 'about-intro', array() ),
			array( 'destinations', array() ),
			array( 'packages', array() ),
			array( 'hotels', array() ),
			array( 'inbound', array() ),
			array(
				'services',
				array(
					'layout' => 'pillars',
					'bg'     => 'bg-gradient-to-b from-brand-surface via-white to-white',
				),
			),
			array( 'why-us', array() ),
			array( 'dmc', array() ),
			array( 'contact', array() ),
		),
		'about'        => array(
			array( 'page-hero', $heroes['about'] ),
			array(
				'about-intro',
				array(
					'button1_text' => 'Discover What We Do',
					'button1_url'  => '/services/',
					'button2_text' => 'Talk to Our Team',
					'button2_url'  => '/contact/',
				),
			),
			array( 'vision-mission', array( 'bg' => 'bg-brand-surface' ) ),
			array( 'core-values', array() ),
			array( 'team', array( 'bg' => 'bg-white' ) ),
			array( 'commitment', array() ),
		),
		'services'     => array(
			array( 'page-hero', $heroes['services'] ),
			array(
				'services',
				array(
					'layout'       => 'grouped',
					'show_heading' => '',
				),
			),
		),
		'destinations' => array(
			array( 'page-hero', $heroes['destinations'] ),
			array( 'destinations-directory', array() ),
		),
		'packages'     => array(
			array( 'packages-showcase', array() ),
		),
		'dmc'          => array(
			array( 'page-hero', $heroes['dmc'] ),
			array(
				'dmc',
				array(
					'title'        => 'Local Knowledge.',
					'highlight'    => 'On-Ground Support.',
					'show_button2' => '',
				),
			),
			array( 'dmc-groups', array() ),
			array( 'dmc-partners', array() ),
		),
		'why-us'       => array(
			array( 'page-hero', $heroes['why-us'] ),
			array(
				'why-us',
				array(
					'show_heading' => '',
					'show_cta'     => 'yes',
				),
			),
		),
		'contact'      => array(
			array( 'page-hero', $heroes['contact'] ),
			array(
				'contact',
				array(
					'title'     => 'Talk to Our',
					'highlight' => 'Travel Team',
					'text'      => 'Call, message us on WhatsApp, email us, or send the form. A member of our team will get back to you with suitable options for your trip.',
				),
			),
		),
	);
}
