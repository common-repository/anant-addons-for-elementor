<?php
namespace AnantAddons;

use Elementor\Controls_Manager;
use Elementor\Group_Control_Background;
use Elementor\Group_Control_Text_Stroke;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class AnantProductDetails extends \Elementor\Widget_Base {
	
	public function get_name() {
		return 'anant-product-details';
	}

	public function get_title() {
		return esc_html__( 'Product Details', 'anant-addons-for-elementor' );
	}

	public function get_icon() {
		return 'ant-icon eicon-product-info';
	}

	public function get_categories() {
		return [ 'anant-sng-woo-elements' ];
	}

	public function get_keywords() {
		return [ 'woocommerce', 'product-details', 'product', 'details' ];
	}

	protected function register_controls() {

		$this->start_controls_section(
			'section_product_details',
			[
				'label' => esc_html__( 'General', 'anant-addons-for-elementor' ),
				'tab' => Controls_Manager::TAB_CONTENT,
			]
		);

		$this->add_responsive_control(
            'product_details_tabs_align',
            [
                'label' => esc_html__( 'Alignment', 'anant-addons-for-elementor' ),
                'type' => Controls_Manager::CHOOSE,
                'default' => 'left',
                'label_block' => false,
                'options' => [
					'start'    => [
						'title' => __( 'Left', 'anant-addons-for-elementor' ),
						'icon' => 'eicon-text-align-left',
					],
					'center' => [
						'title' => __( 'Center', 'anant-addons-for-elementor' ),
						'icon' => 'eicon-text-align-center',
					],
					'end' => [
						'title' => __( 'Right', 'anant-addons-for-elementor' ),
						'icon' => 'eicon-text-align-right',
					],
                ],
				'selectors' => [
					'{{WRAPPER}} .anant-product-details .tabs.wc-tabs' => 'justify-content: {{VALUE}}',
				]
            ]
        );

		$this->end_controls_section(); // End Controls Section

		anant_pro_promotion_controls($this);

		$this->start_controls_section(
			'product_details_tabs_styles',
			[
				'label' => esc_html__( 'Tabs', 'anant-addons-for-elementor' ),
				'tab' => Controls_Manager::TAB_STYLE,
				'show_label' => false,
			]
		);
		
		$slug = 'product_details_tabs';
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
					'{{WRAPPER}}  .anant-product-details .tabs.wc-tabs li a' => 'color: {{VALUE}};', 
				],
			]
		);
		
		$this->add_control(
			$slug.'_bg_color',
			[
				'label'     => __( 'Background Color', 'anant-addons-for-elementor' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}}  .anant-product-details .tabs.wc-tabs li' => 'background-color: {{VALUE}};', 
				],
			]
		);

		anant_typography_control(
			$this,
			[
				'name'     => $slug.'_typography',
				'label'    => 'Typography',
				'selector' => '{{WRAPPER}}  .anant-product-details .tabs.wc-tabs li',
			]
		);

		anant_border_control(
			$this,
			[
				'name'     => $slug.'_border_type',
				'label'    => 'Border Type',
				'selector' => '{{WRAPPER}} .anant-product-details .tabs.wc-tabs li',
			]
		);

		anant_border_radius_control(
			$this,
			[
				'key'       => $slug.'_border_radius',
				'label'     => 'Border Radius',
				'selectors' => [
					'{{WRAPPER}} .anant-product-details .tabs.wc-tabs li' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
					'{{WRAPPER}} .anant-product-details .tabs.wc-tabs li' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
					'{{WRAPPER}} .anant-product-details .tabs.wc-tabs li' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
			$slug.'_style_hover',
			[
				'label' => __( 'Hover / Active', 'anant-addons-for-elementor' ),

			]
		);

		$this->add_control(
			$slug.'_color_hover',
			[
				'label'     => __( 'Color', 'anant-addons-for-elementor' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .anant-product-details .tabs.wc-tabs li:hover a' => 'color: {{VALUE}};', 
					'{{WRAPPER}} .anant-product-details .tabs.wc-tabs li.active a' => 'color: {{VALUE}};', 
				],
			]
		);
		
		$this->add_control(
			$slug.'_bg_color_hover',
			[
				'label'     => __( 'Background Color', 'anant-addons-for-elementor' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}}  .anant-product-details .tabs.wc-tabs li:hover' => 'background-color: {{VALUE}};', 
					'{{WRAPPER}}  .anant-product-details .tabs.wc-tabs li.active' => 'background-color: {{VALUE}};', 
				],
			]
		);

		anant_border_control(
			$this,
			[
				'name'     => $slug.'_border_type_hover',
				'label'    => 'Border Type',
				'selector' => '{{WRAPPER}} .anant-product-details .tabs.wc-tabs li:hover, {{WRAPPER}} .anant-product-details .tabs.wc-tabs li.active',
			]
		);

		$this->end_controls_tab();
		$this->end_controls_tabs(); 

		$this->end_controls_section(); // End Controls Section

		$this->start_controls_section(
			'product_details_description_styles',
			[
				'label' => esc_html__( 'Product Description', 'anant-addons-for-elementor' ),
				'tab' => Controls_Manager::TAB_STYLE,
				'show_label' => false,
			]
		);

		$this->add_responsive_control(
            'product_details_description_align',
            [
                'label' => esc_html__( 'Alignment', 'anant-addons-for-elementor' ),
                'type' => Controls_Manager::CHOOSE,
                'default' => 'left',
                'label_block' => false,
                'options' => [
					'start'    => [
						'title' => __( 'Left', 'anant-addons-for-elementor' ),
						'icon' => 'eicon-text-align-left',
					],
					'center' => [
						'title' => __( 'Center', 'anant-addons-for-elementor' ),
						'icon' => 'eicon-text-align-center',
					],
					'end' => [
						'title' => __( 'Right', 'anant-addons-for-elementor' ),
						'icon' => 'eicon-text-align-right',
					],
                ],
				'selectors' => [
					'{{WRAPPER}} .anant-product-details #tab-description' => 'text-align: {{VALUE}}',
				],
				'separator' => 'before'
            ]
        );
		
		$slug = 'product_details_description_title';

		$this->add_control(
			$slug.'_heading',
			[
				'label' => esc_html__( 'Description Title', 'anant-addons-for-elementor' ),
				'type' => \Elementor\Controls_Manager::HEADING,
			]
		);
		
		$this->add_control(
			$slug.'_color',
			[
				'label'     => __( 'Color', 'anant-addons-for-elementor' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}}  .anant-product-details #tab-description h2' => 'color: {{VALUE}};', 
				],
			]
		);

		anant_typography_control(
			$this,
			[
				'name'     => $slug.'_typography',
				'label'    => 'Typography',
				'selector' => '{{WRAPPER}}  .anant-product-details  #tab-description h2',
			]
		);

		anant_text_shadow_control(
			$this,
			[
				'key'      =>  $slug.'_shadow',
				'label'    => 'Text Shadow',
				'selector' => '{{WRAPPER}} .anant-product-details  #tab-description h2',
                'separator' => 'after',
			]
		);

		anant_text_stroke_control(
			$this,
			[
				'key'      =>  $slug.'_text_stroke',
				'label'    => 'Text Stroke',
				'selector' => '{{WRAPPER}} .anant-product-details  #tab-description h2',
                'separator' => 'after',
			]
		);

		$this->add_responsive_control(
			$slug.'_margin',
			[
				'label'     => esc_html__('Margin', 'anant-addons-for-elementor'),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}}  .anant-product-details  #tab-description h2' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		
		$slug = 'product_details_description_text';

		$this->add_control(
			$slug.'_heading',
			[
				'label' => esc_html__( 'Description', 'anant-addons-for-elementor' ),
				'type' => \Elementor\Controls_Manager::HEADING,
				'separator' => 'before'
			]
		);
		
		$this->add_control(
			$slug.'_color',
			[
				'label'     => __( 'Color', 'anant-addons-for-elementor' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}}  .anant-product-details  #tab-description p' => 'color: {{VALUE}};', 
				],
			]
		);

		anant_typography_control(
			$this,
			[
				'name'     => $slug.'_typography',
				'label'    => 'Typography',
				'selector' => '{{WRAPPER}}  .anant-product-details   #tab-description p',
			]
		);

		anant_text_shadow_control(
			$this,
			[
				'key'      =>  $slug.'_shadow',
				'label'    => 'Text Shadow',
				'selector' => '{{WRAPPER}} .anant-product-details   #tab-description p',
                'separator' => 'after',
			]
		);

		anant_text_stroke_control(
			$this,
			[
				'key'      =>  $slug.'_text_stroke',
				'label'    => 'Text Stroke',
				'selector' => '{{WRAPPER}} .anant-product-details   #tab-description p',
                'separator' => 'after',
			]
		);

		$this->add_responsive_control(
			$slug.'_margin',
			[
				'label'     => esc_html__('Margin', 'anant-addons-for-elementor'),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}}  .anant-product-details   #tab-description p' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->end_controls_section();  // End Controls Section

		$this->start_controls_section(
			'product_details_additional_info_styles',
			[
				'label' => esc_html__( 'Additional Info', 'anant-addons-for-elementor' ),
				'tab' => Controls_Manager::TAB_STYLE,
				'show_label' => false,
			]
		);

		$this->add_responsive_control(
            'product_details_additional_info_title_align',
            [
                'label' => esc_html__( 'Title Alignment', 'anant-addons-for-elementor' ),
                'type' => Controls_Manager::CHOOSE,
                'default' => 'left',
                'label_block' => false,
                'options' => [
					'start'    => [
						'title' => __( 'Left', 'anant-addons-for-elementor' ),
						'icon' => 'eicon-text-align-left',
					],
					'center' => [
						'title' => __( 'Center', 'anant-addons-for-elementor' ),
						'icon' => 'eicon-text-align-center',
					],
					'end' => [
						'title' => __( 'Right', 'anant-addons-for-elementor' ),
						'icon' => 'eicon-text-align-right',
					],
                ],
				'selectors' => [
					'{{WRAPPER}} .anant-product-details #tab-additional_information > h2' => 'text-align: {{VALUE}}',
				],
            ]
        );

		$this->add_responsive_control(
            'product_details_additional_info_table_align',
            [
                'label' => esc_html__( 'Table Alignment', 'anant-addons-for-elementor' ),
                'type' => Controls_Manager::CHOOSE,
                'default' => 'left',
                'label_block' => false,
                'options' => [
					'start'    => [
						'title' => __( 'Left', 'anant-addons-for-elementor' ),
						'icon' => 'eicon-text-align-left',
					],
					'center' => [
						'title' => __( 'Center', 'anant-addons-for-elementor' ),
						'icon' => 'eicon-text-align-center',
					],
					'end' => [
						'title' => __( 'Right', 'anant-addons-for-elementor' ),
						'icon' => 'eicon-text-align-right',
					],
                ],
				'selectors' => [
					'{{WRAPPER}} #tab-additional_information table.shop_attributes' => 'justify-content: {{VALUE}}',
				],
            ]
        );

		$this->add_responsive_control(
            'product_details_additional_info_table_text_align',
            [
                'label' => esc_html__( 'Table Text Alignment', 'anant-addons-for-elementor' ),
                'type' => Controls_Manager::CHOOSE,
                'default' => 'left',
                'label_block' => false,
                'options' => [
					'start'    => [
						'title' => __( 'Left', 'anant-addons-for-elementor' ),
						'icon' => 'eicon-text-align-left',
					],
					'center' => [
						'title' => __( 'Center', 'anant-addons-for-elementor' ),
						'icon' => 'eicon-text-align-center',
					],
					'end' => [
						'title' => __( 'Right', 'anant-addons-for-elementor' ),
						'icon' => 'eicon-text-align-right',
					],
                ],
				'selectors' => [
					'{{WRAPPER}} #tab-additional_information .woocommerce-product-attributes-item__label' => 'text-align: {{VALUE}}',
					'{{WRAPPER}} #tab-additional_information .woocommerce-product-attributes-item__value' => 'text-align: {{VALUE}}',
				],
				'separator' => 'after'
            ]
        );
		
		$slug = 'product_details_additional_info';

		$this->add_control(
			$slug.'_title_heading',
			[
				'label' => esc_html__( 'Title', 'anant-addons-for-elementor' ),
				'type' => \Elementor\Controls_Manager::HEADING,
			]
		);
		
		$this->add_control(
			$slug.'_title_color',
			[
				'label'     => __( 'Color', 'anant-addons-for-elementor' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}}  .anant-product-details .woocommerce-Tabs-panel--additional_information h2' => 'color: {{VALUE}};', 
				],
			]
		);

		anant_typography_control(
			$this,
			[
				'name'     => $slug.'_title_typography',
				'label'    => 'Typography',
				'selector' => '{{WRAPPER}}  .anant-product-details  .woocommerce-Tabs-panel--additional_information h2',
			]
		);

		anant_text_shadow_control(
			$this,
			[
				'key'      =>  $slug.'_shadow',
				'label'    => 'Text Shadow',
				'selector' => '{{WRAPPER}} .anant-product-details  .woocommerce-Tabs-panel--additional_information h2',
			]
		);

		anant_text_stroke_control(
			$this,
			[
				'key'      =>  $slug.'_text_stroke',
				'label'    => 'Text Stroke',
				'selector' => '{{WRAPPER}} .anant-product-details  .woocommerce-Tabs-panel--additional_information h2',
			]
		);

		$this->add_responsive_control(
			$slug.'_title_margin',
			[
				'label'     => esc_html__('Margin', 'anant-addons-for-elementor'),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}}  .anant-product-details  .woocommerce-Tabs-panel--additional_information h2' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_control(
			$slug.'_table_heading',
			[
				'label' => esc_html__( 'Table Body', 'anant-addons-for-elementor' ),
				'type' => \Elementor\Controls_Manager::HEADING,
                'separator' => 'before',
			]
		);
		
		$this->add_control(
			$slug.'_color',
			[
				'label'     => __( 'Border Color', 'anant-addons-for-elementor' ),
				'type'      => Controls_Manager::COLOR,
				'selectors'       => [
					'{{WRAPPER}} .anant-product-details.woocommerce table.shop_attributes tbody .woocommerce-product-attributes-item__value' => 'border-color: {{VALUE}};',
					'{{WRAPPER}} .anant-product-details.woocommerce table.shop_attributes tbody .woocommerce-product-attributes-item__label' => 'border-color: {{VALUE}};',
				],
			]
		);

		$this->add_responsive_control(
			$slug.'_width',
			[
				'label'           => __( 'Border Width', 'anant-addons-for-elementor' ),
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
					'{{WRAPPER}} .anant-product-details.woocommerce table.shop_attributes tbody .woocommerce-product-attributes-item__value' => 'border-width: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .anant-product-details.woocommerce table.shop_attributes tbody .woocommerce-product-attributes-item__label' => 'border-width: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			$slug.'_table_margin',
			[
				'label'     => esc_html__('Margin', 'anant-addons-for-elementor'),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}}  .anant-product-details.woocommerce table.shop_attributes' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		anant_box_shadow_control(
			$this,
			[
				'key'      => $slug.'_table_box_shadow',
				'label'    => 'Box Shadow',
				'selector' => '{{WRAPPER}}  .anant-product-details.woocommerce table.shop_attributes',
			]
		);
		
		$this->add_control(
			$slug.'_odd_bg_color',
			[
				'label'     => __( 'Odd Row Background Color', 'anant-addons-for-elementor' ),
				'type'      => Controls_Manager::COLOR,
				'selectors'       => [
					'{{WRAPPER}} .anant-product-details.woocommerce table.shop_attributes tr.woocommerce-product-attributes-item:nth-child(odd) .woocommerce-product-attributes-item__value' => 'background-color: {{VALUE}};',
					'{{WRAPPER}} .anant-product-details.woocommerce table.shop_attributes tr.woocommerce-product-attributes-item:nth-child(odd) .woocommerce-product-attributes-item__label' => 'background-color: {{VALUE}};',
				],
			]
		);
		
		$this->add_control(
			$slug.'_even_bg_color',
			[
				'label'     => __( 'Even Row Background Color', 'anant-addons-for-elementor' ),
				'type'      => Controls_Manager::COLOR,
				'selectors'       => [
					'{{WRAPPER}} .anant-product-details.woocommerce table.shop_attributes tr.woocommerce-product-attributes-item:nth-child(even) .woocommerce-product-attributes-item__value' => 'background-color: {{VALUE}};',
					'{{WRAPPER}} .anant-product-details.woocommerce table.shop_attributes tr.woocommerce-product-attributes-item:nth-child(even) .woocommerce-product-attributes-item__label' => 'background-color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			$slug.'_label_column_heading',
			[
				'label' => esc_html__( 'Label Column', 'anant-addons-for-elementor' ),
				'type' => \Elementor\Controls_Manager::HEADING,
				'separator' => 'before'
			]
		);
		
		$this->add_control(
			$slug.'_label_column_color',
			[
				'label'     => __( 'Color', 'anant-addons-for-elementor' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}}   .anant-product-details.woocommerce table.shop_attributes tbody .woocommerce-product-attributes-item__label' => 'color: {{VALUE}};', 
				],
			]
		);

		anant_typography_control(
			$this,
			[
				'name'     => $slug.'_label_column_typography',
				'label'    => 'Typography',
				'selector' => '{{WRAPPER}}   .anant-product-details.woocommerce table.shop_attributes tbody .woocommerce-product-attributes-item__label',
			]
		);
		anant_text_shadow_control(
			$this,
			[
				'key'      =>  $slug.'_label_column_shadow',
				'label'    => 'Text Shadow',
				'selector' => '{{WRAPPER}}  .anant-product-details.woocommerce table.shop_attributes tbody .woocommerce-product-attributes-item__label',
                'separator' => 'after',
			]
		);

		anant_text_stroke_control(
			$this,
			[
				'key'      =>  $slug.'_label_column_text_stroke',
				'label'    => 'Text Stroke',
				'selector' => '{{WRAPPER}}  .anant-product-details.woocommerce table.shop_attributes tbody .woocommerce-product-attributes-item__label',
                'separator' => 'after',
			]
		);

		$this->add_control(
			$slug.'_value_column_heading',
			[
				'label' => esc_html__( 'Value Column', 'anant-addons-for-elementor' ),
				'type' => \Elementor\Controls_Manager::HEADING,
				'separator' => 'before'
			]
		);
		
		$this->add_control(
			$slug.'_value_column_color',
			[
				'label'     => __( 'Color', 'anant-addons-for-elementor' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}}   .anant-product-details.woocommerce table.shop_attributes tbody .woocommerce-product-attributes-item__value' => 'color: {{VALUE}};', 
				],
			]
		);

		anant_typography_control(
			$this,
			[
				'name'     => $slug.'_value_column_typography',
				'label'    => 'Typography',
				'selector' => '{{WRAPPER}}   .anant-product-details.woocommerce table.shop_attributes tbody .woocommerce-product-attributes-item__value',
			]
		);
		anant_text_shadow_control(
			$this,
			[
				'key'      =>  $slug.'_value_column_shadow',
				'label'    => 'Text Shadow',
				'selector' => '{{WRAPPER}}  .anant-product-details.woocommerce table.shop_attributes tbody .woocommerce-product-attributes-item__value',
                'separator' => 'after',
			]
		);

		anant_text_stroke_control(
			$this,
			[
				'key'      =>  $slug.'_value_column_text_stroke',
				'label'    => 'Text Stroke',
				'selector' => '{{WRAPPER}}  .anant-product-details.woocommerce table.shop_attributes tbody .woocommerce-product-attributes-item__value',
                'separator' => 'after',
			]
		);

		$this->end_controls_section();  // End Controls Section

		$this->start_controls_section(
			'product_details_reviews_styles',
			[
				'label' => esc_html__( 'Customer Reviews', 'anant-addons-for-elementor' ),
				'tab' => Controls_Manager::TAB_STYLE,
				'show_label' => false,
			]
		);

		$this->add_responsive_control(
            'product_details_reviews_title_align',
            [
                'label' => esc_html__( 'Alignment', 'anant-addons-for-elementor' ),
                'type' => Controls_Manager::CHOOSE,
                'default' => 'left',
                'label_block' => false,
                'options' => [
					'start'    => [
						'title' => __( 'Left', 'anant-addons-for-elementor' ),
						'icon' => 'eicon-text-align-left',
					],
					'center' => [
						'title' => __( 'Center', 'anant-addons-for-elementor' ),
						'icon' => 'eicon-text-align-center',
					],
					'end' => [
						'title' => __( 'Right', 'anant-addons-for-elementor' ),
						'icon' => 'eicon-text-align-right',
					],
                ],
				'selectors' => [
					'{{WRAPPER}} .anant-product-details.woocommerce #reviews #comments .woocommerce-Reviews-title' => 'text-align: {{VALUE}}',
				]
            ]
        );
		
		$slug = 'product_details_reviews_title';

		$this->add_control(
			$slug.'_title_heading',
			[
				'label' => esc_html__( 'Title', 'anant-addons-for-elementor' ),
				'type' => \Elementor\Controls_Manager::HEADING,
			]
		);
		
		$this->add_control(
			$slug.'_title_color',
			[
				'label'     => __( 'Color', 'anant-addons-for-elementor' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}}  .anant-product-details h2.woocommerce-Reviews-title' => 'color: {{VALUE}};', 
				],
			]
		);

		anant_typography_control(
			$this,
			[
				'name'     => $slug.'_title_typography',
				'label'    => 'Typography',
				'selector' => '{{WRAPPER}} .anant-product-details.woocommerce #reviews #comments .woocommerce-Reviews-title',
			]
		);

		anant_text_shadow_control(
			$this,
			[
				'key'      =>  $slug.'_title_shadow',
				'label'    => 'Text Shadow',
				'selector' => '{{WRAPPER}} .anant-product-details h2.woocommerce-Reviews-title',
                'separator' => 'after',
			]
		);

		anant_text_stroke_control(
			$this,
			[
				'key'      =>  $slug.'_title_text_stroke',
				'label'    => 'Text Stroke',
				'selector' => '{{WRAPPER}} .anant-product-details h2.woocommerce-Reviews-title',
                'separator' => 'after',
			]
		);

		$this->add_responsive_control(
			$slug.'_title_margin',
			[
				'label'     => esc_html__('Margin', 'anant-addons-for-elementor'),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .anant-product-details h2.woocommerce-Reviews-title' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		
		$slug = 'product_details_customer_review_img';

		$this->add_control(
			$slug.'_heading',
			[
				'label' => esc_html__( 'image', 'anant-addons-for-elementor' ),
				'type' => \Elementor\Controls_Manager::HEADING,
				'separator' => 'before'
			]
		);

		$this->add_responsive_control(
			$slug.'_img_size',
			[
				'label'           => __( 'Image Size', 'anant-addons-for-elementor' ),
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
					'{{WRAPPER}} .anant-product-details.woocommerce #reviews #comments ol.commentlist li img.avatar' => 'width: {{SIZE}}{{UNIT}};',
				],
			]
		);

		anant_border_control(
			$this,
			[
				'name'     => $slug.'_border_type',
				'label'    => 'Border Type',
				'selector' => '{{WRAPPER}} .anant-product-details.woocommerce #reviews #comments ol.commentlist li img.avatar',
			]
		);

		anant_border_radius_control(
			$this,
			[
				'key'       => $slug.'_border_radius',
				'label'     => 'Border Radius',
				'selectors' => [
					'{{WRAPPER}} .anant-product-details.woocommerce #reviews #comments ol.commentlist li img.avatar' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
					'{{WRAPPER}} .anant-product-details.woocommerce #reviews #comments ol.commentlist li img.avatar' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		anant_box_shadow_control(
			$this,
			[
				'key'      => $slug.'_box_shadow',
				'label'    => 'Box Shadow',
				'selector' => '{{WRAPPER}}  .anant-product-details.woocommerce #reviews #comments ol.commentlist li img.avatar',
			]
		);
		
		$slug = 'product_details_customer_review_box';

		$this->add_control(
			$slug.'_heading',
			[
				'label' => esc_html__( 'Review Box', 'anant-addons-for-elementor' ),
				'type' => \Elementor\Controls_Manager::HEADING,
				'separator' => 'before'
			]
		);
		
		$this->add_control(
			$slug.'_user_name_color',
			[
				'label'     => __( 'User Name Color', 'anant-addons-for-elementor' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}}  .anant-product-details.woocommerce #reviews #comments .woocommerce-review__author' => 'color: {{VALUE}};', 
				],
			]
		);

		anant_typography_control(
			$this,
			[
				'name'     => $slug.'_user_name_typography',
				'label'    => 'Typography',
				'selector' => '{{WRAPPER}}  .anant-product-details.woocommerce #reviews #comments .woocommerce-review__author',
			]
		);
		
		$this->add_control(
			$slug.'_date_color',
			[
				'label'     => __( 'Date Color', 'anant-addons-for-elementor' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .anant-product-details.woocommerce #reviews #comments .woocommerce-review__dash' => 'color: {{VALUE}};', 
					'{{WRAPPER}} .anant-product-details.woocommerce #reviews #comments .woocommerce-review__published-date' => 'color: {{VALUE}};', 
				],
			]
		);

		anant_typography_control(
			$this,
			[
				'name'     => $slug.'_date_typography',
				'label'    => 'Typography',
				'selector' => '{{WRAPPER}} .anant-product-details.woocommerce #reviews #comments .woocommerce-review__dash , {{WRAPPER}} .anant-product-details.woocommerce #reviews #comments .woocommerce-review__published-date',
			]
		);
		
		$this->add_control(
			$slug.'_review_text_color',
			[
				'label'     => __( 'Review Text Color', 'anant-addons-for-elementor' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}}  .anant-product-details.woocommerce #reviews #comments ol.commentlist li .comment-text .description p' => 'color: {{VALUE}};', 
				],
			]
		);

		anant_typography_control(
			$this,
			[
				'name'     => $slug.'_review_text_typography',
				'label'    => 'Typography',
				'selector' => '{{WRAPPER}} .anant-product-details.woocommerce #reviews #comments ol.commentlist li .comment-text .description p',
			]
		);

		
		$this->add_control(
			$slug.'_bg_color',
			[
				'label'     => __( 'Background Color', 'anant-addons-for-elementor' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}}  .anant-product-details.woocommerce #reviews #comments ol.commentlist li .comment-text' => 'background-color: {{VALUE}};', 
				],
			]
		);

		anant_border_control(
			$this,
			[
				'name'     => $slug.'_border_type',
				'label'    => 'Border Type',
				'selector' => '{{WRAPPER}} .anant-product-details.woocommerce #reviews #comments ol.commentlist li .comment-text',
			]
		);

		anant_border_radius_control(
			$this,
			[
				'key'       => $slug.'_border_radius',
				'label'     => 'Border Radius',
				'selectors' => [
					'{{WRAPPER}} .anant-product-details.woocommerce #reviews #comments ol.commentlist li .comment-text' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
					'{{WRAPPER}} .anant-product-details.woocommerce #reviews #comments ol.commentlist li .comment-text' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
					'{{WRAPPER}} .anant-product-details.woocommerce #reviews #comments ol.commentlist li .comment-text' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		anant_box_shadow_control(
			$this,
			[
				'key'      => $slug.'_box_shadow',
				'label'    => 'Box Shadow',
				'selector' => '{{WRAPPER}}  .anant-product-details.woocommerce #reviews #comments ol.commentlist li .comment-text',
			]
		);

		$this->add_control(
			$slug.'_star_heading',
			[
				'label' => esc_html__( 'Stars', 'anant-addons-for-elementor' ),
				'type' => \Elementor\Controls_Manager::HEADING,
				'separator' => 'before'
			]
		);
		
		$this->add_control(
			$slug.'_star_color',
			[
				'label'     => __( 'Star Color', 'anant-addons-for-elementor' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .anant-product-details .star-rating span' => 'color: {{VALUE}};', 
					'{{WRAPPER}} .anant-product-details .star-rating::before' => 'color: {{VALUE}};', 
				],
			]
		);

		// $this->add_control(
		// 	$slug.'_star_size',
		// 	[
		// 		'label' => __( 'Star Size', 'codesigner' ),
		// 		'type' => Controls_Manager::SLIDER,
		// 		'size_units' => [ 'px', 'em' ],
		// 		'default' => [
		// 			'unit' => 'px',
		// 		],
		// 		'range' => [
		// 			'em' => [
		// 				'min' => 0,
		// 				'max' => 4,
		// 				'step' => 0.1,
		// 			],
		// 			'px' => [
		// 				'min' => 0,
		// 				'max' => 50,
		// 				'step' => 1,
		// 			],
		// 		],
		// 		'selectors' => [
		// 			'{{WRAPPER}} .ant-rating-icons .fas:before' => 'font-size: {{SIZE}}{{UNIT}}',
		// 			'{{WRAPPER}} .ant-rating-icons .far:before' => 'font-size: {{SIZE}}{{UNIT}}',
		// 		],
		// 	]
		// );

		// $this->add_control(
		// 	$slug.'_space_between',
		// 	[
		// 		'label' => __( 'Space Between', 'codesigner' ),
		// 		'type' => Controls_Manager::SLIDER,
		// 		'size_units' => [ 'px', 'em' ],
		// 		'default' => [
		// 			'unit' => 'px',
		// 		],
		// 		'range' => [
		// 			'em' => [
		// 				'min' => 0,
		// 				'max' => 4,
		// 				'step' => 0.1,
		// 			],
		// 			'px' => [
		// 				'min' => 0,
		// 				'max' => 50,
		// 				'step' => 1,
		// 			],
		// 		],
		// 		'selectors' => [
		// 			'{{WRAPPER}} .ant-rating-icons  .anant-star-rating i' => 'margin-right: {{SIZE}}{{UNIT}}',
		// 			'{{WRAPPER}} .ant-rating-icons  .anant-star-rating i' => 'margin-left: {{SIZE}}{{UNIT}}',
		// 		],
		// 	]
		// );

		$this->add_responsive_control(
			$slug.'_star_margin',
			[
				'label'     => esc_html__('Margin', 'anant-addons-for-elementor'),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .anant-product-details.woocommerce .star-rating' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->end_controls_section();  // End Controls Section

		$this->start_controls_section(
			'product_details_review_form_styles',
			[
				'label' => esc_html__( 'Review Form', 'anant-addons-for-elementor' ),
				'tab' => Controls_Manager::TAB_STYLE,
				'show_label' => false,
			]
		);
		
		$slug = 'product_details_review_form';

		$this->add_control(
			$slug.'_title_heading',
			[
				'label' => esc_html__( 'Title', 'anant-addons-for-elementor' ),
				'type' => \Elementor\Controls_Manager::HEADING,
			]
		);
		
		$this->add_control(
			$slug.'_title_color',
			[
				'label'     => __( 'Color', 'anant-addons-for-elementor' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}}  .anant-product-details.woocommerce #reply-title' => 'color: {{VALUE}};', 
				],
			]
		);

		anant_typography_control(
			$this,
			[
				'name'     => $slug.'_title_typography',
				'label'    => 'Typography',
				'selector' => '{{WRAPPER}}  .anant-product-details.woocommerce #reply-title',
			]
		);

		$this->add_responsive_control(
			$slug.'_title_margin',
			[
				'label'     => esc_html__('Margin', 'anant-addons-for-elementor'),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}}  .anant-product-details.woocommerce #reply-title' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		anant_text_shadow_control(
			$this,
			[
				'key'      =>  $slug.'_title_shadow',
				'label'    => 'Text Shadow',
				'selector' => '{{WRAPPER}} .anant-product-details.woocommerce #reply-title',
                'separator' => 'after',
			]
		);

		anant_text_stroke_control(
			$this,
			[
				'key'      =>  $slug.'_title_text_stroke',
				'label'    => 'Text Stroke',
				'selector' => '{{WRAPPER}} .anant-product-details.woocommerce #reply-title',
                'separator' => 'after',
			]
		);
		
		$this->add_control(
			$slug.'_require_color',
			[
				'label'     => __( 'Require *', 'anant-addons-for-elementor' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .anant-product-details.woocommerce .comment-form-rating label .required' => 'color: {{VALUE}};', 
					'{{WRAPPER}} .anant-product-details.woocommerce .comment-form-comment label .required' => 'color: {{VALUE}};', 
				],
                'separator' => 'after',
			]
		);
		
		$slug = 'product_details_review_form_stars';

		$this->add_control(
			$slug.'_title_heading',
			[
				'label' => esc_html__( 'Rating', 'anant-addons-for-elementor' ),
				'type' => \Elementor\Controls_Manager::HEADING,
			]
		);
		
		$this->add_control(
			$slug.'_title_color',
			[
				'label'     => __( 'Color', 'anant-addons-for-elementor' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .anant-product-details.woocommerce .comment-form-rating label' => 'color: {{VALUE}};', 
				],
			]
		);

		anant_typography_control(
			$this,
			[
				'name'     => $slug.'_title_typography',
				'label'    => 'Typography',
				'selector' => '{{WRAPPER}} .anant-product-details.woocommerce .comment-form-rating label',
			]
		);

		$this->add_responsive_control(
			$slug.'_title_margin',
			[
				'label'     => esc_html__('Margin', 'anant-addons-for-elementor'),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}}  .anant-product-details.woocommerce .comment-form-rating label' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		anant_text_shadow_control(
			$this,
			[
				'key'      =>  $slug.'_title_shadow',
				'label'    => 'Text Shadow',
				'selector' => '{{WRAPPER}} .anant-product-details.woocommerce .comment-form-rating label',
			]
		);
		
		$this->add_control(
			$slug.'_color',
			[
				'label'     => __( 'Star Color', 'anant-addons-for-elementor' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .anant-product-details.woocommerce .stars span a:before' => 'color: {{VALUE}};', 
				]
			]
		);

		$this->add_control(
			$slug.'_size',
			[
				'label' => __( 'Star Size', 'codesigner' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px', 'em' ],
				'default' => [
					'unit' => 'px',
				],
				'range' => [
					'em' => [
						'min' => 0,
						'max' => 4,
						'step' => 0.1,
					],
					'px' => [
						'min' => 0,
						'max' => 50,
						'step' => 1,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .anant-product-details .stars span a' => 'font-size: {{SIZE}}{{UNIT}}',
				],
			]
		);

		$this->add_control(
			$slug.'_space_between',
			[
				'label' => __( 'Space Between', 'codesigner' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px', 'em' ],
				'default' => [
					'unit' => 'px',
				],
				'range' => [
					'em' => [
						'min' => 0,
						'max' => 4,
						'step' => 0.1,
					],
					'px' => [
						'min' => 0,
						'max' => 50,
						'step' => 1,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .anant-product-details .stars span a' => 'margin-right: {{SIZE}}{{UNIT}};margin-left: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			$slug.'_star_margin',
			[
				'label'     => esc_html__('Margin', 'anant-addons-for-elementor'),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .anant-product-details.woocommerce .comment-form-rating' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		
		$slug = 'product_details_review_form_text';

		$this->add_control(
			$slug.'_title_heading',
			[
				'label' => esc_html__( 'Review', 'anant-addons-for-elementor' ),
				'type' => \Elementor\Controls_Manager::HEADING,
				'separator' => 'before'
			]
		);
		
		$this->add_control(
			$slug.'_title_color',
			[
				'label'     => __( 'Title Color', 'anant-addons-for-elementor' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .anant-product-details.woocommerce .comment-form-comment label' => 'color: {{VALUE}};', 
				],
			]
		);

		anant_typography_control(
			$this,
			[
				'name'     => $slug.'_title_typography',
				'label'    => 'Typography',
				'selector' => '{{WRAPPER}} .anant-product-details.woocommerce .comment-form-comment label',
			]
		);

		$this->add_responsive_control(
			$slug.'_title_margin',
			[
				'label'     => esc_html__('Margin', 'anant-addons-for-elementor'),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}}  .anant-product-details.woocommerce .comment-form-comment label' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		anant_text_shadow_control(
			$this,
			[
				'key'      =>  $slug.'_title_shadow',
				'label'    => 'Text Shadow',
				'selector' => '{{WRAPPER}} .anant-product-details.woocommerce .comment-form-comment label',
			]
		);
		
		$slug = 'product_details_review_form_inputs';

		$this->add_control(
			$slug.'_heading',
			[
				'label' => esc_html__( 'Input', 'anant-addons-for-elementor' ),
				'type' => \Elementor\Controls_Manager::HEADING,
				'separator' => 'before'
			]
		);
		
		$this->add_control(
			$slug.'_color',
			[
				'label'     => __( 'Color', 'anant-addons-for-elementor' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .anant-product-details.woocommerce #review_form #respond textarea' => 'color: {{VALUE}};', 
					'{{WRAPPER}} .anant-product-details.woocommerce #review_form #respond #author' => 'color: {{VALUE}};', 
					'{{WRAPPER}} .anant-product-details.woocommerce #review_form #respond #email' => 'color: {{VALUE}};', 
				]
			]
		);
		
		$this->add_control(
			$slug.'_bg_color',
			[
				'label'     => __( 'Background Color', 'anant-addons-for-elementor' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .anant-product-details.woocommerce #review_form #respond textarea' => 'background-color: {{VALUE}};', 
					'{{WRAPPER}} .anant-product-details.woocommerce #review_form #respond #author' => 'background-color: {{VALUE}};', 
					'{{WRAPPER}} .anant-product-details.woocommerce #review_form #respond #email' => 'background-color: {{VALUE}};', 
				],
			]
		);

		anant_typography_control(
			$this,
			[
				'name'     => $slug.'_typography',
				'label'    => 'Typography',
				'selector' => '{{WRAPPER}} .anant-product-details.woocommerce #review_form #respond textarea, {{WRAPPER}} .anant-product-details.woocommerce #review_form #respond #author, {{WRAPPER}} .anant-product-details.woocommerce #review_form #respond #email',
			]
		);

		anant_border_control(
			$this,
			[
				'name'     => $slug.'_border_type',
				'label'    => 'Border Type',
				'selector' => '{{WRAPPER}} .anant-product-details.woocommerce #review_form #respond textarea, {{WRAPPER}} .anant-product-details.woocommerce #review_form #respond #author, {{WRAPPER}} .anant-product-details.woocommerce #review_form #respond #email',
			]
		);

		anant_border_radius_control(
			$this,
			[
				'key'       => $slug.'_border_radius',
				'label'     => 'Border Radius',
				'selectors' => [
					'{{WRAPPER}} .anant-product-details.woocommerce #review_form #respond textarea' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					'{{WRAPPER}} .anant-product-details.woocommerce #review_form #respond #author' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					'{{WRAPPER}} .anant-product-details.woocommerce #review_form #respond #email' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		// create_dimensions_control(
		// 	$this,
		// 	[
		// 		'key'       => $slug.'_margin',
		// 		'label'     => 'Margin',
		// 		'selectors' => [
		// 			'{{WRAPPER}} .anant-product-details.woocommerce #review_form #respond textarea' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
		// 		],
		// 	]
		// );

		anant_box_shadow_control(
			$this,
			[
				'key'      => $slug.'_box_shadow',
				'label'    => 'Box Shadow',
				'selector' => '{{WRAPPER}} .anant-product-details.woocommerce #review_form #respond textarea, {{WRAPPER}} .anant-product-details.woocommerce #review_form #respond #author, {{WRAPPER}} .anant-product-details.woocommerce #review_form #respond #email',
			]
		);

		$this->add_control(
			$slug.'_btn_heading',
			[
				'label' => esc_html__( 'Button', 'anant-addons-for-elementor' ),
				'type' => \Elementor\Controls_Manager::HEADING,
                'separator' => 'before',
			]
		);
		
		$this->add_control(
			$slug.'_btn_color',
			[
				'label'     => __( 'Color', 'anant-addons-for-elementor' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .anant-product-details.woocommerce #review_form #respond .form-submit input' => 'color: {{VALUE}};', 
				],
			]
		);
		
		$this->add_control(
			$slug.'_btn_hover_color',
			[
				'label'     => __( 'Hover Color', 'anant-addons-for-elementor' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .anant-product-details.woocommerce #review_form #respond .form-submit input:hover' => 'color: {{VALUE}};', 
				],
			]
		);
		
		$this->add_control(
			$slug.'_btn_bg_color',
			[
				'label'     => __( 'Background Color', 'anant-addons-for-elementor' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .anant-product-details.woocommerce #review_form #respond .form-submit input' => 'background-color: {{VALUE}};', 
				],
			]
		);
		
		$this->add_control(
			$slug.'_btn_bg_hover_color',
			[
				'label'     => __( 'Background Hover Color', 'anant-addons-for-elementor' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .anant-product-details.woocommerce #review_form #respond .form-submit input:hover' => 'background-color: {{VALUE}};', 
				],
			]
		);

		anant_typography_control(
			$this,
			[
				'name'     => $slug.'_btn_typography',
				'label'    => 'Typography',
				'selector' => '{{WRAPPER}} .anant-product-details.woocommerce #review_form #respond .form-submit input',
			]
		);

		anant_border_control(
			$this,
			[
				'name'     => $slug.'_btn_border_type',
				'label'    => 'Border Type',
				'selector' => '{{WRAPPER}} .anant-product-details.woocommerce #review_form #respond .form-submit input',
			]
		);

		anant_border_radius_control(
			$this,
			[
				'key'       => $slug.'_btn_border_radius',
				'label'     => 'Border Radius',
				'selectors' => [
					'{{WRAPPER}} .anant-product-details.woocommerce #review_form #respond .form-submit input' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			$slug.'_btn_margin',
			[
				'label'     => esc_html__('Margin', 'anant-addons-for-elementor'),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .anant-product-details.woocommerce #review_form #respond .form-submit input' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			$slug.'_btn_padding',
			[
				'label'     => esc_html__('Padding', 'anant-addons-for-elementor'),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .anant-product-details.woocommerce #review_form #respond .form-submit input' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		anant_box_shadow_control(
			$this,
			[
				'key'      => $slug.'_btn_box_shadow',
				'label'    => 'Box Shadow',
				'selector' => '{{WRAPPER}}  .anant-product-details.woocommerce #review_form #respond .form-submit input',
			]
		);

		$this->end_controls_section(); 

		$this->start_controls_section(
			'product_details_no_review_section_style',
			[
				'label' => esc_html__( 'No Review', 'anant-addons-for-elementor' ),
				'tab' => Controls_Manager::TAB_STYLE,
				'show_label' => false,
			]
		);

		$this->add_responsive_control(
            'product_details_no_review_title_align',
            [
                'label' => esc_html__( 'Alignment', 'anant-addons-for-elementor' ),
                'type' => Controls_Manager::CHOOSE,
                'default' => 'left',
                'label_block' => false,
                'options' => [
					'start'    => [
						'title' => __( 'Left', 'anant-addons-for-elementor' ),
						'icon' => 'eicon-text-align-left',
					],
					'center' => [
						'title' => __( 'Center', 'anant-addons-for-elementor' ),
						'icon' => 'eicon-text-align-center',
					],
					'end' => [
						'title' => __( 'Right', 'anant-addons-for-elementor' ),
						'icon' => 'eicon-text-align-right',
					],
                ],
				'selectors' => [
					'{{WRAPPER}} .anant-product-details .woocommerce-noreviews' => 'text-align: {{VALUE}}',
				]
            ]
        );

		anant_color_control(
			$this,
			[
				'key'       => 'title_color',
				'label'     => esc_html__( 'Color', 'anant-addons-for-elementor' ),
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .anant-product-details .woocommerce-noreviews' => 'color: {{VALUE}}',
				],
			]
		);
		anant_typography_control(
			$this,
			[
				'name'     => 'title_typography',
				'label'    => 'Typography',
				'selector' => '{{WRAPPER}} .anant-product-details .woocommerce-noreviews',
			]
		);

		anant_text_shadow_control(
			$this,
			[
				'key'      => 'title_shadow',
				'label'    => 'Text Shadow',
				'selector' => '{{WRAPPER}} .anant-product-details .woocommerce-noreviews',
                'separator' => 'after',
			]
		);

		$this->add_responsive_control(
			'title_margin',
			[
				'label'     => esc_html__('Margin', 'anant-addons-for-elementor'),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .anant-product-details .woocommerce-noreviews' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->end_controls_section();
	}

	protected function render() {
		$settings = $this->get_settings();
		$current_url = $_SERVER['REQUEST_URI'];
		if ( ( class_exists( "\Elementor\Plugin" ) && \Elementor\Plugin::$instance->editor->is_edit_mode() ) ||  ( class_exists( "\Elementor\Plugin" ) && isset( $_GET['preview'] ) && isset( $_GET['preview_id'] ) && $_GET['preview'] == true ) || ( strpos($current_url, 'anant-header-footer') !== false && get_post_type() == 'anant-header-footer' ) ) {
			$post_id = get_the_ID();
        	$product_id = \Elementor\Plugin::$instance->documents->get($post_id, false)->get_settings('demo_product_id');
            $product = wc_get_product( $product_id );
            if ( ! $product ) {
                return;
            }
			$preview_type = 'demo';
			$GLOBALS['product'] = $product;
			$GLOBALS['post'] = get_post($product_id);
        }else{
            $product_id = get_the_ID();
            $product = wc_get_product($product_id);
			$preview_type = 'norm';
            if ( ! $product ) {
                return;
            }
		} 

        setup_postdata( $product->get_id() ); ?>

		<div class="anant-product-details woocommerce" prev-type="<?php esc_attr_e($preview_type); ?>" >
			<?php wc_get_template( 'single-product/tabs/tabs.php' );	?>
		</div>

	<?php }
	
}