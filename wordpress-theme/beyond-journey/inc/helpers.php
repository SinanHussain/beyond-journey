<?php
/**
 * Shared helpers: class strings, links, images, headings, layouts and Elementor detection.
 *
 * @package Beyond_Journey
 */

defined( 'ABSPATH' ) || exit;

const BJ_H2         = 'text-[1.75rem] font-bold leading-[1.15] text-brand-heading sm:text-3xl lg:text-[2.5rem]';
const BJ_EYEBROW    = 'mb-2.5 text-xs font-semibold uppercase tracking-[0.18em] text-brand-orange sm:text-sm';
const BJ_BTN_ORANGE = 'rounded-lg bg-brand-orange px-7 py-3.5 text-center font-semibold text-white transition-all duration-300 hover:-translate-y-0.5 hover:bg-brand-orange-dark hover:shadow-lg hover:shadow-brand-orange/25';
const BJ_BTN_BLUE   = 'rounded-lg bg-brand-blue px-7 py-3.5 text-center font-semibold text-white transition-all duration-300 hover:-translate-y-0.5 hover:bg-brand-blue-dark hover:shadow-lg hover:shadow-brand-blue/25';
const BJ_BTN_GHOST  = 'rounded-lg border border-brand-blue/20 bg-white px-6 py-3.5 text-center font-semibold text-brand-blue transition-all duration-300 hover:-translate-y-0.5 hover:border-brand-blue/40 hover:shadow-md';

/**
 * Unsplash image URL at a given width (same parameters as the original site).
 *
 * @param string $base    Image URL without query string.
 * @param int    $width   Width in pixels.
 * @param int    $quality JPEG quality.
 * @return string
 */
function bj_img( $base, $width, $quality = 75, $ratio = 0 ) {
	$size = 'w=' . (int) $width;
	if ( $ratio > 0 ) {
		// Ask Unsplash for the crop the layout shows, instead of a wide photo the browser throws half of away.
		$size .= '&h=' . (int) round( $width / $ratio );
	}
	return $base . '?auto=format&fit=crop&' . $size . '&q=' . (int) $quality;
}

/**
 * Image URL from a section value: a Media Library item (Elementor media array) or a plain URL.
 * Unsplash URLs get the size parameters.
 *
 * @param array|string $media   Media array (id, url) or URL.
 * @param int          $width   Display width.
 * @param int          $quality Unsplash quality.
 * @return string
 */
function bj_media_src( $media, $width, $quality = 75, $ratio = 0 ) {
	if ( is_array( $media ) ) {
		if ( ! empty( $media['id'] ) ) {
			$src = wp_get_attachment_image_url( (int) $media['id'], $width > 1000 ? 'full' : 'large' );
			if ( $src ) {
				return $src;
			}
		}
		$media = isset( $media['url'] ) ? $media['url'] : '';
	}
	$media = (string) $media;
	if ( false !== strpos( $media, 'images.unsplash.com' ) && false === strpos( $media, '?' ) ) {
		return bj_img( $media, $width, $quality, $ratio );
	}
	return $media;
}

/**
 * Alt text: the typed text, or the Media Library alt text.
 *
 * @param array|string $media Media array or URL.
 * @param string       $alt   Typed alt text.
 * @return string
 */
function bj_media_alt( $media, $alt ) {
	if ( '' !== trim( (string) $alt ) ) {
		return (string) $alt;
	}
	if ( is_array( $media ) && ! empty( $media['id'] ) ) {
		return (string) get_post_meta( (int) $media['id'], '_wp_attachment_image_alt', true );
	}
	return '';
}

/**
 * Link URL from a section value: an Elementor link array or a string. "/page/" links are made site-relative.
 *
 * @param array|string $link Link value.
 * @return string
 */
function bj_href( $link ) {
	$url = trim( is_array( $link ) ? ( isset( $link['url'] ) ? (string) $link['url'] : '' ) : (string) $link );
	if ( '' !== $url && '/' === $url[0] && ( ! isset( $url[1] ) || '/' !== $url[1] ) ) {
		$url = home_url( $url );
	}
	return $url;
}

