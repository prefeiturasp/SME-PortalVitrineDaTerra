<?php

/*Define Constants for this theme*/
define( 'ONLINE_ESTORE_PRO_VERSION', '1.2.8' );
define( 'ONLINE_ESTORE_PRO_PATH', get_template_directory() );
define( 'ONLINE_ESTORE_PRO_URL', get_template_directory_uri() );
define( 'ONLINE_ESTORE_PRO_SCRIPT_PREFIX', ( defined( 'SCRIPT_DEBUG' ) && SCRIPT_DEBUG ) ? '' : '.min' );


if ( ! function_exists( 'online_estore_site_general_layout_option' ) ) :

	/**
	 * Site General Layout
	 * This is apply for header, footer and site main content
	 *
	 * @since Online Estore 1.0.0
	 *
	 * @param null
	 * @return array $online_estore_site_general_layout_option
	 *
	 */
	function online_estore_site_general_layout_option( $not_dependent = false ) {
		$online_estore_site_general_layout_option = array(
			'spwp-full-width'  => esc_html__( 'Full Width', 'online-estore' ),
			'spwp-fluid-width' => esc_html__( 'Fluid Width', 'online-estore' ),
		);
		if ( ! $not_dependent ) {
			$dependent                           = array( 'inherit' => esc_html__( 'Inherit', 'online-estore' ) );
			$online_estore_site_general_layout_option = array_merge( $dependent, $online_estore_site_general_layout_option );
		}
		return apply_filters( 'online_estore_site_general_layout_option', $online_estore_site_general_layout_option );
	}
endif;


if ( ! function_exists( 'online_estore_background_image_size_options' ) ) :

	/**
	 * Background Image Size Options
	 *
	 * @since Online Estore 1.0.0
	 *
	 * @param null
	 * @return array $online_estore_background_image_size_options
	 *
	 */
	function online_estore_background_image_size_options() {

		$online_estore_background_image_size_options = array(
			'auto'    => esc_html__( 'Auto', 'online-estore' ),
			'cover'   => esc_html__( 'Cover', 'online-estore' ),
			'contain' => esc_html__( 'Contain', 'online-estore' ),
		);
		return apply_filters( 'online_estore_background_image_size_options', $online_estore_background_image_size_options );
	}
endif;

if ( ! function_exists( 'online_estore_background_image_position_options' ) ) :

	/**
	 * Background Image Position Options
	 *
	 * @since Online Estore 1.0.0
	 *
	 * @param null
	 * @return array $online_estore_background_image_position_options
	 *
	 */
	function online_estore_background_image_position_options() {

		$online_estore_background_image_position_options = array(
			'center'        => esc_html__( 'Center', 'online-estore' ),
			'left_center'   => esc_html__( 'Left Center', 'online-estore' ),
			'right_center'  => esc_html__( 'Right Center', 'online-estore' ),
			'top_left'      => esc_html__( 'Top Left', 'online-estore' ),
			'top_right'     => esc_html__( 'Top Right', 'online-estore' ),
			'top_center'    => esc_html__( 'Top Center', 'online-estore' ),
			'bottom_left'   => esc_html__( 'Bottom Left', 'online-estore' ),
			'bottom_right'  => esc_html__( 'Bottom Right', 'online-estore' ),
			'bottom_center' => esc_html__( 'Bottom Center', 'online-estore' ),
		);
		return apply_filters( 'online_estore_background_image_position_options', $online_estore_background_image_position_options );
	}
endif;

if ( ! function_exists( 'online_estore_background_image_repeat_options' ) ) :

	/**
	 * Background Image Repeat Options
	 *
	 * @since Online Estore 1.0.0
	 *
	 * @param null
	 * @return array $online_estore_background_image_repeat_options
	 *
	 */
	function online_estore_background_image_repeat_options() {

		$online_estore_background_image_repeat_options = array(
			'no-repeat' => esc_html__( 'No Repeat', 'online-estore' ),
			'repeat'    => esc_html__( 'Repeat', 'online-estore' ),
			'repeat-x'  => esc_html__( 'Repeat X', 'online-estore' ),
			'repeat-y'  => esc_html__( 'Repeat Y', 'online-estore' ),
		);
		return apply_filters( 'online_estore_background_image_repeat_options', $online_estore_background_image_repeat_options );
	}
