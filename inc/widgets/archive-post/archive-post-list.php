<?php namespace AnantAddons;

use Elementor\Controls_Manager;
use Elementor\Widget_Base;
use ElementorPro\Modules\Posts\Widgets\Posts_Base;
use Elementor\Plugin;
use WP_Query;

class AnantArchivePostList extends \Elementor\Widget_Base {
	
	private $blog_list_class = 'anant-archive-post-list';
	private $blog_inner = 'anant-archive-post-list-inner';
	private $blog_category = 'anant-archive-post-list-category';
	private $blog_img = 'anant-archive-post-list-image';
	private $blog_title = 'anant-archive-post-list-title';
	private $blog_desc = 'anant-archive-post-list-description';
	private $blog_meta = 'anant-archive-post-list-meta';
	private $blog_date = 'anant-archive-post-list-meta-date';
	public function get_name() {
		return 'anant-archive-post-list';
	}

	public function get_title() {
		return __( 'Archive Post List', 'anant-addons-for-elementor' );
	}

	public function get_categories() {
		return [ 'anant-sng-blog-elements' ];
	}

	public function get_icon() {
		return 'ant-icon eicon-post-list';
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
			'post blog list',
			'news',
			'post',
			'blog',
			'list',
			 
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
			'template_style',
			[
				'label'       => esc_html__( 'Blog Post List Style', 'anant-addons-for-elementor' ),
				'placeholder' => esc_html__( 'Choose Template from Here', 'anant-addons-for-elementor' ),
				'type'        => \Elementor\Controls_Manager::SELECT,
				'default'     => 'layout_1',
				'options'     => [
					'layout_1'      => esc_html__( 'Layout 1', 'anant-addons-for-elementor' ),
					'layout_2'      => esc_html__( 'Layout 2', 'anant-addons-for-elementor' ),
					'layout_3'      => esc_html__( 'Layout 3', 'anant-addons-for-elementor' ),
					'layout_4'      => esc_html__( 'Layout 4', 'anant-addons-for-elementor' ), 
					'layout_5'      => esc_html__( 'Layout 5', 'anant-addons-for-elementor' ), 
 
				],
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
					'three'      => esc_html__( 'Style 3', 'anant-addons-for-elementor' ),
					'four'      => esc_html__( 'Style 4', 'anant-addons-for-elementor' ), 
					'five'      => esc_html__( 'Style 5', 'anant-addons-for-elementor' ), 
 
				],
			]
		);

		$this->add_control (
			'allow_sticky_post',
			[
				'type' => Controls_Manager::SWITCHER,
				'label' => esc_html__( 'Allow Sticky Posts', 'anant-addons-for-elementor' ),
				'default' => 'no',
				'return_value' => 'yes',
			]
		);

		anant_number_control(
			$this,
			[
				'key'         => 'number_of_posts',
				'label'       => 'Number of Posts',
				'placeholder' => 'Default is 4',
				'min'         => 1,
				'default'     => 5,
			]
		);

		anant_number_responsive_control(
			$this,
			[
				'key'         => 'post_count_per_row',
				'label'       => 'Post Count Per Row',
				'placeholder' => '2',
				'min'         => 1,
				'max'         => 4,
				'default'     => '',
				'selectors'       => [
					'{{WRAPPER}} .ant-grid' =>  'grid-template-columns: repeat({{VALUE}}, minmax(0, 1fr));',
				], 
			]
		);

		anant_number_responsive_control(
			$this,
			[
				'key'         => 'title_length',
				'label'       => 'Title Length',
				'placeholder' => 'Default is 10',
				'min'         => 0,
				'default'     => 10,
				'description' => 'Enter 0 to hide Title',
			]
		);

		anant_number_responsive_control(
			$this,
			[
				'key'         => 'excerpt_length',
				'label'       => 'Excerpt Length',
				'placeholder' => 'Default is 0',
				'min'         => 0,
				'default'     => 0,
				'description' => 'Enter 0 to hide Excerpt'
			]
		);

		anant_select2_control(
			$this,
			[
				'key'         => 'order_by',
				'label'       => 'Order By',
				'placeholder' => 'Order By',
				'multiple'    => false,
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
		
		anant_select2_control(
			$this,
			[
				'key'         => 'order',
				'label'       => 'Order',
				'placeholder' => 'Order',
				'multiple'    => false,
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
					'{{WRAPPER}} .ant-grid.ant-post-list' => 'grid-column-gap :{{SIZE}}{{UNIT}};',
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
					'{{WRAPPER}} .ant-grid.ant-post-list' => 'grid-row-gap :{{SIZE}}{{UNIT}};',
				], 
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'search_query_settings',
			[
				'label' => __( 'Search Query Settings', 'anant-addons-for-elementor' ),
				'tab'   => Controls_Manager::TAB_CONTENT,
			]
		);

		$this->add_control(
			'search_query_list',
			[
				'label' => esc_html__( 'Include Post Type in Search Result', 'anant-addons-for-elementor' ),
				'type' => \Elementor\Controls_Manager::SELECT2,
				'label_block' => true,
				'multiple' => true,
				'options' => get_all_post_types(),
				'default' => [ 'post' ],
			]
		);

		$this->add_control(
			'nothing_found_title', [
				'label' => __( 'Nothing Found Title', 'anant-addons-for-elementor' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => __( 'Nothing Found' , 'anant-addons-for-elementor' ),
				'label_block' => true,
			]
		);

		$this->add_control(
			'nothing_found_desc', [
				'label' => __( 'Nothing Found Description', 'anant-addons-for-elementor' ),
				'type' => \Elementor\Controls_Manager::TEXTAREA,
				'default' => __( 'Sorry, but nothing matched your search criteria. Please try again with some different keywords.', 'anant-addons-for-elementor' ),
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

		anant_switcher_control(
			$this,
			[
				'key'       => 'show_date',
				'label'     => 'Show Date',
				'on_label'  => 'Yes',
				'off_label' => 'No',
				'default' => 'yes'
			]
		);
		anant_switcher_control(
			$this,
			[
				'key'       => 'show_author',
				'label'     => 'Show Author',
				'on_label'  => 'Yes',
				'off_label' => 'No',
				'default' => 'yes'
			]
		);
		anant_switcher_control(
			$this,
			[
				'key'       => 'show_comments',
				'label'     => 'Show Comments',
				'on_label'  => 'Yes',
				'off_label' => 'No',
				'default' => 'yes'
			]
		);

		anant_switcher_control(
			$this,
			[
				'key'       => 'show_category',
				'label'     => 'Show Category',
				'on_label'  => 'Yes',
				'off_label' => 'No',
				'default' => 'yes'
			]
		);

		anant_switcher_control(
			$this,
			[
				'key'       => 'show_title',
				'label'     => 'Show Title',
				'on_label'  => 'Yes',
				'off_label' => 'No',
				'default' => 'yes'
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'pagination',
			[
				'label' => __( 'Pagination Settings', 'anant-addons-for-elementor' ),
				'tab'   => Controls_Manager::TAB_CONTENT, 
			]
		);

		anant_select2_control(
			$this,
			[
				'key'         => 'pagination_type',
				'label'       => 'Pagination',
				'placeholder' => 'Choose pagination to include',
				'options'     => [
					'none' => 'None',
					'numbers' => 'Numbers',
					'previous/next' => 'Previous/Next',
					'numbers+previous/next' => 'Numbers + Previous/Next',
				],
				'default' => 'none',
				'multiple'    => false,
			]
		);

		$this->add_control(
			'anant_archive_post_list_pro_notice',
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
				'label'     => 'Alignment',
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

		$this->start_controls_section(
			'blog_style',
			[
				'label' => __( 'Blog Post Settings', 'anant-addons-for-elementor' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);


		
		$slug = 'blog_box';

		$this->start_controls_tabs( $slug.'_tabs' );

		$this->start_controls_tab(
			$slug.'_normal_style',
			[
				'label' => __( 'Normal', 'anant-addons-for-elementor' ),
			]
		);

		$this->add_control(
			$slug.'_bg_color',
			[
				'label'     => __( 'Background Color', 'anant-addons-for-elementor' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}}  .'.$this->blog_list_class => 'background-color: {{VALUE}}',
				], 
			]
		);

		anant_border_control(
			$this,
			[
				'name'     => $slug.'_border_type',
				'label'    => 'Border Type',
				'selector' => '{{WRAPPER}} .'.$this->blog_list_class,
			]
		);

		anant_border_radius_control(
			$this,
			[
				'key'       => $slug.'_border_radius',
				'label'     => 'Border Radius',
				'selectors' => [
					'{{WRAPPER}} .'.$this->blog_list_class => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
					'{{WRAPPER}} .'.$this->blog_list_class => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
					'{{WRAPPER}} .'.$this->blog_list_class => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		anant_box_shadow_control(
			$this,
			[
				'key'      => $slug.'_box_shadow',
				'label'    => 'Box Shadow',
				'selector' => '{{WRAPPER}}  .'.$this->blog_list_class,
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
			$slug.'_bg_hover_color',
			[
				'label'     => __( 'Background Color', 'anant-addons-for-elementor' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}}  .'.$this->blog_list_class.':hover' => 'background-color: {{VALUE}}',
				], 
			]
		);

		 
		anant_border_control(
			$this,
			[
				'name'     => $slug.'_border_type_hover',
				'label'    => 'Border Type',
				'selector' => '{{WRAPPER}} .'.$this->blog_list_class.':hover',
			]
		);

		anant_border_radius_control(
			$this,
			[
				'key'       => $slug.'_border_radius_hover',
				'label'     => 'Border Radius',
				'selectors' => [
					'{{WRAPPER}} .'.$this->blog_list_class.':hover' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			$slug.'_padding_hover',
			[
				'label'     => esc_html__('Padding', 'anant-addons-for-elementor'),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .'.$this->blog_list_class.':hover' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			$slug.'_inner_padding_hover',
			[
				'label'     => esc_html__('Inner Content Padding', 'anant-addons-for-elementor'),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .'.$this->blog_inner.':hover' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			$slug.'_margin_hover',
			[
				'label'     => esc_html__('Margin', 'anant-addons-for-elementor'),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .'.$this->blog_list_class.':hover' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		anant_box_shadow_control(
			$this,
			[
				'key'      => $slug.'_box_shadow_hover',
				'label'    => 'Box Shadow',
				'selector' => '{{WRAPPER}}  .'.$this->blog_list_class.':hover',
			]
		);

		$this->end_controls_tab();
		$this->end_controls_tabs(); 
		$this->end_controls_section();


		$this->start_controls_section(
			'image_style',
			[
				'label' => __( 'Image Settings', 'anant-addons-for-elementor' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);

		$slug = 'blog_image';

		$this->start_controls_tabs( $slug.'_tabs' );

		$this->start_controls_tab(
			$slug.'_normal_style',
			[
				'label' => __( 'Normal', 'anant-addons-for-elementor' ),
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

		anant_box_shadow_control(
			$this,
			[
				'key'      => $slug.'_box_shadow',
				'label'    => 'Box Shadow',
				'selector' => '{{WRAPPER}}  .'.$this->blog_img.'',
			]
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
			$slug.'_style_hover',
			[
				'label' => __( 'Hover', 'anant-addons-for-elementor' ),

			]
		);

		
		$this->add_responsive_control(
			$slug.'_hover_image_width',
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
					'{{WRAPPER}} .'.$this->blog_img.':hover' => 'width: {{SIZE}}{{UNIT}};',
				],
			],
		);

		$this->add_responsive_control(
			$slug.'_hover_image_height',
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
					'{{WRAPPER}} .'.$this->blog_img.':hover' => 'height: {{SIZE}}{{UNIT}};',
				],
			]
		);


		anant_border_control(
			$this,
			[
				'name'     => $slug.'_border_type_hover',
				'label'    => 'Border Type',
				'selector' => '{{WRAPPER}} .'.$this->blog_img.':hover',
			]
		);

		anant_border_radius_control(
			$this,
			[
				'key'       => $slug.'_border_radius_hover',
				'label'     => 'Border Radius',
				'selectors' => [
					'{{WRAPPER}} .'.$this->blog_img.':hover' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			$slug.'_margin_hover',
			[
				'label'     => esc_html__('Margin', 'anant-addons-for-elementor'),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .'.$this->blog_img.':hover' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		anant_box_shadow_control(
			$this,
			[
				'key'      => $slug.'_box_shadow_hover',
				'label'    => 'Box Shadow',
				'selector' => '{{WRAPPER}}  .'.$this->blog_img.':hover',
			]
		);

		$this->end_controls_tab();
		$this->end_controls_tabs(); 
		$this->end_controls_section();

		$this->start_controls_section(
			'nothing_found_style_section',
			[
				'label' => esc_html__( 'Nothing Found Settings', 'anant-addons-for-elementor' ),
				'tab' => Controls_Manager::TAB_STYLE,
				'show_label' => false,
			]
		);

		$this->add_control(
			'nothing_found_title_heading',
			[
				'label' => esc_html__( 'Nothing found Title', 'anant-addons-for-elementor' ),
				'type' => \Elementor\Controls_Manager::HEADING,
				
			]
		);

		anant_color_control(
			$this,
			[
				'key'       => 'nothing_found_title_color',
				'label'     => esc_html__( 'Color', 'anant-addons-for-elementor' ),
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .anant-search-nothing-found h2' => 'color: {{VALUE}}',
				],
			]
		);

		anant_typography_control(
			$this,
			[
				'name'     => 'nothing_found_title_typography',
				'label'    => 'Typography',
				'selector' => '{{WRAPPER}} .anant-search-nothing-found h2',
			]
		);

		anant_text_shadow_control(
			$this,
			[
				'key'      => 'nothing_found_title_shadow',
				'label'    => 'Text Shadow',
				'selector' => '{{WRAPPER}} .anant-search-nothing-found h2',
                
			]
		);

		anant_text_stroke_control(
			$this,
			[
				'key'      => 'nothing_found_title_stroke',
				'label'    => 'Text Stroke',
				'selector' => '{{WRAPPER}} .anant-search-nothing-found h2',
                
			]
		);

		$this->add_responsive_control(
			'nothing_found_title_margin',
			[
				'label'     => esc_html__('Margin', 'anant-addons-for-elementor'),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .anant-search-nothing-found h2' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_control(
			$slug.'_separator_panel_style',
			[
				'type' => Controls_Manager::DIVIDER,
				'style' => 'thick',
			]
		);

		$this->add_control(
			'nothing_found_description_heading',
			[
				'label' => esc_html__( 'Nothing found Description', 'anant-addons-for-elementor' ),
				'type' => \Elementor\Controls_Manager::HEADING,
				
			]
		);

		anant_color_control(
			$this,
			[
				'key'       => 'nothing_found_description_color',
				'label'     => esc_html__( 'Color', 'anant-addons-for-elementor' ),
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .anant-search-nothing-found p' => 'color: {{VALUE}}',
				],
			]
		);

		anant_typography_control(
			$this,
			[
				'name'     => 'nothing_found_description_typography',
				'label'    => 'Typography',
				'selector' => '{{WRAPPER}} .anant-search-nothing-found p',
			]
		);

		anant_text_shadow_control(
			$this,
			[
				'key'      => 'nothing_found_description_shadow',
				'label'    => 'Text Shadow',
				'selector' => '{{WRAPPER}} .anant-search-nothing-found p',
                
			]
		);

		anant_text_stroke_control(
			$this,
			[
				'key'      => 'nothing_found_description_stroke',
				'label'    => 'Text Stroke',
				'selector' => '{{WRAPPER}} .anant-search-nothing-found p',
                
			]
		);

		$this->add_responsive_control(
			'nothing_found_description_margin',
			[
				'label'     => esc_html__('Margin', 'anant-addons-for-elementor'),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .anant-search-nothing-found p' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
				'label'     => 'Alignment',
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

		anant_box_shadow_control(
			$this,
			[
				'key'      => $slug.'_box_shadow',
				'label'    => 'Box Shadow',
				'selector' => '{{WRAPPER}}  .'.$this->blog_category.' a',
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
					'{{WRAPPER}}  .'.$this->blog_category.' a:hover' => 'color: {{VALUE}}',
				],
			]
		);
		$this->add_control(
			$slug.'_color_bg_hover',
			[
				'label'     => __( 'Background Color', 'anant-addons-for-elementor' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}}  .'.$this->blog_category.' a:hover' => 'background-color: {{VALUE}}',
				],
			]
		);
		anant_typography_control(
			$this,
			[
				'name'     => $slug.'_typography_hover',
				'label'    => 'Typography',
				'selector' => '{{WRAPPER}}  .'.$this->blog_category.' a:hover',
			]
		);
		anant_border_control(
			$this,
			[
				'name'     => $slug.'_border_type_hover',
				'label'    => 'Border Type',
				'selector' => '{{WRAPPER}} .'.$this->blog_category.' a:hover',
			]
		);

		anant_border_radius_control(
			$this,
			[
				'key'       => $slug.'_border_radius_hover',
				'label'     => 'Border Radius',
				'selectors' => [
					'{{WRAPPER}} .'.$this->blog_category.' a:hover' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			$slug.'_padding_hover',
			[
				'label'     => esc_html__('Padding', 'anant-addons-for-elementor'),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .'.$this->blog_category.' a:hover' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			$slug.'_margin_hover',
			[
				'label'     => esc_html__('Margin', 'anant-addons-for-elementor'),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .'.$this->blog_category.' a:hover' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		anant_box_shadow_control(
			$this,
			[
				'key'      => $slug.'_box_shadow_hover',
				'label'    => 'Box Shadow',
				'selector' => '{{WRAPPER}}  .'.$this->blog_category.' a:hover',
			]
		);

		$this->end_controls_tab();
		$this->end_controls_tabs(); 
		$this->end_controls_section();

		$this->start_controls_section(
			'title_style',
			[
				'label' => __( 'Title Settings', 'anant-addons-for-elementor' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);

		anant_select2_control(
			$this,
			[
				'key'         => 'title_html_tag',
				'label'       => 'Title HTML Tag',
				'placeholder' => 'Choose Tag to Include',
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
					'{{WRAPPER}}  .'.$this->blog_title.' a' => 'color: {{VALUE}}',
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
		
		anant_border_control(
			$this,
			[
				'name'     => $slug.'_border_type',
				'label'    => 'Border Type',
				'selector' => '{{WRAPPER}} .'.$this->blog_title,
			]
		);

		anant_border_radius_control(
			$this,
			[
				'key'       => $slug.'_border_radius',
				'label'     => 'Border Radius',
				'selectors' => [
					'{{WRAPPER}} .'.$this->blog_title => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
					'{{WRAPPER}} .'.$this->blog_title => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
					'{{WRAPPER}} .'.$this->blog_title => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		anant_text_shadow_control(
			$this,
			[
				'key'      => $slug.'_text_shadow',
				'label'    => 'Text Shadow',
				'selector' => '{{WRAPPER}}  .'.$this->blog_title,
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
					'{{WRAPPER}} .'.$this->blog_list_class.' .'.$this->blog_title.' a:hover' => 'color: {{VALUE}}',
				],
			]
		);

		anant_typography_control(
			$this,
			[
				'name'     => $slug.'_typography_hover',
				'label'    => 'Typography',
				'selector' => '{{WRAPPER}}  .'.$this->blog_title.':hover',
			]
		);
		anant_border_control(
			$this,
			[
				'name'     => $slug.'_border_type_hover',
				'label'    => 'Border Type',
				'selector' => '{{WRAPPER}} .'.$this->blog_title.':hover',
			]
		);

		anant_border_radius_control(
			$this,
			[
				'key'       => $slug.'_border_radius_hover',
				'label'     => 'Border Radius',
				'selectors' => [
					'{{WRAPPER}} .'.$this->blog_title.':hover' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			$slug.'_padding_hover',
			[
				'label'     => esc_html__('Padding', 'anant-addons-for-elementor'),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .'.$this->blog_title.':hover' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			$slug.'_margin_hover',
			[
				'label'     => esc_html__('Margin', 'anant-addons-for-elementor'),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .'.$this->blog_title.':hover' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		anant_text_shadow_control(
			$this,
			[
				'key'      => $slug.'_text_shadow_hover',
				'label'    => 'Text Shadow',
				'selector' => '{{WRAPPER}}  .'.$this->blog_title.':hover',
			]
		);

		$this->end_controls_tab();
		$this->end_controls_tabs(); 
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
				'label'     => 'Alignment',
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
		$this->start_controls_tabs( $slug.'_style_tabs' );

		$this->start_controls_tab(
			$slug.'_normal_style',
			[
				'label' => __( 'Normal', 'anant-addons-for-elementor' ),

			]
		);

		anant_color_control(
			$this,
			[
				'key'       => $slug.'_color',
				'label'     => 'Color',
				'selectors' => [
					'{{WRAPPER}} .'.$this->blog_meta.' a' => 'color: {{VALUE}};',
				],
			]
		);

		anant_color_control(
			$this,
			[
				'key'       => $slug.'_icon_color',
				'label'     => 'Icon Color',
				'selectors' => [
					'{{WRAPPER}} .'.$this->blog_meta.' a i' => 'color: {{VALUE}};',
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

		anant_border_control(
			$this,
			[
				'name'     => $slug.'_border_type',
				'label'    => 'Border Type',
				'selector' => '{{WRAPPER}} .'.$this->blog_meta.' a',
			]
		);

		anant_border_radius_control(
			$this,
			[
				'key'       => $slug.'_border_radius',
				'label'     => 'Border Radius',
				'selectors' => [
					'{{WRAPPER}} .'.$this->blog_meta.' a' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
					'{{WRAPPER}} .'.$this->blog_meta.' a' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
					'{{WRAPPER}} .'.$this->blog_meta.' a' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		anant_text_shadow_control(
			$this,
			[
				'key'      => $slug.'_text_shadow',
				'label'    => 'Text Shadow',
				'selector' => '{{WRAPPER}}  .'.$this->blog_meta.' a',
			]
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
			$slug.'_hover_style',
			[
				'label' => __( 'Hover', 'anant-addons-for-elementor' ),

			]
		);

		anant_color_control(
			$this,
			[
				'key'       => $slug.'_color_hover',
				'label'     => 'Color',
				'selectors' => [
					'{{WRAPPER}} .'.$this->blog_meta.' a:hover' => 'color: {{VALUE}};',
				],
			]
		);

		anant_color_control(
			$this,
			[
				'key'       => $slug.'_icon_hover_color',
				'label'     => 'Icon Color',
				'selectors' => [
					'{{WRAPPER}} .'.$this->blog_meta.' a:hover i' => 'color: {{VALUE}};',
				],
			]
		);

		anant_typography_control(
			$this,
			[
				'name'     =>  $slug.'_typography_hover',
				'label'    => 'Typography',
				'selector' => '{{WRAPPER}} .'.$this->blog_meta.' a:hover',
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

		anant_border_radius_control(
			$this,
			[
				'key'       => $slug.'_border_radius_hover',
				'label'     => 'Border Radius',
				'selectors' => [
					'{{WRAPPER}} .'.$this->blog_meta.' a:hover' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			$slug.'_padding_hover',
			[
				'label'     => esc_html__('Padding', 'anant-addons-for-elementor'),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .'.$this->blog_meta.' a:hover' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			$slug.'_margin_hover',
			[
				'label'     => esc_html__('Margin', 'anant-addons-for-elementor'),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .'.$this->blog_meta.' a:hover' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		anant_text_shadow_control(
			$this,
			[
				'key'      => $slug.'_text_shadow_hover',
				'label'    => 'Text Shadow',
				'selector' => '{{WRAPPER}}  .'.$this->blog_meta.' a:hover',
			]
		);

		$this->end_controls_tab();
		$this->end_controls_tabs();
		$this->end_controls_section();

		$this->start_controls_section(
			'metas_date_style',
			[
				'label' => __( 'Metas Date Settings', 'anant-addons-for-elementor' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);

		$slug = 'metas_date'; 
		 
		$this->start_controls_tabs( $slug.'_style_tabs' );

		$this->start_controls_tab(
			$slug.'_normal_style',
			[
				'label' => __( 'Normal', 'anant-addons-for-elementor' ),

			]
		);

		anant_color_control(
			$this,
			[
				'key'       => $slug.'_color',
				'label'     => 'Color',
				'selectors' => [
					'{{WRAPPER}} .'.$this->blog_date.' a' => 'color: {{VALUE}};',
					'{{WRAPPER}} .'.$this->blog_date.' a span' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			$slug.'_bg_color',
			[
				'label'     => __( 'Background Color', 'anant-addons-for-elementor' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}}  .'.$this->blog_date.'' => 'background-color: {{VALUE}}',
				],
			]
		);

		anant_typography_control(
			$this,
			[
				'name'     =>  $slug.'_day_typography',
				'label'    => 'Day Typography',
				'selector' => '{{WRAPPER}} .'.$this->blog_date.' a',
			]
		);

		anant_typography_control(
			$this,
			[
				'name'     =>  $slug.'_mounth_typography',
				'label'    => 'Month Typography',
				'selector' => '{{WRAPPER}} .'.$this->blog_date.' a span',
			]
		);

		anant_border_control(
			$this,
			[
				'name'     => $slug.'_border_type',
				'label'    => 'Border Type',
				'selector' => '{{WRAPPER}} .'.$this->blog_date.'',
			]
		);

		anant_border_radius_control(
			$this,
			[
				'key'       => $slug.'_border_radius',
				'label'     => 'Border Radius',
				'selectors' => [
					'{{WRAPPER}} .'.$this->blog_date.'' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
					'{{WRAPPER}} .'.$this->blog_date.'' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
					'{{WRAPPER}} .'.$this->blog_date.'' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
				'condition'   => [
					'template_style!' => 'layout_1',
				]
			]
		);

		anant_box_shadow_control(
			$this,
			[
				'key'      => $slug.'_box_shadow',
				'label'    => 'Box Shadow',
				'selector' => '{{WRAPPER}}  .'.$this->blog_date.'',
			]
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
			$slug.'_hover_style',
			[
				'label' => __( 'Hover', 'anant-addons-for-elementor' ),

			]
		);

		anant_color_control(
			$this,
			[
				'key'       => $slug.'_color_hover',
				'label'     => 'Color',
				'selectors' => [
					'{{WRAPPER}} .'.$this->blog_date.' a:hover' => 'color: {{VALUE}};',
					'{{WRAPPER}} .'.$this->blog_date.' a:hover span' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			$slug.'_bg_hover_color',
			[
				'label'     => __( 'Background Color', 'anant-addons-for-elementor' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}}  .'.$this->blog_date.':hover' => 'background-color: {{VALUE}}',
				],
			]
		);

		anant_typography_control(
			$this,
			[
				'name'     =>  $slug.'_day_hover_typography',
				'label'    => 'Day Typography',
				'selector' => '{{WRAPPER}} .'.$this->blog_date.':hover a',
			]
		);

		anant_typography_control(
			$this,
			[
				'name'     =>  $slug.'_mounth_hover_typography',
				'label'    => 'Month Typography',
				'selector' => '{{WRAPPER}} .'.$this->blog_date.':hover a span',
			]
		);
 
		anant_border_control(
			$this,
			[
				'name'     => $slug.'_border_type_hover',
				'label'    => 'Border Type',
				'selector' => '{{WRAPPER}} .'.$this->blog_date.':hover',
			]
		);

		anant_border_radius_control(
			$this,
			[
				'key'       => $slug.'_border_radius_hover',
				'label'     => 'Border Radius',
				'selectors' => [
					'{{WRAPPER}} .'.$this->blog_date.':hover' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			$slug.'_padding_hover',
			[
				'label'     => esc_html__('Padding', 'anant-addons-for-elementor'),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .'.$this->blog_date.':hover' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			$slug.'_margin_hover',
			[
				'label'     => esc_html__('Margin', 'anant-addons-for-elementor'),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .'.$this->blog_date.':hover' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
				'condition'   => [
					'template_style!' => 'layout_1',
				]
			]
		);

		anant_box_shadow_control(
			$this,
			[
				'key'      => $slug.'_box_shadow_hover',
				'label'    => 'Box Shadow',
				'selector' => '{{WRAPPER}}  .'.$this->blog_date.':hover',
			]
		);

		$this->end_controls_tab();
		$this->end_controls_tabs();
		$this->end_controls_section();

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

		$this->start_controls_tabs( $slug.'_style_tabs' );

		$this->start_controls_tab(
			$slug.'_normal_style',
			[
				'label' => __( 'Normal', 'anant-addons-for-elementor' ),

			]
		);

		anant_color_control(
			$this,
			[
				'key'       => $slug.'_color',
				'label'     => 'Color',
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

		anant_border_control(
			$this,
			[
				'name'     => $slug.'_border_type',
				'label'    => 'Border Type',
				'selector' => '{{WRAPPER}} .'.$this->blog_desc,
			]
		);
		
		anant_border_radius_control(
			$this,
			[
				'key'       => $slug.'_border_radius',
				'label'     => 'Border Radius',
				'selectors' => [
					'{{WRAPPER}} .'.$this->blog_desc => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
					'{{WRAPPER}} .'.$this->blog_desc.'' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
					'{{WRAPPER}} .'.$this->blog_desc.'' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		anant_text_shadow_control(
			$this,
			[
				'key'      => $slug.'_text_shadow',
				'label'    => 'Text Shadow',
				'selector' => '{{WRAPPER}}  .'.$this->blog_desc,
			]
		);
		$this->end_controls_tab();

		$this->start_controls_tab(
			$slug.'_hover_style',
			[
				'label' => __( 'Hover', 'anant-addons-for-elementor' ),

			]
		);

		anant_color_control(
			$this,
			[
				'key'       => $slug.'_color_hover',
				'label'     => 'Color',
				'selectors' => [
					'{{WRAPPER}} .'.$this->blog_desc.':hover' => 'color: {{VALUE}};',
				],
			]
		);

		anant_typography_control(
			$this,
			[
				'name'     =>  $slug.'_typography_hover',
				'label'    => 'Typography',
				'selector' => '{{WRAPPER}} .'.$this->blog_desc.':hover',
			]
		);

		anant_border_control(
			$this,
			[
				'name'     => $slug.'_border_type_hover',
				'label'    => 'Border Type',
				'selector' => '{{WRAPPER}} .'.$this->blog_desc.':hover',
			]
		);

		anant_border_radius_control(
			$this,
			[
				'key'       => $slug.'_border_radius_hover',
				'label'     => 'Border Radius',
				'selectors' => [
					'{{WRAPPER}} .'.$this->blog_desc.':hover' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			$slug.'_padding_hover',
			[
				'label'     => esc_html__('Padding', 'anant-addons-for-elementor'),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .'.$this->blog_desc.':hover' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			$slug.'_margin_hover',
			[
				'label'     => esc_html__('Margin', 'anant-addons-for-elementor'),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .'.$this->blog_desc.':hover' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		anant_text_shadow_control(
			$this,
			[
				'key'      => $slug.'_text_shadow_hover',
				'label'    => 'Text Shadow',
				'selector' => '{{WRAPPER}}  .'.$this->blog_desc.':hover',
			]
		);
		$this->end_controls_tab();
		$this->end_controls_tabs();
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

		anant_color_control(
			$this,
			[
				'key'       => $slug.'_background_color',
				'label'     => 'Background Color',
				'selectors' => [
					'{{WRAPPER}} .anant-navigation li .page-numbers' => 'background-color: {{VALUE}};',
				],
			]
		);

		anant_color_control(
			$this,
			[
				'key'       => $slug.'_color',
				'label'     => 'Color',
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

		anant_border_radius_control(
			$this,
			[
				'key'       => $slug.'_border_radius',
				'label'     => 'Border Radius',
				'selectors' => [
					'{{WRAPPER}} .anant-navigation li .page-numbers' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
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

		$this->end_controls_tab();

		$this->start_controls_tab(
			$slug.'_hover_style',
			[
				'label' => __( 'Hover', 'anant-addons-for-elementor' ),

			]
		);

		anant_color_control(
			$this,
			[
				'key'       => $slug.'_background_color_hover',
				'label'     => 'Background Color',
				'selectors' => [
					'{{WRAPPER}} .anant-navigation li .page-numbers:hover' => 'background-color: {{VALUE}};',
				],
			]
		);

		anant_color_control(
			$this,
			[
				'key'       => $slug.'_color_hover',
				'label'     => 'Color',
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

		anant_border_radius_control(
			$this,
			[
				'key'       => $slug.'_border_radius_hover',
				'label'     => 'Border Radius',
				'selectors' => [
					'{{WRAPPER}} .anant-navigation li .page-numbers:hover' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		anant_typography_control(
			$this,
			[
				'name'     =>  $slug.'_typography_hover',
				'label'    => 'Typography',
				'selector' => '{{WRAPPER}} .anant-navigation li .page-numbers:hover',
			]
		);

		$this->add_responsive_control(
			$slug.'_padding_hover',
			[
				'label'     => esc_html__('Padding', 'anant-addons-for-elementor'),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .anant-navigation li .page-numbers:hover' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			$slug.'_margin_hover',
			[
				'label'     => esc_html__('Margin', 'anant-addons-for-elementor'),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .anant-navigation li .page-numbers:hover' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
			$slug.'_active_style',
			[
				'label' => __( 'Active', 'anant-addons-for-elementor' ),

			]
		);

		anant_color_control(
			$this,
			[
				'key'       => $slug.'active_background_color',
				'label'     => 'Active Background Color',
				'selectors' => [
					'{{WRAPPER}} .anant-navigation li span.page-numbers.current' => 'background-color: {{VALUE}};',
				],
			]
		);

		anant_color_control(
			$this,
			[
				'key'       => $slug.'active_color',
				'label'     => 'Active Color',
				'selectors' => [
					'{{WRAPPER}} .anant-navigation li span.page-numbers.current' => 'color: {{VALUE}};',
				],
			]
		);

		anant_color_control(
			$this,
			[
				'key'       => $slug.'active_background_color_hover',
				'label'     => 'Active Hover Background Color',
				'selectors' => [
					'{{WRAPPER}} .anant-navigation li span.page-numbers.current:hover' => 'background-color: {{VALUE}};',
				],
			]
		);

		anant_color_control(
			$this,
			[
				'key'       => $slug.'active_color_hover',
				'label'     => 'Active Hover Color',
				'selectors' => [
					'{{WRAPPER}} .anant-navigation li span.page-numbers.current:hover' => 'color: {{VALUE}};',
				],
			]
		);

		anant_color_control(
			$this,
			[
				'key'       => $slug.'active_border_color_hover',
				'label'     => 'Active Hover Border Color',
				'selectors' => [
					'{{WRAPPER}} .anant-navigation li span.page-numbers.current:hover' => 'border-color: {{VALUE}};',
				],
			]
		);	

		anant_color_control(
			$this,
			[
				'key'       => $slug.'active_border_color',
				'label'     => 'Active Border Color',
				'selectors' => [
					'{{WRAPPER}} .anant-navigation li span.page-numbers.current' => 'border-color: {{VALUE}};',
				],
			]
		);
		$this->end_controls_tab();
		$this->end_controls_tabs();
		$this->end_controls_section();
	}

	protected function render() {
		$settings = $this->get_settings_for_display();

		$template_style = $settings['template_style'];
		$category_style = $settings['category_style'];

		$show_author = $settings['show_author'];
		$show_date = $settings['show_date'];
		$show_comments = $settings['show_comments'];
		$show_category = $settings['show_category'];
		$show_title = $settings['show_title']; 

		$title_html_tag = $settings['title_html_tag'];

		$excerpt_length = $settings['excerpt_length']; 
		$title_length = $settings['title_length']; 
		$paged = get_query_var( 'paged' ) ? absint( get_query_var( 'paged' ) ) : 1; 

		$CURRENT_URL = $_SERVER['REQUEST_URI'];

		if ( ( class_exists( "\Elementor\Plugin" ) && \Elementor\Plugin::$instance->editor->is_edit_mode() ) ||  ( class_exists( "\Elementor\Plugin" ) && isset( $_GET['preview'] ) && isset( $_GET['preview_id'] ) && $_GET['preview'] == true ) || ( strpos($CURRENT_URL, 'anant-header-footer') !== false && get_post_type() == 'anant-header-footer' ) ) {
			$post_id = get_the_ID();
        	$archive_type 	= Plugin::$instance->documents->get($post_id, false)->get_settings('demo_archive_select');
			$cat_archive 	= Plugin::$instance->documents->get($post_id, false)->get_settings('demo_cat_archive_select');
			$tag_archive 	= Plugin::$instance->documents->get($post_id, false)->get_settings('demo_tag_archive_select');
			$author_archive = Plugin::$instance->documents->get($post_id, false)->get_settings('demo_author_archive_select');
			$date_archive 	= Plugin::$instance->documents->get($post_id, false)->get_settings('demo_date_year_archive_select');
			$search_query 	= Plugin::$instance->documents->get($post_id, false)->get_settings('demo_search_result_archive_select');
			switch ($archive_type) {
				case 'category':
					$args = array(
						'category_name' => $cat_archive,
						'posts_per_page' => 5,
						'orderby' => 'ID',
						'order' => 'DESC',
						'post_type' => 'post',
						'post_status' => 'publish',
						'paged' => $paged
					);
				break;
			
				case 'tag':
					$tag = get_term_by('name', $tag_archive, 'post_tag');
					$args = array(
						'tag'           => $tag->slug,
						'posts_per_page' => 5,
						'orderby' => 'ID',
						'order' => 'DESC',
						'post_type' => 'post',
						'post_status' => 'publish',
						'paged' => $paged
					);
				break;
			
				case 'author':
					$user = get_user_by('id', $author_archive);
					$args = array(
						'author_name'   => $user->user_login,
						'posts_per_page' => 5,
						'orderby' => 'ID',
						'order' => 'DESC',
						'post_type' => 'post',
						'post_status' => 'publish',
						'paged' => $paged
					);
				break;
			
				case 'date':
					$args = array(
						'year'          => $date_archive,
						'posts_per_page' => 5,
						'orderby' => 'ID',
						'order' => 'DESC',
						'post_type' => 'post',
						'post_status' => 'publish',
						'paged' => $paged
					);
				break;
			
				case 'search':
					$args = array(
						's'              => $search_query,
						'post_type'      => 'post',
						'posts_per_page' => 5,
						'orderby' => 'ID',
						'order' => 'DESC',
						'post_status' => 'publish',
						'paged' => $paged
					);
				break;
			
				default:
				break;
			}
			
        }else{
			
			if (is_category()) {
				$category = get_category(get_queried_object_id());
				$args = array(
					'category_name' => $category->name,
					'posts_per_page' => 5,
					'orderby' => 'ID',
					'order' => 'DESC',
					'post_type' => 'post',
					'post_status' => 'publish',
					'paged' => $paged
				);
			} else if (is_tag()) {
				$args = array(
					'tag__in' => array(get_queried_object_id()),
					'posts_per_page' => 5,
					'orderby' => 'ID',
					'order' => 'DESC',
					'post_type' => 'post',
					'post_status' => 'publish',
					'paged' => $paged
				);
			}  else if (is_author()) {
				$user = get_user_by('id', get_queried_object_id());
				$args = array(
					'author_name'   => $user->user_login,
					'posts_per_page' => 5,
					'orderby' => 'ID',
					'order' => 'DESC',
					'post_type' => 'post',
					'post_status' => 'publish',
					'paged' => $paged
				);
			}  else if(is_date()) {
				$args = array(
					'post_type'      => 'post', 
					'posts_per_page' => -1,
					'orderby'        => 'date',
					'order'          => 'DESC',
					'date_query'     => array(),
				);

				if(!empty(get_query_var('m'))) {
					$m = get_query_var('m');
					if (!empty($m)) {
						$args['date_query']['year'] = substr($m, 0, 4);
						if (strlen($m) > 4) {
							$args['date_query']['month'] = substr($m, 4, 2);
						}
						if (strlen($m) > 6) {
							$args['date_query']['day'] = substr($m, 6, 2);
						}
					}
				} elseif (is_day()) {
					$args['date_query']['year'] = get_query_var('year');
					$args['date_query']['month'] = get_query_var('monthnum');
					$args['date_query']['day'] = get_query_var('day');
				} elseif (is_month()) {
					$args['date_query']['year'] = get_query_var('year');
					$args['date_query']['month'] = get_query_var('monthnum');
				} elseif (is_year()) {
					$args['date_query']['year'] = get_query_var('year');
				}
			}   else if (is_search()) {
				$search_query = get_search_query(); // Get the search query
				$args = array(
					's'              => $search_query,
					'post_type'		 => $settings['search_query_list'],
					'posts_per_page' => 5,
					'orderby' => 'ID',
					'order' => 'DESC',
					'post_status' => 'publish',
					'paged' => $paged
				);
				$archive_type = '';
			} 
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

		if ( $settings['allow_sticky_post'] !== 'yes' ) {
			$args['ignore_sticky_posts'] = 1;
		}

		$wp_query = new WP_Query( $args );

		?>
		<div class="ant-grid ant-post-list">
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
						<!-- blog list post -->
						<div class="ant-small-post one <?php echo esc_attr($this->blog_list_class );?>" id="<?php echo esc_attr(get_the_ID()); ?>">
							<?php 
								$image_src = '';
								if ($thumbnail_id) {
									$image_src = \Elementor\Group_Control_Image_Size::get_attachment_image_src($thumbnail_id, $thumbnail_size_key, $params['settings']);
								}
					
								if ( $image_src === '' ) {
									?>
										<div class="ant-img-small-post ant-back-img hlgr <?php echo esc_attr($this->blog_img) ;?>">
									<?php
								} else {
									$bg = "background-image: url(". esc_url($image_src) .");";
									?>
										<div class="ant-img-small-post ant-back-img hlgr <?php echo esc_attr($this->blog_img) ;?>" style=" <?php echo esc_attr($bg); ?> ">
									<?php
								}
							?> 
							<?php
								if( $show_date === 'yes' ) {
									?>
										<span class="ant-blog-date <?php echo esc_attr($this->blog_date );?>">
											<a href="<?php echo esc_url(get_day_link(get_post_time(''), get_post_time('m'), get_post_time('j')));  ?>" class="entry-date">
												<?php
													the_time('j');
													echo '<span>'; the_time('F');echo'</span>'; 
												?>
											</a>
										</span>
									<?php
								}
							?>
							<a href="<?php echo esc_url(get_permalink()); ?>" class="ant-link-div"></a>
							</div>
							<article class="ant-small-post-content <?php echo esc_attr($this->blog_inner );?>">
            					<div class="ant-blog-category <?php if ($category_style == 'one') { echo'one'; } 
								elseif ($category_style == 'two') { echo'two'; } 
								elseif (($category_style != 'two') || ($category_style != 'one')) { echo 'remove' ;} ;?> 
								<?php echo esc_attr($this->blog_category) ;?>">
									<?php
									if ( count($params['categories']) > 0 && $show_category === 'yes') {
										foreach($params['categories'] as $category ) {
											$category = (array) $category;
											?>
												<a href="<?php echo esc_url(get_category_link( $category['term_id'] )) ?>"><?php echo esc_html($category['name']) ?></a>
											<?php
										}
									}
									?>
							</div>
					
							 <?php
									if ( $show_title === 'yes' ) {
										// title_html_tag
					
										echo '<'.esc_attr($title_html_tag).' class="title '.esc_attr($this->blog_title).'">';
										if ( $params['title_length'] > 0 ) {
											?>
												<a href="<?php echo esc_url(get_permalink()); ?>" title="<?php the_title_attribute(); ?>"><?php echo esc_html(wp_trim_words(get_the_title(), 10, '' )); ?></a>
											<?php
										}
										echo '</'.esc_attr($title_html_tag).'>';
									}
								?>
					
								<div class="ant-blog-meta <?php echo esc_attr($this->blog_meta );?>">
									<?php
										if( $show_author === 'yes' ) {
											?>
												<span class="ant-author">
													<a href="<?php echo esc_url(get_author_posts_url(get_the_author_meta( 'ID' ))); ?>"><?php echo get_avatar(get_the_author_meta( 'ID') , 150); ?><?php the_author(); ?></a>
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
												<span class="ant-comments-link"> <a href="<?php comments_link(); ?>"><i class="far fa-comments"></i><?php echo esc_html(get_comments_number(). ' ') ?></a> </span>
											<?php
										}
									?>
								</div>
					
								<?php
									if ( $params['excerpt_length'] > 0 ) {
										?>
											<div class="discription <?php echo esc_attr($this->blog_desc );?>">
										<?php
										echo wp_kses_post(anant_get_excerpt( $params['excerpt_length'], get_post() ));
										?>
											</div>
										<?php
									}
								?>
							</article>
						</div>
						<!-- /blog list post -->
						<?php
						}
					endwhile;
					
					elseif(is_search()) : ?> 
						<div class="anant-search-nothing-found">
							<h2>
								<?php echo esc_html( $settings['nothing_found_title'] ); ?>
							</h2>
							<p>
								<?php echo esc_html( $settings['nothing_found_desc'] ); ?>
							</p>
						</div>
					<?php
			endif; ?>
		</div> <?php
		
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