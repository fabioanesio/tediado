<?php
/**
 * Security hardening.
 *
 * @package AziumeHumor
 */

function aziume_humor_disable_file_editing() {
	if ( ! defined( 'DISALLOW_FILE_EDIT' ) ) {
		define( 'DISALLOW_FILE_EDIT', true );
	}
}
add_action( 'after_setup_theme', 'aziume_humor_disable_file_editing', 1 );

function aziume_humor_secure_upload_mimes( $mimes ) {
	$mimes['webp'] = 'image/webp';
	return $mimes;
}
add_filter( 'upload_mimes', 'aziume_humor_secure_upload_mimes' );
