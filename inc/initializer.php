<?php // phpcs:disable WordPress.Security.NonceVerification.Recommended
// phpcs:disable WordPress.WP.I18n.MissingTranslatorsComment
namespace AnantAddons;

if ( ! defined( 'ABSPATH' ) ) { exit; }

class Plugin {

	private static $instance = null;

	public static function instance() {
		if ( is_null( self::$instance ) ) {
			self::$instance = new self();
		}
		return self::$instance;
	}

	private function __construct() {

		// Remove All Third Party Notices
		add_action( 'admin_enqueue_scripts',  [ $this, 'remove_notices' ]);

		$this->file_include();

		// Check if Elementor installed and activated
		if ( ! did_action( 'elementor/loaded' ) ) {
			add_action( 'admin_notices', [ $this, 'admin_notice_missing_main_plugin' ] );
			return;
		}

		// Check for required Elementor version
		if ( ! version_compare( ELEMENTOR_VERSION, ANANT_MIN_ELEMENTOR_VERSION, '>=' ) ) {
			add_action( 'admin_notices', [ $this, 'admin_notice_minimum_elementor_version' ] );
			return;
		}

		// Check for required PHP version
		if ( version_compare( PHP_VERSION, ANANT_MIN_PHP_VERSION, '<' ) ) {
			add_action( 'admin_notices', [ $this, 'admin_notice_minimum_php_version' ] );
			return;
		}

		// Enqueue Styles
		add_action( 'elementor/frontend/after_enqueue_styles', [ $this, 'enqueue_styles' ] );
		add_action( 'wp_enqueue_scripts', [ $this, 'enqueue_styles' ] );

		// Enqueue Scripts
		add_action( 'elementor/frontend/after_register_scripts', [ $this, 'enqueue_scripts' ] , 999 );
		add_action( 'wp_enqueue_scripts', [ $this, 'enqueue_scripts' ] , 999 );

		// Register widget
		add_action( 'elementor/widgets/register', [ $this, 'register_widgets' ] );
		add_action('elementor/controls/register', [$this, 'init_controls']);
		add_action('elementor/editor/after_enqueue_styles', [$this, 'anant_editor_enqueue_scripts']);

		add_action('wp_ajax_search_site',[ $this,'ajax_search'] );
		add_action('wp_ajax_nopriv_search_site',[ $this,'ajax_search'] 	);
		
        add_action('wp_ajax_search_woo_site',[ $this,'ajax_woo_search'] );
        add_action('wp_ajax_nopriv_search_woo_site',[ $this,'ajax_woo_search'] );

		add_action('wp_ajax_ajax_add_to_cart',[ $this,'ajax_add_to_cart']);
		add_action('wp_ajax_nopriv_ajax_add_to_cart',[ $this,'ajax_add_to_cart']);

		add_action('wp_ajax_woo_quickview', array( $this, 'woo_quickview' ));
		add_action('wp_ajax_nopriv_woo_quickview', array( $this, 'woo_quickview' ));

		// Refresh the cart fragments.
		if ( class_exists( 'woocommerce' ) ) {
			add_filter( 'woocommerce_add_to_cart_fragments', [ $this, 'cart_refresh' ] );
			add_action('wp_ajax_anant_add_to_wishlist', [$this, 'anant_add_to_wishlist']);
			add_action('wp_ajax_nopriv_anant_add_to_wishlist', [$this, 'anant_add_to_wishlist']);
			add_action('wp_ajax_anant_remove_from_wishlist', [$this, 'anant_remove_from_wishlist']);
			add_action('wp_ajax_nopriv_anant_remove_from_wishlist', [$this, 'anant_remove_from_wishlist']);
		}
		// Admin
        if (is_admin()) {
	        if ( ! empty( $_REQUEST['action'] ) && 'elementor' === $_REQUEST['action'] ) {
		        add_action( 'init', [ $this, 'register_wc_hook' ], 5 );
	        }
        }

		add_shortcode('anant_year', [ $this, 'get_year' ] );
		add_shortcode('anant_site_tile', [ $this, 'get_site_name' ] );
		
		add_action('elementor/documents/register_controls', [$this, 'select_for_demo_content'], 10);
		add_action('elementor/frontend/after_register_scripts',[ $this,'enqueue_custom_widget_assets'] );
		add_action('elementor/editor/after_enqueue_scripts', [ $this, 'enqueue_custom_elementor_script' ] );
		if ( class_exists( 'woocommerce' ) ) {
			add_action('pre_get_posts', [ $this, 'anant_product_per_page' ]);
		}
	}
	
