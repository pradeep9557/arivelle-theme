<?php
/**
 * Header template.
 *
 * @package Arivelle_Bloom
 */
?><!doctype html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<?php wp_body_open(); ?>
<div class="site-topbar">Festive accessories live now | Free shipping above Rs. 999 | WhatsApp support available</div>
<header class="site-header">
    <div class="header-inner">
        <a class="brand" href="<?php echo esc_url(home_url('/')); ?>" aria-label="<?php bloginfo('name'); ?>">
            <?php if (has_custom_logo()) : ?>
                <?php the_custom_logo(); ?>
            <?php else : ?>
                <span class="brand-mark">A</span>
                <span><?php bloginfo('name'); ?></span>
            <?php endif; ?>
        </a>

        <nav id="site-navigation" class="main-nav" aria-label="<?php esc_attr_e('Primary menu', 'arivelle-bloom'); ?>">
            <?php
            wp_nav_menu(array(
                'theme_location' => 'primary',
                'container'      => false,
                'fallback_cb'    => 'arivelle_bloom_default_menu',
            ));
            ?>
        </nav>

        <button class="menu-toggle" type="button" aria-controls="site-navigation" aria-expanded="false">Menu</button>

        <div class="header-actions">
            <a class="icon-link" href="<?php echo esc_url(home_url('/?s=')); ?>" aria-label="<?php esc_attr_e('Search', 'arivelle-bloom'); ?>">
                <span class="dashicons dashicons-search" aria-hidden="true"></span>
            </a>
            <?php if (class_exists('WooCommerce')) : ?>
                <a class="icon-link" href="<?php echo esc_url(wc_get_cart_url()); ?>" aria-label="<?php esc_attr_e('Cart', 'arivelle-bloom'); ?>">
                    <span class="dashicons dashicons-cart" aria-hidden="true"></span>
                </a>
            <?php endif; ?>
        </div>
    </div>
</header>
<?php
function arivelle_bloom_default_menu() {
    echo '<ul>';
    echo '<li><a href="' . esc_url(home_url('/')) . '">Home</a></li>';
    if (class_exists('WooCommerce')) {
        echo '<li><a href="' . esc_url(get_permalink(wc_get_page_id('shop'))) . '">Shop</a></li>';
    }
    echo '<li><a href="' . esc_url(home_url('/about')) . '">About</a></li>';
    echo '<li><a href="' . esc_url(home_url('/contact')) . '">Contact</a></li>';
    echo '</ul>';
}
