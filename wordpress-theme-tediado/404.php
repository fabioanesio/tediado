<?php
if (!defined('ABSPATH')) {
    exit;
}

get_header();
?>
<div class="site-main-wrap">
    <main>
        <article class="content-single">
            <h1><?php esc_html_e('Erro 404 — página não encontrada', 'tediado-clone'); ?></h1>
            <p class="post-excerpt"><?php esc_html_e('Esse conteúdo pode ter sido removido ou movido. Tente buscar por outro termo.', 'tediado-clone'); ?></p>
            <?php get_search_form(); ?>
            <p><a class="read-more" href="<?php echo esc_url(home_url('/')); ?>"><?php esc_html_e('Voltar para a página inicial', 'tediado-clone'); ?></a></p>
        </article>
    </main>

    <?php get_sidebar(); ?>
</div>
<?php
get_footer();
