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
use Elementor\Repeater;
use Elementor\Group_Control_Border;

class AnantAuthorlist extends \Elementor\Widget_Base {

	private $author_list_class = 'anant-author-list';
	private $author_list_inner_class = 'anant-author-inner-list';
	private $author_list_image_class = 'anant-author-list-image';
	private $author_list_label_class = 'anant-author-list-label';
	private $author_list_heading_class = 'anant-author-list-heading';
	private $author_list_social_icon_class = 'anant-author-list-social-icon';
	private $author_list_designation_class = 'anant-author-list-designation';
	private $author_list_description_class = 'anant-author-list-description';

	public function get_name() {
		return 'anant-author-list';
	}

	public function get_title() {
		return __( 'Author List', 'anant-addons-for-elementor' );
	}

	public function get_categories() {
		return [ 'anant-elements' ];
	}

	public function get_icon() {
		return 'ant-icon eicon-post-list';
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
		return ['author',
				'user',
				'list', 
				'items',
				'',
				' author',
				'anant addons',
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
			'anant_author_list_pro_notice',
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
			'card_image',
			[
				'label'   => __( 'Choose Image', 'anant-addons-for-elementor' ),
				'type'    => Controls_Manager::MEDIA,
				'default' => [
					'url' => anant_placeholder_image_src(),
				],
			]
		);

		$this->add_control(
			'card_title', [
				'label' => __( 'Title', 'anant-addons-for-elementor' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => __( 'Card Title' , 'anant-addons-for-elementor' ),
				'label_block' => true,
			]
		);

		$this->add_control(
			'card_designation',
			[
				'label' => __( 'Designation', 'anant-addons-for-elementor' ),
				'type' => \Elementor\Controls_Manager::TEXT, 
				'default' => __( 'Author', 'anant-addons-for-elementor' ),
				'placeholder' => __( 'Type your designation here', 'anant-addons-for-elementor' ),
			]
		);

		$this->add_control(
			'card_description',
			[
				'label' => __( 'Description', 'anant-addons-for-elementor' ),
				'type' => \Elementor\Controls_Manager::TEXTAREA,
				'rows' => 10,
				'default' => esc_html__( 'Aenean ut turpis blandit eros convallis congue sit amet a libero', 'anant-addons-for-elementor' ),
				'placeholder' => __( 'Type your description here', 'anant-addons-for-elementor' ),
			]
		);

		$this->add_control(
			'card_label', [
				'label' => __( 'label', 'anant-addons-for-elementor' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => __( 'Post-1' , 'anant-addons-for-elementor' ),
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
			'show_label',
			[
				'label' => __( 'Show label', 'anant-addons-for-elementor' ),
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
			'show_designation',
			[
				'label' => __( 'Show Designation', 'anant-addons-for-elementor' ),
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
		$this->add_control(
			'show_link',
			[
				'label' => __( 'Show Social Icon', 'anant-addons-for-elementor' ),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'label_on' => __( 'Show', 'anant-addons-for-elementor' ),
				'label_off' => __( 'Hide', 'anant-addons-for-elementor' ),
				'return_value' => 'yes',
				'default' => 'yes',
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'social_icons_section',
			[
				'label' => __( 'Social Icon Settings', 'anant-addons-for-elementor' ),
				'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);

		$repeater = new Repeater();
		$repeater->add_control(
			'author_social_title', 
			[
				'label' => __('Title', 'anant-addons-for-elementor') ,
				'type' => Controls_Manager::TEXT, 
				'label_block' => true,  
			]
		);
		$repeater->add_control(
			'author_social_icon',
			[
				'label' => __( 'Icon', 'anant-addons-for-elementor' ),
				'type' => \Elementor\Controls_Manager::ICONS, 

			]
		);

		$repeater->add_control(
			'author_social_link',
			[
				'label' => __( 'Link', 'anant-addons-for-elementor' ),
				'type' => \Elementor\Controls_Manager::URL,
				'placeholder' => __( 'https://your-link.com', 'anant-addons-for-elementor' ),
				'show_external' => true, 
			]
		);

		$this->add_control(
			'author_socials',
			[
				'label'       => __( 'socials', 'anant-addons-for-elementor' ),
				'type'        => Controls_Manager::REPEATER,
				'fields'      => $repeater->get_controls(),
				'default'     => [
					[
						'author_social_title' => __('Facebook', 'anant-addons-for-elementor') ,
						'author_social_icon' => ['value' => 'fab fa-facebook-f', 'library' => 'brands',],
						'author_social_link' => ['url' => '#', 'is_external' => true, 'nofollow' => true,]
					],
					[
						'author_social_title' => __('Telegram', 'anant-addons-for-elementor') ,
						'author_social_icon' => ['value' => 'fab fa-telegram-plane', 'library' => 'brands',],
						'author_social_link' => ['url' => '#', 'is_external' => true, 'nofollow' => true,]
					],
					[
						'author_social_title' => __('Instagram', 'anant-addons-for-elementor') ,
						'author_social_icon' => ['value' => 'fab fa-instagram', 'library' => 'brands',],
						'author_social_link' => ['url' => '#', 'is_external' => true, 'nofollow' => true,]
					],
					[
						'author_social_title' => __('Twitter', 'anant-addons-for-elementor') ,
						'author_social_icon' => ['value' => 'fab fa-twitter', 'library' => 'brands',],
						'author_social_link' => ['url' => '#', 'is_external' => true, 'nofollow' => true,]
					],
				],
				'title_field' => '{{{ author_social_title }}}',
			]
		); 

		$this->add_control(
			'anant_author_list_repeater_pro_notice',
			[
				'raw' => 'More than 4 are available in <a href="https://anantaddons.com/" target="_blank">Pro Version!</a>',
				'type' => \Elementor\Controls_Manager::RAW_HTML,
				'content_classes' => 'anant-pro-notice',
			]
		);

		$this->end_controls_section();

		anant_pro_promotion_controls($this);

		// styles
		// Auhtor Box Settings
		$this->start_controls_section(
			'author_box_settings',
			[
				'label' => __( 'Author Box Settings ', 'anant-addons-for-elementor' ),
				'tab'   => Controls_Manager::TAB_STYLE, 
			]
		);
		
		$slug = 'author_box';

		$this->add_control(
			$slug.'_bg_color',
			[
				'label'     => __( 'Background Color', 'anant-addons-for-elementor' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}}  .'.$this->author_list_class => 'background-color: {{VALUE}}',
				], 
			]
		);
		
		$this->add_control(
			$slug.'_bg_hover_color',
			[
				'label'     => __( 'Hover Background Color', 'anant-addons-for-elementor' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}}  .'.$this->author_list_class.':hover' => 'background-color: {{VALUE}}',
				], 
			]
		);

		anant_border_control(
			$this,
			[
				'name'     => $slug.'_border_type',
				'label'    => 'Border Type',
				'selector' => '{{WRAPPER}} .'.$this->author_list_class,
			]
		);

		anant_border_radius_control(
			$this,
			[
				'key'       => $slug.'_border_radius',
				'label'     => 'Border Radius',
				'selectors' => [
					'{{WRAPPER}} .'.$this->author_list_class => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
					'{{WRAPPER}} .'.$this->author_list_class => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			$slug.'_inner_padding',
			[
				'label'     => esc_html__('Inner Padding', 'anant-addons-for-elementor'),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .'.$this->author_list_inner_class => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
					'{{WRAPPER}} .'.$this->author_list_class => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		anant_box_shadow_control(
			$this,
			[
				'key'      => $slug.'_box_shadow',
				'label'    => 'Box Shadow',
				'selector' => '{{WRAPPER}}  .'.$this->author_list_class,
			]
		);

		$this->end_controls_section();
		

		// Auhtor Image Settings
		$this->start_controls_section(
			'author_image_settings',
			[
				'label' => __( 'Image Settings ', 'anant-addons-for-elementor' ),
				'tab'   => Controls_Manager::TAB_STYLE, 
				'condition' => [ 
					'show_image' => 'yes',
				],
			], 
		);
		
		$slug = 'author_image';
		
		$this->add_responsive_control(
			$slug.'_image_width',
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
				'selectors'       => [
					'{{WRAPPER}} .'.$this->author_list_image_class.' a' => 'width: {{SIZE}}{{UNIT}};',
				],
			],
		);

		$this->add_responsive_control(
			$slug.'_image_height',
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
					'{{WRAPPER}} .'.$this->author_list_image_class.' a' => 'height: {{SIZE}}{{UNIT}};',
				],
			]
		);

		anant_border_control(
			$this,
			[
				'name'     => $slug.'_border_type',
				'label'    => 'Border Type',
				'selector' => '{{WRAPPER}} .'.$this->author_list_image_class.' a',
			]
		);

		anant_border_radius_control(
			$this,
			[
				'key'       => $slug.'_border_radius',
				'label'     => 'Border Radius',
				'selectors' => [
					'{{WRAPPER}} .'.$this->author_list_image_class.' a' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
					'{{WRAPPER}} .'.$this->author_list_image_class.' a' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->end_controls_section();

		
		// Author tag
		$this->start_controls_section(
			'author_label_settings',
			[
				'label' => __( 'Label', 'anant-addons-for-elementor' ),
				'tab'   => Controls_Manager::TAB_STYLE,  
				'condition' => [ 
					'show_label' => 'yes',
				],
				
			]
		);
		
		$slug = 'author_label';
		$this->add_control(
			$slug.'_position',
			[
				'label'     => __( 'Position', 'anant-addons-for-elementor' ),
				'type'      => Controls_Manager::CHOOSE,
				'options'   => [
					'left' => [
						'title' => __( 'Left', 'anant-addons-for-elementor' ),
						'icon'  => 'eicon-text-align-left',
					],
					'right' => [
						'title' => __( 'Right', 'anant-addons-for-elementor' ),
						'icon'  => 'eicon-text-align-right',
					],
				],
				'toggle'    => true,
				'prefix_class' => 'ant-label-',
				'default' => 'right',
			]
		);
		
		$this->add_control(
			$slug.'_color',
			[
				'label'     => __( 'Color', 'anant-addons-for-elementor' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}}  .'.$this->author_list_label_class.' span' => 'color: {{VALUE}}',
				],
			]
		);
		
		$this->add_control(
			$slug.'_color_hover',
			[
				'label'     => __( 'Hover Color', 'anant-addons-for-elementor' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}}  .'.$this->author_list_class.':hover .'.$this->author_list_label_class.' span' => 'color: {{VALUE}}',
				],
			]
		);
		
		
		$this->add_control(
			$slug.'_bg_color',
			[
				'label'     => __( 'Background Color', 'anant-addons-for-elementor' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}}  .'.$this->author_list_label_class.' span' => 'background-color: {{VALUE}}',
				],
			]
		);

		$this->add_control(
			$slug.'_color_bg_hover',
			[
				'label'     => __( 'Hover Background Color', 'anant-addons-for-elementor' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}}  .'.$this->author_list_class.':hover .'.$this->author_list_label_class.' span' => 'background-color: {{VALUE}}',
				],
			]
		);

		anant_typography_control(
			$this,
			[
				'name'     => $slug.'_typography',
				'label'    => 'Typography',
				'selector' => '{{WRAPPER}}  .'.$this->author_list_label_class.' span',
			]
		);

		anant_border_control(
			$this,
			[
				'name'     => $slug.'_border_type',
				'label'    => 'Border Type',
				'selector' => '{{WRAPPER}} .'.$this->author_list_label_class.' span',
			]
		);

		anant_border_radius_control(
			$this,
			[
				'key'       => $slug.'_border_radius',
				'label'     => 'Border Radius',
				'selectors' => [
					'{{WRAPPER}} .'.$this->author_list_label_class.' span' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
					'{{WRAPPER}} .'.$this->author_list_label_class.' span' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
					'{{WRAPPER}} .'.$this->author_list_label_class.' span' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->end_controls_section();

		// Author Title
		$this->start_controls_section(
			'author_title_settings',
			[
				'label' => __( 'Title ', 'anant-addons-for-elementor' ),
				'tab'   => Controls_Manager::TAB_STYLE,  
				'condition' => [ 
					'show_title' => 'yes',
				],
			]
		);
		
		$slug = 'author_title';
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
					'{{WRAPPER}} .'.$this->author_list_heading_class => 'text-align: {{VALUE}};',
				],
			]
		);
		
		$this->add_control(
			$slug.'_color',
			[
				'label'     => __( 'Color', 'anant-addons-for-elementor' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}}  .'.$this->author_list_heading_class.' a' => 'color: {{VALUE}}',
				],
			]
		);

