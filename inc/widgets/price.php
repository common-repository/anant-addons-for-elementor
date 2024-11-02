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
use Elementor\Repeater;

class AnantPrice extends \Elementor\Widget_Base {

	private $price_card_class = 'anant-price-card';
	private $price_card_inner_class = 'anant-price-inner-card';
	private $price_card_image_class = 'anant-price-card-image';
	private $price_card_heading_class = 'anant-price-card-heading';
	private $price_card_plan_class = 'anant-price-card-plan';
	private $price_card_icon_class = 'anant-price-card-icon';
	private $price_card_ribbon_class = 'anant-price-card-ribbon';
	private $price_card_feature_class = 'anant-price-card-feature';
	private $price_card_read_more_class  = 'anant-price-card-read-more';
	private $price_sign  = 'anant-price-currency-sign';
	private $price_value  = 'anant-price-currency-value';
	private $price_duration  = 'anant-price-duration';
	private $price_sale  = 'anant-price-currency-sale';

	public function get_name() {
		return 'anant-price';
	}

	public function get_title() {
		return __( 'Price Table', 'anant-addons-for-elementor' );
	}

	public function get_categories() {
		return [ 'anant-elements' ];
	}

	public function get_icon() {
		return 'ant-icon eicon-price-table';
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
			'price table',
			'plan', 
			'price list', 
			'price menus ',
			'anant addons',
			'',
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
					'layout_4'      => esc_html__( 'Layout 4 (Pro)', 'anant-addons-for-elementor' ),
					'layout_5'      => esc_html__( 'Layout 5 (Pro)', 'anant-addons-for-elementor' ),
					'layout_6'      => esc_html__( 'Layout 6 (Pro)', 'anant-addons-for-elementor' ),
					'layout_7'      => esc_html__( 'Layout 7 (Pro)', 'anant-addons-for-elementor' ),
					'layout_8'      => esc_html__( 'Layout 8 (Pro)', 'anant-addons-for-elementor' ),
				],
			]
		);
		$this->add_control(
			'anant_price_item_pro_notice',
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
			'primary_box', 
			[
				'label' => esc_html__('Main Box', 'anant-addons-for-elementor') , 
				'type' => Controls_Manager::SWITCHER, 
				'return_value' => 'show', 
				'default' => ' ', 
			]
		);
		$this->add_control(
			'card_title', [
				'label' => __( 'Plan Name', 'anant-addons-for-elementor' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => __( 'Basic Plan' , 'anant-addons-for-elementor' ),
				'label_block' => true,
			]
		);
		$this->add_control(
			'currency_symbol', [
				'label' => __( 'Currency Symbol', 'anant-addons-for-elementor' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => __( '$' , 'anant-addons-for-elementor' ),
				'label_block' => true,
			]
		);
		$this->add_control(
			'price_amount', [
				'label' => __( 'Price Amount', 'anant-addons-for-elementor' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => __( '69' , 'anant-addons-for-elementor' ),
				'label_block' => true,
			]
		);
		$this->add_control(
			'price_per_plan', [
				'label' => __( 'Price Duration', 'anant-addons-for-elementor' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => __( '/ Month' , 'anant-addons-for-elementor' ),
				'label_block' => true,
			]
		);
		$this->add_control(
			'sale_switch', 
			[
				'label' => esc_html__('Sale', 'anant-addons-for-elementor') , 
				'type' => Controls_Manager::SWITCHER, 
				'return_value' => 'show', 
				'default' => ' ', 
			]
		);
		$this->add_control(
			'price_sale_amount', [
				'label' => __( 'Original Price Amount', 'anant-addons-for-elementor' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => __( '99' , 'anant-addons-for-elementor' ),
				'label_block' => true,
				'condition' => [
					'sale_switch' => 'show'
				]
			]
		);
		$this->add_control(
			'card_icon',
			[
				'label' => __( 'Icon', 'anant-addons-for-elementor' ),
				'type' => \Elementor\Controls_Manager::ICONS,
				'default' => [
					'value' => 'fa fa-star',
					'library' => 'solid',
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
		$this->end_controls_section();

		$this->start_controls_section(
			'features_section',
			[
				'label' => __( 'Features', 'anant-addons-for-elementor' ),
				'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);
		$this->add_control(
			'show_list_icon', 
			[
				'label' => esc_html__('List Icon', 'anant-addons-for-elementor') , 
				'type' => Controls_Manager::SWITCHER, 
				'return_value' => 'show', 
				'default' => 'show', 
			]
		);
		$this->add_responsive_control(
			'features_icon_position',
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
	    $repeater = new Repeater();
        $repeater->add_control(
			'features_title', 
			[
				'label' => __('Features', 'anant-addons-for-elementor') , 
				'type' => Controls_Manager::TEXT, 
				'label_block' => true, 
				'default' => __('Feature List Item', 'anant-addons-for-elementor') ,
			]
		);
        $repeater->add_control(
			'features_icon',
			[
				'label' => __( 'Icon', 'anant-addons-for-elementor' ),
				'type' => \Elementor\Controls_Manager::ICONS,
				'default' => [
					'value' => 'fa fa-check', 'library' => 'solid',
				], 
			],
		);
		$repeater->add_control(
			'features_repeater_icon_color',
			[
				'label'     => __( 'Color', 'anant-addons-for-elementor' ),
				'type'      => Controls_Manager::COLOR,
			]
		);
		$repeater->add_control(
			'feature_item_active', 
			[
				'label' => esc_html__('Item Active', 'anant-addons-for-elementor') , 
				'type' => Controls_Manager::SWITCHER, 
				'return_value' => 'show',
				'default' => 'show',
			]
		);
		$this->add_control(
			'features_title_block', 
			[
				'label' => __('Add Features', 'anant-addons-for-elementor') , 
				'type' => Controls_Manager::REPEATER, 
				'fields' => $repeater->get_controls() , 
				'default' => [
					[
						'features_title' => __('Advance Analytics', 'anant-addons-for-elementor') ,
						'features_icon' => [ 'value' => 'fa fa-check', 'library' => 'solid', ],
						'feature_item_active' => 'show',
					],	[
						'features_title' => __('Change Managment', 'anant-addons-for-elementor') ,
						'features_icon' => [ 'value' => 'fa fa-check', 'library' => 'solid', ],
						'feature_item_active' => 'show',
					],	[
						'features_title' => __('Corporate Finance', 'anant-addons-for-elementor') ,
						'features_icon' => [ 'value' => 'fa fa-check', 'library' => 'solid', ],
						'feature_item_active' => 'show',
					],	[
						'features_title' => __('Strategy & Marketing', 'anant-addons-for-elementor') ,
						'features_icon' => [ 'value' => 'fa fa-times', 'library' => 'solid', ],
						'feature_item_active' => 'show',
					],
				], 
				'title_field' => '{{{ features_title }}}', 
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
			'show_plan',
			[
				'label' => __( 'Show Plan', 'anant-addons-for-elementor' ),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'label_on' => __( 'Show', 'anant-addons-for-elementor' ),
				'label_off' => __( 'Hide', 'anant-addons-for-elementor' ),
				'return_value' => 'yes',
				'default' => 'yes',

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
			'show_link',
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
			'ribbon_section',
			[
				'label' => __( 'Ribbon Settings', 'anant-addons-for-elementor' ),
				'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);
		$this->add_control(
			'show_ribbon',
			[
				'label' => __( 'Show Ribbon', 'anant-addons-for-elementor' ),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'label_on' => __( 'Show', 'anant-addons-for-elementor' ),
				'label_off' => __( 'Hide', 'anant-addons-for-elementor' ),
				'return_value' => 'yes',
				'default' => 'no',
			]
		);
		$this->add_control(
			'ribbon_style',
			[
				'label'       => esc_html__( 'Ribbon Style', 'anant-addons-for-elementor' ),
				'placeholder' => esc_html__( 'Choose Ribbon from Here', 'anant-addons-for-elementor' ),
				'type'        => \Elementor\Controls_Manager::SELECT,
				'default'     => 'one',
				'options'     => [
					'one'      => esc_html__( 'Style 1', 'anant-addons-for-elementor' ),
					'two'      => esc_html__( 'Style 2 (Pro)', 'anant-addons-for-elementor' ),
					'three'      => esc_html__( 'Style 3 (Pro)', 'anant-addons-for-elementor' ),
					'four'      => esc_html__( 'Style 4 (Pro)', 'anant-addons-for-elementor' ),
					'five'      => esc_html__( 'Style 5 (Pro)', 'anant-addons-for-elementor' ),
					'six'      => esc_html__( 'Style 6 (Pro)', 'anant-addons-for-elementor' ),
				],
				'condition'  => [
					'show_ribbon' => 'yes'
				],
			]
		);
		$this->add_control(
			'anant_ribbon_pro_notice',
			[
				'raw' => 'Only Available in <a href="https://anantaddons.com/" target="_blank">Pro Version!</a>',
				'type' => \Elementor\Controls_Manager::RAW_HTML,
				'content_classes' => 'anant-pro-notice',
				'condition' => [
                    'ribbon_style!' => ['one'],
                ],
			]
		);
		$this->add_control(
			'ribbon_title', [
				'label' => __( 'Title', 'anant-addons-for-elementor' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => __( 'Popular' , 'anant-addons-for-elementor' ),
				'label_block' => true,
				'condition'  => [
					'show_ribbon' => 'yes'
				],
			]
		);
		$this->end_controls_section();

		$this->start_controls_section(
			'button_section',
			[
				'label' => __( 'Button Settings', 'anant-addons-for-elementor' ),
				'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);
		$this->add_control(
			'card_link_text', [
				'label' => __( 'Link Text', 'anant-addons-for-elementor' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => __( 'Choose Plan' , 'anant-addons-for-elementor' ),
				'label_block' => true,
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
			'link_button_icon',
			[
				'label' => __( 'Icon', 'anant-addons-for-elementor' ),
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
			'link_button_space_before',
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
					'{{WRAPPER}} .'.$this->price_card_read_more_class.' i' => 'margin-right: {{SIZE}}{{UNIT}};',
				], 
				'conditions' => [
					'relation' => 'and',
					'terms'    => [
						[
							'name'     => 'link_button_position',
							'operator' => '!==',
							'value'    => 'after',
						],
					],
				],
			],
		);
		$this->add_responsive_control(
			'link_button_space_after',
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
					'{{WRAPPER}} .'.$this->price_card_read_more_class.' i' => 'margin-left: {{SIZE}}{{UNIT}};',
				],
				'conditions' => [
					'relation' => 'and',
					'terms'    => [
						[
							'name'     => 'link_button_position',
							'operator' => '!==',
							'value'    => 'before',
						],
					],
				],
			]
		);
		$this->end_controls_section();
		anant_pro_promotion_controls($this);

		$this->start_controls_section(
			'price_settings',
			[
				'label' => __( 'Price Settings', 'anant-addons-for-elementor' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);
		$this->add_control(
			'card_bg_color',
			[
				'label'     => __( 'Background Color', 'anant-addons-for-elementor' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}}  .'.$this->price_card_class.', .'.$this->price_card_class.'::before' => 'background-color: {{VALUE}}',
				],
			]
		);
		anant_border_control(
			$this,
			[
				'name'     => 'card_border_type',
				'label'    => 'Border Type',
				'selector' => '{{WRAPPER}} .'.$this->price_card_class,
			]
		);
		anant_border_radius_control(
			$this,
			[
				'key'       => 'card_border_radius',
				'label'     => 'Border Radius',
				'selectors' => [
					'{{WRAPPER}} .'.$this->price_card_class => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					'{{WRAPPER}} .'.$this->price_card_class => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
					'{{WRAPPER}} .'.$this->price_card_class => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
					'{{WRAPPER}} .'.$this->price_card_class => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					'{{WRAPPER}} .'.$this->price_card_class => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		anant_box_shadow_control(
			$this,
			[
				'key'      => 'card_box_shadow',
				'label'    => 'Box Shadow',
				'selector' => '{{WRAPPER}}  .'.$this->price_card_class,
			]
		);
		$this->end_controls_section();

		$this->start_controls_section(
			'price_ribbon',
			[
				'label' => __( 'Ribbon', 'anant-addons-for-elementor' ),
				'tab'   => Controls_Manager::TAB_STYLE,
				'condition' => [
					'show_ribbon' => 'yes',
				],
			]
		);
		anant_typography_control(
			$this,
			[
				'name'     => 'price_ribbon_typography',
				'label'    => 'Typography',
				'selector' => '{{WRAPPER}}  span.'.$this->price_card_ribbon_class,
			]
		);
		$this->start_controls_tabs( 'price_ribbon_tabs' );
		$this->start_controls_tab(
			'price_ribbon_normal_style',
			[
				'label' => __( 'Normal', 'anant-addons-for-elementor' ),
			]
		);
		$this->add_control(
			'price_ribbon_color',
			[
				'label'     => __( 'Color', 'anant-addons-for-elementor' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}}  .ant-price-ribbon span.'.$this->price_card_ribbon_class => 'color: {{VALUE}}',
				],
			]
		);
		$this->add_control(
			'price_ribbon_bg_color',
			[
				'label'     => __( 'Background Color', 'anant-addons-for-elementor' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}}  .ant-price-ribbon span.'.$this->price_card_ribbon_class => 'background-color: {{VALUE}}',
					'{{WRAPPER}}  .ant-price-ribbon span.'.$this->price_card_ribbon_class.'::after' => 'background-color: {{VALUE}}',
					'{{WRAPPER}}  .ant-price-ribbon span.'.$this->price_card_ribbon_class.'::before' => 'background-color: {{VALUE}}',
				],
			]
		);
		$this->end_controls_tab(); 
		$this->start_controls_tab(
			'price_ribbon_hover_style',
			[
				'label' => __( 'Hover', 'anant-addons-for-elementor' ),
			]
		);
		$this->add_control(
			'price_ribbon_color_hover',
			[
				'label'     => __( 'Color', 'anant-addons-for-elementor' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}}  .'.$this->price_card_class.':hover span.'.$this->price_card_ribbon_class => 'color: {{VALUE}}',
				],
			]
		);
		$this->add_control(
			'price_ribbon_bg_color_hover',
			[
				'label'     => __( 'Background Color', 'anant-addons-for-elementor' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}}  .'.$this->price_card_class.':hover span.'.$this->price_card_ribbon_class => 'background-color: {{VALUE}}',
					'{{WRAPPER}}  .'.$this->price_card_class.':hover span.'.$this->price_card_ribbon_class.'::after' => 'background-color: {{VALUE}}',
					'{{WRAPPER}}  .'.$this->price_card_class.':hover span.'.$this->price_card_ribbon_class.'::before' => 'background-color: {{VALUE}}',
				],
			]
		);
		$this->end_controls_tab(); 
		$this->end_controls_tabs(); 
		$this->end_controls_section();

		$this->start_controls_section(
			'price_heading_title',
			[
				'label' => __( 'Plan Name', 'anant-addons-for-elementor' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);
		$this->add_responsive_control(
			'card_heading_title_alignment',
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
					'{{WRAPPER}} .'.$this->price_card_heading_class => 'text-align: {{VALUE}};',
				],
			]
		);
		$this->add_control(
			'card_heading_title_color',
			[
				'label'     => __( '  Color', 'anant-addons-for-elementor' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}}  .'.$this->price_card_heading_class => 'color: {{VALUE}}',
				],
			]
		);
		anant_typography_control(
			$this,
			[
				'name'     => 'card_heading_title_typography',
				'label'    => 'Typography',
				'selector' => '{{WRAPPER}}  .'.$this->price_card_heading_class,
			]
		);
		$this->add_responsive_control(
			'card_heading_title_margin',
			[
				'label'     => esc_html__('Margin', 'anant-addons-for-elementor'),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .'.$this->price_card_heading_class => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->end_controls_section();

		$this->start_controls_section(
			'price_plan_title',
			[
				'label' => __( 'Price Plan', 'anant-addons-for-elementor' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);
		$this->add_responsive_control(
			'card_plan_title_alignment',
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
					'{{WRAPPER}} .'.$this->price_card_plan_class => 'text-align: {{VALUE}};',
				],
			]
		);
		$this->add_control(
			'card_currency_heading',
			[
				'label' => esc_html__( 'Currency', 'anant-addons-for-elementor' ),
				'type' => \Elementor\Controls_Manager::HEADING,
			]
		);
		$this->add_control(
			'card_currency_color',
			[
				'label'     => __( 'Color', 'anant-addons-for-elementor' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}}  span.'.$this->price_sign => 'color: {{VALUE}}',
				],
			]
		);
		anant_typography_control(
			$this,
			[
				'name'     => 'card_currency_typography',
				'label'    => 'Typography',
				'selector' => '{{WRAPPER}}  .'.$this->price_sign,
			]
		);
		$this->add_control(
			'card_price_heading',
			[
				'label' => esc_html__( 'Price', 'anant-addons-for-elementor' ),
				'type' => \Elementor\Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);
		$this->add_control(
			'card_price_color',
			[
				'label'     => __( 'Color', 'anant-addons-for-elementor' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}}  span.'.$this->price_value => 'color: {{VALUE}}',
				],
			]
		);
		anant_typography_control(
			$this,
			[
				'name'     => 'card_price_typography',
				'label'    => 'Typography',
				'selector' => '{{WRAPPER}}  .'.$this->price_value,
			]
		);
		$this->add_control(
			'card_duration_heading',
			[
				'label' => esc_html__( 'Duration ', 'anant-addons-for-elementor' ),
				'type' => \Elementor\Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);
		$this->add_control(
			'card_duration_color',
			[
				'label'     => __( 'Color', 'anant-addons-for-elementor' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}}  span.'.$this->price_duration => 'color: {{VALUE}}',
				],
			]
		);
		anant_typography_control(
			$this,
			[
				'name'     => 'card_duration_typography',
				'label'    => 'Typography',
				'selector' => '{{WRAPPER}}  .'.$this->price_duration,
			]
		);
		$this->add_control(
			'card_sale_heading',
			[
				'label' => esc_html__( 'Sale ', 'anant-addons-for-elementor' ),
				'type' => \Elementor\Controls_Manager::HEADING,
				'separator' => 'before',
				'condition' => [
					'sale_switch' => 'show'
				],
			]
		);
		$this->add_control(
			'card_sale_color',
			[
				'label'     => __( 'Color', 'anant-addons-for-elementor' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .'.$this->price_sale => 'color: {{VALUE}}',
					'{{WRAPPER}} .active .'.$this->price_sale => 'color: {{VALUE}}',
					'{{WRAPPER}} .active .'.$this->price_sale.' span' => 'color: {{VALUE}}',
				],
				'condition' => [
					'sale_switch' => 'show'
				],
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' => 'card_sale_typography',
				'label'    => 'Typography',
				'selector' => '{{WRAPPER}} .'.$this->price_sale.', {{WRAPPER}} .'.$this->price_card_class.' .'.$this->price_sale.' span.ant-currency-sign',
				'condition' => [
					'sale_switch' => 'show'
				],
			]
		);
		$this->add_control(
			'card_plan_bg_color',
			[
				'label'     => __( 'Background Color', 'anant-addons-for-elementor' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}}  .'.$this->price_card_plan_class => 'background-color: {{VALUE}}',
				], 
				'condition' => [
					'template_style' => 'layout_2',
				],
			]
		);
		$this->add_responsive_control(
			'card_plan_title_padding',
			[
				'label'     => esc_html__('Padding', 'anant-addons-for-elementor'),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .'.$this->price_card_plan_class => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
				'condition' => [
					'template_style' => 'layout_2',
				],
			]
		);
		$this->add_responsive_control(
			'card_plan_title_margin',
			[
				'label'     => esc_html__('Margin', 'anant-addons-for-elementor'),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .'.$this->price_card_plan_class => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->end_controls_section();

		$this->start_controls_section(
			'icon_settings',
			[
				'label' => __( 'Icon Settings', 'anant-addons-for-elementor' ),
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
		$this->add_responsive_control(
			'card_heading_icon_alignment',
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
					'{{WRAPPER}} .'.$this->price_card_icon_class => 'justify-content: {{VALUE}};',
				],
			]
		);
		$this->add_control(
			'card_heading_icon_bg_color',
			[
				'label'     => __( 'Icon Background Color', 'anant-addons-for-elementor' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}}  .'.$this->price_card_icon_class.' .icon'  => 'background-color: {{VALUE}}',
				],
			]
		);
		$this->add_control(
			'card_heading_icon_color',
			[
				'label'     => __( 'Icon Color', 'anant-addons-for-elementor' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}}  .'.$this->price_card_icon_class.' .icon' => 'color: {{VALUE}}',
					'{{WRAPPER}}  .'.$this->price_card_icon_class.' .icon svg' => 'fill: {{VALUE}}',
				],
			]
		);
		$this->add_responsive_control(
			'icon_width',
			[
				'label'           => __( 'Icon Width', 'anant-addons-for-elementor' ),
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
					'{{WRAPPER}} .'.$this->price_card_icon_class.' .icon' => 'width: {{SIZE}}{{UNIT}};height: {{SIZE}}{{UNIT}};',
				],
			]
		);
		$this->add_responsive_control(
			'icon_size',
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
					'{{WRAPPER}} .'.$this->price_card_icon_class.' .icon' => 'font-size: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .'.$this->price_card_icon_class.' .icon svg' => 'width: {{SIZE}}{{UNIT}};height: {{SIZE}}{{UNIT}};',
				],
			]
		);
		anant_border_radius_control(
			$this,
			[
				'key'       => 'icon_border_type',
				'label'     => 'Border Radius',
				'selectors' => [
					'{{WRAPPER}} .'.$this->price_card_icon_class.' .icon' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					'{{WRAPPER}} .'.$this->price_card_icon_class.' .icon' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
					'{{WRAPPER}} .'.$this->price_card_icon_class.' .icon' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					'{{WRAPPER}} .'.$this->price_card_icon_class.' .icon' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->end_controls_section();

		$this->start_controls_section(
			'price_feature',
			[
				'label' => __( 'Feature Setting', 'anant-addons-for-elementor' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);
		$this->add_responsive_control(
			'card_heading_feature_alignment',
			[
				'label'     => __( 'Alignment', 'anant-addons-for-elementor' ),
				'type'      => Controls_Manager::CHOOSE,
				'options'   => [
					'start' => [
						'title' => __( 'Start', 'anant-addons-for-elementor' ),
						'icon'  => 'eicon-justify-start-h',
					],
					'center' => [
						'title' => __( 'Center', 'anant-addons-for-elementor' ),
						'icon'  => 'eicon-justify-center-h',
					],
					'end' => [
						'title' => __( 'End', 'anant-addons-for-elementor' ),
						'icon'  => 'eicon-justify-end-h',
					],
					'space-between' => [
						'title' => __( 'Space Between', 'anant-addons-for-elementor' ),
						'icon'  => 'eicon-justify-space-between-h',
					],
				],
				'toggle'    => true,
				'selectors' => [
					'{{WRAPPER}} .'.$this->price_card_feature_class => 'justify-content: {{VALUE}};',
				],
			]
		);
		$this->add_control(
			'card_heading_feature_color',
			[
				'label'     => __( 'Color', 'anant-addons-for-elementor' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .'.$this->price_card_class.' .'.$this->price_card_feature_class.' a' => 'color: {{VALUE}}',
				],
			]
		);
		$this->add_control(
			'card_heading_feature_icon_color',
			[
				'label'     => __( 'Icon Color', 'anant-addons-for-elementor' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .'.$this->price_card_class.' .'.$this->price_card_feature_class.' i' => 'color: {{VALUE}}',
				],
			]
		);
		anant_typography_control(
			$this,
			[
				'name'     => 'card_heading_feature_typography',
				'label'    => 'Typography',
				'selector' => '{{WRAPPER}}  .'.$this->price_card_feature_class.' a',
			]
		);
		$this->add_responsive_control(
			'feature_icon_size',
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
				'default_desktop' => [
					'size' =>  '',
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
					'{{WRAPPER}} .'.$this->price_card_feature_class.' i' => 'font-size: {{SIZE}}{{UNIT}};',
				],
			]
		);
		anant_border_control(
			$this,
			[
				'name'     => 'card_heading_feature_border_type',
				'label'    => 'Border Type',
				'selector' => '{{WRAPPER}} .'.$this->price_card_feature_class,
			]
		);
		$this->add_responsive_control(
			'card_heading_feature_padding',
			[
				'label'     => esc_html__('Padding', 'anant-addons-for-elementor'),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .'.$this->price_card_feature_class => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					'{{WRAPPER}} .'.$this->price_card_feature_class => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_responsive_control(
			'card_heading_feature_margin',
			[
				'label'     => esc_html__('Margin', 'anant-addons-for-elementor'),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .'.$this->price_card_feature_class => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					'{{WRAPPER}} .'.$this->price_card_feature_class => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'feature_content_padding_top',
			[
				'label'           => __( 'Feature Top Distance', 'anant-addons-for-elementor' ),
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
				'default_desktop' => [
					'size' =>  '',
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
					'{{WRAPPER}} .'.$this->price_card_inner_class => 'padding-top: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'feature_content_padding_bottom',
			[
				'label'           => __( 'Feature Bottom Distance', 'anant-addons-for-elementor' ),
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
				'default_desktop' => [
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
					'{{WRAPPER}} .'.$this->price_card_inner_class => 'padding-bottom: {{SIZE}}{{UNIT}};',
				],
			],
		);
		$this->end_controls_section();

		$this->start_controls_section(
			'price_button_settings',
			[
				'label' => __( 'Button Settings', 'anant-addons-for-elementor' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);
		$this->add_responsive_control(
			'card_heading_read_more_alignment',
			[
				'label'     => __( 'Alignment', 'anant-addons-for-elementor' ),
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
					'{{WRAPPER}} .'.$this->price_card_read_more_class => 'text-align: {{VALUE}};',
				],
			]
		);
		anant_typography_control(
			$this,
			[
				'name'     => 'card_heading_read_more_typography',
				'label'    => 'Typography',
				'selector' => '{{WRAPPER}}  .'.$this->price_card_class.' .'.$this->price_card_read_more_class.' a',
			]
		);
		$this->add_responsive_control(
			'card_heading_read_more_padding',
			[
				'label'     => esc_html__('Padding', 'anant-addons-for-elementor'),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .'.$this->price_card_class.' .'.$this->price_card_read_more_class.' a' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
					'{{WRAPPER}} .'.$this->price_card_class.' .'.$this->price_card_read_more_class.' a' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		anant_border_radius_control(
			$this,
			[
				'key'       => 'card_heading_read_more_border_radius',
				'label'     => 'Border Radius',
				'selectors' => [
					'{{WRAPPER}} .'.$this->price_card_class.' .'.$this->price_card_read_more_class.' a' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		anant_box_shadow_control(
			$this,
			[
				'key'      => 'card_heading_read_more_box_shadow',
				'label'    => 'Box Shadow',
				'selector' => '{{WRAPPER}}  .'.$this->price_card_class.' .'.$this->price_card_read_more_class.' a',
			]
		);
		$this->start_controls_tabs( 'card_heading_read_more_tabs' );
		$this->start_controls_tab(
			'card_heading_read_more_normal_style',
			[
				'label' => __( 'Normal', 'anant-addons-for-elementor' ),
			]
		);
		$this->add_control(
			'card_heading_read_more_color',
			[
				'label'     => __( 'Color', 'anant-addons-for-elementor' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}}  .'.$this->price_card_class.' .'.$this->price_card_read_more_class.' a' => 'color: {{VALUE}}',
					'{{WRAPPER}}  .'.$this->price_card_class.' .'.$this->price_card_read_more_class.' a i' => 'color: {{VALUE}}',
				],
			]
		);
		$this->add_control(
			'card_heading_read_more_bg_color',
			[
				'label'     => __( 'Background Color', 'anant-addons-for-elementor' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}}  .'.$this->price_card_class.' .'.$this->price_card_read_more_class.' a' => 'background-color: {{VALUE}}',
				],
			]
		);
		anant_border_control(
			$this,
			[
				'name'     => 'card_heading_read_more_border_type',
				'label'    => 'Border Type',
				'selector' => '{{WRAPPER}} .'.$this->price_card_class.' .'.$this->price_card_read_more_class.' a',
			]
		);
		$this->end_controls_tab();
		$this->start_controls_tab(
			'card_heading_read_more_style_hover',
			[
				'label' => __( 'Hover', 'anant-addons-for-elementor' ),

			]
		);
		$this->add_control(
			'card_heading_read_more_color_hover',
			[
				'label'     => __( 'Color', 'anant-addons-for-elementor' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .'.$this->price_card_read_more_class.' a:hover'=> 'color: {{VALUE}}',
					'{{WRAPPER}} .'.$this->price_card_read_more_class.' a:hover i'=> 'color: {{VALUE}}',
				],
			]
		);
		$this->add_control(
			'card_heading_read_more_bg_color_hover',
			[
				'label'     => __( 'Background Color', 'anant-addons-for-elementor' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .'.$this->price_card_read_more_class.' a:hover' => 'background-color: {{VALUE}}',
				],
			]
		);
		anant_border_control(
			$this,
			[
				'name'     => 'card_heading_read_more_border_type_hover',
				'label'    => 'Border Type',
				'selector' => '{{WRAPPER}} .'.$this->price_card_read_more_class.' a:hover',
			]
		);
		$this->end_controls_tab();
		$this->end_controls_tabs();
		$this->end_controls_section();
	}

	protected function render() {
		$settings = $this->get_settings_for_display();
		
		$show_feature = $settings['show_feature'];
		$show_icon = $settings['show_icon'];
		$show_title = $settings['show_title'];
		$show_link = $settings['show_link'];
		$show_plan = $settings['show_plan'];
		$show_ribbon = $settings['show_ribbon'];

		$title = $settings['card_title'];
		$primary_box = $settings['primary_box'];

		$currency_symbol = $settings['currency_symbol']; 
		$price_per_plan = $settings['price_per_plan'];
		$price_amount = $settings['price_amount'];
		$link_text = $settings['card_link_text'];
		$card_icon = $settings['card_icon'];
		$ribbon_style = $settings['ribbon_style'];
		$ribbon_title = $settings['ribbon_title'];
		$features_title_block = $settings['features_title_block'];
		$features_icon_position = $settings['features_icon_position'];
		$sale_switch = $settings['sale_switch'];
		$show_list_icon = $settings['show_list_icon'];
		$price_sale_amount = $settings['price_sale_amount'];
		$link_button_icon = $settings['link_button_icon'];
		$link_button_position = $settings['link_button_position'];
		$link = $settings['card_link']['url'];
		$target = $settings['card_link']['is_external'] ? ' target=_blank' : '';
		$nofollow = $settings['card_link']['nofollow'] ? ' rel=nofollow' : '';

		$template_style = $settings['template_style'];

		if (in_array($ribbon_style, ['two', 'three', 'four', 'five', 'six',])) {
			$ribbon_style = 'remove';
		}

		$template_path = ANANT_PATH . 'inc/templates/price/';

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