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

class Anant_Service extends \Elementor\Widget_Base {

	private $service_card_class = 'anant-service-card';
	private $service_card_inner_class = 'anant-service-inner-card';
	private $service_card_image_class = 'anant-service-card-image';
	private $service_card_heading_class = 'anant-service-card-heading';
	private $service_card_icon_class = 'anant-service-card-icon';
	private $service_card_description_class = 'anant-service-card-description';
	private $service_card_read_more_class = 'anant-service-card-read-more';

	public function get_name() {
		return 'anant-service';
	}

	public function get_title() {
		return esc_html__( 'Service', 'anant-addons-for-elementor' );
	}

	public function get_categories() {
		return [ 'anant-elements' ];
	}

	public function get_icon() {
		return 'ant-icon eicon-info-box';
	}

	public function get_style_depends() {
		return [
			'anant-widget-css',
		];
	}

	public function get_script_depends() {
		return [
			'anant-widget-js',
		];
	}

	public function get_keywords() {
		return [
			'service item',
			'service',
			'item',
			'anant',
			'anant service',
			'anant addons',
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
					'layout_2'      => esc_html__( 'Layout 2', 'anant-addons-for-elementor' ),
					'layout_3'      => esc_html__( 'Layout 3', 'anant-addons-for-elementor' ),
					'layout_4'      => esc_html__( 'Layout 4 (Pro)', 'anant-addons-for-elementor' ),
					'layout_5'      => esc_html__( 'Layout 5 (Pro)', 'anant-addons-for-elementor' ),
					'layout_6'      => esc_html__( 'Layout 6 (Pro)', 'anant-addons-for-elementor' ),
					'layout_7'      => esc_html__( 'Layout 7 (Pro)', 'anant-addons-for-elementor' ),
					'layout_8'      => esc_html__( 'Layout 8 (Pro)', 'anant-addons-for-elementor' ),
					'layout_9'      => esc_html__( 'Layout 9 (Pro)', 'anant-addons-for-elementor' ),
					'layout_10'     => esc_html__( 'Layout 10 (Pro)', 'anant-addons-for-elementor' ),
				],
			]
		);

		$this->add_control(
			'anant_service_item_pro_notice',
			[
				'raw' => 'Only Available in <a href="https://anantaddons.com/" target="_blank">Pro Version!</a>',
				'type' => \Elementor\Controls_Manager::RAW_HTML,
				'content_classes' => 'anant-pro-notice',
				'condition' => [
                    'template_style!' => ['layout_1', 'layout_2', 'layout_3'],
                ],
			]
		);

		$this->add_control(
			'card_image',
			[
				'label'   => esc_html__( 'Choose Image', 'anant-addons-for-elementor' ),
				'type'    => Controls_Manager::MEDIA,
				'default' => [
					'url' => anant_placeholder_image_src(),
				],
				'condition' => [ 
					'template_style' => [
						'layout_2',
					],
				],
			]
		);

	

		$this->add_control(
			'card_icon',
			[
				'label' => esc_html__( 'Icon', 'anant-addons-for-elementor' ),
				'type' => \Elementor\Controls_Manager::ICONS,
				'default' => [
					'value' => 'fa fa-star',
					'library' => 'solid',
				],
			]
		);

		$this->add_control(
			'card_title', [
				'label' => esc_html__( 'Title', 'anant-addons-for-elementor' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => esc_html__( 'Card Title' , 'anant-addons-for-elementor' ),
				'label_block' => true,
			]
		);

		$this->add_control(
			'card_description',
			[
				'label' => esc_html__( 'Description', 'anant-addons-for-elementor' ),
				'type' => \Elementor\Controls_Manager::TEXTAREA,
				'rows' => 5,
				'default' => esc_html__( 'Aenean ut turpis blandit eros convallis congue sit amet a libero. Mauris sed tempor felis. Nunc nisi massa, imperdiet ac metus quis, pharetra pulvinar sapien', 'anant-addons-for-elementor' ),
				'placeholder' => esc_html__( 'Type your description here', 'anant-addons-for-elementor' ),
				'conditions' => [
					'relation' => 'and',
					'terms'    => [
						[
							'name'     => 'template_style',
							'operator' => '!==',
							'value'    => 'layout_2',
						]
					]
				]
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'settings_section',
			[
				'label' => esc_html__( 'Settings', 'anant-addons-for-elementor' ),
				'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);

		$this->add_control(
			'show_image',
			[
				'label' => esc_html__( 'Show Image', 'anant-addons-for-elementor' ),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'label_on' => esc_html__( 'Show', 'anant-addons-for-elementor' ),
				'label_off' => esc_html__( 'Hide', 'anant-addons-for-elementor' ),
				'return_value' => 'yes',
				'default' => 'yes',
				'condition' => [ 
					'template_style' => [
						'layout_2', 
					],
				],
			]
		);


		$this->add_control(
			'show_icon',
			[
				'label' => esc_html__( 'Show Icon', 'anant-addons-for-elementor' ),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'label_on' => esc_html__( 'Show', 'anant-addons-for-elementor' ),
				'label_off' => esc_html__( 'Hide', 'anant-addons-for-elementor' ),
				'return_value' => 'yes',
				'default' => 'yes',
			]
		);

		$this->add_control(
			'show_title',
			[
				'label' => esc_html__( 'Show Title', 'anant-addons-for-elementor' ),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'label_on' => esc_html__( 'Show', 'anant-addons-for-elementor' ),
				'label_off' => esc_html__( 'Hide', 'anant-addons-for-elementor' ),
				'return_value' => 'yes',
				'default' => 'yes',
			]
		);

		$this->add_control(
			'show_description',
			[
				'label' => esc_html__( 'Show Description', 'anant-addons-for-elementor' ),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'label_on' => esc_html__( 'Show', 'anant-addons-for-elementor' ),
				'label_off' => esc_html__( 'Hide', 'anant-addons-for-elementor' ),
				'return_value' => 'yes',
				'default' => 'yes',
				'conditions' => [
					'relation' => 'and',
					'terms'    => [
						[
							'name'     => 'template_style',
							'operator' => '!==',
							'value'    => 'layout_2',
						]
					]
				]
			]
		);

		$this->add_control(
			'show_link',
			[
				'label' => esc_html__( 'Show Read More', 'anant-addons-for-elementor' ),
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
				'label' => esc_html__( 'Button Settings', 'anant-addons-for-elementor' ),
				'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);

		$this->add_control(
			'card_link_text', [
				'label' => esc_html__( 'Button Text', 'anant-addons-for-elementor' ),
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
					'value' => 'fa fa-arrow-right',
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
				],
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
					'{{WRAPPER}} .'.$this->service_card_read_more_class.' .more' => 'gap: {{SIZE}}{{UNIT}};',
				],
				'conditions' => [
					'relation' => 'and',
					'terms'    => [
						[
							'name'     => 'template_style',
							'operator' => '!==',
							'value'    => 'layout_2',
						]
					],
				],
			]
		);

		$this->end_controls_section();

		anant_pro_promotion_controls($this);

		//STYLE
		// Service Box
		$this->start_controls_section(
			'service_settings',
			[
				'label' => esc_html__( 'Service Box Settings', 'anant-addons-for-elementor' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);

		$this->start_controls_tabs( 'card_tabs' );

		$this->start_controls_tab(
			'card_normal_style',
			[
				'label' => esc_html__( 'Normal', 'anant-addons-for-elementor' ),
			]
		);

		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name'      => 'card_bg_opacity_color',
				'types'          => [ 'classic', 'gradient' ],
				'exclude'        => [ 'image' ],
				'fields_options' => [
					'background' => [
						'label'     => esc_html__( 'Background ', 'anant-addons-for-elementor' ),
						'default' => 'classic',
					],
				],
				'selector'  => '{{WRAPPER}} .'.$this->service_card_class.', .'.$this->service_card_class.'.service_four::before',
			]
		);
		anant_border_control(
			$this,
			[
				'name'     => 'card_border_type',
				'selector' => '{{WRAPPER}} .'.$this->service_card_class,
			]
		);

		anant_border_radius_control(
			$this,
			[
				'key'       => 'card_border_radius',
				'selectors' => [
					'{{WRAPPER}} .'.$this->service_card_class => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					'{{WRAPPER}} .'.$this->service_card_class => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'card_padding',
			[
				'label'     => esc_html__('Padding', 'anant-addons-for-elementor'),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .'.$this->service_card_class => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					'{{WRAPPER}} .'.$this->service_card_class => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'card_margin',
			[
				'label'     => esc_html__('Margin', 'anant-addons-for-elementor'),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .'.$this->service_card_class => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					'{{WRAPPER}} .'.$this->service_card_class => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		anant_box_shadow_control(
			$this,
			[
				'key'      => 'card_box_shadow',
				'selector' => '{{WRAPPER}}  .'.$this->service_card_class,
			]
		);


		$this->end_controls_tab();

		$this->start_controls_tab(
			'card_style_hover',
			[
				'label' => esc_html__( 'Hover', 'anant-addons-for-elementor' ),

			]
		);
		
		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name'      	 => 'card_bg_opacity_hover_color',
				'types'          => [ 'classic', 'gradient' ],
				'exclude'        => [ 'image' ],
				'fields_options' => [
					'background' => [
						'label'     => esc_html__( 'Background ', 'anant-addons-for-elementor' ),
						'default' => 'classic',
					],
				],
				'selector'  => '{{WRAPPER}} .'.$this->service_card_class.':hover',
				'condition' => [
					'template_style!' => [
						'layout_1',
					],
				],
			]
		);
		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name'      	 => 'card_bg_opacity_two_hover_color',
				'types'          => [ 'classic', 'gradient' ],
				'exclude'        => [ 'image' ],
				'fields_options' => [
					'background' => [
						'label'     => esc_html__( 'Background ', 'anant-addons-for-elementor' ),
						'default' => 'classic',
					],
				],
				'selector'  => '{{WRAPPER}} .'.$this->service_card_class.'::before',
				'condition' => [
					'template_style' => [
						'layout_1',
					],
				],
			]
		);

		anant_border_control(
			$this,
			[
				'name'     => 'card_border_type_hover',
				'selector' => '{{WRAPPER}} .'.$this->service_card_class.':hover',
			]
		);

		anant_border_radius_control(
			$this,
			[
				'key'       => 'card_border_radius_hover',
				'selectors' => [
					'{{WRAPPER}} .'.$this->service_card_class.':hover' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					'{{WRAPPER}} .'.$this->service_card_class.':hover' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'card_padding_hover',
			[
				'label'     => esc_html__('Padding', 'anant-addons-for-elementor'),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .'.$this->service_card_class.':hover' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					'{{WRAPPER}} .'.$this->service_card_class.':hover' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'card_margin_hover',
			[
				'label'     => esc_html__('Margin', 'anant-addons-for-elementor'),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .'.$this->service_card_class.':hover' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					'{{WRAPPER}} .'.$this->service_card_class.':hover' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		anant_box_shadow_control(
			$this,
			[
				'key'      => 'card_box_shadow_hover',
				'selector' => '{{WRAPPER}}  .'.$this->service_card_class.':hover',
			]
		);

		$this->end_controls_tab(); 
		$this->end_controls_tabs();
		$this->end_controls_section();

		// Service Inner Settings
		$this->start_controls_section(
			'service_inner_style',
			[
				'label' => esc_html__( 'Service Content Settings', 'anant-addons-for-elementor' ),
				'tab'   => Controls_Manager::TAB_STYLE,
				'condition' => [
					'template_style' => [
						'layout_3',
					],
				],
			]
		); 
		$slug = 'service_inner_box';

		$this->start_controls_tabs( $slug.'_tabs' );

		$this->start_controls_tab(
			$slug.'_normal_style',
			[
				'label' => esc_html__( 'Normal', 'anant-addons-for-elementor' ),
			]
		);

		$this->add_control(
			$slug.'_bg_color',
			[
				'label'     => esc_html__( 'Background Color', 'anant-addons-for-elementor' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}}  .'.$this->service_card_inner_class => 'background-color: {{VALUE}}',
				], 
			]
		);

		anant_border_control(
			$this,
			[
				'name'     => $slug.'_border_type',
				'selector' => '{{WRAPPER}} .'.$this->service_card_inner_class,
			]
		);

		anant_border_radius_control(
			$this,
			[
				'key'       => $slug.'_border_radius',
				'selectors' => [
					'{{WRAPPER}} .'.$this->service_card_inner_class => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					'{{WRAPPER}} .'.$this->service_card_inner_class => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
					'{{WRAPPER}} .'.$this->service_card_inner_class => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
					'{{WRAPPER}} .'.$this->service_card_inner_class => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					'{{WRAPPER}} .'.$this->service_card_inner_class => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		anant_box_shadow_control(
			$this,
			[
				'key'      => $slug.'_box_shadow',
				'selector' => '{{WRAPPER}}  .'.$this->service_card_inner_class,
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
			$slug.'_bg_hover_color',
			[
				'label'     => esc_html__( 'Background Color', 'anant-addons-for-elementor' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}}  .'.$this->service_card_inner_class.':hover' => 'background-color: {{VALUE}}',
				], 
			]
		);

		 
		anant_border_control(
			$this,
			[
				'name'     => $slug.'_border_type_hover',
				'selector' => '{{WRAPPER}} .'.$this->service_card_inner_class.':hover',
			]
		);

		$this->add_responsive_control(
			$slug.'_padding_hover',
			[
				'label'     => esc_html__('Padding', 'anant-addons-for-elementor'),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .'.$this->service_card_inner_class.':hover' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			$slug.'_inner_padding_hover',
			[
				'label'     => esc_html__('Inner Content Padding', 'anant-addons-for-elementor'),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .'.$this->service_card_inner_class.':hover' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
					'{{WRAPPER}} .'.$this->service_card_inner_class.':hover' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					'{{WRAPPER}} .'.$this->service_card_inner_class.':hover' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		anant_box_shadow_control(
			$this,
			[
				'key'      => $slug.'_box_shadow_hover',
				'selector' => '{{WRAPPER}}  .'.$this->service_card_inner_class.':hover',
			]
		);

		$this->end_controls_tab();
		$this->end_controls_tabs(); 
		$this->end_controls_section();

		// Service Image Settings
		$this->start_controls_section(
			'service_image_settings',
			[
				'label' => esc_html__( 'Image Settings ', 'anant-addons-for-elementor' ),
				'tab'   => Controls_Manager::TAB_STYLE, 
				'condition' => [ 
					'template_style' => [
						'layout_2',
					],
				],
			], 
		);

		$this->add_control(
			'servie_image_bg_color',
			[
				'label'     => esc_html__( 'Overlay Color', 'anant-addons-for-elementor' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}}  .'.$this->service_card_image_class.'::before , .service_five .'.$this->service_card_image_class.' + 	.content::before' => 'background-color: {{VALUE}}',
				],
				'condition' => [ 
					'template_style' => [
						'layout_2',
					],
				],
			]
		);
		
		$slug = 'service_box_image';
		$this->start_controls_tabs( $slug.'_tabs' );

		$this->start_controls_tab(
			$slug.'_normal_style',
			[
				'label' => esc_html__( 'Normal', 'anant-addons-for-elementor' ),
			]
		);
		
		$this->add_responsive_control(
			$slug.'_image_width',
			[
				'label'           => esc_html__( 'Image Width', 'anant-addons-for-elementor' ),
				'type'            => Controls_Manager::SLIDER,
				'size_units'      => [ 'px', '%' ],
				'range'           => [
					'px' => [
						'min' => 0,
						'max' => 1200,
					],
					'%' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'devices'         => [ 'desktop', 'tablet', 'mobile' ],
				'desktop_default' => [
					'size' =>'' ,
					'unit' => '%',
				],
				'tablet_default'  => [
					'size' => '',
					'unit' => '%',
				],
				'mobile_default'  => [
					'size' => '',
					'unit' => '%',
				],
				'selectors'       => [
					'{{WRAPPER}} .'.$this->service_card_image_class.'' => 'width: {{SIZE}}{{UNIT}};',
				],
			],
		);

		$this->add_responsive_control(
			$slug.'_image_height',
			[
				'label'           => esc_html__( 'Image Height', 'anant-addons-for-elementor' ),
				'type'            => Controls_Manager::SLIDER,
				'size_units'      => [ 'px', '%' ],
				'range'           => [
					'px' => [
						'min' => 0,
						'max' => 1200,
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
					'{{WRAPPER}} .'.$this->service_card_image_class.'' => 'height: {{SIZE}}{{UNIT}};',
				],
			]
		);

		anant_border_control(
			$this,
			[
				'name'     => $slug.'_border_type',
				'selector' => '{{WRAPPER}} .'.$this->service_card_image_class.' img',
			]
		);

		anant_border_radius_control(
			$this,
			[
				'key'       => $slug.'_border_radius',
				'selectors' => [
					'{{WRAPPER}} .'.$this->service_card_image_class.' img' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					'{{WRAPPER}} .'.$this->service_card_image_class.' img' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
					'{{WRAPPER}} .'.$this->service_card_image_class.' img' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					'{{WRAPPER}} .'.$this->service_card_image_class.' img' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		anant_box_shadow_control(
			$this,
			[
				'key'      => $slug.'_box_shadow',
				'selector' => '{{WRAPPER}}  .'.$this->service_card_image_class.'',
			]
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
			$slug.'_style_hover',
			[
				'label' => esc_html__( 'Hover', 'anant-addons-for-elementor' ),

			]
		);

		
		$this->add_responsive_control(
			$slug.'_hover_image_width',
			[
				'label'           => esc_html__( 'Image Width', 'anant-addons-for-elementor' ),
				'type'            => Controls_Manager::SLIDER,
				'size_units'      => [ 'px', '%' ],
				'range'           => [
					'px' => [
						'min' => 0,
						'max' => 1200,
					],
					'%' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'devices'         => [ 'desktop', 'tablet', 'mobile' ],
				'desktop_default' => [
					'size' =>'' ,
					'unit' => '%',
				],
				'tablet_default'  => [
					'size' => '',
					'unit' => '%',
				],
				'mobile_default'  => [
					'size' => '',
					'unit' => '%',
				],
				'selectors'       => [
					'{{WRAPPER}} .'.$this->service_card_image_class.':hover' => 'width: {{SIZE}}{{UNIT}};',
				],
			],
		);

		$this->add_responsive_control(
			$slug.'_hover_image_height',
			[
				'label'           => esc_html__( 'Image Height', 'anant-addons-for-elementor' ),
				'type'            => Controls_Manager::SLIDER,
				'size_units'      => [ 'px', '%' ],
				'range'           => [
					'px' => [
						'min' => 0,
						'max' => 1200,
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
					'{{WRAPPER}} .'.$this->service_card_image_class.':hover' => 'height: {{SIZE}}{{UNIT}};',
				],
			]
		);


		anant_border_control(
			$this,
			[
				'name'     => $slug.'_border_type_hover',
				'selector' => '{{WRAPPER}} .'.$this->service_card_image_class.' img:hover',
			]
		);

		anant_border_radius_control(
			$this,
			[
				'key'       => $slug.'_border_radius_hover',
				'selectors' => [
					'{{WRAPPER}} .'.$this->service_card_image_class.' img:hover' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					'{{WRAPPER}} .'.$this->service_card_image_class.' img:hover' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
					'{{WRAPPER}} .'.$this->service_card_image_class.' img:hover' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					'{{WRAPPER}} .'.$this->service_card_image_class.' img:hover' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		anant_box_shadow_control(
			$this,
			[
				'key'      => $slug.'_box_shadow_hover',
				'selector' => '{{WRAPPER}}  .'.$this->service_card_image_class.':hover',
			]
		);

		$this->end_controls_tab();
		$this->end_controls_tabs(); 
		$this->end_controls_section();

		// Service Icon Settings
		$this->start_controls_section(
			'icon_settings',
			[
				'label' => esc_html__( 'Icon Settings', 'anant-addons-for-elementor' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_responsive_control(
			'card_heading_icon_alignment',
			[
				'label'     => esc_html__( 'Alignment', 'anant-addons-for-elementor' ),
				'type'      => Controls_Manager::CHOOSE,
				'options'   => [
					'flex-start' => [
						'title' => esc_html__( 'Left', 'anant-addons-for-elementor' ),
						'icon'  => 'eicon-text-align-left',
					],
					'center' => [
						'title' => esc_html__( 'Center', 'anant-addons-for-elementor' ),
						'icon'  => 'eicon-text-align-center',
					],
					'flex-end' => [
						'title' => esc_html__( 'Right', 'anant-addons-for-elementor' ),
						'icon'  => 'eicon-text-align-right',
					],
				],
				'toggle'    => true,
				'selectors' => [
					'{{WRAPPER}} .'.$this->service_card_icon_class => 'justify-content: {{VALUE}};',
				],
			]
		);

        $this->start_controls_tabs( 'card_icon_tabs' );

		$this->start_controls_tab(
			'card_heading_icon_normal_style',
			[
				'label' => esc_html__( 'Normal', 'anant-addons-for-elementor' ),
			]
		);

		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name'      => 'icon_bg_color',
				'types'          => [ 'classic', 'gradient' ],
				'exclude'        => [ 'image' ],
				'fields_options' => [
					'background' => [
						'label'     => esc_html__( 'Background ', 'anant-addons-for-elementor' ),
						'default' => 'classic',
					],
				],
				'selector'  => '{{WRAPPER}} .'.$this->service_card_icon_class.' .icon:before, {{WRAPPER}} .'.$this->service_card_icon_class.' .icon',
			]
		);

		$this->add_control(
			'icon_color',
			[
				'label'     => esc_html__( 'Icon Color', 'anant-addons-for-elementor' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}}  .'.$this->service_card_icon_class.' .icon' => 'color: {{VALUE}}',
					'{{WRAPPER}}  .'.$this->service_card_icon_class.' .icon svg' => 'fill: {{VALUE}}',
				],
			],
		);

		$this->add_responsive_control(
			'icon_width',
			[
				'label'           => esc_html__( 'Icon Width', 'anant-addons-for-elementor' ),
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
					'{{WRAPPER}} .'.$this->service_card_icon_class.' .icon' => 'width: {{SIZE}}{{UNIT}};height: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'icon_size',
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
					'{{WRAPPER}} .'.$this->service_card_icon_class.' .icon i' => 'font-size: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .'.$this->service_card_icon_class.' .icon svg' => 'width: {{SIZE}}{{UNIT}};height: {{SIZE}}{{UNIT}};',
				],
			]
		);

		anant_border_control(
			$this,
			[
				'name'     => 'icon_border_type',
				'selector' => '{{WRAPPER}} .'.$this->service_card_icon_class.' .icon',
			]
		);

		anant_border_radius_control(
			$this,
			[
				'key'       => 'icon_border_type',
				'selectors' => [
					'{{WRAPPER}} .'.$this->service_card_icon_class.' .icon' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					'{{WRAPPER}} .'.$this->service_card_icon_class.' .icon:before' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'card_heading_icon_margin',
			[
				'label'     => esc_html__('Margin', 'anant-addons-for-elementor'),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .'.$this->service_card_icon_class => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					'{{WRAPPER}} .'.$this->service_card_icon_class => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		anant_box_shadow_control(
			$this,
			[
				'key'      => 'icon_box_shadow',
				'selector' => '{{WRAPPER}}  .'.$this->service_card_icon_class . ' .icon',
			]
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
			'card_heading_icon_style_hover',
			[
				'label' => esc_html__( 'Hover', 'anant-addons-for-elementor' ),

			]
		);

		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name'      => 'icon_bg_color_hover',
				'types'          => [ 'classic', 'gradient' ],
				'exclude'        => [ 'image' ],
				'fields_options' => [
					'background' => [
						'label'     => esc_html__( 'Background ', 'anant-addons-for-elementor' ),
						'default' => 'classic',
					],
				],
				'selector'  => '{{WRAPPER}} .'.$this->service_card_class.':hover .icon:before, {{WRAPPER}} .'.$this->service_card_class.':hover .icon',
			]
		);
		$this->add_control(
			'icon_color_hover',
			[
				'label'     => esc_html__( 'Icon Color', 'anant-addons-for-elementor' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}}  .'.$this->service_card_class.':hover .icon' => 'color: {{VALUE}}',
					'{{WRAPPER}}  .'.$this->service_card_class.':hover .icon svg' => 'fill: {{VALUE}}',
				], 
			]
		);

		$this->add_responsive_control(
			'icon_width_hover',
			[
				'label'           => esc_html__( 'Icon Width', 'anant-addons-for-elementor' ),
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
					'{{WRAPPER}} .'.$this->service_card_icon_class.' .icon:hover' => 'width: {{SIZE}}{{UNIT}};height: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'icon_size_hover',
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
					'{{WRAPPER}} .'.$this->service_card_icon_class.' .icon:hover i' => 'font-size: {{SIZE}}{{UNIT}};',
				],
			]
		);

		anant_border_control(
			$this,
			[
				'name'     => 'icon_border_type_hover',
				'selector' => '{{WRAPPER}} .'.$this->service_card_icon_class. ' .icon:hover',
			]
		);

		anant_border_radius_control(
			$this,
			[
				'key'       => 'icon_border_radius_hover',
				'selectors' => [
					'{{WRAPPER}} .'.$this->service_card_icon_class.' .icon:hover' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					'{{WRAPPER}} .'.$this->service_card_icon_class. ' .icon:hover:before' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'card_heading_icon_margin_hover',
			[
				'label'     => esc_html__('Margin', 'anant-addons-for-elementor'),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .'.$this->service_card_icon_class.':hover' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					'{{WRAPPER}} .'.$this->service_card_icon_class.':hover' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		anant_box_shadow_control(
			$this,
			[
				'key'      => 'icon_box_shadow_hover',
				'selector' => '{{WRAPPER}}  .'.$this->service_card_icon_class . ' .icon:hover',
			]
		);

		$this->end_controls_tab();  
		$this->end_controls_tabs(); 
		$this->end_controls_section();

		// Service Title Settings
		$this->start_controls_section(
			'service_heading_title',
			[
				'label' => esc_html__( 'Heading Title', 'anant-addons-for-elementor' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_responsive_control(
			'card_heading_title_alignment',
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
				'toggle'    => true,
				'selectors' => [
					'{{WRAPPER}} .'.$this->service_card_heading_class => 'text-align: {{VALUE}};',
				],
			]
		);

        $this->start_controls_tabs( 'card_heading_tabs' );

		$this->start_controls_tab(
			'card_heading_title_normal_style',
			[
				'label' => esc_html__( 'Normal', 'anant-addons-for-elementor' ),
			]
		);

		
		$this->add_control(
			'card_heading_title_color',
			[
				'label'     => esc_html__( 'Heading Color', 'anant-addons-for-elementor' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}}  .'.$this->service_card_class.' h3' => 'color: {{VALUE}}',
				],
			]
		);

		anant_typography_control(
			$this,
			[
				'name'     => 'card_heading_title_typography',
				'selector' => '{{WRAPPER}}  .'.$this->service_card_heading_class,
			]
		);
		
		anant_border_control(
			$this,
			[
				'name'     => 'card_heading_title_border_type',
				'selector' => '{{WRAPPER}} .'.$this->service_card_heading_class,
			]
		);

		anant_border_radius_control(
			$this,
			[
				'key'       => 'card_heading_title_border_radius',
				'selectors' => [
					'{{WRAPPER}} .'.$this->service_card_heading_class => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					'{{WRAPPER}} .'.$this->service_card_heading_class => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'card_heading_title_padding',
			[
				'label'     => esc_html__('Padding', 'anant-addons-for-elementor'),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .'.$this->service_card_heading_class => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					'{{WRAPPER}} .'.$this->service_card_heading_class => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'card_heading_title_margin',
			[
				'label'     => esc_html__('Margin', 'anant-addons-for-elementor'),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .'.$this->service_card_heading_class => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					'{{WRAPPER}} .'.$this->service_card_heading_class => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		anant_text_shadow_control(
			$this,
			[
				'key'      => 'card_heading_title_text_shadow',
				'selector' => '{{WRAPPER}}  .'.$this->service_card_heading_class,
			]
		);


		$this->end_controls_tab();

		$this->start_controls_tab(
			'card_heading_title_style_hover',
			[
				'label' => esc_html__( 'Hover', 'anant-addons-for-elementor' ),

			]
		);

		$this->add_control(
			'card_heading_title_color_hover',
			[
				'label'     => esc_html__( 'Heading Color', 'anant-addons-for-elementor' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}}  .'.$this->service_card_class.':hover h3' => 'color: {{VALUE}}',
				],
			]
		);

		anant_typography_control(
			$this,
			[
				'name'     => 'card_heading_title_typography_hover',
				'selector' => '{{WRAPPER}}  .'.$this->service_card_heading_class.':hover',
			]
		);

		anant_border_control(
			$this,
			[
				'name'     => 'card_heading_title_border_type_hover',
				'selector' => '{{WRAPPER}} .'.$this->service_card_heading_class.':hover',
			]
		);

		anant_border_radius_control(
			$this,
			[
				'key'       => 'card_heading_title_border_radius_hover',
				'selectors' => [
					'{{WRAPPER}} .'.$this->service_card_heading_class.':hover' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					'{{WRAPPER}} .'.$this->service_card_heading_class.':hover' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'card_heading_title_padding_hover',
			[
				'label'     => esc_html__('Padding', 'anant-addons-for-elementor'),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .'.$this->service_card_heading_class.':hover' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					'{{WRAPPER}} .'.$this->service_card_heading_class.':hover' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'card_heading_title_margin_hover',
			[
				'label'     => esc_html__('Margin', 'anant-addons-for-elementor'),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .'.$this->service_card_heading_class.':hover' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					'{{WRAPPER}} .'.$this->service_card_heading_class.':hover' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		anant_text_shadow_control(
			$this,
			[
				'key'      => 'card_heading_title_text_shadow_hover',
				'selector' => '{{WRAPPER}}  .'.$this->service_card_heading_class.':hover',
			]
		);

		$this->end_controls_tab(); 
		$this->end_controls_tabs(); 
		$this->end_controls_section();

		// Service Description Settings
		$this->start_controls_section(
			'service_description',
			[
				'label' => esc_html__( 'Description Format', 'anant-addons-for-elementor' ),
				'tab'   => Controls_Manager::TAB_STYLE,
				'conditions' => [
					'relation' => 'and',
					'terms'    => [
						[
							'name'     => 'template_style',
							'operator' => '!==',
							'value'    => 'layout_2',
						]
					]
				]
			]
		);

		$this->add_responsive_control(
			'card_heading_description_alignment',
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
				'toggle'    => true,
				'selectors' => [
					'{{WRAPPER}} .'.$this->service_card_description_class => 'text-align: {{VALUE}};',
				],
			]
		);

		$this->start_controls_tabs( 'card_heading_description_tabs' );

		$this->start_controls_tab(
			'card_heading_description_normal_style',
			[
				'label' => esc_html__( 'Normal', 'anant-addons-for-elementor' ),
			]
		);
		
		$this->add_control(
			'card_heading_description_color',
			[
				'label'     => esc_html__( 'Description Color', 'anant-addons-for-elementor' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}}  .'.$this->service_card_description_class => 'color: {{VALUE}}',
				],
				'conditions' => [
					'relation' => 'and',
					'terms'    => [
						[
							'name'     => 'template_style',
							'operator' => '!==',
							'value'    => 'layout_2',
						],
					],
				],
			]
		);

		anant_typography_control(
			$this,
			[
				'name'     => 'card_heading_description_typography',
				'selector' => '{{WRAPPER}}  .'.$this->service_card_description_class,
			]
		);

		anant_border_control(
			$this,
			[
				'name'     => 'card_heading_description_border_type',
				'selector' => '{{WRAPPER}} .'.$this->service_card_description_class,
			]
		);

		anant_border_radius_control(
			$this,
			[
				'key'       => 'card_heading_description_border_radius',
				'selectors' => [
					'{{WRAPPER}} .'.$this->service_card_description_class => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					'{{WRAPPER}} .'.$this->service_card_description_class => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'card_heading_description_padding',
			[
				'label'     => esc_html__('Padding', 'anant-addons-for-elementor'),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .'.$this->service_card_description_class => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					'{{WRAPPER}} .'.$this->service_card_description_class => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'card_heading_description_margin',
			[
				'label'     => esc_html__('Margin', 'anant-addons-for-elementor'),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .'.$this->service_card_description_class => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					'{{WRAPPER}} .'.$this->service_card_description_class => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		anant_text_shadow_control(
			$this,
			[
				'key'      => 'card_heading_description_text_shadow',
				'selector' => '{{WRAPPER}}  .'.$this->service_card_description_class,
			]
		);


		$this->end_controls_tab();

		$this->start_controls_tab(
			'card_heading_description_style_hover',
			[
				'label' => esc_html__( 'Hover', 'anant-addons-for-elementor' ),

			]
		);

		$this->add_control(
			'card_heading_description_color_hover',
			[
				'label'     => esc_html__( 'Description Color', 'anant-addons-for-elementor' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}}  .'.$this->service_card_class.':hover .'.$this->service_card_description_class.'.text' => 'color: {{VALUE}}',
				],
				'conditions' => [
					'relation' => 'and',
					'terms'    => [
						[
							'name'     => 'template_style',
							'operator' => '!==',
							'value'    => 'layout_2',
						],
					],
				],
			]
		);

		anant_typography_control(
			$this,
			[
				'name'     => 'card_heading_description_typography_hover',
				'selector' => '{{WRAPPER}}  .'.$this->service_card_description_class.':hover',
			]
		);

		anant_border_control(
			$this,
			[
				'name'     => 'card_heading_description_border_type_hover',
				'selector' => '{{WRAPPER}} .'.$this->service_card_description_class.':hover',
			]
		);

		anant_border_radius_control(
			$this,
			[
				'key'       => 'card_heading_description_border_radius_hover',
				'selectors' => [
					'{{WRAPPER}} .'.$this->service_card_description_class.':hover' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					'{{WRAPPER}} .'.$this->service_card_description_class.':hover' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		anant_text_shadow_control(
			$this,
			[
				'key'      => 'card_heading_description_text_shadow_hover',
				'selector' => '{{WRAPPER}}  .'.$this->service_card_description_class.':hover',
			]
		);

		$this->end_controls_tab(); 
		$this->end_controls_tabs(); 
		$this->end_controls_section();

		// Service Button Settings
		$this->start_controls_section(
			'service_button_settings',
			[
				'label' => esc_html__( 'Button Settings', 'anant-addons-for-elementor' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_responsive_control(
			'card_heading_read_more_alignment',
			[
				'label'     => esc_html__( 'Alignment', 'anant-addons-for-elementor' ),
				'type'      => Controls_Manager::CHOOSE,
				'options'   => [
					'start' => [
						'title' => esc_html__( 'Left', 'anant-addons-for-elementor' ),
						'icon'  => 'eicon-text-align-left',
					],
					'center' => [
						'title' => esc_html__( 'Center', 'anant-addons-for-elementor' ),
						'icon'  => 'eicon-text-align-center',
					],
					'end' => [
						'title' => esc_html__( 'Right', 'anant-addons-for-elementor' ),
						'icon'  => 'eicon-text-align-right',
					],
				],
				'toggle'    => true,
				'selectors' => [
					'{{WRAPPER}} .'.$this->service_card_read_more_class => 'text-align: {{VALUE}};',
				],
			]
		); 
		$this->start_controls_tabs( 'card_heading_read_more_tabs' );

		$this->start_controls_tab(
			'card_heading_read_more_normal_style',
			[
				'label' => esc_html__( 'Normal', 'anant-addons-for-elementor' ),
			]
		); 
		$this->add_control(
			'card_heading_read_more_color',
			[
				'label'     => esc_html__( 'Color', 'anant-addons-for-elementor' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}}  .'.$this->service_card_read_more_class.' .more' => 'color: {{VALUE}}',
					'{{WRAPPER}}  .'.$this->service_card_read_more_class.' .more i' => 'color: {{VALUE}}',
				],
			]
		);

		$this->add_control(
			'card_heading_read_more_bg_color',
			[
				'label'     => esc_html__( 'Background Color', 'anant-addons-for-elementor' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}}  .'.$this->service_card_read_more_class.' .more' => 'background-color: {{VALUE}}', 
					'{{WRAPPER}}  .'.$this->service_card_class.':after' => 'background-color: {{VALUE}}', 
				],
			]
		);


		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name'     => 'card_heading_read_more_typography',
				'selector' => '{{WRAPPER}}  .'.$this->service_card_read_more_class.' .more',
			]
		);

		anant_border_control(
			$this,
			[
				'name'     => 'card_heading_read_more_border_type',
				'selector' => '{{WRAPPER}} .'.$this->service_card_read_more_class.' .more',
			]
		);

		anant_border_radius_control(
			$this,
			[
				'key'       => 'card_heading_read_more_border_radius',
				'selectors' => [
					'{{WRAPPER}} .'.$this->service_card_read_more_class.' .more' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					'{{WRAPPER}} .'.$this->service_card_read_more_class.' .more' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'card_heading_read_more_padding',
			[
				'label'     => esc_html__('Padding', 'anant-addons-for-elementor'),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .'.$this->service_card_read_more_class.' .more' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					'{{WRAPPER}} .'.$this->service_card_read_more_class.' .more' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'card_heading_read_more_margin',
			[
				'label'     => esc_html__('Margin', 'anant-addons-for-elementor'),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .'.$this->service_card_read_more_class.' .more' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					'{{WRAPPER}} .'.$this->service_card_read_more_class.' .more' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		
		anant_box_shadow_control(
			$this,
			[
				'key'      => 'card_heading_read_more_box_shadow',
				'selector' => '{{WRAPPER}}  .'.$this->service_card_read_more_class.' .more',
			]
		);


		$this->end_controls_tab();

		$this->start_controls_tab(
			'card_heading_read_more_style_hover',
			[
				'label' => esc_html__( 'Hover', 'anant-addons-for-elementor' ),

			]
		);

		$this->add_control(
			'card_heading_read_more_color_hover',
			[
				'label'     => esc_html__( 'Color', 'anant-addons-for-elementor' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}}  .'.$this->service_card_class.':hover .more' => 'color: {{VALUE}}',
					'{{WRAPPER}}  .'.$this->service_card_class.':hover .more i' => 'color: {{VALUE}}',
				],
			]
		);

		$this->add_control(
			'card_heading_read_more_bg_color_hover',
			[
				'label'     => esc_html__( 'Background Color', 'anant-addons-for-elementor' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .'.$this->service_card_class.':hover .more' => 'background-color: {{VALUE}}', 
				],
			]
		); 

		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name'     => 'card_heading_read_more_hover_typography',
				'selector' => '{{WRAPPER}}  .'.$this->service_card_read_more_class.' .more:hover',
			]
		);
		$this->add_responsive_control(
			'btn_icon_size_hover',
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
					'{{WRAPPER}} .'.$this->service_card_class.' .more:hover i' => 'font-size: {{SIZE}}{{UNIT}};',
				],
			
			]
		);
		anant_border_control(
			$this,
			[
				'name'     => 'card_heading_read_more_border_type_hover',
				'selector' => '{{WRAPPER}} .'.$this->service_card_read_more_class.' .more:hover',
			]
		);

		anant_border_radius_control(
			$this,
			[
				'key'       => 'card_heading_read_more_border_radius_hover',
				'selectors' => [
					'{{WRAPPER}} .'.$this->service_card_read_more_class.' .more'.':hover' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					'{{WRAPPER}} .'.$this->service_card_read_more_class.' .more'.':hover' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'card_heading_read_more_padding_hover',
			[
				'label'     => esc_html__('Padding', 'anant-addons-for-elementor'),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .'.$this->service_card_read_more_class.' .more'.':hover' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					'{{WRAPPER}} .'.$this->service_card_read_more_class.' .more'.':hover' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'card_heading_read_more_margin_hover',
			[
				'label'     => esc_html__('Margin', 'anant-addons-for-elementor'),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .'.$this->service_card_read_more_class.' .more'.':hover' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					'{{WRAPPER}} .'.$this->service_card_read_more_class.' .more'.':hover' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		anant_box_shadow_control(
			$this,
			[
				'key'      => 'card_heading_read_more_box_shadow_hover',
				'selector' => '{{WRAPPER}}  .'.$this->service_card_read_more_class.' .more'.':hover',
			]
		);

		$this->end_controls_tab(); 
		$this->end_controls_tabs();  
		$this->end_controls_section();
	}

	protected function render() {
		$settings = $this->get_settings_for_display();

		$show_image = $settings['show_image'];
		$show_icon = $settings['show_icon'];
		$show_title = $settings['show_title'];
		$show_description = $settings['show_description'];
		$show_link = $settings['show_link'];

		$title = $settings['card_title'];
		$description = $settings['card_description'];
		$link_text = $settings['card_link_text'];
		$card_icon = $settings['card_icon'];
		$link_button_icon = $settings['link_button_icon'];
		$link_button_position = $settings['link_button_position'];
		$link = $settings['card_link']['url'];
		$target = $settings['card_link']['is_external'] ? ' target="_blank"' : '';
		$nofollow = $settings['card_link']['nofollow'] ? ' rel="nofollow"' : '';

		$template_style = $settings['template_style'];

		if ( ($template_style == 'layout_2') ) {
			$image_url = $settings['card_image']['url'];
		}

		$template_path = ANANT_PATH . 'inc/templates/service/';

		switch ($template_style) {
			case 'layout_1':
				require $template_path. 'layout-1.php';
				break;
			case 'layout_2':
				require $template_path. 'layout-2.php';
				break;
			case 'layout_3':
				require $template_path. 'layout-3.php';
				break;
		}
	}
}