	function anant_add_to_wishlist() {
		if (is_user_logged_in()) {
			$user_id = get_current_user_id();
			$product_id = intval($_POST['product_id']);
	
			// Get existing wishlist or initialize an empty array
			$wishlist = get_user_meta($user_id, '_user_wishlist', true);
			if (!is_array($wishlist)) {
				$wishlist = array();
			}
	
			// Add the product ID to the wishlist if it isn't already there
			if (!in_array($product_id, $wishlist)) {
				$wishlist[] = $product_id;
				update_user_meta($user_id, '_user_wishlist', $wishlist);
			}
			wp_send_json($wishlist);
		}
	}
	
	function anant_remove_from_wishlist() {
		if (is_user_logged_in()) {
			$user_id = get_current_user_id();
			$product_id = intval($_POST['product_id']);
	
			// Get the current wishlist
			$wishlist = get_user_meta($user_id, '_user_wishlist', true);
	
			// Remove the product ID from the wishlist if it exists
			if (($key = array_search($product_id, $wishlist)) !== false) {
				unset($wishlist[$key]);
				update_user_meta($user_id, '_user_wishlist', array_values($wishlist)); // reindex array
			}
			wp_send_json($wishlist);
		}
	}
	
	function anant_product_per_page($query) {
		// Check if it's the main query and we're on the shop page
		if ($query->is_main_query() && !is_admin() && (is_shop() || is_product_category() || is_product_tag())) {
			// Set the number of products per page to 1
			$query->set('posts_per_page', 1);
		}
	}
	

	function enqueue_custom_widget_assets() {
		wp_enqueue_style('font-awesome-5', ANANT_URL . 'assets/css/all.css', null, ANANT_VERSION );
		
		wp_enqueue_script(
            'anant-swiper',
            ELEMENTOR_ASSETS_URL . 'lib/swiper/swiper.min.js',
            ['jquery'],
            ANANT_VERSION, true 
        );	

		if ( class_exists( 'woocommerce' ) ) {
			wp_enqueue_script( 'wc-checkout', WC()->plugin_url() . '/assets/js/frontend/checkout.js', array( 'jquery' ), WC_VERSION, true );
		}
	}

	function enqueue_custom_elementor_script() {
		if (is_admin()) {
			wp_enqueue_script('refresh-elementor-script', ANANT_URL .'assets/js/elem-editor.js', array('jquery'), '1.0', true);
		}
	}

