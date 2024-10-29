<?php namespace AnantAddons;
use Elementor\Controls_Manager;
use Elementor\Core\Schemes\Color;
use Elementor\Core\Schemes\Typography;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Image_Size;
use Elementor\Widget_Base;
use Elementor\this;
use Elementor\Utils;
use Elementor\Group_Control_Border;
use Elementor\Repeater;
use Elementor\Group_Control_Background;

if ( ! defined( 'ABSPATH' ) ) { exit; } // Exit if accessed directly

class Anant_Team extends \Elementor\Widget_Base {

	private $class_name = 'Anant_Team';

	private $team_card_class = 'anant-team-card';
	private $team_card_inner_class = 'anant-team-inner-card';
	private $team_card_image_class = 'anant-team-card-image';
	private $team_card_top_content_class = 'anant-team-top-content-card';
	private $team_card_bottom_content_class = 'anant-team-bottom-content-card';
	private $team_card_heading_class = 'anant-team-card-heading';
	private $team_card_icon_class = 'anant-team-card-icon';
	private $team_card_designation_class = 'anant-team-card-designation';
	public function get_name() {
		return 'anant-team';
	}

	public function get_title() {
		return esc_html__( 'Team Member', 'anant-addons-for-elementor' );
	}

	public function get_categories() {
		return [ 'anant-elements' ];
	}

