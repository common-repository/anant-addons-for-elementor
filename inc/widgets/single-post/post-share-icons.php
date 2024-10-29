<?php
namespace AnantAddons;

use Elementor\Controls_Manager;
use Elementor\Group_Control_Background;
use Elementor\Group_Control_Text_Stroke;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class AnantPostShareIcons extends \Elementor\Widget_Base {
	
	public function get_name() {
		return 'anant-post-share-icons';
	}

	public function get_title() {
		return esc_html__( 'Post Share Icons', 'anant-addons-for-elementor' );
	}

	public function get_icon() {
		return 'ant-icon eicon-social-icons';
	}

	public function get_categories() {
		return [ 'anant-sng-blog-elements' ];
	}

	public function get_keywords() {
		return [ 'post-title', 'post', 'share icons', 'post social icons', 'social icons' ];
	}


	protected function register_controls() {

		// Tab: Content ==============
		// Section: General ----------
		$this->start_controls_section(
			'section_post_title',
			[
				'label' => esc_html__( 'General', 'anant-addons-for-elementor' ),
				'tab' => Controls_Manager::TAB_CONTENT,
			]
		);

		$this->add_control(
			'icon_one',
			[
				'label'       => esc_html__( 'Icon 1', 'anant-addons-for-elementor' ),
				'type'        => \Elementor\Controls_Manager::SELECT,
				'default'     => 'facebook',
				'options'     => [
					'facebook'	=> esc_html__( 'FaceBook', 'anant-addons-for-elementor' ),
					'x-twitter' => esc_html__( 'X Twitter', 'anant-addons-for-elementor' ),
					'envelope'  => esc_html__( 'Envelope', 'anant-addons-for-elementor' ),
					'linkedin'  => esc_html__( 'LinkedIn', 'anant-addons-for-elementor' ),
					'pinterest'  => esc_html__( 'Pintrest', 'anant-addons-for-elementor' ),
					'telegram'  => esc_html__( 'Telegram', 'anant-addons-for-elementor' ),
					'whatsapp'  => esc_html__( 'Whatsapp', 'anant-addons-for-elementor' ),
					'reddit'    => esc_html__( 'Reddit', 'anant-addons-for-elementor' ),
					'print'     => esc_html__( 'Print', 'anant-addons-for-elementor' ),
				],
				
			]
		);

		$this->add_control(
			'icon_two',
			[
				'label'       => esc_html__( 'Icon 2', 'anant-addons-for-elementor' ),
				'type'        => \Elementor\Controls_Manager::SELECT,
				'default'     => 'x-twitter',
				'options'     => [
					'facebook'	=> esc_html__( 'FaceBook', 'anant-addons-for-elementor' ),
					'x-twitter'	=> esc_html__( 'X Twitter', 'anant-addons-for-elementor' ),
					'envelope'	=> esc_html__( 'Envelope', 'anant-addons-for-elementor' ),
					'linkedin'	=> esc_html__( 'LinkedIn', 'anant-addons-for-elementor' ),
					'pinterest'	=> esc_html__( 'Pintrest', 'anant-addons-for-elementor' ),
					'telegram'	=> esc_html__( 'Telegram', 'anant-addons-for-elementor' ),
					'whatsapp'	=> esc_html__( 'Whatsapp', 'anant-addons-for-elementor' ),
					'reddit'	=> esc_html__( 'Reddit', 'anant-addons-for-elementor' ),
					'print'		=> esc_html__( 'Print', 'anant-addons-for-elementor' ),
				],
				
			]
		);

		$this->add_control(
			'icon_three',
			[
				'label'       => esc_html__( 'Icon 3', 'anant-addons-for-elementor' ),
				'type'        => \Elementor\Controls_Manager::SELECT,
				'default'     => 'linkedin',
				'options'     => [
					'facebook'	=> esc_html__( 'FaceBook', 'anant-addons-for-elementor' ),
					'x-twitter'	=> esc_html__( 'X Twitter', 'anant-addons-for-elementor' ),
					'envelope'	=> esc_html__( 'Envelope', 'anant-addons-for-elementor' ),
					'linkedin'	=> esc_html__( 'LinkedIn', 'anant-addons-for-elementor' ),
					'pinterest'	=> esc_html__( 'Pintrest', 'anant-addons-for-elementor' ),
					'telegram'	=> esc_html__( 'Telegram', 'anant-addons-for-elementor' ),
					'whatsapp'	=> esc_html__( 'Whatsapp', 'anant-addons-for-elementor' ),
					'reddit'	=> esc_html__( 'Reddit', 'anant-addons-for-elementor' ),
					'print'		=> esc_html__( 'Print', 'anant-addons-for-elementor' ),
				],
				
			]
		);

		$this->add_control(
			'icon_four',
			[
				'label'       => esc_html__( 'Icon 4', 'anant-addons-for-elementor' ),
				'type'        => \Elementor\Controls_Manager::SELECT,
				'default'     => 'whatsapp',
				'options'     => [
					'facebook'	=> esc_html__( 'FaceBook', 'anant-addons-for-elementor' ),
					'x-twitter'	=> esc_html__( 'X Twitter', 'anant-addons-for-elementor' ),
					'envelope'	=> esc_html__( 'Envelope', 'anant-addons-for-elementor' ),
					'linkedin'	=> esc_html__( 'LinkedIn', 'anant-addons-for-elementor' ),
					'pinterest'	=> esc_html__( 'Pintrest', 'anant-addons-for-elementor' ),
					'telegram'	=> esc_html__( 'Telegram', 'anant-addons-for-elementor' ),
					'whatsapp'	=> esc_html__( 'Whatsapp', 'anant-addons-for-elementor' ),
					'reddit'	=> esc_html__( 'Reddit', 'anant-addons-for-elementor' ),
					'print'		=> esc_html__( 'Print', 'anant-addons-for-elementor' ),
				],
				
			]
		);

		$this->end_controls_section(); // End Controls Section

		anant_pro_promotion_controls($this);

		$this->start_controls_section(
			'icons_style_section',
			[
				'label' => esc_html__( 'Icon', 'anant-addons-for-elementor' ),
				'tab' => Controls_Manager::TAB_STYLE,
				'show_label' => false,
			]
		);

		$this->add_responsive_control(
            'post_social_icon_align',
            [
                'label' => esc_html__( 'Alignment', 'anant-addons-for-elementor' ),
                'type' => Controls_Manager::CHOOSE,
                'default' => 'center',
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
					'{{WRAPPER}} .anant-single-post-social-icons .ant-post-share-icons' => 'justify-content: {{VALUE}}',
				],
				'separator' => 'before'
            ]
        );

		$this->add_control(
			'select_post_social_icon', 
			[
				'label' => __('Color', 'anant-addons-for-elementor'),
				'type'        => \Elementor\Controls_Manager::SELECT,
				'options' => [
					'official'       => esc_html__( 'Official Color', 'anant-addons-for-elementor' ),
					'custom'       => esc_html__( 'Custom', 'anant-addons-for-elementor' ),
				],
				'default' => ['official'],
			]
		);

		$this->add_control(
			'social_icon_color',
			[
				'label'     => __( 'Color', 'anant-addons-for-elementor' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .ant-post-share-icons a' => 'color: {{VALUE}}',
				],
				'condition' => [
					'select_post_social_icon' => 'custom'
				],
			]
		);
		
		$this->add_control(
			'social_icon_bg_color',
			[
				'label'     => __( 'Background Color', 'anant-addons-for-elementor' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .ant-post-share-icons a' => 'background-color: {{VALUE}}',
				],
				'condition' => [
					'select_post_social_icon' => 'custom'
				],
			]
		);

		$this->add_responsive_control(
			'social_icon_size',
			[
				'label'           => __( 'Icon Size', 'anant-addons-for-elementor'),
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
					'{{WRAPPER}} .ant-post-share-icons a i:before' => 'font-size: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'social_icon_width',
			[
				'label'           => __( 'Icon Width', 'anant-addons-for-elementor'),
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
					'{{WRAPPER}} .anant-single-post-social-icons .ant-post-share-icons a' => 'width: {{SIZE}}{{UNIT}};height: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'social_icon_spacing',
			[
				'label'           => __( 'Icon Spacing', 'anant-addons-for-elementor'),
				'type'            => Controls_Manager::SLIDER,
				'size_units'      => [ 'px', '%', 'vh' ],
				'range'           => [
					'px' => [
						'min' => 0,
						'max' => 120,
					],
					'%' => [
						'min' => 0,
						'max' => 100,
					],
					'vh' => [
						'min' => 0,
						'max' => 70,
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
					'{{WRAPPER}} .anant-single-post-social-icons .ant-post-share-icons ' => 'gap: {{SIZE}}{{UNIT}};',
				],
			]
		);

		anant_border_radius_control(
			$this,
			[
				'key'       => 'social_icon_border_radius',
				'label'     => 'Border Radius',
				'selectors' => [
					'{{WRAPPER}} .anant-single-post-social-icons .ant-post-share-icons a' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
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
		

        echo '<div class="anant-single-post-social-icons">';
			$this->social_icons($post_id, $settings);
        echo '</div>';

	}

	

	function social_icons($post_id , $args) {

		$post_link  = esc_url( get_the_permalink($post_id) );
		$post_title = get_the_title($post_id);
		$icons = array(
			$args['icon_one'],
			$args['icon_two'],
			$args['icon_three'],
			$args['icon_four']
		);

		$facebook_url = add_query_arg(
		array(
		'url' => $post_link,
		),
		'https://www.facebook.com/share.php'
		);

		$twitter_url = add_query_arg(
		array(
		'url'  => $post_link,
		'text' => rawurlencode( html_entity_decode( wp_strip_all_tags( $post_title ), ENT_COMPAT, 'UTF-8' ) ),
			),
			'http://twitter.com/share'
			);

		$email_title = str_replace( '&', '%26', $post_title );

		$email_url = add_query_arg(
		array(
		'subject' => wp_strip_all_tags( $email_title ),
		'body'    => $post_link,
			),
		'mailto:'
			); 

		$linkedin_url = add_query_arg(
		array('url'  => $post_link,
		'title' => rawurlencode( html_entity_decode( wp_strip_all_tags( $post_title ), ENT_COMPAT, 'UTF-8' ) )
			),
		'https://www.linkedin.com/sharing/share-offsite/?url'
		);

		$pinterest_url = add_query_arg(
		array('url'  => $post_link,
			'title' => rawurlencode( html_entity_decode( wp_strip_all_tags( $post_title ), ENT_COMPAT, 'UTF-8' ) )
		),
		'http://pinterest.com/pin/create/link/?url='
		);

		$reddit_url = add_query_arg(
		array('url' => $post_link,
		'title' => rawurlencode( html_entity_decode( wp_strip_all_tags( $post_title ), ENT_COMPAT, 'UTF-8' ) )
		),
		'https://www.reddit.com/submit'
		);

		$telegram_url = add_query_arg(
		array('url' => $post_link,
		'title' => rawurlencode( html_entity_decode( wp_strip_all_tags( $post_title ), ENT_COMPAT, 'UTF-8' ) )
		),
		'https://t.me/share/url?url='
		);

		$whatsapp_url = add_query_arg(
		array('text' => $post_link,
		'title' => rawurlencode( html_entity_decode( wp_strip_all_tags( $post_title ), ENT_COMPAT, 'UTF-8' ) )
		),
		'https://api.whatsapp.com/send?text='
		);
		?>
		<script>
		function pinIt()
		{
		var e = document.createElement('script');
		e.setAttribute('type','text/javascript');
		e.setAttribute('charset','UTF-8');
		e.setAttribute('src','https://assets.pinterest.com/js/pinmarklet.js?r='+Math.random()*99999999);
		document.body.appendChild(e);
		}
		</script>
		<div class="ant-post-share">
			<div class="ant-post-share-icons cf"> 
				<?php foreach($icons as $icon){
					switch ($icon) {
						case 'facebook':
							?>
							<a class="facebook" href="<?php echo esc_url("$facebook_url"); ?>" class="link " target="_blank" ><i class="fab fa-facebook"></i></a>
							<?php
						break;
		
						case 'x-twitter':
							?>
								<a class="x-twitter" href="<?php echo esc_url("$twitter_url"); ?>" class="link " target="_blank"><i class="fab fa-x-twitter"></i></a>
							<?php
						break;
		
						case 'envelope':
							?>
							<a class="envelope" href="<?php echo esc_url("$email_url"); ?>" class="link " target="_blank" ><i class="fas fa-envelope-open"></i></a>
							<?php
						break;
		
						case 'linkedin':
							?>
							<a class="linkedin" href="<?php echo esc_url("$linkedin_url"); ?>" class="link " target="_blank" ><i class="fab fa-linkedin"></i></a>
							<?php
						break;
		
						case 'pinterest':
							?>
							<a href="javascript:pinIt();" class="pinterest"><i class="fab fa-pinterest"></i></a>
							<?php
						break;
		
						case 'telegram':
							?>
							<a class="telegram" href="<?php echo esc_url("$telegram_url"); ?>" target="_blank" ><i class="fab fa-telegram"></i></a>
							<?php
						break;
		
						case 'whatsapp':
							?>
							<a class="whatsapp" href="<?php echo esc_url("$whatsapp_url"); ?>" target="_blank" ><i class="fab fa-whatsapp"></i></a>
							<?php
						break;
		
						case 'reddit':
							?>
							<a class="reddit" href="<?php echo esc_url("$reddit_url"); ?>" target="_blank" ><i class="fab fa-reddit"></i></a>
							<?php
						break;
		
						case 'print':
							?>
							<a class="print-r" href="javascript:window.print()"> <i class="fas fa-print"></i></a>
							<?php
						break;
		
						default:
						break;
					}
				} ?>

			</div>
		</div>

	<?php } 
	
}