	function select_for_demo_content($element) {
		
		$post_type = get_post_type();
		if ($post_type == 'anant-header-footer') {

			if ( class_exists( 'woocommerce' ) ) {
				$element->start_controls_section(
					'demo_product_section',
					[
						'label' => __('Demo Product Section', 'anant-addons-for-elementor'),
						'tab' => \Elementor\Controls_Manager::TAB_SETTINGS,
					]
				);

				$element->add_control(
					'demo_product_id', 
					[
						'label' => __('Choose Product for Demo', 'anant-addons-for-elementor'),
						'type' => \Elementor\Controls_Manager::SELECT,
						'label_block' => true,
						'multiple' => false,
						'options' => anant_get_woo_products(),
					]
				);

				$element->end_controls_section();
			}

			$element->start_controls_section(
				'demo_post_section',
				[
					'label' => __('Demo Post Section', 'anant-addons-for-elementor'),
					'tab' => \Elementor\Controls_Manager::TAB_SETTINGS,
				]
			);

			$element->add_control(
				'demo_post_id', 
				[
					'label' => __('Choose Post for Demo', 'anant-addons-for-elementor'),
					'type' => \Elementor\Controls_Manager::SELECT,
					'label_block' => true,
					'multiple' => false,
					'options' => anant_get_post_title(),
				]
			);

			$element->end_controls_section();

			$element->start_controls_section(
				'demo_archive_post_section',
				[
					'label' => __('Demo Archive Section', 'anant-addons-for-elementor'),
					'tab' => \Elementor\Controls_Manager::TAB_SETTINGS,
				]
			);

			$element->add_control(
				'demo_archive_select', 
				[
					'label' => __('Choose Archive Type for Demo', 'anant-addons-for-elementor'),
					'type' => \Elementor\Controls_Manager::SELECT,
					'label_block' => true,
					'multiple' => false,
					'options' => [
						'category' => esc_html__( 'Category', 'anant-addons-for-elementor' ),
						'tag' => esc_html__( 'Tag', 'anant-addons-for-elementor' ),
						'author'  => esc_html__( 'Author', 'anant-addons-for-elementor' ),
						'date'  => esc_html__( 'Date', 'anant-addons-for-elementor' ),
						'search'  => esc_html__( 'Search Result', 'anant-addons-for-elementor' ),
						'product-category' => esc_html__( 'Product Category (Woocommerce)', 'anant-addons-for-elementor' ),
						'product-tag' => esc_html__( 'Product Tag (Woocommerce)', 'anant-addons-for-elementor' ),
					],
				]
			);

			$element->add_control(
				'demo_cat_archive_select', 
				[
					'label' => __('Choose Category for Archive Post Demo', 'anant-addons-for-elementor'),
					'type' => \Elementor\Controls_Manager::SELECT,
					'label_block' => true,
					'multiple' => false,
					'options' => anant_get_categories( $demo = 1 ),
					'condition' =>[
						'demo_archive_select' => 'category', 
					],
				]
			);

			$element->add_control(
				'demo_tag_archive_select', 
				[
					'label' => __('Choose Tag for Archive Post Demo', 'anant-addons-for-elementor'),
					'type' => \Elementor\Controls_Manager::SELECT,
					'label_block' => true,
					'multiple' => false,
					'options' => anant_get_tags( $demo = 1 ),
					'condition' =>[
						'demo_archive_select' => 'tag', 
					],
				]
			);

			$element->add_control(
				'demo_author_archive_select', 
				[
					'label' => __('Choose Author for Archive Post Demo', 'anant-addons-for-elementor'),
					'type' => \Elementor\Controls_Manager::SELECT,
					'label_block' => true,
					'multiple' => false,
					'options' => anant_get_all_authors( $demo = 0 ),
					'condition' =>[
						'demo_archive_select' => 'author', 
					],
				]
			);

			$element->add_control(
				'demo_date_year_archive_select', 
				[
					'label' => __('Choose Category for Archive Post Demo', 'anant-addons-for-elementor'),
					'type' => \Elementor\Controls_Manager::SELECT,
					'label_block' => true,
					'multiple' => false,
					'options' => anant_get_post_years(),
					'condition' =>[
						'demo_archive_select' => 'date', 
					],
				]
			);

			$element->add_control(
				'demo_search_result_archive_select', [
					'label' => __( 'Demo Search', 'anant-addons-for-elementor' ),
					'type' => \Elementor\Controls_Manager::TEXT,
					'default' => __( 'Hello' , 'anant-addons-for-elementor' ),
					'label_block' => true,
					'condition' =>[
						'demo_archive_select' => 'search', 
					],
				]
			);
			
			if ( class_exists( 'woocommerce' ) ) {
				$element->add_control(
					'demo_product_cat_archive_select', 
					[
						'label' => __('Choose Category for Product Archive Demo', 'anant-addons-for-elementor'),
						'type' => \Elementor\Controls_Manager::SELECT,
						'label_block' => true,
						'multiple' => false,
						'options' => anant_get_woo_categories( $demo = 1 ),
						'condition' =>[
							'demo_archive_select' => 'product-category', 
						],
					]
				);

				$element->add_control(
					'demo_product_tag_archive_select', 
					[
						'label' => __('Choose Tag for Product Archive Demo', 'anant-addons-for-elementor'),
						'type' => \Elementor\Controls_Manager::SELECT,
						'label_block' => true,
						'multiple' => false,
						'options' => anant_get_product_tags( $demo = 1 ),
						'condition' =>[
							'demo_archive_select' => 'product-tag', 
						],
					]
				);

			}else{

				$element->add_control(
					'woocommerce_off_notice',
					[
						'type' => \Elementor\Controls_Manager::RAW_HTML,
						'raw'             => __( '<b>WooCommerce</b> is not installed/activated on your site. Please install and activate <a href="plugin-install.php?s=woocommerce&tab=search&type=term" target="_blank">WooCommerce</a> first.', 'anant-addons-for-elementor' ),
						'content_classes' => 'ant-woo-warning',
						'conditions' => [
							'relation' => 'or',
							'terms'    => [
								[
									'name'     => 'demo_archive_select',
									'operator' => '===',
									'value'    => 'product-category',
								], 
								[
									'name'     => 'demo_archive_select',
									'operator' => '===',
									'value'    => 'product-tag',
								], 
							],
						],
					]
				);
			}

			$element->end_controls_section();
		}
	}

