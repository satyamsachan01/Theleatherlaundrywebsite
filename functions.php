<?php
if (!defined('ABSPATH')) {
    exit;
}

define('TLL_VERSION', '1.0.0');
define('TLL_DIR', get_template_directory());
define('TLL_URI', get_template_directory_uri());

function tll_setup() {
    load_theme_textdomain('leather-laundry', TLL_DIR . '/languages');

    add_theme_support('title-tag');
    add_theme_support('post-thumbnails');
    add_theme_support('custom-logo', [
        'height'      => 120,
        'width'       => 120,
        'flex-height'  => true,
        'flex-width'   => true,
    ]);
    add_theme_support('html5', [
        'search-form', 'comment-form', 'comment-list', 'gallery', 'caption', 'style', 'script', 'navigation-widgets'
    ]);
    add_theme_support('align-wide');
    add_theme_support('responsive-embeds');
    add_theme_support('editor-styles');
    add_editor_style('style.css');

    register_nav_menus([
        'primary'  => __('Primary Menu', 'leather-laundry'),
        'services' => __('Services Menu', 'leather-laundry'),
        'cities'   => __('Cities Menu', 'leather-laundry'),
        'footer'   => __('Footer Menu', 'leather-laundry'),
    ]);
}
add_action('after_setup_theme', 'tll_setup');

function tll_assets() {
    wp_enqueue_style('tll-google-fonts', 'https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,400;0,500;0,600;0,700;1,400;1,500&family=DM+Sans:wght@300;400;500;600;700&display=swap', [], null);
    wp_enqueue_style('tll-style', get_stylesheet_uri(), [], TLL_VERSION);
    wp_enqueue_script('tll-theme', TLL_URI . '/assets/js/theme.js', [], TLL_VERSION, true);
}
add_action('wp_enqueue_scripts', 'tll_assets');

function tll_excerpt_length($length) {
    return 22;
}
add_filter('excerpt_length', 'tll_excerpt_length', 999);

function tll_register_cpts() {
    $supports = ['title', 'editor', 'excerpt', 'thumbnail', 'page-attributes'];
    $common = [
        'public'             => true,
        'show_in_rest'       => true,
        'has_archive'        => true,
        'rewrite'            => ['with_front' => false],
        'menu_position'      => 20,
    ];

    register_post_type('tll_service', array_merge($common, [
        'labels' => [
            'name' => __('Services', 'leather-laundry'),
            'singular_name' => __('Service', 'leather-laundry'),
        ],
        'menu_icon' => 'dashicons-admin-tools',
        'has_archive' => 'services',
        'rewrite' => ['slug' => 'services', 'with_front' => false],
        'supports' => $supports,
    ]));

    register_post_type('tll_city', array_merge($common, [
        'labels' => [
            'name' => __('Cities', 'leather-laundry'),
            'singular_name' => __('City', 'leather-laundry'),
        ],
        'menu_icon' => 'dashicons-location-alt',
        'has_archive' => 'cities',
        'rewrite' => ['slug' => 'cities', 'with_front' => false],
        'supports' => $supports,
    ]));

    register_post_type('tll_testimonial', [
        'public' => true,
        'show_in_rest' => true,
        'labels' => [
            'name' => __('Testimonials', 'leather-laundry'),
            'singular_name' => __('Testimonial', 'leather-laundry'),
        ],
        'menu_icon' => 'dashicons-testimonial',
        'supports' => ['title', 'editor', 'excerpt', 'thumbnail', 'page-attributes'],
        'has_archive' => false,
    ]);

    register_post_type('tll_before_after', [
        'public' => true,
        'show_in_rest' => true,
        'labels' => [
            'name' => __('Before / After', 'leather-laundry'),
            'singular_name' => __('Transformation', 'leather-laundry'),
        ],
        'menu_icon' => 'dashicons-images-alt2',
        'supports' => ['title', 'editor', 'excerpt', 'thumbnail', 'page-attributes'],
        'has_archive' => false,
    ]);

    register_post_type('tll_faq', [
        'public' => true,
        'show_in_rest' => true,
        'labels' => [
            'name' => __('FAQs', 'leather-laundry'),
            'singular_name' => __('FAQ', 'leather-laundry'),
        ],
        'menu_icon' => 'dashicons-editor-help',
        'supports' => ['title', 'editor', 'excerpt', 'page-attributes'],
        'has_archive' => false,
    ]);
}
add_action('init', 'tll_register_cpts');

function tll_register_sidebars() {
    register_sidebar([
        'name' => __('Footer Column 1', 'leather-laundry'),
        'id' => 'footer-1',
        'before_widget' => '<div class="footer-col">',
        'after_widget' => '</div>',
        'before_title' => '<h4>',
        'after_title' => '</h4>',
    ]);
}
add_action('widgets_init', 'tll_register_sidebars');

