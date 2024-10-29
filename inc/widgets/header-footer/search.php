<?php namespace AnantAddons;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Background;
use Elementor\Core\Kits\Documents\Tabs\Global_Typography;
use Elementor\Group_Control_Text_Shadow;
use Elementor\Group_Control_Box_Shadow;
use Elementor\Core\Kits\Documents\Tabs\Global_Colors;
use Elementor\Group_Control_Border;

if ( ! defined( 'ABSPATH' ) ) { exit; } // Exit if accessed directly

class AnantSearch extends Widget_Base {

    public function __construct( $data = array(), $args = null ) {
        parent::__construct( $data, $args );
    }

    public function get_name() {
        return 'anant-search';
    }

    public function get_title() {
        return __( 'Search', 'anant-addons-for-elementor' );
    }

    public function get_icon() {
        return 'ant-icon eaicon eicon-site-search';
    }

    public function get_categories() {
        return array( 'anant-hf-elements' );
    }

    public function get_style_depends() {
        return [
            'jquery-auto-complete-css',
            'anant-styles-css',
        ];

    }

    public function get_script_depends() {
        return ['anant-search-js'];

    }

    public function get_keywords() {
        return [
            'search ',
            'anant addons',
            '',
            'find',
            'header footer',
        ];
    }

    protected function register_controls() {

        $this->start_controls_section(
            'section_general_fields',
            [
                'label' => __( 'Search Box', 'anant-addons-for-elementor' ),
            ]
        );

        $this->add_control(
            'layout',
            [
                'label'        => __( 'Layout', 'anant-addons-for-elementor' ),
                'type'         => Controls_Manager::SELECT,
                'default'      => 'icon_text',
                'options'      => [
                    'icon_text' => __( 'Input Box With Icon', 'anant-addons-for-elementor' ),
                    'icon'      => __( 'Icon (Pro)', 'anant-addons-for-elementor' ),
                    'text_title'      => __( 'Input Box With Text (Pro)', 'anant-addons-for-elementor' ),
                ],
                'prefix_class' => 'anant-search-layout-',
                'render_type'  => 'template',
            ]
        );

        $this->add_control(
            'anant_search_pro_notice',
            [
                'raw' => 'Only Available in <a href="https://anantaddons.com/" target="_blank">Pro Version!</a>',
                'type' => \Elementor\Controls_Manager::RAW_HTML,
                'content_classes' => 'anant-pro-notice',
                'condition' => [
                    'layout!' => ['icon_text'],
                ],
            ]
        );

        $this->add_control(
            'placeholder',
            [
                'label'     => __( 'Placeholder', 'anant-addons-for-elementor' ),
                'type'      => Controls_Manager::TEXT,
                'placeholder'   => __( 'Type Here & Search...', 'anant-addons-for-elementor' ),
            ]
        );

        $this->add_responsive_control(
            'search_width',
            [
                'label'           => __( 'Width', 'anant-addons-for-elementor' ),
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
                    '{{WRAPPER}} .anant_search_container' => 'width: {{SIZE}}{{UNIT}};',
                ],
            ],
        );

