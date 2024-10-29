<?php namespace AnantAddons;

use Elementor\Controls_Manager;
use Elementor\Widget_Base;
use ElementorPro\Modules\Posts\Widgets\Posts_Base;
use Elementor\Group_Control_Background;
use WP_Query;

if ( ! defined( 'ABSPATH' ) ) { exit; } // Exit if accessed directly

class AnantPostBlogTimeline extends \Elementor\Widget_Base {

	private $blog_card_class = 'anant-blog-timeline';
	private $blog_inner = 'anant-blog-timeline-inner';
	private $blog_category = 'anant-blog-timeline-category';
	private $blog_img = 'anant-blog-timeline-image';
	private $blog_title = 'anant-blog-timeline-title';
	private $blog_desc = 'anant-blog-timeline-description';
	private $blog_meta = 'anant-blog-timeline-meta'; 	 
	private $blog_inner_line = 'anant-blog-timeline-inner-line';
	private $blog_line = 'anant-blog-timeline-line';
	private $blog_dot = 'anant-blog-timeline-dot'; 


	public function get_name() {
		return 'anant-post-blog-timeline';
	}

	public function get_title() {
		return __( 'Blog Timeline', 'anant-addons-for-elementor' );
	}

	public function get_categories() {
		return [ 'anant-blog-elements' ];
	}

	public function get_icon() {
		return 'ant-icon eicon-time-line';
	}

	public function get_style_depends() {
		return [
			'anant-post-blog',
		];
	}

	public function get_script_depends() {
		return [
			'anant-custom-js',
		];
	}
	public function get_keywords() {
		return [
			'post blog timeline',
			'news',
			'post',
			'blog',
			'timeline',
		];
	}

