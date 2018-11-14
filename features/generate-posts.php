<?php

WP_CLI::add_command( 'jetpack generate posts', 'jsg_generate_posts_cli_subcommand' );


/**
* Generate posts
*
* ## OPTIONS
*
* <amount>
* : The amount of posts to generate
* ---
* default: 10
* ---
*
* ## EXAMPLES
*
* jetpack generate 10
*
* @param array $args Arguments specified.
* @param array $assoc_args Associative arguments specified.
*
*/
function jsg_generate_posts_cli_subcommand( $args, $assoc_args ) {
		$number = $args[0];
		if ( ! is_numeric( $number) ) {
			WP_CLI::error( 'Please provide a number of posts to generate' );
			return;
		}
		$return = jsg_generate_posts( $number );
        WP_CLI::success( sprintf( __( 'Generated %s posts' ), ( int ) $number ) );
        return 0;
}

function jsg_generate_posts( $number = 10 ) {
	$page = 1;
	$per_page = 10;
	add_filter( 'jsg_generate_posts_post', 'jsg_filter_post' );
	while( $number > 0 ) {
		try {
			$posts = jsg_get_posts_from_mother_site( $per_page, $page );
			if ( ! $posts ) {
				die( 'ouch' );
			}
			foreach( $posts as $post ) {
				$post = apply_filters( 'jsg_generate_posts_post', $post );
				//var_dump($post);
				$ret = wp_insert_post( $post );
				if ( is_wp_error( $ret ) ) {
					echo "WOW";
				}
				$number--;
				if ( $number < 1 ) {
					break;
				}
			}

		} catch ( Exception $e ) {
			error_log( sprintf( __(  'Something failed while trying to generate posts', CONTENT_SITE_URL ) ) );
		}
	}
}


function jsg_get_posts_from_mother_site( $per_page = 10, $page = 1 ) {
	$posts = [];
	$request = wp_remote_get( CONTENT_SITE_URL . "/wp-json/wp/v2/posts?page=$page&per_page=$per_page" );
	if ( is_wp_error( $request ) ) {
		error_log( sprintf( __( 'Something failed while trying to fetch posts from %s', CONTENT_SITE_URL ) ) );
		return [];
	}
	$body = wp_remote_retrieve_body( $request );
	$data = json_decode( $body );
	if ( jsg_is_404( $request ) ) {
		error_log( sprintf( __( 'The API endpoint on %s returned 404 for that query %s', CONTENT_SITE_URL ) ) );
		return [];
	}
	return $data;
}

function jsg_filter_post( $post ) {
	return array(
		'post_title' => $post->title->rendered,
		'post_content' => $post->content->rendered,
		'post_status' => 'publish'
	);
}

function jsg_is_404( $response ) {
	return isset( $response->data ) && isset( $response->data->status ) && 400 == $response->data->status;
}
