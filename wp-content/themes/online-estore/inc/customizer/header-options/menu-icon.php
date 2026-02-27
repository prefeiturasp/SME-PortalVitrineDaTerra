<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/*Menu Icon */
$wp_customize->add_section(
	new OnlineEstore_Customize_Section_H3(
		$wp_customize,
		'online_estore_menu_icon_seperator',
		array(
			'title'    => esc_html__( 'Mobile Menu', 'online-estore' ),
			'panel'    => $this->panel,
			'priority' => 190,
		)
	)
);

/*Menu Icon section*/
$wp_customize->add_section(
	$this->menu_icon,
	array(
		'title'    => esc_html__( 'Menu Icon', 'online-estore' ),
		'panel'    => $this->panel,
		'priority' => 191,
	)
);

/*Menu Styling*/
$wp_customize->add_setting(
	'menu-icon-open-icon-msg',
	array(
		'sanitize_callback' => 'wp_kses_post',
	)
);
$wp_customize->add_control(
	new OnlineEstore_Customize_Heading(
		$wp_customize,
		'menu-icon-open-icon-msg',
		array(
			'label'   => esc_html__( 'Open Icon/Text Setting', 'online-estore' ),
			'section' => $this->menu_icon,
		)
	)
);

/*Menu icon*/
$wp_customize->add_setting(
	'menu-icon-open-icon-options',
	array(
		'default'           => 'icon',
		'sanitize_callback' => 'online_estore_select_type_sanitize',
		'transport'         => 'postMessage',
	)
);

$wp_customize->add_control(
	'menu-icon-open-icon-options',
	array(
		'choices'  => online_estore_menu_indicator_options(),
		'label'    => esc_html__( 'Menu Indicator Option', 'online-estore' ),
		'section'  => $this->menu_icon,
		'settings' => 'menu-icon-open-icon-options',
		'type'     => 'select',
	)
);

/*Menu open Text*/
$wp_customize->add_setting(
	'menu-open-text',
	array(
		'default'           => esc_html__('Menu', 'online-estore'),
		'sanitize_callback' => 'sanitize_text_field',
		'transport'         => 'postMessage',
	)
);
$wp_customize->add_control(
	'menu-open-text',
	array(
		'label'           => esc_html__( 'Open Text', 'online-estore' ),
		'section'         => $this->menu_icon,
		'settings'        => 'menu-open-text',
		'type'            => 'text',
	)
);

/*Menu icon size */
/** menu-open-icon-size-responsive size control */
$wp_customize->add_setting("online_estore_menu_open_size", array(
	'sanitize_callback' => 'online_estore_sanitize_number_blank',
	'default' => 25,
	// 'transport' => 'postMessage'
));

$wp_customize->add_setting("online_estore_menu_open_size_tablet", array(
	'sanitize_callback' => 'online_estore_sanitize_number_blank',
	// 'transport' => 'postMessage'
));

$wp_customize->add_setting("online_estore_menu_open_size_mobile", array(
	'sanitize_callback' => 'online_estore_sanitize_number_blank',
	// 'transport' => 'postMessage'
));

/*Menu Icon align*/
$wp_customize->add_setting(
	'menu-open-icon-align',
	array(
		'default'           => 'swp-flex-align-left',
		'sanitize_callback' => 'online_estore_select_type_sanitize',
		'transport'         => 'postMessage',
	)
);
$wp_customize->add_control(
	new OnlineEstore_Custom_Control_Buttonset(
		$wp_customize,
		'menu-open-icon-align',
		array(
			'choices'  => online_estore_flex_align(),
			'label'    => esc_html__( 'Icon/Text Alignment', 'online-estore' ),
			'section'  => $this->menu_icon,
			'settings' => 'menu-open-icon-align',
		)
	)
);

/** color */
$wp_customize->add_setting(
    'menu-open-icon-color', array(
        'default'     => '#fff',
        'sanitize_callback' => 'sanitize_hex_color',
    )
); 
$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize,
        'menu-open-icon-color',array(
            'label'      => esc_html__( 'Color', 'online-estore' ),
            'section'    => $this->menu_icon,
        )
    )
);

$wp_customize->selective_refresh->add_partial( 'menu-icon-open-icon-options', array(
	'selector' => '.header-container .sp-toggle-nav-icon',
) );