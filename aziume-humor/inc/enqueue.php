<?php
/**
 * Scripts and styles.
 *
 * @package AziumeHumor
 */

function aziume_humor_enqueue_assets() {
	$ver = AZIUME_HUMOR_VERSION;

	wp_enqueue_style( 'aziume-critical', AZIUME_HUMOR_URL . '/assets/css/critical.min.css', [], $ver );
	wp_enqueue_style( 'aziume-main', AZIUME_HUMOR_URL . '/assets/css/main.min.css', [ 'aziume-critical' ], $ver );

	wp_enqueue_script( 'aziume-main', AZIUME_HUMOR_URL . '/assets/js/main.min.js', [], $ver, true );
	wp_localize_script(
		'aziume-main',
		'aziumeHumor',
		[
			'ajaxUrl' => admin_url( 'admin-ajax.php' ),
			'nonce'   => wp_create_nonce( 'aziume_reactions_nonce' ),
		]
	);
}
add_action( 'wp_enqueue_scripts', 'aziume_humor_enqueue_assets' );

function aziume_humor_resource_hints( $hints, $relation_type ) {
	if ( 'preconnect' === $relation_type ) {
		$hints[] = [ 'href' => 'https://fonts.gstatic.com', 'crossorigin' ];
	}
	return $hints;
}
add_filter( 'wp_resource_hints', 'aziume_humor_resource_hints', 10, 2 );

function aziume_humor_defer_scripts( $tag, $handle ) {
	if ( 'aziume-main' === $handle ) {
		return str_replace( ' src', ' defer src', $tag );
	}
	return $tag;
}
add_filter( 'script_loader_tag', 'aziume_humor_defer_scripts', 10, 2 );
