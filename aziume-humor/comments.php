<?php
/**
 * Comments template.
 *
 * @package AziumeHumor
 */
if ( post_password_required() ) {
	return;
}
?>
<section id="comments" class="comments-area">
	<h2><?php esc_html_e( 'Comentários', 'aziume-humor' ); ?></h2>
	<?php wp_list_comments(); ?>
	<?php comment_form(); ?>
</section>
