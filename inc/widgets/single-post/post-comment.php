<?php
namespace AnantAddons;

use Elementor\Controls_Manager;
use Elementor\Group_Control_Background;
use Elementor\Group_Control_Text_Stroke;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class AnantPostComments extends \Elementor\Widget_Base {
	
	private $single_blog_comment = 'anant-single-blog-comment';

	public function get_name() {
		return 'anant-post-comments';
	}

	public function get_title() {
		return esc_html__( 'Post Comments', 'anant-addons-for-elementor' );
	}

	public function get_icon() {
		return 'ant-icon eicon-comments';
	}

	public function get_categories() {
		return [ 'anant-sng-blog-elements' ];
	}

	public function get_keywords() {
		return [ 'post-comments', 'post', 'comments' , 'post comment', 'post comments'];
	}

	protected function register_controls() {
		// Blog Category
		$this->start_controls_section(
			'single_blog_comments_area_settings',
			[
				'label' => __( 'Comment Area Settings ', 'anant-addons-for-elementor' ),
				'tab'   => Controls_Manager::TAB_STYLE,   
				
			]
		);
		
		$slug = 'single_blog_comment_area';
		
		$this->add_control(
			$slug.'_bg_color',
			[
				'label'     => __( 'Background Color', 'anant-addons-for-elementor' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}}  .anant-single-post-comments' => 'background-color: {{VALUE}}',
				],
			]
		);
		
		anant_border_control(
			$this,
			[
				'name'     => $slug.'_border_type',
				'label'    => 'Border Type',
				'selector' => '{{WRAPPER}} .anant-single-post-comments',
			]
		);

		anant_border_radius_control(
			$this,
			[
				'key'       => $slug.'_border_radius',
				'label'     => 'Border Radius',
				'selectors' => [
					'{{WRAPPER}} .anant-single-post-comments' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
					'{{WRAPPER}} .anant-single-post-comments' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}} !important;',
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
					'{{WRAPPER}} .anant-single-post-comments' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		anant_box_shadow_control(
			$this,
			[
				'key'      => $slug.'_box_shadow',
				'label'    => 'Box Shadow',
				'selector' => '{{WRAPPER}}  .anant-single-post-comments#comments',
			]
		);
		$this->end_controls_section();

		$this->start_controls_section(
			'comment_area_title_section',
			[
				'label' => esc_html__( 'Comment Area Title', 'anant-addons-for-elementor' ),
				'tab' => Controls_Manager::TAB_STYLE,
				'show_label' => false,
			]
		);

		$this->add_responsive_control(
            'comment_area_title_align',
            [
                'label' => esc_html__( 'Alignment', 'anant-addons-for-elementor' ),
                'type' => Controls_Manager::CHOOSE,
                'default' => 'end',
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
					'{{WRAPPER}} .anant-single-post-comments .ant-heading-bor-bt' => 'justify-content: {{VALUE}}',
				]
            ]
        );
		$this->add_control(
			'comment_area_title_color',
			[
				'label' => esc_html__( 'Color', 'anant-addons-for-elementor' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .ant-heading-bor-bt h5' => 'color: {{VALUE}}',
				],
			]
		);

		anant_typography_control(
			$this,
			[
				'name'     => 'comment_area_title_typography',
				'label'    => 'Typography',
				'selector' => '{{WRAPPER}} .ant-heading-bor-bt h5',
			]
		);

		$this->add_responsive_control(
			'comment_area_title_margin',
			[
				'label'     => esc_html__('Margin', 'anant-addons-for-elementor'),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .ant-heading-bor-bt h5' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		anant_text_shadow_control(
			$this,
			[
				'key'      => 'comment_area_title_shadow',
				'label'    => 'Text Shadow',
				'selector' => '{{WRAPPER}} .ant-heading-bor-bt h5 ',
                'separator' => 'after',
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'post_user_comment_styles',
			[
				'label' => esc_html__( 'User Comment', 'anant-addons-for-elementor' ),
				'tab' => Controls_Manager::TAB_STYLE,
				'show_label' => false,
			]
		);
		
		$slug = 'post_user_comment_box';

		$this->add_control(
			$slug.'_heading',
			[
				'label' => esc_html__( 'User Comment Box', 'anant-addons-for-elementor' ),
				'type' => \Elementor\Controls_Manager::HEADING,
				'separator' => 'before'
			]
		);
		
		$this->add_control(
			$slug.'_user_name_color',
			[
				'label'     => __( 'User Name Color', 'anant-addons-for-elementor' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}}  .anant-single-post-comments b.fn a' => 'color: {{VALUE}};', 
				],
			]
		);
		
		$this->add_control(
			$slug.'_date_color',
			[
				'label'     => __( 'Date Color', 'anant-addons-for-elementor' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .anant-single-post-comments .comment-metadata a' => 'color: {{VALUE}};', 
					'{{WRAPPER}} .anant-single-post-comments .comment-metadata span' => 'color: {{VALUE}};', 
				],
			]
		);
		
		$this->add_control(
			$slug.'_review_text_color',
			[
				'label'     => __( 'Comment Text Color', 'anant-addons-for-elementor' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}}   .anant-single-post-comments .comment-content ' => 'color: {{VALUE}};', 
					'{{WRAPPER}}   .anant-single-post-comments .comment-author.vcard .says' => 'color: {{VALUE}};', 
				],
			]
		);

		anant_typography_control(
			$this,
			[
				'name'     => $slug.'_review_text_typography',
				'label'    => 'Typography',
				'selector' => '{{WRAPPER}} .anant-single-post-comments .comment-content p, .anant-single-post-comments .comment-author.vcard .says, {{WRAPPER}} .anant-single-post-comments .comment-metadata a , {{WRAPPER}} .anant-single-post-comments .comment-metadata span, {{WRAPPER}}  .anant-single-post-comments b.fn a',
			]
		);

		anant_border_control(
			$this,
			[
				'name'     => $slug.'_border_type',
				'label'    => 'Border Type',
				'selector' => '{{WRAPPER}} .anant-single-post-comments.comments-area .comment-body',
			]
		);

		anant_border_radius_control(
			$this,
			[
				'key'       => $slug.'_border_radius',
				'label'     => 'Border Radius',
				'selectors' => [
					'{{WRAPPER}} .anant-single-post-comments.comments-area .comment-body' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
					'{{WRAPPER}} .anant-single-post-comments.comments-area .comment-body' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		anant_box_shadow_control(
			$this,
			[
				'key'      => $slug.'_box_shadow',
				'label'    => 'Box Shadow',
				'selector' => '{{WRAPPER}}  .anant-single-post-comments.comments-area .comment-body',
			]
		);
		
		$slug = 'post_user_comment_img';

		$this->add_control(
			$slug.'_heading',
			[
				'label' => esc_html__( 'image', 'anant-addons-for-elementor' ),
				'type' => \Elementor\Controls_Manager::HEADING,
				'separator' => 'before'
			]
		);

		$this->add_responsive_control(
			$slug.'_img_size',
			[
				'label'           => __( 'Image Size', 'anant-addons-for-elementor' ),
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
					'{{WRAPPER}} .anant-single-post-comments .comment-author.vcard img.avatar' => 'width: {{SIZE}}{{UNIT}};',
				],
			]
		);

		anant_border_control(
			$this,
			[
				'name'     => $slug.'_border_type',
				'label'    => 'Border Type',
				'selector' => '{{WRAPPER}} .anant-single-post-comments .comment-author.vcard img.avatar',
			]
		);

		anant_border_radius_control(
			$this,
			[
				'key'       => $slug.'_border_radius',
				'label'     => 'Border Radius',
				'selectors' => [
					'{{WRAPPER}} .anant-single-post-comments .comment-author.vcard img.avatar' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
					'{{WRAPPER}} .anant-single-post-comments .comment-author.vcard img.avatar' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_control(
			$slug.'_btn_heading',
			[
				'label' => esc_html__( 'User Comment Button', 'anant-addons-for-elementor' ),
				'type' => \Elementor\Controls_Manager::HEADING,
				'separator' => 'before'
			]
		);

		$this->add_responsive_control(
            'post_user_comment_button_align',
            [
                'label' => esc_html__( 'Alignment', 'anant-addons-for-elementor' ),
                'type' => Controls_Manager::CHOOSE,
                'default' => 'end',
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
					'{{WRAPPER}} .anant-single-post-comments .comment-body .reply' => 'text-align: {{VALUE}}',
				]
            ]
        );
		
		$slug = 'post_user_comment_button';
		
		$this->add_control(
			$slug.'_color',
			[
				'label'     => __( 'Color', 'anant-addons-for-elementor' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .anant-single-post-comments.comments-area .reply a' => 'color: {{VALUE}}',
				],
			]
		);
		
		$this->add_control(
			$slug.'_bg_color',
			[
				'label'     => __( 'Background Color', 'anant-addons-for-elementor' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .anant-single-post-comments.comments-area .reply a' => 'background-color: {{VALUE}}',
				],
			]
		);
		anant_typography_control(
			$this,
			[
				'name'     => $slug.'_typography',
				'label'    => 'Typography',
				'selector' => '{{WRAPPER}} .anant-single-post-comments.comments-area .reply a',
			]
		);

		
		anant_border_control(
			$this,
			[
				'name'     => $slug.'_border_type',
				'label'    => 'Border Type',
				'selector' => '{{WRAPPER}} .anant-single-post-comments.comments-area .reply a',
			]
		);

		anant_border_radius_control(
			$this,
			[
				'key'       => $slug.'_border_radius',
				'label'     => 'Border Radius',
				'selectors' => [
					'{{WRAPPER}} .anant-single-post-comments.comments-area .reply a' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
					'{{WRAPPER}} .anant-single-post-comments.comments-area .reply a' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
					'{{WRAPPER}} .anant-single-post-comments.comments-area .reply a' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->end_controls_section();  // End Controls Section

		$this->start_controls_section(
			'post_comment_form_styles',
			[
				'label' => esc_html__( 'Comment Form', 'anant-addons-for-elementor' ),
				'tab' => Controls_Manager::TAB_STYLE,
				'show_label' => false,
			]
		);
		
		$slug = 'post_comment_form';
		
		$this->add_control(
			$slug.'_form_title_color',
			[
				'label'     => __( 'Form Title Color', 'anant-addons-for-elementor' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}}  .anant-single-post-comments #reply-title' => 'color: {{VALUE}};', 
				],
			]
		);

		anant_typography_control(
			$this,
			[
				'name'     => $slug.'_form_title_typography',
				'label'    => 'Typography',
				'selector' => '{{WRAPPER}}  .anant-single-post-comments #reply-title',
			]
		);
		
		$this->add_control(
			$slug.'_label_color',
			[
				'label'     => __( 'Label Color', 'anant-addons-for-elementor' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .anant-single-post-comments form p' => 'color: {{VALUE}};', 
					// '{{WRAPPER}} .anant-single-post-comments .comment-metadata span' => 'color: {{VALUE}};', 
				],
			]
		);
		
		$this->add_control(
			$slug.'_required_color',
			[
				'label'     => __( 'Required Color', 'anant-addons-for-elementor' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					// '{{WRAPPER}} .anant-single-post-comments form p ' => 'color: {{VALUE}};', 
					'{{WRAPPER}}   .anant-single-post-comments .required' => 'color: {{VALUE}};', 
				],
			]
		);


		anant_typography_control(
			$this,
			[
				'name'     => $slug.'_label_typography',
				'label'    => 'Typography',
				'selector' => '{{WRAPPER}} .anant-single-post-comments form p',
			]
		);
		
		$this->add_control(
			$slug.'_textarea_color',
			[
				'label'     => __( 'Form Text Color', 'anant-addons-for-elementor' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .anant-single-post-comments input[type="text"]' => 'color: {{VALUE}};', 
					'{{WRAPPER}} .anant-single-post-comments input[type="email"]' => 'color: {{VALUE}};', 
					'{{WRAPPER}} .anant-single-post-comments input[type="url"]' => 'color: {{VALUE}};', 
					'{{WRAPPER}} .anant-single-post-comments textarea' => 'color: {{VALUE}};', 
				],
			]
		);
		
		$this->add_control(
			$slug.'_bg_color',
			[
				'label'     => __( 'Background Color', 'anant-addons-for-elementor' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}}  .anant-single-post-comments input[type="text"]' => 'background-color: {{VALUE}};', 
					'{{WRAPPER}}  .anant-single-post-comments input[type="email"]' => 'background-color: {{VALUE}};', 
					'{{WRAPPER}}  .anant-single-post-comments input[type="url"]' => 'background-color: {{VALUE}};', 
					'{{WRAPPER}}  .anant-single-post-comments textarea' => 'background-color: {{VALUE}};', 
				],
			]
		);

		anant_typography_control(
			$this,
			[
				'name'     => $slug.'_textarea_typography',
				'label'    => 'Typography',
				'selector' => '{{WRAPPER}}  .anant-single-post-comments input[type="text"], {{WRAPPER}}  .anant-single-post-comments input[type="email"], {{WRAPPER}}  .anant-single-post-comments input[type="url"], {{WRAPPER}}  .anant-single-post-comments textarea',
			]
		);

		anant_border_radius_control(
			$this,
			[
				'key'       => $slug.'_border_radius',
				'label'     => 'Border Radius',
				'selectors' => [
					'{{WRAPPER}} .anant-single-post-comments input[type="text"]' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					'{{WRAPPER}} .anant-single-post-comments input[type="email"]' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					'{{WRAPPER}} .anant-single-post-comments input[type="url"]' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					'{{WRAPPER}} .anant-single-post-comments textarea' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
					'{{WRAPPER}} .anant-single-post-comments.comments-area input[type="text"]' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					'{{WRAPPER}} .anant-single-post-comments.comments-area input[type="email"]' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					'{{WRAPPER}} .anant-single-post-comments.comments-area input[type="url"]' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					'{{WRAPPER}} .anant-single-post-comments.comments-area textarea' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_control(
			$slug.'_btn_heading',
			[
				'label' => esc_html__( 'Comment Button', 'anant-addons-for-elementor' ),
				'type' => \Elementor\Controls_Manager::HEADING,
				'separator' => 'before'
			]
		);
		
		$slug = 'post_comment_form_button';
		
		$this->add_control(
			$slug.'_color',
			[
				'label'     => __( 'Color', 'anant-addons-for-elementor' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .anant-single-post-comments .form-submit input[type="button"]' => 'color: {{VALUE}}',
					'{{WRAPPER}} .anant-single-post-comments .form-submit input[type="submit"]' => 'color: {{VALUE}}',
				],
			]
		);
		
		$this->add_control(
			$slug.'_hover_color',
			[
				'label'     => __( 'Hover Color', 'anant-addons-for-elementor' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .anant-single-post-comments .form-submit input[type="button"]:hover' => 'color: {{VALUE}}',
					'{{WRAPPER}} .anant-single-post-comments .form-submit input[type="submit"]:hover' => 'color: {{VALUE}}',
				],
			]
		);
		
		$this->add_control(
			$slug.'_bg_color',
			[
				'label'     => __( 'Background Color', 'anant-addons-for-elementor' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .anant-single-post-comments  .form-submit input[type="button"]' => 'background-color: {{VALUE}}',
					'{{WRAPPER}} .anant-single-post-comments  .form-submit input[type="submit"]' => 'background-color: {{VALUE}}',
				],
			]
		);
		
		$this->add_control(
			$slug.'_bg_hover_color',
			[
				'label'     => __( 'Background Hover Color', 'anant-addons-for-elementor' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .anant-single-post-comments  .form-submit input[type="button"]:hover' => 'background-color: {{VALUE}}',
					'{{WRAPPER}} .anant-single-post-comments  .form-submit input[type="submit"]:hover' => 'background-color: {{VALUE}}',
				],
			]
		);

		anant_typography_control(
			$this,
			[
				'name'     => $slug.'_typography',
				'label'    => 'Typography',
				'selector' => '{{WRAPPER}} .anant-single-post-comments .form-submit input[type="button"], {{WRAPPER}} .anant-single-post-comments .form-submit input[type="submit"]',
			]
		);

		
		anant_border_control(
			$this,
			[
				'name'     => $slug.'_border_type',
				'label'    => 'Border Type',
				'selector' => '{{WRAPPER}} .anant-single-post-comments .form-submit input[type="button"], {{WRAPPER}} .anant-single-post-comments .form-submit input[type="submit"]',
			]
		);

		anant_border_radius_control(
			$this,
			[
				'key'       => $slug.'_border_radius',
				'label'     => 'Border Radius',
				'selectors' => [
					'{{WRAPPER}} .anant-single-post-comments .form-submit input[type="button"]' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					'{{WRAPPER}} .anant-single-post-comments .form-submit input[type="submit"]' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
					'{{WRAPPER}} .anant-single-post-comments .form-submit input[type="button"]' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					'{{WRAPPER}} .anant-single-post-comments .form-submit input[type="submit"]' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
					'{{WRAPPER}} .anant-single-post-comments .form-submit input[type="button"]' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					'{{WRAPPER}} .anant-single-post-comments .form-submit input[type="submit"]' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		); 

		$this->end_controls_section();  // End Controls Section
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

		$title = get_the_title($post);
		$comments_number = get_comments_number($post_id);
		// Get comments for the specific post
		$comments = get_comments(array('post_id' => $post_id));
		if (comments_open($post)) :
            if ( post_password_required($post) ) {
				return;
			}
		?>
		<div id="comments" class="anant-single-post-comments comments-area">
				<?php
				// You can start editing here -- including this comment!
				if ( $comments_number > 0 ) : ?>
					<div class="ant-heading-bor-bt">
					<h5 class="comments-title">
						<?php
						if ( '1' === $comments_number ) {
							/* translators: %s: post title */
							printf( esc_html__( 'One thought on &ldquo;%s&rdquo;', 'anant-addons-for-elementor' ), esc_html($title) );
						} else {
							printf(
								   esc_html(
									  /* translators: 1: number of comments, 2: post title */
									 _nx( 
										  '%1$s thought on &ldquo;%2$s&rdquo;',
										  '%1$s thoughts on &ldquo;%2$s&rdquo;',
										  $comments_number,
										  'comments title',
										  'anant-addons-for-elementor'
									   )
								   ),
								   esc_html (number_format_i18n( $comments_number ) ),
								   esc_html($title)
							);
						}
						?>
					</h5>
					</div>
			
					<?php if ( $comments_number > 1 && get_option( 'page_comments' ) ) : // Are there comments to navigate through? ?>
					<nav id="comment-nav-above" class="navigation comment-navigation" role="navigation">
						<h2 class="screen-reader-text"><?php esc_html_e( 'Comment navigation', 'anant-addons-for-elementor' ); ?></h2>
						<div class="nav-links">
			
							<div class="nav-previous"><?php previous_comments_link( esc_html__( 'Older Comments', 'anant-addons-for-elementor' ) ); ?></div>
							<div class="nav-next"><?php next_comments_link( esc_html__( 'Newer Comments', 'anant-addons-for-elementor' ) ); ?></div>
			
						</div><!-- .nav-links -->
					</nav><!-- #comment-nav-above -->
					<?php endif; // Check for comment navigation. ?>
			
					<ol class="comment-list">
						<?php
							wp_list_comments( array(
								'style'      => 'ol',
								'ant_ping' => true,
							), $comments );
						?>
					</ol><!-- .comment-list -->
			
					<?php if ( $comments_number > 1 && get_option( 'page_comments' ) ) : // Are there comments to navigate through? ?>
					<nav id="comment-nav-below" class="navigation comment-navigation" role="navigation">
						<h5 class="screen-reader-text"><?php esc_html_e( 'Comment navigation', 'anant-addons-for-elementor' ); ?></h5>
						<div class="nav-links">
			
							<div class="nav-previous"><?php previous_comments_link( esc_html__( 'Older Comments', 'anant-addons-for-elementor' ) ); ?></div>
							<div class="nav-next"><?php next_comments_link( esc_html__( 'Newer Comments', 'anant-addons-for-elementor' ) ); ?></div>
			
						</div><!-- .nav-links -->
					</nav><!-- #comment-nav-below -->
					<?php
			
				endif; // Check for comment navigation.
				endif; // Check for have_comments().
				
				if ( ! comments_open($post) && get_comments_number($post) && post_type_supports( get_post_type(), 'comments' ) ) : ?>
					<p class="no-comments"><?php esc_html_e( 'Comments are closed.', 'anant-addons-for-elementor' ); ?></p>
				<?php
				endif;
				comment_form( array(), $post);
				?>
		</div><!-- #comments -->
    <?php endif;  
	}
	
}