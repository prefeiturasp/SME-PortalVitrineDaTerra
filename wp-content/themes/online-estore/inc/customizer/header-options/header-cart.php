<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/* cart Menu Section*/
$wp_customize->add_section(
	$this->cart,
	array(
		'capability' => 'edit_theme_options',
		'title'      => esc_html__( 'Cart', 'online-estore' ),
		'panel'      => $this->panel,
		'priority'   => 88,
	)
);

$wp_customize->add_setting('online_estore_header_cart_nav', array(
	// 'transport' => 'postMessage',
	'sanitize_callback' => 'wp_kses_post',
	
));

$wp_customize->add_control(new OnlineEstore_Custom_Control_Tab($wp_customize, 'online_estore_header_cart_nav', array(
	'type' => 'tab',
	'section' => $this->cart,
	'priority' => -1,
	'buttons' => array(
		array(
			'name' => esc_html__('Content', 'online-estore'),
			'fields' => array(
				'cart-icon',
				'cart-icon-options',
				'cart-text',
				'cart-show-count',
				'cart-show-price',
				'cart-options'
			),
			'active' => true
		),
		array(
			'name' => esc_html__('Style', 'online-estore'),
			'fields' => array(
				'cart-setting-msg',
				'cart-icon-align',
				'cart-padding-msg',
				'cart-icon-padding', 
				'cart-icon-margin',
				'cart-count-margin',
				'cart_bg_color',
			),
		),
	),
 )));


// Heading
$wp_customize->add_setting(
	'cart-setting-msg',
	array(
		'sanitize_callback' => 'wp_kses_post',
	)
);
$wp_customize->add_control(
	new OnlineEstore_Customize_Heading(
		$wp_customize,
		'cart-setting-msg',
		array(
			'label'   => esc_html__( 'Alignment', 'online-estore' ),
			'section' => $this->cart,
		)
	)
);

/*Menu Icon align*/
$wp_customize->add_setting(
	'cart-icon-align',
	array(
		'default'           => 'swp-flex-align-right',
		'sanitize_callback' => 'online_estore_select_type_sanitize',
		// 'transport'         => 'postMessage',
	)
);
$wp_customize->add_control(
	new OnlineEstore_Custom_Control_Buttonset(
		$wp_customize,
		'cart-icon-align',
		array(
			'choices'  => online_estore_flex_align(),
			'label'    => esc_html__( 'Icon/Text Alignment', 'online-estore' ),
			'section'  => $this->cart,
			'settings' => 'cart-icon-align',
		)
	)
);


/*Menu icon*/
$wp_customize->add_setting(
	'cart-icon-options',
	array(
		'default'           => 'icon',
		'sanitize_callback' => 'online_estore_select_type_sanitize',
		// 'transport'         => 'postMessage',
	)
);

$wp_customize->add_control(
	'cart-icon-options',
	array(
		'choices'  => online_estore_menu_indicator_options(),
		'label'    => esc_html__( 'Cart Indicator Option', 'online-estore' ),
		'section'  => $this->cart,
		'settings' => 'cart-icon-options',
		'type'     => 'select',
	)
);

/*Menu open Text*/
$wp_customize->add_setting(
	'cart-text',
	array(
		'default' => esc_html__( 'Cart', 'online-estore' ),
		'sanitize_callback' => 'sanitize_text_field',
		// 'transport'         => 'postMessage',
	)
);
$wp_customize->add_control(
	'cart-text',
	array(
		'label'           => esc_html__( 'Text', 'online-estore' ),
		'section'         => $this->cart,
		'settings'        => 'cart-text',
		'type'            => 'text',
	)
);

$wp_customize->add_setting('cart-show-count', array(
    'sanitize_callback' => 'sanitize_text_field',
    'default' => true,
    // 'transport' => 'postMessage',
));

$wp_customize->add_control(new OnlineEstore_Checkbox_Control($wp_customize, 'cart-show-count', array(
    'section' => $this->cart,
    'label' => esc_html__('Show Count', 'online-estore'),
)));

