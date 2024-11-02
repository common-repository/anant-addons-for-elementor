<?php // phpcs:disable Squiz.PHP.CommentedOutCode.Found
namespace AnantAddons;

use Elementor\Controls_Manager;
use Elementor\Group_Control_Background;

class AnantProductCategoryTabWidget extends \Elementor\Widget_Base {

	private $product_class = 'anant-product-category-tab-item';
	private $product_img = 'anant-product-category-tab-image';
	private $product_title = 'anant-product-category-tab-title';
	private $product_price = 'anant-product-category-tab-price';
	private $product_btn = 'anant-product-category-tab-button';
	private $product_icon = 'anant-product-category-tab-icon';
	private $product_tag = 'anant-product-category-tab-tag';
	private $product_rating = 'anant-product-category-tab-rating';
	private $product_category = 'anant-product-category-tab-category';

    /** Widget Name * */
    public function get_name() {
        return 'anant-product-category-tab';
    }

    /** Widget Title * */
    public function get_title() {
        return esc_html__('Product Category Tab', 'anant-addons-for-elementor');
    }

    /** Widget Icon * */
    public function get_icon() {
        return 'ant-icon eicon-tabs';
    }

    /** Categories * */
    public function get_categories() {
        return ['anant-woo-elements'];
    }

	public function get_keywords() {
		return [
			'product category tab',
			'category filter',
			'anant addons',
			'',
			'woo',
		];
	}

