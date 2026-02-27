<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/*Adding sections for secondary menu options*/
$wp_customize->add_section(
	$this->secondary_menu,
	array(
		'priority'   => 82,
		'capability' => 'edit_theme_options',
		'title'      => esc_html__( 'Secondary Menu', 'online-estore' ),
		'panel'      => $this->panel,
	)
);

//tab
$wp_customize->add_setting('online_estore_secondary_menu_nav', array(
	'sanitize_callback' => 'wp_kses_post',
));

$wp_customize->add_control(new OnlineEstore_Custom_Control_Tab($wp_customize, 'online_estore_secondary_menu_nav', array(
	'type' => 'tab',
	'section' => $this->secondary_menu,
	'buttons' => array(
		array(
			'name' => esc_html__('Settings', 'online-estore'),
			'active' => true,
			'fields' => array(
				'secondary-menu-custom-menu',
				'secondary-menu-disable-sub-menu',
				'secondary-menu-align',
				'secondary-menu-sub-menu-layout-msg',
				'secondary-menu-sub-menu-item-margin',
				'secondary-menu-sub-menu-item-padding',
			),
		),
		array(
			'name' => esc_html__('Color', 'online-estore'),
			'fields' => array(
				'secondary-color-msg',
				'online_estore__second_menu_bg_color',
				'online_estore__second_menu_item_color',
				'online_estore_main_hover_menu_heading',
				'online_estore__second_menu_active_bg_color',
				'online_estore__second_menu_active_item_color',
				'online_estore_second_sub_menu_heading',
				'online_estore_second_sub_menu_bg_color',
				'online_estore_second_sub_menu_text_color',
				'online_estore_second_sub_menu_hover_bg_color',
				'online_estore_second_sub_menu_hover_text_color',

			),
		),
	),
)));


/*Secondary Menu*/
$choices = online_estore_get_nav_menus();
$wp_customize->add_setting(
	'secondary-menu-custom-menu',
	array(
		'capability'        => 'edit_theme_options',
		'sanitize_callback' => 'wp_kses_post',
		// 'transport'         => 'postMessage',
	)
);
$wp_customize->add_control(
	'secondary-menu-custom-menu',
	array(
		'label'    => esc_html__( 'Select Secondary Menu', 'online-estore' ),
		'section'  => $this->secondary_menu,
		'settings' => 'secondary-menu-custom-menu',
		'type'     => 'select',
		'choices'  => $choices,
	)
);

/*Disable Sub menu */
$wp_customize->add_setting(
	'secondary-menu-disable-sub-menu',
	array(
		'default'           => false,
		'sanitize_callback' => 'online_estore_sanitize_checkbox',
		// 'transport'         => 'postMessage',
	)
);
$wp_customize->add_control(
	'secondary-menu-disable-sub-menu',
	array(
		'label'    => esc_html__( 'Disable Sub Menu Item', 'online-estore' ),
		'section'  => $this->secondary_menu,
		'settings' => 'secondary-menu-disable-sub-menu',
		'type'     => 'checkbox',
	)
);
/*Secondary Menu align*/
$wp_customize->add_setting(
	'secondary-menu-align',
	array(
		'sanitize_callback' => 'online_estore_select_type_sanitize',
		'default' => 'swp-flex-align-left',
		// 'transport'         => 'postMessage',
	)
);
$choices = online_estore_flex_align();
$wp_customize->add_control(
	new OnlineEstore_Custom_Control_Buttonset(
		$wp_customize,
		'secondary-menu-align',
		array(
			'choices'  => $choices,
			'label'    => esc_html__( 'Secondary Menu Alignment', 'online-estore' ),
			'section'  => $this->secondary_menu,
			'settings' => 'secondary-menu-align',
		)
	)
);

// Heading
$wp_customize->add_setting(
	'secondary-color-msg',
	array(
		'sanitize_callback' => 'wp_kses_post',
	)
);
$wp_customize->add_control(
	new OnlineEstore_Customize_Heading(
		$wp_customize,
		'secondary-color-msg',
		array(
			'label'   => esc_html__( 'Secondary Menu', 'online-estore' ),
			'section' => $this->secondary_menu,
		)
	)
);

/**
 * Style Tab Content
 */

