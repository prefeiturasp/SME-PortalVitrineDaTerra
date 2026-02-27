<?php

$wp_customize->add_section( 'o_s_header_notice', array (
	'capability' => 'edit_theme_options',
	'theme_supports' => '',
	'title' => __( 'Notice Settings', 'online-estore' ),
	'panel' => 'online_estore_header',
));

$wp_customize->add_setting( 'o_s_header_notice_title', array (
	'type' => 'theme_mod',
	'capability' => 'edit_theme_options',
	'transport' => '',
	'sanitize_callback' => 'sanitize_text_field',
));

$wp_customize->add_control( 'o_s_header_notice_title', array (
	'type' => 'text',
	'label' => __( 'Title', 'online-estore' ),
	'section' => 'o_s_header_notice',
));

$wp_customize->add_setting( 'o_s_header_notice_desc', array (
	'type' => 'theme_mod',
	'capability' => 'edit_theme_options',
	'transport' => '',
	'sanitize_callback' => 'sanitize_textarea_field',
));

$wp_customize->add_control( 'o_s_header_notice_desc', array (
	'type' => 'textarea',
	'label' => __( 'Description', 'online-estore' ),
	'section' => 'o_s_header_notice',
));