function tll_customize($wp_customize) {
    $wp_customize->add_section('tll_brand', [
        'title' => __('Leather Laundry Brand', 'leather-laundry'),
        'priority' => 30,
    ]);

    $settings = [
        'brand_name' => 'The Leather Laundry',
        'brand_tagline' => 'Premium Leather Care',
        'announcement' => 'Free Pickup & Drop across India — Trusted by 10,000+ customers since 2015',
        'phone' => '+91 97112 55431',
        'phone_tel' => '+919711255431',
        'whatsapp' => 'https://wa.me/911122795768',
        'whatsapp_label' => 'Get a Quote',
        'hero_badge' => "India's #1 Leather Care Experts",
        'hero_title' => 'Your Luxury Deserves a Second Life',
        'hero_text' => 'Expert repair, restoration & dry cleaning for designer handbags, shoes, jackets & leather upholstery. 40+ years of craftsmanship. 60+ skilled artisans. Pan-India service.',
    ];

    foreach ($settings as $key => $default) {
        $wp_customize->add_setting("tll_{$key}", [
            'default' => $default,
            'sanitize_callback' => is_email($default) ? 'sanitize_email' : 'sanitize_text_field',
        ]);
        $wp_customize->add_control("tll_{$key}", [
            'label' => ucwords(str_replace('_', ' ', $key)),
            'section' => 'tll_brand',
            'type' => 'text',
        ]);
    }
}
add_action('customize_register', 'tll_customize');

function tll_opt($key, $default = '') {
    return get_theme_mod("tll_{$key}", $default);
}

function tll_get_default_services() {
    return [
        ['title' => 'Handbags', 'price' => 'From ₹999', 'desc' => 'Cleaning, colour restoration, handle repair, hardware polishing & shape correction for all luxury brands.', 'icon' => 'bag'],
        ['title' => 'Shoes', 'price' => 'From ₹799', 'desc' => 'Sole replacement, heel repair, colour change, suede cleaning & complete shoe restoration.', 'icon' => 'shoe'],
        ['title' => 'Jackets', 'price' => 'From ₹1,499', 'desc' => 'Leather & suede jacket polishing, alterations, lining repair, colour restoration & zipper replacement.', 'icon' => 'jacket'],
        ['title' => 'Sofa & Upholstery', 'price' => 'From ₹2,499', 'desc' => 'Deep cleaning, leather conditioning, tear repair, colour touch-up & full sofa restoration at your doorstep.', 'icon' => 'sofa'],
        ['title' => 'Custom Leather Products', 'price' => 'Bespoke', 'desc' => 'Bespoke bags, belts, wallets & accessories crafted to your specifications with premium materials.', 'icon' => 'custom'],
        ['title' => 'Repurposed Luxury', 'price' => 'Zero Waste', 'desc' => 'Transform old leather into phone covers, cardholders, keychains & unique accessories.', 'icon' => 'recycle'],
    ];
}

function tll_get_default_cities() {
    return ['Chandigarh', 'Delhi', 'Jaipur', 'Lucknow', 'Ahmedabad', 'Mumbai', 'Hyderabad', 'Bangalore', 'Chennai', 'Kolkata', 'Kochi'];
}

function tll_get_default_testimonials() {
    return [
        ['name' => 'Aarav', 'city' => 'Delhi', 'text' => 'My bag looked beyond repair. They returned it looking elegant, polished and ready to use again.'],
        ['name' => 'Meera', 'city' => 'Mumbai', 'text' => 'Great service, professional pickup, and the leather color restoration was excellent.'],
        ['name' => 'Nitin', 'city' => 'Bangalore', 'text' => 'The finish on my shoes is better than I expected. Very polished experience overall.'],
    ];
}

function tll_get_default_faqs() {
    return [
        ['q' => 'How long does a typical restoration take?', 'a' => 'Most items take 5 to 10 working days depending on condition, material and service type.'],
        ['q' => 'Do you provide pickup and drop?', 'a' => 'Yes. The theme includes a CTA and WhatsApp flow for pickup and drop requests.'],
        ['q' => 'Can I edit services and cities from WordPress?', 'a' => 'Yes. Use the Services and Cities post types in the admin panel.'],
        ['q' => 'Is the theme responsive?', 'a' => 'Yes. The menu becomes a mobile drawer and all sections stack on smaller screens.'],
    ];
}

