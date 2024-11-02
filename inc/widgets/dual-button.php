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

if ( ! defined( 'ABSPATH' ) ) { exit; } // Exit if accessed directly

class Anant_Dualbutton extends \Elementor\Widget_Base {

	private $dual_button_card_class = 'anant-dual-button-card';
	private $dual_button_card_inner_class = 'anant-dual-button-inner-card';
	private $dual_button_one_class = 'anant-dual-button-one';
	private $dual_button_two_class = 'anant-dual-button-two';
	private $dual_button_separator_class = 'anant-dual-button-separator';

	public function get_name() {
		return 'anant-dual-button';
	}

	public function get_title() {
		return esc_html__( 'Dual Button', 'anant-addons-for-elementor' );
	}

	public function get_categories() {
		return [ 'anant-elements' ];
	}

	public function get_icon() {
		return 'ant-icon eicon-dual-button';
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
			'creative', 
			'animate',
			'dual button',
			'hover',
			'anant',
			'anant addons',
			'dual',
			'double',
		];
	}
	protected function register_controls() {

		$this->start_controls_section(
			'content_section',
			[
				'label' => esc_html__( 'Content', 'anant-addons-for-elementor' ),
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
					'layout_1'      => esc_html__( 'Layout 1', 'anant-addons-for-elementor' ),
					'layout_2'      => esc_html__( 'Layout 2 (Pro)', 'anant-addons-for-elementor' ),
					'layout_3'      => esc_html__( 'Layout 3 (Pro)', 'anant-addons-for-elementor' ),
					'layout_4'      => esc_html__( 'Layout 4 (Pro)', 'anant-addons-for-elementor' ),
					'layout_5'      => esc_html__( 'Layout 5 (Pro)', 'anant-addons-for-elementor' ),
					'layout_6'      => esc_html__( 'Layout 6 (Pro)', 'anant-addons-for-elementor' ),
				],
			]
		);
		$this->add_control(
			'anant_dual_button_pro_notice',
			[
				'raw' => 'Only Available in <a href="https://anantaddons.com/" target="_blank">Pro Version!</a>',
				'type' => \Elementor\Controls_Manager::RAW_HTML,
				'content_classes' => 'anant-pro-notice',
				'condition' => [
                    'template_style!' => ['layout_1'],
                ],
			]
		);
		$this->add_control(
			'show_link',
			[
				'label' => esc_html__( 'Show Button One ', 'anant-addons-for-elementor' ),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'label_on' => esc_html__( 'Show', 'anant-addons-for-elementor' ),
				'label_off' => esc_html__( 'Hide', 'anant-addons-for-elementor' ),
				'return_value' => 'yes',
				'default' => 'yes',
			]
		);
		$this->add_control(
			'show_two_link',
			[
				'label' => esc_html__( 'Show Button Two', 'anant-addons-for-elementor' ),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'label_on' => esc_html__( 'Show', 'anant-addons-for-elementor' ),
				'label_off' => esc_html__( 'Hide', 'anant-addons-for-elementor' ),
				'return_value' => 'yes',
				'default' => 'yes',
			]
		);
		$this->end_controls_section();

		$this->start_controls_section(
			'button_section',
			[
				'label' => esc_html__( 'Button One Settings', 'anant-addons-for-elementor' ),
				'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);
		$this->add_control(
			'card_link_text', [
				'label' => esc_html__( 'Link Text', 'anant-addons-for-elementor' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => esc_html__( 'Read More' , 'anant-addons-for-elementor' ),
				'label_block' => true,
			]
		);
		$this->add_control(
			'card_link',
			[
				'label' => esc_html__( 'Link', 'anant-addons-for-elementor' ),
				'type' => \Elementor\Controls_Manager::URL,
				'placeholder' => esc_html__( 'https://your-link.com', 'anant-addons-for-elementor' ),
				'show_external' => true,
				'default' => [
					'url' => '',
					'is_external' => true,
					'nofollow' => true,
				],
			]
		);
		$this->add_control(
			'link_button_icon',
			[
				'label' => esc_html__( 'Icon', 'anant-addons-for-elementor' ),
				'type' => \Elementor\Controls_Manager::ICONS,
				'default' => [
					'value' => 'fas fa-chevron-circle-right',
					'library' => 'solid',
				],
			]
		);
		$this->add_control(
			'link_button_position',
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
			'link_button_space_after',
			[
				'label'           => esc_html__( 'Icon Spacing', 'anant-addons-for-elementor' ),
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
					'{{WRAPPER}} .'.$this->dual_button_one_class.'' => 'gap: {{SIZE}}{{UNIT}};',
				]
			]
		);
		$this->end_controls_section();
		
		$this->start_controls_section(
			'button_two_section',
			[
				'label' => esc_html__( 'Button Two Settings', 'anant-addons-for-elementor' ),
				'tab' => \Elementor\Controls_Manager::TAB_CONTENT, 
			]
		);
		$this->add_control(
			'card_two_link_text', [
				'label' => esc_html__( 'Link Text', 'anant-addons-for-elementor' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => esc_html__( 'Click Here' , 'anant-addons-for-elementor' ),
				'label_block' => true,
			]
		);
		$this->add_control(
			'card_two_link',
			[
				'label' => esc_html__( 'Link', 'anant-addons-for-elementor' ),
				'type' => \Elementor\Controls_Manager::URL,
				'placeholder' => esc_html__( 'https://your-link.com', 'anant-addons-for-elementor' ),
				'show_external' => true,
				'default' => [
					'url' => '',
					'is_external' => true,
					'nofollow' => true,
				],
			]
		);
		$this->add_control(
			'link_two_button_icon',
			[
				'label' => esc_html__( 'Icon', 'anant-addons-for-elementor' ),
				'type' => \Elementor\Controls_Manager::ICONS,
				'default' => [
					'value' => 'fas fa-chevron-circle-left',
					'library' => 'solid',
				],
			]
		);
		$this->add_control(
			'link_two_button_position',
			[
				'label'       => esc_html__( 'Icon Position', 'anant-addons-for-elementor' ),
				'type'        => \Elementor\Controls_Manager::SELECT,
				'default'     => 'before',
				'options'     => [
					'before'      => esc_html__( 'Before', 'anant-addons-for-elementor' ),
					'after'      => esc_html__( 'After', 'anant-addons-for-elementor' ),
				]
			]
		);
		$this->add_responsive_control(
			'link_two_button_space_after',
			[
				'label'           => esc_html__( 'Icon Spacing', 'anant-addons-for-elementor' ),
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
					'{{WRAPPER}} .'.$this->dual_button_two_class.'' => 'gap: {{SIZE}}{{UNIT}};',
				],
			]
		);
		$this->end_controls_section();

		anant_pro_promotion_controls($this);

		//STYLE
		$this->start_controls_section(
			'dual-button_settings',
			[
				'label' => esc_html__( 'General Settings', 'anant-addons-for-elementor' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);
		$this->add_responsive_control(
			'dual-button_alignment',
			[
				'label'     => esc_html__( 'Alignment', 'anant-addons-for-elementor' ),
				'type'      => Controls_Manager::CHOOSE,
				'options'   => [
					'left' => [
						'title' => esc_html__( 'Left', 'anant-addons-for-elementor' ),
						'icon'  => 'eicon-text-align-left',
					],
					'center' => [
						'title' => esc_html__( 'Center', 'anant-addons-for-elementor' ),
						'icon'  => 'eicon-text-align-center',
					],
					'right' => [
						'title' => esc_html__( 'Right', 'anant-addons-for-elementor' ),
						'icon'  => 'eicon-text-align-right',
					],
				],
				'default'    => 'center',
				'toggle'    => true,
				'selectors' => [
					'{{WRAPPER}} .'.$this->dual_button_card_class.'' => 'text-align: {{VALUE}};',
					
				]
			],
		);
		anant_typography_control(
			$this,
			[
				'name'     => 'dual_btn_typography',
				'selector' => '{{WRAPPER}}  .'.$this->dual_button_one_class.', {{WRAPPER}}  .'.$this->dual_button_two_class.'',
			]
		);
		$this->add_responsive_control(
			'cdual_btn_icon_size',
			[
				'label'           => esc_html__( 'Icon Size', 'anant-addons-for-elementor' ),
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
					'{{WRAPPER}} .'.$this->dual_button_one_class.' i' => 'font-size: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .'.$this->dual_button_two_class.' i' => 'font-size: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .'.$this->dual_button_two_class.' svg' => 'width: {{SIZE}}{{UNIT}}; height: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .'.$this->dual_button_one_class.' svg' => 'width: {{SIZE}}{{UNIT}}; height: {{SIZE}}{{UNIT}};',
				],
			]
		);
		$this->add_responsive_control(
			'dual_btn_padding',
			[
				'label'     => esc_html__('Padding', 'anant-addons-for-elementor'),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .'.$this->dual_button_one_class.'' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					'{{WRAPPER}} .'.$this->dual_button_two_class.'' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_responsive_control(
			'dual_btn_margin',
			[
				'label'     => esc_html__('Margin', 'anant-addons-for-elementor'),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .'.$this->dual_button_one_class.'' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					'{{WRAPPER}} .'.$this->dual_button_two_class.'' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->end_controls_section();
				
		//Dual button One Button
		$this->start_controls_section(
			'dual_btn_one_btn_settings',
			[
				'label' => esc_html__('Button One', 'anant-addons-for-elementor' ),
				'tab'   => Controls_Manager::TAB_STYLE, 
				'condition' =>[
					'show_link' => 'yes', 
				],
			]
		);
		$slug = 'dual_btn_one_btn';
		$this->start_controls_tabs( $slug.'_tabs' );
		$this->start_controls_tab(
			$slug.'_normal_style',
			[
				'label' => esc_html__( 'Normal', 'anant-addons-for-elementor' ),
			]
		);
		$this->add_control(
			$slug.'_color',
			[
				'label'     => esc_html__( 'Color', 'anant-addons-for-elementor' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}}  .'.$this->dual_button_one_class.'' => 'color: {{VALUE}}; fill: {{VALUE}};', 
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
						'label' => esc_html__( 'Background', 'anant-addons-for-elementor' ),
						'default' => 'classic',
					],
				],
				'selector'  => '{{WRAPPER}} .'.$this->dual_button_one_class.' ,{{WRAPPER}} .five .'.$this->dual_button_one_class.':before',
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Border::get_type(),
			[
				'name'     => $slug.'_border_type',
				'label'    => esc_html__('Border Type', 'anant-addons-for-elementor' ),
				'selector' => '{{WRAPPER}} .'.$this->dual_button_one_class.'',
			]
		);
		$this->end_controls_tab();
		$this->start_controls_tab(
			$slug.'_style_hover',
			[
				'label' => esc_html__( 'Hover', 'anant-addons-for-elementor' ),

			]
		);
		$this->add_control(
			$slug.'_color_hover',
			[
				'label'     => esc_html__( 'Color', 'anant-addons-for-elementor' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .'.$this->dual_button_one_class.':hover' => 'color: {{VALUE}}; fill: {{VALUE}};', 
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
						'label' => esc_html__( 'Background', 'anant-addons-for-elementor' ),
						'default' => 'classic',
					],
				],
				'selector'  => '{{WRAPPER}} .'.$this->dual_button_one_class.' span:before, 
								{{WRAPPER}} .'.$this->dual_button_one_class.' span:after,
							    {{WRAPPER}} .'.$this->dual_button_one_class.':hover, 
							    {{WRAPPER}} .'.$this->dual_button_one_class.':before,
							    {{WRAPPER}} .'.$this->dual_button_one_class.':after' ,
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Border::get_type(),
			[
				'name'     => $slug.'_border_type_hover',
				'label'    => esc_html__('Border Type', 'anant-addons-for-elementor' ),
				'selector' => '{{WRAPPER}} .'.$this->dual_button_one_class.':hover',
			]
		);
		$this->end_controls_tab();
		$this->end_controls_tabs();

		$this->add_control(
			$slug.'_hr',
			[
				'type' => Controls_Manager::DIVIDER,
			]
		);
		anant_border_radius_control(
			$this,
			[
				'key'       => $slug.'_border_radius',
				'selectors' => [
					'{{WRAPPER}} .'.$this->dual_button_one_class.'' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					'{{WRAPPER}} .'.$this->dual_button_one_class.':before' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					'{{WRAPPER}} .three .'.$this->dual_button_one_class.':after' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		anant_box_shadow_control(
			$this,
			[
				'key'      => $slug.'_box_shadow',
				'selector' => '{{WRAPPER}}  .'.$this->dual_button_one_class.'',
			]
		);
		$this->end_controls_section();
		
		// Dual Button two Button
		$this->start_controls_section(
			'dual_btn_two_btn_settings',
			[
				'label' => esc_html__('Button Two', 'anant-addons-for-elementor' ),
				'tab'   => Controls_Manager::TAB_STYLE,  
				'condition' =>[
					'show_two_link' => 'yes', 
				],
			]
		);
		$slug = 'dual_btn_two_btn';
		$this->start_controls_tabs( $slug.'_tabs' );
		$this->start_controls_tab(
			$slug.'_normal_style',
			[
				'label' => esc_html__( 'Normal', 'anant-addons-for-elementor' ),
			]
		);
		$this->add_control(
			$slug.'_color',
			[
				'label'     => esc_html__( 'Color', 'anant-addons-for-elementor' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}}  .'.$this->dual_button_two_class.'' => 'color: {{VALUE}}; fill: {{VALUE}};', 
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
						'label' => esc_html__( 'Background', 'anant-addons-for-elementor' ),
						'default' => 'classic',
					],
				],
				'selector'  => '{{WRAPPER}} .'.$this->dual_button_two_class.'',
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Border::get_type(),
			[
				'name'     => $slug.'_border_type',
				'label'    => esc_html__('Border Type', 'anant-addons-for-elementor' ),
				'selector' => '{{WRAPPER}} .'.$this->dual_button_two_class.'',
			]
		);
		$this->end_controls_tab();
		$this->start_controls_tab(
			$slug.'_style_hover',
			[
				'label' => esc_html__( 'Hover', 'anant-addons-for-elementor' ),

			]
		);
		$this->add_control(
			$slug.'_color_hover',
			[
				'label'     => esc_html__( 'Color', 'anant-addons-for-elementor' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .'.$this->dual_button_two_class.':hover' => 'color: {{VALUE}}; fill: {{VALUE}};',
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
						'label' => esc_html__( 'Background', 'anant-addons-for-elementor' ),
						'default' => 'classic',
					],
				],
				'selector'  => '{{WRAPPER}} .'.$this->dual_button_two_class.' span:before, 
								{{WRAPPER}} .'.$this->dual_button_two_class.' span:after,
							    {{WRAPPER}} .'.$this->dual_button_two_class.':hover, 
							    {{WRAPPER}} .'.$this->dual_button_two_class.':before,
							    {{WRAPPER}} .'.$this->dual_button_two_class.':after' ,
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Border::get_type(),
			[
				'name'     => $slug.'_border_type_hover',
				'label'    => esc_html__('Border Type', 'anant-addons-for-elementor' ),
				'selector' => '{{WRAPPER}} .'.$this->dual_button_two_class.':hover',
			]
		);
		$this->end_controls_tab();
		$this->end_controls_tabs();

		$this->add_control(
			$slug.'_hr',
			[
				'type' => Controls_Manager::DIVIDER,
			]
		);
		anant_border_radius_control(
			$this,
			[
				'key'       => $slug.'_border_radius',
				'selectors' => [
					'{{WRAPPER}} .'.$this->dual_button_two_class.'' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					'{{WRAPPER}} .'.$this->dual_button_two_class.':before' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					'{{WRAPPER}} .three .'.$this->dual_button_two_class.':after' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		anant_box_shadow_control(
			$this,
			[
				'key'      => $slug.'_box_shadow',
				'selector' => '{{WRAPPER}}  .'.$this->dual_button_two_class.'',
			]
		);
		$this->end_controls_section();
	}

	protected function render() {
		$settings = $this->get_settings_for_display();
 
		$show_link = $settings['show_link'];
		$show_two_link = $settings['show_two_link'];
 
		$link_text = $settings['card_link_text']; 
		$link_button_icon = $settings['link_button_icon'];
		$link_button_position = $settings['link_button_position'];
		$link = $settings['card_link']['url'];
		$target = $settings['card_link']['is_external'] ? ' target=_blank' : '';
		$nofollow = $settings['card_link']['nofollow'] ? ' rel=nofollow' : '';

		$link_two_text = $settings['card_two_link_text']; 
		$link_two_button_icon = $settings['link_two_button_icon'];
		$link_two_button_position = $settings['link_two_button_position'];
		$link_two = $settings['card_two_link']['url'];
		$target_two = $settings['card_two_link']['is_external'] ? ' target=_blank' : '';
		$nofollow_two = $settings['card_two_link']['nofollow'] ? ' rel=nofollow' : '';

		$template_style = $settings['template_style'];

		if ($template_style == 'layout_1') {
			?>
			<div class="anant-dual-button one <?php echo esc_attr($this->dual_button_card_class) ?>">
				<div class="inner <?php echo esc_attr($this->dual_button_card_inner_class) ?>">
				<?php
							if ( $show_link === 'yes' ) { ?>
									<a
										class="anant-btn one <?php echo esc_attr($this->dual_button_one_class) ?> 
										<?php echo $link_button_position === 'before' ? 'anant-no-flex': '' ?>"
										href="<?php echo esc_url($link) ?>"
										<?php echo esc_attr($target); ?>
										<?php echo esc_attr($nofollow); ?>>
										<?php 
											if ($link_button_position === 'before') {
												\Elementor\Icons_Manager::render_icon( $link_button_icon, [ 'aria-hidden' => 'true' ] );
											}
										?>
										<span><?php echo esc_html($link_text) ?></span>
										<?php 
											if ($link_button_position === 'after') {
												\Elementor\Icons_Manager::render_icon( $link_button_icon, [ 'aria-hidden' => 'true' ] );
											}
										?>
									</a>
								<?php
							}
						?>
						<?php if ( $show_two_link === 'yes' ) { ?>
									<a
										class="anant-btn two <?php echo esc_attr($this->dual_button_two_class) ?> <?php echo $link_two_button_position === 'before' ? 'anant-no-flex': '' ?>"
										href="<?php echo esc_url($link_two) ?>"
										<?php echo esc_attr($target); ?>
										<?php echo esc_attr($nofollow); ?>>
										<?php 
											if ($link_two_button_position === 'before') {
												\Elementor\Icons_Manager::render_icon( $link_two_button_icon, [ 'aria-hidden' => 'true' ] );
											}
										?>
										<span><?php echo esc_html($link_two_text) ?></span>
										<?php 
											if ($link_two_button_position === 'after') {
												\Elementor\Icons_Manager::render_icon( $link_two_button_icon, [ 'aria-hidden' => 'true' ] );
											}
										?>
									</a>
								<?php
							}
						?>
				</div>
			</div>
			<?php
		}
	}
}