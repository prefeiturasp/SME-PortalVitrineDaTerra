<?php
/**
 * Vertical Menu Settings
*/
$wp_customize->add_section( 'online_estore_vertical_menu_section',array(
        'title'     => esc_html__( 'Vertical Menu Settings', 'online-estore' ),
        'panel' => $this->panel,
        'priority'   => 81
    )
);

/** vertical menu tab */
$wp_customize->add_setting('online_estore_vertical_menu_section_nav', array(
    // 'transport' => 'postMessage',
    'sanitize_callback' => 'wp_kses_post',
));

$wp_customize->add_control(new OnlineEstore_Custom_Control_Tab($wp_customize, 'online_estore_vertical_menu_section_nav', array(
    'type' => 'tab',
    'section' => 'online_estore_vertical_menu_section',
    'buttons' => array(
        array(
            'name' => esc_html__('Content', 'online-estore'),
            'fields' => array(
                'online_estore__vertical_menu_title',
                'online_estore__vertical_menu_show_all_menu',
                'online_estore__vertical_menu_show_all_menu_close',
                'online_estore__vertical_menu_display_itmes',
            ),
            'active' => true,
        ),
        array(
            'name' => esc_html__('Style', 'online-estore'),
            'fields' => array(
                'online_estore_main_vertical_menu_heading',
                'online_estore__vertical_menu_title_bg_color',
                'online_estore__vertical_menu_title_text_color',
                'online_estore_main_vertical_menu_content',
                'online_estore__vertical_menu_bg_color',
                'online_estore__vertical_menu_item_hover_color',
                'online_estore__vertical_menu_item_text_color',
                'online_estore__vertical_menu_item_hover_text_color',
                'online_estore__vertical_menu_item_hover_bg_color'
            ),
        ),
    ),
)));

/**
 * Text field for Vertical Menu Title
*/
$wp_customize->add_setting(
    'online_estore__vertical_menu_title',

    array(
        'default'    => esc_html__( 'More Categories', 'online-estore' ),
        'sanitize_callback' => 'sanitize_text_field'
    )
);

$wp_customize->add_control(
    'online_estore__vertical_menu_title',

    array(
        'type'      => 'text',
        'label'     => esc_html__( 'Menu Title', 'online-estore' ),
        'section'   => 'online_estore_vertical_menu_section',
    )
);

$wp_customize->selective_refresh->add_partial('online_estore__vertical_menu_title', array(
    'selector' => '.block-nav-category .block-title',
    // 'render_callback' => 'online_estore_gdpr_notice',
    'container_inclusive' => false
));

/**
 * Text field for Vertical Menu Show All Menu Text
*/
$wp_customize->add_setting(
    'online_estore__vertical_menu_show_all_menu',

    array(
        'default'    => esc_html__( 'More Categories', 'online-estore' ),
        'sanitize_callback' => 'sanitize_text_field'
    )
);

$wp_customize->add_control(
    'online_estore__vertical_menu_show_all_menu',

    array(
        'type'      => 'text',
        'label'     => esc_html__( 'Show All Menu Text', 'online-estore' ),
        'section'   => 'online_estore_vertical_menu_section',
    )
);


/**
 * Text field for Vertical Menu Button Close Text
*/
$wp_customize->add_setting(
    'online_estore__vertical_menu_show_all_menu_close',

    array(
        'default'    => esc_html__( 'Close', 'online-estore' ),
        'sanitize_callback' => 'sanitize_text_field'
    )
);

$wp_customize->add_control(
    'online_estore__vertical_menu_show_all_menu_close',

    array(
        'type'      => 'text',
        'label'     => esc_html__( 'Button Close Text', 'online-estore' ),
        'section'   => 'online_estore_vertical_menu_section',
    )
);