	protected function register_controls() {
		$this->start_controls_section(
			'item_configuration',
			[
				'label' => __( 'Content Settings', 'anant-addons-for-elementor' ),
				'tab'   => Controls_Manager::TAB_CONTENT,
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
			'anant_post_blog_pro_notice',
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
			'post_author',
			[
				'label' => esc_html__( 'Authors', 'anant-addons-for-elementor' ),
				'type' => \Elementor\Controls_Manager::SELECT2,
				'label_block' => true,
				'multiple' => true,
				'options' => anant_get_all_authors(),
			]
		);
		
		$this->add_control(
			'post_category',
			[
				'label' => esc_html__( 'Categories', 'anant-addons-for-elementor' ),
				'type' => \Elementor\Controls_Manager::SELECT2,
				'label_block' => true,
				'multiple' => true,
				'options' => anant_get_categories(),
			]
		);
		
		$this->add_control(
			'category_style',
			[
				'label'       => esc_html__( 'Categories Style', 'anant-addons-for-elementor' ),
				'placeholder' => esc_html__( 'Choose Template from Here', 'anant-addons-for-elementor' ),
				'type'        => \Elementor\Controls_Manager::SELECT,
				'default'     => 'one',
				'options'     => [
					'one'      => esc_html__( 'Style 1', 'anant-addons-for-elementor' ),
					'two'      => esc_html__( 'Style 2', 'anant-addons-for-elementor' ),
					'three'      => esc_html__( 'Style 3 (Pro)', 'anant-addons-for-elementor' ),
					'four'      => esc_html__( 'Style 4 (Pro)', 'anant-addons-for-elementor' ), 
					'five'      => esc_html__( 'Style 5 (Pro)', 'anant-addons-for-elementor' ), 
 
				],
			]
		);
		$this->add_control(
			'anant_post_blog_cat_pro_notice',
			[
				'raw' => 'Only Available in <a href="https://anantaddons.com/" target="_blank">Pro Version!</a>',
				'type' => \Elementor\Controls_Manager::RAW_HTML,
				'content_classes' => 'anant-pro-notice',
				'condition' => [ 
                    'category_style!' => ['one', 'two'],
                ],
			]
		);
		$this->add_control(
			'post_tags',
			[
				'label' => esc_html__( 'Tags', 'anant-addons-for-elementor' ),
				'type' => \Elementor\Controls_Manager::SELECT2,
				'label_block' => true,
				'multiple' => true,
				'options' => '',
				'classes' => 'anant-pro-popup-notice',
				'escape' => false,
			]
		);
		$this->add_control(
			'number_of_posts',
			[
				'label' => esc_html__( 'Number of Posts', 'anant-addons-for-elementor' ),
				'type' => Controls_Manager::NUMBER,
				'step' => 1,
				'min'         => 1,
				'max'         => 10,
				'default'     => 4,
			]
		);
		$this->add_responsive_control(
			'title_length',
			[
				'label' => esc_html__( 'Title Length', 'anant-addons-for-elementor' ),
				'type' => Controls_Manager::NUMBER,
				'min'         => 10,
				'max'         => 10,
				'default'     => 10,
				'classes' => 'anant-pro-popup-notice',
				'escape' => false,
			]
		);

		$this->add_responsive_control(
			'excerpt_length',
			[
				'label' => esc_html__( 'Excerpt Length', 'anant-addons-for-elementor' ),
				'type' => Controls_Manager::NUMBER,
				'min'         => 0,
				'default'     => 10,
				'condition'   => [
					'template_style!' => 'layout_5',
				],
			]
		);

		$this->add_control(
			'order_by',
			[
				'label' => esc_html__( 'Order By', 'anant-addons-for-elementor' ),
				'type' => \Elementor\Controls_Manager::SELECT2,
				'label_block' => true,
				'multiple' => false,
				'options'     => [
					'none' => 'None',
					'ID' => 'ID',
					'author' => 'Author',
					'title' => 'Title',
					'name' => 'Name',
					'type' => 'Type',
					'date' => 'Date',
					'modified' => 'Modified',
					'parent' => 'Parent',
					'rand' => 'Random',
					'comment_count' => 'Comment_count',
				],
				'default' => 'date',
			]
		);
		$this->add_control(
			'order',
			[
				'label' => esc_html__( 'Order', 'anant-addons-for-elementor' ),
				'type' => \Elementor\Controls_Manager::SELECT2,
				'label_block' => true,
				'multiple' => false,
				'options'     => [
					'ASC' => 'Ascending',
					'DESC' => 'Descending'
				],
				'default' => 'DESC',
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'settings',
			[
				'label' => __( 'Settings', 'anant-addons-for-elementor' ),
				'tab'   => Controls_Manager::TAB_CONTENT,
			]
		);

		anant_image_size_control(
			$this,
			[
				'name'      => 'thumbnail_size',
				'default'   => 'large'
			]
		);
		$this->add_control(
			'show_meta',
			[
				'label' => esc_html__( 'Show Meta', 'anant-addons-for-elementor' ),
				'type' => Controls_Manager::SWITCHER,
				'label_on' => esc_html__( 'Yes', 'anant-addons-for-elementor' ),
				'label_off' => esc_html__( 'No', 'anant-addons-for-elementor' ),
				'return_value' => 'yes',
				'default' => 'yes',
			]
		);
		$this->add_control(
			'show_comments',
			[
				'label' => esc_html__( 'Show Comments', 'anant-addons-for-elementor' ),
				'type' => Controls_Manager::SWITCHER,
				'label_on' => esc_html__( 'Yes', 'anant-addons-for-elementor' ),
				'label_off' => esc_html__( 'No', 'anant-addons-for-elementor' ),
				'return_value' => 'yes',
				'default' => 'yes',
			]
		);
		$this->add_control(
			'show_category',
			[
				'label' => esc_html__( 'Show Category', 'anant-addons-for-elementor' ),
				'type' => Controls_Manager::SWITCHER,
				'label_on' => esc_html__( 'Yes', 'anant-addons-for-elementor' ),
				'label_off' => esc_html__( 'No', 'anant-addons-for-elementor' ),
				'return_value' => 'yes',
				'default' => 'yes',
			]
		);
		$this->add_control(
			'show_title',
			[
				'label' => esc_html__( 'Show Title', 'anant-addons-for-elementor' ),
				'type' => Controls_Manager::SWITCHER,
				'label_on' => esc_html__( 'Yes', 'anant-addons-for-elementor' ),
				'label_off' => esc_html__( 'No', 'anant-addons-for-elementor' ),
				'return_value' => 'yes',
				'default' => 'yes',
			]
		);

		$this->end_controls_section();

		anant_pro_promotion_controls($this);

		// STYLE
		// Box Settings
		$this->start_controls_section(
			'post_timeline_settings',
			[
				'label' => __( 'Timeline Settings', 'anant-addons-for-elementor' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);

		$slug = 'post_timeline_box';

		$this->add_control(
			$slug.'_bg_color',
			[
				'label'     => __( 'Background Color', 'anant-addons-for-elementor' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}}  .'.$this->blog_card_class => 'background-color: {{VALUE}}',
				],
			]
		);
		anant_border_control(
			$this,
			[
				'name'     => $slug.'_border_type',
				'label'    => 'Border Type',
				'selector' => '{{WRAPPER}} .'.$this->blog_card_class,
			]
		);

		anant_border_radius_control(
			$this,
			[
				'key'       => $slug.'_border_radius',
				'label'     => 'Border Radius',
				'selectors' => [
					'{{WRAPPER}} .'.$this->blog_card_class => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
					'{{WRAPPER}} .'.$this->blog_card_class => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			$slug.'_inner_padding',
			[
				'label'     => esc_html__('Inner Content Padding', 'anant-addons-for-elementor'),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .'.$this->blog_inner.'' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
					'{{WRAPPER}} .'.$this->blog_card_class => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		anant_box_shadow_control(
			$this,
			[
				'key'      => $slug.'_box_shadow',
				'label'    => 'Box Shadow',
				'selector' => '{{WRAPPER}}  .'.$this->blog_card_class,
			]
		);

		$this->end_controls_section();

		//timeline_date
		$this->start_controls_section(
			'meta_settings',
			[
				'label' => __( 'Metas Settings', 'anant-addons-for-elementor' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);

		$slug = 'timeline_meta';

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
					'{{WRAPPER}} .'.$this->blog_meta => 'text-align: {{VALUE}};',
				],
			]
		);
		
		$this->start_controls_tabs( $slug.'_date_tabs' );

		$this->start_controls_tab(
			$slug.'_heading_date_normal_style',
			[
				'label' => __( 'Normal', 'anant-addons-for-elementor' ),
			]
		);
		
		$this->add_control(
			$slug.'_heading_date_bg_color',
			[
				'label'     => __( 'Background Color', 'anant-addons-for-elementor' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}}  .'.$this->blog_meta.' a' => 'background-color: {{VALUE}}',
				],
			]
		);

		$this->add_control(
			$slug.'_heading_date_color',
			[
				'label'     => __( 'Color', 'anant-addons-for-elementor' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}}  .'.$this->blog_meta.' a' => 'color: {{VALUE}}',
				],
			]
		);
		$this->add_control(
			$slug.'_heading_date_icon_color',
			[
				'label'     => __( 'Icon Color', 'anant-addons-for-elementor' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .'.$this->blog_meta.' span a i' => 'color: {{VALUE}}',
				],
			]
		);

		anant_border_control(
			$this,
			[
				'name'     => $slug.'_border_type',
				'label'    => 'Border Type',
				'selector' => '{{WRAPPER}} .'.$this->blog_meta.' a',
			]
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
			$slug.'_heading_date_style_hover',
			[
				'label' => __( 'Hover', 'anant-addons-for-elementor' ),
			]
		);
		
		$this->add_control(
			$slug.'_heading_date_bg_color_hover',
			[
				'label'     => __( 'Background Color', 'anant-addons-for-elementor' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .'.$this->blog_meta.' a:hover' => 'background-color: {{VALUE}}',
				],
			]
		);

		$this->add_control(
			$slug.'_heading_date_color_hover',
			[
				'label'     => __( 'Color', 'anant-addons-for-elementor' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .'.$this->blog_meta.' a:hover' => 'color: {{VALUE}}',
				],
			]
		);

		$this->add_control(
			$slug.'_heading_date_icon_color_hover',
			[
				'label'     => __( 'Icon Color', 'anant-addons-for-elementor' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .'.$this->blog_meta.' span a:hover i' => 'color: {{VALUE}}',
				],
			]
		);

		anant_border_control(
			$this,
			[
				'name'     => $slug.'_border_type_hover',
				'label'    => 'Border Type',
				'selector' => '{{WRAPPER}} .'.$this->blog_meta.' a:hover',
			]
		);

		$this->end_controls_tab();
		$this->end_controls_tabs();

		anant_border_radius_control(
			$this,
			[
				'key'       => $slug.'_border_type',
				'label'     => 'Border Radius',
				'selectors' => [
					'{{WRAPPER}} .'.$this->blog_meta.' a' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
				'separator' => 'before',
			]
		);
		anant_typography_control(
			$this,
			[
				'name'     => $slug.'_date_typography',
				'label'    => 'Typography',
				'selector' => '{{WRAPPER}} .'.$this->blog_meta.' a, .'.$this->blog_meta.' span a i',
			]
		);

		$this->add_responsive_control(
			$slug.'_date_padding',
			[
				'label'     => esc_html__('Padding', 'anant-addons-for-elementor'),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .'.$this->blog_meta.' a' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
					'{{WRAPPER}} .'.$this->blog_meta.' a' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->end_controls_section();
				
		//timeline_title
		$this->start_controls_section(
			'timeline_image',
			[
				'label' => __( 'Image Setting', 'anant-addons-for-elementor' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);

		$slug = 'timeline_image';

		$this->add_responsive_control(
			$slug.'_image_width',
			[
				'label'           => __( 'Image Width', 'anant-addons-for-elementor' ),
				'type'            => Controls_Manager::SLIDER,
				'size_units'      => [ 'px', '%' ],
				'range'           => [
					'px' => [
						'min' => 0,
						'max' => 600,
					],
					'%' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'devices'         => [ 'desktop', 'tablet', 'mobile' ],
				'desktop_default' => [
					'size' =>'' ,
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
					'{{WRAPPER}} .'.$this->blog_img.'' => 'width: {{SIZE}}{{UNIT}};',
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
						'max' => 500,
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
					'{{WRAPPER}} .'.$this->blog_img.'' => 'height: {{SIZE}}{{UNIT}};',
				],
			]
		);

		anant_border_control(
			$this,
			[
				'name'     => $slug.'_border_type',
				'label'    => 'Border Type',
				'selector' => '{{WRAPPER}} .'.$this->blog_img.'',
			]
		);

		anant_border_radius_control(
			$this,
			[
				'key'       => $slug.'_border_type',
				'label'     => 'Border Radius',
				'selectors' => [
					'{{WRAPPER}} .'.$this->blog_img.'' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
					'{{WRAPPER}} .'.$this->blog_img => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->end_controls_section();
		
		// Blog Category
		$this->start_controls_section(
			'blog_category_settings',
			[
				'label' => __( 'Category Settings ', 'anant-addons-for-elementor' ),
				'tab'   => Controls_Manager::TAB_STYLE,   
				
			]
		);
		
		$slug = 'blog_category';
		anant_alignment_control(
			$this,
			[
				'key'       => $slug.'_align',
				'options'   => [
					'start'   => [
						'title' => __( 'Left', 'anant-addons-for-elementor' ),
						'icon'  => 'eicon-text-align-left',
					],
					'center' => [
						'title' => __( 'Center', 'anant-addons-for-elementor' ),
						'icon'  => 'eicon-text-align-center',
					],
					'end'  => [
						'title' => __( 'Right', 'anant-addons-for-elementor' ),
						'icon'  => 'eicon-text-align-right',
					],
				],
				'default'   => '',
				'selectors' => [
					'{{WRAPPER}} .'.$this->blog_category => 'text-align: {{VALUE}}',
				],
			]
		);
		
		$this->add_control(
			$slug.'_color',
			[
				'label'     => __( 'Color', 'anant-addons-for-elementor' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}}  .'.$this->blog_category.' a' => 'color: {{VALUE}}',
				],
			]
		);
		
		$this->add_control(
			$slug.'_bg_color',
			[
				'label'     => __( 'Background Color', 'anant-addons-for-elementor' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}}  .'.$this->blog_category.' a' => 'background-color: {{VALUE}}',
				],
			]
		);

		anant_typography_control(
			$this,
			[
				'name'     => $slug.'_typography',
				'label'    => 'Typography',
				'selector' => '{{WRAPPER}}  .'.$this->blog_category.' a',
			]
		);

		anant_border_control(
			$this,
			[
				'name'     => $slug.'_border_type',
				'label'    => 'Border Type',
				'selector' => '{{WRAPPER}} .'.$this->blog_category.' a',
			]
		);

		anant_border_radius_control(
			$this,
			[
				'key'       => $slug.'_border_radius',
				'label'     => 'Border Radius',
				'selectors' => [
					'{{WRAPPER}} .'.$this->blog_category.' a' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
					'{{WRAPPER}} .'.$this->blog_category.' a' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
					'{{WRAPPER}} .'.$this->blog_category.' a' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
 
		$this->end_controls_section();

		$this->start_controls_section(
			'title_style',
			[
				'label' => __( 'Title Settings', 'anant-addons-for-elementor' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'title_html_tag',
			[
				'label' => esc_html__( 'Title HTML Tag', 'anant-addons-for-elementor' ),
				'type' => \Elementor\Controls_Manager::SELECT2,
				'label_block' => true,
				'options'     => [
					'h1' => 'H1',
					'h2' => 'H2',
					'h3' => 'H3',
					'h4' => 'H4',
					'h5' => 'H5',
					'h6' => 'H6',
				],
				'default' => 'h4',
				'multiple'    => false,
			]
		);

		$slug = 'blog_title';

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
					'{{WRAPPER}} .'.$this->blog_title => 'text-align: {{VALUE}};',
				],
			]
		);
		
		$this->add_control(
			$slug.'_color',
			[
				'label'     => __( 'Color', 'anant-addons-for-elementor' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}}  .'.$this->blog_title.' a' => 'color: {{VALUE}}',
				],
			]
		);

		$this->add_control(
			$slug.'_color_hover',
			[
				'label'     => __( 'Hover Color', 'anant-addons-for-elementor' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .'.$this->blog_card_class.' .'.$this->blog_title.' a:hover' => 'color: {{VALUE}}',
				],
			]
		);

		anant_typography_control(
			$this,
			[
				'name'     => $slug.'_typography',
				'label'    => 'Typography',
				'selector' => '{{WRAPPER}}  .'.$this->blog_title,
			]
		); 

		$this->add_responsive_control(
			$slug.'_margin',
			[
				'label'     => esc_html__('Margin', 'anant-addons-for-elementor'),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .'.$this->blog_title => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->end_controls_section();

		// timeline description
		
		$this->start_controls_section(
			'excerpt_style',
			[
				'label' => __( 'Excerpt Settings', 'anant-addons-for-elementor' ),
				'tab'   => Controls_Manager::TAB_STYLE,
				'condition'   => [
					'excerpt_length!' => 0,
				]
			]
		);

		$slug = 'excerpt';

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
					'{{WRAPPER}} .'.$this->blog_desc => 'text-align: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			$slug.'_color',
			[
				'label' => esc_html__( 'Color', 'anant-addons-for-elementor' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .'.$this->blog_desc.'' => 'color: {{VALUE}};',
				],
			]
		);

		anant_typography_control(
			$this,
			[
				'name'     =>  $slug.'_typography',
				'label'    => 'Typography',
				'selector' => '{{WRAPPER}} .'.$this->blog_desc.'',
			]
		);

		$this->add_responsive_control(
			$slug.'_margin',
			[
				'label'     => esc_html__('Margin', 'anant-addons-for-elementor'),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .'.$this->blog_desc.'' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
					'{{WRAPPER}} .'.$this->blog_line => 'width: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .'.$this->blog_inner_line => 'width: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_control(
			$slug.'_color',
			[
				'label'     => __( 'Color', 'anant-addons-for-elementor' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .'.$this->blog_line=> 'background-color: {{VALUE}}',
				],
			]
		); 

		$this->add_control(
			$slug.'_inner_color',
			[
				'label'     => __( 'Scroll Color', 'anant-addons-for-elementor' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .'.$this->blog_inner_line=> 'background-color: {{VALUE}}',
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
					'{{WRAPPER}} .'.$this->blog_dot => 'width: {{SIZE}}{{UNIT}}; height: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .'.$this->blog_dot.'.highlighted-dot' => 'width: {{SIZE}}{{UNIT}}; height: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_control(
			$slug.'_dot_color',
			[
				'label'     => __( 'Color', 'anant-addons-for-elementor' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .'.$this->blog_dot=> 'background-color: {{VALUE}}',
				],
			]
		);
		
		$this->add_control(
			$slug.'_dot_inner_color',
			[
				'label'     => __( 'Scroll Color', 'anant-addons-for-elementor' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .'.$this->blog_dot.'.highlighted-dot'=> 'background-color: {{VALUE}}',
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
					'{{WRAPPER}} .'.$this->blog_dot => 'left: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .'.$this->blog_dot.'.highlighted-dot' => 'left:{{SIZE}}{{UNIT}};',  
				],
			]
		);
		$this->end_controls_section(); 
	}

	protected function render() {
		$settings = $this->get_settings_for_display();

		$template_style = $settings['template_style'];

		$category_style = $settings['category_style'];
		
		$show_meta = $settings['show_meta'];
		$show_comments = $settings['show_comments'];
		$show_category = $settings['show_category'];
		$show_title = $settings['show_title'];

		$title_html_tag = $settings['title_html_tag'];

		$excerpt_length = $settings['excerpt_length'];
		$title_length = $settings['title_length'];
		$paged = get_query_var( 'paged' ) ? absint( get_query_var( 'paged' ) ) : 1; 

		$args = array(
			'posts_per_page' => 5,
			'orderby' => 'ID',
			'order' => 'DESC',
			'post_type' => 'post',
			'post_status' => 'publish',
			'paged' => $paged
		);

		if ( isset( $settings['post_category'] ) && is_array( $settings['post_category'] ) && ! empty( $settings['post_category'] ) ) {
			$args['cat'] = implode(',',  $settings['post_category']);
		}

		if ( isset( $settings['post_author'] ) && is_array( $settings['post_author'] ) && ! empty( $settings['post_author'] ) ) {
			$args['cat'] = implode(',',  $settings['post_author']);
		}

		if ( isset( $settings['post_tags'] ) && is_array( $settings['post_tags'] ) && ! empty( $settings['post_tags'] ) ) {
			$args['tag'] = implode(',', $settings['post_tags'] );
		}

		if ( isset( $settings['order_by'] ) && ! empty( $settings['order_by'] ) ) {
			$args['orderby'] = $settings['order_by'];
		}

		if ( isset( $settings['order'] ) && ! empty( $settings['order'] ) ) {
			$args['order'] = $settings['order'];
		}

		if ( isset( $settings['number_of_posts'] ) && ! empty( $settings['number_of_posts'] ) ) {
			$args['posts_per_page'] = $settings['number_of_posts'];
		}

		$wp_query = new WP_Query( $args );


		?>
		<div class="ant-post-timeline-items ant-timeline-items">
			<span class="timeline-line <?php echo esc_attr($this->blog_line) ?>"></span>
			<span class="timeline-inner-line <?php echo esc_attr($this->blog_inner_line) ?>"></span>
			<?php
				if ( $wp_query->have_posts() ) :
					while ( $wp_query->have_posts() ) : $wp_query->the_post();
						$thumbnail_id = get_post_thumbnail_id();
						$thumbnail_size_key = 'thumbnail_size';
						$comments_count = get_comments_number();
						$categories_names = [];
						$categories = get_the_category();

						if ( count($categories) > 0 ) {
							foreach($categories as $category ) {
								$category = (array) $category;
								$categories_names[] = $category['name'];
							}
						}

						$params = [ 
							'settings' => $settings, 
							'excerpt_length' => $excerpt_length,
							'title_length' => $title_length,
							'thumbnail_id' => $thumbnail_id,
							'thumbnail_size_key' => $thumbnail_size_key,
							'categories' => $categories,
							'comments_count' => $comments_count,
							
						];
						if ($template_style == 'layout_1') { ?>
							<!-- blog card post -->
								<div class="ant-blog-timeline-item ant-timeline-item" id="<?php echo get_the_ID(); ?>">
									<div class="timeline-dot <?php echo esc_attr($this->blog_dot );?>"></div>
										<div class="ant-blog-meta timeline-date <?php echo esc_attr($this->blog_meta) ;?>">
											<?php
												if( $show_meta === 'yes' ) {
													?>
														<span class="ant-author">
															<a href="<?php echo esc_url( get_author_posts_url(get_the_author_meta( 'ID' )) ); ?>"><?php echo get_avatar(get_the_author_meta( 'ID') , 150); ?><?php the_author(); ?></a>
														</span>
														<span class="ant-blog-date">
															<a href="<?php echo esc_url( get_day_link(get_post_time('Y'), get_post_time('m'), get_post_time('j')) );  ?>" class="entry-date"><i class="far fa-clock"></i>
																<?php
																	the_time('F j, Y');
																?>
															</a>
														</span>
													<?php
												}
											?>
											<?php
												if ( $params['comments_count'] > 0 && $show_comments === 'yes') {
														$text = 'Comment';
														if ( $params['comments_count'] > 1 ) {
															$text = 'Comments';
														}
													?>
														<span class="ant-comments-link"> <a href="<?php comments_link(); ?>"><i class="far fa-comments"></i><?php echo get_comments_number(). ' ' ?></a> </span>
													<?php
												}
											?>
										</div>
										
									<div class="ant-timeline-content <?php echo esc_attr($this->blog_card_class) ;?>">
									<?php 
											$image_src = '';
											if ($thumbnail_id) {
												$image_src = \Elementor\Group_Control_Image_Size::get_attachment_image_src($thumbnail_id, $thumbnail_size_key, $params['settings']);
											}

											if ( $image_src === '' ) {
												?>
													<div class="<?php echo esc_attr($this->blog_img) ;?>">
												<?php
											} else {
												$bg = "background-image: url(". esc_url($image_src) .");";
												?>
													<div class="ant-img-post ant-back-img hlgr <?php echo $this->blog_img ;?>" style=" <?php echo $bg ?> ">
												<?php
											}
										?> 
											<a href="<?php echo esc_url(get_permalink()); ?>" class="ant-link-div"></a>
										</div>
										<article class="small <?php echo esc_attr( $this->blog_inner );?>">
											<div class="ant-blog-category <?php if ($category_style == 'one') { echo'one'; } 
												elseif ($category_style == 'two') { echo'two'; } 
												elseif (($category_style != 'two') || ($category_style != 'one')) { echo 'remove' ;} ;?> 
												<?php echo esc_attr($this->blog_category) ;?>">
													<?php
													if ( count($params['categories']) > 0 && $show_category === 'yes') {
														foreach($params['categories'] as $category ) {
															$category = (array) $category;
															?>
																<a href="<?php echo get_category_link( $category['term_id'] ) ?>"><?php echo esc_html($category['name']) ?></a>
															<?php
														}
													}
													?>
											</div>
											<?php
												if ( $show_title === 'yes' ) {
													// title_html_tag

													echo '<'.$title_html_tag.' class="title '.$this->blog_title.'">';
													if ( $params['title_length'] > 0 ) {
														?>
															<a href="<?php echo esc_url(get_permalink()); ?>" title="<?php the_title_attribute(); ?>"><?php echo wp_trim_words(get_the_title(), $params['title_length'], '' ); ?></a>
														<?php
													}
													echo '</'.$title_html_tag.'>';
												}
											?>
											<?php
												if ( $params['excerpt_length'] > 0 ) {
													?>
														<div class="description <?php echo esc_attr($this->blog_desc);?>">
													<?php
													echo wp_trim_words( get_the_content(), $params['excerpt_length'], '' );
													?>
														</div>
													<?php
												}
											?>
										</article>
									</div>
								</div>
							<!-- /blog card post -->
						<?php }
				endwhile;
			endif;
		?>
		</div>
		<?php
			wp_reset_postdata();
		?>
		<?php
	}
}