<?php
/**
 * Theme options panel.
 *
 * @package AziumeHumor
 */

function aziume_humor_get_options() {
	$defaults = [
		'primary_color'      => '#ff3b30',
		'dark_mode_default'  => '0',
		'show_trending'      => '1',
		'show_recent'        => '1',
		'show_random'        => '1',
		'show_most_read'     => '1',
		'custom_logo_url'    => '',
		'header_ad'          => '',
		'infeed_ad'          => '',
		'mobile_sticky_ad'   => '',
		'sponsor_html'       => '',
		'custom_head_script' => '',
		'facebook_url'       => '',
		'telegram_url'       => '',
		'whatsapp_url'       => '',
	];
	return wp_parse_args( get_option( 'aziume_humor_options', [] ), $defaults );
}

function aziume_humor_register_options_page() {
	add_theme_page( 'Aziume Humor', 'Aziume Humor', 'manage_options', 'aziume-humor', 'aziume_humor_render_options_page' );
}
add_action( 'admin_menu', 'aziume_humor_register_options_page' );

function aziume_humor_register_settings() {
	register_setting( 'aziume_humor_options_group', 'aziume_humor_options', 'aziume_humor_sanitize_options' );
}
add_action( 'admin_init', 'aziume_humor_register_settings' );

function aziume_humor_sanitize_options( $input ) {
	$output                        = [];
	$output['primary_color']       = sanitize_hex_color( $input['primary_color'] ?? '#ff3b30' );
	$output['dark_mode_default']   = isset( $input['dark_mode_default'] ) ? '1' : '0';
	$output['show_trending']       = isset( $input['show_trending'] ) ? '1' : '0';
	$output['show_recent']         = isset( $input['show_recent'] ) ? '1' : '0';
	$output['show_random']         = isset( $input['show_random'] ) ? '1' : '0';
	$output['show_most_read']      = isset( $input['show_most_read'] ) ? '1' : '0';
	$output['custom_logo_url']     = esc_url_raw( $input['custom_logo_url'] ?? '' );
	$output['header_ad']           = wp_kses_post( $input['header_ad'] ?? '' );
	$output['infeed_ad']           = wp_kses_post( $input['infeed_ad'] ?? '' );
	$output['mobile_sticky_ad']    = wp_kses_post( $input['mobile_sticky_ad'] ?? '' );
	$output['sponsor_html']        = wp_kses_post( $input['sponsor_html'] ?? '' );
	$output['custom_head_script']  = wp_kses( $input['custom_head_script'] ?? '', [ 'script' => [ 'src' => true, 'async' => true, 'defer' => true ] ] );
	$output['facebook_url']        = esc_url_raw( $input['facebook_url'] ?? '' );
	$output['telegram_url']        = esc_url_raw( $input['telegram_url'] ?? '' );
	$output['whatsapp_url']        = esc_url_raw( $input['whatsapp_url'] ?? '' );
	return $output;
}

function aziume_humor_render_options_page() {
	$options = aziume_humor_get_options();
	?>
	<div class="wrap">
		<h1><?php esc_html_e( 'Aziume Humor — Painel do Tema', 'aziume-humor' ); ?></h1>
		<form method="post" action="options.php">
			<?php settings_fields( 'aziume_humor_options_group' ); ?>
			<table class="form-table" role="presentation">
				<tr><th><?php esc_html_e( 'Cor Primária', 'aziume-humor' ); ?></th><td><input type="color" name="aziume_humor_options[primary_color]" value="<?php echo esc_attr( $options['primary_color'] ); ?>"></td></tr>
				<tr><th><?php esc_html_e( 'Logo URL', 'aziume-humor' ); ?></th><td><input class="regular-text" type="url" name="aziume_humor_options[custom_logo_url]" value="<?php echo esc_url( $options['custom_logo_url'] ); ?>"></td></tr>
				<tr><th><?php esc_html_e( 'Dark Mode padrão', 'aziume-humor' ); ?></th><td><label><input type="checkbox" name="aziume_humor_options[dark_mode_default]" <?php checked( '1', $options['dark_mode_default'] ); ?>> <?php esc_html_e( 'Ativo', 'aziume-humor' ); ?></label></td></tr>
				<tr><th><?php esc_html_e( 'Blocos Home', 'aziume-humor' ); ?></th><td>
					<label><input type="checkbox" name="aziume_humor_options[show_trending]" <?php checked( '1', $options['show_trending'] ); ?>> Trending</label><br>
					<label><input type="checkbox" name="aziume_humor_options[show_most_read]" <?php checked( '1', $options['show_most_read'] ); ?>> Mais Lidos</label><br>
					<label><input type="checkbox" name="aziume_humor_options[show_recent]" <?php checked( '1', $options['show_recent'] ); ?>> Recentes</label><br>
					<label><input type="checkbox" name="aziume_humor_options[show_random]" <?php checked( '1', $options['show_random'] ); ?>> Aleatórios</label>
				</td></tr>
				<tr><th><?php esc_html_e( 'Anúncio Header', 'aziume-humor' ); ?></th><td><textarea class="large-text" rows="4" name="aziume_humor_options[header_ad]"><?php echo esc_textarea( $options['header_ad'] ); ?></textarea></td></tr>
				<tr><th><?php esc_html_e( 'Anúncio In-feed', 'aziume-humor' ); ?></th><td><textarea class="large-text" rows="4" name="aziume_humor_options[infeed_ad]"><?php echo esc_textarea( $options['infeed_ad'] ); ?></textarea></td></tr>
				<tr><th><?php esc_html_e( 'Anúncio mobile fixo', 'aziume-humor' ); ?></th><td><textarea class="large-text" rows="4" name="aziume_humor_options[mobile_sticky_ad]"><?php echo esc_textarea( $options['mobile_sticky_ad'] ); ?></textarea></td></tr>
				<tr><th><?php esc_html_e( 'Área patrocinador premium', 'aziume-humor' ); ?></th><td><textarea class="large-text" rows="4" name="aziume_humor_options[sponsor_html]"><?php echo esc_textarea( $options['sponsor_html'] ); ?></textarea></td></tr>
				<tr><th><?php esc_html_e( 'Script personalizado', 'aziume-humor' ); ?></th><td><textarea class="large-text code" rows="4" name="aziume_humor_options[custom_head_script]"><?php echo esc_textarea( $options['custom_head_script'] ); ?></textarea></td></tr>
				<tr><th>Facebook</th><td><input class="regular-text" type="url" name="aziume_humor_options[facebook_url]" value="<?php echo esc_url( $options['facebook_url'] ); ?>"></td></tr>
				<tr><th>Telegram</th><td><input class="regular-text" type="url" name="aziume_humor_options[telegram_url]" value="<?php echo esc_url( $options['telegram_url'] ); ?>"></td></tr>
				<tr><th>WhatsApp</th><td><input class="regular-text" type="url" name="aziume_humor_options[whatsapp_url]" value="<?php echo esc_url( $options['whatsapp_url'] ); ?>"></td></tr>
			</table>
			<?php submit_button(); ?>
		</form>
	</div>
	<?php
}

function aziume_humor_inject_custom_head_script() {
	$options = aziume_humor_get_options();
	if ( ! empty( $options['custom_head_script'] ) ) {
		echo $options['custom_head_script']; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
	}
}
add_action( 'wp_head', 'aziume_humor_inject_custom_head_script', 99 );
