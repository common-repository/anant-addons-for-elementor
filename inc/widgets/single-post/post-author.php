<?php namespace AnantAddons;

use Elementor\Controls_Manager;
use Elementor\Group_Control_Background;
use Elementor\Group_Control_Text_Stroke;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class AnantPostAuthor extends \Elementor\Widget_Base {
	
	public function get_name() {
		return 'anant-post-author';
	}

	public function get_title() {
		return esc_html__( 'Post Author', 'anant-addons-for-elementor' );
	}

	public function get_icon() {
		return 'ant-icon eicon-person';
	}

	public function get_categories() {
		return [ 'anant-sng-blog-elements' ];
	}

	public function get_keywords() {
		return [ 'post-title', 'post', 'title', 'post author', 'author' ];
	}


	protected function register_controls() {

		// Tab: Content ==============
		// Section: General ----------
		$this->start_controls_section(
			'section_post_author',
			[
				'label' => esc_html__( 'General', 'anant-addons-for-elementor' ),
				'tab' => Controls_Manager::TAB_CONTENT,
			]
		);

		$this->add_control(
			'by_author',
			[
				'label' => esc_html__( 'Show "By" Author', 'anant-addons-for-elementor' ),
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
            'post_author_align',
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
					'{{WRAPPER}} .anant-single-blog-author-box' => 'justify-content: {{VALUE}}; align-items: {{VALUE}};',
				],
            ]
        );
		$this->add_responsive_control(
			'post_author_img_postition',
			[
				'label' => __('Image Position', 'anant-addons-for-elementor') , 
				'type' => Controls_Manager::CHOOSE, 
                'default' => 'column',
				'options' => [
					'row' => [
						'title' => __('Left', 'anant-addons-for-elementor') , 
						'icon' => 'eicon-h-align-left', 
					], 
					'column' => [
						'title' => __('Top', 'anant-addons-for-elementor') , 
						'icon' => 'eicon-v-align-top', 
					], 
					'row-reverse' => [
						'title' => __('Right', 'anant-addons-for-elementor') , 
						'icon' => 'eicon-h-align-right',
					], 
				], 
				'selectors' => [
					'{{WRAPPER}} .anant-single-blog-author-box' => 'flex-direction: {{VALUE}};',
				],
			]
		);

		$this->end_controls_section(); // End Controls Section

		$this->start_controls_section(
			'post_author_box_area',
			[
				'label' => esc_html__( 'Author Box', 'anant-addons-for-elementor' ),
				'tab' => Controls_Manager::TAB_STYLE,
				'show_label' => false,
			]
		);

		$this->add_control(
			'post_author_box_bg_color',
			[
				'label' => esc_html__( 'Background Color', 'anant-addons-for-elementor' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .anant-single-blog-author-box' => 'background-color: {{VALUE}}',
				],
			]
		);
		
		anant_border_control(
			$this,
			[
				'name'     => 'post_author_box_border_type',
				'label'    => 'Border Type',
				'selector' => '{{WRAPPER}} .anant-single-blog-author-box',
			]
		);

		anant_border_radius_control(
			$this,
			[
				'key'       => 'post_author_box_border_radius',
				'label'     => 'Border Radius',
				'selectors' => [
					'{{WRAPPER}} .anant-single-blog-author-box' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'post_author_box_padding',
			[
				'label'     => esc_html__('Padding', 'anant-addons-for-elementor'),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .anant-single-blog-author-box' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}} !important;',
				],
			]
		);

		$this->add_responsive_control(
			'post_author_box_margin',
			[
				'label'     => esc_html__('Margin', 'anant-addons-for-elementor'),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .anant-single-blog-author-box' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}} !important;',
				],
			]
		);

		anant_box_shadow_control(
			$this,
			[
				'key'      => 'post_author_box_box_shadow',
				'label'    => 'Box Shadow',
				'selector' => '{{WRAPPER}} .anant-single-blog-author-box',
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'post_author_img_style',
			[
				'label' => esc_html__( 'Image', 'anant-addons-for-elementor' ),
				'tab' => Controls_Manager::TAB_STYLE,
				'show_label' => false,
			]
		);
		
		$slug = 'post_author_img';

		$this->add_responsive_control(
			$slug.'_size',
			[
				'label'           => __( 'Image Size', 'anant-addons-for-elementor' ),
				'type'            => Controls_Manager::SLIDER,
				'size_units'      => [ 'px', '%' ],
				'range'           => [
					'px' => [
						'min' => 0,
						'max' => 200,
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
					'{{WRAPPER}} .anant-single-blog-author-box .ant-author-pic img' => 'width: {{SIZE}}{{UNIT}};',
				],
			]
		);
		
		anant_border_control(
			$this,
			[
				'name'     => $slug.'_border_type',
				'label'    => 'Border Type',
				'selector' => '{{WRAPPER}} .anant-single-blog-author-box .ant-author-pic img',
			]
		);

		anant_border_radius_control(
			$this,
			[
				'key'       => $slug.'_border_radius',
				'label'     => 'Border Radius',
				'selectors' => [
					'{{WRAPPER}} .anant-single-blog-author-box .ant-author-pic img' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
					'{{WRAPPER}} .anant-single-blog-author-box .ant-author-pic img' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		anant_box_shadow_control(
			$this,
			[
				'key'      => $slug.'_box_shadow',
				'label'    => 'Box Shadow',
				'selector' => '{{WRAPPER}} .anant-single-blog-author-box .ant-author-pic img',
			]
		); 

		$this->end_controls_section();

		$this->start_controls_section(
			'post_author_name_style',
			[
				'label' => esc_html__( 'Name', 'anant-addons-for-elementor' ),
				'tab' => Controls_Manager::TAB_STYLE,
				'show_label' => false,
			]
		);
		$slug = 'post_author_name';
		
		$this->add_control(
			$slug.'_color',
			[
				'label'     => __( 'Color', 'anant-addons-for-elementor' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .anant-single-blog-author-box .title' => 'color: {{VALUE}}',
					'{{WRAPPER}} .anant-single-blog-author-box .title a' => 'color: {{VALUE}}',
					'{{WRAPPER}} .anant-single-blog-author-box .desc' => 'color: {{VALUE}}',
				],
			]
		);
		
		$this->add_control(
			$slug.'_hover_color',
			[
				'label'     => __( 'Hover Color', 'anant-addons-for-elementor' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .anant-single-blog-author-box .title a:hover' => 'color: {{VALUE}}',
				],
			]
		);

		anant_typography_control(
			$this,
			[
				'name'     => $slug.'_typography',
				'label'    => 'Typography',
				'selector' => '{{WRAPPER}} .anant-single-blog-author-box .title, {{WRAPPER}} .anant-single-blog-author-box .title a, {{WRAPPER}} .anant-single-blog-author-box .desc',
			]
		);

		$this->add_responsive_control(
			$slug.'_margin',
			[
				'label'     => esc_html__('Margin', 'anant-addons-for-elementor'),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .anant-single-blog-author-box .title' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		anant_text_shadow_control(
			$this,
			[
				'key'      => $slug.'_shadow',
				'label'    => 'Text Shadow',
				'selector' => '{{WRAPPER}}  .anant-single-blog-author-box .title, {{WRAPPER}}  .anant-single-blog-author-box .title a',
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'post_author_description_style',
			[
				'label' => esc_html__( 'Description', 'anant-addons-for-elementor' ),
				'tab' => Controls_Manager::TAB_STYLE,
				'show_label' => false,
			]
		);
		$slug = 'post_author_description';

		$this->add_control(
			$slug.'_color',
			[
				'label' => esc_html__( 'Color', 'anant-addons-for-elementor' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .anant-single-blog-author-box .desc' => 'color: {{VALUE}}',
				],
			]
		);

		anant_typography_control(
			$this,
			[
				'name'     => $slug.'_typography',
				'label'    => 'Typography',
				'selector' => '{{WRAPPER}} .anant-single-blog-author-box .desc',
			]
		);

		$this->add_responsive_control(
			$slug.'_margin',
			[
				'label'     => esc_html__('Margin', 'anant-addons-for-elementor'),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .anant-single-blog-author-box .desc' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		anant_text_shadow_control(
			$this,
			[
				'key'      => $slug.'_shadow',
				'label'    => 'Text Shadow',
				'selector' => '{{WRAPPER}} .anant-single-blog-author-box .desc',
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

		$title = $post->post_title;
		$link = get_permalink($post_id);
		$author_id 	 = $post->post_author;
		$author_by	 = $settings['by_author'] === 'yes' ? esc_html('By','anant-addons-for-elementor') : '';
		$author_name = get_the_author_meta('display_name', $author_id);
		$author_description = get_the_author_meta('description', $author_id);
		 ?>
		<div class="anant-single-blog-author-box">
            <a class="ant-author-pic" href="<?php echo esc_url(get_author_posts_url( $author_id ));?>"><?php echo get_avatar( $author_id , 150); ?></a>
            <div class="author-meta">
                <h4 class="title"><a href ="<?php echo esc_url(get_author_posts_url( $author_id ));?>"> <?php echo esc_html( $author_by ); ?> <?php echo esc_html($author_name); ?></a></h4>
                <p class="desc"><?php echo esc_html($author_description); ?></p>
             </div>
        </div>
<?php }
	
}