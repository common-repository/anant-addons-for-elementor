<?php namespace AnantAddons;

use Elementor\Controls_Manager;
use Elementor\Widget_Base;
use Elementor\Group_Control_Background;

class AnantCalltoaction extends \Elementor\Widget_Base {

	private $cta_card_class = 'anant-cta-card';
	private $cta_card_inner_class = 'anant-cta-inner-card';
	private $cta_card_content_class = 'anant-cta-content-card';
	private $cta_card_image_class = 'anant-cta-card-image';
	private $cta_card_heading_class = 'anant-cta-card-heading';
	private $cta_card_subtitle_class = 'anant-cta-card-subtitle';
	private $cta_card_description_class = 'anant-cta-card-description';
	private $cta_card_read_more_class = 'anant-cta-card-read-more';
	private $cta_card_read_more_two_class = 'anant-cta-card-read-two-more';
	
	public function get_name() {
		return 'anant-cta-list';
	}

	public function get_title() {
		return __( 'Call to Action', 'anant-addons-for-elementor' );
	}

	public function get_categories() {
		return [ 'anant-elements' ];
	}

	public function get_icon() {
		return 'ant-icon eicon-image-rollover';
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
		return ['cta',
				'call to action', 
				'get in touch',
				'',
				'anant addons',
		];
	}

	protected function register_controls() { 

		$this->start_controls_section(
			'content_section',
			[
				'label' => __( 'Content', 'anant-addons-for-elementor' ),
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
					'layout_3'      => esc_html__( 'Layout 3 (Pro)', 'anant-addons-for-elementor' ),
				],
			]
		);

