=== Beyond Journey ===
Requires at least: 6.5
Tested up to: 7.1
Requires PHP: 7.4
Stable tag: 2.5.0
License: GPLv2 or later
License URI: https://www.gnu.org/licenses/gpl-2.0.html

Custom WordPress theme for Beyond Journey Tourism, Dubai. Converted from the original single-file website.
Works with or without Elementor.

== Installation ==

1. Appearance > Themes > Add New Theme > Upload Theme. Choose the theme zip and click Install Now, then Activate.
2. On activation the theme:
   * creates the pages Home, About, Services, Destinations, DMC, Why Us and Contact (pages that already exist are kept),
   * sets Home as the front page (only if the site still shows the latest posts on its front page),
   * creates and assigns the menus "Primary Menu", "Footer Services" and "Footer Destinations" (only where no menu is assigned yet),
   * with Elementor active, builds the Elementor layouts of those pages (pages that already have one are kept).
3. Settings > General: set the Site Title to "Beyond Journey Tourism" and the Tagline to "Explore Beyond Boundaries". They are used in the browser tab titles.
4. Appearance > Customize > Beyond Journey Settings: phone, WhatsApp number, public email, where enquiries are sent, location, website address, social media links and the enquiry popup.

== Editing with Elementor ==

Every section of the site is an Elementor widget in the "Beyond Journey" group:
Home Hero Slideshow, Page Banner, About Intro, Inbound & Outbound, Services, Why Us, DMC & Ground Handling,
Destinations Carousel, Premium Hotels, How We Work, Key Numbers, Vision & Mission, Core Values, Our Team, Looking Ahead,
Our Commitment, Call to Action, Contact & Enquiry Form, Destinations List & Regions, DMC Services Groups and DMC Partners.

* Open a page with "Edit with Elementor", click a section and change its text, photos, buttons and lists in the left panel.
* Sections can be moved, copied or deleted, and Elementor's own widgets can be added between them.
* Sections that appear on several pages (for example Core Values) are separate copies: update each page you want changed.
* A page without an Elementor layout shows the theme's built-in design. To create the layouts later, use the
  "Build Elementor layouts" button on the Dashboard, or run: wp bj build-elementor-pages --user=1 (add --force to rebuild).
* Phone, WhatsApp, location and website are site-wide settings in Appearance > Customize > Beyond Journey Settings.

== Other things to edit in the dashboard ==

* Menus: Appearance > Menus (Primary Menu, Footer Services). The footer "Quick Links" use the Primary Menu.
* Logo and favicon: Appearance > Customize > Site Identity (Logo, Site Icon).
* Other pages (for example Privacy Policy) and blog posts use the normal editor, or Elementor.

