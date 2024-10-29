<?php // phpcs:disable Squiz.PHP.CommentedOutCode.Found
namespace AnantAddons;

use Elementor\Controls_Manager;

class AnantProductCategoryGrid extends \Elementor\Widget_Base {

	private $product_cat_card_class = 'anant-single-category';
	private $product_cat_inner = 'anant-product-category-inner'; 
	private $product_cat_img = 'anant-category-image';
	private $product_cat_title = 'anant-category-name';
	private $product_cat_count = 'anant-category-count';

	public function get_name() {
		return 'anant-category-grid';
	}

	public function get_title() {
		return __( ' Product Category Grid', 'anant-addons-for-elementor' );
	}

	public function get_categories() {
		return [ 'anant-woo-elements' ];
	}

	public function get_icon() {
		return 'ant-icon eicon-product-add-to-cart';
	}

	public function get_style_depends() {
		return [
			'anant-widget-css',
		];
	}

	public function get_script_depends() {
		return [
			'anant-widget-js',
		];
	}

	public function get_keywords() {
		return [
			'product category grid',
			'category grid',
			'anant addons',
			'',
			'woo',
		];
	}

	protected function register_controls() {
		$this->start_controls_section(
			'query_configuration',
			[
				'label' => __( 'Content Settings', 'anant-addons-for-elementor' ),
				'tab'   => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);

		$this->add_control(
			'template_style',
			[
				'label'       => esc_html__( 'Template Style', 'anant-addons-for-elementor' ),
				'placeholder' => esc_html__( 'Choose Template from Here', 'anant-addons-for-elementor' ),
				'type'        => \Elementor\Controls_Manager::SELECT,
				'default'     => 'one',
				'options'     => [
					'one'      => esc_html__( 'Layout 1', 'anant-addons-for-elementor' ),
					'two'      => esc_html__( 'Layout 2 (Pro)', 'anant-addons-for-elementor' ),
					'three'      => esc_html__( 'Layout 3 (Pro)', 'anant-addons-for-elementor' ),
					'four'      => esc_html__( 'Layout 4 (Pro)', 'anant-addons-for-elementor' ),
					'five'      => esc_html__( 'Layout 5 (Pro)', 'anant-addons-for-elementor' ),
				],
			]
		);

		$this->add_control(
			'anant_woo_category_pro_notice',
			[
				'raw' => 'Only Available in <a href="https://anantaddons.com/" target="_blank">Pro Version!</a>',
				'type' => \Elementor\Controls_Manager::RAW_HTML,
				'content_classes' => 'anant-pro-notice',
				'condition' => [
                    'template_style!' => ['one'],
                ],
			]
		);

		anant_select2_control(
			$this,
			[
				'key'         => 'product_category',
				'label'       => 'Select Category',
				'placeholder' => 'Choose Category to Include',
				'options'     => anant_get_product_category($type = 1),
				'multiple'    => true,
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

		anant_switcher_control(
			$this,
			[
				'key'       => 'display_category_count',
				'label'     => 'Show Category Count',
				'on_label'  => 'Yes',
				'off_label' => 'No',
				'default'   => 'yes',
				'condition' => [
					'template_style' =>'one',
				]
			]
		);

		anant_switcher_control(
			$this,
			[
				'key'       => 'display_image',
				'label'     => 'Show Image',
				'on_label'  => 'Yes',
				'off_label' => 'No',
				'default'   => 'yes',
			]
		);

		anant_number_control(
			$this,
			[
				'key'         => 'cat_per_page',
				'label'       => 'Limit',
				'placeholder' => '',
				'min'         => 6,
				'max'         => 6,
				'default'     => 6,
				'classes' => 'anant-pro-popup-notice',
				'escape' => false,
			]
		);

		$this->add_responsive_control(
			'grid_column_count',
			[
				'label' => esc_html__( 'Grid Column Count', 'anant-addons-for-elementor' ) .' <i class="eicon-pro-icon"></i>' ,
				'type' => \Elementor\Controls_Manager::SELECT,
				'default' => '5',
				'options' => [
					'5' => esc_html__( '5', 'anant-addons-for-elementor' ),
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
					'{{WRAPPER}} .anant-product-category-grid-wrapper' => 'grid-column-gap: {{SIZE}}{{UNIT}};',
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
					'{{WRAPPER}} .anant-product-category-grid-wrapper' => 'grid-row-gap: {{SIZE}}{{UNIT}};',
				],
			],
		);

		anant_image_size_control(
			$this,
			[
				'name'      => 'thumbnail_size',
				'default'   => 'thumbnail',
				'condition' => [
					'display_image' => 'yes',
				],
			]
		);

		$this->end_controls_section();

		anant_pro_promotion_controls($this);
	
		// STYLE

		// styles image
		$this->start_controls_section(
			'section_image_style',
			[
				'label'     => __( 'Image Settings', 'anant-addons-for-elementor' ),
				'tab'       => Controls_Manager::TAB_STYLE,
			]
		);

		$slug = 'product_categroy_image';

		$this->add_control(
			$slug.'_bg_color',
			[
				'label'     => __( 'Overlay Color', 'anant-addons-for-elementor' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}}  .'.$this->product_cat_img.' .ant_img:before' => 'background: linear-gradient(180deg, rgba(33, 33, 33, 0.05) 0%, {{VALUE}} 100%) ',
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
						'max' => 300,
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
					'{{WRAPPER}} .'.$this->product_cat_img.' .ant_img' => 'width: {{SIZE}}{{UNIT}};', 
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
						'max' => 300,
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
					'{{WRAPPER}} .'.$this->product_cat_img.' .ant_img' => 'height: {{SIZE}}{{UNIT}};', 
				],
			]
		);

		anant_border_control(
			$this,
			[
				'name'     => $slug.'_border_type',
				'label'    => 'Border Type',
				'selector' => '{{WRAPPER}} .'.$this->product_cat_img.' .ant_img',
			]
		);

		anant_border_radius_control(
			$this,
			[
				'key'       => $slug.'_border_radius',
				'label'     => 'Border Radius',
				'selectors' => [
					'{{WRAPPER}} .'.$this->product_cat_img.' .ant_img' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		anant_box_shadow_control(
			$this,
			[
				'key'      => $slug.'_box_shadow',
				'label'    => 'Box Shadow',
				'selector' => '{{WRAPPER}} .'.$this->product_cat_img.' .ant_img',
			]
			);
			
		$this->end_controls_section();
		// styles image ends

		// styles item title
		$this->start_controls_section(
			'section_item_title_style',
			[
				'label'     => __( 'Title Settings', 'anant-addons-for-elementor' ),
				'tab'       => Controls_Manager::TAB_STYLE,
			]
		);
		$slug = 'product_categroy_title';
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
					'{{WRAPPER}} .'.$this->product_cat_title.' .title' => 'text-align: {{VALUE}}',
				],
			]
		);

		anant_color_control(
			$this,
			[
				'key'       => $slug.'_text_color',
				'label'     => 'Color',
				'selectors' => [
					'{{WRAPPER}} .'.$this->product_cat_title.' a' => 'color: {{VALUE}};',
				],
			]
		);

		anant_color_control(
			$this,
			[
				'key'       => $slug.'_text_color_hover',
				'label'     => 'Hover Color',
				'selectors' => [
					'{{WRAPPER}} .'.$this->product_cat_title.' a:hover' => 'color: {{VALUE}};',
				],
			]
		);

		anant_typography_control(
			$this,
			[
				'name'     => $slug.'_typography',
				'label'    => 'Typography',
				'selector' => '{{WRAPPER}} .'.$this->product_cat_title.' a',
			]
		);
		
		$this->add_responsive_control(
			$slug.'_margin',
			[
				'label'     => esc_html__('Margin', 'anant-addons-for-elementor'),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .'.$this->product_cat_title.' a' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->end_controls_section();
		// style item title ends

		// styles item count
		$this->start_controls_section(
			'section_item_count_style',
			[
				'label'     => __( 'Count Settings', 'anant-addons-for-elementor' ),
				'tab'       => Controls_Manager::TAB_STYLE,
			]
		);
		$slug = 'product_categroy_count';
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
					'{{WRAPPER}} .'.$this->product_cat_count.'' => 'text-align: {{VALUE}}',
				],
			]
		);

		anant_color_control(
			$this,
			[
				'key'       => $slug.'_text_color',
				'label'     => 'Color',
				'selectors' => [
					'{{WRAPPER}} .'.$this->product_cat_count.'' => 'color: {{VALUE}};',
				],
			]
		);

		anant_typography_control(
			$this,
			[
				'name'     => $slug.'_typography',
				'label'    => 'Typography',
				'selector' => '{{WRAPPER}} .'.$this->product_cat_count.'',
			]
		);
		$this->add_responsive_control(
			$slug.'_margin',
			[
				'label'     => esc_html__('Margin', 'anant-addons-for-elementor'),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .'.$this->product_cat_count.'' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->end_controls_section();
		// style item count ends
 
	}

	protected function render() {
		$settings                    = $this->get_settings_for_display();
		$element_id                  = 'anant_slider_' . $this->get_id();
		$template_style              = $settings['template_style'];

		$select_cats = $settings['product_category'];
		
		if($select_cats == '' || empty($select_cats) ){
			$categories_list = anant_get_all_category();
		}else{
			$categories = [];
			foreach ($select_cats as $category) {
				$categories[] = get_term_by( 'id', $category, 'product_cat' );
			}

			$categories_list = $categories;
		}

		if ( $categories_list && count( $categories_list ) > 0) {

			require ANANT_PATH . 'inc/templates/style-1/product-category-grid-template.php';
			return;

		}	
	}
}