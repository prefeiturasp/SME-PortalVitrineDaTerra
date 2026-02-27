<?php
/**
 * Online-eStore Theme Customizer
 *
 * @package Online-eStore
 */

/**
 * Add postMessage support for site title and description for the Theme Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function online_estore_customize_register( $wp_customize ) {

	$wp_customize->get_setting( 'blogname' )->transport         = 'postMessage';
	$wp_customize->get_setting( 'blogdescription' )->transport  = 'postMessage';
	$wp_customize->get_setting( 'header_textcolor' )->transport = 'postMessage';

    if ( isset( $wp_customize->selective_refresh ) ) {
        $wp_customize->selective_refresh->add_partial( 'blogname', array(
            'selector'        => '.site-title a',
            'render_callback' => 'online_estore_customize_partial_blogname',
        ) );
        $wp_customize->selective_refresh->add_partial( 'blogdescription', array(
            'selector'        => '.site-description',
            'render_callback' => 'online_estore_customize_partial_blogdescription',
        ) );
    }


    $wp_customize->register_control_type('OnlineEstore_Custom_Control_Tab');
	$wp_customize->register_control_type('OnlineEstore_Background_Control');
    $wp_customize->register_control_type('OnlineEstore_Range_Slider_Control');
    $wp_customize->register_control_type('OnlineEstore_Color_Tab_Control');
    $wp_customize->register_control_type('OnlineEstore_Custom_Control_Buttonset');
	$wp_customize->register_section_type('OnlineEstore_Toggle_Section');
    $wp_customize->register_section_type('OnlineEstore_Customize_Section_H3');
    $wp_customize->register_section_type('Online_Estore_Customize_Upgrade_Section');
    $wp_customize->register_section_type( 'Online_Estore_Customize_Section_Pro' );

		// Register sections.
		$wp_customize->add_section(
			new Online_Estore_Customize_Section_Pro(
				$wp_customize,
				'online_estore_pro',
				array(
					'title'    => '',
					'pro_text' => esc_html__( 'Upgrade To Premium','online-estore' ),
					'pro_url'  => 'https://sparklewpthemes.com/wordpress-themes/online-estore-pro-multipurpose-woocommerce-theme/',
					'priority'  => 1,
				)
			)
		);


/**
 * List All Pages
 *
 * @since 1.0.0
 */
$slider_pages = array();

$slider_pages_obj = get_pages();

$slider_pages[''] = esc_html__('Select Page','online-estore');

foreach ($slider_pages_obj as $page) {
    $slider_pages[$page->ID] = $page->post_title;
}


    /**
     * WooCommerce Panel
     *
     * @since 1.0.0
     */
    $wp_customize->add_panel(
        'woocommerce',
        array(
            'priority'       => 6,
            'title'          => esc_html__( 'WooCommerce Settings', 'online-estore' ),
        )
    );


	/**
	 * Preloader Settings section
	 *
	 * @since 1.0.0
	 */
	$wp_customize->add_section(
	    'online_estore_preloader_section',

	    array(
	        'title'         => esc_html__( 'Preloader Settings', 'online-estore' ),
	        'priority'      => 4,
	    )
	);

	    /**
	     * Enable/Disable option for Pre Loader
	     *
	     * @since 1.0.0
	     */
	    $wp_customize->add_setting( 
	        'online_estore_preloader_section_options', 
	        array(
	            'sanitize_callback' => 'online_estore_sanitize_on_off',
	            'default' => 'off'
	        ) 
	    );

	    $wp_customize->add_control( new Online_eStore_Switch_Control( 
	        $wp_customize, 
	            'online_estore_preloader_section_options', 
	            array(
	                'settings'      => 'online_estore_preloader_section_options',
	                'section'       => 'online_estore_preloader_section',
	                'label'         => esc_html__( 'Pre Loader Section', 'online-estore' ),
	                'description'   => esc_html__( 'Enable/Disable option for pre loader section.', 'online-estore' ),
	                'on_off_label'  => array(
	                    'on'  => esc_html__( 'Enable', 'online-estore' ),
	                    'off' => esc_html__( 'Disable', 'online-estore' )
	                )   
	            ) 
	        ) 
	    );


    /**
     * Preloader Select Image Options
     *
     * @since 1.0.0
     */

    $wp_customize->add_setting( 
        'online_estore_preloader',

        array( 
            'default' => 'default', 
            'sanitize_callback' => 'sanitize_text_field'
        )
    );

    $wp_customize->add_control( new Online_eStore_Customize_Preloader_Control( 
        $wp_customize, 
            'online_estore_preloader', 

            array(
                    'label'      => esc_html__( 'Preloader Image', 'online-estore' ),
                    'section'    => 'online_estore_preloader_section',
                    'settings'   => 'online_estore_preloader',
                )
            )
    );

    $wp_customize->add_setting('o_s_upgrade_text', array(
        'sanitize_callback' => 'sanitize_text_field'
    ));

    $wp_customize->add_control(new Online_Estore_Upgrade_Text($wp_customize, 'o_s_upgrade_text', array(
        'section' => 'online_estore_preloader_section',
        'label' => esc_html__('For more preloader settings,', 'online-estore'),
        'choices' => array(
            esc_html__('Includes More Preloader Images for Selection', 'online-estore'),
            esc_html__('Option to Upload Custom Preloader Image', 'online-estore'),
            esc_html__('Option to Change Preloader Background Color', 'online-estore'),
        ),
        'priority' => 100
    )));    


	$wp_customize->get_section( 'title_tagline' )->panel = 'online_estore_general_settings_panel';
    $wp_customize->get_section( 'title_tagline' )->priority = '5';

    $wp_customize->get_section( 'colors' )->panel    = 'online_estore_general_settings_panel';
    $wp_customize->get_section( 'colors' )->priority = '10';

    $wp_customize->get_section( 'background_image' )->panel = 'online_estore_general_settings_panel';
    $wp_customize->get_section( 'background_image' )->priority = '15';

    $wp_customize->remove_section('header_image');

    /**
     * Add General Settings Panel
     *
     * @since 1.0.0
    */
    $wp_customize->add_panel(
	    'online_estore_general_settings_panel',
	    array(
	        'priority'       => 5,
	        'theme_supports' => '',
	        'title'          => esc_html__( 'General Settings', 'online-estore' ),
	    )
    );


    /**
     * Website layout section
     *
     * @since 1.0.0
     */
    $wp_customize->add_section(
        'online_estore_website_layout_section',
        array(
            'title'         => esc_html__( 'Website Layout', 'online-estore' ),
            'priority'      => 55,
            'panel'         => 'online_estore_general_settings_panel',
        )
    );

    $wp_customize->add_section(new Online_Estore_Customize_Upgrade_Section($wp_customize, 'online-estore-general-upgrade-section', array(
        'title' => esc_html__('More Sections on Premium', 'online-estore'),
        'panel' => 'online_estore_general_settings_panel',
        'options' => array(
            esc_html__('- Contains Section for Customizing Sidebar Title Style', 'online-estore'),
        )
    )));



