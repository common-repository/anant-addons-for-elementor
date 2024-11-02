<?php namespace AnantAddons;

use Elementor\Controls_Manager;
use Elementor\Widget_Base;
use ElementorPro\Modules\Posts\Widgets\Posts_Base;
use Elementor\Group_Control_Background;
use WP_Query;

class AnantMarqueeStipe extends \Elementor\Widget_Base {

	private $marquee_stripe = 'anant-marquee-stripe';
	private $marquee_stripe_main = 'anant-marquee-main';
	private $marquee_stripe_item = 'anant-marquee-item';

	public function get_name() {
		return 'anant-marquee-stripe';
	}

	public function get_title() {
		return __( 'Marquee Stripe', 'anant-addons-for-elementor' );
	}

	public function get_categories() {
		return [ 'anant-elements' ];
	}

	public function get_icon() {
		return 'ant-icon eicon-form-vertical';
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
			'marquee stripe',
			'stripe',
			'marquee ticker',
			'news ticker',
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
			'marquee_type',
			[
				'label'       => esc_html__( 'Marquee Type', 'anant-addons-for-elementor' ),
				'type'        => \Elementor\Controls_Manager::SELECT,
				'default'     => 'repeater',
				'options'     => [
					'repeater'  => esc_html__( 'Marquee By Repeater', 'anant-addons-for-elementor' ),
					'post'      => esc_html__( 'Marquee By Post (Pro)', 'anant-addons-for-elementor' ),
					'product'   => esc_html__( 'Marquee By Product (Pro)', 'anant-addons-for-elementor' ),
 
				],
			]
		);

		$this->add_control(
			'post_taxonomy_select',
			[
				'label'       => esc_html__( 'Post Texonomy', 'anant-addons-for-elementor' ),
				'type'        => \Elementor\Controls_Manager::SELECT,
				'default'     => 'post_categories',
				'options'     => [
					'post_categories'  => esc_html__( 'Categories', 'anant-addons-for-elementor' ),
					'post_tags'      => esc_html__( 'Tags', 'anant-addons-for-elementor' ), 
				],
				'condition' => [ 
					'marquee_type' => 'post',
				],
				'classes' => 'anant-pro-popup-notice',
			]
		);
				
		if ( class_exists( 'woocommerce' ) ) {

			$this->add_control(
				'product_taxonomy_select',
				[
					'label'       => esc_html__( 'Product Texonomy', 'anant-addons-for-elementor' ),
					'type'        => \Elementor\Controls_Manager::SELECT,
					'default'     => 'product_categories',
					'options'     => [
						'product_categories'  => esc_html__( 'Categories', 'anant-addons-for-elementor' ),
						'product_tags'      => esc_html__( 'Tags', 'anant-addons-for-elementor' ), 
					],
					'condition' => [ 
						'marquee_type' => 'product',
					],
					'classes' => 'anant-pro-popup-notice',
				]
			);

		}else{

			$this->add_control(
				'woocommerce_off_notice',
				[
					'type' => \Elementor\Controls_Manager::RAW_HTML,
					'raw'             => __( '<b>WooCommerce</b> is not installed/activated on your site. Please install and activate <a href="plugin-install.php?s=woocommerce&tab=search&type=term" target="_blank">WooCommerce</a> first.', 'anant-addons-for-elementor' ),
					'content_classes' => 'ant-woo-warning',
					'conditions' => [
						'relation' => 'or',
						'terms'    => [
							[
								'name'     => 'marquee_type',
								'operator' => '===',
								'value'    => 'product',
							],  
						],
					],
					'classes' => 'anant-pro-popup-notice',
				]
			);
		}

		anant_switcher_control(
			$this,
			[
				'key'       => 'separator_icon_toggle',
				'label'     => 'Separator Icon On / Off',
				'on_label'  => 'Yes',
				'off_label' => 'No',
				'default' => 'yes'
			]
		);

