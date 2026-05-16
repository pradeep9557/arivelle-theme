<?php
/**
 * Footer template.
 *
 * @package Arivelle_Bloom
 */
?>
<footer class="site-footer">
    <div class="wrap">
        <div class="footer-grid">
            <div>
                <h3><?php bloginfo('name'); ?></h3>
                <p><?php echo esc_html(get_theme_mod('arivelle_footer_about_text', __('Beautiful jhumkas, earrings, clutches, and handbags selected for everyday glow and festive moments.', 'arivelle-bloom'))); ?></p>
            </div>
            <div>
                <h3>Shop</h3>
                <?php
                wp_nav_menu(array(
                    'theme_location' => 'footer_shop',
                    'container'      => false,
                    'fallback_cb'    => 'arivelle_bloom_footer_shop_fallback',
                    'depth'          => 1,
                ));
                ?>
            </div>
            <div>
                <h3>Support</h3>
                <?php
                wp_nav_menu(array(
                    'theme_location' => 'footer_support',
                    'container'      => false,
                    'fallback_cb'    => 'arivelle_bloom_footer_support_fallback',
                    'depth'          => 1,
                ));
                ?>
            </div>
            <div>
                <h3>Order Help</h3>
                <p><?php echo esc_html(get_theme_mod('arivelle_footer_order_help_text', __('Need styling help or bulk order support? Add WhatsApp chat from your plugin dashboard.', 'arivelle-bloom'))); ?></p>
            </div>
        </div>
        <div class="footer-bottom">Copyright &copy; <?php echo esc_html(date_i18n('Y')); ?> <?php bloginfo('name'); ?>. All rights reserved.</div>
    </div>
</footer>
<?php wp_footer(); ?>
</body>
</html>
