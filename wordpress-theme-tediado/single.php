<?php
if (!defined('ABSPATH')) {
    exit;
}

get_header();
?>
<div class="site-main-wrap">
    <main>
        <?php while (have_posts()) : the_post(); ?>
            <article <?php post_class('content-single'); ?>>
                <p class="category"><?php the_category(', '); ?></p>
                <h1><?php the_title(); ?></h1>
                <p class="post-meta"><?php echo esc_html(get_the_date()); ?></p>
                <?php if (has_post_thumbnail()) : ?>
                    <p><?php the_post_thumbnail('large'); ?></p>
                <?php endif; ?>
                <div><?php the_content(); ?></div>
            </article>
        <?php endwhile; ?>
    </main>

    <?php get_sidebar(); ?>
</div>
<?php
get_footer();
