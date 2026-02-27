<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/*Header Elements Starts from here*/
// $wp_customize->register_section_type('OnlineEstore_Customize_Section_H3');
$wp_customize->add_section(
	new OnlineEstore_Customize_Section_H3(
		$wp_customize,
		'online_estore_header_rows_seperator',
		array(
			'title'    => esc_html__( 'Header Rows', 'online-estore' ),
			'panel'    => $this->panel,
			'priority' => 24,
		)
	)
);

/*Header Row Section and Setting*/
$wp_customize->add_section(
	$this->header_top,
	array(
		'title'    => esc_html__( 'Header Top', 'online-estore' ),
		'priority' => 25,
		'panel'    => $this->panel,
	)
);

/*Top Header Styling*/
$wp_customize->add_setting(
	'top-header-styling-msg',
	array(
		'sanitize_callback' => 'wp_kses_post',
	)
);
$wp_customize->add_control(
	new OnlineEstore_Customize_Heading(
		$wp_customize,
		'top-header-styling-msg',
		array(
			'label'   => esc_html__( 'Top Header Height', 'online-estore' ),
			'section' => $this->header_top,
		)
	)
);

/*Top Header Option*/
$wp_customize->add_setting(
	'header-top-height-option',
	array(
		'default'           => $header_defaults['header-top-height-option'],
		'sanitize_callback' => 'online_estore_select_type_sanitize',
		// 'transport'         => 'postMessage',
	)
);
$choices = online_estore_header_top_height_option();
$wp_customize->add_control(
	'header-top-height-option',
	array(
		'label'    => esc_html__( 'Height Option', 'online-estore' ),
		'type'     => 'select',
		'section'  => $this->header_top,
		'settings' => 'header-top-height-option',
		'choices'  => $choices,
	)
);

/*Top Header Height*/
$wp_customize->add_setting("top-header-height", array(
	'sanitize_callback' => 'online_estore_sanitize_number_blank',
	'default' => '',
	// 'transport' => 'postMessage'
));

$wp_customize->add_setting("top-header-height_tablet", array(
	'sanitize_callback' => 'online_estore_sanitize_number_blank',
	// 'transport' => 'postMessage'
));

$wp_customize->add_setting("top-header-height_mobile", array(
	'sanitize_callback' => 'online_estore_sanitize_number_blank',
	// 'transport' => 'postMessage'
));

$wp_customize->add_control(
	new OnlineEstore_Range_Slider_Control(
		$wp_customize,
		'top-header-height',
		array(
			'label'           => esc_html__( 'Header Top Height (px)', 'online-estore' ),
			'section'         => $this->header_top,
			'settings'        => array(
				'desktop' => 'top-header-height',
				'tablet' => 'top-header-height_tablet',
				'mobile' => 'top-header-height_mobile',
			),
			'input_attrs'     => array(
				'min'  => 0,
				'max'  => 100,
				'step' => 1,
			),
		)
	)
);

$wp_customize->add_setting( 'header_top_layout_options', array (
	'default' => 'style-one',
	'sanitize_callback' => 'online_estore_select_type_sanitize',
));

$wp_customize->add_control( 'header_top_layout_options', array (
	'type' => 'select',
	'label' => __( 'Select Layout', 'online-estore' ),
	'section' => $this->header_top,
	'choices' => array (
		'style-one' => __( 'Layout One', 'online-estore' ),
		'style-two' => __( 'Layout Two', 'online-estore' ),
	)
));

/*Margin & Padding Msg*/
$wp_customize->add_setting(
	'top-header-padding-margin-msg',
	array(
		'sanitize_callback' => 'wp_kses_post',
	)
);
$wp_customize->add_control(
	new OnlineEstore_Customize_Heading(
		$wp_customize,
		'top-header-padding-margin-msg',
		array(
			'label'   => esc_html__( 'Margin & Padding', 'online-estore' ),
			'section' => $this->header_top,
		)
	)
);

