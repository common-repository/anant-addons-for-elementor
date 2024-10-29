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

class AnantImageComparison extends \Elementor\Widget_Base {

	private $image_compare_class = 'anant-image-comparison';

	public function get_name() {
		return 'anant-image-comparison';
	}

	public function get_title() {
		return __( 'Image Comparison', 'anant-addons-for-elementor' );
	}

	public function get_categories() {
		return [ 'anant-elements' ];
	}

	public function get_icon() {
		return 'ant-icon eicon-image-before-after';
	}

	public function get_style_depends() {
		return [
            'anant-image-compare-css',
		];
	}

	public function get_script_depends() {
		return [
			'anant-image-compare-js',
		];
	}

	public function get_keywords() {
		return [
			'image comparison',
			'before after', 
			'comparare', 
			'',
			'anant addons'
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
				'label'       => esc_html__( 'Direction', 'anant-addons-for-elementor' ),
				'type'        => \Elementor\Controls_Manager::SELECT,
				'default'     => 'layout_1',
				'options'     => [
					'layout_1'      => esc_html__( 'Horizontal', 'anant-addons-for-elementor' ),
					'layout_2'      => esc_html__( 'Vartical (Pro)', 'anant-addons-for-elementor' ),
				],
			]
		);

		$this->add_control(
			'anant_image_compare_pro_notice',
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
			'compare_image_one',
			[
				'label'   => __( 'After Image', 'anant-addons-for-elementor' ),
				'type'    => Controls_Manager::MEDIA,
				'default' => [
					'url' => anant_placeholder_image_src(),
				],
			]
		); 

        $this->add_control(
			'compare_image_two',
			[
				'label'   => __( 'Before Image', 'anant-addons-for-elementor' ),
				'type'    => Controls_Manager::MEDIA,
				'default' => [
					'url' => anant_placeholder_image_src(),
				],
			]
		);

        $this->add_control(
			'tigger_style',
			[
				'label'       => esc_html__( 'Tigger Type', 'anant-addons-for-elementor' ),
				'type'        => \Elementor\Controls_Manager::SELECT,
				'default'     => 'click',
				'options'     => [
					'click'      => esc_html__( 'Click & Drag', 'anant-addons-for-elementor' ),
					'hover' => esc_html__( 'Mouse Hover', 'anant-addons-for-elementor' ),
				],
			]
		);

		$this->add_control(
			'anant_tigger_style_pro_notice',
			[
				'raw' => 'Only Available in <a href="https://anantaddons.com/" target="_blank">Pro Version!</a>',
				'type' => \Elementor\Controls_Manager::RAW_HTML,
				'content_classes' => 'anant-pro-notice',
				'condition' => [
                    'tigger_style!' => ['click'],
                ],
			]
		);

		$this->add_control(
			'icon_type',
			[
				'label' => esc_html__( 'Select Icon', 'anant-addons-for-elementor' ),
				'type' => Controls_Manager::SELECT,
				'default' => '\f105',
				'options' => [
					'\f105' => esc_html__( 'Angle'),
					'\f0da' => esc_html__( 'Caret'),
					'\f061' => esc_html__( 'Arrow'),
					'\f30b' => esc_html__( 'Long Arrow'),
					'\f054' => esc_html__( 'Chevron' ),
					'\f101' => esc_html__( 'Angle Double' ),
				],
				'selectors' => [
					"{{WRAPPER}} .image-comparison .jx-arrow.jx-left::before" => "content: '{{VALUE}}';",
					"{{WRAPPER}} .image-comparison .jx-arrow.jx-right::before" => "content: '{{VALUE}}';",
				],
			]
		);

		$this->end_controls_section();

		anant_pro_promotion_controls($this);

		// styles
		
