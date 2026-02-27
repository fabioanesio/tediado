<?php
/**
 * Archive template.
 *
 * @package AziumeHumor
 */
get_header();
?>
<header class="archive-header"><h1><?php the_archive_title(); ?></h1></header>
<section class="post-grid">
	<?php
	if ( have_posts() ) {
		while ( have_posts() ) {
			the_post();
			get_template_part( 'template-parts/content', 'card' );
		}
		the_posts_pagination();
	} else {
		get_template_part( 'template-parts/content', 'none' );
	}
	?>
</section>
<?php
get_footer();