$weblayout = array(
   'fullwidth' => esc_html__( 'FullWidth Layout', 'online-estore' ),
    'boxed'     => esc_html__( 'Boxed Layout', 'online-estore' )
);
    $wp_customize->add_setting(
        'online_estore_website_layout_options',

        array(
            'default'           => 'fullwidth',
            'sanitize_callback' => 'online_estore_select_type_sanitize',
        )       
    );

    $wp_customize->add_control(
        'online_estore_website_layout_options',

        array(
            'type'          => 'select',
            'label'         => esc_html__( 'WebSite Page Layout', 'online-estore' ),
            'section'       => 'online_estore_website_layout_section',
            'choices'       => $weblayout
        )
    );


    /**
     * Theme Primary Color Options
     *
     * @since 1.0.0
     */

    $wp_customize->add_section(
        'online_estore_primary_theme_color_section',
        array(
            'title'         => esc_html__( 'Themes Colors Settings', 'online-estore' ),
            'priority'      => 6,
        )
    );

    $wp_customize->add_setting(
        'online_estore_primary_theme_color_options',
        array(
            'default'     => '#f33c3c',
            'sanitize_callback' => 'sanitize_hex_color',
        )
    ); 

    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize,
            'online_estore_primary_theme_color_options',
            array(
                'label'      => esc_html__( 'Theme Primary Colors', 'online-estore' ),
                'section'    => 'online_estore_primary_theme_color_section',
            )
        )
    );

    $wp_customize->add_setting('o_s_theme_color_upgrade_text', array(
        'sanitize_callback' => 'sanitize_text_field'
    ));

    $wp_customize->add_control(new Online_Estore_Upgrade_Text($wp_customize, 'o_s_theme_color_upgrade_text', array(
        'section' => 'online_estore_primary_theme_color_section',
        'label' => esc_html__('For more color settings,', 'online-estore'),
        'choices' => array(
            esc_html__('Added Option for Theme Secondary Color', 'online-estore'),
        ),
        'priority' => 100
    )));




    if ( class_exists( 'WooCommerce' ) ) {

        /**
         * Main Header Settings Option
         */
        $wp_customize->add_section(
            'online_estore_vertical_menu_section',

            array(
                'title'     => esc_html__( 'Vertical Menu Settings', 'online-estore' ),
                'panel'     => 'online_estore_header_settings_panel'
            )
        );

        /**
         * Enable/Disable Option for Product Category Menu
         *
         * @since 1.0.0
         */
        $wp_customize->add_setting( 
            'online_estore_vertical_menu_options', 

            array(
                'sanitize_callback' => 'online_estore_sanitize_on_off',
                'default' => 'on'
            ) 
        );

        $wp_customize->add_control( new Online_eStore_Switch_Control( 
            $wp_customize, 
                'online_estore_vertical_menu_options', 

                array(
                    'section'       => 'online_estore_vertical_menu_section',
                    'label'         => esc_html__( 'Vertical Menu', 'online-estore' ),
                    'description'   => esc_html__( 'Enable/Disable option for vertical menu', 'online-estore' ),
                    'on_off_label'  => array(
                        'on'  => esc_html__( 'Enable', 'online-estore' ),
                        'off' => esc_html__( 'Disable', 'online-estore' )
                    )   
                ) 
            ) 
        );


        /**
         * Text field for Vertical Menu Title
         *
         * @since 1.0.0
        */

        $wp_customize->add_setting(
            'online_estore_vertical_menu_title',

            array(
                'default'    => esc_html__( 'All Categories', 'online-estore' ),
                'sanitize_callback' => 'sanitize_text_field'
            )
        );

        $wp_customize->add_control(
            'online_estore_vertical_menu_title',

            array(
                'type'      => 'text',
                'label'     => esc_html__( 'Vertical Menu Title', 'online-estore' ),
                'section'   => 'online_estore_vertical_menu_section',
            )
        );


        /**
         * Text field for Vertical Menu Show All Menu Text
         *
         * @since 1.0.0
        */

        $wp_customize->add_setting(
            'online_estore_vertical_menu_show_all_menu',

            array(
                'default'    => esc_html__( 'More Categories', 'online-estore' ),
                'sanitize_callback' => 'sanitize_text_field'
            )
        );

        $wp_customize->add_control(
            'online_estore_vertical_menu_show_all_menu',

            array(
                'type'      => 'text',
                'label'     => esc_html__( 'Vertical Menu Show All Menu Text', 'online-estore' ),
                'section'   => 'online_estore_vertical_menu_section',
            )
        );


        /**
         * Text field for Vertical Menu Button Close Text
         *
         * @since 1.0.0
        */

        $wp_customize->add_setting(
            'online_estore_vertical_menu_show_all_menu_close',

            array(
                'default'    => esc_html__( 'Close', 'online-estore' ),
                'sanitize_callback' => 'sanitize_text_field'
            )
        );

        $wp_customize->add_control(
            'online_estore_vertical_menu_show_all_menu_close',

            array(
                'type'      => 'text',
                'label'     => esc_html__( 'Vertical Menu Button Close Text', 'online-estore' ),
                'section'   => 'online_estore_vertical_menu_section',
            )
        );


         /**
         * Text field for Visible Vertical Menu Items
         *
         * @since 1.0.0
        */

        $wp_customize->add_setting(
            'online_estore_vertical_menu_display_itmes',

            array(
                'default'    => 10,
                'sanitize_callback' => 'absint'
            )
        );

        $wp_customize->add_control(
            'online_estore_vertical_menu_display_itmes',

            array(
                'type'      => 'number',
                'label'     => esc_html__( 'Visible Vertical Menu Items', 'online-estore' ),
                'section'   => 'online_estore_vertical_menu_section',
            )
        );


        $wp_customize->add_setting(
            'online_estore_vertical_menu_title_bg_color',

            array(
                'default'     => '#000',
                'sanitize_callback' => 'sanitize_hex_color',
            )
        ); 

        $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize,
                'online_estore_vertical_menu_title_bg_color',

                array(
                    'label'      => esc_html__( 'Vertical Menu Title Background Colors', 'online-estore' ),
                    'section'    => 'online_estore_vertical_menu_section',
                )
            )
        );

    }

    /**
     * Quick Contact information
    */
    $wp_customize->add_section(
        'online_estore_header_quickinfo',

        array(
            'title'     => esc_html__( 'Quick Contact Information', 'online-estore' ),
            'panel'     => 'online_estore_header',
        )
    );

        $wp_customize->add_setting(
            'online_estore_quick_map_address', 

            array(     
                'default' => '',
                'sanitize_callback' => 'sanitize_text_field' //done
            )
        );

        $wp_customize->add_control(
            'online_estore_quick_map_address', 

            array(
                'type' => 'text',
                'label' => esc_html__('Enter Map Address :', 'online-estore'),
                'section' => 'online_estore_header_quickinfo',
                'settings' => 'online_estore_quick_map_address'
            )
        );

        $wp_customize->add_setting(
            'online_estore_quick_email', 

            array(     
                'default' => '',
                'sanitize_callback' => 'sanitize_email' //done
            )
        );

        $wp_customize->add_control(
            'online_estore_quick_email',

            array(
                'type' => 'text',
                'label' => esc_html__('Enter Email Address :', 'online-estore'),
                'section' => 'online_estore_header_quickinfo',
               ' settings' => 'online_estore_quick_email'
            )
        );

        $wp_customize->add_setting(
            'online_estore_quick_phone', 

            array(     
                'default' => '',
                'sanitize_callback' => 'sanitize_text_field' //done
            )
        );

        $wp_customize->add_control(
            'online_estore_quick_phone', 

            array(
                'type' => 'text',
                'label' => esc_html__('Enter Phone Number :', 'online-estore'),
                'section' => 'online_estore_header_quickinfo',
                'settings' => 'online_estore_quick_phone'
            )
        );


        $wp_customize->add_setting(
            'online_estore_quick_working_hour', 

            array(     
                'default' => '',
                'sanitize_callback' => 'sanitize_text_field' //done
            )
        );

        $wp_customize->add_control(
            'online_estore_quick_working_hour', 

            array(
                'type' => 'text',
                'label' => esc_html__('Enter Working Hours :', 'online-estore'),
                'section' => 'online_estore_header_quickinfo',
                'settings' => 'online_estore_quick_working_hour'
            )
        );

        $wp_customize->add_setting( 'o_s_quick_color', array(
                'default' => '#000',
                'type' => 'theme_mod', 
                'capability' => 'edit_theme_options',
                'sanitize_callback' => 'sanitize_hex_color',
            )
        );

        $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'o_s_quick_color', array(
                'label' => 'Select Color', 
                'section' => 'online_estore_header_quickinfo',
                'settings' => 'o_s_quick_color',
            )
        ));

        /*Button align*/
        $wp_customize->add_setting(
            'quick-contact-align',
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
                'quick-contact-align',
                array(
                    'choices'  => $choices,
                    'label'    => esc_html__( 'Alignment', 'online-estore' ),
                    'section'  => 'online_estore_header_quickinfo',
                    'settings' => 'quick-contact-align',
                )
            )
        );

        $wp_customize->add_setting( 'header_quick_contact_layout', array (
            'type' => 'theme_mod',
            'default' => 'style-one',
            'capability' => 'edit_theme_options',
            'sanitize_callback' => 'online_estore_select_type_sanitize',
        ));

        $wp_customize->add_control( 'header_quick_contact_layout', array ( 
            'type' => 'select',
            'label' => __( 'Select Layout', 'online-estore' ),
            'section' => 'online_estore_header_quickinfo',
            'choices' => array(
                'style-one' => __( 'Layout One', 'online-estore' ),
                'style-two' => __( 'Layout Two', 'online-estore' ),
                'style-three' => __( 'Layout Three', 'online-estore' ),
            ),
        ));

    /**
     * Main Banner Slider Section
     */
    $wp_customize->add_section(
        'online_estore_main_banner_section',
        array(
            'title'     => esc_html__( 'Main Slider Settings', 'online-estore' ),
            'priority'  => 8,
        )
    );

    /**
     * Enable/Disable option for Pre Loader
     *
     * @since 1.0.0
     */
    $wp_customize->add_setting( 
        'online_estore_main_slider_enable_disable', 
        array(
            'sanitize_callback' => 'online_estore_sanitize_on_off',
            'default' => 'off'
        ) 
    );

    $wp_customize->add_control( new Online_eStore_Switch_Control( 
        $wp_customize, 
            'online_estore_main_slider_enable_disable', 
            array(
                'section'       => 'online_estore_main_banner_section',
                'label'         => esc_html__( 'Slider Section', 'online-estore' ),
                'description'   => esc_html__( 'Enable/Disable slider section.', 'online-estore' ),
                'on_off_label'  => array(
                    'on'  => esc_html__( 'Enable', 'online-estore' ),
                    'off' => esc_html__( 'Disable', 'online-estore' )
                )   
            ) 
        ) 
    );


    $sliderlayout = array(
        'fullslider'         => esc_html__( 'Full Slider', 'online-estore' ),
        'sliderverticalmenu' => esc_html__( 'Slider With Vertical Menu', 'online-estore' )
    );

        $wp_customize->add_setting(
            'online_estore_slider_layout_options',

            array(
                'default'           => 'sliderverticalmenu',
                'sanitize_callback' => 'online_estore_select_type_sanitize',
            )       
        );

        $wp_customize->add_control(
            'online_estore_slider_layout_options',
            array(
                'type'          => 'select',
                'label'         => esc_html__( 'Slider Layout Settings', 'online-estore' ),
                'section'       => 'online_estore_main_banner_section',
                'choices'       => $sliderlayout
            )
        );

    if ( ! function_exists( 'online_estore_slider_type_options' ) ) {
        function online_estore_slider_type_options(){
            if(esc_attr(get_theme_mod('online_estore_slider_layout_options','sliderpromo')) =='sliderpromo'){
                return true;
            }else{
                return false;
            }
        }
    }

    /**
     * Slider Settings Options
     *
     * @since 1.0.0
     */
    $wp_customize->add_setting( 
        'online_estore_banner_slider_options', 

        array(
            'sanitize_callback' => 'online_estore_sanitize_repeater',
            'default' => json_encode( array(
                array(
                    'slider_page' => '' ,
                    'button_text' => '',
                    'button_url'  => ''
                )
            ) )        
        )
    );

    $wp_customize->add_control( new online_estore_Repeater_Controler( 
        $wp_customize, 
            'online_estore_banner_slider_options', 

            array(
                'label'   => esc_html__('Slider Options Setting','online-estore'),
                'section' => 'online_estore_main_banner_section',
                'settings' => 'online_estore_banner_slider_options',
                'online_estore_box_label' => esc_html__('Slider Settings Area','online-estore'),
                'online_estore_box_add_control' => esc_html__('Add New Slider','online-estore'),
            ),

            array(

                'slider_page' => array(
                    'type'      => 'select',
                    'label'     => esc_html__( 'Select Slider Page', 'online-estore' ),
                    'options'   => $slider_pages
                ),

                'button_text' => array(
                    'type'      => 'text',
                    'label'     => esc_html__( 'Enter Button Text', 'online-estore' ),
                    'default'   => ''
                ),

                'button_url' => array(
                    'type'      => 'text',
                    'label'     => esc_html__( 'Enter Button Url', 'online-estore' ),
                    'default'   => ''
                )             
            )
        )
    );

    $wp_customize->add_setting('o_S_main_slider_upgrade_text', array(
        'sanitize_callback' => 'sanitize_text_field'
    ));

    $wp_customize->add_control(new Online_Estore_Upgrade_Text($wp_customize, 'o_S_main_slider_upgrade_text', array(
        'section' => 'online_estore_main_banner_section',
        'label' => esc_html__('For more slider settings,', 'online-estore'),
        'choices' => array(
            esc_html__('Four Different Types of Slider', 'online-estore'),
            esc_html__('Four Different Slider Layouts', 'online-estore'),
            esc_html__('Change Slider Position from Left to Right or vice-versa', 'online-estore'),
            esc_html__('Customize Slider Height', 'online-estore'),
            esc_html__('Hide/Show Slider Arrow/Dots', 'online-estore'),
            esc_html__('Enable/Disable Slider Loop/Autoplay', 'online-estore'),
            esc_html__('Enable/Disable Mousedrag on Touch Devices', 'online-estore'),
            esc_html__('Change Background Overlay Color', 'online-estore'),
            esc_html__('Change Caption Title and Subtitle Color', 'online-estore'),
            esc_html__('Customize Button Background, Border and Text Color', 'online-estore'),
            esc_html__('Customize Margin and Padding', 'online-estore'),
        ),
        'priority' => 100
    )));




    // $wp_customize->add_setting(
    //     'online_estore_banner_promo_one', 

    //     array(
    //         'sanitize_callback' => 'absint'
    //     )
    // );

    // $wp_customize->add_control(new WP_Customize_Cropped_Image_Control(
    //     $wp_customize, 
    //     'online_estore_banner_promo_one', 
    //         array(
    //            'label' => esc_html__('Promo Image One', 'online-estore'),
    //            'section' => 'online_estore_main_banner_section',
    //             'width' => 340,
    //             'height' => 225,
    //            'active_callback' => 'online_estore_slider_type_options',
    //         )
    //     )
    // );


    // $wp_customize->add_setting(
    //     'online_estore_banner_promo_one_url', 

    //     array(     
    //         'default' => '',
    //         'sanitize_callback' => 'esc_url_raw' //done
    //     )
    // );

    // $wp_customize->add_control(
    //     'online_estore_banner_promo_one_url', 

    //     array(
    //         'type' => 'url',
    //         'label' => esc_html__('Custom Promo Link', 'online-estore'),
    //         'section' => 'online_estore_main_banner_section',
    //         'active_callback' => 'online_estore_slider_type_options',
    //     )
    // );


    // $wp_customize->add_setting(
    //     'online_estore_banner_promo_two', 

    //     array(
    //         'sanitize_callback' => 'absint'
    //     )
    // );

    // $wp_customize->add_control(new WP_Customize_Cropped_Image_Control(
    //     $wp_customize, 
    //     'online_estore_banner_promo_two', 
    //         array(
    //            'label' => esc_html__('Promo Image Two', 'online-estore'),
    //            'section' => 'online_estore_main_banner_section',
    //            'width' => 340,
    //            'height' => 225,
    //            'active_callback' => 'online_estore_slider_type_options',
    //         )
    //     )
    // );


    // $wp_customize->add_setting(
    //     'online_estore_banner_promo_two_url', 

    //     array(     
    //         'default' => '',
    //         'sanitize_callback' => 'esc_url_raw' //done
    //     )
    // );

    // $wp_customize->add_control(
    //     'online_estore_banner_promo_two_url', 

    //     array(
    //         'type' => 'url',
    //         'label' => esc_html__('Custom Promo Link', 'online-estore'),
    //         'section' => 'online_estore_main_banner_section',
    //         'active_callback' => 'online_estore_slider_type_options',
    //     )
    // );


    /**
     * Additional Theme Options Settings
    */
    $wp_customize->add_panel(
        'online_estore_theme_options',
        array(
            'priority'       => 8,
            'title'          => esc_html__( 'Themes Options', 'online-estore' ),
        )
    );

    /**
     * General Settings Options
     *
     * @since 1.0.0
    */
    $wp_customize->add_section(
        'online_estore_themes_options_general_settings',

        array(
            'title'     => esc_html__( 'General Settings', 'online-estore' ),
            'priority'  => 1,
            'panel'     => 'online_estore_theme_options',
        )
    );

        /**
         * Enable/Disable Option Wow Animate
         *
         * @since 1.0.0
         */
        $wp_customize->add_setting( 
            'online_estore_wow_animate_options', 

            array(
                'sanitize_callback' => 'online_estore_sanitize_on_off',
                'default' => 'on'
            ) 
        );

        $wp_customize->add_control( new Online_eStore_Switch_Control( 
            $wp_customize, 
                'online_estore_wow_animate_options', 

                array(
                    'settings'      => 'online_estore_wow_animate_options',
                    'section'       => 'online_estore_themes_options_general_settings',
                    'label'         => esc_html__( 'Wow Animate Options', 'online-estore' ),
                    'description'   => esc_html__( 'Enable/Disable Slider Content Animation.', 'online-estore' ),
                    'on_off_label'  => array(
                        'on'  => esc_html__( 'Enable', 'online-estore' ),
                        'off' => esc_html__( 'Disable', 'online-estore' )
                    )   
                ) 
            ) 
        );

    /**
     * Breadcrumb Section Settings Options
     *
     * @since 1.0.0
    */
    $wp_customize->add_section(
        'online_estore_breadcrumbs_settings',

        array(
            'title'     => esc_html__( 'Breadcrumbs Settings', 'online-estore' ),
            'priority'  => 2,
            'panel'     => 'online_estore_theme_options',
        )
    );

    /**
     * Enable/Disable Option for Breadcrumb Section
     *
     * @since 1.0.0
     */
    $wp_customize->add_setting( 
        'online_estore_breadcrumb_options', 

        array(
            'sanitize_callback' => 'online_estore_sanitize_on_off',
            'default' => 'on'
        ) 
    );

    $wp_customize->add_control( new Online_eStore_Switch_Control( 
        $wp_customize, 
            'online_estore_breadcrumb_options', 

            array(
                'section'       => 'online_estore_breadcrumbs_settings',
                'label'         => esc_html__( 'Breadcrumbs Section', 'online-estore' ),
                'on_off_label'  => array(
                    'on'  => esc_html__( 'Enable', 'online-estore' ),
                    'off' => esc_html__( 'Disable', 'online-estore' )
                )   
            ) 
        ) 
    );

    /**
     * Enable/Disable Option for Breadcrumb Section
     *
     * @since 1.0.0
     */
    $wp_customize->add_setting( 
        'online_estore_breadcrumb_menu_options', 

        array(
            'sanitize_callback' => 'online_estore_sanitize_on_off',
            'default' => 'on'
        ) 
    );

    $wp_customize->add_control( new Online_eStore_Switch_Control( 
        $wp_customize, 
            'online_estore_breadcrumb_menu_options', 

            array(
                'section'       => 'online_estore_breadcrumbs_settings',
                'label'         => esc_html__( 'Breadcrumbs Nav Menu', 'online-estore' ),
                'on_off_label'  => array(
                    'on'  => esc_html__( 'Enable', 'online-estore' ),
                    'off' => esc_html__( 'Disable', 'online-estore' )
                )   
            ) 
        ) 
    );


    // $wp_customize->add_setting(
    //     'online_estore_breadcrumbs_bg_color',

    //     array(
    //         'default'     => '#111111',
    //         'sanitize_callback' => 'sanitize_hex_color',
    //     )
    // ); 

    // $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize,
    //         'online_estore_breadcrumbs_bg_color',

    //         array(
    //             'label'      => esc_html__( 'Breadcrumbs Background Colors', 'online-estore' ),
    //             'section'    => 'online_estore_breadcrumbs_settings',
    //         )
    //     )
    // );


    // $wp_customize->add_setting(
    //     'online_estore_breadcrumb_bg_image', 

    //     array(
    //         'default' => '',
    //         'sanitize_callback' => 'esc_url_raw'
    //     )
    // );

    // $wp_customize->add_control(new WP_Customize_Image_Control(
    //     $wp_customize, 
    //     'online_estore_breadcrumb_bg_image', 
    //         array(
    //            'label' => esc_html__('Breadcrumbs Background Image', 'online-estore'),
    //            'section' => 'online_estore_breadcrumbs_settings'
    //         )
    //     )
    // );


    $breadcrumb_options = array(
        'layoutone'  => esc_html__( 'Layout One', 'online-estore' ),
        'layouttwo'  => esc_html__( 'Layout Two', 'online-estore' )
    );

        $wp_customize->add_setting(
            'online_estore_breadcrumbs_layout_options',

            array(
                'default'           => 'layoutone',
                'sanitize_callback' => 'online_estore_select_type_sanitize',
            )       
        );

        $wp_customize->add_control(
            'online_estore_breadcrumbs_layout_options',
            array(
                'type'          => 'select',
                'label'         => esc_html__( 'Breadcrumbs Layout', 'online-estore' ),
                'section'       => 'online_estore_breadcrumbs_settings',
                'choices'       => $breadcrumb_options
            )
        );

        $wp_customize->add_setting('o_s_breadcrumbs_upgrade_text', array(
            'sanitize_callback' => 'sanitize_text_field'
        ));

        $wp_customize->add_control(new Online_Estore_Upgrade_Text($wp_customize, 'o_s_breadcrumbs_upgrade_text', array(
            'section' => 'online_estore_breadcrumbs_settings',
            'label' => esc_html__('For more breadcrumbs settings,', 'online-estore'),
            'choices' => array(
                esc_html__('Advanced User Friendly Customization', 'online-estore'),
                esc_html__('Option to Show/Hide Title', 'online-estore'),
                esc_html__('Option to Configure Breadcrumbs Alignment', 'online-estore'),
                esc_html__('Three Different Types of Background', 'online-estore'),
                esc_html__('Customize Margin and Padding', 'online-estore'),
                esc_html__('Change Breadcrumb Title and Text Color', 'online-estore'),
                esc_html__('Change Breadcrumb Anchor and Hover Color', 'online-estore'),
            ),
            'priority' => 100
        )));



    /**
     * Blog Post Settings Options
     *
     * @since 1.0.0
    */
    $wp_customize->add_section(
        'online_estore_post_meta_general_settings',

        array(
            'title'     => esc_html__( 'Blog Posts Settings', 'online-estore' ),
            'priority'  => 3,
            'panel'     => 'online_estore_theme_options',
        )
    );

        /**
         * Blog Posts Continue Reading Button Text
         *
         * @since 1.0.0
         */
        $wp_customize->add_setting(
            'online_estore_post_continue_reading_text',
            array(
                'default'    => esc_html__('Continue Reading','online-estore'),
                'sanitize_callback' => 'sanitize_text_field'
            )
        );

        $wp_customize->add_control(
            'online_estore_post_continue_reading_text',

            array(
                'type'      => 'text',
                'label'     => esc_html__( 'Enter Button Text', 'online-estore' ),
                'section'   => 'online_estore_post_meta_general_settings',
            )
        );


    $post_description = array(
        'none'     => esc_html__( 'None', 'online-estore' ),
        'excerpt'  => esc_html__( 'Post Excerpt', 'online-estore' ),
        'content'  => esc_html__( 'Post Content', 'online-estore' )
    );
        
        $wp_customize->add_setting( 
            'online_estore_post_description_options', 

            array(
                'default'           => 'excerpt',
                'sanitize_callback' => 'online_estore_select_type_sanitize'
            ) 
        );
        
        $wp_customize->add_control( 
            'online_estore_post_description_options', 

            array(
                'type' => 'select',
                'label' => esc_html__( 'Post Description', 'online-estore' ),
                'section' => 'online_estore_post_meta_general_settings',
                'settings' => 'online_estore_post_description_options',
                'choices' => $post_description
            ) 
        );



        /**
         * Number field for Excerpt Length section
         *
         * @since 1.0.0
         */
        $wp_customize->add_setting(
            'online_estore_post_excerpt_length',
            array(
                'default'    => 50,
                'sanitize_callback' => 'absint'
            )
        );

        $wp_customize->add_control(
            'online_estore_post_excerpt_length',

            array(
                'type'      => 'number',
                'label'     => esc_html__( 'Enter Posts Excerpt Length', 'online-estore' ),
                'section'   => 'online_estore_post_meta_general_settings',
            )
        );


        /**
         * Enable/Disable Option for Post Elements Date
         *
         * @since 1.0.0
         */
        $wp_customize->add_setting( 
            'online_estore_post_date_options', 

            array(
                'sanitize_callback' => 'online_estore_sanitize_on_off',
                'default' => 'on'
            ) 
        );

        $wp_customize->add_control( new Online_eStore_Switch_Control( 
            $wp_customize, 
                'online_estore_post_date_options', 

                array(
                    'settings'      => 'online_estore_post_date_options',
                    'section'       => 'online_estore_post_meta_general_settings',
                    'label'         => esc_html__( 'Post Date', 'online-estore' ),
                    'on_off_label'  => array(
                        'on'  => esc_html__( 'Enable', 'online-estore' ),
                        'off' => esc_html__( 'Disable', 'online-estore' )
                    )   
                ) 
            ) 
        );


        /**
         * Enable/Disable Option for Post Elements Comments
         *
         * @since 1.0.0
         */
        $wp_customize->add_setting( 
            'online_estore_post_comments_options', 

            array(
                'sanitize_callback' => 'online_estore_sanitize_on_off',
                'default' => 'on'
            ) 
        );

        $wp_customize->add_control( new Online_eStore_Switch_Control( 
            $wp_customize, 
                'online_estore_post_comments_options', 

                array(
                    'settings'      => 'online_estore_post_comments_options',
                    'section'       => 'online_estore_post_meta_general_settings',
                    'label'         => esc_html__( 'Post Comments', 'online-estore' ),
                    'on_off_label'  => array(
                        'on'  => esc_html__( 'Enable', 'online-estore' ),
                        'off' => esc_html__( 'Disable', 'online-estore' )
                    )   
                ) 
            ) 
        );


        /**
         * Enable/Disable Option for Post Elements Tags
         *
         * @since 1.0.0
         */
        $wp_customize->add_setting( 
            'online_estore_post_author_options', 

            array(
                'sanitize_callback' => 'online_estore_sanitize_on_off',
                'default' => 'on'
            ) 
        );

        $wp_customize->add_control( new Online_eStore_Switch_Control( 
            $wp_customize, 
                'online_estore_post_author_options', 

                array(
                    'settings'      => 'online_estore_post_author_options',
                    'section'       => 'online_estore_post_meta_general_settings',
                    'label'         => esc_html__( 'Post Author', 'online-estore' ),
                    'on_off_label'  => array(
                        'on'  => esc_html__( 'Enable', 'online-estore' ),
                        'off' => esc_html__( 'Disable', 'online-estore' )
                    )   
                ) 
            ) 
        );

        $wp_customize->add_setting('o_s_blog_upgrade_text', array(
            'sanitize_callback' => 'sanitize_text_field'
        ));

        $wp_customize->add_control(new Online_Estore_Upgrade_Text($wp_customize, 'o_s_blog_upgrade_text', array(
            'section' => 'online_estore_post_meta_general_settings',
            'label' => esc_html__('For more blog settings,', 'online-estore'),
            'choices' => array(
                esc_html__('Select Post Layout from Multiple Options', 'online-estore'),
                esc_html__('Select Sidebar Position', 'online-estore'),
                esc_html__('Even Includes Option for No Sidebar', 'online-estore'),
                esc_html__('Customize Text Alignment', 'online-estore'),
                esc_html__('Option to Configure Single Post Sidebar Layout', 'online-estore'),
                esc_html__('Option to Remove Sidebar on Single Post Page', 'online-estore'),
                esc_html__('Option to Enable/Disable Features Image on Single Post Page', 'online-estore'),
                esc_html__('Hide/Show Post Meta/Date/Author', 'online-estore'),
                esc_html__('Hide/Show Post Comments/Form/Tags', 'online-estore'),
                esc_html__('Enable/Disable Navigation', 'online-estore'),
                esc_html__('Customize Margin and Padding on all scale devices', 'online-estore'),
                esc_html__('Change Background, Text and Hover Color', 'online-estore'),
                esc_html__('Change Button Background, Border and Text Color', 'online-estore'),
            ),
            'priority' => 100
        )));


    /**
     * WooCommerce Single Page Layout Settings
     *
     * @since 1.0.0
    */

    $wp_customize->add_section(
        'online_estore_quick_services_settings_section',
        array(
            'title'     => esc_html__( 'Quick Services Settings', 'online-estore' ),
            'priority'  => 9,
        )
    );


    /**
     * Enable/Disable Option for quick services section
     *
     * @since 1.0.0
     */
    $wp_customize->add_setting( 
        'online_estore_quick_services_options', 
        array(
            'sanitize_callback' => 'online_estore_sanitize_on_off',
            'default' => 'off'
        ) 
    );

    $wp_customize->add_control( new Online_eStore_Switch_Control( 
        $wp_customize, 
            'online_estore_quick_services_options', 

            array(
                'settings'      => 'online_estore_quick_services_options',
                'section'       => 'online_estore_quick_services_settings_section',
                'label'         => esc_html__( 'Quick Services Section', 'online-estore' ),
                'on_off_label'  => array(
                    'on'  => esc_html__( 'Enable', 'online-estore' ),
                    'off' => esc_html__( 'Disable', 'online-estore' )
                )   
            ) 
        ) 
    );


    /**
     * Slider Settings Options
     *
     * @since 1.0.0
     */
    $wp_customize->add_setting( 
        'online_estore_quick_services_settings_options', 

        array(
            'sanitize_callback' => 'online_estore_sanitize_repeater',
            'default' => json_encode( array(
                array(
                    'services_icon' => 'fa fa-truck',
                    'services_title' => '',
                    'services_subtitle'  => ''
                )
            ) )        
        )
    );

    $wp_customize->add_control( new online_estore_Repeater_Controler( 
        $wp_customize, 
            'online_estore_quick_services_settings_options', 

            array(
                'label'   => esc_html__('More Services Settings','online-estore'),
                'section' => 'online_estore_quick_services_settings_section',
                'online_estore_box_label' => esc_html__('Services Settings','online-estore'),
                'online_estore_box_add_control' => esc_html__('Add New Services','online-estore'),
            ),

            array(

                'services_icon' => array(
                    'type'      => 'icon',
                    'label'     => esc_html__( 'Select Services Icon', 'online-estore' ),
                    'default'   => 'fa fa-truck'
                ),

                'services_title' => array(
                    'type'      => 'text',
                    'label'     => esc_html__( 'Enter Services Title', 'online-estore' ),
                    'default'   => ''
                ),

                'services_subtitle' => array(
                    'type'      => 'text',
                    'label'     => esc_html__( 'Enter Services Sub Title', 'online-estore' ),
                    'default'   => ''
                )             
            )
        )
    );

    $wp_customize->add_setting('o_s_quick_services_upgrade_text', array(
        'sanitize_callback' => 'sanitize_text_field'
    ));

    $wp_customize->add_control(new Online_Estore_Upgrade_Text($wp_customize, 'o_s_quick_services_upgrade_text', array(
        'section' => 'online_estore_quick_services_settings_section',
        'label' => esc_html__('For more quick services settings', 'online-estore'),
        'choices' => array(
            esc_html__('Select from Various Different Layouts', 'online-estore'),
            esc_html__('Supports Four Different Types of Icons', 'online-estore'),
            esc_html__('Enter Services Description', 'online-estore'),
            esc_html__('Enable/Disable Services Icon', 'online-estore'),
            esc_html__('Select from Various Background Types; Color, Gradient, Image', 'online-estore'),
            esc_html__('Customize Margin and Padding', 'online-estore'),
            esc_html__('Select Service Box Background Color', 'online-estore'),
            esc_html__('Change Icon, Title and Description Color', 'online-estore'),
            esc_html__('Select Service Box Background Color', 'online-estore'),
        ),
        'priority' => 100
    )));


