<?php
namespace AnantAddons;

use Elementor\Controls_Manager;
use Elementor\Group_Control_Background;
use Elementor\Group_Control_Text_Stroke;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class AnantProductStock extends \Elementor\Widget_Base {
	
	public function get_name() {
		return 'anant-product-stock';
	}

	public function get_title() {
		return esc_html__( 'Product Stock', 'anant-addons-for-elementor' );
	}

	public function get_icon() {
		return 'ant-icon eicon-product-stock';
	}

	public function get_categories() {
		return [ 'anant-sng-woo-elements' ];
	}

	public function get_keywords() {
		return [ 'woocommerce', 'product-stock', 'product', 'stock' ];
	}


	protected function register_controls() {

		$this->start_controls_section(
			'product_stock_general',
			[
				'label' => esc_html__( 'General', 'anant-addons-for-elementor' ),
				'tab' => Controls_Manager::TAB_CONTENT,
			]
		);

		$this->add_responsive_control(
            'product_title_align',
            [
                'label' => esc_html__( 'Alignment', 'anant-addons-for-elementor' ),
                'type' => Controls_Manager::CHOOSE,
                'default' => 'left',
                'label_block' => false,
                'options' => [
					'left'    => [
						'title' => __( 'Left', 'anant-addons-for-elementor' ),
						'icon' => 'eicon-text-align-left',
					],
					'center' => [
						'title' => __( 'Center', 'anant-addons-for-elementor' ),
						'icon' => 'eicon-text-align-center',
					],
					'right' => [
						'title' => __( 'Right', 'anant-addons-for-elementor' ),
						'icon' => 'eicon-text-align-right',
					],
                ],
				'selectors' => [
					'{{WRAPPER}} .anant-product-stock' => 'text-align: {{VALUE}}',
				]
            ]
        );

		$this->end_controls_section(); // End Controls Section

		$this->start_controls_section(
			'section_in_stock',
			[
				'label' => esc_html__( 'In Stock', 'anant-addons-for-elementor' ),
				'tab' => Controls_Manager::TAB_CONTENT,
			]
		);
        anant_switcher_control(
			$this,
			[
				'key'       => 'quantity_toggle',
				'label'     => 'Quantity Hide/Show',
				'on_label'  => 'Yes',
				'off_label' => 'No',

			]
		);

		$this->add_control(
			'before_quantity_stock', [
				'label' => __( 'Before Quantity', 'anant-addons-for-elementor' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'label_block' => true,
			]
		);

		$this->add_control(
			'after_quantity_stock', [
				'label' => __( 'After Quantity', 'anant-addons-for-elementor' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => __( ' In Stock' , 'anant-addons-for-elementor' ),
				'label_block' => true,
			]
		);

		$this->end_controls_section(); // End Controls Section

		$this->start_controls_section(
			'section_backorder_stock',
			[
				'label' => esc_html__( 'Backorder', 'anant-addons-for-elementor' ),
				'tab' => Controls_Manager::TAB_CONTENT,
			]
		);
        anant_switcher_control(
			$this,
			[
				'key'       => 'backorder_quantity_toggle',
				'label'     => 'Quantity Hide/Show',
				'on_label'  => 'Yes',
				'off_label' => 'No',

			]
		);

		$this->add_control(
			'before_quantity_backorder', [
				'label' => __( 'Before Quantity', 'anant-addons-for-elementor' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'label_block' => true,
			]
		);

		$this->add_control(
			'after_quantity_backorder', [
				'label' => __( 'After Quantity', 'anant-addons-for-elementor' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => __( ' In Stock on backorder' , 'anant-addons-for-elementor' ),
				'label_block' => true,
			]
		);

		$this->end_controls_section(); // End Controls Section

		$this->start_controls_section(
			'out_of_stock_section',
			[
				'label' => esc_html__( 'Out Of Stock', 'anant-addons-for-elementor' ),
				'tab' => Controls_Manager::TAB_CONTENT,
			]
		);

		$this->add_control(
			'out_of_stock_text', [
				'label' => __( 'Out Of Stock Text', 'anant-addons-for-elementor' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => __( 'Out Of Stock' , 'anant-addons-for-elementor' ),
				'label_block' => true,
			]
		);

		$this->end_controls_section(); // End Controls Section

		anant_pro_promotion_controls($this);

		$this->start_controls_section(
			'section_style_instock_backorder',
			[
				'label' => esc_html__( 'In Stock & Back Order', 'anant-addons-for-elementor' ),
				'tab' => Controls_Manager::TAB_STYLE,
				'show_label' => false,
			]
		);

		anant_color_control(
			$this,
			[
				'key'       => 'quantity_color',
				'label'     => esc_html__( 'Quantity Color', 'anant-addons-for-elementor' ),
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .anant-product-stock .stock span' => 'color: {{VALUE}}',
				],
			]
		);

		anant_color_control(
			$this,
			[
				'key'       => 'title_color',
				'label'     => esc_html__( 'Before Quantity Color', 'anant-addons-for-elementor' ),
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .anant-product-stock .stock' => 'color: {{VALUE}}',
				],
			]
		);

		anant_color_control(
			$this,
			[
				'key'       => 'title_bg_color',
				'label'     => esc_html__( 'Background Color', 'anant-addons-for-elementor' ),
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .anant-product-stock .stock' => 'background-color: {{VALUE}}',
				],
			]
		);

		anant_typography_control(
			$this,
			[
				'name'     => 'title_typography',
				'label'    => 'Typography',
				'selector' => '{{WRAPPER}} .anant-product-stock .stock',
			]
		);
		
		anant_border_control(
			$this,
			[
				'name'     => 'title_border_type',
				'label'    => 'Border Type',
				'selector' => '{{WRAPPER}} .anant-product-stock .stock',
			]
		);

		anant_border_radius_control(
			$this,
			[
				'key'       => 'title_border_radius',
				'label'     => 'Border Radius',
				'selectors' => [
					'{{WRAPPER}} .anant-product-stock .stock' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'title_padding',
			[
				'label'     => esc_html__('Padding', 'anant-addons-for-elementor'),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .anant-product-stock .stock' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'title_margin',
			[
				'label'     => esc_html__('Margin', 'anant-addons-for-elementor'),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .anant-product-stock' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		anant_box_shadow_control(
			$this,
			[
				'key'      => 'title_box_shadow',
				'label'    => 'Box Shadow',
				'selector' => '{{WRAPPER}} .anant-product-stock .stock',
			]
		);

		anant_text_shadow_control(
			$this,
			[
				'key'      => 'title_shadow',
				'label'    => 'Text Shadow',
				'selector' => '{{WRAPPER}} .anant-product-stock .stock',
                'separator' => 'after',
			]
		);

		anant_text_stroke_control(
			$this,
			[
				'key'      => 'text_stroke',
				'label'    => 'Text Stroke',
				'selector' => '{{WRAPPER}} .anant-product-stock .stock',
                'separator' => 'after',
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_style_stock_out',
			[
				'label' => esc_html__( 'Out of stock', 'anant-addons-for-elementor' ),
				'tab' => Controls_Manager::TAB_STYLE,
				'show_label' => false,
			]
		);

		anant_color_control(
			$this,
			[
				'key'       => 'out_of_stock_color',
				'label'     => esc_html__( 'Color', 'anant-addons-for-elementor' ),
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .anant-product-stock .stock-out' => 'color: {{VALUE}}',
				],
			]
		);

		anant_color_control(
			$this,
			[
				'key'       => 'out_of_stock_bg_color',
				'label'     => esc_html__( 'Background Color', 'anant-addons-for-elementor' ),
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .anant-product-stock .stock-out' => 'background-color: {{VALUE}}',
				],
			]
		);

		anant_typography_control(
			$this,
			[
				'name'     => 'out_of_stock_typography',
				'label'    => 'Typography',
				'selector' => '{{WRAPPER}} .anant-product-stock .stock-out',
			]
		);
		
		anant_border_control(
			$this,
			[
				'name'     => 'out_of_stock_border_type',
				'label'    => 'Border Type',
				'selector' => '{{WRAPPER}} .anant-product-stock .stock-out',
			]
		);

		anant_border_radius_control(
			$this,
			[
				'key'       => 'out_of_stock_border_radius',
				'label'     => 'Border Radius',
				'selectors' => [
					'{{WRAPPER}} .anant-product-stock .stock-out' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'out_of_stock_padding',
			[
				'label'     => esc_html__('Padding', 'anant-addons-for-elementor'),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .anant-product-stock .stock-out' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'out_of_stock_margin',
			[
				'label'     => esc_html__('Margin', 'anant-addons-for-elementor'),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .anant-product-stock.out-of-stock' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		anant_box_shadow_control(
			$this,
			[
				'key'      => 'out_of_stock_box_shadow',
				'label'    => 'Box Shadow',
				'selector' => '{{WRAPPER}} .anant-product-stock .stock-out',
			]
		);

		anant_text_shadow_control(
			$this,
			[
				'key'      => 'out_of_stock_shadow',
				'label'    => 'Text Shadow',
				'selector' => '{{WRAPPER}} .anant-product-stock .stock-out',
			]
		);

		anant_text_stroke_control(
			$this,
			[
				'key'      => 'out_of_stock_text_stroke',
				'label'    => 'Text Stroke',
				'selector' => '{{WRAPPER}} .anant-product-stock .stock-out',
                'separator' => 'after',
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
    
        }else{
            $product_id = get_the_ID();
            $product = wc_get_product($product_id);
            if ( ! $product ) {
                return;
            }
		}

		$availability = $product->get_availability();
		$status = $product->get_stock_status();
		// $stock_tag = $settings['product_stock_tag'];
		$backorder = $product->get_backorders();
		$instock_quantity = $settings['quantity_toggle'] == 'yes' ? $product->get_stock_quantity() : '';
		$backorder_quantity = $settings['backorder_quantity_toggle'] == 'yes' ? $product->get_stock_quantity() : '';

		if( $status === 'instock' && $backorder == 'no' ){
			echo '<div class="anant-product-stock"><a class="stock '.esc_attr( $availability['class'] ).'">'.esc_html($settings['before_quantity_stock']).'<span>'.esc_html($instock_quantity).'</span>'.esc_html($settings['after_quantity_stock']).'</a></div>';
		}else if($status === 'instock' && ( $backorder == 'yes' || $backorder == 'notify' )){
			echo '<div class="anant-product-stock"><a class="stock '.esc_attr( $availability['class'] ).'" >'.esc_html($settings['before_quantity_backorder']).'<span>'.esc_html($backorder_quantity).'</span>'.esc_html($settings['after_quantity_backorder']).'</a></div>';
		}else{
			echo '<div class="anant-product-stock '.esc_attr( $availability['class'] ).'"><a class="stock-out '.esc_attr( $availability['class'] ).'" >'.esc_html($settings['out_of_stock_text'],'anant-addons-for-elementor').'</a></div>';
		}

	}
	
}