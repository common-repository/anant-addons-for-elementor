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
use Elementor\Group_Control_Background;

if ( ! defined( 'ABSPATH' ) ) { exit; } // Exit if accessed directly

class Anant_CreativeButton extends \Elementor\Widget_Base {

	private $button_card_class = 'anant-creative-button-card';
	private $button_inner = 'anant-creative-button-inner-card';
	private $button_class = 'anant-creative-button';

	public function get_name() {
		return 'anant-creative-button';
	}

	public function get_title() {
		return esc_html__('Creative Button', 'anant-addons-for-elementor' );
	}

	public function get_categories() {
		return [ 'anant-elements' ];
	}

	public function get_icon() {
		return 'ant-icon eicon-download-button';
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
			'creative buttons',
			'button', 
			'anant eddons',
			'anant',
			'animated buttons',
		];
	}

	protected function register_controls() {

		$this->start_controls_section(
			'content_section',
			[
				'label' => esc_html__( 'Content', 'anant-addons-for-elementor' ),
				'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);

		$this->add_control(
			'template_style',
			[
				'label'       => esc_html__( 'Button Styles', 'anant-addons-for-elementor' ),
				'placeholder' => esc_html__( 'Choose Template from Here', 'anant-addons-for-elementor' ),
				'type'        => \Elementor\Controls_Manager::SELECT,
				'default'     => 'one',
				'options'     => [
					'one'      => esc_html__( 'Winona', 'anant-addons-for-elementor' ),
					'two'      => esc_html__( 'Ujarak', 'anant-addons-for-elementor' ),
					'three'      => esc_html__( 'Diagonal Open', 'anant-addons-for-elementor' ),
					'four'      => esc_html__( 'Swipe (Pro)', 'anant-addons-for-elementor' ),
					'five'      => esc_html__( 'Wayra (Pro)', 'anant-addons-for-elementor' ),
					'six'      => esc_html__( 'Tamaya (Pro)', 'anant-addons-for-elementor' ),
					'seven'      => esc_html__( 'Shine (Pro)', 'anant-addons-for-elementor' ),
					'eight'      => esc_html__( 'Alternate (Pro)', 'anant-addons-for-elementor' ),
					'nine'      => esc_html__( 'Collision (Pro)', 'anant-addons-for-elementor' ),
					'ten'      => esc_html__( 'Rayen (Pro)', 'anant-addons-for-elementor' ),
				],
			]
		);
		
		$this->add_control(
			'anant_creative_buttons_pro_notice',
			[
				'raw' => 'Only Available in <a href="https://anantaddons.com/" target="_blank">Pro Version!</a>',
				'type' => \Elementor\Controls_Manager::RAW_HTML,
				'content_classes' => 'anant-pro-notice',
				'condition' => [
                    'template_style!' => ['one', 'two', 'three'],
                ],
			]
		);

		$this->add_control(
			'card_link_text', [
				'label' => esc_html__( 'Link Text', 'anant-addons-for-elementor' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => esc_html__( 'Read More' , 'anant-addons-for-elementor' ),
				'label_block' => true,
			]
		);

		$this->add_control(
			'card_link',
			[
				'label' => esc_html__( 'Link', 'anant-addons-for-elementor' ),
				'type' => \Elementor\Controls_Manager::URL,
				'placeholder' => esc_html__( 'https://your-link.com', 'anant-addons-for-elementor' ),
				'show_external' => true,
				'default' => [
					'url' => '',
					'is_external' => true,
					'nofollow' => true,
				],
			]
		);
		
		$this->add_control(
			'link_button_icon',
			[
				'label' => esc_html__( 'Icon', 'anant-addons-for-elementor' ),
				'type' => \Elementor\Controls_Manager::ICONS,
				'default' => [
					'value' => 'fas fa-angle-double-right',
					'library' => 'solid',
				],
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
			'link_button_space',
			[
				'label'           => esc_html__( 'Icon Spacing', 'anant-addons-for-elementor' ),
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
					'{{WRAPPER}}  .'.$this->button_card_class.' span' => 'gap: {{SIZE}}{{UNIT}};',
				]
			]
		);

		$this->add_responsive_control(
			'creative_btn_alignment',
			[
				'label'     => esc_html__( 'Alignment', 'anant-addons-for-elementor' ),
				'type'      => Controls_Manager::CHOOSE,
				'options'   => [
					'start' => [
						'title' => esc_html__( 'Left', 'anant-addons-for-elementor' ),
						'icon'  => 'eicon-text-align-left',
					],
					'center' => [
						'title' => esc_html__( 'Center', 'anant-addons-for-elementor' ),
						'icon'  => 'eicon-text-align-center',
					],
					'end' => [
						'title' => esc_html__( 'Right', 'anant-addons-for-elementor' ),
						'icon'  => 'eicon-text-align-right',
					],
				],
				'toggle'    => true,
				'selectors' => [
					'{{WRAPPER}} .'.$this->button_card_class => 'text-align: {{VALUE}};',
				],
			]
		);

		$this->end_controls_section();

		anant_pro_promotion_controls($this);

		// style
		$this->start_controls_section(
			'creative_btn_settings',
			[
				'label' => esc_html__('Button Settings', 'anant-addons-for-elementor' ),
				'tab'   => Controls_Manager::TAB_STYLE, 
			]
		);
		
		$slug = 'creative_btn';
		$this->start_controls_tabs( $slug.'_tabs' );

		$this->start_controls_tab(
			$slug.'_normal_style',
			[
				'label' => esc_html__( 'Normal', 'anant-addons-for-elementor' ),
			]
		);
		
		$this->add_control(
			$slug.'_color',
			[
				'label'     => esc_html__( 'Color', 'anant-addons-for-elementor' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}}  .'.$this->button_class.'' => 'color: {{VALUE}}; fill: {{VALUE}}',
					'{{WRAPPER}}  .'.$this->button_class.' i' => 'color: {{VALUE}}',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name'      => $slug.'_bg_color',
				'types'          => [ 'classic', 'gradient' ],
				'exclude'        => [ 'image' ],
				'fields_options' => [
					'background' => [
						'label' => esc_html__( 'Background', 'anant-addons-for-elementor' ),
						'default' => 'classic',
					],
				],
				'selector'  => '{{WRAPPER}} .'.$this->button_class.'',
			]
		);
		
		$this->add_group_control(
			\Elementor\Group_Control_Border::get_type(),
			[
				'name'     => $slug.'_border_type',
				'label'    => esc_html__('Border Type', 'anant-addons-for-elementor'),
				'selector' => '{{WRAPPER}} .'.$this->button_class.'',
				'conditions' => [
					'relation' => 'and',
					'terms'    => [
						[
							'name'     => 'template_style',
							'operator' => '!==',
							'value'    => 'layout_3',
						],
					]	
				], 
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Border::get_type(),
			[
				'name'     => $slug.'_border_two_type',
				'label'    => esc_html__('Border Type', 'anant-addons-for-elementor'),
				'selector' => '{{WRAPPER}} .'.$this->button_class.':before',
				'conditions' => [
					'relation' => 'and',
					'terms'    => [
						[
							'name'     => 'template_style',
							'operator' => '===',
							'value'    => 'layout_3',
						], 
					]	
				], 
			]
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
			$slug.'_style_hover',
			[
				'label' => esc_html__( 'Hover', 'anant-addons-for-elementor' ),

			]
		);

		$this->add_control(
			$slug.'_color_hover',
			[
				'label'     => esc_html__( 'Color', 'anant-addons-for-elementor' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .'.$this->button_class.':hover' => 'color: {{VALUE}}; fill: {{VALUE}};',
					'{{WRAPPER}} .'.$this->button_class.':hover i' => 'color: {{VALUE}}',
					'{{WRAPPER}} .more.one::after' => 'color: {{VALUE}}',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name'      => $slug.'_bg_color_hover',
				'types'          => [ 'classic', 'gradient' ],
				'exclude'        => [ 'image' ],
				'fields_options' => [
					'background' => [
						'label' => esc_html__( 'Background', 'anant-addons-for-elementor' ),
						'default' => 'classic',
					],
				],
				'selector'  => '{{WRAPPER}} .'.$this->button_class.':hover:not(.two), {{WRAPPER}} .more.two::before',
				'condition' => [
					'template_style!' => ['three'],
				],
			]
		);

		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name'      => $slug.'_bg_before_color_hover',
				'types'          => [ 'classic', 'gradient' ],
				'exclude'        => [ 'image' ],
				'fields_options' => [
					'background' => [
						'label' => esc_html__( 'Background', 'anant-addons-for-elementor' ),
						'default' => 'classic',
					],
				],
				'selector'  => '{{WRAPPER}} .'.$this->button_class.' span::before, 
								{{WRAPPER}} .'.$this->button_class.' span::after, 
								{{WRAPPER}} .'.$this->button_class.'::before, 
								{{WRAPPER}} .'.$this->button_class.'::after ',
				'condition' => [
					'template_style' => ['three'],
				],
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Border::get_type(),
			[
				'name'     => $slug.'_border_type_hover',
				'label'    => esc_html__('Border two', 'anant-addons-for-elementor'),
				'selector' => '{{WRAPPER}} .'.$this->button_class.':hover',
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
				'selector' => '{{WRAPPER}}  .'.$this->button_class.'',
			]
		);
		
		$this->add_responsive_control(
			'creative_icon_size',
			[
				'label'           => esc_html__('Icon Size', 'anant-addons-for-elementor'),
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
					'{{WRAPPER}} .'.$this->button_class.' i' => 'font-size: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .'.$this->button_class.' svg' => 'width: {{SIZE}}{{UNIT}}; height: {{SIZE}}{{UNIT}};'
				],
			]
		);

		anant_border_radius_control(
			$this,
			[
				'key'       => $slug.'_border_radius',
				'selectors' => [
					'{{WRAPPER}} .'.$this->button_class.'' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					'{{WRAPPER}} .more.two:hover::before' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
					'{{WRAPPER}} .'.$this->button_class.'' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
					'{{WRAPPER}} .'.$this->button_class.'' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		anant_box_shadow_control(
			$this,
			[
				'key'      => $slug.'_box_shadow',
				'selector' => '{{WRAPPER}}  .'.$this->button_class.'',
			]
		);

		$this->end_controls_section();
	}

	protected function render() {
		$settings = $this->get_settings_for_display();
 
		$link_text = $settings['card_link_text']; 
		$link_button_icon = $settings['link_button_icon'];
		$link_button_position = $settings['link_button_position'];
		$link = $settings['card_link']['url'];
		$target = $settings['card_link']['is_external'] ? ' target=_blank' : '';
		$nofollow = $settings['card_link']['nofollow'] ? ' rel=nofollow' : '';

		$template_style = $settings['template_style'];
		if (in_array($template_style, ['one', 'four', 'five', 'six', 'seven', 'eight', 'nine', 'ten'])) {
			$template_style = 'one';
		} ?>

		<div class="ant-creative-button <?php echo esc_attr($this->button_card_class);?>">
			<a class="more <?php echo esc_attr($template_style);?> <?php echo esc_attr($this->button_class);?> <?php echo $link_button_position === 'before' ? 'anant-no-flex': '' ?>"
				href="<?php echo esc_url($link) ?>"
				<?php echo esc_attr($target); ?>
				<?php echo esc_attr($nofollow); ?>
				<?php if($template_style == 'one') { ?> data-text="<?php echo esc_attr($link_text); ?>" <?php } ?>>
				<span>
				<?php 
					if ($link_button_position === 'before') {
						\Elementor\Icons_Manager::render_icon( $link_button_icon, [ 'aria-hidden' => 'true' ] );
					}
				?>
					<?php echo esc_html($link_text) ?>
				<?php 
					if ($link_button_position === 'after') {
						\Elementor\Icons_Manager::render_icon( $link_button_icon, [ 'aria-hidden' => 'true' ] );
					}
				?>
				</span>
			</a>
		</div>
		<?php		
	}
}