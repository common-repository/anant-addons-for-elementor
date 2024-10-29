<?php namespace AnantAddons;

use Elementor\Controls_Manager;
use Elementor\Core\Schemes\Color;
use Elementor\Core\Schemes\Typography;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Image_Size;
use Elementor\Widget_Base;
use Elementor\this;
use Elementor\Utils;
use Elementor\Group_Control_Border;

class AnantWishlistCount extends Widget_Base {

	private $wishlist_button_class = 'anant-wishlist-button';
	private $wishlist_icon_class = 'anant-wishlist-icon';
	private $wishlist_counter_class = 'anant-wishlist-counter';

	public function get_name() {
		return 'anant-wishlist-count';
	}

	public function get_title() {
		return __( 'Mini Wishlist', 'anant-addons-for-elementor' );
	}

	public function get_icon() {
		return 'ant-icon eicon-favorite';
	}

	public function get_categories() {
		return [ 'anant-woo-elements' ];
	}

    public function get_style_depends() {
        return ['anant-styles-css'];

    }

	public function get_script_depends() {
		return [ 'anant-custom-js'];
	}
	
	public function get_keywords() {
		return [
			'wishlist',
			'mini wishlist',
			'mini-wishlist',
			'favorite',
			'add to cart',
			'anant addons',
			'woo',
		];
	}

	protected function register_controls() {

		$this->general_content_controls();
		$this->style_content_controls();
	}

