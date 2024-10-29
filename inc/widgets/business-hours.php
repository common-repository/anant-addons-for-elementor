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
use Elementor\Repeater;

class AnantBusinessHours extends \Elementor\Widget_Base {

	private $business_hours_card_class = 'anant-business-hours-card';
	private $business_hours_feature_inner_class = 'anant-business-hours-feature-inner';
	private $business_hours_header_title_class = 'anant-business-hours-header-title-card';
	private $business_hours_header_text_class = 'anant-business-hours-header-text-card';
	private $business_hours_header_class = 'anant-business-hours-card-header';
	private $business_hours_footer_text_class = 'anant-business-hours-footer-text-card';
	private $business_hours_footer_class = 'anant-business-hours-card-footer';
	private $business_hours_feature_separator_class = 'anant-business-hours-feature-separator';
	private $business_hours_feature_class = 'anant-business-hours-card-feature';

	public function get_name() {
		return 'anant-business-hours';
	}

	public function get_title() {
		return __( 'Business Hours', 'anant-addons-for-elementor' );
	}

	public function get_categories() {
		return [ 'anant-elements' ];
	}

	public function get_icon() {
		return 'ant-icon eicon-table-of-contents';
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
		return ['business hours',
				'opening closing hours', 
				'anant eddons',
				'',
				'closing',
				'opening',
				'currently',
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
					'layout_2'      => esc_html__( 'Layout 2 (Pro)', 'anant-addons-for-elementor' ), 
					'layout_3'      => esc_html__( 'Layout 3 (Pro)', 'anant-addons-for-elementor' ),
					'layout_4'      => esc_html__( 'Layout 4 (Pro)', 'anant-addons-for-elementor' ), 
				],
			]
		);

		$this->add_control(
			'anant_business_hours_pro_notice',
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
			'card_title', [
				'label' => __( 'Header Title', 'anant-addons-for-elementor' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => __( 'Business Hours' , 'anant-addons-for-elementor' ),
				'label_block' => true,
			]
		);

		$this->add_control(
			'header_description', [
				'label' => __( 'Header Description', 'anant-addons-for-elementor' ),
				'type' => \Elementor\Controls_Manager::TEXTAREA,
				'default' => __( 'Aenean ut turpis blandit eros ' , 'anant-addons-for-elementor' ),
				'label_block' => true,
				'conditions' => [
					'relation' => 'and',
					'terms'    => [
						[
							'name'     => 'template_style',
							'operator' => '===',
							'value'    => 'layout_1',
						], 
					],
				],
			]
		);

		$this->add_control(
			'footer_description', [
				'label' => __( 'Footer Description', 'anant-addons-for-elementor' ),
				'type' => \Elementor\Controls_Manager::TEXTAREA,
				'default' => __( 'Achievement will mechanically come searching out you ' , 'anant-addons-for-elementor' ),
				'label_block' => true,
			]
		);

		$this->end_controls_section();
		
		$this->start_controls_section(
			'business_hours_section',
			[
				'label' => __( 'Business Hours', 'anant-addons-for-elementor' ),
				'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);
		
	    $repeater = new Repeater();

        $repeater->add_control(
			'business_hours_title', 
			[
				'label' => __('Title', 'anant-addons-for-elementor') , 
				'type' => Controls_Manager::TEXT, 
				'label_block' => true,  
			]
		);

        $repeater->add_control(
			'business_hours_text',
			[
				'label' => __( 'Text', 'anant-addons-for-elementor' ),
				'type' => \Elementor\Controls_Manager::TEXT,  
			],
		);
        
		$this->add_control(
		'business_hours_block', 
		[
			'label' => __('Add Features', 'anant-addons-for-elementor') , 
			'type' => Controls_Manager::REPEATER, 
			'fields' => $repeater->get_controls() , 
			'default' => [
				[
					'business_hours_title' => __('Monday', 'anant-addons-for-elementor') ,
					'business_hours_text' => __('10:00am -07:00pm','anant-addons-for-elementor') 
				],
				[
					'business_hours_title' => __('Tuseday', 'anant-addons-for-elementor') ,
					'business_hours_text' => __('10:00am -07:00pm','anant-addons-for-elementor') 
				],
				[
					'business_hours_title' => __('Wednesday', 'anant-addons-for-elementor') ,
					'business_hours_text' => __('10:00am -07:00pm','anant-addons-for-elementor') 
				],
				[
					'business_hours_title' => __('Thursday', 'anant-addons-for-elementor') ,
					'business_hours_text' => __('10:00am -07:00pm','anant-addons-for-elementor') 
				],
				[
					'business_hours_title' => __('Friday', 'anant-addons-for-elementor') ,
					'business_hours_text' => __('10:00am -07:00pm','anant-addons-for-elementor') 
				],
				[
					'business_hours_title' => __('Saturday', 'anant-addons-for-elementor') ,
					'business_hours_text' => __('10:00am -03:00pm','anant-addons-for-elementor') 
				],
				[
					'business_hours_title' => __('Sunday', 'anant-addons-for-elementor') ,
					'business_hours_text' => __('Closed','anant-addons-for-elementor') 
				],
			], 
			'title_field' => '{{{ business_hours_title }}}', 
		]
	);
		$this->end_controls_section();

		$this->start_controls_section(
			'settings_section',
			[
				'label' => __( 'Settings', 'anant-addons-for-elementor' ),
				'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);

		$this->add_control(
			'show_header_title',
			[
				'label' => __( 'Show Header Title', 'anant-addons-for-elementor' ),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'label_on' => __( 'Show', 'anant-addons-for-elementor' ),
				'label_off' => __( 'Hide', 'anant-addons-for-elementor' ),
				'return_value' => 'yes',
				'default' => 'yes',
			]
		);
		
		$this->add_control(
			'show_header_text',
			[
				'label' => __( 'Show Header Text', 'anant-addons-for-elementor' ),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'label_on' => __( 'Show', 'anant-addons-for-elementor' ),
				'label_off' => __( 'Hide', 'anant-addons-for-elementor' ),
				'return_value' => 'yes',
				'default' => 'yes',
				'conditions' => [
					'relation' => 'and',
					'terms'    => [
						[
							'name'     => 'template_style',
							'operator' => '===',
							'value'    => 'layout_1',
						],
					],
				],
			]
		);
		$this->add_control(
			'show_feature',
			[
				'label' => __( 'Show Features', 'anant-addons-for-elementor' ),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'label_on' => __( 'Show', 'anant-addons-for-elementor' ),
				'label_off' => __( 'Hide', 'anant-addons-for-elementor' ),
				'return_value' => 'yes',
				'default' => 'yes',
			]
		);

		$this->add_control(
			'show_footer_text',
			[
				'label' => __( 'Show Footer Text', 'anant-addons-for-elementor' ),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'label_on' => __( 'Show', 'anant-addons-for-elementor' ),
				'label_off' => __( 'Hide', 'anant-addons-for-elementor' ),
				'return_value' => 'yes',
				'default' => 'yes',
			]
		);
		$this->end_controls_section();

		anant_pro_promotion_controls($this);

		//STYLE
		$this->start_controls_section(
			'business_hours_settings',
			[
				'label' => __( 'Business Hours Settings', 'anant-addons-for-elementor' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'card_bg_color',
			[
				'label'     => __( 'Background Color', 'anant-addons-for-elementor' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}}  .'.$this->business_hours_card_class => 'background-color: {{VALUE}}',
				],
			]
		);

		anant_border_control(
			$this,
			[
				'name'     => 'card_border_type',
				'label'    => 'Border Type',
				'selector' => '{{WRAPPER}} .'.$this->business_hours_card_class,
			]
		);

		anant_border_radius_control(
			$this,
			[
				'key'       => 'card_border_radius',
				'label'     => 'Border Radius',
				'selectors' => [
					'{{WRAPPER}} .'.$this->business_hours_card_class => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
					'{{WRAPPER}} .'.$this->business_hours_card_class => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					'{{WRAPPER}} .'.$this->business_hours_card_class.' .overlay' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
					'{{WRAPPER}} .'.$this->business_hours_card_class => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		anant_box_shadow_control(
			$this,
			[
				'key'      => 'card_box_shadow',
				'label'    => 'Box Shadow',
				'selector' => '{{WRAPPER}}  .'.$this->business_hours_card_class,
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'header_settings',
			[
				'label' => __( 'Header Settings', 'anant-addons-for-elementor' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'card_header_bg_color',
			[
				'label'     => __( 'Background Color', 'anant-addons-for-elementor' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}}  .'.$this->business_hours_header_class => 'background-color: {{VALUE}}',
				],
			]
		);
		
		$this->add_responsive_control(
			'card_header_padding',
			[
				'label'     => esc_html__('Padding', 'anant-addons-for-elementor'),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .'.$this->business_hours_header_class => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'card_header_title',
			[
				'label' => __( 'Header Title Setting', 'anant-addons-for-elementor' ),
				'tab'   => Controls_Manager::TAB_STYLE, 
			]
		);
		
		$this->add_responsive_control(
			'card_header_title_alignment',
			[
				'label'     => __( 'Title Alignment', 'anant-addons-for-elementor' ),
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
					'{{WRAPPER}} .'.$this->business_hours_header_title_class => 'text-align: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'card_header_title_color',
			[
				'label'     => __( 'Title Color', 'anant-addons-for-elementor' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}}  .'.$this->business_hours_header_title_class => 'color: {{VALUE}}',
				],
			]
		);

		anant_typography_control(
			$this,
			[
				'name'     => 'card_header_title_typography',
				'label'    => 'Title Typography',
				'selector' => '{{WRAPPER}}  .'.$this->business_hours_header_title_class,
			]
		);
	
		$this->add_responsive_control(
			'card_header_title_space',
			[
				'label'           => __( 'Space', 'anant-addons-for-elementor' ),
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
					'{{WRAPPER}} .'.$this->business_hours_header_title_class => 'margin-bottom: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'card_header_text',
			[
				'label' => __( 'Header Description', 'anant-addons-for-elementor' ),
				'tab'   => Controls_Manager::TAB_STYLE,
				'conditions' => [
					'relation' => 'and',
					'terms'    => [
						[
							'name'     => 'template_style',
							'operator' => '===',
							'value'    => 'layout_1',
						], 
					],
				],
			]
		);
		
		$this->add_responsive_control(
			'card_header_text_alignment',
			[
				'label'     => __( 'Description Alignment', 'anant-addons-for-elementor' ),
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
					'{{WRAPPER}} .'.$this->business_hours_header_text_class => 'text-align: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'card_header_text_color',
			[
				'label'     => __( 'Description Color', 'anant-addons-for-elementor' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}}  .'.$this->business_hours_header_text_class => 'color: {{VALUE}}',
				],
			]
		);

		anant_typography_control(
			$this,
			[
				'name'     => 'card_header_text_typography',
				'label'    => 'Description Typography',
				'selector' => '{{WRAPPER}}  .'.$this->business_hours_header_text_class,
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'business_hours_feature',
			[
				'label' => __( 'Feature Setting', 'anant-addons-for-elementor' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'business_hours_bg_color',
			[
				'label'     => __( 'Background Color', 'anant-addons-for-elementor' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}}  .'.$this->business_hours_feature_class => 'background-color: {{VALUE}}',
				],
			]
		);
		
		$this->add_responsive_control(
			'card_feature_padding',
			[
				'label'     => esc_html__('Box Padding', 'anant-addons-for-elementor'),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .'.$this->business_hours_feature_class => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'card_feature_margin',
			[
				'label'     => esc_html__('Box Margin', 'anant-addons-for-elementor'),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .'.$this->business_hours_feature_class => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'business_hours_feature_list',
			[
				'label' => __( 'Feature List Setting', 'anant-addons-for-elementor' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);
		
		$this->add_control(
			'feature_list_title_color',
			[
				'label'     => __( 'Title Color', 'anant-addons-for-elementor' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}}  .'.$this->business_hours_feature_inner_class.' .feature_title' => 'color: {{VALUE}}',
				],
			]
		);
		
		anant_typography_control(
			$this,
			[
				'name'     => 'feature_list_title_typography',
				'label'    => 'Typography',
				'selector' => '{{WRAPPER}}  .'.$this->business_hours_feature_inner_class.' .feature_title',
			]
		);

		$this->add_control('feature_list_title_divider',['type' => \Elementor\Controls_Manager::DIVIDER,]);

		$this->add_control(
			'feature_list_text_color',
			[
				'label'     => __( 'Text Color', 'anant-addons-for-elementor' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .'.$this->business_hours_feature_inner_class.' .feature_hours' => 'color: {{VALUE}}',
				],
			]
		);

		anant_typography_control(
			$this,
			[
				'name'     => 'feature_list_text_typography',
				'label'    => 'Typography',
				'selector' => '{{WRAPPER}}  .'.$this->business_hours_feature_inner_class.' .feature_hours',
			]
		);

		$this->add_control('feature_list_text_divider',['type' => \Elementor\Controls_Manager::DIVIDER,]);

		$this->add_responsive_control(
			'feature_list_padding',
			[
				'label'     => esc_html__('Padding', 'anant-addons-for-elementor'),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .'.$this->business_hours_feature_inner_class => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'feature_list_margin',
			[
				'label'     => esc_html__('Margin', 'anant-addons-for-elementor'),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .'.$this->business_hours_feature_inner_class => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'feature_separator',
			[
				'label' => __( 'Feature Separator', 'anant-addons-for-elementor' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);
		
		$this->add_responsive_control(
			'feature_separator_style',
			[
				'label'       => esc_html__( 'Separator Style', 'anant-addons-for-elementor' ),
				'placeholder' => esc_html__( 'Choose Template from Here', 'anant-addons-for-elementor' ),
				'type'        => \Elementor\Controls_Manager::SELECT,
				'default'     => 'default',
				'options'     => [
					'default'      => esc_html__( 'Default' ),
					'solid'      => esc_html__( 'Solid' ),
					'dotted'      => esc_html__( 'Dotted' ),
					'dashed'      => esc_html__( 'Dashed' ),
					'none'      => esc_html__( 'None' ),
				],
				'selectors' => [
					'{{WRAPPER}} .'.$this->business_hours_feature_separator_class => 'border-style:{{VALUE}};',
				],
			]
		);

		$this->add_responsive_control(
			'feature_separator_height',
			[
				'label'           => __( 'Separator Width', 'anant-addons-for-elementor' ),
				'type'            => Controls_Manager::SLIDER,
				'size_units'      => [ 'px', '%' ],
				'range'           => [
					'px' => [
						'min' => 0,
						'max' => 20,
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
					'{{WRAPPER}} .'.$this->business_hours_feature_separator_class => 'border-bottom-width: {{SIZE}}{{UNIT}};',
				],
				'conditions' => [
					'relation' => 'and',
					'terms'    => [
						[
							'name'     => 'feature_separator_style',
							'operator' => '!==',
							'value'    => 'default',
						],
						[
							'name'     => 'feature_separator_style',
							'operator' => '!==',
							'value'    => 'none',
						],
					],
				],
			]
		);

		$this->add_control(
			'feature_separator_color',
			[
				'label'     => __( 'Separator Color', 'anant-addons-for-elementor' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .'.$this->business_hours_feature_separator_class => 'border-color: {{VALUE}}',
				],
				'conditions' => [
					'relation' => 'and',
					'terms'    => [
						[
							'name'     => 'feature_separator_style',
							'operator' => '!==',
							'value'    => 'default',
						],
						[
							'name'     => 'feature_separator_style',
							'operator' => '!==',
							'value'    => 'none',
						],
					],
				],
			]
		);

		$this->add_responsive_control(
			'feature_separator_margin',
			[
				'label'     => esc_html__('Margin', 'anant-addons-for-elementor'),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .'.$this->business_hours_feature_separator_class => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'footer_settings',
			[
				'label' => __( 'Footer Description', 'anant-addons-for-elementor' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_responsive_control(
			'card_footer_text_alignment',
			[
				'label'     => __( 'Description Alignment', 'anant-addons-for-elementor' ),
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
					'{{WRAPPER}} .'.$this->business_hours_footer_text_class => 'text-align: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'card_footer_bg_color',
			[
				'label'     => __( 'Background Color', 'anant-addons-for-elementor' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}}  .'.$this->business_hours_footer_class => 'background-color: {{VALUE}}',
				],
			]
		);

		$this->add_responsive_control(
			'card_footer_padding',
			[
				'label'     => esc_html__('Padding', 'anant-addons-for-elementor'),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .'.$this->business_hours_footer_class => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_control('footer_section_divider',['type' => \Elementor\Controls_Manager::DIVIDER,]);

		$this->add_control(
			'card_footer_text_color',
			[
				'label'     => __( 'Description Color', 'anant-addons-for-elementor' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}}  .'.$this->business_hours_footer_text_class => 'color: {{VALUE}}',
				],
			]
		);

		anant_typography_control(
			$this,
			[
				'name'     => 'card_footer_text_typography',
				'label'    => 'Description Typography',
				'selector' => '{{WRAPPER}}  .'.$this->business_hours_footer_text_class,
			]
		);

		$this->end_controls_section();

	}



	protected function render() {
		$settings = $this->get_settings_for_display();

		$show_feature = $settings['show_feature'];
		$show_header_text = $settings['show_header_text'];
		$show_footer_text = $settings['show_footer_text'];
		$show_header_title = $settings['show_header_title'];

		$header_title = $settings['card_title'];
		$header_text = $settings['header_description'];  
		$business_hours_block = $settings['business_hours_block'];
		$footer_text = $settings['footer_description'];

		$template_style = $settings['template_style'];
		if ($template_style == 'layout_1') {
			?>
			<div class="business_hours_one <?php echo esc_attr($this->business_hours_card_class) ?>">
				<?php if ( ( $show_header_title === 'yes' ) || ( $show_header_text === 'yes' )) { ?>
				<div class="header_content <?php echo esc_attr($this->business_hours_header_class) ?>">
					<?php
					if ( $show_header_title === 'yes' ) {
						?>
							<h3 class="title <?php echo esc_attr($this->business_hours_header_title_class) ?>"><?php echo esc_html($header_title )?></h3>
						<?php
					}
					?>
					<?php
					if ( $show_header_text === 'yes' ) {
						?>
							<p class="header_text <?php echo esc_attr($this->business_hours_header_text_class) ?>"><?php echo esc_html($header_text )?></p>
						<?php
					}
					?>
				</div>
				<?php } ?>
				<div class="feature_content <?php echo esc_attr($this->business_hours_feature_class) ?>">
				<?php
					if ( $show_feature === 'yes' ) {
						
						if (isset($business_hours_block) && !empty($business_hours_block))
						{
							foreach ($business_hours_block as $key => $title_block)
							{
								$text_block = $title_block['business_hours_text'];
								
								?>
								<div class=" feature_list <?php echo esc_attr($this->business_hours_feature_inner_class ); ?>" > 
									<div class="feature_title"><?php echo esc_html($title_block['business_hours_title']) ;?></div>
									<div class="feature_hours"><?php echo esc_html($title_block['business_hours_text']) ;?></div>
								</div>
								<div class="separator">
										<div class="list_separator <?php echo esc_attr($this->business_hours_feature_separator_class) ?>"></div>
									</div>
								<?php
							}
						} 
					}
				?>
				
				</div>
				<?php
				if ( $show_footer_text === 'yes' ) {
					?>
						<div class="footer_content <?php echo esc_attr($this->business_hours_footer_class) ?>">
							<p class="footer_text <?php echo esc_attr($this->business_hours_footer_text_class) ?>"><?php echo esc_html($footer_text )?></p>
						</div>
					<?php
				}
				?>
			</div>
			<?php
			}
	}
}