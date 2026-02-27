<?php
/**
 * Online eStore functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package Online eStore
 */

if ( ! defined( 'ONLINE_ESTORE_T_VERSION' ) ) {
	// Replace the version number of the theme on each release.
	define( 'ONLINE_ESTORE_T_VERSION', '1.0.0' );
}

if ( ! function_exists( 'online_estore_setup' ) ) :
	/**
	 * Sets up theme defaults and registers support for various WordPress features.
	 *
	 * Note that this function is hooked into the after_setup_theme hook, which
	 * runs before the init hook. The init hook is too late for some features, such
	 * as indicating support for post thumbnails.
	 */
	function online_estore_setup() {
		/*
		 * Make theme available for translation.
		 * Translations can be filed in the /languages/ directory.
		 * If you're building a theme based on Online eStore, use a find and replace
		 * to change 'online-estore' to the name of your theme in all the template files.
		 */
		load_theme_textdomain( 'online-estore', get_template_directory() . '/languages' );

		// Add default posts and comments RSS feed links to head.
		add_theme_support( 'automatic-feed-links' );

		/*
		 * Let WordPress manage the document title.
		 * By adding theme support, we declare that this theme does not use a
		 * hard-coded <title> tag in the document head, and expect WordPress to
		 * provide it for us.
		 */
		add_theme_support( 'title-tag' );

		/*
		 * Enable support for Post Thumbnails on posts and pages.
		 *
		 * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
		 */
		add_theme_support( 'post-thumbnails' );
		add_image_size('online-estore-post-list', 285, 370, true);

		
		
		/**
		 * Enable support for post formats
		 *
		 * @link https://developer.wordpress.org/themes/functionality/post-formats/
		 */
		add_theme_support( 'post-formats', array( 'gallery', 'quote', 'audio', 'image', 'video' ) );


		// This theme uses wp_nav_menu() in one location.
		register_nav_menus( array(
			'menu-1' => esc_html__( 'Primary', 'online-estore' ),
			'menu-2' => esc_html__( 'Top Menu', 'online-estore' ),
			'menu-3' => esc_html__( 'Vertical Menu', 'online-estore' ),
			'menu-4' => esc_html__( 'Footer Menu', 'online-estore' )
		) );

		/*
		 * Switch default core markup for search form, comment form, and comments
		 * to output valid HTML5.
		 */
		add_theme_support( 'html5', array(
			'search-form',
			'comment-form',
			'comment-list',
			'gallery',
			'caption',
		) );

		// Set up the WordPress core custom background feature.
		add_theme_support( 'custom-background', apply_filters( 'online_estore_custom_background_args', array(
			'default-color' => 'ffffff',
			'default-image' => '',
		) ) );

		// Add theme support for selective refresh for widgets.
		add_theme_support( 'customize-selective-refresh-widgets' );

		/**
		 * Add support for core custom logo.
		 *
		 * @link https://codex.wordpress.org/Theme_Logo
		 */
		add_theme_support( 'custom-logo', array(
			'height'      => 250,
			'width'       => 250,
			'flex-width'  => true,
			'flex-height' => true,
		) );
	}
