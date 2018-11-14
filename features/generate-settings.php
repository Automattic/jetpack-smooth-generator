<?php

/**
 * Generate random Jetpack settings
 *
 * ## EXAMPLES
 *
 * jetpack generate settings
 *
 */
function jsg_generate_settings_cli_subcommand() {
		// $default = 'example.com';
		// if( $assoc_args[ 'default' ] ){
		//         $default = $assoc_args[ 'default' ];
		// }
		// $return = get_option( $args[0], $default );
		Jetpack_Options::get_all_jetpack_options();

		WP_CLI::success( 'Success' );
}

WP_CLI::add_command( 'jetpack generate settings', 'jsg_generate_settings_cli_subcommand' );
