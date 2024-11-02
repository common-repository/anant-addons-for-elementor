<?php
namespace AnantAddons;

use Elementor\Controls_Manager;
use Elementor\Group_Control_Background;
use Elementor\Group_Control_Text_Stroke;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class AnantProductRating extends \Elementor\Widget_Base {
	
	public function get_name() {
		return 'anant-product-rating';
	}

	public function get_title() {
		return esc_html__( 'Product Rating', 'anant-addons-for-elementor' );
	}

	public function get_icon() {
		return 'ant-icon eicon-product-rating';
	}

	public function get_categories() {
		return [ 'anant-sng-woo-elements' ];
	}

	public function get_keywords() {
		return [ 'woocommerce', 'product-rating', 'product', 'rating' ];
	}


	protected function register_controls() {

		$this->start_controls_section(
			'section_product_title',
			[
				'label' => esc_html__( 'General', 'anant-addons-for-elementor' ),
				'tab' => Controls_Manager::TAB_CONTENT,
			]
		);

        anant_switcher_control(
			$this,
			[
				'key'       => 'star_text_toggle',
				'label'     => 'Text On/Off',
				'on_label'  => 'Yes',
				'off_label' => 'No',
				'default'	=> 'Yes',

			]
		);
		
		$this->add_control(
			'star_text', 
			[
				'label' => esc_html__( 'Custom Text', 'anant-addons-for-elementor' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => esc_html__( 'Customers Review' , 'anant-addons-for-elementor' ),
				'label_block' => true,
				'condition'   => [
					'star_text_toggle' => 'yes',
				],
			]
		);

		$this->add_control(
			'star_text_position',
			[
				'label' => esc_html__( 'Text Position', 'anant-addons-for-elementor' ),
				'type' => Controls_Manager::SELECT,
				'options' => [
					'left' => 'Left',
					'right' => 'Right',
				],
				'default' => 'right',
				'condition'   => [
					'star_text_toggle' => 'yes',
				],
			]
		);

		$this->add_control(
			'star_text_tag',
			[
				'label' => esc_html__( 'Text HTML Tag', 'anant-addons-for-elementor' ),
				'type' => Controls_Manager::SELECT,
				'options' => [
					'h1' => 'H1',
					'h2' => 'H2',
					'h3' => 'H3',
					'h4' => 'H4',
					'h5' => 'H5',
					'h6' => 'H6',
					'div' => 'div',
					'span' => 'span',
					'P' => 'p'
				],
				'default' => 'h6',
				'condition'   => [
					'star_text_toggle' => 'yes',
				],
			]
		);

		$this->add_responsive_control(
            'star_n_text_align',
            [
                'label' => esc_html__( 'Alignment', 'anant-addons-for-elementor' ),
                'type' => Controls_Manager::CHOOSE,
                'default' => 'start',
                'label_block' => false,
                'options' => [
					'start'    => [
						'title' => __( 'Left', 'anant-addons-for-elementor' ),
						'icon' => 'eicon-text-align-left',
					],
					'center' => [
						'title' => __( 'Center', 'anant-addons-for-elementor' ),
						'icon' => 'eicon-text-align-center',
					],
					'end' => [
						'title' => __( 'Right', 'anant-addons-for-elementor' ),
						'icon' => 'eicon-text-align-right',
					],
                ],
				'selectors' => [
					'{{WRAPPER}} .anant-single-rating' => 'justify-content: {{VALUE}}',
				],
            ]
        );

		$this->end_controls_section(); // End Controls Section

		anant_pro_promotion_controls($this);

		$this->start_controls_section(
			'section_style_star',
			[
				'label' => esc_html__( 'Stars', 'anant-addons-for-elementor' ),
				'tab' => Controls_Manager::TAB_STYLE,
				'show_label' => false,
			]
		);

		anant_color_control(
			$this,
			[
				'key'       => 'star_color',
				'label'     => esc_html__( 'Star Color', 'anant-addons-for-elementor' ),
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .ant-rating-icons .fa-star' => 'color: {{VALUE}}',
					'{{WRAPPER}} .ant-rating-icons .fa-star-half-alt' => 'color: {{VALUE}}',
				],
			]
		);

		anant_color_control(
			$this,
			[
				'key'       => 'empty_star_color',
				'label'     => esc_html__( 'Empty Star Color', 'anant-addons-for-elementor' ),
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .ant-rating-icons .far.fa-star' => 'color: {{VALUE}}',
				],
			]
		);

		$this->add_control(
			'star_size',
			[
				'label' => __( 'Star Size', 'anant-addons-for-elementor' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px', 'em' ],
				'default' => [
					'unit' => 'px',
				],
				'range' => [
					'em' => [
						'min' => 0,
						'max' => 4,
						'step' => 0.1,
					],
					'px' => [
						'min' => 0,
						'max' => 50,
						'step' => 1,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .ant-rating-icons .fas:before' => 'font-size: {{SIZE}}{{UNIT}}',
					'{{WRAPPER}} .ant-rating-icons .far:before' => 'font-size: {{SIZE}}{{UNIT}}',
				],
			]
		);

		$this->add_control(
			'space_between',
			[
				'label' => __( 'Space Between', 'anant-addons-for-elementor' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px', 'em' ],
				'default' => [
					'unit' => 'px',
				],
				'range' => [
					'em' => [
						'min' => 0,
						'max' => 4,
						'step' => 0.1,
					],
					'px' => [
						'min' => 0,
						'max' => 50,
						'step' => 1,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .ant-rating-icons  .anant-star-rating i' => 'margin-right: {{SIZE}}{{UNIT}}',
					'{{WRAPPER}} .ant-rating-icons  .anant-star-rating i' => 'margin-left: {{SIZE}}{{UNIT}}',
				],
			]
		);

		$this->add_responsive_control(
			'star_margin',
			[
				'label'     => esc_html__('Margin', 'anant-addons-for-elementor'),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .ant-rating-icons' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_style_title',
			[
				'label' => esc_html__( 'Text', 'anant-addons-for-elementor' ),
				'tab' => Controls_Manager::TAB_STYLE,
				'show_label' => false,
			]
		);

		anant_color_control(
			$this,
			[
				'key'       => 'text_color',
				'label'     => esc_html__( 'Color', 'anant-addons-for-elementor' ),
				'default' => '#222222',
				'selectors' => [
					'{{WRAPPER}} .reveiw .star-text ' => 'color: {{VALUE}}',
				],
			]
		);

		anant_typography_control(
			$this,
			[
				'name'     => 'text_typography',
				'label'    => 'Typography',
				'selector' => '{{WRAPPER}} .reveiw .star-text ',
			]
		);
		anant_text_shadow_control(
			$this,
			[
				'key'      => 'text_shadow',
				'label'    => 'Text Shadow',
				'selector' => '{{WRAPPER}} .reveiw .star-text',
                'separator' => 'after',
			]
		);

		anant_text_stroke_control(
			$this,
			[
				'key'      => 'text_stroke',
				'label'    => 'Text Stroke',
				'selector' => '{{WRAPPER}} .reveiw .star-text',
                'separator' => 'after',
			]
		);

		$this->add_responsive_control(
			'star_text_margin',
			[
				'label'     => esc_html__('Margin', 'anant-addons-for-elementor'),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .reveiw' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->end_controls_section();
	}

	protected function render() {
		$settings = $this->get_settings();
		$current_url = $_SERVER['REQUEST_URI'];
		if ( isset( $settings['star_text_toggle'] ) && ! empty( $settings['star_text_toggle'] ) && $settings['star_text_toggle'] === 'yes' ) {
			$star_text = true;
		}else{
			$star_text = false;
		}
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
		$rating_count = $product->get_rating_count();
		$review_count = $product->get_review_count();
		$average      = $product->get_average_rating(); 
		?>

		<div class="anant-single-rating">
			<?php if($settings['star_text_position'] === 'left') { ?>
				<?php if($star_text !== false) { ?>
						<div class="reveiw">
							<?php if( $review_count !== 0){ ?>
								<<?php echo esc_html( $settings['star_text_tag'] ); ?> class="star-text"><?php echo esc_html($settings['star_text'])?> (<?php echo esc_html($review_count)?>)</<?php echo esc_html( $settings['star_text_tag'] ); ?>>
							<?php } else { ?>
								<<?php echo esc_html( $settings['star_text_tag'] ) ?> class="star-text">No Rating Available</<?php echo esc_html( $settings['star_text_tag'] ) ?>>
							<?php } ?>
						</div>
				<?php } ?>
			<?php } ?>
						<?php
						if ('no' !== get_option('woocommerce_enable_review_rating')) {
							
							$rating = $average;
							$round_next_rating = ceil($rating);
							$round_prev_rating = floor($rating); ?>
						<div class="ant-rating-icons ">
						<?php 
							if(is_numeric( $rating ) && floor( $rating ) != $rating){
								?><div class="anant-star-rating"><?php
								for ($i = 1; $i <= 5; $i++) {
									if( $i <= $round_prev_rating){
										?><i class="fas fa-star"></i><?php
									}else if($i <= $round_next_rating){
										?><i class="fas fa-star-half-alt"></i><?php
									}else{
										?><i class="far fa-star"></i><?php
									}
								}
								?></div><?php
							}elseif($rating == 0 || $rating == '0' ){
								?><div class="anant-star-rating"><?php
								$num_iterations = 5;
								for ($i = 1; $i <= $num_iterations; $i++) {
									?><i class="far fa-star"></i><?php
								}
								?></div><?php
							}else{
								?><div class="anant-star-rating"><?php
								for ($i = 1; $i <= 5; $i++) {
									if( $i <= $round_next_rating){
										?><i class="fas fa-star"></i><?php
									}else{
										?><i class="far fa-star"></i><?php
									}
								}
								?></div><?php
							} ?> 
						</div>
						<?php if($settings['star_text_position'] === 'right') { ?>
							<?php if($star_text !== false) { ?>
									<div class="reveiw">
										<?php if( $review_count !== 0){ ?>
											<<?php echo esc_html( $settings['star_text_tag'] ) ?> class="star-text">(<?php echo esc_html($review_count)?>) <?php echo esc_html($settings['star_text'])?></<?php echo esc_html( $settings['star_text_tag'] ) ?>>
										<?php } else { ?>
											<<?php echo esc_html( $settings['star_text_tag'] ) ?> class="star-text">No Rating Available</<?php echo esc_html( $settings['star_text_tag'] ) ?>>
										<?php } ?>
									</div>
							<?php } ?>
						<?php } ?>
			<?php } ?>
		</div>			
	<?php }	
}