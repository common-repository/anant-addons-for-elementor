<?php // phpcs:disable Squiz.PHP.CommentedOutCode.Found
namespace AnantAddons;

use Elementor\Controls_Manager;
use Elementor\Group_Control_Background;
use Elementor\Plugin;

class AnantProductArchiveGrid extends \Elementor\Widget_Base {

	private $product_class = 'anant-product-archive-item';
	private $product_img = 'anant-product-archive-image';
	private $product_title = 'anant-product-archive-title';
	private $product_price = 'anant-product-archive-price';
	private $product_btn = 'anant-product-archive-button';
	private $product_icon = 'anant-product-archive-icon';
	private $product_tag = 'anant-product-archive-tag';
	private $product_rating = 'anant-product-archive-rating';
	private $product_category = 'anant-product-archive-category';

	public function get_name() {
		return 'anant-product-archive-grid';
	}

	public function get_title() {
		return __( 'Product Archive', 'anant-addons-for-elementor' );
	}

	public function get_categories() {
		return [ 'anant-sng-woo-elements' ];
	}

	public function get_icon() {
		return 'ant-icon eicon-products-archive';
	}

	public function get_style_depends() {
		return [
			'anant-widget-css',
			'anant-woo-widgets-css',
		];
	}

	public function get_script_depends() {
		return [
			'anant-woo-js',
		];
	}

	public function get_keywords() {
		return [
			'product archive',
			'products archive',
			'anant addons',
			'archive',
			 
			'woo',
		];
	}

