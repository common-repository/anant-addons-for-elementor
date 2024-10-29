<?php
namespace AnantAddons;

use Elementor\Controls_Manager;
use Elementor\Group_Control_Background;
use Elementor\Group_Control_Text_Stroke;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class AnantProductSku extends \Elementor\Widget_Base {
	
	public function get_name() {
		return 'anant-product-sku';
	}

	public function get_title() {
		return esc_html__( 'Product Sku', 'anant-addons-for-elementor' );
	}

	public function get_icon() {
		return 'ant-icon eicon-purchase-summary';
	}

	public function get_categories() {
		return [ 'anant-sng-woo-elements' ];
	}

	public function get_keywords() {
		return [ 'woocommerce', 'product-sku', 'product', 'sku' ];
	}


	protected function register_controls() {

		// Tab: Content ==============
		// Section: General ----------
		$this->start_controls_section(
			'section_product_sku',
			[
				'label' => esc_html__( 'General', 'anant-addons-for-elementor' ),
				'tab' => Controls_Manager::TAB_CONTENT,
			]
		);

		$this->add_responsive_control(
            'product_sku_align',
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
					'{{WRAPPER}} .anant-product-sku' => 'justify-content: {{VALUE}}',
				],
				'separator' => 'before'
            ]
        );

		$this->end_controls_section(); // End Controls Section

		anant_pro_promotion_controls($this);

		$this->start_controls_section(
			'section_style_sku',
			[
				'label' => esc_html__( 'Sku', 'anant-addons-for-elementor' ),
				'tab' => Controls_Manager::TAB_STYLE,
				'show_label' => false,
			]
		);

		anant_color_control(
			$this,
			[
				'key'       => 'sku_color',
				'label'     => esc_html__( 'Color', 'anant-addons-for-elementor' ),
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .ant-info-sku' => 'color: {{VALUE}}',
				],
			]
		);

		anant_typography_control(
			$this,
			[
				'name'     => 'sku_typography',
				'label'    => 'Typography',
				'selector' => '{{WRAPPER}} .ant-info-sku',
			]
		);

		anant_text_shadow_control(
			$this,
			[
				'key'      => 'sku_shadow',
				'label'    => 'Text Shadow',
				'selector' => '{{WRAPPER}} .ant-info-sku',
			]
		);

		anant_text_stroke_control(
			$this,
			[
				'key'      => 'text_stroke',
				'label'    => 'Text Stroke',
				'selector' => '{{WRAPPER}} .ant-info-sku',
                'separator' => 'after',
			]
		);

		$this->add_responsive_control(
			'sku_margin',
			[
				'label'     => esc_html__('Margin', 'anant-addons-for-elementor'),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .ant-info-sku' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->end_controls_section(); // End Controls Section

		$this->start_controls_section(
			'section_style_sku_name',
			[
				'label' => esc_html__( 'Sku Name', 'anant-addons-for-elementor' ),
				'tab' => Controls_Manager::TAB_STYLE,
				'show_label' => false,
			]
		);

		anant_color_control(
			$this,
			[
				'key'       => 'sku_name_color',
				'label'     => esc_html__( 'Color', 'anant-addons-for-elementor' ),
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .single-sku' => 'color: {{VALUE}}',
				],
			]
		);

		anant_color_control(
			$this,
			[
				'key'       => 'sku_name_hover_color',
				'label'     => esc_html__( 'Hover Color', 'anant-addons-for-elementor' ),
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .single-sku:hover' => 'color: {{VALUE}}',
				],
			]
		);

		anant_typography_control(
			$this,
			[
				'name'     => 'sku_name_typography',
				'label'    => 'Typography',
				'selector' => '{{WRAPPER}} .single-sku',
			]
		);

		anant_text_shadow_control(
			$this,
			[
				'key'      => 'sku_name_shadow',
				'label'    => 'Text Shadow',
				'selector' => '{{WRAPPER}} .single-sku',
			]
		);

		anant_text_stroke_control(
			$this,
			[
				'key'      => 'sku_name_stroke',
				'label'    => 'Text Stroke',
				'selector' => '{{WRAPPER}} .single-sku',
			]
		);

		$this->add_responsive_control(
			'sku_name_margin',
			[
				'label'     => esc_html__('Margin', 'anant-addons-for-elementor'),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .single-sku' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
    
        }else{
            $product_id = get_the_ID();
            $product = wc_get_product($product_id);
            if ( ! $product ) {
                return;
            }
		} ?>

		<div class="anant-product-sku">
			<span class="ant-info-sku">SKU:</span> 
			<?php if( $product->get_sku() !== '' ) { echo '<span class="single-sku">'.$product->get_sku().'</span>'; }
			else{ echo "Sku has not been defined."; } ?>
        </div>

	<?php }
	
}