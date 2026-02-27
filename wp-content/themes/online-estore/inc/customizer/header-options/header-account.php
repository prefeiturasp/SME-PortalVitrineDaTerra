<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
/* Account Section*/
$wp_customize->add_section(
	$this->login_register,
	array(
		'capability' => 'edit_theme_options',
		'title'      => esc_html__( 'Account(Login/Register)', 'online-estore' ),
		'panel'      => $this->panel,
		'priority'   => 87,
	)
);
// Heading
$wp_customize->add_setting(
	'account-msg',
	array(
		'sanitize_callback' => 'wp_kses_post',
	)
);
$wp_customize->add_control(
	new OnlineEstore_Customize_Heading(
		$wp_customize,
		'account-msg',
		array(
			'label'   => esc_html__( 'Account Settings', 'online-estore' ),
			'section' => $this->login_register,
		)
	)
);

/*Menu Icon align*/
$wp_customize->add_setting(
	'account-icon-align',
	array(
		'default'           => 'swp-flex-align-left',
		'sanitize_callback' => 'online_estore_select_type_sanitize',
		// 'transport'         => 'postMessage',
	)
);
$wp_customize->add_control(
	new OnlineEstore_Custom_Control_Buttonset(
		$wp_customize,
		'account-icon-align',
		array(
			'choices'  => online_estore_flex_align(),
			'label'    => esc_html__( 'Icon/Text Alignment', 'online-estore' ),
			'section'  => $this->login_register,
			'settings' => 'account-icon-align',
		)
	)
);

/*Menu icon*/
$wp_customize->add_setting(
	'account-icon-options',
	array(
		'default'           => 'icon',
		'sanitize_callback' => 'online_estore_select_type_sanitize',
		// 'transport'         => 'postMessage',
	)
);

$wp_customize->add_control(
	'account-icon-options',
	array(
		'choices'  => online_estore_menu_indicator_options(),
		'label'    => esc_html__( 'Indicator Option', 'online-estore' ),
		'section'  => $this->login_register,
		'settings' => 'account-icon-options',
		'type'     => 'select',
	)
);

/*Menu open Text*/
$wp_customize->add_setting(
	'account-text',
	array(
		'default' => esc_html__( 'My Account', 'online-estore' ),
		'sanitize_callback' => 'sanitize_text_field',
		// 'transport'         => 'postMessage',
	)
);
$wp_customize->add_control(
	'account-text',
	array(
		'label'           => esc_html__( 'After Login Text', 'online-estore' ),
		'section'         => $this->login_register,
		'settings'        => 'account-text',
		'type'            => 'text',
	)
);


$wp_customize->add_setting(
	'account-before-text',
	array(
		'default' => esc_html__( 'Register', 'online-estore' ),
		'sanitize_callback' => 'sanitize_text_field',
		// 'transport'         => 'postMessage',
	)
);
$wp_customize->add_control(
	'account-before-text',
	array(
		'label'           => esc_html__( 'Before Login Text', 'online-estore' ),
		'section'         => $this->login_register,
		'settings'        => 'account-before-text',
		'type'            => 'text',
	)
);

/** show logout */
$wp_customize->add_setting('account-show-logout', array(
    'sanitize_callback' => 'sanitize_text_field',
    'default' => true,
    // 'transport' => 'postMessage',
));

$wp_customize->add_control(new OnlineEstore_Checkbox_Control($wp_customize, 'account-show-logout', array(
    'section' => $this->login_register,
    'label' => esc_html__('Show Logout', 'online-estore'),
)));

/** color */
$wp_customize->add_setting(
	'account-icon-color', array(
		'default'     => '#000',
		'sanitize_callback' => 'sanitize_hex_color',
	)
); 
$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize,
		'account-icon-color',array(
			'label'      => esc_html__( 'Color', 'online-estore' ),
			'section'    => $this->login_register
		)
	)
);

$wp_customize->selective_refresh->add_partial( 'account-icon', array(
	'selector' => '.header-container .spel-my-account',
	'container_inclusive' => false,
) );

/** background color */
$wp_customize->add_setting(
	'account-background-color', array(
		'default'     => '#000',
		'sanitize_callback' => 'sanitize_hex_color',
	)
); 
$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize,
		'account-background-color',array(
			'label'      => esc_html__( 'Background Color', 'online-estore' ),
			'section'    => $this->login_register
		)
	)
);