/**
 * Register the radio image control class as a JS control type.
*/
$wp_customize->register_control_type( 'online_estore_Customize_Control_Radio_Image' );


if ( class_exists( 'WooCommerce' ) ) {

    /**
     * WooCommerce Category/Archive Page Layout Settings
     *
     * @since 1.0.0
    */
    $wp_customize->get_section('woocommerce_product_catalog')->title = esc_html__( 'Shop & Category Page Settings', 'online-estore' );
    $wp_customize->get_section('woocommerce_product_catalog' )->priority = 1;    

    /**
     * Image Radio field for woocommerce archive/category sidebar
     *
     * @since 1.0.0
     */
    $wp_customize->add_setting(
        'online_estore_woo_category_settings_section',

        array(
            'default'           => 'rightsidebar',
            'sanitize_callback' => 'sanitize_key',
        )
    );

    $wp_customize->add_control( new online_estore_Customize_Control_Radio_Image(
        $wp_customize,
        'online_estore_woo_category_settings_section',

            array(
                'label'    => esc_html__( 'WooCommerce Archive/Category Page', 'online-estore' ),
                'description' => esc_html__( 'Choose sidebar from available layouts', 'online-estore' ),
                'section'  => 'woocommerce_product_catalog',
                'choices'  => array(
                        'leftsidebar' => array(
                            'label' => esc_html__( 'Left Sidebar', 'online-estore' ),
                            'url'   => '%s/assets/images/left-sidebar.png'
                        ),
                        'rightsidebar' => array(
                            'label' => esc_html__( 'Right Sidebar', 'online-estore' ),
                            'url'   => '%s/assets/images/right-sidebar.png'
                        ),
                        'nosidebar' => array(
                            'label' => esc_html__( 'No Sidebar', 'online-estore' ),
                            'url'   => '%s/assets/images/no-sidebar.png'
                        )
                )
            )
        )
    );

    /**
     * Default loop columns on product archives
     *
     * @since 1.0.0
     */
    $wp_customize->add_setting(
        'online_estore_enter_display_number_columns',
        array(
            'default'    => 3,
            'sanitize_callback' => 'absint'
        )
    );

    $wp_customize->add_control(
        'online_estore_enter_display_number_columns',

        array(
            'type'      => 'number',
            'label'     => esc_html__( 'Enter Display Number of Columns', 'online-estore' ),
            'section'   => 'woocommerce_product_catalog',
        )
    );


    /**
     * Default loop Rows on product archives
     *
     * @since 1.0.0
     */
    $wp_customize->add_setting(
        'online_estore_enter_display_number_rows',
        array(
            'default'    => 4,
            'sanitize_callback' => 'absint'
        )
    );

    $wp_customize->add_control(
        'online_estore_enter_display_number_rows',

        array(
            'type'      => 'number',
            'label'     => esc_html__( 'Enter Display Number of Rows', 'online-estore' ),
            'section'   => 'woocommerce_product_catalog',
        )
    );

    /**
     * Enter Display Number of Products in Shop Page
     *
     * @since 1.0.0
     */
    $wp_customize->add_setting(
        'online_estore_display_number_products',
        array(
            'default'    => 12,
            'sanitize_callback' => 'absint'
        )
    );

    $wp_customize->add_control(
        'online_estore_display_number_products',
        array(
            'type'          => 'number',
            'label'         => esc_html__( 'Enter Display Number Products', 'online-estore' ),
            //'description'   => esc_html__( 'Enter number of columns in shop page for displaying products.', 'online-estore' ),
            'section'       => 'woocommerce_product_catalog',
        )
    );

    $wp_customize->add_setting('o_s_woo_upgrade_text', array(
        'sanitize_callback' => 'sanitize_text_field'
    ));

    $wp_customize->add_control(new Online_Estore_Upgrade_Text($wp_customize, 'o_s_woo_upgrade_text', array(
        'section' => 'woocommerce_product_catalog',
        'label' => esc_html__('For more woocommerce settings,', 'online-estore'),
        'choices' => array(
            esc_html__('Select from Three Different Types of Pagination Style', 'online-estore'),
            esc_html__('Five Different Hover Icon Styles', 'online-estore'),
            esc_html__('Customize Quick/Wishlist/Compare Icon Position', 'online-estore'),
            esc_html__('Set Product Display Layout: List or Grid', 'online-estore'),
            esc_html__('Hide/Show Product Description/Price', 'online-estore'),
            esc_html__('Enable/Disable Sales/New/Discount Tag', 'online-estore'),
            esc_html__('Enter Custom Sales and New Tag Text', 'online-estore'),
            esc_html__('Change Sale and New Text and Background Color', 'online-estore'),
        ),
        'priority' => 100
    )));    



    /**
     * WooCommerce Single Page Layout Settings
     *
     * @since 1.0.0
    */

    $wp_customize->add_section(
        'online_estore_woo_single_settings_section',

        array(
            'title'     => esc_html__( 'Single Product Page Settings', 'online-estore' ),
            'panel'     => 'woocommerce',
            'priority'  => 2,
        )
    );      

    /**
     * Image Radio field for woocommerce archive/category sidebar
     *
     * @since 1.0.0
     */
    $wp_customize->add_setting(
        'online_estore_woo_single_settings_section',

        array(
            'default'           => 'rightsidebar',
            'sanitize_callback' => 'sanitize_key',
        )
    );

    $wp_customize->add_control( new online_estore_Customize_Control_Radio_Image(
        $wp_customize,
        'online_estore_woo_single_settings_section',

            array(
                'label'    => esc_html__( 'WooCommerce Single Product Page', 'online-estore' ),
                'description' => esc_html__( 'Choose sidebar from available layouts', 'online-estore' ),
                'section'  => 'online_estore_woo_single_settings_section',
                'choices'  => array(
                        'leftsidebar' => array(
                            'label' => esc_html__( 'Left Sidebar', 'online-estore' ),
                            'url'   => '%s/assets/images/left-sidebar.png'
                        ),
                        'rightsidebar' => array(
                            'label' => esc_html__( 'Right Sidebar', 'online-estore' ),
                            'url'   => '%s/assets/images/right-sidebar.png'
                        ),
                        'nosidebar' => array(
                            'label' => esc_html__( 'No Sidebar', 'online-estore' ),
                            'url'   => '%s/assets/images/no-sidebar.png'
                        )
                )
            )
        )
    );

    /**
     * Text field for related product section title
     *
     * @since 1.0.0
     */
    $wp_customize->add_setting(
        'online_estore_single_related_product_title',
        array(
            'default'    => esc_html__( 'Related Products', 'online-estore' ),
            'sanitize_callback' => 'sanitize_text_field'
        )
    );

    $wp_customize->add_control(
        'online_estore_single_related_product_title',

        array(
            'type'      => 'text',
            'label'     => esc_html__( 'Enter Related Product Title', 'online-estore' ),
            'section'   => 'online_estore_woo_single_settings_section',
        )
    );


    /**
     * Number field for related product section
     *
     * @since 1.0.0
     */
    $wp_customize->add_setting(
        'online_estore_single_num_related_product',
        array(
            'default'    => 6,
            'sanitize_callback' => 'absint'
        )
    );

    $wp_customize->add_control(
        'online_estore_single_num_related_product',

        array(
            'type'      => 'number',
            'label'     => esc_html__( 'Display Number Related Product', 'online-estore' ),
            'section'   => 'online_estore_woo_single_settings_section',
        )
    );


    /**
     * Number field for related product columns section
     *
     * @since 1.0.0
     */
    $wp_customize->add_setting(
        'online_estore_single_num_related_product_columns',
        array(
            'default'    => 3,
            'sanitize_callback' => 'absint'
        )
    );

    $wp_customize->add_control(
        'online_estore_single_num_related_product_columns',

        array(
            'type'      => 'number',
            'label'     => esc_html__( 'Enter Related Product Columns', 'online-estore' ),
            'section'   => 'online_estore_woo_single_settings_section',
        )
    );


    /**
     * Number field for Upsells product section
     *
     * @since 1.0.0
     */
    $wp_customize->add_setting(
        'online_estore_single_num_upsells_product',
        array(
            'default'    => 6,
            'sanitize_callback' => 'absint'
        )
    );

    $wp_customize->add_control(
        'online_estore_single_num_upsells_product',

        array(
            'type'      => 'number',
            'label'     => esc_html__( 'Display Number Upsells Product', 'online-estore' ),
            'section'   => 'online_estore_woo_single_settings_section',
        )
    );

    /**
     * Number field for related product columns section
     *
     * @since 1.0.0
     */
    $wp_customize->add_setting(
        'online_estore_single_num_upsells_product_columns',
        array(
            'default'    => 3,
            'sanitize_callback' => 'absint'
        )
    );

    $wp_customize->add_control(
        'online_estore_single_num_upsells_product_columns',

        array(
            'type'      => 'number',
            'label'     => esc_html__( 'Enter Upsells Product Columns', 'online-estore' ),
            'section'   => 'online_estore_woo_single_settings_section',
        )
    );

}

    /**
     * Home Page Blog Settings
     *
     * @since 1.0.0
    */

    $wp_customize->add_section(
        'online_estore_home_blog_settings_section',

        array(
            'title'     => esc_html__( 'Home Page Blog Settings', 'online-estore' ),
            'priority'       => 11,
            //'panel'     => 'online_estore_design_settings_panel',
        )
    );      

    /**
     * Image Radio field for archive/category sidebar
     *
     * @since 1.0.0
     */
    $wp_customize->add_setting(
        'online_estore_home_page_blog_sidebar',

        array(
            'default'           => 'rightsidebar',
            'sanitize_callback' => 'sanitize_key',
        )
    );

    $wp_customize->add_control( new online_estore_Customize_Control_Radio_Image(
        $wp_customize,
        'online_estore_home_page_blog_sidebar',

            array(
                'label'    => esc_html__( 'Home Page Blog Sidebars', 'online-estore' ),
                'description' => esc_html__( 'Choose sidebar from available layouts', 'online-estore' ),
                'section'  => 'online_estore_home_blog_settings_section',
                'choices'  => array(
                    'leftsidebar' => array(
                        'label' => esc_html__( 'Left Sidebar', 'online-estore' ),
                        'url'   => '%s/assets/images/left-sidebar.png'
                    ),
                    'rightsidebar' => array(
                        'label' => esc_html__( 'Right Sidebar', 'online-estore' ),
                        'url'   => '%s/assets/images/right-sidebar.png'
                    ),
                    'nosidebar' => array(
                        'label' => esc_html__( 'No Sidebar', 'online-estore' ),
                        'url'   => '%s/assets/images/no-sidebar.png'
                    )
                )
            )
        )
    );

	/**
     * Add Design Settings Panel
     *
     * @since 1.0.0
     */
    $wp_customize->add_panel(
	    'online_estore_design_settings_panel',

	    array(
	        'priority'       => 12,
	        'title'          => esc_html__( 'Page Design Settings', 'online-estore' ),
	    )
    );

	/**
     * Archive/Category Settings
     *
     * @since 1.0.0
    */

    $wp_customize->add_section(
        'online_estore_archive_settings_section',

        array(
            'title'     => esc_html__( 'Archive/Category Settings', 'online-estore' ),
            'panel'     => 'online_estore_design_settings_panel',
        )
    );      

    /**
     * Image Radio field for archive/category sidebar
     *
     * @since 1.0.0
     */
    $wp_customize->add_setting(
        'online_estore_archive_sidebar',

        array(
            'default'           => 'rightsidebar',
            'sanitize_callback' => 'sanitize_key',
        )
    );

    $wp_customize->add_control( new online_estore_Customize_Control_Radio_Image(
        $wp_customize,
        'online_estore_archive_sidebar',

            array(
                'label'    => esc_html__( 'Archive/Category Sidebars', 'online-estore' ),
                'description' => esc_html__( 'Choose sidebar from available layouts', 'online-estore' ),
                'section'  => 'online_estore_archive_settings_section',
                'choices'  => array(
                    'leftsidebar' => array(
                        'label' => esc_html__( 'Left Sidebar', 'online-estore' ),
                        'url'   => '%s/assets/images/left-sidebar.png'
                    ),
                    'rightsidebar' => array(
                        'label' => esc_html__( 'Right Sidebar', 'online-estore' ),
                        'url'   => '%s/assets/images/right-sidebar.png'
                    ),
                    'nosidebar' => array(
                        'label' => esc_html__( 'No Sidebar', 'online-estore' ),
                        'url'   => '%s/assets/images/no-sidebar.png'
                    )
                )
            )
        )
    );

    /**
     * Page Settings
     *
     * @since 1.0.0
     */
    $wp_customize->add_section(
        'online_estore_page_settings_section',

        array(
            'title'     => esc_html__( 'Page & Post Layout Settings', 'online-estore' ),
            'panel'     => 'online_estore_design_settings_panel',
        )
    );      

    /**
     * Image Radio for page sidebar
     *
     * @since 1.0.0
     */
    $wp_customize->add_setting(
        'online_estore_default_page_sidebar',

        array(
            'default'           => 'rightsidebar',
            'sanitize_callback' => 'sanitize_key',
        )
    );

    $wp_customize->add_control( new online_estore_Customize_Control_Radio_Image(
        $wp_customize,
        'online_estore_default_page_sidebar',

            array(
                'label'    => esc_html__( 'Page & Post Sidebars', 'online-estore' ),
                'description' => esc_html__( 'Choose sidebar from available layouts', 'online-estore' ),
                'section'  => 'online_estore_page_settings_section',
                'choices'  => array(
                        'leftsidebar' => array(
                            'label' => esc_html__( 'Left Sidebar', 'online-estore' ),
                            'url'   => '%s/assets/images/left-sidebar.png'
                        ),
                        'rightsidebar' => array(
                            'label' => esc_html__( 'Right Sidebar', 'online-estore' ),
                            'url'   => '%s/assets/images/right-sidebar.png'
                        ),
                        'nosidebar' => array(
                            'label' => esc_html__( 'No Sidebar', 'online-estore' ),
                            'url'   => '%s/assets/images/no-sidebar.png'
                        )
                )
            )
        )
    );

    /**
     * Search Settings
     *
     * @since 1.0.0
    */

    $wp_customize->add_section(
        'online_estore_search_settings_section',

        array(
            'title'     => esc_html__( 'Search Page Settings', 'online-estore' ),
            'panel'     => 'online_estore_design_settings_panel',
        )
    );      

    /**
     * Image Radio field for archive/category sidebar
     *
     * @since 1.0.0
     */
    $wp_customize->add_setting(
        'online_estore_search_sidebar',

        array(
            'default'           => 'rightsidebar',
            'sanitize_callback' => 'sanitize_key',
        )
    );

    $wp_customize->add_control( new online_estore_Customize_Control_Radio_Image(
        $wp_customize,
        'online_estore_search_sidebar',

            array(
                'label'    => esc_html__( 'Search Page Sidebar', 'online-estore' ),
                'description' => esc_html__( 'Choose sidebar from available layouts', 'online-estore' ),
                'section'  => 'online_estore_search_settings_section',
                'choices'  => array(
                        'leftsidebar' => array(
                            'label' => esc_html__( 'Left Sidebar', 'online-estore' ),
                            'url'   => '%s/assets/images/left-sidebar.png'
                        ),
                        'rightsidebar' => array(
                            'label' => esc_html__( 'Right Sidebar', 'online-estore' ),
                            'url'   => '%s/assets/images/right-sidebar.png'
                        ),
                        'nosidebar' => array(
                            'label' => esc_html__( 'No Sidebar', 'online-estore' ),
                            'url'   => '%s/assets/images/no-sidebar.png'
                        )
                )
            )
        )
    );

    


    /**
	 * Footer Section
	 *
	 * @since 1.0.0
	 */
	$wp_customize->add_section(
		'online_estore_footer_section',

		array(
			'title' => esc_html__( 'Main Footer Settings', 'online-estore' ),
			'priority' => 20,
		)
	);


	/**
     * Enable/Disable Option for Main Footer Widget Section
     *
     * @since 1.0.0
     */
    $wp_customize->add_setting( 
    	'online_estore_footer_widget_area_option', 

    	array(
			'sanitize_callback' => 'online_estore_sanitize_on_off',
			'default' => 'on'
		) 
	);

	$wp_customize->add_control( new Online_eStore_Switch_Control( 
		$wp_customize, 
			'online_estore_footer_widget_area_option', 

			array(
				'settings'		=> 'online_estore_footer_widget_area_option',
				'section'		=> 'online_estore_footer_section',
				'label'			=> esc_html__( 'Footer Widgert Area Option', 'online-estore' ),
				'on_off_label' 	=> array(
					'on'  => esc_html__( 'Enable', 'online-estore' ),
					'off' => esc_html__( 'Disable', 'online-estore' )
				)	
			) 
		) 
	);

    $wp_customize->add_setting(
        'online_estore_footer_bg_color',

        array(
            'default'     => '#111111',
            'sanitize_callback' => 'sanitize_hex_color',
        )
    ); 

    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize,
            'online_estore_footer_bg_color',

            array(
                'label'      => esc_html__( 'Main Footer Background Colors', 'online-estore' ),
                'section'    => 'online_estore_footer_section',
            )
        )
    );

    $wp_customize->add_setting(
        'online_estore_footer_widget_payment_image', 
        array(
           'default' => '',
           'sanitize_callback' => 'esc_url_raw'
        )
    );

    $wp_customize->add_control( new WP_Customize_Image_Control(
        $wp_customize, 
                'online_estore_footer_widget_payment_image', array(
                'label' => esc_html__('Upload Payment Logo Image', 'online-estore'),
                'section' => 'online_estore_footer_section',
                'setting' => 'online_estore_footer_widget_payment_image'
            )
        )
    );

	$wp_customize->add_setting(
		'online_estore_footer_section_options', array(
			'default' => '',
			'sanitize_callback' => 'sanitize_text_field'
		)
	);

	$wp_customize->add_control(
		'online_estore_footer_section_options',

		array(
			'type' => 'text',
			'label' => esc_html__('Footer Content (Copyright Text)', 'online-estore'),
			'section' => 'online_estore_footer_section',
			'settings' => 'online_estore_footer_section_options'
		) 
	);


    $wp_customize->add_setting(
        'online_estore_sub_footer_bg_color',

        array(
            'default'     => '#111111',
            'sanitize_callback' => 'sanitize_hex_color',
        )
    ); 

    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize,
            'online_estore_sub_footer_bg_color',

            array(
                'label'      => esc_html__( 'Sub Footer Background Colors', 'online-estore' ),
                'section'    => 'online_estore_footer_section',
            )
        )
    );

    $wp_customize->add_setting('o_s_footer_upgrade_text', array(
        'sanitize_callback' => 'sanitize_text_field'
    ));

    $wp_customize->add_control(new Online_Estore_Upgrade_Text($wp_customize, 'o_s_footer_upgrade_text', array(
        'section' => 'online_estore_footer_section',
        'label' => esc_html__('For more footer settings,', 'online-estore'),
        'choices' => array(
            esc_html__('Enable/Disable Full Width Footer', 'online-estore'),
            esc_html__('Enable/Disable Social Icons', 'online-estore'),
            esc_html__('Hide/Show Payment Options', 'online-estore'),
            esc_html__('Embed Multiple Payment Logo Items', 'online-estore'),
            esc_html__('Option to Hide/Show Payment Logo Item', 'online-estore'),
            esc_html__('Embed Multiple Payment Logo Items', 'online-estore'),
            esc_html__('Advanced Copyright Control', 'online-estore'),
            esc_html__('Select Footer Widget Title Style', 'online-estore'),
            esc_html__('Change Widget Title Color', 'online-estore'),
            esc_html__('Embed Multiple Payment Logo Items', 'online-estore'),
            esc_html__('Customize Text, Anchor and Hover Color for Top, Middle and Bottom Footer Sub Sections', 'online-estore'),
            esc_html__('Enter Custom Margin and Padding', 'online-estore'),
        ),
        'priority' => 100
    )));



    /**
     * Social Media Link Section
     *
     * @since 1.0.0
     */
    $wp_customize->add_section(
        'online_estore_social_media_link',

        array(
            'title' => esc_html__( 'Social Media settings', 'online-estore' ),
            'priority' => 21,
            'panel' => 'online_estore_header',
        )
    );

        $online_estore_social_links = array(

            'online_estore_social_facebook' => array(
                'id' => 'online_estore_social_facebook',
                'title' => esc_html__('Facebook', 'online-estore'),
                'default' => ''
            ),

            'online_estore_social_twitter' => array(
                'id' => 'online_estore_social_twitter',
                'title' => esc_html__('Twitter', 'online-estore'),
                'default' => ''
            ),

            'online_estore_social_instagram' => array(
                'id' => 'online_estore_social_instagram',
                'title' => esc_html__('Instagram', 'online-estore'),
                'default' => ''
            ),

            'online_estore_social_pinterest' => array(
                'id' => 'online_estore_social_pinterest',
                'title' => esc_html__('Pinterest', 'online-estore'),
                'default' => ''
            ),

            'online_estore_social_youtube' => array(
                'id' => 'online_estore_social_youtube',
                'title' => esc_html__('YouTube', 'online-estore'),
                'default' => ''
            ),
        );

        $i = 20;

        foreach( $online_estore_social_links as $online_estore_social_link ) {

            $wp_customize->add_setting(
                $online_estore_social_link['id'], 

                array(
                    'default' => $online_estore_social_link['default'],
                    'sanitize_callback' => 'esc_url_raw'
                )
            );

            $wp_customize->add_control(
                $online_estore_social_link['id'], 

                array(
                    'label' => $online_estore_social_link['title'],
                    'section'=> 'online_estore_social_media_link',
                    'settings'=> $online_estore_social_link['id'],
                    'priority' => $i
                )
            );

          $i++;

        }

        /* Enable/Disable Social Icon Msg */
        $wp_customize->add_setting(
            'o_s_enable_social_icon_text_msg',
            array(
                'default' => false,
                'sanitize_callback' => 'wp_kses_post',
            )
        );
        $wp_customize->add_control(
            new OnlineEstore_Customize_Heading(
                $wp_customize,
                'o_s_enable_social_icon_text_msg',
                array(
                    'label'   => esc_html__( 'Enable/Disable Social Icon Text', 'online-estore' ),
                    'section' => 'online_estore_social_media_link',
                    'priority' => 28,
                )
            )
        );

        $wp_customize->add_setting( 'o_s_enable_social_icon_text', array(
            'type' => 'theme_mod',
            'capability' => 'edit_theme_options',
            'transport' => '',
            'sanitize_callback' => 'online_estore_sanitize_checkbox',
        ));

        $wp_customize->add_control( 'o_s_enable_social_icon_text', array(
            'type' => 'checkbox',
            'label' => __( 'Enable Social Icon Text', 'online-estore' ),
            'section' => 'online_estore_social_media_link',
            'priority' => 29,
        ));

        $wp_customize->add_setting( 'o_s_social_media_layout', array(
            'type' => 'theme_mod',
            'default' => 'style-one',
            'capability' => 'edit_theme_options',
            'transport' => '',
            'sanitize_callback' => 'online_estore_select_type_sanitize',
        ));

        $wp_customize->add_control( 'o_s_social_media_layout', array(
            'type' => 'select',
            'label' => __( 'Select Layout', 'online-estore' ),
            'section' => 'online_estore_social_media_link',
            'priority' => 30,
            'choices' => array(
                'style-one' => __( 'Layout One', 'online-estore' ),
                'style-two' => __( 'Layout Two', 'online-estore' ),
                'style-three' => __( 'Layout Three', 'online-estore' ),
                'style-four' => __( 'Layout Four', 'online-estore' ),
            )
        ));

        $wp_customize->add_setting( 'o_s_social_media_alignment', array(
            'default' => 'text-right',
            'sanitize_callback' => 'sanitize_text_field'
        ));

        $wp_customize->add_control( 'o_s_social_media_alignment', array(
            'type' => 'select',
            'label' => __( 'Select Alignment', 'online-estore' ),
            'section' => 'online_estore_social_media_link',
            'priority' => 31,
            'choices' => array(
                'text-left' => __( 'Left', 'online-estore' ),
                'text-center' => __( 'Center', 'online-estore' ),
                'text-right' => __( 'Right', 'online-estore' ),
            )
        ));

        $wp_customize->add_setting( 'o_s_social_media_color', array(
            'type' => 'theme_mod',
            'capability' => 'edit_theme_options',
            'transport' => '',
            'sanitize_callback' => 'sanitize_hex_color',
        ));

        $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize,
                'o_s_social_media_color',
                array(
                    'label'      => esc_html__( 'Select Color', 'online-estore' ),
                    'section'    => 'online_estore_social_media_link',
                    'priority'   => 32,
                )
            )
        );

        $wp_customize->add_setting('o_s_social_upgrade_text', array(
            'sanitize_callback' => 'sanitize_text_field'
        ));
    
        $wp_customize->add_control(new Online_Estore_Upgrade_Text($wp_customize, 'o_s_social_upgrade_text', array(
            'section' => 'online_estore_social_media_link',
            'label' => esc_html__('For more social settings,', 'online-estore'),
            'choices' => array(
                esc_html__('Enable/Disable Social Icon Area', 'online-estore'),
                esc_html__('Features Repeatable Social Items', 'online-estore'),
                esc_html__('Four Different Types of Icon to Choose From', 'online-estore'),
                esc_html__('Enter Custom Social Text', 'online-estore'),
                esc_html__('Option to Open Link in the New Tab', 'online-estore'),
                esc_html__('Enable/Disable Each Social Item', 'online-estore'),
                esc_html__('Select Icon Background Color and Icon Color', 'online-estore'),
                esc_html__('Set Different Icon Background Color and Icon Color on Hover', 'online-estore'),
            ),
            'priority' => 100
        )));    

    /**
	 * On/Off Sanitization Function
	 *
	 * @since 1.0.0
	 */
    function online_estore_sanitize_on_off($input) {

       $valid_keys = array(
          	'on'  => esc_html__( 'Enable', 'online-estore' ),
			'off' => esc_html__( 'Disable', 'online-estore' )
       );
       if ( array_key_exists( $input, $valid_keys ) ) {
          return $input;
       } else {
          return '';
       }

    }

    /**
     * Advance Search Sanitization Function
     *
     * @since 1.0.0
     */
    function online_estore_search_options_sanitize($input) {

       $valid_keys = array(
            'normalsearch'      => esc_html__( 'Normal Search', 'online-estore' ),
            'advancesearch'     => esc_html__( 'Advance Search ( With Category )', 'online-estore' )
       );
       if ( array_key_exists( $input, $valid_keys ) ) {
          return $input;
       } else {
          return '';
       }

    }

    /**
     * Select Box Sanitization Function
     *
     * @since 1.0.0
    */
    function online_estore_select_type_sanitize( $input, $setting ) {
        
        // get all select options
        $options = $setting->manager->get_control( $setting->id )->choices;
        
        // return default if not valid
        return ( array_key_exists( $input, $options ) ? $input : $setting->default );
    }

    /**
     * Multiple checkbox customize control class.
     *
     * @since 1.0.0
    */
    function online_estore_sanitize_checkbox_multiple( $values ) {

        $multi_values = !is_array( $values ) ? explode( ',', $values ) : $values;

        return !empty( $multi_values ) ? array_map( 'sanitize_text_field', $multi_values ) : array();
    }

    if ( ! function_exists( 'online_estore_sanitize_field_background' ) ) :
        /**
         * Sanitize Field Background
         *
         * @since 1.0.0
         *
         * @param $input
         * @return array
         *
         */
        function online_estore_sanitize_field_background( $input ) {
    
            $input_decoded = json_decode( $input, true );
            $output        = array();
            if ( ! empty( $input_decoded ) ) {
                foreach ( $input_decoded as $key => $value ) {
                    switch ( $key ) :
                        case 'background-size':
                        case 'background-position':
                        case 'background-repeat':
                        case 'background-attachment':
                            $output[ $key ] = sanitize_key( $value );
                            break;
                        case 'background-image':
                            $output[ $key ] = esc_url_raw( $value );
                            break;
                        case 'background-color':
                        case 'background-hover-color':
                        case 'background-color-title':
                        case 'title-font-color':
                        case 'background-color-post':
                        case 'site-title-color':
                        case 'site-tagline-color':
                        case 'post-font-color':
                        case 'text-color':
                        case 'text-hover-color':
                        case 'title-color':
                        case 'link-color':
                        case 'link-hover-color':
                        case 'on-sale-bg':
                        case 'on-sale-color':
                        case 'out-of-stock-bg':
                        case 'out-of-stock-color':
                        case 'rating-color':
                        case 'grid-list-color':
                        case 'grid-list-hover-color':
                        case 'categories-color':
                        case 'categories-hover-color':
                        case 'deleted-price-color':
                        case 'deleted-price-hover-color':
                        case 'price-color':
                        case 'price-hover-color':
                        case 'content-color':
                        case 'content-hover-color':
                        case 'tab-list-color':
                        case 'tab-content-color':
                        case 'tab-list-border-color':
                        case 'tab-content-border-color':
                        case 'background-stripped-color':
                        case 'button-color':
                        case 'button-hover-color':
                        case 'icon-color':
                        case 'icon-hover-color':
                        case 'meta-color':
                        case 'next-prev-color':
                        case 'next-prev-hover-color':
                        case 'button-bg-color':
                        case 'button-bg-hover-color':
                            $output[ $key ] = online_estore_sanitize_color( $value );
                            break;
                        default:
                            $output[ $key ] = sanitize_text_field( $value );
                            break;
                    endswitch;
                }
                return json_encode( $output );
            }
    
            return $input;
    
        }
    
    endif;

    if ( !function_exists( 'online_estore_sanitize_number_blank' ) ) :
    
    /**
     * Number with blank value sanitization callback
     *
     */
    function online_estore_sanitize_number_blank($val) {
      return is_numeric($val) ? $val : '';
    }

    endif;

    /**
     * Sanitize checkbox.
     * @param  $input Whether the checkbox is input.
     */
    function online_estore_sanitize_checkbox( $input ) {
      return ( ( isset( $input ) && true === $input ) ? true : false );
    }

}
add_action( 'customize_register', 'online_estore_customize_register' );

