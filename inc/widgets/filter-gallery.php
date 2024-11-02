<?php namespace AnantAddons;

use Elementor\Controls_Manager;
use Elementor\Widget_Base;
use Elementor\Group_Control_Background;

class AnantFilterGalley extends \Elementor\Widget_Base {

	private $gallery_card_class = 'anant-gallery-card'; 
	private $gallery_card_inner_class = 'anant-gallery-inner-card';
	private $gallery_card_content_class = 'anant-gallery-content-card';
	private $gallery_card_image_class = 'anant-gallery-card-image';
	private $gallery_card_heading_class = 'anant-gallery-card-heading';
	private $gallery_card_icon_class = 'anant-gallery-card-icon';
	private $gallery_card_description_class = 'anant-gallery-card-subtitle';

	public function get_name() {
		return 'anant-filter-gallery';
	}

	public function get_title() {
		return __( 'Filter Gallery', 'anant-addons-for-elementor' );
	}

	public function get_categories() {
		return [ 'anant-elements' ];
	}

	public function get_icon() {
		return 'ant-icon eicon-gallery-masonry';
	}

	public function get_style_depends() {
		return [
			'filter-gallery',
		];
	}

	public function get_script_depends() {
		return [
			'anant-filter-gallery',
		];
	}

	public function get_keywords() {
		return [
			'filter gallery',
			'gallery', 
			'filter', 
			'filterable gallery',
			'dynamic gallery',
			'anant addons',
			'',
		];
	}