	public function ajax_search() {
		
        if ( isset($_POST) ) {
    
            $results = new \WP_Query( array(
                'post_type'    	=> array( 'post', 'page' ),
				'post_status'   => 'publish',
				'posts_per_page'=> -1,
                's'             =>  $_POST['search_item'],
				'ignore_sticky_posts' => 1
            ) );
    
        }  
    
        $return_posts = array();
    
        if ( !empty( $results->posts ) ) {
            foreach ( $results->posts as $result ) {
				$post_date = get_the_date( 'F j, Y', $result->ID ); // Format date as 'Y-m-d'
				$date_url = get_day_link( get_the_time('Y', $result->ID), get_the_time('m', $result->ID), get_the_time('d', $result->ID) ); // Get the archive link for the day
				
				$return_posts[] = array(
					'title' => $result->post_title,
					'url'   => get_permalink( $result->ID ),
				);
            }
        }

        $return_posts =  json_encode($return_posts);

        if(!empty($return_posts)){
            wp_send_json_success($return_posts);
        }else{
            wp_send_json_success( array( 'no' => 'no' ) );
        }

    }

	public function ajax_woo_search() {

        if ( isset($_POST) ) {
    
            $results = new \WP_Query( array(
                'post_type' => 'product',
				'post_status'    => 'publish',
				'posts_per_page' => -1,
                's'             =>  $_POST['srchwoo'],
            ) );
    
        }  
    
        $items = array();
    
        if ( !empty( $results->posts ) ) {
            foreach ( $results->posts as $result ) {
                $items[] = $result->post_title;
            }
        }

        $items =  json_encode($items);

        if(!empty($items)){
            wp_send_json_success($items);
        }else{
            wp_send_json_success( array( 'no' => 'no' ) );
        } 

    }
	
	// Add to Cart function
	public function ajax_add_to_cart() {
		if (isset($_POST)) {
			$product_id = sanitize_text_field($_POST['product_id']);
			$quantity = isset($_POST['quantity']) ? absint($_POST['quantity']) : 1;
	
			// Add the product to the cart
			$cart_item_key = WC()->cart->add_to_cart($product_id, $quantity);
	
			if ($cart_item_key) {
				// Product successfully added to the cart
				$response = array(
					'success' => true,
					'message' => 'Product added to cart successfully.',
					'cart_url'=> wc_get_cart_url(),
				);
			} else {
				// Failed to add the product to the cart
				$response = array(
					'success' => false,
					'message' => 'Failed to add the product to the cart, Try again',
				);
			}
	
			// Return the JSON response
			wp_send_json($response);
		}
	}

	public function woo_quickview() {
		global $post, $product, $woocommerce;
	
		$prod_id = $_POST["product"];
		$product = wc_get_product( $prod_id );

		// If the WC_product Object is not defined globally
		if ( ! is_a( $product, 'WC_Product' ) ) {
			$product = wc_get_product( $prod_id );
		}

		$terms = get_the_terms( $prod_id, 'product_cat' );
		$product_cats = '';
		if ( $terms && ! is_wp_error( $terms ) ) {
			$product_cats .= '<span class="posted_in">Category:';
			foreach ( $terms as $term ) {
				$term_link = get_term_link( $term );
				$product_cats .= '<a href="' . esc_url( $term_link ) . '">' . $term->name . '</a>';
			}
			$product_cats .= '</span>';
		}

		$sku = !$product->get_sku()== '' ? $product->get_sku() : "N/A";

		$add_to_cart_html = '';
		ob_start(); 
		woocommerce_template_single_add_to_cart( array(), $product ); 
		$add_to_cart_html = ob_get_clean(); 

		$quick_view = '';

		$quick_view .= '<div class="anant-popup">
					<div class="overlay">
					<div class="close-btn">&times;</div>
					<div class="popup-img">
						<img src="'.wp_get_attachment_url( $product->get_image_id() ).'" alt="">
					</div>
					<div class="popup-content">
					<h2 class="ant_product_title">'.$product->get_name().'</h2>
					<p class="price">'.$product->get_price_html().'</p>
						<p>'.$product->get_description().'</p> 
						<div class="woocommerce">'.$add_to_cart_html.'</div>
					<div class="product_meta">
					<span class="sku_wrapper">SKU: <span class="sku">'.$sku.'</span></span>'.$product_cats.'</div>
						</div>
					</div>
				</div>'; 
		
		$items =  json_encode($quick_view);
		
        if(!empty($items)){
            wp_send_json_success($items);
        }else{
            wp_send_json_success( array( 'no' => 'no' ) );
        }
	}

