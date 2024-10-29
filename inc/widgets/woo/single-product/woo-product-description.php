<?php
namespace AnantAddons;

use Elementor\Controls_Manager;
use Elementor\Group_Control_Background;
use Elementor\Group_Control_Text_Stroke;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class AnantProductDescription extends \Elementor\Widget_Base {
	
	public function get_name() {
		return 'anant-product-description';
	}

	public function get_title() {
		return esc_html__( 'Product Description', 'anant-addons-for-elementor' );
	}

	public function get_icon() {
		return 'ant-icon eicon-product-description';
	}

	public function get_categories() {
		return [ 'anant-sng-woo-elements' ];
	}

	public function get_keywords() {
		return [ 'woocommerce', 'product-description', 'product', 'description' ];
	}

	protected function register_controls() {

		$this->start_controls_section(
			'section_product_description',
			[
				'label' => esc_html__( 'General', 'anant-addons-for-elementor' ),
				'tab' => Controls_Manager::TAB_CONTENT,
			]
		);

		$this->add_control(
			'product_description_type',
			[
				'label' => esc_html__( 'Description Type', 'anant-addons-for-elementor' ),
				'type' => Controls_Manager::SELECT,
				'options' => [
					'full' => 'Full',
					'short' => 'Short',
				],
				'default' => 'full',
			]
		);

		$this->add_control(
			'product_description_tag',
			[
				'label' => esc_html__( 'Description HTML Tag', 'anant-addons-for-elementor' ),
				'type' => Controls_Manager::SELECT,
				'options' => [
					'div' => 'div',
					'span' => 'span',
					'p' => 'p'
				],
				'default' => 'p',
			]
		);

		$this->add_responsive_control(
            'product_description_align',
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
					'{{WRAPPER}} .anant-product-description' => 'text-align: {{VALUE}}',
				],
            ]
        );

		$this->end_controls_section(); // End Controls Section

		anant_pro_promotion_controls($this);

		$this->start_controls_section(
			'product_description_styles',
			[
				'label' => esc_html__( 'Description', 'anant-addons-for-elementor' ),
				'tab' => Controls_Manager::TAB_STYLE,
				'show_label' => false,
			]
		);

		anant_color_control(
			$this,
			[
				'key'       => 'description_color',
				'label'     => esc_html__( 'Color', 'anant-addons-for-elementor' ),
				'default' => '#222222',
				'selectors' => [
					'{{WRAPPER}} .anant-product-description .single-product-description' => 'color: {{VALUE}}',
				],
			]
		);

		anant_typography_control(
			$this,
			[
				'name'     => 'description_typography',
				'label'    => 'Typography',
				'selector' => '{{WRAPPER}} .anant-product-description .single-product-description',
			]
		);

		$this->add_responsive_control(
			'description_margin',
			[
				'label'     => esc_html__('Margin', 'anant-addons-for-elementor'),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .anant-product-description .single-product-description'  => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}} !important;',
				],
			]
		);

		anant_text_shadow_control(
			$this,
			[
				'key'      => 'description_shadow',
				'label'    => 'Text Shadow',
				'selector' => '{{WRAPPER}} .anant-product-description .single-product-description',
			]
		);

		anant_text_stroke_control(
			$this,
			[
				'key'      => 'text_stroke',
				'label'    => 'Text Stroke',
				'selector' => '{{WRAPPER}} .anant-product-description .single-product-description',
			]
		);

		$this->end_controls_section();
	}

	protected function render() {
		$settings = $this->get_settings();
		$desc_type = $settings['product_description_type'];
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

        echo '<div class="anant-product-description">';
		echo '<'. $settings['product_description_tag'] .' class="single-product-description">';
		if($desc_type === 'full'){
			if($product->get_description() !== ''){
				echo $product->get_description();
			}else{
				echo "Description is empty";
			}
		}else{
			if($product->get_short_description() !== ''){
				echo $product->get_short_description();
			}else{
				echo "Short description has not been defined.";
			}
		}
		echo '</'. $settings['product_description_tag'] .'>';
        echo '</div>';

	}
	
}