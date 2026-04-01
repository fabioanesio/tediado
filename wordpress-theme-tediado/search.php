<?php
if (!defined('ABSPATH')) {
    exit;
}

get_header();
?>
<div class="site-main-wrap">
    <main>
        <article class="content-single">
            <h1>
                <?php
                printf(
                    esc_html__('Resultados para: %s', 'tediado-clone'),
                    '<span>' . esc_html(get_search_query()) . '</span>'
                );
                ?>
            </h1>
            <?php get_search_form(); ?>
        </article>

        <?php if (have_posts()) : ?>
            <section class="posts-grid">
                <?php while (have_posts()) : the_post(); ?>
                    <article <?php post_class('post-card'); ?>>
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
                <h2><?php esc_html_e('Nada encontrado.', 'tediado-clone'); ?></h2>
                <p class="post-excerpt"><?php esc_html_e('Tente outros termos para encontrar conteúdos.', 'tediado-clone'); ?></p>
                <?php get_search_form(); ?>
            </article>
        <?php endif; ?>
    </main>

    <?php get_sidebar(); ?>
</div>
<?php
get_footer();
