<?php use Elementor\Controls_Manager;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Box_Shadow;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Image_Size;
use Elementor\Group_Control_Text_Shadow;
use Elementor\Group_Control_Text_Stroke;

if ( ! defined( 'ABSPATH' ) ) { exit; } // Exit if accessed directly

if ( ! function_exists( 'anant_pro_promotion_controls' ) ) {
	function anant_pro_promotion_controls( $obj ){
        $obj->start_controls_section(
			'anant_section_pro',
			[
				'label' => esc_html__('Go Premium for More Features', 'anant-addons-for-elementor'),
			]
		);

		$obj->add_control(
			'anant_control_get_pro',
			[
				'label'       => esc_html__('Unlock more anant', 'anant-addons-for-elementor'),
				'type'        => Controls_Manager::CHOOSE,
				'options'     => [
					'1' => [
						'title' => '',
						'icon' => 'eicon-lock',
					],
				],
				'default'     => '1',
				'description' => ANANT_GO_PRO_HTML,
			]
		);

		$obj->end_controls_section();
    }
} 

function anant_select2_control( $obj, $params ) {
	$label       = $params['label'];
    $placeholder = isset( $params['placeholder'] ) ? esc_html( $params['placeholder'], 'anant-addons-for-elementor' ) : '';
	$key         = $params['key'];
	$default   = array_key_exists( 'default', $params ) ? $params['default'] : '';
	$classes   = array_key_exists( 'classes', $params ) ? $params['classes'] : '';
	$translated_label = esc_html( $label, 'anant-addons-for-elementor' );
	$label = array_key_exists( 'escape', $params ) && $params['escape'] == false ? esc_html( $label ) .' <i class="eicon-pro-icon"></i>'  : esc_html( $label );
	return $obj->add_control(
		$key,
		[
			'label'       => $label,
			'placeholder' => esc_html( $placeholder ),
			'type'        => Controls_Manager::SELECT2,
			'label_block' => true,
			'multiple'    => $params['multiple'],
			'default'     => $default,
			'options'     => $params['options'],
			'classes'   => $classes,
		]
	);
}

function anant_switcher_control( $obj, $params ) {
	$label     = $params['label'];
	$on_label  = $params['on_label'];
	$off_label = $params['off_label'];
	$key       = $params['key'];
	$default   = array_key_exists( 'default', $params ) ? $params['default'] : 'no';
	$description   = array_key_exists( 'description', $params ) ? $params['description'] : '';
	$classes   = array_key_exists( 'classes', $params ) ? $params['classes'] : '';
	$translated_label = esc_html( $label, 'anant-addons-for-elementor' );
	$label = array_key_exists( 'escape', $params ) && $params['escape'] == false ? esc_html( $label ) .' <i class="eicon-pro-icon"></i>'  : esc_html( $label );
	return $obj->add_control(
		$key,
		[
			'label'        =>  $label,
			'type'         => Controls_Manager::SWITCHER,
			'label_on'     => esc_html( $on_label, 'anant-addons-for-elementor' ),
			'label_off'    => esc_html( $off_label, 'anant-addons-for-elementor' ),
			'return_value' => 'yes',
			'default'      => $default,
			'description' => $description,
			'classes' => $classes,
		]
	);
}

function anant_number_control( $obj, $params ) {
	$label     = $params['label'];
	$placeholder = $params['placeholder'];
	$key         = $params['key'];
	$min         = array_key_exists( 'min', $params ) ? $params['min'] : '';
	$max         = array_key_exists( 'max', $params ) ? $params['max'] : '';
	$default     = $params['default'];
	$condition   = array_key_exists( 'condition', $params ) ? $params['condition'] : [];
	$description   = array_key_exists( 'description', $params ) ? $params['description'] : '';
	$classes   = array_key_exists( 'classes', $params ) ? $params['classes'] : '';
	$translated_label = esc_html( $label, 'anant-addons-for-elementor' );
	$label = array_key_exists( 'escape', $params ) && $params['escape'] == false ? esc_html( $label ) .' <i class="eicon-pro-icon"></i>'  : esc_html( $label );

	return $obj->add_control(
		$key,
		[
			'label'       => $label,
			'placeholder' => esc_html( $placeholder, 'anant-addons-for-elementor' ),
			'type'        => Controls_Manager::NUMBER,
			'min'         => $min,
			'max'         => $max,
			'default'     => $default,
			'condition'   => $condition,
			'description' => $description,
			'classes' => $classes,
		]
	);
}

function anant_number_responsive_control( $obj, $params ) {
	$label       = $params['label'];
	$placeholder = $params['placeholder'];
	$key         = $params['key'];
	$min         = $params['min'];
	$max         = array_key_exists( 'max', $params ) ? $params['max'] : [];
	$default     = $params['default'];
	$condition   = array_key_exists( 'condition', $params ) ? $params['condition'] : [];
	$selectors   = array_key_exists( 'selectors', $params ) ? $params['selectors'] : [];
	return $obj->add_responsive_control(
		$key,
		[
			'label'       => esc_html( $label, 'anant-addons-for-elementor' ),
			'placeholder' => esc_html( $placeholder, 'anant-addons-for-elementor' ),
			'type'        => Controls_Manager::NUMBER,
			'min'         => $min,
			'max'         => $max,
			'default'     => $default,
			'condition'   => $condition,
			'selectors'   => $selectors,
		]
	);
}

