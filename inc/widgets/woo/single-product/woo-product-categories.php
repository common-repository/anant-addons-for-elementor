<?php
namespace AnantAddons;

use Elementor\Controls_Manager;
use Elementor\Group_Control_Background;
use Elementor\Group_Control_Text_Stroke;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class AnantProductCategories extends \Elementor\Widget_Base {
	
	public function get_name() {
		return 'anant-product-categories';
	}

	public function get_title() {
		return esc_html__( 'Product Categories', 'anant-addons-for-elementor' );
	}

	public function get_icon() {
		return 'ant-icon eicon-product-categories';
	}

	public function get_categories() {
		return [ 'anant-sng-woo-elements' ];
	}

	public function get_keywords() {
		return [ 'woocommerce', 'product-categories', 'product', 'categories' ];
	}


	protected function register_controls() {

		// Tab: Content ==============
		// Section: General ----------
		$this->start_controls_section(
			'section_product_categories',
			[
				'label' => esc_html__( 'General', 'anant-addons-for-elementor' ),
				'tab' => Controls_Manager::TAB_CONTENT,
			]
		);
		anant_switcher_control(
			$this,
			[
				'key'       => 'show_cat_title',
				'label'     => 'Show "Category" Title',
				'on_label'  => 'Yes',
				'off_label' => 'No',
				'default' => 'yes'
			]
		);
		$this->add_responsive_control(
            'product_categories_align',
            [
                'label' => esc_html__( 'Alignment', 'anant-addons-for-elementor' ),
                'type' => Controls_Manager::CHOOSE,
                'default' => 'left',
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
					'{{WRAPPER}} .anant-product-cate' => 'justify-content: {{VALUE}}',
				],
            ]
        );

		$this->end_controls_section(); // End Controls Section

		$this->start_controls_section(
			'section_style_category',
			[
				'label' => esc_html__( 'Category', 'anant-addons-for-elementor' ),
				'tab' => Controls_Manager::TAB_STYLE,
				'show_label' => false,
				'condition' => [
					'show_cat_title' => 'yes',
				]
			]
		);

		anant_color_control(
			$this,
			[
				'key'       => 'category_color',
				'label'     => esc_html__( 'Color', 'anant-addons-for-elementor' ),
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .ant-info-list' => 'color: {{VALUE}}',
				],
			]
		);

		anant_typography_control(
			$this,
			[
				'name'     => 'category_typography',
				'label'    => 'Typography',
				'selector' => '{{WRAPPER}} .ant-info-list',
			]
		);

		anant_text_shadow_control(
			$this,
			[
				'key'      => 'category_shadow',
				'label'    => 'Text Shadow',
				'selector' => '{{WRAPPER}} .ant-info-list',
                'separator' => 'after',
			]
		);

		anant_text_stroke_control(
			$this,
			[
				'key'      => 'text_stroke',
				'label'    => 'Text Stroke',
				'selector' => '{{WRAPPER}} .ant-info-list',
                'separator' => 'after',
			]
		);

		$this->add_responsive_control(
			'category_margin',
			[
				'label'     => esc_html__('Margin', 'anant-addons-for-elementor'),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .ant-info-list' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->end_controls_section(); // End Controls Section

		anant_pro_promotion_controls($this);

		$this->start_controls_section(
			'section_style_category_term',
			[
				'label' => esc_html__( 'Category Terms', 'anant-addons-for-elementor' ),
				'tab' => Controls_Manager::TAB_STYLE,
				'show_label' => false,
			]
		);

		anant_color_control(
			$this,
			[
				'key'       => 'category_term_color',
				'label'     => esc_html__( 'Color', 'anant-addons-for-elementor' ),
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .single-cat' => 'color: {{VALUE}}',
				],
			]
		);
		
		anant_color_control(
			$this,
			[
				'key'       => 'category_term_hover_color',
				'label'     => esc_html__( 'Hover Color', 'anant-addons-for-elementor' ),
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .single-cat:hover' => 'color: {{VALUE}}',
				],
			]
		);

		anant_border_control(
			$this,
			[
				'name'     => 'category_term_hover_border_type',
				'label'    => 'Border Type',
				'selector' => '{{WRAPPER}} .single-cat:hover',
			]
		);

		anant_typography_control(
			$this,
			[
				'name'     => 'category_term_typography',
				'label'    => 'Typography',
				'selector' => '{{WRAPPER}} .single-cat',
			]
		);


		anant_border_control(
			$this,
			[
				'name'     => 'category_term_border_type',
				'label'    => 'Border Type',
				'selector' => '{{WRAPPER}} .single-cat',
			]
		);

		anant_border_radius_control(
			$this,
			[
				'key'       => 'category_term_border_radius',
				'label'     => 'Border Radius',
				'selectors' => [
					'{{WRAPPER}} .single-cat' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'category_term_padding',
			[
				'label'     => esc_html__('Padding', 'anant-addons-for-elementor'),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .single-cat' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'category_term_margin',
			[
				'label'     => esc_html__('Margin', 'anant-addons-for-elementor'),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .single-cat' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->end_controls_section();
	}

	protected function render() {
		$settings = $this->get_settings();
		$current_url = $_SERVER['REQUEST_URI'];
		$show_cat_title = $settings['show_cat_title'];
		
        if ( ( class_exists( "\Elementor\Plugin" ) && \Elementor\Plugin::$instance->editor->is_edit_mode() ) ||  ( class_exists( "\Elementor\Plugin" ) && isset( $_GET['preview'] ) && isset( $_GET['preview_id'] ) && $_GET['preview'] == true ) || ( strpos($current_url, 'anant-header-footer') !== false && get_post_type() == 'anant-header-footer' ) ) {
			$post_id = get_the_ID();
        	$product_id = \Elementor\Plugin::$instance->documents->get($post_id, false)->get_settings('demo_product_id');
			$terms = wp_get_object_terms($product_id, 'product_cat');
            $product = wc_get_product( $product_id );
            if ( ! $product ) {
                return;
            }
    
        }else{
            $product_id = get_the_ID();
			$terms = wp_get_object_terms($product_id, 'product_cat');
            $product = wc_get_product($product_id);
            if ( ! $product ) {
                return;
            }
		} ?>

		<div class="anant-product-cate"> 
			<?php if (!empty($terms) && !is_wp_error($terms)) {
			if($show_cat_title == 'yes'){ ?>
			<span class="ant-info-list"><?php echo (count($terms) == 1) ?  'Category:' : 'Categories:'; ?></span> 
				<?php } foreach ($terms as $term) {
					$term_link = get_term_link($term); 
					echo '<a href="' . esc_url($term_link) . '" class="single-cat">'.$term->name.'</a>';
				} ?>
			<?php } else{ echo "Categories has not been defined."; } ?>
        </div>

	<?php }
	
}