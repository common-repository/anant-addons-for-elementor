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

class AnantTimeCounter extends \Elementor\Widget_Base {

	private $time_counter_box_class = 'anant-time-counter-box';
	private $time_counter_inner = 'anant-time-counter-inner'; 
	private $time_counter_heading = 'anant-time-counter-card-heading';
	private $time_counter_class = 'anant-time-counter-card-number';
	private $time_counter_description = 'anant-time-counter-card-description';

	public function get_name() {
		return 'anant-time-counter';
	}

	public function get_title() {
		return __( 'Time Counter ', 'anant-addons-for-elementor' );
	}

	public function get_categories() {
		return [ 'anant-woo-elements' ];
	}

	public function get_icon() {
		return 'ant-icon eicon-countdown';
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

	protected function register_controls() {

		$this->start_controls_section(
			'content_section',
			[
				'label' => __( 'Content', 'anant-addons-for-elementor' ),
				'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);

		$this->add_control(
			'counter_time',
			[
				'label' => esc_html__( 'Select Time', 'anant-addons-for-elementor' ),
				'type' => \Elementor\Controls_Manager::DATE_TIME,
			]
		);

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
			'separator_type',
			[
				'label'       => esc_html__( 'Separator Type', 'anant-addons-for-elementor' ),
				'type'        => \Elementor\Controls_Manager::SELECT,
				'default'     => 'text',
				'options'     => [
					'icon'  => esc_html__( 'Icon Separator', 'anant-addons-for-elementor' ),
					'text'      => esc_html__( 'Text Separator', 'anant-addons-for-elementor' ),
 
				],
			]
		);

		$this->add_control(
           'separator_icon',
			[
				'label' => __( 'Icon', 'anant-addons-for-elementor' ),
				'type' => \Elementor\Controls_Manager::ICONS,
				'default' => [
					'value' => 'fas fa-caret-right',
					'library' => 'solid',
				],
				'condition' => [ 
					'separator_type' => 'icon',
					'separator_icon_toggle' => 'yes',
				],
			]
        );

		$this->add_control(
			'separator_text', [
				'label' => __( 'Separator Text', 'anant-addons-for-elementor' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => __( ':' , 'anant-addons-for-elementor' ),
				'label_block' => true,
				'condition' => [ 
					'separator_type' => 'text',
					'separator_icon_toggle' => 'yes',
				],
			]
		);

		$this->add_control(
			'counter_before_text', [
				'label' => __( 'Before Counter Text', 'anant-addons-for-elementor' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => __( 'Sale End In' , 'anant-addons-for-elementor' ),
				'label_block' => true,
			]
		);

		$this->add_control(
			'counter_After_text', [
				'label' => __( 'After Counter Text', 'anant-addons-for-elementor' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'label_block' => true,
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

		anant_alignment_control(
			$this,
			[
				'key'       => 'time_counter_alignment',
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
					'{{WRAPPER}} .'.$this->time_counter_box_class => 'justify-content: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'counter_before_text_toggle',
			[
				'label' => __( 'Before Text On / Off', 'anant-addons-for-elementor' ),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'label_on' => __( 'Show', 'anant-addons-for-elementor' ),
				'label_off' => __( 'Hide', 'anant-addons-for-elementor' ),
				'return_value' => 'yes',
				'default' => 'yes',

			]
		);

		$this->add_control(
			'counter_after_text_toggle',
			[
				'label' => __( 'After Text On / Off', 'anant-addons-for-elementor' ),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'label_on' => __( 'Show', 'anant-addons-for-elementor' ),
				'label_off' => __( 'Hide', 'anant-addons-for-elementor' ),
				'return_value' => 'yes',
				'default' => 'yes',
			]
		);
		$this->end_controls_section();

		$this->start_controls_section(
			'time_counter_box_settings',
			[
				'label' => __( 'Time Counter box', 'anant-addons-for-elementor' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'time_counter_bg_color',
			[
				'label'     => __( 'Background Color', 'anant-addons-for-elementor' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .'.$this->time_counter_box_class => 'background-color: {{VALUE}}',
				],
			]
		);

		anant_border_control(
			$this,
			[
				'name'     => 'time_counter_box_border_type',
				'label'    => 'Border Type',
				'selector' => '{{WRAPPER}} .'.$this->time_counter_box_class,
			]
		);

		anant_border_radius_control(
			$this,
			[
				'key'       => 'time_counter_box_border_type',
				'label'     => 'Border Radius',
				'selectors' => [
					'{{WRAPPER}} .'.$this->time_counter_box_class => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'time_counter_box_counter_padding',
			[
				'label'     => esc_html__('Padding', 'anant-addons-for-elementor'),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .'.$this->time_counter_box_class => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'time_counter_box_counter_margin',
			[
				'label'     => esc_html__('Margin', 'anant-addons-for-elementor'),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .'.$this->time_counter_box_class => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		anant_box_shadow_control(
			$this,
			[
				'key'      => 'time_counterbox_box_shadow',
				'label'    => 'Box Shadow',
				'selector' => '{{WRAPPER}}  .'.$this->time_counter_box_class,
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'time_number_box_settings',
			[
				'label' => __( 'Number Box Settings', 'anant-addons-for-elementor' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'time_number_bg_color',
			[
				'label'     => __( 'Background Color', 'anant-addons-for-elementor' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .timer span span' => 'background-color: {{VALUE}}',
				],
			]
		);

		$this->add_control(
			'time_number_color',
			[
				'label'     => __( 'Color', 'anant-addons-for-elementor' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .timer span span' => 'color: {{VALUE}}',
				],
			]
		);

		$this->add_responsive_control(
			'time_number_width',
			[
				'label'           => __( 'Width', 'anant-addons-for-elementor' ),
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
					'{{WRAPPER}} .timer span span' => 'width: {{SIZE}}{{UNIT}};', 
				],
			],
		);

		$this->add_responsive_control(
			'time_number_height',
			[
				'label'           => __( 'Height', 'anant-addons-for-elementor' ),
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
					'{{WRAPPER}} .timer span span' => 'height: {{SIZE}}{{UNIT}};', 
				],
			]
		);

		$this->add_responsive_control(
			'time_number_size',
			[
				'label'           => __( 'Number Size', 'anant-addons-for-elementor' ),
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
					'{{WRAPPER}} .timer span span' => 'font-size: {{SIZE}}{{UNIT}};',
				],
			]
		);

		anant_border_control(
			$this,
			[
				'name'     => 'time_number_border_type',
				'label'    => 'Border Type',
				'selector' => '{{WRAPPER}} .timer span span',
			]
		);

		anant_border_radius_control(
			$this,
			[
				'key'       => 'time_number_border_radius',
				'label'     => 'Border Radius',
				'selectors' => [
					'{{WRAPPER}} .timer span span' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'time_number_margin',
			[
				'label'     => esc_html__('Margin', 'anant-addons-for-elementor'),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .timer span span' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};', 
				],
			]
		);

		anant_box_shadow_control(
			$this,
			[
				'key'      => 'time_number_box_shadow',
				'label'    => 'Box Shadow',
				'selector' => '{{WRAPPER}}  .timer span span',
			]
		);

		anant_text_shadow_control(
			$this,
			[
				'key'      => 'time_number_text_shadow',
				'label'    => 'Text Shadow',
				'selector' => '{{WRAPPER}} .timer span span',
			]
		);

		anant_text_stroke_control(
			$this,
			[
				'key'      => 'time_number_text_stroke',
				'label'    => 'Text Stroke',
				'selector' => '{{WRAPPER}} .timer span span',
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'time_counter_before_text_settings',
			[
				'label' => __( 'Before Text Settings', 'anant-addons-for-elementor' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'time_counter_before_text_color',
			[
				'label'     => __( 'Color', 'anant-addons-for-elementor' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .timer-before-text' => 'color: {{VALUE}}',
				],
			]
		);

		anant_typography_control(
			$this,
			[
				'name'     => 'time_counter_before_text_typography',
				'label'    => 'Typography',
				'selector' => '{{WRAPPER}} .timer-before-text',
			]
		);

		anant_text_shadow_control(
			$this,
			[
				'key'      => 'time_counter_before_text_shadow',
				'label'    => 'Text Shadow',
				'selector' => '{{WRAPPER}} .timer-before-text',
			]
		);

		anant_text_stroke_control(
			$this,
			[
				'key'      => 'time_counter_before_text_stroke',
				'label'    => 'Text Stroke',
				'selector' => '{{WRAPPER}} .timer-before-text',
			]
		);

		$this->add_responsive_control(
			'time_counter_before_text_margin',
			[
				'label'     => esc_html__('Margin', 'anant-addons-for-elementor'),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .timer-before-text' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'time_counter_after_text_settings',
			[
				'label' => __( 'After Text Settings', 'anant-addons-for-elementor' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'time_counter_after_text_color',
			[
				'label'     => __( 'Color', 'anant-addons-for-elementor' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .timer-after-text' => 'color: {{VALUE}}',
				],
			]
		);

		anant_typography_control(
			$this,
			[
				'name'     => 'time_counter_after_text_typography',
				'label'    => 'Typography',
				'selector' => '{{WRAPPER}} .timer-after-text',
			]
		);

		anant_text_shadow_control(
			$this,
			[
				'key'      => 'time_counter_after_text_shadow',
				'label'    => 'Text Shadow',
				'selector' => '{{WRAPPER}} .timer-after-text',
			]
		);

		anant_text_stroke_control(
			$this,
			[
				'key'      => 'time_counter_after_text_stroke',
				'label'    => 'Text Stroke',
				'selector' => '{{WRAPPER}} .timer-after-text',
			]
		);

		$this->add_responsive_control(
			'time_counter_after_text_margin',
			[
				'label'     => esc_html__('Margin', 'anant-addons-for-elementor'),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .timer-after-text' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'separator_settings',
			[
				'label' => __( 'Separator Settings', 'anant-addons-for-elementor' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'separator_color',
			[
				'label'     => __( 'Color', 'anant-addons-for-elementor' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .timer-counter-sep-icon, {{WRAPPER}} .timer-counter-sep-text' => 'color: {{VALUE}}',
				],
			]
		);

		$this->add_responsive_control(
			'separator_size',
			[
				'label'           => __( 'Separator Size', 'anant-addons-for-elementor' ),
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
					'{{WRAPPER}} .timer-counter-sep-icon, {{WRAPPER}} .timer-counter-sep-text' => 'font-size: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'separator_line_height',
			[
				'label'           => __( 'Separator Line Height', 'anant-addons-for-elementor' ),
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
					'{{WRAPPER}} .timer-counter-sep-icon, {{WRAPPER}} .timer-counter-sep-text' => 'line-height: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->end_controls_section();
	}

	protected function render() {
		$settings = $this->get_settings_for_display();

		$date_time 		= $settings['counter_time'];

		$before_text 		= $settings['counter_before_text'];
		$after_text 		= $settings['counter_After_text'];
		$show_before_text 	= $settings['counter_before_text_toggle'];
		$show_after_text 	= $settings['counter_after_text_toggle']; ?>

		<div class="offer-timer <?php echo esc_attr($this->time_counter_box_class); ?>">
			<?php if($show_before_text === 'yes'){
				echo ('<span class="timer-before-text">'.esc_html($before_text).'</span>');
			}
			if($settings['separator_icon_toggle'] === 'yes'){
				if($settings['separator_type'] === 'icon'){ ?>
					<div class="timer" data-date="<?php echo esc_attr($date_time); ?>">
						<span class="days"><span></span></span>
						<span class="timer-counter-sep-icon"><?php \Elementor\Icons_Manager::render_icon($settings['separator_icon'], ['aria-hidden' => 'true']); ?></span>
						<span class="hours"><span></span></span>
						<span class="timer-counter-sep-icon"><?php \Elementor\Icons_Manager::render_icon($settings['separator_icon'], ['aria-hidden' => 'true']); ?></span>
						<span class="minutes"><span></span></span>
						<span class="timer-counter-sep-icon"><?php \Elementor\Icons_Manager::render_icon($settings['separator_icon'], ['aria-hidden' => 'true']); ?></span>
						<span class="seconds"><span></span></span>
					</div>
				<?php } elseif($settings['separator_type'] === 'text'){ ?>
					<div class="timer" data-date="<?php echo esc_attr($date_time); ?>">
						<span class="days"><span></span></span>
						<span class="timer-counter-sep-text"><?php echo esc_attr($settings['separator_text']) ?></span>
						<span class="hours"><span></span></span>
						<span class="timer-counter-sep-text"><?php echo esc_attr($settings['separator_text']) ?></span>
						<span class="minutes"><span></span></span>
						<span class="timer-counter-sep-text"><?php echo esc_attr($settings['separator_text']) ?></span>
						<span class="seconds"><span></span></span>
					</div>
				<?php }

			}else{ ?>
				<div class="timer" data-date="<?php echo esc_attr($date_time); ?>">
					<span class="days"><span></span></span>
					<span class="hours"><span></span></span>
					<span class="minutes"><span></span></span>
					<span class="seconds"><span></span></span>
				</div>
			<?php }
			if($show_after_text === 'yes'){
				echo ('<span class="timer-after-text">'.esc_html($after_text).'</span>');
			} ?>
        </div> 
	<?php
	}
}