<?php

$wp_customize->add_section( 'online_estore_header_html', array (
	'capability' => 'edit_theme_options',
	'theme_supports' => '',
	'title' => __( 'HTML', 'online-estore' ),
	'panel' => 'online_estore_header',
));

$wp_customize->add_setting( 'o_s_header_html', array (
	'type' => 'theme_mod',
	'capability' => 'edit_theme_options',
	'transport' => '',
	'sanitize_callback' => 'sanitize_textarea_field',
));

$wp_customize->add_control( 'o_s_header_html', array (
	'type' => 'textarea',
	'label' => __( 'Free Hand Text', 'online-estore' ),
	'section' => 'online_estore_header_html',
));