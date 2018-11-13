<?php
/**
 * Plugin Name: Jetpack Smooth Generator
 * Plugin Description: Fill your site with posts and stuff.
 */


if ( ! defined( 'ABSPATH' ) ) {
	exit();
}

define( 'CONTENT_SITE_URL', 'https://bleeding.jurassic.ninja' );

jsg_cli();

function jsg_cli() {
	if ( defined( 'WP_CLI' ) && WP_CLI ) {
		$features = array(
			'generate-posts.php',
			'generate-settings.php',
		);

		foreach( $features as $feature ) {
			require( "features/$feature" );

		}
	}
}
