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

class Anant_Portfolio extends \Elementor\Widget_Base {

	private $portfolio_card_class = 'anant-portfolio-card';
	private $portfolio_card_inner_class = 'anant-portfolio-inner-card';
	private $portfolio_card_content_class = 'anant-portfolio-content-card';
	private $portfolio_card_image_class = 'anant-portfolio-card-image';
	private $portfolio_card_heading_class = 'anant-portfolio-card-heading';
	private $portfolio_card_icon_class = 'anant-portfolio-card-icon';
	private $portfolio_card_subtitle_class = 'anant-portfolio-card-subtitle';

	public function get_name() {
		return 'anant-portfolio';
	}

	public function get_title() {
		return esc_html__( 'Portfolio ', 'anant-addons-for-elementor' );
	}

	public function get_categories() {
		return [ 'anant-elements' ];
	}

	public function get_icon() {
		return 'ant-icon eicon-gallery-grid';
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
			'portfolio',
			'project', 
			'work', 
			'service',
			'anant addons',
			'anant',
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
			'template_design',
			[
				'label'       => esc_html__( 'Portfolio Layout Style', 'anant-addons-for-elementor' ),
				'placeholder' => esc_html__( 'Choose Style from Here', 'anant-addons-for-elementor' ),
				'type'        => \Elementor\Controls_Manager::SELECT,
				'default'     => 'card',
				'options'     => [
					'card'      => esc_html__( 'Card ', 'anant-addons-for-elementor' ),
					'overlay' => esc_html__( 'Overlay', 'anant-addons-for-elementor' ),
				],
			]
		);

