<?php
require_once get_template_directory() . "/modules/class-tgm-plugin-activation.php";
add_action( 'tgmpa_register', 'architecturer_require_plugins' );
 
function architecturer_require_plugins() {
 
    $plugins = array(
	    array(
	        'name'      		 => 'Elementor Page Builder',
	        'slug'      		 => 'elementor',
	        'required'  		 => true, 
	    ),
	    array(
	        'name'               => 'Architecturer Theme Elements for Elementor',
	        'slug'      		 => 'architecturer-elementor',
	        'source'             => get_template_directory() . '/lib/plugins/architecturer-elementor.zip',
	        'required'           => true, 
	        'version'            => '1.6',
	    ),
	    array(
	        'name'      		 => 'ZM Ajax Login & Register',
	        'slug'      		 => 'zm-ajax-login-register',
	        'required'  		 => true, 
	    ),
	    array(
	        'name'               => 'Envato Market',
	        'slug'               => 'envato-market',
	        'source'             => get_template_directory() . '/lib/plugins/envato-market.zip',
	        'required'           => true, 
	        'version'            => '2.0.1',
	    ),
	    array(
	        'name'      => 'Contact Form 7',
	        'slug'      => 'contact-form-7',
	        'required'  => true, 
	    ),
	    array(
	        'name'      => 'MailChimp for WordPress',
	        'slug'      => 'mailchimp-for-wp',
	        'required'  => true, 
	    ),
	    array(
	        'name'      => 'WooCommerce',
	        'slug'      => 'woocommerce',
	        'required'  => true, 
	    ),
	    array(
	        'name'      => 'Typing Effect',
	        'slug'      => 'animated-typing-effect',
	        'required'  => true, 
	    ),
	    array(
	        'name'      		 => 'Elementor Google Map Extended',
	        'slug'      		 => 'extended-google-map-for-elementor',
	        'required'  		 => true, 
	    ),
	);
	
	//If theme demo site add other plugins
	if(ARCHITECTURER_THEMEDEMO)
	{
		$plugins[] = array(
			'name'      => 'EWWW Image Optimizer',
	        'slug'      => 'ewww-image-optimizer',
	        'required'  => false, 
		);
		
		$plugins[] = array(
			'name'      => 'Disable Comments',
	        'slug'      => 'disable-comments',
	        'required'  => false, 
		);
		
		$plugins[] = array(
			'name'      => 'Customizer Export/Import',
	        'slug'      => 'customizer-export-import',
	        'required'  => false, 
		);
		
		$plugins[] = array(
			'name'      => 'Display All Image Sizes',
	        'slug'      => 'display-all-image-sizes',
	        'required'  => false, 
		);
		
		$plugins[] = array(
			'name'      => 'Easy Theme and Plugin Upgrades',
	        'slug'      => 'easy-theme-and-plugin-upgrades',
	        'required'  => false, 
		);
		
		$plugins[] = array(
			'name'      => 'Widget Importer & Exporter',
	        'slug'      => 'widget-importer-exporter',
	        'required'  => false, 
		);
		
		$plugins[] = array(
	        'name'      => 'Imsanity',
	        'slug'      => 'imsanity',
	        'required'  => false, 
	    );
		
		$plugins[] = array(
			'name'      => 'Go Live Update URLs',
	        'slug'      => 'go-live-update-urls',
	        'required'  => false, 
		);
		
		$plugins[] = array(
			'name'      => 'Widget Clone',
	        'slug'      => 'widget-clone',
	        'required'  => false, 
		);
		
		$plugins[] = array(
			'name'      => 'Duplicate Menu',
	        'slug'      => 'duplicate-menu',
	        'required'  => false, 
		);
		
		$plugins[] = array(
			'name'      => 'Quick remove menu item',
	        'slug'      => 'quick-remove-menu-item',
	        'required'  => false, 
		);
		
		$plugins[] = array(
			'name'      => 'WP-Optimize',
	        'slug'      => 'wp-optimize',
	        'required'  => false, 
		);
		
		$plugins[] = array(
			'name'      => 'WP User Avatar',
	        'slug'      => 'wp-user-avatar',
	        'required'  => false, 
		);
		
		$plugins[] = array(
			'name'      => 'Regenerate post permalinks',
	        'slug'      => 'regenerate-post-permalinks',
	        'required'  => false, 
		);
		
		$plugins[] = array(
			'name'      => 'Duplicate Post',
	        'slug'      => 'duplicate-post',
	        'required'  => false, 
		);
	}
	
	$config = array(
		'domain'	=> 'architecturer',
        'default_path' => '',                      // Default absolute path to pre-packaged plugins.
        'menu'         => 'install-required-plugins', // Menu slug.
        'has_notices'  => true,                    // Show admin notices or not.
        'is_automatic' => true,                   // Automatically activate plugins after installation or not.
        'message'      => '',                      // Message to output right before the plugins table.
        'strings'          => array(
	        'page_title'                      => esc_html__('Install Required Plugins', 'architecturer' ),
	        'menu_title'                      => esc_html__('Install Plugins', 'architecturer' ),
	        'installing'                      => esc_html__('Installing Plugin: %s', 'architecturer' ),
	        'oops'                            => esc_html__('Something went wrong with the plugin API.', 'architecturer' ),
	        'return'                          => esc_html__('Return to Required Plugins Installer', 'architecturer' ),
	        'plugin_activated'                => esc_html__('Plugin activated successfully.', 'architecturer' ),
	        'complete'                        => esc_html__('All plugins installed and activated successfully. %s', 'architecturer' ),
	        'nag_type'                        => 'update-nag'
	    )
    );
 
    tgmpa( $plugins, $config );
}
?>