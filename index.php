<?php
/**
 * Main template.
 *
 * @package Arivelle_Bloom
 */

get_header();
?>
<main class="content-area">
    <?php if (have_posts()) : ?>
        <?php while (have_posts()) : the_post(); ?>
            <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
                <?php if (is_singular()) : ?>
                    <h1 class="page-title"><?php the_title(); ?></h1>
                <?php else : ?>
                    <h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
                <?php endif; ?>
                <div class="entry-content">
                    <?php
                    if (is_singular()) {
                        the_content();
                    } else {
                        the_excerpt();
                    }
                    ?>
                </div>
            </article>
        <?php endwhile; ?>
        <?php the_posts_pagination(); ?>
    <?php else : ?>
        <h1 class="page-title"><?php esc_html_e('Nothing found', 'arivelle-bloom'); ?></h1>
        <p><?php esc_html_e('Please add your first page or product.', 'arivelle-bloom'); ?></p>
    <?php endif; ?>
</main>
<?php
get_footer();
