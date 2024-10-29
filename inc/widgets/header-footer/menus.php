<?php namespace AnantAddons; 

use Elementor\Controls_Stack;
use Elementor\Core\Schemes\Typography;
use Elementor\Core\Schemes\Color;
use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Image_Size;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Base;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Box_Shadow; 
use Elementor\Scheme_Color;
use Elementor\Utils;
use Elementor\Repeater;

if ( ! defined( 'ABSPATH' ) ) { exit; } // Exit if accessed directly

class AnantNavMenu extends Widget_Base {

    protected $nav_menu_index = 1;

    public function __construct( $data = array(), $args = null ) {
        parent::__construct( $data, $args );
    }

    public function get_name() {
        return 'anant-nav-menu';
    }

    public function get_title() {
        return __( 'Menus', 'anant-addons-for-elementor' );
    }

    public function get_icon() {
        return 'ant-icon eicon-nav-menu';
    }

    public function get_categories() {
        return array( 'anant-hf-elements' );
    }

    public function get_style_depends() {
        return [
            'anant-styles-css',
            'anant-menu-css',
        ];

    }

    public function get_script_depends() {
        return [
            'anant-custom-js',
        ];
    }

    public function get_keywords() {
        return [
            'nav menus',
            'menus',
            'navigation', 
            'anant addons',
            '',
            'header footer',
        ];
    }

    protected function get_nav_menu_index() {
        return $this->nav_menu_index++;
    }

    private function get_available_menus() {
        $menus = wp_get_nav_menus();

        $options = array();

        foreach ( $menus as $menu ) {
            $options[ $menu->slug ] = $menu->name;
        }

        return $options;
    }