/* Margin*/
$wp_customize->add_setting(
	'top-header-margin',
	array(
		'sanitize_callback' => 'online_estore_sanitize_field_default_css_box',
		'default'           => '',
		// 'transport'         => 'postMessage',
	)
);
$wp_customize->add_control(
	new OnlineEstore_Custom_Control_Cssbox(
		$wp_customize,
		'top-header-margin',
		array(
			'label'    => esc_html__( 'Margin', 'online-estore' ),
			'section'  => $this->header_top,
			'settings' => 'top-header-margin',
		),
		array(),
		array()
	)
);

/* Padding*/
$wp_customize->add_setting(
	'top-header-padding',
	array(
		'sanitize_callback' => 'online_estore_sanitize_field_default_css_box',
		'default'           => '',
		// 'transport'         => 'postMessage',
	)
);
$wp_customize->add_control(
	new OnlineEstore_Custom_Control_Cssbox(
		$wp_customize,
		'top-header-padding',
		array(
			'label'    => esc_html__( 'Padding', 'online-estore' ),
			'section'  => $this->header_top,
			'settings' => 'top-header-padding',
		),
		array(),
		array()
	)
);

/*Background Styling msg */
$wp_customize->add_setting(
	'top-header-bg-styling-msg',
	array(
		'sanitize_callback' => 'wp_kses_post',
	)
);
$wp_customize->add_control(
	new OnlineEstore_Customize_Heading(
		$wp_customize,
		'top-header-bg-styling-msg',
		array(
			'label'   => esc_html__( 'Background Options', 'online-estore' ),
			'section' => $this->header_top,
		)
	)
);

/*Inherit Options*/
$choices = online_estore_header_bg_options();
$wp_customize->add_setting(
	'header-top-bg-options',
	array(
		'default'           => 'none',
		'sanitize_callback' => 'online_estore_select_type_sanitize',
		// 'transport'         => 'postMessage',
	)
);

$wp_customize->add_control(
	'header-top-bg-options',
	array(
		'label'    => esc_html__( 'Background Options', 'online-estore' ),
		'type'     => 'select',
		'section'  => $this->header_top,
		'settings' => 'header-top-bg-options',
		'choices'  => $choices,
	)
);

/*Custom Background*/
$wp_customize->add_setting(
	'header-top-background-options',
	array(
		'sanitize_callback' => 'online_estore_sanitize_field_border',
		'default'           => $header_defaults['header-top-background-options'],
		// 'transport'         => 'postMessage',
	)
);
$background_image_size_options       = online_estore_background_image_size_options();
$background_image_position_options   = online_estore_background_image_position_options();
$background_image_repeat_options     = online_estore_background_image_repeat_options();
$background_image_attachment_options = online_estore_background_image_attachment_options();
$wp_customize->add_control(
	new OnlineEstore_Custom_Control_Group(
		$wp_customize,
		'header-top-background-options',
		array(
			'label'           => esc_html__( 'Custom Background Options', 'online-estore' ),
			'section'         => $this->header_top,
			'settings'        => 'header-top-background-options'
		),
		array(
			'background-color'         => array(
				'type'  => 'color',
				'label' => esc_html__( 'Background Color', 'online-estore' ),
			),
			'text-color' => array(
				'type'  => 'color',
				'label' => esc_html__( 'Text Color', 'online-estore' ),
			),

			'background-image' => array(
				'type'  => 'image',
				'label' => esc_html__( 'Background Image', 'online-estore' ),
			),
			'background-size' => array(
				'type'    => 'select',
				'label'   => esc_html__( 'Background Size', 'online-estore' ),
				'options' => $background_image_size_options,
				'class'   => 'image-properties',
			),
			'background-position' => array(
				'type'    => 'select',
				'label'   => esc_html__( 'Background Position', 'online-estore' ),
				'options' => $background_image_position_options,
				'class'   => 'image-properties',
			),
			'background-repeat' => array(
				'type'    => 'select',
				'label'   => esc_html__( 'Background Repeat', 'online-estore' ),
				'options' => $background_image_repeat_options,
				'class'   => 'image-properties',
			),
			'background-attachment' => array(
				'type'    => 'select',
				'label'   => esc_html__( 'Background Attachment', 'online-estore' ),
				'options' => $background_image_attachment_options,
				'class'   => 'image-properties',
			),
			'enable-overlay' => array(
				'type'  => 'checkbox',
				'label' => esc_html__( 'Enable Overlay', 'online-estore' ),
				'class' => 'image-properties image-properties-checkbox',
			),
			'background-overlay-color' => array(
				'type'  => 'color',
				'label' => esc_html__( 'Background Overlay Color', 'online-estore' ),
				'class' => 'image-properties',
			),
		)
	)
);