Without Elementor, the page content comes from the theme files: inc/content.php (text, lists and page layouts)
and template-parts/sections/*.php (section markup).

== Enquiries ==

Both enquiry forms (Contact section and popup) save every submission under Enquiries in the dashboard
and email it to the address in Beyond Journey Settings. If the emails do not arrive, install an SMTP
plugin such as WP Mail SMTP. Spam protection: a hidden honeypot field and a limit of 5 enquiries per
visitor every 10 minutes.

== Styles and scripts ==

* assets/css/tailwind.css: compiled Tailwind CSS v3 utilities for the classes used in the theme.
  Tailwind v3 only accepts opacity values from its scale (5, 10, 15 ... 95), for example bg-brand-blue/80.
  Regenerate this file after adding new Tailwind classes.
* assets/css/theme.css: custom styles (hero slideshow, animations, carousel, editor content, Elementor fixes).
* assets/js/theme.js: mobile menu, scroll-aware header, banner slideshows, scroll animations, destination carousel, enquiry forms and popup.

== Photos ==

Default photos load from Unsplash (images.unsplash.com), as on the original site. Photos chosen from the
Media Library in Elementor are served from the site.

== Changelog ==

= 2.5.0 =
* Footer editable in Elementor: Appearance > Edit Footer opens the "Site Footer" template (about text, column headings, copyright, credit, skyline and icons on/off). Without Elementor the built-in footer shows.

= 2.4.9 =
* Social links: Facebook, X and LinkedIn icons in the footer and a "Follow us" row in the contact section (new X link setting in Appearance > Customize > Beyond Journey Settings).

= 2.4.8 =
* Packages page hero shows only the package name with the Enquire and View Package buttons (details are on each package page).
* Short card texts (destinations, packages, regions) are left-aligned instead of justified.

= 2.4.3 =
* Package pages: Overview shows a general "About the place" text for the country or city (new package field), instead of the list of sights.

= 2.4.0 =
* Every package has its own page (/package/<name>/): photo banner, overview, day-by-day plan (or a request-the-itinerary box), what's included / not included, hotels, a price box with Enquire and WhatsApp buttons, and more packages.
* New package fields: country, label (Best Seller, New, Group Departure, Limited Offer, Sold Out), travel dates, day-by-day plan, included, not included, hotel details.
* Packages page: country filter tabs; cards link to their package page; the showcase has a View Package button.

= 2.3.1 =
* Enquiry emails are sent from no-reply@ on the site's domain with a matching envelope sender, so they pass SPF/DMARC once the domain's SPF record includes the web host.
* Visitors who give an email address receive a "We received your enquiry" confirmation.
* Each enquiry records whether its emails were handed to the mail server.

= 2.3.0 =
* The Packages page is built with Elementor. Its "Holiday Packages (showcase page)" widget has a Packages list: edits saved there update Dashboard > Packages and the homepage cards. Dashboard > Packages has an "Edit with Elementor" button.
* Packages get the same motion as the other sections: photos build in strip by strip and drift as you scroll, and the Packages page hero animates in.

= 2.2.1 =
* Packages page hero redesigned again: the location in a brush-script line above a large title, an orange Enquire button, and photo cards with the name on the photo running off the right edge, with arrows, a progress line and a large counter.

= 2.2.0 =
* Packages page hero redesigned: faded previous/next destinations around the title, a dot rail with the count, cards running off the right edge, arrows with a progress line and a large counter.

= 2.1.3 =
* Homepage packages: more space above the "View All Packages" button.

= 2.1.2 =
* Homepage package cards: the photo fills the whole card and the Enquire button is solid blue.

= 2.1.1 =
* Elementor: "Holiday Packages" widgets registered.

= 2.1.0 =
* Holiday packages: a new Packages section in the dashboard (name, price, duration, hotel, inclusions, photo, homepage tick), a Packages page with a large package showcase and all packages, and package cards on the homepage. "Enquire" opens the enquiry form with the package name filled in.

= 2.0.3 =
* Website address changed to beyondjourney.net everywhere (footer, contact section, enquiry email sender name).
* Footer bottom bar: "Copyright ... Powered By Skybookdigital" credit.

= 2.0.2 =
* Inbound & Outbound cards: text lines up across both cards.

= 2.0.1 =
* Inbound & Outbound cards simplified: tag, title, one line and link (bullet lists removed), shorter cards and left-aligned text.

= 2.0.0 =
* DMC page partner card restyled: two matching rows with an icon tile, bold title and left-aligned text, divided by a thin line.

= 1.9.9 =
* Homepage About and DMC sections back to their full text (the DMC page partners section keeps its own text).

= 1.9.8 =
* Less repetition: the DMC page partners section has its own text; the homepage About and DMC sections are short summaries (full text stays on their pages).

= 1.9.7 =
* Footer art back to the faint Dubai skyline with two planes (scattered planes, suitcases and leaves removed).

= 1.9.6 =
* Footer art a little more visible; the suitcases are now solid shapes (one small outline kept for variety).

= 1.9.5 =
* Footer art: faint scattered planes, suitcases and leaves framing the edges, replacing the skyline; footer height unchanged.

= 1.9.4 =
* Footer: same content with a lighter, minimal design (no dividers, accent lines or icon circles; smaller type and tighter spacing).

= 1.9.3 =
* Construction-style motion: photos (About, hotels, destinations, services) build in strip by strip as they scroll into view, and section headings rise up from behind a line.

= 1.9.2 =
* Services bar: soft light-blue background with blue icons; the items just glide past (no hover highlight, pause or links).

= 1.9.1 =
* Services bar under the home banner: the services now glide past in a continuous loop with soft faded edges; hovering pauses it.

= 1.9.0 =
* Inbound & Outbound: the Inbound card slides in from the left and the Outbound card from the right when scrolled into view.

= 1.8.9 =
* Services bar under the home banner: deep blue bar with five items (Holidays, UAE Tours, Hotels, Visa, Transfers), white icons and one-line names; an orange line slides under the hovered item.

= 1.8.8 =
* Footer: proper space above the columns (the text no longer sits against the top edge).

= 1.8.7 =
* Footer a little shorter: tighter spacing, and the faint skyline rises behind the lower part of the columns.

= 1.8.6 =
* Footer art: a fuller Dubai skyline (Burj Khalifa at the centre, Emirates Towers, Burj Al Arab) with two small planes just above the rooftops; dotted trails removed.

= 1.8.5 =
* Footer art: a minimal, faint Dubai skyline (Dubai Frame, Museum of the Future, Emirates Towers, Burj Khalifa, Burj Al Arab, Atlantis) and two planes with dashed flight trails.

= 1.8.4 =
* Footer: the landscape silhouette moves to the bottom, as a faint skyline just above the copyright bar, and is no longer cropped.

= 1.8.3 =
* New footer: a UAE landscape silhouette along the top, a deep blue gradient, four columns with thin dividers (about and social icons, quick links, services, get in touch) and a simple bottom bar.

= 1.8.2 =
* Home banner: shorter (ends just below the text), its two buttons and the Discover arrow removed.
* New quick services bar overlapping the bottom of the home banner: seven tinted icon tiles with a short line, linking to the Services page.

= 1.8.1 =
* Header: round call and WhatsApp buttons removed (the phone menu keeps its Call and WhatsApp buttons).

= 1.8.0 =
* Destinations page: four cards per row on desktop (11 destinations sit 4, 4, 3).

= 1.7.9 =
* Inner page banners (About, Services, Destinations, DMC, Why Us, Contact) get a brand-blue tint; the home banner is unchanged.

= 1.7.8 =
* Home banner back to its original overlay (blue tint, rings and dots removed).

= 1.7.7 =
* Home banner: brand-blue overlay on the photos with faint pulsing rings and floating dots.

= 1.7.6 =
* Services list: a gallery of rounded photo cards in staggered heights with the title and text over a soft fade; "Enquire" appears on hover.

= 1.7.5 =
* Less repetition: Core Values, Vision & Mission, Team and Commitment now appear only on the About page; Inbound & Outbound only on Home; the Contact page form section and the DMC page section have their own headings.

= 1.7.4 =
* Scroll motion: the About photo slowly zooms and drifts inside its wave, and the DMC traveller glides across as the page scrolls (off for visitors who prefer reduced motion).

= 1.7.3 =
* DMC section: the three rotating arches are replaced by a single cut-out image (a traveller leaping from a phone) over a soft blue glow.

= 1.7.2 =
* DMC section: three arch-shaped photos (a tall middle one and two tilted behind it) that rotate, with dots to switch; middle, left and right photos are set in the widget.

= 1.7.1 =
* About photo moved slightly down on desktop.

= 1.7.0 =
* About section: the photo now runs to the right edge of the page with a wavy left side and wavy bottom; new photo of a traditional abra on Dubai Creek.

= 1.6.9 =
* About section photo (The Walk at JBR) now has a soft wave cut into its bottom-left corner.

= 1.6.8 =
* Why Beyond Journey: blue photo background removed; the section is now white with the usual heading colours.

= 1.6.7 =
* Header back to the white floating bar (see-through over the banner photo, white rounded bar when scrolling, orange underline on the current page, blue Plan Your Journey pill with call and WhatsApp buttons).
* Keeps the dark dropdown panels where every link has its own icon and a short line.

= 1.6.6 =
* Header redesigned as a deep-blue glass bar with the white logo; it turns more solid and slimmer when scrolling.
* An orange line slides to the hovered menu link and settles on the current page.
* Dropdowns are dark panels where every link has its own icon and a short line (a menu item's Description in Appearance > Menus replaces the line).
* "Plan Your Journey" pill with an arrow, plus round call and WhatsApp buttons; the phone menu is a dark sheet under the bar.

= 1.6.5 =
* New header menu with dropdowns under About (About Us, Why Choose Us, DMC), Services and Destinations; sub-items can also be set in Appearance > Menus.

= 1.6.4 =
* Contact form restyled: "Plan Your Journey" icon header (title and subtitle editable in the widget), labels above taller rounded fields, full-width send button with an arrow. Same fields and email delivery; the popup form is unchanged.

= 1.6.3 =
* Why Beyond Journey: five centred cards in one row, each with a circle icon, dotted corner, short blue line and blue bottom edge.

= 1.6.2 =
* Hotels order: Thailand (lebua at State Tower), India (The Taj Mahal Palace), Maldives (W Maldives), Azerbaijan (Fairmont Baku), Oman (The Chedi Muscat).

= 1.6.1 =
* Homepage Destinations restored to the original carousel.
* Hotels now lead with Thailand, India and the Maldives (lebua at State Tower, Taj Lake Palace, W Maldives), then The Taj Mahal Palace and Shangri-La Colombo.

= 1.6.0 =
* New "Premium Hotels" section and Elementor widget: five 5-star hotels in a card carousel beside a text panel with an "Explore Hotels" button.
* Homepage Destinations now shows the first 3 destinations plus a "More Destinations" card linking to the Destinations page (the number shown is set in the widget).

= 1.5.4 =
* DMC section photo is now a 480px square, matching the About Us photo.

= 1.5.3 =
* The home hero and page banners are no longer justified: centred on phones and tablets, left-aligned on desktop.

= 1.5.2 =
* Removed the decorative outline circles beside the About, DMC and Our Team photos.

= 1.5.1 =
* Justified paragraphs no longer break words with hyphens.

= 1.5.0 =
* Body paragraphs across the site are justified (straight left and right edges).
* Contact details panel: slightly bolder description and contact lines.

= 1.4.9 =
* Contact section: the airport photo moved from behind the form to behind the contact details panel, with white text; the form is back on its outlined box.

= 1.4.8 =
* Contact section: the enquiry popup's airport photo now sits behind the form, with the form on a frosted white card.

= 1.4.7 =
* The Contact section form now matches the enquiry popup: Full Name and Phone / WhatsApp (required), Email, Destination and Travel Dates or Requirements. Travel Type and Number of Travellers were removed.

= 1.4.6 =
* Contact section: on desktop the enquiry form box now matches the height of the contact details panel.

= 1.4.5 =
* Bigger logo in the header and footer.
* Footer social media icons (Instagram, Facebook, LinkedIn, TikTok): add the profile links in Appearance > Customize > Beyond Journey Settings; an empty link hides its icon.

= 1.4.4 =
* Enquiry emails are sent from "beyondjourney.ae".

= 1.4.3 =
* Enquiry emails are sent from "Beyond Journey Website" instead of "WordPress".

= 1.4.2 =
* Enquiry emails no longer include the "Form:" line (which form was used is still shown under Enquiries in the dashboard).

= 1.4.1 =
* Removed the dotted travel route and map pins from behind the contact details.

= 1.4.0 =
* Services are now photo tiles that link to the enquiry form, with the groups arranged in two rows.
* Destinations page: centred card grid with a tap "bloom", and compact colour-coded region cards.
* DMC page: "What We Handle" redrawn as pastel icon tiles with a service count.
* Contact: shorter three-across form, a dotted travel route behind the details, and pop-in animations.
* "Our Commitment" gains an animated flight route; the closing Call to Action band was removed from every page
  (still available as an Elementor widget).
* Client photos added for the hero (resort, Taj Mahal, desert camp) and the About card (JBR), served from the theme.
* DMC copy no longer singles out the Indian market, and the home DMC list shows every service.

= 1.3.0 =
* Matches the latest design: new About, Why Us (five reasons), Vision and Mission copy, and a new
  "Our Commitment" closing section on Home and About.
* Added floating "Start your journey" and WhatsApp buttons, and a "Key Numbers" widget.
* Home hero headline is now plain white with quieter buttons; the banner photos were refreshed.
* "How We Work" and "Looking Ahead" are no longer part of the page layouts; both remain available as
  Elementor widgets.
* Services trimmed to nine; the footer drops the Destinations column and the intro paragraph.

= 1.2.0 =
* Redesigned to match the latest site: transparent header over the banner photo with a light wordmark,
  banner slideshows on every page, three photo cards on the home Services section, a single contact card,
  and the "Multilingual" paragraph in place of the language list.
* New services: Cruise Holidays, Travel Insurance, Corporate Travel & MICE, and Transfers, Transport & Rail.
* Customizer: a second logo for the transparent header (Appearance > Customize > Beyond Journey Settings).

= 1.1.0 =
* Every section is also an Elementor widget, and the pages are built from them.

= 1.0.0 =
* First release.
