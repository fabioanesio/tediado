<?php
if (!defined('ABSPATH')) {
    exit;
}
?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<?php wp_body_open(); ?>
<header class="site-header">
    <div class="top-wrap">
        <div class="site-branding">
            <p class="site-title"><a href="<?php echo esc_url(home_url('/')); ?>"><?php bloginfo('name'); ?></a></p>
            <p class="site-description"><?php bloginfo('description'); ?></p>
        </div>

        <nav class="main-nav" aria-label="<?php esc_attr_e('Menu principal', 'tediado-clone'); ?>">
            <?php
            wp_nav_menu([
                'theme_location' => 'primary',
                'container'      => false,
                'fallback_cb'    => 'wp_page_menu',
            ]);
            ?>
        </nav>
    </div>
</header>