		$this->add_control(
			'anant_call_to_action_pro_notice',
			[
				'raw' => 'Only Available in <a href="https://anantaddons.com/" target="_blank">Pro Version!</a>',
				'type' => \Elementor\Controls_Manager::RAW_HTML,
				'content_classes' => 'anant-pro-notice',
				'condition' => [
                    'template_style!' => ['layout_1', 'layout_2'],
                ],
			]
		);

		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name'      => 'cta_background',
				'types'     => [ 'classic' ],
				'fields_options' => [
					'background' => [
						'label'     => __( 'Background Image', 'anant-addons-for-elementor'),
						'default' => 'classic',
					],
				],
				'selector'  => '{{WRAPPER}} .'.$this->cta_card_inner_class,
			]
		);

		$this->add_control(
			'card_subtitle', [
				'label' => __( 'Sub Title', 'anant-addons-for-elementor'),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => __( 'Get In Touch' , 'anant-addons-for-elementor'),
				'label_block' => true,
			]
		);
		$this->add_control(
			'card_title', [
				'label' => __( 'Title', 'anant-addons-for-elementor'),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => __( 'Need Any Consultations Contact With Us' , 'anant-addons-for-elementor'),
				'label_block' => true,
			]
		);
	

		$description = 'Aenean ut turpis blandit eros convallis congue sit amet a libero';

		$this->add_control(
			'card_description',
			[
				'label' => __( 'Description', 'anant-addons-for-elementor'),
				'type' => \Elementor\Controls_Manager::TEXTAREA,
				'rows' => 10,
				'default' => __( $description, 'anant-addons-for-elementor'),
				'placeholder' => __( 'Type your description here', 'anant-addons-for-elementor'),
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'settings_section',
			[
				'label' => __( 'Settings', 'anant-addons-for-elementor'),
				'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);

		$this->add_control(
			'show_subtitle',
			[
				'label' => __( 'Show Subtitle', 'anant-addons-for-elementor'),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'label_on' => __( 'Show', 'anant-addons-for-elementor'),
				'label_off' => __( 'Hide', 'anant-addons-for-elementor'),
				'return_value' => 'yes',
				'default' => 'yes',
			]
		);

		$this->add_control(
			'show_title',
			[
				'label' => __( 'Show Title', 'anant-addons-for-elementor'),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'label_on' => __( 'Show', 'anant-addons-for-elementor'),
				'label_off' => __( 'Hide', 'anant-addons-for-elementor'),
				'return_value' => 'yes',
				'default' => 'yes',
			]
		);

		$this->add_control(
			'show_description',
			[
				'label' => __( 'Show Description', 'anant-addons-for-elementor'),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'label_on' => __( 'Show', 'anant-addons-for-elementor'),
				'label_off' => __( 'Hide', 'anant-addons-for-elementor'),
				'return_value' => 'yes',
				'default' => 'yes',
			]
		);

		$this->add_control(
			'show_link',
			[
				'label' => __( 'Show Button', 'anant-addons-for-elementor'),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'label_on' => __( 'Show', 'anant-addons-for-elementor'),
				'label_off' => __( 'Hide', 'anant-addons-for-elementor'),
				'return_value' => 'yes',
				'default' => 'yes',
			]
		);

		$this->add_control(
			'show_two_link',
			[
				'label' => __( 'Show Buttn Two', 'anant-addons-for-elementor'),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'label_on' => __( 'Show', 'anant-addons-for-elementor'),
				'label_off' => __( 'Hide', 'anant-addons-for-elementor'),
				'return_value' => 'yes',
				'default' => 'yes',
				'condition' => [ 
					'template_style!'=> 'layout_1',
				], 
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'button_section',
			[
				'label' => __( 'Button Settings', 'anant-addons-for-elementor'),
				'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);

		$this->add_control(
			'card_link_text', [
				'label' => __( 'Link Text', 'anant-addons-for-elementor'),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => __( 'Read More' , 'anant-addons-for-elementor'),
				'label_block' => true,
			]
		);

		$this->add_control(
			'card_link',
			[
				'label' => __( 'Link', 'anant-addons-for-elementor'),
				'type' => \Elementor\Controls_Manager::URL,
				'placeholder' => __( 'https://your-link.com', 'anant-addons-for-elementor'),
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
				'label' => __( 'Icon', 'anant-addons-for-elementor'),
				'type' => \Elementor\Controls_Manager::ICONS,
			]
		);

		$this->add_control(
			'link_button_position',
			[
				'label'       => esc_html__( 'Icon Position', 'anant-addons-for-elementor'),
				'type'        => \Elementor\Controls_Manager::SELECT,
				'default'     => 'after',
				'options'     => [
					'before'      => esc_html__( 'Before', 'anant-addons-for-elementor'),
					'after'      => esc_html__( 'After', 'anant-addons-for-elementor'),
				]
			]
		);

		$this->add_responsive_control(
			'link_button_space_before',
			[
				'label'           => __( 'Icon Spacing', 'anant-addons-for-elementor'),
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
					'{{WRAPPER}}  i' => 'margin-right: {{SIZE}}{{UNIT}};',
				],
				'conditions' => [
					'relation' => 'and',
					'terms'    => [
						[
							'name'     => 'link_button_position',
							'operator' => '===',
							'value'    => 'before',
						]
					],
				],
			]
		);

		$this->add_responsive_control(
			'link_button_space_after',
			[
				'label'           => __( 'Icon Spacing', 'anant-addons-for-elementor'),
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
					'{{WRAPPER}} i' => 'margin-left: {{SIZE}}{{UNIT}};',
				],
				'conditions' => [
					'relation' => 'and',
					'terms'    => [
						[
							'name'     => 'link_button_position',
							'operator' => '===',
							'value'    => 'after',
						]
					],
				],
			]
		);

		$this->end_controls_section();
		
		$this->start_controls_section(
			'button_two_section',
			[
				'label' => __( 'Button Two Settings', 'anant-addons-for-elementor'),
				'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
				'condition' => [ 
					'template_style!'=> 'layout_1',
				], 
			]
		);

		$this->add_control(
			'card_two_link_text', [
				'label' => __( 'Link Text', 'anant-addons-for-elementor'),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => __( 'Contact' , 'anant-addons-for-elementor'),
				'label_block' => true,
			]
		);

		$this->add_control(
			'card_two_link',
			[
				'label' => __( 'Link', 'anant-addons-for-elementor'),
				'type' => \Elementor\Controls_Manager::URL,
				'placeholder' => __( 'https://your-link.com', 'anant-addons-for-elementor'),
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
				'label' => __( 'Icon', 'anant-addons-for-elementor'),
				'type' => \Elementor\Controls_Manager::ICONS,
			]
		);

		$this->add_control(
			'link_two_button_position',
			[
				'label'       => esc_html__( 'Icon Position', 'anant-addons-for-elementor'),
				'type'        => \Elementor\Controls_Manager::SELECT,
				'default'     => 'after',
				'options'     => [
					'before'      => esc_html__( 'Before', 'anant-addons-for-elementor'),
					'after'      => esc_html__( 'After', 'anant-addons-for-elementor'),
				]
			]
		);

		$this->add_responsive_control(
			'link_two_button_space_before',
			[
				'label'           => __( 'Icon Spacing', 'anant-addons-for-elementor'),
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
					'{{WRAPPER}}  i' => 'margin-right: {{SIZE}}{{UNIT}};',
				],
				'conditions' => [
					'relation' => 'and',
					'terms'    => [
						[
							'name'     => 'link_two_button_position',
							'operator' => '===',
							'value'    => 'before',
						]
					],
				],
			]
		);

		$this->add_responsive_control(
			'link_two_button_space_after',
			[
				'label'           => __( 'Icon Spacing', 'anant-addons-for-elementor'),
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
					'{{WRAPPER}} i' => 'margin-left: {{SIZE}}{{UNIT}};',
				],
				'conditions' => [
					'relation' => 'and',
					'terms'    => [
						[
							'name'     => 'link_two_button_position',
							'operator' => '===',
							'value'    => 'after',
						]
					],
				],
			]
		);

		$this->end_controls_section();

		anant_pro_promotion_controls($this);

		// styles
		// Call to Action Settings
		$this->start_controls_section(
			'cta_box_settings',
			[
				'label' => __( 'Call to Action Settings ', 'anant-addons-for-elementor'),
				'tab'   => Controls_Manager::TAB_STYLE, 
			]
		);
		
		$slug = 'cta_box';

		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name'      => $slug.'_overlay_background',
				'label'     => __( 'Background Overlay', 'anant-addons-for-elementor'),
				'types'          => [ 'classic', 'gradient' ],
				'exclude'        => [ 'image' ],
				'fields_options' => [
					'background' => [
						'default' => 'gradient',
					],
					'color' => [
						'default' => '#040524d9',
					],
					'color_b' => [
						'default' => '#0036FF',
					],
				],
				'selector'  => '{{WRAPPER}} .'.$this->cta_card_inner_class.'::before',
			]
		);

		$this->add_responsive_control(
			$slug.'_overlay_opacity',
			[
				'label' => esc_html__( 'Opacity', 'anant-addons-for-elementor' ),
				'type' => Controls_Manager::SLIDER,
				'default' => [
					'size' => 1,
				],
				'range' => [
					'px' => [
						'max' => 1,
						'step' => 0.01,
					],
				],
				'selectors' => [
					'{{WRAPPER}}  .'.$this->cta_card_inner_class.'::before' => 'opacity: {{SIZE}};',
				]
			]
		);
		anant_border_control(
			$this,
			[
				'name'     => $slug.'_border_type',
				'label'    => 'Border Type',
				'selector' => '{{WRAPPER}} .'.$this->cta_card_inner_class,
			]
		);

		anant_border_radius_control(
			$this,
			[
				'key'       => $slug.'_border_radius',
				'label'     => 'Border Radius',
				'selectors' => [
					'{{WRAPPER}} .'.$this->cta_card_inner_class => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
					'{{WRAPPER}} .'.$this->cta_card_content_class => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
					'{{WRAPPER}} .'.$this->cta_card_class => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		anant_box_shadow_control(
			$this,
			[
				'key'      => $slug.'_box_shadow',
				'label'    => 'Box Shadow',
				'selector' => '{{WRAPPER}}  .'.$this->cta_card_inner_class,
			]
		);

		$this->end_controls_section();
		
		// Call to Action Subtitle
		$this->start_controls_section(
			'cta_subtitle_settings',
			[
				'label' => __( 'Subtitle ', 'anant-addons-for-elementor'),
				'tab'   => Controls_Manager::TAB_STYLE, 
			]
		);
		
		$slug = 'cta_subtitle';

		$this->add_responsive_control(
			$slug.'_alignment',
			[
				'label'     => __( 'Alignment', 'anant-addons-for-elementor'),
				'type'      => Controls_Manager::CHOOSE,
				'options'   => [
					'left' => [
						'title' => __( 'Left', 'anant-addons-for-elementor'),
						'icon'  => 'eicon-text-align-left',
					],
					'center' => [
						'title' => __( 'Center', 'anant-addons-for-elementor'),
						'icon'  => 'eicon-text-align-center',
					],
					'right' => [
						'title' => __( 'Right', 'anant-addons-for-elementor'),
						'icon'  => 'eicon-text-align-right',
					],
				],
				'toggle'    => true,
				'selectors' => [
					'{{WRAPPER}} .'.$this->cta_card_subtitle_class => 'text-align: {{VALUE}};',
				],
			]
		);
		
		$this->add_control(
			$slug.'_color',
			[
				'label'     => __( 'Color', 'anant-addons-for-elementor'),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}}  .'.$this->cta_card_subtitle_class => 'color: {{VALUE}}',
				],
			]
		);

		anant_typography_control(
			$this,
			[
				'name'     => $slug.'_typography',
				'label'    => 'Typography',
				'selector' => '{{WRAPPER}}  .'.$this->cta_card_subtitle_class,
			]
		);

		$this->add_responsive_control(
			$slug.'_margin',
			[
				'label'     => esc_html__('Margin', 'anant-addons-for-elementor'),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .'.$this->cta_card_subtitle_class => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->end_controls_section();
		
		// Call to Action Title
		$this->start_controls_section(
			'cta_title_settings',
			[
				'label' => __( 'Title ', 'anant-addons-for-elementor'),
				'tab'   => Controls_Manager::TAB_STYLE, 
			]
		);
		
		$slug = 'cta_title';
		$this->add_responsive_control(
			$slug.'_alignment',
			[
				'label'     => __( 'Alignment', 'anant-addons-for-elementor'),
				'type'      => Controls_Manager::CHOOSE,
				'options'   => [
					'left' => [
						'title' => __( 'Left', 'anant-addons-for-elementor'),
						'icon'  => 'eicon-text-align-left',
					],
					'center' => [
						'title' => __( 'Center', 'anant-addons-for-elementor'),
						'icon'  => 'eicon-text-align-center',
					],
					'right' => [
						'title' => __( 'Right', 'anant-addons-for-elementor'),
						'icon'  => 'eicon-text-align-right',
					],
				],
				'toggle'    => true,
				'selectors' => [
					'{{WRAPPER}} .'.$this->cta_card_heading_class => 'text-align: {{VALUE}};',
				],
			]
		);
		
		$this->add_control(
			$slug.'_color',
			[
				'label'     => __( 'Color', 'anant-addons-for-elementor'),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}}  .'.$this->cta_card_heading_class => 'color: {{VALUE}}',
				],
			]
		);

		anant_typography_control(
			$this,
			[
				'name'     => $slug.'_typography',
				'label'    => 'Typography',
				'selector' => '{{WRAPPER}}  .'.$this->cta_card_heading_class,
			]
		);

		$this->add_responsive_control(
			$slug.'_margin',
			[
				'label'     => esc_html__('Margin', 'anant-addons-for-elementor'),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .'.$this->cta_card_heading_class => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->end_controls_section();
		
		// Call to Action desc
		$this->start_controls_section(
			'cta_desc_settings',
			[
				'label' => __( 'Description ', 'anant-addons-for-elementor'),
				'tab'   => Controls_Manager::TAB_STYLE, 
			]
		);
		
		$slug = 'cta_desc';
		$this->add_responsive_control(
			$slug.'_alignment',
			[
				'label'     => __( 'Alignment', 'anant-addons-for-elementor'),
				'type'      => Controls_Manager::CHOOSE,
				'options'   => [
					'left' => [
						'title' => __( 'Left', 'anant-addons-for-elementor'),
						'icon'  => 'eicon-text-align-left',
					],
					'center' => [
						'title' => __( 'Center', 'anant-addons-for-elementor'),
						'icon'  => 'eicon-text-align-center',
					],
					'right' => [
						'title' => __( 'Right', 'anant-addons-for-elementor'),
						'icon'  => 'eicon-text-align-right',
					],
				],
				'toggle'    => true,
				'selectors' => [
					'{{WRAPPER}} .'.$this->cta_card_description_class => 'text-align: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			$slug.'_color',
			[
				'label'     => __( 'Color', 'anant-addons-for-elementor'),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}}  .'.$this->cta_card_description_class => 'color: {{VALUE}}',
				],
			]
		);

		anant_typography_control(
			$this,
			[
				'name'     => $slug.'_typography',
				'label'    => 'Typography',
				'selector' => '{{WRAPPER}}  .'.$this->cta_card_description_class,
			]
		);

		$this->add_responsive_control(
			$slug.'_margin',
			[
				'label'     => esc_html__('Margin', 'anant-addons-for-elementor'),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .'.$this->cta_card_description_class => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->end_controls_section();
		
		// Call to Action One Button
		$this->start_controls_section(
			'cta_one_btn_settings',
			[
				'label' => __('Button', 'anant-addons-for-elementor'),
				'tab'   => Controls_Manager::TAB_STYLE, 
			]
		);
		
		$slug = 'cta_one_btn';
		$this->add_responsive_control(
			$slug.'_alignment',
			[
				'label'     => __( 'Alignment', 'anant-addons-for-elementor'),
				'type'      => Controls_Manager::CHOOSE,
				'options'   => [
					'flex-start' => [
						'title' => __( 'Left', 'anant-addons-for-elementor'),
						'icon'  => 'eicon-text-align-left',
					],
					'center' => [
						'title' => __( 'Center', 'anant-addons-for-elementor'),
						'icon'  => 'eicon-text-align-center',
					],
					'flex-end' => [
						'title' => __( 'Right', 'anant-addons-for-elementor'),
						'icon'  => 'eicon-text-align-right',
					],
				],
				'toggle'    => true,
				'selectors' => [
					'{{WRAPPER}} .ant-call-button' => 'justify-content: {{VALUE}};',
					
				]
			],
		);

		anant_typography_control(
			$this,
			[
				'name'     => $slug.'_typography',
				'label'    => 'Typography',
				'selector' => '{{WRAPPER}}  .'.$this->cta_card_read_more_class.' a',
			]
		);

		$this->add_responsive_control(
			$slug.'_icon_size',
			[
				'label'           => __( 'Icon Size', 'anant-addons-for-elementor' ),
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
					'{{WRAPPER}} .'.$this->cta_card_read_more_class.' i' => 'font-size: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .'.$this->cta_card_read_more_class.' svg' => 'width: {{SIZE}}{{UNIT}}; height: {{SIZE}}{{UNIT}};'
				],
			]
		);

		anant_border_radius_control(
			$this,
			[
				'key'       => $slug.'_border_radius',
				'label'     => 'Border Radius',
				'selectors' => [
					'{{WRAPPER}} .'.$this->cta_card_read_more_class.' a' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					'{{WRAPPER}} .'.$this->cta_card_read_more_class.' a' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
					'{{WRAPPER}} .'.$this->cta_card_read_more_class.' a' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					//'{{WRAPPER}} .'.$this->cta_card_read_more_class.' a' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
					'{{WRAPPER}} .'.$this->cta_card_read_more_class.' a' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					'{{WRAPPER}} .'.$this->cta_card_read_more_class.' a' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		anant_box_shadow_control(
			$this,
			[
				'key'      => $slug.'_box_shadow',
				'label'    => 'Box Shadow',
				'selector' => '{{WRAPPER}}  .'.$this->cta_card_read_more_class.' a',
			]
		);

		$this->start_controls_tabs( $slug.'_tabs' );

		$this->start_controls_tab(
			$slug.'_normal_style',
			[
				'label' => __( 'Normal', 'anant-addons-for-elementor'),
			]
		);
		
		$this->add_control(
			$slug.'_color',
			[
				'label'     => __( 'Color', 'anant-addons-for-elementor'),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}}  .'.$this->cta_card_read_more_class.' a' => 'color: {{VALUE}}; fill: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			$slug.'_bg_color',
			[
				'label'     => __( 'Background Color', 'anant-addons-for-elementor'),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}}  .'.$this->cta_card_read_more_class.' a' => 'background-color: {{VALUE}}',
				],
			]
		);

		anant_border_control(
			$this,
			[
				'name'     => $slug.'_border_type',
				'label'    => 'Border Type',
				'selector' => '{{WRAPPER}} .'.$this->cta_card_read_more_class.' a',
			]
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
			$slug.'_style_hover',
			[
				'label' => __( 'Hover', 'anant-addons-for-elementor'),

			]
		);

		$this->add_control(
			$slug.'_color_hover',
			[
				'label'     => __( 'Color', 'anant-addons-for-elementor'),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .'.$this->cta_card_class.':hover .'.$this->cta_card_read_more_class.' a:hover' => 'color: {{VALUE}}; fill: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			$slug.'_bg_color_hover',
			[
				'label'     => __( 'Background Color', 'anant-addons-for-elementor'),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .'.$this->cta_card_class.':hover .'.$this->cta_card_read_more_class.' a:hover' => 'background-color: {{VALUE}}',
				],
			]
		);

		anant_border_control(
			$this,
			[
				'name'     => $slug.'_border_type_hover',
				'label'    => 'Border Type',
				'selector' => '{{WRAPPER}} .'.$this->cta_card_read_more_class.' a:hover',
			]
		);

		$this->end_controls_tab();
		$this->end_controls_tabs(); 
		$this->end_controls_section();
		
		// Call to Action two Button
		$this->start_controls_section(
			'cta_two_btn_settings',
			[
				'label' => __('Button Two', 'anant-addons-for-elementor'),
				'tab'   => Controls_Manager::TAB_STYLE, 
				'conditions' => [
					'relation' => 'and',
					'terms'    => [
						[
							'name'     => 'template_style',
							'operator' => '!==',
							'value'    => 'layout_1',
						],
					],
				],
			]
		);
		
		$slug = 'cta_two_btn';
		
		anant_typography_control(
			$this,
			[
				'name'     => $slug.'_typography',
				'label'    => 'Typography',
				'selector' => '{{WRAPPER}}  .'.$this->cta_card_read_more_two_class.' a',
			]
		);

		$this->add_responsive_control(
			$slug.'_icon_size',
			[
				'label'           => __( 'Icon Size', 'anant-addons-for-elementor' ),
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
					'{{WRAPPER}} .'.$this->cta_card_read_more_two_class.' i' => 'font-size: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .'.$this->cta_card_read_more_two_class.' svg' => 'width: {{SIZE}}{{UNIT}}; height: {{SIZE}}{{UNIT}};'
				],
			]
		);

		anant_border_radius_control(
			$this,
			[
				'key'       => $slug.'_border_radius',
				'label'     => 'Border Radius',
				'selectors' => [
					'{{WRAPPER}} .'.$this->cta_card_read_more_two_class.' a' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					'{{WRAPPER}} .'.$this->cta_card_read_more_two_class.' a' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
					'{{WRAPPER}} .'.$this->cta_card_read_more_two_class.' a' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					//'{{WRAPPER}} .'.$this->cta_card_read_more_two_class.' a' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
					'{{WRAPPER}} .'.$this->cta_card_read_more_two_class.' a' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					'{{WRAPPER}} .'.$this->cta_card_read_more_two_class.' a' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		anant_box_shadow_control(
			$this,
			[
				'key'      => $slug.'_box_shadow',
				'label'    => 'Box Shadow',
				'selector' => '{{WRAPPER}}  .'.$this->cta_card_read_more_two_class.' a',
			]
		);

		$this->start_controls_tabs( $slug.'_tabs' );

		$this->start_controls_tab(
			$slug.'_normal_style',
			[
				'label' => __( 'Normal', 'anant-addons-for-elementor'),
			]
		);
		
		$this->add_control(
			$slug.'_color',
			[
				'label'     => __( 'Color', 'anant-addons-for-elementor'),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}}  .'.$this->cta_card_read_more_two_class.' a' => 'color: {{VALUE}}; fill: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			$slug.'_bg_color',
			[
				'label'     => __( 'Background Color', 'anant-addons-for-elementor'),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}}  .'.$this->cta_card_read_more_two_class.' a' => 'background-color: {{VALUE}}',
				],
			]
		);

		anant_border_control(
			$this,
			[
				'name'     => $slug.'_border_type',
				'label'    => 'Border Type',
				'selector' => '{{WRAPPER}} .'.$this->cta_card_read_more_two_class.' a',
			]
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
			$slug.'_style_hover',
			[
				'label' => __( 'Hover', 'anant-addons-for-elementor'),

			]
		);

		$this->add_control(
			$slug.'_color_hover',
			[
				'label'     => __( 'Color', 'anant-addons-for-elementor'),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .'.$this->cta_card_class.':hover .'.$this->cta_card_read_more_two_class.' a:hover' => 'color: {{VALUE}}; fill: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			$slug.'_bg_color_hover',
			[
				'label'     => __( 'Background Color', 'anant-addons-for-elementor'),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .'.$this->cta_card_class.':hover .'.$this->cta_card_read_more_two_class.' a:hover' => 'background-color: {{VALUE}}',
				],
			]
		);

		anant_border_control(
			$this,
			[
				'name'     => $slug.'_border_type_hover',
				'label'    => 'Border Type',
				'selector' => '{{WRAPPER}} .'.$this->cta_card_read_more_two_class.' a:hover',
			]
		);

		$this->end_controls_tab();
		$this->end_controls_tabs(); 
		$this->end_controls_section();
	}

	protected function render() {
		$settings = $this->get_settings_for_display();
		$show_subtitle = $settings['show_subtitle'];
		$show_title = $settings['show_title'];
		$show_description = $settings['show_description'];
		$show_link = $settings['show_link'];
		$show_two_link = $settings['show_two_link'];

		$title = $settings['card_title'];
		$subtitle = $settings['card_subtitle'];
		$description = $settings['card_description'];

		$link_text = $settings['card_link_text']; 
		$link_button_icon = $settings['link_button_icon'];
		$link_button_position = $settings['link_button_position'];
		$link = $settings['card_link']['url'];
		$target = $settings['card_link']['is_external'] ? ' target="_blank"' : '';
		$nofollow = $settings['card_link']['nofollow'] ? ' rel="nofollow"' : '';

		$template_style = $settings['template_style'];

		if ($template_style !== 'layout_1') {
			$link_two_text = $settings['card_two_link_text']; 
			$link_two_button_icon = $settings['link_two_button_icon'];
			$link_two_button_position = $settings['link_two_button_position'];
			$link_two = $settings['card_two_link']['url'];
			$target_two = $settings['card_two_link']['is_external'] ? ' target="_blank"' : '';
			$nofollow_two = $settings['card_two_link']['nofollow'] ? ' rel="nofollow"' : '';
		}

		$template_path = ANANT_PATH . 'inc/templates/cta/';

		switch ($template_style) {
			case 'layout_1':
				require $template_path. 'layout-1.php';
				break;
			case 'layout_2':
				require $template_path. 'layout-2.php';
				break;
		}
	}
}