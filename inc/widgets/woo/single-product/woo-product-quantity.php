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

class AnantProductQuantity extends \Elementor\Widget_Base {

	private $product_quantity_card_inner_class = 'anant-product-quantity-inner-card';
	private $product_quantity_one_class = 'anant-product-quantity-one';
	private $product_quantity_two_class = 'anant-product-quantity-two';
	private $product_quantity_three_class = 'anant-product-quantity-three';
	private $product_quantity_separator_class = 'anant-product-quantity-separator';

	public function get_name() {
		return 'anant-product-quantity';
	}

	public function get_title() {
		return __( 'Product Quantity', 'anant-addons-for-elementor' );
	}

	public function get_categories() {
		return [ 'anant-sng-woo-elements' ];
	}

	public function get_icon() {
		return 'ant-icon eicon-counter';
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
			'quantity',
			'product quantity', 
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
			'decrease_value_icon',
			[
				'label'       => esc_html__( 'Decrease Icon', 'anant-addons-for-elementor' ),
				'placeholder' => esc_html__( 'Choose Icon from Here', 'anant-addons-for-elementor' ),
				'type'        => \Elementor\Controls_Manager::SELECT,
				'default'     => 'fa-minus',
				'options'     => [
					'fa-minus'      => esc_html__( 'Minus', 'anant-addons-for-elementor' ),
					'fa-angle-left' => esc_html__( 'Left Angle', 'anant-addons-for-elementor' ),
					'fa-arrow-left' => esc_html__( 'Left Arrow', 'anant-addons-for-elementor' ),
					'fa-caret-left' => esc_html__( 'Left Caret', 'anant-addons-for-elementor' ),
					'fa-caret-down' => esc_html__( 'Down Caret', 'anant-addons-for-elementor' ),
					'fa-angle-down' => esc_html__( 'Down Angle', 'anant-addons-for-elementor' ),
				],
			]
		);

		$this->add_control(
			'increase_value_icon',
			[
				'label'       => esc_html__( 'Increase Icon', 'anant-addons-for-elementor' ),
				'placeholder' => esc_html__( 'Choose Icon from Here', 'anant-addons-for-elementor' ),
				'type'        => \Elementor\Controls_Manager::SELECT,
				'default'     => 'fa-plus',
				'options'     => [
					'fa-plus'        => esc_html__( 'Plus', 'anant-addons-for-elementor' ),
					'fa-angle-right' => esc_html__( 'Right Angle', 'anant-addons-for-elementor' ),
					'fa-arrow-right' => esc_html__( 'Right Arrow', 'anant-addons-for-elementor' ),
					'fa-caret-right' => esc_html__( 'Right Caret', 'anant-addons-for-elementor' ),
					'fa-caret-up' 	 => esc_html__( 'Up Caret', 'anant-addons-for-elementor' ),
					'fa-angle-up' 	 => esc_html__( 'Up Angle', 'anant-addons-for-elementor' ),
				],
			]
		);