endif;

if ( ! function_exists( 'online_estore_background_image_attachment_options' ) ) :

	/**
	 * Background Image Attachment Options
	 *
	 * @since Online Estore 1.0.0
	 *
	 * @param null
	 * @return array $online_estore_background_image_attachment_options
	 *
	 */
	function online_estore_background_image_attachment_options() {

		$online_estore_background_image_attachment_options = array(
			'scroll' => esc_html__( 'Scroll', 'online-estore' ),
			'fixed'  => esc_html__( 'Fixed', 'online-estore' ),
		);
		return apply_filters( 'online_estore_background_image_attachment_options', $online_estore_background_image_attachment_options );
	}
endif;

if ( ! function_exists( 'online_estore_header_border_style' ) ) :

	/**
	 * Header Border Style
	 *
	 * @since Online Estore 1.0.0
	 *
	 * @param null
	 * @return array $online_estore_header_border_style
	 *
	 */
	function online_estore_header_border_style() {
		$online_estore_header_border_style = array(
			'none'   => esc_html__( 'None', 'online-estore' ),
			'solid'  => esc_html__( 'Solid', 'online-estore' ),
			'dotted' => esc_html__( 'Dotted', 'online-estore' ),
			'dashed' => esc_html__( 'Dashed', 'online-estore' ),
			'double' => esc_html__( 'Double', 'online-estore' ),
			'ridge'  => esc_html__( 'Ridge', 'online-estore' ),
			'inset'  => esc_html__( 'Inset', 'online-estore' ),
			'outset' => esc_html__( 'outset', 'online-estore' ),
		);
		return apply_filters( 'online_estore_header_border_style', $online_estore_header_border_style );
	}
endif;

if ( ! function_exists( 'online_estore_header_top_height_option' ) ) :

	/**
	 * Header Top Options
	 *
	 * @since Online Estore 1.0.0
	 *
	 * @param null
	 * @return array $online_estore_header_top_height_option
	 *
	 */
	function online_estore_header_top_height_option() {
		$online_estore_header_top_height_option = array(
			'auto'   => esc_html__( 'Auto', 'online-estore' ),
			'custom' => esc_html__( 'Custom', 'online-estore' ),
		);
		return apply_filters( 'online_estore_header_top_height_option', $online_estore_header_top_height_option );
	}
endif;

if ( ! function_exists( 'online_estore_get_default_theme_options' ) ) :
	/**
	*  Default Theme layout options
	*
	* @since Online Estore 1.0.0
	*
	* @param null
	* @return array $online_estore_theme_layout
	*
	*/

	function online_estore_get_default_theme_options() {

		$default_theme_options = array(

			/*Header top options*/
			'header-top-options' => 'hide',
			'ajax-show-more'     => '',
			'ajax-no-more'       => '',
		);
		// $data = apply_filters( 'online_estore_default_theme_options', $default_theme_options );
		return apply_filters( 'online_estore_default_theme_options', $default_theme_options );
	}

	online_estore_get_default_theme_options();
endif;


if ( ! function_exists( 'online_estore_get_theme_options' ) ) :
	/**
	* Get theme options
	*
	* @since Online Estore 1.0.0
	*
	* @param null
	* @return mixed online_estore_theme_options
	*
	*/
	function online_estore_get_theme_options( $key = '', $value='' ) {
		
		if ( ! empty( $key ) ) {
			$online_estore_default_theme_options = online_estore_get_default_theme_options();
			$online_estore_get_theme_options     = get_theme_mod( $key, isset( $online_estore_default_theme_options[ $key ] ) ? $online_estore_default_theme_options[ $key ] : $value );
			return apply_filters( 'online_estore_' . $key, $online_estore_get_theme_options );
		}
		return false;
	}
endif;

