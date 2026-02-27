<?php
/**
 * Header template.
 *
 * @package AziumeHumor
 */
$options = aziume_humor_get_options();
?><!doctype html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<?php wp_head(); ?>
</head>
<body <?php body_class( 'aziume-site' ); ?>>
<?php wp_body_open(); ?>
<header class="site-header">
	<div class="container header-inner">
		<div class="branding">
			<?php if ( has_custom_logo() ) : the_custom_logo(); elseif ( ! empty( $options['custom_logo_url'] ) ) : ?>
				<img src="<?php echo esc_url( $options['custom_logo_url'] ); ?>" alt="<?php bloginfo( 'name' ); ?>" loading="lazy">
			<?php else : ?>
				<a href="<?php echo esc_url( home_url( '/' ) ); ?>"><?php bloginfo( 'name' ); ?></a>
			<?php endif; ?>
		</div>
		<nav class="main-nav" aria-label="Principal">
			<?php wp_nav_menu( [ 'theme_location' => 'primary', 'container' => false, 'fallback_cb' => false ] ); ?>
		</nav>
	</div>
	<?php aziume_humor_render_ad_slot( 'header_ad' ); ?>
</header>
<main class="site-main container">
