<?php

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

if ( ! class_exists( 'Architecturer_Templates_Manager' ) ) {

	/**
	 * Define Architecturer_Templates_Manager class
	 */
	class Architecturer_Templates_Manager {

		/**
		 * A reference to an instance of this class.
		 *
		 * @since 1.0.0
		 * @var   object
		 */
		private static $instance = null;

		/**
		 * Template option name
		 * @var string
		 */
		protected $option = 'architecturer_templates';

		/**
		 * Constructor for the class
		 */
		public function init() {
			add_action( 'elementor/init', array( $this, 'register_templates_source' ) );
			add_action( 'wp_ajax_elementor_get_template_data', array( $this, 'force_architecturer_template_source' ), 0 );
		}

		/**
		 * Register
		 *
		 * @return [type] [description]
		 */
		public function register_templates_source() {
			$is_verified_envato_purchase_code = false;

			//Get verified purchase code data
			$pp_verified_envato_architecturer = get_option("pp_verified_envato_architecturer");
			if(!empty($pp_verified_envato_architecturer))
			{
				$is_verified_envato_purchase_code = true;
			}
			
			if($is_verified_envato_purchase_code)
			{
				require ARCHITECTURER_ELEMENTOR_PATH.'/templates_source.php';
				
				$elementor = Elementor\Plugin::instance();
				$elementor->templates_manager->register_source( 'Architecturer_Templates_Source' );
			}
		}

		/**
		 * Return template data insted of elementor template.
		 *
		 * @return [type] [description]
		 */
		public function force_architecturer_template_source() {

			if ( empty( $_REQUEST['template_id'] ) ) {
				return;
			}

			if ( false === strpos( $_REQUEST['template_id'], 'architecturer_' ) ) {
				return;
			}

			$_REQUEST['source'] = 'architecturer-templates';

		}

		/**
		 * Returns the instance.
		 *
		 * @since  1.0.0
		 * @return object
		 */
		public static function get_instance() {

			// If the single instance hasn't been set, set it now.
			if ( null == self::$instance ) {
				self::$instance = new self;
			}
			return self::$instance;
		}
	}

}

/**
 * Returns instance of Architecturer_Templates_Manager
 *
 * @return object
 */
function architecturer_templates_manager() {
	return Architecturer_Templates_Manager::get_instance();
}