    /** Render Layout * */
    protected function render() {
		$settings = $this->get_settings_for_display();
		$args = [];
		$args['status'] = 'publish';
		$args['limit']  = 10;

		$template_style = $settings['template_style'];

		if ( isset( $settings['slider_tab_posts_per_page'] ) && intval( $settings['slider_tab_posts_per_page'] ) > 0 ) {
			$args['limit'] = $settings['slider_tab_posts_per_page'];
		}
		// phpcs:ignore WordPress.PHP.StrictComparisons.LooseComparison
		if ( isset( $settings['slider_tab_posts_per_page'] ) && intval( $settings['slider_tab_posts_per_page'] ) == -1 ) {
			$args['limit'] = $settings['posts_per_page'];
		}


		if ( isset( $settings['slider_tab_include_featured'] ) && ! empty( $settings['slider_tab_include_featured'] ) && $settings['slider_tab_include_featured'] === 'yes' ) {
			$args['featured'] = true;
		}
		if ( isset( $settings['slider_tab_latest_product'] ) && ! empty( $settings['slider_tab_latest_product'] ) && $settings['slider_tab_latest_product'] === 'yes' ) {
			$args['orderby'] = 'date';
			$args['order']   = 'DESC';
		}

		$title = '';

		$this->add_render_attribute( 'wrapper', 'class', 'anant-outer-wrapper' );
		$this->add_render_attribute( 'wrapper', 'data-wid', $this->get_id() );

		$counter     = 0;


		//slider_tab_
		$is_best_rated = $settings['slider_tab_only_best_rated_product'];
		$best_rated_count = $settings['slider_tab_best_rated_count'];
		$display_title = $settings['slider_tab_display_title'];
		$product_design = $settings['product_design'];


		$display_rating = array_key_exists('slider_tab_display_rating', $settings) ? $settings['slider_tab_display_rating'] : false;
		$display_category = array_key_exists('display_category', $settings) && $settings['display_category'] === 'yes' ? true : false;
		$display_price  = array_key_exists('slider_tab_display_price', $settings)  ? $settings['slider_tab_display_price'] : false;
		$display_image  = array_key_exists('slider_tab_display_image', $settings) ? $settings['slider_tab_display_image'] : false;
		$on_sales_ids = wc_get_product_ids_on_sale();
		$only_on_sale = false;
		$only_best_sale = false;
		$best_sale_count = 0;
		$show_cart_button = true;
		if (isset($settings['slider_tab_only_on_sale']) && !empty($settings['slider_tab_only_on_sale']) && $settings['slider_tab_only_on_sale'] === 'yes') {
			$only_on_sale = true;
		}
		if (isset($settings['slider_tab_display_add_to_cart_button']) && empty($settings['slider_tab_display_add_to_cart_button']) && $settings['slider_tab_display_add_to_cart_button'] !== 'yes') {
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

		if (isset($settings['slider_tab_only_best_sale']) && !empty($settings['slider_tab_only_best_sale']) && $settings['slider_tab_only_best_sale'] === 'yes') {
			$only_best_sale = true;
			if ( isset( $settings['slider_tab_best_sale_count'] ) && intval( $settings['slider_tab_best_sale_count'] ) > 0 ) {
				$best_sale_count = $settings['slider_tab_best_sale_count'];
			}
		}

		$thumbnail_size_key = 'slider_tab_thumbnail_size';
		$selected_cats = [];
		$cat = [];
		$cat_details = [];
		if ( $template_style == 'layout_1' ) {
		?>
			<div class="anant-product-tabs-grid" id="anant-product-tabs-grid-<?php echo esc_attr($this->get_id()); ?>">
				<div class="header">
				<?php
					if (!empty($settings['products_tabs'])) {
						?>
							<ul class="tabs">
								<?php $li_counter = 1; ?>
								<?php foreach ($settings['products_tabs'] as $id) : ?>
									<?php
									if( $term = get_term_by( 'id', $id, 'product_cat' ) ){
										$selected_cats[] = $term->name;
									}
									$active_class = ( $li_counter == 1 ) ? 'active' : '';
									$term = get_term($id, 'product_cat');
									if($term == NULL || $term == false){ continue; } 
									?>
									<li data-anant-cat-slug=<?php echo esc_attr($term->slug); ?> data-id="anant-<?php echo esc_attr($id) . '-' . esc_attr($this->get_id()); ?>" class="<?php echo esc_attr($active_class); ?>" >

									<?php echo esc_html($term->name); ?>

									</li>

									<?php
										$swiper_div_tabs[$id] = 'anant-'. $id. '-' . $this->get_id();
										$li_counter++;
									?>
								<?php endforeach; ?>
                    		</ul>
						<?php
					}
				?>
				</div>

				<?php $li_counter = 1;




				?>
				<?php

	if ( array_key_exists('products_tabs', $settings) && $settings['products_tabs'] != '' ) {
		foreach ($settings['products_tabs'] as $id) : ?>
			<?php
			$term = get_term($id, 'product_cat');
			if($term == NULL || $term == false){ continue; }
			$cat_id = $term->term_id;

			$cat_details['slug'] = $term->slug;

			$category_class = 'anant-'.$cat_id.'-'.$this->get_id();

			$args['category'] = $term->slug;

			$products = wc_get_products( $args );

			$hide = false;

			if ( $li_counter === 1) {
				$hide = false;
			} else {
				$hide = true;
			}

			require ANANT_PATH . 'inc/templates/style-1/product-grid-template.php';

			$li_counter++;

		endforeach;
	}

					?>


			</div>

		<?php
	}
    }

	 /** Query Arguments */
    protected function get_query_args($term_id) {
        $settings = $this->get_settings_for_display();
        $no_of_products = ( $settings['products_no_of_products']['size'] ) ? $settings['products_no_of_products']['size'] : 4;
        $orderby = ( $settings['products_orderby'] ) ? $settings['products_orderby'] : 'none';
        $order = ( $settings['products_order'] ) ? $settings['products_order'] : 'DESC';

        $args = array(
            'post_type' => 'product',
            'posts_per_page' => $no_of_products,
            'orderby' => $orderby,
            'order' => $order,
            'tax_query' => array(
                array(
                    'taxonomy' => 'product_cat',
                    'field' => 'term_id',
                    'terms' => $term_id,
                ),
            ),
        );

        return $args;
    }

	 /** Widget Controls * */
    protected function register_controls() {

        $this->start_controls_section(
                'product_query', [
            'label' => esc_html__('Content', 'anant-addons-for-elementor'),
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
			'anant_woo_category_tab_pro_notice',
			[
				'raw' => 'Only Available in <a href="https://anantaddons.com/" target="_blank">Pro Version!</a>',
				'type' => \Elementor\Controls_Manager::RAW_HTML,
				'content_classes' => 'anant-pro-notice',
				'condition' => [
                    'template_style!' => ['layout_1'],
                ],
			]
		);
        $this->add_control(
            'products_tabs', 
			[
				'label' => __('Choose Categories for Tab', 'anant-addons-for-elementor'),
				'description' => __('Drag & Drop to reorder tabs', 'anant-addons-for-elementor'),
				'type' => Selectize_Control::Selectize,
				'label_block' => true,
				'multiple' => true,
				'options' => anant_get_woo_categories(),
            ]
        );
        anant_switcher_control(
			$this,
			[
				'key'       => 'slider_tab_include_featured',
				'label'     => 'Include Featured Products',
				'on_label'  => 'Yes',
				'off_label' => 'No',

			]
		);

		anant_switcher_control(
			$this,
			[
				'key'       => 'slider_tab_only_best_rated_product',
				'label'     => 'Include Only Best Rated Products',
				'on_label'  => 'Yes',
				'off_label' => 'No',

			]
		);

		anant_number_control(
			$this,
			[
				'key'         => 'slider_tab_best_rated_count',
				'label'       => 'Rating Count',
				'placeholder' => 'Default is 0',
				'min'         => 0,
				'max'         => 5,
				'default'     => 0,
				'condition'   => [
					'slider_tab_only_best_rated_product' => 'yes',
				],
			]
		);

		anant_switcher_control(
			$this,
			[
				'key'       => 'slider_tab_only_on_sale',
				'label'     => 'Only On Sale Products',
				'on_label'  => 'Yes',
				'off_label' => 'No',

			]
		);

		anant_switcher_control(
			$this,
			[
				'key'       => 'slider_tab_only_best_sale',
				'label'     => 'Only Best Selling Products',
				'on_label'  => 'Yes',
				'off_label' => 'No',

			]
		);

		anant_switcher_control(
			$this,
			[
				'key'       => 'slider_tab_latest_product',
				'label'     => 'Latest Products First',
				'on_label'  => 'Yes',
				'off_label' => 'No',

			]
		);

		anant_number_control(
			$this,
			[
				'key'         => 'slider_tab_best_sale_count',
				'label'       => 'Selling Products Count',
				'placeholder' => 'Default is 0',
				'min'         => -1,
				'default'     => 0,
				'condition'   => [
					'slider_tab_only_best_sale' => 'yes',
				],
			]
		);

        $this->add_responsive_control(
            'align_tabs', [
				'label' => __('Tabs Alignment', 'anant-addons-for-elementor'),
				'type' => Controls_Manager::CHOOSE,
				'options' => [
					'start' => [
						'title' => __('Left', 'anant-addons-for-elementor'),
						'icon' => 'eicon-text-align-left',
					],
					'center' => [
						'title' => __('Center', 'anant-addons-for-elementor'),
						'icon' => 'eicon-text-align-center',
					],
					'end' => [
						'title' => __('Right', 'anant-addons-for-elementor'),
						'icon' => 'eicon-text-align-right',
					],
				],
				'default' => 'center',
				'toggle' => true,
				'selectors' => [
					'{{WRAPPER}} .anant-product-tabs-grid .header' => 'justify-content: {{VALUE}};',
					'{{WRAPPER}} .anant-product-tabs-grid .tabs' => 'justify-content: {{VALUE}};',
				],
            ]
        );

        $this->end_controls_section();


		$this->start_controls_section(
			'slider_tab_item_configuration',
			[
				'label' => __( 'Item Settings', 'anant-addons-for-elementor' ),
				'tab'   => Controls_Manager::TAB_CONTENT,
			]
		);

		anant_number_control(
			$this,
			[
				'key'         => 'slider_tab_posts_per_page',
				'label'       => 'Limit',
				'placeholder' => 'Default is 3',
				'min'         => 1,
				'max'         => 10,
				'default'     => 3,
			]
		);

		$this->add_responsive_control(
			'slider_tab_grid_column_count',
			[
				'label' => esc_html__( 'Grid Column Count', 'anant-addons-for-elementor' ) .' <i class="eicon-pro-icon"></i>' ,
				'type' => \Elementor\Controls_Manager::SELECT,
				'default' => '3',
				'options' => [
					'3' => esc_html__( '3', 'anant-addons-for-elementor' ),
				],
				'classes' => 'anant-pro-popup-notice',
			]
		);

		$this->add_responsive_control(
			'grid_column_gap',
			[
				'label'           => __( 'Grid Column Gap', 'anant-addons-for-elementor' ),
				'type'            => Controls_Manager::SLIDER,
				'size_units'      => [ 'px'],
				'range'           => [
					'px' => [
						'min' => 15,
						'max' => 30,
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
				'size_units'      => [ 'px'],
				'range'           => [
					'px' => [
						'min' => 15,
						'max' => 30,
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
					'key'       => 'slider_tab_display_title',
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
				'key'       => 'slider_tab_display_price',
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
				'key'       => 'slider_tab_display_rating',
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
				'key'       => 'slider_tab_display_add_to_cart_button',
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
				'name'      => 'slider_tab_thumbnail_size',
				'default'   => 'thumbnail',
			]
		);


		$this->end_controls_section();

		anant_pro_promotion_controls($this);

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
				'selectors' =>[
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
				'selectors' =>[
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
				'selectors' =>[
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
				'slider_tab_display_rating' => 'yes',
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
				'{{WRAPPER}} .anant-outer-wrapper  .anant-rating .star-rating i::before' => 'color: {{VALUE}};',
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
			'selectors'   => [
				'{{WRAPPER}} .anant-outer-wrapper  .anant-rating .star-rating' => 'font-size: {{SIZE}}{{UNIT}};',
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
				'{{WRAPPER}} .anant-outer-wrapper  .anant-rating .star-rating i' => 'margin-right: {{SIZE}}{{UNIT}};',
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
					'{{WRAPPER}} .anant-outer-wrapper .anant-rating .star-rating' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
				'slider_tab_display_price' => 'yes',
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
				'slider_tab_display_add_to_cart_button' => 'yes',
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
				'selectors' =>[
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

        $this->start_controls_section(
            'slider_tab_slider_tab_tabs_text_style', 
			[
				'label' => esc_html__('Tabs', 'anant-addons-for-elementor'),
				'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

		$this->add_control(
		'tabs_color',
		[
			'label'     => __( 'Color', 'anant-addons-for-elementor' ),
			'type'      => Controls_Manager::COLOR,
            'selectors' => [
                '{{WRAPPER}} .anant-product-tabs-grid .tabs li' => 'color: {{VALUE}}',
                '{{WRAPPER}} .anant-product-tabs-grid .tabs li:after' => 'background-color: {{VALUE}}'
            ],
		]
		);

        $this->add_control(
            'tabs_hover_color', 
			[
				'label' => __('Text Hover/Active Color', 'anant-addons-for-elementor'),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .anant-product-tabs-grid .tabs li:hover, {{WRAPPER}} .anant-product-tabs-grid .tabs li.active' => 'color: {{VALUE}}',
					'{{WRAPPER}} .anant-product-tabs-grid .tabs li:hover:after, {{WRAPPER}} .anant-product-tabs-grid .tabs li.active:after' => 'background-color: {{VALUE}}'
				],
            ]
        );

		anant_typography_control(
			$this,
			[
				'name'     => 'tab_typography',
				'label'    => 'Typography',
				'selector' => '{{WRAPPER}} .anant-product-tabs-grid .tabs li',
			]
		);
		
		$this->add_responsive_control(
			'tab_gap',
			[
				'label'           => __( 'Tabs Gap', 'anant-addons-for-elementor' ),
				'type'            => Controls_Manager::SLIDER,
				'size_units'      => [ 'px' ],
				'range'           => [
					'px' => [
						'min' => 0,
						'max' => 50,
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
				'selectors' => [
					'{{WRAPPER}} .anant-product-tabs-grid .tabs' => 'gap: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'tab_wrapper_margin',
			[
				'label'     => esc_html__('Margin', 'anant-addons-for-elementor'),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .anant-product-tabs-grid .header' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

        $this->end_controls_section();
    }

}