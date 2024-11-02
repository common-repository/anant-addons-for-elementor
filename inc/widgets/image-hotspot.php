<?php namespace AnantAddons;

use Elementor\Controls_Manager;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Background;
use Elementor\Group_Control_Image_Size;
use Elementor\Group_Control_Css_Filter;
use Elementor\Core\Schemes\Color;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Box_Shadow;
use Elementor\Repeater;
use Elementor\Core\Schemes\Typography;
use Elementor\Widget_Base;
use Elementor\Utils;
use Elementor\Icons;

class AnantImageHotspot extends \Elementor\Widget_Base {

	private $anant_hotspot_content = 'anant-hotspot-content';
	private $anant_hotspot_item = 'anant-hotspot-item';
	private $anant_hotspot_tooltip = 'anant-hotspot-tooltip';

	public function get_name() {
		return 'anant-image-hotspot';
	}

	public function get_title() {
		return __( 'Image Hotspot', 'anant-addons-for-elementor' );
	}

	public function get_categories() {
		return [ 'anant-elements' ];
	}

	public function get_icon() {
		return 'ant-icon eicon-hotspot';
	}

	public function get_style_depends() {
		return [
			'anant-styles-css',
		];
	}

	public function get_script_depends() {
		return [
			'',
		];
	}

	public function get_keywords() {
		return [
			'image hotspot',
			'product tag price', 
			'tags', 
			'toplips ',
			'hotspot',
			'anant addons',
			'',
		];
	}

