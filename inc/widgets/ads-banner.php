<?php // phpcs:disable Squiz.PHP.CommentedOutCode.Found
namespace AnantAddons;

use Elementor\Controls_Manager;
use Elementor\Group_Control_Background;

class AnantAdsBanner extends \Elementor\Widget_Base {

	private $ads_banner_card_class = 'anant-ads-banner';
	private $ads_banner_inner = 'anant-ads-banner-inner'; 
	private $ads_banner_img = 'anant-banner-image';
	private $ads_banner_subtitle = 'anant-banner-subtitle';
	private $ads_banner_title = 'anant-banner-title';
	private $ads_banner_btn = 'anant-banner-button';

	public function get_name() {
		return 'anant-ads-banner';
	}

	public function get_title() {
		return __( 'Ads Banner', 'anant-addons-for-elementor' );
	}

	public function get_categories() {
		return [ 'anant-elements' ];
	}

	public function get_icon() {
		return 'ant-icon eicon-product-breadcrumbs';
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
			'ads banner',
			'banner',
			'promotion',
			'advertise',
			'ads',
			'ad',
			'anant addons',
			'woo',
		];
	}

	protected function register_controls() {
		$this->start_controls_section(
			'query_configuration',
			[
				'label' => __( 'Content Settings', 'anant-addons-for-elementor' ),
				'tab'   => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);

		$this->add_control(
			'template_style',
			[
				'label'       => esc_html__( 'Template Style', 'anant-addons-for-elementor' ),
				'placeholder' => esc_html__( 'Choose Template from Here', 'anant-addons-for-elementor' ),
				'type'        => \Elementor\Controls_Manager::SELECT,
				'default'     => 'one',
				'options'     => [
					'one'      => esc_html__( 'Layout 1', 'anant-addons-for-elementor' ),
					'two'      => esc_html__( 'Layout 2 (Pro)', 'anant-addons-for-elementor' ),
					'three'      => esc_html__( 'Layout 3 (Pro)', 'anant-addons-for-elementor' ),
					'four'      => esc_html__( 'Layout 4 (Pro)', 'anant-addons-for-elementor' ), 
				],
			]
		);

		$this->add_control(
			'anant_woo_banner_pro_notice',
			[
				'raw' => 'Only Available in <a href="https://anantaddons.com/" target="_blank">Pro Version!</a>',
				'type' => \Elementor\Controls_Manager::RAW_HTML,
				'content_classes' => 'anant-pro-notice',
				'condition' => [
                    'template_style!' => ['one'],
                ],
			]
		);

		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name'      => 'card_bg_image',
				'types'     => [ 'classic' ],
				'fields_options' => [
					'background' => [
						'label'     => __('Choose Background Image', 'anant-addons-for-elementor' ),
						'default' => 'classic',
					],
				],
				'selector'  => '{{WRAPPER}} .'.$this->ads_banner_card_class,
			]
		);

		$this->add_control(
			'card_subtitle',
			[
				'label' => __( 'Subtitle', 'anant-addons-for-elementor' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => __( 'Limited Time Offer' , 'anant-addons-for-elementor' ),
				'label_block' => true,

			]
		);

		$this->add_control(
			'card_title', [
				'label' => __( 'Title', 'anant-addons-for-elementor' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => __( 'Our Best Collection ' , 'anant-addons-for-elementor' ),
				'label_block' => true,
			]
		);

		$this->add_control(
			'card_btn', [
				'label' => __( 'Button', 'anant-addons-for-elementor' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => __( 'Show Now' , 'anant-addons-for-elementor' ),
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
			'card_image',
			[
				'label'   => __( 'Choose Image', 'anant-addons-for-elementor' ),
				'type'    => Controls_Manager::MEDIA,
				'default' => [
					'url' => anant_placeholder_image_src(),
				],
				'description' => __('use PNG image', 'anant-addons-for-elementor' ),
				'condition' => [
					'template_style' => [ 'one'],
				],
			]
		);
		$this->end_controls_section();

		$this->start_controls_section(
			'item_configuration',
			[
				'label' => __( 'Item Settings', 'anant-addons-for-elementor' ),
				'tab'   => Controls_Manager::TAB_CONTENT,
			]
		);

		anant_switcher_control(
			$this,
			[
				'key'       => 'show_subtitle',
				'label'     => 'Show Subtitle',
				'on_label'  => 'Yes',
				'off_label' => 'No',
				'default'   => 'yes',
			]
		);

		anant_switcher_control(
			$this,
			[
				'key'       => 'show_title',
				'label'     => 'Show Title',
				'on_label'  => 'Yes',
				'off_label' => 'No',
				'default'   => 'yes',
			]
		);

		anant_switcher_control(
			$this,
			[
				'key'       => 'show_btn',
				'label'     => 'Show Button',
				'on_label'  => 'Yes',
				'off_label' => 'No',
				'default'   => 'yes',
			]
		);

		$this->end_controls_section();

		anant_pro_promotion_controls($this);
	
		// STYLE
		// style item box
		$this->start_controls_section(
			'section_item_style',
			[
				'label' => __( 'Banner Settings', 'anant-addons-for-elementor' ),
				'tab'   => Controls_Manager::TAB_STYLE,

			]
		);

		$slug = 'ads_categroy_item';

		anant_color_control(
			$this,
			[
				'key'       => $slug.'_bg_color',
				'label'     => 'Background Color',
				'selectors' => [
					'{{WRAPPER}} .'.$this->ads_banner_card_class.':after' => 'background-color: {{VALUE}};',
				],
			]
		);

		anant_border_control(
			$this,
			[
				'name'     => $slug.'_border_type',
				'label'    => 'Border Type',
				'selector' => '{{WRAPPER}} .'.$this->ads_banner_card_class,
			]
		);

		anant_border_radius_control(
			$this,
			[
				'key'       => $slug.'_border_radius',
				'label'     => 'Border Radius',
				'selectors' => [
					'{{WRAPPER}} .'.$this->ads_banner_card_class => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
					'{{WRAPPER}} .'.$this->ads_banner_card_class => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
					'{{WRAPPER}} .'.$this->ads_banner_card_class => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		anant_box_shadow_control(
			$this,
			[
				'key'      => $slug.'_box_shadow',
				'label'    => 'Box Shadow',
				'selector' => '{{WRAPPER}} .'.$this->ads_banner_card_class,
			]
		);

		$this->end_controls_section();
		// style item ends

		// styles image
		$this->start_controls_section(
			'section_image_style',
			[
				'label'     => __( 'Image Settings', 'anant-addons-for-elementor' ),
				'tab'       => Controls_Manager::TAB_STYLE,
			]
		);

		$slug = 'ads_categroy_image';

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
					'{{WRAPPER}} .'.$this->ads_banner_img.' .ant_img' => 'width: {{SIZE}}{{UNIT}};', 
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
					'{{WRAPPER}} .'.$this->ads_banner_img.' .ant_img' => 'height: {{SIZE}}{{UNIT}};', 
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
					'{{WRAPPER}} .'.$this->ads_banner_img.'' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->end_controls_section();
		// styles image ends

		// styles item subtitle
		$this->start_controls_section(
			'section_item_subtitle_style',
			[
				'label'     => __( 'Subtitle Settings', 'anant-addons-for-elementor' ),
				'tab'       => Controls_Manager::TAB_STYLE,
				'condition' => [
					'show_subtitle' => 'yes',
				],
			]
		);
		$slug = 'ads_categroy_subtitle';
		anant_alignment_control(
			$this,
			[
				'key'       => $slug.'_text_align',
				'label'     => 'Alignment',
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
				'default'   => '',
				'selectors' => [
					'{{WRAPPER}} .ant-banner-subtitle' => 'text-align: {{VALUE}}',
				],
			]
		);

		anant_color_control(
			$this,
			[
				'key'       => $slug.'_text_color',
				'label'     => 'Color',
				'selectors' => [
					'{{WRAPPER}} .'.$this->ads_banner_subtitle => 'color: {{VALUE}};',
				],
			]
		);

		anant_typography_control(
			$this,
			[
				'name'     => $slug.'_typography',
				'label'    => 'Typography',
				'selector' => '{{WRAPPER}} .'.$this->ads_banner_subtitle,
			]
		);

		anant_border_control(
			$this,
			[
				'name'     => $slug.'_border_type',
				'label'    => 'Border Type',
				'selector' => '{{WRAPPER}} .'.$this->ads_banner_subtitle,
			]
		);

		$this->add_responsive_control(
			$slug.'_margin',
			[
				'label'     => esc_html__('Margin', 'anant-addons-for-elementor'),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .'.$this->ads_banner_subtitle => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->end_controls_section();
		// style item subtitle ends

		// styles item title
		$this->start_controls_section(
			'section_item_title_style',
			[
				'label'     => __( 'Title Settings', 'anant-addons-for-elementor' ),
				'tab'       => Controls_Manager::TAB_STYLE,
				'condition' => [
					'show_title' => 'yes',
				],
			]
		);
		$slug = 'ads_categroy_title';
		anant_alignment_control(
			$this,
			[
				'key'       => $slug.'_text_align',
				'label'     => 'Alignment',
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
				'default'   => '',
				'selectors' => [
					'{{WRAPPER}} .'.$this->ads_banner_title => 'text-align: {{VALUE}}',
				],
			]
		);

		anant_color_control(
			$this,
			[
				'key'       => $slug.'_text_color',
				'label'     => 'Color',
				'selectors' => [
					'{{WRAPPER}} .'.$this->ads_banner_title => 'color: {{VALUE}};',
				],
			]
		);

		anant_typography_control(
			$this,
			[
				'name'     => $slug.'_typography',
				'label'    => 'Typography',
				'selector' => '{{WRAPPER}} .'.$this->ads_banner_title,
			]
		);

		$this->add_responsive_control(
			$slug.'_margin',
			[
				'label'     => esc_html__('Margin', 'anant-addons-for-elementor'),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .'.$this->ads_banner_title => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->end_controls_section();
		// style item title ends

		// styles item count
		$this->start_controls_section(
			'section_item_count_style',
			[
				'label'     => __( 'Button Settings', 'anant-addons-for-elementor' ),
				'tab'       => Controls_Manager::TAB_STYLE,
				'condition' => [
					'show_btn' => 'yes',
				]
			]
		);
		$slug = 'ads_categroy_count';
		anant_alignment_control(
			$this,
			[
				'key'       => $slug.'_text_align',
				'label'     => 'Alignment',
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
				'default'   => '',
				'selectors' => [
					'{{WRAPPER}} .'.$this->ads_banner_card_class.' .ant-banner-button' => 'text-align: {{VALUE}}',
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

		anant_color_control(
			$this,
			[
				'key'       => $slug.'_text_color',
				'label'     => 'Color',
				'selectors' => [
					'{{WRAPPER}} .'.$this->ads_banner_btn.'' => 'color: {{VALUE}};',
				],
			]
		);

		anant_color_control(
			$this,
			[
				'key'       => $slug.'_bg_color',
				'label'     => 'Background Color',
				'selectors' => [
					'{{WRAPPER}} .'.$this->ads_banner_btn.'' => 'background-color: {{VALUE}};',
				],
			]
		);

		anant_border_control(
			$this,
			[
				'name'     => $slug.'_border_type',
				'label'    => 'Border Type',
				'selector' => '{{WRAPPER}} .'.$this->ads_banner_btn.'',
			]
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
			$slug.'_style_hover',
			[
				'label' => __( 'Hover', 'anant-addons-for-elementor' ),

			]
		);

		anant_color_control(
			$this,
			[
				'key'       => $slug.'_text_color_hover',
				'label'     => 'Color',
				'selectors' => [
					'{{WRAPPER}} .'.$this->ads_banner_btn.':hover' => 'color: {{VALUE}};',
				],
			]
		);

		anant_color_control(
			$this,
			[
				'key'       => $slug.'_bg_color_hover',
				'label'     => 'Background Color',
				'selectors' => [
					'{{WRAPPER}} .'.$this->ads_banner_btn.':before' => 'background-color: {{VALUE}};',
				],
			]
		);

		anant_border_control(
			$this,
			[
				'name'     => $slug.'_border_type_hover',
				'label'    => 'Border Type',
				'selector' => '{{WRAPPER}} .'.$this->ads_banner_btn.':hover',
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
				'name'     => $slug.'_typography',
				'label'    => 'Typography',
				'selector' => '{{WRAPPER}} .'.$this->ads_banner_btn.'',
			]
		);

		anant_border_radius_control(
			$this,
			[
				'key'       => $slug.'_border_radius',
				'label'     => 'Border Radius',
				'selectors' => [
					'{{WRAPPER}} .'.$this->ads_banner_btn.'' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
					'{{WRAPPER}} .'.$this->ads_banner_btn.'' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
					'{{WRAPPER}} .'.$this->ads_banner_btn.'' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		anant_box_shadow_control(
			$this,
			[
				'key'      => $slug.'_box_shadow',
				'label'    => 'Box Shadow',
				'selector' => '{{WRAPPER}} .'.$this->ads_banner_btn.'',
			]
		);

		$this->end_controls_section();
		// style item count ends
	}

	protected function render() {
		$settings = $this->get_settings_for_display();
		$show_btn = $settings['show_btn'];
		$show_title = $settings['show_title'];
		$show_subtitle = $settings['show_subtitle'];

		$title = $settings['card_title'];
		$subtitle = $settings['card_subtitle'];
		$card_btn = $settings['card_btn'];
		$link = $settings['card_link']['url'];
		$target = $settings['card_link']['is_external'] ? ' target=_blank' : '';
		$nofollow = $settings['card_link']['nofollow'] ? ' rel=nofollow' : '';

		$template_style = $settings['template_style'];

		if ( ($template_style == 'one') ) {
			$image_url = $settings['card_image']['url'];
		?>
		<div class="ant-banner <?php echo esc_attr($template_style) ?>">
			<div class="overlay <?php echo esc_attr($this->ads_banner_card_class) ?>">
			  <?php if ( ($template_style == 'one') ) { ?>
				  <div class="ant-banner-img <?php echo esc_attr($this->ads_banner_img) ?>">
					  <img src="<?php echo esc_url($image_url) ?>" class="img-mover ant_img" alt="<?php echo esc_html($title) ?>">
				  </div>
			  <?php } ?>

			  <div class="ant-content">
			  <?php if($show_subtitle == 'yes') { ?>
					<span class="ant-banner-subtitle">
						<span class="subtitle <?php echo esc_attr($this->ads_banner_subtitle) ?>"><?php echo esc_html($subtitle) ?></span>
					</span>
				<?php } ?>

			  <?php if($show_title == 'yes') { ?>
				  <h3 class="title <?php echo esc_attr($this->ads_banner_title) ?>"><?php echo esc_html($title) ?></h3> 
			  <?php } ?>

			  <?php if($show_btn == 'yes') { ?>
				<div class="ant-banner-button">
						<a href="<?php echo esc_url($link) ?>" <?php echo esc_attr($target) ?> <?php echo esc_attr($nofollow) ?> class="more <?php echo esc_attr($this->ads_banner_btn) ?>">
							<?php echo esc_html($card_btn) ?>
						</a>
					</div>          
			  <?php } ?>

			  </div>
			</div>
		  </div>
		  <?php
		} 
		
	}
}