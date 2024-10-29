<?php namespace AnantAddons;

use Elementor\Controls_Manager;
use Elementor\Group_Control_Background;

class AnantProductGridWithNav extends \Elementor\Widget_Base {

	private $product_class = 'anant-product-grid-nav-item';
	private $product_img = 'anant-product-grid-nav-image';
	private $product_title = 'anant-product-grid-nav-title';
	private $product_price = 'anant-product-grid-nav-price';
	private $product_btn = 'anant-product-grid-nav-button';
	private $product_icon = 'anant-product-grid-nav-icon';
	private $product_tag = 'anant-product-grid-nav-tag';
	private $product_rating = 'anant-product-grid-nav-rating';
	private $product_category = 'anant-product-grid-nav-category';

	public function get_name() {
		return 'anant-product-grid-with-nav';
	}

	public function get_title() {
		return __( 'Products Grid with Nav', 'anant-addons-for-elementor' );
	}

	public function get_categories() {
		return [ 'anant-woo-elements' ];
	}

	public function get_icon() {
		return 'ant-icon eicon-products';
	}

	public function get_style_depends() {
		return [
			'anant-post-blog',
		];
	}

	public function get_script_depends() {
		return [
			'anant-post-blog',
		];
	}

	public function get_keywords() {
		return [
			'product grid with nav',
			'sorting',
			'product filter',
			'anant addons',
			'',
			'woo',
		];
	}

	protected function render() {
		$settings                    = $this->get_settings_for_display();

		$template_style = $settings['template_style'];

		
		$category_class = '';
		$hide = '';

		$args['status'] = 'publish';
		$args['limit']  = 10;

		if ( isset( $settings['posts_per_page'] ) && intval( $settings['posts_per_page'] ) > 0 ) {
			$args['limit'] = $settings['posts_per_page'];
		}


		if ( isset( $settings['product_category'] ) && is_array( $settings['product_category'] ) && ! empty( $settings['product_category'] ) ) {
			$args['category'] = $settings['product_category'];
		}
		if ( isset( $settings['product_tags'] ) && is_array( $settings['product_tags'] ) && ! empty( $settings['product_tags'] ) ) {
			$args['tag'] = $settings['product_tags'];
		}
		if ( isset( $settings['include_featured'] ) && ! empty( $settings['include_featured'] ) && $settings['include_featured'] === 'yes' ) {
			$args['featured'] = true;
		}
		if ( isset( $settings['latest_product'] ) && ! empty( $settings['latest_product'] ) && $settings['latest_product'] === 'yes' ) {
			$args['orderby'] = 'date';
			$args['order']   = 'DESC';
		}

		$title = '';
		if ( isset( $settings['title'] ) && ! empty( $settings['title'] ) ) {
			$title = $settings['title'];
		}

		$this->add_render_attribute( 'wrapper', 'class', 'anant-outer-wrapper' );
		$this->add_render_attribute( 'wrapper', 'data-wid', $this->get_id() );
		$is_best_rated = $settings['only_best_rated_product'];
		$best_rated_count = $settings['best_rated_count'];
		$display_title = $settings['display_title'];
		$product_design = $settings['product_design'];

		$display_rating = array_key_exists('display_rating', $settings) ? $settings['display_rating'] : false;
		$display_category = array_key_exists('display_category', $settings) && $settings['display_category'] === 'yes' ? true : false;
		$display_price  = array_key_exists('display_price', $settings) ? $settings['display_price'] : false;
		// $display_image  = array_key_exists('display_image', $settings) ? $settings['display_image'] : false;
		$on_sales_ids = wc_get_product_ids_on_sale();
		$only_on_sale = false;
		$only_best_sale = false;
		$best_sale_count = 0;
		$show_cart_button = true;
		if (isset($settings['only_on_sale']) && !empty($settings['only_on_sale']) && $settings['only_on_sale'] === 'yes') {
			$only_on_sale = true;
		}
		if (isset($settings['display_add_to_cart_button']) && empty($settings['display_add_to_cart_button']) && $settings['display_add_to_cart_button'] !== 'yes') {
			$show_cart_button = false;
		}

		$show_wishlist_button = true;
		if (isset($settings['show_wishlist_button']) && empty($settings['show_wishlist_button']) && $settings['show_wishlist_button'] !== 'yes') {
			$show_wishlist_button = false;
		}
		$show_quickview_button = true;
		if (isset($settings['show_quickview_button']) && empty($settings['show_quickview_button']) && $settings['show_quickview_button'] !== 'yes') {
			$show_quickview_button = false;
		}

		if (isset($settings['only_best_sale']) && !empty($settings['only_best_sale']) && $settings['only_best_sale'] === 'yes') {
			$only_best_sale = true;
			if ( isset( $settings['best_sale_count'] ) && intval( $settings['best_sale_count'] ) > 0 ) {
				$best_sale_count = $settings['best_sale_count'];
			}
		}

		$thumbnail_size_key = 'thumbnail_size';
		$swiper_div_tabs = false;

		$cat_details = [];
		$counter     = 0;
		if ( $cat_details ) {
			$args['category'] = [
				$cat_details['slug']
			];
		}

		if(!function_exists('wc_get_products')) { return; }

		$paged                   = (get_query_var('paged')) ? absint(get_query_var('paged')) : 1;
		$ordering                = WC()->query->get_catalog_ordering_args();
		$temp = explode(' ', $ordering['orderby']);
		$ordering['orderby']     = array_shift($temp);
		$ordering['orderby']     = stristr($ordering['orderby'], 'price') ? 'meta_value_num' : $ordering['orderby'];
		$products_per_page       = apply_filters('loop_shop_per_page', wc_get_default_products_per_row() * wc_get_default_product_rows_per_page());

		$args['page'] = $paged;
		$args['orderby'] =  $ordering['orderby'];
		$args['order'] =  $ordering['order'];

		$pagination_type = $settings['pagination_type'];
		if ( $pagination_type !== 'none' ) {
			$args['paginate'] = true;
		}else{
			$args['paginate'] = false;
		}

		$featured_products = wc_get_products( $args );

		if (is_array($featured_products) || is_object($featured_products)) {
			if(empty($featured_products->products)){
				return 'Products are Not available';
			}
		} else {
		}
		
		wc_set_loop_prop('current_page', $paged);
		wc_set_loop_prop('is_paginated', wc_string_to_bool(true));
		wc_set_loop_prop('page_template', get_page_template_slug());
		wc_set_loop_prop('per_page', $products_per_page);
		if (is_array($featured_products)) {
			wc_set_loop_prop('total', count($featured_products));
			wc_set_loop_prop('total_pages', ceil(count($featured_products) / $products_per_page));
		} else {
			wc_set_loop_prop('total', $featured_products->total);
			wc_set_loop_prop('total_pages', $featured_products->max_num_pages);
		}

		if($featured_products) {
			do_action('woocommerce_before_shop_loop');
			woocommerce_product_loop_start();
			if (is_array($featured_products)) {
				$products = $featured_products;
				require ANANT_PATH . 'inc/templates/style-1/product-grid-template.php';
			} else {
				$products = $featured_products->products;
				require ANANT_PATH . 'inc/templates/style-1/product-grid-template.php';
			}
			wp_reset_postdata();
			woocommerce_product_loop_end();
			if ( $pagination_type !== 'none' ) {
				if ( $pagination_type === 'previous/next' ) {
					$this->anant_pagi_previous_next( $featured_products );
				}
			}
		} else {
			do_action('woocommerce_no_products_found');
		}

		return;

		$all_products = wc_get_products( $args );
		$products = $all_products->products;;

		echo $all_products->total . ' products found\n';
		echo 'Page 1 of ' . $all_products->max_num_pages . '\n';
		require ANANT_PATH . 'inc/templates/style-1/product-grid-template.php';

	}