	public function get_icon() {
		return 'ant-icon eicon-featured-image';
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
			'team item',
			'team member', 
			'team members', 
			'team',
			'member',
			'our team',
			'person',
			'anant',
			'anant team',
			'anant addons'
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
				'default'     => 'layout_5',
				'options'     => [
					'layout_5'      => esc_html__( 'Layout 1', 'anant-addons-for-elementor' ),
					'layout_7'      => esc_html__( 'Layout 2', 'anant-addons-for-elementor' ),
					'layout_9'      => esc_html__( 'Layout 3', 'anant-addons-for-elementor' ),
					'layout_4'      => esc_html__( 'Layout 4 (Pro)', 'anant-addons-for-elementor' ),
					'layout_1'      => esc_html__( 'Layout 5 (Pro)', 'anant-addons-for-elementor' ),
					'layout_6'      => esc_html__( 'Layout 6 (Pro)', 'anant-addons-for-elementor' ),
					'layout_2'      => esc_html__( 'Layout 7 (Pro)', 'anant-addons-for-elementor' ),
					'layout_8'      => esc_html__( 'Layout 8 (Pro)', 'anant-addons-for-elementor' ),
					'layout_3'      => esc_html__( 'Layout 9 (Pro)', 'anant-addons-for-elementor' ),
					'layout_10'      => esc_html__( 'Layout 10 (Pro)', 'anant-addons-for-elementor' ),
				],
			]
		);

		$this->add_control(
			'anant_team_member_pro_notice',
			[
				'raw' => 'Only Available in <a href="https://anantaddons.com/" target="_blank">Pro Version!</a>',
				'type' => \Elementor\Controls_Manager::RAW_HTML,
				'content_classes' => 'anant-pro-notice',
				'condition' => [
                    'template_style!' => ['layout_5', 'layout_7', 'layout_9'],
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
			'card_title', [
				'label' => esc_html__( 'Name', 'anant-addons-for-elementor' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => esc_html__( 'John Doe' , 'anant-addons-for-elementor' ),
				'label_block' => true,
			]
		);
		

		$this->add_control(
			'card_designation',
			[
				'label' => esc_html__( 'Designation', 'anant-addons-for-elementor' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'rows' => 10,
				'default' => esc_html__( 'Designer', 'anant-addons-for-elementor' ),
				'placeholder' => esc_html__( 'Type your designation here', 'anant-addons-for-elementor' ),
			]
		);
		$repeater = new Repeater();

        $repeater->add_control(
			'social_icon_title', 
			[
				'label' => esc_html__('Title', 'anant-addons-for-elementor') ,
				'type' => Controls_Manager::TEXT, 
				'label_block' => true, 
				'default' => esc_html__('Telegram', 'anant-addons-for-elementor') ,
				]
			);
        $repeater->add_control(
			'social_icon', 
			[
				'label' => esc_html__('Social Icon', 'anant-addons-for-elementor') , 
				'type' => Controls_Manager::ICONS, 
				'default' => [
					'value' => 'fab fa-facebook-f', 'library' => 'brands',
				], 
			]
		);
        $repeater->add_control(
			'social_icon_link', 
			[
				'label' => esc_html__(' Link', 'anant-addons-for-elementor') , 
				'type' => Controls_Manager::URL, 
				'placeholder' => esc_html__('Enter URL', 'anant-addons-for-elementor') , 
				'show_external' => true, 
				'default' => [
					'url' => '#', 'is_external' => true, 'nofollow' => true, 
				], 
			]
		);
		$this->add_control(
			'social_icons_block', 
			[
				'label' => esc_html__('Add Social Icons', 'anant-addons-for-elementor') ,
				'type' => Controls_Manager::REPEATER,
				'fields' => $repeater->get_controls() ,
				'default' => [
				[
					'social_icon_title' => esc_html__('Facebook', 'anant-addons-for-elementor') ,
					'social_icon' => ['value' => 'fab fa-facebook-f', 'library' => 'brands',],
					'social_icon_link' => ['url' => '#','is_external' => true, 'nofollow' => true,]
				],
				[
					'social_icon_title' => esc_html__('Telegram', 'anant-addons-for-elementor') ,
					'social_icon' => ['value' => 'fab fa-telegram-plane', 'library' => 'brands',],
					'social_icon_link' => ['url' => '#','is_external' => true, 'nofollow' => true,]
				],
				[
					'social_icon_title' => esc_html__('Instagram', 'anant-addons-for-elementor') ,
					'social_icon' => ['value' => 'fab fa-instagram', 'library' => 'brands',],
					'social_icon_link' => ['url' => '#','is_external' => true, 'nofollow' => true,]
				],
				[
					'social_icon_title' => esc_html__('Twitter', 'anant-addons-for-elementor') ,
					'social_icon' => ['value' => 'fab fa-twitter', 'library' => 'brands',],
					'social_icon_link' => ['url' => '#','is_external' => true, 'nofollow' => true,]
				],
				],

				'title_field' => '{{{ social_icon_title }}}', 
			]
		);

		$this->add_control(
			'anant_team_repeater_pro_notice',
			[
				'raw' => 'More than 4 are available in <a href="https://anantaddons.com/" target="_blank">Pro Version!</a>',
				'type' => \Elementor\Controls_Manager::RAW_HTML,
				'content_classes' => 'anant-pro-notice',
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
			]
		);


		$this->add_control(
			'show_title',
			[
				'label' => esc_html__( 'Show Name', 'anant-addons-for-elementor' ),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'label_on' => esc_html__( 'Show', 'anant-addons-for-elementor' ),
				'label_off' => esc_html__( 'Hide', 'anant-addons-for-elementor' ),
				'return_value' => 'yes',
				'default' => 'yes',
			]
		);

		$this->add_control(
			'show_designation',
			[
				'label' => esc_html__( 'Show Designation', 'anant-addons-for-elementor' ),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'label_on' => esc_html__( 'Show', 'anant-addons-for-elementor' ),
				'label_off' => esc_html__( 'Hide', 'anant-addons-for-elementor' ),
				'return_value' => 'yes',
				'default' => 'yes',
			]
		);

		$this->add_control(
			'show_icon',
			[
				'label' => esc_html__( 'Show Social Icon', 'anant-addons-for-elementor' ),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'label_on' => esc_html__( 'Show', 'anant-addons-for-elementor' ),
				'label_off' => esc_html__( 'Hide', 'anant-addons-for-elementor' ),
				'return_value' => 'yes',
				'default' => 'yes',

			]
		);

		$this->end_controls_section();

		anant_pro_promotion_controls($this);

		// STYLE
		$this->start_controls_section(
			'box_settings',
			[
				'label' => esc_html__( 'Box Settings', 'anant-addons-for-elementor' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'box_bg_color',
			[
				'label'     => esc_html__( 'Background Color', 'anant-addons-for-elementor' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .'.$this->team_card_class => 'background-color: {{VALUE}}', 
				],
			]
		);

		$this->add_control(
			'box_bg_color_hover',
			[
				'label'     => esc_html__( 'Hover Background Color', 'anant-addons-for-elementor' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [ 
					'{{WRAPPER}}  .'.$this->team_card_class.':hover  ' => 'background-color: {{VALUE}}',
				],
				'condition' => [
					'template_style' => ['layout_9']
				]
			]
		);

		anant_border_control(
			$this,
			[
				'name'     => 'box_border_type',
				'selector' => '{{WRAPPER}} .'.$this->team_card_class,
			]
		);

		anant_border_radius_control(
			$this,
			[
				'key'       => 'box_border_radius',
				'selectors' => [
					'{{WRAPPER}} .'.$this->team_card_class => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'box_padding',
			[
				'label'     => esc_html__('Padding', 'anant-addons-for-elementor'),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .'.$this->team_card_class => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'box_margin',
			[
				'label'     => esc_html__('Margin', 'anant-addons-for-elementor'),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .'.$this->team_card_class => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		anant_box_shadow_control(
			$this,
			[
				'key'      => 'box_box_shadow',
				'selector' => '{{WRAPPER}}  .'.$this->team_card_class,
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'team_settings',
			[
				'label' => esc_html__( 'Team Settings', 'anant-addons-for-elementor' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'card_bg_color',
			[
				'label'     => esc_html__( 'Background Color', 'anant-addons-for-elementor' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .'.$this->team_card_bottom_content_class => 'background-color: {{VALUE}}',
					'{{WRAPPER}} .'.$this->team_card_bottom_content_class.'::after' => 'background-color: {{VALUE}}',
				],
			]
		);

		anant_border_control(
			$this,
			[
				'name'     => 'card_border_type',
				'selector' => '{{WRAPPER}} .'.$this->team_card_bottom_content_class,
			]
		);

		anant_border_radius_control(
			$this,
			[
				'key'       => 'card_border_radius',
				'selectors' => [
					'{{WRAPPER}} .'.$this->team_card_bottom_content_class => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
					'{{WRAPPER}} .'.$this->team_card_bottom_content_class => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
					'{{WRAPPER}} .'.$this->team_card_bottom_content_class => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->end_controls_section();

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
				'name'      => 'bg_opacity_color_hover',
				'label'     => esc_html__( 'Background Overlay', 'anant-addons-for-elementor' ),
				'types'          => [ 'classic', 'gradient' ],
				'exclude'        => [ 'image' ],
				'fields_options' => [
					'background' => [
						'default' => 'classic',
					],
				],
				'selector'  => '{{WRAPPER}} .'.$this->team_card_class.':hover .'.$this->team_card_top_content_class.' .top_img::before',
				'condition' => [
					'template_style' => ['layout_5', 'layout_7',]
				]
			]
		);

		$this->add_responsive_control(
			'bg_overlay_opacity_hover',
			[
				'label' => esc_html__( 'Opacity', 'anant-addons-for-elementor' ),
				'type' => Controls_Manager::SLIDER,
				'default' => [
					'size' => 0.5,
				],
				'range' => [
					'px' => [
						'max' => 1,
						'step' => 0.01,
					],
				],
				'selectors' => [
					'{{WRAPPER}}  .'.$this->team_card_class.':hover .'.$this->team_card_top_content_class.' .top_img::before' => 'opacity: {{SIZE}};',
				],
				'condition' => [
					'template_style' => ['layout_5', 'layout_7',]
				]
			]
		);

		anant_border_control(
			$this,
			[
				'name'     => 'image_border_type',
				'selector' => '{{WRAPPER}} .'.$this->team_card_image_class.' img, {{WRAPPER}} .team_seven .'.$this->team_card_image_class.':after',
			]
		);

		anant_border_radius_control(
			$this,
			[
				'key'       => 'image_border_radius',
				'selectors' => [
					'{{WRAPPER}} .'.$this->team_card_image_class.' img' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					'{{WRAPPER}} .'.$this->team_card_top_content_class.' .top_img::before' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					'{{WRAPPER}} .team_seven .top_img::after' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
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
					'{{WRAPPER}} .'.$this->team_card_image_class.' img' => 'width: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .'.$this->team_card_top_content_class.'::before' => 'width: {{SIZE}}{{UNIT}};',
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
					'{{WRAPPER}} .'.$this->team_card_class.' .'.$this->team_card_image_class.' img' => 'height: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'card_heading_image_margin',
			[
				'label'     => esc_html__('Margin', 'anant-addons-for-elementor'),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .'.$this->team_card_image_class.'' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					'{{WRAPPER}} .'.$this->team_card_top_content_class.'::before' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		anant_box_shadow_control(
			$this,
			[
				'key'      => 'image_box_shadow',
				'selector' => '{{WRAPPER}}  .'.$this->team_card_image_class.' img',
			]
		);

		$this->end_controls_section();

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
					'{{WRAPPER}} .'.$this->team_card_icon_class.' .social-icon' => 'justify-content: {{VALUE}};',
				],
				'conditions' => [
					'relation' => 'and',
					'terms'    => [
						[
							'name'     => 'template_style',
							'operator' => '!==',
							'value'    => 'layout_7',
						],
					],
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
		
		$this->add_control(
			'card_heading_icon_bg_color',
			[
				'label'     => esc_html__( 'Icon Background Color', 'anant-addons-for-elementor' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}}  .'.$this->team_card_icon_class.' .social-icon a' => 'background-color: {{VALUE}}',
				],
			]
		);

		$this->add_control(
			'card_heading_icon_color',
			[
				'label'     => esc_html__( 'Icon Color', 'anant-addons-for-elementor' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}}  .'.$this->team_card_icon_class.' .social-icon a' => 'color: {{VALUE}}',
					'{{WRAPPER}}  .'.$this->team_card_icon_class.' .social-icon a svg' => 'fill: {{VALUE}}',
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
					'size' => '' ,
					'unit' => 'px',
				],
				'tablet_default'  => [
					'size' => '' ,
					'unit' => 'px',
				],
				'mobile_default'  => [
					'size' =>  '',
					'unit' => 'px',
				],
				'selectors'       => [
					'{{WRAPPER}} .'.$this->team_card_icon_class.' .social-icon a' => 'width: {{SIZE}}{{UNIT}};height: {{SIZE}}{{UNIT}};',
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
					'{{WRAPPER}} .'.$this->team_card_icon_class.' .social-icon i' => 'font-size: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .'.$this->team_card_icon_class.' .social-icon svg' => 'width: {{SIZE}}{{UNIT}}; height: {{SIZE}}{{UNIT}};',
				],
			]
		);

		anant_border_control(
			$this,
			[
				'name'     => 'icon_border_type',
				'selector' => '{{WRAPPER}} .'.$this->team_card_icon_class. ' .social-icon a',
			]
		);

		anant_border_radius_control(
			$this,
			[
				'key'       => 'icon_border_type',
				'selectors' => [
					'{{WRAPPER}} .'.$this->team_card_icon_class.' .social-icon a' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
					'{{WRAPPER}} .'.$this->team_card_icon_class.' .social-icon a' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
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
			'card_heading_icon_bg_color_hover',
			[
				'label'     => esc_html__( 'Icon Background Color', 'anant-addons-for-elementor' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .'.$this->team_card_icon_class.' .social-icon a:hover' => 'background-color: {{VALUE}}',
				], 
			]
		);

		$this->add_control(
			'card_heading_icon_color_hover',
			[
				'label'     => esc_html__( 'Icon Color', 'anant-addons-for-elementor' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}}  .'.$this->team_card_icon_class.' .social-icon a:hover' => 'color: {{VALUE}}',
					'{{WRAPPER}}  .'.$this->team_card_icon_class.' .social-icon a:hover svg' => 'fill: {{VALUE}}',
				],
			]
		);

		anant_border_control(
			$this,
			[
				'name'     => 'icon_border_type_hover',
				'selector' => '{{WRAPPER}}  .'.$this->team_card_icon_class.' .social-icon a:hover' ,
			]
		);

		anant_border_radius_control(
			$this,
			[
				'key'       => 'icon_border_radius_hover',
				'selectors' => [
					'{{WRAPPER}} .'.$this->team_card_icon_class.' .social-icon a:hover' =>  'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->end_controls_tab();

		$this->end_controls_tabs();

		$this->end_controls_section();

		$this->start_controls_section(
			'team_heading_title',
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
					'{{WRAPPER}} .'.$this->team_card_heading_class => 'text-align: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'card_heading_title_color',
			[
				'label'     => esc_html__( 'Color', 'anant-addons-for-elementor' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}}  .'.$this->team_card_heading_class => 'color: {{VALUE}}',
				],
			]
		);

		$this->add_control(
			'card_heading_title_color_hover',
			[
				'label'     => esc_html__( 'Hover Color', 'anant-addons-for-elementor' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}}  .'.$this->team_card_class.':hover h3 ' => 'color: {{VALUE}}',
				], 
				'condition' => [
                    'template_style' => ['layout_9'],
                ],
			]
		);

		anant_typography_control(
			$this,
			[
				'name'     => 'card_heading_title_typography',
				'selector' => '{{WRAPPER}}  .'.$this->team_card_heading_class,
			]
		);

		$this->add_responsive_control(
			'card_heading_title_margin',
			[
				'label'     => esc_html__('Margin', 'anant-addons-for-elementor'),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .'.$this->team_card_heading_class => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					'{{WRAPPER}} .'.$this->team_card_heading_class => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->end_controls_section();


		$this->start_controls_section(
			'team_designation',
			[
				'label' => esc_html__( 'Designation', 'anant-addons-for-elementor' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_responsive_control(
			'card_heading_designation_alignment',
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
					'{{WRAPPER}} .'.$this->team_card_designation_class => 'text-align: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'card_heading_designation_color',
			[
				'label'     => esc_html__( 'Color', 'anant-addons-for-elementor' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}}  .'.$this->team_card_designation_class => 'color: {{VALUE}}',
				],
			]
		);

		$this->add_control(
			'card_heading_designation_color_hover',
			[
				'label'     => esc_html__( 'Hover Color', 'anant-addons-for-elementor' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .'.$this->team_card_class.':hover .'.$this->team_card_designation_class.'' => 'color: {{VALUE}}',
				],
				'condition' => [
                    'template_style' => ['layout_9'],
                ],
			]
		);

		anant_typography_control(
			$this,
			[
				'name'     => 'card_heading_designation_typography',
				'selector' => '{{WRAPPER}}  .'.$this->team_card_designation_class,
			]
		);

		$this->add_responsive_control(
			'card_heading_designation_margin',
			[
				'label'     => esc_html__('Margin', 'anant-addons-for-elementor'),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .'.$this->team_card_designation_class => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->end_controls_section(); 
	}

	protected function render() {
		
		$settings = $this->get_settings_for_display();

		$show_image = $settings['show_image'];
		$show_icon = $settings['show_icon'];
		$show_title = $settings['show_title'];
		$show_designation = $settings['show_designation'];


		$title = $settings['card_title'];
		$designation = $settings['card_designation']; 
		$image_url = $settings['card_image']['url'];
		$social_icons_block = $settings['social_icons_block'];
	

		$template_style = $settings['template_style'];

		$template_path = ANANT_PATH . 'inc/templates/team/';

		switch ($template_style) {
			case 'layout_5':
				require $template_path. 'layout-5.php';
				break;
			case 'layout_7':
				require $template_path. 'layout-7.php';
				break;
			case 'layout_9':
				require $template_path. 'layout-9.php';
				break;
		}
	}
}