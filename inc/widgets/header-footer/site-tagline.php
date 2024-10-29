<?php namespace AnantAddons;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Typography;
use Elementor\Core\Kits\Documents\Tabs\Global_Typography;
use Elementor\Group_Control_Text_Shadow;
use Elementor\Core\Kits\Documents\Tabs\Global_Colors;

if ( ! defined( 'ABSPATH' ) ) { exit; } // Exit if accessed directly

class AnantSiteTagline extends Widget_Base {

    private $tagline_icon_class = 'ant-tagline-icon';
    private $tagline_icon_class_hover = 'ant-tagline-icon:hover';
    private $tagline_class = 'ant-site-tagline';

    protected $copyright_index = 1;

    public function __construct( $data = array(), $args = null ) {
        parent::__construct( $data, $args );
    }

    public function get_name() {
        return 'anant-site-tagline';
    }

    public function get_title() {
        return __( 'Site Tagline', 'anant-addons-for-elementor' );
    }

    public function get_icon() {
        return 'ant-icon eicon-text-area';
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
            'site tagline',
            'tagline',
            'header footer', 
            'anant eddons',
            '',
        ];
    }

    protected function register_controls() {
        
        $this->start_controls_section(
            'section_general_fields',
            [
                'label' => __( 'Style', 'anant-addons-for-elementor' ),
            ]
        );

        $this->add_control(
            'before',
            [
                'label'   => __( 'Before Title Text', 'anant-addons-for-elementor' ),
                'type'    => Controls_Manager::TEXTAREA,
                'rows'    => '1',
                'dynamic' => [
                    'active' => true,
                ],
            ]
        );

        $this->add_control(
            'after',
            [
                'label'   => __( 'After Title Text', 'anant-addons-for-elementor' ),
                'type'    => Controls_Manager::TEXTAREA,
                'rows'    => '1',
                'dynamic' => [
                    'active' => true,
                ],
            ]
        );

        $this->add_control(
            'icon',
            [
                'label'       => __( 'Icon', 'anant-addons-for-elementor' ),
                'type'        => Controls_Manager::ICONS,
                'label_block' => 'true',
            ]
        );

        $this->add_control(
            'icon_indent',
            [
                'label'     => __( 'Icon Spacing', 'anant-addons-for-elementor' ),
                'type'      => Controls_Manager::SLIDER,
                'range'     => [
                    'px' => [
                        'max' => 50,
                    ],
                ],
                'condition' => [
                    'icon[value]!' => '',
                ],
                'selectors' => [
                    '{{WRAPPER}} .'.$this->tagline_icon_class.' ' => 'margin-right: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'heading_text_align',
            [
                'label'              => __( 'Alignment', 'anant-addons-for-elementor' ),
                'type'               => Controls_Manager::CHOOSE,
                'options'            => [
                    'left'    => [
                        'title' => __( 'Left', 'anant-addons-for-elementor' ),
                        'icon'  => 'eicon-text-align-left',
                    ],
                    'center'  => [
                        'title' => __( 'Center', 'anant-addons-for-elementor' ),
                        'icon'  => 'eicon-text-align-center',
                    ],
                    'right'   => [
                        'title' => __( 'Right', 'anant-addons-for-elementor' ),
                        'icon'  => 'eicon-text-align-right',
                    ],
                    'justify' => [
                        'title' => __( 'Justify', 'anant-addons-for-elementor' ),
                        'icon'  => 'eicon-text-align-justify',
                    ],
                ],
                'selectors'          => [
                    '{{WRAPPER}} .'.$this->tagline_class.' ' => 'text-align: {{VALUE}};',
                ],
                'frontend_available' => true,
            ]
        );
        $this->end_controls_section();

        anant_pro_promotion_controls($this);
        
        $this->start_controls_section(
            'section_style',
            array(
                'label' => esc_html__( 'Site Tagline', 'anant-addons-for-elementor' ),                    
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
            )
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'     => 'tagline_typography',
                'global'   => [
                    'default' => Global_Typography::TYPOGRAPHY_SECONDARY,
                ],
                'selector' => '{{WRAPPER}} .'.$this->tagline_class.' ',
            ]
        );
        $this->add_control(
            'tagline_color',
            [
                'label'     => __( 'Color', 'anant-addons-for-elementor' ),
                'type'      => Controls_Manager::COLOR,
                'global'    => [
                    'default' => Global_Colors::COLOR_SECONDARY,
                ],
                'selectors' => [
                    '{{WRAPPER}} .'.$this->tagline_class.' ' => 'color: {{VALUE}};',
                    '{{WRAPPER}} .ant-tagline-icon i'       => 'color: {{VALUE}};',
                    '{{WRAPPER}} .ant-tagline-icon svg'     => 'fill: {{VALUE}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'icon_size',
            [
                'label'           => __( 'Icon Size', 'anant-addons-for-elementor' ),
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
                    'size' =>  '',
                    'unit' => 'px',
                ],
                'tablet_default'  => [
                    'size' =>  '',
                    'unit' => 'px',
                ],
                'mobile_default'  => [
                    'size' =>  '',
                    'unit' => 'px',
                ],
                'selectors'       => [
                    '{{WRAPPER}} .'.$this->tagline_icon_class.' i' => 'font-size: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'icon_color',
            [
                'label'     => __( 'Icon Color', 'anant-addons-for-elementor' ),
                'type'      => Controls_Manager::COLOR,
                'global'    => [
                    'default' => Global_Colors::COLOR_PRIMARY,
                ],
                'condition' => [
                    'icon[value]!' => '',
                ],
                'default'   => '',
                'selectors' => [
                    '{{WRAPPER}} .'.$this->tagline_icon_class.' i'   => 'color: {{VALUE}};',
                    '{{WRAPPER}} .'.$this->tagline_icon_class.' svg' => 'fill: {{VALUE}};',
                ],
            ]
        );
        $this->add_control(
            'icons_hover_color',
            [
                'label'     => __( 'Icon Hover Color', 'anant-addons-for-elementor' ),
                'type'      => Controls_Manager::COLOR,
                'condition' => [
                    'icon[value]!' => '',
                ],
                'default'   => '',
                'selectors' => [
                    '{{WRAPPER}} .'.$this->tagline_icon_class_hover.' i'   => 'color: {{VALUE}};',
                    '{{WRAPPER}} .'.$this->tagline_icon_class_hover.' svg' => 'fill: {{VALUE}};',
                ],
            ]
        );
        $this->add_responsive_control(
            'site_title_padding',
            [
				'label'     => esc_html__('Padding', 'anant-addons-for-elementor'),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
                'selectors' => [
                    '{{WRAPPER}}  .'.$this->tagline_class.' ' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->add_responsive_control(
            'site_title_margin',
            [
				'label'     => esc_html__('Margin', 'anant-addons-for-elementor'),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
                'selectors' => [
                    '{{WRAPPER}}  .'.$this->tagline_class.' ' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->end_controls_section();  
    }

    protected function render() {
        
    $settings = $this->get_settings_for_display(); ?>

    <div class="ant-site-tagline ant-site-tagline-wrapper">
        <?php if ( '' !== $settings['icon']['value'] ) { ?>
            <span class="ant-tagline-icon">
                <?php \Elementor\Icons_Manager::render_icon( $settings['icon'], [ 'aria-hidden' => 'true' ] ); ?>					
            </span>
        <?php } ?>
        <span>
        <?php
        if ( '' !== $settings['before'] ) {
            echo wp_kses_post( $settings['before'] );
        }
        ?>
        <?php echo wp_kses_post( get_bloginfo( 'description' ) ); ?>
        <?php
        if ( '' !== $settings['after'] ) {
            echo ' ' . wp_kses_post( $settings['after'] );
        }
        ?>
        </span>
    </div>
    <?php
    }        
}