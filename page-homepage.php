<?php
/**
 * Template Name: Arivelle Homepage
 * Template Post Type: page
 *
 * @package Arivelle_Bloom
 */

get_header();

$arivelle_product_categories = array();
$arivelle_offer_categories = array();

if (class_exists('WooCommerce')) {
    $arivelle_product_categories = arivelle_bloom_get_published_product_categories();

    $arivelle_offer_categories = array(
        'combos' => array(
            'class' => 'offer-card offer-dark',
            'label' => __('Bundle edit', 'arivelle-bloom'),
            'title' => __('Jhumka + Clutch combos', 'arivelle-bloom'),
            'text'  => __('Create higher-value festive sets for quick gifting decisions.', 'arivelle-bloom'),
        ),
        'earrings' => array(
            'class' => 'offer-card',
            'label' => __('Under Rs. 999', 'arivelle-bloom'),
            'title' => __('Everyday sparkle', 'arivelle-bloom'),
            'text'  => __('Easy add-to-cart styles for daily wear and gifting.', 'arivelle-bloom'),
        ),
        'handbags' => array(
            'class' => 'offer-card',
            'label' => __('New arrivals', 'arivelle-bloom'),
            'title' => __('Bags for every plan', 'arivelle-bloom'),
            'text'  => __('Party, office and casual picks in one place.', 'arivelle-bloom'),
        ),
    );

    foreach ($arivelle_offer_categories as $slug => $offer) {
        if (!arivelle_bloom_product_category_has_published_products($slug)) {
            unset($arivelle_offer_categories[$slug]);
        }
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
                    <?php if (class_exists('WooCommerce') && arivelle_bloom_product_category_has_published_products('combos')) : ?>
                        <a class="button secondary" href="<?php echo esc_url(get_term_link('combos', 'product_cat')); ?>">Explore Combos</a>
                    <?php endif; ?>
                </div>
                <div class="hero-mini-stats" aria-label="Store benefits">
                    <span>COD available</span>
                    <span>Secure payments</span>
                    <span>WhatsApp support</span>
                </div>
            </div>
            <div class="commerce-hero-panel">
                <img
                    class="commerce-hero-image"
                    src="<?php echo esc_url(get_template_directory_uri() . '/assets/images/homepage-festive-model.png'); ?>"
                    width="1412"
                    height="1114"
                    loading="eager"
                    decoding="async"
                    fetchpriority="high"
                    alt="<?php esc_attr_e('Model wearing festive Arivelle jewellery', 'arivelle-bloom'); ?>"
                >
                <div class="hero-product-card hero-product-card-main">
                    <span>Best Pick</span>
                    <strong>Kundan Jhumkas</strong>
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

    <?php if (!empty($arivelle_offer_categories)) : ?>
        <section class="section alt compact-section">
            <div class="wrap offer-grid">
                <?php foreach ($arivelle_offer_categories as $slug => $offer) : ?>
                    <?php
                    $offer_link = get_term_link($slug, 'product_cat');

                    if (is_wp_error($offer_link)) {
                        continue;
                    }
                    ?>
                    <a class="<?php echo esc_attr($offer['class']); ?>" href="<?php echo esc_url($offer_link); ?>">
                        <span><?php echo esc_html($offer['label']); ?></span>
                        <h2><?php echo esc_html($offer['title']); ?></h2>
                        <p><?php echo esc_html($offer['text']); ?></p>
                    </a>
                <?php endforeach; ?>
            </div>
        </section>
    <?php endif; ?>

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
