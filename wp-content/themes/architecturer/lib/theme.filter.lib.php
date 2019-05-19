<?php
	
add_filter( 'zm_alr_login_redirect_url', 'architecturer_zm_alr_login_redirect_url', 16, 3 );
function architecturer_zm_alr_login_redirect_url() {
	if ( validate_username(sanitize_user($_POST['zm_alr_login_user_name'])) ){
		if ( username_exists(sanitize_user($_POST['zm_alr_login_user_name'])) ){
			$user = get_user_by( 'login', sanitize_user($_POST['zm_alr_login_user_name']) );
			
			if ( wp_check_password( $_POST['zm_alr_login_password'], $user->data->user_pass, $user->ID ) )
			{
				$user_homepage = get_the_author_meta( 'user_homepage', $user->ID );
				$user_loggedin_url = get_permalink($user_homepage);
				
			    return $user_loggedin_url;
			}
		}
	}
}
	
add_filter( 'the_password_form', 'architecturer_password_form' );
function architecturer_password_form() {
    $post = architecturer_get_wp_post();
    
    $label = 'pwbox-'.( empty( $post->ID ) ? rand() : $post->ID );
    
    $return_html = '<div class="protected-post-header"><h1>' . esc_html($post->post_title) . '</h1></div>';
    $return_html.= '<form class="protected-post-form" action="' .wp_login_url(). '?action=postpass" method="post">';
    $return_html.= esc_html__( "This content is password protected. To view it please enter your password below:", 'architecturer'  ).'<p><input name="post_password" id="' . $label . '" type="password" size="40" /></p>';
    
    $return_html.= '<p><input type="submit" name="Submit" class="button" value="' . esc_html__( "Authenticate", 'architecturer' ) . '" /></p>';
    $return_html.= '</form>';
    
    return $return_html;
}
	
if ( ! function_exists( 'architecturer_theme_kirki_update_url' ) ) {
    function architecturer_theme_kirki_update_url( $config ) {
        $config['url_path'] = get_template_directory_uri() . '/modules/kirki/';
        return $config;
    }
}
add_filter( 'kirki/config', 'architecturer_theme_kirki_update_url' );

add_action( 'customize_register', function( $wp_customize ) {
	/**
	 * The custom control class
	 */
	class Kirki_Controls_Title_Control extends Kirki_Control_Base {
		public $type = 'title';
		public function render_content() { 
			echo esc_html($this->label);
		}
	}
	// Register our custom control with Kirki
	add_filter( 'kirki/control_types', function( $controls ) {
		$controls['title'] = 'Kirki_Controls_Title_Control';
		return $controls;
	} );

} );

