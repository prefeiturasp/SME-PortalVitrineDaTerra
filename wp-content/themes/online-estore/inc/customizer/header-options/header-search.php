<?php
    /**
     * Search
     */

    $wp_customize->add_section('online_estore_header_search', array(
        'title' => esc_html__('Search Settings', 'online-estore'),
        'panel' => $this->panel,
    ));
    //Heading 
    $wp_customize->add_setting("online_estore_header_search_msg", array(
        'sanitize_callback' => 'sanitize_text_field'
    ));
    $wp_customize->add_control(new OnlineEstore_Customize_Heading($wp_customize, "online_estore_header_search_msg", array(
        'section' => 'online_estore_header_search',
        'label' => esc_html__('Search Type', 'online-estore')
    )));

    $wp_customize->add_setting('online_estore_search_type_options', array(
        'default' => 'advancesearch',
        'sanitize_callback' => 'sanitize_text_field',
    ));

    $wp_customize->add_control('online_estore_search_type_options', array(
      'type' => 'radio',
      'label' => esc_html__('Select Search Type', 'online-estore'),
      'section' => 'online_estore_header_search',
      'settings' => 'online_estore_search_type_options',
      'choices' => array(
           'advancesearch' => esc_html__('Advance Search ( With Category )', 'online-estore'),
           'normalsearch' => esc_html__('Normal Search', 'online-estore'),
           'ajaxsearch' => esc_html__('Ajax Search', 'online-estore'),
          )
    ));

    $wp_customize->add_setting('online_estore_search_layout_type', array(
        'default' => 'style-one',
        'sanitize_callback' => 'online_estore_select_type_sanitize',
    ));

    $wp_customize->add_control('online_estore_search_layout_type', array(
      'type' => 'select',
      'label' => esc_html__('Select Layout', 'online-estore'),
      'section' => 'online_estore_header_search',
      'settings' => 'online_estore_search_layout_type',
      'choices' => array(
           'style-one' => esc_html__('Layout One', 'online-estore'),
           'style-two' => esc_html__('Layout Two', 'online-estore'),
           'style-three' => esc_html__('Layout Three', 'online-estore'),
          )
    ));    

    $wp_customize->selective_refresh->add_partial( 'online_estore_search_type_options', array(
		'selector' => '.header-container .block-search',
		'container_inclusive' => false,
	) );   

    /**
     * Text field for search placeholder caption
    */
    $wp_customize->add_setting(
        'online_estore_search_placeholder_text',
        array(
            'default'    => esc_html__( 'I am searching for...', 'online-estore' ),
            'sanitize_callback' => 'sanitize_text_field'
        )
    );

    $wp_customize->add_control(
        'online_estore_search_placeholder_text',
        array(
            'type'      => 'text',
            'label'     => esc_html__( 'Placeholder Text', 'online-estore' ),
            'section'   => 'online_estore_header_search',
        )
    );

    /** icon only heading */
    $wp_customize->add_setting("online_estore_search_icon_only_msg", array(
        'sanitize_callback' => 'sanitize_text_field'
    ));
    $wp_customize->add_control(new OnlineEstore_Customize_Heading($wp_customize, "online_estore_search_icon_only_msg", array(
        'section' => 'online_estore_header_search',
        'label' => esc_html__('Icon Settings', 'online-estore')
    )));

    /** show icon only */
    $wp_customize->add_setting('online_estore_search_icon_only', array(
        'sanitize_callback' => 'sanitize_text_field',
        'default' => false,
        // 'transport' => 'postMessage',
    ));
    $wp_customize->add_control(new OnlineEstore_Checkbox_Control($wp_customize, 'online_estore_search_icon_only', array(
        'section' => 'online_estore_header_search',
        'label' => esc_html__('Show Icon Only', 'online-estore'),
        'description' => esc_html__('Display Icon Only & Show by click on icon', 'online-estore'),
    )));

    /** alignment */
    $wp_customize->add_setting(
        'online_estore_search_icon_alignment',
        array(
            'default'           => 'swp-flex-align-left',
            'sanitize_callback' => 'online_estore_select_type_sanitize',
            // 'transport'         => 'postMessage',
        )
    );
    $wp_customize->add_control(
        new OnlineEstore_Custom_Control_Buttonset(
            $wp_customize,
            'online_estore_search_icon_alignment',
            array(
                'choices'  => online_estore_flex_align(),
                'label'    => esc_html__( 'Alignment', 'online-estore' ),
                'section'  => 'online_estore_header_search',
                'settings' => 'online_estore_search_icon_alignment',
            )
        )
    );
    /** icon color */
    $wp_customize->add_setting(
        'online_estore_search_icon_color', array(
            'default'     => '#fff',
            'sanitize_callback' => 'online_estore_sanitize_color_alpha',
        )
    ); 
    $wp_customize->add_control(new OnlineEstore_Alpha_Color_Control($wp_customize, 'online_estore_search_icon_color', array(
        'label'      => esc_html__( 'Icon Color', 'online-estore' ),
        'section'    => 'online_estore_header_search',
    )));

    /** icon background color */
    $wp_customize->add_setting(
        'online_estore_search_icon_background_color', array(
            'default'     => '#000',
            'sanitize_callback' => 'online_estore_sanitize_color_alpha',
        )
    ); 
    $wp_customize->add_control(new OnlineEstore_Alpha_Color_Control($wp_customize, 'online_estore_search_icon_background_color', array(
        'label'      => esc_html__( 'Icon Background Color', 'online-estore' ),
        'section'    => 'online_estore_header_search',
    )));    

    $wp_customize->add_setting("online_estore_search_icon_size", array(
        'sanitize_callback' => 'online_estore_sanitize_number_blank',
        'default' => 20,
        'transport' => 'postMessage'
    ));
    
    $wp_customize->add_setting("online_estore_search_icon_size_tablet", array(
        'sanitize_callback' => 'online_estore_sanitize_number_blank',
        'transport' => 'postMessage'
    ));
    
    $wp_customize->add_setting("online_estore_search_icon_size_mobile", array(
        'sanitize_callback' => 'online_estore_sanitize_number_blank',
        'transport' => 'postMessage'
    ));
    
    $wp_customize->add_control(new OnlineEstore_Range_Slider_Control($wp_customize, "online_estore_search_icon_size", array(
        'section' => 'online_estore_header_search',
        'label' => esc_html__('Icon Size (px)', 'online-estore'),
        'input_attrs' => array(
            'min' => 20,
            'max' => 200,
            'step' => 1,
        ),
        'settings' => array(
            'desktop' => "online_estore_search_icon_size",
            'tablet' => "online_estore_search_icon_size_tablet",
            'mobile' => "online_estore_search_icon_size_mobile",
        )
    )));

    /** heading */
    $wp_customize->add_setting("online_estore_search_icon_margin_padding_msg", array(
        'sanitize_callback' => 'sanitize_text_field'
    ));
    
    $wp_customize->add_control(new OnlineEstore_Customize_Heading($wp_customize, "online_estore_search_icon_margin_padding_msg", array(
        'section' => 'online_estore_header_search',
        'label' => esc_html__('Margin & Padding', 'online-estore')
    )));

    /** margin */
    $wp_customize->add_setting(
        'online_estore_search_icon_margin',
        array(
            'default'           => $header_defaults['online_estore_search_icon_margin'],
            'sanitize_callback' => 'online_estore_sanitize_field_default_css_box',
        )
    );
    $wp_customize->add_control(
        new OnlineEstore_Custom_Control_Cssbox(
            $wp_customize,
            'online_estore_search_icon_margin',
            array(
                'label'    => esc_html__( 'Margin', 'online-estore' ),
                'section'  => 'online_estore_header_search',
                'settings' => 'online_estore_search_icon_margin',
            ),
            array(),
            array()
        )
    );
    /** padding */
    $wp_customize->add_setting(
        'online_estore_search_icon_padding',
        array(
            'default'           => $header_defaults['online_estore_search_icon_padding'],
            'sanitize_callback' => 'online_estore_sanitize_field_default_css_box',
        )
    );
    $wp_customize->add_control(
        new OnlineEstore_Custom_Control_Cssbox(
            $wp_customize,
            'online_estore_search_icon_padding',
            array(
                'label'    => esc_html__( 'Padding', 'online-estore' ),
                'section'  => 'online_estore_header_search',
                'settings' => 'online_estore_search_icon_padding',
            ),
            array(),
            array()
        )
    );