		$this->add_control(
			$slug.'_color_hover',
			[
				'label'     => __( 'Hover Color', 'anant-addons-for-elementor' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .'.$this->author_list_class.':hover .'.$this->author_list_heading_class.' a' => 'color: {{VALUE}}',
				],
			]
		);

		anant_typography_control(
			$this,
			[
				'name'     => $slug.'_typography',
				'label'    => 'Typography',
				'selector' => '{{WRAPPER}}  .'.$this->author_list_heading_class,
			]
		);

		$this->add_responsive_control(
			$slug.'_margin',
			[
				'label'     => esc_html__('Margin', 'anant-addons-for-elementor'),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .'.$this->author_list_heading_class => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->end_controls_section();
		
		// Author designation
		$this->start_controls_section(
			'author_designation_settings',
			[
				'label' => __( 'Designation ', 'anant-addons-for-elementor' ),
				'tab'   => Controls_Manager::TAB_STYLE,  
				'condition' => [ 
					'show_designation' => 'yes',
				],
			]
		);
		
		$slug = 'author_designation';
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
					'{{WRAPPER}} .'.$this->author_list_designation_class => 'text-align: {{VALUE}};',
				],
			]
		);
		
		$this->add_control(
			$slug.'_color',
			[
				'label'     => __( 'Color', 'anant-addons-for-elementor' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}}  .'.$this->author_list_designation_class => 'color: {{VALUE}}',
				],
			]
		);

		$this->add_control(
			$slug.'_color_hover',
			[
				'label'     => __( 'Hover Color', 'anant-addons-for-elementor' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .'.$this->author_list_class.':hover .'.$this->author_list_designation_class => 'color: {{VALUE}}',
				],
			]
		);

		anant_typography_control(
			$this,
			[
				'name'     => $slug.'_typography',
				'label'    => 'Typography',
				'selector' => '{{WRAPPER}}  .'.$this->author_list_designation_class,
			]
		);

		$this->add_responsive_control(
			$slug.'_margin',
			[
				'label'     => esc_html__('Margin', 'anant-addons-for-elementor'),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .'.$this->author_list_designation_class => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->end_controls_section();

		
		// Author desc
		$this->start_controls_section(
			'author_desc_settings',
			[
				'label' => __( 'Description ', 'anant-addons-for-elementor' ),
				'tab'   => Controls_Manager::TAB_STYLE,  
				'condition' => [ 
					'show_description' => 'yes',
				],
			]
		);
		
		$slug = 'author_desc';
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
					'{{WRAPPER}} .'.$this->author_list_description_class => 'text-align: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			$slug.'_color',
			[
				'label'     => __( 'Color', 'anant-addons-for-elementor' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}}  .'.$this->author_list_description_class => 'color: {{VALUE}}',
				],
			]
		);

		$this->add_control(
			$slug.'_color_hover',
			[
				'label'     => __( 'Hover Color', 'anant-addons-for-elementor' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .'.$this->author_list_class.':hover .'.$this->author_list_description_class => 'color: {{VALUE}}',
				],
			]
		);

		anant_typography_control(
			$this,
			[
				'name'     => $slug.'_typography',
				'label'    => 'Typography',
				'selector' => '{{WRAPPER}}  .'.$this->author_list_description_class,
			]
		);

		$this->add_responsive_control(
			$slug.'_margin',
			[
				'label'     => esc_html__('Margin', 'anant-addons-for-elementor'),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .'.$this->author_list_description_class => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->end_controls_section();
		
		// Author icon
		$this->start_controls_section(
			'author_icon_settings',
			[
				'label' => __( 'Social Icon ', 'anant-addons-for-elementor' ),
				'tab'   => Controls_Manager::TAB_STYLE,  
				'condition' => [ 
					'show_link' => 'yes',
				],
			]
		);
		
		$slug = 'author_icon';

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
					'{{WRAPPER}} .'.$this->author_list_social_icon_class => 'justify-content: {{VALUE}};',
					
				]
			],
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
					'{{WRAPPER}}  .'.$this->author_list_social_icon_class.' a' => 'color: {{VALUE}}',
					'{{WRAPPER}}  .'.$this->author_list_social_icon_class.' a svg' => 'fill: {{VALUE}}',
				],
			]
		);
		
		$this->add_control(
			$slug.'_bg_color',
			[
				'label'     => __( 'Background Color', 'anant-addons-for-elementor' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}}  .'.$this->author_list_social_icon_class.' a' => 'background-color: {{VALUE}}',
				],
			]
		);
		$this->add_responsive_control(
			$slug.'_icon_width',
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
					'{{WRAPPER}} .'.$this->author_list_social_icon_class.' a' => 'width: {{SIZE}}{{UNIT}};height: {{SIZE}}{{UNIT}};',
				],
			]
		);

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
					'{{WRAPPER}} .'.$this->author_list_social_icon_class.' a i' => 'font-size: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .'.$this->author_list_social_icon_class.' a svg' => 'width: {{SIZE}}{{UNIT}};height: {{SIZE}}{{UNIT}};',
				],
			]
		);

		
		anant_border_control(
			$this,
			[
				'name'     => $slug.'_border_type',
				'label'    => 'Border Type',
				'selector' => '{{WRAPPER}} .'.$this->author_list_social_icon_class.' a',
			]
		);

		anant_border_radius_control(
			$this,
			[
				'key'       => $slug.'_border_radius',
				'label'     => 'Border Radius',
				'selectors' => [
					'{{WRAPPER}} .'.$this->author_list_social_icon_class.' a' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					'{{WRAPPER}} .'.$this->author_list_social_icon_class.' a' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
					'{{WRAPPER}} .'.$this->author_list_social_icon_class.' a' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					'{{WRAPPER}} .'.$this->author_list_social_icon_class.' a' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		anant_box_shadow_control(
			$this,
			[
				'key'      => $slug.'_box_shadow',
				'label'    => 'Box Shadow',
				'selector' => '{{WRAPPER}}  .'.$this->author_list_social_icon_class.' a',
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
					'{{WRAPPER}}  .'.$this->author_list_social_icon_class.' a:hover' => 'color: {{VALUE}}',
					'{{WRAPPER}}  .'.$this->author_list_social_icon_class.' a:hover svg' => 'fill: {{VALUE}}',
				],
			]
		);

		$this->add_control(
			$slug.'_color_bg_hover',
			[
				'label'     => __( 'Background Color', 'anant-addons-for-elementor' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}}  .'.$this->author_list_social_icon_class.' a:hover' => 'background-color: {{VALUE}}',
				],
			]
		);

		anant_border_control(
			$this,
			[
				'name'     => $slug.'_border_type_hover',
				'label'    => 'Border Type',
				'selector' => '{{WRAPPER}} .'.$this->author_list_social_icon_class.' a:hover',
			]
		);

		anant_border_radius_control(
			$this,
			[
				'key'       => $slug.'_border_radius_hover',
				'label'     => 'Border Radius',
				'selectors' => [
					'{{WRAPPER}} .'.$this->author_list_social_icon_class.' a:hover' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->end_controls_section();
	}

	protected function render() {
		$settings = $this->get_settings_for_display();

		$socials = $settings['author_socials'];

		$show_image = $settings['show_image'];
		$show_title = $settings['show_title'];
		$show_designation = $settings['show_designation'];
		$show_description = $settings['show_description'];
		$show_link = $settings['show_link'];
		$show_label = $settings['show_label'];

		$title = $settings['card_title'];
		$description = $settings['card_description'];
		$designation = $settings['card_designation'];
		$label = $settings['card_label'];
		$card_link = $settings['card_link']['url'];
		$target = $settings['card_link']['is_external'] ? ' target=_blank' : '';
		$nofollow = $settings['card_link']['nofollow'] ? ' rel=nofollow' : '';
		$image_url = $settings['card_image']['url']; 

		$template_style = $settings['template_style'];

		if ($template_style == 'layout_1') {
			?>
			<div class="ant-author-list one <?php echo esc_attr($this->author_list_class )?>">
				<?php
				if ( $show_image === 'yes' ) {
					?>
						<div class="ant-author-thumbnail <?php echo esc_attr($this->author_list_image_class )?>">
						<a href="<?php echo esc_url($card_link) ?>" class="ant-img">
							<img src="<?php echo esc_url($image_url) ?>" alt="<?php echo esc_attr($title) ?>">
						</a>
						<?php
							if ( $show_label === 'yes' ) {
								?>
									<div class="ant-label <?php echo esc_attr($this->author_list_label_class )?>">
										<span><?php echo esc_html($label) ?></span>
									</div>
								<?php
							}
						?>                
						</div>
					<?php
				}
				?>                
				<div class="ant-content <?php echo esc_attr($this->author_list_inner_class )?>">
					<div class="ant-author-title">
						<?php
						if ( $show_title === 'yes' ) {
							?>
							<h2 class="title <?php echo esc_attr($this->author_list_heading_class )?>">
								<a href="<?php echo esc_url($card_link )?>" <?php echo esc_attr($target); ?> <?php echo esc_attr($nofollow); ?>><?php echo esc_html($title) ?></a>
							</h2>
							<?php
						}
						?>
						<?php
						if ( $show_designation === 'yes' ) {
							?>
								<span class="designation <?php echo esc_attr($this->author_list_designation_class )?>"><?php echo esc_html($designation) ?></span>
							<?php
						} 
						?>
					</div>
						<?php
						if ( $show_description === 'yes' ) {
							?>
								<p class="description <?php echo esc_attr($this->author_list_description_class )?>"><?php echo esc_html($description) ?></p>
							<?php
						} 
						?>
						<?php
					if ( $show_link === 'yes' ) {
						?>
						<div class="ant-social-icons <?php echo esc_attr($this->author_list_social_icon_class )?>">
							<?php
							foreach ($socials as $key => $socials) { 
								$author_social_link = $socials['author_social_link']['url'];
								$target = $socials['author_social_link']['is_external'] ? ' target=_blank' : '';
								$nofollow = $socials['author_social_link']['nofollow'] ? ' rel=nofollow' : '';
								if ($key === 4 ) { break; }?>
								<a href="<?php echo esc_url( $author_social_link ); ?>" <?php echo esc_attr($target) ?> <?php echo esc_attr($nofollow) ?>> 
									<?php \Elementor\Icons_Manager::render_icon( $socials['author_social_icon'], [ 'aria-hidden' => 'true' ] ); ?>                            
								</a>
							<?php } ?>
						</div>
						<?php
					}
					?>
				</div>
			</div>
		<?php
		}
	}
}