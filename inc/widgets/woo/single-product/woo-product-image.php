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
use Elementor\Group_Control_Css_Filter;
use Elementor\Group_Control_Box_Shadow;

class AnantProductImage extends \Elementor\Widget_Base {

	private $product_image_card_inner_class = 'anant-product-image-inner-card';
	private $product_image_one_class = 'anant-product-image-one';
	private $product_image_two_class = 'anant-product-image-two';
	private $product_image_three_class = 'anant-product-image-three';
	private $product_image_separator_class = 'anant-product-image-separator';

	public function get_name() {
		return 'anant-product-image';
	}

	public function get_title() {
		return __( 'Product Image', 'anant-addons-for-elementor' );
	}

	public function get_categories() {
		return [ 'anant-sng-woo-elements' ];
	}

	public function get_icon() {
		return 'ant-icon eicon-product-images';
	}

	public function get_style_depends() {
		return [
			'anant-widget-css',
		];
	}

	public function get_script_depends() {
		return [
			'anant-custom-js',
		];
	}

	public function get_keywords() {
		return [
			'image',
			'product image', 
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
			'slides_template_type',
			[
				'label'       => esc_html__( 'Slides Alignment', 'anant-addons-for-elementor' ),
				'placeholder' => esc_html__( 'Choose Slides Alignment from Here', 'anant-addons-for-elementor' ),
				'type'        => \Elementor\Controls_Manager::SELECT,
				'default'     => 'horizontal_slide',
				'options'     => [
					'horizontal_slide' => esc_html__( 'Horizontal', 'anant-addons-for-elementor' ),
					'vertical_slide'   => esc_html__( 'Vertical (Pro)', 'anant-addons-for-elementor' ),
				],
			]
		);
		
		$this->end_controls_section();

		$this->start_controls_section(
			'slider',
			[
				'label' => __( 'Slider Settings', 'anant-addons-for-elementor'),
				'tab'   => Controls_Manager::TAB_CONTENT,
			]
		);

		anant_switcher_control(
			$this,
			[
				'key'       => 'show_navigation_arrow',
				'label'     => 'Show Navigation Arrow',
				'on_label'  => 'Yes',
				'off_label' => 'No',
				'default'   => 'yes',
			]
		);

		anant_switcher_control(
			$this,
			[
				'key'       => 'autoplay',
				'label'     => 'AutoPlay',
				'on_label'  => 'Yes',
				'off_label' => 'No',
				'default'   => 'no',
			]
		);

		anant_number_control(
			$this,
			[
				'key'         => 'autoplay_speed',
				'label'       => 'AutoPlay Speed',
				'placeholder' => '',
				'min'         => 1,
				'default'     => 3000,
				'condition'   => [
					'autoplay' => 'yes',
				],
			]
		);

		anant_number_control(
			$this,
			[
				'key'         => 'transition_between_slides',
				'label'       => 'Slide Switch Speed',
				'placeholder' => '',
				'min'         => 1,
				'default'     => 1000,
			]
		);

		anant_switcher_control(
			$this,
			[
				'key'       => 'loop',
				'label'     => 'Loop',
				'on_label'  => 'Yes',
				'off_label' => 'No',
				'default'   => 'no',
			]
		);

		$this->end_controls_section();

		anant_pro_promotion_controls($this);

		$this->start_controls_section(
			'main_image_settings',
			[
				'label' => __( 'Main Image Settings', 'anant-addons-for-elementor' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);

		$slug = 'product_image_main_image';

		$this->add_responsive_control(
			$slug.'_width',
			[
				'label' => esc_html__( 'Width', 'anant-addons-for-elementor' ),
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
				'size_units' => [ 'px', '%', 'vw' ],
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
					'{{WRAPPER}} .anant-product-image .ant-single-imageBox .anant-product-image-main-img .swiper-slide-active .ant-single-main-img' => 'width: {{SIZE}}{{UNIT}}',
				],
			]
		);

		$this->add_responsive_control(
			$slug.'_height',
			[
				'label' => esc_html__( 'Height', 'anant-addons-for-elementor' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px', '%', 'vh' ],
				'range' => [
					'px' => [
						'min' => 1,
						'max' => 1500,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .anant-product-image .ant-single-imageBox .anant-product-image-main-img .swiper-slide' => 'height: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_control(
			$slug.'_opacity',
			[
				'label' => esc_html__( 'Opacity', 'anant-addons-for-elementor' ),
				'type' => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'max' => 1,
						'min' => 0.10,
						'step' => 0.01,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .ant-single-imageBox .anant-product-image-main-img .swiper-slide-active' => 'opacity: {{SIZE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Css_Filter::get_type(),
			[
				'name' => $slug.'_css_filters',
				'selector' => '{{WRAPPER}} .ant-single-imageBox .anant-product-image-main-img .swiper-slide-active',
			]
		);

		anant_border_control(
			$this,
			[
				'name'     => $slug.'_border_type',
				'label'    => 'Border Type',
				'selector' => '{{WRAPPER}} .ant-single-imageBox .anant-product-image-main-img .swiper-slide-active',
			]
		);

		anant_border_radius_control(
			$this,
			[
				'key'       => $slug.'_border_radius',
				'label'     => 'Border Radius',
				'selectors' => [
					'{{WRAPPER}} .ant-single-imageBox .anant-product-image-main-img .swiper-slide-active' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
					'{{WRAPPER}} .ant-single-imageBox .anant-product-image-main-img .swiper-slide-active' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		anant_box_shadow_control(
			$this,
			[
				'key'      => $slug.'_box_shadow',
				'label'    => 'Box Shadow',
				'selector' => '{{WRAPPER}}  .ant-single-imageBox .anant-product-image-main-img .swiper-slide-active',
			]
		);

		$this->end_controls_section();
				
		// Decrease Button Button
		$this->start_controls_section(
			'small_image_settings',
			[
				'label' => __('Small Image Settings', 'anant-addons-for-elementor' ),
				'tab'   => Controls_Manager::TAB_STYLE, 
			]
		);
		
		$slug = 'product_image_small_image';

		$this->start_controls_tabs( $slug.'_tabs' );

		$this->start_controls_tab(
			$slug.'_normal_style',
			[
				'label' => __( 'Normal', 'anant-addons-for-elementor' ),
			]
		);

		$this->add_responsive_control(
			$slug.'_width',
			[
				'label' => esc_html__( 'Width', 'anant-addons-for-elementor' ),
				'type' => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'min' => 1,
						'max' => 500,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .ant-single-imageBox .anant-product-image-gallery-img .ant-small-single-img' => 'width: {{SIZE}}{{UNIT}}!important;',
				],
			]
		);

		$this->add_responsive_control(
			$slug.'_height',
			[
				'label' => esc_html__( 'Height', 'anant-addons-for-elementor' ),
				'type' => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'min' => 1,
						'max' => 500,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .ant-single-imageBox .anant-product-image-gallery-img .ant-small-single-img' => 'height: {{SIZE}}{{UNIT}}!important;',
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
					'{{WRAPPER}} .ant-single-imageBox .anant-product-image-gallery-img .ant-small-single-img' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
					'{{WRAPPER}} .ant-single-imageBox .anant-product-image-gallery-img .ant-small-single-img' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_control(
			$slug.'_opacity',
			[
				'label' => esc_html__( 'Opacity', 'anant-addons-for-elementor' ),
				'type' => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'max' => 1,
						'min' => 0.10,
						'step' => 0.01,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .ant-single-imageBox .anant-product-image-gallery-img .ant-single-gallery-img' => 'opacity: {{SIZE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Css_Filter::get_type(),
			[
				'name' => $slug.'_css_filters',
				'selector' => '{{WRAPPER}} .ant-single-imageBox .anant-product-image-gallery-img .ant-single-gallery-img',
			]
		);	

		anant_border_control(
			$this,
			[
				'name'     => $slug.'_border_type',
				'label'    => 'Border Type',
				'selector' => '{{WRAPPER}} .ant-single-imageBox .anant-product-image-gallery-img .ant-small-single-img',
			]
		);

		anant_border_radius_control(
			$this,
			[
				'key'       => $slug.'_border_radius',
				'label'     => 'Border Radius',
				'selectors' => [
					'{{WRAPPER}} .ant-single-imageBox .anant-product-image-gallery-img .ant-small-single-img' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					'{{WRAPPER}} .ant-single-imageBox .anant-product-image-gallery-img .ant-small-single-img .ant-single-gallery-img' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->end_controls_tab();
		
		$slug = 'product_image_small_image_hover';

		$this->start_controls_tab(
			$slug.'_style_hover',
			[
				'label' => __( 'Hover / Active', 'anant-addons-for-elementor' ),

			]
		);	

		anant_border_control(
			$this,
			[
				'name'     => $slug.'_border_type',
				'label'    => 'Border Type',
				'selector' => '{{WRAPPER}} .ant-single-imageBox .anant-product-image-gallery-img .ant-small-single-img.swiper-slide-thumb-active, {{WRAPPER}} .ant-single-imageBox .anant-product-image-gallery-img .ant-small-single-img:hover',
			]
		);

		anant_border_radius_control(
			$this,
			[
				'key'       => $slug.'_border_radius',
				'label'     => 'Border Radius',
				'selectors' => [
					'{{WRAPPER}} .ant-single-imageBox .anant-product-image-gallery-img .ant-small-single-img.swiper-slide-thumb-active, {{WRAPPER}} .ant-single-imageBox .anant-product-image-gallery-img .ant-small-single-img.swiper-slide-thumb-active .ant-single-gallery-img' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					'{{WRAPPER}} .ant-single-imageBox .anant-product-image-gallery-img .ant-small-single-img:hover, {{WRAPPER}} .ant-single-imageBox .anant-product-image-gallery-img .ant-small-single-img:hover .ant-single-gallery-img' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->end_controls_tab();
		$this->end_controls_tabs(); 

		$this->end_controls_section();


		//  Navigation styles
		$this->start_controls_section(
			'section_navi_arrow_style',
			[
				'label'     => __( 'Navigation Style', 'anant-addons-for-elementor' ),
				'tab'       => Controls_Manager::TAB_STYLE,
			],
		);

		$this->start_controls_tabs( 'navi_arrow_btn_tabs' );

		$this->start_controls_tab(
			'navi_arrow_btn_normal_style',
			[
				'label' => __( 'Normal', 'anant-addons-for-elementor' ),

			]
		);

		anant_color_control(
			$this,
			[
				'key'       => 'navi_arrow_color',
				'label'     => 'Color',
				'selectors' => [
					'{{WRAPPER}} .swiper-button-prev' => 'color: {{VALUE}};background-image: none;',
					'{{WRAPPER}} .swiper-button-next' => 'color: {{VALUE}};background-image: none;',
				],
			]
		);

		anant_color_control(
			$this,
			[
				'key'       => 'navi_arrow_bg_color',
				'label'     => 'Background Color',
				'selectors' => [
					'{{WRAPPER}} .swiper-button-prev' => 'background-color: {{VALUE}};background-image: none;',
					'{{WRAPPER}} .swiper-button-next' => 'background-color: {{VALUE}};background-image: none;',
				],
			]
		);

		anant_border_control(
			$this,
			[
				'name'     => 'navi_arrow_border_type',
				'label'    => 'Border Type',
				'selector' => '{{WRAPPER}} .anant_slider_wrapper  .swiper-button-prev,{{WRAPPER}} .anant_slider_wrapper  .swiper-button-next',
			]
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
			'navi_arrow_btn_style_hover',
			[
				'label' => __( 'Hover', 'anant-addons-for-elementor' ),

			]
		);

		anant_color_control(
			$this,
			[
				'key'       => 'navi_arrow_color_hover',
				'label'     => 'Color',
				'selectors' => [
					'{{WRAPPER}} .swiper-button-prev:hover' => 'color: {{VALUE}};background-image: none;',
					'{{WRAPPER}} .swiper-button-next:hover' => 'color: {{VALUE}};background-image: none;',
				],
			]
		);

		anant_color_control(
			$this,
			[
				'key'       => 'navi_arrow_bg_color_hover',
				'label'     => 'Background Color',
				'selectors' => [
					'{{WRAPPER}} .swiper-button-prev:hover' => 'background-color: {{VALUE}};background-image: none;',
					'{{WRAPPER}} .swiper-button-next:hover' => 'background-color: {{VALUE}};background-image: none;',
				],
			]
		);

		anant_border_control(
			$this,
			[
				'name'     => 'navi_arrow_border_type_hover',
				'label'    => 'Border Type',
				'selector' => '{{WRAPPER}} .anant_slider_wrapper  .swiper-button-prev:hover,{{WRAPPER}} .anant_slider_wrapper  .swiper-button-next:hover',
			]
		);

		$this->end_controls_tab();

		$this->end_controls_tabs();

		$this->add_responsive_control(
			'navi_arrow_size',
			[
				'label'           => esc_html__( 'Arrow Size', 'anant-addons-for-elementor' ),
				'type'            => Controls_Manager::SLIDER,
				'size_units'      => [ 'px', '%' ],
				'range'           => [
					'px' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'default_desktop' => [
					'size' => 30,
					'unit' => 'px',
				],
				'tablet_default'  => [
					'size' => 20,
					'unit' => 'px',
				],
				'mobile_default'  => [
					'size' => 10,
					'unit' => 'px',
				],
				'separator'       => 'before',
				'selectors'       => [
					'{{WRAPPER}} .swiper-button-prev::after' => 'font-size: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .swiper-button-next::after' => 'font-size: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'navi_arrow_width',
			[
				'label'           => esc_html__( 'Arrow Width', 'anant-addons-for-elementor' ),
				'type'            => Controls_Manager::SLIDER,
				'size_units'      => [ 'px', '%' ],
				'range'           => [
					'px' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'default_desktop' => [
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
					'{{WRAPPER}} .swiper-button-prev' => 'width: {{SIZE}}{{UNIT}}; height: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .swiper-button-next' => 'width: {{SIZE}}{{UNIT}}; height: {{SIZE}}{{UNIT}};',
				],
			]
		);
		
		anant_border_radius_control(
			$this,
			[
				'key'       => 'navi_arrow_border_radius',
				'label'     => 'Border Radius',
				'selectors' => [
					'{{WRAPPER}} .anant_slider_wrapper  .swiper-button-prev' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					'{{WRAPPER}} .anant_slider_wrapper  .swiper-button-next' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->end_controls_section();
		//  Navigation styles ends
	}

	protected function render() {
		$settings = $this->get_settings_for_display();
		$current_url = $_SERVER['REQUEST_URI'];
		if ( ( class_exists( "\Elementor\Plugin" ) && \Elementor\Plugin::$instance->editor->is_edit_mode() ) ||  ( class_exists( "\Elementor\Plugin" ) && isset( $_GET['preview'] ) && isset( $_GET['preview_id'] ) && $_GET['preview'] == true ) || ( strpos($current_url, 'anant-header-footer') !== false && get_post_type() == 'anant-header-footer' ) ) {
			$post_id = get_the_ID();
        	$product_id = \Elementor\Plugin::$instance->documents->get($post_id, false)->get_settings('demo_product_id');
            $product = wc_get_product( $product_id );
            if ( ! $product ) {
                return;
            }
        }else{
            $product_id = get_the_ID();
            $product = wc_get_product($product_id);
			
            if ( ! $product ) {
                return;
            }
		}

		$image_id = $product->get_image_id();
		$image_url = wp_get_attachment_image_url($image_id, 'full');
		$gallary_images_ids = $product->get_gallery_image_ids(); 
		$slides_align = $settings['slides_template_type']; 
		$auto = $settings['autoplay']; 
		$speed = $settings['autoplay_speed']; 
		$switch_speed = $settings['transition_between_slides']; 
		$loop = $settings['loop']; 
		$i = 0;  ?>
	<div class="anant-product-image " zoom-type="inner" slide-align="<?php esc_attr_e($slides_align); ?>" auto="<?php esc_attr_e($auto); ?>" speed="<?php esc_attr_e($speed); ?>" switch-speed="<?php esc_attr_e($switch_speed); ?>" swipe-loop="<?php esc_attr_e($loop); ?>" >
      <div class="ant-single-imageBox anant_slider_wrapper inner <?php esc_attr_e($slides_align); ?>">

	  <?php if($slides_align === 'horizontal_slide') { ?>
		<div class="swiper-container swiper anant-product-image-main-img">
            <div class="swiper-wrapper">
                <div class="swiper-slide ant-big-single-img" imageScale="1.5">
                  	<div class="ant-single-main-img" style="background-image: url('<?php esc_attr_e($image_url); ?>');"></div>
                </div>  
			<?php if(!empty($gallary_images_ids)) { ?>
				<?php foreach($gallary_images_ids as $img_id) { $img_url = wp_get_attachment_image_url($img_id, 'full'); ?>
				    <div class="swiper-slide ant-big-single-img" imageScale="1.5">
                  		<div class="ant-single-main-img" style="background-image: url('<?php esc_attr_e($img_url); ?>');"></div>
                	</div>    
				<?php } ?>
			<?php } ?>
            </div>
		<?php } ?>

          </div>
		<?php if($slides_align === 'horizontal_slide' && $settings['show_navigation_arrow'] === 'yes') { ?>	    
			<div class="ant-single-img-navigation">
				<div class="swiper-button-next"></div>
				<div class="swiper-button-prev"></div>
			</div> 
		<?php } ?>
         <?php if($slides_align === 'horizontal_slide') { ?>
          <div class="swiper-container swiper horizontal anant-product-image-gallery-img">
            <div class="swiper-wrapper">
			<?php if($i === 0) { ?>
                <div class="swiper-slide ant-small-single-img">
                  <div class="ant-single-gallery-img" style="background-image: url('<?php esc_attr_e($image_url); ?>');"></div>
                </div>  
			<?php } ?>
			<?php if(!empty($gallary_images_ids)) { ?>
				<?php foreach($gallary_images_ids as $img_id) { $img_url = wp_get_attachment_image_url($img_id, 'full'); ?>
                <div class="swiper-slide ant-small-single-img">
                  <div class="ant-single-gallery-img" style="background-image: url('<?php esc_attr_e($img_url); ?>');"></div>
                </div>  
				<?php } ?>
			<?php } ?>
            </div>
          </div>
		  <?php } ?>

      </div> 

    </div>
	<?php }
}