    protected function register_controls() {

        $this->start_controls_section(
            'section_menu',
            array(
                'label' => __( 'Menu', 'anant-addons-for-elementor' ),
            )
        );

        $menus = $this->get_available_menus();

        if ( ! empty( $menus ) ) {
            $this->add_control(
                'menu',
                array(
                    'label'       => __( 'Menu', 'anant-addons-for-elementor' ),
                    'type'        => Controls_Manager::SELECT,
                    'options'     => $menus,
                    'default'     => array_keys( $menus )[0],
                    'description' => sprintf( __( 'To manage nav menus, navigate to <a href="%s" target="_blank">Menus admin</a>.', 'anant-addons-for-elementor' ), admin_url( 'nav-menus.php' ) ),
                )
            );
        } else {
            $this->add_control(
                'menu',
                array(
                    'type'            => Controls_Manager::RAW_HTML,
                    'raw'             => sprintf( __( '<strong>It seems no menus are created.</strong><br>Navigate to <a href="%s" target="_blank">Menus admin</a> and create one.', 'anant-addons-for-elementor' ), admin_url( 'nav-menus.php?action=edit&menu=0' ) ),
                    'content_classes' => 'elementor-panel-alert elementor-panel-alert-info',
                )
            );
        }

        $this->add_control(
            'menu_type',
            array(
                'label'       => __( 'Type', 'anant-addons-for-elementor' ),
                'type'        => Controls_Manager::SELECT,
                'options'   => array(
                    'horizontal'    => 'Horizontal',
                    'vertical'    => 'Vertical (Pro)',
                ),
                'default'     => 'horizontal',
            )
        );

        $this->add_control(
			'anant_menus_pro_notice',
			[
				'raw' => 'Only Available in <a href="https://anantaddons.com/" target="_blank">Pro Version!</a>',
				'type' => \Elementor\Controls_Manager::RAW_HTML,
				'content_classes' => 'anant-pro-notice',
				'condition' => [
                    'menu_type!' => ['horizontal'],
                ],
			]
		);

        $this->add_control(
            'menu_is_sticky',
            array(
                'label'              => esc_html__( 'Sticky Menu', 'anant-addons-for-elementor' ) .' <i class="eicon-pro-icon"></i>' ,
                'type'               => Controls_Manager::SWITCHER,
                'label_on'     => __( 'Show', 'anant-addons-for-elementor' ),
                'label_off'    => __( 'Hide', 'anant-addons-for-elementor' ),
                'return_value' => 'yes',
                'default'      => 'no', 
                'classes' => 'anant-pro-popup-notice',
				'escape' => false,
            )
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'section_layout',
            array(
                'label' => __( 'Layout', 'anant-addons-for-elementor' ),
            )
        );

        $this->add_responsive_control(
            'align_items',
            [
                'label' => esc_html__( 'Menu Alignment', 'anant-addons-for-elementor' ),
                'type' => \Elementor\Controls_Manager::CHOOSE,
                'default' => 'center', 
                'options' => [
                    'flex-star' => [
                        'title' => esc_html__( 'Left', 'anant-addons-for-elementor' ),
                        'icon' => 'eicon-text-align-left',
                    ],
                    'center' => [
                        'title' => esc_html__( 'Center', 'anant-addons-for-elementor' ),
                        'icon' => 'eicon-text-align-center',
                    ],
                    'flex-end' => [
                        'title' => esc_html__( 'Right', 'anant-addons-for-elementor' ),
                        'icon' => 'eicon-text-align-right',
                    ],
                ],
                'selectors' =>[
                    '{{WRAPPER}} #ant-main-menu ' => 'justify-content:{{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'indicator_icon',
            [
                'label'       => esc_html__( 'Submenu Indicator', 'anant-addons-for-elementor' ),
                'type'        => \Elementor\Controls_Manager::SELECT,
                'default'     => '\f0d7',
                'options'     => [
                ''                          => esc_html__( 'None', 'anant-addons-for-elementor' ),
                '\f0d7'                     => esc_html__( 'Classic ', 'anant-addons-for-elementor' ),
                '\f107'                      => esc_html__( 'Angle ', 'anant-addons-for-elementor' ),
                '\f103'                      => esc_html__( 'Double Angle ', 'anant-addons-for-elementor' ),
                '\f078'                      => esc_html__( 'Chevron ', 'anant-addons-for-elementor' ),
                '\f067'                      => esc_html__( 'Plus ', 'anant-addons-for-elementor' ),
                ],
                'selectors' =>[
                    '{{WRAPPER}} .ant-main-menu li.has-children > a.ant-sub-item::after'=> 'content:"{{VALUE}}";',
                    '{{WRAPPER}} .ant-main-menu .menu-item.has-children .arrow-sb::before'=> 'content:"{{VALUE}}";' 
                ],
            ]
        );

        $this->add_control(
            'full_width_dropdown',
            array(
                'label'              => esc_html__( 'Full Width', 'anant-addons-for-elementor' ) .' <i class="eicon-pro-icon"></i>' ,
                'type'               => Controls_Manager::SWITCHER,
                'label_on'     => __( 'Show', 'anant-addons-for-elementor' ),
                'label_off'    => __( 'Hide', 'anant-addons-for-elementor' ),
                'return_value' => 'yes',
                'default'      => 'no', 
                'classes' => 'anant-pro-popup-notice',
				'escape' => false,
            )
        );
        
        $this->add_control(
            'heading_responsive',
            [
                'type'      => Controls_Manager::HEADING,
                'label'     => __( 'Responsive', 'anant-addons-for-elementor' ),
                'separator' => 'before',
            ]
        );

        $this->add_control(
            'toggle_responsive',
            [
                'label'        => __( 'Breakpoint', 'anant-addons-for-elementor' ),
                'type'         => Controls_Manager::SELECT,
                'default'      => 'nav-menu-dropdown-tablet',
                'options'      => [
                    'nav-menu-dropdown-tablet' => __( 'Tablet', 'anant-addons-for-elementor' ),
                    'nav-menu-dropdown-mobile' => __( 'Mobile', 'anant-addons-for-elementor' ),
                    'nav-menu-dropdown-none' => __( 'None', 'anant-addons-for-elementor' ),
                ],
            ]
        );

        $this->add_control(
            'toggle_align',
            array(
                'label'                => __( 'Toggle Align', 'anant-addons-for-elementor' ),
                'type'                 => Controls_Manager::CHOOSE,
                'default'              => 'center',
                'options'              => array(
                    'left'   => array(
                        'title' => __( 'Left', 'anant-addons-for-elementor' ),
                        'icon'  => 'eicon-h-align-left',
                    ),
                    'center' => array(
                        'title' => __( 'Center', 'anant-addons-for-elementor' ),
                        'icon'  => 'eicon-h-align-center',
                    ),
                    'right'  => array(
                        'title' => __( 'Right', 'anant-addons-for-elementor' ),
                        'icon'  => 'eicon-h-align-right',
                    ),
                ),
                'condition' => [
                    'toggle_responsive!' => 'none',
                ],
                'selectors' =>[
                    '{{WRAPPER}} .ant-mm-mobile-btn'=> 'justify-content:{{VALUE}};' 
                ],
            )
        );

        $this->end_controls_section(); 

        anant_pro_promotion_controls($this);
    
        $this->start_controls_section(
            'section_style_main_menu',
            array(
                'label' => __( 'Menu Box', 'anant-addons-for-elementor' ),
                'tab'   => Controls_Manager::TAB_STYLE,
            )
        );
        $this->start_controls_tabs(
            'main_menu_tabs'
        );
        
        $this->start_controls_tab(
            'main_menu_normal_tab',
            [
                'label' => esc_html__( 'Normal', 'anant-addons-for-elementor' ),
            ]
        );
        $this->add_control(
            'main_menu_color',
            array(
                'label'     => __( 'Background Color', 'anant-addons-for-elementor' ),
                'type'      => Controls_Manager::COLOR,
                'default'   => '',
                'selectors' =>[
                    '{{WRAPPER}} #ant-main-nav' => 'background-color: {{VALUE}}',
                ],
            )
        );
        $this->add_group_control(
            \Elementor\Group_Control_Border::get_type(),
            [
                'name' => 'main_menu_border',
                'label' => esc_html__( 'Border', 'anant-addons-for-elementor' ),
                'selector' => '{{WRAPPER}} #ant-main-nav',
            ]
        );
            
        $this->add_responsive_control(
            'main_menu_border_radius',
            array(
                'label'      => __( 'Border Radius', 'anant-addons-for-elementor' ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%','em'],
                'devices' => [ 'desktop', 'tablet', 'mobile' ],
                'desktop_default' => [
                    'size' => '',
                    'unit' => 'px',
                ],
                'tablet_default' => [
                    'size' => '',
                    'unit' => 'px',
                ],
                'mobile_default' => [
                    'size' => '',
                    'unit' => 'px',
                ],
                'selectors'  => [
                    '{{WRAPPER}} #ant-main-nav' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}} !important;',
                ],
            )
        );
        $this->add_responsive_control(
            'main_menu_padding',
            array(
                'label'      => __( 'Padding', 'anant-addons-for-elementor' ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%','em'],
                'selectors'  => [
                    '{{WRAPPER}} #ant-main-nav' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            )
        );
        $this->add_responsive_control(
            'main_menu_margin',
            array(
                'label'      => __( 'Margin', 'anant-addons-for-elementor' ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%','em'],
                'selectors'  => [
                    '{{WRAPPER}} #ant-main-nav' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            )
        );
        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            array(
                'name'     => 'main_menu_box_shadow',
                'label'     => esc_html__( 'Box Shadow'),
                'selector' => '{{WRAPPER}}  #ant-main-nav',
            )
        );

        $this->end_controls_tab();
        $this->start_controls_tab(
            'main_menu_hover_tab',
            [
                'label' => esc_html__( 'Hover', 'anant-addons-for-elementor' ),
            ]
        );

        $this->add_control(
            'main_menu_color_hover',
            array(
                'label'     => __( 'Background Color', 'anant-addons-for-elementor' ),
                'type'      => Controls_Manager::COLOR,
                'default'   => '',
                'selectors' =>[
                    '{{WRAPPER}} #ant-main-nav:hover' => 'background-color: {{VALUE}}',
                ],
            )
        );
        $this->add_group_control(
            \Elementor\Group_Control_Border::get_type(),
            [
                'name' => 'main_menu_border_hover',
                'label' => esc_html__( 'Border', 'anant-addons-for-elementor' ),
                'selector' => '{{WRAPPER}}  #ant-main-nav:hover',
            ]
        );
            
        $this->add_responsive_control(
            'main_menu_border_radius_hover',
            array(
                'label'      => __( 'Border Radius', 'anant-addons-for-elementor' ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em' ],
                'devices' => [ 'desktop', 'tablet', 'mobile' ],
                'desktop_default' => [
                    'size' => '',
                    'unit' => 'px',
                ],
                'tablet_default' => [
                    'size' => '',
                    'unit' => 'px',
                ],
                'mobile_default' => [
                    'size' => '',
                    'unit' => 'px',
                ],
                'selectors' =>[
                    '{{WRAPPER}} #ant-main-nav:hover' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            )
        );
        $this->add_responsive_control(
            'main_menu_padding_hover',
            array(
                'label'      => __( 'Padding', 'anant-addons-for-elementor' ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%','em'],
                'selectors' =>[
                    '{{WRAPPER}} #ant-main-nav:hover' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            )
        );
        $this->add_responsive_control(
            'main_menu_margin_hover',
            array(
                'label'      => __( 'Margin', 'anant-addons-for-elementor' ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%','em'],
                'selectors' =>[
                    '{{WRAPPER}} #ant-main-nav:hover' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            )
        );
        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            array(
                'name'     => 'main_menu_box_shadow_hover',
                'label'     => esc_html__( 'Box Shadow'),
                'selector' => '{{WRAPPER}}  #ant-main-nav:hover',
            )
        );
        $this->end_controls_tab();
        $this->end_controls_tabs();
        $this->end_controls_section(); 

        $this->start_controls_section(
            'menus_style',
            array(
                'label' => __( 'Menus', 'anant-addons-for-elementor' ),
                'tab'   => Controls_Manager::TAB_STYLE,
            )
        );

        $this->start_controls_tabs(
            'menus_tabs'
        );
        
        $this->start_controls_tab(
            'menus_normal_tab',
            [
                'label' => esc_html__( 'Normal', 'anant-addons-for-elementor' ),
            ]
        );

        $this->add_control(
            'menus_color',
            array(
                'label'     => __( 'Color', 'anant-addons-for-elementor' ),
                'type'      => Controls_Manager::COLOR,
                'default'   => '',
                'selectors' =>[
                    '{{WRAPPER}} #ant-main-nav .menu-item a.sub-link' => 'color: {{VALUE}}',
                    '{{WRAPPER}} #ant-main-nav .menu-item a.sub-link + .arrow-sb:before' => 'color: {{VALUE}}',
                ],
            )
        );

        $this->add_control(
            'menus_bg_color',
            array(
                'label'     => __( 'Background Color', 'anant-addons-for-elementor' ),
                'type'      => Controls_Manager::COLOR,
                'default'   => '',
                'selectors' =>[
                    '{{WRAPPER}} .ant-main-menu > .menu-item' => 'background-color: {{VALUE}}',
                    '{{WRAPPER}} #ant-main-nav .menu-item .arrow-sb' => 'background-color: {{VALUE}}',
                ],
            )
        );

        $this->end_controls_tab();

        $this->start_controls_tab(
            'menus_hover_tab',
            [
                'label' => esc_html__( 'Hover', 'anant-addons-for-elementor' ),
            ]
        );

        $this->add_control(
            'menus_color_hover',
            array(
                'label'     => __( ' Color', 'anant-addons-for-elementor' ),
                'type'      => Controls_Manager::COLOR,
                'default'   => '',
                'selectors' =>[
                    '{{WRAPPER}} #ant-main-nav .menu-item:hover a.sub-link' => 'color: {{VALUE}}',
                    '{{WRAPPER}} #ant-main-nav .active li.menu-item a.sub-link' => 'color: {{VALUE}}',
                    '{{WRAPPER}} #ant-main-nav .menu-item:hover a.sub-link + .arrow-sb:before' => 'color: {{VALUE}}',
                ],
            )
        );

        $this->add_control(
            'menus_color_bg_hover',
            array(
                'label'     => __( 'Background Color', 'anant-addons-for-elementor' ),
                'type'      => Controls_Manager::COLOR,
                'default'   => '',
                'selectors' =>[
                    '{{WRAPPER}} .ant-main-menu > .menu-item:hover' => 'background-color: {{VALUE}}',
                    '{{WRAPPER}} #ant-main-nav .active li.menu-item  a.sub-link' => 'background-color: {{VALUE}}',
                    '{{WRAPPER}} #ant-main-nav .menu-item:hover .arrow-sb' => 'background-color: {{VALUE}}',    
                ],
            )
        );
    
        $this->end_controls_tab();
        $this->end_controls_tabs();

        $this->add_control(
			'hr',
			[
				'type' => Controls_Manager::DIVIDER,
			]
		);

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            array(
                'name'      => 'menus_typography',
                'label'     => __( 'Typography', 'anant-addons-for-elementor' ), 
                'selector'  => '{{WRAPPER}} #ant-main-nav .menu-item a.sub-link', 
            )
        ); 
        $this->add_group_control(
            \Elementor\Group_Control_Border::get_type(),
            [
                'name' => 'menus_border',
                'label' => esc_html__( 'Border', 'anant-addons-for-elementor' ),
                'selector' => '{{WRAPPER}} .ant-main-menu > .menu-item',
            ]
        );
            
        $this->add_responsive_control(
            'menus_border_radius',
            array(
                'label'      => __( 'Border Radius', 'anant-addons-for-elementor' ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%','em'],
                'devices' => [ 'desktop', 'tablet', 'mobile' ],
                'desktop_default' => [
                    'size' => '',
                    'unit' => 'px',
                ],
                'tablet_default' => [
                    'size' => '',
                    'unit' => 'px',
                ],
                'mobile_default' => [
                    'size' => '',
                    'unit' => 'px',
                ],
                'selectors'  => [
                    '{{WRAPPER}} .ant-main-menu > .menu-item' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            )
        );
        $this->add_responsive_control(
            'menus_padding',
            array(
                'label'      => __( 'Padding', 'anant-addons-for-elementor' ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%','em'],
                'selectors'  => [
                    '{{WRAPPER}} .ant-main-menu > .menu-item' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            )
        );
        $this->add_responsive_control(
            'menus_margin',
            array(
                'label'      => __( 'Margin', 'anant-addons-for-elementor' ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%','em'],
                'selectors'  => [
                    '{{WRAPPER}} .ant-main-menu > .menu-item' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            )
        );
        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            array(
                'name'     => 'menus_box_shadow',
                'label'     => esc_html__( 'Box Shadow'),
                'selector' => '{{WRAPPER}} .ant-main-menu > .menu-item',
            )
        );

        $this->end_controls_section(); 
        
        $this->start_controls_section(
            'section_style_dropdown',
            array(
                'label' => __( 'Dropdown', 'anant-addons-for-elementor' ),
                'tab'   => Controls_Manager::TAB_STYLE,
            )
        );
        $this->add_control(
            'dropdown_description',
            array(
                'raw'             => __( 'On desktop, this will affect the submenu. On mobile, this will affect the entire menu.', 'anant-addons-for-elementor' ),
                'type'            => Controls_Manager::RAW_HTML,
                'content_classes' => 'elementor-descriptor',
            )
        );

        $this->start_controls_tabs( 'tabs_dropdown_item_style' );

        $this->start_controls_tab(
            'tab_dropdown_item_normal',
            array(
                'label' => __( 'Normal', 'anant-addons-for-elementor' ),
            )
        );

        $this->add_control(
            'color_dropdown_item',
            array(
                'label'     => __( 'Color', 'anant-addons-for-elementor' ),
                'type'      => Controls_Manager::COLOR,
                'default'   => '',
                'selectors' => array(
                    '{{WRAPPER}}  #ant-main-nav .menu-item a.dropdown-item' => 'color: {{VALUE}}',
                    '{{WRAPPER}}  .ant-main-menu .menu-item .sb-menu .menu-item .arrow-sb:before' => 'color: {{VALUE}}',
                ),
            )
        );

        $this->add_control(
            'background_color_dropdown_item',
            array(
                'label'     => __( 'Background Color', 'anant-addons-for-elementor' ),
                'type'      => Controls_Manager::COLOR,
                'default'   => '',
                'selectors' => array(
                    '{{WRAPPER}} .ant-main-menu .menu-item .sb-menu .menu-item' => 'background-color: {{VALUE}}',
                    '{{WRAPPER}} #ant-main-nav .menu-item .sb-menu .menu-item .arrow-sb' => 'background-color: {{VALUE}}',
                ),
                'separator' => 'none',
            )
        );
    
        

        $this->end_controls_tab();

        $this->start_controls_tab(
            'tab_dropdown_item_hover',
            array(
                'label' => __( 'Hover', 'anant-addons-for-elementor' ),
            )
        );

        $this->add_control(
            'color_dropdown_item_hover',
            array(
                'label'     => __( 'Color', 'anant-addons-for-elementor' ),
                'type'      => Controls_Manager::COLOR,
                'default'   => '',
                'selectors' => array(
                    '{{WRAPPER}} #ant-main-nav .menu-item .sb-menu .menu-item:hover > a.dropdown-item' => 'color: {{VALUE}}',
                    '{{WRAPPER}} .ant-main-menu .menu-item .sb-menu .menu-item:hover > .arrow-sb:before' => 'color: {{VALUE}}',
                ),
            )
        );

        $this->add_control(
            'background_color_dropdown_item_hover',
            array(
                'label'     => __( 'Background Color', 'anant-addons-for-elementor' ),
                'type'      => Controls_Manager::COLOR,
                'default'   => '',
                'selectors' => array(
                    '{{WRAPPER}} .ant-main-menu .menu-item .sb-menu .menu-item:hover' => 'background-color: {{VALUE}}',
                    '{{WRAPPER}} #ant-main-nav .menu-item .sb-menu .menu-item:hover > .arrow-sb' => 'background-color: {{VALUE}}',
                ),
                'separator' => 'none',
            )
        );

        $this->end_controls_tab();
        $this->end_controls_tabs();

        $this->add_control(
			'tab_dropdown_hr',
			[
				'type' => Controls_Manager::DIVIDER,
			]
		);

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            array(
                'name'      => 'dropdown_typography',
                'label'     => __( 'Typography', 'anant-addons-for-elementor' ), 
                'selector'  => '{{WRAPPER}} #ant-main-nav .menu-item a.dropdown-item', 
            )
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            array(
                'name'      => 'dropdown_border',
                'label'     => __( 'Border', 'anant-addons-for-elementor' ),
                'selector'  => '{{WRAPPER}} .ant-main-menu .menu-item .sb-menu .menu-item', 
            )
        );

        $this->add_responsive_control(
            'dropdown_border_radius',
            array(
                'label'      => __( 'Border Radius', 'anant-addons-for-elementor' ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%','em'],
                'devices' => [ 'desktop', 'tablet', 'mobile' ],
                'desktop_default' => [
                    'size' => '',
                    'unit' => 'px',
                ],
                'tablet_default' => [
                    'size' => '',
                    'unit' => 'px',
                ],
                'mobile_default' => [
                    'size' => '',
                    'unit' => 'px',
                ],
                'selectors'  => [
                    '{{WRAPPER}} .ant-main-menu .menu-item .sb-menu .menu-item' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}} !important;',
                ],
            )
        );

        $this->add_responsive_control(
            'dropdown_padding',
            array(
                'label'      => __( 'Padding', 'anant-addons-for-elementor' ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%','em'],
                'selectors'  => [
                    '{{WRAPPER}} #ant-main-nav .menu-item a.dropdown-item' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            )
        );
        
        $this->add_responsive_control(
            'dropdown_margin',
            array(
                'label'      => __( 'Margin', 'anant-addons-for-elementor' ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%','em'],
                'selectors'  => [
                    '{{WRAPPER}} .ant-main-menu .menu-item .sb-menu .menu-item' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            )
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'section_style_toggle',
            array(
                'label' => __( 'Toggle Button', 'anant-addons-for-elementor' ),
                'tab'   => Controls_Manager::TAB_STYLE,
            )
        );
        $this->start_controls_tabs( 'tabs_toggle_style' );

        $this->start_controls_tab(
            'tab_toggle_style_normal',
            array(
                'label' => __( 'Normal', 'anant-addons-for-elementor' ),
            )
        );

        $this->add_control(
            'toggle_color',
            array(
                'label'     => __( 'Color', 'anant-addons-for-elementor' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => array(
                    '{{WRAPPER}} .ant-menu-btn' => 'color: {{VALUE}}',
                ),
            )
        );

        $this->add_control(
            'toggle_background_color',
            array(
                'label'     => __( 'Background Color', 'anant-addons-for-elementor' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => array(
                    '{{WRAPPER}} .ant-menu-btn' => 'background-color: {{VALUE}}',
                ),
            )
        );
        $this->add_control(
            'toggle_border_color',
            array(
                'label'     => __( 'Border Color', 'anant-addons-for-elementor' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => array( 
                    '{{WRAPPER}} .ant-menu-btn' => 'border-color: {{VALUE}}', // Harder selector to override text color control
                ),
            )
        );
        $this->end_controls_tab();

        $this->start_controls_tab(
            'tab_toggle_style_hover',
            array(
                'label' => __( 'Focus / Hover', 'anant-addons-for-elementor' ),
            )
        );

        $this->add_control(
            'toggle_color_hover',
            array(
                'label'     => __( 'Color', 'anant-addons-for-elementor' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => array(
                    '{{WRAPPER}} .ant-menu-btn:hover' => 'color: {{VALUE}}',
                ),
            )
        );

        $this->add_control(
            'toggle_background_color_hover',
            array(
                'label'     => __( 'Background Color', 'anant-addons-for-elementor' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => array(
                    '{{WRAPPER}} .ant-menu-btn:hover' => 'background-color: {{VALUE}}',
                ),
            )
        );
        $this->add_control(
            'toggle_border_color_hover',
            array(
                'label'     => __( 'Border Color', 'anant-addons-for-elementor' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => array( 
                    '{{WRAPPER}} .ant-menu-btn:hover' => 'border-color: {{VALUE}}',
                ),
            )
        );
        $this->end_controls_tab(); 
        $this->end_controls_tabs();

        $this->add_responsive_control(
            'toggle_size',
            array(
                'label'     => __( 'Size', 'anant-addons-for-elementor' ),
                'type'      => Controls_Manager::SLIDER,
                'range'     => array(
                    'px' => array(
                        'min' => 15,
                    ),
                ),
                'selectors' => array(
                    '{{WRAPPER}} .ant-menu-btn' => 'font-size: {{SIZE}}{{UNIT}}',
                ),
            )
        );

        $this->add_responsive_control(
            'toggle_wsize',
            array(
                'label'     => __( 'Wrap Size', 'anant-addons-for-elementor' ),
                'type'      => Controls_Manager::SLIDER,
                'range'     => array(
                    'px' => array(
                        'min' => 15,
                    ),
                ),
                'selectors' => array(
                    '{{WRAPPER}} .ant-menu-btn' => 'width: {{SIZE}}{{UNIT}}; height: {{SIZE}}{{UNIT}};',
                ),
            )
        );

        $this->add_responsive_control(
            'toggle_border_width',
            array(
                'label'     => __( 'Border Width', 'anant-addons-for-elementor' ),
                'type'      => Controls_Manager::SLIDER,
                'range'     => array(
                    'px' => array(
                        'max' => 10,
                    ),
                ),
                'selectors' => array(
                    '{{WRAPPER}} .ant-menu-btn' => 'border-width: {{SIZE}}{{UNIT}}',
                ),
            )
        );

        $this->add_responsive_control(
            'toggle_border_radius',
            array(
                'label'      => __( 'Border Radius', 'anant-addons-for-elementor' ),
                'type'       => Controls_Manager::SLIDER,
                'size_units' => array( 'px', '%' ),
                'selectors'  => array(
                    '{{WRAPPER}} .ant-menu-btn' => 'border-radius: {{SIZE}}{{UNIT}}',
                    '{{WRAPPER}} .ant-main-nav .mobile-menu-toggle' => 'border-radius: {{SIZE}}{{UNIT}}',
                ),
            )
        );
        $this->add_responsive_control(
            'toggle_padding',
            array(
                'label'      => __( 'Padding', 'anant-addons-for-elementor' ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%','em'],
                'selectors'  => [
                    '{{WRAPPER}} .ant-menu-btn' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            )
        );
        anant_box_shadow_control(
            $this,
            [
                'key'      => 'toggle_box_shadow',
                'label'    => 'Box Shadow',
                'selector' => '{{WRAPPER}} .ant-menu-btn',
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'style_resposive_menu',
            array(
                'label' => __( 'Mobile Menu', 'anant-addons-for-elementor' ),
                'tab'   => Controls_Manager::TAB_STYLE,
            )
        );
        $slug = 'responsive_menu';

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
				'label' => esc_html__( 'Color', 'anant-addons-for-elementor' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .show .menu-item a.sub-link' => 'color: {{VALUE}} !important;',
					'{{WRAPPER}} .show .menu-item .arrow-sb:before' => 'color: {{VALUE}} !important;',
				],
			]
		);
        $this->add_control(
			$slug.'_bg_color',
			[
				'label' => esc_html__( 'Background Color', 'anant-addons-for-elementor' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .show .menu-item' => 'background-color: {{VALUE}} !important;',
					'{{WRAPPER}} .show .menu-item .arrow-sb' => 'background-color: {{VALUE}} !important;',
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
			$slug.'_hover_color',
			[
				'label' => esc_html__( 'Color', 'anant-addons-for-elementor' ),
				'type' => Controls_Manager::COLOR,
                'selectors' =>[
                    '{{WRAPPER}} .show .menu-item:hover a.sub-link' => 'color: {{VALUE}} !important;',
                    '{{WRAPPER}} .show .active li.menu-item a.sub-link' => 'color: {{VALUE}} !important;',
                    '{{WRAPPER}} .show .menu-item:hover .arrow-sb:before' => 'color: {{VALUE}} !important;',
                ],
			]
		);
        $this->add_control(
			$slug.'_bg_hover_color',
			[
				'label' => esc_html__( 'Background Color', 'anant-addons-for-elementor' ),
				'type' => Controls_Manager::COLOR,
                'selectors' =>[
                    '{{WRAPPER}} .show .menu-item:hover' => 'background-color: {{VALUE}} !important;',
                    '{{WRAPPER}} .show .active li.menu-item  a.sub-link' => 'background-color: {{VALUE}} !important;',
                    '{{WRAPPER}} .show .menu-item:hover > .arrow-sb' => 'background-color: {{VALUE}} !important;',    
                ],
			]
		);
        $this->end_controls_tab();
        $this->end_controls_tabs();
        $this->end_controls_section();
        
    }

    protected function render() {
        
        $available_menus = $this->get_available_menus();
        $widget_id = $this->get_id();

        if ( ! $available_menus ) {
            return;
        }
        
        $settings = $this->get_settings_for_display();
        $toggle_responsive = $settings['toggle_responsive'];
        $menu_type = $settings['menu_type'];  ?>  

        <?php if($menu_type == 'horizontal'){ ?>
            <div class="header-menu <?php echo esc_attr($toggle_responsive); ?>"> 
                        
                <div class="ant-mm-mobile-btn">
                    <button class="ant-menu-btn">
                        <i class="fas fa-bars"></i>
                    </button>
                </div>

                <nav id="ant-main-nav" class="ant-nav-wp">
                
                    <?php wp_nav_menu( array(
                            'menu'        => $settings['menu'],
                            'menu_class'  => 'ant-main-menu ant-main-menu-'.$widget_id.' mobile-nav',
                            'menu_id'     => 'ant-main-menu',
                            'fallback_cb' => 'anant_nav_walker::fallback',
                            'container'   => '',
                            'walker' => new anant_nav_walker()
                        ) ); ?>
                    
                </nav>

            </div> 
        <?php } ?>         
    <?php  } 
}