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

class AnantProgressBar extends \Elementor\Widget_Base {

	private $progress_main_class = 'anant-progress-items';
	private $progress_class = 'anant-progress';
	private $progress_bar_class = 'anant-progress-bar';
	private $progress_title_class = 'anant-progress-title';
	private $progress_counter_class = 'anant-progress-percentage';

	public function get_name() {
		return 'anant-progress-bar';
	}

	public function get_title() {
		return __( 'Progress Bar', 'anant-addons-for-elementor' );
	}

	public function get_categories() {
		return [ 'anant-elements' ];
	}

	public function get_icon() {
		return 'ant-icon eicon-skill-bar';
	}

	public function get_style_depends() {
		return [
            '',
		];
	}

	public function get_script_depends() {
		return [
			'',
		];
	}

	public function get_keywords() {
		return [
			'progress bar',
			'bar', 
			'skills',
			'',
			' progress',
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
					'layout_2'      => esc_html__( 'Layout 2', 'anant-addons-for-elementor' ),
					'layout_3'      => esc_html__( 'Layout 3 (Pro)', 'anant-addons-for-elementor' ),
					'layout_4'      => esc_html__( 'Layout 4 (Pro)', 'anant-addons-for-elementor' ),
					'layout_5'      => esc_html__( 'Layout 5 (Pro)', 'anant-addons-for-elementor' ),
				],
			]
		);

		$this->add_control(
			'anant_progress_bar_pro_notice',
			[
				'raw' => 'Only Available in <a href="https://anantaddons.com/" target="_blank">Pro Version!</a>',
				'type' => \Elementor\Controls_Manager::RAW_HTML,
				'content_classes' => 'anant-pro-notice',
				'condition' => [
                    'template_style!' => ['layout_1', 'layout_2'],
                ],
			]
		);

		$this->add_control(
			'progress_title', [
				'label' => __( 'Title', 'anant-addons-for-elementor' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => 'Title',
			]
		);
		
		$this->add_control(
			'progress_percentage',
			[
				'label' => esc_html__( 'Counter Value', 'anant-addons-for-elementor' ),
				'type' => \Elementor\Controls_Manager::SLIDER,
				'range' => [
						'min' => 0,
						'max' => 100,
				],
				'default' => [
					'size' => 70,
				],
			]
		);
		
		$this->add_control(
			'progress_suffix', [
				'label' => __( 'Counter Suffix', 'anant-addons-for-elementor' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => '%',
			]
		);

		$this->add_control(
			'show_percentage',
			[
				'label' => __( 'Show Counter', 'anant-addons-for-elementor' ),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'label_on' => __( 'Show', 'anant-addons-for-elementor' ),
				'label_off' => __( 'Hide', 'anant-addons-for-elementor' ),
				'return_value' => 'yes',
				'default' => 'yes',
			]
		);

		$this->add_control(
			'progress_animation_duration',
			[
				'label' => __( 'Animation Duration', 'anant-addons-for-elementor' ) .' <i class="eicon-pro-icon"></i>',
				'type' => \Elementor\Controls_Manager::NUMBER,
				'min' => 0,
				'max' => 0,
				'step' => .1,
				'classes' => 'anant-pro-popup-notice',
			]
		);	

		$this->add_control(
			'progress_animation_delay',
			[
				'label' => __( 'Animation Delay', 'anant-addons-for-elementor' ) .' <i class="eicon-pro-icon"></i>',
				'type' => \Elementor\Controls_Manager::NUMBER,
				'min' => 0,
				'max' => 0,
				'step' => .1,
				'classes' => 'anant-pro-popup-notice',
			]
		);

		$this->end_controls_section();

		anant_pro_promotion_controls($this);

		$this->start_controls_section(
			'progress_background',
			[
				'label' => __( 'Wrapper', 'anant-addons-for-elementor' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);

		$slug = 'progress';

		$this->add_responsive_control(
			$slug.'_width',
			[
				'label'           => __( 'Width', 'anant-addons-for-elementor' ),
				'type'            => Controls_Manager::SLIDER,
				'size_units'      => [ 'px', '%' ],
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
					'{{WRAPPER}} .'.$this->progress_class => 'width: {{SIZE}}{{UNIT}};',
				],
			],
		);

		$this->add_responsive_control(
			$slug.'_height',
			[
				'label'           => __( 'Height', 'anant-addons-for-elementor' ),
				'type'            => Controls_Manager::SLIDER,
				'size_units'      => [ 'px' ],
				'range'           => [
					'px' => [
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
					'{{WRAPPER}} .'.$this->progress_class => 'height: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_control(
			$slug.'_bg_color',
			[
				'label'     => __( 'Background Color', 'anant-addons-for-elementor' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .'.$this->progress_class => 'background-color: {{VALUE}}', 
				],
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'progress_bar',
			[
				'label' => __( 'Progress Line', 'anant-addons-for-elementor' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);

		$slug = 'progress_bar';

		$this->add_responsive_control(
			$slug.'_height',
			[
				'label'           => __( 'Height', 'anant-addons-for-elementor' ),
				'type'            => Controls_Manager::SLIDER,
				'size_units'      => [ 'px' ],
				'range'           => [
					'px' => [
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
					'{{WRAPPER}} .'.$this->progress_bar_class => 'height: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_control(
			$slug.'_color',
			[
				'label'     => __( 'Color', 'anant-addons-for-elementor' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .'.$this->progress_bar_class => 'background-color: {{VALUE}}',
					'{{WRAPPER}} .'.$this->progress_bar_class.'::after' => 'border-color: {{VALUE}}',
				],
			]
		);

		$this->add_control(
			$slug.'_after',
			[
				'label' => esc_html__( 'After', 'anant-addons-for-elementor' ),
				'type' => \Elementor\Controls_Manager::HEADING,
				'separator' => 'before',
				'condition' => [
					'template_style' => ['layout_1']
				],
			]
		);

		$this->add_control(
			$slug.'_after_size',
			[
				'label' => esc_html__( 'Size', 'anant-addons-for-elementor' ),
				'type' => \Elementor\Controls_Manager::SLIDER,
				'size_units' => [ 'px' ],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'default' => [
					'unit' => 'px',
					'size' => 6,
				],
				'selectors' => [
					'{{WRAPPER}} .'.$this->progress_bar_class.'::after' => 'padding: {{SIZE}}{{UNIT}};',
				],
				'condition' => [
					'template_style' => ['layout_1']
				],
			]
		);
		
		$this->add_control(
			$slug.'_after_color',
			[
				'label'     => __( 'Color', 'anant-addons-for-elementor' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .'.$this->progress_bar_class.'::after' => 'background-color: {{VALUE}}', 
				],
				'condition' => [
					'template_style' => ['layout_1']
				],
			]
		);

		anant_box_shadow_control(
			$this,
			[
				'key'      => $slug.'_box_shadow',
				'label'    => 'Box Shadow',
				'selector' => '{{WRAPPER}}  .'.$this->progress_bar_class.'::after',
				'condition' => [
					'template_style' => ['layout_1']
				],
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'progress_bar_title',
			[
				'label' => __( 'Title', 'anant-addons-for-elementor' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);

		$this->start_controls_tabs( 'progress_bar_title_tabs' );

		$slug = 'progress_bar_title';

		$this->add_control(
			$slug.'_color',
			[
				'label'     => __( 'Color', 'anant-addons-for-elementor' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}}  .'.$this->progress_title_class => 'color: {{VALUE}}',
				],
			]
		);

		anant_typography_control(
			$this,
			[
				'name'     => $slug.'_typography',
				'label'    => 'Typography',
				'selector' => '{{WRAPPER}}  .'.$this->progress_title_class,
			]
		);

		$this->add_responsive_control(
			$slug.'_margin',
			[
				'label'     => esc_html__('Margin', 'anant-addons-for-elementor'),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .'.$this->progress_title_class => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'progress_bar_counter',
			[
				'label' => __( 'Counter', 'anant-addons-for-elementor' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);

		$slug = 'progress_bar_counter';

		$this->add_control(
			$slug.'_background_color',
			[
				'label'     => __( 'Background Color', 'anant-addons-for-elementor' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}}  .'.$this->progress_counter_class => 'background-color: {{VALUE}}',
					'{{WRAPPER}}  .'.$this->progress_counter_class.'::after' => 'background-color: {{VALUE}}',
				],
				'condition' => [
					'template_style' => ['layout_2']
				],
			]
		);

		$this->add_control(
			$slug.'_color',
			[
				'label'     => __( 'Color', 'anant-addons-for-elementor' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}}  .'.$this->progress_counter_class => 'color: {{VALUE}}',
				],
			]
		);

		anant_typography_control(
			$this,
			[
				'name'     => $slug.'_typography',
				'label'    => 'Typography',
				'selector' => '{{WRAPPER}}  .'.$this->progress_counter_class,
			]
		);

		$this->add_responsive_control(
			$slug.'_padding',
			[
				'label'     => esc_html__('Padding', 'anant-addons-for-elementor'),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .'.$this->progress_counter_class => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
				'condition' => [
					'template_style' => ['layout_2']
				],
			]
		);

		$this->add_control(
			'progress_bar_counter_cart',
			[
				'label' => esc_html__( 'Cart', 'anant-addons-for-elementor' ),
				'type' => \Elementor\Controls_Manager::HEADING,
				'separator' => 'before',
				'condition' => [
					'template_style' => ['layout_2']
				],
			]
		);

		$this->add_control(
			'progress_bar_counter_cart_size',
			[
				'label' => esc_html__( 'Size', 'anant-addons-for-elementor' ),
				'type' => \Elementor\Controls_Manager::SLIDER,
				'size_units' => [ 'px' ],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'default' => [
					'unit' => 'px',
					'size' => 6,
				],
				'selectors' => [
					'{{WRAPPER}} .'.$this->progress_counter_class.'::after' => 'padding: {{SIZE}}{{UNIT}};',
				],
				'condition' => [
					'template_style' => ['layout_2']
				],
			]
		);

		$this->add_control(
			'progress_bar_counter_spacing',
			[
				'label' => esc_html__( 'Spacing', 'anant-addons-for-elementor' ),
				'type' => \Elementor\Controls_Manager::SLIDER,
				'size_units' => [ 'px' ],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .'.$this->progress_counter_class => 'top: -{{SIZE}}{{UNIT}};',
				],
			]
		);
	$this->end_controls_section();
	}

	protected function render() {

		$settings = $this->get_settings_for_display();

		$title = $settings['progress_title'];
		$counter = $settings['progress_percentage']['size'];
		$counter_suffix = $settings['progress_suffix'];

		$show_percentage = $settings['show_percentage'];
		$animation_duration = $settings['progress_animation_duration'];
		$animation_delay = $settings['progress_animation_delay'];

		$template_style = $settings['template_style'];

		$template_path = ANANT_PATH . 'inc/templates/progress-bar/';

		switch ($template_style) {
			case 'layout_1':
				require $template_path. 'layout-1.php';
				break;
			case 'layout_2':
				require $template_path. 'layout-2.php';
				break;
		}
	}
}