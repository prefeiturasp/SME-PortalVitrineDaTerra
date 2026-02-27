<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/*Button one section*/
$wp_customize->add_section( $this->button_one,
	array(
		'title' => esc_html__( 'Button One', 'online-estore' ),
		'panel' => $this->panel,
	)
);

/*Button Text*/
$wp_customize->add_setting( 'button-one-text',
	array(
		'default'           => esc_html__("Shop Now", 'online-estore'),
		'sanitize_callback' => 'sanitize_text_field',
		// 'transport'         => 'postMessage',
	)
);
$wp_customize->add_control( 'button-one-text',
	array(
		'label'    => esc_html__( 'Button Text', 'online-estore' ),
		'section'  => $this->button_one,
		'settings' => 'button-one-text',
		'type'     => 'text',
	)
);

/*Icon Position*/
$wp_customize->add_setting( 'button-one-icon-position',
	array(
		'default'           => '',
		'sanitize_callback' => 'sanitize_text_field',
		// 'transport'         => 'postMessage',
	)
);
$choices = online_estore_icon_position();
$wp_customize->add_control(new OnlineEstore_Custom_Control_Buttonset( $wp_customize, 'button-one-icon-position',
		array(
			'choices'         => $choices,
			'label'           => esc_html__( 'Icon Position', 'online-estore' ),
			'section'         => $this->button_one,
			'settings'        => 'button-one-icon-position'
		)
	)
);

/*Button URL*/
$wp_customize->add_setting( 'button-one-url',
	array(
		'default'           => $header_defaults['button-one-url'],
		'sanitize_callback' => 'esc_url_raw',
		// 'transport'         => 'postMessage',
	)
);
$wp_customize->add_control( 'button-one-url',
	array(
		'label'     => esc_html__( 'Button URL', 'online-estore' ),
		'section'   => $this->button_one,
		'settings'  => 'button-one-url',
		'type'      => 'url',
		'transport' => 'postMessage',
	)
);

/*Open link in new tab */
$wp_customize->add_setting( 'button-one-open-link-new-tab',
	array(
		'default'           => true,
		'sanitize_callback' => 'sanitize_text_field',
		// 'transport'         => 'postMessage',
	)
);
$wp_customize->add_control( 'button-one-open-link-new-tab',
	array(
		'label'    => esc_html__( 'Open link in a new tab', 'online-estore' ),
		'section'  => $this->button_one,
		'settings' => 'button-one-open-link-new-tab',
		'type'     => 'checkbox',
	)
);

$wp_customize->add_setting( 'button-one-class-name',
	array(
		'default'           => $header_defaults['button-one-class-name'],
		'sanitize_callback' => 'sanitize_text_field',
		// 'transport'         => 'postMessage',
	)
);
$wp_customize->add_control( 'button-one-class-name',
	array(
		'label'       => esc_html__( 'Button CSS Class ', 'online-estore' ),
		'description' => esc_html__( 'Multiple classes added by space', 'online-estore' ),
		'section'     => $this->button_one,
		'settings'    => 'button-one-class-name',
		'type'        => 'text',
	)
);

/*Button One Styling Msg*/
$wp_customize->add_setting(
	'button-one-styling-styling-msg',
	array(
		'sanitize_callback' => 'wp_kses_post',
	)
);
$wp_customize->add_control(
	new OnlineEstore_Customize_Heading(
		$wp_customize,
		'button-one-styling-styling-msg',
		array(
			'label'   => esc_html__( 'Button One Styling', 'online-estore' ),
			'section' => $this->button_one,
		)
	)
);

/*Button align*/
$wp_customize->add_setting(
	'button-one-align',
	array(
		'default'           => 'swp-flex-align-left',
		'sanitize_callback' => 'online_estore_sanitize_field_responsive_buttonset',
		// 'transport'         => 'postMessage',
	)
);
$choices = online_estore_flex_align();
$wp_customize->add_control(
	new OnlineEstore_Custom_Control_Responsive_Buttonset(
		$wp_customize,
		'button-one-align',
		array(
			'choices'  => $choices,
			'label'    => esc_html__( 'Button Alignment', 'online-estore' ),
			'section'  => $this->button_one,
			'settings' => 'button-one-align',
		)
	)
);

// font size
$wp_customize->add_setting('button-one-font-size', array(
    'default' => 14,
    'sanitize_callback' => 'online_estore_sanitize_number_blank'  // done
));

$wp_customize->add_control('button-one-font-size', array(
    'type' => 'number',
    'label' => esc_html__('Font Size(px)', 'online-estore'),
    'section' => $this->button_one,
    'settings' => 'button-one-font-size'
));

/*Tabs button color*/
$wp_customize->add_setting('button-one_bg_color', array(
    'default' => '#003772',
    'sanitize_callback' => 'sanitize_hex_color'
));

$wp_customize->add_setting('button-one_border_color', array(
    'default' => '#003772',
    'sanitize_callback' => 'sanitize_hex_color'
));

$wp_customize->add_setting('button-one_text_color', array(
    'default' => '#ffffff',
    'sanitize_callback' => 'sanitize_hex_color'
));

// Slider Button Hover Color
$wp_customize->add_setting('button-one_bg_hov_color', array(
    'default' => '#003772',
    'sanitize_callback' => 'sanitize_hex_color'
));

$wp_customize->add_setting('button-one_border_hov_color', array(
    'default' => '#003772',
    'sanitize_callback' => 'sanitize_hex_color'
));

$wp_customize->add_setting('button-one_text_hov_color', array(
    'default' => '#ffffff',
    'sanitize_callback' => 'sanitize_hex_color'
));


$wp_customize->add_control(new OnlineEstore_Color_Tab_Control($wp_customize, 'button-one_color_group', array(
    'label' => esc_html__('Button Color', 'online-estore'),
    'section' => $this->button_one,
    'show_opacity' => false,
    'settings' => array(
        'normal_button-one_bg_color' => 'button-one_bg_color',
        'normal_button-one_border_color' => 'button-one_border_color',
        'normal_button-one_text_color' => 'button-one_text_color',
        'hover_button-one_bg_hov_color' => 'button-one_bg_hov_color',
        'hover_button-one_border_hov_color' => 'button-one_border_hov_color',
        'hover_button-one_text_hov_color' => 'button-one_text_hov_color',
    ),
    'group' => array(
        'normal_button-one_bg_color' => esc_html__('Background Color', 'online-estore'),
        'normal_button-one_border_color' => esc_html__('Border Color', 'online-estore'),
        'normal_button-one_text_color' => esc_html__('Text Color', 'online-estore'),
        'hover_button-one_bg_hov_color' => esc_html__('Background Color', 'online-estore'),
        'hover_button-one_border_hov_color' => esc_html__('Border Color', 'online-estore'),
        'hover_button-one_text_hov_color' => esc_html__('Text Color', 'online-estore')
    )
)));

$wp_customize->selective_refresh->add_partial( 'button-one-text', array(
	'selector' => '.header-container .swp-header-button',
	'container_inclusive' => false,
) );