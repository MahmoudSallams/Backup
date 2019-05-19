<?php
	
//Get page custom fields values
function architecturer_get_page_postmetas() {
	//Get all sidebars
	$theme_sidebar = array(
		'' => '',
		'Page Sidebar' => 'Page Sidebar', 
		'Contact Sidebar' => 'Contact Sidebar', 
		'Blog Sidebar' => 'Blog Sidebar',
	);
	
	$dynamic_sidebar = get_option('pp_sidebar');
	
	if(!empty($dynamic_sidebar))
	{
		foreach($dynamic_sidebar as $sidebar)
		{
			$theme_sidebar[$sidebar] = $sidebar;
		}
	}
	
	/*
		Get gallery list
	*/
	$args = array(
	    'numberposts' => -1,
	    'post_type' => array('galleries'),
	);
	
	$galleries_arr = get_posts($args);
	$galleries_select = array();
	$galleries_select[0] = '';
	
	foreach($galleries_arr as $gallery)
	{
		$galleries_select[$gallery->ID] = $gallery->post_title;
	}
	
	/*
		Get page templates list
	*/
	if(function_exists('get_page_templates'))
	{
		$page_templates = get_page_templates();
		$page_templates_select = array();
		$page_key = 1;
		
		foreach ($page_templates as $template_name => $template_filename) 
		{
			$page_templates_select[$template_name] = get_template_directory_uri()."/functions/images/page/".basename($template_filename, '.php').".png";
			$page_key++;
		}
	}
	else
	{
		$page_templates_select = array();
	}
	
	/*
		Get all menus available
	*/
	$menus = get_terms('nav_menu');
	$menus_select = array(
		 '' => 'Default Menu'
	);
	foreach($menus as $each_menu)
	{
		$menus_select[$each_menu->slug] = $each_menu->name;
	}
	
	//Get all footer posts
	$args = array(
		 'post_type'     => 'footer',
		 'post_status'   => array( 'publish' ),
		 'numberposts'   => -1,
		 'orderby'       => 'title',
		 'order'         => 'ASC',
		 'suppress_filters'   => false
	);
	$footers = get_posts($args);
	$tg_footers_select = array();
	$tg_footers_select[''] = '';
	
	if(!empty($footers))
	{
		foreach ($footers as $footer)
		{
			$tg_footers_select[$footer->ID] = $footer->post_title;
		}
	}
	
	$architecturer_page_postmetas = array();
	
	$architecturer_page_postmetas_extended = 
		array (
			/*
				Begin Page custom fields
			*/
			array("section" => esc_html__('Page Title', 'architecturer'), "id" => "page_menu_transparent", "type" => "checkbox", "title" => esc_html__('Make Menu Transparent', 'architecturer' ), "description" => esc_html__('Check this option if you want to display main menu in transparent', 'architecturer' )),
			
			array("section" => esc_html__('Page Title', 'architecturer' ), "id" => "page_show_title", "type" => "checkbox", "title" => esc_html__('Hide Default Page Header', 'architecturer' ), "description" => esc_html__('Check this option if you want to hide default page header', 'architecturer' )),
			
			array("section" => esc_html__('Page Tagline', 'architecturer' ), "id" => "page_tagline", "type" => "textarea", "title" => esc_html__('Page Tagline (Optional)', 'architecturer' ), "description" => esc_html__('Enter page tagline. It will displays under page title (*Note: HTML code also support)', 'architecturer' )),
			
			array("section" => esc_html__('Layout', 'architecturer'), "id" => "page_boxed_layout", "type" => "checkbox", "title" => esc_html__('Boxed Layout', 'architecturer' ), "description" => esc_html__('Check this option if you want to enable boxed layout', 'architecturer' )),
			
			array("section" => esc_html__('Footer', 'architecturer' ), "id" => "page_show_copyright", "type" => "checkbox", "title" => esc_html__('Hide Page Copyright', 'architecturer' ), "description" => esc_html__('Check this option if you want to hide page copyright', 'architecturer' )),
			
			array("section" => esc_html__('Select Footer (Optional)', 'architecturer' ), "id" => "page_footer", "type" => "select", "title" => esc_html__('Page Footer (Optional)', 'architecturer' ), "description" => esc_html__('Select this page footer content if you want to display footer content other than default one', 'architecturer' ), "items" => $tg_footers_select),
			
			array("section" => esc_html__('Select Sidebar (Optional)', 'architecturer' ), "id" => "page_sidebar", "type" => "select", "title" => esc_html__('Page Sidebar (Optional)', 'architecturer' ), "description" => esc_html__('Select this page sidebar to display. To use this option, you have to select page template end with "Sidebar" only', 'architecturer' ), "items" => $theme_sidebar),
			
			array("section" => esc_html__('Select Menu', 'architecturer' ), "id" => "page_menu", "type" => "select", "title" => esc_html__('Page Menu (Optional)', 'architecturer' ), "description" => esc_html__('Select this page menu if you want to display main menu other than default one', 'architecturer' ), "items" => $menus_select),
		);
	
	
	$architecturer_page_postmetas = $architecturer_page_postmetas + $architecturer_page_postmetas_extended;
		
	return $architecturer_page_postmetas;
}
	
/**
 * The PHP code for setup Theme page custom fields.
 */

