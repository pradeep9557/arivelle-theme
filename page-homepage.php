<?php
/**
 * Template Name: Arivelle Homepage
 * Template Post Type: page
 *
 * @package Arivelle_Bloom
 */

get_header();

$arivelle_product_categories = array();

if (class_exists('WooCommerce')) {
    $arivelle_product_categories = get_terms(array(
        'taxonomy'   => 'product_cat',
        'hide_empty' => true,
        'orderby'    => 'count',
        'order'      => 'DESC',
        'exclude'    => array(get_option('default_product_cat')),
    ));

    if (is_wp_error($arivelle_product_categories)) {
        $arivelle_product_categories = array();
    }
}
?>
<main>
    <section class="commerce-hero">
        <div class="wrap commerce-hero-inner">
            <div class="commerce-hero-copy">
                <span class="sale-kicker">Fresh festive edit</span>
                <h1>Jewellery, clutches and bags for every celebration.</h1>
                <p>Discover jhumkas, statement earrings, party clutches and handbags curated for festive looks, gifting and everyday styling.</p>
                <div class="hero-actions">
                    <?php if (class_exists('WooCommerce')) : ?>
                        <a class="button" href="<?php echo esc_url(get_permalink(wc_get_page_id('shop'))); ?>">Shop New Arrivals</a>
                    <?php endif; ?>
                    <a class="button secondary" href="<?php echo esc_url(home_url('/product-category/combos/')); ?>">Explore Combos</a>
                </div>
                <div class="hero-mini-stats" aria-label="Store benefits">
                    <span>COD available</span>
                    <span>Secure payments</span>
                    <span>WhatsApp support</span>
                </div>
            </div>
            <div class="commerce-hero-panel" aria-hidden="true">
                <div class="hero-product-card hero-product-card-main">
                    <span>Best Pick</span>
                    <strong>Kundan Jhumkas</strong>
                </div>
                <div class="hero-product-card hero-product-card-small">
                    <span>Gift Ready</span>
                    <strong>Clutch Sets</strong>
                </div>
            </div>
        </div>
    </section>

    <?php if (class_exists('WooCommerce')) : ?>
        <section class="section product-feature">
            <div class="wrap">
                <div class="section-head">
                    <div>
                        <span class="section-eyebrow">Trending now</span>
                        <h2>Best Sellers</h2>
                        <p>Put your fastest-moving products here so buyers can start shopping immediately.</p>
                    </div>
                    <a class="text-link" href="<?php echo esc_url(get_permalink(wc_get_page_id('shop'))); ?>">View all</a>
                </div>
                <?php echo do_shortcode('[products limit="8" columns="4" orderby="popularity"]'); ?>
            </div>
        </section>
    <?php endif; ?>

    <?php if (!empty($arivelle_product_categories)) : ?>
        <section class="section compact-section category-index">
            <div class="wrap">
                <div class="section-head">
                    <div>
                        <span class="section-eyebrow">Shop by category</span>
                        <h2>Find your finishing touch</h2>
                    </div>
                </div>
                <div class="category-grid category-grid-modern">
                    <?php foreach ($arivelle_product_categories as $category) : ?>
                        <?php
                        $category_link = get_term_link($category);
                        $thumbnail_id  = get_term_meta($category->term_id, 'thumbnail_id', true);
                        $image_data    = $thumbnail_id ? wp_get_attachment_image_src($thumbnail_id, 'full') : false;
                        $image_url     = $image_data ? $image_data[0] : '';
                        $image_width   = !empty($image_data[1]) ? (int) $image_data[1] : 1;
                        $image_height  = !empty($image_data[2]) ? (int) $image_data[2] : 1;

                        if (is_wp_error($category_link)) {
                            continue;
                        }
                        ?>
                        <a class="category-card dynamic-category-card" href="<?php echo esc_url($category_link); ?>" style="--category-ratio: <?php echo esc_attr($image_width . ' / ' . $image_height); ?>;">
                            <?php if ($image_url) : ?>
                                <img
                                    class="category-image"
                                    src="<?php echo esc_url($image_url); ?>"
                                    width="<?php echo esc_attr($image_width); ?>"
                                    height="<?php echo esc_attr($image_height); ?>"
                                    loading="lazy"
                                    decoding="async"
                                    alt="<?php echo esc_attr($category->name); ?>"
                                >
                            <?php else : ?>
                                <span class="category-art"></span>
                            <?php endif; ?>
                        </a>
                    <?php endforeach; ?>
                </div>
            </div>
        </section>

        <section class="category-product-sections">
            <?php foreach ($arivelle_product_categories as $index => $category) : ?>
                <div id="category-<?php echo esc_attr($category->slug); ?>" class="section category-product-section <?php echo esc_attr($index % 2 ? 'alt' : ''); ?>">
                    <div class="wrap">
                        <div class="section-head">
                            <div>
                                <span class="section-eyebrow">Shop <?php echo esc_html($category->name); ?></span>
                                <h2><?php echo esc_html($category->name); ?></h2>
                                <?php if (!empty($category->description)) : ?>
                                    <p><?php echo esc_html(wp_trim_words($category->description, 18)); ?></p>
                                <?php else : ?>
                                    <p><?php echo esc_html(sprintf(__('Browse %s available products from this collection.', 'arivelle-bloom'), number_format_i18n($category->count))); ?></p>
                                <?php endif; ?>
                            </div>
                            <a class="text-link" href="<?php echo esc_url(get_term_link($category)); ?>">View all</a>
                        </div>
                        <?php echo do_shortcode('[products limit="8" columns="4" category="' . esc_attr($category->slug) . '"]'); ?>
                    </div>
                </div>
            <?php endforeach; ?>
        </section>
    <?php endif; ?>

    <section class="section alt compact-section">
        <div class="wrap offer-grid">
            <a class="offer-card offer-dark" href="<?php echo esc_url(home_url('/product-category/combos/')); ?>">
                <span>Bundle edit</span>
                <h2>Jhumka + Clutch combos</h2>
                <p>Create higher-value festive sets for quick gifting decisions.</p>
            </a>
            <a class="offer-card" href="<?php echo esc_url(home_url('/product-category/earrings/')); ?>">
                <span>Under Rs. 999</span>
                <h2>Everyday sparkle</h2>
                <p>Easy add-to-cart styles for daily wear and gifting.</p>
            </a>
            <a class="offer-card" href="<?php echo esc_url(home_url('/product-category/handbags/')); ?>">
                <span>New arrivals</span>
                <h2>Bags for every plan</h2>
                <p>Party, office and casual picks in one place.</p>
            </a>
        </div>
    </section>

    <section class="trust-strip trust-strip-bottom">
        <div class="wrap trust-grid">
            <div class="trust-item"><span class="trust-icon">1</span> Quality checked pieces</div>
            <div class="trust-item"><span class="trust-icon">2</span> Secure online payment</div>
            <div class="trust-item"><span class="trust-icon">3</span> Easy WhatsApp support</div>
            <div class="trust-item"><span class="trust-icon">4</span> Gift-ready styles</div>
        </div>
    </section>
</main>
<?php
get_footer();