	protected function register_controls() {

		$this->start_controls_section(
			'filter_gallery_settings',
			[
				'label' => __( 'Settings', 'anant-addons-for-elementor' ),
				'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);

		$this->add_control(
			'template_design',
			[
				'label'       => esc_html__( 'gallery Layout Style', 'anant-addons-for-elementor' ),
				'placeholder' => esc_html__( 'Choose Style from Here', 'anant-addons-for-elementor' ),
				'type'        => \Elementor\Controls_Manager::SELECT,
				'default'     => 'card',
				'options'     => [
					'card'      => esc_html__( 'Card ', 'anant-addons-for-elementor' ),
					'overlay' => esc_html__( 'Overlay', 'anant-addons-for-elementor' ),
				],
			]
		);

		$this->add_control(
			'template_card_style',
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
				],
				'condition' => [
                    'template_design' => ['card'],
                ],
			]
		);

		$this->add_control(
			'template_overlay_style',
			[
				'label'       => esc_html__( 'Template Style', 'anant-addons-for-elementor' ),
				'placeholder' => esc_html__( 'Choose Template from Here', 'anant-addons-for-elementor' ),
				'type'        => \Elementor\Controls_Manager::SELECT,
				'default'     => 'layout_1',
				'options'     => [
					'layout_1'     => esc_html__( 'Layout 1', 'anant-addons-for-elementor' ),
					'layout_2'      => esc_html__( 'Layout 2 (Pro)', 'anant-addons-for-elementor' ),
					'layout_3'      => esc_html__( 'Layout 3 (Pro)', 'anant-addons-for-elementor' ),
					'layout_4'      => esc_html__( 'Layout 4 (Pro)', 'anant-addons-for-elementor' ),
					'layout_5'      => esc_html__( 'Layout 5 (Pro)', 'anant-addons-for-elementor' ),
				],
				'condition' => [
                    'template_design' => ['overlay'],
                ],
			]
		);

		$this->add_control(
			'anant_portfolio_card_pro_notice',
			[
				'raw' => 'Only Available in <a href="https://anantaddons.com/" target="_blank">Pro Version!</a>',
				'type' => \Elementor\Controls_Manager::RAW_HTML,
				'content_classes' => 'anant-pro-notice',
				'condition' => [
                    'template_design' => ['card'],
                    'template_card_style!' => ['layout_1', 'layout_2'],
                ],
			]
		);

		$this->add_control(
			'anant_portfolio_overlay_pro_notice',
			[
				'raw' => 'Only Available in <a href="https://anantaddons.com/" target="_blank">Pro Version!</a>',
				'type' => \Elementor\Controls_Manager::RAW_HTML,
				'content_classes' => 'anant-pro-notice',
				'condition' => [
                    'template_design' => ['overlay'],
                    'template_overlay_style!' => ['layout_1'],
                ],
			]
		);

		$this->add_control(
			'btn1_icon',
			[
				'label' => __( 'Lightbox Icon', 'anant-addons-for-elementor' ),
				'type' => \Elementor\Controls_Manager::ICONS,
				'default' => [
					'value' => 'fas fa-link',
					'library' => 'solid',
				],

			]
		);
		
		$this->add_control(
			'btn2_icon',
			[
				'label' => __( 'Link Icon', 'anant-addons-for-elementor' ),
				'type' => \Elementor\Controls_Manager::ICONS,
				'default' => [
					'value' => 'far fa-eye',
					'library' => 'solid',
				],

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
			'show_buttons',
			[
				'label' => __( 'Show Buttons', 'anant-addons-for-elementor' ),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'label_on' => __( 'Show', 'anant-addons-for-elementor' ),
				'label_off' => __( 'Hide', 'anant-addons-for-elementor' ),
				'return_value' => 'yes',
				'default' => 'yes',
			]
		);

		$this->add_responsive_control(
			'filter_gallery_grid_column_count',
			[
				'label' => esc_html__( 'Grid Column Count', 'anant-addons-for-elementor' ) .' <i class="eicon-pro-icon"></i>' ,
				'type' => \Elementor\Controls_Manager::SELECT,
				'default' => '3',
				'options' => [
					'3' => esc_html__( '3', 'anant-addons-for-elementor' ),
				],
				'classes' => 'anant-pro-popup-notice',
			]
		);

		$this->add_responsive_control(
			'filter_gallery_grid_column_gap',
			[
				'label'           => __( 'Grid Column Space', 'anant-addons-for-elementor' ),
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
				'selectors'   => '',
				'classes' => 'anant-pro-popup-notice',
				'escape' => false,
			]
		);

		$this->add_responsive_control(
			'filter_gallery_grid_row_gap',
			[
				'label'           => __( 'Grid Row Space', 'anant-addons-for-elementor' ),
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
				'selectors'       => '',
				'classes' => 'anant-pro-popup-notice',
				'escape' => false,
			]
		);

		$this->end_controls_section();
		
		$this->start_controls_section(
			'filter_gallery_menu_section',
			[
				'label' => __( 'Filterable Settings', 'anant-addons-for-elementor' ),
				'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);

		$this->add_control(
			'show_filter_menu',
			[
				'label' => __( 'Show Filter', 'anant-addons-for-elementor' ),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'label_on' => __( 'Show', 'anant-addons-for-elementor' ),
				'label_off' => __( 'Hide', 'anant-addons-for-elementor' ),
				'return_value' => 'yes',
				'default' => 'yes',
			]
		);

		$repeater = new \Elementor\Repeater();

		$repeater->add_control(
			'menu_title', [
				'label' => __( 'Title', 'anant-addons-for-elementor' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'label_block' => true,
			]
		);


		$this->add_control(
			'menus',
			[
				'label' => __( 'Menu List', 'anant-addons-for-elementor' ),
				'type' => \Elementor\Controls_Manager::REPEATER,
				'fields' => $repeater->get_controls(),
				'default' => [
					[
						'menu_title' => __( 'All', 'anant-addons-for-elementor' ),
					],
					[
						'menu_title' => __( 'Gallery Name', 'anant-addons-for-elementor' ),
					],
					[
						'menu_title' => __( 'Gallery Name', 'anant-addons-for-elementor' ),
					],
				],
				'title_field' => '{{{ menu_title }}}',
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'filter_gallery_content_section',
			[
				'label' => __( 'Content', 'anant-addons-for-elementor' ),
				'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		); 

		$repeater = new \Elementor\Repeater();

		$repeater->add_control(
			'content_image',
			[
				'label'   => __( 'Choose Image', 'anant-addons-for-elementor' ),
				'type'    => Controls_Manager::MEDIA,
				'default' => [
					'url' => anant_placeholder_image_src(),
				],
			]
		); 

		$repeater->add_control(
			'filter_name', [
				'label' => __( 'Gallery Name', 'anant-addons-for-elementor' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => __( 'All' , 'anant-addons-for-elementor' ),
				'placeholder' => 'Enter menu name',
				'label_block' => true,
			]
		);
		$repeater->add_control(
			'filter_title', [
				'label' => __( 'Title', 'anant-addons-for-elementor' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => __( 'Title' , 'anant-addons-for-elementor' ),
				'placeholder' => 'Enter title',
				'label_block' => true,
			]
		);

		$repeater->add_control(
			'filter_description', [
				'label' => __( 'Description', 'anant-addons-for-elementor' ),
				'type' => \Elementor\Controls_Manager::TEXTAREA,
				'rows' => 10,
				'default' => __( 'Aenean ut turpis blandit eros convallis ', 'anant-addons-for-elementor' ),
				'placeholder' => __( 'Type your description here', 'anant-addons-for-elementor' ),
			]
		);

		$repeater->add_control(
			'filter_link',
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
			'filter_gallery_content_list',
			[
				'label' => __( 'Content List', 'anant-addons-for-elementor' ),
				'type' => \Elementor\Controls_Manager::REPEATER,
				'fields' => $repeater->get_controls(),
				'default' => [
					[
						'content_image' => anant_placeholder_image_src(),
						'filter_name' => 'All',
						'filter_title' => 'Gallery Item Name',
						'filter_description' => 'Aenean ut turpis blandit eros convallis',
						'filter_link' => '', 
					],
					[
						'content_image' => anant_placeholder_image_src(),
						'filter_name' => 'All',
						'filter_title' => 'Gallery Item Name',
						'filter_description' => 'Aenean ut turpis blandit eros convallis',
						'filter_link' => '', 
					],
					[
						'content_image' => anant_placeholder_image_src(),
						'filter_name' => 'All',
						'filter_title' => 'Gallery Item Name',
						'filter_description' => 'Aenean ut turpis blandit eros convallis',
						'filter_link' => '', 
					],
				],
				'title_field' => '{{filter_title}}',
			]
		);


		$this->end_controls_section();

		anant_pro_promotion_controls($this);

		// styles

		$this->start_controls_section(
			'filter_gallery_menu_style',
			[
				'label' => __( 'Menu Settings', 'anant-addons-for-elementor' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_responsive_control(
			'filter_gallery_menu_alignment',
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
				'default'   => '',
				'toggle'    => true,
				'selectors' => [
					'{{WRAPPER}} .anant-fg-filters' => 'justify-content: {{VALUE}};',
				],
			]
		);

		$this->start_controls_tabs( 'menu_style_tabs' );

		$this->start_controls_tab(
			'filter_gallery_menu_normal_style',
			[
				'label' => __( 'Normal', 'anant-addons-for-elementor' ),
			]
		);

		$this->add_control(
			'filter_gallery_menu_color',
			[
				'label'     => __( 'Color', 'anant-addons-for-elementor' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}}  .anant-fg-filter' => 'color: {{VALUE}}',
				],
			]
		);

		$this->add_control(
			'filter_gallery_menu_bg_color',
			[
				'label'     => __( 'Background Color', 'anant-addons-for-elementor' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}}  .anant-fg-filter' => 'background-color: {{VALUE}}',
				],
			]
		);

		anant_border_control(
			$this,
			[
				'name'     => 'menu_border_type',
				'label'    => 'Border Type',
				'selector' => '{{WRAPPER}} .anant-fg-filter',
			]
		);

        $this->end_controls_tab();

        $this->start_controls_tab(
			'filter_gallery_menu_hover_style',
			[
				'label' => __( 'Hover', 'anant-addons-for-elementor' ),
			]
		);

		$this->add_control(
			'filter_gallery_menu_color_hover',
			[
				'label'     => __( 'Color', 'anant-addons-for-elementor' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}}  .anant-fg-filter:hover' => 'color: {{VALUE}}',
				],
			]
		);

		$this->add_control(
			'filter_gallery_menu_bg_color_hover',
			[
				'label'     => __( 'Background Color', 'anant-addons-for-elementor' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}}  .anant-fg-filter:hover' => 'background-color: {{VALUE}}',
				],
			]
		);

		anant_border_control(
			$this,
			[
				'name'     => 'filter_gallery_menu_border_type_hover',
				'label'    => 'Border Type',
				'selector' => '{{WRAPPER}} .anant-fg-filter:hover',
			]
		);
		
        $this->end_controls_tab();

		$this->start_controls_tab(
			'filter_gallery_style_active',
			[
				'label' => __( 'Active', 'anant-addons-for-elementor' ),
			]
		);

		$this->add_control(
			'filter_gallery_color_active',
			[
				'label'     => __( 'Color', 'anant-addons-for-elementor' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}}  .anant-fg-filter.active' => 'color: {{VALUE}}',
				],
			]
		);
		$this->add_control(
			'filter_gallery_color_bg_active',
			[
				'label'     => __( 'Background Color', 'anant-addons-for-elementor' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}}  .anant-fg-filter.active' => 'background-color: {{VALUE}}',
				],
			]
		);
		
