<?php

/**
 * Generate random Jetpack settings
 *
 * ## EXAMPLES
 *
 * jetpack generate 10
 *
 * @param array $args Arguments specified.
 * @param array $assoc_args Associative arguments specified.
 *
 */
function jsg_generate_settings_cli_subcommand( $args, $assoc_args ) {
        // $default = 'example.com';
        // if( $assoc_args[ 'default' ] ){
        //         $default = $assoc_args[ 'default' ];
        // }
        // $return = get_option( $args[0], $default );
		$settings = Jetpack_Options::get_all_jetpack_options();

		var_dump($settings);
        WP_CLI::success( $return );
}

WP_CLI::add_command( 'jetpack generate settings', 'jsg_generate_settings_cli_subcommand' );