add_action( 'admin_footer', 'architecturer_welcome_dashboard_widget' );
function architecturer_welcome_dashboard_widget() {
 // Bail if not viewing the main dashboard page
 if ( get_current_screen()->base !== 'dashboard' ) {
  return;
 }
 ?>

 <div id="architecturer-welcome-id" class="welcome-panel" style="display: none;">
  <div class="welcome-panel-content">
	  <div style="height:10px"></div>
   <h2>Welcome to <?php echo esc_html(ARCHITECTURER_THEMENAME); ?> Theme</h2>
   <p class="about-description">Welcome to <?php echo esc_html(ARCHITECTURER_THEMENAME); ?> theme. <?php echo esc_html(ARCHITECTURER_THEMENAME); ?> is now installed and ready to use! Read below for additional informations. We hope you enjoy using the theme!</p>
   
   <br style="clear:both;"/>
   
   <div class="welcome-panel-column-container">
    
    <div class="one_half">
		<div class="step_icon">
			<a href="<?php echo admin_url("themes.php?page=install-required-plugins"); ?>">
				<i class="fas fa-plug"></i>
				<div class="step_title">Install Plugins</div>
			</a>
		</div>
		<div class="step_info">
			<?php echo esc_html(ARCHITECTURER_THEMENAME); ?> has required and recommended plugins in order to build your website using layouts you saw on our demo site. We recommend you to install all plugins first.
		</div>
	</div>
	
	<div class="one_half last">
		<div class="step_icon">
			<a href="<?php echo admin_url("post-new.php?post_type=page"); ?>">
				<i class="fa fa-file-alt"></i>
				<div class="step_title">Create Page</div>
			</a>
		</div>
		<div class="step_info">
			<?php echo esc_html(ARCHITECTURER_THEMENAME); ?> support standard WordPress page option. You can also use Elementor page builder to create and organise page contents.
		</div>
	</div>
	
	<div class="one_half">
		<div class="step_icon">
			<a href="<?php echo admin_url("customize.php"); ?>">
				<i class="fas fa-sliders-h"></i>
				<div class="step_title">Customize Theme</div>
			</a>
		</div>
		<div class="step_info">
			Start customize theme's layouts, typography, elements colors using WordPress customize and see your changes in live preview instantly.
		</div>
	</div>
	
	<div class="one_half last">
		<div class="step_icon">
			<a href="<?php echo admin_url("themes.php?page=functions.php#pp_panel_import-demo"); ?>">
				<i class="fas fa-database"></i>
				<div class="step_title">Import Demo</div>
			</a>
		</div>
		<div class="step_info">
			We created various ready to use pages for you to use as starting point of your website. We recommend you to install all recommended plugins before importing ready site contents.
		</div>
	</div>
	
	<br style="clear:both;"/>
	
	<h1>Support</h1>
	<div style="height:20px"></div>
	<div class="one_half nomargin">
		<div class="step_icon">
			<a href="https://themegoods.ticksy.com/submit/" target="_blank">
				<i class="fas fa-life-ring"></i>
				<div class="step_title">Submit a Ticket</div>
			</a>
		</div>
		<div class="step_info">
			We offer excellent support through our ticket system. Please make sure you prepare your purchased code first to access our services.
		</div>
	</div>
	
	<div class="one_half last nomargin">
		<div class="step_icon">
			<a href="http://docs.themegoods.com/docs/architecturer" target="_blank">
				<i class="fas fa-book"></i>
				<div class="step_title">Theme Document</div>
			</a>
		</div>
		<div class="step_info">
			This is the place to go find all reference aspects of theme functionalities. Our online documentation is resource for you to start using theme.
		</div>
	</div>
	
	<br style="clear:both;"/>
	
	<div style="height:30px"></div>
    
   </div>
  </div>
 </div>
 <script>
  jQuery(document).ready(function($) {
   	jQuery('#welcome-panel').after($('#architecturer-welcome-id').show());
  });
 </script>

<?php }

//Make widget support shortcode
add_filter('widget_text', 'do_shortcode');

function architecturer_tag_cloud_filter($args = array()) {
   $args['smallest'] = 12;
   $args['largest'] = 12;
   $args['unit'] = 'px';
   return $args;
}

add_filter('widget_tag_cloud_args', 'architecturer_tag_cloud_filter', 90);

//Customise Widget Title Code
add_filter( 'dynamic_sidebar_params', 'architecturer_wrap_widget_titles', 1 );
function architecturer_wrap_widget_titles( array $params ) 
{
	$widget =& $params[0];
	$widget['before_title'] = '<h2 class="widgettitle"><span>';
	$widget['after_title'] = '</span></h2>';
	
	return $params;
}

//Control post excerpt length
function architecturer_custom_excerpt_length( $length ) {
	return 40;
}
add_filter( 'excerpt_length', 'architecturer_custom_excerpt_length', 200 );


function architecturer_theme_queue_js(){
  if (is_singular() AND comments_open() AND (get_option('thread_comments') == 1)) {
      wp_enqueue_script( 'comment-reply' );
  }
}
add_action('get_header', 'architecturer_theme_queue_js');


function architecturer_add_meta_tags() {
    $post = architecturer_get_wp_post();
    
    echo '<meta charset="'.get_bloginfo( 'charset' ).'" />';
    
    //Check if responsive layout is enabled
    echo '<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />';
	
	//meta for phone number link on mobile
	echo '<meta name="format-detection" content="telephone=no">';
}
add_action( 'wp_head', 'architecturer_add_meta_tags' , 2 );

add_filter('redirect_canonical','custom_disable_redirect_canonical');
function custom_disable_redirect_canonical($redirect_url) {if (is_paged() && is_singular()) $redirect_url = false; return $redirect_url; }

add_action('elementor/widgets/widgets_registered', 'architecturer_unregister_elementor_widgets');

function architecturer_unregister_elementor_widgets($obj){
	$obj->unregister_widget_type('sidebar');
}