	public function cart_refresh( $fragments ) {

		$has_cart = is_a( WC()->cart, 'WC_Cart' );
		if ( ! $has_cart ) {
			return $fragments;
		}
		$product_count = WC()->cart->get_cart_contents_count();
		$sub_total = WC()->cart->get_cart_subtotal();
		
		if ( null !== WC()->cart ) {

			$fragments['span.cart-total'] = '<span class="cart-total">' . $sub_total . '</span>';

			$fragments['span.counter'] = '<span class="counter">' . $product_count . '</span>';

		}
		return $fragments;
	}


	public function remove_notices() {
		$screen = get_current_screen();
        if ( isset( $screen->base ) && $screen->base == 'toplevel_page_anant_admin_menu' || isset( $screen->post_type ) && $screen->post_type == 'anant-header-footer') {
            remove_all_actions( 'admin_notices' );
        }
	}

	// editor styles
	public function anant_editor_enqueue_scripts() {
		wp_enqueue_style( 'anant-editor', ANANT_URL . 'assets/css/editor-css.css', array(), ANANT_VERSION );
	}

	/**
     * Check if a plugin is installed
     *
     * @since v3.0.0
     */
    public function is_plugin_installed($basename)
    {
        if (!function_exists('get_plugins')) {
            include_once ABSPATH . '/wp-admin/includes/plugin.php';
        }

        $installed_plugins = get_plugins();

        return isset($installed_plugins[$basename]);
    }

	public function admin_notice_missing_main_plugin() {

		$elementor = 'elementor/elementor.php';

		if ($this->is_plugin_installed($elementor)) {
			$activation_url = wp_nonce_url('plugins.php?action=activate&amp;plugin=' . $elementor . '&amp;plugin_status=all&amp;paged=1&amp;s', 'activate-plugin_' . $elementor);

			$message = sprintf(
				esc_html__( '"%1$s" requires "%2$s" to be active.', 'anant-addons-for-elementor' ),
				'<strong>' . esc_html__( 'Anant Addons For Elementor', 'anant-addons-for-elementor' ) . '</strong>',
				'<strong>' . esc_html__( 'Elementor', 'anant-addons-for-elementor' ) . '</strong>'
			);

			$button_text = esc_html__('Activate Elementor', 'anant-addons-for-elementor');
		}else {
			$activation_url = wp_nonce_url(self_admin_url('update.php?action=install-plugin&plugin=elementor'), 'install-plugin_elementor');

			$message = sprintf(
				esc_html__( '"%1$s" requires "%2$s" to be installed and activated.', 'anant-addons-for-elementor' ),
				'<strong>' . esc_html__( 'Anant Addons For Elementor', 'anant-addons-for-elementor' ) . '</strong>',
				'<strong>' . esc_html__( 'Elementor', 'anant-addons-for-elementor' ) . '</strong>'
			);

            $button_text = esc_html__('Install Elementor', 'anant-addons-for-elementor');
		}

		$button = '<p><a href="' . esc_url( $activation_url ) . '" class="button-primary">' . esc_html( $button_text ) . '</a></p>';

		printf( '<div class="notice notice-error"><p>%1$s</p>%2$s</div>', 
			wp_kses_post( $message ),
			wp_kses_post( $button ) 
		);
	}

	public function admin_notice_missing_wc_plugin() { 

		if ( isset( $_GET['activate'] ) ) {
			unset( $_GET['activate'] );
		}

		$message = sprintf(
			esc_html__( '"%1$s" requires "%2$s" to be installed and activated.', 'anant-addons-for-elementor' ),
			'<strong>' . esc_html__( 'Anant', 'anant-addons-for-elementor' ) . '</strong>',
			'<strong>' . esc_html__( 'WooCommerce', 'anant-addons-for-elementor' ) . '</strong>'
		);
		// phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
		printf( '<div class="notice notice-error"><p>%1$s</p></div>',  wp_kses_post( $message ) );
	}
	public function admin_notice_minimum_elementor_version() {

		if ( isset( $_GET['activate'] ) ) {
			unset( $_GET['activate'] );
		}

		$message = sprintf(
			/* translators: 1: Plugin name 2: Elementor 3: Required Elementor version */
			esc_html__( '"%1$s" requires "%2$s" version %3$s or greater.', 'anant-addons-for-elementor' ),
			'<strong>' . esc_html__( 'Anant', 'anant-addons-for-elementor' ) . '</strong>',
			'<strong>' . esc_html__( 'Elementor', 'anant-addons-for-elementor' ) . '</strong>',
			ANANT_MIN_ELEMENTOR_VERSION
		);
		// phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
		printf( '<div class="notice notice-error"><p>%1$s</p></div>',  wp_kses_post( $message ) );
	}
	public function admin_notice_minimum_php_version() {

		if ( isset( $_GET['activate'] ) ) {
			unset( $_GET['activate'] );
		}

		$message = sprintf(
			/* translators: 1: Plugin name 2: PHP 3: Required PHP version */
			esc_html__( '"%1$s" requires "%2$s" version %3$s or greater.', 'anant-addons-for-elementor' ),
			'<strong>' . esc_html__( ' Anant', 'anant-addons-for-elementor' ) . '</strong>',
			'<strong>' . esc_html__( 'PHP', 'anant-addons-for-elementor' ) . '</strong>',
			ANANT_MIN_PHP_VERSION
		);
		// phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
		printf( '<div class="notice notice-error"><p>%1$s</p></div>',  wp_kses_post( $message ) );
	}

