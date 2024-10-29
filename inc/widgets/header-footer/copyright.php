<?php namespace AnantAddons;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Typography;

if ( ! defined( 'ABSPATH' ) ) { exit; } // Exit if accessed directly

class AnantCopyright extends Widget_Base {

    protected $copyright_index = 1;

    public function __construct( $data = array(), $args = null ) {
        parent::__construct( $data, $args );
    }

    public function get_name() {
        return 'anant-copyright';
    }

    public function get_title() {
        return __( 'Copyright', 'anant-addons-for-elementor' );
    }

    public function get_icon() {
        return 'ant-icon eicon-alert';
    }

    public function get_categories() {
        return array( 'anant-hf-elements' );
    }
    
    public function get_keywords() {
        return ['copyright',
                'header footer', 
                'anant eddons',
                '',
        ];
    }

    protected function register_controls() {

        $this->start_controls_section(
            'section_title',
            array(
                'label' => __( 'Copyright', 'anant-addons-for-elementor' ),
            )
        );

        $this->add_control(
            'copyright',
            array(
                'label'   => __( 'Copyright Text', 'anant-addons-for-elementor' ),
                'type'    => Controls_Manager::TEXTAREA,
                'dynamic' => array(
                    'active' => true,
                ),
                'default' => __( 'Copyright © [anant_year] [anant_site_tile] | All Rights Reserved. Designed by [anant_site_tile].', 'anant-addons-for-elementor' ),
            )
        );

        $this->add_responsive_control(
            'align',
            array(
                'label'     => __( 'Alignment', 'anant-addons-for-elementor' ),
                'type'      => Controls_Manager::CHOOSE,
                'options'   => array(
                    'left'   => array(
                        'title' => __( 'Left', 'anant-addons-for-elementor' ),
                        'icon'  => 'eicon-text-align-left',
                    ),
                    'center' => array(
                        'title' => __( 'Center', 'anant-addons-for-elementor' ),
                        'icon'  => 'eicon-text-align-center',
                    ),
                    'right'  => array(
                        'title' => __( 'Right', 'anant-addons-for-elementor' ),
                        'icon'  => 'eicon-text-align-right',
                    ),
                ),
                'selectors' => array(
                    '{{WRAPPER}} .ant-copyright-wrapper' => 'text-align: {{VALUE}};',
                ),
            )
        );

        $this->end_controls_section();

        anant_pro_promotion_controls($this);
        
        $this->start_controls_section(
            'section_style_copyright',
            array(
                'label' => __( 'Copyright Text', 'anant-addons-for-elementor' ),
                'tab'   => Controls_Manager::TAB_STYLE,
            )
        );

        $this->add_control(
            'text_color',
            array(
                'label'     => __( 'Color', 'anant-addons-for-elementor' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => array(
                    // Stronger selector to avoid section style from overwriting.
                    '{{WRAPPER}} .ant-copyright-wrapper' => 'color: {{VALUE}};',
                ),
            )
        );
        $this->add_group_control(
            Group_Control_Typography::get_type(),
            array(
                'name'     => 'caption_typography',
                'selector' => '{{WRAPPER}} .ant-copyright-wrapper',
            )
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'section_style_site_title',
            array(
                'label' => __( 'Site Title', 'anant-addons-for-elementor' ),
                'tab'   => Controls_Manager::TAB_STYLE,
            )
        );

        $this->add_control(
            'site_title_color',
            array(
                'label'     => __( 'Color', 'anant-addons-for-elementor' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => array(
                    // Stronger selector to avoid section style from overwriting.
                    '{{WRAPPER}} .ant-copyright-wrapper a' => 'color: {{VALUE}};',
                ),
            )
        );
        $this->add_control(
            'site_title_hover_color',
            array(
                'label'     => __( 'Hover Color', 'anant-addons-for-elementor' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => array(
                    // Stronger selector to avoid section style from overwriting.
                    '{{WRAPPER}} .ant-copyright-wrapper a:hover' => 'color: {{VALUE}};',
                ),
            )
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            array(
                'name'      => 'site_title_typography',
                'label'     => __( 'Typography', 'anant-addons-for-elementor' ), 
                'selector' => '{{WRAPPER}} .ant-copyright-wrapper a',
            )
        );

        $this->end_controls_section();

    }

    protected function render() {

    $settings             = $this->get_settings_for_display();
    $copy_right= do_shortcode( shortcode_unautop( $settings['copyright'] ) );
    ?>
    <div class="ant-copyright-wrapper">
        <div class="ant-main-wrapper">
            <span>
                <?php
                    echo wp_kses(
                        $copy_right,
                        array(
                            'a' => array(
                                'class' => array(),
                                'href'  => array(),
                                'id'    => array(),
                            ),
                        )
                    );
                ?>
            </span>
        </div>
    </div>
    <?php
    }
}