endif;
add_action( 'after_setup_theme', 'online_estore_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function online_estore_content_width() {
	// This variable is intended to be overruled from themes.
	// Open WPCS issue: {@link https://github.com/WordPress-Coding-Standards/WordPress-Coding-Standards/issues/1043}.
	// phpcs:ignore WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedVariableFound
	$GLOBALS['content_width'] = apply_filters( 'online_estore_content_width', 640 );
}
add_action( 'after_setup_theme', 'online_estore_content_width', 0 );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function online_estore_widgets_init() {
	
	register_sidebar( array(
		'name'          => esc_html__( 'Right Sidebar Widget Area', 'online-estore' ),
		'id'            => 'sidebar-1',
		'description'   => esc_html__( 'Add widgets here.', 'online-estore' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title wow fadeInUp">',
		'after_title'   => '</h2>',
	) );

	register_sidebar( array(
		'name'          => esc_html__( 'Left Sidebar Widget Area', 'online-estore' ),
		'id'            => 'sidebar-2',
		'description'   => esc_html__( 'Add widgets here.', 'online-estore' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title wow fadeInUp">',
		'after_title'   => '</h2>',
	) );


	register_sidebar( array(
		'name'          => esc_html__( 'Online eStore HomePage Widget', 'online-estore' ),
		'id'            => 'home-1',
		'description'   => esc_html__( 'Add widgets here.', 'online-estore' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );


	register_sidebar( array(
		'name'          => esc_html__( 'Footer Widget Area One', 'online-estore' ),
		'id'            => 'footer-1',
		'description'   => esc_html__( 'Add widgets here.', 'online-estore' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );

	register_sidebar( array(
		'name'          => esc_html__( 'Footer Widget Area Two', 'online-estore' ),
		'id'            => 'footer-2',
		'description'   => esc_html__( 'Add widgets here.', 'online-estore' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );

	register_sidebar( array(
		'name'          => esc_html__( 'Footer Widget Area Three', 'online-estore' ),
		'id'            => 'footer-3',
		'description'   => esc_html__( 'Add widgets here.', 'online-estore' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );

	register_sidebar( array(
		'name'          => esc_html__( 'Footer Widget Area Four', 'online-estore' ),
		'id'            => 'footer-4',
		'description'   => esc_html__( 'Add widgets here.', 'online-estore' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );

}
add_action( 'widgets_init', 'online_estore_widgets_init' );


if ( ! function_exists( 'online_estore_fonts_url' ) ) :

	/**
	 * Register Google fonts for News Portal.
	 *
	 * @return string Google fonts URL for the theme.
	 * @since 1.0.0
	 */

    function online_estore_fonts_url() {

        $fonts_url = '';
        $font_families = array();

        /*
         * Translators: If there are characters in your language that are not supported
         * by Roboto Condensed, translate this to 'off'. Do not translate into your own language.
         */
        if ( 'off' !== _x( 'on', 'Open Sans font: on or off', 'online-estore' ) ) {
            $font_families[] = 'Open Sans:wght@100,200,300;400;600;700;800';
        }

		if ( 'off' !== _x( 'on', 'Rochester font: on or off', 'online-estore' ) ) {
            $font_families[] = 'Rochester';
        }

        if( $font_families ) {
            $query_args = array(
                'family' => urlencode( implode( '|', $font_families ) ),
                'subset' => urlencode( 'latin,latin-ext' ),
            );

            $fonts_url = add_query_arg( $query_args, 'https://fonts.googleapis.com/css' );
        }

        return $fonts_url;
    }

endif;


/**
 * Enqueue scripts and styles.
 */
function online_estore_scripts() {
	
	$min = defined( 'SCRIPT_DEBUG' ) && SCRIPT_DEBUG ? '' : '.min';

	wp_enqueue_style( 'online-estore-fonts', online_estore_fonts_url(), array(), null );

	/**
	 * Load Font Awesome CSS Library File
	*/
	wp_enqueue_style( 'font-awesome-4', trailingslashit( esc_url ( get_template_directory_uri() ) ) . '/assets/library/font-awesome/css/font-awesome' . esc_attr( $min ) . '.css', '', '4.7.0' );

	/**
	 * Load Chosen JS Library File
	*/
	wp_enqueue_style( 'chosen', trailingslashit( esc_url ( get_template_directory_uri() ) ) . '/assets/library/chosen/chosen' . esc_attr( $min ) . '.css', '1.8.2', true );

	/**
	 * Load Animate CSS Library File
	*/
	wp_enqueue_style( 'animate', trailingslashit( esc_url ( get_template_directory_uri() ) ) . '/assets/library/animate/animate' . esc_attr( $min ) . '.css', '3.7.0' );

	/**
	 * Load Lightslider CSS Library File
	*/
	wp_enqueue_style( 'lightslider', trailingslashit( esc_url ( get_template_directory_uri() ) ) . '/assets/library/lightslider/css/lightslider' . esc_attr( $min ) . '.css', '1.1.3' );

	/**
	 * Flexslider Slider CSS Library File
	*/
	wp_enqueue_style( 'flexslider', trailingslashit( esc_url ( get_template_directory_uri() ) ) . '/assets/library/flexslider/css/flexslider.css' );

	/* ONLINE E-STORE Store Main Style */
    wp_enqueue_style( 'online-estore-bg-color', get_template_directory_uri() . '/assets/css/bg-color.css', ONLINE_ESTORE_T_VERSION );
	wp_enqueue_style( 'online-estore-font-color', get_template_directory_uri() . '/assets/css/font-color.css', ONLINE_ESTORE_T_VERSION );
	wp_enqueue_style( 'online-estore-border-color', get_template_directory_uri() . '/assets/css/border-color.css', ONLINE_ESTORE_T_VERSION );
	wp_enqueue_style( 'online-estore-style', get_stylesheet_uri(), array(), ONLINE_ESTORE_T_VERSION );

	//wp_enqueue_style( 'online-estore-style-responsive', get_template_directory_uri() . '/assets/css/responsive.css' );
	//wp_enqueue_style( 'online-estore-style', get_stylesheet_uri() );

	/**
	 * Load WoW JS Library File
	*/
	wp_enqueue_script( 'wow', trailingslashit( esc_url ( get_template_directory_uri() ) ) . 'assets/library/wow/wow' . esc_attr( $min ) . '.js', '1.1.3', true );

	/**
	 * Load Lightslider JS Library File
	*/
	wp_enqueue_script( 'lightslider', trailingslashit( esc_url ( get_template_directory_uri() ) ) . '/assets/library/lightslider/js/lightslider' . esc_attr( $min ) . '.js', array('jquery'), '1.1.6', true );

	/**
	 * Flexslider Slider JS Library File
	*/
	wp_enqueue_script('jquery-flexslider', trailingslashit( esc_url ( get_template_directory_uri() ) ) . '/assets/library/flexslider/js/jquery.flexslider' . esc_attr( $min ) . '.js', array('jquery'), '2.2.2', true);

	/**
	 * Load Chosen JS Library File
	*/
	wp_enqueue_script( 'chosen-jquery', trailingslashit( esc_url ( get_template_directory_uri() ) ) . '/assets/library/chosen/chosen.jquery' . esc_attr( $min ) . '.js', '1.8.2', true );

	/**
	 * Load html5 JS Library File
	*/
    wp_enqueue_script('html5', trailingslashit( esc_url ( get_template_directory_uri() ) ) . '/assets/library/html5shiv/html5shiv' . esc_attr( $min ) . '.js', array('jquery'), false );
    wp_script_add_data( 'html5', 'conditional', 'lt IE 9' );

    /**
	 * Load respond JS Library File
	*/
    wp_enqueue_script('respond', trailingslashit( esc_url ( get_template_directory_uri() ) ) . '/assets/library/respond/respond' . esc_attr( $min ) . '.js', array('jquery'), false );
    wp_script_add_data( 'respond', 'conditional', 'lt IE 9' );

	wp_enqueue_script( 'online-estore-skip-link-focus-fix', trailingslashit( esc_url ( get_template_directory_uri() ) ) . '/assets/js/skip-link-focus-fix.js', array(), '20151215', true );

	/**
	 * Theme Custom js 
	*/
	$wowanimate   = get_theme_mod( 'online_estore_wow_animate_options', 'on' );

	wp_enqueue_script('online-estore-custom', trailingslashit( esc_url ( get_template_directory_uri() ) ) . '/assets/js/onlineestorecustom.js', array('jquery', 'masonry','jquery-ui-tabs'), true );

	wp_localize_script( 'online-estore-custom', 'online_estore_tabs_ajax_action', array( 
		'ajaxurl' 		=>  esc_url(admin_url( 'admin-ajax.php')),
		'wowanimate'   	=> $wowanimate
	));

	wp_localize_script( 'online-estore-custom', 'online_estore_tabs_products_ajax_action', array( 
		'ajaxurl' => esc_url(admin_url( 'admin-ajax.php'))
	) );


	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'online_estore_scripts' );


/**
 * Enqueue scripts and styles for only admin
 *
 * @since 1.0.0
 */
add_action( 'admin_enqueue_scripts', 'online_estore_admin_scripts' );

function online_estore_admin_scripts( $hook ) {

    if( 'widgets.php' != $hook && 'customize.php' != $hook && 'edit.php' != $hook && 'post.php' != $hook && 'post-new.php' != $hook ) {
        return;
    }
    
    wp_enqueue_script( 'online-estore-admin-script', get_template_directory_uri() .'/assets/js/onlineestore-admin.js', array( 'jquery' ), true );

    wp_enqueue_style( 'online-estore-admin-style', get_template_directory_uri() . '/assets/css/onlineestore-admin.css' );
}


/**
 * Require init.
*/
require trailingslashit( get_template_directory() ).'sparklethemes/init.php';

if ( ! function_exists( 'online_estore_is_active_header' ) ) :

	/**
	 * online_estore_is_active_header
	 * @return true
	 */
	function online_estore_is_active_header() {
		return true;
	}
endif;

if ( ! function_exists( 'online_estore_responsive_button_value' ) ) {

	/**
	 * online_estore_responsive_button_value
	 * @param  array  $button_group
	 * @param  string $device
	 * @return string
	 */
	function online_estore_responsive_button_value( $button_group, $device ) {

		$button_val = '';
		if ( ! is_array( $button_group ) ) {
			return false;
		}
		foreach ( $button_group as $device_data => $value ) {

			switch ( $device_data ) {

				case 'desktop':
					if ( 'desktop' == $device ) {
						if ( ! empty( $value ) ) {

							$button_val = $value . '-desktop';
						}
					}
					break;

				case 'tablet':
					if ( 'tablet' == $device ) {
						if ( ! empty( $value ) ) {
							$button_val = $value . '-tablet';
						}
					}
					break;

				case 'mobile':
					if ( 'mobile' == $device ) {
						if ( ! empty( $value ) ) {
							$button_val = $value . '-mobile';
						}
					}
					break;

				default:
					break;
			}
		}
		return $button_val;
	}
}

if ( ! function_exists( 'online_estore_ifset' ) ) {

	/**
	 * online_estore_ifset
	 * @param string $var
	 * @return string
	 */
	function online_estore_ifset( &$var ) {
		if ( isset( $var ) ) {
			return $var;
		}
		return '';
	}
}

if ( ! function_exists( 'online_estore_boxshadow_values_inline' ) ) {

	/**
	 * online_estore_boxshadow_values_inline description
	 * @param  array  $position_collection
	 * @param  string $device
	 * @return string
	 */
	function online_estore_boxshadow_values_inline( $position_collection, $device ) {

		$inline_css = '';
		if ( ! is_array( $position_collection ) ) {
			return false;
		}
		foreach ( $position_collection as $device_data => $value ) {

			switch ( $device_data ) {

				case 'desktop':
					if ( 'desktop' == $device ) {

						$top    = $value['x'];
						$top    = ( ! empty( $top ) ) ? $top . 'px' : '0';
						$right  = $value['Y'];
						$right  = ( ! empty( $right ) ) ? $right . 'px' : '0';
						$bottom = $value['BLUR'];
						$bottom = ( ! empty( $bottom ) ) ? $bottom . 'px' : '0';
						$left   = $value['SPREAD'];
						$left   = ( ! empty( $left ) ) ? $left . 'px' : '0';
						$inset  = $value['cssbox_link'];
						$inset  = ( $inset ) ? 'inset' : '';

						$inline_css = $inset . ' ' . $top . ' ' . $right . ' ' . $bottom . ' ' . $left;
					}
					break;

				case 'tablet':
					if ( 'tablet' == $device ) {

						$top    = $value['x'];
						$top    = ( ! empty( $top ) ) ? $top . 'px' : '0';
						$right  = $value['Y'];
						$right  = ( ! empty( $right ) ) ? $right . 'px' : '0';
						$bottom = $value['BLUR'];
						$bottom = ( ! empty( $bottom ) ) ? $bottom . 'px' : '0';
						$left   = $value['SPREAD'];
						$left   = ( ! empty( $left ) ) ? $left . 'px' : '0';
						$inset  = $value['cssbox_link'];
						$inset  = ( $inset ) ? 'inset' : '';

						$inline_css = $inset . ' ' . $top . ' ' . $right . ' ' . $bottom . ' ' . $left;
					}
					break;

				case 'mobile':
					if ( 'mobile' == $device ) {

						$top    = $value['x'];
						$top    = ( ! empty( $top ) ) ? $top . 'px' : '0';
						$right  = $value['Y'];
						$right  = ( ! empty( $right ) ) ? $right . 'px' : '0';
						$bottom = $value['BLUR'];
						$bottom = ( ! empty( $bottom ) ) ? $bottom . 'px' : '0';
						$left   = $value['SPREAD'];
						$left   = ( ! empty( $left ) ) ? $left . 'px' : '0';
						$inset  = $value['cssbox_link'];
						$inset  = ( $inset ) ? 'inset' : '';

						$inline_css = $inset . ' ' . $top . ' ' . $right . ' ' . $bottom . ' ' . $left;
					}
					break;

				default:
					break;
			}
		}
		return $inline_css;
	}
}

/** remove widgets block editor */
function online_estore_widget_theme_support() {
    remove_theme_support( 'widgets-block-editor' );
}
add_action( 'after_setup_theme', 'online_estore_widget_theme_support' );