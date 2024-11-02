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

class Anant_Feature extends \Elementor\Widget_Base {

	private $feature_card_class = 'anant-feature-card';
	private $feature_card_inner_class = 'anant-feature-inner-card';
	private $feature_card_bg_image_class = 'anant-feature-card-bg-image';
	private $feature_card_image_class = 'anant-feature-card-image';
	private $feature_card_heading_class = 'anant-feature-card-heading';
	private $feature_card_icon_class = 'anant-feature-card-icon';
	private $feature_card_description_class = 'anant-feature-card-description';

	public function get_name() {
		return 'anant-feature';
	}

	public function get_title() {
		return esc_html__( 'Feature ', 'anant-addons-for-elementor' );
	}

	public function get_categories() {
		return [ 'anant-elements' ];
	}

	public function get_icon() {
		return 'ant-icon eicon-icon-box';
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
				'info box', 
				'icon box', 
				'feature service', 
				'feature', 
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
					'layout_10'      => esc_html__( 'Layout 10 (Pro)', 'anant-addons-for-elementor' ),
				],
			]
		);

		$this->add_control(
			'anant_feature_pro_notice',
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
			'card_bg_image',
			[
				'label'   => esc_html__( 'Choose Background Image', 'anant-addons-for-elementor' ),
				'type'    => Controls_Manager::MEDIA,
				'default' => [
					'url' => anant_placeholder_image_src(),
				],
				'condition' => [
					'template_style' => ['layout_2']
				],
			],
		);

		$this->add_responsive_control(
            'choose_icon_or_img',
            [
                'label' => esc_html__('Image or Icon', 'anant-addons-for-elementor'),
                'type' => Controls_Manager::CHOOSE,
				'default' => 'icon',
                'options' => [
                    'none' => [
                        'title' => esc_html__('None', 'anant-addons-for-elementor'),
                        'icon' => 'eicon-ban',
                    ],
                    'icon' => [
                        'title' => esc_html__('Icon', 'anant-addons-for-elementor'),
                        'icon' => 'eicon-info-circle',
                    ],
                    'img' => [
                        'title' => esc_html__('Image', 'anant-addons-for-elementor'),
                        'icon' => 'eicon-image-bold',
                    ],
                ],
				'label_block' => true,
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
                    'choose_icon_or_img' => 'img',
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
				'condition' => [
                    'choose_icon_or_img' => 'icon',
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
				'rows' => 10,
				'default' => esc_html__( 'Aenean ut turpis blandit eros convallis congue sit.', 'anant-addons-for-elementor' ),
				'placeholder' => esc_html__( 'Type your description here', 'anant-addons-for-elementor' ),
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
			]
		);

		$this->end_controls_section();

		
		anant_pro_promotion_controls($this);

		$this->start_controls_section(
			'feature_settings',
			[
				'label' => esc_html__( 'Feature Settings', 'anant-addons-for-elementor' ),
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
				'name'      => 'card_bg_color',
				'types'          => [ 'classic', 'gradient' ],
				'exclude'        => [ 'image' ],
				'fields_options' => [
					'background' => [
						'label'     => esc_html__( 'Background ', 'anant-addons-for-elementor' ),
						'default' => 'classic',
					],
				],
				'selector'  => '{{WRAPPER}} .'.$this->feature_card_class,
			]
		);

		anant_border_control(
			$this,
			[
				'name'     => 'card_border_type',
				'selector' => '{{WRAPPER}} .'.$this->feature_card_class.', {{WRAPPER}} .feature_five .content',
			]
		);

		anant_border_radius_control(
			$this,
			[
				'key'       => 'card_border_radius',
				'selectors' => [
					'{{WRAPPER}} .'.$this->feature_card_class => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					'{{WRAPPER}} .feature_five .content' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					'{{WRAPPER}} .feature_seven .content' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
					'{{WRAPPER}} .'.$this->feature_card_class => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					'{{WRAPPER}} .feature_five .content' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					'{{WRAPPER}} .feature_seven .content' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
					'{{WRAPPER}} .'.$this->feature_card_class => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					'{{WRAPPER}} .feature_five .content' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		anant_box_shadow_control(
			$this,
			[
				'key'      => 'card_box_shadow',
				'selector' => '{{WRAPPER}} .'.$this->feature_card_class.', {{WRAPPER}} .feature_five .content',
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
				'name'      => 'card_bg_color_hover',
				'types'          => [ 'classic', 'gradient' ],
				'exclude'        => [ 'image' ],
				'fields_options' => [
					'background' => [
						'label'     => esc_html__( 'Background ', 'anant-addons-for-elementor' ),
						'default' => 'classic',
					],
				],
				'selector'  => '{{WRAPPER}} .'.$this->feature_card_class.':hover',
				'condition' => [
					'template_style!' => ['layout_3']
				]
			]
		);

		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name'      => 'card_bg_before_color_hover',
				'types'          => [ 'classic', 'gradient' ],
				'exclude'        => [ 'image' ],
				'fields_options' => [
					'background' => [
						'label'     => esc_html__( 'Background ', 'anant-addons-for-elementor' ),
						'default' => 'classic',
					],
				],
				'selector'  => '{{WRAPPER}} .'.$this->feature_card_class.'::before',
				'condition' => [
					'template_style' => ['layout_3']
				]
			]
		);

		anant_border_control(
			$this,
			[
				'name'     => 'card_border_type_hover',
				'selector' => '{{WRAPPER}} .'.$this->feature_card_class.':hover',
				'condition' => [
					'template_style' => ['layout_1']
				]
			]
		);

		$this->end_controls_tab(); 
		$this->end_controls_tabs();  
		$this->end_controls_section();

		$this->start_controls_section(
			'icon_settings',
			[
				'label' => esc_html__( 'Icon Settings', 'anant-addons-for-elementor' ),
				'tab'   => Controls_Manager::TAB_STYLE,
				'condition' => [
                    'choose_icon_or_img' => 'icon',
                ],
			]
		);
		$this->add_responsive_control(
			'feature_icon_position',
			[
				'label' => esc_html__('Position', 'anant-addons-for-elementor') , 
				'type' => Controls_Manager::CHOOSE, 
				'options' => [
					'row' => [
						'title' => esc_html__('Left', 'anant-addons-for-elementor') , 
						'icon' => 'eicon-h-align-left', 
					], 
					'column' => [
						'title' => esc_html__('Top', 'anant-addons-for-elementor') , 
						'icon' => 'eicon-v-align-top', 
					], 
					'row-reverse' => [
						'title' => esc_html__('Right', 'anant-addons-for-elementor') , 
						'icon' => 'eicon-h-align-right',
					], 
				], 
				'selectors' => [
					'{{WRAPPER}} .'.$this->feature_card_inner_class => 'flex-direction: {{VALUE}};',
					'{{WRAPPER}} .feature_seven .content' => 'flex-direction: {{VALUE}};',
				],
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
					'{{WRAPPER}} .'.$this->feature_card_icon_class => 'align-self: {{VALUE}};',
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
				'name'      => 'card_heading_icon_bg_color',
				'types'          => [ 'classic', 'gradient' ],
				'exclude'        => [ 'image' ],
				'fields_options' => [
					'background' => [
						'label'     => esc_html__( 'Icon Background Color', 'anant-addons-for-elementor' ),
						'default' => 'classic',
					],
				],
				'selector'  => '{{WRAPPER}} .'.$this->feature_card_icon_class.' .icon',
			]
		);

		$this->add_control(
			'card_heading_icon_color',
			[
				'label'     => esc_html__( 'Icon Color', 'anant-addons-for-elementor' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}}  .'.$this->feature_card_icon_class.' .icon i' => 'color: {{VALUE}}',
					'{{WRAPPER}}  .'.$this->feature_card_icon_class.' .icon svg' => 'fill: {{VALUE}}',
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
					'{{WRAPPER}} .'.$this->feature_card_icon_class.' .icon' => 'width: {{SIZE}}{{UNIT}};height: {{SIZE}}{{UNIT}};',
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
					'{{WRAPPER}} .'.$this->feature_card_icon_class.' .icon i' => 'font-size: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .'.$this->feature_card_icon_class.' .icon svg' => 'width: {{SIZE}}{{UNIT}};height: {{SIZE}}{{UNIT}};',
				],
			]
		);

		anant_border_control(
			$this,
			[
				'name'     => 'icon_border_type',
				'selector' => '{{WRAPPER}} .'.$this->feature_card_icon_class. ' .icon',
			]
		);

		anant_border_radius_control(
			$this,
			[
				'key'       => 'icon_border_type',
				'selectors' => [
					'{{WRAPPER}} .'.$this->feature_card_icon_class.' .icon' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					'{{WRAPPER}} .'.$this->feature_card_icon_class. ' .icon::before' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
					'{{WRAPPER}} .'.$this->feature_card_icon_class.' .icon' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		anant_box_shadow_control(
			$this,
			[
				'key'      => 'icon_box_shadow',
				'selector' => '{{WRAPPER}}  .'.$this->feature_card_icon_class . ' .icon',
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
				'name'      => 'card_heading_icon_bg_color_hover',
				'types'          => [ 'classic', 'gradient' ],
				'exclude'        => [ 'image' ],
				'fields_options' => [
					'background' => [
						'label'     => esc_html__( 'Icon Background Color', 'anant-addons-for-elementor' ),
						'default' => 'classic',
					],
				],
				'selector'  => '{{WRAPPER}}  .'.$this->feature_card_class.':hover .'.$this->feature_card_icon_class.' .icon',
			]
		);

		$this->add_control(
			'card_heading_icon_color_hover',
			[
				'label'     => esc_html__( 'Icon Color', 'anant-addons-for-elementor' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}}  .'.$this->feature_card_class.':hover .'.$this->feature_card_icon_class.' .icon i' => 'color: {{VALUE}}',
					'{{WRAPPER}}  .'.$this->feature_card_class.':hover .'.$this->feature_card_icon_class.' .icon svg' => 'fill: {{VALUE}}',
				],
			]
		);

		anant_border_control(
			$this,
			[
				'name'     => 'icon_border_type_hover',
				'selector' => '{{WRAPPER}} .'.$this->feature_card_class.':hover .'.$this->feature_card_icon_class.' .icon' ,
			]
		);

		anant_border_radius_control(
			$this,
			[
				'key'       => 'icon_border_radius_hover',
				'selectors' => [
					'{{WRAPPER}}   .'.$this->feature_card_class.':hover .'.$this->feature_card_icon_class.' .icon' =>  'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->end_controls_tab();
		$this->end_controls_tabs();
		$this->end_controls_section();

		$this->start_controls_section(
			'feature_image_style',
			[
				'label' => esc_html__( 'Image Settings', 'anant-addons-for-elementor' ),
				'tab'   => Controls_Manager::TAB_STYLE,
				'condition' => [
                    'choose_icon_or_img' => 'img',
                ],
			]
		);

		$slug = 'feature_image';

		$this->add_control(
			$slug.'_icon_position',
			[
				'label' => esc_html__('Position', 'anant-addons-for-elementor') , 
				'type' => Controls_Manager::CHOOSE, 
				'options' => [
					'row' => [
						'title' => esc_html__('Left', 'anant-addons-for-elementor') , 
						'icon' => 'eicon-h-align-left', 
					], 
					'column' => [
						'title' => esc_html__('Center', 'anant-addons-for-elementor') , 
						'icon' => 'eicon-v-align-top', 
					], 
					'row-reverse' => [
						'title' => esc_html__('Right', 'anant-addons-for-elementor') , 
						'icon' => 'eicon-h-align-right',
					], 
				], 
				'selectors' => [
					'{{WRAPPER}} .'.$this->feature_card_inner_class => 'flex-direction: {{VALUE}};',
					'{{WRAPPER}} .feature_seven .content' => 'flex-direction: {{VALUE}};',
				],
			]
		);

		$this->add_responsive_control(
			$slug.'_icon_alignment',
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
					'{{WRAPPER}} .'.$this->feature_card_image_class => 'align-self: {{VALUE}};',
				],
			]
		);
		$this->start_controls_tabs( $slug.'_tabs' );

		$this->start_controls_tab(
			$slug.'_normal_style',
			[
				'label' => esc_html__( 'Normal', 'anant-addons-for-elementor' ),
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
						'label'     => esc_html__( 'Background Color', 'anant-addons-for-elementor' ),
						'default' => 'classic',
					],
				],
				'selector'  => '{{WRAPPER}} .'.$this->feature_card_class.' .'.$this->feature_card_image_class.' .image',
			]
		);

		$this->add_responsive_control(
			$slug.'_image_width',
			[
				'label' => esc_html__('Image Background Width', 'anant-addons-for-elementor' ), 
				'type' => Controls_Manager::SLIDER,
				'size_units'      => [ 'px', '%' ],
				'range'           => [
					'px' => [
						'min' => 0,
						'max' => 300,
					],
					'%' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'default' => [
					'size' =>'' ,
					'unit' => '%',
				],
				'selectors'       => [
					'{{WRAPPER}} .'.$this->feature_card_image_class.' .image ' => 'width: {{SIZE}}{{UNIT}} ; height: {{SIZE}}{{UNIT}};', 
				],
			]
		);

		$this->add_responsive_control(
			$slug.'_image_size',
			[
				'label' => esc_html__('Image Size', 'anant-addons-for-elementor' ), 
				'type' => Controls_Manager::SLIDER,
				'size_units'      => [ 'px', '%' ],
				'range'           => [
					'px' => [
						'min' => 0,
						'max' => 250,
					],
					'%' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'default' => [
					'size' =>'' ,
					'unit' => '%',
				],
				'selectors'       => [
					'{{WRAPPER}} .'.$this->feature_card_image_class.' img' => 'width: {{SIZE}}{{UNIT}}; height: {{SIZE}}{{UNIT}};',
				],
			]
		);

		anant_border_control(
			$this,
			[
				'name'     => $slug.'_border_type',
				'selector' => '{{WRAPPER}} .'.$this->feature_card_image_class.' .image',
			]
		);

		anant_border_radius_control(
			$this,
			[
				'key'       => $slug.'_border_radius',
				'selectors' => [
					'{{WRAPPER}} .'.$this->feature_card_image_class.' .image' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
					'{{WRAPPER}} .'.$this->feature_card_image_class.' .image' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		anant_box_shadow_control(
			$this,
			[
				'key'      => $slug.'_box_shadow',
				'selector' => '{{WRAPPER}}  .'.$this->feature_card_image_class.' .image',
			]
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
			$slug.'_style_hover',
			[
				'label' => esc_html__( 'Hover', 'anant-addons-for-elementor' ),

			]
		);

		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name'      => $slug.'_hover_bg_color',
				'types'          => [ 'classic', 'gradient' ],
				'exclude'        => [ 'image' ],
				'fields_options' => [
					'background' => [
						'label'     => esc_html__( 'Background Color', 'anant-addons-for-elementor' ),
						'default' => 'classic',
					],
				],
				'selector'  => '{{WRAPPER}} .'.$this->feature_card_class.':hover .'.$this->feature_card_image_class.' .image',
			]
		);

		anant_border_control(
			$this,
			[
				'name'     => $slug.'_border_type_hover',
				'selector' => '{{WRAPPER}} .'.$this->feature_card_image_class.' .image:hover',
			]
		);

		anant_border_radius_control(
			$this,
			[
				'key'       => $slug.'_border_radius_hover',
				'selectors' => [
					'{{WRAPPER}} .'.$this->feature_card_image_class.' .image:hover' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->end_controls_tab();
		$this->end_controls_tabs(); 
		$this->end_controls_section();

		$this->start_controls_section(
			'feature_heading_title',
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
					'{{WRAPPER}} .'.$this->feature_card_heading_class => 'text-align: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'card_heading_title_color',
			[
				'label'     => esc_html__( 'Color', 'anant-addons-for-elementor' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}}  .'.$this->feature_card_heading_class.' a' => 'color: {{VALUE}}',
				],
			]
		);

		$this->add_control(
			'card_heading_title_color_hover',
			[
				'label'     => esc_html__( 'Hover Color', 'anant-addons-for-elementor' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .'.$this->feature_card_class.':hover .'.$this->feature_card_heading_class.' a' => 'color: {{VALUE}}',
				],
			]
		);

		anant_typography_control(
			$this,
			[
				'name'     => 'card_heading_title_typography',
				'selector' => '{{WRAPPER}}  .'.$this->feature_card_heading_class,
			]
		);

		$this->add_responsive_control(
			'card_heading_title_margin',
			[
				'label'     => esc_html__('Margin', 'anant-addons-for-elementor'),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .'.$this->feature_card_heading_class => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->end_controls_section();


		$this->start_controls_section(
			'feature_description',
			[
				'label' => esc_html__( 'Description', 'anant-addons-for-elementor' ),
				'tab'   => Controls_Manager::TAB_STYLE,
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
					'{{WRAPPER}} .'.$this->feature_card_description_class => 'text-align: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'card_heading_description_color',
			[
				'label'     => esc_html__( 'Color', 'anant-addons-for-elementor' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}}  .'.$this->feature_card_description_class => 'color: {{VALUE}}',
				],
			]
		);

		$this->add_control(
			'card_heading_description_color_hover',
			[
				'label'     => esc_html__( 'Hover Color', 'anant-addons-for-elementor' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .'.$this->feature_card_class.':hover .'.$this->feature_card_description_class.'' => 'color: {{VALUE}}',
				],
			]
		);

		anant_typography_control(
			$this,
			[
				'name'     => 'card_heading_description_typography',
				'selector' => '{{WRAPPER}}  .'.$this->feature_card_description_class,
			]
		);

		$this->add_responsive_control(
			'card_heading_description_margin',
			[
				'label'     => esc_html__('Margin', 'anant-addons-for-elementor'),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .'.$this->feature_card_description_class => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->end_controls_section();
	}

	protected function render() {
		$settings = $this->get_settings_for_display();

		$choose_icon = $settings['choose_icon_or_img'];

		$show_title = $settings['show_title'];
		$show_description = $settings['show_description'];

		$title = $settings['card_title'];
		$description = $settings['card_description'];
		$card_icon = $settings['card_icon'];
		$link = $settings['card_link']['url'];
		$target = $settings['card_link']['is_external'] ? ' target=_blank' : '';
		$nofollow = $settings['card_link']['nofollow'] ? ' rel=nofollow' : '';

		$template_style = $settings['template_style'];
		if ( ($template_style == 'layout_2') ) {
			$image_bg_url = $settings['card_bg_image']['url'];
		}
		if ($choose_icon == 'img' ) {
			$image_url = $settings['card_image']['url'];
		}
		$template_path = ANANT_PATH . 'inc/templates/feature/';

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