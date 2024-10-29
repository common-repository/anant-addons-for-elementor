<?php // phpcs:disable Squiz.PHP.CommentedOutCode.Found
namespace AnantAddons;

use Elementor\Controls_Manager;
use Elementor\Core\Schemes\Color;
use Elementor\Core\Schemes\Typography;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Image_Size;
use Elementor\Widget_Base;
use Elementor\this;
use Elementor\Utils;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Background;

class AnantProductButtons extends \Elementor\Widget_Base {

	private $product_button_card_class = 'anant-product-button-card';
	private $product_button_card_inner_class = 'anant-product-button-inner-card';
	private $product_button_one_class = 'anant-product-button-one';
	private $product_button_two_class = 'anant-product-button-two';
	private $product_button_three_class = 'anant-product-button-three';
	private $product_button_separator_class = 'anant-product-button-separator';

	public function get_name() {
		return 'anant-product-button';
	}

	public function get_title() {
		return __( 'Product Buttons', 'anant-addons-for-elementor' );
	}

	public function get_categories() {
		return [ 'anant-sng-woo-elements' ];
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
			'anant-custom-js',
		];
	}

	public function get_keywords() {
		return [
			'button',
			'product buttons', 
			'product button',
			'anant addons',
		];
	}
	protected function register_controls() {

		$this->start_controls_section(
			'content_section',
			[
				'label' => __( 'Content', 'anant-addons-for-elementor' ),
				'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
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
					'layout_1'      => esc_html__( 'Add to Cart', 'anant-addons-for-elementor' ),
					'layout_2'      => esc_html__( 'Buy Now (Pro)', 'anant-addons-for-elementor' ),
					'layout_3'      => esc_html__( 'Both (Pro)', 'anant-addons-for-elementor' ),
				],
			]
		);

		$this->add_responsive_control(
			'product_buttons_alignment',
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
				'default'    => 'center',
				'selectors' => [
					'{{WRAPPER}} .'.$this->product_button_card_class.'' => 'text-align: {{VALUE}};',
					
				]
			],
		);
		
		$this->end_controls_section();

		$this->start_controls_section(
			'cart_button_section',
			[
				'label' => __( 'Add To Cart Settings', 'anant-addons-for-elementor' ),
				'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
				'condition' => [
					'template_style' =>['layout_1'],
				]
			]
		);

		$this->add_control(
			'cart_button_icon',
			[
				'label' => __( 'Icon', 'anant-addons-for-elementor' ),
				'type' => \Elementor\Controls_Manager::ICONS,
				'default' => [],
			]
		);

		$this->add_control(
			'cart_button_position',
			[
				'label'       => esc_html__( 'Icon Position', 'anant-addons-for-elementor' ),
				'type'        => \Elementor\Controls_Manager::SELECT,
				'default'     => 'after',
				'options'     => [
					'before'      => esc_html__( 'Before', 'anant-addons-for-elementor' ),
					'after'      => esc_html__( 'After', 'anant-addons-for-elementor' ),
				]
			]
		);

		$this->add_responsive_control(
			'cart_button_space_before',
			[
				'label'           => __( 'Icon Spacing', 'anant-addons-for-elementor' ),
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
					'{{WRAPPER}}  .'.$this->product_button_one_class.' i' => 'margin-right: {{SIZE}}{{UNIT}};',
				],
				'conditions' => [
					'relation' => 'and',
					'terms'    => [
						[
							'name'     => 'cart_button_position',
							'operator' => '===',
							'value'    => 'before',
						]
					],
				],
			]
		);

		$this->add_responsive_control(
			'cart_button_space_after',
			[
				'label'           => __( 'Icon Spacing', 'anant-addons-for-elementor' ),
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
					'{{WRAPPER}} .'.$this->product_button_one_class.' i' => 'margin-left: {{SIZE}}{{UNIT}};',
				],
				'conditions' => [
					'relation' => 'and',
					'terms'    => [
						[
							'name'     => 'cart_button_position',
							'operator' => '===',
							'value'    => 'after',
						]
					],
				],
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'out_of_stock_button_section',
			[
				'label' => __( 'Out of Stock Settings', 'anant-addons-for-elementor' ),
				'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);

		$this->add_control(
			'out_of_stock_button_icon',
			[
				'label' => __( 'Icon', 'anant-addons-for-elementor' ),
				'type' => \Elementor\Controls_Manager::ICONS,
				'default' => [],
			]
		);

		$this->add_control(
			'out_of_stock_button_position',
			[
				'label'       => esc_html__( 'Icon Position', 'anant-addons-for-elementor' ),
				'type'        => \Elementor\Controls_Manager::SELECT,
				'default'     => 'after',
				'options'     => [
					'before'      => esc_html__( 'Before', 'anant-addons-for-elementor' ),
					'after'      => esc_html__( 'After', 'anant-addons-for-elementor' ),
				]
			]
		);

		$this->add_responsive_control(
			'out_of_stock_button_space_before',
			[
				'label'           => __( 'Icon Spacing', 'anant-addons-for-elementor' ),
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
					'{{WRAPPER}}  .'.$this->product_button_three_class.' i' => 'margin-right: {{SIZE}}{{UNIT}};',
				],
				'conditions' => [
					'relation' => 'and',
					'terms'    => [
						[
							'name'     => 'out_of_stock_button_position',
							'operator' => '===',
							'value'    => 'before',
						]
					],
				],
			]
		);

		$this->add_responsive_control(
			'out_of_stock_button_space_after',
			[
				'label'           => __( 'Icon Spacing', 'anant-addons-for-elementor' ),
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
					'{{WRAPPER}} .'.$this->product_button_three_class.' i' => 'margin-left: {{SIZE}}{{UNIT}};',
				],
				'conditions' => [
					'relation' => 'and',
					'terms'    => [
						[
							'name'     => 'out_of_stock_button_position',
							'operator' => '===',
							'value'    => 'after',
						]
					],
				],
			]
		);

		$this->end_controls_section();

		anant_pro_promotion_controls($this);

		$this->start_controls_section(
			'button_area_settings',
			[
				'label' => __( 'Button Area Settings', 'anant-addons-for-elementor' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);
		$this->start_controls_tabs( 'card_tabs' );

		$this->start_controls_tab(
			'card_normal_style',
			[
				'label' => __( 'Normal', 'anant-addons-for-elementor' ),
			]
		);

		$this->add_control(
			'card_bg_color',
			[
				'label'     => __( 'Background Color', 'anant-addons-for-elementor' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}}  .'.$this->product_button_card_class.'' => 'background-color: {{VALUE}}',
				],
			]
		);
		anant_border_control(
			$this,
			[
				'name'     => 'card_border_type',
				'label'    => 'Border Type',
				'selector' => '{{WRAPPER}} .'.$this->product_button_card_class,
			]
		);

		anant_border_radius_control(
			$this,
			[
				'key'       => 'card_border_radius',
				'label'     => 'Border Radius',
				'selectors' => [
					'{{WRAPPER}} .'.$this->product_button_card_class => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		
		$this->add_responsive_control(
			'card_padding',
			[
				'label'     => esc_html__('Padding', 'anant-addons-for-elementor'),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .'.$this->product_button_card_class => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'card_margin',
			[
				'label'     => esc_html__('Margin', 'anant-addons-for-elementor'),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .'.$this->product_button_card_class => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		anant_box_shadow_control(
			$this,
			[
				'key'      => 'card_box_shadow',
				'label'    => 'Box Shadow',
				'selector' => '{{WRAPPER}}  .'.$this->product_button_card_class,
			]
		);


		$this->end_controls_tab();

		$this->start_controls_tab(
			'card_style_hover',
			[
				'label' => __( 'Hover', 'anant-addons-for-elementor' ),

			]
		);

		$this->add_control(
			'card_bg_color_hover',
			[
				'label'     => __( 'Background Color', 'anant-addons-for-elementor' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}}  .'.$this->product_button_card_class.':hover' => 'Background-color: {{VALUE}}',
				],
			]
		);
		
		anant_border_control(
			$this,
			[
				'name'     => 'card_border_type_hover',
				'label'    => 'Border Type',
				'selector' => '{{WRAPPER}} .'.$this->product_button_card_class.':hover',
			]
		);

		anant_border_radius_control(
			$this,
			[
				'key'       => 'card_border_radius_hover',
				'label'     => 'Border Radius',
				'selectors' => [
					'{{WRAPPER}} .'.$this->product_button_card_class.':hover' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'card_padding_hover',
			[
				'label'     => esc_html__('Padding', 'anant-addons-for-elementor'),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .'.$this->product_button_card_class.':hover' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'card_margin_hover',
			[
				'label'     => esc_html__('Margin', 'anant-addons-for-elementor'),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .'.$this->product_button_card_class.':hover' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		anant_box_shadow_control(
			$this,
			[
				'key'      => 'card_box_shadow_hover',
				'label'    => 'Box Shadow',
				'selector' => '{{WRAPPER}}  .'.$this->product_button_card_class.':hover',
			]
		);

		$this->end_controls_tab();
		$this->end_controls_tabs();
		$this->end_controls_section();

				
		// Add To Cart Button
		$this->start_controls_section(
			'add_to_cart_btn_settings',
			[
				'label' => __('Add To Cart', 'anant-addons-for-elementor' ),
				'tab'   => Controls_Manager::TAB_STYLE, 
				'condition' =>[
					'template_style' => [
						'layout_1',
					]
				]
			]
		);
		
		$slug = 'add_to_cart_btn';
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
					'{{WRAPPER}}  .'.$this->product_button_one_class.'' => 'color: {{VALUE}}; fill: {{VALUE}};', 
				],
			]
		);

		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name'      => $slug.'_bg_color',
				'types'          => [ 'classic', 'gradient' ],
				'exclude'        => [ 'image' ],
				'fields_options' => [
					'background' => [
						'label' => 'Background',
						'default' => 'classic',
					],
				],
				'selector'  => '{{WRAPPER}} .'.$this->product_button_one_class.'',

			]
		);
		anant_typography_control(
			$this,
			[
				'name'     => $slug.'_typography',
				'label'    => 'Typography',
				'selector' => '{{WRAPPER}}  .'.$this->product_button_one_class.'',
			]
		);

		$this->add_responsive_control(
			$slug.'_icon_size',
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
					'{{WRAPPER}}  .'.$this->product_button_one_class.' i' => 'font-size: {{SIZE}}{{UNIT}};',
				],
			]
		);		
		
		$this->add_group_control(
			\Elementor\Group_Control_Border::get_type(),
			[
				'name'     => $slug.'_border_type',
				'label'    => 'Border Type',
				'selector' => '{{WRAPPER}} .'.$this->product_button_one_class.'',
			]
		);

		anant_border_radius_control(
			$this,
			[
				'key'       => $slug.'_border_radius',
				'label'     => 'Border Radius',
				'selectors' => [
					'{{WRAPPER}} .'.$this->product_button_one_class.'' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					'{{WRAPPER}} .'.$this->product_button_one_class.':before' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
					'{{WRAPPER}} .'.$this->product_button_one_class.'' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
					'{{WRAPPER}} .'.$this->product_button_one_class.'' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		anant_box_shadow_control(
			$this,
			[
				'key'      => $slug.'_box_shadow',
				'label'    => 'Box Shadow',
				'selector' => '{{WRAPPER}}  .'.$this->product_button_one_class.'',
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
					'{{WRAPPER}} .'.$this->product_button_one_class.':hover' => 'color: {{VALUE}}; fill: {{VALUE}};', 
				],
			]
		);

		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name'      => $slug.'_bg_color_hover',
				'types'          => [ 'classic', 'gradient' ],
				'exclude'        => [ 'image' ],
				'fields_options' => [
					'background' => [
						'label' => 'Background',
						'default' => 'classic',
					],
				],
				'selector'  => '{{WRAPPER}} .'.$this->product_button_one_class.' span:before, 
								{{WRAPPER}} .'.$this->product_button_one_class.' span:after,
							    {{WRAPPER}} .'.$this->product_button_one_class.':hover, 
							    {{WRAPPER}} .'.$this->product_button_one_class.':before,
							    {{WRAPPER}} .'.$this->product_button_one_class.':after' ,
			]
		);

		anant_typography_control(
			$this,
			[
				'name'     => $slug.'_typography_hover',
				'label'    => 'Typography',
				'selector' => '{{WRAPPER}}  .'.$this->product_button_one_class.':hover',
			]
		);

		$this->add_responsive_control(
			$slug.'_hover_icon_size',
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
					'{{WRAPPER}}  .'.$this->product_button_one_class.':hover i' => 'font-size: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Border::get_type(),
			[
				'name'     => $slug.'_border_type_hover',
				'label'    => 'Border Type',
				'selector' => '{{WRAPPER}} .'.$this->product_button_one_class.':hover',
			]
		);

		anant_border_radius_control(
			$this,
			[
				'key'       => $slug.'_border_radius_hover',
				'label'     => 'Border Radius',
				'selectors' => [
					'{{WRAPPER}} .'.$this->product_button_one_class.':hover' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					'{{WRAPPER}} .'.$this->product_button_one_class.':after' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			$slug.'_padding_hover',
			[
				'label'     => esc_html__('Padding', 'anant-addons-for-elementor'),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .'.$this->product_button_one_class.':hover' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			$slug.'_margin_hover',
			[
				'label'     => esc_html__('Margin', 'anant-addons-for-elementor'),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .'.$this->product_button_one_class.':hover' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		anant_box_shadow_control(
			$this,
			[
				'key'      => $slug.'_box_shadow_hover',
				'label'    => 'Box Shadow',
				'selector' => '{{WRAPPER}}  .'.$this->product_button_one_class.':hover',
			]
		);

		$this->end_controls_tab();
		$this->end_controls_tabs(); 
		$this->end_controls_section();

		$this->start_controls_section(
			'cart_message_styles',
			[
				'label' => esc_html__( 'Cart Message', 'anant-addons-for-elementor' ),
				'tab' => Controls_Manager::TAB_STYLE,
				'show_label' => false,
			]
		);
		
		$slug = 'cart_message';

		$this->add_control(
			$slug.'_box_heading',
			[
				'label' => esc_html__( 'Cart Message Box', 'anant-addons-for-elementor' ),
				'type' => \Elementor\Controls_Manager::HEADING,
			]
		);
		
		$this->add_control(
			$slug.'_box_bg_color',
			[
				'label'     => __( 'Background Color', 'anant-addons-for-elementor' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}}  .ant-add-card-massage' => 'background: {{VALUE}};', 
				],
			]
		);

		anant_border_control(
			$this,
			[
				'name'     => $slug.'_box_border_type',
				'label'    => 'Border Type',
				'selector' => '{{WRAPPER}} .ant-add-card-massage',
			]
		);

		anant_border_radius_control(
			$this,
			[
				'key'       => $slug.'_box_border_radius',
				'label'     => 'Border Radius',
				'selectors' => [
					'{{WRAPPER}} .ant-add-card-massage' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			$slug.'_box_padding',
			[
				'label'     => esc_html__('Padding', 'anant-addons-for-elementor'),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .ant-add-card-massage' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			$slug.'_box_margin',
			[
				'label'     => esc_html__('Margin', 'anant-addons-for-elementor'),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .ant-add-card-massage' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		anant_box_shadow_control(
			$this,
			[
				'key'      => $slug.'_box_box_shadow',
				'label'    => 'Box Shadow',
				'selector' => '{{WRAPPER}}  .ant-add-card-massage',
			]
		);
		
		$this->add_control(
			$slug.'_text_color',
			[
				'label'     => __( 'Text Color', 'anant-addons-for-elementor' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}}  .ant-add-card-massage h6' => 'color: {{VALUE}};', 
				],
			]
		);
		
		$this->add_control(
			$slug.'_icon_color',
			[
				'label'     => __( 'Icon Color', 'anant-addons-for-elementor' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}}  .ant-add-card-massage .massage-text i' => 'color: {{VALUE}};', 
				],
			]
		);

		anant_typography_control(
			$this,
			[
				'name'     => $slug.'_text_typography',
				'label'    => 'Typography',
				'selector' => '{{WRAPPER}}  .ant-add-card-massage h6',
			]
		);

		$this->add_control(
			$slug.'_btn_heading',
			[
				'label' => esc_html__( 'Cart Message Button', 'anant-addons-for-elementor' ),
				'type' => \Elementor\Controls_Manager::HEADING,
			]
		);
		
		$slug = 'cart_message_btn';
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
					'{{WRAPPER}}  .ant-add-card-massage .to-cart' => 'color: {{VALUE}};', 
				],
			]
		);
		
		$this->add_control(
			$slug.'_bg_color',
			[
				'label'     => __( 'Background Color', 'anant-addons-for-elementor' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}}  .ant-add-card-massage .to-cart' => 'background-color: {{VALUE}};', 
				],
			]
		);

		anant_typography_control(
			$this,
			[
				'name'     => $slug.'_typography',
				'label'    => 'Typography',
				'selector' => '{{WRAPPER}}  .ant-add-card-massage .to-cart',
			]
		);

		anant_border_control(
			$this,
			[
				'name'     => $slug.'_border_type',
				'label'    => 'Border Type',
				'selector' => '{{WRAPPER}} .ant-add-card-massage .to-cart',
			]
		);

		anant_border_radius_control(
			$this,
			[
				'key'       => $slug.'_border_radius',
				'label'     => 'Border Radius',
				'selectors' => [
					'{{WRAPPER}} .ant-add-card-massage .to-cart' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
					'{{WRAPPER}} .ant-add-card-massage .to-cart' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
					'{{WRAPPER}} .ant-add-card-massage .to-cart' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		anant_box_shadow_control(
			$this,
			[
				'key'      => $slug.'_box_shadow',
				'label'    => 'Box Shadow',
				'selector' => '{{WRAPPER}}  .ant-add-card-massage .to-cart',
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
					'{{WRAPPER}} .ant-add-card-massage .to-cart:hover' => 'color: {{VALUE}};', 
				],
			]
		);
		
		$this->add_control(
			$slug.'_bg_color_hover',
			[
				'label'     => __( 'Background Color', 'anant-addons-for-elementor' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}}  .ant-add-card-massage .to-cart:hover' => 'background-color: {{VALUE}};', 
				],
			]
		);

		anant_border_control(
			$this,
			[
				'name'     => $slug.'_border_type_hover',
				'label'    => 'Border Type',
				'selector' => '{{WRAPPER}} .ant-add-card-massage .to-cart:hover',
			]
		);

		anant_border_radius_control(
			$this,
			[
				'key'       => $slug.'_border_radius_hover',
				'label'     => 'Border Radius',
				'selectors' => [
					'{{WRAPPER}} .ant-add-card-massage .to-cart:hover' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			$slug.'_padding_hover',
			[
				'label'     => esc_html__('Padding', 'anant-addons-for-elementor'),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .ant-add-card-massage .to-cart:hover' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			$slug.'_margin_hover',
			[
				'label'     => esc_html__('Margin', 'anant-addons-for-elementor'),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .ant-add-card-massage .to-cart:hover' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		anant_box_shadow_control(
			$this,
			[
				'key'      => $slug.'_box_shadow_hover',
				'label'    => 'Box Shadow',
				'selector' => '{{WRAPPER}}  .ant-add-card-massage .to-cart:hover',
			]
		);

		$this->end_controls_tab();
		$this->end_controls_tabs(); 

		$this->end_controls_section();  // End Controls Section
		
		// Buy Now Button
		$this->start_controls_section(
			'out_of_stock_btn_settings',
			[
				'label' => __('Out of Stock', 'anant-addons-for-elementor' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);
		
		$slug = 'out_of_stock_btn';
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
					'{{WRAPPER}}  .'.$this->product_button_three_class.'' => 'color: {{VALUE}}; fill: {{VALUE}};', 
				],
			]
		);

		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name'      => $slug.'_bg_color',
				'types'          => [ 'classic', 'gradient' ],
				'exclude'        => [ 'image' ],
				'fields_options' => [
					'background' => [
						'label' => 'Background',
						'default' => 'classic',
					],
				],
				'selector'  => '{{WRAPPER}} .'.$this->product_button_three_class.'',
			]
		);

		anant_typography_control(
			$this,
			[
				'name'     => $slug.'_typography',
				'label'    => 'Typography',
				'selector' => '{{WRAPPER}}  .'.$this->product_button_three_class.'',
			]
		);

		$this->add_responsive_control(
			$slug.'_icon_size',
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
					'{{WRAPPER}}  .'.$this->product_button_three_class.' i' => 'font-size: {{SIZE}}{{UNIT}};',
				],
			]
		);
		
		$this->add_group_control(
			\Elementor\Group_Control_Border::get_type(),
			[
				'name'     => $slug.'_border_type',
				'label'    => 'Border Type',
				'selector' => '{{WRAPPER}} .'.$this->product_button_three_class.'', 
			]
		);
		
		anant_border_radius_control(
			$this,
			[
				'key'       => $slug.'_border_radius',
				'label'     => 'Border Radius',
				'selectors' => [
					'{{WRAPPER}} .'.$this->product_button_three_class.'' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					'{{WRAPPER}} .'.$this->product_button_three_class.':before' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
					'{{WRAPPER}} .'.$this->product_button_three_class.'' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
					'{{WRAPPER}} .'.$this->product_button_three_class.'' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		anant_box_shadow_control(
			$this,
			[
				'key'      => $slug.'_box_shadow',
				'label'    => 'Box Shadow',
				'selector' => '{{WRAPPER}}  .'.$this->product_button_three_class.'',
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
					'{{WRAPPER}} .'.$this->product_button_three_class.':hover' => 'color: {{VALUE}}; fill: {{VALUE}};',
				],
			]
		);
		
		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name'      => $slug.'_bg_color_hover',
				'types'          => [ 'classic', 'gradient' ],
				'exclude'        => [ 'image' ],
				'fields_options' => [
					'background' => [
						'label' => 'Background',
						'default' => 'classic',
					],
				],
				'selector'  => '{{WRAPPER}} .'.$this->product_button_three_class.' span:before, 
								{{WRAPPER}} .'.$this->product_button_three_class.' span:after,
							    {{WRAPPER}} .'.$this->product_button_three_class.':hover, 
							    {{WRAPPER}} .'.$this->product_button_three_class.':before,
							    {{WRAPPER}} .'.$this->product_button_three_class.':after' ,
			]
		);
		anant_typography_control(
			$this,
			[
				'name'     => $slug.'_typography_hover',
				'label'    => 'Typography',
				'selector' => '{{WRAPPER}}  .'.$this->product_button_three_class.':hover',
			]
		);

		$this->add_responsive_control(
			$slug.'_hover_icon_size',
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
					'{{WRAPPER}}  .'.$this->product_button_three_class.':hover i' => 'font-size: {{SIZE}}{{UNIT}};',
				],
			]
		);
		
		$this->add_group_control(
			\Elementor\Group_Control_Border::get_type(),
			[
				'name'     => $slug.'_border_type_hover',
				'label'    => 'Border Type',
				'selector' => '{{WRAPPER}} .'.$this->product_button_three_class.':hover',

			]
		);

		anant_border_radius_control(
			$this,
			[
				'key'       => $slug.'_border_radius_hover',
				'label'     => 'Border Radius',
				'selectors' => [
					'{{WRAPPER}} .'.$this->product_button_three_class.':hover' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					'{{WRAPPER}} .'.$this->product_button_three_class.':after' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			$slug.'_padding_hover',
			[
				'label'     => esc_html__('Padding', 'anant-addons-for-elementor'),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .'.$this->product_button_three_class.':hover' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					//'{{WRAPPER}} .'.$this->product_button_three_class.'over' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			$slug.'_margin_hover',
			[
				'label'     => esc_html__('Margin', 'anant-addons-for-elementor'),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .'.$this->product_button_three_class.':hover' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					'{{WRAPPER}} .'.$this->product_button_three_class.':hover' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		anant_box_shadow_control(
			$this,
			[
				'key'      => $slug.'_box_shadow_hover',
				'label'    => 'Box Shadow',
				'selector' => '{{WRAPPER}}  .'.$this->product_button_three_class.':hover',
			]
		);
		$this->end_controls_tab();
		$this->end_controls_tabs();
		$this->end_controls_section(); 
	}



	protected function render() {
		$settings = $this->get_settings_for_display();
		$current_url = $_SERVER['REQUEST_URI'];
		if ( ( class_exists( "\Elementor\Plugin" ) && \Elementor\Plugin::$instance->editor->is_edit_mode() ) ||  ( class_exists( "\Elementor\Plugin" ) && isset( $_GET['preview'] ) && isset( $_GET['preview_id'] ) && $_GET['preview'] == true ) || ( strpos($current_url, 'anant-header-footer') !== false && get_post_type() == 'anant-header-footer' ) ) {
			$post_id = get_the_ID();
        	$product_id = \Elementor\Plugin::$instance->documents->get($post_id, false)->get_settings('demo_product_id');
            $product = wc_get_product( $product_id );
            if ( ! $product ) {
                return;
            }else{	
				$status = $product->get_stock_status();
			}
    
        }else{
            $product_id = get_the_ID();
            $product = wc_get_product($product_id);
            if ( ! $product ) {
                return;
            }else{	
				$status = $product->get_stock_status();
			}
		}

		// var_dump($status);
 
		$link_text = 'Add To Cart'; 
		$cart_button_icon = $settings['cart_button_icon'];
		$cart_button_position = $settings['cart_button_position'];

		$link_three_text = 'Out of Stock'; 
		$out_of_stock_button_icon = $settings['out_of_stock_button_icon'];
		$out_of_stock_button_position = $settings['out_of_stock_button_position'];

		$template_style = $settings['template_style']; ?>
		<form class="cart" method="post" enctype='multipart/form-data'>
				<div class="ant-dual-button six <?php echo esc_attr($this->product_button_card_class); ?>">

					<div class="inner <?php echo esc_attr($this->product_button_card_inner_class); ?>">
					<?php if( $status === 'instock' ){
								if ( $template_style === 'layout_1' ) {
									?>
										<a class="ant-btn one <?php echo esc_attr($this->product_button_one_class) ?> <?php echo $cart_button_position === 'before' ? 'anant-no-flex': '' ?>"
											id="ant-btn-cart" value="1" product-id="<?php echo esc_attr($product_id); ?>">
											<?php 
												if ($cart_button_position === 'before') {
													\Elementor\Icons_Manager::render_icon( $cart_button_icon, [ 'aria-hidden' => 'true' ] );
												}
											?>
											<span><?php echo esc_html($link_text); ?></span>
											<?php 
												if ($cart_button_position === 'after') {
													\Elementor\Icons_Manager::render_icon( $cart_button_icon, [ 'aria-hidden' => 'true' ] );
												}
											?>
										</a>
									<?php
								}
							}else{ ?>
								<a class="ant-btn one <?php echo esc_attr($this->product_button_three_class) ?> 
									<?php echo $out_of_stock_button_position === 'before' ? 'anant-no-flex': '' ?>"
										value="1" product-id="<?php echo esc_attr($product_id); ?>" >
										<?php 
											if ($out_of_stock_button_position === 'before') {
												\Elementor\Icons_Manager::render_icon( $out_of_stock_button_icon, [ 'aria-hidden' => 'true' ] );
											}
										?>
										<span><?php echo esc_html($link_three_text); ?></span>
										<?php 
											if ($out_of_stock_button_position === 'after') {
												\Elementor\Icons_Manager::render_icon( $out_of_stock_button_icon, [ 'aria-hidden' => 'true' ] );
											}
									?>
								</a>
								<?php
					
							}
							?>
					</div>
				</div>

				<div class="ant-add-card-massage">
				  <div class="inner">
					<div class="massage-text">
					  <i class="fas fa-info-circle"></i>
					  <h6>This Product Has Been Added To The Cart.</h6>
					</div>
					<a href="<?php wc_get_cart_url() ?>" class="to-cart">View Cart</a>
				  </div>
				</div>
		</form>
	<?php }

}

