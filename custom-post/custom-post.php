<?php
/**
 * Plugin Name: Custom Post
 * Plugin URI: http://www.example.com
 * Description: Custom Post
 * Version: 1.0
 * Author: Your Name
 * Author URI: http://www.example.com
 * License: GPL2
 * Text Domain: custom-post
 * Domain Path: /languages
 * Network: true
 * Site Wide Only: true
 *
 * @package Custom Post
 * @version 1.0
 * @since 1.0
 * @link http://www.example.com
 * @author Your Name
 * @license GPL2
 */

/**
 * Activation callback.
 *
 * @return void
 */
function activate_custom_post_plugin(): void {
	// Do something
}
register_activation_hook( __FILE__, 'activate_custom_post_plugin' );

/**
 * Deactivation callback.
 *
 * @return void
 */
function deactivate_custom_post_plugin(): void {
	// Do something
}
register_deactivation_hook( __FILE__, 'deactivate_custom_post_plugin' );

/**
 * Register custom post type.
 *
 * @return void
 */
function create_post_type() : void {
	register_post_type(
		'movie',
		array(
			'labels' => array(
				'name' => 'Movies',
				'singular_name' => 'Movie'
			),
			'public' => true
		)
	);
}

// Create custom post type on init.
add_action('init', 'create_post_type');