/*Header top border style*/
$wp_customize->add_setting(
	'top-header-border-options-styling-msg',
	array(
		'sanitize_callback' => 'wp_kses_post',
	)
);
$wp_customize->add_control(
	new OnlineEstore_Customize_Heading(
		$wp_customize,
		'top-header-border-options-styling-msg',
		array(
			'label'   => esc_html__( 'Border & Box Options', 'online-estore' ),
			'section' => $this->header_top,
		)
	)
);

/*Header top border & box*/
$wp_customize->add_setting(
	'header-top-border-styling',
	array(
		'sanitize_callback' => 'online_estore_sanitize_field_border',
		'default'           => '',
		// 'transport'         => 'postMessage',
	)
);
$wp_customize->add_control(
	new OnlineEstore_Custom_Control_Group(
		$wp_customize,
		'header-top-border-styling',
		array(
			'label'    => esc_html__( 'Border & Box', 'online-estore' ),
			'section'  => $this->header_top,
			'settings' => 'header-top-border-styling',
		),
		array(
			'border-style'     => array(
				'type'    => 'select',
				'label'   => esc_html__( 'Border Style', 'online-estore' ),
				'options' => online_estore_header_border_style(),
			),
			'border-width'     => array(
				'type'       => 'cssbox',
				'label'      => esc_html__( 'Border Width', 'online-estore' ),
				'class'      => 'spwp-element-show',
				'box_fields' => array(
					'top'    => true,
					'right'  => true,
					'bottom' => true,
					'left'   => true,
				),
				'attr'       => array(
					'min'       => 0,
					'max'       => 1000,
					'step'      => 1,
					'link'      => 1,
					'devices'   => array(
						'desktop' => array(
							'icon' => 'dashicons-laptop',
						),
					),
					'link_text' => esc_html__( 'Link', 'online-estore' ),
				),
			),
			'border-color'     => array(
				'type'  => 'color',
				'label' => esc_html__( 'Border Color', 'online-estore' ),
			),
			'border-radius'    => array(
				'type'       => 'cssbox',
				'label'      => esc_html__( 'Border Radius', 'online-estore' ),
				'class'      => 'spwp-element-show',
				'box_fields' => array(
					'top'    => true,
					'right'  => true,
					'bottom' => true,
					'left'   => true,
				),
				'attr'       => array(
					'min'       => 0,
					'max'       => 1000,
					'step'      => 1,
					'link'      => 1,
					'devices'   => array(
						'desktop' => array(
							'icon' => 'dashicons-laptop',
						),
					),
					'link_text' => esc_html__( 'Link', 'online-estore' ),
				),
			),
			'box-shadow-color' => array(
				'type'  => 'color',
				'label' => esc_html__( 'Box Shadow Color', 'online-estore' ),
			),
			'box-shadow-css'   => array(
				'type'       => 'cssbox',
				'class'      => 'spwp-element-show',
				'box_fields' => array(
					'x'      => true,
					'Y'      => true,
					'BLUR'   => true,
					'SPREAD' => true,
				),
				'attr'       => array(
					'min'         => 0,
					'max'         => 1000,
					'step'        => 1,
					'link'        => 1,
					'link_toggle' => false,
					'devices'     => array(
						'desktop' => array(
							'icon' => 'dashicons-laptop',
						),
					),
					'link_text'   => esc_html__( 'INSET', 'online-estore' ),
				),
			),
		)
	)
);