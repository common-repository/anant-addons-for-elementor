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

class AnantAccountPage extends Widget_Base {

	public function __construct( $data = [], $args = null ) {
		parent::__construct( $data, $args );
			if ( is_null( WC()->cart ) ) {
				include_once WC_ABSPATH . 'includes/wc-cart-functions.php';
				include_once WC_ABSPATH . 'includes/class-wc-cart.php';
				wc_load_cart();
		}
	}
	
	public function get_name() {
		return 'anant-account-page';
	}

	public function get_title() {
		return esc_html__( 'Account Page ', 'anant-addons-for-elementor' );
	}

	public function get_icon() {
		return 'ant-icon eicon-my-account';
	}

	public function get_categories() {
		return [ 'anant-woo-elements' ];
	}

	public function get_keywords() {
		return [
			'account',
			'my account',
			'checkout',
			'product',
			'billing',
			'anant addons',
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
			'template_style',
			[
				'label'       => esc_html__( 'Layout', 'anant-addons-for-elementor' ),
				'type'        => \Elementor\Controls_Manager::SELECT,
				'default'     => 'ant_vertical_account',
				'options'     => [
					'ant_vertical_account'      => esc_html__( 'Vertical', 'anant-addons-for-elementor' ),
					''      => esc_html__( 'Horizontal (Pro)', 'anant-addons-for-elementor' ),
				],
			]
		);

		$this->add_responsive_control(
			'tab_sec_width',
			[
				'label'   => __( 'Width', 'anant-addons-for-elementor' ),
				'type'            => Controls_Manager::SLIDER,
				'size_units'      => [ '%' ],
				'range'           => [
					'%' => [
						'step' => 1,
						'min' => 0,
						'max' => 100,
					],
				],
				'devices'         => [ 'desktop', 'tablet', 'mobile' ],
				'default' => [
					'unit' => '%',
				],
				'tablet_default'  => [
					'unit' => '%',
				],
				'mobile_default'  => [
					'unit' => '%',
				],
				'selectors'       => [
					'{{WRAPPER}} .anant-woocommerce-account .woocommerce-MyAccount-navigation' => 'width: {{SIZE}}{{UNIT}};', 
					'{{WRAPPER}} .anant-woocommerce-account .woocommerce-MyAccount-content' => 'width: calc(100% - {{SIZE}}{{UNIT}} - 2% );', 
				],
				'condition' => [
					'template_style' => 'ant_vertical_account',
				],
			]
		);

		$this->end_controls_section();

		// Main Wrapper style
		$this->start_controls_section(
            'account_main_wrapper_style', 
			[
				'label' => esc_html__('Main Wrapper', 'anant-addons-for-elementor'),
				'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

		$slug ='account_main_wrapper';

		anant_color_control(
			$this,
			[
				'key'       => $slug.'_bg_color',
				'label'     => 'Background Color',
				'selectors' => [
					'{{WRAPPER}} .anant-account-wrapper' => 'background-color: {{VALUE}};',
				],
			]
		);

		anant_border_control(
			$this,
			[
				'name'     => $slug.'_border_type',
				'label'    => 'Border Type',
				'selector' => '{{WRAPPER}} .anant-account-wrapper',
			]
		);

		anant_border_radius_control(
			$this,
			[
				'key'       => $slug.'_border_radius',
				'label'     => 'Border Radius',
				'selectors' => [
					'{{WRAPPER}} .anant-account-wrapper' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
					'{{WRAPPER}} .anant-account-wrapper' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
					'{{WRAPPER}} .anant-account-wrapper' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		anant_box_shadow_control(
			$this,
			[
				'key'      => $slug.'_box_shadow',
				'label'    => 'Box Shadow',
				'selector' => '{{WRAPPER}} .anant-account-wrapper',
			]
		);

		$this->end_controls_section();

		// Login / Signup style
		$this->start_controls_section(
            'account_register_style', 
			[
				'label' => esc_html__('Login / SignUp', 'anant-addons-for-elementor'),
				'tab' => Controls_Manager::TAB_STYLE,
            ]
        );
		
		$slug = 'my_account_register_form';

		$this->add_control(
			$slug.'_toggle_btn_heading',
			[
				'label' => esc_html__( 'Toggle Button', 'anant-addons-for-elementor' ),
				'type' => \Elementor\Controls_Manager::HEADING,
			]
		);

		$slug = $slug.'_toggle_btn';
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
					'{{WRAPPER}} .slide-btn input[type="radio"] + label' => 'color: {{VALUE}};',
				],
			]
		);

		anant_color_control(
			$this,
			[
				'key'       => $slug.'_bg_color',
				'label'     => 'Background Color',
				'selectors' => [
					'{{WRAPPER}} .slide-btn' => 'background-color: {{VALUE}};',
				],
			]
		);

		anant_border_control(
			$this,
			[
				'name'     => $slug.'_border_type',
				'label'    => 'Border Type',
				'selector' => '{{WRAPPER}} .slide-btn',
			]
		);

		$this->add_responsive_control(
			$slug.'_margin',
			[
				'label'     => esc_html__('Margin', 'anant-addons-for-elementor'),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .slide-btn' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
			$slug.'_normal_style_hover',
			[
				'label' => __( 'Active', 'anant-addons-for-elementor' ),
			]
		);

		anant_color_control(
			$this,
			[
				'key'       => $slug.'_hover_color',
				'label'     => 'Color',
				'selectors' => [
					'{{WRAPPER}} .slide-btn input[type="radio"]:checked + label' => 'color: {{VALUE}} !important;',
				],
			]
		);

		anant_color_control(
			$this,
			[
				'key'       => $slug.'_bg_hover_color',
				'label'     => 'Background Color',
				'selectors' => [
					'{{WRAPPER}} .glider' => 'background-color: {{VALUE}} !important;',
				],
			]
		);	
		anant_border_control(
			$this,
			[
				'name'     => $slug.'_border_hover_type',
				'label'    => 'Border Type',
				'selector' => '{{WRAPPER}} .glider',
			]
		);
	
		$this->end_controls_tab(); 
		$this->end_controls_tabs(); 

		anant_typography_control(
			$this,
			[
				'name'     => $slug.'_typography',
				'label'    => 'Typography',
				'selector' => '{{WRAPPER}} .slide-btn input[type="radio"] + label',
				'separator' => 'before',
			]
		); 

		anant_border_radius_control(
			$this,
			[
				'key'       => $slug.'_border_radius',
				'label'     => 'Border Radius',
				'selectors' => [
					'{{WRAPPER}} .slide-btn' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					'{{WRAPPER}} .glider' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		anant_box_shadow_control(
			$this,
			[
				'key'      => $slug.'_box_shadow',
				'label'    => 'Box Shadow',
				'selector' => '{{WRAPPER}} .slide-btn',
			]
		);

		$this->add_control( $slug.'_toggle_btn_hr', [ 'type' => \Elementor\Controls_Manager::DIVIDER, ] );
		
		$slug = 'my_account_register_form';

		$this->add_control(
			$slug.'_text',
			[
				'label' => __( 'Text', 'anant-addons-for-elementor' ),
				'type' => Controls_Manager::HEADING,
			]
		);
		
		anant_color_control(
			$this,
			[
				'key'       =>  $slug.'_text_color',
				'label'     => 'Color',
				'selectors' => [
					'{{WRAPPER}} .anant-account-wrapper.logout  p' => 'color: {{VALUE}};',
					'{{WRAPPER}} .anant-account-wrapper.logout  address' => 'color: {{VALUE}};',
				],
			]
		);
		anant_typography_control(
			$this,
			[
				'name'     =>  $slug.'_text_typography',
				'label'    => 'Typography',
				'selector' => '{{WRAPPER}} .anant-account-wrapper.logout  p, {{WRAPPER}} .anant-account-wrapper.logout  address',
			]
		);
		$this->add_control(
			$slug.'_heading',
			[
				'label' => __( 'Heading', 'anant-addons-for-elementor' ),
				'type' => Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);
		anant_color_control(
			$this,
			[
				'key'       =>  $slug.'_heading_color',
				'label'     => 'Color',
				'selectors' => [
					'{{WRAPPER}} .anant-account-wrapper.logout  h1' => 'color: {{VALUE}};',
					'{{WRAPPER}} .anant-account-wrapper.logout  h2' => 'color: {{VALUE}};',
					'{{WRAPPER}} .anant-account-wrapper.logout  h3' => 'color: {{VALUE}};',
					'{{WRAPPER}} .anant-account-wrapper.logout  h4' => 'color: {{VALUE}};',
					'{{WRAPPER}} .anant-account-wrapper.logout  h5' => 'color: {{VALUE}};',
					'{{WRAPPER}} .anant-account-wrapper.logout  h6' => 'color: {{VALUE}};',
				],
			]
		);
		anant_typography_control(
			$this,
			[
				'name'     =>  $slug.'_heading_typography',
				'label'    => 'Typography',
				'selector' => '{{WRAPPER}} .anant-account-wrapper.logout  h1, 
								{{WRAPPER}} .anant-account-wrapper.logout  h2, 
								{{WRAPPER}} .anant-account-wrapper.logout  h3, 
								{{WRAPPER}} .anant-account-wrapper.logout  h4, 
								{{WRAPPER}} .anant-account-wrapper.logout  h5, 
								{{WRAPPER}} .anant-account-wrapper.logout  h6',
			]
		);
		$this->add_control(
			$slug.'_link',
			[
				'label' => __( 'Link', 'anant-addons-for-elementor' ),
				'type' => Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);
		anant_color_control(
			$this,
			[
				'key'       =>  $slug.'_link_color',
				'label'     => 'Color',
				'selectors' => [
					'{{WRAPPER}} .anant-account-wrapper.logout a' => 'color: {{VALUE}};',
				],
			]
		);
		anant_color_control(
			$this,
			[
				'key'       =>  $slug.'_link_hover_color',
				'label'     => 'Hover Color',
				'selectors' => [
					'{{WRAPPER}} .anant-account-wrapper.logout a:hover' => 'color: {{VALUE}};',
				],
			]
		);
		anant_typography_control(
			$this,
			[
				'name'     =>  $slug.'_link_typography',
				'label'    => 'Typography',
				'selector' => '{{WRAPPER}} .anant-account-wrapper.logout a',
			]
		);
		$this->add_control(
			$slug.'_label',
			[
				'label' => __( 'Label', 'anant-addons-for-elementor' ),
				'type' => Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);
		anant_color_control(
			$this,
			[
				'key'       =>  $slug.'_label_color',
				'label'     => 'Color',
				'selectors' => [
					'{{WRAPPER}} .anant-account-wrapper.logout label' => 'color: {{VALUE}};',
				],
			]
		);
		anant_typography_control(
			$this,
			[
				'name'     =>  $slug.'_label_typography',
				'label'    => 'Typography',
				'selector' => '{{WRAPPER}} .anant-account-wrapper.logout label',
			]
		);

		$this->add_responsive_control(
			$slug.'_label_spacing',
			[
				'label'     => esc_html__('Spacing', 'anant-addons-for-elementor'),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .anant-account-wrapper.logout label' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
					'{{WRAPPER}} .anant-account-wrapper.logout label .required' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			$slug.'_fields',
			[
				'label' => __( 'Input Fields', 'anant-addons-for-elementor' ),
				'type' => Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);

		$this->add_responsive_control(
			$slug.'_inputs_height',
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
					'{{WRAPPER}} .anant-account-wrapper.logout .form-row input.input-text' => 'height: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .anant-account-wrapper.logout .select2-container .select2-selection--single' => 'height: {{SIZE}}{{UNIT}};',
				],
			]
		);
		anant_color_control(
			$this,
			[
				'key'       =>  $slug.'_field_color',
				'label'     => 'Color',
				'selectors' => [
					'{{WRAPPER}} .anant-account-wrapper.logout input, {{WRAPPER}} .anant-account-wrapper.logout select, {{WRAPPER}} .anant-account-wrapper.logout textarea' => 'color: {{VALUE}};',
				],
			]
		);
		anant_color_control(
			$this,
			[
				'key'       =>  $slug.'_field_bg_color',
				'label'     => 'Background Color',
				'selectors' => [
					'{{WRAPPER}} .anant-account-wrapper.logout input, {{WRAPPER}} .anant-account-wrapper.logout select, {{WRAPPER}} .anant-account-wrapper.logout textarea' => 'background-color: {{VALUE}};',
				],
			]
		);
		anant_border_control(
			$this,
			[
				'name'     =>  $slug.'_field_border_color',
				'label'    => 'Border Type',
				'selector' => '
					{{WRAPPER}} .anant-account-wrapper.logout input, 
					{{WRAPPER}} .anant-account-wrapper.logout .select, 
					{{WRAPPER}} .anant-account-wrapper.logout .select2-container--default .select2-selection--single, 
					{{WRAPPER}} .anant-account-wrapper.logout textarea',
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
					{{WRAPPER}} .anant-account-wrapper.logout input:hover, 
					{{WRAPPER}} .anant-account-wrapper.logout input:focus, 
					{{WRAPPER}} .anant-account-wrapper.logout input:active , {{WRAPPER}} .anant-account-wrapper.logout textarea:hover, 
					{{WRAPPER}} .anant-account-wrapper.logout textarea:focus, {{WRAPPER}} .anant-account-wrapper.logout textarea:active',
			]
		);

		anant_border_radius_control(
			$this,
			[
				'key'       =>  $slug.'_field_border_radius',
				'label'     => 'Border Radius',
				'selectors' => [
					'{{WRAPPER}} .anant-account-wrapper.logout input' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					'{{WRAPPER}} .anant-account-wrapper.logout select' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					'{{WRAPPER}} .anant-account-wrapper.logout .select2-container--default .select2-selection--single' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					'{{WRAPPER}} .anant-account-wrapper.logout textarea' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
					'{{WRAPPER}} .anant-account-wrapper.logout .form-row' => 'margin-bottom: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_control( $slug.'_show_password_hr', [ 'type' => \Elementor\Controls_Manager::DIVIDER, ] );

		$this->add_control(
			$slug.'_show_password',
			[
				'label' => __( 'Show PassWord', 'anant-addons-for-elementor' ),
				'type' => Controls_Manager::HEADING,
			]
		);
		$this->add_responsive_control(
			$slug.'_show_password_size',
			[
				'label' => __( 'Size', 'anant-addons-for-elementor' ),
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
					'{{WRAPPER}} .anant-account-wrapper.logout .show-password-input' => 'font-size: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			$slug.'_show_password_margin',
			[
				'label'     => esc_html__('Margin', 'anant-addons-for-elementor'),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .anant-account-wrapper.logout .show-password-input' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
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
					'{{WRAPPER}} .anant-account-wrapper.logout button.button' => 'color: {{VALUE}};',
				],
			]
		);

		anant_color_control(
			$this,
			[
				'key'       => $slug.'_bg_color',
				'label'     => 'Background Color',
				'selectors' => [
					'{{WRAPPER}} .anant-account-wrapper.logout button.button' => 'background-color: {{VALUE}};',
				],
			]
		);

		anant_border_control(
			$this,
			[
				'name'     => $slug.'_border_type',
				'label'    => 'Border Type',
				'selector' => '{{WRAPPER}} .anant-account-wrapper.logout button.button',
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
					'{{WRAPPER}} .anant-account-wrapper.logout button.button:hover' => 'color: {{VALUE}} !important;',
				],
			]
		);

		anant_color_control(
			$this,
			[
				'key'       => $slug.'_bg_hover_color',
				'label'     => 'Background Color',
				'selectors' => [
					'{{WRAPPER}} .anant-account-wrapper.logout button.button:hover' => 'background-color: {{VALUE}} !important;',
				],
			]
		);	
		anant_border_control(
			$this,
			[
				'name'     => $slug.'_border_hover_type',
				'label'    => 'Border Type',
				'selector' => '{{WRAPPER}} .anant-account-wrapper.logout button.button:hover',
			]
		);
	
		$this->end_controls_tab(); 
		$this->end_controls_tabs(); 

		anant_typography_control(
			$this,
			[
				'name'     => $slug.'_typography',
				'label'    => 'Typography',
				'selector' => '{{WRAPPER}} .anant-account-wrapper.logout button.button',
			]
		); 

		anant_border_radius_control(
			$this,
			[
				'key'       => $slug.'_border_radius',
				'label'     => 'Border Radius',
				'selectors' => [
					'{{WRAPPER}} .anant-account-wrapper.logout button.button' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
				'separator' => 'before',
			]
		);

		$this->add_responsive_control(
			$slug.'_padding',
			[
				'label'     => esc_html__('Padding', 'anant-addons-for-elementor'),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .anant-account-wrapper.logout button.button' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
					'{{WRAPPER}} .anant-account-wrapper.logout button.button' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		anant_box_shadow_control(
			$this,
			[
				'key'      => $slug.'_box_shadow',
				'label'    => 'Box Shadow',
				'selector' => '{{WRAPPER}} .anant-account-wrapper.logout button.button',
			]
		);

		$this->end_controls_section();

		// Product tabs style
		$this->start_controls_section(
            'account_tabs_style', 
			[
				'label' => esc_html__('Tabs', 'anant-addons-for-elementor'),
				'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

		$slug = 'account_tabs';
		anant_alignment_control(
			$this,
			[
				'key'       => $slug.'_align',
				'label'     => 'Alignment',
				'options'   => [
					'start'   => [
						'title' => __( 'Left', 'anant-addons-for-elementor' ),
						'icon'  => 'eicon-text-align-left',
					],
					'center' => [
						'title' => __( 'Center', 'anant-addons-for-elementor' ),
						'icon'  => 'eicon-text-align-center',
					],
					'end'  => [
						'title' => __( 'Right', 'anant-addons-for-elementor' ),
						'icon'  => 'eicon-text-align-right',
					],
				],
				'default'   => '',
				'selectors' => [
					'{{WRAPPER}} .woocommerce-MyAccount-navigation ul' => 'text-align: {{VALUE}};',
				],
			]
		);

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
					'{{WRAPPER}}  .anant-woocommerce-account .woocommerce-MyAccount-navigation-link a' => 'color: {{VALUE}}',
				],
			]
		);

		$this->add_control(
			$slug.'_bg_color',
			[
				'label'     => __( 'Background Color', 'anant-addons-for-elementor' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}}  .anant-woocommerce-account .woocommerce-MyAccount-navigation-link' => 'background-color: {{VALUE}}',
				],
			]
		);

		anant_typography_control(
			$this,
			[
				'name'     => $slug.'_typography',
				'label'    => 'Typography',
				'selector' => '{{WRAPPER}}  .anant-woocommerce-account .woocommerce-MyAccount-navigation-link',
			]
		);

		anant_border_control(
			$this,
			[
				'name'     => $slug.'_border_type',
				'label'    => 'Border Type',
				'selector' => '{{WRAPPER}} .anant-woocommerce-account .woocommerce-MyAccount-navigation-link',
			]
		);

		anant_border_radius_control(
			$this,
			[
				'key'       => $slug.'_border_radius',
				'label'     => 'Border Radius',
				'selectors' => [
					'{{WRAPPER}} .anant-woocommerce-account .woocommerce-MyAccount-navigation-link' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
					'{{WRAPPER}} .anant-woocommerce-account .woocommerce-MyAccount-navigation-link' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
					'{{WRAPPER}} .anant-woocommerce-account .woocommerce-MyAccount-navigation-link' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		anant_box_shadow_control(
			$this,
			[
				'key'      => $slug.'_box_shadow',
				'label'    => 'Box Shadow',
				'selector' => '{{WRAPPER}}  .anant-woocommerce-account .woocommerce-MyAccount-navigation-link',
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
					'{{WRAPPER}}  .anant-woocommerce-account .woocommerce-MyAccount-navigation-link:hover a' => 'color: {{VALUE}}',
				],
			]
		);

		$this->add_control(
			$slug.'_color_bg_hover',
			[
				'label'     => __( 'Background Color', 'anant-addons-for-elementor' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}}  .anant-woocommerce-account .woocommerce-MyAccount-navigation-link:hover' => 'background-color: {{VALUE}}',
				],
			]
		);

		anant_typography_control(
			$this,
			[
				'name'     => $slug.'_typography_hover',
				'label'    => 'Typography',
				'selector' => '{{WRAPPER}}  .anant-woocommerce-account .woocommerce-MyAccount-navigation-link:hover',
			]
		);

		anant_border_control(
			$this,
			[
				'name'     => $slug.'_border_type_hover',
				'label'    => 'Border Type',
				'selector' => '{{WRAPPER}} .anant-woocommerce-account .woocommerce-MyAccount-navigation-link:hover',
			]
		);

		anant_border_radius_control(
			$this,
			[
				'key'       => $slug.'_border_radius_hover',
				'label'     => 'Border Radius',
				'selectors' => [
					'{{WRAPPER}} .anant-woocommerce-account .woocommerce-MyAccount-navigation-link:hover' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
					'{{WRAPPER}} .anant-woocommerce-account .woocommerce-MyAccount-navigation-link:hover' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
					'{{WRAPPER}} .anant-woocommerce-account .woocommerce-MyAccount-navigation-link:hover' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		anant_box_shadow_control(
			$this,
			[
				'key'      => $slug.'_box_shadow_hover',
				'label'    => 'Box Shadow',
				'selector' => '{{WRAPPER}}  .anant-woocommerce-account .woocommerce-MyAccount-navigation-link:hover',
			]
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
			$slug.'_style_active',
			[
				'label' => __( 'Active', 'anant-addons-for-elementor' ),

			]
		);

		$this->add_control(
			$slug.'_color_active',
			[
				'label'     => __( 'Color', 'anant-addons-for-elementor' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}}  .anant-woocommerce-account .woocommerce-MyAccount-navigation-link.is-active a' => 'color: {{VALUE}}',
				],
			]
		);

		$this->add_control(
			$slug.'_color_bg_active',
			[
				'label'     => __( 'Background Color', 'anant-addons-for-elementor' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}}  .anant-woocommerce-account .woocommerce-MyAccount-navigation-link.is-active' => 'background-color: {{VALUE}}',
				],
			]
		);
		
		anant_color_control(
			$this,
			[
				'key'       => $slug.'active_border_color',
				'label'     => 'Border Color',
				'selectors' => [
					'{{WRAPPER}}  .anant-woocommerce-account .woocommerce-MyAccount-navigation-link.is-active' => 'border-color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			$slug.'_active_color_hover',
			[
				'label'     => __( 'Hover Color', 'anant-addons-for-elementor' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}}  .anant-woocommerce-account .woocommerce-MyAccount-navigation-link.is-active:hover' => 'color: {{VALUE}}',
				],
			]
		);

		$this->add_control(
			$slug.'_active_color_bg_hover',
			[
				'label'     => __( 'Hover Background Color', 'anant-addons-for-elementor' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}}  .anant-woocommerce-account .woocommerce-MyAccount-navigation-link.is-active:hover' => 'background-color: {{VALUE}}',
				],
			]
		);
		
		anant_color_control(
			$this,
			[
				'key'       => $slug.'active_border_color_hover',
				'label'     => 'Hover Border Color',
				'selectors' => [
					'{{WRAPPER}} .anant-woocommerce-account .woocommerce-MyAccount-navigation-link.is-active:hover' => 'border-color: {{VALUE}};',
				],
			]
		);	

		$this->end_controls_tab();
		$this->end_controls_tabs(); 
        $this->end_controls_section();

		$this->start_controls_section(
			'anant_woo_my_account_general',
			[
				'label' => esc_html__( 'General', 'anant-addons-for-elementor' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);
		$slug = 'my_account_general';
		$this->add_control(
			$slug.'_text',
			[
				'label' => __( 'Text', 'anant-addons-for-elementor' ),
				'type' => Controls_Manager::HEADING,
			]
		);
		anant_color_control(
			$this,
			[
				'key'       =>  $slug.'_text_color',
				'label'     => 'Color',
				'selectors' => [
					'{{WRAPPER}} .anant-woocommerce-account .woocommerce-MyAccount-content p' => 'color: {{VALUE}};',
					'{{WRAPPER}} .anant-woocommerce-account .woocommerce-MyAccount-content address' => 'color: {{VALUE}};',
				],
			]
		);
		anant_typography_control(
			$this,
			[
				'name'     =>  $slug.'_text_typography',
				'label'    => 'Typography',
				'selector' => '{{WRAPPER}} .anant-woocommerce-account .woocommerce-MyAccount-content p, {{WRAPPER}} .anant-woocommerce-account .woocommerce-MyAccount-content address',
			]
		);
		$this->add_control(
			$slug.'_heading',
			[
				'label' => __( 'Heading', 'anant-addons-for-elementor' ),
				'type' => Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);
		anant_color_control(
			$this,
			[
				'key'       =>  $slug.'_heading_color',
				'label'     => 'Color',
				'selectors' => [
					'{{WRAPPER}} .anant-woocommerce-account .woocommerce-MyAccount-content h1' => 'color: {{VALUE}};',
					'{{WRAPPER}} .anant-woocommerce-account .woocommerce-MyAccount-content h2' => 'color: {{VALUE}};',
					'{{WRAPPER}} .anant-woocommerce-account .woocommerce-MyAccount-content h3' => 'color: {{VALUE}};',
					'{{WRAPPER}} .anant-woocommerce-account .woocommerce-MyAccount-content h4' => 'color: {{VALUE}};',
					'{{WRAPPER}} .anant-woocommerce-account .woocommerce-MyAccount-content h5' => 'color: {{VALUE}};',
					'{{WRAPPER}} .anant-woocommerce-account .woocommerce-MyAccount-content h6' => 'color: {{VALUE}};',
				],
			]
		);
		anant_typography_control(
			$this,
			[
				'name'     =>  $slug.'_heading_typography',
				'label'    => 'Typography',
				'selector' => '{{WRAPPER}} .anant-woocommerce-account .woocommerce-MyAccount-content h1, 
								{{WRAPPER}} .anant-woocommerce-account .woocommerce-MyAccount-content h2, 
								{{WRAPPER}} .anant-woocommerce-account .woocommerce-MyAccount-content h3, 
								{{WRAPPER}} .anant-woocommerce-account .woocommerce-MyAccount-content h4, 
								{{WRAPPER}} .anant-woocommerce-account .woocommerce-MyAccount-content h5, 
								{{WRAPPER}} .anant-woocommerce-account .woocommerce-MyAccount-content h6',
			]
		);
		$this->add_control(
			$slug.'_link',
			[
				'label' => __( 'Link', 'anant-addons-for-elementor' ),
				'type' => Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);
		anant_color_control(
			$this,
			[
				'key'       =>  $slug.'_link_color',
				'label'     => 'Color',
				'selectors' => [
					'{{WRAPPER}} .anant-woocommerce-account a:not(.button, .view, .pay, .cancel, .woocommerce-orders-table__cell-order-number a, .download-product a, .woocommerce-MyAccount-navigation-link a)' => 'color: {{VALUE}};',
				],
			]
		);
		anant_color_control(
			$this,
			[
				'key'       =>  $slug.'_link_hover_color',
				'label'     => 'Hover Color',
				'selectors' => [
					'{{WRAPPER}} .anant-woocommerce-account a:not(.button, .view, .pay, .cancel, .woocommerce-orders-table__cell-order-number a, .download-product a, .woocommerce-MyAccount-navigation-link a):hover' => 'color: {{VALUE}};',
				],
			]
		);
		anant_typography_control(
			$this,
			[
				'name'     =>  $slug.'_link_typography',
				'label'    => 'Typography',
				'selector' => '{{WRAPPER}} .anant-woocommerce-account a:not(.button, .view, .pay, .cancel, .woocommerce-orders-table__cell-order-number a, .download-product a, .woocommerce-MyAccount-navigation-link a)',
			]
		);
		$this->add_control(
			$slug.'_label',
			[
				'label' => __( 'Label', 'anant-addons-for-elementor' ),
				'type' => Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);
		anant_color_control(
			$this,
			[
				'key'       =>  $slug.'_label_color',
				'label'     => 'Color',
				'selectors' => [
					'{{WRAPPER}} .anant-woocommerce-account label' => 'color: {{VALUE}};',
				],
			]
		);
		anant_typography_control(
			$this,
			[
				'name'     =>  $slug.'_label_typography',
				'label'    => 'Typography',
				'selector' => '{{WRAPPER}} .anant-woocommerce-account label',
			]
		);

		$this->add_responsive_control(
			$slug.'_label_spacing',
			[
				'label'     => esc_html__('Spacing', 'anant-addons-for-elementor'),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .anant-woocommerce-account label' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
					'{{WRAPPER}} .anant-woocommerce-account label .required' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			$slug.'_fields',
			[
				'label' => __( 'Input Fields', 'anant-addons-for-elementor' ),
				'type' => Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);

		$this->add_responsive_control(
			$slug.'inputs_height',
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
					'{{WRAPPER}} .anant-woocommerce-account .woocommerce .form-row input.input-text' => 'height: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .anant-woocommerce-account .woocommerce .select2-container .select2-selection--single' => 'height: {{SIZE}}{{UNIT}};',
				],
			]
		);
		anant_color_control(
			$this,
			[
				'key'       =>  $slug.'_field_color',
				'label'     => 'Color',
				'selectors' => [
					'{{WRAPPER}} .anant-woocommerce-account .woocommerce input, {{WRAPPER}} .anant-woocommerce-account .woocommerce select, {{WRAPPER}} .anant-woocommerce-account .woocommerce textarea' => 'color: {{VALUE}};',
				],
			]
		);
		anant_color_control(
			$this,
			[
				'key'       =>  $slug.'_field_bg_color',
				'label'     => 'Background Color',
				'selectors' => [
					'{{WRAPPER}} .anant-woocommerce-account .woocommerce input, {{WRAPPER}} .anant-woocommerce-account .woocommerce select, {{WRAPPER}} .anant-woocommerce-account .woocommerce textarea' => 'background-color: {{VALUE}};',
				],
			]
		);
		anant_border_control(
			$this,
			[
				'name'     =>  $slug.'_field_border_color',
				'label'    => 'Border Type',
				'selector' => '
					{{WRAPPER}} .anant-woocommerce-account .woocommerce input, 
					{{WRAPPER}} .anant-woocommerce-account .woocommerce .select, 
					{{WRAPPER}} .anant-woocommerce-account .woocommerce .select2-container--default .select2-selection--single, 
					{{WRAPPER}} .anant-woocommerce-account .woocommerce textarea',
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
					{{WRAPPER}} .anant-woocommerce-account .woocommerce input:hover, 
					{{WRAPPER}} .anant-woocommerce-account .woocommerce input:focus, 
					{{WRAPPER}} .anant-woocommerce-account .woocommerce input:active , {{WRAPPER}} .anant-woocommerce-account .woocommerce textarea:hover, 
					{{WRAPPER}} .anant-woocommerce-account .woocommerce textarea:focus, {{WRAPPER}} .anant-woocommerce-account .woocommerce textarea:active',
			]
		);

		anant_border_radius_control(
			$this,
			[
				'key'       =>  $slug.'_field_border_radius',
				'label'     => 'Border Radius',
				'selectors' => [
					'{{WRAPPER}} .anant-woocommerce-account .woocommerce input' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					'{{WRAPPER}} .anant-woocommerce-account .woocommerce select' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					'{{WRAPPER}} .anant-woocommerce-account .woocommerce .select2-container--default .select2-selection--single' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					'{{WRAPPER}} .anant-woocommerce-account .woocommerce textarea' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
					'{{WRAPPER}} .anant-woocommerce-account .woocommerce .form-row' => 'margin-bottom: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_control( $slug.'_show_password_hr', [ 'type' => \Elementor\Controls_Manager::DIVIDER, ] );

		$this->add_control(
			$slug.'_show_password',
			[
				'label' => __( 'Show PassWord', 'anant-addons-for-elementor' ),
				'type' => Controls_Manager::HEADING,
			]
		);
		$this->add_responsive_control(
			$slug.'_show_password_size',
			[
				'label' => __( 'Size', 'anant-addons-for-elementor' ),
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
					'{{WRAPPER}} .anant-account-wrapper.loggedin .show-password-input' => 'font-size: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			$slug.'_show_password_margin',
			[
				'label'     => esc_html__('Margin', 'anant-addons-for-elementor'),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .anant-account-wrapper.loggedin .show-password-input' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
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
					'{{WRAPPER}} .anant-account-wrapper .woocommerce p button.button' => 'color: {{VALUE}};',
					'{{WRAPPER}} .anant-account-wrapper a.button:not(.view, .cancel, .pay)' => 'color: {{VALUE}} !important;',
					'{{WRAPPER}} div.anant-account-wrapper .woocommerce-MyAccount-content .woocommerce-Button--previous' => 'color: {{VALUE}};',
					'{{WRAPPER}} div.anant-account-wrapper .woocommerce-MyAccount-content .woocommerce-Button--next' => 'color: {{VALUE}};',
				],
			]
		);

		anant_color_control(
			$this,
			[
				'key'       => $slug.'_bg_color',
				'label'     => 'Background Color',
				'selectors' => [
					'{{WRAPPER}} .anant-account-wrapper .woocommerce p button.button' => 'background-color: {{VALUE}};',
					'{{WRAPPER}} .anant-account-wrapper a.button:not(.view, .cancel, .pay)' => 'background-color: {{VALUE}};',
					'{{WRAPPER}} div.anant-account-wrapper .woocommerce-MyAccount-content .woocommerce-Button--previous' => 'background-color: {{VALUE}};',
					'{{WRAPPER}} div.anant-account-wrapper .woocommerce-MyAccount-content .woocommerce-Button--next' => 'background-color: {{VALUE}};',
				],
			]
		);

		anant_border_control(
			$this,
			[
				'name'     => $slug.'_border_type',
				'label'    => 'Border Type',
				'selector' => '{{WRAPPER}} .anant-account-wrapper .woocommerce p button.button, {{WRAPPER}} .anant-account-wrapper a.button:not(.view, .cancel, .pay), {{WRAPPER}} div.anant-account-wrapper .woocommerce-MyAccount-content .woocommerce-Button--previous, {{WRAPPER}} div.anant-account-wrapper .woocommerce-MyAccount-content .woocommerce-Button--next',
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
					'{{WRAPPER}} .anant-account-wrapper .woocommerce p button.button:hover' => 'color: {{VALUE}} !important;',
					'{{WRAPPER}} .anant-account-wrapper a.button:not(.view, .cancel, .pay):hover' => 'color: {{VALUE}} !important;',
					'{{WRAPPER}} div.anant-account-wrapper .woocommerce-MyAccount-content .woocommerce-Button--previous:hover' => 'color: {{VALUE}} !important;',
					'{{WRAPPER}} div.anant-account-wrapper .woocommerce-MyAccount-content .woocommerce-Button--next:hover' => 'color: {{VALUE}} !important;',
				],
			]
		);

		anant_color_control(
			$this,
			[
				'key'       => $slug.'_bg_hover_color',
				'label'     => 'Background Color',
				'selectors' => [
					'{{WRAPPER}} .anant-account-wrapper .woocommerce p button.button:hover' => 'background-color: {{VALUE}} !important;',
					'{{WRAPPER}} .anant-account-wrapper a.button:not(.view, .cancel, .pay):hover' => 'background-color: {{VALUE}} !important;',
					'{{WRAPPER}} div.anant-account-wrapper .woocommerce-MyAccount-content .woocommerce-Button--previous:hover' => 'background-color: {{VALUE}} !important;',
					'{{WRAPPER}} div.anant-account-wrapper .woocommerce-MyAccount-content .woocommerce-Button--next:hover' => 'background-color: {{VALUE}} !important;',
				],
			]
		);	
		anant_border_control(
			$this,
			[
				'name'     => $slug.'_border_hover_type',
				'label'    => 'Border Type',
				'selector' => '{{WRAPPER}} .anant-account-wrapper .woocommerce p button.button:hover, {{WRAPPER}} .anant-account-wrapper a.button:not(.view, .cancel, .pay):hover, {{WRAPPER}} div.anant-account-wrapper .woocommerce-MyAccount-content .woocommerce-Button--previous:hover, {{WRAPPER}} div.anant-account-wrapper .woocommerce-MyAccount-content .woocommerce-Button--next:hover',
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
					'{{WRAPPER}} .anant-account-wrapper .woocommerce p button.button' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					'{{WRAPPER}} .anant-account-wrapper a.button:not(.view, .cancel, .pay)' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					'{{WRAPPER}} div.anant-account-wrapper .woocommerce-MyAccount-content .woocommerce-Button--previous' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					'{{WRAPPER}} div.anant-account-wrapper .woocommerce-MyAccount-content .woocommerce-Button--next' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
				'separator' => 'before',
			]
		);
		anant_typography_control(
			$this,
			[
				'name'     => $slug.'_typography',
				'label'    => 'Typography',
				'selector' => '{{WRAPPER}} .anant-account-wrapper .woocommerce p button.button, {{WRAPPER}} .anant-account-wrapper a.button:not(.view, .cancel, .pay), {{WRAPPER}} div.anant-account-wrapper .woocommerce-MyAccount-content .woocommerce-Button--previous, {{WRAPPER}} div.anant-account-wrapper .woocommerce-MyAccount-content .woocommerce-Button--next',
			]
		); 

		$this->add_responsive_control(
			$slug.'_padding',
			[
				'label'     => esc_html__('Padding', 'anant-addons-for-elementor'),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .anant-account-wrapper .woocommerce p button.button' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					'{{WRAPPER}} .anant-account-wrapper a.button:not(.view, .cancel, .pay)' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					'{{WRAPPER}} div.anant-account-wrapper .woocommerce-MyAccount-content .woocommerce-Button--previous' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					'{{WRAPPER}} div.anant-account-wrapper .woocommerce-MyAccount-content .woocommerce-Button--next' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
					'{{WRAPPER}} .anant-account-wrapper .woocommerce p button.button' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					'{{WRAPPER}} .anant-account-wrapper a.button:not(.view, .cancel, .pay)' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					'{{WRAPPER}} div.anant-account-wrapper .woocommerce-MyAccount-content .woocommerce-Button--previous' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					'{{WRAPPER}} div.anant-account-wrapper .woocommerce-MyAccount-content .woocommerce-Button--next' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		anant_box_shadow_control(
			$this,
			[
				'key'      => $slug.'_box_shadow',
				'label'    => 'Box Shadow',
				'selector' => '{{WRAPPER}} .anant-account-wrapper .woocommerce p button.button, {{WRAPPER}} .anant-account-wrapper a.button:not(.view, .cancel, .pay), {{WRAPPER}} div.anant-account-wrapper .woocommerce-MyAccount-content .woocommerce-Button--previous, {{WRAPPER}} div.anant-account-wrapper .woocommerce-MyAccount-content .woocommerce-Button--next',
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'anant_my_account_address_section',
			[
				'label' => esc_html__( 'Address', 'anant-addons-for-elementor' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

		$slug = 'my_account_address';

		anant_color_control(
			$this,
			[
				'key'       =>  $slug.'_bg_color',
				'label' => esc_html__( 'Background Color', 'anant-addons-for-elementor' ),
				'selectors' => [
					'{{WRAPPER}} #anant-account-page .woocommerce-Addresses.col2-set .col-1' => 'background-color: {{VALUE}};',
					'{{WRAPPER}} #anant-account-page .woocommerce-Addresses.col2-set .col-2' => 'background-color: {{VALUE}};',
				],
			]
		);

		anant_border_radius_control(
			$this,
			[
				'key'       => $slug.'_border_radius',
				'label'     => 'Border Radius',
				'selectors' => [
					'{{WRAPPER}} #anant-account-page .woocommerce-Addresses.col2-set .col-1' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					'{{WRAPPER}} #anant-account-page .woocommerce-Addresses.col2-set .col-2' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'anant_my_account_table_style',
			[
				'label' => esc_html__( 'Table', 'anant-addons-for-elementor' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

		$slug = 'my_account_table';
		$this->add_control (
			$slug.'_border_collapse',
			[
				'type' => Controls_Manager::SWITCHER,
				'label' => esc_html__( 'Border Collapse', 'anant-addons-for-elementor' ),
				'default' => 'no',
				'return_value' => 'yes',
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
					{{WRAPPER}} .anant-account-wrapper table.shop_table td, 
					{{WRAPPER}} .anant-account-wrapper table.shop_table th, 
					{{WRAPPER}} .anant-account-wrapper .woocommerce table.shop_table tfoot th',
			]
		);

		$this->add_responsive_control(
			$slug.'_padding',
			[
				'label'     => esc_html__('Padding', 'anant-addons-for-elementor'),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .anant-account-wrapper table.shop_table td' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					'{{WRAPPER}} .anant-account-wrapper table.shop_table th' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					'{{WRAPPER}} .anant-account-wrapper .woocommerce table.shop_table tfoot th' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
				'label' => esc_html__( 'Heading Color', 'anant-addons-for-elementor' ),
				'selectors' => [
					'{{WRAPPER}} .anant-account-wrapper thead th' => 'color: {{VALUE}};',
				],
			]
		);
		anant_color_control(
			$this,
			[
				'key'       =>  $slug.'_headings_bg_color',
				'label' => esc_html__( 'Background Color', 'anant-addons-for-elementor' ),
				'selectors' => [
					'{{WRAPPER}} .anant-account-wrapper thead th' => 'background-color: {{VALUE}};',
				],
			]
		);
		anant_typography_control(
			$this,
			[
				'name'     => $slug.'_header_typo',
				'label'    => 'Typography',
				'selector' => '{{WRAPPER}} .anant-account-wrapper thead th',
			]
		);
		$this->add_control(
			$slug.'_table_body_text',
			[
				'label' => __( 'Table Body Text', 'anant-addons-for-elementor' ),
				'type' => Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);
		anant_color_control(
			$this,
			[
				'key'       => $slug.'_table_body_text_color',
				'label' => esc_html__( 'Color', 'anant-addons-for-elementor' ),
				'selectors' => [
					'{{WRAPPER}} .anant-account-wrapper tbody td' => 'color: {{VALUE}};',
				],
			]
		);
		anant_typography_control(
			$this,
			[
				'name'     => $slug.'_table_body_text_typography',
				'label'    => 'Typography',
				'selector' => '{{WRAPPER}}  .anant-account-wrapper tbody td',
			]
		);
        $this->add_control(
            $slug.'_table_body_link',
            [
                'label' => __( 'Table Body Link', 'anant-addons-for-elementor' ),
                'type' => Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );
		anant_color_control(
			$this,
			[
				'key'       => $slug.'_table_body_link_color',
				'label'     => 'Color',
				'selectors' => [
					'{{WRAPPER}} .anant-account-wrapper tbody th a' => 'color: {{VALUE}} !important;',
					'{{WRAPPER}} .anant-account-wrapper tbody td a' => 'color: {{VALUE}} !important;',
				],
			]
		);
		anant_color_control(
			$this,
			[
				'key'       => $slug.'_table_body_link_hover_color',
				'label'     => 'Hover Color',
				'selectors' => [
					'{{WRAPPER}} .anant-account-wrapper tbody th a:hover' => 'color: {{VALUE}} !important;',
					'{{WRAPPER}} .anant-account-wrapper tbody td a:hover' => 'color: {{VALUE}} !important;',
				],
			]
		);
        anant_typography_control(
			$this,
			[
				'name'     => $slug.'_table_body_link_typo',
				'label'    => 'Typography',
				'selector' => '{{WRAPPER}}  .anant-account-wrapper tbody th a, {{WRAPPER}}  .anant-account-wrapper tbody td a, {{WRAPPER}} .anant-account-wrapper a.button.cancel, {{WRAPPER}} .anant-account-wrapper a.button.view, {{WRAPPER}} .anant-account-wrapper a.button.pay',
			]
		);
		anant_color_control(
			$this,
			[
				'key'       => $slug.'_table_odd_color',
				'label' => esc_html__( 'Table Odd Color', 'anant-addons-for-elementor' ),
				'selectors' => [
					'{{WRAPPER}} table tbody>tr:nth-child(odd)>td, {{WRAPPER}} table tbody>tr:nth-child(odd)>th' => 'background-color: {{VALUE}};',
				],
                'separator' => 'before',
			]
		);
		anant_color_control(
			$this,
			[
				'key'       => $slug.'_table_even_color',
				'label' => esc_html__( 'Table Even Color', 'anant-addons-for-elementor' ),
				'selectors' => [
					'{{WRAPPER}} table tbody>tr:nth-child(even)>td, {{WRAPPER}} table tbody>tr:nth-child(even)>th' => 'background-color: {{VALUE}};',
				],
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
				{{WRAPPER}} .anant-account-wrapper .woocommerce-message, 
				{{WRAPPER}} .anant-account-wrapper .woocommerce-error,
				{{WRAPPER}} .anant-account-wrapper .woocommerce-info',
			]
		);
		anant_border_radius_control(
			$this,
			[
				'key'       => $slug.'_border_radius',
				'label'     => 'Border Radius',
				'selectors' => [
					'{{WRAPPER}} .anant-account-wrapper .woocommerce-message' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					'{{WRAPPER}} .anant-account-wrapper .woocommerce-error' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					'{{WRAPPER}} .anant-account-wrapper .woocommerce-info' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
					'{{WRAPPER}} .anant-account-wrapper .woocommerce-message' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					'{{WRAPPER}} .anant-account-wrapper .woocommerce-error' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					'{{WRAPPER}} .anant-account-wrapper .woocommerce-info' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
					'{{WRAPPER}} .anant-account-wrapper .woocommerce-message' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					'{{WRAPPER}} .anant-account-wrapper .woocommerce-error' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					'{{WRAPPER}} .anant-account-wrapper .woocommerce-info' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		anant_box_shadow_control(
			$this,
			[
				'key'      => $slug.'_box_shadow',
				'label'    => 'Box Shadow',
				'selector' => '
				{{WRAPPER}} .anant-account-wrapper .woocommerce-message, 
				{{WRAPPER}} .anant-account-wrapper .woocommerce-error,
				{{WRAPPER}} .anant-account-wrapper .woocommerce-info',
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
					'{{WRAPPER}} .anant-account-wrapper .woocommerce-message' => 'background-color: {{VALUE}}',
				],
			]
		);
		$this->add_control(
			$slug.'_message_color',
			[
				'label'     => __( 'Color', 'anant-addons-for-elementor' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .anant-account-wrapper .woocommerce-message' => 'color: {{VALUE}}',
				],
			]
		);
		$this->add_control(
			$slug.'_message_icon_color',
			[
				'label'     => __( 'Icon Color', 'anant-addons-for-elementor' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .anant-account-wrapper .woocommerce-message:before' => 'color: {{VALUE}}',
				],
			]
		);
		$this->add_control(
			$slug.'_message_border_color',
			[
				'label'     => __( 'Border Color', 'anant-addons-for-elementor' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .anant-account-wrapper .woocommerce-message' => 'border-color: {{VALUE}}',
				],
			]
		);
		anant_typography_control(
			$this,
			[
				'name'     => $slug.'_message_typography',
				'label'    => 'Typography',
				'selector' => '{{WRAPPER}} .anant-account-wrapper .woocommerce-message',
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
					'{{WRAPPER}} .anant-account-wrapper .woocommerce-error' => 'background-color: {{VALUE}}',
				],
			]
		);
		$this->add_control(
			$slug.'_error_color',
			[
				'label'     => __( 'Color', 'anant-addons-for-elementor' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .anant-account-wrapper .woocommerce-error' => 'color: {{VALUE}}',
				],
			]
		);
		$this->add_control(
			$slug.'_error_icon_color',
			[
				'label'     => __( 'Icon Color', 'anant-addons-for-elementor' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .anant-account-wrapper .woocommerce-error:before' => 'color: {{VALUE}}',
				],
			]
		);
		$this->add_control(
			$slug.'_error_border_color',
			[
				'label'     => __( 'Border Color', 'anant-addons-for-elementor' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .anant-account-wrapper .woocommerce-error' => 'border-color: {{VALUE}}',
				],
			]
		);
		anant_typography_control(
			$this,
			[
				'name'     => $slug.'_error_typography',
				'label'    => 'Typography',
				'selector' => '{{WRAPPER}} .anant-account-wrapper .woocommerce-error',
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
					'{{WRAPPER}} .anant-account-wrapper .woocommerce-info' => 'background-color: {{VALUE}}',
				],
			]
		);
		$this->add_control(
			$slug.'_info_color',
			[
				'label'     => __( 'Color', 'anant-addons-for-elementor' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .anant-account-wrapper .woocommerce-info' => 'color: {{VALUE}}',
				],
			]
		);
		$this->add_control(
			$slug.'_info_icon_color',
			[
				'label'     => __( 'Icon Color', 'anant-addons-for-elementor' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .anant-account-wrapper .woocommerce-info:before' => 'color: {{VALUE}}',
					'{{WRAPPER}} .anant-account-wrapper .woocommerce-info a' => 'color: {{VALUE}}',
				],
			]
		);
		$this->add_control(
			$slug.'_info_border_color',
			[
				'label'     => __( 'Border Color', 'anant-addons-for-elementor' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .anant-account-wrapper .woocommerce-info' => 'border-color: {{VALUE}}',
				],
			]
		);
		anant_typography_control(
			$this,
			[
				'name'     => $slug.'_info_typography',
				'label'    => 'Typography',
				'selector' => '{{WRAPPER}} .anant-account-wrapper .woocommerce-info',
			]
		);
		$this->end_controls_tab();
		$this->end_controls_tabs();
		$this->end_controls_section();
	}

	public function render() {

		$settings = $this->get_settings_for_display(); 
		$current_url = $_SERVER['REQUEST_URI']; 
		$status = is_user_logged_in() ? 'loggedin' : 'logout'; 
		$layout = $settings['template_style']; 
		$border_collapse = $settings['my_account_table_border_collapse']; 
		$border_collapse = ($border_collapse === 'yes' ? 'anant-border-collapse' : ''); 
		$account_creation = get_option('woocommerce_enable_myaccount_registration'); ?>

		<?php if($layout == 'ant_vertical_account'){ ?>
			<div class="anant-woocommerce-account <?php echo esc_attr($layout); ?>" id="anant-account-page">
				<div class="anant-account-wrapper <?php echo esc_attr($status); ?> <?php echo esc_attr($border_collapse); ?>">
					<?php if (!is_user_logged_in() ) { ?>
						<?php if (!is_wc_endpoint_url('lost-password') && $account_creation === 'yes') { ?>
							<div class="slide-btn">
								<input type="radio" id="login-id" name="anant_tab_settings" checked="checked" value="0">
								<label class="tab" for="login-id">Login</label>
								<input type="radio" id="signup-id" name="anant_tab_settings" value="1">
								<label class="tab" for="signup-id">Signup</label>
								<span class="glider"></span>
							</div>
						<?php } ?>
					<?php } ?>
					<?php echo do_shortcode('[woocommerce_my_account]'); ?>
				</div>
			</div>
		<?php }

	}
}