<?php
namespace AnantAddons;

use Elementor\Controls_Manager;
use Elementor\Group_Control_Background;
use Elementor\Group_Control_Text_Stroke;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class AnantPostPagination extends \Elementor\Widget_Base {
	
	private $single_blog_pagination = 'anant-single-blog-pagination';

	public function get_name() {
		return 'anant-post-pagination';
	}

	public function get_title() {
		return esc_html__( 'Post Pagination', 'anant-addons-for-elementor' );
	}

	public function get_icon() {
		return 'ant-icon eicon-post-navigation';
	}

	public function get_categories() {
		return [ 'anant-sng-blog-elements' ];
	}

	public function get_keywords() {
		return [ 'post-pagination', 'post', 'pagination' , 'post pagination'];
	}

	protected function register_controls() {

		// Tab: Content ==============
		// Section: General ----------
		$this->start_controls_section(
			'section_post_categories',
			[
				'label' => esc_html__( 'General', 'anant-addons-for-elementor' ),
				'tab' => Controls_Manager::TAB_CONTENT,
			]
		);

		$this->add_control(
			'pagination_icons',
			[
				'label'       => esc_html__( 'Pagination Icon', 'anant-addons-for-elementor' ),
				'placeholder' => esc_html__( 'Choose Icon from Here', 'anant-addons-for-elementor' ),
				'type'        => \Elementor\Controls_Manager::SELECT,
				'default'     => 'fas fa-angle-double-',
				'options'     => [
					'fas fa-angle-' 			=> esc_html__( 'Angle', 'anant-addons-for-elementor' ),
					'fas fa-angle-double-' 		=> esc_html__( 'Double Angle', 'anant-addons-for-elementor' ),
					'fas fa-arrow-' 			=> esc_html__( 'Arrow', 'anant-addons-for-elementor' ),
					'fas fa-long-arrow-alt-' 	=> esc_html__( 'Long Arrow (Pro)', 'anant-addons-for-elementor' ),
					'fas fa-arrow-circle-'		=> esc_html__( 'Circle Arrow (Pro)', 'anant-addons-for-elementor' ),
					'fas fa-arrow-alt-circle-' 	=> esc_html__( 'Circle Arrow 2 (Pro)', 'anant-addons-for-elementor' ),
					'far fa-arrow-alt-circle-' 	=> esc_html__( 'Circle Arrow 3 (Pro)', 'anant-addons-for-elementor' ),
					'fas fa-caret-' 			=> esc_html__( 'Caret (Pro)', 'anant-addons-for-elementor' ),
					'fas fa-caret-square-' 		=> esc_html__( 'Square Caret (Pro)', 'anant-addons-for-elementor' ),
					'far fa-caret-square-' 		=> esc_html__( 'Square Caret 2 (Pro)', 'anant-addons-for-elementor' ),
					'fas fa-chevron-' 			=> esc_html__( 'Chevron (Pro)', 'anant-addons-for-elementor' ),
					'fas fa-chevron-circle-' 	=> esc_html__( 'Circle Chevron (Pro)', 'anant-addons-for-elementor' ),
					'fas fa-hand-point-' 		=> esc_html__( 'Hand Point (Pro)', 'anant-addons-for-elementor' ),
					'far fa-hand-point-' 		=> esc_html__( 'Hand Point 2 (Pro)', 'anant-addons-for-elementor' ),
				],
			]
		);

		$this->add_control(
			'time_format_pro_notice',
			[
				'raw' => 'Only Available in <a href="https://anantaddons.com/" target="_blank">Pro Version!</a>',
				'type' => \Elementor\Controls_Manager::RAW_HTML,
				'content_classes' => 'anant-pro-notice',
				'condition' => [
                    'pagination_icons!' => ['fas fa-angle-', 'fas fa-angle-double-', 'fas fa-arrow-'],
                ],
			]
		);

		$this->add_control(
			'pagination_same_term',
			[
				'label' => esc_html__( 'Same Term', 'anant-addons-for-elementor' ),
				'type' => Controls_Manager::SWITCHER,
				'label_on' => esc_html__( 'Yes', 'anant-addons-for-elementor' ),
				'label_off' => esc_html__( 'No', 'anant-addons-for-elementor' ),
				'return_value' => 'yes',
				'default' => 'no',
				'classes' => 'anant-pro-popup-notice',
				'escape' => false,
			]
		);

		$this->add_responsive_control(
            'post_categories_align',
            [
                'label' => esc_html__( 'Alignment', 'anant-addons-for-elementor' ),
                'type' => Controls_Manager::CHOOSE,
                'default' => 'left',
                'label_block' => false,
                'options' => [
					'left'    => [
						'title' => __( 'Left', 'anant-addons-for-elementor' ),
						'icon' => 'eicon-text-align-left',
					],
					'center' => [
						'title' => __( 'Center', 'anant-addons-for-elementor' ),
						'icon' => 'eicon-text-align-center',
					],
					'right' => [
						'title' => __( 'Right', 'anant-addons-for-elementor' ),
						'icon' => 'eicon-text-align-right',
					],
                ],
				'selectors' => [
					'{{WRAPPER}} .ant-blog-category ' => 'text-align: {{VALUE}}',
				],
            ]
        );

		$this->end_controls_section(); // End Controls Section

		anant_pro_promotion_controls($this);

		// Blog Category
		$this->start_controls_section(
			'single_blog_pagination_area_settings',
			[
				'label' => __( 'Pagination Area Settings ', 'anant-addons-for-elementor' ),
				'tab'   => Controls_Manager::TAB_STYLE,   
				
			]
		);
		
		$slug = 'single_blog_pagination_area';
		
		$this->add_control(
			$slug.'_bg_color',
			[
				'label'     => __( 'Background Color', 'anant-addons-for-elementor' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .anant-single-post-pagination .post-navigation' => 'background-color: {{VALUE}}',
				],
			]
		);
		
		anant_border_control(
			$this,
			[
				'name'     => $slug.'_border_type',
				'label'    => 'Border Type',
				'selector' => '{{WRAPPER}} .anant-single-post-pagination .post-navigation',
			]
		);

		anant_border_radius_control(
			$this,
			[
				'key'       => $slug.'_border_radius',
				'label'     => 'Border Radius',
				'selectors' => [
					'{{WRAPPER}} .anant-single-post-pagination .post-navigation' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
					'{{WRAPPER}} .anant-single-post-pagination .post-navigation' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
					'{{WRAPPER}} .anant-single-post-pagination .post-navigation' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		anant_box_shadow_control(
			$this,
			[
				'key'      => $slug.'_box_shadow',
				'label'    => 'Box Shadow',
				'selector' => '{{WRAPPER}} .anant-single-post-pagination .post-navigation',
			]
		);

		$this->end_controls_section();

		// Blog Category
		$this->start_controls_section(
			'single_blog_pagination_icon_settings',
			[
				'label' => __( 'Icon Settings ', 'anant-addons-for-elementor' ),
				'tab'   => Controls_Manager::TAB_STYLE,   
				
			]
		);
		
		$slug = 'single_blog_pagination_icon';

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
					'{{WRAPPER}}  .anant-single-post-pagination .post-navigation .nav-previous a div:before' => 'color: {{VALUE}}',
					'{{WRAPPER}}  .anant-single-post-pagination .post-navigation .nav-next a div:before' => 'color: {{VALUE}}',
				],
			]
		);
		
		$this->add_control(
			$slug.'_bg_color',
			[
				'label'     => __( 'Background Color', 'anant-addons-for-elementor' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}}  .anant-single-post-pagination .post-navigation .nav-previous a div:before' => 'background-color: {{VALUE}}',
					'{{WRAPPER}}  .anant-single-post-pagination .post-navigation .nav-next a div:before' => 'background-color: {{VALUE}}',
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

		$this->add_control(
			$slug.'_color_hover',
			[
				'label'     => __( 'Color', 'anant-addons-for-elementor' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}}  .anant-single-post-pagination .post-navigation .nav-previous a:hover div:before' => 'color: {{VALUE}}',
					'{{WRAPPER}}  .anant-single-post-pagination .post-navigation .nav-next a:hover div:before' => 'color: {{VALUE}}',
				],
			]
		);

		$this->add_control(
			$slug.'_color_bg_hover',
			[
				'label'     => __( 'Background Color', 'anant-addons-for-elementor' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}}  .anant-single-post-pagination .post-navigation .nav-previous a:hover div:before' => 'background-color: {{VALUE}}',
					'{{WRAPPER}}  .anant-single-post-pagination .post-navigation .nav-next a:hover div:before' => 'background-color: {{VALUE}}',
				],
			]
		);

		$this->end_controls_tab();
		$this->end_controls_tabs(); 
		
		anant_border_control(
			$this,
			[
				'name'     => $slug.'_border_type',
				'label'    => 'Border Type',
				'selector' => '{{WRAPPER}} .anant-single-post-pagination .post-navigation .nav-previous a div:before, {{WRAPPER}}  .anant-single-post-pagination .post-navigation .nav-next a div:before',
			]
		);

		anant_border_radius_control(
			$this,
			[
				'key'       => $slug.'_border_radius',
				'label'     => 'Border Radius',
				'selectors' => [
					'{{WRAPPER}}  .anant-single-post-pagination .post-navigation .nav-previous a div:before' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					'{{WRAPPER}}  .anant-single-post-pagination .post-navigation .nav-next a div:before' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
					'{{WRAPPER}}  .anant-single-post-pagination .post-navigation .nav-previous a div:before' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					'{{WRAPPER}}  .anant-single-post-pagination .post-navigation .nav-next a div:before' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
					'{{WRAPPER}}  .anant-single-post-pagination .post-navigation .nav-previous a div:before' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					'{{WRAPPER}}  .anant-single-post-pagination .post-navigation .nav-next a div:before' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		anant_box_shadow_control(
			$this,
			[
				'key'      => $slug.'_box_shadow',
				'label'    => 'Box Shadow',
				'selector' => '{{WRAPPER}} .anant-single-post-pagination .post-navigation .nav-previous a div:before, {{WRAPPER}}  .anant-single-post-pagination .post-navigation .nav-next a div:before',
			]
		);

		$this->end_controls_section();

		// Blog Pagination Links
		$this->start_controls_section(
			'single_blog_pagination_links_settings',
			[
				'label' => __( 'Links Settings ', 'anant-addons-for-elementor' ),
				'tab'   => Controls_Manager::TAB_STYLE,   
				
			]
		);
		
		$slug = 'single_blog_pagination_links';

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
					'{{WRAPPER}} .anant-single-post-pagination .post-navigation .nav-previous a' => 'color: {{VALUE}}',
					'{{WRAPPER}} .anant-single-post-pagination .post-navigation .nav-next a' => 'color: {{VALUE}}',
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

		$this->add_control(
			$slug.'_color_hover',
			[
				'label'     => __( 'Color', 'anant-addons-for-elementor' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .anant-single-post-pagination .post-navigation .nav-previous a:hover' => 'color: {{VALUE}}',
					'{{WRAPPER}} .anant-single-post-pagination .post-navigation .nav-next a:hover' => 'color: {{VALUE}}',
				],
			]
		);

		$this->end_controls_tab();
		$this->end_controls_tabs(); 
		
		anant_typography_control(
			$this,
			[
				'name'     => $slug.'_typography',
				'label'    => 'Typography',
				'selector' => '{{WRAPPER}} .anant-single-post-pagination .post-navigation .nav-previous a, {{WRAPPER}} .anant-single-post-pagination .post-navigation .nav-next a',
			]
		);

		$this->add_responsive_control(
			$slug.'_margin',
			[
				'label'     => esc_html__('Margin', 'anant-addons-for-elementor'),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .anant-single-post-pagination .post-navigation .nav-previous a' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					'{{WRAPPER}} .anant-single-post-pagination .post-navigation .nav-next a' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		anant_text_shadow_control(
			$this,
			[
				'key'      => $slug.'_shadow',
				'label'    => 'Text Shadow',
				'selector' => '{{WRAPPER}} .anant-single-post-pagination .post-navigation .nav-previous a, {{WRAPPER}} .anant-single-post-pagination .post-navigation .nav-next a',
                'separator' => 'after',
			]
		);

		$this->end_controls_section();
	}

	protected function render() {
		$settings = $this->get_settings();
		$current_url = $_SERVER['REQUEST_URI'];
		if ( ( class_exists( "\Elementor\Plugin" ) && \Elementor\Plugin::$instance->editor->is_edit_mode() ) ||  ( class_exists( "\Elementor\Plugin" ) && isset( $_GET['preview'] ) && isset( $_GET['preview_id'] ) && $_GET['preview'] == true ) || ( strpos($current_url, 'anant-header-footer') !== false && get_post_type() == 'anant-header-footer' ) ) {
			$post_id = get_the_ID();
        	$post_id = \Elementor\Plugin::$instance->documents->get($post_id, false)->get_settings('demo_post_id');
            $post = get_post( $post_id );
            if ( ! $post ) {
                return;
            }
        }else{
            $post_id = get_the_ID();
            $post = get_post($post_id);
            if ( ! $post ) {
                return;
            }
		} 
		
		$left_icon  = ( $settings['pagination_icons'] === 'fas fa-angle-' || $settings['pagination_icons'] === 'fas fa-angle-double-' || $settings['pagination_icons'] === 'fas fa-arrow-' ) ? $settings['pagination_icons'].'left' : '' ;
		$right_icon = ( $settings['pagination_icons'] === 'fas fa-angle-' || $settings['pagination_icons'] === 'fas fa-angle-double-' || $settings['pagination_icons'] === 'fas fa-arrow-' ) ? $settings['pagination_icons'].'right' : '' ;

		$wp_query = new \WP_Query(array('p' => $post_id)); // Create a new query for the single post
		if( ( $settings['pagination_icons'] === 'fas fa-angle-' || $settings['pagination_icons'] === 'fas fa-angle-double-' || $settings['pagination_icons'] === 'fas fa-arrow-' )){
			$args = array(
				'prev_text' => '<div class="'.esc_attr($left_icon).'"></div><span></span> %title ',
				'next_text' => ' %title <div class="'.esc_attr($right_icon).'"></div><span></span>',
			);
		}
		
		if($settings['pagination_same_term'] === 'yes'){
			$args['in_same_term'] = true;
		}else{ 
			$args['in_same_term'] = false;
		}

		if($post_id !== "") { 
		?><div class="anant-single-post-pagination"><?php 
			// Display the post navigation for the single post
			if ($wp_query->have_posts()) {
				while ($wp_query->have_posts()) {
					$wp_query->the_post();
					the_post_navigation( $args );
					wp_link_pages(array(
							'before' => '<div class="single-nav-links">',
							'after' => '</div>',
					));
				}
			}
			// Reset the custom query
			wp_reset_postdata();
		?></div><?php
		}	
	}
	
}