		$this->add_control(
           'separator_icon',
			[
				'label' => __( 'Icon', 'anant-addons-for-elementor' ),
				'type' => \Elementor\Controls_Manager::ICONS,
				'default' => [
					'value' => 'fas fa-link',
					'library' => 'solid',
				],
				'condition' => [ 
					'separator_icon_toggle' => 'yes',
				],
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

		$repeater = new \Elementor\Repeater();

		$repeater->add_control(
			'marquee_stripe_item_title', [
				'label' => __( 'Title', 'anant-addons-for-elementor' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => __( 'Business' , 'anant-addons-for-elementor' ),
				'label_block' => true,
			]
		);  

		$this->add_control(
			'marquee_stripe_repeater',
			[
				'label' => __( 'Title', 'anant-addons-for-elementor' ),
				'type' => \Elementor\Controls_Manager::REPEATER,
				'fields' => $repeater->get_controls(),
				'default' => [
					[
						'marquee_stripe_item_title' => 'Accounting',
					],
					[
						'marquee_stripe_item_title' => 'Financial',
					],
					[
						'marquee_stripe_item_title' => 'Marketing',
					],
					[
						'marquee_stripe_item_title' => 'Taxes',
					],
					[
						'marquee_stripe_item_title' => 'Implementing',
					],
					[
						'marquee_stripe_item_title' => 'Marketing',
					],
				],
				'title_field' => '{{{ marquee_stripe_item_title }}}',
				'condition' => [ 
					'marquee_type' => 'repeater',
				],
			]
		);

		anant_select2_control(
			$this,
			[
				'key'         => 'post_category',
				'label'       => 'Categories',
				'placeholder' => 'Choose Category to Include',
				'options'     => [],
				'multiple'    => true,
                'condition' => [
                    'marquee_type' => 'post',
                    'post_taxonomy_select' => 'post_categories',
                ],
				'classes' => 'anant-pro-popup-notice',
			]
		);

		anant_select2_control(
			$this,
			[
				'key'         => 'post_tags',
				'label'       => 'Tags',
				'placeholder' => 'Choose Tag to Include',
				'options'     => [],
				'multiple'    => true,
                'condition' => [
                    'marquee_type' => 'post',
                    'post_taxonomy_select' => 'post_tags',
                ],
				'classes' => 'anant-pro-popup-notice',
			]
		);
				
		if ( class_exists( 'woocommerce' ) ) {

			anant_select2_control(
				$this,
				[
					'key'         => 'product_category',
					'label'       => 'Product Categories',
					'placeholder' => 'Choose Category to Include',
					'options'     => [],
					'multiple'    => true,
					'condition' => [
						'marquee_type' => 'product',
						'product_taxonomy_select' => 'product_categories',
					],
					'classes' => 'anant-pro-popup-notice',
				]
			);
	
			anant_select2_control(
				$this,
				[
					'key'         => 'product_tags',
					'label'       => 'Product Tags',
					'placeholder' => 'Choose Tag to Include',
					'options'     => [],
					'multiple'    => true,
					'condition' => [
						'marquee_type' => 'product',
						'product_taxonomy_select' => 'product_tags',
					],
					'classes' => 'anant-pro-popup-notice',
				]
			);

		}

		$this->end_controls_section();

		$this->start_controls_section(
			'settings',
			[
				'label' => __( 'Marquee Settings', 'anant-addons-for-elementor' ),
				'tab'   => Controls_Manager::TAB_CONTENT,
			]
		);

		$this->add_control(
			'directon_type',
			[
				'label'       => esc_html__( 'Slide Direction', 'anant-addons-for-elementor' ),
				'placeholder' => esc_html__( 'Choose Direction', 'anant-addons-for-elementor' ),
				'type'        => \Elementor\Controls_Manager::SELECT,
				'options'     => [ 
					'right' => 'Right', 
					'left' => 'Left',
				],
				'default' => 'left',
				'classes' => 'anant-pro-popup-notice',
			]
		);
		
		$this->add_control(
			'slide_speed',
			[
				'label'       => esc_html__( 'Slide Speed', 'anant-addons-for-elementor' ),
				'placeholder' => esc_html__( 'Choose Speed', 'anant-addons-for-elementor' ),
				'type'        => \Elementor\Controls_Manager::SELECT,
				'options'     => [ 
					'100' => '1s',
					'90' => '2s',
					'80' => '3s',
					'70' => '4s',
					'60' => '5s',
					'50' => '6s',
					'40' => '7s',
					'30' => '8s',
					'20' => '9s',
					'10' => '10s',
				],
				'default' => '80',
				'classes' => 'anant-pro-popup-notice',
			]
		);

		anant_switcher_control(
			$this,
			[
				'key'       => 'pause_hover',
				'label'     => 'Pause On Hover',
				'on_label'  => 'Yes',
				'off_label' => 'No',
				'default' => 'yes'
			]
		);

		$this->end_controls_section();
		
		// STYLE
		$this->start_controls_section(
			'marquee_stripe_wrapper_style',
			[
				'label' => __( 'Marquee Stripe Settings', 'anant-addons-for-elementor' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		); 

		$slug = 'marquee_stripe_wrapper';
		
		$this->add_responsive_control(
			$slug.'_rotation',
			[
				'label'           => __( 'Rotation', 'anant-addons-for-elementor' ),
				'type'            => Controls_Manager::SLIDER,
				'size_units'      => ['deg'],
				'range'           => [
					'deg' => [
						'min' => 0,
						'max' => 360,
					],
				],
				'default' => [
					'unit' => 'deg',
					'size' => '',
				],
				'devices'         => [ 'desktop', 'tablet', 'mobile' ],
				'desktop_default' => [
					'size' =>'' ,
				],
				'tablet_default'  => [
					'size' => '',
				],
				'mobile_default'  => [
					'size' => '',
				],
				'selectors'       => [
					'{{WRAPPER}} .anant-marquee-stripe ' => 'transform: rotate({{SIZE}}{{UNIT}}) !important;', 
				],
			],
		);

		$this->add_responsive_control(
			'separator_icon_spacing',
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
					'{{WRAPPER}} .anant-marquee-main .js-marquee' => 'gap: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_control(
			$slug.'_bg_color',
			[
				'label'     => __( 'Background Color', 'anant-addons-for-elementor' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}}  .anant-marquee-stripe .overlay' => 'background-color: {{VALUE}}',
				], 
			]
		);

		anant_border_control(
			$this,
			[
				'name'     => $slug.'_border_type',
				'label'    => 'Border Type',
				'selector' => '{{WRAPPER}} .anant-marquee-stripe .overlay',
			]
		);

		anant_border_radius_control(
			$this,
			[
				'key'       => $slug.'_border_radius',
				'label'     => 'Border Radius',
				'selectors' => [
					'{{WRAPPER}} .anant-marquee-stripe .overlay' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
					'{{WRAPPER}} .anant-marquee-stripe .overlay' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
					'{{WRAPPER}} .anant-marquee-stripe .overlay' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		anant_box_shadow_control(
			$this,
			[
				'key'      => $slug.'_box_shadow',
				'label'    => 'Box Shadow',
				'selector' => '{{WRAPPER}}  .anant-marquee-stripe .overlay',
			]
		);

		$this->end_controls_section();
		
		// Heading 
		$this->start_controls_section(
			'marquee_stripe_title_style',
			[
				'label' => __( 'Title Settings', 'anant-addons-for-elementor' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);

		$slug = 'marquee_stripe_title';
		
		$this->add_control(
			$slug.'_color',
			[
				'label'     => __( 'Color', 'anant-addons-for-elementor' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}}  .anant-marquee-item .title' => 'color: {{VALUE}}',
				],
			]
		);

		$this->add_control(
			$slug.'_bg_color',
			[
				'label'     => __( 'Background Color', 'anant-addons-for-elementor' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .anant-marquee-item .title' => 'background-color: {{VALUE}}',
				],
			]
		);

		anant_typography_control(
			$this,
			[
				'name'     => $slug.'_typography',
				'label'    => 'Typography',
				'selector' => '{{WRAPPER}}  .anant-marquee-item .title',
			]
		); 
		
		anant_border_control(
			$this,
			[
				'name'     => $slug.'_border_type',
				'label'    => 'Border Type',
				'selector' => '{{WRAPPER}} .anant-marquee-item .title',
			]
		);

		anant_border_radius_control(
			$this,
			[
				'key'       => $slug.'_border_radius',
				'label'     => 'Border Radius',
				'selectors' => [
					'{{WRAPPER}} .anant-marquee-item .title' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
					'{{WRAPPER}} .anant-marquee-item .title' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
					'{{WRAPPER}} .anant-marquee-item .title' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		); 

		anant_text_stroke_control(
			$this,
			[
				'key'      => $slug.'_text_stroke',
				'label'    => 'Text Stroke',
				'selector' => '{{WRAPPER}} .anant-marquee-item .title',
			]
		);

		$this->end_controls_section();
				
		// Separator Icon Style
		$this->start_controls_section(
			'marquee_stripe_separator_icon_style',
			[
				'label' => __( 'Separator Icon Settings', 'anant-addons-for-elementor' ),
				'tab'   => Controls_Manager::TAB_STYLE,
				'condition' => [
					'separator_icon_toggle'=> 'yes',
				]
			]
		);

		$slug = 'marquee_stripe_separator_icon';
		
		$this->add_control(
			$slug.'_color',
			[
				'label'     => __( 'Color', 'anant-addons-for-elementor' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}}  .anant-marquee-item i' => 'color: {{VALUE}}',
				],
			]
		);

		$this->add_responsive_control(
			$slug.'_size',
			[
				'label'           => __( 'Icon Size', 'anant-addons-for-elementor' ),
				'type'            => Controls_Manager::SLIDER,
				'size_units'      => [ 'px', '%' ],
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
					'{{WRAPPER}} .anant-marquee-item i' => 'font-size: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->end_controls_section();
	}

	protected function render() {
		$settings = $this->get_settings_for_display();

		$marquee_type = $settings['marquee_type']; 
		$marquee_stripe_repeater = $settings['marquee_stripe_repeater']; 

        $title_tag = $settings['title_html_tag'];
		$pause_hover = $settings['pause_hover']; ?>
		
		<div class="anant-marquee-stripe" style="transform: rotate(0deg);">
            <div class="overlay">
                <!-- marquee-slide -->
                <div class="anant-marquee-main" tickerHover = "<?php echo esc_attr($pause_hover) ?>">
                    <?php if($marquee_type === 'repeater') {
                        if ( $marquee_stripe_repeater ) { ?>
                            <?php foreach (  $marquee_stripe_repeater as $item ) {
                                $title = $item['marquee_stripe_item_title']; ?>
                                <!-- item -->
                                    <div class="anant-marquee-item" >
                                        <<?php echo esc_attr($title_tag) ?> class="title" data-title="<?php echo esc_attr($title); ?>"></<?php echo esc_attr($title_tag) ?>>
                                    </div>
                                <!-- /item -->

                                <!-- item -->
                                    <div class="anant-marquee-item" >
                                        <?php \Elementor\Icons_Manager::render_icon($settings['separator_icon'], ['aria-hidden' => 'true']); ?>
                                    </div>
                                <!-- /item -->
                            <?php } ?>
                        <?php
                        }
                    }else if($marquee_type === 'post') { 
					}else if($marquee_type === 'product') {
                    }  ?>
                </div>
                <!--/ marquee-slide -->
            </div>
        </div>
		<?php
	}
}