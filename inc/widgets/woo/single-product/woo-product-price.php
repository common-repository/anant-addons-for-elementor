<?php
namespace AnantAddons;

use Elementor\Controls_Manager;
use Elementor\Group_Control_Background;
use Elementor\Group_Control_Text_Stroke;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class AnantProductPrice extends \Elementor\Widget_Base {
	
	public function get_name() {
		return 'anant-product-price';
	}

	public function get_title() {
		return esc_html__( 'Product Price', 'anant-addons-for-elementor' );
	}

	public function get_icon() {
		return 'ant-icon eicon-product-price';
	}

	public function get_categories() {
		return [ 'anant-sng-woo-elements' ];
	}

	public function get_keywords() {
		return [ 'woocommerce', 'product-price', 'product', 'price' ];
	}


	protected function register_controls() {

		// Tab: Content ==============
		// Section: General ----------
		$this->start_controls_section(
			'section_product_title',
			[
				'label' => esc_html__( 'General', 'anant-addons-for-elementor' ),
				'tab' => Controls_Manager::TAB_CONTENT,
			]
		);

        anant_switcher_control(
			$this,
			[
				'key'       => 'price_swap_toggle',
				'label'     => 'Price Position Swap',
				'on_label'  => 'Yes',
				'off_label' => 'No',
				'default'	=> 'No',

			]
		);

        anant_switcher_control(
			$this,
			[
				'key'       => 'price_percentage_toggle',
				'label'     => 'Percentage',
				'on_label'  => 'Yes',
				'off_label' => 'No',
				'default'	=> 'No',

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
					'{{WRAPPER}} .anant-single-price' => 'text-align: {{VALUE}}',
				]
            ]
        );

		$this->end_controls_section(); // End Controls Section

		anant_pro_promotion_controls($this);

		// styles item price
		$this->start_controls_section(
			'single_product_price_style',
			[
				'label'     => __( 'Price', 'anant-addons-for-elementor' ),
				'tab'       => Controls_Manager::TAB_STYLE,
			]
		);
		
		$slug = 'single_product_price';
		
		$this->add_control(
			$slug.'_ragular_heading',
			[
				'label' => esc_html__( 'Ragular', 'anant-addons-for-elementor' ),
				'type' => Controls_Manager::HEADING,
			]
		);

		$this->add_control(
			$slug.'_ragular_color',
			[
				'label'     => __( 'Color', 'anant-addons-for-elementor' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}}  .discount-price' => 'color: {{VALUE}}',
				],
			]
		);

		$this->add_control(
			$slug.'_re_bg_color',
			[
				'label'     => __( 'Background Color', 'anant-addons-for-elementor' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}}  .discount-price' => 'background-color: {{VALUE}}',
				],
			]
		);
	
		anant_typography_control(
		$this,
		[
			'name'     => $slug.'_ragular_typography',
			'label'    => 'Typography',
			'selector' => '{{WRAPPER}}  .discount-price',
		]
		); 

		anant_border_control(
			$this,
			[
				'name'     => $slug.'_ragular_border_type',
				'label'    => 'Border Type',
				'selector' => '{{WRAPPER}}  .discount-price' ,
			]
		);

		anant_border_radius_control(
			$this,
			[
				'key'       => $slug.'_ragular_border_radius',
				'label'     => 'Border Radius',
				'selectors' => [
					'{{WRAPPER}}  .discount-price'  => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			$slug.'_ragular_padding',
			[
				'label'     => esc_html__('Padding', 'anant-addons-for-elementor'),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}}  .discount-price'  => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			$slug.'_ragular_margin',
			[
				'label'     => esc_html__('Margin', 'anant-addons-for-elementor'),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}}  .discount-price'  => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}} !important;',
				],
			]
		);

		anant_box_shadow_control(
			$this,
			[
				'key'      => $slug.'_ragular_box_shadow',
				'label'    => 'Box Shadow',
				'selector' => '{{WRAPPER}}  .discount-price' ,
			]
		);

		anant_text_shadow_control(
			$this,
			[
				'key'      => $slug.'_ragular_text_shadow',
				'label'    => 'Text Shadow',
				'selector' => '{{WRAPPER}} .discount-price',
                'separator' => 'after',
			]
		);

		anant_text_stroke_control(
			$this,
			[
				'key'      => $slug.'_ragular_text_stroke',
				'label'    => 'Text Stroke',
				'selector' => '{{WRAPPER}} .discount-price',
                'separator' => 'after',
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
				'{{WRAPPER}}  .ask-price' => 'color: {{VALUE}}',
				'{{WRAPPER}} .woocommerce-Price-amount bdi' => 'color: {{VALUE}}',
			],
		]
		);

		$this->add_control(
			$slug.'_sale_bg_color',
			[
				'label'     => __( 'Background Color', 'anant-addons-for-elementor' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}}  .ask-price' => 'background-color: {{VALUE}}',
					'{{WRAPPER}} .woocommerce-Price-amount bdi' => 'background-color: {{VALUE}}',
				],
			]
		);

		anant_typography_control(
		$this,
		[
			'name'     => $slug.'_sale_typography',
			'label'    => 'Typography',
			'selector' => '{{WRAPPER}}  .ask-price, {{WRAPPER}} .woocommerce-Price-amount bdi',
		]
		);

		anant_border_control(
			$this,
			[
				'name'     => $slug.'_border_type',
				'label'    => 'Border Type',
				'selector' => '{{WRAPPER}}  .ask-price, {{WRAPPER}} .woocommerce-Price-amount bdi' ,
			]
		);

		anant_border_radius_control(
			$this,
			[
				'key'       => $slug.'_border_radius',
				'label'     => 'Border Radius',
				'selectors' => [
					'{{WRAPPER}} .ask-price'  => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					'{{WRAPPER}} .woocommerce-Price-amount bdi'  => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
					'{{WRAPPER}} .ask-price'  => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					'{{WRAPPER}} .woocommerce-Price-amount bdi'  => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
					'{{WRAPPER}} .ask-price'  => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}} !important;',
					'{{WRAPPER}} .woocommerce-Price-amount bdi'  => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		anant_box_shadow_control(
			$this,
			[
				'key'      => $slug.'_box_shadow',
				'label'    => 'Box Shadow',
				'selector' => '{{WRAPPER}}  .ask-price, {{WRAPPER}} .woocommerce-Price-amount bdi' ,
			]
		);

		anant_text_shadow_control(
			$this,
			[
				'key'      => $slug.'title_shadow',
				'label'    => 'Text Shadow',
				'selector' => '{{WRAPPER}} .ask-price, {{WRAPPER}} .woocommerce-Price-amount bdi',
                'separator' => 'after',
			]
		);

		anant_text_stroke_control(
			$this,
			[
				'key'      => $slug.'text_stroke',
				'label'    => 'Text Stroke',
				'selector' => '{{WRAPPER}} .ask-price, {{WRAPPER}} .woocommerce-Price-amount bdi',
                'separator' => 'after',
			]
		);

		$this->end_controls_section();
		// style item price ends

		$this->start_controls_section(
			'section_style_title',
			[
				'label' => esc_html__( 'Percent Tag', 'anant-addons-for-elementor' ),
				'tab' => Controls_Manager::TAB_STYLE,
				'show_label' => false,
			]
		);

		$slug = 'single_product_price_percentage';

		anant_color_control(
			$this,
			[
				'key'       => $slug.'_color',
				'label'     => esc_html__( 'Color', 'anant-addons-for-elementor' ),
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .anant-discount-tag' => 'color: {{VALUE}}',
				],
			]
		);

		anant_color_control(
			$this,
			[
				'key'       => $slug.'_bg_color',
				'label'     => esc_html__( 'Background Color', 'anant-addons-for-elementor' ),
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .anant-discount-tag' => 'background-color: {{VALUE}}',
				],
			]
		);

		anant_typography_control(
			$this,
			[
				'name'     => $slug.'_typography',
				'label'    => 'Typography',
				'selector' => '{{WRAPPER}} .anant-discount-tag',
			]
		);
		
		anant_border_control(
			$this,
			[
				'name'     => $slug.'_border_type',
				'label'    => 'Border Type',
				'selector' => '{{WRAPPER}} .anant-discount-tag',
			]
		);

		anant_border_radius_control(
			$this,
			[
				'key'       => $slug.'_border_radius',
				'label'     => 'Border Radius',
				'selectors' => [
					'{{WRAPPER}} .anant-discount-tag' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
					'{{WRAPPER}} .anant-discount-tag' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
					'{{WRAPPER}} .anant-discount-tag' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		anant_box_shadow_control(
			$this,
			[
				'key'      => $slug.'_box_shadow',
				'label'    => 'Box Shadow',
				'selector' => '{{WRAPPER}} .anant-discount-tag',
			]
		);

		anant_text_shadow_control(
			$this,
			[
				'key'      => $slug.'_shadow',
				'label'    => 'Text Shadow',
				'selector' => '{{WRAPPER}} .anant-discount-tag',
			]
		);

		anant_text_stroke_control(
			$this,
			[
				'key'      => $slug.'_stroke',
				'label'    => 'Text Stroke',
				'selector' => '{{WRAPPER}} .anant-discount-tag',
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

		$sale_price = $product->get_sale_price(); 
		$price = $product->get_regular_price();

		if($sale_price == "" && $product->is_on_sale()){
			$sale_price = $product->get_price(); 
			$price = $product->regular_price;
		} 
		
		if( $sale_price !== "" && $sale_price !== 0  ){
			$discount_percentage = ( ($price - $sale_price) / $price ) * 100;
		} 

		$symbol = get_woocommerce_currency_symbol();  ?>

			<div class="anant-single-price">
				
				<?php if( $product->is_on_sale() ){ ?>
					<?php if($settings['price_swap_toggle'] === 'yes') { ?>
						<span class="ant-price-amount amount">
							<bdi class="ask-price"><span class="woocommerce-Price-currencySymbol"><?php echo esc_html($symbol); ?></span><?php echo esc_html($sale_price); ?></bdi>
							<bdi class="discount-price"><span class="woocommerce-Price-currencySymbol"><?php echo esc_html($symbol); ?></span><?php echo esc_html($price); ?></bdi>
						</span>
						<?php if($settings['price_percentage_toggle'] === 'yes') { ?>
							<span class="anant-discount-tag">-<?php echo esc_html(round($discount_percentage, 2)); ?>%</span>
						<?php } ?>
					<?php } else { ?>
						<span class="ant-price-amount amount">
							<bdi class="discount-price"><span class="woocommerce-Price-currencySymbol"><?php echo esc_html($symbol); ?></span><?php echo esc_html($price); ?></bdi>
							<bdi class="ask-price"><span class="woocommerce-Price-currencySymbol"><?php echo esc_html($symbol); ?></span><?php echo esc_html($sale_price); ?></bdi>
						</span>
						<?php if($settings['price_percentage_toggle'] === 'yes') { ?>
							<span class="anant-discount-tag">-<?php echo esc_html(round($discount_percentage, 2)); ?>%</span>
						<?php } ?>
					<?php } ?>
				<?php } else { ?>
					<?php echo wp_kses_post( $product->get_price_html() ); ?>
				<?php } ?>

            </div>
	<?php }
	
}