/**
 * Text field for Visible Vertical Menu Items
*/
$wp_customize->add_setting(
    'online_estore__vertical_menu_display_itmes',

    array(
        'default'    => 11,
        'sanitize_callback' => 'absint'
    )
);
$wp_customize->add_control(new OnlineEstore_Range_Control($wp_customize, "online_estore__vertical_menu_display_itmes", array(
    'section'   => 'online_estore_vertical_menu_section',
    'label'     => esc_html__( 'Menu Items', 'online-estore' ),
    'input_attrs' => array(
        'min' => 5,
        'max' => 50,
        'step' => 1,
    )
)));

// Style Vertical Menu Settings

$wp_customize->add_setting("online_estore_main_vertical_menu_heading", array(
    'sanitize_callback' => 'sanitize_text_field'
));

$wp_customize->add_control(new OnlineEstore_Customize_Heading($wp_customize, "online_estore_main_vertical_menu_heading", array(
    'section' => 'online_estore_vertical_menu_section',
    'label' => esc_html__('Vertical Heading', 'online-estore')
)));

$wp_customize->add_setting(
    'online_estore__vertical_menu_title_bg_color', array(
        'default'     => '#f33c3c',
        'sanitize_callback' => 'sanitize_hex_color',
    )
); 
$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize,
        'online_estore__vertical_menu_title_bg_color',array(
            'label'      => esc_html__( 'Title Background Color', 'online-estore' ),
            'section'    => 'online_estore_vertical_menu_section',
        )
    )
);

$wp_customize->add_setting(
    'online_estore__vertical_menu_title_text_color', array(
        'default'     => '#ffffff',
        'sanitize_callback' => 'sanitize_hex_color',
    )
); 
$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize,
        'online_estore__vertical_menu_title_text_color',array(
            'label'      => esc_html__( 'Title Text Color', 'online-estore' ),
            'section'    => 'online_estore_vertical_menu_section',
        )
    )
);

$wp_customize->add_setting("online_estore_main_vertical_menu_content", array(
    'sanitize_callback' => 'sanitize_text_field'
));

$wp_customize->add_control(new OnlineEstore_Customize_Heading($wp_customize, "online_estore_main_vertical_menu_content", array(
    'section' => 'online_estore_vertical_menu_section',
    'label' => esc_html__('Vertical Menu Items', 'online-estore')
)));

$wp_customize->add_setting(
    'online_estore__vertical_menu_bg_color',
    array(
        'default'     => '#ffffff',
        'sanitize_callback' => 'sanitize_hex_color',
    )
); 
$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize,
        'online_estore__vertical_menu_bg_color',
        array(
            'label'      => esc_html__( 'Background Colors', 'online-estore' ),
            'section'    => 'online_estore_vertical_menu_section',
        )
    )
);

$wp_customize->add_setting(
    'online_estore__vertical_menu_item_text_color', array(
        'default'     => '#232529',
        'sanitize_callback' => 'sanitize_hex_color',
    )
); 
$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize,
        'online_estore__vertical_menu_item_text_color', array(
            'label'      => esc_html__( 'Text Colors', 'online-estore' ),
            'section'    => 'online_estore_vertical_menu_section',
        )
    )
);

$wp_customize->add_setting(
    'online_estore__vertical_menu_item_hover_bg_color', array(
        'default'     => '#f33c3c',
        'sanitize_callback' => 'sanitize_hex_color',
    )
); 
$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize,
        'online_estore__vertical_menu_item_hover_bg_color', array(
            'label'      => esc_html__( 'Menu Item Hover BG Color', 'online-estore' ),
            'section'    => 'online_estore_vertical_menu_section',
        )
    )
);

$wp_customize->add_setting(
    'online_estore__vertical_menu_item_hover_color', array(
        'default'     => '#ffffff',
        'sanitize_callback' => 'sanitize_hex_color',
    )
); 
$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize,
        'online_estore__vertical_menu_item_hover_color', array(
            'label'      => esc_html__( 'Menu Item Hover Text Color', 'online-estore' ),
            'section'    => 'online_estore_vertical_menu_section',
        )
    )
);