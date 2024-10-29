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

class AnantHeading extends \Elementor\Widget_Base {

	private $heading_card_class = 'anant-heading-card';
	private $heading_card_inner_class = 'anant-heading-inner-card';

	public function get_name() {
		return 'anant-heading-items';
	}

	public function get_title() {
		return __( 'Heading ', 'anant-addons-for-elementor' );
	}

	public function get_categories() {
		return [ 'anant-elements' ];
	}

	public function get_icon() {
		return 'ant-icon eicon-animated-headline';
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
					'layout_3'      => esc_html__( 'Layout 3', 'anant-addons-for-elementor' ),
				],
			]
		);

	

		$this->add_control(
			'card_title', [
				'label' => __( 'Title', 'anant-addons-for-elementor' ),
				'type' => \Elementor\Controls_Manager::TEXTAREA,
				'default' => __( 'Add Text ' , 'anant-addons-for-elementor' ),
				'label_block' => true,
			]
		);
	
		$this->add_control(
			'before_title', [
				'label' => __( 'Title Before', 'anant-addons-for-elementor' ),
				'type' => \Elementor\Controls_Manager::TEXTAREA,
				'default' => __( 'Heading' , 'anant-addons-for-elementor' ),
				'label_block' => true,
				'conditions' => [
					'relation' => 'and',
					'terms'    => [
						[
							'name'     => 'template_style',
							'operator' => '!==',
							'value'    => 'layout_1',
						],
						[
							'name'     => 'template_style',
							'operator' => '!==',
							'value'    => 'layout_3',
						],
					],
				],
			]
		);
		$this->add_control(
			'after_title', [
				'label' => __( 'Title After', 'anant-addons-for-elementor' ),
				'type' => \Elementor\Controls_Manager::TEXTAREA,
				'default' => __( 'Text' , 'anant-addons-for-elementor' ),
				'label_block' => true,
				'conditions' => [
					'relation' => 'and',
					'terms'    => [
						[
							'name'     => 'template_style',
							'operator' => '!==',
							'value'    => 'layout_1',
						],
						[
							'name'     => 'template_style',
							'operator' => '!==',
							'value'    => 'layout_3',
						],
					],
				],
			]
		);
		$this->add_control(
			'card_link',
			[
				'label' => __( 'Link', 'anant-addons-for-elementor' ),
				'type' => \Elementor\Controls_Manager::URL,
				'placeholder' => __( 'https://your-link.com', 'anant-addons-for-elementor' ),
				'show_external' => true,
				'default' => [
					'url' => '',
					'is_external' => true,
					'nofollow' => true,
				],
			]
		);
		$this->add_control(
            'heading_html_tag',
            [
                'label'       => esc_html__( 'Html Tag', 'anant-addons-for-elementor' ),
                'placeholder' => esc_html__( 'Choose Template from Here', 'anant-addons-for-elementor' ),
                'type'        => \Elementor\Controls_Manager::SELECT,
                'default'     => 'h3',
                'options'     => [
                    'h1' => esc_html__( 'H1', 'anant-addons-for-elementor' ),
                    'h2' => esc_html__( 'H2', 'anant-addons-for-elementor' ),
                    'h3' => esc_html__( 'H3', 'anant-addons-for-elementor' ),
                    'h4' => esc_html__( 'H4', 'anant-addons-for-elementor' ),
                    'h5' => esc_html__( 'H5', 'anant-addons-for-elementor' ),
                    'h6' => esc_html__( 'H6', 'anant-addons-for-elementor' ),
                    'div' => esc_html__( 'Div', 'anant-addons-for-elementor' ),
                    'span' => esc_html__( 'span', 'anant-addons-for-elementor' ),
                ],
            ]
        );
		
		$this->add_control(
			'card_heading_alignment',
			[
				'label'     => __( 'Alignment', 'anant-addons-for-elementor' ),
				'type'      => Controls_Manager::CHOOSE,
				'options'   => [
					'-webkit-left' => [
						'title' => __( 'Left', 'anant-addons-for-elementor' ),
						'icon'  => 'eicon-text-align-left',
					],
					'-webkit-center' => [
						'title' => __( 'Center', 'anant-addons-for-elementor' ),
						'icon'  => 'eicon-text-align-center',
					],
					'-webkit-right' => [
						'title' => __( 'Right', 'anant-addons-for-elementor' ),
						'icon'  => 'eicon-text-align-right',
					],
				],
				'toggle'    => true,
				'selectors' => [
					'{{WRAPPER}} .'.$this->heading_card_class.' .title' => 'text-align: {{VALUE}};',
				],
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'heading_settings',
			[
				'label' => __( 'Heading Settings', 'anant-addons-for-elementor' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);

		$this->start_controls_tabs( 'card_tabs' );

		$this->start_controls_tab(
			'card_normal_style',
			[
				'label' => __( 'Normal', 'anant-addons-for-elementor' ),
			]
		);

		$this->add_control(
			'card_bg_color',
			[
				'label'     => __( ' Color', 'anant-addons-for-elementor' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}}  .'.$this->heading_card_class.' a' => 'color: {{VALUE}}',
				],
			]
		);
		$this->add_control(
			'card_before_color',
			[
				'label'     => __( 'Before Color', 'anant-addons-for-elementor' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}}  .'.$this->heading_card_class.' a span' => 'color: {{VALUE}}',
				],	
				'conditions' => [
					'relation' => 'and',
					'terms'    => [
						[
							'name'     => 'template_style',
							'operator' => '!==',
							'value'    => 'layout_1',
						],
						[
							'name'     => 'template_style',
							'operator' => '!==',
							'value'    => 'layout_3',
						],
					],
				],
			]
		);
		anant_typography_control(
			$this,
			[
				'name'     => 'card_heading_title_typography',
				'label'    => 'Typography',
				'selector' => '{{WRAPPER}}  .'.$this->heading_card_class,
			]
		);

		anant_border_control(
			$this,
			[
				'name'     => 'card_border_type',
				'label'    => 'Border Type',
				'selector' => '{{WRAPPER}} .'.$this->heading_card_class,
			]
		);

		anant_border_radius_control(
			$this,
			[
				'key'       => 'card_border_radius',
				'label'     => 'Border Radius',
				'selectors' => [
					'{{WRAPPER}} .'.$this->heading_card_class => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					'{{WRAPPER}} .'.$this->heading_card_class => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
					'{{WRAPPER}} .'.$this->heading_card_class => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					//'{{WRAPPER}} .'.$this->heading_card_class => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
					'{{WRAPPER}} .'.$this->heading_card_class => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					'{{WRAPPER}} .'.$this->heading_card_class => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		anant_box_shadow_control(
			$this,
			[
				'key'      => 'card_box_shadow',
				'label'    => 'Box Shadow',
				'selector' => '{{WRAPPER}}  .'.$this->heading_card_class,
			]
		);


		$this->end_controls_tab();

		$this->start_controls_tab(
			'card_style_hover',
			[
				'label' => __( 'Hover', 'anant-addons-for-elementor' ),

			]
		);

		$this->add_control(
			'card_bg_color_hover',
			[
				'label'     => __( ' Color', 'anant-addons-for-elementor' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}}  .'.$this->heading_card_class.' a:hover' => 'color: {{VALUE}}',
				],
			]
		);
		
		$this->add_control(
			'card_before_color_hover',
			[
				'label'     => __( 'Before Color', 'anant-addons-for-elementor' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}}  .'.$this->heading_card_class.' a:hover span' => 'color: {{VALUE}}',
				],	
				'conditions' => [
					'relation' => 'and',
					'terms'    => [
						[
							'name'     => 'template_style',
							'operator' => '!==',
							'value'    => 'layout_1',
						],
						[
							'name'     => 'template_style',
							'operator' => '!==',
							'value'    => 'layout_3',
						],
					],
				],
			]
		);
		anant_typography_control(
			$this,
			[
				'name'     => 'card_heading_title_typography_hover',
				'label'    => 'Typography',
				'selector' => '{{WRAPPER}}  .'.$this->heading_card_class.':hover',
			]
		);

		anant_border_control(
			$this,
			[
				'name'     => 'card_border_type_hover',
				'label'    => 'Border Type',
				'selector' => '{{WRAPPER}} .'.$this->heading_card_class.':hover',
			]
		);

		anant_border_radius_control(
			$this,
			[
				'key'       => 'card_border_radius_hover',
				'label'     => 'Border Radius',
				'selectors' => [
					'{{WRAPPER}} .'.$this->heading_card_class.':hover' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					'{{WRAPPER}} .'.$this->heading_card_class.':hover' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
					'{{WRAPPER}} .'.$this->heading_card_class.':hover' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					//'{{WRAPPER}} .'.$this->heading_card_class.':hover' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
					'{{WRAPPER}} .'.$this->heading_card_class.':hover' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					'{{WRAPPER}} .'.$this->heading_card_class.':hover' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		anant_box_shadow_control(
			$this,
			[
				'key'      => 'card_box_shadow_hover',
				'label'    => 'Box Shadow',
				'selector' => '{{WRAPPER}}  .'.$this->heading_card_class.':hover',
			]
		);

		$this->end_controls_tab();

		$this->end_controls_tabs();
		$this->end_controls_section();

		$this->start_controls_section(
			'border_settings',
			[
				'label' => __( 'Border Settings', 'anant-addons-for-elementor' ),
				'tab'   => Controls_Manager::TAB_STYLE,
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
		$this->add_control(
			'card_border_color',
			[
				'label'     => __( 'Border Color', 'anant-addons-for-elementor' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}}  .'.$this->heading_card_class.' .title::before' => 'border-color: {{VALUE}}',
					'{{WRAPPER}}  .'.$this->heading_card_class.' .title::after' => 'border-color: {{VALUE}}',
				],
			]
		);
		$this->add_responsive_control(
			'border_width',
			[
				'label'           => __( 'Border Width', 'anant-addons-for-elementor' ),
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
					'unit' => '',
				],
				'tablet_default'  => [
					'size' => '',
					'unit' => '',
				],
				'mobile_default'  => [
					'size' =>  '',
					'unit' => '',
				],
				'selectors'       => [
					'{{WRAPPER}} .'.$this->heading_card_class.' .title::before' => 'width: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .'.$this->heading_card_class.' .title::after' => 'width: {{SIZE}}{{UNIT}};',
				],
			],
		);
		$this->add_responsive_control(
			'border_height',
			[
				'label'           => __( 'Border Height', 'anant-addons-for-elementor' ),
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
					'unit' => '',
				],
				'tablet_default'  => [
					'size' => '',
					'unit' => '',
				],
				'mobile_default'  => [
					'size' =>  '',
					'unit' => '',
				],
				'selectors'       => [
					'{{WRAPPER}} .'.$this->heading_card_class.' .title::before' => 'border-bottom: {{SIZE}}{{UNIT}} solid;',
					'{{WRAPPER}} .'.$this->heading_card_class.' .title::after' => 'border-bottom: {{SIZE}}{{UNIT}} solid;',
				],
			],
		);
		$this->add_responsive_control(
			'border_radius',
			[
				'label'           => __( 'Border Radius', 'anant-addons-for-elementor' ),
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
					'unit' => '',
				],
				'tablet_default'  => [
					'size' => '',
					'unit' => '',
				],
				'mobile_default'  => [
					'size' =>  '',
					'unit' => '',
				],
				'selectors'       => [
					'{{WRAPPER}} .'.$this->heading_card_class.' .title::before' => 'border-radius: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .'.$this->heading_card_class.' .title::after' => 'border-radius: {{SIZE}}{{UNIT}};',
				],
			],
		);
		$this->add_responsive_control(
			'border_space',
			[
				'label'           => __( 'Border Space', 'anant-addons-for-elementor' ),
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
					'unit' => '',
				],
				'tablet_default'  => [
					'size' => '',
					'unit' => '',
				],
				'mobile_default'  => [
					'size' =>  '',
					'unit' => '',
				],
				'selectors'       => [
					'{{WRAPPER}} .'.$this->heading_card_class.' .title::before' => 'margin-bottom: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .'.$this->heading_card_class.' .title::after' => 'margin-top: {{SIZE}}{{UNIT}};',
				],
			],
		);

		$this->end_controls_section();
		anant_pro_promotion_controls($this);
	}

	protected function render() {
		$settings = $this->get_settings_for_display(); 

		$title = $settings['card_title'];
		$before_title = $settings['before_title'];
		$after_title = $settings['after_title'];
		$heading_html_tag = $settings['heading_html_tag'];
		$link = $settings['card_link']['url'];
		$target = $settings['card_link']['is_external'] ? ' target="_blank"' : '';
		$nofollow = $settings['card_link']['nofollow'] ? ' rel="nofollow"' : '';

		$template_style = $settings['template_style'];

		$template_path = ANANT_PATH . 'inc/templates/heading/';

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
			default:
				require $template_path. 'layout-1.php';
				break;
		}
	}
}