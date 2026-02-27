<?php
/**
 * Template Name: Online eStore HomePage
 *
 * This is the template that displays all widgets included in homepage widget area.
 *
 * @package Sparkle Themes
 *
 * @subpackage Online eStore
 *
 * @since 1.0.0
 */

get_header(); 

	/**
	 * Home Page Main Widget Area
	 *
	 * @since 1.0.0
	 */
	if( is_active_sidebar('home-1')){ 

		dynamic_sidebar( 'home-1' ); 
		 
	} 

get_footer();