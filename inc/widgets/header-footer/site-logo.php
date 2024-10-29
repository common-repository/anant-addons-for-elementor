<?php namespace AnantAddons;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Image_Size;

if ( ! defined( 'ABSPATH' ) ) { exit; } // Exit if accessed directly

class AnantSiteLogo extends \Elementor\Widget_Base {

    private $site_logo_class = 'ant-site-logo-header';

    public function __construct( $data = array(), $args = null ) {
        parent::__construct( $data, $args );
    }

    public function get_name() {
        return 'anant-site-logo';
    }

    public function get_title() {
        return __( 'Site Logo', 'anant-addons-for-elementor' );
    }

    public function get_icon() {
        return 'ant-icon eicon-site-logo';
    }

    public function get_categories() {
        return array( 'anant-hf-elements' );
    }

    public function get_style_depends() {
        return array( '' );
    }

    public function get_script_depends() {
        return array('');

    }

    public function get_keywords() {
        return [
            'site logo',
            'logo', 
            'anant eddons',
            '',
            'header footer',
        ];
    }


    protected function register_controls() {

        $this->start_controls_section(
            'section_content',
            array(
                'label' => esc_html__( 'Logo', 'anant-addons-for-elementor' ),                    
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
            )
        );

        $this->add_control(
            'use',
            array(
                'label'   => __( 'Use', 'anant-addons-for-elementor' ),
                'type'    => Controls_Manager::SELECT,
                'default' => 'site',
                'options' => array(
                    'site'   => 'Site Logo',
                    'custom' => 'Custom Logo',
                ),
            )
        );

        $this->add_control(
            'image',
            array(
                'label'     => __( 'Logo Custom', 'anant-addons-for-elementor' ),
                'type'      => \Elementor\Controls_Manager::MEDIA,
                'default' => [
                    'url' => \Elementor\Utils::get_placeholder_image_src(),
                ],
                'condition' => array(
                    'use' => 'custom',
                ),
            )
        );

        $this->add_group_control(
            Group_Control_Image_Size::get_type(),
            array(
                'name'        => 'thumbnail',
                'default'     => 'full',
                'label'       => esc_html__( 'Logo Size', 'anant-addons-for-elementor' ),
                'description' => esc_html__( 'Custom Logo size when selected image.', 'anant-addons-for-elementor' ),
                'condition'   => array(
                    'use' => 'custom',
                ),
            )
        );

        $this->add_responsive_control(
            'align',
            array(
                'label'     => esc_html__( 'Alignment', 'anant-addons-for-elementor' ),
                'type'      => Controls_Manager::CHOOSE,
                'default'   => '',
                'selectors' => array(
                    '{{WRAPPER}} .'.$this->site_logo_class => 'text-align: {{VALUE}};',
                ),
                'options'   => array(
                    'left'   => array(
                        'icon'  => 'eicon-h-align-left',
                        'title' => 'Left',
                    ),
                    'center' => array(
                        'icon'  => 'eicon-h-align-center',
                        'title' => 'Center',
                    ),
                    'right'  => array(
                        'icon'  => 'eicon-h-align-right',
                        'title' => 'Right',
                    ),
                ),
            )
        );

        $this->end_controls_section();

        anant_pro_promotion_controls($this);

        $this->start_controls_section(
            'section_style',
            array(
                'label' => esc_html__( 'Logo Setting', 'anant-addons-for-elementor' ),                    
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
            )
        );

        $this->add_responsive_control(
            'image_width',
            [
                'label' => esc_html__( 'Width', 'anant-addons-for-elementor' ),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'size_units' => [ 'px', '%', 'vw' ],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 1000,
                        'step' => 5,
                    ],
                    '%' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                    'vw' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .'.$this->site_logo_class.' a img' => 'width: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'logo_bg_color',
            [
                'label'     => __( 'Background Color', 'anant-addons-for-elementor' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}}  .'.$this->site_logo_class => 'background-color: {{VALUE}}',
                ],
            ]
        );

        anant_border_control(
            $this,
            [
                'name'     => 'logo_border_type',
                'label'    => 'Border Type',
                'selector' => '{{WRAPPER}} .'.$this->site_logo_class,
            ]
        );

        anant_border_radius_control(
            $this,
            [
                'key'       => 'logo_border_radius',
                'label'     => 'Border Radius',
                'selectors' => [
                    '{{WRAPPER}} .'.$this->site_logo_class => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    '{{WRAPPER}} .'.$this->site_logo_class => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->end_controls_section();
    }

    protected function render() {

        $settings = $this->get_settings_for_display(); ?>
        <div class="ant-site-logo-header">
        <?php
        if ( 'site' === $settings['use'] || empty( $settings['image']['id'] ) ) {

            if ( has_custom_logo() ) :
                the_custom_logo();
            else :
                if ( is_user_logged_in() ) {
                    echo esc_html__( 'Please go to customize choose logo for site', 'anant-addons-for-elementor' );
                } else {
                ?>
                    <h1 class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h1>
                <?php
                }
            endif;
        } else {

            $url = Group_Control_Image_Size::get_attachment_image_src( $settings['image']['id'], 'thumbnail', $settings );
            ?>
            <a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home">
                <img src="<?php echo esc_url( $url ); ?>" alt="Logo" class="custom-logo">
            </a>
            <?php
        }
        ?>
    </div>
    <?php
    }
}