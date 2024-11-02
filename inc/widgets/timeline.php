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

class AnantContentTimeline extends \Elementor\Widget_Base {

	private $timeline_card_class = 'anant-timeline-card';
	private $timeline_card_date_class = 'anant-timeline-card-date';
	private $timeline_card_heading_class = 'anant-timeline-card-heading';
	private $timeline_card_subtitle_class = 'anant-timeline-card-subtitle';
	private $timeline_card_image = 'anant-timeline-card-image';
	private $timeline_inner_line = 'anant-timeline-inner-line';
	private $timeline_line = 'anant-timeline-line';
	private $timeline_dot = 'anant-timeline-dot';
	private $timeline_card_description_class = 'anant-timeline-card-description';

	public function get_name() {
		return 'anant-timeline';
	}

	public function get_title() {
		return __( 'Content Timeline', 'anant-addons-for-elementor' );
	}

	public function get_categories() {
		return [ 'anant-elements' ];
	}

	public function get_icon() {
		return 'ant-icon eicon-time-line';
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
			'timeline',
			'content',
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
			'anant_timeline_pro_notice',
			[
				'raw' => 'Only Available in <a href="https://anantaddons.com/" target="_blank">Pro Version!</a>',
				'type' => \Elementor\Controls_Manager::RAW_HTML,
				'content_classes' => 'anant-pro-notice',
				'condition' => [
                    'template_style!' => ['layout_1'],
                ],
			]
		);
		
		$repeater = new Repeater();
		$repeater->add_control(
			'template_style',
			[
				'label'       => esc_html__( 'Template Style', 'anant-addons-for-elementor' ), 
				'type'        => \Elementor\Controls_Manager::HIDDEN, 
			]
		);
		$repeater->add_control(
			'card_date', [
				'label' => __( 'Date', 'anant-addons-for-elementor' ),
				'type' => \Elementor\Controls_Manager::TEXT, 
				'default' => __( '01 jan 2008', 'anant-addons-for-elementor' ),
				'label_block' => true, 
			]
		);

		$repeater->add_control(
			'card_title', [
				'label' => __( 'Title', 'anant-addons-for-elementor' ),
				'type' => \Elementor\Controls_Manager::TEXT, 
				'default' => __( 'Timeline item', 'anant-addons-for-elementor' ),
				'label_block' => true, 
			]
		);

		$repeater->add_control(
			'card_subtitle', [
				'label' => __( 'Subtitle', 'anant-addons-for-elementor' ),
				'type' => \Elementor\Controls_Manager::TEXT, 
				'default' => __( 'Items', 'anant-addons-for-elementor' ),
				'label_block' => true, 
			]
		);

		$description = __( 'Aenean ut turpis blandit eros convallis congue sit amet a libero.', 'anant-addons-for-elementor' );

		$repeater->add_control(
			'card_description',
			[
				'label' => __( 'Description', 'anant-addons-for-elementor' ),
				'type' => \Elementor\Controls_Manager::TEXTAREA,  
				'default' => esc_html( $description ),
				'label_block' => true,
			]
		);
        
		$repeater->add_control(
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
			'timeline_block', 
			[
			'label' => __('Add Timeline', 'anant-addons-for-elementor') , 
			'type' => Controls_Manager::REPEATER, 
			'fields' => $repeater->get_controls() , 
			'default' => [
				[
					'card_date' => __('01 jan 2000', 'anant-addons-for-elementor') ,
					'card_title' => __('Timeline item ','anant-addons-for-elementor') ,
					'card_subtitle' => __('Item-1','anant-addons-for-elementor') ,
					'card_description' => esc_html( $description ), 
				],
				[
					'card_date' => __('01 jan 2005', 'anant-addons-for-elementor') ,
					'card_title' => __('Timeline item ','anant-addons-for-elementor') ,
					'card_subtitle' => __('Item-2', 'anant-addons-for-elementor') ,
					'card_description' => esc_html( $description ), 
				],
				[
					'card_date' => __('01 jan 2010', 'anant-addons-for-elementor') ,
					'card_title' => __('Timeline item ','anant-addons-for-elementor') ,
					'card_subtitle' => __('Item-3', 'anant-addons-for-elementor') ,
					'card_description' => esc_html( $description ), 
				],
				[
					'card_date' => __('01 jan 2020', 'anant-addons-for-elementor') ,
					'card_title' => __('Timeline item ','anant-addons-for-elementor') ,
					'card_subtitle' => __('Item-4', 'anant-addons-for-elementor') ,
					'card_description' => esc_html( $description ), 
				],
			], 
			'title_field' => '{{{ card_title }}}', 
		]
		);