function architecturer_page_create_meta_box() {

	$architecturer_page_postmetas = architecturer_get_page_postmetas();
	
	if ( function_exists('add_meta_box') && isset($architecturer_page_postmetas) && count($architecturer_page_postmetas) > 0 ) {  
		add_meta_box( 'page_metabox', 'Page Options', 'architecturer_page_new_meta_box', 'page', 'normal', 'default' );  
	}

}  

function architecturer_page_new_meta_box() {
	$post = architecturer_get_wp_post();
	$architecturer_page_postmetas = architecturer_get_page_postmetas();

	echo '<input type="hidden" name="pp_meta_form" id="pp_meta_form" value="' . wp_create_nonce('architecturer_once') . '" />';
	
	$meta_section = '';
	$key = 0;
	foreach ( $architecturer_page_postmetas as $key => $postmeta ) {

		$meta_id = $postmeta['id'];
		$meta_title = $postmeta['title'];
		$meta_description = $postmeta['description'];
		$meta_section = $postmeta['section'];
		
		$meta_type = '';
		if(isset($postmeta['type']))
		{
			$meta_type = $postmeta['type'];
		}
		
		echo '<div id="page_option_'.strtolower($postmeta['id']).'" class="pp_meta_option page key'.intval($key+1).' '.$meta_type.'">';
		echo "<div class=\"meta_title_wrapper\">";
		echo "<strong>".$meta_title."</strong>";
		
		echo "<div class='pp_widget_description'>$meta_description</div>";
		
		echo "</div>";
		echo "<div class=\"meta_title_field\">";

		if ($meta_type == 'checkbox') {
			$checked = get_post_meta($post->ID, $meta_id, true) == '1' ? "checked" : "";
			echo "<input type='checkbox' name='$meta_id' id='$meta_id' class='iphone_checkboxes' value='1' $checked />";
		}
		else if ($meta_type == 'select') {
			echo "<select name='$meta_id' id='$meta_id'>";
			
			if(!empty($postmeta['items']))
			{
				foreach ($postmeta['items'] as $key => $item)
				{
					$page_style = get_post_meta($post->ID, $meta_id);
				
					if(isset($page_style[0]) && $key == $page_style[0])
					{
						$css_string = 'selected';
					}
					else
					{
						$css_string = '';
					}
				
					echo '<option value="'.$key.'" '.$css_string.'>'.$item.'</option>';
				}
			}
			
			echo "</select>";
		}
		else if ($meta_type == 'file') { 
		    echo "<input type='text' name='$meta_id' id='$meta_id' class='' value='".get_post_meta($post->ID, $meta_id, true)."' style='width:calc(100% - 75px)' /><input id='".$meta_id."_button' name='".$meta_id."_button' type='button' value='Upload' class='metabox_upload_btn button' readonly='readonly' rel='".$meta_id."' style='margin:0 0 0 5px' />";
		}
		else if ($meta_type == 'textarea') { 
			echo "<textarea name='$meta_id' id='$meta_id' class='' style='width:100%' rows='7'>".get_post_meta($post->ID, $meta_id, true)."</textarea>";
		}
		else {
			echo "<input type='text' name='$meta_id' id='$meta_id' class='' value='".get_post_meta($post->ID, $meta_id, true)."' style='width:100%' />";
		}
		
		echo '</div>';
		echo '</div>';
	}

}

function architecturer_page_save_postdata( $post_id ) {

	$architecturer_page_postmetas = architecturer_get_page_postmetas();

	// verify this came from the our screen and with proper authorization,
	// because save_post can be triggered at other times

	if ( isset($_POST['pp_meta_form']) && !wp_verify_nonce( $_POST['pp_meta_form'], 'architecturer_once' )) {
		return $post_id;
	}

	// verify if this is an auto save routine. If it is our form has not been submitted, so we dont want to do anything

	if ( defined('DOING_AUTOSAVE') && DOING_AUTOSAVE ) return $post_id;

	// Check permissions

	if ( isset($_POST['post_type']) && 'page' == $_POST['post_type'] ) {
		if ( !current_user_can( 'edit_page', $post_id ) )
			return $post_id;
		} else {
		if ( !current_user_can( 'edit_post', $post_id ) )
			return $post_id;
	}

	// OK, we're authenticated

	if ( $parent_id = wp_is_post_revision($post_id) )
	{
		$post_id = $parent_id;
	}
	
	if (isset($_POST['pp_meta_form'])) 
	{
	
		foreach ( $architecturer_page_postmetas as $postmeta ) 
		{
		
			if (isset($_POST[$postmeta['id']]) && $_POST[$postmeta['id']]) {
				architecturer_page_update_custom_meta($post_id, $_POST[$postmeta['id']], $postmeta['id']);
			}
	
			if (isset($_POST[$postmeta['id']]) && $_POST[$postmeta['id']] == "") {
				delete_post_meta($post_id, $postmeta['id']);
			}
			
			if (!isset($_POST[$postmeta['id']])) {
				delete_post_meta($post_id, $postmeta['id']);
			}
		}
	}

}

function architecturer_page_update_custom_meta($postID, $newvalue, $field_name) {

	if (isset($_POST['pp_meta_form'])) 
	{
		if (!get_post_meta($postID, $field_name)) {
			add_post_meta($postID, $field_name, $newvalue);
		} else {
			update_post_meta($postID, $field_name, $newvalue);
		}
	}

}

//init

add_action('admin_menu', 'architecturer_page_create_meta_box'); 
add_action('save_post', 'architecturer_page_save_postdata');  

/*
	End creating custom fields
*/

?>