	protected function register_controls() { 
		
		$this->start_controls_section(
			'section_content',
			[
				'label' => esc_html__( 'Content', 'anant-addons-for-elementor' ),
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

		$repeater = new Repeater();

		$repeater->start_controls_tabs( 'tabs_hotspot_item' );

		$repeater->start_controls_tab(
			'hotspot_item_content_tab',
			[
				'label' => esc_html__( 'Content', 'anant-addons-for-elementor' ),
			]
		);
		$slug = 'hotspot_item';

		$repeater->add_control(
			'hotspot_item_icon', 
			[
				'label' => __('Choose Icon', 'anant-addons-for-elementor') , 
				'type' => Controls_Manager::ICONS, 
				'default' => [
					'value' => 'fas fa-plus', 'library' => 'brands',
				], 
			]
		);

		$repeater->add_control(
			'hotspot_item_custom_color',
			[
				'label' => esc_html__( 'Custom Color', 'anant-addons-for-elementor' ) .' <i class="eicon-pro-icon"></i>' ,
				'type' => Controls_Manager::SWITCHER,
				'classes' => 'anant-pro-popup-notice',
			]
		);

		$repeater->add_control(
			'hotspot_item_tooltip',
			[
				'label' => esc_html__( 'Tooltip', 'anant-addons-for-elementor' ),
				'type' => Controls_Manager::SWITCHER,
				'default' => 'yes',
			]
		);

		$repeater->add_control(
			'tooltip_text',
			[
				'label' => '',
				'type' => Controls_Manager::TEXTAREA,
				'default' => 'Tooltip Content',
				'condition' => [
					$slug.'_tooltip' => 'yes',
				],
			]
		);

		$repeater->add_control(
			'hotspot_item_link', 
			[
				'label' => __(' Link', 'anant-addons-for-elementor') , 
				'type' => Controls_Manager::URL, 
				'placeholder' => __('Enter URL', 'anant-addons-for-elementor') , 
				'show_external' => true, 
				'default' => [
					'url' => '#', 'is_external' => true, 'nofollow' => true, 
				], 
			]
		);

		$repeater->end_controls_tab();

		$repeater->start_controls_tab(
			'hotspot_item_position_tab',
			[
				'label' => esc_html__( 'Position', 'anant-addons-for-elementor' ),
			]
		);

		$repeater->add_responsive_control(
			'hotspot_item_horizontal',
			[
				'type' => Controls_Manager::SLIDER,
				'label' => esc_html__( 'Horizontal Position (%)', 'anant-addons-for-elementor' ),
				'size_units' => [ '%', 'px' ,'em', 'rem' ],
				'range' => [
					'%' => [
						'min' => 0,
						'max' => 100,
					]
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
				'selectors' => [
					'{{WRAPPER}} {{CURRENT_ITEM}}.'.$this->anant_hotspot_item => 'left: {{SIZE}}{{UNIT}};',
				],
			]
		);
		
		$repeater->add_responsive_control(
			'hotspot_item_vertical',
			[
				'type' => Controls_Manager::SLIDER,
				'label' => esc_html__( 'Vertical Position (%)', 'anant-addons-for-elementor' ),
				'size_units' => [ '%', 'px' ,'em', 'rem' ],
				'range' => [
					'%' => [
						'min' => 0,
						'max' => 100,
					]
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
				'selectors' => [
					'{{WRAPPER}} {{CURRENT_ITEM}}.'.$this->anant_hotspot_item => 'top: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$repeater->end_controls_tab();

		$repeater->end_controls_tabs();

		$this->add_control(
			'hotspot_items',
			[
				'type' => Controls_Manager::REPEATER,
				'fields' => $repeater->get_controls(),
				'default' => [
					[
						'tooltip_text' => 'Tooltip Content',
						'hotspot_item_horizontal' => [
							'unit' => '%',
							'size' => 20,
						],
						'hotspot_item_vertical' => [
							'unit' => '%',
							'size' => 40,
						],
					],
					[
						'tooltip_text' => 'Tooltip Content',
						'hotspot_item_horizontal' => [
							'unit' => '%',
							'size' => 60,
						],
						'hotspot_item_vertical' => [
							'unit' => '%',
							'size' => 20,
						],
					],
				],
				'title_field' => '{{{ tooltip_text }}}',
			]
		);

		$this->add_control(
			'anant_image_hotspot_repeater_pro_notice',
			[
				'raw' => 'More than 3 are available in <a href="https://anantaddons.com/" target="_blank">Pro Version!</a>',
				'type' => \Elementor\Controls_Manager::RAW_HTML,
				'content_classes' => 'anant-pro-notice',
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_tooltips',
			[
				'label' => esc_html__( 'Tooltips Settings', 'anant-addons-for-elementor' ),
			]
		);

		$this->add_control(
			'show_tooltip',
			[
				'label'       => esc_html__( 'Show Tooltips', 'anant-addons-for-elementor' ),
				'type'        => Controls_Manager::SELECT,
				'default'     => 'by_default',
				'options'     => [
					'by_default' => esc_html__( 'Default', 'anant-addons-for-elementor' ),
					'by_click'   => esc_html__( 'Click', 'anant-addons-for-elementor' ),
					'by_hover'   => esc_html__( 'Hover', 'anant-addons-for-elementor' ),
				],
			]
		);
		
		$this->add_responsive_control(
            'tooltip_align',
            [
                'label' => esc_html__( 'Alignment', 'anant-addons-for-elementor' ),
                'type' => Controls_Manager::CHOOSE,
                'label_block' => false,
                'default' => 'center',
                'options' => [
                    'left' => [
                        'title' => esc_html__( 'Left', 'anant-addons-for-elementor' ),
                        'icon' => 'eicon-h-align-left',
                    ],
                    'center' => [
                        'title' => esc_html__( 'Center', 'anant-addons-for-elementor' ),
                        'icon' => 'eicon-h-align-center',
                    ],
                    'right' => [
                        'title' => esc_html__( 'Right', 'anant-addons-for-elementor' ),
                        'icon' => 'eicon-h-align-right',
                    ]
                ],
				'selectors' => [
					'{{WRAPPER}} .'.$this->anant_hotspot_tooltip => 'text-align: {{VALUE}}',
				],
            ]
        );

		$this->add_responsive_control(
			'tooltip_width',
			[
				'label' => esc_html__( 'Width', 'anant-addons-for-elementor' ),
				'type' => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'min' => 50,
						'max' => 500,
					],
				],
				'size_units' => [ 'px' ],
				'selectors' => [
					'{{WRAPPER}} .'.$this->anant_hotspot_tooltip => 'width: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_control(
			'tooltip_triangle',
			[
				'label' => esc_html__( 'Triangle', 'anant-addons-for-elementor' ),
				'type' => Controls_Manager::SWITCHER,				
				'default' => 'yes',
			]
		);

		$this->add_control(
			'tooltip_triangle_size',
			[
				'type' => Controls_Manager::SLIDER,
				'label' => esc_html__( 'Size', 'anant-addons-for-elementor' ),
				'size_units' => [ 'px' ],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 50,
					]
				],
				'selectors' => [
					'{{WRAPPER}} .'.$this->anant_hotspot_tooltip.'::before' => 'width: {{SIZE}}{{UNIT}}; height: {{SIZE}}{{UNIT}};',
					
				],
				'condition' => [
					'tooltip_triangle' => 'yes',
				],
			]
		);

		$this->add_control(
			'tooltip_spacing',
			[
				'type' => Controls_Manager::SLIDER,
				'label' => esc_html__( 'Spacing', 'anant-addons-for-elementor' ),
				'size_units' => [ 'px' ],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 100,
					]
				],
				'selectors' => [
					'{{WRAPPER}} .'.$this->anant_hotspot_tooltip => 'margin-bottom: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->end_controls_section();

		anant_pro_promotion_controls($this);

		$this->start_controls_section(
			'image_section_style',
			[
				'label' => esc_html__( 'Image', 'anant-addons-for-elementor' ),
				'tab' => Controls_Manager::TAB_STYLE,
				'show_label' => false,
			]
		);

		$slug = 'hotspot_image';

		$this->add_responsive_control(
            $slug.'_align',
            [
                'label' => esc_html__( 'Alignment', 'anant-addons-for-elementor' ),
                'type' => Controls_Manager::CHOOSE,
                'default' => 'left',
                'label_block' => false,
                'options' => [
					'start'    => [
						'title' => __( 'Left', 'anant-addons-for-elementor' ),
						'icon' => 'eicon-text-align-left',
					],
					'center' => [
						'title' => __( 'Center', 'anant-addons-for-elementor' ),
						'icon' => 'eicon-text-align-center',
					],
					'end' => [
						'title' => __( 'Right', 'anant-addons-for-elementor' ),
						'icon' => 'eicon-text-align-right',
					],
                ],
				'selectors' => [
					'{{WRAPPER}} .ant-hotspot-image' => 'justify-content: {{VALUE}}; display:flex;',
				],
            ]
        );

		$this->add_responsive_control(
			$slug.'_width',
			[
				'label' => esc_html__( 'Width', 'anant-addons-for-elementor' ),
				'type' => Controls_Manager::SLIDER,
				'default' => [
					'unit' => 'px',
				],
				'tablet_default' => [
					'unit' => 'px',
				],
				'mobile_default' => [
					'unit' => 'px',
				],
				'size_units' => [ 'px', '%','vw' ],
				'range' => [
					'%' => [
						'min' => 1,
						'max' => 100,
					],
					'px' => [
						'min' => 1,
						'max' => 1500,
					],
					'vw' => [
						'min' => 1,
						'max' => 100,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .ant-hotspot-image img' => 'width: {{SIZE}}{{UNIT}}!important;',
				],
			]
		);

		$this->add_responsive_control(
			$slug.'_max_width',
			[
				'label' => esc_html__( 'Max Width', 'anant-addons-for-elementor' ),
				'type' => Controls_Manager::SLIDER,
				'default' => [
					'unit' => '%',
				],
				'tablet_default' => [
					'unit' => '%',
				],
				'mobile_default' => [
					'unit' => '%',
				],
				'size_units' => [ 'px', '%','vw' ],
				'range' => [
					'%' => [
						'min' => 1,
						'max' => 100,
					],
					'px' => [
						'min' => 1,
						'max' => 1500,
					],
					'vw' => [
						'min' => 1,
						'max' => 100,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .ant-hotspot-image img' => 'max-width: {{SIZE}}{{UNIT}}!important;',
				],
			]
		);

		$this->add_responsive_control(
			$slug.'_height',
			[
				'label' => esc_html__( 'Height', 'anant-addons-for-elementor' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px', '%','vh' ],
				'range' => [
					'%' => [
						'min' => 1,
						'max' => 100,
					],
					'px' => [
						'min' => 1,
						'max' => 1500,
					],
					'vh' => [
						'min' => 1,
						'max' => 500,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .ant-hotspot-image img' => 'height: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->end_controls_section();

		// STYLE
		$this->start_controls_section(
			'section_style_hotspots',
			[
				'label' => esc_html__( 'Hotspots', 'anant-addons-for-elementor' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'icon_bg_color',
			[
				'label' => esc_html__( 'Background Color', 'anant-addons-for-elementor' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .'.$this->anant_hotspot_content.' a' => 'background-color: {{VALUE}}',
					'{{WRAPPER}}  .'.$this->anant_hotspot_content.'::before' => 'background-color: {{VALUE}}',
				],
			]
		);

		$this->add_control(
			'icon_color',
			[
				'label' => esc_html__( 'Color', 'anant-addons-for-elementor' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .'.$this->anant_hotspot_content.' a' => 'color: {{VALUE}}',
					'{{WRAPPER}} .'.$this->anant_hotspot_content.' a ' => 'fill: {{VALUE}}',
				],
			]
		);

		$this->add_responsive_control(
			'icon_size',
			[
				'label' => esc_html__( 'Size', 'anant-addons-for-elementor' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => ['px'],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 120,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .'.$this->anant_hotspot_content.' a' => 'font-size: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .'.$this->anant_hotspot_content.' a svg' => 'width: {{SIZE}}{{UNIT}};height: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'icon_width',
			[
				'label' => esc_html__( 'Box Size', 'anant-addons-for-elementor' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => ['px'],
				'range' => [
					'px' => [
						'min' => 10,
						'max' => 150,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .'.$this->anant_hotspot_content.' a' => 'width: {{SIZE}}{{UNIT}};height: {{SIZE}}{{UNIT}};',
				],
			]
		);

		anant_border_control(
			$this,
			[
				'name'     => 'icon_border_type',
				'label'    => 'Border Type',
				'selector' => '{{WRAPPER}}  .'.$this->anant_hotspot_content.' a',
			]
		);

		$this->add_responsive_control(
			'icon_border_radius',
			[
				'label' => esc_html__( 'Border Radius', 'anant-addons-for-elementor' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%' ],
				'selectors' => [
					'{{WRAPPER}}  .'.$this->anant_hotspot_content.' a' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					'{{WRAPPER}}  .'.$this->anant_hotspot_content.'::before' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'icon_box_shadow',
				'selector' => '{{WRAPPER}} .'.$this->anant_hotspot_content.' a',
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_style_tooltips',
			[
				'label' => esc_html__( 'Tooltips', 'anant-addons-for-elementor' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);
		
		$this->add_control(
			'tooltip_color',
			[
				'label' => esc_html__( 'Color', 'anant-addons-for-elementor' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .'.$this->anant_hotspot_tooltip.' p' => 'color: {{VALUE}}',
				],
			]
		);

		$this->add_control(
			'tooltip_bg_color',
			[
				'type' => Controls_Manager::COLOR,
				'label' => esc_html__( 'Background Color', 'anant-addons-for-elementor' ),
				'selectors' => [
					'{{WRAPPER}} .'.$this->anant_hotspot_tooltip => 'background-color: {{VALUE}}',
					'{{WRAPPER}} .'.$this->anant_hotspot_tooltip.'::before' => 'background-color: {{VALUE}}',
				],
			]
		);

		anant_typography_control(
			$this,
			[
				'name'     => 'tooltip_typography',
				'label'    => 'Typography',
				'selector' => '{{WRAPPER}}  .'.$this->anant_hotspot_tooltip,
			]
		);
		
		anant_border_radius_control(
			$this,
			[
				'key'       => 'tooltip_border_radius',
				'label'     => 'Border Radius',
				'selectors' => [
					'{{WRAPPER}} .'.$this->anant_hotspot_tooltip => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					'{{WRAPPER}} .'.$this->anant_hotspot_tooltip => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'tooltip_padding',
			[
				'label'     => esc_html__('Padding', 'anant-addons-for-elementor'),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .'.$this->anant_hotspot_tooltip => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		anant_box_shadow_control(
			$this,
			[
				'key'      => 'tooltip_box_shadow',
				'label'    => 'Box Shadow',
				'selector' => '{{WRAPPER}}  .'.$this->anant_hotspot_tooltip,
			]
		);

		$this->end_controls_section();
	}

	protected function render() {

		$settings = $this->get_settings_for_display();

		$hotspot_items = $settings['hotspot_items'];

		$show_tooltip = $settings['show_tooltip'];
		$image_url = $settings['card_image']['url'];

		?>

		<div class="ant-image-hotspots" tigger="<?php echo esc_attr($show_tooltip); ?>">
			<div class="ant-hotspot-image">
				<img src="<?php echo esc_url($image_url) ?>" class="img-cover" >
			</div>
			<div class="ant-hotspot-item-container">
				<?php
				if (isset($hotspot_items) && !empty($hotspot_items))
				{
					foreach ($hotspot_items as $key => $item)
					{
						if ($key === 3 ) { break; }
						$target = $item['hotspot_item_link']['is_external'] ? ' target=_blank' : '';
						$nofollow = $item['hotspot_item_link']['nofollow'] ? ' rel=nofollow' : ''; 
						?>
						<div class="ant-hotspot-item elementor-repeater-item-<?php echo esc_attr( $item['_id'] ) ?> <?php echo esc_attr($this->anant_hotspot_item) ?>">
							<div class="ant-hotspot-content <?php echo esc_attr($this->anant_hotspot_content) ?>">
								<a href="<?php echo esc_url($item['hotspot_item_link']['url']) ?>"<?php echo esc_attr($target) . esc_attr($nofollow); ?>>
									<?php \Elementor\Icons_Manager::render_icon($item['hotspot_item_icon'], ['aria-hidden' => 'true']); ?>
								</a>
							</div>
							<?php if ( 'yes' === $item['hotspot_item_tooltip'] && '' !== $item['tooltip_text'] ) : ?>
								<div class="ant-hotspot-tooltip <?php echo esc_attr($this->anant_hotspot_tooltip) ?>">
									<p><?php echo esc_html($item['tooltip_text']); ?></p>
								</div>						
							<?php endif; ?>	
						</div>
					<?php
					}
				}
				?>
			</div>
		</div>
	<?php
	}
}
