<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/* Primary Menu Section*/
$wp_customize->add_section(
	$this->primary_menu,
	array(
		'capability' => 'edit_theme_options',
		'title'      => esc_html__( 'Primary Menu', 'online-estore' ),
		'panel'      => $this->panel,
		'priority'   => 80,
	)
);

$wp_customize->add_setting('online_estore_primary_menu_nav', array(
	'sanitize_callback' => 'wp_kses_post',
));

$wp_customize->add_control(new OnlineEstore_Custom_Control_Tab($wp_customize, 'online_estore_primary_menu_nav', array(
	'type' => 'tab',
	'section' => $this->primary_menu,
	'buttons' => array(
		array(
			'name' => esc_html__('Settings', 'online-estore'),
			'active' => true,
			'fields' => array(
				'primary-menu-custom-menu',
				'primary-menu-disable-sub-menu',
				'primary-menu-align',
			),
		),
		array(
			'name' => esc_html__('Color', 'online-estore'),
			'fields' => array(
				'online_estore__main_menu_bg_color',
				'online_estore__main_menu_item_color',
				'online_estore_main_hover_menu_heading',
				'online_estore__main_menu_active_bg_color',
				'online_estore__main_menu_active_item_color',
				'online_estore_main_sub_menu_heading',
				'online_estore_main_sub_menu_bg_color',
				'online_estore_main_sub_menu_text_color',
				'online_estore_main_sub_menu_hover_bg_color',
				'online_estore_main_sub_menu_hover_text_color',

			),
		),
	),
)));



/*Custom Menu*/
$choices = online_estore_get_nav_menus();
$wp_customize->add_setting(
	'primary-menu-custom-menu',
	array(
		'capability'        => 'edit_theme_options',
		'default'           => $header_defaults['primary-menu-custom-menu'],
		'sanitize_callback' => 'online_estore_select_type_sanitize',
		// 'transport'         => 'postMessage',
	)
);
$wp_customize->add_control(
	'primary-menu-custom-menu',
	array(
		'label'           => esc_html__( 'Select Primary Menu', 'online-estore' ),
		'section'         => $this->primary_menu,
		'settings'        => 'primary-menu-custom-menu',
		'type'            => 'select',
		'choices'         => $choices,
	)
);

/*Disable Sub menu */
$wp_customize->add_setting(
	'primary-menu-disable-sub-menu',
	array(
		'default'           => false,
		'sanitize_callback' => 'online_estore_sanitize_checkbox',
		// 'transport'         => 'postMessage',
	)
);
$wp_customize->add_control(
	'primary-menu-disable-sub-menu',
	array(
		'label'    => esc_html__( 'Disable Sub Menu Item', 'online-estore' ),
		'section'  => $this->primary_menu,
		'settings' => 'primary-menu-disable-sub-menu',
		'type'     => 'checkbox',
	)
);

/*Primary Menu align*/
$wp_customize->add_setting(
	'primary-menu-align',
	array(
		'default'           => 'swp-flex-align-left',
		'sanitize_callback' => 'online_estore_select_type_sanitize',
		// 'transport'         => 'postMessage',
	)
);
$choices = online_estore_flex_align();
$wp_customize->add_control(
	new OnlineEstore_Custom_Control_Buttonset(
		$wp_customize,
		'primary-menu-align',
		array(
			'choices'  => $choices,
			'label'    => esc_html__( 'Menu Alignment', 'online-estore' ),
			'section'  => $this->primary_menu,
			'settings' => 'primary-menu-align',
		)
	)
);

/**
 * Style Tab Content
 */
$wp_customize->add_setting(
    'online_estore__main_menu_bg_color', array(
        'default'     => 'rgba(255,255,255,0)',
        'sanitize_callback' => 'online_estore_sanitize_color_alpha',
    )
); 
$wp_customize->add_control(new OnlineEstore_Alpha_Color_Control($wp_customize, 'online_estore__main_menu_bg_color', array(
    'label'      => esc_html__( 'Menu Background Color', 'online-estore' ),
    'section'    => $this->primary_menu,
)));

