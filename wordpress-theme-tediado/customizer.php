<?php

if (!defined('ABSPATH')) {
    exit;
}

function tediado_clone_customize_register(WP_Customize_Manager $wp_customize): void
{
    $wp_customize->add_section('tediado_clone_colors', [
        'title'       => __('Tediado Clone: Cores', 'tediado-clone'),
        'priority'    => 30,
        'description' => __('Personalize as cores principais do tema.', 'tediado-clone'),
    ]);

    $wp_customize->add_setting('tediado_clone_brand_color', [
        'default'           => '#e74c3c',
        'sanitize_callback' => 'sanitize_hex_color',
        'transport'         => 'refresh',
    ]);

    $wp_customize->add_control(new WP_Customize_Color_Control(
        $wp_customize,
        'tediado_clone_brand_color_control',
        [
            'label'    => __('Cor principal', 'tediado-clone'),
            'section'  => 'tediado_clone_colors',
            'settings' => 'tediado_clone_brand_color',
        ]
    ));
}
add_action('customize_register', 'tediado_clone_customize_register');

function tediado_clone_customizer_css(): void
{
    $brand_color = get_theme_mod('tediado_clone_brand_color', '#e74c3c');
    if (!$brand_color) {
        return;
    }

    $css = ':root{--brand:' . esc_html($brand_color) . ';--brand-dark:' . esc_html($brand_color) . ';}';
    wp_add_inline_style('tediado-clone-style', $css);
}
add_action('wp_enqueue_scripts', 'tediado_clone_customizer_css', 20);
