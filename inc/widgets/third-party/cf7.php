<?php // phpcs:disable Squiz.PHP.CommentedOutCode.Found
namespace AnantAddons;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Typography;
use Elementor\Core\Schemes;
use Elementor\Group_Control_Box_Shadow;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class AnantContactForm7 extends Widget_Base {

	public function get_name() {
		return 'anant-contact-form-7';
	}

	public function get_title() {
		return esc_html__( 'Contact Form 7', 'anant-addons-for-elementor' );
	}

	public function get_icon() {
		return 'ant-icon eicon-form-horizontal';
	}

	public function get_categories() {
		return [ 'anant-elements' ];
	}

	public function get_keywords() {
		return [ 'contact', 'form', 'email' , 'anant-addons-for-elementor'];
	}

	protected function register_controls() {
		$this->start_controls_section(
			'section_content_layout',
			[
				'label' => esc_html__( 'Layout', 'anant-addons-for-elementor' ),
			]
		);

		$anant_contact_forms = array();
		$cf7 = get_posts( 'post_type="wpcf7_contact_form"&numberposts=-1' );

		if ( $cf7 ) {
			foreach ( $cf7 as $anant_cf7 ) {
				$anant_contact_forms[ $anant_cf7->ID ] = $anant_cf7->post_title;
			}
		} else {
			$anant_contact_forms[ esc_html__( 'No contact forms found', 'anant-addons-for-elementor' ) ] = 0;
		}

		$this->add_control(
			'contact_form',
			[
				'label'     => esc_html__( 'Select Form', 'anant-addons-for-elementor' ),
				'type'      => Controls_Manager::SELECT,
				'options'   => $anant_contact_forms,
			]
		);

		$this->add_responsive_control(
			'space_between',
			[
				'label'   => __( 'Space Between', 'anant-addons-for-elementor' ),
				'type'    => Controls_Manager::SLIDER,
				'default' => [
					'size' => 0
				],
				'selectors' => [
					'{{WRAPPER}} .wpcf7-form > p:not(:last-child)' => 'margin-bottom: {{SIZE}}{{UNIT}};'
				]
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_style_label',
			[
				'label' => esc_html__( 'Label', 'anant-addons-for-elementor' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'label_color',
			[
				'label'     => esc_html__( 'Color', 'anant-addons-for-elementor' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .wpcf7-form label' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'label_typography',
				'label' => esc_html__( 'Typography', 'anant-addons-for-elementor' ),
				//'scheme' => Schemes\Typography::TYPOGRAPHY_4,
				'selector' => '{{WRAPPER}} .wpcf7-form label',
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_style_input',
			[
				'label' => esc_html__( 'Input', 'anant-addons-for-elementor' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'input_placeholder_color',
			[
				'label'     => esc_html__( 'Placeholder Color', 'anant-addons-for-elementor' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .wpcf7-form .wpcf7-form-control-wrap input::placeholder' => 'color: {{VALUE}};',
					'{{WRAPPER}} .wpcf7-form .wpcf7-form-control-wrap textarea::placeholder' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'input_text_color',
			[
				'label'     => esc_html__( 'Text Color', 'anant-addons-for-elementor' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .wpcf7-form .wpcf7-form-control-wrap input' => 'color: {{VALUE}};',
					'{{WRAPPER}} .wpcf7-form .wpcf7-form-control-wrap .wpcf7-textarea' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'others_type_input_text_color',
			[
				'label'     => esc_html__( 'Others Type Input Text Color', 'anant-addons-for-elementor' ),
				'type'      => Controls_Manager::COLOR,
				'default'      => '#666666',
				'selectors' => [
					'{{WRAPPER}} .wpcf7-form .wpcf7-form-control-wrap.select-state' => 'color: {{VALUE}};',
					'{{WRAPPER}} .wpcf7-form .wpcf7-form-control-wrap.select-gender' => 'color: {{VALUE}};',
					'{{WRAPPER}} .wpcf7-form .wpcf7-form-control-wrap.accept-this-1' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'input_text_background',
			[
				'label'     => esc_html__( 'Background Color', 'anant-addons-for-elementor' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .wpcf7-form .wpcf7-form-control-wrap input' => 'background-color: {{VALUE}};',
					'{{WRAPPER}} .wpcf7-form .wpcf7-form-control-wrap .wpcf7-textarea' => 'background-color: {{VALUE}};',
				],
			]
		);

		$this->add_responsive_control(
			'textarea_height',
			[
				'label' => esc_html__( 'Textarea Height', 'anant-addons-for-elementor' ),
				'type' => Controls_Manager::SLIDER,
				'default' => [
					'size' => 125,
				],
				'range' => [
					'px' => [
						'min' => 30,
						'max' => 500,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .wpcf7-form .wpcf7-textarea' => 'height: {{SIZE}}{{UNIT}}; display: block;',
				],
				'separator' => 'before',

			]
		);

		$this->add_control(
			'input_padding',
			[
				'label' => esc_html__( 'Padding', 'anant-addons-for-elementor' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors' => [
					'{{WRAPPER}} .wpcf7-form .wpcf7-form-control-wrap input, {{WRAPPER}} .wpcf7-form .wpcf7-form-control-wrap .wpcf7-textarea, {{WRAPPER}} .wpcf7-form .wpcf7-form-control-wrap .wpcf7-select' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'input_space',
			[
				'label' => esc_html__( 'Element Space', 'anant-addons-for-elementor' ),
				'type' => Controls_Manager::SLIDER,
				'default' => [
					'size' => 25,
				],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 50,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .wpcf7-form-control' => 'margin-top: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .wpcf7-form' => 'margin-top: -{{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_control(
			'input_border_show',
			[
				'label' => esc_html__( 'Border Style', 'anant-addons-for-elementor' ),
				'type' => Controls_Manager::SWITCHER,
				'default' => 'no',
				'label_on' => 'Hide',
				'label_off' => 'Show',
				'return_value' => 'yes',
				'separator' => 'before',
			]
		);

		$this->add_group_control(
			Group_Control_Border::get_type(), [
				'name'        => 'input_border',
				'label'       => esc_html__( 'Border', 'anant-addons-for-elementor' ),
				'placeholder' => '1px',
				'default'     => '1px',
				'selector'    => '{{WRAPPER}} .wpcf7-form .wpcf7-form-control-wrap input, {{WRAPPER}} .wpcf7-form .wpcf7-form-control-wrap textarea, {{WRAPPER}} .wpcf7-form .wpcf7-form-control-wrap .wpcf7-select',
				'condition' => [
					'input_border_show' => 'yes',
				],
			]
		);

		$this->add_control(
			'input_border_radius',
			[
				'label' => esc_html__( 'Border Radius', 'anant-addons-for-elementor' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%' ],
				'selectors' => [
					'{{WRAPPER}} .wpcf7-form .wpcf7-form-control-wrap input' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					'{{WRAPPER}} .wpcf7-form .wpcf7-form-control-wrap textarea' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					'{{WRAPPER}} .wpcf7-form .wpcf7-form-control-wrap .wpcf7-select' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'input_typography',
				'label' => esc_html__( 'Typography', 'anant-addons-for-elementor' ),
				'selector' => '{{WRAPPER}} .wpcf7-form .wpcf7-form-control-wrap input',
			]
		);

		$this->end_controls_section();


		$this->start_controls_section(
			'section_style_submit_button',
			[
				'label' => esc_html__( 'Submit Button', 'anant-addons-for-elementor' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

		$this->start_controls_tabs( 'tabs_button_style' );

		$this->start_controls_tab(
			'tab_button_normal',
			[
				'label' => esc_html__( 'Normal', 'anant-addons-for-elementor' ),
			]
		);

		$this->add_control(
			'button_text_color',
			[
				'label' => esc_html__( 'Text Color', 'anant-addons-for-elementor' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .wpcf7-form .wpcf7-submit' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'background_color',
			[
				'label' => esc_html__( 'Background Color', 'anant-addons-for-elementor' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .wpcf7-form .wpcf7-submit' => 'background-color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' => 'border',
				'label' => esc_html__( 'Border', 'anant-addons-for-elementor' ),
				'placeholder' => '1px',
				'default' => '1px',
				'selector' => '{{WRAPPER}} .wpcf7-form .wpcf7-submit',
				'separator' => 'before',
			]
		);

		$this->add_control(
			'border_radius',
			[
				'label' => esc_html__( 'Border Radius', 'anant-addons-for-elementor' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%' ],
				'selectors' => [
					'{{WRAPPER}} .wpcf7-form .wpcf7-submit' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'button_box_shadow',
				'selector' => '{{WRAPPER}} .wpcf7-submit',
			]
		);

		$this->add_control(
			'text_padding',
			[
				'label' => esc_html__( 'Padding', 'anant-addons-for-elementor' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors' => [
					'{{WRAPPER}} .wpcf7-form .wpcf7-submit' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
				'separator' => 'before',
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'button_typography',
				'label' => esc_html__( 'Typography', 'anant-addons-for-elementor' ),
				//'scheme' => Schemes\Typography::TYPOGRAPHY_4,
				'selector' => '{{WRAPPER}} .wpcf7-form .wpcf7-submit',
				'separator' => 'before',
			]
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
			'tab_button_hover',
			[
				'label' => esc_html__( 'Hover', 'anant-addons-for-elementor' ),
			]
		);

		$this->add_control(
			'hover_color',
			[
				'label' => esc_html__( 'Text Color', 'anant-addons-for-elementor' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .wpcf7-form .wpcf7-submit:hover' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'button_background_hover_color',
			[
				'label' => esc_html__( 'Background Color', 'anant-addons-for-elementor' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .wpcf7-form .wpcf7-submit:hover' => 'background-color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'button_hover_border_color',
			[
				'label' => esc_html__( 'Border Color', 'anant-addons-for-elementor' ),
				'type' => Controls_Manager::COLOR,
				'condition' => [
					'border_border!' => '',
				],
				'selectors' => [
					'{{WRAPPER}} .wpcf7-form .wpcf7-submit:hover' => 'border-color: {{VALUE}};',
				],
			]
		);

		$this->end_controls_tab();

		$this->end_controls_tabs();

		$this->end_controls_section();

		$this->start_controls_section(
			'section_style_additional_option',
			[
				'label' => esc_html__( 'Additional Option', 'anant-addons-for-elementor' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);
		
		$this->add_control(
			'fullwidth_input',
			[
				'label' => esc_html__( 'Fullwidth Input', 'anant-addons-for-elementor' ),
				'type' => Controls_Manager::SWITCHER,
				'label_on' => esc_html__( 'On', 'anant-addons-for-elementor' ),
				'label_off' => esc_html__( 'Off', 'anant-addons-for-elementor' ),
				'selectors' => [
					'{{WRAPPER}} .wpcf7-form .wpcf7-form-control-wrap input[type*="text"]'   => 'width: 100%;',
					'{{WRAPPER}} .wpcf7-form .wpcf7-form-control-wrap input[type*="email"]'  => 'width: 100%;',
					'{{WRAPPER}} .wpcf7-form .wpcf7-form-control-wrap input[type*="url"]'    => 'width: 100%;',
					'{{WRAPPER}} .wpcf7-form .wpcf7-form-control-wrap input[type*="number"]' => 'width: 100%;',
					'{{WRAPPER}} .wpcf7-form .wpcf7-form-control-wrap input[type*="tel"]'    => 'width: 100%;',
					'{{WRAPPER}} .wpcf7-form .wpcf7-form-control-wrap input[type*="date"]'   => 'width: 100%;',
					'{{WRAPPER}} .wpcf7-form .wpcf7-form-control-wrap .wpcf7-select'         => 'width: 100%;',
				],
			]
		);
		
		$this->add_control(
			'fullwidth_textarea',
			[
				'label' => esc_html__( 'Fullwidth Texarea', 'anant-addons-for-elementor' ),
				'type' => Controls_Manager::SWITCHER,
				'label_on' => esc_html__( 'On', 'anant-addons-for-elementor' ),
				'label_off' => esc_html__( 'Off', 'anant-addons-for-elementor' ),
				'selectors' => [
					'{{WRAPPER}} .wpcf7-form .wpcf7-form-control-wrap textarea' => 'width: 100%;',
				],
			]
		);
		
		$this->add_control(
			'fullwidth_button',
			[
				'label' => esc_html__( 'Fullwidth Button', 'anant-addons-for-elementor' ),
				'type' => Controls_Manager::SWITCHER,
				'label_on' => esc_html__( 'On', 'anant-addons-for-elementor' ),
				'label_off' => esc_html__( 'Off', 'anant-addons-for-elementor' ),
				'selectors' => [
					'{{WRAPPER}} .wpcf7-form .wpcf7-submit' => 'width: 100%;',
				],
			]
		);

        $this->add_control(
            'label_error_note',
            [
                'type' => \Elementor\Controls_Manager::RAW_HTML,
                'raw' => __('If <strong>full width</strong> settings doesn\'t worked, please update <strong>display</strong> settings', 'anant-addons-for-elementor'),
                'content_classes' => 'anant-alert-warning',
				'conditions' => [
					'relation' => 'or',
					'terms'    => [
						[
							'name'     => 'fullwidth_input',
							'operator' => '==',
							'value'    => 'yes',
						],
						[
							'name'     => 'fullwidth_textarea',
							'operator' => '==',
							'value'    => 'yes',
						],
						[
							'name'     => 'fullwidth_button',
							'operator' => '==',
							'value'    => 'yes',
						],
					],
				],
            ]
        );
        $this->add_control(
            'label_disply_type',
            [
                'label' => __('Display', 'anant-addons-for-elementor'),
                'type' => \Elementor\Controls_Manager::SELECT,
                'default' => '',
                'options' => [
                    '' => __('Default', 'anant-addons-for-elementor'),
                    'inherit' => __('Inherit', 'anant-addons-for-elementor'),
                    'initial' => __('Initial', 'anant-addons-for-elementor'),
                    'inline' => __('Inline', 'anant-addons-for-elementor'),
                    'inline-block' => __('Inline Block', 'anant-addons-for-elementor'),
                    'flex' => __('Flex', 'anant-addons-for-elementor'),
                    'inline-flex' => __('Inline Flex', 'anant-addons-for-elementor'),
                ],
                'selectors' => [
                    '{{WRAPPER}} .wpcf7-form label, {{WRAPPER}} .wpcf7-form .wpcf7-quiz-label' => 'display: {{UNIT}}',
                ],
				'conditions' => [
					'relation' => 'or',
					'terms'    => [
						[
							'name'     => 'fullwidth_input',
							'operator' => '==',
							'value'    => 'yes',
						],
						[
							'name'     => 'fullwidth_textarea',
							'operator' => '==',
							'value'    => 'yes',
						],
						[
							'name'     => 'fullwidth_button',
							'operator' => '==',
							'value'    => 'yes',
						],
					],
				],
            ]
        );

		$this->end_controls_section();

	}

	private function get_shortcode() {
		$settings = $this->get_settings_for_display();

		if (!$settings['contact_form']) {
			return '<div class="anant-alert anant-alert-warning">'.__('Please select a Contact Form From Setting!', 'anant-addons-for-elementor').'</div>';
		}

		$attributes = [
			'id'	=> $settings['contact_form'],
		];

		$this->add_render_attribute( 'shortcode', $attributes );

		$shortcode   = [];
		$shortcode[] = sprintf( '[contact-form-7 %s]', $this->get_render_attribute_string( 'shortcode' ) );

		return implode("", $shortcode);
	}

	public function render() {
		echo do_shortcode( $this->get_shortcode() );
	}

	public function render_plain_content() {
		echo $this->get_shortcode();
	}
}