		$this->add_control(
			'template_card_style',
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
					'layout_5'      => esc_html__( 'Layout 5 (Pro)', 'anant-addons-for-elementor' ),
				],
				'condition' => [
                    'template_design' => ['card'],
                ],
			]
		);
		$this->add_control(
			'template_overlay_style',
			[
				'label'       => esc_html__( 'Template Style', 'anant-addons-for-elementor' ),
				'placeholder' => esc_html__( 'Choose Template from Here', 'anant-addons-for-elementor' ),
				'type'        => \Elementor\Controls_Manager::SELECT,
				'default'     => 'layout_1',
				'options'     => [
					'layout_1'     => esc_html__( 'Layout 1', 'anant-addons-for-elementor' ),
					'layout_2'      => esc_html__( 'Layout 2 (Pro)', 'anant-addons-for-elementor' ),
					'layout_3'      => esc_html__( 'Layout 3 (Pro)', 'anant-addons-for-elementor' ),
					'layout_4'      => esc_html__( 'Layout 4 (Pro)', 'anant-addons-for-elementor' ),
					'layout_5'      => esc_html__( 'Layout 5 (Pro)', 'anant-addons-for-elementor' ),
				],
				'condition' => [
                    'template_design' => ['overlay'],
                ],
			]
		);

		$this->add_control(
			'anant_portfolio_card_pro_notice',
			[
				'raw' => 'Only Available in <a href="https://anantaddons.com/" target="_blank">Pro Version!</a>',
				'type' => \Elementor\Controls_Manager::RAW_HTML,
				'content_classes' => 'anant-pro-notice',
				'condition' => [
                    'template_design' => ['card'],
                    'template_card_style!' => ['layout_1', 'layout_2'],
                ],
			]
		);

		$this->add_control(
			'anant_portfolio_overlay_pro_notice',
			[
				'raw' => 'Only Available in <a href="https://anantaddons.com/" target="_blank">Pro Version!</a>',
				'type' => \Elementor\Controls_Manager::RAW_HTML,
				'content_classes' => 'anant-pro-notice',
				'condition' => [
                    'template_design' => ['overlay'],
                    'template_overlay_style!' => ['layout_1'],
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
			]
		);

		$this->add_control(
			'card_icon',
			[
				'label' => esc_html__( 'Icon', 'anant-addons-for-elementor' ),
				'type' => \Elementor\Controls_Manager::ICONS,
				'default' => [
					'value' => 'fas fa-link',
					'library' => 'solid',
				],

			]
		);
		
		$this->add_control(
			'card_two_icon',
			[
				'label' => esc_html__( 'Icon', 'anant-addons-for-elementor' ),
				'type' => \Elementor\Controls_Manager::ICONS,
				'default' => [
					'value' => 'far fa-eye',
					'library' => 'solid',
				],

			]
		);

		$this->add_control(
			'card_subtitle',
			[
				'label' => esc_html__( 'Subtitle', 'anant-addons-for-elementor' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => esc_html__( 'Advertise', 'anant-addons-for-elementor' ),
				'placeholder' => esc_html__( 'Type your subtitle here', 'anant-addons-for-elementor' ),
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
		$this->end_controls_section();

		$this->start_controls_section(
			'settings_section',
			[
				'label' => esc_html__( 'Settings', 'anant-addons-for-elementor' ),
				'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
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
			'show_subtitle',
			[
				'label' => esc_html__( 'Show Subtitle', 'anant-addons-for-elementor' ),
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
		//portfolio Box Settings
		$this->start_controls_section(
			'portfolio_box_settings',
			[
				'label' => esc_html__( 'Portfolio Box Settings ', 'anant-addons-for-elementor' ),
				'tab'   => Controls_Manager::TAB_STYLE, 
			]
		);
		
		$slug = 'portfolio_box';

		$this->add_control(
			$slug.'_bg_color',
			[
				'label'     => esc_html__( 'Background Color', 'anant-addons-for-elementor' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}}  .'.$this->portfolio_card_class.'' => 'background-color: {{VALUE}}',
				],
			]
		);

		anant_border_control(
			$this,
			[
				'name'     => $slug.'_border_type',
				'selector' => '{{WRAPPER}} .'.$this->portfolio_card_class,
			]
		);

		anant_border_radius_control(
			$this,
			[
				'key'       => $slug.'_border_radius',
				'selectors' => [
					'{{WRAPPER}} .'.$this->portfolio_card_class => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
					'{{WRAPPER}} .'.$this->portfolio_card_class => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
					'{{WRAPPER}} .'.$this->portfolio_card_class => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		anant_box_shadow_control(
			$this,
			[
				'key'      => $slug.'_box_shadow',
				'selector' => '{{WRAPPER}}  .'.$this->portfolio_card_class,
			]
		);

		$this->end_controls_section();

		//portfolio Content Settings
		$this->start_controls_section(
			'portfolio_content_settings',
			[
				'label' => esc_html__( 'Portfolio Content Settings', 'anant-addons-for-elementor' ),
				'tab'   => Controls_Manager::TAB_STYLE, 
			]
		);

		$this->add_control(
			'card_bg_color',
			[
				'label'     => esc_html__( 'Background Color', 'anant-addons-for-elementor' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}}  .'.$this->portfolio_card_content_class.'' => 'background-color: {{VALUE}}',
				],
			]
		);

		$this->add_control(
			'card_bg_color_hover',
			[
				'label'     => esc_html__( 'Hover Background Color', 'anant-addons-for-elementor' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .'.$this->portfolio_card_content_class.':hover' => 'background-color: {{VALUE}}',
					'{{WRAPPER}} .'.$this->portfolio_card_content_class.':before' => 'background-color: {{VALUE}}',
				],
			]
		);

		anant_border_control(
			$this,
			[
				'name'     => 'card_border_type',
				'selector' => '{{WRAPPER}} .'.$this->portfolio_card_content_class,
			]
		);

		anant_border_radius_control(
			$this,
			[
				'key'       => 'card_border_radius',
				'selectors' => [
					'{{WRAPPER}} .'.$this->portfolio_card_content_class => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
					'{{WRAPPER}} .'.$this->portfolio_card_content_class => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
					'{{WRAPPER}} .'.$this->portfolio_card_content_class => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		anant_box_shadow_control(
			$this,
			[
				'key'      => 'card_box_shadow',
				'selector' => '{{WRAPPER}}  .'.$this->portfolio_card_content_class,
			]
		);

		$this->end_controls_section();

		//portfolio Image Settings
		$this->start_controls_section(
			'image_settings',
			[
				'label' => esc_html__( 'Image Settings', 'anant-addons-for-elementor' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name'      => 'image_opacity_color',
				'types'          => [ 'classic'],
				'exclude'        => [ 'image' ],
				'fields_options' => [
					'background' => [
						'label'     => esc_html__( 'Background Overlay', 'anant-addons-for-elementor' ),
						'default' => 'classic',
					],
				],
				'selector'  => '{{WRAPPER}} .'.$this->portfolio_card_image_class.'::before',
			]
		);

		$this->add_responsive_control(
			'image_overlay_opacity',
			[
				'label' => esc_html__( 'Opacity', 'anant-addons-for-elementor' ),
				'type' => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'max' => 1,
						'step' => 0.01,
					],
				],
				'selectors' => [
					'{{WRAPPER}}  .'.$this->portfolio_card_image_class.'::before' => 'opacity: {{SIZE}};',
				]
			]
		);

		$this->add_responsive_control(
			'image_width',
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
					'{{WRAPPER}} .'.$this->portfolio_card_image_class.' ' => 'width: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .'.$this->portfolio_card_image_class.'::before' => 'width: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .portfolio_six .'.$this->portfolio_card_image_class.'::before' => 'width: calc( {{SIZE}}{{UNIT}} - 10%);',
				],
			]
		);

		$this->add_responsive_control(
			'image_height',
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
					'size' =>  '',
					'unit' => 'px',
				],
				'tablet_default'  => [
					'size' =>  '',
					'unit' => 'px',
				],
				'mobile_default'  => [
					'size' =>  '',
					'unit' => 'px',
				],
				'selectors'       => [
					'{{WRAPPER}} .'.$this->portfolio_card_image_class.' ' => 'height: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .'.$this->portfolio_card_image_class.'::before' => 'height: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->end_controls_section();
		
		//portfolio Icon Settings
		$this->start_controls_section(
			'icon_settings',
			[
				'label' => esc_html__( 'Icon Settings', 'anant-addons-for-elementor' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		); 
        $this->start_controls_tabs( 'card_icon_tabs' );

		$this->start_controls_tab(
			'card_heading_icon_normal_style',
			[
				'label' => esc_html__( 'Normal', 'anant-addons-for-elementor' ),
			]
		);
		
		$this->add_control(
			'card_heading_icon_bg_color',
			[
				'label'     => esc_html__( 'Icon Background Color', 'anant-addons-for-elementor' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}}  .'.$this->portfolio_card_icon_class.' a' => 'background-color: {{VALUE}}',
				],
			]
		);

		$this->add_control(
			'card_heading_icon_color',
			[
				'label'     => esc_html__( 'Icon Color', 'anant-addons-for-elementor' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}}  .'.$this->portfolio_card_icon_class.' a i' => 'color: {{VALUE}}',
					'{{WRAPPER}}  .'.$this->portfolio_card_icon_class.' a svg' => 'fill: {{VALUE}}',
				],
			]
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
					'{{WRAPPER}} .'.$this->portfolio_card_icon_class.' a' => 'width: {{SIZE}}{{UNIT}};height: {{SIZE}}{{UNIT}};',
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
					'{{WRAPPER}} .'.$this->portfolio_card_icon_class.' a i' => 'font-size: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .'.$this->portfolio_card_icon_class.' a svg' => 'width: {{SIZE}}{{UNIT}}; height: {{SIZE}}{{UNIT}};',
				],
			]
		);

		anant_border_control(
			$this,
			[
				'name'     => 'icon_border_type',
				'selector' => '{{WRAPPER}} .'.$this->portfolio_card_icon_class. ' a',
			]
		);

		anant_border_radius_control(
			$this,
			[
				'key'       => 'icon_border_type',
				'selectors' => [
					'{{WRAPPER}} .'.$this->portfolio_card_icon_class.' a' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					'{{WRAPPER}} .'.$this->portfolio_card_icon_class. ' a' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
					'{{WRAPPER}} .'.$this->portfolio_card_icon_class.' a' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					'{{WRAPPER}} .'.$this->portfolio_card_icon_class.' a' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		anant_box_shadow_control(
			$this,
			[
				'key'      => 'icon_box_shadow',
				'selector' => '{{WRAPPER}}  .'.$this->portfolio_card_icon_class . ' a',
			]
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
			'card_heading_icon_style_hover',
			[
				'label' => esc_html__( 'Hover', 'anant-addons-for-elementor' ),

			]
		);

		$this->add_control(
			'card_heading_icon_before_bg_color_hover',
			[
				'label'     => esc_html__( 'Icon Background Color', 'anant-addons-for-elementor' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .'.$this->portfolio_card_icon_class.' a:before' => 'background-color: {{VALUE}}',
				],
			]
		);

		$this->add_control(
			'card_heading_icon_color_hover',
			[
				'label'     => esc_html__( 'Icon Color', 'anant-addons-for-elementor' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .'.$this->portfolio_card_icon_class.' a:hover i' => 'color: {{VALUE}}',
					'{{WRAPPER}} .'.$this->portfolio_card_icon_class.' a:hover svg' => 'fill: {{VALUE}}',
				],
			]
		);

		anant_border_control(
			$this,
			[
				'name'     => 'icon_border_type_hover',
				'selector' => '{{WRAPPER}} .'.$this->portfolio_card_icon_class.' a:hover' ,
			]
		);

		anant_border_radius_control(
			$this,
			[
				'key'       => 'icon_border_radius_hover',
				'selectors' => [
					'{{WRAPPER}} .'.$this->portfolio_card_icon_class.' a:hover' =>  'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					'{{WRAPPER}} .'.$this->portfolio_card_icon_class.' a:before' =>  'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->end_controls_tab(); 
		$this->end_controls_tabs(); 
		$this->end_controls_section();

		//portfolio Subtitle Settings
		$this->start_controls_section(
			'portfolio_subtitle',
			[
				'label' => esc_html__( 'Subtitle  ', 'anant-addons-for-elementor' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_responsive_control(
			'card_heading_subtitle_alignment',
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
					'{{WRAPPER}} .'.$this->portfolio_card_subtitle_class => 'text-align: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'card_heading_subtitle_color',
			[
				'label'     => esc_html__( 'Subtitle Color', 'anant-addons-for-elementor' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}}  .'.$this->portfolio_card_subtitle_class => 'color: {{VALUE}}',
				],
			]
		);

		$this->add_control(
			'card_heading_subtitle_color_hover',
			[
				'label'     => esc_html__( 'Hover Subtitle Color', 'anant-addons-for-elementor' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .'.$this->portfolio_card_class.':hover .'.$this->portfolio_card_subtitle_class => 'color: {{VALUE}}',
				],
			]
		);

		anant_typography_control(
			$this,
			[
				'name'     => 'card_heading_subtitle_typography',
				'selector' => '{{WRAPPER}}  .'.$this->portfolio_card_subtitle_class,
			]
		);

		$this->add_responsive_control(
			'card_heading_subtitle_margin',
			[
				'label'     => esc_html__('Margin', 'anant-addons-for-elementor'),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .'.$this->portfolio_card_subtitle_class => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->end_controls_section();

		//portfolio Title Settings
		$this->start_controls_section(
			'portfolio_heading_title',
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
					'{{WRAPPER}} .'.$this->portfolio_card_heading_class => 'text-align: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'card_heading_title_color',
			[
				'label'     => esc_html__( 'Heading Color', 'anant-addons-for-elementor' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}}  .'.$this->portfolio_card_heading_class.' a' => 'color: {{VALUE}}',
				],
			]
		);

		$this->add_control(
			'card_heading_title_color_hover',
			[
				'label'     => esc_html__( 'Hover Heading Color', 'anant-addons-for-elementor' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .'.$this->portfolio_card_class.':hover .'.$this->portfolio_card_heading_class.' a' => 'color: {{VALUE}}',
				],
			]
		);

		anant_typography_control(
			$this,
			[
				'name'     => 'card_heading_title_typography',
				'selector' => '{{WRAPPER}}  .'.$this->portfolio_card_heading_class,
			]
		);

		$this->add_responsive_control(
			'card_heading_title_margin',
			[
				'label'     => esc_html__('Margin', 'anant-addons-for-elementor'),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .'.$this->portfolio_card_heading_class => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->end_controls_section(); 
	}

	protected function render() {
		$settings = $this->get_settings_for_display();

		$show_icon = $settings['show_icon'];
		$show_title = $settings['show_title'];
		$show_subtitle = $settings['show_subtitle'];

		$title = $settings['card_title'];
		$subtitle = $settings['card_subtitle']; 
		$image_url = $settings['card_image']['url'];
		$card_icon = $settings['card_icon'];
		$card_two_icon = $settings['card_two_icon'];
		$link = $settings['card_link']['url'];
		$target = $settings['card_link']['is_external'] ? ' target="_blank"' : '';
		$nofollow = $settings['card_link']['nofollow'] ? ' rel="nofollow"' : '';

		$template_card_style = $settings['template_card_style'];
		$template_overlay_style = $settings['template_overlay_style'];

		$template_path = ANANT_PATH . 'inc/templates/portfolio/';

		switch ($template_card_style) {
			case 'layout_1':
				require $template_path. 'layout-1.php';
				break;
			case 'layout_2':
				require $template_path. 'layout-2.php';
				break;
		}
		switch ($template_overlay_style) {
			case 'layout_1':
				require $template_path. 'layout-3.php';
				break;
		}
	}
}