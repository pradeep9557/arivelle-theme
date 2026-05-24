<?php
/**
 * Arivelle Bloom theme functions.
 *
 * @package Arivelle_Bloom
 */

if (!defined('ABSPATH')) {
    exit;
}

function arivelle_bloom_setup() {
    add_theme_support('title-tag');
    add_theme_support('post-thumbnails');
    add_theme_support('custom-logo', array(
        'height'      => 80,
        'width'       => 240,
        'flex-height' => true,
        'flex-width'  => true,
    ));
    add_theme_support('woocommerce');
    add_theme_support('wc-product-gallery-zoom');
    add_theme_support('wc-product-gallery-lightbox');
    add_theme_support('wc-product-gallery-slider');
    add_theme_support('align-wide');

    register_nav_menus(array(
        'primary'        => __('Primary Menu', 'arivelle-bloom'),
        'footer'         => __('Footer Menu', 'arivelle-bloom'),
        'footer_shop'    => __('Footer Shop Menu', 'arivelle-bloom'),
        'footer_support' => __('Footer Support Menu', 'arivelle-bloom'),
    ));
}
add_action('after_setup_theme', 'arivelle_bloom_setup');

function arivelle_bloom_assets() {
    wp_enqueue_style('dashicons');

    wp_enqueue_style(
        'arivelle-bloom-fonts',
        'https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700;800;900&display=swap',
        array(),
        null
    );

    wp_enqueue_style(
        'arivelle-bloom-style',
        get_stylesheet_uri(),
        array('arivelle-bloom-fonts'),
        wp_get_theme()->get('Version')
    );

    wp_enqueue_script(
        'arivelle-bloom-script',
        get_template_directory_uri() . '/assets/theme.js',
        array(),
        wp_get_theme()->get('Version'),
        true
    );
}
add_action('wp_enqueue_scripts', 'arivelle_bloom_assets');

function arivelle_bloom_widgets() {
    register_sidebar(array(
        'name'          => __('Footer 1', 'arivelle-bloom'),
        'id'            => 'footer-1',
        'before_widget' => '<div class="footer-widget">',
        'after_widget'  => '</div>',
        'before_title'  => '<h3>',
        'after_title'   => '</h3>',
    ));
}
add_action('widgets_init', 'arivelle_bloom_widgets');

function arivelle_bloom_body_classes($classes) {
    $classes[] = 'arivelle-bloom';
    return $classes;
}
add_filter('body_class', 'arivelle_bloom_body_classes');

function arivelle_bloom_products_per_page() {
    return 12;
}
add_filter('loop_shop_per_page', 'arivelle_bloom_products_per_page', 20);

function arivelle_bloom_product_columns() {
    return 4;
}
add_filter('loop_shop_columns', 'arivelle_bloom_product_columns');

function arivelle_bloom_force_published_product_queries($query) {
    if (is_admin() || !$query instanceof WP_Query) {
        return;
    }

    $post_type = $query->get('post_type');
    $is_product_query = 'product' === $post_type || (is_array($post_type) && in_array('product', $post_type, true));
    $is_product_tax_query = $query->is_tax(array('product_cat', 'product_tag'));

    if ($is_product_query || $is_product_tax_query) {
        $query->set('post_status', 'publish');
    }
}
add_action('pre_get_posts', 'arivelle_bloom_force_published_product_queries', 20);

function arivelle_bloom_force_published_product_shortcode($query_args) {
    $query_args['post_status'] = 'publish';
    return $query_args;
}
add_filter('woocommerce_shortcode_products_query', 'arivelle_bloom_force_published_product_shortcode');

function arivelle_bloom_footer_shop_fallback() {
    echo '<ul>';
    echo '<li><a href="' . esc_url(home_url('/product-category/jhumka/')) . '">Jhumka</a></li>';
    echo '<li><a href="' . esc_url(home_url('/product-category/earrings/')) . '">Earrings</a></li>';
    echo '<li><a href="' . esc_url(home_url('/product-category/clutches/')) . '">Clutches</a></li>';
    echo '<li><a href="' . esc_url(home_url('/product-category/handbags/')) . '">Handbags</a></li>';
    echo '</ul>';
}

function arivelle_bloom_footer_support_fallback() {
    echo '<ul>';
    echo '<li><a href="' . esc_url(home_url('/contact/')) . '">Contact</a></li>';
    echo '<li><a href="' . esc_url(home_url('/shipping-policy/')) . '">Shipping</a></li>';
    echo '<li><a href="' . esc_url(home_url('/return-policy/')) . '">Returns</a></li>';
    echo '<li><a href="' . esc_url(home_url('/privacy-policy/')) . '">Privacy</a></li>';
    echo '</ul>';
}

