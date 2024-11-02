<?php
/**
* Plugin Name: Anant Addons for Elementor
* Description: High quality addons for elementor with 50+ stunning free anant including Filterable Gallery, WooCommerce, and many more.
* Author: Anantaddons, Anantsites
* Author URI: https://anantaddons.com
* Version: 1.0.5
* License: GPLv3
* License URI: https://opensource.org/licenses/GPL-3.0
* Text Domain: anant-addons-for-elementor
* Domain Path: /languages
*
*/

if ( ! defined( 'ABSPATH' ) ) { exit; } // Exit if accessed directly

if ( !class_exists('ANANT_ADDONS') ) {
	class ANANT_ADDONS {

		private static $instance;
		public static function get_instance() {
			if ( ! isset( self::$instance ) ) {
				self::$instance = new ANANT_ADDONS();
				self::$instance->constants();
				self::$instance->init();
			}
			return self::$instance;
		}

		// Setup constants.
		public function constants() { 
			if(!defined('ANANT')){
				define( 'ANANT', __FILE__);
				define( 'ANANT_DOAMIN', 'anant-addons-for-elementor' ); //Pro Link
				define( 'ANANT_PATH', plugin_dir_path( ANANT ) );
				define( 'ANANT_URL', plugin_dir_url( ANANT ) );
				define( 'ANANT_VERSION', '1.0.5' ); //Plugin Version
				define( 'ANANT_MIN_ELEMENTOR_VERSION', '2.0.0' ); //MINIMUM ELEMENTOR Plugin Version
				define( 'ANANT_MIN_PHP_VERSION', '5.4' ); //MINIMUM PHP Plugin Version
				define( 'ANANT_PRO_LINK', 'https://anantaddons.com/' ); //Pro Link
				define( 'ANANT_GO_PRO_HTML', '<span class="anant-pro-feature"> Get the  <a href="'.ANANT_PRO_LINK.'" target="_blank">Pro version</a> for more stunning anant.</span>' ); //Pro Link
			} 
		}

		//initialize Plugin
		public function init() {
			$this->include_files();
			add_action( 'elementor/elements/categories_registered', [ $this, 'wc_single_product_create_category' ] );  	// Add a custom single product woo category for panel widgets
			add_action( 'elementor/elements/categories_registered', [ $this, 'wc_woo_create_category' ] );				// Add a custom woo category for panel widgets
			add_action( 'elementor/elements/categories_registered', [ $this, 'wc_single_blog_create_category' ] ); 		// Add a custom single blog category for panel widgets
			add_action( 'elementor/elements/categories_registered', [ $this, 'wc_blog_create_category' ] ); 			// Add a custom blog category for panel widgets
			add_action( 'elementor/elements/categories_registered', [ $this, 'wc_create_category' ] );					// Add a custom category for panel widgets
			add_action( 'elementor/elements/categories_registered', [ $this, 'wc_hf_create_category' ] ); 				// Add a custom header footer category for panel widgets
		}

		//Include all files
		public function include_files() {
			require_once ANANT_PATH . 'inc/anant-custom-navwalker.php';
			require_once ANANT_PATH . 'inc/classes/utils.php';
			require_once ANANT_PATH . 'inc/initializer.php';
		}

		// add category for header & footer widgets
		public function wc_hf_create_category($elements_manager) {
			$categories['anant-hf-elements'] = [
				'title' => esc_html__( 'Anant Header & Footer', 'anant-addons-for-elementor' ),
				'icon'  => 'fa fa-plug',
			];

			$el_categories = $elements_manager->get_categories();
			$categories    = array_merge(
				array_slice( $el_categories, 0,  1),
				$categories,
				array_slice( $el_categories,  1)
			);

			$set_categories = function( $categories ) {
				$this->categories = $categories;
			};

			$set_categories->call( $elements_manager, $categories );
		}

		// add category for addons
		public function wc_create_category($elements_manager) {
			$categories['anant-elements'] = [
				'title' => esc_html__( 'Anant Addons', 'anant-addons-for-elementor' ),
				'icon'  => 'fa fa-plug',
			];

			$el_categories = $elements_manager->get_categories();
			$categories    = array_merge(
				array_slice( $el_categories, 0, 1 ),
				$categories,
				array_slice( $el_categories, 1 )
			);

			$set_categories = function( $categories ) {
				$this->categories = $categories;
			};

			$set_categories->call( $elements_manager, $categories );
		}

		// add category for Blog widgets
		public function wc_blog_create_category($elements_manager) {
			$categories['anant-blog-elements'] = [
				'title' => esc_html__( 'Anant Blog', 'anant-addons-for-elementor' ),
				'icon'  => 'fa fa-plug',
			];

			$el_categories = $elements_manager->get_categories();
			$categories    = array_merge(
				array_slice( $el_categories, 0, 1 ),
				$categories,
				array_slice( $el_categories, 1 )
			);

			$set_categories = function( $categories ) {
				$this->categories = $categories;
			};

			$set_categories->call( $elements_manager, $categories );
		}

		// add category for Single Blog widgets
		public function wc_single_blog_create_category($elements_manager) {
			$categories['anant-sng-blog-elements'] = [
				'title' => esc_html__( 'Anant Single Blog', 'anant-addons-for-elementor' ),
				'icon'  => 'fa fa-plug',
			];

			$el_categories = $elements_manager->get_categories();
			$categories    = array_merge(
				array_slice( $el_categories, 0, 1 ),
				$categories,
				array_slice( $el_categories, 1 )
			);

			$set_categories = function( $categories ) {
				$this->categories = $categories;
			};

			$set_categories->call( $elements_manager, $categories );
		}

		// add category for woocommerce
		public function wc_woo_create_category($elements_manager) {
			$categories['anant-woo-elements'] = [
				'title' => esc_html__( 'Anant Woocommerce', 'anant-addons-for-elementor' ),
				'icon'  => 'fa fa-plug',
			];

			$el_categories = $elements_manager->get_categories();
			$categories    = array_merge(
				array_slice( $el_categories, 0, 1 ),
				$categories,
				array_slice( $el_categories, 1 )
			);

			$set_categories = function( $categories ) {
				$this->categories = $categories;
			};

			$set_categories->call( $elements_manager, $categories );
		}
		
		// add category for Single Product
		public function wc_single_product_create_category($elements_manager) {
			$categories['anant-sng-woo-elements'] = [
				'title' => esc_html__( 'Anant Single Product', 'anant-addons-for-elementor' ),
				'icon'  => 'fa fa-plug',
			];

			$el_categories = $elements_manager->get_categories();
			$categories    = array_merge(
				array_slice( $el_categories, 0, 1 ),
				$categories,
				array_slice( $el_categories, 1 )
			);

			$set_categories = function( $categories ) {
				$this->categories = $categories;
			};

			$set_categories->call( $elements_manager, $categories );
		}

		// prevent the instance from being cloned
		public function __clone() {     }

		// prevent from being unserialized
		public function __wakeup() {    }
	}
	require_once plugin_dir_path( __FILE__ ) . '/inc/class-anant-header-footer-elementor.php';
	function anant_addons_register_function() {
		$WPCE_SLIDER = ANANT_ADDONS::get_instance();
		Anant_Header_Footer_Elementor::instance();
	}
	add_action( 'plugins_loaded', 'anant_addons_register_function' );
}

/**
 * WooCommerce HPOS Support
 * 
 * @since v5.8.2
 */
add_action( 'before_woocommerce_init', function() {
	if ( class_exists( \Automattic\WooCommerce\Utilities\FeaturesUtil::class ) ) {
		\Automattic\WooCommerce\Utilities\FeaturesUtil::declare_compatibility( 'custom_order_tables', __FILE__, true );
	}
} );