/**
 * href plus target/rel attributes for a link value.
 *
 * @param array|string $link Link value.
 * @return string Escaped attributes, starting with a space.
 */
function bj_link_attrs( $link ) {
	$attrs = ' href="' . esc_url( bj_href( $link ) ) . '"';
	if ( is_array( $link ) ) {
		$rel = array();
		if ( ! empty( $link['is_external'] ) ) {
			$attrs .= ' target="_blank"';
			$rel[]  = 'noopener';
			$rel[]  = 'noreferrer';
		}
		if ( ! empty( $link['nofollow'] ) ) {
			$rel[] = 'nofollow';
		}
		if ( $rel ) {
			$attrs .= ' rel="' . esc_attr( implode( ' ', $rel ) ) . '"';
		}
	}
	return $attrs;
}

/**
 * Items of a "one per line" list.
 *
 * @param array|string $value Lines or array.
 * @return string[]
 */
function bj_lines( $value ) {
	$items = is_array( $value ) ? $value : preg_split( '/\r\n|\r|\n/', (string) $value );
	return array_values( array_filter( array_map( 'trim', $items ), 'strlen' ) );
}

/**
 * Title HTML with an optional highlighted part.
 *
 * @param string $title     Plain part.
 * @param string $highlight Highlighted part.
 * @param string $class     Highlight class.
 * @param bool   $break     Line break before the highlight.
 * @return string
 */
function bj_title( $title, $highlight = '', $class = 'text-brand-heading-soft', $break = false ) {
	$html = esc_html( $title );
	if ( '' !== trim( (string) $highlight ) ) {
		$glue  = $break ? '<br>' : ( '' !== trim( (string) $title ) ? ' ' : '' );
		$html .= $glue . '<span class="' . esc_attr( $class ) . '">' . esc_html( $highlight ) . '</span>';
	}
	return $html;
}

/**
 * Prints a link button when it has text.
 *
 * @param string       $text  Button text.
 * @param array|string $link  Link value.
 * @param string       $class Classes.
 * @param bool         $arrow Append the hover arrow.
 */
function bj_button( $text, $link, $class, $arrow = false ) {
	if ( '' === trim( (string) $text ) ) {
		return;
	}
	echo '<a' . bj_link_attrs( $link ) . ' class="' . esc_attr( $class ) . '">' . esc_html( $text ) . ( $arrow ? bj_arrow_svg() : '' ) . '</a>'; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped -- escaped above; static SVG.
}

/**
 * Prints a paragraph when it has text.
 *
 * @param string $text  Paragraph text.
 * @param string $class Classes.
 */
function bj_p( $text, $class ) {
	if ( '' !== trim( (string) $text ) ) {
		echo '<p class="' . esc_attr( $class ) . '">' . esc_html( $text ) . '</p>';
	}
}

/**
 * Permalink of one of the site pages by slug ('' is the home page).
 * Falls back to /slug/ when the page has not been created yet.
 *
 * @param string $slug Page slug.
 * @return string
 */
function bj_url( $slug = '' ) {
	static $cache = array();

	$slug = trim( $slug, '/' );
	if ( '' === $slug ) {
		return home_url( '/' );
	}
	if ( ! isset( $cache[ $slug ] ) ) {
		$page           = get_page_by_path( $slug );
		$cache[ $slug ] = $page ? get_permalink( $page ) : home_url( '/' . $slug . '/' );
	}
	return $cache[ $slug ];
}

/**
 * Marks the current request as one of the designed pages (set before get_header()).
 *
 * @param bool|null $set New value, or null to read.
 * @return bool
 */
function bj_is_designed( $set = null ) {
	static $flag = false;
	if ( null !== $set ) {
		$flag = (bool) $set;
	}
	return $flag;
}

/**
 * Content of a section: the given values over the section defaults.
 *
 * @param string $section Section name.
 * @param array  $args    Values (template args or Elementor settings).
 * @return array
 */