        $this->add_responsive_control(
            'search_height',
            [
                'label'           => __( 'Height', 'anant-addons-for-elementor' ),
                'type'            => Controls_Manager::SLIDER,
                'size_units'      => [ 'px', '%' ],
                'range'           => [
                    'px' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                    '%' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                ],
                'devices'         => [ 'desktop', 'tablet', 'mobile' ],
                'desktop_default' => [
                    'size' => '',
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
                    '{{WRAPPER}} .anant_search_container' => 'height: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->end_controls_section();

        anant_pro_promotion_controls($this);

        $this->start_controls_section(
            'section_input_style',
            [
                'label' => __( 'Input', 'anant-addons-for-elementor' ),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->start_controls_tabs( 'tabs_input_colors' );

        $this->start_controls_tab(
            'tab_input_normal',
            [
                'label'     => __( 'Normal', 'anant-addons-for-elementor' ),
            ]
        );

        $this->add_control(
            'input_text_color',
            [
                'label'     => __( 'Color', 'anant-addons-for-elementor' ),
                'type'      => Controls_Manager::COLOR,
                'global'    => [
                    'default' => Global_Colors::COLOR_TEXT,
                ],
                'selectors' => [
                    '{{WRAPPER}} .anant_search_input' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_control(
            'input_placeholder_color',
            [
                'label'     => __( 'Placeholder Color', 'anant-addons-for-elementor' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .anant_search_input::placeholder' => 'color: {{VALUE}}',
                ], 
            ]
        );

        $this->add_control(
            'input_background_color',
            [
                'label'     => __( 'Background Color', 'anant-addons-for-elementor' ),
                'type'      => Controls_Manager::COLOR,
                'default'   => '',
                'selectors' => [
                    '{{WRAPPER}} .anant_search_input, {{WRAPPER}} .anant-input-focus .anant-search-icon-toggle .anant_search_input' => 'background-color: {{VALUE}}',
                    '{{WRAPPER}} .anant-search-icon-toggle .anant_search_input' => 'background-color: transparent;',
                ],
            ]
        );

        $this->end_controls_tab();

        $this->start_controls_tab(
            'tab_input_focus',
            [
                'label'     => __( 'Focus', 'anant-addons-for-elementor' ),
            ]
        );

        $this->add_control(
            'input_text_color_focus',
            [
                'label'     => __( 'Color', 'anant-addons-for-elementor' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .anant-input-focus .anant_search_input:focus,
                    {{WRAPPER}} .anant-search-wrapper input[type=search]:focus' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_control(
            'input_placeholder_hover_color',
            [
                'label'     => __( 'Placeholder Color', 'anant-addons-for-elementor' ),
                'type'      => Controls_Manager::COLOR,
                'global'    => [
                    'default' => Global_Colors::COLOR_TEXT,
                ],
                'selectors' => [
                    '{{WRAPPER}} .anant_search_input:focus::placeholder' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_control(
            'input_background_color_focus',
            [
                'label'     => __( 'Background Color', 'anant-addons-for-elementor' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .anant-input-focus .anant_search_input:focus,
                    {{WRAPPER}}.anant-search-layout-icon .anant-search-icon-toggle .anant_search_input' => 'background-color: {{VALUE}}',
                ],
            ]
        );

        $this->add_control(
            'input_border_color_focus',
            [
                'label'     => __( 'Border Color', 'anant-addons-for-elementor' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .anant-input-focus .anant_search_container,
                     {{WRAPPER}} .anant-input-focus .anant-search-icon-toggle .anant_search_input' => 'border-color: {{VALUE}}',
                ],
            ]
        );

        $this->end_controls_tab();

        $this->end_controls_tabs();

        $this->add_control(
            'hr',
            [
                'type' => Controls_Manager::DIVIDER,
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'     => 'input_typography',
                'selector' => '{{WRAPPER}} input[type="search"].anant_search_input,{{WRAPPER}} .anant-search-icon-toggle',
                'global'   => [
                    'default' => Global_Typography::TYPOGRAPHY_PRIMARY,
                ],
            ]
        );

        $this->add_responsive_control(
            'border_style',
            [
                'label'       => __( 'Border Style', 'anant-addons-for-elementor' ),
                'type'        => Controls_Manager::SELECT,
                'default'     => 'none',
                'label_block' => false,
                'options'     => [
                    'none'   => __( 'None', 'anant-addons-for-elementor' ),
                    'solid'  => __( 'Solid', 'anant-addons-for-elementor' ),
                    'double' => __( 'Double', 'anant-addons-for-elementor' ),
                    'dotted' => __( 'Dotted', 'anant-addons-for-elementor' ),
                    'dashed' => __( 'Dashed', 'anant-addons-for-elementor' ),
                ],
                'selectors'   => [
                    '{{WRAPPER}} .anant_search_container ,{{WRAPPER}} .anant-search-icon-toggle .anant_search_input,{{WRAPPER}} .anant-input-focus .anant-search-icon-toggle .anant_search_input' => 'border-style: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'border_color',
            [
                'label'     => __( 'Border Color', 'anant-addons-for-elementor' ),
                'type'      => Controls_Manager::COLOR,
                'condition' => [
                    'border_style!' => 'none',
                ],
                'selectors' => [
                    '{{WRAPPER}} .anant_search_container, {{WRAPPER}} .anant-search-icon-toggle .anant_search_input,{{WRAPPER}} .anant-input-focus .anant-search-icon-toggle .anant_search_input' => 'border-color: {{VALUE}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'border_width',
            [
                'label'      => __( 'Border Width', 'anant-addons-for-elementor' ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px' ],
                'default'    => [
                    'top'    => '',
                    'bottom' => '',
                    'left'   => '',
                    'right'  => '',
                    'unit'   => 'px',
                ],
                'condition'  => [
                    'border_style!' => 'none',
                ],
                'selectors'  => [
                    '{{WRAPPER}} .anant_search_container, {{WRAPPER}} .anant-search-icon-toggle .anant_search_input,{{WRAPPER}} .anant-input-focus .anant-search-icon-toggle .anant_search_input' => 'border-width: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'border_radius',
            [
                'label'     => __( 'Border Radius', 'anant-addons-for-elementor' ),
                'type'      => Controls_Manager::SLIDER,
                'range'     => [
                    'px' => [
                        'min' => 0,
                        'max' => 200,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .anant_search_container, {{WRAPPER}} .anant-search-icon-toggle .anant_search_input,{{WRAPPER}} .anant-input-focus .anant-search-icon-toggle .anant_search_input' => 'border-radius: {{SIZE}}{{UNIT}}',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name'      => 'input_box_shadow',
                'selector'  => '{{WRAPPER}} .anant_search_container,{{WRAPPER}} input.anant_search_input',
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'section_button_style',
            [
                'label'     => __( 'Button', 'anant-addons-for-elementor' ),
                'tab'       => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->start_controls_tabs( 'tabs_button_colors' );

        $this->start_controls_tab(
            'tab_button_normal',
            [
                'label' => __( 'Normal', 'anant-addons-for-elementor' ),
            ]
        );

        $this->add_control(
            'button_icon_color',
            [
                'label'     => __( 'Color', 'anant-addons-for-elementor' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} button.anant-search-submit' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name'           => 'button_background',
                'label'          => __( 'Background', 'anant-addons-for-elementor' ),
                'types'          => [ 'classic'],
                'exclude'        => [ 'image' ],
                'selector'       => '{{WRAPPER}} .anant-search-submit',
                'fields_options' => [
                    'background' => [
                        'default' => 'classic',
                    ],
                ],
            ]
        );

        $this->end_controls_tab();

        $this->start_controls_tab(
            'tab_button_hover',
            [
                'label' => __( 'Hover', 'anant-addons-for-elementor' ),
            ]
        );

        $this->add_control(
            'button_text_color_hover',
            [
                'label'     => __( ' Color', 'anant-addons-for-elementor' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .anant-search-submit:hover' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_control(
            'button_background_color_hover',
            [
                'label'     => __( 'Background Color', 'anant-addons-for-elementor' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .anant-search-submit:hover' => 'background-color: {{VALUE}}',
                ],
                'condition' => [
                    'button_background_color_hover!' => '',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name'      => 'button_background_hover',
                'label'     => __( 'Background', 'anant-addons-for-elementor' ),
                'types'     => [ 'classic' ],
                'exclude'   => [ 'image' ],
                'selector'  => '{{WRAPPER}} .anant-search-submit:hover',
                'condition' => [
                    'button_background_color_hover' => '',
                ],
            ]
        );

        $this->end_controls_tab();

        $this->end_controls_tabs();

        $this->add_responsive_control(
            'icon_size',
            [
                'label'              => __( 'Icon Size', 'anant-addons-for-elementor' ),
                'type'               => Controls_Manager::SLIDER,
                'range'              => [
                    'px' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                ],
                'default'            => [
                    'size' => '16',
                    'unit' => 'px',
                ],
                'selectors'          => [
                    '{{WRAPPER}} .anant-search-submit' => 'font-size: {{SIZE}}{{UNIT}}',
                ],
                'separator'          => 'before',
                'render_type'        => 'template',
                'frontend_available' => true,
            ]
        );

        $this->add_responsive_control(
            'button_width',
            [
                'label'              => __( 'Width', 'anant-addons-for-elementor' ),
                'type'               => Controls_Manager::SLIDER,
                'range'              => [
                    'px' => [
                        'max'  => 500,
                        'step' => 5,
                    ],
                ],
                'selectors'          => [
                    '{{WRAPPER}} .anant_search_container .anant-search-submit' => 'width: {{SIZE}}{{UNIT}}',
                    '{{WRAPPER}} .anant-close-icon-yes button#clear_with_button' => 'right: {{SIZE}}{{UNIT}}',
                ],
                'render_type'        => 'template',
                'frontend_available' => true,
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'section_close_icon',
            [
                'label'     => __( 'Close Icon', 'anant-addons-for-elementor' ),
                'tab'       => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_responsive_control(
            'close_icon_size',
            [
                'label'              => __( 'Size', 'anant-addons-for-elementor' ),
                'type'               => Controls_Manager::SLIDER,
                'range'              => [
                    'px' => [
                        'min' => 0,
                        'max' => 50,
                    ],
                ],
                'default'            => [
                    'size' => '20',
                    'unit' => 'px',
                ],
                'selectors'          => [
                    '{{WRAPPER}} .anant_search_container button#clear i:before,
                    {{WRAPPER}} .anant-search-icon-toggle button#clear i:before,
                {{WRAPPER}} .anant_search_container button#clear-with-button i:before' => 'font-size: {{SIZE}}{{UNIT}};',
                ],
                'frontend_available' => true,

            ]
        );

        $this->add_control(
            'text_color',
            [
                'label'     => __( 'Color', 'anant-addons-for-elementor' ),
                'type'      => Controls_Manager::COLOR,
                'global'    => [
                    'default' => Global_Colors::COLOR_TEXT,
                ],
                'default'   => '#7a7a7a',
                'selectors' => [
                    '{{WRAPPER}} .anant_search_container button#clear-with-button,
                    {{WRAPPER}} .anant_search_container button#clear,
                    {{WRAPPER}} .anant-search-icon-toggle button#clear' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->end_controls_section();

		$this->start_controls_section(
			'suggestion_style_section',
			[
				'label' => esc_html__( 'Suggestions', 'anant-addons-for-elementor' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'suggestions_container_heading',
			[
				'type' => Controls_Manager::HEADING,
				'label' => esc_html__( 'Suggestions Container', 'anant-addons-for-elementor' ),
			]
        );

		$this->add_control(
			'suggestions_container_bg_color',
			[
				'label' => esc_html__( 'Background Color', 'anant-addons-for-elementor' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} #ant-suggestions-container' => 'background-color: {{VALUE}};',
				],
			]
		);

		$this->add_responsive_control(
			'suggestions_container_alignment',
			[
				'label'     => __( 'Alignment', 'anant-addons-for-elementor' ),
				'type'      => Controls_Manager::CHOOSE,
                'default'   => 'ant-center',
				'options'   => [
					'ant-start' => [
						'title' => __( 'Left', 'anant-addons-for-elementor' ),
						'icon'  => 'eicon-text-align-left',
					],
					'ant-center' => [
						'title' => __( 'Center', 'anant-addons-for-elementor' ),
						'icon'  => 'eicon-text-align-center',
					],
					'ant-right' => [
						'title' => __( 'Right', 'anant-addons-for-elementor' ),
						'icon'  => 'eicon-text-align-right',
					],
				],
				'toggle'    => true,
			]
		);

		$this->add_responsive_control(
			'suggestions_container_height',
			[
				'label' => esc_html__( 'Height', 'anant-addons-for-elementor' ),
				'type' => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 500,
						'step' => 1,
					],
					'vh' => [
						'min' => 0,
						'max' => 300,
						'step' => 1,
					],
				],
				'size_units' => [ '%', 'px', 'vh' ],
				'selectors' => [
					'{{WRAPPER}} #ant-suggestions-container' => 'max-height: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'suggestions_container_width',
			[
				'label' => esc_html__( 'Width', 'anant-addons-for-elementor' ),
				'type' => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 1200,
						'step' => 1,
					],
					'%' => [
						'min' => 0,
						'max' => 100,
						'step' => 0.5,
					],
					'vh' => [
						'min' => 0,
						'max' => 500,
						'step' => 1,
					],
				],
				'size_units' => [ '%', 'px', 'vh' ],
				'selectors' => [
					'{{WRAPPER}} #ant-suggestions-container' => 'width: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'suggestions_container_top_spacing',
			[
				'label' => esc_html__( 'Top Spacing', 'anant-addons-for-elementor' ),
				'type' => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 1200,
						'step' => 1,
					],
					'%' => [
						'min' => 0,
						'max' => 100,
						'step' => 0.5,
					],
					'vh' => [
						'min' => 0,
						'max' => 500,
						'step' => 1,
					],
				],
				'size_units' => [ '%', 'px', 'vh' ],
				'selectors' => [
					'{{WRAPPER}} #ant-suggestions-container' => 'margin-top: {{SIZE}}{{UNIT}};',
				],
			]
		);

		anant_border_control(
			$this,
			[
				'name'     => 'suggestions_container_border_type',
				'label'    => 'Border Type',
				'selector' => '{{WRAPPER}} #ant-suggestions-container',
			]
		);

		anant_border_radius_control(
			$this,
			[
				'key'       => 'suggestions_container_border_radius',
				'label'     => 'Border Radius',
				'selectors' => [
					'{{WRAPPER}} #ant-suggestions-container' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'suggestions_container_padding',
			[
				'label'     => esc_html__('Padding', 'anant-addons-for-elementor'),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} #ant-suggestions-container' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		anant_box_shadow_control(
			$this,
			[
				'key'      => 'suggestions_container_shadow',
				'label'    => 'Box Shadow',
				'selector' => '{{WRAPPER}} #ant-suggestions-container',
			]
		); 

		$this->add_control(
			'suggestions_container_hr',
			[
				'type' => \Elementor\Controls_Manager::DIVIDER,
				'style' => 'thick',
			]
		);

		$this->add_control(
			'suggestions_container_scroll_bar',
			[
				'type' => Controls_Manager::HEADING,
				'label' => esc_html__( 'Product Container Scrollbar', 'anant-addons-for-elementor' ),
			]
        );

		$slug = 'suggestions_container_scrollbar';
	
		$this->add_control(
			$slug.'_bg_color',
			[
				'label'     => __( 'Background Color', 'anant-addons-for-elementor' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} #ant-suggestions-container::-webkit-scrollbar-track' => 'background-color: {{VALUE}}',
					'{{WRAPPER}} #ant-suggestions-container::-webkit-scrollbar-track-piece' => 'background-color: {{VALUE}}',
				],
			]
		);
	
		$this->add_control(
			$slug.'_bg_hover_color',
			[
				'label'     => __( 'Background Color Hover', 'anant-addons-for-elementor' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} #ant-suggestions-container::-webkit-scrollbar-track:hover' => 'background-color: {{VALUE}}',
					'{{WRAPPER}} #ant-suggestions-container::-webkit-scrollbar-track-piece:hover' => 'background-color: {{VALUE}}',
				],
			]
		);
	
		anant_border_radius_control(
			$this,
			[
				'key'       => $slug.'_border_radiur',
				'label'     => 'Border Radius',
				'selectors' => [
					'{{WRAPPER}} #ant-suggestions-container::-webkit-scrollbar-track' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};', 
					'{{WRAPPER}} #ant-suggestions-container::-webkit-scrollbar-track-piece' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};', 
				],
			]
		);
	
		$this->add_responsive_control(
			$slug.'_width',
			[
				'label'           => __( 'Size', 'anant-addons-for-elementor' ),
				'type'            => Controls_Manager::SLIDER,
				'size_units'      => [ 'px', '%' ],
				'range'           => [
					'px' => [
						'min' => 0,
						'max' => 30,
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
					'{{WRAPPER}} #ant-suggestions-container::-webkit-scrollbar' => 'width: {{SIZE}}{{UNIT}};height: {{SIZE}}{{UNIT}};', 
				],
			],
		);

		$this->add_control(
			$slug.'_active_color_',
			[
				'label'     => __( 'Scroll Bar Color', 'anant-addons-for-elementor' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} #ant-suggestions-container::-webkit-scrollbar-thumb' => 'background-color: {{VALUE}}',
				],
			]
		);

		$this->add_control(
			$slug.'_active_hover_color_',
			[
				'label'     => __( 'Scroll Bar Hover Color', 'anant-addons-for-elementor' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} #ant-suggestions-container::-webkit-scrollbar-thumb:hover' => 'background-color: {{VALUE}}',
				],
			]
		);

		anant_border_radius_control(
			$this,
			[
				'key'       => $slug.'_hover_border_radiur',
				'label'     => 'Active Border Radius',
				'selectors' => [
					'{{WRAPPER}} #ant-suggestions-container::-webkit-scrollbar-thumb' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};', 
				],
			]
		);

		$this->add_control(
			'suggestions_container_scroll_bar_hr',
			[
				'type' => \Elementor\Controls_Manager::DIVIDER,
				'style' => 'thick',
			]
		);

		$this->add_control(
			'suggestion_title',
			[
				'type' => Controls_Manager::HEADING,
				'label' => esc_html__( 'Title', 'anant-addons-for-elementor' ),
			]
		);

		$this->add_responsive_control(
			'suggestion_title_align',
			[
				'label'              => __( 'Alignment', 'anant-addons-for-elementor' ),
				'type'               => Controls_Manager::CHOOSE,
				'options'            => [
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
				'default'            => '',

                'selectors' =>[
                    '{{WRAPPER}} .search-suggestion' => 'justify-content: {{VALUE}}',
                ]
			]
		);

		anant_typography_control(
			$this,
			[
				'name' => 'suggestion_title_typography',
				'label'    => 'Title Typography',
				'selector' => '{{WRAPPER}} .search-suggestion p',
			]
		);

		$this->add_control(
			'suggestion_title_color',
			[
				'label' => esc_html__( 'Title Color', 'anant-addons-for-elementor' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .search-suggestion p a' => 'color: {{VALUE}};',

				],
			]
		);

		$this->add_control(
			'suggestion_title_hover_color',
			[
				'label' => esc_html__( 'Title Hover Color', 'anant-addons-for-elementor' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .search-suggestion p a:hover' => 'color: {{VALUE}};',

				],
			]
		);

		anant_color_control(
			$this,
			[
				'key'       => 'suggestion_title_bg_color',
				'label'     => 'Background Color',
				'selectors' => [
					'{{WRAPPER}} .search-suggestion' => 'background-color: {{VALUE}};',
				],
			]
		);

		anant_border_control(
			$this,
			[
				'name'     => 'suggestion_title_border_type',
				'label'    => 'Border Type',
				'selector' => '{{WRAPPER}} .search-suggestion',
			]
		);

		anant_border_radius_control(
			$this,
			[
				'key'       => 'suggestion_title_border_radius',
				'label'     => 'Border Radius',
				'selectors' => [
					'{{WRAPPER}} .search-suggestion' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'suggestion_title_padding',
			[
				'label'     => esc_html__('Padding', 'anant-addons-for-elementor'),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .search-suggestion' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'suggestion_title_margin',
			[
				'label'     => esc_html__('Margin', 'anant-addons-for-elementor'),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .search-suggestion' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		anant_box_shadow_control(
			$this,
			[
				'key'      => 'suggestion_title_shadow',
				'label'    => 'Box Shadow',
				'selector' => '{{WRAPPER}} .search-suggestion',
			]
		);
        
        $this->end_controls_section();
        
    }

    protected function render() {

        $settings = $this->get_settings_for_display();

        $this->add_render_attribute(
            'input',
            [
                'placeholder' => $settings['placeholder'],
                'class'       => 'anant_search_input',
                'id'          => 'ant-search-input',
                'type'        => 'search',
                'name'        => 's',
                'title'       => __( 'Search', 'anant-addons-for-elementor' ),
                'value'       => get_search_query(),

            ]
        );

        $this->add_render_attribute(
            'container',
            [
                'class' => [ 'anant_search_container' ],
                'role'  => 'tablist',
            ]
        ); ?>
        <form class="anant-search-wrapper" role="search" action="<?php echo home_url(); ?>" method="get">
            <div <?php echo wp_kses_post( $this->get_render_attribute_string( 'container' ) ); ?>>
                <?php if ( 'icon_text' === $settings['layout'] ) { ?>
                    <input <?php echo $this->get_render_attribute_string( 'input' ); ?>>
                    <button id="clear-with-button" type="reset">
                        <i class="fas fa-times" aria-hidden="true"></i>
                    </button>
                    <button class="anant-search-submit" type="submit">
                        <i class="fas fa-search" aria-hidden="true"></i>
                    </button>
                <?php } ?>
            </div>
            <div id="ant-suggestions-container" class="ant-search-icon ">
            </div>
        </form>
        <?php
    }
}