function arivelle_bloom_customize_register($wp_customize) {
    $wp_customize->add_section('arivelle_bloom_footer_content', array(
        'title'       => __('Footer Content', 'arivelle-bloom'),
        'description' => __('Update footer about and order help text.', 'arivelle-bloom'),
        'priority'    => 160,
    ));

    $wp_customize->add_setting('arivelle_footer_about_text', array(
        'default'           => __('Beautiful jhumkas, earrings, clutches, and handbags selected for everyday glow and festive moments.', 'arivelle-bloom'),
        'sanitize_callback' => 'sanitize_textarea_field',
    ));

    $wp_customize->add_control('arivelle_footer_about_text', array(
        'label'   => __('About Text', 'arivelle-bloom'),
        'section' => 'arivelle_bloom_footer_content',
        'type'    => 'textarea',
    ));

    $wp_customize->add_setting('arivelle_footer_order_help_text', array(
        'default'           => __('Need styling help or bulk order support? Add WhatsApp chat from your plugin dashboard.', 'arivelle-bloom'),
        'sanitize_callback' => 'sanitize_textarea_field',
    ));

    $wp_customize->add_control('arivelle_footer_order_help_text', array(
        'label'   => __('Order Help Text', 'arivelle-bloom'),
        'section' => 'arivelle_bloom_footer_content',
        'type'    => 'textarea',
    ));
}
add_action('customize_register', 'arivelle_bloom_customize_register');

function arivelle_bloom_has_seo_plugin() {
    return defined('WPSEO_VERSION')
        || defined('RANK_MATH_VERSION')
        || defined('AIOSEO_VERSION')
        || class_exists('autodescription');
}

function arivelle_bloom_get_meta_description() {
    if (is_front_page()) {
        return get_bloginfo('description') ?: __('Shop fashion jewellery, jhumkas, earrings, necklaces, handbags and festive accessories at Arivelle.', 'arivelle-bloom');
    }

    if (is_singular()) {
        $post = get_post();

        if (!$post) {
            return '';
        }

        if (has_excerpt($post)) {
            return get_the_excerpt($post);
        }

        return wp_trim_words(wp_strip_all_tags(strip_shortcodes($post->post_content)), 28);
    }

    if (is_tax() || is_category() || is_tag()) {
        return wp_strip_all_tags(term_description());
    }

    if (class_exists('WooCommerce') && is_shop()) {
        return __('Explore Arivelle fashion jewellery, bags, clutches and accessories for everyday and festive styling.', 'arivelle-bloom');
    }

    return get_bloginfo('description');
}

function arivelle_bloom_seo_meta() {
    if (arivelle_bloom_has_seo_plugin()) {
        return;
    }

    $description = arivelle_bloom_get_meta_description();

    if ($description) {
        echo '<meta name="description" content="' . esc_attr(wp_trim_words($description, 32, '')) . '">' . "\n";
    }

    echo '<meta name="robots" content="max-image-preview:large">' . "\n";
}
add_action('wp_head', 'arivelle_bloom_seo_meta', 2);

function arivelle_bloom_structured_data() {
    if (arivelle_bloom_has_seo_plugin() || !is_front_page()) {
        return;
    }

    $logo = get_template_directory_uri() . '/assets/images/arivelle-logo-header.png';
    $data = array(
        '@context'        => 'https://schema.org',
        '@graph'          => array(
            array(
                '@type' => 'Organization',
                '@id'   => home_url('/#organization'),
                'name'  => get_bloginfo('name'),
                'url'   => home_url('/'),
                'logo'  => esc_url_raw($logo),
            ),
            array(
                '@type'           => 'WebSite',
                '@id'             => home_url('/#website'),
                'url'             => home_url('/'),
                'name'            => get_bloginfo('name'),
                'publisher'       => array('@id' => home_url('/#organization')),
                'potentialAction' => array(
                    '@type'       => 'SearchAction',
                    'target'      => home_url('/?s={search_term_string}&post_type=product'),
                    'query-input' => 'required name=search_term_string',
                ),
            ),
        ),
    );

    echo '<script type="application/ld+json">' . wp_json_encode($data, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE) . '</script>' . "\n";
}
add_action('wp_head', 'arivelle_bloom_structured_data', 20);
