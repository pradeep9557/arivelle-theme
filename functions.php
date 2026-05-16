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
        'primary' => __('Primary Menu', 'arivelle-bloom'),
        'footer'  => __('Footer Menu', 'arivelle-bloom'),
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
