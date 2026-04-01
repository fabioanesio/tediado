<?php
if (!defined('ABSPATH')) {
    exit;
}
?>
<aside class="sidebar">
    <?php if (is_active_sidebar('sidebar-1')) : ?>
        <?php dynamic_sidebar('sidebar-1'); ?>
    <?php else : ?>
        <section class="widget">
            <h2 class="widget-title"><?php esc_html_e('Categorias', 'tediado-clone'); ?></h2>
            <ul>
                <?php wp_list_categories(['title_li' => '']); ?>
            </ul>
        </section>

        <section class="widget">
            <h2 class="widget-title"><?php esc_html_e('Assuntos do Momento', 'tediado-clone'); ?></h2>
            <ul>
                <?php
                wp_get_archives([
                    'type'            => 'postbypost',
                    'limit'           => 6,
                    'show_post_count' => false,
                ]);
                ?>
            </ul>
        </section>
    <?php endif; ?>
</aside>