		$this->start_controls_section(
			'compare_image_style',
			[
				'label' => __( 'Divider Settings', 'anant-addons-for-elementor' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);

		$slug = 'image_compare';

		$this->add_responsive_control(
			$slug.'_line_width',
			[
				'label'           => __( 'Line Width', 'anant-addons-for-elementor' ),
				'type'            => Controls_Manager::SLIDER,
				'size_units'      => [ 'px', '%' ],
				'range'           => [
					'px' => [
						'min' => 0,
						'max' => 50,
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
					'{{WRAPPER}} .'.$this->image_compare_class.' .jx-control' => 'width: {{SIZE}}{{UNIT}};',
				],
			],
		);

		$this->add_control(
			$slug.'_line_color',
			[
				'label'     => __( 'Line Color', 'anant-addons-for-elementor' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .'.$this->image_compare_class.' .jx-slider' => 'color: {{VALUE}}', 
				],
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'compare_image_icon_style',
			[
				'label' => __( 'Icon Settings', 'anant-addons-for-elementor' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);

		$slug = 'image_compare';

		$this->add_control(
			$slug.'_icon_bg_color',
			[
				'label'     => __( 'Background Color', 'anant-addons-for-elementor' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .'.$this->image_compare_class.' .jx-arrow' => 'background-color: {{VALUE}}', 
				],
			]
		);

		$this->add_control(
			$slug.'_icon_color',
			[
				'label'     => __( 'Color', 'anant-addons-for-elementor' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .'.$this->image_compare_class.' .jx-arrow' => 'color: {{VALUE}}', 
				],
			]
		);

		$this->add_responsive_control(
			$slug.'_icon_width',
			[
				'label'           => __( 'Width', 'anant-addons-for-elementor' ),
				'type'            => Controls_Manager::SLIDER,
				'size_units'      => [ 'px', ],
				'range'           => [
					'px' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'devices'         => [ 'desktop', 'tablet', 'mobile' ],
				'desktop_default' => [
					'size' => '',
					'unit' => '',
				],
				'tablet_default'  => [
					'size' => '',
					'unit' => '',
				],
				'mobile_default'  => [
					'size' => '',
					'unit' => '',
				],
				'selectors'       => [
					'{{WRAPPER}} .'.$this->image_compare_class.' .jx-arrow' => 'width: {{SIZE}}{{UNIT}};',
				],
			],
		);

		$this->add_responsive_control(
			$slug.'_icon_height',
			[
				'label'           => __( 'Height', 'anant-addons-for-elementor' ),
				'type'            => Controls_Manager::SLIDER,
				'size_units'      => [ 'px', ],
				'range'           => [
					'px' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'devices'         => [ 'desktop', 'tablet', 'mobile' ],
				'desktop_default' => [
					'size' => '',
					'unit' => '',
				],
				'tablet_default'  => [
					'size' => '',
					'unit' => '',
				],
				'mobile_default'  => [
					'size' => '',
					'unit' => '',
				],
				'selectors'       => [
					'{{WRAPPER}} .'.$this->image_compare_class.' .jx-arrow' => 'height: {{SIZE}}{{UNIT}};',
				],
			],
		);

		$this->add_responsive_control(
			$slug.'_icon_size',
			[
				'label'           => __( 'Size', 'anant-addons-for-elementor' ),
				'type'            => Controls_Manager::SLIDER,
				'size_units'      => [ 'px', ],
				'range'           => [
					'px' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'devices'         => [ 'desktop', 'tablet', 'mobile' ],
				'desktop_default' => [
					'size' => '',
					'unit' => '',
				],
				'tablet_default'  => [
					'size' => '',
					'unit' => '',
				],
				'mobile_default'  => [
					'size' => '',
					'unit' => '',
				],
				'selectors'       => [
					'{{WRAPPER}} .'.$this->image_compare_class.' .jx-arrow.jx-right::before' => 'font-size: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .'.$this->image_compare_class.' .jx-arrow.jx-left::before' => 'font-size: {{SIZE}}{{UNIT}};',
				],
			],
		);

		$this->add_responsive_control(
			$slug.'_icon_spacing',
			[
				'label'           => __( 'Spacing', 'anant-addons-for-elementor' ),
				'type'            => Controls_Manager::SLIDER,
				'size_units'      => [ '%' ],
				'range'           => [
					'%' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'devices'         => [ 'desktop', 'tablet', 'mobile' ],
				'desktop_default' => [
					'size' => '',
					'unit' => '',
				],
				'tablet_default'  => [
					'size' => '',
					'unit' => '',
				],
				'mobile_default'  => [
					'size' => '',
					'unit' => '',
				],
				'selectors'       => [
					'{{WRAPPER}} .'.$this->image_compare_class.' .jx-arrow.jx-right' => 'right: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .'.$this->image_compare_class.' .jx-arrow.jx-left' => 'left: {{SIZE}}{{UNIT}};',
				],
			],
		);

		$this->add_responsive_control(
			$slug.'_icon_border_radius',
			array(
				'label'      => __( 'Border Radius', 'anant-addons-for-elementor' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%','em'],
				'devices' => [ 'desktop', 'tablet', 'mobile' ],
				'desktop_default' => [
					'size' => '',
					'unit' => '',
				],
				'tablet_default' => [
					'size' => '',
					'unit' => '',
				],
				'mobile_default' => [
					'size' => '',
					'unit' => '',
				],
				'selectors'  => [
					'{{WRAPPER}} .'.$this->image_compare_class.' .jx-arrow.jx-right' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					'{{WRAPPER}} .'.$this->image_compare_class.' .jx-arrow.jx-left' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			)
		);
		$this->end_controls_section();
	}

	protected function render() {

		$settings = $this->get_settings_for_display();

		$after_image_url = $settings['compare_image_one']['url'];  
		$before_image_url = $settings['compare_image_two']['url'];  
        $tigger_style = $settings['tigger_style'];
		if (in_array($tigger_style, ['click', 'hover'])) {
			$tigger_style = 'click';
		}
		$template_style = $settings['template_style'];
		if (in_array($template_style, ['layout_1', 'layout_2'])) {
			$template_style = 'layout_1';
		}

		if ($template_style == 'layout_1') {
			?>
			<div class="image-comparison <?php echo esc_attr($this->image_compare_class) ?>" tigger="<?php echo esc_attr($tigger_style); ?>">
				<div class="images-container juxtapose">
					<img class="before-image" src="<?php echo esc_url($after_image_url )?>" alt="before" >
					<img class="after-image" src="<?php echo esc_url($before_image_url )?>" alt="after" >
				</div>
			</div>
			<?php
		}
	}
}