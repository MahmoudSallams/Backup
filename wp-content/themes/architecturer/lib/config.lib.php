<?php
//Setup theme constant and default data
$theme_obj = wp_get_theme('architecturer');

define("ARCHITECTURER_THEMENAME", $theme_obj['Name']);
define("ARCHITECTURER_THEMEDEMO", false);
define("ARCHITECTURER_THEMEDEMOIG", 'modernarchitecture');
define("ARCHITECTURER_SHORTNAME", "pp");
define("ARCHITECTURER_THEMEVERSION", $theme_obj['Version']);
define("ARCHITECTURER_THEMEDEMOURL", $theme_obj['ThemeURI']);

if (!defined('ARCHITECTURER_THEMEDATEFORMAT'))
{
	define("ARCHITECTURER_THEMEDATEFORMAT", get_option('date_format'));
}

if (!defined('ARCHITECTURER_THEMETIMEFORMAT'))
{
	define("ARCHITECTURER_THEMETIMEFORMAT", get_option('time_format'));
}

define("ENVATOITEMID", 22544684);

//Get default WP uploads folder
$wp_upload_arr = wp_upload_dir();
define("ARCHITECTURER_THEMEUPLOAD", $wp_upload_arr['basedir']."/".strtolower(sanitize_title(ARCHITECTURER_THEMENAME))."/");
define("ARCHITECTURER_THEMEUPLOADURL", $wp_upload_arr['baseurl']."/".strtolower(sanitize_title(ARCHITECTURER_THEMENAME))."/");

if(!is_dir(ARCHITECTURER_THEMEUPLOAD))
{
	wp_mkdir_p(ARCHITECTURER_THEMEUPLOAD);
}

/**
*  Begin Global variables functions
*/

//Get default WordPress post variable
function architecturer_get_wp_post() {
	global $post;
	return $post;
}

//Get default WordPress file system variable
function architecturer_get_wp_filesystem() {
	require_once(ABSPATH . 'wp-admin/includes/file.php');
	WP_Filesystem();
	global $wp_filesystem;
	return $wp_filesystem;
}

//Get default WordPress wpdb variable
function architecturer_get_wpdb() {
	global $wpdb;
	return $wpdb;
}

//Get default WordPress wp_query variable
function architecturer_get_wp_query() {
	global $wp_query;
	return $wp_query;
}

//Get default WordPress customize variable
function architecturer_get_wp_customize() {
	global $wp_customize;
	return $wp_customize;
}

//Get default WordPress current screen variable
function architecturer_get_current_screen() {
	global $current_screen;
	return $current_screen;
}

//Get default WordPress paged variable
function architecturer_get_paged() {
	global $paged;
	return $paged;
}

//Get default WordPress registered widgets variable
function architecturer_get_registered_widget_controls() {
	global $wp_registered_widget_controls;
	return $wp_registered_widget_controls;
}

//Get default WordPress registered sidebars variable
function architecturer_get_registered_sidebars() {
	global $wp_registered_sidebars;
	return $wp_registered_sidebars;
}

//Get default Woocommerce variable
function architecturer_get_woocommerce() {
	global $woocommerce;
	return $woocommerce;
}

//Get all google font usages in customizer
function architecturer_get_google_fonts() {
	$architecturer_google_fonts = array('tg_body_font', 'tg_header_font', 'tg_menu_font', 'tg_sidemenu_font', 'tg_sidebar_title_font', 'tg_button_font');
	
	global $architecturer_google_fonts;
	return $architecturer_google_fonts;
}

//Get menu transparent variable
function architecturer_get_page_menu_transparent() {
	global $architecturer_page_menu_transparent;
	return $architecturer_page_menu_transparent;
}

//Set menu transparent variable
function architecturer_set_page_menu_transparent($new_value = '') {
	global $architecturer_page_menu_transparent;
	$architecturer_page_menu_transparent = $new_value;
}

//Get no header checker variable
function architecturer_get_is_no_header() {
	global $architecturer_is_no_header;
	return $architecturer_is_no_header;
}

//Get deafult theme screen CSS class
function architecturer_get_screen_class() {
	global $architecturer_screen_class;
	return $architecturer_screen_class;
}

//Set deafult theme screen CSS class
function architecturer_set_screen_class($new_value = '') {
	global $architecturer_screen_class;
	$architecturer_screen_class = $new_value;
}

//Get theme homepage style
function architecturer_get_homepage_style() {
	global $architecturer_homepage_style;
	return $architecturer_homepage_style;
}

//Set theme homepage style
function architecturer_set_homepage_style($new_value = '') {
	global $architecturer_homepage_style;
	$architecturer_homepage_style = $new_value;
}

//Get page gallery ID
function architecturer_get_page_gallery_id() {
	global $architecturer_page_gallery_id;
	return $architecturer_page_gallery_id;
}

//Get default theme options variable
function architecturer_get_options() {
	global $architecturer_options;
	return $architecturer_options;
}

//Set default theme options variable
function architecturer_set_options($new_value = '') {
	global $architecturer_options;
	$architecturer_options = $new_value;
}

//Get top bar setting
function architecturer_get_topbar() {
	global $architecturer_topbar;
	return $architecturer_topbar;
}

//Set top bar setting
function architecturer_set_topbar($new_value = '') {
	global $architecturer_topbar;
	$architecturer_topbar = $new_value;
}

//Get is hide title option
function architecturer_get_hide_title() {
	global $architecturer_hide_title;
	return $architecturer_hide_title;
}

//Set is hide title option
function architecturer_set_hide_title($new_value = '') {
	global $architecturer_hide_title;
	$architecturer_hide_title = $new_value;
}

//Get theme page content CSS class
function architecturer_get_page_content_class() {
	global $architecturer_page_content_class;
	return $architecturer_page_content_class;
}

//Set theme page content CSS class
function architecturer_set_page_content_class($new_value = '') {
	global $architecturer_page_content_class;
	$architecturer_page_content_class = $new_value;
}

//Get Kirki global variable
function architecturer_get_kirki() {
	global $kirki;
	return $kirki;
}

//Get admin theme global variable
function architecturer_get_wp_admin_css_colors() {
	global $_wp_admin_css_colors;
	return $_wp_admin_css_colors;
}

//Get theme plugins
function architecturer_get_plugins() {
	global $architecturer_tgm_plugins;
	return $architecturer_tgm_plugins;
}

//Set theme plugins
function architecturer_set_plugins($new_value = '') {
	global $architecturer_tgm_plugins;
	$architecturer_tgm_plugins = $new_value;
}

$is_verified_envato_purchase_code = false;

//Get verified purchase code data
$pp_verified_envato_architecturer = get_option("pp_verified_envato_architecturer");
if(!empty($pp_verified_envato_architecturer))
{
	$is_verified_envato_purchase_code = true;
}

$is_imported_elementor_templates_architecturer = false;
$pp_imported_elementor_templates_architecturer = get_option("pp_imported_elementor_templates_architecturer");
if(!empty($pp_imported_elementor_templates_architecturer))
{
	$is_imported_elementor_templates_architecturer = true;
}
?>