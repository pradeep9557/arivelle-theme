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
                <p>Beautiful jhumkas, earrings, clutches, and handbags selected for everyday glow and festive moments.</p>
            </div>
            <div>
                <h3>Shop</h3>
                <ul>
                    <li><a href="<?php echo esc_url(home_url('/product-category/jhumka/')); ?>">Jhumka</a></li>
                    <li><a href="<?php echo esc_url(home_url('/product-category/earrings/')); ?>">Earrings</a></li>
                    <li><a href="<?php echo esc_url(home_url('/product-category/clutches/')); ?>">Clutches</a></li>
                    <li><a href="<?php echo esc_url(home_url('/product-category/handbags/')); ?>">Handbags</a></li>
                </ul>
            </div>
            <div>
                <h3>Support</h3>
                <ul>
                    <li><a href="<?php echo esc_url(home_url('/contact/')); ?>">Contact</a></li>
                    <li><a href="<?php echo esc_url(home_url('/shipping-policy/')); ?>">Shipping</a></li>
                    <li><a href="<?php echo esc_url(home_url('/return-policy/')); ?>">Returns</a></li>
                    <li><a href="<?php echo esc_url(home_url('/privacy-policy/')); ?>">Privacy</a></li>
                </ul>
            </div>
            <div>
                <h3>Order Help</h3>
                <p>Need styling help or bulk order support? Add WhatsApp chat from your plugin dashboard.</p>
            </div>
        </div>
        <div class="footer-bottom">Copyright &copy; <?php echo esc_html(date_i18n('Y')); ?> <?php bloginfo('name'); ?>. All rights reserved.</div>
    </div>
</footer>
<?php wp_footer(); ?>
</body>
</html>
