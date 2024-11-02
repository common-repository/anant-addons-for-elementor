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

class AnantCreativeIcon extends \Elementor\Widget_Base {

	private $icon_card_class = 'anant-creative-icon-card';
	private $icon_inner = 'anant-creative-icon-inner-card';
	private $icon_class = 'anant-creative-icon';

	public function get_name() {
		return 'anant-creative-icon';
	}

	public function get_title() {
		return __('Creative Icon', 'anant-addons-for-elementor' );
	}

	public function get_categories() {
		return [ 'anant-elements' ];
	}

	public function get_icon() {
		return 'ant-icon eicon-favorite';
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
		return ['creative icons',
				'icon', 
				'anant eddons',
				 
				'animated icons',
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
			'link_icon_icon',
			[
				'label' => __( 'Icon', 'anant-addons-for-elementor' ),
				'type' => \Elementor\Controls_Manager::ICONS,
				'default' => [
					'value' => 'fas fa-arrow-top',
					'library' => 'solid',
				],
			]
		);
	 
		$this->add_responsive_control(
			'creative_btn_alignment',
			[
				'label'     => __( 'Alignment', 'anant-addons-for-elementor' ),
				'type'      => Controls_Manager::CHOOSE,
				'options'   => [
					'start' => [
						'title' => __( 'Left', 'anant-addons-for-elementor' ),
						'icon'  => 'eicon-text-align-left',
					],
					'center' => [
						'title' => __( 'Center', 'anant-addons-for-elementor' ),
						'icon'  => 'eicon-text-align-center',
					],
					'end' => [
						'title' => __( 'Right', 'anant-addons-for-elementor' ),
						'icon'  => 'eicon-text-align-right',
					],
				],
				'toggle'    => true,
				'selectors' => [
					'{{WRAPPER}} .'.$this->icon_card_class => 'text-align: {{VALUE}};',
				],
			]
		);

		$this->end_controls_section();

		anant_pro_promotion_controls($this);

		// style
		// icon One Icon
		$this->start_controls_section(
			'creative_btn_settings',
			[
				'label' => __('Settings', 'anant-addons-for-elementor' ),
				'tab'   => Controls_Manager::TAB_STYLE, 
			]
		);
		
		$slug = 'creative_btn';
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
					'{{WRAPPER}}  .'.$this->icon_class.'' => 'color: {{VALUE}}',
					'{{WRAPPER}} .'.$this->icon_class.' svg' => 'fill: {{VALUE}}',
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
						'label' => 'Background',
						'default' => 'classic',
					],
				],
				'selector'  => '{{WRAPPER}} .'.$this->icon_class.'',
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
					'{{WRAPPER}} .'.$this->icon_class.':hover' => 'color: {{VALUE}}',
					'{{WRAPPER}} .'.$this->icon_class.':hover svg' => 'fill: {{VALUE}}',
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
						'label' => 'Background',
						'default' => 'classic',
					],
				],
				'selector'  => '{{WRAPPER}} .'.$this->icon_class.':hover',
			]
		);

		$this->add_control(
			$slug.'_border_color_hover',
			[
				'label'     => __( 'Border Color', 'anant-addons-for-elementor' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .'.$this->icon_class.':hover' => 'border-color: {{VALUE}}',
				],
			]
		);
		
		$this->end_controls_tab();
		$this->end_controls_tabs(); 

		$this->add_group_control(
			\Elementor\Group_Control_Border::get_type(),
			[
				'name'     => $slug.'_border_type',
				'label'    => 'Border two',
				'selector' => '{{WRAPPER}} .'.$this->icon_class.'',
				'separator' => 'before',
			]
		); 

		anant_border_radius_control(
			$this,
			[
				'key'       => $slug.'_border_radius',
				'label'     => 'Border Radius',
				'selectors' => [
					'{{WRAPPER}} .'.$this->icon_class.'' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					'{{WRAPPER}} .ant-creative-icon.four .'.$this->icon_class.':before' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
					'{{WRAPPER}} .'.$this->icon_class.'' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		anant_box_shadow_control(
			$this,
			[
				'key'      => $slug.'_box_shadow',
				'label'    => 'Box Shadow',
				'selector' => '{{WRAPPER}}  .'.$this->icon_class.'',
			]
		);
		$this->end_controls_section();

		// icon One Icon
		$this->start_controls_section(
			'creative_icon_icon_settings',
			[
				'label' => __('Icon Settings', 'anant-addons-for-elementor' ),
				'tab'   => Controls_Manager::TAB_STYLE, 
			]
		);
		
		$slug = 'creative_icon';
		$this->start_controls_tabs( $slug.'_tabs' );

		$this->start_controls_tab(
			$slug.'_normal_style',
			[
				'label' => __( 'Normal', 'anant-addons-for-elementor' ),
			]
		); 

		$this->add_responsive_control(
			$slug.'_wsize',
			[
				'label'           => __( 'Icon Wrap Size', 'anant-addons-for-elementor' ),
				'type'            => Controls_Manager::SLIDER,
				'size_units'      => [ 'px', '%' ],
				'range'           => [
					'px' => [
						'min' => 0,
						'max' => 300,
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
					'{{WRAPPER}} .'.$this->icon_class.'' => 'width: {{SIZE}}{{UNIT}}; height: {{SIZE}}{{UNIT}};'
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
					'{{WRAPPER}} .'.$this->icon_class.' i' => 'font-size: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .'.$this->icon_class.' svg' => 'width: {{SIZE}}{{UNIT}}; height: {{SIZE}}{{UNIT}};'
				],
			]
		); 

		$this->add_responsive_control(
			$slug.'_rotate',
			[
				'label'           => __( 'Icon Rotate', 'anant-addons-for-elementor' ),
				'type'            => Controls_Manager::SLIDER,
				'size_units'      => [ 'deg', '%' ],
				'range'           => [
					'deg' => [
						'min' => 0,
						'max' => 360,
					],
					'%' => [
						'min' => 0,
						'max' => 360,
					],
				],
				'devices'         => [ 'desktop', 'tablet', 'mobile' ],
				'desktop_default' => [
					'size' => '',
					'unit' => 'deg',
				],
				'tablet_default'  => [
					'size' => '',
					'unit' => 'deg',
				],
				'mobile_default'  => [
					'size' => '',
					'unit' => 'deg',
				],
				'selectors'       => [
					'{{WRAPPER}} .'.$this->icon_class.' i' =>  'transform: rotate({{SIZE}}{{UNIT}});',
					'{{WRAPPER}} .'.$this->icon_class.' svg' => 'transform: rotate({{SIZE}}{{UNIT}});',
				],
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
			$slug.'_hover_rotate',
			[
				'label'           => __( 'Icon Rotate', 'anant-addons-for-elementor' ),
				'type'            => Controls_Manager::SLIDER,
				'size_units'      => [ 'deg', '%' ],
				'range'           => [
					'deg' => [
						'min' => 0,
						'max' => 360,
					],
					'%' => [
						'min' => 0,
						'max' => 360,
					],
				],
				'devices'         => [ 'desktop', 'tablet', 'mobile' ],
				'desktop_default' => [
					'size' => '',
					'unit' => 'deg',
				],
				'tablet_default'  => [
					'size' => '',
					'unit' => 'deg',
				],
				'mobile_default'  => [
					'size' => '',
					'unit' => 'deg',
				],
				'selectors'       => [
					'{{WRAPPER}} .'.$this->icon_class.':hover i' => 'transform: rotate({{SIZE}}{{UNIT}});',
					'{{WRAPPER}} .'.$this->icon_class.':hover svg' => 'transform: rotate({{SIZE}}{{UNIT}});',
				],
			]
		);
		 
		$this->end_controls_tab();
		$this->end_controls_tabs(); 
		$this->end_controls_section();
	}



	protected function render() {
		$settings = $this->get_settings_for_display();
  
		$link_icon_icon = $settings['link_icon_icon'];
		$link = $settings['card_link']['url'];
		$target = $settings['card_link']['is_external'] ? ' target=_blank' : '';
		$nofollow = $settings['card_link']['nofollow'] ? ' rel=nofollow' : '';
		?>

		<div class="ant-creative-icon <?php echo esc_attr($this->icon_card_class);?>">
			<a class="more <?php echo esc_attr($this->icon_class);?>"
				href="<?php echo esc_url($link) ?>"
				<?php echo esc_attr($target) ?>
				<?php echo esc_attr($nofollow) ?>>
				<?php \Elementor\Icons_Manager::render_icon( $link_icon_icon, [ 'aria-hidden' => 'true' ] ); ?> 
			</a>
		</div>
		<?php		
	}
}