	protected function general_content_controls() {

		$this->start_controls_section(
			'anant_wishlish_general_fields',
			[
				'label' => __( 'Wishlist', 'anant-addons-for-elementor' ),
			]
		);

        $this->add_control(
			'anant_wishlish_icon',
			[
				'label' => esc_html__( 'Icon', 'plugin-name' ),
				'type' => \Elementor\Controls_Manager::ICONS,
				'default' => [
					'value' => 'far fa-heart',
					'library' => 'fa-regular',
				],
			]
		);

		$this->add_control(
			'anant_wishlish_count',
			[
				'label'        => __( 'Wishlist Count', 'anant-addons-for-elementor' ),
				'type'         => Controls_Manager::SWITCHER,
				'label_on'     => __( 'Show', 'anant-addons-for-elementor' ),
				'label_off'    => __( 'Hide', 'anant-addons-for-elementor' ),
				'return_value' => 'yes',
				'default'      => 'yes',    
				
			]
		);

		$this->add_responsive_control(
			'anant_wishlish_align',
			[
				'label'              => __( 'Alignment', 'anant-addons-for-elementor' ),
				'type'               => Controls_Manager::CHOOSE,
				'options'            => [
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
				'default'            => '',

                'selectors' =>[
                    '{{WRAPPER}} .anant-cart' => 'text-align: {{VALUE}}',
                ]
			]
		);

		$this->end_controls_section();
	}

	protected function style_content_controls() {

		$this->start_controls_section(
			'wrapper_settings',
			[
				'label' => __( 'Wrapper Settings', 'anant-addons-for-elementor' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'wrapper_bg_color',
			[
				'label'     => __( 'Background Color', 'anant-addons-for-elementor' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .'.$this->wishlist_button_class => 'background-color: {{VALUE}}',
				],
			]
		);

		anant_border_control(
			$this,
			[
				'name'     => 'wrapper_border_type',
				'label'    => 'Border Type',
				'selector' => '{{WRAPPER}} .'.$this->wishlist_button_class,
			]
		);

		anant_border_radius_control(
			$this,
			[
				'key'       => 'wrapper_border_radius',
				'label'     => 'Border Radius',
				'selectors'  => [
					'{{WRAPPER}} .'.$this->wishlist_button_class => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		
		$this->add_responsive_control(
			'wrapper_margin',
			[
				'label'     => esc_html__('Margin', 'anant-addons-for-elementor'),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' =>[
					'{{WRAPPER}} .'.$this->wishlist_button_class => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}',
                ],
			]
		);

		$this->add_responsive_control(
			'wrapper_padding',
			[
				'label'     => esc_html__('Padding', 'anant-addons-for-elementor'),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .'.$this->wishlist_button_class => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}',
                ],
			]
		);

		anant_box_shadow_control(
			$this,
			[
				'key'      => 'wrapper_box_shadow',
				'label'    => 'Box Shadow',
				'selector' => '{{WRAPPER}}  .'.$this->wishlist_button_class,
			]
		);

		$this->end_controls_section();
		
		$this->start_controls_section(
			'anant_wishlish_settings',
			[
				'label' => __( 'Wishlist icon Settings', 'anant-addons-for-elementor' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);

        $this->start_controls_tabs( 'anant_wishlish_colors' );

		$this->start_controls_tab(
			'anant_wishlish_normal_colors',
			[
				'label' => __( 'Normal', 'anant-addons-for-elementor' ),
			]
		);

		$this->add_control(
			'anant_wishlish_icon_color',
			[
				'label'     => __( 'Icon Color', 'anant-addons-for-elementor' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .'.$this->wishlist_icon_class.' i' => 'color: {{VALUE}};',
					'{{WRAPPER}} .'.$this->wishlist_icon_class.' svg' => 'fill: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'anant_wishlish_background_color',
			[
				'label'     => __( 'Background Color', 'anant-addons-for-elementor' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .'.$this->wishlist_icon_class => 'background-color: {{VALUE}}',
				],
			]
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
			'anant_wishlish_hover_colors',
			[
				'label' => __( 'Hover', 'anant-addons-for-elementor' ),
			]
		);

		$this->add_control(
			'anant_wishlish_icon_color_hover',
			[
				'label'     => __( 'Icon Color', 'anant-addons-for-elementor' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .'.$this->wishlist_button_class.':hover .'.$this->wishlist_icon_class.' i' => 'color: {{VALUE}};',
					'{{WRAPPER}} .'.$this->wishlist_button_class.':hover .'.$this->wishlist_icon_class.' svg' => 'fill: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'anant_wishlish_background_color_hover',
			[
				'label'     => __( 'Background Color', 'anant-addons-for-elementor' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .'.$this->wishlist_button_class.':hover .'.$this->wishlist_icon_class => 'background-color: {{VALUE}}',
				],
			]
		);

		$this->end_controls_tab();
		$this->end_controls_tabs();

		$this->add_control('anant_wishlist_divider',['type' => \Elementor\Controls_Manager::DIVIDER,]);

		$this->add_responsive_control(
			'anant_wishlish_icon_size',
			[
				'label'      => __( 'Icon Size', 'anant-addons-for-elementor' ),
				'type'       => Controls_Manager::SLIDER,
				'range'      => [
					'px' => [
						'min' => 0,
						'max' => 50,
					],
				],
				'size_units' => [ 'px', 'em' ],
				'selectors'  => [
					'{{WRAPPER}} .'.$this->wishlist_icon_class.' i' => 'font-size: {{SIZE}}{{UNIT}}',
					'{{WRAPPER}} .'.$this->wishlist_icon_class.' svg' => 'width: {{SIZE}}{{UNIT}}; height: {{SIZE}}{{UNIT}}',
				],
			]
		);

		$this->add_responsive_control(
			'anant_wishlish_icon_wrap_size',
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
					'{{WRAPPER}} .'.$this->wishlist_icon_class.'' => 'width: {{SIZE}}{{UNIT}}; height: {{SIZE}}{{UNIT}};'
				],
			]
		); 

		anant_border_control(
			$this,
			[
				'name'     => 'anant_wishlish_border_type',
				'label'    => 'Border Type',
				'selector' => '{{WRAPPER}} .'.$this->wishlist_icon_class,
			]
		);

		anant_border_radius_control(
			$this,
			[
				'key'       => 'anant_wishlish_border_radius',
				'label'     => 'Border Radius',
				'selectors'  => [
					'{{WRAPPER}} .'.$this->wishlist_icon_class => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'anant_wishlish_margin',
			[
				'label'     => esc_html__('Margin', 'anant-addons-for-elementor'),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors'          => [
					'{{WRAPPER}} .'.$this->wishlist_icon_class => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}',
                ],
			]
		);

		anant_box_shadow_control(
			$this,
			[
				'key'      => 'anant_wishlish_box_shadow',
				'label'    => 'Box Shadow',
				'selector' => '{{WRAPPER}}  .'.$this->wishlist_icon_class,
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'anant_wishlish_num_count',
			[
				'label'     => __( 'Counter', 'anant-addons-for-elementor' ),
				'tab'       => Controls_Manager::TAB_STYLE,
				
			]
		);

		$this->add_control(
			'anant_wishlish_num_count_color',
			[
				'label'     => __( 'Color', 'anant-addons-for-elementor' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .'.$this->wishlist_counter_class => 'color: {{VALUE}}',
				],
			]
		);

		$this->add_control(
			'anant_wishlish_num_count_background_color',
			[
				'label'     => __( 'Background Color', 'anant-addons-for-elementor' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .'.$this->wishlist_counter_class => 'background-color: {{VALUE}}',
				],
			]
		); 

        anant_typography_control(
			$this,
			[
				'name'     => 'anant_wishlish_num_count_typography',
				'label'    => 'Typography',
				'selector' => '{{WRAPPER}} .'.$this->wishlist_counter_class,
			]
		);

		$this->add_responsive_control(
			'anant_wishlish_num_count_icon_width',
			[
				'label'           => __( 'Width', 'anant-addons-for-elementor' ),
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
					'{{WRAPPER}} .'.$this->wishlist_counter_class => 'width: {{SIZE}}{{UNIT}}; height: {{SIZE}}{{UNIT}};',
				],
			]
		);

		anant_border_radius_control(
			$this,
			[
				'key'       => 'anant_wishlish_num_count_border_radius',
				'label'     => 'Border Radius',
				'selectors' => [
					'{{WRAPPER}} .'.$this->wishlist_counter_class => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'anant_wishlish_num_count_margin',
			[
				'label'     => esc_html__('Margin', 'anant-addons-for-elementor'),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .'.$this->wishlist_counter_class => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->end_controls_section();
	}

	protected function render() {

		$settings  = $this->get_settings_for_display();

        if (is_user_logged_in()) {
            $user_id = get_current_user_id();
            $wishlist = get_user_meta($user_id, '_user_wishlist', true); 
			
			if(empty($wishlist)){
				$wishlist = [0];
			}
			
			if((in_array(0, $wishlist))){
				$wish_num = count($wishlist);
				$wish_num--;
			} else {
				$wish_num = count($wishlist);
			}
			$wishlist_url = get_option('wishlist_template_select');
			$wishlist_url = get_permalink($wishlist_url);
			if($wishlist_url == false || $wishlist_url == 0 ){
				$wishlist_url = home_url();
			}
			?>
			<div class="anant-cart anant-bor" >
				<div class="cart-inner">	
					<a href="<?php echo esc_attr($wishlist_url); ?>" class="cart <?php echo esc_attr($this->wishlist_button_class) ?>">   
						<div class="cart-icon <?php echo esc_attr($this->wishlist_icon_class) ?>">
							<?php \Elementor\Icons_Manager::render_icon( $settings['anant_wishlish_icon'], [ 'aria-hidden' => 'true' ] ); ?>
						</div>
						<?php if($settings['anant_wishlish_count'] === 'yes' ) { ?>   
							<span class='counter <?php echo esc_attr($this->wishlist_counter_class) ?>'>
								<?php echo esc_html($wish_num); ?>
							</span>
						<?php } ?>
					</a>       
				</div>   
			</div>
			<?php
		}
	}
}
