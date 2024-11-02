<?php namespace AnantAddons;

use Elementor\Controls_Manager;
use Elementor\Widget_Base;
use ElementorPro\Modules\Posts\Widgets\Posts_Base;
use Elementor\Group_Control_Background;
use WP_Query;

if ( ! defined( 'ABSPATH' ) ) { exit; } // Exit if accessed directly

class AnantPostBlog extends \Elementor\Widget_Base {

	private $blog_card_class = 'anant-blog-card';
	private $blog_inner = 'anant-blog-card-inner';
	private $blog_category = 'anant-blog-card-category';
	private $blog_img = 'anant-blog-card-image';
	private $blog_title = 'anant-blog-card-title';
	private $blog_desc = 'anant-blog-card-description';
	private $blog_meta = 'anant-blog-card-meta';
	private $blog_btn = 'anant-blog-card-button';

	public function get_name() {
		return 'anant-post-blog';
	}

	public function get_title() {
		return __( 'Blog Post', 'anant-addons-for-elementor' );
	}

	public function get_categories() {
		return [ 'anant-blog-elements' ];
	}

	public function get_icon() {
		return 'ant-icon eicon-posts-grid';
	}

	public function get_style_depends() {
		return [
			'anant-post-blog',
		];
	}

	public function get_script_depends() {
		return [
			'anant-post-blog',
		];
	}
	public function get_keywords() {
		return [
			'post blog',
			'news',
			'post',
			'blog',
			'',
			'anant addons',
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
			'blog_design',
			[
				'label'       => esc_html__( 'Blog Post Layout', 'anant-addons-for-elementor' ),
				'placeholder' => esc_html__( 'Choose Template from Here', 'anant-addons-for-elementor' ),
				'type'        => \Elementor\Controls_Manager::SELECT,
				'default'     => 'card',
				'options'     => [
					'card'      => esc_html__( 'Card', 'anant-addons-for-elementor' ),
					'over'      => esc_html__( 'Overlay', 'anant-addons-for-elementor' ), 
				],
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
				'default'     => 3,
			]
		);
		$this->add_responsive_control(
			'post_count_per_row',
			[
				'label' => esc_html__( 'Post Count Per Row', 'anant-addons-for-elementor' ) .' <i class="eicon-pro-icon"></i>' ,
				'type' => \Elementor\Controls_Manager::SELECT,
				'default' => '3',
				'options' => [
					'3' => esc_html__( '3', 'anant-addons-for-elementor' ),
				],
				'classes' => 'anant-pro-popup-notice',
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
				'default'     => 20,
				'condition'   => [
					'blog_design' => 'card',
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
		
		$this->add_responsive_control(
			'column_space_between',
			[
				'label'           => esc_html__('Column Space', 'anant-addons-for-elementor' ), 
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
					'{{WRAPPER}} .ant-blog-grid' => 'grid-column-gap :{{SIZE}}{{UNIT}};',
				], 
			]
		);
		$this->add_responsive_control(
			'row_space_between',
			[
				'label'           => esc_html__('Row Space', 'anant-addons-for-elementor' ), 
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
					'{{WRAPPER}} .ant-blog-grid' => 'grid-row-gap :{{SIZE}}{{UNIT}};',
				], 
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
		$this->add_control(
			'show_read_more',
			[
				'label' => esc_html__( 'Show Read More', 'anant-addons-for-elementor' ),
				'type' => Controls_Manager::SWITCHER,
				'label_on' => esc_html__( 'Yes', 'anant-addons-for-elementor' ),
				'label_off' => esc_html__( 'No', 'anant-addons-for-elementor' ),
				'return_value' => 'yes',
				'default' => 'yes',
				'condition'   => [
					'blog_design' => 'card',
				],
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'button_section',
			[
				'label' => __( 'Button Settings', 'anant-addons-for-elementor' ),
				'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
				'condition'   => [
					'blog_design' => 'card'
				],
			]
		);

		$this->add_control(
			'card_link_text', [
				'label' => __( 'Button Text', 'anant-addons-for-elementor' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => __( 'Read More' , 'anant-addons-for-elementor' ),
				'label_block' => true,
			]
		);

		$this->add_control(
			'link_button_icon',
			[
				'label' => __( 'Icon', 'anant-addons-for-elementor' ),
				'type' => \Elementor\Controls_Manager::ICONS,
				'default' => ['value' => 'fa fa-arrow-right', 'library' => 'brands',],
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
				]
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
					'{{WRAPPER}} .'.$this->blog_btn.' i' => 'margin-right: {{SIZE}}{{UNIT}};',
				],
				'conditions' => [
					'relation' => 'and',
					'terms'    => [
						[
							'name'     => 'link_button_position',
							'operator' => '===',
							'value'    => 'before',
						]
					],
				],
			]
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
					'{{WRAPPER}} .'.$this->blog_btn.' i' => 'margin-left: {{SIZE}}{{UNIT}};',
				],
				'conditions' => [
					'relation' => 'and',
					'terms'    => [
						[
							'name'     => 'link_button_position',
							'operator' => '===',
							'value'    => 'after',
						]
					],
				],
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'pagination',
			[
				'label' => __( 'Pagination Settings', 'anant-addons-for-elementor' ),
				'tab'   => Controls_Manager::TAB_CONTENT, 
				'condition' => [
					'template_style' => ['layout_1']
				],
			]
		);
		$this->add_control(
			'pagination_type',
			[
				'label' => esc_html__( 'Pagination', 'anant-addons-for-elementor' ),
				'type' => \Elementor\Controls_Manager::SELECT2,
				'label_block' => true,
				'options'     => [
					'none' => 'None',
					'previous/next' => 'Previous/Next',
					'numbers' => 'Numbers (Pro)',
					'numbers+previous/next' => 'Numbers + Previous/Next (Pro)',
				],
				'default' => 'numbers',
				'multiple'    => false,
			]
		);

		$this->add_control(
			'anant_post_blog_page_pro_notice',
			[
				'raw' => 'Only Available in <a href="https://anantaddons.com/" target="_blank">Pro Version!</a>',
				'type' => \Elementor\Controls_Manager::RAW_HTML,
				'content_classes' => 'anant-pro-notice',
				'condition' => [ 
                    'pagination_type!' => ['previous/next', 'none'],
                ],
			]
		);

		anant_alignment_control(
			$this,
			[
				'key'       => 'pagination_align',
				'options'   => [
					'flex-start'   => [
						'title' => __( 'Left', 'anant-addons-for-elementor' ),
						'icon'  => 'eicon-text-align-left',
					],
					'center' => [
						'title' => __( 'Center', 'anant-addons-for-elementor' ),
						'icon'  => 'eicon-text-align-center',
					],
					'flex-end'  => [
						'title' => __( 'Right', 'anant-addons-for-elementor' ),
						'icon'  => 'eicon-text-align-right',
					],
				],
				'default'   => '',
				'selectors' => [
					'{{WRAPPER}} .navigation' => 'justify-content: {{VALUE}}',
				],
				'condition'   => [
					'pagination_type!' => 'none',
				],
			]
		); 

		$this->end_controls_section();

		anant_pro_promotion_controls($this);

		$this->start_controls_section(
			'blog_style',
			[
				'label' => __( 'Blog Post Settings', 'anant-addons-for-elementor' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);		

		$slug = 'blog_box';
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

		$this->start_controls_section(
			'image_style',
			[
				'label' => __( 'Image Settings', 'anant-addons-for-elementor' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);

		$slug = 'blog_image';
		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name'      => $slug.'_opacity_color',
				'types'          => [ 'classic', 'gradient' ],
				'exclude'        => [ 'image' ],
				'fields_options' => [
					'background' => [
						'label'     => __( 'Background Overlay', 'anant-addons-for-elementor' ),
						'default' => 'classic',
					],
				],
				'selector'  =>  '{{WRAPPER}} .'.$this->blog_card_class.' .lg:after', 
				'conditions' => [
					'relation' => 'and',
					'terms'    => [
						[
							'name'     => 'template_style',
							'operator' => '!==',
							'value'    => 'layout_1',
						],
						[
							'name'     => 'blog_design',
							'operator' => '!==',
							'value'    => 'card',
						],
					],
				],
			]
		);

		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name'      => $slug.'_opacity_six_color',
				'types'          => [ 'classic', 'gradient' ],
				'exclude'        => [ 'image' ],
				'fields_options' => [
					'background' => [
						'label'     => __( 'Background Overlay', 'anant-addons-for-elementor' ),
						'default' => 'classic',
					],
				],
				'selector'  =>  
					'{{WRAPPER}} .six .'.$this->blog_inner.':after',
				'condition'   => [
					'blog_design!' => 'card',
					'template_style' => 'layout_1',
				],
			]
		);

		$this->add_responsive_control(
			$slug.'_overlay_opacity',
			[
				'label' => esc_html__( 'Opacity', 'anant-addons-for-elementor' ),
				'type' => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'max' => 1,
						'step' => 0.01,
					],
				],
				'selectors'  => [
					'{{WRAPPER}} .'.$this->blog_card_class.' .lg:after' => 'opacity: {{SIZE}};',
					'{{WRAPPER}} .'.$this->blog_card_class.'.six .'.$this->blog_inner.':after' => 'opacity: {{SIZE}};',
				],
				'condition'   => [
					'blog_design!' => 'card'
				],
			]
		);
		
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
					'{{WRAPPER}} .'.$this->blog_img.' ' => 'width: {{SIZE}}{{UNIT}};', 
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
					'{{WRAPPER}} .'.$this->blog_img.' ' => 'height: {{SIZE}}{{UNIT}};', 
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
				'key'       => $slug.'_border_radius',
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
					'{{WRAPPER}} .'.$this->blog_img.'' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
		
		$this->add_responsive_control(
			$slug.'_gap',
			[
				'label'           => __( 'Gap', 'anant-addons-for-elementor' ),
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
				'default' => [
					'size' => 5,
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
					'{{WRAPPER}} .'.$this->blog_category => 'gap: {{SIZE}}{{UNIT}};',
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
			$slug.'_hover_color',
			[
				'label'     => __( 'Hover Color', 'anant-addons-for-elementor' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}}  .'.$this->blog_category.' a:hover' => 'color: {{VALUE}}',
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
		
		$this->add_control(
			$slug.'_bg_hover_color',
			[
				'label'     => __( 'Background Hover Color', 'anant-addons-for-elementor' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}}  .'.$this->blog_category.' a:hover' => 'background-color: {{VALUE}}; border-color: {{VALUE}};',
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
			$slug.'_wrapper_margin',
			[
				'label'     => esc_html__('Wrapper Margin', 'anant-addons-for-elementor'),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .'.$this->blog_category => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
					'{{WRAPPER}} .'.$this->blog_title.' a:hover' => 'color: {{VALUE}}',
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

		$this->start_controls_section(
			'metas_style',
			[
				'label' => __( 'Metas Settings', 'anant-addons-for-elementor' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);

		$slug = 'metas';
		anant_alignment_control(
			$this,
			[
				'key'       => $slug.'_align',
				'options'   => [
					'flex-start'   => [
						'title' => __( 'Left', 'anant-addons-for-elementor' ),
						'icon'  => 'eicon-text-align-left',
					],
					'center' => [
						'title' => __( 'Center', 'anant-addons-for-elementor' ),
						'icon'  => 'eicon-text-align-center',
					],
					'flex-end'  => [
						'title' => __( 'Right', 'anant-addons-for-elementor' ),
						'icon'  => 'eicon-text-align-right',
					],
				],
				'default'   => '',
				'selectors' => [
					'{{WRAPPER}} .'.$this->blog_meta => 'justify-content: {{VALUE}}',
				],
			]
		);

		$this->add_control(
			$slug.'_color',
			[
				'label' => esc_html__( 'Color', 'anant-addons-for-elementor' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .'.$this->blog_meta.' a' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			$slug.'_color_hover',
			[
				'label'     => __( 'Hover Color', 'anant-addons-for-elementor' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .'.$this->blog_meta.' a:hover' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			$slug.'_icon_color',
			[
				'label' => esc_html__( 'Icon Color', 'anant-addons-for-elementor' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .'.$this->blog_meta.' a i' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			$slug.'_icon_hover_color',
			[
				'label'     => __( 'Hover Icon Color', 'anant-addons-for-elementor' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .'.$this->blog_meta.' a:hover i' => 'color: {{VALUE}};',
				],
			]
		);

		anant_typography_control(
			$this,
			[
				'name'     =>  $slug.'_typography',
				'label'    => 'Typography',
				'selector' => '{{WRAPPER}} .'.$this->blog_meta.' a',
			]
		);

		$this->add_responsive_control(
			$slug.'_margin',
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

		$this->start_controls_section(
			'excerpt_style',
			[
				'label' => __( 'Excerpt Settings', 'anant-addons-for-elementor' ),
				'tab'   => Controls_Manager::TAB_STYLE,
				'condition'   => [
					'blog_design' => 'card'
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

		$this->start_controls_section(
			'button_style',
			[
				'label' => __( 'Button Settings', 'anant-addons-for-elementor' ),
				'tab'   => Controls_Manager::TAB_STYLE,
				'condition'   => [
					'blog_design' => 'card'
				],
			]
		);

		$slug = 'button'; 
		anant_alignment_control(
			$this,
			[
				'key'       => $slug.'_text_align',
				'options'   => [
					'left'   => [
						'title' => __( 'Left', 'anant-addons-for-elementor' ),
						'icon'  => 'eicon-text-align-left',
					],
					'center' => [
						'title' => __( 'Center', 'anant-addons-for-elementor' ),
						'icon'  => 'eicon-text-align-center',
					],
					'right'  => [
						'title' => __( 'Right', 'anant-addons-for-elementor' ),
						'icon'  => 'eicon-text-align-right',
					],
				],
				'default'   => ' ',
				'selectors' => [
					'{{WRAPPER}} .ant-more-link' => 'text-align: {{VALUE}}',
				],
			]
		);

		$this->start_controls_tabs( $slug.'_style_tabs' );

		$this->start_controls_tab(
			$slug.'_normal_style',
			[
				'label' => __( 'Normal', 'anant-addons-for-elementor' ),

			]
		);

		$this->add_control(
			$slug.'_background_color',
			[
				'label' => esc_html__( 'Background Color', 'anant-addons-for-elementor' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .'.$this->blog_btn.'' => 'background-color: {{VALUE}};',
				],
			]
		);
		$this->add_control(
			$slug.'_color',
			[
				'label' => esc_html__( 'Color', 'anant-addons-for-elementor' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .'.$this->blog_btn.'' => 'color: {{VALUE}};',
				],
			]
		);

		anant_border_control(
			$this,
			[
				'name'     => $slug.'_border_type',
				'label'    => 'Border Type',
				'selector' => '{{WRAPPER}} .'.$this->blog_btn.'',
			]
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
			$slug.'_hover_style',
			[
				'label' => __( 'Hover', 'anant-addons-for-elementor' ),

			]
		);

		$this->add_control(
			$slug.'_background_color_hover',
			[
				'label' => esc_html__( 'Background Color', 'anant-addons-for-elementor' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .'.$this->blog_btn.':hover' => 'background-color: {{VALUE}};',
				],
			]
		);
		$this->add_control(
			$slug.'_color_hover',
			[
				'label' => esc_html__( 'Color', 'anant-addons-for-elementor' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .'.$this->blog_btn.':hover' => 'color: {{VALUE}};',
				],
			]
		);

		anant_border_control(
			$this,
			[
				'name'     => $slug.'_border_type_hover',
				'label'    => 'Border Type',
				'selector' => '{{WRAPPER}} .'.$this->blog_btn.':hover',
			]
		);

		$this->end_controls_tab();
		$this->end_controls_tabs();

		anant_border_radius_control(
			$this,
			[
				'key'       => $slug.'_border_radius',
				'label'     => 'Border Radius',
				'selectors' => [
					'{{WRAPPER}} .'.$this->blog_btn.'' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
				'separator' => 'before',
			]
		);
		anant_typography_control(
			$this,
			[
				'name'     =>  $slug.'_typography',
				'label'    => 'Typography',
				'selector' => '{{WRAPPER}} .'.$this->blog_btn.'',
			]
		);

		$this->add_responsive_control(
			$slug.'_padding',
			[
				'label'     => esc_html__('Padding', 'anant-addons-for-elementor'),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .'.$this->blog_btn.'' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
					'{{WRAPPER}} .'.$this->blog_btn.'' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		anant_box_shadow_control(
			$this,
			[
				'key'      => $slug.'_box_shadow',
				'label'    => 'Box Shadow',
				'selector' => '{{WRAPPER}}  .'.$this->blog_btn.'',
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'pagination_style',
			[
				'label' => __( 'Pagination Settings', 'anant-addons-for-elementor' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);

		$slug = 'pagination';
		$this->start_controls_tabs( $slug.'_style_tabs' );
		$this->start_controls_tab(
			$slug.'_normal_style',
			[
				'label' => __( 'Normal', 'anant-addons-for-elementor' ),

			]
		);

		$this->add_control(
			$slug.'_background_color',
			[
				'label' => esc_html__( 'Background Color', 'anant-addons-for-elementor' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .anant-navigation li .page-numbers' => 'background-color: {{VALUE}};',
				],
			]
		);
		$this->add_control(
			$slug.'_color',
			[
				'label' => esc_html__( 'Color', 'anant-addons-for-elementor' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .anant-navigation li .page-numbers' => 'color: {{VALUE}};',
				],
			]
		);

		anant_border_control(
			$this,
			[
				'name'     => $slug.'_border_type',
				'label'    => 'Border Type',
				'selector' => '{{WRAPPER}} .anant-navigation li .page-numbers',
			]
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
			$slug.'_hover_style',
			[
				'label' => __( 'Hover', 'anant-addons-for-elementor' ),

			]
		);

		$this->add_control(
			$slug.'_background_color_hover',
			[
				'label' => esc_html__( 'Background Color', 'anant-addons-for-elementor' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .anant-navigation li .page-numbers:hover' => 'background-color: {{VALUE}};',
				],
			]
		);
		$this->add_control(
			$slug.'_color_hover',
			[
				'label' => esc_html__( 'Color', 'anant-addons-for-elementor' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .anant-navigation li .page-numbers:hover' => 'color: {{VALUE}};',
				],
			]
		);

		anant_border_control(
			$this,
			[
				'name'     => $slug.'_border_type_hover',
				'label'    => 'Border Type',
				'selector' => '{{WRAPPER}} .anant-navigation li .page-numbers:hover',
			]
		);
		$this->end_controls_tab();
		$this->end_controls_tabs();

		anant_border_radius_control(
			$this,
			[
				'key'       => $slug.'_border_radius',
				'label'     => 'Border Radius',
				'selectors' => [
					'{{WRAPPER}} .anant-navigation li .page-numbers' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
				'separator' => 'before',
			]
		);

		anant_typography_control(
			$this,
			[
				'name'     =>  $slug.'_typography',
				'label'    => 'Typography',
				'selector' => '{{WRAPPER}} .anant-navigation li .page-numbers',
			]
		);

		$this->add_responsive_control(
			$slug.'_padding',
			[
				'label'     => esc_html__('Padding', 'anant-addons-for-elementor'),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .anant-navigation li .page-numbers' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
					'{{WRAPPER}} .anant-navigation li .page-numbers' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		anant_box_shadow_control(
			$this,
			[
				'key'      => $slug.'_box_shadow_hover',
				'label'    => 'Box Shadow',
				'selector' => '{{WRAPPER}} .anant-navigation li .page-numbers',
			]
		);
		$this->end_controls_section();
	}

	protected function render() {
		$settings = $this->get_settings_for_display();

		$template_style = $settings['template_style'];

		$category_style = $settings['category_style'];
		
		$blog_design = $settings['blog_design'];

		$show_meta = $settings['show_meta'];
		$show_comments = $settings['show_comments'];
		$show_category = $settings['show_category'];
		$show_title = $settings['show_title'];
		$show_read_more = $settings['show_read_more'];

		$title_html_tag = $settings['title_html_tag'];

		$excerpt_length = $settings['excerpt_length'];
		$title_length = $settings['title_length'];
		$paged = (get_query_var('paged')) 
		? absint(get_query_var('paged')) 
			: (isset($_GET['paged']) 
				? absint($_GET['paged']) 
				: (get_query_var('page') 
					? absint(get_query_var('page')) 
					: 1));

		$link_text = $settings['card_link_text']; 
		$link_button_icon = $settings['link_button_icon'];
		$link_button_position = $settings['link_button_position'];

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
		<div class="ant-blog-grid">
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
						$template_path = ANANT_PATH . 'inc/templates/post-blog/';

						switch ($template_style) {
							case 'layout_1':
								require $template_path. 'layout-1.php';
								break;
						}
					endwhile;
					?>
			<?php
			endif;
		?>
		</div>
		<?php
		
			if ('previous/next'=== $settings['pagination_type']) {
				$this->anant_pagi_previous_next( $wp_query );
			}
			wp_reset_postdata();
	}

	function custom_previous_posts_page_link( $paged ) {
		if ( $paged > 1 ) {
			$prev_page = $paged - 1;
			return get_pagenum_link( $prev_page );
		}
		return false;
	}
	
	function custom_next_posts_page_link( $paged, $max ) {
		if ( $paged < $max ) {
			$next_page = $paged + 1;
			return get_pagenum_link( $next_page );
		}
		return false;
	}
	
	
	function anant_pagi_previous_next( $wp_query ) {
		if( $wp_query->max_num_pages <= 1 ) return;
	
		$paged = (get_query_var('paged')) 
			? absint(get_query_var('paged')) 
				: (isset($_GET['paged']) 
					? absint($_GET['paged']) 
					: (get_query_var('page') 
						? absint(get_query_var('page')) 
						: 1));
					
		$max   = intval( $wp_query->max_num_pages );
	
		echo '<div class="anant-navigation navigation anant-pagi-p-n"><ul>' . "\n";
		
		// Previous link
		$prev_link = $this->custom_previous_posts_page_link( $paged );
		if ( $prev_link ) {
			echo "<li><a href='". esc_url($prev_link) ."' class='page-numbers anant-pagi-pre-btn'>Previous</a></li>";
		}
	
		// Next link
		$next_link = $this->custom_next_posts_page_link( $paged, $max );
		if ( $next_link ) {
			echo "<li><a href='". esc_url($next_link) ."' class='page-numbers'>Next</a></li>";
		}
	
		echo '</ul></div>' . "\n";
	}
}