<?php // phpcs:disable Squiz.PHP.CommentedOutCode.Found
namespace AnantAddons;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Background;
use Elementor\Core\Schemes;
use Elementor\Group_Control_Box_Shadow;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class AnantCheckoutPage extends Widget_Base {

	public function __construct( $data = [], $args = null ) {
		parent::__construct( $data, $args );
			if ( is_null( WC()->cart ) ) {
				include_once WC_ABSPATH . 'includes/wc-cart-functions.php';
				include_once WC_ABSPATH . 'includes/class-wc-cart.php';
				wc_load_cart();
		}
	}

	public function get_name() {
		return 'anant-checkout-page';
	}

	public function get_title() {
		return esc_html__( 'Checkout Page ', 'anant-addons-for-elementor' );
	}

	public function get_icon() {
		return 'ant-icon eicon-form-horizontal';
	}

	public function get_categories() {
		return [ 'anant-woo-elements' ];
	}

	public function get_keywords() {
		return [
			'checkout',
			'product',
			'billing',
			'anant addons',
			'',
			'woo',
		];
	}

	protected function register_controls() {
		$this->start_controls_section(
			'general_setting_section',
			[
				'label' => esc_html__( 'General Settings', 'anant-addons-for-elementor' ),
			]
		);

		$this->add_control(
            'apply_changes',
            [
                'type' => Controls_Manager::RAW_HTML,
                'raw' => '<div class="elementor-update-preview editor-anant-preview-update"><span style="margin-right:10px;">Update changes to Preview</span><button class="elementor-button elementor-button-success" onclick="elementor.reloadPreview();">Apply</button>',
                'separator' => 'after'
            ]
        );

		$this->end_controls_section();

		$this->start_controls_section(
			'anant_woo_checkout_section_title',
			[
				'label' => esc_html__( 'Section Title', 'anant-addons-for-elementor' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);
		$slug = 'checkout_section_title';
		anant_color_control(
			$this,
			[
				'key'       => $slug.'_color',
				'label'     => 'Color',
				'selectors' => [
					'{{WRAPPER}} h3, {{WRAPPER}} .woo-checkout-section-title, {{WRAPPER}} .anant-woocommerce-checkout #customer_details h3' => 'color: {{VALUE}};',
				],
			]
		);
		anant_typography_control(
			$this,
			[
				'name'     => $slug.'_typography',
				'label'    => 'Typography',
				'selector' => '{{WRAPPER}} h3, {{WRAPPER}} .woo-checkout-section-title, {{WRAPPER}} .anant-woocommerce-checkout #customer_details h3',
			]
		);
		$this->add_responsive_control(
			'bottom_gap',
			[
				'label'           => esc_html__( 'Bottom Gap', 'anant-addons-for-elementor' ),
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
				'default_desktop' => [
					'size' =>  '',
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
					'{{WRAPPER}} h3' => 'margin-bottom: {{SIZE}}{{UNIT}}!important;',
					'{{WRAPPER}} .woo-checkout-section-title' => 'margin-bottom: {{SIZE}}{{UNIT}}!important;',
					'{{WRAPPER}} .anant-woocommerce-checkout #customer_details h3' => 'margin-bottom: {{SIZE}}{{UNIT}}!important;',
				],
			]
		);
		$this->end_controls_section();

		$this->start_controls_section(
			'anant_woo_checkout_customer_details',
			[
				'label' => esc_html__( 'Customer Details', 'anant-addons-for-elementor' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);
		$slug = 'checkout_customer_details';
		$this->add_control(
			$slug.'_label',
			[
				'label' => __( 'Label', 'anant-addons-for-elementor' ),
				'type' => Controls_Manager::HEADING,
			]
		);
		anant_color_control(
			$this,
			[
				'key'       =>  $slug.'_label_color',
				'label'     => 'Color',
				'selectors' => [
					'{{WRAPPER}} #customer_details label' => 'color: {{VALUE}};',
				],
			]
		);
		anant_typography_control(
			$this,
			[
				'name'     =>  $slug.'_label_typography',
				'label'    => 'Typography',
				'selector' => '{{WRAPPER}} #customer_details label',
			]
		);
		$this->add_responsive_control(
			$slug.'_label_spacing',
			[
				'label'     => esc_html__('Spacing', 'anant-addons-for-elementor'),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' =>[
					'{{WRAPPER}} #customer_details label' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_control(
			$slug.'_field_required',
			[
				'label' => __( 'Required (*)', 'anant-addons-for-elementor' ),
				'type' => Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);
		anant_color_control(
			$this,
			[
				'key'       =>  $slug.'_required_color',
				'label'     => 'Color',
				'selectors' => [
					'{{WRAPPER}} #customer_details label .required' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			$slug.'_fields',
			[
				'label' => __( 'Fields', 'anant-addons-for-elementor' ),
				'type' => Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);

		$this->add_responsive_control(
			'inputs_height',
			[
				'label'           => esc_html__( 'Input Height', 'anant-addons-for-elementor' ),
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
				'default_desktop' => [
					'size' =>  '',
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
					'{{WRAPPER}} .anant-woocommerce-checkout .woocommerce .woocommerce-checkout .form-row input.input-text' => 'height: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .anant-woocommerce-checkout .woocommerce .woocommerce-checkout .form-row select, .eael-woo-checkout' => 'height: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .anant-woocommerce-checkout .select2-container .select2-selection--single' => 'height: {{SIZE}}{{UNIT}};',
				],
			]
		);
		anant_color_control(
			$this,
			[
				'key'       =>  $slug.'_field_color',
				'label'     => 'Color',
				'selectors' => [
					'{{WRAPPER}} #customer_details input, {{WRAPPER}} #customer_details select, {{WRAPPER}} #customer_details textarea' => 'color: {{VALUE}};',
				],
			]
		);
		anant_color_control(
			$this,
			[
				'key'       =>  $slug.'_field_bg_color',
				'label'     => 'Background Color',
				'selectors' => [
					'{{WRAPPER}} #customer_details input, {{WRAPPER}} #customer_details select, {{WRAPPER}} #customer_details textarea' => 'background-color: {{VALUE}};',
				],
			]
		);
		anant_border_control(
			$this,
			[
				'name'     =>  $slug.'_field_border_color',
				'label'    => 'Border Type',
				'selector' => '
					{{WRAPPER}} #customer_details input, 
					{{WRAPPER}} #customer_details .select, 
					{{WRAPPER}} #customer_details .select2-container--default .select2-selection--single, 
					{{WRAPPER}} #customer_details textarea',
			]
		);

		anant_border_control(
			$this,
			[
				'name'     =>  $slug.'_field_border_color_hover',
				'fields_options' => [
					'border' => [
						'label' => 'Border Hover/Focus',
					],
				],
				'selector' => '
					{{WRAPPER}} #customer_details input:hover, 
					{{WRAPPER}} #customer_details input:focus, 
					{{WRAPPER}} #customer_details input:active , {{WRAPPER}} #customer_details textarea:hover, 
					{{WRAPPER}} #customer_details textarea:focus, {{WRAPPER}} #customer_details textarea:active',
			]
		);

		anant_border_radius_control(
			$this,
			[
				'key'       =>  $slug.'_field_border_radius',
				'label'     => 'Border Radius',
				'selectors' => [
					'{{WRAPPER}} #customer_details input' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					'{{WRAPPER}} #customer_details select' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					'{{WRAPPER}} #customer_details .select2-container--default .select2-selection--single' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					'{{WRAPPER}} #customer_details textarea' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_responsive_control(
			$slug.'_field_spacing',
			[
				'label' => __( 'Bottom Spacing (PX)', 'anant-addons-for-elementor' ),
				'type' => Controls_Manager::SLIDER,
				'default' => [
					'size' => 5,
				],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 60,
					],
				],
				'selectors' => [
					'{{WRAPPER}} #customer_details .form-row' => 'margin-bottom: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'anant_woo_checkout_order_review_style',
			[
				'label' => esc_html__( 'Order Details', 'anant-addons-for-elementor' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);
		$slug = 'checkout_order_review';
		anant_color_control(
			$this,
			[
				'key'       => $slug.'_bg_color',
				'label'     => 'Background Color',
				'selectors' => [
					'{{WRAPPER}} .woocommerce-checkout-review-order' => 'background-color: {{VALUE}};',
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
					'{{WRAPPER}} .woocommerce-checkout-review-order' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		anant_border_radius_control(
			$this,
			[
				'key'       => $slug.'_border_radius',
				'label'     => 'Border Radius',
				'selectors' => [
					'{{WRAPPER}} .woocommerce-checkout-review-order'  => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_control(
			$slug.'_head',
			[
				'label' => __( 'Table Head', 'anant-addons-for-elementor' ),
				'type' => Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);
		anant_color_control(
			$this,
			[
				'key'       =>  $slug.'_header_color',
				'label' => esc_html__( 'Header Color', 'anant-addons-for-elementor' ),
				'selectors' => [
					'{{WRAPPER}} .woocommerce-checkout-review-order thead th' => 'color: {{VALUE}};',
					'{{WRAPPER}} .anant-woocommerce-checkout table.shop_table th' => 'color: {{VALUE}};',
				],
			]
		);
		anant_typography_control(
			$this,
			[
				'name'     => $slug.'_header_typo',
				'label'    => 'Typography',
				'selector' => '{{WRAPPER}} .woocommerce-checkout-review-order thead th, {{WRAPPER}} .anant-woocommerce-checkout table.shop_table th',
			]
		);
		$this->add_control(
			$slug.'_table_body',
			[
				'label' => __( 'Table Body', 'anant-addons-for-elementor' ),
				'type' => Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);
		anant_color_control(
			$this,
			[
				'key'       => $slug.'_row_color',
				'label' => esc_html__( 'Color', 'anant-addons-for-elementor' ),
				'selectors' => [
					'{{WRAPPER}} .woocommerce-checkout-review-order .cart_item' => 'color: {{VALUE}};',
				],
			]
		);
		anant_typography_control(
			$this,
			[
				'name'     => $slug.'_row_typography',
				'label'    => 'Typography',
				'selector' => '{{WRAPPER}}  .woocommerce-checkout-review-order .cart_item',
			]
		);
        $this->add_control(
            $slug.'_total',
            [
                'label' => __( 'Total', 'anant-addons-for-elementor' ),
                'type' => Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );
		anant_color_control(
			$this,
			[
				'key'       => $slug.'_total_color',
                'default' => '#ffffff',
				'label'     => 'Color',
				'selectors' => [
					'{{WRAPPER}} .woocommerce-checkout-review-order tfoot tr' => 'color: {{VALUE}};',
				],
			]
		);
        anant_typography_control(
			$this,
			[
				'name'     => $slug.'_total_typo',
				'label'    => 'Typography',
				'selector' => '{{WRAPPER}}  .woocommerce-checkout-review-order tfoot tr',
			]
		);
		anant_border_control(
			$this,
			[
				'name'     => $slug.'_total_border',
				'fields_options' => [
					'border' => [
						'label' => 'Inner Table Border',
					],
				],
				'selector' => '
					{{WRAPPER}} .anant-woocommerce-checkout table.shop_table td, 
					{{WRAPPER}} .anant-woocommerce-checkout table.shop_table th, 
					{{WRAPPER}} .anant-woocommerce-checkout .woocommerce table.shop_table tfoot th',
			]
		);
		$this->end_controls_section();

		/**
		 * -------------------------------------------
		 * Tab Style Notices
		 * -------------------------------------------
		 */	
		$this->start_controls_section(
			'checkout_notice_section',
			[
				'label' => esc_html__( 'Notices', 'anant-addons-for-elementor' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);
		$slug = 'checkout_notice';
		anant_border_control(
			$this,
			[
				'name'     =>  $slug.'_border_type',
				'exclude'        => [ 'color' ],
				'fields_options' => [
					'border' => [
						'label' => 'Border Type',
					],
				],
				'selector' => '
				{{WRAPPER}} .anant-woocommerce-checkout .woocommerce-message, 
				{{WRAPPER}} .anant-woocommerce-checkout .woocommerce-error,
				{{WRAPPER}} .anant-woocommerce-checkout .woocommerce-info',
			]
		);
		anant_border_radius_control(
			$this,
			[
				'key'       => $slug.'_border_radius',
				'label'     => 'Border Radius',
				'selectors' => [
					'{{WRAPPER}} .anant-woocommerce-checkout .woocommerce-message' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					'{{WRAPPER}} .anant-woocommerce-checkout .woocommerce-error' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					'{{WRAPPER}} .anant-woocommerce-checkout .woocommerce-info' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
					'{{WRAPPER}} .anant-woocommerce-checkout .woocommerce-message' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					'{{WRAPPER}} .anant-woocommerce-checkout .woocommerce-error' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					'{{WRAPPER}} .anant-woocommerce-checkout .woocommerce-info' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
					'{{WRAPPER}} .anant-woocommerce-checkout .woocommerce-message' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					'{{WRAPPER}} .anant-woocommerce-checkout .woocommerce-error' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					'{{WRAPPER}} .anant-woocommerce-checkout .woocommerce-info' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		anant_box_shadow_control(
			$this,
			[
				'key'      => $slug.'_box_shadow',
				'label'    => 'Box Shadow',
				'selector' => '
				{{WRAPPER}} .anant-woocommerce-checkout .woocommerce-message, 
				{{WRAPPER}} .anant-woocommerce-checkout .woocommerce-error,
				{{WRAPPER}} .anant-woocommerce-checkout .woocommerce-info',
			]
		);

		$this->start_controls_tabs( $slug.'_tabs' );

		// message notice
		$this->start_controls_tab(
			$slug.'_message_style',
			[
				'label' => __( 'Message', 'anant-addons-for-elementor' ),
			]
		);
		
		$this->add_control(
			$slug.'_message_bg_color',
			[
				'label'     => __( 'Background Color', 'anant-addons-for-elementor' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .anant-woocommerce-checkout .woocommerce-message' => 'background-color: {{VALUE}}',
				],
			]
		);
		$this->add_control(
			$slug.'_message_color',
			[
				'label'     => __( 'Color', 'anant-addons-for-elementor' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .anant-woocommerce-checkout .woocommerce-message' => 'color: {{VALUE}}',
				],
			]
		);
		$this->add_control(
			$slug.'_message_icon_color',
			[
				'label'     => __( 'Icon Color', 'anant-addons-for-elementor' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .anant-woocommerce-checkout .woocommerce-message:before' => 'color: {{VALUE}}',
				],
			]
		);
		$this->add_control(
			$slug.'_message_border_color',
			[
				'label'     => __( 'Border Color', 'anant-addons-for-elementor' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .anant-woocommerce-checkout .woocommerce-message' => 'border-color: {{VALUE}}',
				],
			]
		);
		anant_typography_control(
			$this,
			[
				'name'     => $slug.'_message_typography',
				'label'    => 'Typography',
				'selector' => '{{WRAPPER}} .anant-woocommerce-checkout .woocommerce-message',
			]
		);	
		$this->end_controls_tab();
		// end message notice
		
		// error notice
		$this->start_controls_tab(
			$slug.'_style_error',
			[
				'label' => __( 'Error', 'anant-addons-for-elementor' ),

			]
		);
		$this->add_control(
			$slug.'_error_bg_color',
			[
				'label'     => __( 'Background Color', 'anant-addons-for-elementor' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .anant-woocommerce-checkout .woocommerce-error' => 'background-color: {{VALUE}}',
				],
			]
		);
		$this->add_control(
			$slug.'_error_color',
			[
				'label'     => __( 'Color', 'anant-addons-for-elementor' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .anant-woocommerce-checkout .woocommerce-error' => 'color: {{VALUE}}',
				],
			]
		);
		$this->add_control(
			$slug.'_error_icon_color',
			[
				'label'     => __( 'Icon Color', 'anant-addons-for-elementor' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .anant-woocommerce-checkout .woocommerce-error:before' => 'color: {{VALUE}}',
				],
			]
		);
		$this->add_control(
			$slug.'_error_border_color',
			[
				'label'     => __( 'Border Color', 'anant-addons-for-elementor' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .anant-woocommerce-checkout .woocommerce-error' => 'border-color: {{VALUE}}',
				],
			]
		);
		anant_typography_control(
			$this,
			[
				'name'     => $slug.'_error_typography',
				'label'    => 'Typography',
				'selector' => '{{WRAPPER}} .anant-woocommerce-checkout .woocommerce-error',
			]
		);
		$this->end_controls_tab();
		// end error notice
		
		// info notice
		$this->start_controls_tab(
			$slug.'_style_info',
			[
				'label' => __( 'Info', 'anant-addons-for-elementor' ),

			]
		);
		$this->add_control(
			$slug.'_info_bg_color',
			[
				'label'     => __( 'Background Color', 'anant-addons-for-elementor' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .anant-woocommerce-checkout .woocommerce-info' => 'background-color: {{VALUE}}',
				],
			]
		);
		$this->add_control(
			$slug.'_info_color',
			[
				'label'     => __( 'Color', 'anant-addons-for-elementor' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .anant-woocommerce-checkout .woocommerce-info' => 'color: {{VALUE}}',
				],
			]
		);
		$this->add_control(
			$slug.'_info_icon_color',
			[
				'label'     => __( 'Icon Color', 'anant-addons-for-elementor' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .anant-woocommerce-checkout .woocommerce-info:before' => 'color: {{VALUE}}',
					'{{WRAPPER}} .anant-woocommerce-checkout .woocommerce-info a' => 'color: {{VALUE}}',
				],
			]
		);
		$this->add_control(
			$slug.'_info_border_color',
			[
				'label'     => __( 'Border Color', 'anant-addons-for-elementor' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .anant-woocommerce-checkout .woocommerce-info' => 'border-color: {{VALUE}}',
				],
			]
		);
		anant_typography_control(
			$this,
			[
				'name'     => $slug.'_info_typography',
				'label'    => 'Typography',
				'selector' => '{{WRAPPER}} .anant-woocommerce-checkout .woocommerce-info',
			]
		);
		$this->end_controls_tab();
		$this->end_controls_tabs();
		$this->end_controls_section();

		// Coupon Form
		$this->start_controls_section(
			'section_style_coupon_form',
			[
				'label' => esc_html__( 'Coupon', 'anant-addons-for-elementor' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);
		$slug = 'anant_checkout_coupon';
		// Lebal
		$this->add_control(
			$slug.'_label',
			[
				'label' => __( 'Lebal', 'anant-addons-for-elementor' ),
				'type' => Controls_Manager::HEADING,
			]
		);
		anant_color_control(
			$this,
			[
				'key'       => $slug.'_lebal_color',
				'label'     => 'Color',
				'selectors' => [
					'{{WRAPPER}} .anant-woocommerce-checkout .checkout_coupon p' => 'color: {{VALUE}};',
				],
			]
		);
		anant_typography_control(
			$this,
			[
				'name'     => $slug.'_lebal_typo',
				'label'    => 'Typography',
				'selector' => '{{WRAPPER}} .anant-woocommerce-checkout .checkout_coupon p',
			]
		);	
		$this->add_control(
			$slug.'_input_field',
			[
				'label' => __( 'Input Field', 'anant-addons-for-elementor' ),
				'type' => Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);
		anant_color_control(
			$this,
			[
				'key'       => $slug.'_color',
				'label'     => 'Color',
				'selectors' => [
					'{{WRAPPER}} .anant-woocommerce-checkout #coupon_code' => 'color: {{VALUE}};',
				],
			]
		);

		anant_color_control(
			$this,
			[
				'key'       => $slug.'_bg_color',
				'label'     => 'Background Color',
				'selectors' => [
					'{{WRAPPER}} .anant-woocommerce-checkout #coupon_code' => 'background-color: {{VALUE}};',
				],
			]
		);

		anant_color_control(
			$this,
			[
				'key'       => $slug.'_placeholder_color',
				'label'     => 'Placeholder Color',
				'selectors' => [
					'{{WRAPPER}} .anant-woocommerce-checkout #coupon_code::placeholder' => 'color: {{VALUE}};',
				],
			]
		);

		anant_typography_control(
			$this,
			[
				'name'     => $slug.'_typography',
				'label'    => 'Typography',
				'selector' => '{{WRAPPER}}  .anant-woocommerce-checkout #coupon_code',
			]
		); 

		anant_border_control(
			$this,
			[
				'name'     => $slug.'_border_type_hover',
				'label'    => 'Border Type',
				'selector' => '{{WRAPPER}} .anant-woocommerce-checkout #coupon_code',
			]
		);

		anant_border_radius_control(
			$this,
			[
				'key'       => $slug.'_border_radius_hover',
				'label'     => 'Border Radius',
				'selectors' => [
					'{{WRAPPER}} .anant-woocommerce-checkout #coupon_code' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					'{{WRAPPER}} .anant-woocommerce-checkout #coupon_code' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
					'{{WRAPPER}} .anant-woocommerce-checkout #coupon_code' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
					'{{WRAPPER}} .anant-woocommerce-checkout #coupon_code' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		anant_box_shadow_control(
			$this,
			[
				'key'      => $slug.'_shadow',
				'label'    => 'Box Shadow',
				'selector' => '{{WRAPPER}}  .anant-woocommerce-checkout #coupon_code' ,
			]
		);
		$this->add_control(
			$slug.'hr',
			[
				'type' => \Elementor\Controls_Manager::DIVIDER,
			]
		);
		$this->add_control(
			$slug.'_btn_heading',
			[
				'label' => esc_html__( 'Button', 'anant-addons-for-elementor' ),
				'type' => \Elementor\Controls_Manager::HEADING,
			]
		);

		$slug = $slug.'_btn';
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
				'key'       => $slug.'_color',
				'label'     => 'Color',
				'selectors' => [
					'{{WRAPPER}} .anant-woocommerce-checkout .checkout_coupon .button[name="apply_coupon"]' => 'color: {{VALUE}};',
				],
			]
		);

		anant_color_control(
			$this,
			[
				'key'       => $slug.'_bg_color',
				'label'     => 'Background Color',
				'selectors' => [
					'{{WRAPPER}} .anant-woocommerce-checkout .checkout_coupon .button[name="apply_coupon"]' => 'background-color: {{VALUE}};',
				],
			]
		);
		
		anant_border_control(
			$this,
			[
				'name'     => $slug.'_border_type',
				'label'    => 'Border Type',
				'selector' => '{{WRAPPER}} .anant-woocommerce-checkout .checkout_coupon .button[name="apply_coupon"]',
			]
		);
		$this->end_controls_tab();

		$this->start_controls_tab(
			$slug.'_normal_style_hover',
			[
				'label' => __( 'Hover', 'anant-addons-for-elementor' ),
			]
		);

		anant_color_control(
			$this,
			[
				'key'       => $slug.'_hover_color',
				'label'     => 'Color',
				'selectors' => [
					'{{WRAPPER}} .anant-woocommerce-checkout .checkout_coupon .button[name="apply_coupon"]:hover' => 'color: {{VALUE}};',
				],
			]
		);

		anant_color_control(
			$this,
			[
				'key'       => $slug.'_bg_hover_color',
				'label'     => 'Background Color',
				'selectors' => [
					'{{WRAPPER}} .anant-woocommerce-checkout .checkout_coupon .button[name="apply_coupon"]:hover' => 'background-color: {{VALUE}};',
				],
			]
		);		
		anant_border_control(
			$this,
			[
				'name'     => $slug.'_border_hover',
				'label'    => 'Border Type',
				'selector' => '{{WRAPPER}} .anant-woocommerce-checkout .checkout_coupon .button[name="apply_coupon"]:hover',
			]
		);

		$this->end_controls_tab(); 
		$this->end_controls_tabs(); 

		anant_border_radius_control(
			$this,
			[
				'key'       => $slug.'_border_radius',
				'label'     => 'Border Radius',
				'selectors' => [
					'{{WRAPPER}} .anant-woocommerce-checkout .checkout_coupon .button[name="apply_coupon"]' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
				'separator' => 'before',
			]
		);
		anant_typography_control(
			$this,
			[
				'name'     => $slug.'_typography',
				'label'    => 'Typography',
				'selector' => '{{WRAPPER}}  .anant-woocommerce-checkout .checkout_coupon .button[name="apply_coupon"]',
			]
		); 

		$this->add_responsive_control(
			$slug.'_padding',
			[
				'label'     => esc_html__('Padding', 'anant-addons-for-elementor'),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' =>[
					'{{WRAPPER}} .anant-woocommerce-checkout .checkout_coupon .button[name="apply_coupon"]' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
					'{{WRAPPER}} .anant-woocommerce-checkout .checkout_coupon .button[name="apply_coupon"]' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		anant_box_shadow_control(
			$this,
			[
				'key'      => $slug.'_box_shadow',
				'label'    => 'Box Shadow',
				'selector' => '{{WRAPPER}} .anant-woocommerce-checkout .checkout_coupon .button[name="apply_coupon"]',
			]
		);
		$this->end_controls_section();
		// End Coupon Form

		if( true ) {
			$this->start_controls_section(
				'anant_woo_checkout_pickup_point_style',
				[
					'label' => esc_html__( 'Pickup Point', 'anant-addons-for-elementor' ),
					'tab' => Controls_Manager::TAB_STYLE,
				]
			);

			$slug = 'checkout_pickup_point';
			anant_color_control(
				$this,
				[
					'key'       => $slug.'_title_color',
					'label'     => 'Title Color',
					'selectors' => [
						'{{WRAPPER}} .anant-rating .anant-star-rating i::before' => 'color: {{VALUE}};',
					],
				]
			);

			$this->start_controls_tabs($slug.'_tabs');
			$this->start_controls_tab($slug.'_tab_normal', ['label' => __('Normal', 'anant-addons-for-elementor')]);

			anant_color_control(
				$this,
				[
					'key'       => $slug.'_btn_bg_color',
					'label'     => 'Background Color',
					'selectors' => [
						'{{WRAPPER}} .anant-rating .anant-star-rating i::before' => 'color: {{VALUE}};',
					],
				]
			);

			anant_color_control(
				$this,
				[
					'key'       => $slug.'_btn_color',
					'label'     => 'Color',
					'selectors' => [
						'{{WRAPPER}} .anant-rating .anant-star-rating i::before' => 'color: {{VALUE}};',
					],
				]
			);

			anant_border_control(
				$this,
				[
					'name'     => $slug.'_btn_border_type',
					'label'    => 'Border Type',
					'selector' => '{{WRAPPER}} .bdi',
				]
			);
	
			anant_border_radius_control(
				$this,
				[
					'key'       => $slug.'_btn_border_radius',
					'label'     => 'Border Radius',
					'selectors' => [
						'{{WRAPPER}} .bdi' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
						'{{WRAPPER}} .bdi' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					],
				]
			);

			$this->end_controls_tab();

			$this->start_controls_tab($slug.'_tab_hover', ['label' => __('Hover', 'anant-addons-for-elementor')]);

			anant_color_control(
				$this,
				[
					'key'       => $slug.'_btn_bg_color_hover',
					'label'     => 'Background Color',
					'selectors' => [
						'{{WRAPPER}} .anant-rating .anant-star-rating i::before' => 'color: {{VALUE}};',
					],
				]
			);

			anant_color_control(
				$this,
				[
					'key'       => $slug.'_btn_color_hover',
					'label'     => 'Color',
					'selectors' => [
						'{{WRAPPER}} .anant-rating .anant-star-rating i::before' => 'color: {{VALUE}};',
					],
				]
			);

			anant_border_control(
				$this,
				[
					'name'     => $slug.'_btn_hover_border_type',
					'label'    => 'Border Type',
					'selector' => '{{WRAPPER}} .bdi',
				]
			);
	
			anant_border_radius_control(
				$this,
				[
					'key'       => $slug.'_btn_hover_border_radius',
					'label'     => 'Border Radius',
					'selectors' => [
						'{{WRAPPER}} .bdi' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
						'{{WRAPPER}} .bdi' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					],
				]
			);

			$this->end_controls_tab();
			$this->end_controls_tabs();
			$this->end_controls_section();
		}

		/**
		 * -------------------------------------------
		 * Tab Style Payment
		 * -------------------------------------------
		 */
		$this->start_controls_section(
			'anant_woo_checkout_payment_style',
			[
				'label' => esc_html__( 'Payment', 'anant-addons-for-elementor' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);
		$slug = 'anant_checkout_payment';
		anant_color_control(
			$this,
			[
				'key'       => 'anant_checkout_payment_bg_color',
				'label'     => 'Background Color',
				'selectors' => [
					'{{WRAPPER}} .woocommerce-checkout-payment' => 'background-color: {{VALUE}} !important;',
				],
			]
		);

		$this->add_responsive_control(
			'anant_checkout_payment_padding',
			[
				'label'     => esc_html__('Padding', 'anant-addons-for-elementor'),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' =>[
					'{{WRAPPER}} .woocommerce-checkout-payment' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}} !important;',
				],
			]
		);

		$this->add_responsive_control(
			'anant_checkout_payment_border_radius',
			[
				'label'     => esc_html__('Border Radius', 'anant-addons-for-elementor'),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' =>[
					'{{WRAPPER}} .woocommerce-checkout-payment' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}} !important;',
				],
			]
		);

		// Label
		$this->add_control(
			'anant_checkout_payment_label',
			[
				'label' => __( 'Label', 'anant-addons-for-elementor' ),
				'type' => Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);
		anant_typography_control(
			$this,
			[
				'name'     => 'anant_checkout_payment_label_typography',
				'label'    => 'Typography',
				'selector' => '{{WRAPPER}}  .',
			]
		);

		$this->start_controls_tabs( 'anant_checkout_payment_label_tabs' );
		$this->start_controls_tab(
			'anant_checkout_payment_label_tab_normal',
			[
				'label' => __( 'Normal', 'anant-addons-for-elementor' ),
			]
		);

		anant_color_control(
			$this,
			[
				'key'       => 'anant_checkout_payment_label_color',
				'label'     => 'Color',
				'selectors' => [
					'{{WRAPPER}} .anant-rating .anant-star-rating i::before' => 'color: {{VALUE}};',
				],
			]
		);
		$this->end_controls_tab();

		$this->start_controls_tab(
			'anant_checkout_payment_label_tab_hover',
			[
				'label' => __( 'Selected', 'anant-addons-for-elementor' ),
			]
		);

		anant_color_control(
			$this,
			[
				'key'       => 'anant_checkout_payment_label_color_select',
				'label'     => 'Color',
				'selectors' => [
					'{{WRAPPER}} .anant-rating .anant-star-rating i::before' => 'color: {{VALUE}};',
				],
			]
		);
		$this->end_controls_tab();
		$this->end_controls_tabs();

		// Info
		$this->add_control(
			'anant_checkout_payment_info',
			[
				'label' => __( 'Methods Info', 'anant-addons-for-elementor' ),
				'type' => Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);
		anant_color_control(
			$this,
			[
				'key'       => 'anant_checkout_payment_methods_bg_color',
				'label'     => 'Background Color',
				'selectors' => [
					'{{WRAPPER}} .anant-rating .anant-star-rating i::before' => 'color: {{VALUE}};',
				],
			]
		);
		$slug = $slug.'_privacy_policy';
		// Privacy Policy
		$this->add_control(
			$slug,
			[
				'label' => __( 'Privacy Policy', 'anant-addons-for-elementor' ),
				'type' => Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);
		anant_color_control(
			$this,
			[
				'key'       => $slug.'_color',
				'label'     => 'Color',
				'selectors' => [
					'{{WRAPPER}} .anant-woocommerce-checkout .woocommerce-privacy-policy-text p' => 'color: {{VALUE}};',
				],
			]
		);
		anant_typography_control(
			$this,
			[
				'name'     => $slug.'_typo',
				'label'    => 'Typography',
				'selector' => '{{WRAPPER}} .anant-woocommerce-checkout .woocommerce-privacy-policy-text p',
			]
		);
		anant_color_control(
			$this,
			[
				'key'       => $slug.'_link_color',
				'label'     => 'Link Color',
				'selectors' => [
					'{{WRAPPER}} .anant-woocommerce-checkout .woocommerce-privacy-policy-text p a' => 'color: {{VALUE}};',
				],
			]
		);
		anant_color_control(
			$this,
			[
				'key'       => $slug.'_link_hover_color',
				'label'     => 'Link Hover Color',
				'selectors' => [
					'{{WRAPPER}} .anant-woocommerce-checkout .woocommerce-privacy-policy-text p a:hover' => 'color: {{VALUE}};',
				],
			]
		);
		// anant_border_control(
		// 	$this,
		// 	[
		// 		'name'     => 'anant_checkout_privacy_border_type',
		// 		'label'    => 'Border Type',
		// 		'selector' => '{{WRAPPER}} .bdi',
		// 	]
		// );

		// anant_border_radius_control(
		// 	$this,
		// 	[
		// 		'key'       => 'anant_checkout_privacy_border_radius',
		// 		'label'     => 'Border Radius',
		// 		'selectors' => [
		// 			'{{WRAPPER}} .bdi' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
		// 			'{{WRAPPER}} .bdi' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
		// 		],
		// 	]
		// );

		$this->add_control(
			$slug.'hr',
			[
				'type' => \Elementor\Controls_Manager::DIVIDER,
			]
		);
		$this->add_control(
			$slug.'_btn_heading',
			[
				'label' => esc_html__( 'Button', 'anant-addons-for-elementor' ),
				'type' => \Elementor\Controls_Manager::HEADING,
			]
		);

		$slug = $slug.'_btn';
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
				'key'       => $slug.'_color',
				'label'     => 'Color',
				'selectors' => [
					'{{WRAPPER}} .anant-woocommerce-checkout #place_order' => 'color: {{VALUE}};',
				],
			]
		);

		anant_color_control(
			$this,
			[
				'key'       => $slug.'_bg_color',
				'label'     => 'Background Color',
				'selectors' => [
					'{{WRAPPER}} .anant-woocommerce-checkout #place_order' => 'background-color: {{VALUE}};',
				],
			]
		);

		anant_border_control(
			$this,
			[
				'name'     => $slug.'_border_type',
				'label'    => 'Border Type',
				'selector' => '{{WRAPPER}} .anant-woocommerce-checkout #place_order',
			]
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
			$slug.'_normal_style_hover',
			[
				'label' => __( 'Hover', 'anant-addons-for-elementor' ),
			]
		);

		anant_color_control(
			$this,
			[
				'key'       => $slug.'_hover_color',
				'label'     => 'Color',
				'selectors' => [
					'{{WRAPPER}} .anant-woocommerce-checkout #place_order:hover' => 'color: {{VALUE}};',
				],
			]
		);

		anant_color_control(
			$this,
			[
				'key'       => $slug.'_bg_hover_color',
				'label'     => 'Background Color',
				'selectors' => [
					'{{WRAPPER}} .anant-woocommerce-checkout #place_order:hover' => 'background-color: {{VALUE}};',
				],
			]
		);	
		anant_border_control(
			$this,
			[
				'name'     => $slug.'_border_hover_type',
				'label'    => 'Border Type',
				'selector' => '{{WRAPPER}} .anant-woocommerce-checkout #place_order:hover',
			]
		);
	
		$this->end_controls_tab(); 
		$this->end_controls_tabs(); 

		anant_border_radius_control(
			$this,
			[
				'key'       => $slug.'_border_radius',
				'label'     => 'Border Radius',
				'selectors' => [
					'{{WRAPPER}} .anant-woocommerce-checkout #place_order' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
				'separator' => 'before',
			]
		);
		anant_typography_control(
			$this,
			[
				'name'     => $slug.'_typography',
				'label'    => 'Typography',
				'selector' => '{{WRAPPER}} .anant-woocommerce-checkout #place_order',
			]
		); 

		$this->add_responsive_control(
			$slug.'_padding',
			[
				'label'     => esc_html__('Padding', 'anant-addons-for-elementor'),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' =>[
					'{{WRAPPER}} .anant-woocommerce-checkout #place_order' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
					'{{WRAPPER}} .anant-woocommerce-checkout #place_order' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		anant_box_shadow_control(
			$this,
			[
				'key'      => $slug.'_box_shadow',
				'label'    => 'Box Shadow',
				'selector' => '{{WRAPPER}} .anant-woocommerce-checkout #place_order',
			]
		);
		$this->end_controls_section();
	}

	public function render() {
		$settings = $this->get_settings_for_display();

		echo '<div class="anant-woocommerce-checkout" id="anant-checkout-page">';
		echo do_shortcode('[woocommerce_checkout]');
		echo '</div>';
	}
}