	public function enqueue_styles() {

		wp_enqueue_style( 'anant-styles-css', ANANT_URL . 'assets/css/style.css', array(), ANANT_VERSION );
		wp_enqueue_style( 'anant-swiper-custom-css', ANANT_URL . 'assets/css/anant-widget-css.css', [], ANANT_VERSION );
		wp_enqueue_style( 'anant-image-compare-css', ANANT_URL . 'assets/css/juxtapose.css', [], ANANT_VERSION );
		wp_enqueue_style( 'anant-filter-gallery', ANANT_URL . 'assets/css/filter-gallery.css', [], ANANT_VERSION );
		wp_enqueue_style( 'anant-post-blog-css'	, ANANT_URL . 'assets/css/anant-post-blog.css', [], ANANT_VERSION );
		wp_enqueue_style( 'anant-woo-widgets-css', ANANT_URL . 'assets/css/anant-woo-widgets.css', [], ANANT_VERSION );

		wp_enqueue_style( 'anant-google-fonts'	, ANANT_URL . 'assets/css/font.css', array(), ANANT_VERSION );

        wp_enqueue_style( 'anant-menu-css', ANANT_URL . 'assets/css/anant-menu.css', array(), ANANT_VERSION );
		wp_enqueue_style( 'jquery-auto-complete-min', ANANT_URL . 'assets/css/jquery-ui.min.css', array(), '1.13.2' );

		if(defined('ELEMENTOR_ASSETS_URL')) {
			wp_enqueue_style( 'font-awesome', ELEMENTOR_ASSETS_URL . 'lib/font-awesome/css/all.min.css', array(), ANANT_VERSION );
		}

	}

	public function enqueue_scripts() {
        wp_enqueue_script( 'anant-custom-js', ANANT_URL.'assets/js/custom.js', ['jquery'], ANANT_VERSION, true );
		wp_enqueue_script( 'anant-filter-gallery-js', ANANT_URL . 'assets/js/anant-filter-gallery.js', [], ANANT_VERSION, true );
		wp_enqueue_script( 'anant-image-compare-js', ANANT_URL . 'assets/js/image-compare.js', [], ANANT_VERSION, true );
		wp_enqueue_script( 'anant-marquee-js', ANANT_URL . 'assets/js/jquery.marquee.min.js', [], ANANT_VERSION, true );
        wp_enqueue_script( 'anant-woo-js', ANANT_URL.'assets/js/anant-woo.js', ['jquery'], ANANT_VERSION, true );
		wp_enqueue_script( 'anant-search-js', ANANT_URL . 'assets/js/search.js', ['jquery', 'jquery-ui-autocomplete'], ANANT_VERSION, true );

		wp_localize_script( 'anant-woo-js', 'myajax', array( 'ajaxurl' => admin_url( 'admin-ajax.php' ) ) );
		wp_localize_script( 'anant-search-js',
            'search',
            array(
                'ajax' => admin_url( 'admin-ajax.php' ),
                'nonce' => wp_create_nonce( 'woo_tittle_nonce' ),
            )
        );
	}

	public function get_site_name() {
        return '<a class="anant-copyright-info" href="' . esc_url( home_url( '/' ) ) . '">' . esc_html( get_bloginfo( 'name' ) ) . '</a>';
    }

    public function get_year() {
        return esc_html( date( 'Y' ) );
    }

	public function register_wc_hook() {
		if ( class_exists( 'WooCommerce' ) ) {
			wc()->frontend_includes();
		}
	}

	public function register_widgets() {
		$this->includes();
		$this->register_slider_widgets();
	}

