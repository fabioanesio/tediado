<?php
/**
 * Template helpers and custom layout meta.
 *
 * @package AziumeHumor
 */

function aziume_humor_add_layout_metabox() {
	add_meta_box( 'aziume-post-layout', __( 'Layout Humor', 'aziume-humor' ), 'aziume_humor_layout_metabox_html', 'post', 'side' );
}
add_action( 'add_meta_boxes', 'aziume_humor_add_layout_metabox' );

function aziume_humor_layout_metabox_html( $post ) {
	wp_nonce_field( 'aziume_post_layout', 'aziume_post_layout_nonce' );
	$value = get_post_meta( $post->ID, '_aziume_post_layout', true );
	?>
	<select name="aziume_post_layout" style="width:100%">
		<option value="default" <?php selected( $value, 'default' ); ?>><?php esc_html_e( 'Padrão', 'aziume-humor' ); ?></option>
		<option value="single-image" <?php selected( $value, 'single-image' ); ?>><?php esc_html_e( 'Imagem única', 'aziume-humor' ); ?></option>
		<option value="gallery" <?php selected( $value, 'gallery' ); ?>><?php esc_html_e( 'Galeria', 'aziume-humor' ); ?></option>
		<option value="list" <?php selected( $value, 'list' ); ?>><?php esc_html_e( 'Lista', 'aziume-humor' ); ?></option>
		<option value="quick-joke" <?php selected( $value, 'quick-joke' ); ?>><?php esc_html_e( 'Piada rápida', 'aziume-humor' ); ?></option>
	</select>
	<?php
}

function aziume_humor_save_layout_metabox( $post_id ) {
	if ( ! isset( $_POST['aziume_post_layout_nonce'] ) || ! wp_verify_nonce( sanitize_text_field( wp_unslash( $_POST['aziume_post_layout_nonce'] ) ), 'aziume_post_layout' ) ) {
		return;
	}
	if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
		return;
	}
	if ( ! current_user_can( 'edit_post', $post_id ) ) {
		return;
	}
	$layout = sanitize_key( $_POST['aziume_post_layout'] ?? 'default' );
	update_post_meta( $post_id, '_aziume_post_layout', $layout );
}
add_action( 'save_post', 'aziume_humor_save_layout_metabox' );

function aziume_humor_get_post_layout( $post_id = null ) {
	$post_id = $post_id ? $post_id : get_the_ID();
	return get_post_meta( $post_id, '_aziume_post_layout', true ) ?: 'default';
}
