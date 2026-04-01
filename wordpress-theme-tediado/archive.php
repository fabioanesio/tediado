<?php
if (!defined('ABSPATH')) {
    exit;
}

get_header();
?>
<div class="site-main-wrap">
    <main>
        <article class="content-single">
            <h1><?php the_archive_title(); ?></h1>
            <?php the_archive_description('<div class="post-excerpt">', '</div>'); ?>
        </article>

        <?php if (have_posts()) : ?>
            <section class="posts-grid">
                <?php while (have_posts()) : the_post(); ?>
                    <article <?php post_class('post-card'); ?>>
                        <?php if (has_post_thumbnail()) : ?>
                            <a href="<?php the_permalink(); ?>" aria-label="<?php the_title_attribute(); ?>">
                                <?php the_post_thumbnail('medium_large'); ?>
                            </a>
                        <?php endif; ?>
                        <p class="category"><?php the_category(', '); ?></p>
                        <h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
                        <p class="post-meta"><?php echo esc_html(get_the_date()); ?></p>
                        <div class="post-excerpt"><?php the_excerpt(); ?></div>
                    </article>
                <?php endwhile; ?>
            </section>

            <div class="pagination">
                <?php echo wp_kses_post(paginate_links(['type' => 'list'])); ?>
            </div>
        <?php else : ?>
            <article class="content-single">
                <h2><?php esc_html_e('Nenhum conteúdo nesta listagem.', 'tediado-clone'); ?></h2>
            </article>
        <?php endif; ?>
    </main>

    <?php get_sidebar(); ?>
</div>
<?php
get_footer();
