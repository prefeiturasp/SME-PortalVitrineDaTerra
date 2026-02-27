<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/*Menu Icon sidebar section*/
$wp_customize->add_section(
	'online_estore_header_sidebar',
	array(
		'title'    => esc_html__( 'Menu Icon Sidebar', 'online-estore' ),
		'panel'    => $this->panel,
		'priority' => 195,
	)
);

/** 
 * Enable Search
 */
$wp_customize->add_setting('online_estore_header_sidebar_enable_search', array(
    'sanitize_callback' => 'online_estore_sanitize_checkbox',
    'default' => true
));

$wp_customize->add_control(new OnlineEstore_Checkbox_Control($wp_customize, 'online_estore_header_sidebar_enable_search', array(
    'section' => 'online_estore_header_sidebar',
    'label' => esc_html__('Enable Search', 'online-estore'),
)));

/**
 * Enable Tab
 */
$wp_customize->add_setting('online_estore_header_sidebar_enable_tab', array(
    'sanitize_callback' => 'online_estore_sanitize_checkbox',
    'default' => true
));

$wp_customize->add_control(new OnlineEstore_Checkbox_Control($wp_customize, 'online_estore_header_sidebar_enable_tab', array(
    'section' => 'online_estore_header_sidebar',
    'label' => esc_html__('Enable Tab', 'online-estore'),
)));

/**
 * First tab Text
 */

$wp_customize->add_setting('online_estore_header_sidebar_tab_1_text', array(
	'sanitize_callback' => 'sanitize_text_field',
	'default'			=> esc_html__( "Menu", 'online-estore' )
));

$wp_customize->add_control('online_estore_header_sidebar_tab_1_text', array(
    'section' => 'online_estore_header_sidebar',
    'type' => 'text',
    'label' => esc_html__('First Tab', 'online-estore'),
));
/**
 * Second tab Text
 */
$wp_customize->add_setting('online_estore_header_sidebar_tab_2_text', array(
	'sanitize_callback' => 'sanitize_text_field',
	'default'			=> esc_html__( "Category", 'online-estore' )
));

$wp_customize->add_control('online_estore_header_sidebar_tab_2_text', array(
    'section' => 'online_estore_header_sidebar',
    'type' => 'text',
    'label' => esc_html__('Second Tab', 'online-estore'),
));

/**
 * Second Tab Content
 */
$choices = online_estore_get_nav_menus();
$wp_customize->add_setting(
	'sparklecategory-custom-menu',
	array(
		'capability'        => 'edit_theme_options',
		'default'           => '',
		'sanitize_callback' => 'online_estore_select_type_sanitize',
		'transport'         => 'postMessage',
	)
);
$wp_customize->add_control(
	'sparklecategory-custom-menu',
	array(
		'label'           => esc_html__( 'Select Menu', 'online-estore' ),
		'section'         => 'online_estore_header_sidebar',
		'settings'        => 'sparklecategory-custom-menu',
		'type'            => 'select',
		'choices'         => $choices,
	)
);

$wp_customize->add_section(new Online_Estore_Customize_Upgrade_Section($wp_customize, 'o_s_header_builder-upgrade-section', array(
	'title' => esc_html__('More Sections on Premium', 'online-estore'),
	'panel' => 'online_estore_header',
	'priority' => 300,
	'options' => array(
		esc_html__('- More Elements on Premium', 'online-estore'),
	)
)));
