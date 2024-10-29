<?php // phpcs:disable Squiz.PHP.CommentedOutCode.Found
namespace AnantAddons;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Typography;
use Elementor\Core\Schemes;
use Elementor\Group_Control_Box_Shadow;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class AnantWishlistPage extends Widget_Base {

	public function __construct( $data = [], $args = null ) {
		parent::__construct( $data, $args );
			if ( is_null( WC()->cart ) ) {
				include_once WC_ABSPATH . 'includes/wc-cart-functions.php';
				include_once WC_ABSPATH . 'includes/class-wc-cart.php';
				wc_load_cart();
		}
	}
	
	public function get_name() {
		return 'anant-wishlist-page';
	}

	public function get_title() {
		return esc_html__( 'Wishlist Page', 'anant-addons-for-elementor' );
	}

	public function get_icon() {
		return 'ant-icon eicon-welcome';
	}

	public function get_categories() {
		return [ 'anant-woo-elements' ];
	}

	public function get_keywords() {
		return [
			'cart page',
			'wishlist page',
			'favorite page',
			'anant addons',
			'woo',
		];
	}

	protected function register_controls() {

		$this->start_controls_section(
			'heading_style',
			[
				'label' => esc_html__( 'Heading Style', 'anant-addons-for-elementor' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);

		$slug = 'heading';
		$this->add_control(
			$slug.'_color',
			[
				'label'     => esc_html__( 'Color', 'anant-addons-for-elementor' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .anant-wishlist-main thead tr th' => 'color: {{VALUE}};',
					'{{WRAPPER}} .anant-wishlist-main thead tr th h4' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			$slug.'_bg_color',
			[
				'label'     => esc_html__( 'Background Color', 'anant-addons-for-elementor' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .anant-wishlist-main thead tr ' => 'background: {{VALUE}};',
				],
			]
		);

		anant_typography_control(
			$this,
			[
				'name'     => $slug.'_typography',
				'label'    => 'Typography',
				'selector' => '{{WRAPPER}}  .anant-wishlist-main thead tr th h4',
			]
		); 
		
		$this->add_responsive_control(
			$slug.'_padding',
			[
				'label'     => esc_html__('Padding', 'anant-addons-for-elementor'),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .anant-wishlist-main thead tr th' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
					'{{WRAPPER}} .anant-wishlist-main thead tr th h4' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->end_controls_section();

		$this->start_controls_section(
			'table_item_section',
			[
				'label' => esc_html__( 'Table Item', 'anant-addons-for-elementor' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);

		$slug = 'table_item';
		anant_color_control(
			$this,
			[
				'key'       => $slug.'_bg_color',
				'label'     => 'Background Color',
				'selectors' => [
					'{{WRAPPER}} .anant-wishlist-main tbody' => 'background-color: {{VALUE}};',
					'{{WRAPPER}} .anant-wishlist-main table:not( .has-background ) tbody td' => 'background-color: {{VALUE}};',
				],
			]
		);
		anant_border_control(
			$this,
			[
				'name'     => $slug.'_inner_border_type',
				'fields_options' => [
					'border' => [
						'label' => 'Inner Table Border',
					],
				],
				'selector' => '
				{{WRAPPER}} .anant-wishlist-main td, 
				{{WRAPPER}} .anant-wishlist-main th',
			]
		);

		$this->add_control(
			'remove_icon_heading',
			[
				'label' => esc_html__( 'Remove Icon', 'anant-addons-for-elementor' ),
				'type' => \Elementor\Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);

		anant_color_control(
			$this,
			[
				'key'       => 'remove_icon_color',
				'label'     => 'Color',
				'selectors' => [
					'{{WRAPPER}} .anant-wishlist-main .product-remover' => 'color: {{VALUE}}!important;',
				],
			]
		);

		anant_color_control(
			$this,
			[
				'key'       => 'remove_icon_bg_color',
				'label'     => 'Background Color',
				'selectors' => [
					'{{WRAPPER}} .anant-wishlist-main .product-remover' => 'background-color: {{VALUE}};',
				],
			]
		);
		anant_color_control(
			$this,
			[
				'key'       => 'remove_icon_hover_color',
				'label'     => 'Hover Color',
				'selectors' => [
					'{{WRAPPER}} .anant-wishlist-main .product-remover:hover' => 'color: {{VALUE}}!important;',
				],
			]
		);

		anant_color_control(
			$this,
			[
				'key'       => 'remove_icon_bg_hover_color',
				'label'     => 'Hover Background Color',
				'selectors' => [
					'{{WRAPPER}} .anant-wishlist-main .product-remover:hover' => 'background-color: {{VALUE}};',
				],
			]
		);

		$this->add_responsive_control(
			'removie_icon_width',
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
					'{{WRAPPER}} .anant-wishlist-main .product-remover' => 'width: {{SIZE}}{{UNIT}}; height: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'removie_icon_size',
			[
				'label'           => __( 'Size', 'anant-addons-for-elementor' ),
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
					'{{WRAPPER}} .anant-wishlist-main .product-remover' => 'font-size: {{SIZE}}{{UNIT}};',
				],
				'separator' => 'after',

			]
		);

		$this->add_control(
			'product_img_heading',
			[
				'label' => esc_html__( 'Image', 'anant-addons-for-elementor' ),
				'type' => \Elementor\Controls_Manager::HEADING,
				// 'separator' => 'before',
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
					'{{WRAPPER}} .anant-wishlist-main .product-thumbnail a' => 'width: {{SIZE}}{{UNIT}}; height: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .anant-wishlist-main .product-thumbnail a img' => 'width: {{SIZE}}{{UNIT}}; height: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'counter_icon_height',
			[
				'label'           => __( 'Height', 'anant-addons-for-elementor' ),
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
					'{{WRAPPER}} .anant-wishlist-main .product-thumbnail a' => 'height: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .anant-wishlist-main .product-thumbnail a img' => 'height: {{SIZE}}{{UNIT}};',
				],

			]
		);

		anant_border_radius_control(
			$this,
			[
				'key'       => 'image_border_radius',
				'label'     => 'Border Radius',
				'selectors' => [
					'{{WRAPPER}} .anant-wishlist-main .product-thumbnail a'  => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					'{{WRAPPER}} .anant-wishlist-main .product-thumbnail a img'  => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_control(
			'title_heading',
			[
				'label' => esc_html__( 'Name', 'anant-addons-for-elementor' ),
				'type' => \Elementor\Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);

		anant_color_control(
			$this,
			[
				'key'       => 'title_color',
				'label'     => 'Color',
				'selectors' => [
					'{{WRAPPER}} .anant-wishlist-main .product-name a' => 'color: {{VALUE}};',
				],
			]
		);
		anant_color_control(
			$this,
			[
				'key'       => 'title_hover_color',
				'label'     => 'Hover Color',
				'selectors' => [
					'{{WRAPPER}} .anant-wishlist-main .product-name a:hover' => 'color: {{VALUE}};',
				],
			]
		);
		anant_typography_control(
			$this,
			[
				'name'     => 'title_typography',
				'label'    => 'Typography',
				'selector' => '{{WRAPPER}}  .anant-wishlist-main tbody td.product-name',
			]
		); 

		$this->add_control(
			'price_heading',
			[
				'label' => esc_html__( 'Price', 'anant-addons-for-elementor' ),
				'type' => \Elementor\Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);

		anant_color_control(
			$this,
			[
				'key'       => 'price_color',
				'label'     => 'Price Color',
				'selectors' => [
					'{{WRAPPER}} .anant-wishlist-main .product-price del' => 'color: {{VALUE}};',
					'{{WRAPPER}} .anant-wishlist-main .product-price bdi' => 'color: {{VALUE}};',
				],
			]
		);

		anant_typography_control(
			$this,
			[
				'name'     => 'price_typography',
				'label'    => 'Typography',
				'selector' => '{{WRAPPER}} .anant-wishlist-main .product-price del, {{WRAPPER}} .anant-wishlist-main .product-price ins',
			]
		); 

		anant_color_control(
			$this,
			[
				'key'       => 'sale_price_color',
				'label'     => 'Sale Price Color',
				'selectors' => [
					'{{WRAPPER}} .anant-wishlist-main .product-price ins' => 'color: {{VALUE}};',
					'{{WRAPPER}} .anant-wishlist-main .product-price ins bdi' => 'color: {{VALUE}};',
				],
			]
		);

		anant_typography_control(
			$this,
			[
				'name'     => 'sale_price_typography',
				'label'    => 'Typography',
				'selector' => '{{WRAPPER}} .anant-wishlist-main .product-price ins, {{WRAPPER}} .anant-wishlist-main .product-price ins bdi',
			]
		); 

		$this->add_control(
			'stock_heading',
			[
				'label' => esc_html__( 'In Stock', 'anant-addons-for-elementor' ),
				'type' => \Elementor\Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);

		anant_color_control(
			$this,
			[
				'key'       => 'stock_color',
				'label'     => 'Color',
				'selectors' => [
					'{{WRAPPER}} .anant-wishlist-main .product-stock .in-stock' => 'color: {{VALUE}};',
				],
			]
		);

		anant_typography_control(
			$this,
			[
				'name'     => 'stock_typography',
				'label'    => 'Typography',
				'selector' => '{{WRAPPER}}  .anant-wishlist-main .product-stock .in-stock',
			]
		); 

		$this->add_control(
			'out_of_stock_heading',
			[
				'label' => esc_html__( 'Out Of Stock', 'anant-addons-for-elementor' ),
				'type' => \Elementor\Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);

		anant_color_control(
			$this,
			[
				'key'       => 'out_of_stock_color',
				'label'     => 'Color',
				'selectors' => [
					'{{WRAPPER}} .anant-wishlist-main .product-stock .out-of-stock' => 'color: {{VALUE}};',
				],
			]
		);

		anant_typography_control(
			$this,
			[
				'name'     => 'out_of_stock_typography',
				'label'    => 'Typography',
				'selector' => '{{WRAPPER}}  .anant-wishlist-main .product-stock .out-of-stock',
			]
		); 

		$this->add_control(
			'button_heading',
			[
				'label' => esc_html__( 'Button', 'anant-addons-for-elementor' ),
				'type' => \Elementor\Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);

		$slug = 'product_cart_btn';
		$this->add_responsive_control(
			$slug.'_alignment',
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
					'{{WRAPPER}}  .anant-wishlist-main .product-cart-btn' => 'text-align: {{VALUE}};',
					
				]
			],
		);
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
					'{{WRAPPER}}  .anant-wishlist-main .product-cart-btn a' => 'color: {{VALUE}}',
				],
			]
		);

		$this->add_control(
			$slug.'_bg_color',
			[
				'label'     => __( 'Background Color', 'anant-addons-for-elementor' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}}  .anant-wishlist-main .product-cart-btn a' => 'background-color: {{VALUE}}',
				],
			]
		);

		anant_border_control(
			$this,
			[
				'name'     => $slug.'_border_type',
				'label'    => 'Border Type',
				'selector' => '{{WRAPPER}} .anant-wishlist-main .product-cart-btn a',
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
					'{{WRAPPER}} .anant-wishlist-main .product-cart-btn a:hover' => 'color: {{VALUE}}',
				],
			]
		);

		$this->add_control(
			$slug.'_bg_color_hover',
			[
				'label'     => __( 'Background Color', 'anant-addons-for-elementor' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .anant-wishlist-main .product-cart-btn a:hover' => 'background-color: {{VALUE}}',
				],
			]
		);

		anant_border_control(
			$this,
			[
				'name'     => $slug.'_border_type_hover',
				'label'    => 'Border Type',
				'selector' => '{{WRAPPER}} .anant-wishlist-main .product-cart-btn a:hover',
			]
		);

		$this->end_controls_tab(); 
		$this->end_controls_tabs();

		$this->add_responsive_control(
			$slug.'_width',
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
					'{{WRAPPER}} .anant-wishlist-main .product-cart-btn a' => 'min-width: {{SIZE}}{{UNIT}};',
				],
			]
		);

		anant_typography_control(
			$this,
			[
				'name'     => $slug.'_typography',
				'label'    => 'Typography',
				'selector' => '{{WRAPPER}}  .anant-wishlist-main .product-cart-btn a',
			]
		);

		anant_border_radius_control(
			$this,
			[
				'key'       => $slug.'_border_radius',
				'label'     => 'Border Radius',
				'selectors' => [
					'{{WRAPPER}} .anant-wishlist-main .product-cart-btn a' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
					'{{WRAPPER}} .anant-wishlist-main .product-cart-btn a' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
					'{{WRAPPER}} .anant-wishlist-main .product-cart-btn a' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		anant_box_shadow_control(
			$this,
			[
				'key'      => $slug.'_box_shadow',
				'label'    => 'Box Shadow',
				'selector' => '{{WRAPPER}}  .anant-wishlist-main .product-cart-btn a',
			]
		);

		$this->end_controls_section();

	}

	public function render() {
		$settings = $this->get_settings_for_display();

        if (is_user_logged_in()) {
            $user_id = get_current_user_id();
            $wishlist = get_user_meta($user_id, '_user_wishlist', true); 
			
			if(empty($wishlist)){
				$wishlist = [0];
			} ?>
    
            <div class="anant-wishlist-main" >
                <table class="enn-table-manage-list table-bordered ">
                    <thead>
                        <tr>
                            <th class="product-remove"></th>
                            <th class="product-thumbnail"></th>
                            <th class="product-name"><h4>Product Name</h4class=></th>
                            <th class="product-price"><h4>Price</h4> </th>
                            <th class="product-stock"> <h4>Stock Status</h4> </th>
                            <th class="product-btn"></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php 
                            if (!empty($wishlist) && (count($wishlist) === 1 && reset($wishlist) === 0) === false) {
                                foreach ($wishlist as $product_id) {
                                    if($product_id !== 0){}
                                    echo '<tr class="wishlist_item">';
                                    $product = wc_get_product($product_id);
                                    if ($product) { 

                                        $image_id = $product->get_image_id();
                                        $image_url = wp_get_attachment_image_url($image_id, 'full');

                                        $availability = $product->get_availability();
                                        $status = $product->get_stock_status();
                                        $backorder = $product->get_backorders(); ?>
                                        
                                        <td class="product-remove">
                                            <button type="button" class="product-remover" data-product_id="<?php echo esc_attr($product->get_id()); ?>" title="Remove"><i class="fas fa-times"></i></button>
                                        </td>

                                        <td class="product-thumbnail">
                                            <a href="<?php echo esc_url($product->get_permalink()); ?>"><img src="<?php echo esc_attr($image_url); ?>" class="attachment-enn_thumbnail " alt=""></a>
                                        </td>

                                        <td class="product-name">
                                            <a href="<?php echo esc_url($product->get_permalink()); ?>"><?php echo esc_html($product->get_title()); ?></a>
                                        </td>

                                        <td class="product-price">
                                            <?php echo $product->get_price_html(); ?>
                                        </td>

                                        <td class="product-stock">
                                            <?php 
                                                if( $status === 'instock' && $backorder == 'no' ){
                                                    echo '<div class="anant-product-stock '.esc_attr( $availability['class'] ).'"><span>'.esc_html__('In Stock','anant-addons-for-elementor').'</span></div>';
                                                }else if($status === 'instock' && ( $backorder == 'yes' || $backorder == 'notify' )){
                                                    echo '<div class="anant-product-stock '.esc_attr( $availability['class'] ).'"><span>'.esc_html__('Back Orders','anant-addons-for-elementor').'</span></div>';
                                                }else{
                                                    echo '<div class="anant-product-stock '.esc_attr( $availability['class'] ).'"><span>'.esc_html__('Out Of Stocks','anant-addons-for-elementor').'</span></div>';
                                                } 
                                            ?>				
                                        </td>

                                        <td class="product-cart-btn">
                                            <?php if( $status !== 'outofstock' ){ ?> 
                                                <a href="?add-to-cart=<?php echo esc_attr($product->get_id()); ?>" class="product-cart-btn product_type_simple add_to_cart_button ajax_add_to_cart anant_add_to_cart_btn added" rel="nofollow">Add to cart</a>
                                            <?php } ?>
                                        </td>

                                    <?php }
                                    echo '</tr>';
                                }
                            } else {
                                echo '<tr class="no-wish-id"><td colspan="6">No products added to the wishlist.</td></tr>';
                            } ?>
                    </tbody>
                </table>
            </div>
        <?php 
        } else {
            echo '<p>Please log in to view your wishlist.</p>';
        }

	}
}