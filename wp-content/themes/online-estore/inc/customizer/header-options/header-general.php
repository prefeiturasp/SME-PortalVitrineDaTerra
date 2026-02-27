<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/*General Header*/
$wp_customize->add_section(
	'sparklewp-header-general',
	array(
		'title'    => esc_html__( 'Header General ', 'online-estore' ),
		'panel'    => $this->panel,
		'priority' => 10,
	)
);

/*Header Position*/
$wp_customize->add_setting(
	'header-position-options',
	array(
		'default'           => 'normal',
		'sanitize_callback' => 'online_estore_select_type_sanitize',
		// 'transport'         => 'postMessage',
	)
);
$choices = online_estore_header_layout_options();
$wp_customize->add_control(
	'header-position-options',
	array(
		'choices'  => $choices,
		'label'    => esc_html__( 'Header Position', 'online-estore' ),
		'section'  => 'sparklewp-header-general',
		'settings' => 'header-position-options',
		'type'     => 'select',
	)
);

/*General Header Width*/
$choices = online_estore_site_general_layout_option();
$wp_customize->add_setting(
	'header-general-width',
	array(
		'default'           => 'inherit',
		'sanitize_callback' => 'online_estore_select_type_sanitize',
		// 'transport'         => 'postMessage',
	)
);

$wp_customize->add_control(
	'header-general-width',
	array(
		'label'           => esc_html__( 'Header General Width', 'online-estore' ),
		'type'            => 'select',
		'section'         => 'sparklewp-header-general',
		'settings'        => 'header-general-width',
		'priority'        => 10,
		'choices'         => $choices,
	)
);

$wp_customize->add_setting( 'header_general_layout', array (
	'type' => 'theme_mod',
	'default' => 'style-one',
	'capability' => 'edit_theme_options',
	'transport' => '',
	'sanitize_callback' => 'online_estore_select_type_sanitize',
));

$wp_customize->add_control( 'header_general_layout', array ( 
	'type' => 'select',
	'label' => __( 'Header Layout', 'online-estore' ),
	'section' => 'sparklewp-header-general',
	'choices' => array(
		'style-one' => __( 'Layout One', 'online-estore' ),
		'style-two' => __( 'Layout Two', 'online-estore' ),
		'style-three' => __( 'Layout Three', 'online-estore' ),
		'style-four' => __( 'Layout Four', 'online-estore' ),
		'style-five' => __( 'Layout Five', 'online-estore' ),
		'style-six' => __( 'Layout Six', 'online-estore' ),
		'style-seven' => __( 'Layout Seven', 'online-estore' ),
	),
));

/*Heading Background Options*/
$wp_customize->add_setting(
	'header-general-bg-styling-msg',
	array(
		'sanitize_callback' => 'wp_kses_post',
	)
);
$wp_customize->add_control(
	new OnlineEstore_Customize_Heading(
		$wp_customize,
		'header-general-bg-styling-msg',
		array(
			'label'   => esc_html__( 'Background Options', 'online-estore' ),
			'section' => 'sparklewp-header-general',
		)
	)
);

/*Custom Background*/
$wp_customize->add_setting(
	'header-general-background-options',
	array(
		'sanitize_callback' => 'online_estore_sanitize_field_background',
		'default'           => $header_defaults['header-general-background-options'],
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
		'header-general-background-options',
		array(
			'label'    => esc_html__( 'Background Option', 'online-estore' ),
			'section'  => 'sparklewp-header-general',
			'settings' => 'header-general-background-options',
		),
		array(
			'background-color'         => array(
				'type'  => 'color',
				'label' => esc_html__( 'Background Color', 'online-estore' ),
			),
			'background-image'         => array(
				'type'  => 'image',
				'label' => esc_html__( 'Background Image', 'online-estore' ),
			),
			'background-size'          => array(
				'type'    => 'select',
				'label'   => esc_html__( 'Background Size', 'online-estore' ),
				'options' => $background_image_size_options,
				'class'   => 'image-properties',
			),
			'background-position'      => array(
				'type'    => 'select',
				'label'   => esc_html__( 'Background Position', 'online-estore' ),
				'options' => $background_image_position_options,
				'class'   => 'image-properties',
			),
			'background-repeat'        => array(
				'type'    => 'select',
				'label'   => esc_html__( 'Background Repeat', 'online-estore' ),
				'options' => $background_image_repeat_options,
				'class'   => 'image-properties',
			),
			'background-attachment'    => array(
				'type'    => 'select',
				'label'   => esc_html__( 'Background Attachment', 'online-estore' ),
				'options' => $background_image_attachment_options,
				'class'   => 'image-properties',
			),
			'enable-overlay'           => array(
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

/*Heading border Info*/
$wp_customize->add_setting(
	'header-general-border-styling-msg',
	array(
		'sanitize_callback' => 'wp_kses_post',
	)
);
$wp_customize->add_control(
	new OnlineEstore_Customize_Heading(
		$wp_customize,
		'header-general-border-styling-msg',
		array(
			'label'   => esc_html__( 'Border & Box Shadow Options', 'online-estore' ),
			'section' => 'sparklewp-header-general',
		)
	)
);

/*Border & Box Shadow*/
$wp_customize->add_setting(
	'header-general-border-styling',
	array(
		'sanitize_callback' => 'online_estore_sanitize_field_background',
		'default'           => $header_defaults['header-general-border-styling'],
		// 'transport'         => 'postMessage',
	)
);
$wp_customize->add_control(
	new OnlineEstore_Custom_Control_Group(
		$wp_customize,
		'header-general-border-styling',
		array(
			'label'    => esc_html__( 'Border & Box Shadow', 'online-estore' ),
			'section'  => 'sparklewp-header-general',
			'settings' => 'header-general-border-styling',
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
				'class'      => 'spwp-element-show',
				'label'      => esc_html__( 'Border Radius', 'online-estore' ),
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
					'min'         => -1000,
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