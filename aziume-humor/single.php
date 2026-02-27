<?php
/**
 * Single post.
 *
 * @package AziumeHumor
 */
get_header();

while ( have_posts() ) :
	the_post();
	$layout = aziume_humor_get_post_layout();
	aziume_humor_breadcrumbs();
	?>
	<article <?php post_class( 'single-post layout-' . esc_attr( $layout ) ); ?>>
		<h1><?php the_title(); ?></h1>
		<div class="meta"><?php echo esc_html( get_the_date() ); ?> · <?php echo esc_html( (string) get_post_meta( get_the_ID(), '_aziume_views_total', true ) ); ?> views</div>
		<?php if ( has_post_thumbnail() ) : the_post_thumbnail( 'aziume-hero', [ 'loading' => 'eager', 'fetchpriority' => 'high' ] ); endif; ?>
		<div class="content"><?php the_content(); ?></div>
		<div class="floating-share">
			<a target="_blank" rel="noopener" href="https://wa.me/?text=<?php echo rawurlencode( get_permalink() ); ?>">WhatsApp</a>
			<a target="_blank" rel="noopener" href="https://www.facebook.com/sharer/sharer.php?u=<?php echo rawurlencode( get_permalink() ); ?>">Facebook</a>
			<a target="_blank" rel="noopener" href="https://t.me/share/url?url=<?php echo rawurlencode( get_permalink() ); ?>">Telegram</a>
		</div>
		<div class="reactions" data-post="<?php echo esc_attr( (string) get_the_ID() ); ?>">
			<button data-reaction="laugh">😂 <span><?php echo esc_html( (string) get_post_meta( get_the_ID(), '_aziume_reaction_laugh', true ) ); ?></span></button>
			<button data-reaction="love">😍 <span><?php echo esc_html( (string) get_post_meta( get_the_ID(), '_aziume_reaction_love', true ) ); ?></span></button>
			<button data-reaction="shock">😱 <span><?php echo esc_html( (string) get_post_meta( get_the_ID(), '_aziume_reaction_shock', true ) ); ?></span></button>
		</div>
	</article>

	<section>
		<h2><?php esc_html_e( 'Relacionados', 'aziume-humor' ); ?></h2>
		<div class="post-grid">
			<?php
			$related = aziume_humor_related_posts( get_the_ID() );
			while ( $related->have_posts() ) {
				$related->the_post();
				get_template_part( 'template-parts/content', 'card' );
			}
			wp_reset_postdata();
			?>
		</div>
	</section>
	<?php
	comments_template();
endwhile;

get_footer();
