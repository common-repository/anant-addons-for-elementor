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

class AnantPriceList extends \Elementor\Widget_Base {

	private $price_list_card_class = 'anant-price-list';
	private $price_card_inner_class = 'anant-price-list-inner';
	private $price_list_card_image_class = 'anant-price-list-image';
	private $price_list_card_heading_class = 'anant-price-list-heading';
	private $price_list_feature_separator_class = 'anant-price-list-feature-separator';
	private $price_card_title_class = 'anant-price-list-feature';
	private $price_list_card_description_class = 'anant-price-list-description';

	public function get_name() {
		return 'anant-price-list';
	}

	public function get_title() {
		return __( 'Price List', 'anant-addons-for-elementor' );
	}

	public function get_categories() {
		return [ 'anant-elements' ];
	}

	public function get_icon() {
		return 'ant-icon eicon-price-list';
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
			'price ',
			'price menus',
			'price list', 
			'plans ',
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
					'layout_2'      => esc_html__( 'Layout 2 (Pro)', 'anant-addons-for-elementor' ),
					'layout_3'      => esc_html__( 'Layout 3 (Pro)', 'anant-addons-for-elementor' ),
					'layout_4'      => esc_html__( 'Layout 4 (Pro)', 'anant-addons-for-elementor' ),
					'layout_5'      => esc_html__( 'Layout 5 (Pro)', 'anant-addons-for-elementor' ),
				],
			]
		);

		$this->add_control(
			'anant_price_list_pro_notice',
			[
				'raw' => 'Only Available in <a href="https://anantaddons.com/" target="_blank">Pro Version!</a>',
				'type' => \Elementor\Controls_Manager::RAW_HTML,
				'content_classes' => 'anant-pro-notice',
				'condition' => [
                    'template_style!' => ['layout_1'],
                ],
			]
		);

		$repeater = new \Elementor\Repeater();
		$repeater->add_control(
			'card_image',
			[
				'label'   => __( 'Choose Image', 'anant-addons-for-elementor' ),
				'type'    => Controls_Manager::MEDIA,
				'default' => [
					'url' => anant_placeholder_image_src(),
				],
			]
		); 
		$repeater->add_control(
			'card_title', [
				'label' => __( 'Item Name', 'anant-addons-for-elementor' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'label_block' => true,
				'default' =>__('Cafe Latte', 'anant-addons-for-elementor'),	
			]
		);

		$repeater->add_control(
			'card_amount', [
				'label' => __( 'Amount', 'anant-addons-for-elementor' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'label_block' => true,
				'default' =>__('$99', 'anant-addons-for-elementor'),	
			]
		);
	
		$description = 'Aenean ut turpis blandit eros convallis congue sit amet a libero.';

		$repeater->add_control(
			'card_description',
			[
				'label' => __( 'Description', 'anant-addons-for-elementor' ),
				'type' => \Elementor\Controls_Manager::TEXTAREA, 
				'label_block' => true,
				'default' =>__( $description, 'anant-addons-for-elementor'),	
			]
		);

		$this->add_control(
			'price_list_item',
			[
				'label' => __( 'Item', 'anant-addons-for-elementor' ),
				'type' => \Elementor\Controls_Manager::REPEATER,
				'fields' => $repeater->get_controls(),
				'default' => [
					[
						'card_title'  => __('Cafe Latte', 'anant-addons-for-elementor'),						
						'card_amount' => __('$99', 'anant-addons-for-elementor'),
						'card_description' => __($description, 'anant-addons-for-elementor'),
					],
					[
						'card_title'  => __('Cafe Latte', 'anant-addons-for-elementor'),						
						'card_amount' => __('$99', 'anant-addons-for-elementor'),
						'card_description' => __($description, 'anant-addons-for-elementor'),
					],
				],
				'title_field' => '{{{ card_title }}}',
			]
		);

		$this->add_control(
			'anant_price_list_repeater_pro_notice',
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
				'label' => __( 'Settings', 'anant-addons-for-elementor' ),
				'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);

		$this->add_control(
			'show_image',
			[
				'label' => __( 'Show Image', 'anant-addons-for-elementor' ),
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
			'show_amount',
			[
				'label' => __( 'Show Amount', 'anant-addons-for-elementor' ),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'label_on' => __( 'Show', 'anant-addons-for-elementor' ),
				'label_off' => __( 'Hide', 'anant-addons-for-elementor' ),
				'return_value' => 'yes',
				'default' => 'yes',
			]
		);

		$this->add_control(
			'show_description',
			[
				'label' => __( 'Show Description', 'anant-addons-for-elementor' ),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'label_on' => __( 'Show', 'anant-addons-for-elementor' ),
				'label_off' => __( 'Hide', 'anant-addons-for-elementor' ),
				'return_value' => 'yes',
				'default' => 'yes',
			]
		);

		$this->end_controls_section();

		anant_pro_promotion_controls($this);

		// STYLE
		$this->start_controls_section(
			'price_settings',
			[
				'label' => __( 'Price list Settings', 'anant-addons-for-elementor' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'card_bg_color',
			[
				'label'     => __( 'Background Color', 'anant-addons-for-elementor' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}}  .'.$this->price_list_card_class.', .'.$this->price_list_card_class.'::before' => 'background-color: {{VALUE}}',
				],
			]
		);

		anant_border_control(
			$this,
			[
				'name'     => 'card_border_type',
				'label'    => 'Border Type',
				'selector' => '{{WRAPPER}} .'.$this->price_list_card_class,
			]
		);

		anant_border_radius_control(
			$this,
			[
				'key'       => 'card_border_radius',
				'label'     => 'Border Radius',
				'selectors' => [
					'{{WRAPPER}} .'.$this->price_list_card_class => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
					'{{WRAPPER}} .'.$this->price_list_card_class => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'card_inner_padding',
			[
				'label'     => esc_html__('Inner Content Padding', 'anant-addons-for-elementor'),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .'.$this->price_card_inner_class.'' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
					'{{WRAPPER}} .'.$this->price_list_card_class => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		anant_box_shadow_control(
			$this,
			[
				'key'      => 'card_box_shadow',
				'label'    => 'Box Shadow',
				'selector' => '{{WRAPPER}}  .'.$this->price_list_card_class,
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'price',
			[
				'label' => __( 'Price Settings', 'anant-addons-for-elementor' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'price_color',
			[
				'label'     => __( 'Color', 'anant-addons-for-elementor' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}}  .'.$this->price_list_card_class.' .amount' => 'color: {{VALUE}}',
				],
			]
		);

		$this->add_control(
			'price_bg_color',
			[
				'label'     => __( 'Background Color', 'anant-addons-for-elementor' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}}  .'.$this->price_list_card_class.' .amount' => 'background-color: {{VALUE}}',
				],
			]
		);

		anant_typography_control(
			$this,
			[
				'name'     => 'price_typography',
				'label'    => 'Typography',
				'selector' => '{{WRAPPER}}  .'.$this->price_list_card_class.' .amount',
 			]
		);

		anant_border_control(
			$this,
			[
				'name'     => 'price_border_type',
				'label'    => 'Border Type',
				'selector' => '{{WRAPPER}} .'.$this->price_list_card_class.' .amount',
 			]
		);

		anant_border_radius_control(
			$this,
			[
				'key'       => 'price_border_radius',
				'label'     => 'Border Radius',
				'selectors' => [
					'{{WRAPPER}} .'.$this->price_list_card_class.' .amount' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'price_padding',
			[
				'label'     => esc_html__('Padding', 'anant-addons-for-elementor'),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .'.$this->price_list_card_class.' .amount' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'price_margin',
			[
				'label'     => esc_html__('Margin', 'anant-addons-for-elementor'),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .'.$this->price_list_card_class.' .amount' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'image_settings',
			[
				'label' => __( 'Image Settings', 'anant-addons-for-elementor' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'image_position',
			[
				'label' => __('Image Position', 'anant-addons-for-elementor') , 
				'type' => Controls_Manager::CHOOSE, 
				'options' => [
					'row' => [
						'title' => __('Left', 'anant-addons-for-elementor') , 
						'icon' => 'eicon-h-align-left', 
					], 
					'column' => [
						'title' => __('Center', 'anant-addons-for-elementor') , 
						'icon' => 'eicon-v-align-top', 
					], 
					'row-reverse' => [
						'title' => __('Right', 'anant-addons-for-elementor') , 
						'icon' => 'eicon-h-align-right',
					], 
				], 
				'selectors' => [
					'{{WRAPPER}} .'.$this->price_list_card_class.' .ant-inner' => 'flex-direction: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'image_vertical_align',
			[
				'label' => __('Vertical Alignment', 'anant-addons-for-elementor') , 
				'type' => Controls_Manager::CHOOSE, 
				'options' => [
					'flex-start' => [
						'title' => __('Top', 'anant-addons-for-elementor') , 
						'icon' => 'eicon-v-align-top', 
					], 
					'center' => [
						'title' => __('Middle', 'anant-addons-for-elementor') , 
						'icon' => 'eicon-v-align-middle', 
					], 
					'flex-end' => [
						'title' => __('Bottom', 'anant-addons-for-elementor') , 
						'icon' => 'eicon-v-align-bottom',
					], 
				], 
				'selectors' => [
					'{{WRAPPER}} .'.$this->price_list_card_image_class => 'align-self: {{VALUE}};',
				],
			]
		);

		anant_border_control(
			$this,
			[
				'name'     => 'image_border_type',
				'label'    => 'Border Type',
				'selector' => '{{WRAPPER}} .'.$this->price_list_card_image_class,
			]
		);

		anant_border_radius_control(
			$this,
			[
				'key'       => 'image_border_radius',
				'label'     => 'Border Radius',
				'selectors' => [
					'{{WRAPPER}} .'.$this->price_list_card_image_class => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					'{{WRAPPER}} .'.$this->price_list_card_image_class => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'image_width',
			[
				'label'           => __( 'Image Width', 'anant-addons-for-elementor' ),
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
					'{{WRAPPER}} .'.$this->price_list_card_image_class => 'width: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .'.$this->price_list_card_image_class.'::before' => 'width: {{SIZE}}{{UNIT}};',
				],
			],
		);

		$this->add_responsive_control(
			'image_height',
			[
				'label'           => __( 'Image Height', 'anant-addons-for-elementor' ),
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
					'{{WRAPPER}} .'.$this->price_list_card_image_class => 'height: {{SIZE}}{{UNIT}};',
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
					'{{WRAPPER}} .'.$this->price_list_card_image_class => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		anant_box_shadow_control(
			$this,
			[
				'key'      => 'image_box_shadow',
				'label'    => 'Box Shadow',
				'selector' => '{{WRAPPER}}  .'.$this->price_list_card_image_class,
			]
		);

		$this->end_controls_section();
		
		$this->start_controls_section(
			'price_heading_title',
			[
				'label' => __( 'Title Settings', 'anant-addons-for-elementor' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_responsive_control(
			'price_heading_title_alignment',
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
				'condition' => [
					'template_style!' => ['layout_1']
				],
				'toggle'    => true,
				'selectors' => [
					'{{WRAPPER}} .'.$this->price_list_card_heading_class => 'text-align: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'price_heading_title_color',
			[
				'label'     => __( 'Color', 'anant-addons-for-elementor' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}}  .'.$this->price_list_card_heading_class => 'color: {{VALUE}}',
				],
			]
		);

		anant_typography_control(
			$this,
			[
				'name'     => 'price_heading_title_typography',
				'label'    => 'Typography',
				'selector' => '{{WRAPPER}}  .'.$this->price_list_card_heading_class,
			]
		);

		$this->add_responsive_control(
			'price_heading_title_margin',
			[
				'label'     => esc_html__('Margin', 'anant-addons-for-elementor'),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .'.$this->price_list_card_heading_class => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'price_description',
			[
				'label' => __( 'Description Settings', 'anant-addons-for-elementor' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_responsive_control(
			'price_description_alignment',
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
					'{{WRAPPER}} .'.$this->price_list_card_description_class => 'text-align: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'price_description_color',
			[
				'label'     => __( 'Color', 'anant-addons-for-elementor' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}}  .'.$this->price_list_card_description_class => 'color: {{VALUE}}',
				],
			]
		);

		anant_typography_control(
			$this,
			[
				'name'     => 'price_description_typography',
				'label'    => 'Typography',
				'selector' => '{{WRAPPER}}  .'.$this->price_list_card_description_class,
			]
		);

		$this->add_responsive_control(
			'price_description_margin',
			[
				'label'     => esc_html__('Margin', 'anant-addons-for-elementor'),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .'.$this->price_list_card_description_class => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'price_separator',
			[
				'label' => __( 'Separator Settings', 'anant-addons-for-elementor' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);
		
		$this->add_responsive_control(
			'price_separator_style',
			[
				'label'       => esc_html__( 'Separator Style', 'anant-addons-for-elementor' ),
				'placeholder' => esc_html__( 'Choose Template from Here', 'anant-addons-for-elementor' ),
				'type'        => \Elementor\Controls_Manager::SELECT,
				'default'     => 'dashed',
				'options'     => [
					'none'      => esc_html__( 'None' ),
					'solid'      => esc_html__( 'Solid' ),
					'dotted'      => esc_html__( 'Dotted' ),
					'dashed'      => esc_html__( 'Dashed' ),
				],
				'selectors' => [
					'{{WRAPPER}} .'.$this->price_list_feature_separator_class => 'border-bottom-style:{{VALUE}};',
				],
			]
		);

		$this->add_responsive_control(
			'price_separator_height',
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
					'{{WRAPPER}} .'.$this->price_list_feature_separator_class => 'border-bottom-width: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_control(
			'price_separator_color',
			[
				'label'     => __( 'Separator Color', 'anant-addons-for-elementor' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .'.$this->price_list_feature_separator_class => 'border-bottom-color: {{VALUE}}',
				],
			]
		);

		$this->add_responsive_control(
			'price_separator_margin',
			[
				'label'     => esc_html__('Margin', 'anant-addons-for-elementor'),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .'.$this->price_list_feature_separator_class => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->end_controls_section();
	}

	protected function render() {

		$settings = $this->get_settings_for_display();

		$show_image = $settings['show_image'];
		$show_title = $settings['show_title'];
		$show_amount = $settings['show_amount'];
		$show_description = $settings['show_description'];
		
		$price_list_item = $settings['price_list_item'];

		$template_style = $settings['template_style'];

		if ($template_style == 'layout_1') {
			if (isset($price_list_item) && !empty($price_list_item))
			{
				foreach ($price_list_item as $key => $item)
				{
					if ($key === 4 ) { break; }
					$image_url = $item['card_image' ]['url'];
					$title = $item['card_title' ];
					$amount = $item['card_amount']; 
					$description = $item['card_description']; 
					?>

					<div class="ant-price-list one <?php echo esc_attr($this->price_list_card_class) ?>">
						<div class="ant-inner">
							<?php
							if ( $show_image === 'yes' ) {
								?>
									<div class="ant-list-image <?php echo esc_attr($this->price_list_card_image_class) ?>">
										<img class="img-cover" src="<?php echo esc_url($image_url)?>" alt="<?php echo esc_attr($title) ?>">
									</div>
								<?php
							}
							?>
							<div class="ant-price-content <?php echo esc_attr($this->price_card_inner_class) ?>">
								<div class="ant-list">
									<?php
										if ( $show_title === 'yes' ) {
											?>
											<h4 class="ant-title <?php echo esc_attr($this->price_list_card_heading_class) ?>"><?php echo esc_html($title) ;?></h4>
										<?php
										}
										?>
										<span class="ant-title-connector <?php echo esc_attr($this->price_list_feature_separator_class) ?>">
										</span>
										<?php
										if ( $show_amount === 'yes' ) {
											?>
											<span class="amount"><?php echo esc_html($amount); ?></span>
										<?php
										}
										?>
								</div>
								<?php
								if ( $show_description === 'yes' ) {
										?>
											<p class="text <?php echo esc_attr($this->price_list_card_description_class) ?>"><?php echo esc_html($description) ?></p>
										<?php
									}
								?>
							</div>
						</div>
					</div>
				<?php
				}
			}
		}
	}
}