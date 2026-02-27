<?php
/**
 * Monetization slots.
 *
 * @package AziumeHumor
 */

function aziume_humor_render_ad_slot( $slot ) {
	$options = aziume_humor_get_options();
	if ( empty( $options[ $slot ] ) ) {
		return;
	}
	echo '<div class="ad-slot ad-' . esc_attr( $slot ) . '">';
	echo wp_kses_post( $options[ $slot ] );
	echo '</div>';
}

function aziume_humor_mobile_sticky_ad() {
	if ( wp_is_mobile() ) {
		aziume_humor_render_ad_slot( 'mobile_sticky_ad' );
	}
}
add_action( 'wp_footer', 'aziume_humor_mobile_sticky_ad' );

function aziume_humor_inject_incontent_ads( $content ) {
	if ( ! is_single() || ! in_the_loop() || ! is_main_query() ) {
		return $content;
	}
	$options = aziume_humor_get_options();
	if ( empty( $options['infeed_ad'] ) ) {
		return $content;
	}
	$paragraphs = explode( '</p>', $content );
	if ( isset( $paragraphs[2] ) ) {
		$paragraphs[2] .= '</p><div class="ad-slot ad-incontent">' . wp_kses_post( $options['infeed_ad'] ) . '</div>';
	}
	return implode( '</p>', $paragraphs );
}
add_filter( 'the_content', 'aziume_humor_inject_incontent_ads' );