function bj_section_content( $section, $args ) {
	return array_merge( bj_section_defaults( $section ), is_array( $args ) ? $args : array() );
}

/**
 * Loads a section template part.
 *
 * @param string $name Section name.
 * @param array  $args Section values.
 */
function bj_section( $name, $args = array() ) {
	get_template_part( 'template-parts/sections/' . $name, null, bj_section_content( $name, $args ) );
}

/**
 * Renders the default section layout of a designed page.
 *
 * @param string $slug Page layout key.
 */
function bj_render_layout( $slug ) {
	$layouts = bj_page_layouts();
	if ( empty( $layouts[ $slug ] ) ) {
		return;
	}
	foreach ( $layouts[ $slug ] as $block ) {
		bj_section( $block[0], $block[1] );
	}
}

/** Whether Elementor is loaded. */
function bj_elementor_ready() {
	return did_action( 'elementor/loaded' ) && class_exists( '\Elementor\Plugin' );
}

/** Whether the request is the Elementor editor preview. */
function bj_is_elementor_preview() {
	if ( ! bj_elementor_ready() ) {
		return false;
	}
	$preview = \Elementor\Plugin::$instance->preview;
	return $preview && $preview->is_preview_mode();
}

/**
 * Whether a page is shown with its Elementor layout (or is open in the Elementor editor).
 *
 * @param int $post_id Page ID, defaults to the current page.
 * @return bool
 */
function bj_is_elementor_page( $post_id = 0 ) {
	if ( ! bj_elementor_ready() ) {
		return false;
	}
	$post_id = $post_id ? (int) $post_id : get_queried_object_id();
	if ( ! $post_id ) {
		return false;
	}
	$plugin = \Elementor\Plugin::$instance;
	if ( $plugin->preview && $plugin->preview->is_preview_mode( $post_id ) ) {
		return true;
	}
	$document = $plugin->documents->get( $post_id );
	return $document && $document->is_built_with_elementor() && ! empty( $document->get_elements_data() );
}

/**
 * Renders a designed page: its Elementor layout when it has one, otherwise the built-in layout.
 *
 * @param string $slug Page layout key.
 */
function bj_render_page( $slug ) {
	bj_is_designed( true );
	get_header();
	if ( bj_is_elementor_page() ) {
		while ( have_posts() ) {
			the_post();
			the_content();
		}
	} else {
		bj_render_layout( $slug );
	}
	get_footer();
}

/**
 * Centered section heading (eyebrow, title, accent rule, lead).
 *
 * @param string $eyebrow Small label above the title.
 * @param string $title   Title HTML (see bj_title()).
 * @param string $lead    Optional lead paragraph.
 * @param string $class   Wrapper spacing class, defaults to mb-10.
 * @param string $tone    'on-blue' for dark backgrounds.
 */
function bj_heading( $eyebrow, $title, $lead = '', $class = '', $tone = '' ) {
	$on_blue = ( 'on-blue' === $tone );

	echo '<div class="aos text-center ' . esc_attr( $class ? $class : 'mb-10' ) . '">';
	if ( '' !== trim( (string) $eyebrow ) ) {
		echo '<p class="mb-2.5 text-xs font-semibold uppercase tracking-[0.18em] sm:text-sm ' . ( $on_blue ? 'text-brand-orange-light' : 'text-brand-orange' ) . '">' . esc_html( $eyebrow ) . '</p>';
	}
	echo '<h2 class="text-[1.75rem] sm:text-3xl lg:text-[2.5rem] font-bold leading-[1.15] ' . ( $on_blue ? 'text-white' : 'text-brand-heading' ) . '">' . wp_kses_post( $title ) . '</h2>';
	echo '<span class="section-accent-center' . ( $on_blue ? ' section-accent-on-blue' : '' ) . '"></span>';
	if ( '' !== trim( (string) $lead ) ) {
		echo '<p class="mx-auto mt-4 max-w-2xl leading-relaxed ' . ( $on_blue ? 'text-white' : 'text-brand-gray' ) . '">' . esc_html( $lead ) . '</p>';
	}
	echo '</div>';
}

