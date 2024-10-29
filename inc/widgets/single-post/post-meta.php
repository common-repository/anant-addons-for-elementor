<?php
namespace AnantAddons;

use Elementor\Controls_Manager;
use Elementor\Group_Control_Background;
use Elementor\Group_Control_Text_Stroke;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class AnantPostMeta extends \Elementor\Widget_Base {
	
	private $single_blog_meta = 'anant-single-blog-meta';

	public function get_name() {
		return 'anant-post-meta';
	}

	public function get_title() {
		return esc_html__( 'Post Meta', 'anant-addons-for-elementor' );
	}

	public function get_icon() {
		return 'ant-icon eicon-post-info';
	}

	public function get_categories() {
		return [ 'anant-sng-blog-elements' ];
	}

	public function get_keywords() {
		return [ 'post-meta', 'post', 'meta' ];
	}

	protected function register_controls() {

		// Tab: Content ==============
		// Section: General ----------
		$this->start_controls_section(
			'section_post_meta',
			[
				'label' => esc_html__( 'General', 'anant-addons-for-elementor' ),
				'tab' => Controls_Manager::TAB_CONTENT,
			]
		);

		$this->add_control(
			'select_post_meta', 
			[
				'label' => __('Choose Meta', 'anant-addons-for-elementor'),
				'type' => Selectize_Control::Selectize,
				'label_block' => true,
				'multiple' => true,
				'options' => [
					'author'       => esc_html__( 'Author', 'anant-addons-for-elementor' ),
					'date'       => esc_html__( 'Date', 'anant-addons-for-elementor' ),
					'time'       => esc_html__( 'Time', 'anant-addons-for-elementor' ),
					'comment'       => esc_html__( 'Comments', 'anant-addons-for-elementor' ),
				],
				'default' => ['author', 'date', 'time', 'comment'],
			]
		);

		$this->add_control(
			'date_format',
			[
				'label'       => esc_html__( 'Date Format', 'anant-addons-for-elementor' ),
				'type'        => \Elementor\Controls_Manager::SELECT,
				'default'     => 'default',
				'options'     => [
					'default'       => esc_html__( 'Default', 'anant-addons-for-elementor' ),
					'wordpress'       => esc_html__( 'Wordpress (Pro)', 'anant-addons-for-elementor' ),
				],
				'condition' => [
					'select_post_meta' => 'date'
				],
			]
		);

		$this->add_control(
			'date_format_pro_notice',
			[
				'raw' => 'Only Available in <a href="https://anantaddons.com/" target="_blank">Pro Version!</a>',
				'type' => \Elementor\Controls_Manager::RAW_HTML,
				'content_classes' => 'anant-pro-notice',
				'condition' => [
                    'date_format!' => ['default'],
                ],
			]
		);

		$this->add_control(
			'time_format',
			[
				'label'       => esc_html__( 'Time Format', 'anant-addons-for-elementor' ),
				'type'        => \Elementor\Controls_Manager::SELECT,
				'default'     => 'g:i a',
				'options'     => [
					'g:i a'       => esc_html__( 'Default', 'anant-addons-for-elementor' ),
					'H:i'       => esc_html__( 'Format 2 (Pro)', 'anant-addons-for-elementor' ),
					'@ G:i'       => esc_html__( 'Format 3 (Pro)', 'anant-addons-for-elementor' ),
					'h:i:s A'       => esc_html__( 'Format 4 (Pro)', 'anant-addons-for-elementor' ),
					'G:i:s'       => esc_html__( 'Format 5 (Pro)', 'anant-addons-for-elementor' ),
					'g:i:s a'       => esc_html__( 'Format 6 (Pro)', 'anant-addons-for-elementor' ),
				],
				'condition' => [
					'select_post_meta' => 'time'
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
                    'time_format!' => ['g:i a'],
                ],
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
				'default' => 'yes',
				'condition' => [
					'select_post_meta' => 'author'
				],
				'classes' => 'anant-pro-popup-notice',
				'escape' => false,
			]
		);

		$this->add_responsive_control(
            'post_meta_align',
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
					'{{WRAPPER}} .anant-single-blog-meta .ant-blog-meta' => 'justify-content: {{VALUE}}',
				],
				'separator' => 'before'
            ]
        );

		$this->end_controls_section(); // End Controls Section

		anant_pro_promotion_controls($this);

		// Blog Meta Author
		$this->start_controls_section(
			'single_blog_meta_author_img_settings',
			[
				'label' => __( 'Author Image Settings ', 'anant-addons-for-elementor' ),
				'tab'   => Controls_Manager::TAB_STYLE,   
				'condition' => [
					'select_post_meta' => 'author'
				],
			]
		);
		
		$slug = 'single_blog_meta_author';

		$this->add_responsive_control(
			$slug.'_img_size',
			[
				'label' => esc_html__( 'Size', 'anant-addons-for-elementor' ),
				'type' => Controls_Manager::SLIDER,

				'size_units'      => [ 'px', '%' ],
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
				'range'           => [
					'px' => [
						'min' => 1,
						'max' => 200,
					],
					'%' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'selectors' => [
					'{{WRAPPER}} a.ant-single-author-pic img' => 'width: {{SIZE}}{{UNIT}};',
				],
			]
		);

		
		anant_border_control(
			$this,
			[
				'name'     => $slug.'_img_border_type',
				'label'    => 'Border Type',
				'selector' => '{{WRAPPER}} a.ant-single-author-pic img',
			]
		);

		anant_border_radius_control(
			$this,
			[
				'key'       => $slug.'_img_border_radius',
				'label'     => 'Border Radius',
				'selectors' => [
					'{{WRAPPER}} a.ant-single-author-pic img' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			$slug.'_img_margin',
			[
				'label'     => esc_html__('Margin', 'anant-addons-for-elementor'),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}}  a.ant-single-author-pic img'  => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->end_controls_section();

		$slug = 'meta_style';

		$this->start_controls_section(
			$slug,
			[
				'label' => __( 'Metas Settings', 'anant-addons-for-elementor' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);
		$this->add_control(
			$slug.'_color',
			[
				'label' => esc_html__( 'Color', 'anant-addons-for-elementor' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .ant-blog-meta span a' => 'color: {{VALUE}};',
					'{{WRAPPER}} .ant-blog-meta span' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			$slug.'_color_hover',
			[
				'label' => esc_html__( 'Hover Color', 'anant-addons-for-elementor' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .ant-blog-meta span a:hover' => 'color: {{VALUE}};',
					'{{WRAPPER}} .ant-blog-meta span:hover' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			$slug.'_icon_color',
			[
				'label' => esc_html__( 'Icon Color', 'anant-addons-for-elementor' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .ant-blog-meta span i' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			$slug.'_icon_hover_color',
			[
				'label' => esc_html__( 'Hover Icon Color', 'anant-addons-for-elementor' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .ant-blog-meta span:hover i' => 'color: {{VALUE}};',
				],
			]
		);

		anant_typography_control(
			$this,
			[
				'name'     =>  $slug.'_typography',
				'label'    => 'Typography',
				'selector' => '{{WRAPPER}} .ant-blog-meta span',
			]
		);

		$this->add_responsive_control(
			$slug.'_margin',
			[
				'label'     => esc_html__('Margin', 'anant-addons-for-elementor'),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .ant-blog-meta span' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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

		if ($post) {
			// Get the post date
			$post_date = mysql2date('Y-m-d', $post->post_date);
		
			// Get the year, month, and day
			list($year, $month, $day) = explode('-', $post_date);
		
			// Get the date archive URL
			$date_url = get_day_link($year, $month, $day);
		}
		
		$date_format = $settings['date_format'];
		$time_format = $settings['time_format'];
		$author_by	 = $settings['by_author'] === 'yes' ? esc_html('By','anant-addons-for-elementor') : '';
		$author_id   = $post->post_author;
		$author_name = get_the_author_meta('display_name', $author_id);
		?>
		
		<div class="anant-single-blog-meta">
			<div class="ant-blog-meta">
			<?php foreach ($settings['select_post_meta'] as $meta) {
					switch ($meta) {
						case 'author':
							?>
							<span class="ant-single-author">
								<a class="ant-single-author-pic" href="<?php echo esc_url(get_author_posts_url($author_id)); ?>">
									<?php echo get_avatar($author_id, 150); ?> <?php echo $author_by; ?> <?php echo $author_name; ?>
								</a>
							</span>
							<?php
						break;
		
						case 'date':
							if ($date_format === 'default') :
								?>
								<span class="ant-single-blog-date">
									<i class="far fa-calendar-alt"></i>
									<a href="<?php echo esc_url($date_url); ?>">
										<?php echo get_the_date('M j, Y', $post); ?>
									</a>
								</span>
								<?php
							endif;
						break;
		
						case 'time':
							if ($time_format == 'g:i a') :
								?>
								<span class="ant-single-blog-time">
									<i class="far fa-clock"></i>
									<a href="<?php echo esc_url($date_url); ?>">
										<?php echo get_the_time($time_format, $post); ?>
									</a>
								</span>
								<?php
							endif;
						break;
		
						case 'comment':
							?>
							<span class="ant-comments-link">
								<i class="far fa-comments"></i>
								<a href="<?php the_permalink($post); ?>#comment">
									<?php echo get_comments_number($post); ?> <?php esc_html_e('Comments', 'anant-addons-for-elementor'); ?>
								</a>
							</span>
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