	public function includes() {
		require_once ANANT_PATH . 'inc/widgets/widget-utils.php';

		require_once ANANT_PATH . 'inc/widgets/header-footer/site-logo.php';
		require_once ANANT_PATH . 'inc/widgets/header-footer/site-title.php';
		require_once ANANT_PATH . 'inc/widgets/header-footer/site-tagline.php';
		require_once ANANT_PATH . 'inc/widgets/header-footer/copyright.php';
		require_once ANANT_PATH . 'inc/widgets/header-footer/search.php';
		require_once ANANT_PATH . 'inc/widgets/header-footer/menus.php';

		require_once ANANT_PATH . 'inc/widgets/creative-button.php';
		require_once ANANT_PATH . 'inc/widgets/creative-icon.php';
		require_once ANANT_PATH . 'inc/widgets/dual-button.php';
		require_once ANANT_PATH . 'inc/widgets/image-hotspot.php';
		require_once ANANT_PATH . 'inc/widgets/team.php';
		require_once ANANT_PATH . 'inc/widgets/feature.php';
		require_once ANANT_PATH . 'inc/widgets/dual-heading.php';
		require_once ANANT_PATH . 'inc/widgets/service.php';
		require_once ANANT_PATH . 'inc/widgets/portfolio.php';
		require_once ANANT_PATH . 'inc/widgets/author.php'; 

		require_once ANANT_PATH . 'inc/widgets/testimonial.php';
		require_once ANANT_PATH . 'inc/widgets/flip-box.php';
		require_once ANANT_PATH . 'inc/widgets/progress-bar.php';
		require_once ANANT_PATH . 'inc/widgets/calltoaction.php';
		require_once ANANT_PATH . 'inc/widgets/timeline.php';
		require_once ANANT_PATH . 'inc/widgets/number-box.php';
		require_once ANANT_PATH . 'inc/widgets/price.php';
		require_once ANANT_PATH . 'inc/widgets/business-hours.php';
		require_once ANANT_PATH . 'inc/widgets/price-list.php';
		require_once ANANT_PATH . 'inc/widgets/filter-gallery.php';
		require_once ANANT_PATH . 'inc/widgets/author-list.php';
		require_once ANANT_PATH . 'inc/widgets/image-comparison.php';
		require_once ANANT_PATH . 'inc/widgets/marquee-stripe.php';
		require_once ANANT_PATH . 'inc/widgets/ads-banner.php';
		
		require_once ANANT_PATH . 'inc/widgets/blog-posts/post-blog-list.php';
		require_once ANANT_PATH . 'inc/widgets/blog-posts/post-blog.php';
		require_once ANANT_PATH . 'inc/widgets/blog-posts/post-timeline.php';

		require_once ANANT_PATH . 'inc/widgets/archive-post/archive-title.php';
		require_once ANANT_PATH . 'inc/widgets/archive-post/archive-post.php';
		require_once ANANT_PATH . 'inc/widgets/archive-post/archive-post-list.php';

		require_once ANANT_PATH . 'inc/widgets/single-post/post-title.php';
		require_once ANANT_PATH . 'inc/widgets/single-post/post-content.php';
		require_once ANANT_PATH . 'inc/widgets/single-post/post-featured-image.php';
		require_once ANANT_PATH . 'inc/widgets/single-post/post-categories.php';
		require_once ANANT_PATH . 'inc/widgets/single-post/post-meta.php';
		require_once ANANT_PATH . 'inc/widgets/single-post/post-pagination.php';
		require_once ANANT_PATH . 'inc/widgets/single-post/post-share-icons.php';
		require_once ANANT_PATH . 'inc/widgets/single-post/post-comment.php';
		require_once ANANT_PATH . 'inc/widgets/single-post/post-author.php';

		require_once ANANT_PATH . 'inc/widgets/woo/product-grid.php';
		require_once ANANT_PATH . 'inc/widgets/woo/product-category-grid.php';
		require_once ANANT_PATH . 'inc/widgets/woo/product-category-tab.php';
		require_once ANANT_PATH . 'inc/widgets/woo/product-grid-with-nav.php';
		require_once ANANT_PATH . 'inc/widgets/woo/cart.php';
		require_once ANANT_PATH . 'inc/widgets/woo/cart-page.php';
		require_once ANANT_PATH . 'inc/widgets/woo/checkout.php';
		require_once ANANT_PATH . 'inc/widgets/woo/wishlist-page.php';
		require_once ANANT_PATH . 'inc/widgets/woo/wishlist.php';
		require_once ANANT_PATH . 'inc/widgets/woo/product-search.php';
		require_once ANANT_PATH . 'inc/widgets/time-counter.php';
		require_once ANANT_PATH . 'inc/widgets/woo/account.php';

		require_once ANANT_PATH . 'inc/widgets/woo/single-product/woo-product-title.php';
		require_once ANANT_PATH . 'inc/widgets/woo/single-product/woo-product-description.php';
		require_once ANANT_PATH . 'inc/widgets/woo/single-product/woo-product-categories.php';
		require_once ANANT_PATH . 'inc/widgets/woo/single-product/woo-product-image.php';
		require_once ANANT_PATH . 'inc/widgets/woo/single-product/woo-product-sku.php';
		require_once ANANT_PATH . 'inc/widgets/woo/single-product/woo-product-buttons.php';
		require_once ANANT_PATH . 'inc/widgets/woo/single-product/woo-product-stock.php';
		require_once ANANT_PATH . 'inc/widgets/woo/single-product/woo-product-quantity.php';
		require_once ANANT_PATH . 'inc/widgets/woo/single-product/woo-product-price.php';
		require_once ANANT_PATH . 'inc/widgets/woo/single-product/woo-product-rating.php';
		require_once ANANT_PATH . 'inc/widgets/woo/single-product/woo-product-details.php';

		require_once ANANT_PATH . 'inc/widgets/woo/product-archive/product-archive-title.php';
		require_once ANANT_PATH . 'inc/widgets/woo/product-archive/product-archive-grid.php';

		require_once ANANT_PATH . 'inc/widgets/third-party/cf7.php';
		require_once ANANT_PATH . 'inc/widgets/third-party/everest-forms.php';
		require_once ANANT_PATH . 'inc/widgets/third-party/ninja-forms.php';

	}
	public function total_widgets(){
		$All_Widgets = [];
		foreach (anant_registered_widgets() as $widget_setting) {
			foreach ( $widget_setting['widgets'] as $widget) {

				$widget_id = explode(" ",$widget['slug']);
				$widget_id = implode("-anant-",$widget_id);
			   
				$All_Widgets[] .= get_option($widget_id, $widget_id) == "" ? false : true ;
			}
		}

		return $All_Widgets;
	}
	public function total_TP_widgets(){
		$All_Widgets = [];
		foreach (anant_third_party_widgets() as $widget_setting) {
		  $widget_id = explode(" ",$widget_setting['name']);
		  $widget_id = implode("-anant-",$widget_id);
		 
		  $All_Widgets[] .= get_option($widget_id, $widget_id) == "" ? false : true ;
		}

		return $All_Widgets;
	}
	public function register_slider_widgets() {
		$header_scripts = get_option('Copyright',true);
		define("ANANT_WIDGETS", $this->total_widgets());
		define("ANANT_TP_WIDGETS", $this->total_TP_widgets());
		$widget_manager = \Elementor\Plugin::instance()->widgets_manager;
		$i = 0;
		foreach ( anant_registered_widgets() as $widgets ) {

			if($widgets['widget_cat'] == 'Anant Woocommerce' || $widgets['widget_cat'] == 'Anant Single Product'){

				foreach ( $widgets['widgets'] as $widget ) {
					$class_name = '\AnantAddons\\'. $widget['name'];
					
					if($widget['ver'] == 'lite') {
						if( !$widget['name'] == '' && !ANANT_WIDGETS[$i] == false ){
							if(array_key_exists('id', $widget ) && $widget['id'] == 'woocommerce' && class_exists( 'woocommerce' ) && is_plugin_active('woocommerce/woocommerce.php') ){
								$widget_manager->register( new $class_name() );
							}
						}
					}
					$i++;
					
				}

			}else{
				foreach ( $widgets['widgets'] as $widget ) {
					$class_name = '\AnantAddons\\'. $widget['name'];
				
					if($widget['ver'] == 'lite') {		
						if( !$widget['name'] == '' && !ANANT_WIDGETS[$i] == false ){
							$widget_manager->register( new $class_name() );
						}
					}
					$i++;
					
				}
			}

		}
		$j = 0;
		foreach ( anant_third_party_widgets() as $widget ) {
			$class_name = '\AnantAddons\\'. $widget['name'];
			$plug_path = get_plugin_path($widget['id']);
			 if(is_plugin_active($plug_path)){ 
				if( !$widget['name'] == '' && !ANANT_TP_WIDGETS[$j] == '' ){
					$widget_manager->register( new $class_name() );
				}
			}
			$j++;
		}
	}

	public function init_controls() {
		require_once ANANT_PATH . 'inc/controls/class-selectize-control.php';
		\Elementor\Plugin::instance()->controls_manager->register_control('meta-store-selectize', new Selectize_Control() );
	}

	public function file_include(){
		require_once ANANT_PATH . 'inc/admin.php';
	}
}

Plugin::instance();