	function custom_previous_posts_page_link( $paged ) {
		if ( $paged > 1 ) {
			$prev_page = $paged - 1;
			return get_pagenum_link( $prev_page );
		}
		return false;
	}
	
	function custom_next_posts_page_link( $paged, $max ) {
		if ( $paged < $max ) {
			$next_page = $paged + 1;
			return get_pagenum_link( $next_page );
		}
		return false;
	}
	
	
	function anant_pagi_previous_next( $wp_query ) {
		if( $wp_query->max_num_pages <= 1 ) return;
	
		$paged = (get_query_var('paged')) 
			? absint(get_query_var('paged')) 
				: (isset($_GET['paged']) 
					? absint($_GET['paged']) 
					: (get_query_var('page') 
						? absint(get_query_var('page')) 
						: 1));
					
		$max   = intval( $wp_query->max_num_pages );
	
		echo '<div class="anant-navigation navigation anant-pagi-p-n"><ul>' . "\n";
		
		// Previous link
		$prev_link = $this->custom_previous_posts_page_link( $paged );
		if ( $prev_link ) {
			echo "<li><a href='". $prev_link ."' class='page-numbers anant-pagi-pre-btn'>Previous</a></li>";
		}
	
		// Next link
		$next_link = $this->custom_next_posts_page_link( $paged, $max );
		if ( $next_link ) {
			echo "<li><a href='". $next_link ."' class='page-numbers'>Next</a></li>";
		}
	
		echo '</ul></div>' . "\n";
	}

