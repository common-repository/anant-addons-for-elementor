<?php // phpcs:disable Squiz.PHP.CommentedOutCode.Found
namespace AnantAddons;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Typography;
use Elementor\Core\Schemes;
use Elementor\Group_Control_Box_Shadow;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class AnantCartPage extends Widget_Base {

	public function __construct( $data = [], $args = null ) {
		parent::__construct( $data, $args );
			if ( is_null( WC()->cart ) ) {
				include_once WC_ABSPATH . 'includes/wc-cart-functions.php';
				include_once WC_ABSPATH . 'includes/class-wc-cart.php';
				wc_load_cart();
		}
	}

	public function get_name() {
		return 'anant-cart-page';
	}

	public function get_title() {
		return esc_html__( 'Cart Page', 'anant-addons-for-elementor' );
	}

	public function get_icon() {
		return 'ant-icon eicon-woo-cart';
	}

	public function get_categories() {
		return [ 'anant-woo-elements' ];
	}

	public function get_keywords() {
		return [
			'cart page',
			'wishlist page',
			'favorite page',
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
		$this->add_control(
			'show_coupon',
			[
				'label' => __( 'Show Coupon Form', 'anant-addons-for-elementor' ),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'label_on' => __( 'Show', 'anant-addons-for-elementor' ),
				'label_off' => __( 'Hide', 'anant-addons-for-elementor' ),
				'return_value' => 'yes',
				'default' => 'yes',
				'prefix_class' => 'ant-woo-coupon-form-',
			]
		);
		$this->add_control(
			'show_c_update',
			[
				'label' => __( 'Show Cart Update Button', 'anant-addons-for-elementor' ),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'label_on' => __( 'Show', 'anant-addons-for-elementor' ),
				'label_off' => __( 'Hide', 'anant-addons-for-elementor' ),
				'return_value' => 'yes',
				'default' => 'yes',
				'prefix_class' => 'ant-woo-cart-update-',
			]
		);
		$this->add_control(
			'show_c_total',
			[
				'label' => __( 'Show Cart Total', 'anant-addons-for-elementor' ),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'label_on' => __( 'Show', 'anant-addons-for-elementor' ),
				'label_off' => __( 'Hide', 'anant-addons-for-elementor' ),
				'return_value' => 'yes',
				'default' => 'yes',
				'prefix_class' => 'ant-woo-cart-total-',
			]
		);
		$this->add_control(
			'show_b_2_shop',
			[
				'label' => __( 'Show Back To Shop', 'anant-addons-for-elementor' ),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'label_on' => __( 'Show', 'anant-addons-for-elementor' ),
				'label_off' => __( 'Hide', 'anant-addons-for-elementor' ),
				'return_value' => 'yes',
				'default' => 'yes',
				'prefix_class' => 'ant-woo-back-to-shop-',
			]
		);
		$this->end_controls_section();

		$this->start_controls_section(
			'general_style',
			[
				'label' => esc_html__( 'General Style', 'anant-addons-for-elementor' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);
		$slug = 'general';
		$this->add_control(
			$slug.'_bg_color',
			[
				'label'     => esc_html__( 'Background Color', 'anant-addons-for-elementor' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .anant-woocommerce-cart .woocommerce' => 'background-color: {{VALUE}};',
				],
			]
		);

		$this->add_responsive_control(
			$slug.'_bg_padding',
			[
				'label'     => esc_html__('Padding', 'anant-addons-for-elementor'),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .anant-woocommerce-cart .woocommerce' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			$slug.'_bg_margin',
			[
				'label'     => esc_html__('Margin', 'anant-addons-for-elementor'),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .anant-woocommerce-cart .woocommerce' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->end_controls_section();

		$this->start_controls_section(
			'heading_style',
			[
				'label' => esc_html__( 'Heading Style', 'anant-addons-for-elementor' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);

		$slug = 'heading';
		$this->add_control(
			$slug.'_color',
			[
				'label'     => esc_html__( 'Color', 'anant-addons-for-elementor' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .anant-woocommerce-cart .shop_table thead tr th' => 'color: {{VALUE}};',
				],
			]
		);

		anant_typography_control(
			$this,
			[
				'name'     => $slug.'_typography',
				'label'    => 'Typography',
				'selector' => '{{WRAPPER}}  .anant-woocommerce-cart .shop_table thead tr th',
			]
		); 

		$this->add_responsive_control(
			$slug.'_padding',
			[
				'label'     => esc_html__('Padding', 'anant-addons-for-elementor'),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .anant-woocommerce-cart .shop_table thead tr th' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->end_controls_section();

		$this->start_controls_section(
			'table_item_section',
			[
				'label' => esc_html__( 'Table Item', 'anant-addons-for-elementor' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);

		$slug = 'table_item';
		anant_color_control(
			$this,
			[
				'key'       => $slug.'_bg_color',
				'label'     => 'Background Color',
				'selectors' => [
					'{{WRAPPER}} .anant-woocommerce-cart .shop_table.woocommerce-cart-form__contents' => 'background-color: {{VALUE}};',
				],
			]
		);
		anant_border_control(
			$this,
			[
				'name'     => $slug.'_inner_border_type',
				'fields_options' => [
					'border' => [
						'label' => 'Inner Table Border',
					],
				],
				'selector' => '
				{{WRAPPER}} .anant-woocommerce-cart .woocommerce-cart-form table.shop_table td, 
				{{WRAPPER}} .anant-woocommerce-cart .woocommerce-cart-form table.shop_table th',
			]
		);
		anant_border_radius_control(
			$this,
			[
				'key'       => $slug.'_border_radius',
				'label'     => 'Border Radius',
				'selectors' => [
					'{{WRAPPER}} .anant-woocommerce-cart .shop_table.shop_table.woocommerce-cart-form__contents' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					'{{WRAPPER}} .anant-woocommerce-cart .shop_table.shop_table.woocommerce-cart-form__contents' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
					'{{WRAPPER}} .anant-woocommerce-cart .shop_table.shop_table.woocommerce-cart-form__contents' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_control(
			'remove_icon_heading',
			[
				'label' => esc_html__( 'Remove Icon', 'anant-addons-for-elementor' ),
				'type' => \Elementor\Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);
		$this->add_responsive_control(
			'remove_icon_alignment',
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
					'{{WRAPPER}}  .anant-woocommerce-cart .product-remove' => 'text-align: {{VALUE}} !important;',
					
				]
			],
		);

		anant_color_control(
			$this,
			[
				'key'       => 'remove_icon_color',
				'label'     => 'Color',
				'selectors' => [
					'{{WRAPPER}} .anant-woocommerce-cart .woocommerce-cart-form__contents .remove' => 'color: {{VALUE}}!important;',
				],
			]
		);

		anant_color_control(
			$this,
			[
				'key'       => 'remove_icon_bg_color',
				'label'     => 'Background Color',
				'selectors' => [
					'{{WRAPPER}} .anant-woocommerce-cart .woocommerce-cart-form__contents .remove' => 'background-color: {{VALUE}};',
				],
			]
		);
		anant_color_control(
			$this,
			[
				'key'       => 'remove_icon_hover_color',
				'label'     => 'Hover Color',
				'selectors' => [
					'{{WRAPPER}} .anant-woocommerce-cart .woocommerce-cart-form__contents .remove:hover' => 'color: {{VALUE}}!important;',
				],
			]
		);

		anant_color_control(
			$this,
			[
				'key'       => 'remove_icon_bg_hover_color',
				'label'     => 'Hover Background Color',
				'selectors' => [
					'{{WRAPPER}} .anant-woocommerce-cart .woocommerce-cart-form__contents .remove:hover' => 'background-color: {{VALUE}};',
				],
			]
		);

		$this->add_responsive_control(
			'removie_icon_width',
			[
				'label'           => __( 'Width', 'anant-addons-for-elementor' ),
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
					'{{WRAPPER}} .anant-woocommerce-cart .woocommerce-cart-form__contents .remove' => 'width: {{SIZE}}{{UNIT}}; height: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'removie_icon_size',
			[
				'label'           => __( 'Size', 'anant-addons-for-elementor' ),
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
					'{{WRAPPER}} .anant-woocommerce-cart .woocommerce-cart-form__contents .remove' => 'font-size: {{SIZE}}{{UNIT}};',
				],
				'separator' => 'after',

			]
		);

		$this->add_control(
			'product_img_heading',
			[
				'label' => esc_html__( 'Image', 'anant-addons-for-elementor' ),
				'type' => \Elementor\Controls_Manager::HEADING,
				// 'separator' => 'before',
			]
		);

		$this->add_responsive_control(
			'counter_icon_width',
			[
				'label'           => __( 'Width', 'anant-addons-for-elementor' ),
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
					'{{WRAPPER}} .anant-woocommerce-cart .product-thumbnail .attachment-woocommerce_thumbnail' => 'width: {{SIZE}}{{UNIT}}; height: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'counter_icon_height',
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
					'{{WRAPPER}} .anant-woocommerce-cart .product-thumbnail .attachment-woocommerce_thumbnail' => 'height: {{SIZE}}{{UNIT}};',
				],

			]
		);

		anant_border_radius_control(
			$this,
			[
				'key'       => 'image_border_radius',
				'label'     => 'Border Radius',
				'selectors' => [
					'{{WRAPPER}} .anant-woocommerce-cart .product-thumbnail .attachment-woocommerce_thumbnail'  => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_control(
			'title_heading',
			[
				'label' => esc_html__( 'Title', 'anant-addons-for-elementor' ),
				'type' => \Elementor\Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);

		anant_color_control(
			$this,
			[
				'key'       => 'title_color',
				'label'     => 'Color',
				'selectors' => [
					'{{WRAPPER}} .anant-woocommerce-cart .cart_item .product-name a' => 'color: {{VALUE}};',
				],
			]
		);
		anant_color_control(
			$this,
			[
				'key'       => 'title_hover_color',
				'label'     => 'Hover Color',
				'selectors' => [
					'{{WRAPPER}} .anant-woocommerce-cart .cart_item .product-name a:hover' => 'color: {{VALUE}};',
				],
			]
		);
		anant_typography_control(
			$this,
			[
				'name'     => 'title_typography',
				'label'    => 'Typography',
				'selector' => '{{WRAPPER}}  .anant-woocommerce-cart .cart_item .product-name',
			]
		); 

		$this->add_control(
			'price_heading',
			[
				'label' => esc_html__( 'Price', 'anant-addons-for-elementor' ),
				'type' => \Elementor\Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);

		anant_color_control(
			$this,
			[
				'key'       => 'price_color',
				'label'     => 'Color',
				'selectors' => [
					'{{WRAPPER}} .anant-woocommerce-cart .cart_item .product-price bdi' => 'color: {{VALUE}};',
				],
			]
		);

		anant_typography_control(
			$this,
			[
				'name'     => 'price_typography',
				'label'    => 'Typography',
				'selector' => '{{WRAPPER}}  .anant-woocommerce-cart .cart_item .product-price',
			]
		); 

		$this->add_control(
			'quantity_heading',
			[
				'label' => esc_html__( 'Quantity', 'anant-addons-for-elementor' ),
				'type' => \Elementor\Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);

		anant_color_control(
			$this,
			[
				'key'       => 'quantity_color',
				'label'     => 'Color',
				'selectors' => [
					'{{WRAPPER}} .anant-woocommerce-cart .cart_item .product-quantity .quantity .qty' => 'color: {{VALUE}};',
				],
			]
		);

		anant_color_control(
			$this,
			[
				'key'       => 'quantity_bg_color',
				'label'     => 'Background Color',
				'selectors' => [
					'{{WRAPPER}} .anant-woocommerce-cart .cart_item .product-quantity .quantity .qty' => 'background-color: {{VALUE}};',
				],
			]
		);

		anant_color_control(
			$this,
			[
				'key'       => 'quantity_border_color',
				'label'     => 'Border Color',
				'selectors' => [
					'{{WRAPPER}} .anant-woocommerce-cart .cart_item .product-quantity .quantity .qty' => 'border-color: {{VALUE}};',
				],
			]
		);
		anant_typography_control(
			$this,
			[
				'name'     => 'quantity_typography',
				'label'    => 'Typography',
				'selector' => '{{WRAPPER}}  .anant-woocommerce-cart .cart_item .product-quantity .quantity .qty',
			]
		); 

		$this->add_control(
			'subtotal_heading',
			[
				'label' => esc_html__( 'Subtotal', 'anant-addons-for-elementor' ),
				'type' => \Elementor\Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);

		anant_color_control(
			$this,
			[
				'key'       => 'subtotal_color',
				'label'     => 'Color',
				'selectors' => [
					'{{WRAPPER}} .anant-woocommerce-cart .cart_item .product-subtotal bdi' => 'color: {{VALUE}};',
				],
			]
		);

		anant_typography_control(
			$this,
			[
				'name'     => 'subtotal_typography',
				'label'    => 'Typography',
				'selector' => '{{WRAPPER}}  .anant-woocommerce-cart .cart_item .product-subtotal , {{WRAPPER}}  .anant-woocommerce-cart .cart_item .product-subtotal bdi',
			]
		); 

		$this->end_controls_section();

		// Coupon Form
		$this->start_controls_section(
			'section_style_submit_button',
			[
				'label' => esc_html__( 'Coupon Form', 'anant-addons-for-elementor' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);
		$slug = 'anant_cart_coupon';
		anant_color_control(
			$this,
			[
				'key'       => $slug.'_color',
				'label'     => 'Color',
				'selectors' => [
					'{{WRAPPER}} .anant-woocommerce-cart #coupon_code' => 'color: {{VALUE}};',
				],
			]
		);

		anant_color_control(
			$this,
			[
				'key'       => $slug.'_bg_color',
				'label'     => 'Background Color',
				'selectors' => [
					'{{WRAPPER}} .anant-woocommerce-cart #coupon_code' => 'background-color: {{VALUE}};',
				],
			]
		);

		anant_color_control(
			$this,
			[
				'key'       => $slug.'_placeholder_color',
				'label'     => 'Placeholder Color',
				'selectors' => [
					'{{WRAPPER}} .anant-woocommerce-cart #coupon_code::placeholder' => 'color: {{VALUE}};',
				],
			]
		);

		anant_typography_control(
			$this,
			[
				'name'     => $slug.'_typography',
				'label'    => 'Typography',
				'selector' => '{{WRAPPER}}  .anant-woocommerce-cart #coupon_code',
			]
		); 

		anant_border_control(
			$this,
			[
				'name'     => $slug.'_border_type_hover',
				'label'    => 'Border Type',
				'selector' => '{{WRAPPER}} .anant-woocommerce-cart #coupon_code',
			]
		);

		anant_border_radius_control(
			$this,
			[
				'key'       => $slug.'_border_radius_hover',
				'label'     => 'Border Radius',
				'selectors' => [
					'{{WRAPPER}} .anant-woocommerce-cart #coupon_code' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					'{{WRAPPER}} .anant-woocommerce-cart #coupon_code' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
					'{{WRAPPER}} .anant-woocommerce-cart #coupon_code' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
					'{{WRAPPER}} .anant-woocommerce-cart #coupon_code' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		anant_box_shadow_control(
			$this,
			[
				'key'      => $slug.'_shadow',
				'label'    => 'Box Shadow',
				'selector' => '{{WRAPPER}}  .anant-woocommerce-cart #coupon_code' ,
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
					'{{WRAPPER}} .anant-woocommerce-cart .coupon .button , {{WRAPPER}} .anant-woocommerce-cart .actions button.button[name="update_cart"] ' => 'color: {{VALUE}};',
				],
			]
		);

		anant_color_control(
			$this,
			[
				'key'       => $slug.'_bg_color',
				'label'     => 'Background Color',
				'selectors' => [
					'{{WRAPPER}} .anant-woocommerce-cart .coupon .button , {{WRAPPER}} .anant-woocommerce-cart .actions button.button[name="update_cart"] ' => 'background-color: {{VALUE}};',
				],
			]
		);

		anant_border_control(
			$this,
			[
				'name'     => $slug.'_border_type',
				'label'    => 'Border Type',
				'selector' => '{{WRAPPER}} .anant-woocommerce-cart .coupon .button , {{WRAPPER}} .anant-woocommerce-cart .actions button.button[name="update_cart"] ',
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
					'{{WRAPPER}} .anant-woocommerce-cart .coupon .button:hover , {{WRAPPER}} .anant-woocommerce-cart .actions button.button[name="update_cart"]:hover' => 'color: {{VALUE}};',
				],
			]
		);

		anant_color_control(
			$this,
			[
				'key'       => $slug.'_bg_hover_color',
				'label'     => 'Background Color',
				'selectors' => [
					'{{WRAPPER}} .anant-woocommerce-cart .coupon .button:hover , {{WRAPPER}} .anant-woocommerce-cart .actions button.button[name="update_cart"]:hover' => 'background-color: {{VALUE}};',
				],
			]
		);	
		anant_border_control(
			$this,
			[
				'name'     => $slug.'_border_hover_type',
				'label'    => 'Border Type',
				'selector' => '{{WRAPPER}} .anant-woocommerce-cart .coupon .button:hover, {{WRAPPER}} .anant-woocommerce-cart .actions button.button[name="update_cart"]:hover',
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
					'{{WRAPPER}} .anant-woocommerce-cart .coupon .button , {{WRAPPER}} .anant-woocommerce-cart .actions button.button[name="update_cart"] ' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
				'separator' => 'before',
			]
		);
		anant_typography_control(
			$this,
			[
				'name'     => $slug.'_typography',
				'label'    => 'Typography',
				'selector' => '{{WRAPPER}} .anant-woocommerce-cart .coupon .button , {{WRAPPER}} .anant-woocommerce-cart .actions button.button[name="update_cart"] ',
			]
		); 

		$this->add_responsive_control(
			$slug.'_padding',
			[
				'label'     => esc_html__('Padding', 'anant-addons-for-elementor'),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .anant-woocommerce-cart .coupon .button , {{WRAPPER}} .anant-woocommerce-cart .actions button.button[name="update_cart"] ' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
					'{{WRAPPER}} .anant-woocommerce-cart .coupon .button , {{WRAPPER}} .anant-woocommerce-cart .actions button.button[name="update_cart"] ' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		anant_box_shadow_control(
			$this,
			[
				'key'      => $slug.'_box_shadow',
				'label'    => 'Box Shadow',
				'selector' => '{{WRAPPER}} .anant-woocommerce-cart .coupon .button , {{WRAPPER}} .anant-woocommerce-cart .actions button.button[name="update_cart"] ',
			]
		);
		$this->end_controls_section();
		// End Coupon Form

		$this->start_controls_section(
			'cart_total_section',
			[
				'label' => esc_html__( 'Cart Total', 'anant-addons-for-elementor' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'cart_total_title',
			[
				'label' => esc_html__( 'Cart total title', 'anant-addons-for-elementor' ),
				'type' => \Elementor\Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);

		anant_color_control(
			$this,
			[
				'key'       => 'cart_total_color',
				'label'     => 'Color',
				'selectors' => [
					'{{WRAPPER}} .anant-woocommerce-cart .cart_totals h2' => 'color: {{VALUE}};',
				],
			]
		);

		anant_typography_control(
			$this,
			[
				'name'     => 'cart_total_typography',
				'label'    => 'Typography',
				'selector' => '{{WRAPPER}}  .anant-woocommerce-cart .cart_totals h2',
			]
		); 

		$this->add_control(
			'cart_total_borders',
			[
				'label' => esc_html__( 'Border', 'anant-addons-for-elementor' ),
				'type' => \Elementor\Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);

		anant_border_control(
			$this,
			[
				'name'     => 'cart_total_inner_border_type',
				'fields_options' => [
					'border' => [
						'label' => 'Inner Table Border',
					],
				],
				'selector' => '
				{{WRAPPER}} .anant-woocommerce-cart .cart-collaterals table.shop_table td, 
				{{WRAPPER}} .anant-woocommerce-cart .cart-collaterals table.shop_table th',
			]
		);
		anant_border_radius_control(
			$this,
			[
				'key'       => 'cart_total_border_radius',
				'label'     => 'Border Radius',
				'selectors' => [
					'{{WRAPPER}} .anant-woocommerce-cart .cart-collaterals table.shop_table' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					'{{WRAPPER}} .anant-woocommerce-cart .cart-collaterals table.shop_table' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_control(
			'cart_total_title_n_subtitle',
			[
				'label' => esc_html__( 'Titles', 'anant-addons-for-elementor' ),
				'type' => \Elementor\Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);

		anant_color_control(
			$this,
			[
				'key'       => 'cart_total_titles_color',
				'label'     => 'Color',
				'selectors' => [
					'{{WRAPPER}} .anant-woocommerce-cart tr.cart-subtotal th , {{WRAPPER}} .anant-woocommerce-cart tr.order-total th ' => 'color: {{VALUE}};',
				],
			]
		);

		anant_typography_control(
			$this,
			[
				'name'     => 'cart_total_titles_typography',
				'label'    => 'Typography',
				'selector' => '{{WRAPPER}} .anant-woocommerce-cart tr.cart-subtotal th , {{WRAPPER}} .anant-woocommerce-cart tr.order-total th',
			]
		); 

		$this->add_control(
			'cart_total_price',
			[
				'label' => esc_html__( 'Details', 'anant-addons-for-elementor' ),
				'type' => \Elementor\Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);

		anant_color_control(
			$this,
			[
				'key'       => 'cart_total_price_color',
				'label'     => 'Color',
				'selectors' => [
					'{{WRAPPER}} .anant-woocommerce-cart tr.cart-subtotal td bdi, {{WRAPPER}} .anant-woocommerce-cart tr.order-total td bdi' => 'color: {{VALUE}};',
				],
			]
		);

		anant_typography_control(
			$this,
			[
				'name'     => 'cart_total_price_typography',
				'label'    => 'Typography',
				'selector' => '{{WRAPPER}}  .anant-woocommerce-cart tr.cart-subtotal td , {{WRAPPER}} .anant-woocommerce-cart tr.order-total td',
			]
		); 

		$this->add_control(
			'cart_total_btn',
			[
				'label' => esc_html__( 'Button', 'anant-addons-for-elementor' ),
				'type' => \Elementor\Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);

		$slug = 'total_cart_btn';
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
					'{{WRAPPER}} .anant-woocommerce-cart .wc-proceed-to-checkout a' => 'color: {{VALUE}};',
					'{{WRAPPER}} .anant-woocommerce-cart .back-to-shop' => 'color: {{VALUE}};',
				],
			]
		);

		anant_color_control(
			$this,
			[
				'key'       => $slug.'_bg_color',
				'label'     => 'Background Color',
				'selectors' => [
					'{{WRAPPER}} .anant-woocommerce-cart .wc-proceed-to-checkout a' => 'background-color: {{VALUE}};',
					'{{WRAPPER}} .anant-woocommerce-cart .back-to-shop' => 'background-color: {{VALUE}};',
				],
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
					'{{WRAPPER}} .anant-woocommerce-cart .wc-proceed-to-checkout:hover a' => 'color: {{VALUE}};',
					'{{WRAPPER}} .anant-woocommerce-cart .back-to-shop:hover' => 'color: {{VALUE}};',
				],
			]
		);

		anant_color_control(
			$this,
			[
				'key'       => $slug.'_bg_hover_color',
				'label'     => 'Background Color',
				'selectors' => [
					'{{WRAPPER}} .anant-woocommerce-cart .wc-proceed-to-checkout:hover a' => 'background-color: {{VALUE}};',
					'{{WRAPPER}} .anant-woocommerce-cart .back-to-shop:hover' => 'background-color: {{VALUE}};',
				],
			]
		);
		$this->end_controls_tab(); 
		$this->end_controls_tabs();
	
		$this->add_control(
			$slug.'hr',
			[
				'type' => \Elementor\Controls_Manager::DIVIDER,
			]
		);
		anant_typography_control(
			$this,
			[
				'name'     => $slug.'_typography',
				'label'    => 'Typography',
				'selector' => '{{WRAPPER}}  .anant-woocommerce-cart .wc-proceed-to-checkout a, {{WRAPPER}} .anant-woocommerce-cart .back-to-shop',
			]
		); 

		anant_border_control(
			$this,
			[
				'name'     => $slug.'_border_type',
				'label'    => 'Border Type',
				'selector' => '{{WRAPPER}} .anant-woocommerce-cart .wc-proceed-to-checkout a, {{WRAPPER}} .anant-woocommerce-cart .back-to-shop',
			]
		);

		anant_border_radius_control(
			$this,
			[
				'key'       => $slug.'_border_radius',
				'label'     => 'Border Radius',
				'selectors' => [
					'{{WRAPPER}} .anant-woocommerce-cart .wc-proceed-to-checkout a' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					'{{WRAPPER}} .anant-woocommerce-cart .back-to-shop' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
					'{{WRAPPER}} .anant-woocommerce-cart .wc-proceed-to-checkout a' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					'{{WRAPPER}} .anant-woocommerce-cart .back-to-shop' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
					'{{WRAPPER}} .anant-woocommerce-cart .wc-proceed-to-checkout a' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					'{{WRAPPER}} .anant-woocommerce-cart .back-to-shop' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		anant_box_shadow_control(
			$this,
			[
				'key'      => $slug.'_box_shadow',
				'label'    => 'Box Shadow',
				'selector' => '{{WRAPPER}} .anant-woocommerce-cart .wc-proceed-to-checkout a, .anant-woocommerce-cart .back-to-shop',
			]
		);
		$this->end_controls_section();
		
		// Notice
		$this->start_controls_section(
			'cart_notice_section',
			[
				'label' => esc_html__( 'Cart Notice', 'anant-addons-for-elementor' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);
		$slug = 'cart_notice';	
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
				{{WRAPPER}} .anant-woocommerce-cart .woocommerce-message, 
				{{WRAPPER}} .anant-woocommerce-cart .woocommerce-error',
			]
		);
		anant_border_radius_control(
			$this,
			[
				'key'       => $slug.'_border_radius',
				'label'     => 'Border Radius',
				'selectors' => [
					'{{WRAPPER}} .anant-woocommerce-cart .woocommerce-message' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					'{{WRAPPER}} .anant-woocommerce-cart .woocommerce-error' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
					'{{WRAPPER}} .anant-woocommerce-cart .woocommerce-message' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					'{{WRAPPER}} .anant-woocommerce-cart .woocommerce-error' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
					'{{WRAPPER}} .anant-woocommerce-cart .woocommerce-message' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					'{{WRAPPER}} .anant-woocommerce-cart .woocommerce-error' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		anant_box_shadow_control(
			$this,
			[
				'key'      => $slug.'_box_shadow',
				'label'    => 'Box Shadow',
				'selector' => '{{WRAPPER}} .anant-woocommerce-cart .woocommerce-message, {{WRAPPER}} .anant-woocommerce-cart .woocommerce-error',
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
					'{{WRAPPER}} .anant-woocommerce-cart .woocommerce-message' => 'background-color: {{VALUE}}',
				],
			]
		);
		$this->add_control(
			$slug.'_message_color',
			[
				'label'     => __( 'Color', 'anant-addons-for-elementor' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .anant-woocommerce-cart .woocommerce-message' => 'color: {{VALUE}}',
				],
			]
		);
		$this->add_control(
			$slug.'_message_icon_color',
			[
				'label'     => __( 'Icon Color', 'anant-addons-for-elementor' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .anant-woocommerce-cart .woocommerce-message:before' => 'color: {{VALUE}}',
				],
			]
		);
		$this->add_control(
			$slug.'_message_border_color',
			[
				'label'     => __( 'Border Color', 'anant-addons-for-elementor' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .anant-woocommerce-cart .woocommerce-message' => 'border-color: {{VALUE}}',
				],
			]
		);
		anant_typography_control(
			$this,
			[
				'name'     => $slug.'_message_typography',
				'label'    => 'Typography',
				'selector' => '{{WRAPPER}} .anant-woocommerce-cart .woocommerce-message',
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
					'{{WRAPPER}} .anant-woocommerce-cart .woocommerce-error' => 'background-color: {{VALUE}}',
				],
			]
		);
		$this->add_control(
			$slug.'_error_color',
			[
				'label'     => __( 'Color', 'anant-addons-for-elementor' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .anant-woocommerce-cart .woocommerce-error' => 'color: {{VALUE}}',
				],
			]
		);
		$this->add_control(
			$slug.'_error_icon_color',
			[
				'label'     => __( 'Icon Color', 'anant-addons-for-elementor' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .anant-woocommerce-cart .woocommerce-error:before' => 'color: {{VALUE}}',
				],
			]
		);
		$this->add_control(
			$slug.'_error_border_color',
			[
				'label'     => __( 'Border Color', 'anant-addons-for-elementor' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .anant-woocommerce-cart .woocommerce-error' => 'border-color: {{VALUE}}',
				],
			]
		);
		anant_typography_control(
			$this,
			[
				'name'     => $slug.'_error_typography',
				'label'    => 'Typography',
				'selector' => '{{WRAPPER}} .anant-woocommerce-cart .woocommerce-error',
			]
		);
		$this->end_controls_tab();
		// end error notice
		
		// info notice
		$this->start_controls_tab(
			$slug.'_style_info',
			[
				'label' => __( 'info', 'anant-addons-for-elementor' ),

			]
		);
		$this->add_control(
			$slug.'_info_bg_color',
			[
				'label'     => __( 'Background Color', 'anant-addons-for-elementor' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .anant-woocommerce-cart .woocommerce-info' => 'background-color: {{VALUE}}',
				],
			]
		);
		$this->add_control(
			$slug.'_info_color',
			[
				'label'     => __( 'Color', 'anant-addons-for-elementor' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .anant-woocommerce-cart .woocommerce-info' => 'color: {{VALUE}}',
				],
			]
		);
		$this->add_control(
			$slug.'_info_icon_color',
			[
				'label'     => __( 'Icon Color', 'anant-addons-for-elementor' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .anant-woocommerce-cart .woocommerce-info:before' => 'color: {{VALUE}}',
				],
			]
		);
		$this->add_control(
			$slug.'_info_border_color',
			[
				'label'     => __( 'Border Color', 'anant-addons-for-elementor' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .anant-woocommerce-cart .woocommerce-info' => 'border-color: {{VALUE}}',
				],
			]
		);
		anant_typography_control(
			$this,
			[
				'name'     => $slug.'_info_typography',
				'label'    => 'Typography',
				'selector' => '{{WRAPPER}} .anant-woocommerce-cart .woocommerce-info',
			]
		);
		$this->end_controls_tab();
		$this->end_controls_tabs(); 

		$this->add_control(
			'undo_heading',
			[
				'label' => esc_html__( 'Undo', 'anant-addons-for-elementor' ),
				'type' => \Elementor\Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);
		$this->add_responsive_control(
			$slug.'_undo_padding',
			[
				'label'     => esc_html__('Padding', 'anant-addons-for-elementor'),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' =>[
					'{{WRAPPER}} .anant-woocommerce-cart a.restore-item' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		anant_typography_control(
			$this,
			[
				'name'     => $slug.'_undo_typography',
				'label'    => 'Typography',
				'selector' => '{{WRAPPER}} .anant-woocommerce-cart a.restore-item',
			]
		);
		$this->start_controls_tabs( $slug.'_undo_tabs' );

		// message notice
		$this->start_controls_tab(
			$slug.'_normal_style',
			[
				'label' => __( 'normal', 'anant-addons-for-elementor' ),
			]
		);
		$this->add_control(
			$slug.'_undo_bg_color',
			[
				'label'     => __( 'Background Color', 'anant-addons-for-elementor' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .anant-woocommerce-cart a.restore-item' => 'background-color: {{VALUE}}',
				],
			]
		);
		$this->add_control(
			$slug.'_undo_color',
			[
				'label'     => __( 'Color', 'anant-addons-for-elementor' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .anant-woocommerce-cart a.restore-item' => 'color: {{VALUE}}',
				],
			]
		);
		$this->end_controls_tab();
		// end error notice
		
		// undo_hover_ notice
		$this->start_controls_tab(
			$slug.'_style_hover',
			[
				'label' => __( 'hover', 'anant-addons-for-elementor' ),
			]
		);
		$this->add_control(
			$slug.'_undo_hover_bg_color',
			[
				'label'     => __( 'Background Color', 'anant-addons-for-elementor' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .anant-woocommerce-cart a.restore-item:hover' => 'background-color: {{VALUE}}',
				],
			]
		);
		$this->add_control(
			$slug.'_undo_hover_color',
			[
				'label'     => __( 'Color', 'anant-addons-for-elementor' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .anant-woocommerce-cart a.restore-item:hover' => 'color: {{VALUE}}',
				],
			]
		);
		$this->end_controls_tab();
		$this->end_controls_tabs(); 
		$this->end_controls_section();

	}

	public function render() {
		$settings = $this->get_settings_for_display();

		echo '<div class="anant-woocommerce-cart" id="anant-cart-page">';
		echo do_shortcode('[woocommerce_cart]'); ?>
		<a href="<?php echo esc_url( apply_filters( 'woocommerce_return_to_shop_redirect', wc_get_page_permalink( 'shop' ) ) );?>" class="back-to-shop">Back To Shop</a>
		<?php
		echo '</div>';
	}
}