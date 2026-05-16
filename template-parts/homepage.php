<?php
/**
 * Homepage sections.
 *
 * @package Arivelle_Bloom
 */
?>
<main>
    <section class="hero">
        <div class="wrap hero-inner">
            <div>
                <span class="eyebrow">Arivelle Accessories</span>
                <h1>Jewellery and bags that complete your look.</h1>
                <p>Shop graceful jhumkas, statement earrings, party clutches, and handbags made for festive outfits, office looks, and thoughtful gifting.</p>
                <div class="hero-actions">
                    <?php if (class_exists('WooCommerce')) : ?>
                        <a class="button" href="<?php echo esc_url(get_permalink(wc_get_page_id('shop'))); ?>">Shop New Arrivals</a>
                    <?php endif; ?>
                    <a class="button secondary" href="<?php echo esc_url(home_url('/contact/')); ?>">Order on WhatsApp</a>
                </div>
            </div>
            <div class="hero-visual" aria-hidden="true"></div>
        </div>
    </section>

    <section class="trust-strip">
        <div class="wrap trust-grid">
            <div class="trust-item"><span class="trust-icon">1</span> Quality checked pieces</div>
            <div class="trust-item"><span class="trust-icon">2</span> Secure online payment</div>
            <div class="trust-item"><span class="trust-icon">3</span> Easy WhatsApp support</div>
            <div class="trust-item"><span class="trust-icon">4</span> Gift-ready styles</div>
        </div>
    </section>

    <section class="section">
        <div class="wrap">
            <div class="section-head">
                <div>
                    <h2>Shop by Style</h2>
                    <p>Quick paths for buyers who already know what they want.</p>
                </div>
            </div>
            <div class="category-grid">
                <a class="category-card jhumka" href="<?php echo esc_url(home_url('/product-category/jhumka/')); ?>">
                    <span class="category-art"></span>
                    <h3>Traditional Jhumka</h3>
                </a>
                <a class="category-card earrings" href="<?php echo esc_url(home_url('/product-category/earrings/')); ?>">
                    <span class="category-art"></span>
                    <h3>Statement Earrings</h3>
                </a>
                <a class="category-card clutch" href="<?php echo esc_url(home_url('/product-category/clutches/')); ?>">
                    <span class="category-art"></span>
                    <h3>Party Clutches</h3>
                </a>
                <a class="category-card bag" href="<?php echo esc_url(home_url('/product-category/handbags/')); ?>">
                    <span class="category-art"></span>
                    <h3>Everyday Handbags</h3>
                </a>
            </div>
        </div>
    </section>

    <?php if (class_exists('WooCommerce')) : ?>
        <section class="section alt">
            <div class="wrap">
                <div class="section-head">
                    <div>
                        <h2>Best Sellers</h2>
                        <p>Keep your most attractive and profitable products here for faster buying decisions.</p>
                    </div>
                    <a href="<?php echo esc_url(get_permalink(wc_get_page_id('shop'))); ?>">View all</a>
                </div>
                <?php echo do_shortcode('[products limit="8" columns="4" orderby="popularity"]'); ?>
            </div>
        </section>
    <?php endif; ?>

    <section class="section">
        <div class="wrap">
            <div class="promo-band">
                <div>
                    <h2>Festive combos sell faster.</h2>
                    <p>Create sets like Jhumka + Clutch or Earrings + Handbag and offer a small bundle discount.</p>
                </div>
                <?php if (class_exists('WooCommerce')) : ?>
                    <a class="button" href="<?php echo esc_url(get_permalink(wc_get_page_id('shop'))); ?>">Explore Combos</a>
                <?php endif; ?>
            </div>
        </div>
    </section>
</main>
