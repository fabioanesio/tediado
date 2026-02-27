<?php
/**
 * Core bootstrap.
 *
 * @package AziumeHumor
 */

define( 'AZIUME_HUMOR_VERSION', '1.0.0' );
define( 'AZIUME_HUMOR_PATH', get_template_directory() );
define( 'AZIUME_HUMOR_URL', get_template_directory_uri() );

$aziume_modules = [
	'/inc/setup.php',
	'/inc/enqueue.php',
	'/inc/theme-options.php',
	'/inc/seo.php',
	'/inc/monetization.php',
	'/inc/viral.php',
	'/inc/templates.php',
	'/inc/security.php',
];

foreach ( $aziume_modules as $module ) {
	require_once AZIUME_HUMOR_PATH . $module;
}