$wp_customize->add_setting(
    'online_estore__second_menu_bg_color', array(
        'default'     => '',
        'sanitize_callback' => 'online_estore_sanitize_color_alpha',
    )
); 
$wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'online_estore__second_menu_bg_color', array(
    'label'      => esc_html__( 'Menu Background Color', 'online-estore' ),
    'section'    => $this->secondary_menu,
)));

$wp_customize->add_setting(
    'online_estore__second_menu_item_color', array(
        'default'     => '',
        'sanitize_callback' => 'online_estore_sanitize_color_alpha',
    )
); 
$wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'online_estore__second_menu_item_color', array(
    'label'      => esc_html__( 'Menu Items Color', 'online-estore' ),
    'section'    => $this->secondary_menu,
)));


// $wp_customize->add_setting("online_estore_main_hover_menu_heading", array(
//     'sanitize_callback' => 'sanitize_text_field'
// ));
// $wp_customize->add_control(new OnlineEstore_Customize_Heading($wp_customize, "online_estore_main_hover_menu_heading", array(
//     'section' => $this->secondary_menu,
//     'label' => esc_html__('Menu Item', 'online-estore')
// )));

$wp_customize->add_setting(
    'online_estore__second_menu_active_bg_color', array(
        'default'     => '#f33c3c',
        'sanitize_callback' => 'online_estore_sanitize_color_alpha',
    )
); 
$wp_customize->add_control(new OnlineEstore_Alpha_Color_Control($wp_customize, 'online_estore__second_menu_active_bg_color', array(
    'label'      => esc_html__( 'Hover & Active BG Color', 'online-estore' ),
    'section'    => $this->secondary_menu,
)));


$wp_customize->add_setting(
    'online_estore__second_menu_active_item_color', array(
        'default'     => '#ffffff',
        'sanitize_callback' => 'online_estore_sanitize_color_alpha',
    )
); 
$wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'online_estore__second_menu_active_item_color', array(
    'label'      => esc_html__( 'Active & Hover Color', 'online-estore' ),
    'section'    => $this->secondary_menu,
)));

/**
 * Sub Menu 
 */
$wp_customize->add_setting("online_estore_second_sub_menu_heading", array(
    'sanitize_callback' => 'sanitize_text_field'
));
$wp_customize->add_control(new OnlineEstore_Customize_Heading($wp_customize, "online_estore_second_sub_menu_heading", array(
    'section' => $this->secondary_menu,
    'label' => esc_html__('Sub Menu', 'online-estore')
)));

$wp_customize->add_setting(
    'online_estore_second_sub_menu_bg_color', array(
        'default'     => 'rgba(255,255,255,1)',
        'sanitize_callback' => 'online_estore_sanitize_color_alpha',
    )
); 
$wp_customize->add_control(new OnlineEstore_Alpha_Color_Control($wp_customize, 'online_estore_second_sub_menu_bg_color', array(
    'label'      => esc_html__( 'Background', 'online-estore' ),
    'section'    => $this->secondary_menu,
)));

$wp_customize->add_setting(
    'online_estore_second_sub_menu_text_color', array(
        'default'     => '#232529',
        'sanitize_callback' => 'online_estore_sanitize_color_alpha',
    )
); 
$wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'online_estore_second_sub_menu_text_color', array(
    'label'      => esc_html__( 'Text Color', 'online-estore' ),
    'section'    => $this->secondary_menu,
)));


$wp_customize->add_setting(
    'online_estore_second_sub_menu_hover_bg_color', array(
        'default'     => '#fff',
        'sanitize_callback' => 'online_estore_sanitize_color_alpha',
    )
); 
$wp_customize->add_control(new OnlineEstore_Alpha_Color_Control($wp_customize, 'online_estore_second_sub_menu_hover_bg_color', array(
    'label'      => esc_html__( 'Hover & Active BG Color', 'online-estore' ),
    'section'    => $this->secondary_menu,
)));

$wp_customize->add_setting(
    'online_estore_second_sub_menu_hover_text_color', array(
        'default'     => '#000',
        'sanitize_callback' => 'online_estore_sanitize_color_alpha',
    )
); 
$wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'online_estore_second_sub_menu_hover_text_color', array(
    'label'      => esc_html__( 'Hover & Active Color', 'online-estore' ),
    'section'    => $this->secondary_menu,
)));