$wp_customize->add_setting('cart-show-price', array(
    'sanitize_callback' => 'sanitize_text_field',
    'default' => false,
    // 'transport' => 'postMessage',
));

$wp_customize->add_control(new OnlineEstore_Checkbox_Control($wp_customize, 'cart-show-price', array(
    'section' => $this->cart,
    'label' => esc_html__('Show Price', 'online-estore'),
)));

// Heading
$wp_customize->add_setting(
	'cart-padding-msg',
	array(
		'sanitize_callback' => 'wp_kses_post',
	)
);
$wp_customize->add_control(
	new OnlineEstore_Customize_Heading(
		$wp_customize,
		'cart-padding-msg',
		array(
			'label'   => esc_html__( 'Margin & Padding', 'online-estore' ),
			'section' => $this->cart,
		)
	)
);

/*Padding*/
$wp_customize->add_setting(
	'cart-icon-padding',
	array(
		'sanitize_callback' => 'online_estore_sanitize_field_default_css_box',
		// 'transport'         => 'postMessage',
	)
);
$wp_customize->add_control(
	new OnlineEstore_Custom_Control_Cssbox(
		$wp_customize,
		'cart-icon-padding',
		array(
			'label'    => esc_html__( 'Padding', 'online-estore' ),
			'section'  => $this->cart,
			'settings' => 'cart-icon-padding',
		),
		array(),
		array()
	)
);

/*Margin*/
$wp_customize->add_setting(
	'cart-icon-margin',
	array(
		'sanitize_callback' => 'online_estore_sanitize_field_default_css_box',
		// 'transport'         => 'postMessage',
	)
);
$wp_customize->add_control(
	new OnlineEstore_Custom_Control_Cssbox(
		$wp_customize,
		'cart-icon-margin',
		array(
			'label'    => esc_html__( 'Margin', 'online-estore' ),
			'section'  => $this->cart,
			'settings' => 'cart-icon-margin',
		),
		array(),
		array()
	)
);

/** cart count margin */
$wp_customize->add_setting(
	'cart-count-margin',
	array(
		'sanitize_callback' => 'online_estore_sanitize_field_default_css_box',
		// 'transport'         => 'postMessage',
	)
);
$wp_customize->add_control(
	new OnlineEstore_Custom_Control_Cssbox(
		$wp_customize,
		'cart-count-margin',
		array(
			'label'    => esc_html__( 'Count Margin', 'online-estore' ),
			'section'  => $this->cart,
			'settings' => 'cart-count-margin',
			'min' => -20
		),
		array(),
		array()
	)
);

/**
 * Cart Icon Color, font size
 */
$wp_customize->add_setting(
	'cart-options',
	array(
		'sanitize_callback' => 'online_estore_sanitize_field_border',
		'default'           => array(
			
		),
		// 'transport'         => 'postMessage',
	)
);
$wp_customize->add_control(
	new OnlineEstore_Custom_Control_Group(
		$wp_customize,
		'cart-options',
		array(
			'label'           => esc_html__( 'Cart Settings', 'online-estore' ),
			'section'         => $this->cart,
			'settings'        => 'cart-options'
		),
		array(
			'background-color'         => array(
				'type'  => 'color',
				'label' => esc_html__( 'Background Color', 'online-estore' ),
			),
			'text-color'         => array(
				'type'  => 'color',
				'label' => esc_html__( 'Text Color', 'online-estore' ),
			),
			'icon-font-size'         => array(
				'type'  => 'text',
				'label' => esc_html__( 'Icon Size', 'online-estore' ),
			),

			'text-font-size'         => array(
				'type'  => 'text',
				'label' => esc_html__( 'Text Size', 'online-estore' ),
			),
			
			
			'count-bg-color'         => array(
				'type'  => 'color',
				'label' => esc_html__( 'Count Background', 'online-estore' ),
			),
			'count-text-color'         => array(
				'type'  => 'color',
				'label' => esc_html__( 'Count Text Color', 'online-estore' ),
			)
		)
	)
);

$wp_customize->selective_refresh->add_partial( 'cart-icon', array(
	'selector' => '.header-container .spel-cart',
	// 'container_inclusive' => false,
) );