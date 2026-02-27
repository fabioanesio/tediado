<?php
/**
 * Index fallback.
 *
 * @package AziumeHumor
 */
get_header();
if ( have_posts() ) :
	echo '<section class="post-grid">';
	while ( have_posts() ) :
		the_post();
		get_template_part( 'template-parts/content', 'card' );
	endwhile;
	echo '</section>';
	the_posts_pagination();
else :
	get_template_part( 'template-parts/content', 'none' );
endif;
get_footer();