function architecturer_body_class_names($classes) 
{
	$post = architecturer_get_wp_post();
	
	if(isset($post->ID))
	{
		//Check if boxed layout is enable
		$page_boxed_layout = get_post_meta($post->ID, 'page_boxed_layout', true);
		if(!empty($page_boxed_layout))
		{
			$classes[] = esc_attr('tg_boxed');
		}
		
		//Get Page Menu Transparent Option
		$page_menu_transparent = get_post_meta($post->ID, 'page_menu_transparent', true);
		if(!empty($page_menu_transparent))
		{
			$classes[] = esc_attr('tg_menu_transparent');
		}
	}
	
	//if password protected
	if(post_password_required() && is_page())
	{
	   	$classes[] = esc_attr('tg_password_protected');
	}
	
	//Get lightbox color scheme
	$tg_lightbox_color_scheme = get_theme_mod('tg_lightbox_color_scheme', 'black');
	
	if(!empty($tg_lightbox_color_scheme))
	{
		$classes[] = esc_attr('tg_lightbox_'.$tg_lightbox_color_scheme);
	}
	
	//Get sidemenu on desktop class
	$tg_sidemenu = get_theme_mod('tg_sidemenu', false);

	if(!empty($tg_sidemenu))
	{
		$classes[] = esc_attr('tg_sidemenu_desktop');
	}
	
	//Get main menu layout
	$tg_menu_layout = architecturer_menu_layout();
	if(!empty($tg_menu_layout))
	{
		$classes[] = esc_attr($tg_menu_layout);
	}
	
	//Get fotoer reveal class
	$tg_footer_reveal = get_theme_mod('tg_footer_reveal', true);
	if(!empty($tg_footer_reveal))
	{
		$classes[] = esc_attr('tg_footer_reveal');
	}

	return $classes;
}

//Now add test class to the filter
add_filter('body_class','architecturer_body_class_names');

add_filter('upload_mimes', 'architecturer_add_custom_upload_mimes');
function architecturer_add_custom_upload_mimes($existing_mimes) 
{
  	$existing_mimes['woff'] = 'application/x-font-woff';
  	return $existing_mimes;
}

add_action('init','architecturer_shop_sorting_remove');
function architecturer_shop_sorting_remove() {
	$tg_shop_filter_sorting = get_theme_mod('tg_shop_filter_sorting', true);
	
	if(empty($tg_shop_filter_sorting))
	{
		remove_action( 'woocommerce_before_shop_loop', 'woocommerce_catalog_ordering', 30 );
		remove_action( 'woocommerce_after_shop_loop', 'woocommerce_catalog_ordering', 30 );
		
		remove_action( 'woocommerce_after_shop_loop', 'woocommerce_result_count', 20 );
		remove_action( 'woocommerce_before_shop_loop', 'woocommerce_result_count', 20 );
	}
}

add_action( 'show_user_profile', 'architecturer_extra_user_fields' );
add_action( 'edit_user_profile', 'architecturer_extra_user_fields' );
function architecturer_extra_user_fields( $user ) 
{ 
	$available_pages = get_pages();
?>
    <h3><?php esc_html_e('Client Options', 'architecturer' ); ?></h3>

    <table class="form-table">
        <tr>
            <th><label for="user_homepage"><?php esc_html_e('Client Homepage', 'architecturer' ); ?></label></th>
            <td>
                <select id="user_homepage" name="user_homepage">
	            <?php
		            $user_homepage = get_the_author_meta( 'user_homepage', $user->ID ); 
		            
					foreach($available_pages as $available_page) 
					{  
		        ?>
		        	<option value="<?php echo esc_attr($available_page->ID); ?>" <?php if($user_homepage == $available_page->ID) { ?>selected<?php } ?>><?php echo esc_attr($available_page->post_title); ?></option>
		        <?php
			        }
			    ?>
                </select>
                <span class="description"><?php esc_html_e('Select homepage for this user when logged in successfully', 'architecturer' ); ?></span>
            </td>
        </tr>
    </table>
<?php }
	
add_action( 'personal_options_update', 'architecturer_save_extra_user_fields' );
add_action( 'edit_user_profile_update', 'architecturer_save_extra_user_fields' );

function architecturer_save_extra_user_fields( $user_id ) 
{
    if ( !current_user_can( 'edit_user', $user_id ) ) { return false; }else{

        if(isset($_POST['user_homepage']) && $_POST['user_homepage'] != ""){
            update_user_meta( $user_id, 'user_homepage', $_POST['user_homepage'] );
        }
    }
}

add_action( 'admin_enqueue_scripts', 'architecturer_admin_pointers_header' );