$wp_customize->add_setting(
    'online_estore__main_menu_item_color', array(
        'default'     => '#ffffff',
        'sanitize_callback' => 'online_estore_sanitize_color_alpha',
    )
); 
$wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'online_estore__main_menu_item_color', array(
    'label'      => esc_html__( 'Menu Items Color', 'online-estore' ),
    'section'    => $this->primary_menu,
)));


$wp_customize->add_setting("online_estore_main_hover_menu_heading", array(
    'sanitize_callback' => 'sanitize_text_field'
));
$wp_customize->add_control(new OnlineEstore_Customize_Heading($wp_customize, "online_estore_main_hover_menu_heading", array(
    'section' => $this->primary_menu,
    'label' => esc_html__('Menu Item', 'online-estore')
)));

$wp_customize->add_setting(
    'online_estore__main_menu_active_bg_color', array(
        'default'     => '#f33c3c',
        'sanitize_callback' => 'online_estore_sanitize_color_alpha',
    )
); 
$wp_customize->add_control(new OnlineEstore_Alpha_Color_Control($wp_customize, 'online_estore__main_menu_active_bg_color', array(
    'label'      => esc_html__( 'Hover & Active BG Color', 'online-estore' ),
    'section'    => $this->primary_menu,
)));


$wp_customize->add_setting(
    'online_estore__main_menu_active_item_color', array(
        'default'     => '#ffffff',
        'sanitize_callback' => 'online_estore_sanitize_color_alpha',
    )
); 
$wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'online_estore__main_menu_active_item_color', array(
    'label'      => esc_html__( 'Active & Hover Color', 'online-estore' ),
    'section'    => $this->primary_menu,
)));

/**
 * Sub Menu 
 */
$wp_customize->add_setting("online_estore_main_sub_menu_heading", array(
    'sanitize_callback' => 'sanitize_text_field'
));
$wp_customize->add_control(new OnlineEstore_Customize_Heading($wp_customize, "online_estore_main_sub_menu_heading", array(
    'section' => $this->primary_menu,
    'label' => esc_html__('Sub Menu', 'online-estore')
)));

$wp_customize->add_setting(
    'online_estore_main_sub_menu_bg_color', array(
        'default'     => '#ffffff',
        'sanitize_callback' => 'online_estore_sanitize_color_alpha',
    )
); 
$wp_customize->add_control(new OnlineEstore_Alpha_Color_Control($wp_customize, 'online_estore_main_sub_menu_bg_color', array(
    'label'      => esc_html__( 'Background', 'online-estore' ),
    'section'    => $this->primary_menu,
)));

$wp_customize->add_setting(
    'online_estore_main_sub_menu_text_color', array(
        'default'     => '#232529',
        'sanitize_callback' => 'online_estore_sanitize_color_alpha',
    )
); 
$wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'online_estore_main_sub_menu_text_color', array(
    'label'      => esc_html__( 'Text Color', 'online-estore' ),
    'section'    => $this->primary_menu,
)));


$wp_customize->add_setting(
    'online_estore_main_sub_menu_hover_bg_color', array(
        'default'     => 'rgba(243,60,60,1)',
        'sanitize_callback' => 'online_estore_sanitize_color_alpha',
    )
); 
$wp_customize->add_control(new OnlineEstore_Alpha_Color_Control($wp_customize, 'online_estore_main_sub_menu_hover_bg_color', array(
    'label'      => esc_html__( 'Hover & Active BG Color', 'online-estore' ),
    'section'    => $this->primary_menu,
)));

$wp_customize->add_setting(
    'online_estore_main_sub_menu_hover_text_color', array(
        'default'     => '#ffffff',
        'sanitize_callback' => 'online_estore_sanitize_color_alpha',
    )
); 
$wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'online_estore_main_sub_menu_hover_text_color', array(
    'label'      => esc_html__( 'Hover & Active Color', 'online-estore' ),
    'section'    => $this->primary_menu,
)));

$wp_customize->selective_refresh->add_partial( 'primary-menu-custom-menu', array(
	'selector' => '.header-container .box-header-nav',
	'container_inclusive' => false,
) );