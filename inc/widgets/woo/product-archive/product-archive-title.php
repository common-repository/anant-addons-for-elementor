<?php
namespace AnantAddons;

use Elementor\Controls_Manager;
use Elementor\Group_Control_Background;
use Elementor\Group_Control_Text_Stroke;
use Elementor\Plugin;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class AnantProductArchiveTitle extends \Elementor\Widget_Base {
	
	public function get_name() {
		return 'anant-product-archive-title';
	}

	public function get_title() {
		return esc_html__( 'Product Archive Title', 'anant-addons-for-elementor' );
	}

	public function get_icon() {
		return 'ant-icon eicon-product-title';
	}

	public function get_categories() {
		return [ 'anant-sng-woo-elements' ];
	}

	public function get_keywords() {
		return [ 'product archive', 'product archive title', 'archive title' ];
	}

	protected function register_controls() {

		// Tab: Content ==============
		// Section: General ----------
		$this->start_controls_section(
			'section_product_title',
			[
				'label' => esc_html__( 'General', 'anant-addons-for-elementor' ),
				'tab' => Controls_Manager::TAB_CONTENT,
			]
		);

		$this->add_control(
			'product_archive_title_tag',
			[
				'label' => esc_html__( 'Title HTML Tag', 'anant-addons-for-elementor' ),
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
				'default' => 'h1',
			]
		);

		$this->add_control (
			'cat_archive_title_before_text_toggle',
			[
				'type' => Controls_Manager::SWITCHER,
				'label' => esc_html__( 'Category Before Text Toggle', 'anant-addons-for-elementor' ),
				'default' => 'no',
				'return_value' => 'yes',
			]
		);

		$this->add_control(
			'cat_archive_title_before_text', [
				'label' => __( 'Category Before Text', 'anant-addons-for-elementor' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => __( 'Category:' , 'anant-addons-for-elementor' ),
				'label_block' => true,
				'condition' =>[
					'cat_archive_title_before_text_toggle' => 'yes', 
				],
			]
		);

		$this->add_control (
			'tag_archive_title_before_text_toggle',
			[
				'type' => Controls_Manager::SWITCHER,
				'label' => esc_html__( 'Tag Before Text Toggle', 'anant-addons-for-elementor' ),
				'default' => 'no',
				'return_value' => 'yes',
			]
		);

		$this->add_control(
			'tag_archive_title_before_text', [
				'label' => __( 'Tag Before Text', 'anant-addons-for-elementor' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => __( 'Tag:' , 'anant-addons-for-elementor' ),
				'label_block' => true,
				'condition' =>[
					'tag_archive_title_before_text_toggle' => 'yes', 
				],
			]
		);

		$this->add_control (
			'search_result_title_before_text_toggle',
			[
				'type' => Controls_Manager::SWITCHER,
				'label' => esc_html__( 'Search Before Text Toggle', 'anant-addons-for-elementor' ),
				'default' => 'no',
				'return_value' => 'yes',
			]
		);

		$this->add_control(
			'search_result_title_before_text', [
				'label' => __( 'Search Before Text', 'anant-addons-for-elementor' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => __( 'Search Results for:' , 'anant-addons-for-elementor' ),
				'label_block' => true,
				'condition' =>[
					'search_result_title_before_text_toggle' => 'yes', 
				],
			]
		);

		$this->add_responsive_control(
            'product_archive_title_align',
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
					'{{WRAPPER}} .anant-archive-title' => 'text-align: {{VALUE}}',
				],
				'separator' => 'before'
            ]
        );

		$this->end_controls_section(); // End Controls Section

		$this->start_controls_section(
			'archive_type_title_section',
			[
				'label' => esc_html__( 'Archive Type', 'anant-addons-for-elementor' ),
				'tab' => Controls_Manager::TAB_STYLE,
				'show_label' => false,
				'conditions' => [
					'relation' => 'or',
					'terms'    => [
						[
							'name'     => 'cat_archive_title_before_text_toggle',
							'operator' => '===',
							'value'    => 'yes',
						],
						[
							'name'     => 'tag_archive_title_before_text_toggle',
							'operator' => '===',
							'value'    => 'yes',
						],
					],
				],
			]
		);

		anant_color_control(
			$this,
			[
				'key'       => 'archive_type_title_color',
				'label'     => esc_html__( 'Color', 'anant-addons-for-elementor' ),
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .anant-archive-title span' => 'color: {{VALUE}}',
				],
			]
		);

		anant_typography_control(
			$this,
			[
				'name'     => 'archive_type_title_typography',
				'label'    => 'Typography',
				'selector' => '{{WRAPPER}} .anant-archive-title span',
			]
		);

		anant_text_shadow_control(
			$this,
			[
				'key'      => 'archive_type_title_shadow',
				'label'    => 'Text Shadow',
				'selector' => '{{WRAPPER}} .anant-archive-title span',
                'separator' => 'after',
			]
		);

		anant_text_stroke_control(
			$this,
			[
				'key'      => 'archive_type_title_stroke',
				'label'    => 'Text Stroke',
				'selector' => '{{WRAPPER}} .anant-archive-title span',
                'separator' => 'after',
			]
		);

		$this->add_responsive_control(
			'archive_type_title_margin',
			[
				'label'     => esc_html__('Margin', 'anant-addons-for-elementor'),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .anant-archive-title span' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->end_controls_section(); // End Controls Section

		$this->start_controls_section(
			'archive_title_section',
			[
				'label' => esc_html__( 'Archive Title', 'anant-addons-for-elementor' ),
				'tab' => Controls_Manager::TAB_STYLE,
				'show_label' => false,
			]
		);

		anant_color_control(
			$this,
			[
				'key'       => 'archive_title_color',
				'label'     => esc_html__( 'Color', 'anant-addons-for-elementor' ),
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .anant-archive-title' => 'color: {{VALUE}}',
				],
			]
		);

		anant_typography_control(
			$this,
			[
				'name'     => 'archive_title_typography',
				'label'    => 'Typography',
				'selector' => '{{WRAPPER}} .anant-archive-title',
			]
		);

		anant_text_shadow_control(
			$this,
			[
				'key'      => 'archive_title_shadow',
				'label'    => 'Text Shadow',
				'selector' => '{{WRAPPER}} .anant-archive-title',
                'separator' => 'after',
			]
		);

		anant_text_stroke_control(
			$this,
			[
				'key'      => 'archive_title_stroke',
				'label'    => 'Text Stroke',
				'selector' => '{{WRAPPER}} .anant-archive-title',
                'separator' => 'after',
			]
		);

		$this->add_responsive_control(
			'archive_title_margin',
			[
				'label'     => esc_html__('Margin', 'anant-addons-for-elementor'),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .anant-archive-title' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->end_controls_section();
	}

	protected function render() {
		$settings = $this->get_settings();
		$URL = $_SERVER['REQUEST_URI'];

		$cat_before_text_toggle = $settings['cat_archive_title_before_text_toggle'];
		$tag_before_text_toggle = $settings['tag_archive_title_before_text_toggle'];
		$search_before_text_toggle = $settings['search_result_title_before_text_toggle'];

		$cat_before_text = $settings['cat_archive_title_before_text'];
		$tag_before_text = $settings['tag_archive_title_before_text'];
		$search_before_text = $settings['search_result_title_before_text'];

		if ( ( class_exists( "\Elementor\Plugin" ) && Plugin::$instance->editor->is_edit_mode() ) ||  ( class_exists( "\Elementor\Plugin" ) && isset( $_GET['preview'] ) && isset( $_GET['preview_id'] ) && $_GET['preview'] == true ) || ( strpos($URL, 'anant-header-footer') !== false && get_post_type() == 'anant-header-footer' ) ) {
			$post_id = get_the_ID();
        	$archive_type 	= Plugin::$instance->documents->get($post_id, false)->get_settings('demo_archive_select');
			$cat_archive 	= Plugin::$instance->documents->get($post_id, false)->get_settings('demo_product_cat_archive_select');
			$tag_archive 	= Plugin::$instance->documents->get($post_id, false)->get_settings('demo_product_tag_archive_select');
			// $search_result 	= Plugin::$instance->documents->get($post_id, false)->get_settings('demo_search_result_archive_select');
			if($archive_type === 'product-category'){
				$title = $cat_before_text_toggle === 'yes' ? '<span>'.$cat_before_text.'</span>'.$cat_archive : $cat_archive;
			} else if($archive_type === 'product-tag'){
				$title = $tag_before_text_toggle === 'yes' ? '<span>'.$tag_before_text.'</span>'.$tag_archive : $tag_archive;
			} 
			// else if($archive_type === 'search'){
			// 	$title = $search_before_text_toggle === 'yes' ? '<span>'.$search_before_text.'</span>'.$search_result : $search_result;
			// }
           
        }else{
			$title = '';
			if (is_product_category()) {
				$Category = get_term_by('id', get_queried_object_id(), 'product_cat');
				if ($Category) {
					$Category_name = $Category->name;
					$title = $cat_before_text_toggle === 'yes' ? '<span>'.$cat_before_text.'</span>'.$Category_name : $Category_name;
				}
			} else if (is_product_tag()) {
				$tag = get_term_by('id', get_queried_object_id(), 'product_tag');
				if ($tag) {
					$tag_name = $tag->name;
					$title = $tag_before_text_toggle === 'yes' ? '<span>'.$tag_before_text.'</span>'.$tag_name : $tag_name;
				}
			}  
			//  else if (stripos($URL, "?s=") !== false) {
			// 	$search_query = explode("?s=", $URL);
			// 	$title = $search_before_text_toggle === 'yes' ? '<span>'.$search_before_text.'</span>'.$search_query[1] : $search_query[1];
			// } 
		}

		echo '<'. $settings['product_archive_title_tag'] .' class="anant-archive-title title">';
			echo ($title);
		echo '</'. $settings['product_archive_title_tag'] .'>';
	}
	
}