<?php
namespace AnantAddons;

use Elementor\Controls_Manager;
use Elementor\Group_Control_Background;
use Elementor\Group_Control_Text_Stroke;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class AnantPostDescription extends \Elementor\Widget_Base {
	
	public function get_name() {
		return 'anant-post-description';
	}

	public function get_title() {
		return esc_html__( 'Post Description', 'anant-addons-for-elementor' );
	}

	public function get_icon() {
		return 'ant-icon eicon-post-content';
	}

	public function get_categories() {
		return [ 'anant-sng-blog-elements' ];
	}

	public function get_keywords() {
		return [ 'post-description', 'post', 'description', 'post description' ];
	}

	protected function register_controls() {

		$this->start_controls_section(
			'section_post_description',
			[
				'label' => esc_html__( 'General', 'anant-addons-for-elementor' ),
				'tab' => Controls_Manager::TAB_CONTENT,
			]
		);

		$this->add_responsive_control(
            'post_description_align',
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
					'{{WRAPPER}} .single-post-content.content' => 'text-align: {{VALUE}}',
				],
				'separator' => 'before'
            ]
        );

		$this->end_controls_section(); // End Controls Section

		$this->start_controls_section(
			'post_description_styles',
			[
				'label' => esc_html__( 'Description', 'anant-addons-for-elementor' ),
				'tab' => Controls_Manager::TAB_STYLE,
				'show_label' => false,
			]
		);

		$this->add_control(
			'post_description_color',
			[
				'label' => esc_html__( 'Color', 'anant-addons-for-elementor' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .single-post-content.content' => 'color: {{VALUE}}',
					'{{WRAPPER}} .single-post-content.content p' => 'color: {{VALUE}}',
					'{{WRAPPER}} .single-post-content.content a' => 'color: {{VALUE}}',
				],
			]
		);

		$this->add_control(
			'post_description_heading_color',
			[
				'label' => esc_html__( 'Heading Color', 'anant-addons-for-elementor' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .single-post-content.content h1' => 'color: {{VALUE}}',
					'{{WRAPPER}} .single-post-content.content h2' => 'color: {{VALUE}}',
					'{{WRAPPER}} .single-post-content.content h3' => 'color: {{VALUE}}',
					'{{WRAPPER}} .single-post-content.content h4' => 'color: {{VALUE}}',
					'{{WRAPPER}} .single-post-content.content h5' => 'color: {{VALUE}}',
					'{{WRAPPER}} .single-post-content.content h6' => 'color: {{VALUE}}',
				],
			]
		);
		
		$this->add_control(
			'post_description_links_color',
			[
				'label' => esc_html__( 'Links Color', 'anant-addons-for-elementor' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .single-post-content.content a' => 'color: {{VALUE}}',
				],
			]
		);

		anant_typography_control(
			$this,
			[
				'name'     => 'post_description_typography',
				'label'    => 'Typography',
				'selector' => '{{WRAPPER}} .single-post-content.content',
			]
		);

		$this->add_responsive_control(
			'post_description_margin',
			[
				'label'     => esc_html__('Margin', 'anant-addons-for-elementor'),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .single-post-content.content' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		anant_text_shadow_control(
			$this,
			[
				'key'      => 'post_description_shadow',
				'label'    => 'Text Shadow',
				'selector' => '{{WRAPPER}} .single-post-content.content',
                'separator' => 'after',
			]
		);

		anant_text_stroke_control(
			$this,
			[
				'key'      => 'text_stroke',
				'selector' => '{{WRAPPER}} .single-post-content.content',
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

		$content = $post->post_content;

        echo '<div class="anant-post-content ">';
		echo '<article class="single-post-content content">';
			// echo '<a href="'.esc_attr($link).'" >'.esc_html($title).'</a>';
			echo ($content);
		echo '</article>';
        echo '</div>';

	}
	
}