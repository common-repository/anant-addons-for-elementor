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

class AnantCart extends Widget_Base {

	private $cart_button_class = 'anant-cart-button';
	private $cart_total_class = 'anant-cart-total';
	private $cart_icon_class = 'anant-cart-icon';
	private $cart_counter_class = 'anant-cart-counter';
	private $cart_offcanvas_class = 'anant-cart-offcanvas';

	public function get_name() {
		return 'anant-cart';
	}

	public function get_title() {
		return __( 'Cart', 'anant-addons-for-elementor' );
	}

	public function get_icon() {
		return 'ant-icon eicon-cart';
	}

	public function get_categories() {
		return [ 'anant-woo-elements' ];
	}

    public function get_style_depends() {
        return ['anant-styles-css'];

    }

	public function get_script_depends() {
		return [
			'anant-custom-js',
		];
	}

	public function get_keywords() {
		return [
			'cart',
			'wishlist',
			'favorite',
			'add to cart',
			'anant addons',
			'',
			'woo',
		];
	}

	protected function register_controls() {

		$this->general_content_controls();
		$this->style_content_controls();
	}

	protected function general_content_controls() {

		$this->start_controls_section(
			'section_general_fields',
			[
				'label' => __( 'Cart', 'anant-addons-for-elementor' ),
			]
		);

        $this->add_control(
			'anant_cart_icon',
			[
				'label' => esc_html__( 'Icon', 'anant-addons-for-elementor' ),
				'type' => \Elementor\Controls_Manager::ICONS,
				'default' => [
					'value' => 'fa fa-shopping-cart',
					'library' => 'fa-solid',
				],
			]
		);


		$this->add_control(
			'items_indicator',
			[
				'label'        => __( 'Items Count', 'anant-addons-for-elementor' ),
				'type'         => Controls_Manager::SWITCHER,
				'label_on'     => __( 'Show', 'anant-addons-for-elementor' ),
				'label_off'    => __( 'Hide', 'anant-addons-for-elementor' ),
				'return_value' => 'yes',
				'default'      => 'yes',
			]
		);

		$this->add_control(
			'show_subtotal',
			[
				'label'        => __( 'Show Total Price', 'anant-addons-for-elementor' ),
				'type'         => Controls_Manager::SWITCHER,
				'label_on'     => __( 'Show', 'anant-addons-for-elementor' ),
				'label_off'    => __( 'Hide', 'anant-addons-for-elementor' ),
				'return_value' => 'yes',
				'default'      => 'yes',

			]
		);

		$this->add_responsive_control(
			'cart_align',
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

		$this->start_controls_section(
			'cart_settings',
			[
				'label' => __( 'Cart Settings', 'anant-addons-for-elementor' ),
				'tab'   => Controls_Manager::TAB_CONTENT,
			]
		);

		$this->add_control(
			'cart_type_style',
			[
				'label'       => esc_html__( 'Cart Type', 'anant-addons-for-elementor' ) .' <i class="eicon-pro-icon"></i>',
				'placeholder' => esc_html__( 'Choose Template from Here', 'anant-addons-for-elementor' ),
				'type'        => \Elementor\Controls_Manager::SELECT,
				'default'     => 'slide',
				'options'     => [
					'slide'      => esc_html__( 'Slide (Pro)', 'anant-addons-for-elementor' ),
					'mini_cart' => esc_html__( 'Dropdown (Pro)', 'anant-addons-for-elementor' ),
				],
				'classes' => 'anant-pro-popup-notice',
			]
		); 
		
		$this->add_control(
			'open_cart_type',
			[
				'label'       => esc_html__( 'Open Cart', 'anant-addons-for-elementor' ) .' <i class="eicon-pro-icon"></i>',
				'placeholder' => esc_html__( 'Choose Template from Here', 'anant-addons-for-elementor' ),
				'type'        => \Elementor\Controls_Manager::SELECT,
				'default'     => 'on_click',
				'options'     => [
					'on_click'      => esc_html__( 'On Click (Pro)', 'anant-addons-for-elementor' ),
					'on_hover' => esc_html__( 'On Hover (Pro)', 'anant-addons-for-elementor' ),
				],
				'classes' => 'anant-pro-popup-notice',
			]
		);

		$this->end_controls_section();

		anant_pro_promotion_controls($this);

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
					'{{WRAPPER}} .'.$this->cart_button_class => 'background-color: {{VALUE}}',
				],
			]
		);

		anant_border_control(
			$this,
			[
				'name'     => 'wrapper_border_type',
				'label'    => 'Border Type',
				'selector' => '{{WRAPPER}} .'.$this->cart_button_class,
			]
		);

		anant_border_radius_control(
			$this,
			[
				'key'       => 'wrapper_border_radius',
				'label'     => 'Border Radius',
				'selectors'  => [
					'{{WRAPPER}} .'.$this->cart_button_class => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
					'{{WRAPPER}} .'.$this->cart_button_class => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}',
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
					'{{WRAPPER}} .'.$this->cart_button_class => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}',
                ],
			]
		);

		anant_box_shadow_control(
			$this,
			[
				'key'      => 'wrapper_box_shadow',
				'label'    => 'Box Shadow',
				'selector' => '{{WRAPPER}}  .'.$this->cart_button_class,
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'cart_total_settings',
			[
				'label'     => __( 'Total', 'anant-addons-for-elementor' ),
				'tab'       => Controls_Manager::TAB_STYLE,
				'condition' => [
                    'show_subtotal' => 'yes',
                ],
				
			]
		);

		$this->add_control(
			'cart_total_color',
			[
				'label'     => __( 'Color', 'anant-addons-for-elementor' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .'.$this->cart_total_class.' .woocommerce-Price-amount  bdi' => 'color: {{VALUE}}',
				],
			]
		);

        anant_typography_control(
			$this,
			[
				'name'     => 'cart_total_typography',
				'label'    => 'Typography',
				'selector' => '{{WRAPPER}} .'.$this->cart_total_class,
			]
		);

		$this->end_controls_section();
		
		$this->start_controls_section(
			'cart_icon_settings',
			[
				'label' => __( 'Cart icon Settings', 'anant-addons-for-elementor' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);

        $this->start_controls_tabs( 'cart_icon_style_tabs' );

		$this->start_controls_tab(
			'cart_icon_normal_tab',
			[
				'label' => __( 'Normal', 'anant-addons-for-elementor' ),
			]
		);

		$this->add_control(
			'cart_icon_color',
			[
				'label'     => __( 'Color', 'anant-addons-for-elementor' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .woocommerce-Price-amount  bdi' => 'color: {{VALUE}}',
					'{{WRAPPER}} .'.$this->cart_icon_class.' i' => 'color: {{VALUE}};',
					'{{WRAPPER}} .'.$this->cart_icon_class.' svg' => 'fill: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'cart_icon_bg_color',
			[
				'label'     => __( 'Background Color', 'anant-addons-for-elementor' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .'.$this->cart_icon_class => 'background-color: {{VALUE}}',
				],
			]
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
			'cart_icon_hover_colors',
			[
				'label' => __( 'Hover', 'anant-addons-for-elementor' ),
			]
		);

		$this->add_control(
			'cart_icon_hover_color',
			[
				'label'     => __( 'Color', 'anant-addons-for-elementor' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .'.$this->cart_button_class.':hover .woocommerce-Price-amount  bdi' => 'color: {{VALUE}}',
					'{{WRAPPER}} .'.$this->cart_button_class.':hover i' => 'color: {{VALUE}};',
					'{{WRAPPER}} .'.$this->cart_button_class.':hover svg' => 'fill: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'cart_icon_bg_hover_color',
			[
				'label'     => __( 'Background Color', 'anant-addons-for-elementor' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .'.$this->cart_button_class.':hover .'.$this->cart_icon_class => 'background-color: {{VALUE}}',
				],
			]
		);

		$this->end_controls_tab();
		$this->end_controls_tabs();

		$this->add_control('cart_icon_divider',['type' => \Elementor\Controls_Manager::DIVIDER,]);

		$this->add_responsive_control(
			'cart_icon_size',
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
					'{{WRAPPER}} .'.$this->cart_icon_class.' i' => 'font-size: {{SIZE}}{{UNIT}}',
					'{{WRAPPER}} .'.$this->cart_icon_class.' svg' => 'width: {{SIZE}}{{UNIT}}; height: {{SIZE}}{{UNIT}}',
				],
			]
		);

		$this->add_responsive_control(
			'cart_icon_wsize',
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
					'{{WRAPPER}} .'.$this->cart_icon_class.'' => 'width: {{SIZE}}{{UNIT}}; height: {{SIZE}}{{UNIT}};'
				],
			]
		); 

		$this->add_responsive_control(
			'cart_icon_space',
			[
				'label'           => __( 'Icon Spacing', 'anant-addons-for-elementor' ),
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
					'{{WRAPPER}}  .'.$this->cart_icon_class.'' => 'margin-left: {{SIZE}}{{UNIT}};',
				],
			]
		);

		anant_border_control(
			$this,
			[
				'name'     => 'cart_icon_border_type',
				'label'    => 'Border Type',
				'selector' => '{{WRAPPER}} .'.$this->cart_icon_class,
			]
		);

		anant_border_radius_control(
			$this,
			[
				'key'       => 'cart_icon_border_radius',
				'label'     => 'Border Radius',
				'selectors'  => [
					'{{WRAPPER}} .'.$this->cart_icon_class => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		
		$this->add_responsive_control(
			'cart_icon_margin',
			[
				'label'     => esc_html__('Margin', 'anant-addons-for-elementor'),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' =>[
					'{{WRAPPER}} .'.$this->cart_icon_class => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}',
                ],
			]
		);

		anant_box_shadow_control(
			$this,
			[
				'key'      => 'cart_icon_box_shadow',
				'label'    => 'Box Shadow',
				'selector' => '{{WRAPPER}}  .'.$this->cart_icon_class,
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'item_counter_settings',
			[
				'label'     => __( 'Counter', 'anant-addons-for-elementor' ),
				'tab'       => Controls_Manager::TAB_STYLE,
				
			]
		);

		$this->add_control(
			'counter_color',
			[
				'label'     => __( 'Color', 'anant-addons-for-elementor' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .'.$this->cart_counter_class => 'color: {{VALUE}}',
				],
			]
		);

		$this->add_control(
			'counter_background_color',
			[
				'label'     => __( 'Background Color', 'anant-addons-for-elementor' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .'.$this->cart_counter_class => 'background-color: {{VALUE}}',
				],
			]
		);

        anant_typography_control(
			$this,
			[
				'name'     => 'counter_typography',
				'label'    => 'Typography',
				'selector' => '{{WRAPPER}} .'.$this->cart_counter_class,
			]
		);

		$this->add_responsive_control(
			'counter_icon_width',
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
					'{{WRAPPER}} .'.$this->cart_counter_class => 'width: {{SIZE}}{{UNIT}}; height: {{SIZE}}{{UNIT}};',
				],
			]
		);

		anant_border_radius_control(
			$this,
			[
				'key'       => 'cart_icon_num_count_border_radius',
				'label'     => 'Border Radius',
				'selectors' => [
					'{{WRAPPER}} .'.$this->cart_counter_class => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'cart_icon_num_count_margin',
			[
				'label'     => esc_html__('Margin', 'anant-addons-for-elementor'),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .'.$this->cart_counter_class => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->end_controls_section();
	}

	protected function render() {
		
		if ( null === WC()->cart ) {
			return;
		}
	
		$settings  = $this->get_settings_for_display(); 
		$product_count = WC()->cart->get_cart_contents_count();
		$get_cart_subtotal = WC()->cart->get_cart_subtotal(); ?>

    	<div class="anant-cart anant-bor" >
			<div class="cart-inner">
				<a href="<?php echo esc_url( wc_get_cart_url() ); ?>" class="cart <?php echo esc_attr($this->cart_button_class) ?>" >
					<?php if($settings['show_subtotal'] === 'yes' ) { ?>
						<span class='cart-total <?php echo esc_attr($this->cart_total_class) ?>'>
							<?php echo wp_kses_post(WC()->cart->get_cart_subtotal()); ?>
						</span>
					<?php } ?>    
					<div class="cart-icon <?php echo esc_attr($this->cart_icon_class) ?>">
						<?php \Elementor\Icons_Manager::render_icon( $settings['anant_cart_icon'], [ 'aria-hidden' => 'true' ] ); ?>
					</div>
					<?php if($settings['items_indicator'] === 'yes' ) { ?>   
						<span class='counter <?php echo esc_attr($this->cart_counter_class) ?>'>
							<?php echo esc_html($product_count); ?>
						</span>
					<?php } ?>
				</a>       
			</div>  
		</div>
	<?php 
	}

	protected function content_template() {
	}
}