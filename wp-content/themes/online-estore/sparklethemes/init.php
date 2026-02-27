<?php
/**
 * Main Custom admin functions area
 *
 * @since Sparkle Themes
 *
 * @param Online eStore
 *
 */


/**
 * Load Custom Admin functions that act independently of the theme functions.
 */
require get_theme_file_path('sparklethemes/functions.php');

/**
 * Implement the Custom Header feature.
*/
require get_theme_file_path('sparklethemes/core/custom-header.php');


/**
 * Custom template tags for this theme.
 */
require get_theme_file_path('sparklethemes/core/template-tags.php');


/**
 * Customizer additions.
 */
require get_theme_file_path('sparklethemes/customizer/customizer.php');


/**
 * Functions which enhance the theme by hooking into WordPress.
 */
require get_theme_file_path('sparklethemes/core/template-functions.php');


/**
 * Load Jetpack compatibility file.
 */
if ( defined( 'JETPACK__VERSION' ) ) {

	require get_theme_file_path('sparklethemes/core/jetpack.php');
    
}

/**
 * Load Widget function file
 */
require get_theme_file_path('sparklethemes/widgets/widget-fields.php');
require get_theme_file_path('sparklethemes/widgets/fullpromo.php');
require get_theme_file_path('sparklethemes/widgets/promo-widget.php');
require get_theme_file_path('sparklethemes/widgets/blogs-widget.php');
require get_theme_file_path('sparklethemes/widgets/aboutus-info.php');


/**
 * Load WooCommerce compatibility file.
 */
if ( class_exists( 'WooCommerce' ) ) {

	require get_theme_file_path('sparklethemes/core/woocommerce.php');

	require get_theme_file_path('sparklethemes/widgets/multiplecategorylist.php');
	require get_theme_file_path('sparklethemes/widgets/multiple-category-products.php');
	require get_theme_file_path('sparklethemes/widgets/single-category-products.php');
	require get_theme_file_path('sparklethemes/widgets/products-type.php');
	require get_theme_file_path('sparklethemes/widgets/bestsellingproducts.php');
	require get_theme_file_path('sparklethemes/widgets/onsaleproducts.php');
	require get_theme_file_path('sparklethemes/widgets/topratedproducts.php');
	require get_theme_file_path('sparklethemes/widgets/allproductstype.php');
	require get_theme_file_path('sparklethemes/widgets/multiple-category-tabs.php');
	require get_theme_file_path('sparklethemes/widgets/tabs-products-type.php');

}

/**
 * Load breadcrumbs class
 */
if ( ! function_exists( 'breadcrumb_trail' ) ) {

	require get_template_directory() . '/sparklethemes/breadcrumbs.php';
}

require get_template_directory() .'/inc/options.php';
require get_template_directory() .'/inc/custom-controller/init.php';

/*Customizer Builder*/
require get_template_directory() .'/inc/library/customizer-builder/class-customizer-builder.php';

/*Header Builder*/
require get_template_directory() .'/inc/customizer/header-options/header-builder.php';

/*Header Hooks*/
require get_template_directory() .'/inc/customizer/header-options/header-hooks.php';


/** dynamic css */
require get_template_directory() .'/inc/dynamic-css.php';

if(is_admin()){
	/**
	 * Welcome Page.
	 */
	require get_template_directory() . '/inc/welcome/welcome.php';
}

/** 
 * Mobile Menu 
*/
require get_template_directory() . '/sparklethemes/mobile-menu/init.php';

require get_theme_file_path('sparklethemes/customizer/class-customize.php');