		$this->add_responsive_control(
			'product_quantity_alignment',
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
				'default'    => 'center',
				'selectors' => [
					'{{WRAPPER}} .ant-quantity-group' => 'justify-content: {{VALUE}};',
					
				]
			],
		);
		
		$this->end_controls_section();

		anant_pro_promotion_controls($this);

		$this->start_controls_section(
			'quantity_area_settings',
			[
				'label' => __( 'Quantity Area Settings', 'anant-addons-for-elementor' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'product_quantity_area_bg_color',
			[
				'label'     => __( 'Background Color', 'anant-addons-for-elementor' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}}  .ant-quantity-group' => 'background-color: {{VALUE}}',
				],
			]
		);
		anant_border_control(
			$this,
			[
				'name'     => 'product_quantity_area_border_type',
				'label'    => 'Border Type',
				'selector' => '{{WRAPPER}} .ant-quantity-group',
			]
		);

		anant_border_radius_control(
			$this,
			[
				'key'       => 'product_quantity_area_border_radius',
				'label'     => 'Border Radius',
				'selectors' => [
					'{{WRAPPER}} .ant-quantity-group' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'product_quantity_area_padding',
			[
				'label'     => esc_html__('Padding', 'anant-addons-for-elementor'),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .ant-quantity-group' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'product_quantity_margin',
			[
				'label'     => esc_html__('Margin', 'anant-addons-for-elementor'),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .ant-quantity-group' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		anant_box_shadow_control(
			$this,
			[
				'key'      => 'product_quantity_area_box_shadow',
				'label'    => 'Box Shadow',
				'selector' => '{{WRAPPER}}  .ant-quantity-group',
			]
		);

		$this->end_controls_section();
				
		// Decrease Button Button
		$this->start_controls_section(
			'quantity_btns_settings',
			[
				'label' => __('Quantity Buttons', 'anant-addons-for-elementor' ),
				'tab'   => Controls_Manager::TAB_STYLE, 
			]
		);
		
		$slug = 'quantity_btns';

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
					'{{WRAPPER}}  .ant-icon-minus i:before' => 'color: {{VALUE}}; fill: {{VALUE}};', 
					'{{WRAPPER}}  .ant-icon-plus i:before' => 'color: {{VALUE}}; fill: {{VALUE}};', 
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
				'selector'  => '{{WRAPPER}} .ant-icon-minus, {{WRAPPER}} .ant-icon-plus',

			]
		);	

		$this->add_responsive_control(
			$slug.'_icon_width',
			[
				'label'           => __( 'Icon Width', 'anant-addons-for-elementor' ),
				'type'            => Controls_Manager::SLIDER,
				'size_units'      => [ 'px', '%' ],
				'range'           => [
					'px' => [
						'min' => 0,
						'max' => 100,
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
					'{{WRAPPER}}  .ant-icon-minus' => 'width: {{SIZE}}{{UNIT}};height: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}}  .ant-icon-plus' => 'width: {{SIZE}}{{UNIT}};height: {{SIZE}}{{UNIT}};',
				],
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
						'max' => 70,
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
					'{{WRAPPER}}  .ant-icon-minus i' => 'font-size: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}}  .ant-icon-plus i' => 'font-size: {{SIZE}}{{UNIT}};',
				],
			]
		);			
		
		$this->add_group_control(
			\Elementor\Group_Control_Border::get_type(),
			[
				'name'     => $slug.'_border_type',
				'label'    => 'Border Type',
				'selector' => '{{WRAPPER}} .ant-icon-minus, {{WRAPPER}} .ant-icon-plus',
			]
		);

		anant_box_shadow_control(
			$this,
			[
				'key'      => $slug.'_box_shadow',
				'label'    => 'Box Shadow',
				'selector' => '{{WRAPPER}}  .ant-icon-minus, {{WRAPPER}} .ant-icon-plus',
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
					'{{WRAPPER}} .ant-icon-minus:hover i:before' => 'color: {{VALUE}}; fill: {{VALUE}};', 
					'{{WRAPPER}} .ant-icon-plus:hover i:before' => 'color: {{VALUE}}; fill: {{VALUE}};', 
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
				'selector'  => '{{WRAPPER}} .ant-icon-minus:hover, {{WRAPPER}} .ant-icon-plus:hover ',
					
			]
		);

		$this->add_responsive_control(
			$slug.'_icon_width_hover',
			[
				'label'           => __( 'Icon Width', 'anant-addons-for-elementor' ),
				'type'            => Controls_Manager::SLIDER,
				'size_units'      => [ 'px', '%' ],
				'range'           => [
					'px' => [
						'min' => 0,
						'max' => 100,
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
					'{{WRAPPER}}  .ant-icon-minus:hover' => 'width: {{SIZE}}{{UNIT}};height: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}}  .ant-icon-plus:hover' => 'width: {{SIZE}}{{UNIT}};height: {{SIZE}}{{UNIT}};',
				],
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
						'max' => 70,
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
					'{{WRAPPER}}  .ant-icon-minus:hover i' => 'font-size: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}}  .ant-icon-plus:hover i' => 'font-size: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Border::get_type(),
			[
				'name'     => $slug.'_border_type_hover',
				'label'    => 'Border Type',
				'selector' => '{{WRAPPER}} .ant-icon-minus:hover, {{WRAPPER}} .ant-icon-plus:hover',
			]
		);

		anant_box_shadow_control(
			$this,
			[
				'key'      => $slug.'_box_shadow_hover',
				'label'    => 'Box Shadow',
				'selector' => '{{WRAPPER}}  .ant-icon-minus:hover, {{WRAPPER}} .ant-icon-plus:hover',
			]
		);

		$this->end_controls_tab();
		$this->end_controls_tabs(); 
		
		$slug = 'quantity_btn_decrease';

		$this->add_control(
			$slug.'_heading',
			[
				'label' => esc_html__( 'Decrease Button', 'anant-addons-for-elementor' ),
				'type' => \Elementor\Controls_Manager::HEADING,
			]
		);
		$this->start_controls_tabs( $slug.'_tabs' );

		$this->start_controls_tab(
			$slug.'_normal_style',
			[
				'label' => __( 'Normal', 'anant-addons-for-elementor' ),
			]
		);		

		anant_border_radius_control(
			$this,
			[
				'key'       => $slug.'_border_radius',
				'label'     => 'Border Radius',
				'selectors' => [
					'{{WRAPPER}} .ant-icon-minus' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
					'{{WRAPPER}} .ant-icon-minus' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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

		anant_border_radius_control(
			$this,
			[
				'key'       => $slug.'_border_radius_hover',
				'label'     => 'Border Radius',
				'selectors' => [
					'{{WRAPPER}} .ant-icon-minus:hover' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
					'{{WRAPPER}} .ant-icon-minus:hover' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->end_controls_tab();
		$this->end_controls_tabs(); 

		
		$slug = 'quantity_btn_increase';

		$this->add_control(
			$slug.'_heading',
			[
				'label' => esc_html__( 'Increase Button', 'anant-addons-for-elementor' ),
				'type' => \Elementor\Controls_Manager::HEADING,
			]
		);

		$this->start_controls_tabs( $slug.'_tabs' );

		$this->start_controls_tab(
			$slug.'_normal_style',
			[
				'label' => __( 'Normal', 'anant-addons-for-elementor' ),
			]
		);		

		anant_border_radius_control(
			$this,
			[
				'key'       => $slug.'_border_radius',
				'label'     => 'Border Radius',
				'selectors' => [
					'{{WRAPPER}} .ant-icon-plus' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
					'{{WRAPPER}} .ant-icon-plus' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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

		anant_border_radius_control(
			$this,
			[
				'key'       => $slug.'_border_radius_hover',
				'label'     => 'Border Radius',
				'selectors' => [
					'{{WRAPPER}} .ant-icon-plus:hover' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
					'{{WRAPPER}} .ant-icon-plus:hover' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->end_controls_tab();
		$this->end_controls_tabs(); 

		$this->end_controls_section();
		
		// Buy Now Button
		$this->start_controls_section(
			'quantity_settings',
			[
				'label' => __('Quantity', 'anant-addons-for-elementor' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);
		
		$slug = 'quantity';
		
		$this->add_control(
			$slug.'_color',
			[
				'label'     => __( 'Color', 'anant-addons-for-elementor' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}}  .ant-quantity-control' => 'color: {{VALUE}}; fill: {{VALUE}};', 
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
				'selector'  => '{{WRAPPER}} .ant-quantity-control',
			]
		);

		anant_typography_control(
			$this,
			[
				'name'     => $slug.'_typography',
				'label'    => 'Typography',
				'selector' => '{{WRAPPER}}  .ant-quantity-control',
			]
		);

		$this->add_responsive_control(
			$slug.'_width',
			[
				'label'           => __( 'Width', 'anant-addons-for-elementor' ),
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
					'{{WRAPPER}}  .ant-quantity-control' => 'max-width: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			$slug.'_height',
			[
				'label'           => __( 'Height', 'anant-addons-for-elementor' ),
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
					'{{WRAPPER}}  .ant-quantity-control' => 'height: {{SIZE}}{{UNIT}};',
				],
			]
		);
		
		$this->add_group_control(
			\Elementor\Group_Control_Border::get_type(),
			[
				'name'     => $slug.'_border_type',
				'label'    => 'Border Type',
				'selector' => '{{WRAPPER}} .ant-quantity-control', 
			]
		);
		
		anant_border_radius_control(
			$this,
			[
				'key'       => $slug.'_border_radius',
				'label'     => 'Border Radius',
				'selectors' => [
					'{{WRAPPER}} .ant-quantity-control' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
					'{{WRAPPER}} .ant-quantity-control' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		anant_box_shadow_control(
			$this,
			[
				'key'      => $slug.'_box_shadow',
				'label'    => 'Box Shadow',
				'selector' => '{{WRAPPER}}  .ant-quantity-control',
			]
		);

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
            }
    
        }else{
            $product_id = get_the_ID();
            $product = wc_get_product($product_id);
			
            if ( ! $product ) {
                return;
            }
		}
 
		$status = $product->get_stock_status();
		$increase_icon = $settings['increase_value_icon']; 
		$decrease_icon = $settings['decrease_value_icon']; ?>
		<?php if($status === 'instock'){ ?>
			<div class="ant-input-group ant-quantity-group">
				<button class="quantity-idicator ant-icon-minus"><i class="fas <?php echo esc_attr($decrease_icon); ?>"></i></button>
				<input class="ant-form-control ant-quantity-control" type="number"  value="1"  >
				<button class="quantity-idicator ant-icon-plus"><i class="fas <?php echo esc_attr($increase_icon); ?>"></i></button>
			</div>
		<?php } ?>	
	<?php }
}