<?php
/**
 * Viral features.
 *
 * @package AziumeHumor
 */

function aziume_humor_track_post_views() {
	if ( ! is_single() || is_admin() ) {
		return;
	}
	$post_id = get_the_ID();
	if ( ! $post_id ) {
		return;
	}
	$total = (int) get_post_meta( $post_id, '_aziume_views_total', true );
	$week  = (int) get_post_meta( $post_id, '_aziume_views_week', true );
	update_post_meta( $post_id, '_aziume_views_total', $total + 1 );
	update_post_meta( $post_id, '_aziume_views_week', $week + 1 );
}
add_action( 'wp', 'aziume_humor_track_post_views' );

function aziume_humor_get_trending_posts( $limit = 6 ) {
	return new WP_Query(
		[
			'post_type'      => 'post',
			'posts_per_page' => $limit,
			'meta_key'       => '_aziume_views_week',
			'orderby'        => 'meta_value_num',
			'order'          => 'DESC',
		]
	);
}

function aziume_humor_schedule_weekly_reset() {
	if ( ! wp_next_scheduled( 'aziume_humor_reset_weekly_ranking' ) ) {
		wp_schedule_event( time(), 'weekly', 'aziume_humor_reset_weekly_ranking' );
	}
}
add_action( 'after_switch_theme', 'aziume_humor_schedule_weekly_reset' );

function aziume_humor_add_weekly_cron_interval( $schedules ) {
	$schedules['weekly'] = [
		'interval' => WEEK_IN_SECONDS,
		'display'  => __( 'Once Weekly', 'aziume-humor' ),
	];
	return $schedules;
}
add_filter( 'cron_schedules', 'aziume_humor_add_weekly_cron_interval' );

function aziume_humor_reset_weekly_ranking() {
	global $wpdb;
	$wpdb->query( "DELETE FROM {$wpdb->postmeta} WHERE meta_key = '_aziume_views_week'" ); // phpcs:ignore WordPress.DB.DirectDatabaseQuery.DirectQuery
}
add_action( 'aziume_humor_reset_weekly_ranking', 'aziume_humor_reset_weekly_ranking' );

function aziume_humor_save_reaction() {
	check_ajax_referer( 'aziume_reactions_nonce', 'nonce' );
	$post_id   = absint( $_POST['post_id'] ?? 0 );
	$reaction  = sanitize_key( $_POST['reaction'] ?? '' );
	$allowed   = [ 'laugh', 'love', 'shock' ];
	if ( ! $post_id || ! in_array( $reaction, $allowed, true ) ) {
		wp_send_json_error();
	}
	$key   = '_aziume_reaction_' . $reaction;
	$count = (int) get_post_meta( $post_id, $key, true );
	update_post_meta( $post_id, $key, $count + 1 );
	wp_send_json_success( [ 'count' => $count + 1 ] );
}
add_action( 'wp_ajax_aziume_react', 'aziume_humor_save_reaction' );
add_action( 'wp_ajax_nopriv_aziume_react', 'aziume_humor_save_reaction' );