function anant_image_size_control( $obj, $params ) {
	$name      = $params['name'];
	$default   = $params['default'];
	$condition = array_key_exists( 'condition', $params ) ? $params['condition'] : [];
	return $obj->add_group_control(
		Group_Control_Image_Size::get_type(),
		[
			'name'      => $name,
			'default'   => $default,
			'condition' => $condition,
		]
	);
}

function anant_alignment_control( $obj, $params ) {
	$left  = ! is_rtl() ? 'left' : 'right';
	$right = ! is_rtl() ? 'right' : 'left';
	$options   = $params['options'];
	$default   = $params['default'];
	$selectors =  array_key_exists( 'selectors', $params ) ? $params['selectors'] : [];
	$condition   = array_key_exists( 'condition', $params ) ? $params['condition'] : [];
	$key       = $params['key'];

	return $obj->add_responsive_control(
		$key,
		[
			'label'                => esc_html__( 'Alignment', 'anant-addons-for-elementor' ),
			'type'                 => Controls_Manager::CHOOSE,
			'options'              => $options,
			'selectors_dictionary' => [
				'left'  => $left,
				'right' => $right,
			],
			'default'              => $default,
			'toggle'               => true,
			'selectors'            => $selectors,
			'condition' => $condition,
		]
	);
}

function anant_border_control( $obj, $params ) {
	$name     = $params['name'];
	$selector = $params['selector'];
	$condition = array_key_exists( 'condition', $params ) ? $params['condition'] : [];
	$fields_options = array_key_exists( 'fields_options', $params ) ? $params['fields_options'] : [];
	$exclude = array_key_exists( 'exclude', $params ) ? $params['exclude'] : [];

	return $obj->add_group_control(
		Group_Control_Border::get_type(),
		[
			'label'    => esc_html__( 'Border Type', 'anant-addons-for-elementor' ),
			'name'     => $name,
			'selector' => $selector,
			'condition' => $condition,
			'fields_options' => $fields_options,
			'exclude' => $exclude,
		]
	);
}

function anant_border_radius_control( $obj, $params ) {
	$key       = $params['key'];
	$selectors = $params['selectors'];
	$condition = array_key_exists( 'condition', $params ) ? $params['condition'] : [];
	$separator = array_key_exists( 'separator', $params ) ? $params['separator'] : '';

	return $obj->add_responsive_control(
		$key,
		[
			'label'      => esc_html__( 'Border Radius', 'anant-addons-for-elementor' ),
			'type'       => Controls_Manager::DIMENSIONS,
			'size_units' => [ 'px', '%' ],
			'selectors'  => $selectors,
			'condition' => $condition,
			'separator' => $separator,
		]
	);
}

function anant_box_shadow_control( $obj, $params ) {
	$key      = $params['key'];
	$selector = $params['selector'];
	$separator = array_key_exists( 'separator', $params ) ? $params['separator'] : '';


	return $obj->add_group_control(
		Group_Control_Box_Shadow::get_type(),
		[
			'name'     => $key,
			'label'    => esc_html__( 'Box Shadow', 'anant-addons-for-elementor' ),
			'selector' => $selector,
			'separator'=> $separator,
		]
	);
}

function anant_text_shadow_control( $obj, $params ) {
	$key      = $params['key'];
	$selector = $params['selector'];
	$classes   = array_key_exists( 'classes', $params ) ? $params['classes'] : '';
		
	return $obj->add_group_control(
		Group_Control_Text_Shadow::get_type(),
		[
			'name'     => $key,
			'label'    => esc_html__( 'Text Shadow', 'anant-addons-for-elementor' ),
			'selector' => $selector,
			'classes'   => $classes,
		]
	);
}

function anant_typography_control( $obj, $params ) {
	$name     = $params['name'];
	$selector = $params['selector'];
	$separator = array_key_exists( 'separator', $params ) ? $params['separator'] : '';

	return $obj->add_group_control(
		Group_Control_Typography::get_type(),
		[
			'label'    => esc_html__( 'Typography', 'anant-addons-for-elementor' ),
			'name'     => $name,
			'selector' => $selector,
			'separator' => $separator,

		]
	);
}

function anant_text_stroke_control( $obj, $params ) {
	$key      = $params['key'];
	$selector = $params['selector'];
	$separator = array_key_exists( 'separator', $params ) ? $params['separator'] : '';
	$default = array_key_exists('default', $params) ? $params['default'] : [];
	
	return $obj->add_group_control(
		Group_Control_Text_Stroke::get_type(),
		[
			'name'     => $key,
			'label'    => esc_html__( 'Text Stroke', 'anant-addons-for-elementor' ),
			'selector' => $selector,
			'separator' => $separator,
			'default' => $default,
		]
	);
}

function anant_color_control( $obj, $params ) {
	$key       = $params['key'];
	$label     = $params['label'];
	$selectors = array_key_exists( 'selectors', $params ) ? $params['selectors'] : '';
	$separator = array_key_exists( 'separator', $params ) ? $params['separator'] : '';

	return $obj->add_control(
		$key,
		[
			'label'     => esc_html( $label, 'anant-addons-for-elementor' ),
			'type'      => Controls_Manager::COLOR,
			'selectors' => $selectors,
			'separator' => $separator,
		]
	);
}