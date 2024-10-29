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

class AnantFlipbox extends \Elementor\Widget_Base {

	private $flip_card_class = 'anant-flip-box';
	private $flip_card_inner_class = 'anant-flip-box-inner';
	private $flip_front_class = 'anant-flip-box-front-class';
	private $flip_back_class = 'anant-flip-box-back-class';
	private $flip_icon_class = 'anant-flip-box-icon';
	private $flip_title_class = 'anant-flip-box-title';
	private $flip_desc_class = 'anant-flip-box-description';
	private $flip_btn_class = 'anant-flip-box-button';

	public function get_name() {
		return 'anant-flip';
	}

	public function get_title() {
		return __( 'Flip Box', 'anant-addons-for-elementor' );
	}

	public function get_categories() {
		return [ 'anant-elements' ];
	}

	public function get_icon() {
		return 'ant-icon eicon-flip-box';
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
		return ['flip box',
				'box', 
				'flip', 
				'3d box',
				'2d',
				'',
				'anant addons'
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
				],
			]
		); 

		$this->add_control(
			'anant_flip_box_pro_notice',
			[
				'raw' => 'Only Available in <a href="https://anantaddons.com/" target="_blank">Pro Version!</a>',
				'type' => \Elementor\Controls_Manager::RAW_HTML,
				'content_classes' => 'anant-pro-notice',
				'condition' => [
                    'template_style!' => ['layout_1'],
                ],
			]
		);

		$this->start_controls_tabs( 'content_tabs' );

		$this->start_controls_tab(
			'content_normal_style',
			[
				'label' => __( 'Front', 'anant-addons-for-elementor' ),
			]
		);
		
		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name'      => 'front_card_bg_image',
				'types'     => [ 'classic' ],
				'fields_options' => [
					'background' => [
						'label'     => __( 'Choose Background Image', 'anant-addons-for-elementor' ),
						'default' => 'classic',
					],
				],
				'selector'  => '{{WRAPPER}} .'.$this->flip_front_class,
			]
		);

		$this->add_control(
			'front_card_icon',
			[
				'label' => __( 'Icon', 'anant-addons-for-elementor' ),
				'type' => \Elementor\Controls_Manager::ICONS,
				'default' => [
					'value' => 'fa fa-star',
					'library' => 'solid',
				],
			]
		);

		$this->add_control(
			'front_card_title', [
				'label' => __( 'Title', 'anant-addons-for-elementor' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => __( 'Front Title' , 'anant-addons-for-elementor' ),
				'label_block' => true,
			]
		);

		$this->add_control(
			'front_card_description',
			[
				'label' => __( 'Description', 'anant-addons-for-elementor' ),
				'type' => \Elementor\Controls_Manager::TEXTAREA, 
				'row'  => 5,
				'default' => __('Aenean ut turpis blandit eros convallis congue sit amet a libero', 'anant-addons-for-elementor' ),
				'placeholder' => __( 'Type your description here', 'anant-addons-for-elementor' ),
			]
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
			'content_style_hover',
			[
				'label' => __( 'Back', 'anant-addons-for-elementor' ),

			]
		);

		$this->add_control(
			'back_card_link_text', [
				'label' => __( 'Button Text', 'anant-addons-for-elementor' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => __( 'Read More' , 'anant-addons-for-elementor' ),
				'label_block' => true,
			]
		);

		$this->add_control(
			'back_card_link',
			[
				'label' => __( 'Button Link', 'anant-addons-for-elementor' ),
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
			'back_button_position',
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
		$this->add_control(
			'back_button_icon',
			[
				'label' => __( 'Button Icon', 'anant-addons-for-elementor' ),
				'type' => \Elementor\Controls_Manager::ICONS,
			]
		);

		$this->add_responsive_control(
			'back_button_space_before',
			[
				'label'           => __( 'Icon Spacing', 'anant-addons-for-elementor' ),
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
					'{{WRAPPER}} .'.$this->flip_btn_class.' i' => 'margin-right: {{SIZE}}{{UNIT}};',
				], 
				'conditions' => [
					'relation' => 'and',
					'terms'    => [
						[
							'name'     => 'back_button_position',
							'operator' => '!==',
							'value'    => 'after',
						],
					],
				],
			],
		);

		$this->add_responsive_control(
			'back_button_space_after',
			[
				'label'           => __( 'Icon Spacing', 'anant-addons-for-elementor' ),
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
					'{{WRAPPER}} .'.$this->flip_btn_class.' i' => 'margin-left: {{SIZE}}{{UNIT}};',
				],
				'conditions' => [
					'relation' => 'and',
					'terms'    => [
						[
							'name'     => 'back_button_position',
							'operator' => '!==',
							'value'    => 'before',
						],
					],
				],
			]
		);

		$this->end_controls_tab();
		$this->end_controls_tabs();
		$this->end_controls_section();
		
		$this->start_controls_section(
			'settings_section',
			[
				'label' => __( 'Settings', 'anant-addons-for-elementor' ),
				'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);

		$this->add_control(
			'show_icon',
			[
				'label' => __( 'Show Icon', 'anant-addons-for-elementor' ),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'label_on' => __( 'Show', 'anant-addons-for-elementor' ),
				'label_off' => __( 'Hide', 'anant-addons-for-elementor' ),
				'return_value' => 'yes',
				'default' => 'yes',
			]
		);  
		
		$this->add_control(
			'show_title',
			[
				'label' => __( 'Show Title', 'anant-addons-for-elementor' ),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'label_on' => __( 'Show', 'anant-addons-for-elementor' ),
				'label_off' => __( 'Hide', 'anant-addons-for-elementor' ),
				'return_value' => 'yes',
				'default' => 'yes',
			]
		);  
		
		$this->add_control(
			'show_desc',
			[
				'label' => __( 'Show Description', 'anant-addons-for-elementor' ),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'label_on' => __( 'Show', 'anant-addons-for-elementor' ),
				'label_off' => __( 'Hide', 'anant-addons-for-elementor' ),
				'return_value' => 'yes',
				'default' => 'yes',
			]
		);  
		$this->add_control(
			'show_btn',
			[
				'label' => __( 'Show Button', 'anant-addons-for-elementor' ),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'label_on' => __( 'Show', 'anant-addons-for-elementor' ),
				'label_off' => __( 'Hide', 'anant-addons-for-elementor' ),
				'return_value' => 'yes',
				'default' => 'yes',
			]
		);  

		$this->end_controls_section();

		$this->start_controls_section(
			'flip_box_settings',
			[
				'label' => __( 'Flip Settings', 'anant-addons-for-elementor' ),
				'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);

		$this->add_control(
			'flip_style',
			[
				'label'       => esc_html__( 'Flip Effect', 'anant-addons-for-elementor' ),
				'placeholder' => esc_html__( 'Choose Effect from Here', 'anant-addons-for-elementor' ),
				'type'        => \Elementor\Controls_Manager::SELECT,
				'default'     => 'flip',
				'options'     => [
					'flip'      => esc_html__( 'Flip', 'anant-addons-for-elementor' ),
					'slide'      => esc_html__( 'Slide', 'anant-addons-for-elementor' ), 
					'push'      => esc_html__( 'Push (Pro)', 'anant-addons-for-elementor' ),
					'zoom-in'      => esc_html__( 'Zoom In (Pro)', 'anant-addons-for-elementor' ), 
					'zoom-out'      => esc_html__( 'Zoom Out (Pro)', 'anant-addons-for-elementor' ), 
					'fade'      => esc_html__( 'Fade (Pro)', 'anant-addons-for-elementor' ), 
				],
				'prefix_class' => 'anant-flip-box-effect-',
			]
		);

		$this->add_control(
			'anant_flip_effect_pro_notice',
			[
				'raw' => 'Only Available in <a href="https://anantaddons.com/" target="_blank">Pro Version!</a>',
				'type' => \Elementor\Controls_Manager::RAW_HTML,
				'content_classes' => 'anant-pro-notice',
				'condition' => [
                    'flip_style!' => ['flip', 'slide'],
                ],
			]
		);
		
		$this->add_control(
			'flip_direction',
			[
				'label'       => esc_html__( 'Direction', 'anant-addons-for-elementor' ),
				'placeholder' => esc_html__( 'Choose Direction from Here', 'anant-addons-for-elementor' ),
				'type'        => \Elementor\Controls_Manager::SELECT,
				'default'     => 'right',
				'options'     => [
					'up'      => esc_html__( 'Up', 'anant-addons-for-elementor' ),
					'right'      => esc_html__( 'Right', 'anant-addons-for-elementor' ), 
					'down'      => esc_html__( 'Down', 'anant-addons-for-elementor' ),
					'left'      => esc_html__( 'Left', 'anant-addons-for-elementor' ),  
				],
				'prefix_class' => 'anant-flip-box-direction-',
			]
		);
		$this->add_control(
			'flip_3d_effect',
			[
				'label' => __( '3D Depth', 'anant-addons-for-elementor' ),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'label_on' => __( 'Yes', 'anant-addons-for-elementor' ),
				'label_off' => __( 'No', 'anant-addons-for-elementor' ),
				'return_value' => 'yes',
				'default' => '',
				'condition' => [
					'flip_style' => 'flip'
				],
			]
		);  
		
		$this->end_controls_section();

		anant_pro_promotion_controls($this);

		//STYLE
		$this->start_controls_section(
			'flip_settings',
			[
				'label' => __( 'Flip Box Settings', 'anant-addons-for-elementor' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'card_front_heading',
			[
				'label' => esc_html__( 'Front', 'anant-addons-for-elementor' ),
				'type' => \Elementor\Controls_Manager::HEADING,
			]
		);

		$this->add_control(
			'card_bg_color',
			[
				'label'     => __( 'Background Color', 'anant-addons-for-elementor' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}}  .'.$this->flip_front_class.':before' => 'background-color: {{VALUE}}',
					'{{WRAPPER}}  .'.$this->flip_back_class.':before' => 'background-color: {{VALUE}}',
				],
			]
		); 

		$this->add_responsive_control(
			'card_overlay_opacity',
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
					'{{WRAPPER}}  .'.$this->flip_front_class.':before' => 'opacity: {{SIZE}};',
				]
			]
		);

		$this->add_control(
			'card_back_heading',
			[
				'label' => esc_html__( 'Back', 'anant-addons-for-elementor' ),
				'type' => \Elementor\Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);

		$this->add_control(
			'card_bg_color_hover',
			[
				'label'     => __( 'Background Color', 'anant-addons-for-elementor' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}}  .'.$this->flip_back_class => 'background-color: {{VALUE}}',
				],
			]
		);

		$this->add_control(
			'filp_content_position',
			[
				'label' => __('Content Position', 'anant-addons-for-elementor') , 
				'type' => Controls_Manager::CHOOSE, 
				'options' => [
					'flex-start' => [
						'title' => esc_html__( 'Top', 'anant-addons-for-elementor' ),
						'icon' => 'eicon-v-align-top',
					],
					'center' => [
						'title' => esc_html__( 'Middle', 'anant-addons-for-elementor' ),
						'icon' => 'eicon-v-align-middle',
					],
					'flex-end' => [
						'title' => esc_html__( 'Bottom', 'anant-addons-for-elementor' ),
						'icon' => 'eicon-v-align-bottom',
					],
				],
				'separator' => 'before',
				'selectors' => [
					'{{WRAPPER}} .'.$this->flip_front_class => 'justify-content: {{VALUE}};', 
					'{{WRAPPER}} .'.$this->flip_back_class => 'justify-content: {{VALUE}};', 
				],
			]
		);

		anant_border_control(
			$this,
			[
				'name'     => 'card_border_type',
				'label'    => 'Border Type',
				'selector' => '{{WRAPPER}}  .'.$this->flip_front_class.', {{WRAPPER}}  .'.$this->flip_back_class,
			]
		);

		anant_border_radius_control(
			$this,
			[
				'key'       => 'card_border_radius',
				'label'     => 'Border Radius',
				'selectors' => [
					'{{WRAPPER}} .'.$this->flip_front_class => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					'{{WRAPPER}} .'.$this->flip_front_class.':before' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					'{{WRAPPER}} .'.$this->flip_back_class => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					'{{WRAPPER}} .'.$this->flip_back_class.':before' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
					'{{WRAPPER}} .'.$this->flip_front_class => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					'{{WRAPPER}} .'.$this->flip_back_class => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
					'{{WRAPPER}} .'.$this->flip_front_class => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					'{{WRAPPER}} .'.$this->flip_back_class => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		anant_box_shadow_control(
			$this,
			[
				'key'      => 'card_box_shadow',
				'label'    => 'Box Shadow',
				'selector' => '{{WRAPPER}}  .'.$this->flip_front_class.', {{WRAPPER}}  .'.$this->flip_back_class,
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'flip_box_icon_settings',
			[
				'label' => __( 'Icon Settings', 'anant-addons-for-elementor' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);
	
		$slug = 'flip_box_icon';

		$this->add_responsive_control(
			$slug.'_alignment',
			[
				'label'     => __( 'Alignment', 'anant-addons-for-elementor' ),
				'type'      => Controls_Manager::CHOOSE,
				'options'   => [
					'flex-start' => [
						'title' => __( 'Left', 'anant-addons-for-elementor' ),
						'icon'  => 'eicon-text-align-left',
					],
					'center' => [
						'title' => __( 'Center', 'anant-addons-for-elementor' ),
						'icon'  => 'eicon-text-align-center',
					],
					'flex-end' => [
						'title' => __( 'Right', 'anant-addons-for-elementor' ),
						'icon'  => 'eicon-text-align-right',
					],
				],
				'toggle'    => true,
				'selectors' => [
					'{{WRAPPER}} .'.$this->flip_icon_class => 'justify-content: {{VALUE}};',
					
				]
			],
		); 
		
		$this->add_control(
			$slug.'_color',
			[
				'label'     => __( 'Color', 'anant-addons-for-elementor' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}}  .'.$this->flip_icon_class.'' => 'color: {{VALUE}}',
					'{{WRAPPER}}  .'.$this->flip_icon_class.' svg' => 'fill: {{VALUE}}',
				],
			]
		);

		// $this->add_responsive_control(
		// 	$slug.'_icon_width',
		// 	[
		// 		'label'           => __( 'Icon Width', 'anant-addons-for-elementor' ),
		// 		'type'            => Controls_Manager::SLIDER,
		// 		'size_units'      => [ 'px', '%' ],
		// 		'range'           => [
		// 			'px' => [
		// 				'min' => 0,
		// 				'max' => 150,
		// 			],
		// 			'%' => [
		// 				'min' => 0,
		// 				'max' => 100,
		// 			],
		// 		],
		// 		'devices'         => [ 'desktop', 'tablet', 'mobile' ],
		// 		'desktop_default' => [
		// 			'size' => '',
		// 			'unit' => 'px',
		// 		],
		// 		'tablet_default'  => [
		// 			'size' => '',
		// 			'unit' => 'px',
		// 		],
		// 		'mobile_default'  => [
		// 			'size' => '',
		// 			'unit' => 'px',
		// 		],
		// 		'selectors'       => [
		// 			'{{WRAPPER}} .'.$this->flip_icon_class.'' => 'width: {{SIZE}}{{UNIT}};height: {{SIZE}}{{UNIT}};',
		// 		],
		// 	]
		// );

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
					'{{WRAPPER}} .'.$this->flip_icon_class.' i' => 'font-size: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .'.$this->flip_icon_class.' svg' => 'width: {{SIZE}}{{UNIT}};height: {{SIZE}}{{UNIT}};',
				],
			]
		);
		
		anant_border_control(
			$this,
			[
				'name'     => $slug.'_border_type',
				'label'    => 'Border Type',
				'selector' => '{{WRAPPER}} .'.$this->flip_icon_class.'',
			]
		);

		anant_border_radius_control(
			$this,
			[
				'key'       => $slug.'_border_radius',
				'label'     => 'Border Radius',
				'selectors' => [
					'{{WRAPPER}} .'.$this->flip_icon_class.'' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
					'{{WRAPPER}} .'.$this->flip_icon_class.'' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->end_controls_section();

		// flip box Title
		$this->start_controls_section(
			'flip_box_title_settings',
			[
				'label' => __( 'Title ', 'anant-addons-for-elementor' ),
				'tab'   => Controls_Manager::TAB_STYLE,  
				'condition' => [ 
					'show_title' => 'yes',
				],
			]
		);

		$slug = 'flip_box_title';

		$this->add_responsive_control(
			$slug.'_alignment',
			[
				'label'     => __( 'Alignment', 'anant-addons-for-elementor' ),
				'type'      => Controls_Manager::CHOOSE,
				'options'   => [
					'left' => [
						'title' => __( 'flex-start', 'anant-addons-for-elementor' ),
						'icon'  => 'eicon-text-align-left',
					],
					'center' => [
						'title' => __( 'Center', 'anant-addons-for-elementor' ),
						'icon'  => 'eicon-text-align-center',
					],
					'right' => [
						'title' => __( 'flex-end', 'anant-addons-for-elementor' ),
						'icon'  => 'eicon-text-align-right',
					],
				],
				'toggle'    => true,
				'selectors' => [
					'{{WRAPPER}} .'.$this->flip_front_class.' .ant-heading, .'.$this->flip_back_class.' .ant-heading' => 'justify-content: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			$slug.'_color',
			[
				'label'     => __( 'Color', 'anant-addons-for-elementor' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}}  .'.$this->flip_front_class.' .'.$this->flip_title_class => 'color: {{VALUE}}',
				],
			]
		);

		anant_typography_control(
			$this,
			[
				'name'     => $slug.'_typography',
				'label'    => 'Typography',
				'selector' => '{{WRAPPER}}  .'.$this->flip_front_class.' .'.$this->flip_title_class,
			]
		);

		$this->add_responsive_control(
			$slug.'_margin',
			[
				'label'     => esc_html__('Margin', 'anant-addons-for-elementor'),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .'.$this->flip_front_class.' .'.$this->flip_title_class => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->end_controls_section();
		
		// flip box desc
		$this->start_controls_section(
			'flip_box_desc_settings',
			[
				'label' => __( 'Description ', 'anant-addons-for-elementor' ),
				'tab'   => Controls_Manager::TAB_STYLE,   
			]
		);
		
		$slug = 'flip_box_desc';
		$this->add_responsive_control(
			$slug.'_alignment',
			[
				'label'     => __( 'Alignment', 'anant-addons-for-elementor' ),
				'type'      => Controls_Manager::CHOOSE,
				'options'   => [
					'left' => [
						'title' => __( 'Left', 'anant-addons-for-elementor' ),
						'icon'  => 'eicon-text-align-left',
					],
					'center' => [
						'title' => __( 'Center', 'anant-addons-for-elementor' ),
						'icon'  => 'eicon-text-align-center',
					],
					'right' => [
						'title' => __( 'Right', 'anant-addons-for-elementor' ),
						'icon'  => 'eicon-text-align-right',
					],
				],
				'toggle'    => true,
				'selectors' => [
					'{{WRAPPER}} .'.$this->flip_desc_class => 'text-align: {{VALUE}};',
				],
			]
		);
		
		$this->add_control(
			$slug.'_color',
			[
				'label'     => __( 'Color', 'anant-addons-for-elementor' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}}  .'.$this->flip_front_class.' .'.$this->flip_desc_class => 'color: {{VALUE}}',
				],
			]
		);

		anant_typography_control(
			$this,
			[
				'name'     => $slug.'_typography',
				'label'    => 'Typography',
				'selector' => '{{WRAPPER}}  .'.$this->flip_front_class.' .'.$this->flip_desc_class,
			]
		);

		$this->add_responsive_control(
			$slug.'_margin',
			[
				'label'     => esc_html__('Margin', 'anant-addons-for-elementor'),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .'.$this->flip_front_class.' .'.$this->flip_desc_class => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->end_controls_section();

		//Dual button One Button
		$this->start_controls_section(
			'flip_box_btn_settings',
			[
				'label' => __('Button', 'anant-addons-for-elementor' ),
				'tab'   => Controls_Manager::TAB_STYLE,  
			]
		);
		
		$slug = 'flip_box_btn';
		
		anant_typography_control(
			$this,
			[
				'name'     => $slug.'_typography',
				'label'    => 'Typography',
				'selector' => '{{WRAPPER}}  .'.$this->flip_btn_class.'',
			]
		);

		anant_border_radius_control(
			$this,
			[
				'key'       => $slug.'_border_radius',
				'label'     => 'Border Radius',
				'selectors' => [
					'{{WRAPPER}} .'.$this->flip_btn_class.'' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
					'{{WRAPPER}} .'.$this->flip_btn_class.'' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
					'{{WRAPPER}} .'.$this->flip_btn_class.'' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		anant_box_shadow_control(
			$this,
			[
				'key'      => $slug.'_box_shadow',
				'label'    => 'Box Shadow',
				'selector' => '{{WRAPPER}}  .'.$this->flip_btn_class.'',
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
					'{{WRAPPER}}  .'.$this->flip_btn_class.'' => 'color: {{VALUE}}',
				],
			]
		);

		$this->add_control(
			$slug.'_bg_color',
			[
				'label'     => __( 'Background Color', 'anant-addons-for-elementor' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}}  .'.$this->flip_btn_class.'' => 'background-color: {{VALUE}}',
				],
			]
		);

		anant_border_control(
			$this,
			[
				'name'     => $slug.'_border_type',
				'label'    => 'Border Type',
				'selector' => '{{WRAPPER}} .'.$this->flip_btn_class.'',
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
					'{{WRAPPER}} .'.$this->flip_btn_class.':hover' => 'color: {{VALUE}}',
				],
			]
		);

		$this->add_control(
			$slug.'_bg_color_two_hover',
			[
				'label'     => __( 'Background Color', 'anant-addons-for-elementor' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .'.$this->flip_btn_class.':hover' => 'background-color: {{VALUE}}',
				],
			]
		);
		
		anant_border_control(
			$this,
			[
				'name'     => $slug.'_border_type_hover',
				'label'    => 'Border Type',
				'selector' => '{{WRAPPER}} .'.$this->flip_btn_class.':hover',
			]
		);

		$this->end_controls_tab();
		$this->end_controls_tabs(); 
		$this->end_controls_section();
	}

	protected function render() {
		$settings = $this->get_settings_for_display();

		$template_style = $settings['template_style'];
		
		$show_icon = $settings['show_icon'];
		$show_title = $settings['show_title'];
		$show_desc = $settings['show_desc'];
		$show_btn = $settings['show_btn'];
		
		$flip_style = $settings['flip_style'];
		if (in_array($flip_style, ['flip', 'push', 'zoom-in', 'zoom-out', 'fade'])) {
			$flip_style = 'flip';
		}

		$flip_direction = $settings['flip_direction'];
		$flip_3d_effect = $settings['flip_3d_effect'];

		$front_card_icon = $settings['front_card_icon']; 
		$front_card_title = $settings['front_card_title']; 
		$front_card_description = $settings['front_card_description']; 

		$back_link_text = $settings['back_card_link_text']; 
		$back_link_button_icon = $settings['back_button_icon'];
		$back_link_button_position = $settings['back_button_position'];
		$back_link = $settings['back_card_link']['url'];
		$back_target = $settings['back_card_link']['is_external'] ? ' target="_blank"' : '';
		$back_nofollow = $settings['back_card_link']['nofollow'] ? ' rel="nofollow"' : '';

		if ($template_style == 'layout_1') {
			?>
		<div class="flip-card one <?php echo esc_attr($this->flip_card_class) ; if($flip_3d_effect == 'yes') { echo' anant-flip-box-3d'; } ?>">
			<div class="flip-card-inner">
				<div class="flip-card-front <?php echo esc_attr($this->flip_front_class) ?>" >
					<?php if ( $show_icon === 'yes' ) { ?>
						<div class="ant-icon <?php echo esc_attr($this->flip_icon_class) ?>">
							<?php \Elementor\Icons_Manager::render_icon( $front_card_icon, [ 'aria-hidden' => 'true' ] ); ?>
						</div> 
					<?php } ?>
					<?php if ( $show_title === 'yes' ) { ?>
						<div class="ant-heading">
						<h3 class="title <?php echo esc_attr($this->flip_title_class) ?>"><?php echo esc_html($front_card_title) ?></h3> 
						</div>
					<?php } ?>
					<?php if ( $show_desc === 'yes' ) { ?>
						<div class="ant-description">
						<p class="description <?php echo esc_attr($this->flip_desc_class )?>"><?php echo esc_html($front_card_description) ?></p> 
						</div>
					<?php } ?>
				</div>
				<div class="flip-card-back <?php echo esc_attr($this->flip_back_class) ?>"> 
					<?php if ( $show_btn === 'yes' ) { ?>
					<a
						class="ant-btn <?php echo esc_attr($this->flip_btn_class )?> <?php echo $back_link_button_position === 'before' ? 'anant-no-flex': '' ?>"
						href="<?php echo esc_url($back_link) ?>"
						<?php echo $back_target ?>
						<?php echo $back_nofollow ?>>
						<?php 
							if ($back_link_button_position === 'before') {
								\Elementor\Icons_Manager::render_icon( $back_link_button_icon, [ 'aria-hidden' => 'true' ] );
							}
						?>
						<span><?php echo esc_html($back_link_text) ?></span>
						<?php 
							if ($back_link_button_position === 'after') {
								\Elementor\Icons_Manager::render_icon( $back_link_button_icon, [ 'aria-hidden' => 'true' ] );
							}
						?>
					</a>
					<?php } ?>
				</div>
			</div>
		</div>
		<?php
		}
	}
}