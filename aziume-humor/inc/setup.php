<?php
/**
 * Theme setup.
 *
 * @package AziumeHumor
 */

function aziume_humor_setup() {
	load_theme_textdomain( 'aziume-humor', AZIUME_HUMOR_PATH . '/languages' );

	add_theme_support( 'title-tag' );
	add_theme_support( 'post-thumbnails' );
	add_theme_support( 'responsive-embeds' );
	add_theme_support( 'wp-block-styles' );
	add_theme_support( 'align-wide' );
	add_theme_support( 'editor-styles' );
	add_theme_support( 'html5', [ 'comment-list', 'comment-form', 'search-form', 'gallery', 'caption', 'style', 'script' ] );
	add_theme_support( 'custom-logo', [ 'height' => 100, 'width' => 320, 'flex-height' => true, 'flex-width' => true ] );
	add_theme_support( 'automatic-feed-links' );
	add_theme_support( 'customize-selective-refresh-widgets' );
	add_theme_support( 'amp' );

	register_nav_menus(
		[
			'primary' => __( 'Menu Principal', 'aziume-humor' ),
			'footer'  => __( 'Menu Rodapé', 'aziume-humor' ),
		]
	);

	add_image_size( 'aziume-card', 640, 420, true );
	add_image_size( 'aziume-hero', 1200, 680, true );
}
add_action( 'after_setup_theme', 'aziume_humor_setup' );

function aziume_humor_widgets_init() {
	register_sidebar(
		[
			'name'          => __( 'Sidebar Principal', 'aziume-humor' ),
			'id'            => 'sidebar-main',
			'before_widget' => '<section class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h3 class="widget-title">',
			'after_title'   => '</h3>',
		]
	);
}
add_action( 'widgets_init', 'aziume_humor_widgets_init' );