	protected function render() {

		$settings       = $this->get_settings_for_display();
		$paged = (get_query_var('paged')) ? absint( get_query_var( 'paged' ) ) : (isset($_GET['paged']) ? absint($_GET['paged']) : 1);
		$args           = ['paged' => $paged];
		$args['status'] = 'publish';
		$args['limit']  = 10;

		if ( isset( $settings['posts_per_page'] ) && intval( $settings['posts_per_page'] ) > 0 ) {
			$args['limit'] = $settings['posts_per_page'];
		}
		
		// phpcs:ignore WordPress.PHP.StrictComparisons.LooseComparison
		if ( isset( $settings['posts_per_page'] ) && intval( $settings['posts_per_page'] ) == -1 ) {
			$args['limit'] = $settings['posts_per_page'];
		}

		$CURRENT_URL = $_SERVER['REQUEST_URI'];

		if ( ( class_exists( "\Elementor\Plugin" ) && \Elementor\Plugin::$instance->editor->is_edit_mode() ) ||  ( class_exists( "\Elementor\Plugin" ) && isset( $_GET['preview'] ) && isset( $_GET['preview_id'] ) && $_GET['preview'] == true ) || ( strpos($CURRENT_URL, 'anant-header-footer') !== false && get_post_type() == 'anant-header-footer' ) ) {
			$post_id = get_the_ID();
        	$archive_type 	= Plugin::$instance->documents->get($post_id, false)->get_settings('demo_archive_select');
			$cat_archive 	= Plugin::$instance->documents->get($post_id, false)->get_settings('demo_product_cat_archive_select');
			$tag_archive 	= Plugin::$instance->documents->get($post_id, false)->get_settings('demo_product_tag_archive_select');
			// $search_query 	= Plugin::$instance->documents->get($post_id, false)->get_settings('demo_search_result_archive_select'); 
			switch ($archive_type) {
				case 'product-category':
					$args['tax_query'] =  array(
						array(
							'taxonomy' => 'product_cat',
							'field' => 'slug',
							'terms' => $cat_archive,
						),
					);
				break;
			
				case 'product-tag':
					$args['tax_query'] =  array(
						array(
							'taxonomy' => 'product_tag',
							'field' => 'slug',
							'terms' => $tag_archive,
						),
					);
				break;
			
				// case 'search':
				// 	$args = array(
				// 		's'              => $search_query,
				// 		'post_type'      => 'post',
				// 		'posts_per_page' => 5,
				// 		'orderby' => 'ID',
				// 		'order' => 'DESC',
				// 		'post_status' => 'publish',
				// 		'paged' => $paged
				// 	);
				// break;
			
				default:
				break;
			}
			
        }else{
			$cate = "product-category";
			$tag = "product-tag";
			$title = '';
			// Case-insensitive check
			if (is_product_category()) {
				$args['tax_query'] =  array(
					array(
						'taxonomy' => 'product_cat',
						'field' => 'id',
						'terms' => get_queried_object_id(),
					),
				);
			} else if (is_product_tag()) {
				$args['tax_query'] =  array(
					array(
						'taxonomy' => 'product_tag',
						'field' => 'id',
						'terms' => get_queried_object_id(),
					),
				);
			}  
			// else if (is_search()) {
			// 	$search_query = get_search_query(); // Get the search query
			// 	$args = array(
			// 		's'              => $search_query,
			// 		'post_type'		 => $settings['search_query_list'],
			// 		'posts_per_page' => 5,
			// 		'orderby' => 'ID',
			// 		'order' => 'DESC',
			// 		'post_status' => 'publish',
			// 		'paged' => $paged
			// 	);
			// 	$archive_type = '';
			// } 
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

		$template_style = $settings['template_style'];
		$is_best_rated = false;
		$best_rated_count = false;
		$display_title = $settings['display_title'];
		$product_design = $settings['product_design'];

		$display_rating = array_key_exists('display_rating', $settings) ? $settings['display_rating'] : false;
		$display_category = array_key_exists('display_category', $settings) && $settings['display_category'] === 'yes' ? true : false;
		$display_price  = array_key_exists('display_price', $settings) ? $settings['display_price'] : false;
		$on_sales_ids = wc_get_product_ids_on_sale();
		$selected_cats = false;
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

		$thumbnail_size_key = 'thumbnail_size';
		$swiper_div_tabs = false;
		$category_class = '';
		$hide = false;
		$cat_details = [];
		$counter     = 0;

		if ( $cat_details ) {
			$args['category'] = [
				$cat_details['slug']
			];
		}

		$pagination_type = $settings['pagination_type'];
		$args['paginate'] = $pagination_type !== 'none';
		
		$products_result = wc_get_products( $args );
		
		if ($args['paginate']) {
			$products = $products_result->products;
			$max_num_pages = $products_result->max_num_pages;
		} else {
			$products = $products_result;
			$max_num_pages = 1; // Default to 1 when pagination is not used
		}
		
		require ANANT_PATH . 'inc/templates/style-1/product-grid-template.php';
		
		if ('previous/next'=== $settings['pagination_type']) {
			$this->anant_pagi_previous_next( $products_result );
		}
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
			echo "<li><a href='". esc_url($prev_link) ."' class='page-numbers anant-pagi-pre-btn'>Previous</a></li>";
		}
	
		// Next link
		$next_link = $this->custom_next_posts_page_link( $paged, $max );
		if ( $next_link ) {
			echo "<li><a href='". esc_url($next_link) ."' class='page-numbers'>Next</a></li>";
		}
	
		echo '</ul></div>' . "\n";
	}