function tll_icon_svg($icon) {
    switch ($icon) {
        case 'bag':
            return '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"><rect x="2" y="7" width="20" height="14" rx="2"/><path d="M16 7V5a4 4 0 00-8 0v2"/></svg>';
        case 'shoe':
            return '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"><path d="M12 2L2 7v10l10 5 10-5V7L12 2z"/><path d="M12 22V12M12 12L2 7M12 12l10-5"/></svg>';
        case 'jacket':
            return '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"><path d="M16 3h5v5M4 20L21 3M21 16v5h-5M14 14l7 7M3 8V3h5M10 10L3 3"/></svg>';
        case 'sofa':
            return '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"><path d="M3 9l9-7 9 7v11a2 2 0 01-2 2H5a2 2 0 01-2-2z"/><path d="M9 22V12h6v10"/></svg>';
        case 'custom':
            return '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"><circle cx="12" cy="12" r="10"/><path d="M8 14s1.5 2 4 2 4-2 4-2M9 9h.01M15 9h.01"/></svg>';
        default:
            return '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"><path d="M12 3v18M3 12h18M7.5 7.5L12 3l4.5 4.5M7.5 16.5L12 21l4.5-4.5"/></svg>';
    }
}

function tll_inline_svg_icon($type) {
    if ($type === 'phone') {
        return '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M22 16.92v3a2 2 0 01-2.18 2 19.79 19.79 0 01-8.63-3.07 19.5 19.5 0 01-6-6 19.79 19.79 0 01-3.07-8.67A2 2 0 014.11 2h3a2 2 0 012 1.72c.127.96.361 1.903.7 2.81a2 2 0 01-.45 2.11L8.09 9.91a16 16 0 006 6l1.27-1.27a2 2 0 012.11-.45c.907.339 1.85.573 2.81.7A2 2 0 0122 16.92z"/></svg>';
    }
    if ($type === 'check') {
        return '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M20 6L9 17l-5-5"/></svg>';
    }
    if ($type === 'wa') {
        return '<svg viewBox="0 0 24 24" fill="currentColor"><path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347z"/><path d="M12 0C5.373 0 0 5.373 0 12c0 2.625.846 5.059 2.284 7.034L.789 23.492a.5.5 0 00.611.611l4.458-1.495A11.944 11.944 0 0012 24c6.627 0 12-5.373 12-12S18.627 0 12 0zm0 22a9.94 9.94 0 01-5.39-1.583l-.386-.232-3.322 1.114 1.114-3.322-.232-.386A9.94 9.94 0 012 12C2 6.477 6.477 2 12 2s10 4.477 10 10-4.477 10-10 10z"/></svg>';
    }
    return '';
}

function tll_render_default_primary_menu() {
    $services_archive = get_post_type_archive_link('tll_service') ?: home_url('/services/');
    $cities_archive = get_post_type_archive_link('tll_city') ?: home_url('/cities/');
    $faqs_link = home_url('/faqs/');
    $contact_link = home_url('/contact-us/');
    $about_link = home_url('/about/');
    $care_link = home_url('/category/care-tips/');

    echo '<ul class="menu">';
    echo '<li><a href="' . esc_url(home_url('/')) . '">Home</a></li>';
    echo '<li><a href="' . esc_url($about_link) . '">About</a></li>';
    echo '<li class="menu-item-has-children"><a href="' . esc_url($services_archive) . '">Services</a><ul class="sub-menu">';
    foreach (tll_get_default_services() as $service) {
        echo '<li><a href="' . esc_url($services_archive) . '">' . esc_html($service['title']) . '</a></li>';
    }
    echo '</ul></li>';
    echo '<li class="menu-item-has-children"><a href="' . esc_url($cities_archive) . '">Cities</a><ul class="sub-menu">';
    foreach (tll_get_default_cities() as $city) {
        echo '<li><a href="' . esc_url($cities_archive) . '">' . esc_html($city) . '</a></li>';
    }
    echo '</ul></li>';
    echo '<li><a href="' . esc_url($care_link) . '">Care Tips</a></li>';
    echo '<li><a href="#before-after">Before &amp; After</a></li>';
    echo '<li><a href="#testimonials">Testimonials</a></li>';
    echo '<li><a href="' . esc_url($faqs_link) . '">FAQs</a></li>';
    echo '<li><a href="' . esc_url($contact_link) . '">Contact Us</a></li>';
    echo '<li><a href="' . esc_url(home_url('/blog/')) . '">Blogs</a></li>';
    echo '</ul>';
}

function tll_render_services_menu_list() {
    $items = tll_get_default_services();
    echo '<ul class="mobile-links">';
    foreach ($items as $item) {
        echo '<li><a href="' . esc_url(home_url('/services/')) . '">' . esc_html($item['title']) . '</a></li>';
    }
    echo '</ul>';
}

function tll_render_cities_menu_list() {
    echo '<ul class="mobile-links">';
    foreach (tll_get_default_cities() as $city) {
        echo '<li><a href="' . esc_url(home_url('/cities/')) . '">' . esc_html($city) . '</a></li>';
    }
    echo '</ul>';
}