function architecturer_admin_pointers_header() {
   if ( architecturer_admin_pointers_check() ) {
      add_action( 'admin_print_footer_scripts', 'architecturer_admin_pointers_footer' );

      wp_enqueue_script( 'wp-pointer' );
      wp_enqueue_style( 'wp-pointer' );
   }
}

function architecturer_admin_pointers_check() {
   $admin_pointers = architecturer_admin_pointers();
   foreach ( $admin_pointers as $pointer => $array ) {
      if ( $array['active'] )
         return true;
   }
}

function architecturer_admin_pointers_footer() {
   $admin_pointers = architecturer_admin_pointers();
?>
<script type="text/javascript">
/* <![CDATA[ */
( function($) {
   <?php
   foreach ( $admin_pointers as $pointer => $array ) {
      if ( $array['active'] ) {
         ?>
         $( '<?php echo esc_js($array['anchor_id']); ?>' ).pointer( {
            content: '<?php echo wp_kses_post($array['content']); ?>',
            position: {
            edge: '<?php echo esc_js($array['edge']); ?>',
            align: '<?php echo esc_js($array['align']); ?>'
         },
            close: function() {
               $.post( ajaxurl, {
                  pointer: '<?php echo esc_js($pointer); ?>',
                  action: 'dismiss-wp-pointer'
               } );
            }
         } ).pointer( 'open' );
         <?php
      }
   }
   ?>
} )(jQuery);
/* ]]> */
</script>
   <?php
}

function architecturer_admin_pointers() {
   $dismissed = explode( ',', (string) get_user_meta( get_current_user_id(), 'dismissed_wp_pointers', true ) );
   $prefix = 'architecturer_admin_pointer';
   
   //Page help pointers
   $elementor_builder_content = '<h3>Page Builder</h3>';
   $elementor_builder_content .= '<p>Basically you can use WordPress visual editor to create page content but theme also has another way to create page content. By using Elementor Page Builder, you would be ale to drag&drop each content block without coding knowledge. Click here to enable Elementor.</p>';
   
   $page_options_content = '<h3>Page Options</h3>';
   $page_options_content .= '<p>You can customise various options for this page including menu styling, page templates etc.</p>';
   
   $page_featured_image_content = '<h3>Page Featured Image</h3>';
   $page_featured_image_content .= '<p>Upload or select featured image for this page to displays it as background header.</p>';
   
   //Post help pointers
   $post_options_content = '<h3>Post Options</h3>';
   $post_options_content .= '<p>You can customise various options for this post including its layout and featured content type.</p>';
   
   $post_featured_image_content = '<h3>Post Featured Image (*Required)</h3>';
   $post_featured_image_content .= '<p>Upload or select featured image for this post to displays it as post image on blog, archive, category, tag and search pages.</p>';

   $tg_pointer_arr = array(   
   	  //Page help pointers
      $prefix . '_elementor_builder' => array(
         'content' => $elementor_builder_content,
         'anchor_id' => '#elementor-switch-mode-button .elementor-switch-mode-off',
         'edge' => 'top',
         'align' => 'left',
         'active' => ( ! in_array( $prefix . '_elementor_builder', $dismissed ) )
      ),
      
      $prefix . '_page_options' => array(
         'content' => $page_options_content,
         'anchor_id' => 'body.post-type-page #page_option_page_menu_transparent',
         'edge' => 'top',
         'align' => 'left',
         'active' => ( ! in_array( $prefix . '_page_options', $dismissed ) )
      ),
      
      $prefix . '_page_featured_image' => array(
         'content' => $page_featured_image_content,
         'anchor_id' => 'body.post-type-page #set-post-thumbnail',
         'edge' => 'top',
         'align' => 'left',
         'active' => ( ! in_array( $prefix . '_page_featured_image', $dismissed ) )
      ),
      
      //Post help pointers
      $prefix . '_post_options' => array(
         'content' => $post_options_content,
         'anchor_id' => 'body.post-type-post #post_option_post_layout',
         'edge' => 'top',
         'align' => 'left',
         'active' => ( ! in_array( $prefix . '_post_options', $dismissed ) )
      ),
      
      $prefix . '_post_featured_image' => array(
         'content' => $post_featured_image_content,
         'anchor_id' => 'body.post-type-post #set-post-thumbnail',
         'edge' => 'top',
         'align' => 'left',
         'active' => ( ! in_array( $prefix . '_post_featured_image', $dismissed ) )
      ),
   );

   return $tg_pointer_arr;
}
?>