	protected function register_controls() {

		$this->start_controls_section(
			'query_configuration',
			[
				'label' => __( 'Content Settings 1', 'anant-addons-for-elementor' ),
				'tab'   => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);

		$this->add_control(
			'product_design',
			[
				'label'       => esc_html__( 'Product Style', 'anant-addons-for-elementor' ),
				'placeholder' => esc_html__( 'Choose Style from Here', 'anant-addons-for-elementor' ),
				'type'        => \Elementor\Controls_Manager::SELECT,
				'default'     => 'card',
				'options'     => [
					'card'      => esc_html__( 'Card ', 'anant-addons-for-elementor' ),
					'overlay' => esc_html__( 'Overlay', 'anant-addons-for-elementor' ),
				],
			]
		);
		$this->add_control(
			'template_style',
			[
				'label'       => esc_html__( 'Template Style', 'anant-addons-for-elementor' ),
				'placeholder' => esc_html__( 'Choose Template from Here', 'anant-addons-for-elementor' ),
				'type'        => \Elementor\Controls_Manager::SELECT,
				'default'     => 'layout_1',
				'options'     => [
					'layout_1'      => esc_html__( 'Layout 1', 'anant-addons-for-elementor' ),
					'layout_2'      => esc_html__( 'Layout 2 (Pro)', 'anant-addons-for-elementor' ),
					'layout_3'      => esc_html__( 'Layout 3 (Pro)', 'anant-addons-for-elementor' ),
					'layout_4'      => esc_html__( 'Layout 4 (Pro)', 'anant-addons-for-elementor' ),
					'layout_5'      => esc_html__( 'Layout 5 (Pro)', 'anant-addons-for-elementor' ),
				],
			]
		);

		$this->add_control(
			'anant_woo_product_nav_pro_notice',
			[
				'raw' => 'Only Available in <a href="https://anantaddons.com/" target="_blank">Pro Version!</a>',
				'type' => \Elementor\Controls_Manager::RAW_HTML,
				'content_classes' => 'anant-pro-notice',
				'condition' => [
                    'template_style!' => ['layout_1'],
                ],
			]
		);

		anant_select2_control(
			$this,
			[
				'key'         => 'product_category',
				'label'       => 'Product Category',
				'placeholder' => 'Choose Category to Include',
				'options'     => anant_get_product_category(),
				'multiple'    => true,
			]
		);
		
		anant_select2_control(
			$this,
			[
				'key'         => 'product_tags',
				'label'       => 'Product Tags',
				'placeholder' => 'Choose Tags to Include',
				'options'     => anant_get_product_tags(),
				'multiple'    => true,
			]
		);

		anant_switcher_control(
			$this,
			[
				'key'       => 'include_featured',
				'label'     => 'Include Only Featured Products',
				'on_label'  => 'Yes',
				'off_label' => 'No',

			]
		);

		anant_switcher_control(
			$this,
			[
				'key'       => 'only_best_rated_product',
				'label'     => 'Include Only Best Rated Products',
				'on_label'  => 'Yes',
				'off_label' => 'No',

			]
		);

		anant_number_control(
			$this,
			[
				'key'         => 'best_rated_count',
				'label'       => 'Rating Count',
				'placeholder' => 'Default is 0',
				'min'         => 0,
				'max'         => 5,
				'default'     => 0,
				'condition'   => [
					'only_best_rated_product' => 'yes',
				],
			]
		);

		anant_switcher_control(
			$this,
			[
				'key'       => 'only_on_sale',
				'label'     => 'Only On Sale Products',
				'on_label'  => 'Yes',
				'off_label' => 'No',

			]
		);

		anant_switcher_control(
			$this,
			[
				'key'       => 'only_best_sale',
				'label'     => 'Only Best Selling Products',
				'on_label'  => 'Yes',
				'off_label' => 'No',

			]
		);

		anant_switcher_control(
			$this,
			[
				'key'       => 'latest_product',
				'label'     => 'Latest Products First',
				'on_label'  => 'Yes',
				'off_label' => 'No',

			]
		);

		anant_number_control(
			$this,
			[
				'key'         => 'best_sale_count',
				'label'       => 'Selling Products Count',
				'placeholder' => 'Default is 0',
				'min'         => -1,
				'default'     => 0,
				'condition'   => [
					'only_best_sale' => 'yes',
				],
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'item_configuration',
			[
				'label' => __( 'Item Settings', 'anant-addons-for-elementor' ),
				'tab'   => Controls_Manager::TAB_CONTENT,
			]
		);

		anant_number_control(
			$this,
			[
				'key'         => 'posts_per_page',
				'label'       => 'Limit',
				'placeholder' => 'Default is 8',
				'min'         => 1,
				'max'         => 10,
				'default'     => 8,
			]
		);

		$this->add_responsive_control(
			'grid_column_count',
			[
				'label' => esc_html__( 'Grid Column Count', 'anant-addons-for-elementor' ) .' <i class="eicon-pro-icon"></i>' ,
				'type' => \Elementor\Controls_Manager::SELECT,
				'default' => '4',
				'options' => [
					'4' => esc_html__( '4', 'anant-addons-for-elementor' ),
				],
				'classes' => 'anant-pro-popup-notice',
			]
		);

		$this->add_responsive_control(
			'grid_column_gap',
			[
				'label'           => __( 'Grid Column Gap', 'anant-addons-for-elementor' ),
				'type'            => Controls_Manager::SLIDER,
				'size_units'      => [ 'px' ],
				'range'           => [
					'px' => [
						'min' => 15,
						'max' => 100,
					],
				],
				'default' => [
					'unit' => 'px',
					'size' => 30,
				],
				'devices'         => [ 'desktop', 'tablet', 'mobile' ],
				'desktop_default' => [
					'size' => 30,
					'unit' => 'px',
				],
				'tablet_default'  => [
					'size' => 30,
					'unit' => 'px',
				],
				'mobile_default'  => [
					'size' => 30,
					'unit' => 'px',
				],
				'selectors'   => [
					'{{WRAPPER}} .anant-product-grid-wrapper ' => 'grid-column-gap: {{SIZE}}{{UNIT}};',
				],
			],
		);

		$this->add_responsive_control(
			'grid_row_gap',
			[
				'label'           => __( 'Grid Row Gap', 'anant-addons-for-elementor' ),
				'type'            => Controls_Manager::SLIDER,
				'size_units'      => [ 'px' ],
				'range'           => [
					'px' => [
						'min' => 15,
						'max' => 100,
					],
				],
				'default' => [
					'unit' => 'px',
					'size' => 30,
				],
				'devices'         => [ 'desktop', 'tablet', 'mobile' ],
				'desktop_default' => [
					'size' => 30,
					'unit' => 'px',
				],
				'tablet_default'  => [
					'size' => 30,
					'unit' => 'px',
				],
				'mobile_default'  => [
					'size' => 30,
					'unit' => 'px',
				], 
				'selectors'   => [
					'{{WRAPPER}} .anant-product-grid-wrapper ' => 'grid-row-gap: {{SIZE}}{{UNIT}};',
				],
			],
		);

		// slider title

			anant_switcher_control(
				$this,
				[
					'key'       => 'display_title',
					'label'     => 'Show Title',
					'on_label'  => 'Yes',
					'off_label' => 'No',
					'default'   => 'yes',
				]
			);

		// slider title ends

		// slider price

		anant_switcher_control(
			$this,
			[
				'key'       => 'display_price',
				'label'     => 'Show Price',
				'on_label'  => 'Yes',
				'off_label' => 'No',
				'default'   => 'yes',
			]
		);

		// slider price ends

		// slider rating

		anant_switcher_control(
			$this,
			[
				'key'       => 'display_rating',
				'label'     => 'Show Rating',
				'on_label'  => 'Yes',
				'off_label' => 'No',
				'default'   => 'yes',
			]
		);

		// slider rating ends

		anant_switcher_control(
			$this,
			[
				'key'       => 'display_category',
				'label'     => 'Show Category',
				'on_label'  => 'Yes',
				'off_label' => 'No',
				'default'   => 'yes',
			]
		);

		// slider button

		anant_switcher_control(
			$this,
			[
				'key'       => 'display_add_to_cart_button',
				'label'     => 'Show Add to Cart Button',
				'on_label'  => 'Yes',
				'off_label' => 'No',
				'default'   => 'yes',
			]
		);

		// slider button ends

		anant_switcher_control(
			$this,
			[
				'key'       => 'show_wishlist_button',
				'label'     => 'Show Wishlist Button',
				'on_label'  => 'Yes',
				'off_label' => 'No',
				'default'   => 'yes',
			]
		);

		anant_switcher_control(
			$this,
			[
				'key'       => 'show_quickview_button',
				'label'     => 'Show Quick View Button',
				'on_label'  => 'Yes',
				'off_label' => 'No',
				'default'   => 'yes',
			]
		);

		anant_switcher_control(
			$this,
			[
				'key'       => 'show_compare_button',
				'label'     => 'Show Compare Button',
				'on_label'  => 'Yes',
				'off_label' => 'No',
				'default'   => 'No',
				'classes' => 'anant-pro-popup-notice',
				'escape' => false,
			]
		);

		// slider image

		anant_image_size_control(
			$this,
			[
				'name'      => 'thumbnail_size',
				'default'   => 'thumbnail',
			]
		);

		// slider ends
		$this->end_controls_section();

		$this->start_controls_section(
			'pagination',
			[
				'label' => __( 'Pagination', 'anant-addons-for-elementor' ),
				'tab'   => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);

		anant_select2_control(
			$this,
			[
				'key'         => 'pagination_type',
				'label'       => 'Pagination',
				'placeholder' => 'Choose pagination to include',
				'options'     => [
					'none' => 'None',
					'previous/next' => 'Previous/Next',
					'numbers' => 'Numbers (Pro)',
					'numbers+previous/next' => 'Numbers + Previous/Next (Pro)',
				],
				'default' => 'previous/next',
				'multiple'    => false,
			]
		);

		$this->add_control(
			'anant_woo_product_pagination_pro_notice',
			[
				'raw' => 'Only Available in <a href="https://anantaddons.com/" target="_blank">Pro Version!</a>',
				'type' => \Elementor\Controls_Manager::RAW_HTML,
				'content_classes' => 'anant-pro-notice',
				'condition' => [
                    'pagination_type!' => ['none', 'previous/next'],
                ],
			]
		);

		anant_alignment_control(
			$this,
			[
				'key'       => 'pagination_align',
				'label'     => 'Alignment',
				'options'   => [
					'flex-start'   => [
						'title' => __( 'Left', 'anant-addons-for-elementor' ),
						'icon'  => 'eicon-text-align-left',
					],
					'center' => [
						'title' => __( 'Center', 'anant-addons-for-elementor' ),
						'icon'  => 'eicon-text-align-center',
					],
					'flex-end'  => [
						'title' => __( 'Right', 'anant-addons-for-elementor' ),
						'icon'  => 'eicon-text-align-right',
					],
				],
				'default'   => 'center',
				'selectors' => [
					'{{WRAPPER}} .navigation,{{WRAPPER}} .woocommerce-pagination .page-numbers' => 'justify-content: {{VALUE}}',
				],
				'condition'   => [
					'pagination_type' => 'previous/next',
				],
			]
		);

		$this->end_controls_section();

		anant_pro_promotion_controls($this);

		// style item
		$this->start_controls_section(
			'section_nav_style',
			[
				'label' => __( 'Nav Style', 'anant-addons-for-elementor' ),
				'tab'   => Controls_Manager::TAB_STYLE,

			]
		);

        $this->add_control(
            'heading_result',
            [
                'type'      => Controls_Manager::HEADING,
                'label'     => __( 'Showing Result', 'anant-addons-for-elementor' ),
                'separator' => 'before',
            ]
        );

		anant_color_control(
			$this,
			[
				'key'       => 'nav_result_count_color',
				'label'     => 'Color',
				'selectors' => [
					'{{WRAPPER}} .woocommerce-result-count' => 'color: {{VALUE}};',
				],
			]
		);

		anant_typography_control(
			$this,
			[
				'name'     => 'nav_result_count_typography',
				'label'    => 'Typography',
				'selector' => '{{WRAPPER}} .woocommerce-result-count',
			]
		);

        $this->add_control(
            'heading_shorting',
            [
                'type'      => Controls_Manager::HEADING,
                'label'     => __( 'Shorting', 'anant-addons-for-elementor' ),
                'separator' => 'before',
            ]
        );

		anant_color_control(
			$this,
			[
				'key'       => 'nav_text_color',
				'label'     => 'Color',
				'selectors' => [
					'{{WRAPPER}} .woocommerce-ordering .orderby' => 'color: {{VALUE}};',
				],
			]
		);

		anant_color_control(
			$this,
			[
				'key'       => 'nav_text_bg_color',
				'label'     => 'Background Color',
				'selectors' => [
					'{{WRAPPER}} .woocommerce-ordering .orderby' => 'background-color: {{VALUE}};',
				],
			]
		);

		anant_typography_control(
			$this,
			[
				'name'     => 'nav_typography',
				'label'    => 'Typography',
				'selector' => '{{WRAPPER}} .woocommerce-ordering .orderby',
			]
		);

        $this->add_control(
            'heading_shorting_option',
            [
                'type'      => Controls_Manager::HEADING,
                'label'     => __( 'Shorting Options', 'anant-addons-for-elementor' ),
                'separator' => 'before',
            ]
        );

		anant_color_control(
			$this,
			[
				'key'       => 'nav_options_text_color',
				'label'     => 'Color',
				'selectors' => [
					'{{WRAPPER}} .woocommerce-ordering .orderby option' => 'color: {{VALUE}};',
				],
			]
		);

		anant_color_control(
			$this,
			[
				'key'       => 'nav_options_text_bg_color',
				'label'     => 'Background Color',
				'selectors' => [
					'{{WRAPPER}} .woocommerce-ordering .orderby option' => 'background-color: {{VALUE}};',
				],
			]
		);

		anant_typography_control(
			$this,
			[
				'name'     => 'nav_options_typography',
				'label'    => 'Typography',
				'selector' => '{{WRAPPER}} .woocommerce-ordering .orderby option',
			]
		);

		anant_border_control(
			$this,
			[
				'name'     => 'nav_border_type',
				'label'    => 'Border Type',
				'selector' => '{{WRAPPER}} .woocommerce-ordering .orderby',
			]
		);

		anant_border_radius_control(
			$this,
			[
				'key'       => 'nav_border_radius',
				'label'     => 'Border Radius',
				'selectors' => [
					'{{WRAPPER}} .woocommerce-ordering .orderby' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'nav_padding',
			[
				'label'     => esc_html__('Padding', 'anant-addons-for-elementor'),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .woocommerce-ordering .orderby' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'nav_margin',
			[
				'label'     => esc_html__('Margin', 'anant-addons-for-elementor'),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .woocommerce-ordering .orderby' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		anant_box_shadow_control(
			$this,
			[
				'key'      => 'nav_box_shadow',
				'label'    => 'Box Shadow',
				'selector' => '{{WRAPPER}} .woocommerce-ordering .orderby',
				'separator' => 'after',
				
			]
		);

		$this->end_controls_section();
		// style item ends

		// style item
		$this->start_controls_section(
			'section_item_style',
			[
				'label' => __( 'Item Box', 'anant-addons-for-elementor' ),
				'tab'   => Controls_Manager::TAB_STYLE,
	
			]
			);
		$slug = 'section_iteam';

		anant_color_control(
		$this,
		[
			'key'       => $slug.'_bg_color',
			'label'     => 'Background Color',
			'selectors' => [
				'{{WRAPPER}} .'.$this->product_class => 'background-color: {{VALUE}};',
			],
		]
		);

		anant_border_control(
		$this,
		[
			'name'     => $slug.'_border_type',
			'label'    => 'Border Type',
			'selector' => '{{WRAPPER}} .'.$this->product_class,
		]
		);

		anant_border_radius_control(
		$this,
		[
			'key'       => $slug.'_border_radius',
			'label'     => 'Border Radius',
			'selectors' => [
				'{{WRAPPER}} .'.$this->product_class => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
			],
		]
		);

		$this->add_responsive_control(
			$slug.'_padding',
			[
				'label'     => esc_html__('Padding', 'anant-addons-for-elementor'),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .'.$this->product_class => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		anant_box_shadow_control(
		$this,
		[
			'key'      => $slug.'_box_shadow',
			'label'    => 'Box Shadow',
			'selector' => '{{WRAPPER}} .'.$this->product_class,
		]
		);

		$this->end_controls_section();
		// style item ends

		// styles image

		$this->start_controls_section(
		'section_image_style',
		[
			'label'     => __( 'Image Settings', 'anant-addons-for-elementor' ),
			'tab'       => Controls_Manager::TAB_STYLE,
		]
		);

		$slug = 'product_image';

		$this->add_group_control(
		Group_Control_Background::get_type(),
		[
			'name'      => $slug.'_image_overlay_color',
			'types'          => [ 'classic', 'gradient' ],
			'exclude'        => [ 'image' ],
			'fields_options' => [
				'background' => [
					'label'     => __( 'Background ', 'anant-addons-for-elementor' ),
					'default' => 'classic',
				],
			],
			'selector'  => '{{WRAPPER}} .anant_thumbnail:before',
			'condition'   => [
				'template_style' => 'layout_1',
				'product_design' => 'overlay',
			],
		]
		);

		$this->add_responsive_control(
		$slug.'_overlay_opacity',
		[
			'label' => esc_html__( 'Opacity', 'anant-addons-for-elementor' ),
			'type' => Controls_Manager::SLIDER,
			'range' => [
				'px' => [
					'max' => 1,
					'step' => 0.01,
				],
			],
			'selectors'  => [
				'{{WRAPPER}} .anant_thumbnail:before' => 'opacity: {{SIZE}};',
			],
			'condition'   => [
				'template_style' => 'layout_1',
				'product_design' => 'overlay',
			],
		]
		);

		$this->add_responsive_control(
		$slug.'_image_width',
		[
			'label'           => __( 'Image Width', 'anant-addons-for-elementor' ),
			'type'            => Controls_Manager::SLIDER,
			'size_units'      => [ 'px', '%' ],
			'range'           => [
				'px' => [
					'min' => 0,
					'max' => 1200,
				],
				'%' => [
					'min' => 0,
					'max' => 100,
				],
			],
			'devices'         => [ 'desktop', 'tablet', 'mobile' ],
			'desktop_default' => [
				'size' =>'' ,
				'unit' => '%',
			],
			'tablet_default'  => [
				'size' => '',
				'unit' => '%',
			],
			'mobile_default'  => [
				'size' => '',
				'unit' => '%',
			],
			'selectors'       => [
				'{{WRAPPER}} .'.$this->product_img.' img' => 'width: {{SIZE}}{{UNIT}};', 
			],
		],
		);

		$this->add_responsive_control(
		$slug.'_image_height',
		[
			'label'           => __( 'Image Height', 'anant-addons-for-elementor' ),
			'type'            => Controls_Manager::SLIDER,
			'size_units'      => [ 'px', '%' ],
			'range'           => [
				'px' => [
					'min' => 0,
					'max' => 1200,
				],
				'%' => [
					'min' => 0,
					'max' => 100,
				],
			],
			'devices'         => [ 'desktop', 'tablet', 'mobile' ],
			'desktop_default' => [
				'size' => '',
				'unit' => 'px',
			],
			'tablet_default'  => [
				'size' => '',
				'unit' => 'px',
			],
			'mobile_default'  => [
				'size' => '',
				'unit' => 'px',
			],
			'selectors'       => [
				'{{WRAPPER}} .'.$this->product_img.' img' => 'height: {{SIZE}}{{UNIT}};', 
			],
		]
		);

		anant_border_control(
		$this,
		[
			'name'     => $slug.'_border_type',
			'label'    => 'Border Type',
			'selector' => '{{WRAPPER}} .'.$this->product_img.' img',
		]
		);

		anant_border_radius_control(
		$this,
		[
			'key'       => $slug.'_border_radius',
			'label'     => 'Border Radius',
			'selectors' => [
				'{{WRAPPER}} .'.$this->product_img.' img' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
			],
		]
		);

		$this->add_responsive_control(
			$slug.'_margin',
		[
			'label'     => esc_html__('Margin', 'anant-addons-for-elementor'),
			'type' => Controls_Manager::DIMENSIONS,
			'size_units' => [ 'px', '%', 'em' ],
			'selectors' => [
				'{{WRAPPER}} .'.$this->product_img.' img' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
			],
		]
		);

		$this->end_controls_section();
		// styles image ends

		// Icon Settings
		$this->start_controls_section(
		'product_icon_settings',
		[
			'label' => __( 'Icon Settings', 'anant-addons-for-elementor' ),
			'tab'   => Controls_Manager::TAB_STYLE,
		]
		);
		$slug = 'product_icon';

		$this->add_responsive_control(
			$slug.'_margin',
		[
			'label'     => esc_html__('Margin', 'anant-addons-for-elementor'),
			'type' => Controls_Manager::DIMENSIONS,
			'size_units' => [ 'px', '%', 'em' ],
			'selectors' => [
				'{{WRAPPER}} .'.$this->product_icon.' a' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
			],
		]
		);

		$this->add_responsive_control(
		$slug.'_width',
		[
			'label'           => __( 'Icon Width', 'anant-addons-for-elementor' ),
			'type'            => Controls_Manager::SLIDER,
			'size_units'      => [ 'px', '%' ],
			'range'           => [
				'px' => [
					'min' => 0,
					'max' => 150,
				],
				'%' => [
					'min' => 0,
					'max' => 100,
				],
			],
			'devices'         => [ 'desktop', 'tablet', 'mobile' ],
			'desktop_default' => [
				'size' => '',
				'unit' => 'px',
			],
			'tablet_default'  => [
				'size' => '',
				'unit' => 'px',
			],
			'mobile_default'  => [
				'size' => '',
				'unit' => 'px',
			],
			'selectors'       => [
				'{{WRAPPER}} .'.$this->product_icon.' a' => 'width: {{SIZE}}{{UNIT}};height: {{SIZE}}{{UNIT}};',
			],
		]
		);

		$this->add_responsive_control(
		$slug.'_size',
		[
			'label'           => __( 'Icon Size', 'anant-addons-for-elementor' ),
			'type'            => Controls_Manager::SLIDER,
			'size_units'      => [ 'px', '%' ],
			'range'           => [
				'px' => [
					'min' => 0,
					'max' => 120,
				],
				'%' => [
					'min' => 0,
					'max' => 100,
				],
			],
			'devices'         => [ 'desktop', 'tablet', 'mobile' ],
			'desktop_default' => [
				'size' => '',
				'unit' => 'px',
			],
			'tablet_default'  => [
				'size' => '',
				'unit' => 'px',
			],
			'mobile_default'  => [
				'size' => '',
				'unit' => 'px',
			],
			'selectors'       => [
				'{{WRAPPER}} .'.$this->product_icon.' a i' => 'font-size: {{SIZE}}{{UNIT}};',
			],
		]
		);

		$this->start_controls_tabs( $slug.'_tabs' );

		$this->start_controls_tab(
		$slug.'_normal_style',
		[
			'label' => __( 'Normal', 'anant-addons-for-elementor' ),
		]
		);

		$this->add_control(
		$slug.'_bg_color',
		[
			'label'     => __( 'Background Color', 'anant-addons-for-elementor' ),
			'type'      => Controls_Manager::COLOR,
			'selectors' => [
				'{{WRAPPER}}  .'.$this->product_icon.' a' => 'background-color: {{VALUE}}',
			],
		]
		);

		$this->add_control(
		$slug.'_color',
		[
			'label'     => __( 'Color', 'anant-addons-for-elementor' ),
			'type'      => Controls_Manager::COLOR,
			'selectors' => [
				'{{WRAPPER}}  .'.$this->product_icon.' a i' => 'color: {{VALUE}}',
			],
		]
		);

		anant_border_control(
		$this,
		[
			'name'     => $slug.'_border_type',
			'label'    => 'Border Type',
			'selector' => '{{WRAPPER}} .'.$this->product_icon. ' a',
		]
		);

		anant_border_radius_control(
		$this,
		[
			'key'       => $slug.'_border_type',
			'label'     => 'Border Radius',
			'selectors' => [
				'{{WRAPPER}} .'.$this->product_icon.' a' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
			],
		]
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
		$slug.'_style_hover',
		[
			'label' => __( 'Hover', 'anant-addons-for-elementor' ),

		]
		);

		$this->add_control(
		$slug.'_before_bg_color_hover',
		[
			'label'     => __( 'Background Color', 'anant-addons-for-elementor' ),
			'type'      => Controls_Manager::COLOR,
			'selectors' => [
				'{{WRAPPER}} .'.$this->product_icon.' a:before' => 'background-color: {{VALUE}}',
			],
			'condition' => [
				'template_style' => ['layout_1']
			]
		]
		);

		$this->add_control(
		$slug.'_color_hover',
		[
			'label'     => __( 'Color', 'anant-addons-for-elementor' ),
			'type'      => Controls_Manager::COLOR,
			'selectors' => [
				'{{WRAPPER}} .'.$this->product_icon.' a:hover i' => 'color: {{VALUE}}',
			],
		]
		);

		anant_border_control(
		$this,
		[
			'name'     => $slug.'_border_type_hover',
			'label'    => 'Border Type',
			'selector' => '{{WRAPPER}} .'.$this->product_icon.':hover a' ,
		]
		);

		anant_border_radius_control(
		$this,
		[
			'key'       => $slug.'_border_radius_hover',
			'label'     => 'Border Radius',
			'selectors' => [
				'{{WRAPPER}} .'.$this->product_icon.':hover a' =>  'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				'{{WRAPPER}} .'.$this->product_icon.' a:before' =>  'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
			],
		]
		);

		$this->end_controls_tab(); 
		$this->end_controls_tabs(); 
		$this->end_controls_section();
		// end item icon

		// styles tooltip
		$this->start_controls_section(
		'section_item_tooltip_style',
		[
			'label'     => __( 'Tooltip Settings', 'anant-addons-for-elementor' ),
			'tab'       => Controls_Manager::TAB_STYLE,
		]
		);
		$slug = 'product_tooltip';

		$this->add_control(
		$slug.'_color',
		[
			'label'     => __( 'Color', 'anant-addons-for-elementor' ),
			'type'      => Controls_Manager::COLOR,
			'selectors' => [
				'{{WRAPPER}}  .'.$this->product_icon.' a .ant-tooltip' => 'color: {{VALUE}}',
			],
		]
		);

		$this->add_control(
		$slug.'_bg_color',
		[
			'label'     => __( 'Background Color', 'anant-addons-for-elementor' ),
			'type'      => Controls_Manager::COLOR,
			'selectors' => [
				'{{WRAPPER}}  .'.$this->product_icon.' a .ant-tooltip' => 'background-color: {{VALUE}}',
				'{{WRAPPER}}  .'.$this->product_icon.' a .ant-tooltip::after' => 'background-color: {{VALUE}}',
			],
		]
		);

		anant_typography_control(
		$this,
		[
			'name'     => $slug.'_typography',
			'label'    => 'Typography',
			'selector' => '{{WRAPPER}}  .'.$this->product_icon.' a .ant-tooltip',
		]
		);

		$this->add_responsive_control(
		$slug.'_spacing',
		[
			'label'           => __( 'Cart Size', 'anant-addons-for-elementor' ),
			'type'            => Controls_Manager::SLIDER,
			'size_units'      => [ 'px' ],
			'range'           => [
				'px' => [
					'min' => 0,
					'max' => 20,
				],
			],
			'devices'         => [ 'desktop', 'tablet', 'mobile' ],
			'desktop_default' => [
				'size' => '',
				'unit' => 'px',
			],
			'tablet_default'  => [
				'size' => '',
				'unit' => 'px',
			],
			'mobile_default'  => [
				'size' => '',
				'unit' => 'px',
			],
			'selectors'       => [
				'{{WRAPPER}} .'.$this->product_icon.' a .ant-tooltip::after' => 'width: {{SIZE}}{{UNIT}}; height: {{SIZE}}{{UNIT}};',
			],
		]
		);

		anant_border_radius_control(
		$this,
		[
			'key'       => $slug.'_border_radius',
			'label'     => 'Border Radius',
			'selectors' => [
				'{{WRAPPER}} .'.$this->product_icon.' a .ant-tooltip' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
			],
		]
		);
		$this->add_responsive_control(
			$slug.'_padding',
		[
			'label'     => esc_html__('Padding', 'anant-addons-for-elementor'),
			'type' => Controls_Manager::DIMENSIONS,
			'size_units' => [ 'px', '%', 'em' ],
			'selectors' => [
				'{{WRAPPER}} .'.$this->product_icon.' a .ant-tooltip' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
			],
		]
		);
		$this->end_controls_section();
		// style tooltip ends

		// style sale label 
		$this->start_controls_section(
			'section_item_label_settings',
			[
				'label' => __( 'Sale Tag Settings', 'anant-addons-for-elementor' ),
				'tab'   => Controls_Manager::TAB_STYLE, 
			]
		);

		$slug = 'product_label';
		
		$this->add_control(
			$slug.'_color',
			[
				'label'     => __( 'Color', 'anant-addons-for-elementor' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}}  .'.$this->product_tag.' span' => 'color: {{VALUE}}',
				],
			]
		);

		$this->add_control(
			$slug.'_bg_color',
			[
				'label'     => __( 'Background Color', 'anant-addons-for-elementor' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}}  .'.$this->product_tag.' span' => 'background-color: {{VALUE}}',
				],
			]
		);

		anant_typography_control(
			$this,
			[
				'name'     => $slug.'_typography',
				'label'    => 'Typography',
				'selector' => '{{WRAPPER}}  .'.$this->product_tag.' span',
			]
		);

		anant_border_control(
			$this,
			[
				'name'     => $slug.'_border_type',
				'label'    => 'Border Type',
				'selector' => '{{WRAPPER}} .'.$this->product_tag.' span',
			]
		);

		anant_border_radius_control(
			$this,
			[
				'key'       => $slug.'_border_radius',
				'label'     => 'Border Radius',
				'selectors' => [
					'{{WRAPPER}} .'.$this->product_tag.' span' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			$slug.'_padding',
			[
				'label'     => esc_html__('Padding', 'anant-addons-for-elementor'),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .'.$this->product_tag.' span' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			$slug.'_margin',
			[
				'label'     => esc_html__('Margin', 'anant-addons-for-elementor'),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .'.$this->product_tag.' span' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->end_controls_section();
		// style sale label ends

		// styles item title
		$this->start_controls_section(
		'section_item_title_style',
		[
			'label'     => __( 'Title Settings', 'anant-addons-for-elementor' ),
			'tab'       => Controls_Manager::TAB_STYLE,
		]
		);

		$slug = 'product_title';

		$this->add_responsive_control(
		$slug.'_alignment',
		[
			'label'     => __( 'Alignment', 'anant-addons-for-elementor' ),
			'type'      => Controls_Manager::CHOOSE,
			'options'   => [
				'left' => [
					'title' => __( 'Left', 'anant-addons-for-elementor' ),
					'icon'  => 'eicon-text-align-left',
				],
				'center' => [
					'title' => __( 'Center', 'anant-addons-for-elementor' ),
					'icon'  => 'eicon-text-align-center',
				],
				'right' => [
					'title' => __( 'Right', 'anant-addons-for-elementor' ),
					'icon'  => 'eicon-text-align-right',
				],
			],
			'toggle'    => true,
			'selectors' => [
				'{{WRAPPER}} .'.$this->product_title => 'text-align: {{VALUE}};',
			],
		]
		);

		$this->add_control(
		$slug.'_color',
		[
			'label'     => __( 'Color', 'anant-addons-for-elementor' ),
			'type'      => Controls_Manager::COLOR,
			'selectors' => [
				'{{WRAPPER}}  .'.$this->product_title.' a' => 'color: {{VALUE}}',
			],
		]
		);

		$this->add_control(
		$slug.'_color_hover',
		[
			'label'     => __( 'Hover Color', 'anant-addons-for-elementor' ),
			'type'      => Controls_Manager::COLOR,
			'selectors' => [
				'{{WRAPPER}} .'.$this->product_class.' .'.$this->product_title.' a:hover' => 'color: {{VALUE}}',
			],
		]
		);

		anant_typography_control(
		$this,
		[
			'name'     => $slug.'_typography',
			'label'    => 'Typography',
			'selector' => '{{WRAPPER}}  .'.$this->product_title,
		]
		); 

		$this->add_responsive_control(
			$slug.'_margin',
		[
			'label'     => esc_html__('Margin', 'anant-addons-for-elementor'),
			'type' => Controls_Manager::DIMENSIONS,
			'size_units' => [ 'px', '%', 'em' ],
			'selectors' => [
				'{{WRAPPER}} .'.$this->product_title => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
			],
		]
		);

		$this->end_controls_section();
		// style item title ends

		// styles item rating
		$this->start_controls_section(
		'section_item_rating_style',
		[
			'label'     => __( 'Rating Settings', 'anant-addons-for-elementor' ),
			'tab'       => Controls_Manager::TAB_STYLE,
			'condition' => [
				'display_rating' => 'yes',
			],
		]
		);

		anant_alignment_control(
		$this,
		[
			'key'       => 'product_rating_text_align',
			'label'     => 'Alignment',
			'options'   => [
				'flex-start' => [
					'title' => __( 'Left', 'anant-addons-for-elementor' ),
					'icon'  => 'eicon-text-align-left',
				],
				'center' => [
					'title' => __( 'Center', 'anant-addons-for-elementor' ),
					'icon'  => 'eicon-text-align-center',
				],
				'flex-end' => [
					'title' => __( 'Right', 'anant-addons-for-elementor' ),
					'icon'  => 'eicon-text-align-right',
				],
			],
			'default'   => '',
			'selectors' => [
				'{{WRAPPER}} .anant-outer-wrapper  .anant-rating' => 'justify-content: {{VALUE}};',
			],
		]
		);

		$slug = 'product_rating';

		anant_color_control(
		$this,
		[
			'key'       => 'product_rating_color',
			'label'     => 'Star Color',
			'selectors' => [
				'{{WRAPPER}} .anant-outer-wrapper  .anant-rating .anant-star-rating i::before' => 'color: {{VALUE}};',
			],
		]
		);

		$this->add_responsive_control(
		$slug.'_size',
		[
			'label'           => __( 'Size', 'anant-addons-for-elementor' ),
			'type'            => Controls_Manager::SLIDER,
			'size_units'      => [ 'px', '%' ],
			'range'           => [
				'px' => [
					'min' => 0,
					'max' => 50,
				],
				'%' => [
					'min' => 0,
					'max' => 100,
				],
			],
			'default' => [
				'unit' => 'px',
				'size' => '',
			],
			'devices'         => [ 'desktop', 'tablet', 'mobile' ],
			'desktop_default' => [
				'size' => '',
				'unit' => 'px',
			],
			'tablet_default'  => [
				'size' => '',
				'unit' => 'px',
			],
			'mobile_default'  => [
				'size' => '',
				'unit' => 'px',
			],
			'condition'   => [
				'template_style' => 'product_grid',
			],
			'selectors'   => [
				'{{WRAPPER}} .anant-outer-wrapper  .anant-rating .anant-star-rating' => 'font-size: {{SIZE}}{{UNIT}};',
			],
		],
		);

		$this->add_responsive_control(
		$slug.'_spacing',
		[
			'label'           => __( 'Spacing', 'anant-addons-for-elementor' ),
			'type'            => Controls_Manager::SLIDER,
			'size_units'      => [ 'px' ],
			'range'           => [
				'px' => [
					'min' => 0,
					'max' => 20,
				],
			],
			'devices'         => [ 'desktop', 'tablet', 'mobile' ],
			'desktop_default' => [
				'size' => '',
				'unit' => 'px',
			],
			'tablet_default'  => [
				'size' => '',
				'unit' => 'px',
			],
			'mobile_default'  => [
				'size' => '',
				'unit' => 'px',
			],
			'selectors'       => [
				'{{WRAPPER}} .anant-outer-wrapper  .anant-rating .anant-star-rating i' => 'margin-right: {{SIZE}}{{UNIT}};',
			],
		]
		);

		$this->add_responsive_control(
			$slug.'_margin',
		[
			'label'     => esc_html__('Margin', 'anant-addons-for-elementor'),
			'type' => Controls_Manager::DIMENSIONS,
			'size_units' => [ 'px', '%', 'em' ],
			'selectors' => [
				'{{WRAPPER}} .anant-outer-wrapper  .anant-rating .anant-star-rating' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
			],
		]
		);

		$this->end_controls_section();
		// style item rating ends

		// styles item price
		$this->start_controls_section(
		'section_item_price_style',
		[
			'label'     => __( 'Price Settings', 'anant-addons-for-elementor' ),
			'tab'       => Controls_Manager::TAB_STYLE,
			'condition' => [
				'display_price' => 'yes',
			],
		]
		);


		$slug = 'product_price';

		$this->add_responsive_control(
		$slug.'_alignment',
		[
			'label'     => __( 'Alignment', 'anant-addons-for-elementor' ),
			'type'      => Controls_Manager::CHOOSE,
			'options'   => [
				'left' => [
					'title' => __( 'Left', 'anant-addons-for-elementor' ),
					'icon'  => 'eicon-text-align-left',
				],
				'center' => [
					'title' => __( 'Center', 'anant-addons-for-elementor' ),
					'icon'  => 'eicon-text-align-center',
				],
				'right' => [
					'title' => __( 'Right', 'anant-addons-for-elementor' ),
					'icon'  => 'eicon-text-align-right',
				],
			],
			'toggle'    => true,
			'selectors' => [
				'{{WRAPPER}} .'.$this->product_price => 'text-align: {{VALUE}};',
			],
		]
		);

		$this->add_control(
		$slug.'_ragular_heading',
		[
			'label' => esc_html__( 'Ragular', 'anant-addons-for-elementor' ),
			'type' => \Elementor\Controls_Manager::HEADING,
		]
		);

		$this->add_control(
		$slug.'_ragular_color',
		[
			'label'     => __( 'Color', 'anant-addons-for-elementor' ),
			'type'      => Controls_Manager::COLOR,
			'selectors' => [
				'{{WRAPPER}}  .'.$this->product_price.'' => 'color: {{VALUE}}',
				'{{WRAPPER}}  .'.$this->product_price.' del bdi' => 'color: {{VALUE}}',
			],
		]
		);

		anant_typography_control(
		$this,
		[
			'name'     => $slug.'_ragular_typography',
			'label'    => 'Typography',
			'selector' => '{{WRAPPER}}  .'.$this->product_price.' bdi',
		]
		); 

		$this->add_control(
		$slug.'_sale_heading',
		[
			'label' => esc_html__( 'Sale ', 'anant-addons-for-elementor' ),
			'type' => \Elementor\Controls_Manager::HEADING,
			'separator' => 'before',
		]
		);

		$this->add_control(
		$slug.'_sale_color',
		[
			'label'     => __( 'Color', 'anant-addons-for-elementor' ),
			'type'      => Controls_Manager::COLOR,
			'selectors' => [
				'{{WRAPPER}}  .'.$this->product_price.' ins bdi' => 'color: {{VALUE}}',
			],
		]
		);

		anant_typography_control(
		$this,
		[
			'name'     => $slug.'_sale_typography',
			'label'    => 'Typography',
			'selector' => '{{WRAPPER}}  .'.$this->product_price.' ins bdi',
		]
		);

		$this->add_responsive_control(
			$slug.'_margin',
		[
			'label'     => esc_html__('Margin', 'anant-addons-for-elementor'),
			'type' => Controls_Manager::DIMENSIONS,
			'size_units' => [ 'px', '%', 'em' ],
			'selectors' => [
				'{{WRAPPER}} .'.$this->product_price.' bdi'  => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
			],
		]
		);

		$this->end_controls_section();
		// style item price ends

		// styles item add to cart button
		$this->start_controls_section(
		'section_item_add_to_cart_btn_style',
		[
			'label'     => __( 'Button Settings', 'anant-addons-for-elementor' ),
			'tab'       => Controls_Manager::TAB_STYLE,
			'condition' => [
				'display_add_to_cart_button' => 'yes',
			],
		]
		);

		$slug = 'product_btn';
		$this->add_responsive_control(
		$slug.'_alignment',
		[
			'label'     => __( 'Alignment', 'anant-addons-for-elementor' ),
			'type'      => Controls_Manager::CHOOSE,
			'options'   => [
				'start' => [
					'title' => __( 'Left', 'anant-addons-for-elementor' ),
					'icon'  => 'eicon-text-align-left',
				],
				'center' => [
					'title' => __( 'Center', 'anant-addons-for-elementor' ),
					'icon'  => 'eicon-text-align-center',
				],
				'end' => [
					'title' => __( 'Right', 'anant-addons-for-elementor' ),
					'icon'  => 'eicon-text-align-right',
				],
			],
			'toggle'    => true,
			'selectors' => [
				'{{WRAPPER}}  .'.$this->product_btn => 'text-align: {{VALUE}};',
				
			]
		],
		);
		$this->start_controls_tabs( $slug.'_tabs' );

		$this->start_controls_tab(
		$slug.'_normal_style',
		[
			'label' => __( 'Normal', 'anant-addons-for-elementor' ),
		]
		);

		$this->add_control(
		$slug.'_color',
		[
			'label'     => __( 'Color', 'anant-addons-for-elementor' ),
			'type'      => Controls_Manager::COLOR,
			'selectors' => [
				'{{WRAPPER}}  .'.$this->product_btn.' a' => 'color: {{VALUE}}',
			],
		]
		);

		$this->add_control(
		$slug.'_bg_color',
		[
			'label'     => __( 'Background Color', 'anant-addons-for-elementor' ),
			'type'      => Controls_Manager::COLOR,
			'selectors' => [
				'{{WRAPPER}}  .'.$this->product_btn.' a' => 'background-color: {{VALUE}}',
			],
		]
		);

		anant_border_control(
		$this,
		[
			'name'     => $slug.'_border_type',
			'label'    => 'Border Type',
			'selector' => '{{WRAPPER}} .'.$this->product_btn.' a',
		]
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
		$slug.'_style_hover',
		[
			'label' => __( 'Hover', 'anant-addons-for-elementor' ),

		]
		);

		$this->add_control(
		$slug.'_color_hover',
		[
			'label'     => __( 'Color', 'anant-addons-for-elementor' ),
			'type'      => Controls_Manager::COLOR,
			'selectors' => [
				'{{WRAPPER}} .'.$this->product_btn.' a:hover' => 'color: {{VALUE}}',
			],
		]
		);

		$this->add_control(
		$slug.'_bg_color_hover',
		[
			'label'     => __( 'Background Color', 'anant-addons-for-elementor' ),
			'type'      => Controls_Manager::COLOR,
			'selectors' => [
				'{{WRAPPER}} .'.$this->product_btn.' a:after' => 'background-color: {{VALUE}}',
				'{{WRAPPER}} .'.$this->product_btn.' a:before' => 'background-color: {{VALUE}}',
			],
		]
		);

		anant_border_control(
		$this,
		[
			'name'     => $slug.'_border_type_hover',
			'label'    => 'Border Type',
			'selector' => '{{WRAPPER}} .'.$this->product_btn.' a:hover',
		]
		);

		$this->end_controls_tab(); 
		$this->end_controls_tabs(); 

		$this->add_control(
		'hr',
		[
			'type' => Controls_Manager::DIVIDER,
		]
		);

		anant_typography_control(
		$this,
		[
			'name'     => $slug.'_typography',
			'label'    => 'Typography',
			'selector' => '{{WRAPPER}}  .'.$this->product_btn.' a',
		]
		);

		anant_border_radius_control(
		$this,
		[
			'key'       => $slug.'_border_radius',
			'label'     => 'Border Radius',
			'selectors' => [
				'{{WRAPPER}} .'.$this->product_btn.' a' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
			],
		]
		);
		
		$this->add_responsive_control(
			$slug.'_padding',
		[
			'label'     => esc_html__('Padding', 'anant-addons-for-elementor'),
			'type' => Controls_Manager::DIMENSIONS,
			'size_units' => [ 'px', '%', 'em' ],
			'selectors' => [
				'{{WRAPPER}} .'.$this->product_btn.' a' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
			],
		]
		);

		$this->add_responsive_control(
			$slug.'_margin',
			[
				'label'     => esc_html__('Margin', 'anant-addons-for-elementor'),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .'.$this->product_btn.' a' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		anant_box_shadow_control(
		$this,
		[
			'key'      => $slug.'_box_shadow',
			'label'    => 'Box Shadow',
			'selector' => '{{WRAPPER}}  .'.$this->product_btn.' a',
		]
		);

		$this->end_controls_section();
		// style item add to cart btn ends

		// style item pagination
		$this->start_controls_section(
			'pagination_style',
			[
				'label' => __( 'Pagination Settings', 'anant-addons-for-elementor' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);

		$slug = 'pagination';
		$this->start_controls_tabs( $slug.'_style_tabs' );
		$this->start_controls_tab(
			$slug.'_normal_style',
			[
				'label' => __( 'Normal', 'anant-addons-for-elementor' ),

			]
		);
		anant_color_control(
			$this,
			[
				'key'       => $slug.'_background_color',
				'label'     => 'Background Color',
				'selectors' => [
					'{{WRAPPER}} .anant-navigation li .page-numbers' => 'background-color: {{VALUE}};',
				],
			]
		);

		anant_color_control(
			$this,
			[
				'key'       => $slug.'_color',
				'label'     => 'Color',
				'selectors' => [
					'{{WRAPPER}} .anant-navigation li .page-numbers' => 'color: {{VALUE}};',
				],
			]
		);

		anant_border_control(
			$this,
			[
				'name'     => $slug.'_border_type',
				'label'    => 'Border Type',
				'selector' => '{{WRAPPER}} .anant-navigation li .page-numbers',
			]
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
			$slug.'_hover_style',
			[
				'label' => __( 'Hover', 'anant-addons-for-elementor' ),

			]
		);

		anant_color_control(
			$this,
			[
				'key'       => $slug.'_background_color_hover',
				'label'     => 'Background Color',
				'selectors' => [
					'{{WRAPPER}} .anant-navigation li .page-numbers:hover' => 'background-color: {{VALUE}};',
				],
			]
		);

		anant_color_control(
			$this,
			[
				'key'       => $slug.'_color_hover',
				'label'     => 'Color',
				'selectors' => [
					'{{WRAPPER}} .anant-navigation li .page-numbers:hover' => 'color: {{VALUE}};',
				],
			]
		);

		anant_border_control(
			$this,
			[
				'name'     => $slug.'_border_type_hover',
				'label'    => 'Border Type',
				'selector' => '{{WRAPPER}} .anant-navigation li .page-numbers:hover',
			]
		);
		$this->end_controls_tab();
		$this->end_controls_tabs();

		anant_border_radius_control(
			$this,
			[
				'key'       => $slug.'_border_radius',
				'label'     => 'Border Radius',
				'selectors' => [
					'{{WRAPPER}} .anant-navigation li .page-numbers' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
				'separator' => 'before',
			]
		);

		anant_typography_control(
			$this,
			[
				'name'     =>  $slug.'_typography',
				'label'    => 'Typography',
				'selector' => '{{WRAPPER}} .anant-navigation li .page-numbers',
			]
		);
		
		$this->add_responsive_control(
			$slug.'_padding',
			[
				'label'     => esc_html__('Padding', 'anant-addons-for-elementor'),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .anant-navigation li .page-numbers' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			$slug.'_margin',
			[
				'label'     => esc_html__('Margin', 'anant-addons-for-elementor'),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .anant-navigation li .page-numbers' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		anant_box_shadow_control(
			$this,
			[
				'key'      => $slug.'_box_shadow_hover',
				'label'    => 'Box Shadow',
				'selector' => '{{WRAPPER}} .anant-navigation li .page-numbers',
			]
		);
		$this->end_controls_section();
		// style item pagination ends
	}
}