		anant_color_control(
			$this,
			[
				'key'       => 'filter_gallery_active_border_color',
				'label'     => 'Border Color',
				'selectors' => [
					'{{WRAPPER}}  .anant-fg-filter.active' => 'border-color: {{VALUE}};',
				],
			]
		);
		
		$this->add_control(
			'filter_gallery_active_color_hover',
			[
				'label'     => __( 'Hover Color', 'anant-addons-for-elementor' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}}  .anant-fg-filter.active:hover' => 'color: {{VALUE}}',
				],
			]
		);
		$this->add_control(
			'filter_gallery_active_color_bg_hover',
			[
				'label'     => __( 'Hover Background Color', 'anant-addons-for-elementor' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}}  .anant-fg-filter.active:hover' => 'background-color: {{VALUE}}',
				],
			]
		);
		
		anant_color_control(
			$this,
			[
				'key'       => 'filter_gallery_active_border_color_hover',
				'label'     => ' Hover Border Color',
				'selectors' => [
					'{{WRAPPER}} .anant-fg-filter.active:hover' => 'border-color: {{VALUE}};',
				],
			]
		);	

		$this->end_controls_tab();
		$this->end_controls_tabs();

		$this->add_control(
			'hr',
			[
				'type' => Controls_Manager::DIVIDER,
			]
		);

		anant_typography_control(
			$this,
			[
				'name'     => 'filter_gallery_menu_typography',
				'label'    => 'Typography',
				'selector' => '{{WRAPPER}}  .anant-fg-filter',
			]
		);

		anant_border_radius_control(
			$this,
			[
				'key'       => 'filter_gallery_menu_border_radius',
				'label'     => 'Border Radius',
				'selectors' => [
					'{{WRAPPER}} .anant-fg-filter' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					'{{WRAPPER}} .anant-fg-filter' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'filter_gallery_menu_padding',
			[
				'label'     => esc_html__('Padding', 'anant-addons-for-elementor'),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .anant-fg-filter' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'filter_gallery_menu_margin',
			[
				'label'     => esc_html__('Margin', 'anant-addons-for-elementor'),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .anant-fg-filter' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->end_controls_section();


		//gallery Box Settings
		$this->start_controls_section(
			'gallery_box_settings',
			[
				'label' => __( 'Box Settings ', 'anant-addons-for-elementor' ),
				'tab'   => Controls_Manager::TAB_STYLE, 
			]
		);
		
		$slug = 'gallery_box';

		$this->add_control(
			$slug.'_bg_color',
			[
				'label'     => __( 'Background Color', 'anant-addons-for-elementor' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}}  .'.$this->gallery_card_class.'' => 'background-color: {{VALUE}}',
				],
			]
		);

		anant_border_control(
			$this,
			[
				'name'     => $slug.'_border_type',
				'label'    => 'Border Type',
				'selector' => '{{WRAPPER}} .'.$this->gallery_card_class,
			]
		);

		anant_border_radius_control(
			$this,
			[
				'key'       => $slug.'_border_radius',
				'label'     => 'Border Radius',
				'selectors' => [
					'{{WRAPPER}} .'.$this->gallery_card_class => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
					'{{WRAPPER}} .'.$this->gallery_card_class => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
					'{{WRAPPER}} .'.$this->gallery_card_class => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		anant_box_shadow_control(
			$this,
			[
				'key'      => $slug.'_box_shadow',
				'label'    => 'Box Shadow',
				'selector' => '{{WRAPPER}}  .'.$this->gallery_card_class,
			]
		);
 
		$this->end_controls_section();

		//gallery Content Settings
		$this->start_controls_section(
			'gallery_content_settings',
			[
				'label' => __( 'Content Settings', 'anant-addons-for-elementor' ),
				'tab'   => Controls_Manager::TAB_STYLE, 
			]
		);
		
		$this->add_control(
			'card_bg_color',
			[
				'label'     => __( 'Background Color', 'anant-addons-for-elementor' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}}  .'.$this->gallery_card_content_class.'' => 'background-color: {{VALUE}}',
				],
			]
		);

		$this->add_control(
			'card_bg_color_hover',
			[
				'label'     => __( 'Hover Background Color', 'anant-addons-for-elementor' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .'.$this->gallery_card_content_class.':hover' => 'background-color: {{VALUE}}',
					'{{WRAPPER}} .'.$this->gallery_card_content_class.':before' => 'background-color: {{VALUE}}',
				],
			]
		);

		anant_border_control(
			$this,
			[
				'name'     => 'card_border_type',
				'label'    => 'Border Type',
				'selector' => '{{WRAPPER}} .'.$this->gallery_card_content_class,
			]
		);

		anant_border_radius_control(
			$this,
			[
				'key'       => 'card_border_radius',
				'label'     => 'Border Radius',
				'selectors' => [
					'{{WRAPPER}} .'.$this->gallery_card_content_class => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
					'{{WRAPPER}} .'.$this->gallery_card_content_class => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->end_controls_section();


		//gallery Image Settings
		$this->start_controls_section(
			'image_settings',
			[
				'label' => __( 'Image Settings', 'anant-addons-for-elementor' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name'      => 'bg_opacity_color',
				'types'          => [ 'classic'],
				'exclude'        => [ 'image' ],
				'fields_options' => [
					'background' => [
						'label'     => __( 'Background Overlay', 'anant-addons-for-elementor' ),
						'default' => 'classic',
					],
				],
				'selector'  => '{{WRAPPER}} .'.$this->gallery_card_image_class.'::before',
			]
		);

		$this->add_responsive_control(
			'bg_overlay_opacity',
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
					'{{WRAPPER}}  .'.$this->gallery_card_image_class.'::before' => 'opacity: {{SIZE}};',
				]
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
					'{{WRAPPER}} .'.$this->gallery_card_image_class.' ' => 'width: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .'.$this->gallery_card_image_class.'::before' => 'width: {{SIZE}}{{UNIT}};',
				],
			]
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
					'{{WRAPPER}} .'.$this->gallery_card_image_class.' ' => 'height: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .'.$this->gallery_card_image_class.'::before' => 'height: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->end_controls_section();
		
		//gallery Icon Settings
		$this->start_controls_section(
			'icon_settings',
			[
				'label' => __( 'Icon Settings', 'anant-addons-for-elementor' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);

		$this->start_controls_tabs( 'card_icon_tabs' );

		$this->start_controls_tab(
			'card_heading_icon_normal_style',
			[
				'label' => __( 'Normal', 'anant-addons-for-elementor' ),
			]
		);

		$this->add_control(
			'card_heading_icon_bg_color',
			[
				'label'     => __( 'Icon Background Color', 'anant-addons-for-elementor' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}}  .'.$this->gallery_card_icon_class.' a' => 'background-color: {{VALUE}}',
				],
			]
		);

		$this->add_control(
			'card_heading_icon_color',
			[
				'label'     => __( 'Icon Color', 'anant-addons-for-elementor' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}}  .'.$this->gallery_card_icon_class.' a i' => 'color: {{VALUE}}',
					'{{WRAPPER}}  .'.$this->gallery_card_icon_class.' a svg' => 'fill: {{VALUE}}',
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
					'{{WRAPPER}} .'.$this->gallery_card_icon_class.' a' => 'width: {{SIZE}}{{UNIT}};height: {{SIZE}}{{UNIT}};',
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
					'{{WRAPPER}} .'.$this->gallery_card_icon_class.' a i' => 'font-size: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .'.$this->gallery_card_icon_class.' a svg' => 'width: {{SIZE}}{{UNIT}}; height: {{SIZE}}{{UNIT}};',
				],
			]
		);

		anant_border_control(
			$this,
			[
				'name'     => 'icon_border_type',
				'label'    => 'Border Type',
				'selector' => '{{WRAPPER}} .'.$this->gallery_card_icon_class. ' a',
			]
		);

		anant_border_radius_control(
			$this,
			[
				'key'       => 'icon_border_type',
				'label'     => 'Border Radius',
				'selectors' => [
					'{{WRAPPER}} .'.$this->gallery_card_icon_class.' a' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					'{{WRAPPER}} .'.$this->gallery_card_icon_class. ' a' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
					'{{WRAPPER}} .'.$this->gallery_card_icon_class.' a' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					'{{WRAPPER}} .'.$this->gallery_card_icon_class.' a' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		anant_box_shadow_control(
			$this,
			[
				'key'      => 'icon_box_shadow',
				'label'    => 'Box Shadow',
				'selector' => '{{WRAPPER}}  .'.$this->gallery_card_icon_class . ' a',
			]
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
			'card_heading_icon_style_hover',
			[
				'label' => __( 'Hover', 'anant-addons-for-elementor' ),

			]
		);

		$this->add_control(
			'card_heading_icon_before_bg_color_hover',
			[
				'label'     => __( 'Icon Background Color', 'anant-addons-for-elementor' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .'.$this->gallery_card_icon_class.' a:before' => 'background-color: {{VALUE}}',
				],
			]
		);

		$this->add_control(
			'card_heading_icon_color_hover',
			[
				'label'     => __( 'Icon Color', 'anant-addons-for-elementor' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .'.$this->gallery_card_icon_class.' a:hover i' => 'color: {{VALUE}}',
					'{{WRAPPER}} .'.$this->gallery_card_icon_class.' a:hover svg' => 'fill: {{VALUE}}',
				],
			]
		);

		anant_border_control(
			$this,
			[
				'name'     => 'icon_border_type_hover',
				'label'    => 'Border Type',
				'selector' => '{{WRAPPER}} .'.$this->gallery_card_icon_class.' a:hover' ,
			]
		);

		anant_border_radius_control(
			$this,
			[
				'key'       => 'icon_border_radius_hover',
				'label'     => 'Border Radius',
				'selectors' => [
					'{{WRAPPER}} .'.$this->gallery_card_icon_class.' a:hover' =>  'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					'{{WRAPPER}} .'.$this->gallery_card_icon_class.' a:before' =>  'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->end_controls_tab(); 
		$this->end_controls_tabs(); 
		$this->end_controls_section();


		//gallery Title Settings
		$this->start_controls_section(
			'gallery_heading_title',
			[
				'label' => __( 'Heading Title', 'anant-addons-for-elementor' ),
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
					'{{WRAPPER}} .'.$this->gallery_card_heading_class => 'text-align: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'card_heading_title_color',
			[
				'label'     => __( 'Heading Color', 'anant-addons-for-elementor' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}}  .'.$this->gallery_card_heading_class.' a' => 'color: {{VALUE}}',
				],
			]
		);
		
		$this->add_control(
			'card_heading_title_color_hover',
			[
				'label'     => __( 'Hover Heading Color', 'anant-addons-for-elementor' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .'.$this->gallery_card_content_class.':hover .'.$this->gallery_card_heading_class.' a' => 'color: {{VALUE}}',
				],
			]
		);

		anant_typography_control(
			$this,
			[
				'name'     => 'card_heading_title_typography',
				'label'    => 'Typography',
				'selector' => '{{WRAPPER}}  .'.$this->gallery_card_heading_class,
			]
		);

		$this->add_responsive_control(
			'card_heading_title_margin',
			[
				'label'     => esc_html__('Margin', 'anant-addons-for-elementor'),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .'.$this->gallery_card_heading_class => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					'{{WRAPPER}} .'.$this->gallery_card_heading_class => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->end_controls_section();

		//gallery Subtitle Settings
		$this->start_controls_section(
			'gallery_description',
			[
				'label' => __( 'Description ', 'anant-addons-for-elementor' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_responsive_control(
			'card_heading_description_alignment',
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
					'{{WRAPPER}} .'.$this->gallery_card_description_class => 'text-align: {{VALUE}};',
					
				],
			]
		);

		$this->add_control(
			'card_heading_description_color',
			[
				'label'     => __( 'Color', 'anant-addons-for-elementor' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}}  .'.$this->gallery_card_description_class => 'color: {{VALUE}}',
				],
			]
		);

		$this->add_control(
			'card_heading_description_color_hover',
			[
				'label'     => __( 'Hover Color', 'anant-addons-for-elementor' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .'.$this->gallery_card_content_class.':hover .'.$this->gallery_card_description_class => 'color: {{VALUE}}',
				],
			]
		);
		
		anant_typography_control(
			$this,
			[
				'name'     => 'card_heading_description_typography',
				'label'    => 'Typography',
				'selector' => '{{WRAPPER}}  .'.$this->gallery_card_description_class,
			]
		);

		$this->add_responsive_control(
			'card_heading_description_margin',
			[
				'label'     => esc_html__('Margin', 'anant-addons-for-elementor'),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .'.$this->gallery_card_description_class => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					'{{WRAPPER}} .'.$this->gallery_card_heading_class => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->end_controls_section(); 

	}

	protected function render() {
		$settings = $this->get_settings_for_display(); 
		$show_title = $settings['show_title']; 
		$show_icon = $settings['show_buttons'];
		$show_subtitle = $settings['show_description'];

		
		$card_icon = $settings['btn1_icon'];
		$card_two_icon = $settings['btn2_icon'];

		if ( $settings['menus'] ) { ?>
			<div class="anant-fg-filters">
				<?php 
				foreach (  $settings['menus'] as $key => $item ) { 
					 ?>
					<span class="anant-fg-filter <?php if($key == 0) { echo 'active';} ?>" data-filter="<?php echo esc_attr($item['menu_title']) ?>"><?php echo esc_html($item['menu_title']) ?></span>
				<?php } ?>
    		</div>
		<?php
		}
		if ( $settings['filter_gallery_content_list'] ) { ?>
			<div class="anant-fg-projects"> 

			<?php foreach (  $settings['filter_gallery_content_list'] as $item ) {
				
				$title = $item['filter_title'];
				$subtitle = $item['filter_description']; 
				$image_url = $item['content_image']['url']; 
				$link = $item['filter_link']['url'];
				$target = $item['filter_link']['is_external'] ? ' target=_blank' : '';
				$nofollow = $item['filter_link']['nofollow'] ? ' rel=nofollow' : ''; ?>
				<div class="anant-fg-project" data-filter="<?php echo esc_attr($item['filter_name']) ?>">
				<?php 
				$template_card_style = $settings['template_card_style'];
				$template_overlay_style = $settings['template_overlay_style'];

				$template_path = ANANT_PATH . 'inc/templates/gallery/';

				switch ($template_card_style) {
					case 'layout_1':
						require $template_path. 'layout-1.php';
						break;
					case 'layout_2':
						require $template_path. 'layout-2.php';
						break;
				}
				switch ($template_overlay_style) {
					case 'layout_1':
						require $template_path. 'layout-3.php';
						break;
				}
				?>
					
				</div>
			<?php } ?>
    		</div>
		<?php
		}
	}
}