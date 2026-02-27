<?php
/**
 * Home portal.
 *
 * @package AziumeHumor
 */
get_header();
$options = aziume_humor_get_options();

if ( '1' === $options['show_trending'] ) {
	$trending = aziume_humor_get_trending_posts();
	echo '<section><h2>🔥 Trending</h2><div class="post-grid">';
	while ( $trending->have_posts() ) {
		$trending->the_post();
		get_template_part( 'template-parts/content', 'card' );
	}
	echo '</div></section>';
	wp_reset_postdata();
}

if ( '1' === $options['show_most_read'] ) {
	$most_read = new WP_Query( [ 'post_type' => 'post', 'posts_per_page' => 6, 'meta_key' => '_aziume_views_total', 'orderby' => 'meta_value_num', 'order' => 'DESC' ] );
	echo '<section><h2>🏆 Mais lidos</h2><div class="post-grid">';
	while ( $most_read->have_posts() ) {
		$most_read->the_post();
		get_template_part( 'template-parts/content', 'card' );
	}
	echo '</div></section>';
	wp_reset_postdata();
}

if ( '1' === $options['show_recent'] ) {
	$recent = new WP_Query( [ 'post_type' => 'post', 'posts_per_page' => 9 ] );
	echo '<section><h2>🆕 Recentes</h2><div class="post-grid">';
	$i = 0;
	while ( $recent->have_posts() ) {
		$recent->the_post();
		get_template_part( 'template-parts/content', 'card' );
		$i++;
		if ( 0 === $i % 4 ) {
			aziume_humor_render_ad_slot( 'infeed_ad' );
		}
	}
	echo '</div></section>';
	wp_reset_postdata();
}

if ( '1' === $options['show_random'] ) {
	$random = new WP_Query( [ 'post_type' => 'post', 'posts_per_page' => 6, 'orderby' => 'rand' ] );
	echo '<section><h2>🎲 Aleatórios</h2><div class="post-grid">';
	while ( $random->have_posts() ) {
		$random->the_post();
		get_template_part( 'template-parts/content', 'card' );
	}
	echo '</div></section>';
	wp_reset_postdata();
}

get_footer();
