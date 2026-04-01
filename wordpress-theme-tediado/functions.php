<?php

if (!defined('ABSPATH')) {
    exit;
}

require get_template_directory() . '/customizer.php';

function tediado_clone_setup(): void
{
    add_theme_support('title-tag');
    add_theme_support('post-thumbnails');
    add_theme_support('html5', ['search-form', 'gallery', 'caption', 'style', 'script']);

    register_nav_menus([
        'primary' => __('Menu Principal', 'tediado-clone'),
    ]);
}
add_action('after_setup_theme', 'tediado_clone_setup');

function tediado_clone_assets(): void
{
    wp_enqueue_style('tediado-clone-style', get_stylesheet_uri(), [], '1.1.0');
}
add_action('wp_enqueue_scripts', 'tediado_clone_assets');

function tediado_clone_widgets(): void
{
    register_sidebar([
        'name'          => __('Sidebar Principal', 'tediado-clone'),
        'id'            => 'sidebar-1',
        'description'   => __('Widgets da lateral no estilo Tediado.', 'tediado-clone'),
        'before_widget' => '<section id="%1$s" class="widget %2$s">',
        'after_widget'  => '</section>',
        'before_title'  => '<h2 class="widget-title">',
        'after_title'   => '</h2>',
    ]);
}
add_action('widgets_init', 'tediado_clone_widgets');