	// phpcs:ignore PSR2.Methods.MethodDeclaration.Underscore
	protected function register_controls() {
		$this->start_controls_section(
			'query_configuration',
			[
				'label' => __( 'Content Settings', 'anant-addons-for-elementor' ),
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

		anant_switcher_control(
			$this,
			[
				'key'       => 'latest_product',
				'label'     => 'Latest Products First',
				'on_label'  => 'Yes',
				'off_label' => 'No',

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
				'placeholder' => 'Default is 4',
				'min'         => 1,
				'default'     => 4,
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
				'size_units'      => [ 'px', '%' ],
				'range'           => [
					'px' => [
						'min' => 15,
						'max' => 100,
					],
					'%' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'placeholder' => '',
				'default' => [
					'unit' => 'px',
					'size' => '30',
				],
				'devices'         => [ 'desktop', 'tablet', 'mobile' ],
				'desktop_default' => [
					'size' => '30',
					'unit' => 'px',
				],
				'tablet_default'  => [
					'size' => '30',
					'unit' => 'px',
				],
				'mobile_default'  => [
					'size' => '30',
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
				'size_units'      => [ 'px', '%' ],
				'range'           => [
					'px' => [
						'min' => 15,
						'max' => 100,
					],
					'%' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'placeholder' => '',
				'default' => [
					'unit' => 'px',
					'size' => '30',
				],
				'devices'         => [ 'desktop', 'tablet', 'mobile' ],
				'desktop_default' => [
					'size' => '30',
					'unit' => 'px',
				],
				'tablet_default'  => [
					'size' => '30',
					'unit' => 'px',
				],
				'mobile_default'  => [
					'size' => '30',
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
				'label' => __( 'Pagination Settings', 'anant-addons-for-elementor' ),
				'tab'   => Controls_Manager::TAB_CONTENT, 
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
				'default' => 'none',
				'multiple'    => false,
			]
		);

		$this->add_control(
			'anant_archive_product_pro_notice',
			[
				'raw' => 'Only Available in <a href="https://anantaddons.com/" target="_blank">Pro Version!</a>',
				'type' => \Elementor\Controls_Manager::RAW_HTML,
				'content_classes' => 'anant-pro-notice',
				'condition' => [ 
                    'pagination_type!' => ['previous/next', 'none'],
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
				'default'   => '',
				'selectors' => [
					'{{WRAPPER}} .navigation' => 'justify-content: {{VALUE}}',
				],
				'condition'   => [
					'pagination_type!' => 'none',
				],
			]
		); 

		$this->end_controls_section();

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
		
		$this->add_responsive_control(
			$slug.'_margin',
			[
				'label'     => esc_html__('Margin', 'anant-addons-for-elementor'),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .'.$this->product_class => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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

		anant_box_shadow_control(
			$this,
			[
				'key'      => $slug.'_box_shadow',
				'label'    => 'Box Shadow',
				'selector' => '{{WRAPPER}}  .'.$this->product_img.' img',
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
					'{{WRAPPER}}  .'.$this->product_icon.' a i' => 'color: {{VALUE}}',
				],
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
			$slug.'_color_hover',
			[
				'label'     => __( 'Color', 'anant-addons-for-elementor' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .'.$this->product_icon.' a:hover i' => 'color: {{VALUE}}',
				],
			]
		);

		$this->add_control(
			$slug.'_bg_color_hover',
			[
				'label'     => __( 'Background Color', 'anant-addons-for-elementor' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .'.$this->product_icon.' a:hover' => 'background-color: {{VALUE}}',
				],
				'condition' => [
					'template_style!' => ['layout_1', 'layout_2', 'layout_3', 'layout_4', 'layout_5']
				]
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
					'template_style' => ['layout_1', 'layout_2', 'layout_3', 'layout_4', 'layout_5']
				]
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

		$this->add_responsive_control(
			$slug.'_margin',
			[
				'label'     => esc_html__('Margin', 'anant-addons-for-elementor'),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .'.$this->product_icon.' a' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
				'separator' => 'before',
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

		// styles category
		$this->start_controls_section(
			'section_category_style',
			[
				'label'     => __( 'Category Settings', 'anant-addons-for-elementor' ),
				'tab'       => Controls_Manager::TAB_STYLE,
			]
		);

		$slug = 'product_categroy';
		anant_alignment_control(
			$this,
			[
				'key'       => $slug.'_text_align',
				'label'     => 'Alignment',
				'options'   => [
					'left'   => [
						'title' => __( 'Left', 'anant-addons-for-elementor' ),
						'icon'  => 'eicon-text-align-left',
					],
					'center' => [
						'title' => __( 'Center', 'anant-addons-for-elementor' ),
						'icon'  => 'eicon-text-align-center',
					],
					'right'  => [
						'title' => __( 'Right', 'anant-addons-for-elementor' ),
						'icon'  => 'eicon-text-align-right',
					],
				],
				'default'   => '',
				'selectors' => [
					'{{WRAPPER}} .anant_title' => 'text-align: {{VALUE}}',
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

		anant_color_control(
			$this,
			[
				'key'       => $slug.'_text_color',
				'label'     => 'Color',
				'selectors' => [
					'{{WRAPPER}} a.'.$this->product_category => 'color: {{VALUE}};',
				],
			]
		);

		anant_color_control(
			$this,
			[
				'key'       => $slug.'_bg_color',
				'label'     => 'Background Color',
				'selectors' => [
					'{{WRAPPER}} a.'.$this->product_category => 'background-color: {{VALUE}};',
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

		anant_color_control(
			$this,
			[
				'key'       => $slug.'_text_color_hover',
				'label'     => 'Color',
				'selectors' => [
					'{{WRAPPER}} a.'.$this->product_category.':hover' => 'color: {{VALUE}};',
				],
			]
		);

		anant_color_control(
			$this,
			[
				'key'       => $slug.'_bg_color_hover',
				'label'     => 'Background Color',
				'selectors' => [
					'{{WRAPPER}} a.'.$this->product_category.':hover' => 'background-color: {{VALUE}};',
				],
			]
		);

		$this->end_controls_tab();
		$this->end_controls_tabs();

		$this->add_control('product_category_style_divider',['type' => \Elementor\Controls_Manager::DIVIDER,]);

		anant_typography_control(
			$this,
			[
				'name'     => $slug.'_typography',
				'label'    => 'Typography',
				'selector' => '{{WRAPPER}} a.'.$this->product_category,
			]
		);

		anant_border_control(
			$this,
			[
				'name'     => $slug.'_border_type',
				'label'    => 'Border Type',
				'selector' => '{{WRAPPER}} a.'.$this->product_category,
			]
		);

		anant_border_radius_control(
			$this,
			[
				'key'       => $slug.'_border_radius',
				'label'     => 'Border Radius',
				'selectors' => [
					'{{WRAPPER}} a.'.$this->product_category => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
					'{{WRAPPER}} a.'.$this->product_category => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
					'{{WRAPPER}} a.'.$this->product_category => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		anant_box_shadow_control(
			$this,
			[
				'key'      => $slug.'_box_shadow',
				'label'    => 'Box Shadow',
				'selector' => '{{WRAPPER}} a.'.$this->product_category,
			]
		);
		$this->end_controls_section();
		// style category ends

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
					'{{WRAPPER}} .'.$this->product_title.' a:hover' => 'color: {{VALUE}}',
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

		$slug = 'product_rating';

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
					'{{WRAPPER}} .anant-outer-wrapper .anant-rating' => 'justify-content: {{VALUE}};',
				],
			]
		);

		anant_color_control(
			$this,
			[
				'key'       => 'product_rating_color',
				'label'     => 'Color',
				'selectors' => [
					'{{WRAPPER}} .'.$this->product_rating.' .anant-star-rating i' => 'color: {{VALUE}};',
				],
			]
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
					'{{WRAPPER}} .'.$this->product_rating.' .anant-star-rating i' => 'margin-right: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'product_rating_margin',
			[
				'label'     => esc_html__('Margin', 'anant-addons-for-elementor'),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .'.$this->product_rating.' .anant-star-rating' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
					'{{WRAPPER}}  .'.$this->product_price.' del bdi' => 'color: {{VALUE}}',
				],
			]
		);
	
		anant_typography_control(
		$this,
		[
			'name'     => $slug.'_ragular_typography',
			'label'    => 'Typography',
			'selector' => '{{WRAPPER}}  .'.$this->product_price.' del bdi',
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
				'{{WRAPPER}}  .'.$this->product_price.'' => 'color: {{VALUE}}',
				'{{WRAPPER}}  .'.$this->product_price.' ins bdi' => 'color: {{VALUE}}',
			],
		]
		);

		anant_typography_control(
		$this,
		[
			'name'     => $slug.'_sale_typography',
			'label'    => 'Typography',
			'selector' => '{{WRAPPER}}  .'.$this->product_price.' bdi',
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
					'{{WRAPPER}} .two .'.$this->product_btn.' a:hover, {{WRAPPER}} .three .'.$this->product_btn.' a:hover, {{WRAPPER}} .five .'.$this->product_btn.' a:hover, {{WRAPPER}} .six .'.$this->product_btn.' a:hover, {{WRAPPER}} .seven .'.$this->product_btn.' a:hover, {{WRAPPER}} .eight .'.$this->product_btn.' a:hover, {{WRAPPER}} .nine .'.$this->product_btn.' a:hover, {{WRAPPER}} .ten .'.$this->product_btn.' a:hover' => 'background-color: {{VALUE}}', 
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

		$this->add_control( $slug.'_hr', [ 'type' => Controls_Manager::DIVIDER, ] );

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

	}
}