if ( ! function_exists( 'online_estore_menu_indicator_options' ) ) :

	/**
	 * Menu Indicator options
	 *
	 * @since Online Estore 1.0.0
	 *
	 * @param null
	 * @return array $online_estore_menu_indicator_options
	 *
	 */
	function online_estore_menu_indicator_options() {
		$online_estore_menu_indicator_options = array(
			'text' => esc_html__( 'Text', 'online-estore' ),
			'icon' => esc_html__( 'Icon', 'online-estore' ),
			'both' => esc_html__( 'Icon & Text', 'online-estore' ),
		);
		return apply_filters( 'online_estore_menu_indicator_options', $online_estore_menu_indicator_options );
	}
endif;


if ( ! function_exists( 'online_estore_icon_position' ) ) :

	/**
	 * Icon Position
	 *
	 * @since Online Estore 1.0.0
	 *
	 * @param null
	 * @return array $online_estore_icon_position
	 *
	 */
	function online_estore_icon_position() {
		$online_estore_icon_position = array(
			'before' => esc_html__( 'Before', 'online-estore' ),
			'after'  => esc_html__( 'After', 'online-estore' ),
		);
		return apply_filters( 'online_estore_icon_position', $online_estore_icon_position );
	}
endif;

if ( ! function_exists( 'online_estore_flex_align' ) ) :

	/**
	 * Flex Align
	 *
	 * @since Online Estore 1.0.0
	 *
	 * @param null
	 * @return array $online_estore_align
	 *
	 */
	function online_estore_flex_align() {
		$online_estore_flex_align = array(
			'swp-flex-align-left'   => esc_html__( 'Left', 'online-estore' ),
			'swp-flex-align-center' => esc_html__( 'Center', 'online-estore' ),
			'swp-flex-align-right'  => esc_html__( 'Right', 'online-estore' ),
		);
		return apply_filters( 'online_estore_flex_align', $online_estore_flex_align );
	}
endif;

if ( ! function_exists( 'online_estore_header_bg_options' ) ) :

	/**
	 * Header Background options
	 *
	 * @since Online Estore 1.0.0
	 *
	 * @param null
	 * @return array $online_estore_header_bg_options
	 *
	 */
	function online_estore_header_bg_options() {
		$online_estore_header_bg_options = array(
			'none'   => esc_html__( 'None', 'online-estore' ),
			'custom' => esc_html__( 'Custom', 'online-estore' ),
		);
		return apply_filters( 'online_estore_header_bg_options', $online_estore_header_bg_options );
	}
endif;

if ( ! function_exists( 'online_estore_get_nav_menus' ) ) :

	/**
	 * Get Nav Menus Array
	 *
	 * @since Online Estore 1.0.0
	 *
	 * @param null
	 * @return array $nav_menus
	 *
	 */
	function online_estore_get_nav_menus( $options = array() ) {
		$online_estore_get_nav_menus = array();
		$nav_menus              = wp_get_nav_menus();
		foreach ( $nav_menus as $menu ) {
			$online_estore_get_nav_menus[ $menu->term_id ] = ucwords( $menu->name );
		}
		return apply_filters( 'online_estore_get_nav_menus', $online_estore_get_nav_menus );
	}
endif;

/**
 * Default color palettes
 *
 * @since Online Estore 1.0.0
 * @param null
 * @return array $online_estore_default_color_palettes
 *
 */
if ( ! function_exists( 'online_estore_default_color_palettes' ) ) {

	function online_estore_default_color_palettes() {

		$palettes = array(
			'#000000',
			'#ffffff',
			'#dd3333',
			'#dd9933',
			'#eeee22',
			'#81d742',
			'#1e73be',
			'#8224e3',
		);
		return apply_filters( 'online_estore_default_color_palettes', $palettes );
	}
}

if ( ! function_exists( 'online_estore_header_layout_options' ) ) :

	/**
	 * Header layout options
	 *
	 * @since Online Estore 1.0.0
	 *
	 * @param null
	 * @return array $online_estore_header_layout_options
	 *
	 */
	function online_estore_header_layout_options() {
		$layout = array(
			'normal'                  => esc_html__( 'Normal', 'online-estore' ),
			'sticky'                  => esc_html__( 'Sticky', 'online-estore' ),
			'fixed'       			  => esc_html__( 'Fixed Header', 'online-estore' ),
			'transparent'             => esc_html__( 'Transparent Header', 'online-estore' ),
		);
		return apply_filters( 'online_estore_header_layout_options', $layout );
	}
endif;