/** Soft blue and orange glows on light sections. */
function bj_glow() {
	echo '<div aria-hidden="true" class="pointer-events-none absolute inset-0 overflow-hidden">' .
		'<div class="absolute -left-40 -top-36 h-96 w-96 rounded-full" style="background-image:radial-gradient(closest-side,rgba(27,127,191,.10),transparent)"></div>' .
		'<div class="absolute -bottom-40 -right-36 h-[26rem] w-[26rem] rounded-full" style="background-image:radial-gradient(closest-side,rgba(244,123,32,.07),transparent)"></div></div>';
}

/** White and orange glows on blue sections. */
function bj_glow_blue() {
	echo '<div aria-hidden="true" class="pointer-events-none absolute inset-0 overflow-hidden">' .
		'<div class="absolute -left-40 -top-36 h-96 w-96 rounded-full" style="background-image:radial-gradient(closest-side,rgba(255,255,255,.15),transparent)"></div>' .
		'<div class="absolute -bottom-40 -right-36 h-[26rem] w-[26rem] rounded-full" style="background-image:radial-gradient(closest-side,rgba(244,123,32,.20),transparent)"></div></div>';
}

/** Tinted landscape photo behind blue sections and the footer. */
function bj_footer_image_url() {
	return bj_img( BJ_FOOTER_IMAGE, 1920, 72 ) . '&con=80&sat=30';
}

/** Scenic photo layer with blue overlays. */
function bj_scenic() {
	echo '<div aria-hidden="true" class="pointer-events-none absolute inset-0 isolate overflow-hidden">' .
		'<img src="' . esc_url( bj_footer_image_url() ) . '" alt="" loading="lazy" decoding="async" class="absolute inset-0 h-full w-full object-cover object-[center_30%]">' .
		'<div class="absolute inset-0 bg-gradient-to-b from-brand-blue/80 via-brand-blue/80 to-brand-blue-dark/90"></div>' .
		'<div class="absolute inset-0 bg-gradient-to-r from-brand-blue-dark/55 via-brand-blue-dark/15 to-transparent"></div></div>';
}

/**
 * Logo URL: the Customizer logo when set, otherwise the bundled one.
 * The light logo is shown over the banner photo, the dark one once the page is scrolled.
 *
 * @param string $variant 'dark' (default) or 'light'.
 * @return string
 */
function bj_logo_url( $variant = 'dark' ) {
	if ( 'light' === $variant ) {
		$light = get_theme_mod( 'bj_logo_light' );
		return $light ? $light : BJ_URI . '/assets/images/logo-light.webp';
	}

	$logo_id = get_theme_mod( 'custom_logo' );
	if ( $logo_id ) {
		$src = wp_get_attachment_image_url( $logo_id, 'full' );
		if ( $src ) {
			return $src;
		}
	}
	return BJ_URI . '/assets/images/logo.png';
}

/**
 * A colour safe to place in a style attribute: a hex value, or the fallback.
 *
 * @param string $value    Colour typed in the panel.
 * @param string $fallback Colour used when the value is not a hex colour.
 * @return string
 */
function bj_color( $value, $fallback = '#1B7FBF' ) {
	$value = trim( (string) $value );
	return preg_match( '/^#([0-9a-f]{3}|[0-9a-f]{6})$/i', $value ) ? $value : $fallback;
}

/** tel: link for the phone number setting. */
function bj_tel_url() {
	return 'tel:' . preg_replace( '/[^0-9+]/', '', bj_setting( 'phone' ) );
}

/** wa.me link for the WhatsApp number setting. */
function bj_whatsapp_url() {
	return 'https://wa.me/' . preg_replace( '/\D/', '', bj_setting( 'whatsapp' ) );
}

/** Website setting without the scheme, for display. */
function bj_website_label() {
	return untrailingslashit( preg_replace( '#^https?://(www\.)?#i', '', bj_setting( 'website' ) ) );
}