/**
 * Render the site title for the selective refresh partial.
 *
 * @return void
 */
function online_estore_customize_partial_blogname() {
	bloginfo( 'name' );
}

/**
 * Render the site tagline for the selective refresh partial.
 *
 * @return void
 */
function online_estore_customize_partial_blogdescription() {
	bloginfo( 'description' );
}


/**
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
 *
 * Enqueue required scripts/styles for customizer panel
 *
 * @since 1.0.0
 *
 */
function online_estore_customize_backend_scripts() {
    
    wp_enqueue_style( 'onlineestore-customizer-style', get_template_directory_uri() . '/assets/css/onlineestore-customizer.css' );

    wp_enqueue_style( 'font-awesome-admin', get_template_directory_uri()  . '/assets/library/font-awesome/css/font-awesome.css', '4.7.0' );

    wp_enqueue_script( 'onlineestore-customizer-script', get_template_directory_uri() . '/assets/js/onlineestore-customizer.js', array( 'jquery', 'customize-controls' ), '20180910', true );
    
}
add_action( 'customize_controls_enqueue_scripts', 'online_estore_customize_backend_scripts' );

/**
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
 */
function online_estore_customize_preview_js() {
	wp_enqueue_script( 'onlineestore-customizer', get_template_directory_uri() . '/assets/js/customizer-controls.js', array( 'customize-preview' ), '20151215', true );
}
add_action( 'customize_preview_init', 'online_estore_customize_preview_js' );
add_action( 'customize_controls_enqueue_scripts', 'online_estore_customize_preview_js' );