<?php
/**
 * Plugin Name: Architecturer Theme Elements for Elementor
 * Description: Custom elements for Elementor using Architecturer theme
 * Plugin URI:  http://themegoods.com/
 * Version:     1.6
 * Author:      ThemGoods
 * Author URI:  http://themegoods.com/
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die();
}

define( 'ARCHITECTURER_ELEMENTOR_PATH', plugin_dir_path( __FILE__ ));

if (!defined('ARCHITECTURER_THEMEDATEFORMAT'))
{
	define("ARCHITECTURER_THEMEDATEFORMAT", get_option('date_format'));
}

if (!defined('ARCHITECTURER_THEMETIMEFORMAT'))
{
	define("ARCHITECTURER_THEMETIMEFORMAT", get_option('time_format'));
}

/**
 * Load the plugin after Elementor (and other plugins) are loaded.
 *
 * @since 1.0.0
 */
function architecturer_elementor_load() {
	load_plugin_textdomain( 'architecturer-elementor', FALSE, dirname( plugin_basename(__FILE__) ) . '/languages/' );
	
	// Require the main plugin file
	require(ARCHITECTURER_ELEMENTOR_PATH.'/tools.php');
	require(ARCHITECTURER_ELEMENTOR_PATH.'/actions.php');
	require(ARCHITECTURER_ELEMENTOR_PATH.'/templates.php' );
	require(ARCHITECTURER_ELEMENTOR_PATH.'/plugin.php' );
	require(ARCHITECTURER_ELEMENTOR_PATH.'/page-fields.php' );
	require(ARCHITECTURER_ELEMENTOR_PATH.'/post-fields.php' );
}
add_action( 'plugins_loaded', 'architecturer_elementor_load' );


function post_type_footer() {
	$labels = array(
    	'name' => _x('Footers', 'post type general name', 'architecturer-elementor'),
    	'singular_name' => _x('Footer', 'post type singular name', 'architecturer-elementor'),
    	'add_new' => _x('Add New Footer', 'book', 'architecturer-elementor'),
    	'add_new_item' => __('Add New Footer', 'architecturer-elementor'),
    	'edit_item' => __('Edit Footer', 'architecturer-elementor'),
    	'new_item' => __('New Footer', 'architecturer-elementor'),
    	'view_item' => __('View Footer', 'architecturer-elementor'),
    	'search_items' => __('Search Footer', 'architecturer-elementor'),
    	'not_found' =>  __('No Footer found', 'architecturer-elementor'),
    	'not_found_in_trash' => __('No Footer found in Trash', 'architecturer-elementor'), 
    	'parent_item_colon' => ''
	);		
	$args = array(
    	'labels' => $labels,
    	'public' => true,
    	'publicly_queryable' => true,
    	'show_ui' => true, 
    	'query_var' => true,
    	'rewrite' => true,
    	'capability_type' => 'post',
    	'hierarchical' => false,
    	'show_in_nav_menus' => false,
    	'show_in_admin_bar' => true,
    	'menu_position' => 20,
    	'exclude_from_search' => true,
    	'supports' => array('title', 'content'),
    	'menu_icon' => 'dashicons-editor-insertmore'
	); 		

	register_post_type( 'footer', $args );
} 
								  
add_action('init', 'post_type_footer');