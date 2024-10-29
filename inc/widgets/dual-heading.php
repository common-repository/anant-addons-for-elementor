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

class Anant_DualHeading extends \Elementor\Widget_Base {

	private $heading_card_class = 'anant-heading-card';
	private $heading_card_inner_class = 'anant-heading-inner-card';

	public function get_name() {
		return 'anant-heading';
	}

	public function get_title() {
		return esc_html__( 'Dual Color Heading ', 'anant-addons-for-elementor' );
	}

	public function get_categories() {
		return [ 'anant-elements' ];
	}

	public function get_icon() {
		return 'ant-icon eicon-animated-headline';
	}

	public function get_style_depends() {
		return [
			'',
		];
	}

	public function get_script_depends() {
		return [
			'anant-widget-js',
		];
	}

	public function get_keywords() {
		return ['heading',
				'dual heading', 
				'creative', 
				'dual',
				'creative heading',
				'title',
				'color',
				'dual color heading',
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
					'layout_3'      => esc_html__( 'Layout 3 (Pro)', 'anant-addons-for-elementor' ),
					'layout_4'      => esc_html__( 'Layout 4 (Pro)', 'anant-addons-for-elementor' ),
				],
			]
		);

		$this->add_control(
			'anant_dual_heading_pro_notice',
			[
				'raw' => 'Only Available in <a href="https://anantaddons.com/" target="_blank">Pro Version!</a>',
				'type' => \Elementor\Controls_Manager::RAW_HTML,
				'content_classes' => 'anant-pro-notice',
				'condition' => [
                    'template_style!' => ['layout_1', 'layout_2'],
                ],
			]
		);

		$this->add_control(
			'before_title', [
				'label' => esc_html__( 'Prefix Text', 'anant-addons-for-elementor' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => esc_html__( 'Dual' , 'anant-addons-for-elementor' ),
				'label_block' => true,
			]
		);

		$this->add_control(
			'primary_title', [
				'label' => esc_html__( 'Highlight Text', 'anant-addons-for-elementor' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => esc_html__( 'Color' , 'anant-addons-for-elementor' ),
				'label_block' => true,
			]
		);

		$this->add_control(
			'after_title', [
				'label' => esc_html__( 'Suffix Text', 'anant-addons-for-elementor' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => esc_html__( 'Heading' , 'anant-addons-for-elementor' ),
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
		
		$this->add_responsive_control(
			'card_heading_alignment',
			[
				'label'     => esc_html__( 'Alignment', 'anant-addons-for-elementor' ),
				'type'      => Controls_Manager::CHOOSE,
				'options'   => [
					'-webkit-left' => [
						'title' => esc_html__( 'Left', 'anant-addons-for-elementor' ),
						'icon'  => 'eicon-text-align-left',
					],
					'-webkit-center' => [
						'title' => esc_html__( 'Center', 'anant-addons-for-elementor' ),
						'icon'  => 'eicon-text-align-center',
					],
					'-webkit-right' => [
						'title' => esc_html__( 'Right', 'anant-addons-for-elementor' ),
						'icon'  => 'eicon-text-align-right',
					],
				],
				'toggle'    => true,
				'selectors' => [
					'{{WRAPPER}} .'.$this->heading_card_class.' .title' => 'text-align: {{VALUE}};',
				],
			]
		);
		
		$this->add_control(
			'show_heading',
			[
				'label' => esc_html__( 'Show Heading', 'anant-addons-for-elementor' ),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'label_on' => esc_html__( 'Show', 'anant-addons-for-elementor' ),
				'label_off' => esc_html__( 'Hide', 'anant-addons-for-elementor' ),
				'return_value' => 'yes',
				'default' => 'yes',
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'subtext_settings',
			[
				'label' => esc_html__( 'Subtext', 'anant-addons-for-elementor' ),
				'tab'   => Controls_Manager::TAB_CONTENT,
			]
		);

		$this->add_control(
			'card_subtext',
			[
				'label' => esc_html__( 'Subtext', 'anant-addons-for-elementor' ),
				'type' => \Elementor\Controls_Manager::WYSIWYG,
				'default' => __( '<p>Aenean ut turpis blandit eros convallis congue sit amet a libero. Mauris sed tempor felis. Nunc nisi massa, imperdiet ac metus quis, pharetra pulvinar sapien</p>', 'anant-addons-for-elementor' ),
				'placeholder' => esc_html__( 'Type your subtext here', 'anant-addons-for-elementor' ),
			]
		);

		$this->add_responsive_control(
			'card_subtext_alignment',
			[
				'label'     => esc_html__( 'Alignment', 'anant-addons-for-elementor' ),
				'type'      => Controls_Manager::CHOOSE,
				'options'   => [
					'-webkit-left' => [
						'title' => esc_html__( 'Left', 'anant-addons-for-elementor' ),
						'icon'  => 'eicon-text-align-left',
					],
					'-webkit-center' => [
						'title' => esc_html__( 'Center', 'anant-addons-for-elementor' ),
						'icon'  => 'eicon-text-align-center',
					],
					'-webkit-right' => [
						'title' => esc_html__( 'Right', 'anant-addons-for-elementor' ),
						'icon'  => 'eicon-text-align-right',
					],
				],
				'toggle'    => true,
				'selectors' => [
					'{{WRAPPER}} .'.$this->heading_card_class.' .text' => 'text-align: {{VALUE}};',
				],
			]
		);
		
		$this->add_control(
			'show_subtext',
			[
				'label' => esc_html__( 'Show Subtext', 'anant-addons-for-elementor' ),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'label_on' => esc_html__( 'Show', 'anant-addons-for-elementor' ),
				'label_off' => esc_html__( 'Hide', 'anant-addons-for-elementor' ),
				'return_value' => 'yes',
				'default' => 'yes',
			]
		);

		$this->end_controls_section();

		anant_pro_promotion_controls($this);

		//STYLE
		$this->start_controls_section(
			'heading_settings',
			[
				'label' => esc_html__( 'Dual Heading Settings', 'anant-addons-for-elementor' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_responsive_control(
			'heading_main_line_height',
			[
				'label'           => __( 'Line Height', 'anant-addons-for-elementor' ),
				'type'            => Controls_Manager::SLIDER,
				'size_units'      => [ 'px', '%', 'rem', 'em' ],
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
				'selectors' => [
					'{{WRAPPER}} .'.$this->heading_card_class.' div' => 'line-height:{{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .'.$this->heading_card_class.' span' => 'line-height:{{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .'.$this->heading_card_class.' h3' => 'line-height:{{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .'.$this->heading_card_class.' h1' => 'line-height:{{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .'.$this->heading_card_class.' h2' => 'line-height:{{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .'.$this->heading_card_class.' h4' => 'line-height:{{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .'.$this->heading_card_class.' h5' => 'line-height:{{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .'.$this->heading_card_class.' h6' => 'line-height:{{SIZE}}{{UNIT}};',
				], 
			],
		);

		$this->add_control(
			'card_bg_color',
			[
				'label'     => esc_html__( 'Background Color', 'anant-addons-for-elementor' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}}  .'.$this->heading_card_class => 'background-color: {{VALUE}}',
				],
			]
		);

		anant_border_control(
			$this,
			[
				'name'     => 'card_border_type',
				'selector' => '{{WRAPPER}} .'.$this->heading_card_class,
			]
		);

		anant_border_radius_control(
			$this,
			[
				'key'       => 'card_border_radius',
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
				],
			]
		);

		anant_box_shadow_control(
			$this,
			[
				'key'      => 'card_box_shadow',
				'selector' => '{{WRAPPER}}  .'.$this->heading_card_class,
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'main_settings',
			[
				'label' => esc_html__( 'Color & Typography Settings', 'anant-addons-for-elementor' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'card_title_heading',
			[
				'label' => esc_html__( 'Title', 'anant-addons-for-elementor' ),
				'type' => \Elementor\Controls_Manager::HEADING,
			]
		);

		$this->add_control(
			'card_title_color',
			[
				'label'     => esc_html__( 'Highlight Text', 'anant-addons-for-elementor' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}}  .'.$this->heading_card_class.' .title span' => 'color: {{VALUE}}',
				],
				'condition' => [
					'template_style!'    => ['layout_1'],
				]
			]
		);

		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name'      => 'card_title_gradient_color',
				'types'          => [ 'classic', 'gradient' ],
				'exclude'        => [ 'image' ],
				'fields_options' => [
					'background' => [
						'label'     => esc_html__( 'Highlight type', 'anant-addons-for-elementor' ),
						'default' => 'classic',
					],
				],
				'selector'  => '{{WRAPPER}} .'.$this->heading_card_class.' .title span',
				'condition' => [
					'template_style'    => ['layout_1'],
				]
			]
		);

		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name'      => 'card_title_gradient_bg_color',
				'types'          => [ 'classic', 'gradient' ],
				'exclude'        => [ 'image' ],
				'fields_options' => [
					'background' => [
						'label'     => esc_html__( 'Background Color', 'anant-addons-for-elementor' ),
						'default' => 'classic',
					],
				],
				'selector'  => '{{WRAPPER}} .'.$this->heading_card_class.' .title span',
				'condition' => [
					'template_style'    => ['layout_2'],
				]
			]
		);

		anant_typography_control(
			$this,
			[
				'name'     => 'card_title_typography',
				'selector' => '{{WRAPPER}}  .'.$this->heading_card_class.' .title span',
			]
		);

		$this->add_responsive_control(
			'card_title_padding',
			[
				'label'     => esc_html__('Padding', 'anant-addons-for-elementor'),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .'.$this->heading_card_class.' .title span' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
				'condition' => [
					'template_style' => ['layout_2'],
				]
			]
		);

		$this->add_control(
			'card_before_after_heading',
			[
				'label' => esc_html__( 'Prefix & Suffix Text', 'anant-addons-for-elementor' ),
				'type' => \Elementor\Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);

		$this->add_control(
			'card_before_after_color',
			[
				'label'     => esc_html__( 'Color', 'anant-addons-for-elementor' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}}  .'.$this->heading_card_class.' .title a' => 'color: {{VALUE}}',
				],	
			]
		);

		anant_typography_control(
			$this,
			[
				'name'     => 'card_before_after_typography',
				'selector' => '{{WRAPPER}}  .'.$this->heading_card_class.' .title a',
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'subtext_style_settings',
			[
				'label' => esc_html__( 'Subtext Settings', 'anant-addons-for-elementor' ),
				'tab'   => Controls_Manager::TAB_STYLE,
				'condition' => [
					'show_subtext' =>  'yes',
				]
			]
		);

		$slug = 'dual_heading_subtext';

		$this->add_control(
			$slug.'_color',
			[
				'label'     => esc_html__( 'Color', 'anant-addons-for-elementor' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}}  .'.$this->heading_card_class.' .text p' => 'color: {{VALUE}}',
					'{{WRAPPER}}  .'.$this->heading_card_class.' .text h1' => 'color: {{VALUE}}',
					'{{WRAPPER}}  .'.$this->heading_card_class.' .text h2' => 'color: {{VALUE}}',
					'{{WRAPPER}}  .'.$this->heading_card_class.' .text h3' => 'color: {{VALUE}}',
					'{{WRAPPER}}  .'.$this->heading_card_class.' .text h4' => 'color: {{VALUE}}',
					'{{WRAPPER}}  .'.$this->heading_card_class.' .text h5' => 'color: {{VALUE}}',
					'{{WRAPPER}}  .'.$this->heading_card_class.' .text h6' => 'color: {{VALUE}}',
					'{{WRAPPER}}  .'.$this->heading_card_class.' .text pre' => 'color: {{VALUE}}',
				],
			]
		);
		anant_typography_control(
			$this,
			[
				'name'     => $slug.'_typography',
				'selector' => '
				{{WRAPPER}}  .'.$this->heading_card_class.' .text p,
				{{WRAPPER}}  .'.$this->heading_card_class.' .text h1,
				{{WRAPPER}}  .'.$this->heading_card_class.' .text h2,
				{{WRAPPER}}  .'.$this->heading_card_class.' .text h3,
				{{WRAPPER}}  .'.$this->heading_card_class.' .text h4,
				{{WRAPPER}}  .'.$this->heading_card_class.' .text h5,
				{{WRAPPER}}  .'.$this->heading_card_class.' .text h6,
				{{WRAPPER}}  .'.$this->heading_card_class.' .text pre',
			]
		);
		$this->add_responsive_control(
			$slug.'_margin',
			[
				'label'     => esc_html__('Margin', 'anant-addons-for-elementor'),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .'.$this->heading_card_class.' .text p' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					'{{WRAPPER}} .'.$this->heading_card_class.' .text h1' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					'{{WRAPPER}} .'.$this->heading_card_class.' .text h2' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					'{{WRAPPER}} .'.$this->heading_card_class.' .text h3' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					'{{WRAPPER}} .'.$this->heading_card_class.' .text h4' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					'{{WRAPPER}} .'.$this->heading_card_class.' .text h5' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					'{{WRAPPER}} .'.$this->heading_card_class.' .text h6' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					'{{WRAPPER}} .'.$this->heading_card_class.' .text pre' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				], 
			]
		);

		$this->end_controls_section();

	}

	protected function render() {

		$settings = $this->get_settings_for_display();

		$template_style = $settings['template_style'];
		
		$title = $settings['primary_title'];
		$before_title = $settings['before_title'];
		$after_title = $settings['after_title'];
		$heading_html_tag = $settings['heading_html_tag'];
		$link = $settings['card_link']['url'];
		$target = $settings['card_link']['is_external'] ? ' target="_blank"' : '';
		$nofollow = $settings['card_link']['nofollow'] ? ' rel="nofollow"' : '';
		$show_heading = $settings['show_heading'];

		$subtext = $settings['card_subtext'];
		$show_subtext = $settings['show_subtext'];

		$template_path = ANANT_PATH . 'inc/templates/dual-heading/';

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