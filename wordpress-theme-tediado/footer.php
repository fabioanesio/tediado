<?php
if (!defined('ABSPATH')) {
    exit;
}
?>
<footer class="site-footer">
    <div class="footer-inner">
        <p>
            <?php
            printf(
                esc_html__('Copyright © %1$s %2$s | Inspirado no estilo editorial do Tediado.', 'tediado-clone'),
                esc_html(wp_date('Y')),
                esc_html(get_bloginfo('name'))
            );
            ?>
        </p>
    </div>
</footer>
<?php wp_footer(); ?>
</body>
</html>