		$this->add_control(
			'anant_timeline_repeater_pro_notice',
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
			'show_date',
			[
				'label' => __( 'Show Date', 'anant-addons-for-elementor' ),
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
			'show_subtitle',
			[
				'label' => __( 'Show Subtitle', 'anant-addons-for-elementor' ),
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
		
		//STYLE
		// Box Settings
		$this->start_controls_section(
			'timeline_settings',
			[
				'label' => __( 'Timeline Settings', 'anant-addons-for-elementor' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);

		$slug = 'timeline_box';
		$this->add_control(
			$slug.'_bg_color',
			[
				'label'     => __( 'Background Color', 'anant-addons-for-elementor' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}}  .'.$this->timeline_card_class => 'background-color: {{VALUE}}',
				],
			]
		);

		anant_border_control(
			$this,
			[
				'name'     => $slug.'_border_type',
				'label'    => 'Border Type',
				'selector' => '{{WRAPPER}} .'.$this->timeline_card_class,
			]
		);

		anant_border_radius_control(
			$this,
			[
				'key'       => $slug.'_border_radius',
				'label'     => 'Border Radius',
				'selectors' => [
					'{{WRAPPER}} .'.$this->timeline_card_class => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
					'{{WRAPPER}} .'.$this->timeline_card_class => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
					'{{WRAPPER}} .'.$this->timeline_card_class => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		anant_box_shadow_control(
			$this,
			[
				'key'      => $slug.'_box_shadow',
				'label'    => 'Box Shadow',
				'selector' => '{{WRAPPER}}  .'.$this->timeline_card_class,
			]
		);

		$this->end_controls_section();

		//timeline_date
		$this->start_controls_section(
			'date_settings',
			[
				'label' => __( 'Date Settings', 'anant-addons-for-elementor' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);

		$slug = 'timeline_date';
		$this->add_responsive_control(
			$slug.'_date_alignment',
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
					'{{WRAPPER}} .'.$this->timeline_card_date_class => 'text-align: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			$slug.'_heading_date_bg_color',
			[
				'label'     => __( 'Background Color', 'anant-addons-for-elementor' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}}  .'.$this->timeline_card_date_class.' span' => 'background-color: {{VALUE}}',
				],
			]
		);

		$this->add_control(
			$slug.'_heading_date_color',
			[
				'label'     => __( 'Color', 'anant-addons-for-elementor' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}}  .'.$this->timeline_card_date_class.' span' => 'color: {{VALUE}}',
				],
			]
		);
		anant_typography_control(
			$this,
			[
				'name'     => $slug.'_date_typography',
				'label'    => 'Typography',
				'selector' => '{{WRAPPER}}  .'.$this->timeline_card_date_class.' span',
			]
		);
		anant_border_control(
			$this,
			[
				'name'     => $slug.'_border_type',
				'label'    => 'Border Type',
				'selector' => '{{WRAPPER}} .'.$this->timeline_card_date_class.' span',
			]
		);
		anant_border_radius_control(
			$this,
			[
				'key'       => $slug.'_border_type',
				'label'     => 'Border Radius',
				'selectors' => [
					'{{WRAPPER}} .'.$this->timeline_card_date_class.' span' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_responsive_control(
			$slug.'_date_padding',
			[
				'label'     => esc_html__('Padding', 'anant-addons-for-elementor'),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .'.$this->timeline_card_date_class.' span' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_responsive_control(
			$slug.'_date_margin',
			[
				'label'     => esc_html__('Margin', 'anant-addons-for-elementor'),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .'.$this->timeline_card_date_class => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->end_controls_section();

		//timeline_title
		$this->start_controls_section(
			'timeline_heading',
			[
				'label' => __( 'Title Setting', 'anant-addons-for-elementor' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);

		$slug = 'timeline_title';
		$this->add_responsive_control(
			$slug.'_alignment',
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
					'{{WRAPPER}} .'.$this->timeline_card_heading_class => 'text-align: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			$slug.'_color',
			[
				'label'     => __( 'Color', 'anant-addons-for-elementor' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}}  .'.$this->timeline_card_heading_class.' a' => 'color: {{VALUE}}',
				],
			]
		);

		anant_typography_control(
			$this,
			[
				'name'     =>  $slug.'_typography',
				'label'    => 'Typography',
				'selector' => '{{WRAPPER}}  .'.$this->timeline_card_heading_class,
			]
		);

		$this->add_responsive_control(
			$slug.'_margin',
			[
				'label'     => esc_html__('Margin', 'anant-addons-for-elementor'),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .'.$this->timeline_card_heading_class => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->end_controls_section();

		// Subtitle
		$this->start_controls_section(
			'subtitle_settings',
			[
				'label' => __( 'Subtitle Setting', 'anant-addons-for-elementor' ),
				'tab'   => Controls_Manager::TAB_STYLE,  
				'condition' => [ 
					'show_subtitle' => 'yes',
				],
			]
		);
		
		$slug = 'timeline_subtitle';
		$this->add_responsive_control(
			$slug.'_alignment',
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
					'{{WRAPPER}} .'.$this->timeline_card_subtitle_class => 'text-align: {{VALUE}};',
				],
			]
		);
		
		$this->add_control(
			$slug.'_color',
			[
				'label'     => __( 'Color', 'anant-addons-for-elementor' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}}  .'.$this->timeline_card_subtitle_class.' span' => 'color: {{VALUE}}',
				],
			]
		);
		
		$this->add_control(
			$slug.'_bg_color',
			[
				'label'     => __( 'Background Color', 'anant-addons-for-elementor' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}}  .'.$this->timeline_card_subtitle_class.' span' => 'background-color: {{VALUE}}',
				],
			]
		);

		anant_typography_control(
			$this,
			[
				'name'     => $slug.'_typography',
				'label'    => 'Typography',
				'selector' => '{{WRAPPER}}  .'.$this->timeline_card_subtitle_class.' span',
			]
		);

		
		anant_border_control(
			$this,
			[
				'name'     => $slug.'_border_type',
				'label'    => 'Border Type',
				'selector' => '{{WRAPPER}} .'.$this->timeline_card_subtitle_class.' span',
			]
		);

		anant_border_radius_control(
			$this,
			[
				'key'       => $slug.'_border_radius',
				'label'     => 'Border Radius',
				'selectors' => [
					'{{WRAPPER}} .'.$this->timeline_card_subtitle_class.' span' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
					'{{WRAPPER}} .'.$this->timeline_card_subtitle_class.' span' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
					'{{WRAPPER}} .'.$this->timeline_card_subtitle_class => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->end_controls_section();

		// timeline description
		$this->start_controls_section(
			'timeline_description',
			[
				'label' => __( 'Description Setting', 'anant-addons-for-elementor' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);
 
		$slug = 'timeline_desc';
		$this->add_responsive_control(
			$slug.'_alignment',
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
					'{{WRAPPER}} .'.$this->timeline_card_description_class => 'text-align: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			$slug.'_color',
			[
				'label'     => __( 'Color', 'anant-addons-for-elementor' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}}  .'.$this->timeline_card_description_class => 'color: {{VALUE}}',
				],
			]
		);

		anant_typography_control(
			$this,
			[
				'name'     => $slug.'_typography',
				'label'    => 'Typography',
				'selector' => '{{WRAPPER}}  .'.$this->timeline_card_description_class,
			]
		);

		$this->add_responsive_control(
			$slug.'_margin',
			[
				'label'     => esc_html__('Margin', 'anant-addons-for-elementor'),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .'.$this->timeline_card_description_class => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		
		$this->end_controls_section();

		//vertical divider
	
		$this->start_controls_section(
			'vertical_divider',
			[
				'label' => __( 'Divider', 'anant-addons-for-elementor' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);

		$slug = 'divider';		
		$this->add_control(
			$slug.'_heading',
			[
				'label' => esc_html__( 'Divider', 'anant-addons-for-elementor' ),
				'type' => \Elementor\Controls_Manager::HEADING,
				//'separator' => 'before',
			]
		);
		$this->add_responsive_control(
			$slug.'_line_width',
			[
				'label'           => __( 'Width', 'anant-addons-for-elementor' ),
				'type'            => Controls_Manager::SLIDER,
				'size_units'      => [ 'px' , '%'],
				'range'           => [
					'px' => [
						'min' => 0,
						'max' => 10,
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
					'{{WRAPPER}} .'.$this->timeline_line => 'width: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .'.$this->timeline_inner_line => 'width: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_control(
			$slug.'_color',
			[
				'label'     => __( 'Color', 'anant-addons-for-elementor' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .'.$this->timeline_line=> 'background-color: {{VALUE}}',
				],
			]
		); 

		$this->add_control(
			$slug.'_inner_color',
			[
				'label'     => __( 'Scroll Color', 'anant-addons-for-elementor' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .'.$this->timeline_inner_line=> 'background-color: {{VALUE}}',
				],
			]
		); 
		$this->add_control(
			$slug.'_dot_heading',
			[
				'label' => esc_html__( 'Dot', 'anant-addons-for-elementor' ),
				'type' => \Elementor\Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);
		$this->add_responsive_control(
			$slug.'_dot_width',
			[
				'label'           => __( 'Width', 'anant-addons-for-elementor' ),
				'type'            => Controls_Manager::SLIDER,
				'size_units'      => [ 'px', '%'],
				'range'           => [
					'px' => [
						'min' => 0,
						'max' => 50,
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
					'{{WRAPPER}} .'.$this->timeline_dot => 'width: {{SIZE}}{{UNIT}}; height: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .'.$this->timeline_dot.'.highlighted-dot' => 'width: {{SIZE}}{{UNIT}}; height: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_control(
			$slug.'_dot_color',
			[
				'label'     => __( 'Color', 'anant-addons-for-elementor' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .'.$this->timeline_dot=> 'background-color: {{VALUE}}',
				],
			]
		);
		
		$this->add_control(
			$slug.'_dot_inner_color',
			[
				'label'     => __( 'Scroll Color', 'anant-addons-for-elementor' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .'.$this->timeline_dot.'.highlighted-dot'=> 'background-color: {{VALUE}}',
				],
			]
		); 
		$this->add_responsive_control(
			$slug.'_dot_position',
			[
				'label'           => __( 'Posiition', 'anant-addons-for-elementor' ),
				'type'            => Controls_Manager::SLIDER,
				'size_units'      => [ 'px', '%'],
				'range'           => [
					'px' => [
						'min' => 0,
						'max' => 1000,
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
					'{{WRAPPER}} .'.$this->timeline_dot => 'left: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .'.$this->timeline_dot.'.highlighted-dot' => 'left:{{SIZE}}{{UNIT}};',  
				],
			]
		);
		$this->end_controls_section(); 
	}

	protected function render() {
		$settings = $this->get_settings_for_display();

		$show_title = $settings['show_title'];
		$show_date = $settings['show_date'];
		$show_description = $settings['show_description'];
		$show_subtitle = $settings['show_subtitle'];

		$timeline_block = $settings['timeline_block'];

		$template_style = $settings['template_style'];

		if ($template_style == 'layout_1') {
			?>
			<div class="ant-timeline-items">
				<span class="timeline-line <?php echo esc_attr($this->timeline_line )?>"></span>
				<span class="timeline-inner-line <?php echo esc_attr($this->timeline_inner_line )?>"></span>
				<?php
				if (isset($timeline_block) && !empty($timeline_block)) { 

					foreach ($timeline_block as $key => $content_block)
					{
						if ($key === 4 ) { break; }
						$date_block = $content_block['card_date'];
						$title_block = $content_block['card_title'];
						$subtitle_block = $content_block['card_subtitle'];
						$desc_block = $content_block['card_description'];
						$link_block = $content_block['card_link']['url']; 
						$target = $content_block['card_link']['is_external'] ? ' target=_blank' : '';
						$nofollow = $content_block['card_link']['nofollow'] ? ' rel=nofollow' : '';
						?>
						<div class="ant-timeline-item">
							<div class="timeline-dot <?php echo esc_attr($this->timeline_dot )?>"></div>
							<?php
							if ( $show_date === 'yes' ) {
								?>
									<div class="timeline-date <?php echo esc_attr($this->timeline_card_date_class )?>">
										<span><?php echo esc_html($date_block); ?></span>
									</div>
								<?php
							}
							?>
							<div class="ant-timeline-content <?php echo esc_attr($this->timeline_card_class )?>">
							<?php
							if ( $show_subtitle === 'yes' ) {
								?>
									<div class="ant-subtitle <?php echo esc_attr($this->timeline_card_subtitle_class )?>">
										<span><?php echo esc_html($subtitle_block) ?></span>
									</div>
								<?php
								}
							?>
							<?php
							if ( $show_title === 'yes' ) {
								?>
									<div class="heading">
										<h3 class="title <?php echo esc_attr($this->timeline_card_heading_class )?>">
										<a href="<?php echo esc_url($link_block) ?>" <?php echo esc_attr($target) ?> <?php echo esc_attr($nofollow) ?>><?php echo esc_html($title_block) ?></a></h3>
									</div>
								<?php
							}
							?>
							<?php
							if ( $show_description === 'yes' ) {
								?>
									<div class="description <?php echo esc_attr($this->timeline_card_description_class )?>">
										<span><?php echo esc_html($desc_block); ?></span>
									</div>
								<?php
							}
							?>
							</div>
						</div>
						<?php
					} 
				}
				?>
			</div>
			<?php
		}
	}
}