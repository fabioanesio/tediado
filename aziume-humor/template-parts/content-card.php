<?php
/**
 * Post card.
 *
 * @package AziumeHumor
 */
?>
<article <?php post_class( 'post-card' ); ?>>
	<a href="<?php the_permalink(); ?>">
		<?php if ( has_post_thumbnail() ) : the_post_thumbnail( 'aziume-card', [ 'loading' => 'lazy' ] ); endif; ?>
		<h3><?php the_title(); ?></h3>
	</a>
	<p><?php echo esc_html( wp_trim_words( get_the_excerpt(), 18 ) ); ?></p>
</article>
