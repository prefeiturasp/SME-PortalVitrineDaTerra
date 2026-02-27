<?php
/**
 * Functions which enhance the theme by hooking into WordPress
 *
 * @package Online-eStore
 */

/**
 * Adds custom classes to the array of body classes.
 *
 * @param array $classes Classes for the body element.
 * @return array
 */
function online_estore_body_classes( $classes ) {
	// Adds a class of hfeed to non-singular pages.
	if ( ! is_singular() ) {
		$classes[] = 'hfeed';
	}

	// Adds a class of nosidebar when there is no sidebar present.
	if ( ! is_active_sidebar( 'sidebar-1' ) ) {
		$classes[] = 'nosidebar';
	}

	// Add a class of boxed wehen user choose web page boxed layout.
	if( get_theme_mod( 'online_estore_website_layout_options', 'fullwidth' ) == 'boxed') {

		$classes[] = 'boxed';

	}

	
	if ( class_exists( 'WooCommerce' ) ) {
	    
	    if( is_product_category() || is_shop() ) {
	        
	        $woo_page_layout = esc_attr( get_theme_mod( 'online_estore_woo_category_settings_section','rightsidebar' ) );
	        
	        if(!$woo_page_layout){
	            $woo_page_layout = 'rightsidebar';
	        }

	        $classes[] = $woo_page_layout;
	    }

	    if( is_singular('product') ) {
	        $woo_page_layout = esc_attr( get_theme_mod( 'online_estore_woo_single_settings_section','rightsidebar' ) );
	        
	        if(!$woo_page_layout){
	            $woo_page_layout = 'rightsidebar';
	        }

	        $classes[] = $woo_page_layout;
	    }

	    $classes[] = 'woocommerce';
	}
	return $classes;
}
add_filter( 'body_class', 'online_estore_body_classes' );

/**
 * Add a pingback url auto-discovery header for single posts, pages, or attachments.
 */
function online_estore_pingback_header() {
	if ( is_singular() && pings_open() ) {
		printf( '<link rel="pingback" href="%s">', esc_url( get_bloginfo( 'pingback_url' ) ) );
	}
}
add_action( 'wp_head', 'online_estore_pingback_header' );