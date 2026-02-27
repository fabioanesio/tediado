<?php
/**
 * SEO and structured data.
 *
 * @package AziumeHumor
 */

function aziume_humor_meta_tags() {
	if ( is_singular() ) {
		global $post;
		$description = wp_trim_words( wp_strip_all_tags( get_the_excerpt( $post ) ), 28 );
		$image       = get_the_post_thumbnail_url( $post, 'large' );
		?>
		<meta property="og:type" content="article">
		<meta property="og:title" content="<?php echo esc_attr( get_the_title( $post ) ); ?>">
		<meta property="og:description" content="<?php echo esc_attr( $description ); ?>">
		<meta property="og:url" content="<?php echo esc_url( get_permalink( $post ) ); ?>">
		<meta property="og:image" content="<?php echo esc_url( $image ); ?>">
		<meta name="twitter:card" content="summary_large_image">
		<meta name="twitter:title" content="<?php echo esc_attr( get_the_title( $post ) ); ?>">
		<meta name="twitter:description" content="<?php echo esc_attr( $description ); ?>">
		<?php
	}
}
add_action( 'wp_head', 'aziume_humor_meta_tags', 5 );

function aziume_humor_schema_json_ld() {
	if ( ! is_singular( 'post' ) ) {
		return;
	}
	$schema = [
		'@context'      => 'https://schema.org',
		'@type'         => 'BlogPosting',
		'headline'      => get_the_title(),
		'datePublished' => get_the_date( DATE_W3C ),
		'dateModified'  => get_the_modified_date( DATE_W3C ),
		'author'        => [ '@type' => 'Person', 'name' => get_the_author() ],
		'mainEntityOfPage' => get_permalink(),
	];
	echo '<script type="application/ld+json">' . wp_json_encode( $schema ) . '</script>'; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
}
add_action( 'wp_head', 'aziume_humor_schema_json_ld', 30 );

function aziume_humor_breadcrumbs() {
	echo '<nav aria-label="Breadcrumb" class="breadcrumbs"><a href="' . esc_url( home_url( '/' ) ) . '">Home</a>';
	if ( is_single() ) {
		$category = get_the_category();
		if ( ! empty( $category ) ) {
			echo ' / <a href="' . esc_url( get_category_link( $category[0]->term_id ) ) . '">' . esc_html( $category[0]->name ) . '</a>';
		}
		echo ' / <span>' . esc_html( get_the_title() ) . '</span>';
	}
	echo '</nav>';
}

function aziume_humor_related_posts( $post_id, $limit = 4 ) {
	$cats = wp_get_post_categories( $post_id );
	if ( empty( $cats ) ) {
		return new WP_Query();
	}
	return new WP_Query(
		[
			'post_type'           => 'post',
			'posts_per_page'      => $limit,
			'post__not_in'        => [ $post_id ],
			'category__in'        => $cats,
			'ignore_sticky_posts' => true,
		]
	);
}
