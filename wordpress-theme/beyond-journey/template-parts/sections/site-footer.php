<?php
/**
 * Site footer: logo, about text and icons, Quick Links (the main menu), Our Services (Footer Services menu),
 * contact details, Dubai skyline and the bottom bar. Contact details and social links come from
 * Appearance > Customize > Beyond Journey Settings; the texts here can be edited in Elementor (Appearance > Edit Footer).
 *
 * @package Beyond_Journey
 */

defined( 'ABSPATH' ) || exit;

$c            = $args;
$bj_card_link = 'flex h-9 w-9 items-center justify-center rounded-lg bg-white text-brand-blue shadow-sm ring-1 ring-white/40 transition-colors hover:text-white';
?>
<footer class="site-footer">
	<div class="footer-body">
		<div class="footer-inner relative z-10 mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
			<div class="footer-grid">
				<div>
					<img id="footer-logo" src="<?php echo esc_url( bj_logo_url( 'light' ) ); ?>" alt="<?php esc_attr_e( 'Beyond Journey Tourism', 'beyond-journey' ); ?>" loading="lazy" class="footer-logo-img w-auto">
					<?php bj_p( $c['about'], 'footer-about' ); ?>
					<?php if ( 'yes' === $c['show_icons'] ) : ?>
					<div class="footer-social">
					<a href="<?php echo esc_url( bj_whatsapp_url() ); ?>" target="_blank" rel="noopener noreferrer" aria-label="<?php esc_attr_e( 'Contact us on WhatsApp', 'beyond-journey' ); ?>" class="<?php echo esc_attr( $bj_card_link ); ?> hover:bg-brand-orange">
						<?php echo bj_whatsapp_svg( 'h-4 w-4' ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped -- static SVG. ?>
					</a>
					<a href="<?php echo esc_url( 'mailto:' . bj_setting( 'email' ) ); ?>" aria-label="<?php echo esc_attr( sprintf( /* translators: %s: email address. */ __( 'Email Beyond Journey Tourism at %s', 'beyond-journey' ), bj_setting( 'email' ) ) ); ?>" class="<?php echo esc_attr( $bj_card_link ); ?> hover:bg-brand-blue">
						<?php echo bj_svg( 'mail', 'h-4 w-4' ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped -- static SVG. ?>
					</a>
					<a href="<?php echo esc_url( bj_setting( 'website' ) ); ?>" aria-label="<?php esc_attr_e( 'Beyond Journey Tourism website', 'beyond-journey' ); ?>" class="<?php echo esc_attr( $bj_card_link ); ?> hover:bg-brand-blue">
						<?php echo bj_svg( 'globe', 'h-4 w-4' ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped -- static SVG. ?>
					</a>
					<?php foreach ( bj_social_networks() as $bj_network => $bj_network_name ) : ?>
						<?php $bj_social_url = bj_setting( $bj_network ); ?>
						<?php if ( $bj_social_url ) : ?>
							<a href="<?php echo esc_url( $bj_social_url ); ?>" target="_blank" rel="noopener noreferrer" aria-label="<?php echo esc_attr( sprintf( /* translators: %s: social network. */ __( 'Beyond Journey Tourism on %s', 'beyond-journey' ), $bj_network_name ) ); ?>" class="<?php echo esc_attr( $bj_card_link ); ?> hover:bg-brand-blue">
								<?php echo bj_social_svg( $bj_network, 'h-4 w-4' ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped -- static SVG. ?>
							</a>
						<?php endif; ?>
					<?php endforeach; ?>
					</div>
					<?php endif; ?>
				</div>
				<nav aria-label="<?php esc_attr_e( 'Quick links', 'beyond-journey' ); ?>">
					<h2 class="footer-h"><?php echo esc_html( $c['links_title'] ); ?></h2>
					<ul id="footer-links" class="footer-list"><?php bj_footer_links(); ?></ul>
				</nav>
				<nav aria-label="<?php esc_attr_e( 'Services', 'beyond-journey' ); ?>">
					<h2 class="footer-h"><?php echo esc_html( $c['services_title'] ); ?></h2>
					<ul id="footer-services" class="footer-list"><?php bj_footer_list( 'footer_services', bj_footer_defaults( 'services' ) ); ?></ul>
				</nav>
				<div>
					<h2 class="footer-h"><?php echo esc_html( $c['contact_title'] ); ?></h2>
					<ul class="footer-contact">
						<li><a href="<?php echo esc_url( bj_tel_url() ); ?>"><span class="footer-ci"><?php echo bj_svg( 'phone' ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped -- static SVG. ?></span><?php echo esc_html( bj_setting( 'phone' ) ); ?></a></li>
						<li><a href="<?php echo esc_url( bj_whatsapp_url() ); ?>" target="_blank" rel="noopener noreferrer"><span class="footer-ci"><?php echo bj_whatsapp_svg( '' ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped -- static SVG. ?></span><?php esc_html_e( 'WhatsApp', 'beyond-journey' ); ?></a></li>
						<li><a href="<?php echo esc_url( 'mailto:' . bj_setting( 'email' ) ); ?>"><span class="footer-ci"><?php echo bj_svg( 'mail' ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped -- static SVG. ?></span><?php echo esc_html( bj_setting( 'email' ) ); ?></a></li>
						<li><span class="footer-row"><span class="footer-ci"><?php echo bj_svg( 'pin' ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped -- static SVG. ?></span><?php echo esc_html( bj_setting( 'location' ) ); ?></span></li>
					</ul>
				</div>
			</div>
		</div>
		<?php // Faint Dubai skyline (Burj Khalifa at the centre, Emirates Towers, Burj Al Arab) with two planes above it. ?>
		<?php if ( 'yes' === $c['show_skyline'] ) : ?>
		<div class="footer-sil" aria-hidden="true"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 220" preserveAspectRatio="xMidYMax meet" aria-hidden="true" focusable="false"><g fill="currentColor"><path d="M20,216 V185 Q27,175 34,185 V216 Z"/><rect x="36" y="159" width="10" height="57"/><path d="M50,216 V189 L68,180 V216 Z"/><path d="M70,216 V164 Q75,157 80,164 V216 Z"/><path d="M82,216 V185 L94,173 V216 Z"/><rect x="96" y="153" width="24" height="63"/><path d="M123,216 V146 L143,140 V216 Z"/><rect x="149" y="170" width="10" height="46"/><path d="M162,216 V157 L169,139 L176,157 V216 Z"/><path d="M178,216 V163 L196,155 V216 Z"/><rect x="198" y="145" width="18" height="71"/><rect x="206" y="129" width="2" height="16"/><path d="M219,216 V173 L233,166 V216 Z"/><path d="M235,216 V165 Q244,152 253,165 V216 Z"/><path d="M259,216 V156 Q271,139 283,156 V216 Z"/><path d="M289,216 V154 L296,132 L303,154 V216 Z"/><rect x="306" y="157" width="20" height="59"/><path d="M330,216 V139 H333 V129 H345 V139 H348 V216 Z"/><rect x="354" y="130" width="14" height="86"/><path d="M370,216 V141 L379,119 L388,141 V216 Z"/><path d="M434,216 V131 Q440,122 446,131 V216 Z"/><path d="M448,216 V157 L468,146 V216 Z"/><path d="M472,216 V137 L492,124 V216 Z"/><path d="M498,216 V152 H501 V142 H505 V152 H508 V216 Z"/><rect x="514" y="152" width="20" height="64"/><rect x="538" y="118" width="20" height="98"/><rect x="547" y="102" width="2" height="16"/><rect x="564" y="128" width="14" height="88"/><rect x="570" y="112" width="2" height="16"/><path d="M582,216 V121 H585 V111 H589 V121 H592 V216 Z"/><path d="M595,216 V142 Q604,129 613,142 V216 Z"/><path d="M615,216 V130 L621,109 L627,130 V216 Z"/><path d="M630,216 V122 Q638,110 646,122 V216 Z"/><path d="M648,216 V117 Q654,108 660,117 V216 Z"/><path d="M784,216 V118 L796,108 V216 Z"/><path d="M802,216 V122 L809,110 L816,122 V216 Z"/><path d="M818,216 V138 L824,118 L830,138 V216 Z"/><path d="M833,216 V117 L843,109 V216 Z"/><path d="M847,216 V149 L854,133 L861,149 V216 Z"/><path d="M865,216 V115 H868 V105 H880 V115 H883 V216 Z"/><path d="M886,216 V121 L906,115 V216 Z"/><path d="M912,216 V120 Q924,103 936,120 V216 Z"/><rect x="942" y="132" width="16" height="84"/><rect x="964" y="134" width="20" height="82"/><path d="M987,216 V147 Q992,140 997,147 V216 Z"/><path d="M1000,216 V140 L1010,134 V216 Z"/><path d="M1084,216 V132 L1089,114 L1094,132 V216 Z"/><rect x="1096" y="130" width="14" height="86"/><path d="M1112,216 V157 L1136,145 V216 Z"/><path d="M1139,216 V156 H1142 V146 H1156 V156 H1159 V216 Z"/><rect x="1163" y="167" width="16" height="49"/><path d="M1185,216 V146 Q1193,134 1201,146 V216 Z"/><rect x="1205" y="169" width="10" height="47"/><path d="M1219,216 V163 Q1229,149 1239,163 V216 Z"/><path d="M1242,216 V180 L1251,162 L1260,180 V216 Z"/><rect x="1264" y="148" width="12" height="68"/><rect x="1280" y="178" width="20" height="38"/><rect x="1289" y="162" width="2" height="16"/><path d="M1304,216 V162 L1313,147 L1322,162 V216 Z"/><path d="M1325,216 V153 L1343,142 V216 Z"/><path d="M1346,216 V177 L1355,161 L1364,177 V216 Z"/><path d="M1367,216 V157 Q1373,148 1379,157 V216 Z"/><rect x="1383" y="191" width="20" height="25"/><path d="M1407,216 V177 L1415,156 L1423,177 V216 Z"/><path d="M694,216 L702,150 L706,150 L709,110 L713,110 L715,76 L719,76 L720,44 L722,44 L723,14 L724,0 L725,14 L726,44 L728,44 L729,76 L733,76 L735,110 L739,110 L742,150 L746,150 L754,216 Z"/><rect x="668" y="140" width="14" height="76"/><rect x="760" y="132" width="14" height="84"/><path d="M386,216 V100 L402,84 V216 Z"/><path d="M408,216 V122 L422,110 V216 Z"/><path d="M1018,216 L1022,120 L1026,120 Q1066,150 1074,216 Z"/><rect x="1020" y="110" width="2" height="12"/><rect x="0" y="214" width="1440" height="6"/><path transform="translate(560 58) rotate(78) scale(1.25) translate(-12 -12)" d="M21 16v-2l-8-5V3.5a1.5 1.5 0 0 0-3 0V9l-8 5v2l8-2.5V19l-2 1.5V22l3.5-1 3.5 1v-1.5L13 19v-5.5l8 2.5z"/><path transform="translate(1230 40) rotate(96) scale(1) translate(-12 -12)" d="M21 16v-2l-8-5V3.5a1.5 1.5 0 0 0-3 0V9l-8 5v2l8-2.5V19l-2 1.5V22l3.5-1 3.5 1v-1.5L13 19v-5.5l8 2.5z"/></g></svg></div>
		<?php endif; ?>
		<div class="footer-bottom">
			<div class="mx-auto flex max-w-7xl flex-col items-center justify-between gap-2 px-4 py-5 text-center sm:flex-row sm:gap-3 sm:px-6 sm:text-left lg:px-8">
				<p class="text-xs text-white/75"><?php echo esc_html( str_replace( '{year}', wp_date( 'Y' ), $c['copyright'] ) ); ?>
					<?php if ( '' !== trim( (string) $c['credit_name'] ) ) : ?>
						<span class="footer-credit"><?php echo esc_html( $c['credit_text'] ); ?> <a<?php echo bj_link_attrs( $c['credit_url'] ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped -- escaped in bj_link_attrs(). ?>><?php echo esc_html( $c['credit_name'] ); ?></a></span>
					<?php endif; ?>
				</p>
				<?php if ( 'yes' === $c['show_bottom_links'] ) : ?>
				<p class="text-xs text-white/75"><a href="<?php echo esc_url( bj_setting( 'website' ) ); ?>"><?php echo esc_html( bj_website_label() ); ?></a> <span aria-hidden="true">&middot;</span> <a href="<?php echo esc_url( bj_url( 'contact' ) ); ?>"><?php esc_html_e( 'Contact Us', 'beyond-journey' ); ?></a></p>
				<?php endif; ?>
			</div>
		</div>
	</div>
</footer>
