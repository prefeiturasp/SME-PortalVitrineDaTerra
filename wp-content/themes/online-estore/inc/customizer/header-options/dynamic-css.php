<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Header Dynamic CSS
 */
$header_dynamic_style = $header_dynamic_tablet_style = $header_dynamic_mobile_style = '';


$header_top_height_option = online_estore_get_theme_options( 'header-top-height-option' );
if ( 'custom' == $header_top_height_option ) {
	$header_top_height       = online_estore_get_theme_options( 'top-header-height' );
	$header_top_height_tablet = online_estore_get_theme_options( 'top-header-height_tablet' );
	$header_top_height_mobile = online_estore_get_theme_options( 'top-header-height_mobile' );
	
	$header_dynamic_style 			.= 'height:' . $header_top_height. 'px;';
	if($header_top_height_tablet)
		$header_dynamic_tablet_style   	.= 'height:' . $header_top_height_tablet . 'px;';
	if($header_top_height_mobile)
		$header_dynamic_mobile_style   	.= 'height:' . $header_top_height_mobile . 'px;';
} else {
	$header_dynamic_style .= 'height:auto;';
}
$header_top_overlay_css = '';
//background options
$header_top_bg_options = online_estore_get_theme_options( 'header-top-bg-options' );
if ( 'custom' == $header_top_bg_options ) {

	$header_top_bg          = online_estore_get_theme_options( 'header-top-background-options' );
	$header_top_bg          = json_decode( $header_top_bg, true );
	//bg color
	$header_top_bg_color = online_estore_ifset( $header_top_bg['background-color'] );
	if ( $header_top_bg_color ) {
		$header_dynamic_style .= 'background-color:' . $header_top_bg_color . ';';
	}

	//text color
	$header_top_bg_color = online_estore_ifset( $header_top_bg['text-color'] );
	if ( $header_top_bg_color ) {
		$header_dynamic_style .= 'color:' . $header_top_bg_color . ';';
	}

	//bg image
	$header_top_bg_image = online_estore_ifset( $header_top_bg['background-image'] );
	if ( $header_top_bg_image ) {
		$header_dynamic_style .= 'background-image:url(' . esc_url( $header_top_bg_image ) . ');';
		//bg size
		$header_top_bg_size = online_estore_ifset( $header_top_bg['background-size'] );
		if ( $header_top_bg_size ) {
			$header_dynamic_style .= 'background-size:' . $header_top_bg_size . ';';
			$header_dynamic_style .= '-webkit-background-size:' . $header_top_bg_size . ';';
		}
		//bg position
		$header_top_bg_position = online_estore_ifset( $header_top_bg['background-position'] );
		if ( $header_top_bg_position ) {
			$header_dynamic_style .= 'background-position:' . str_replace( '_', ' ', $header_top_bg_position ) . ';';
		}
		//bg repeat
		$header_top_bg_repeat = online_estore_ifset( $header_top_bg['background-repeat'] );
		if ( $header_top_bg_repeat ) {
			$header_dynamic_style .= 'background-repeat:' . $header_top_bg_repeat . ';';
		}
		//bg attachment
		$header_top_bg_attachment = online_estore_ifset( $header_top_bg['background-attachment'] );
		if ( $header_top_bg_attachment ) {
			$header_dynamic_style .= 'background-attachment:' . $header_top_bg_attachment . ';';
		}

		//bg overlay color
		$header_top_enable_overlay   = online_estore_ifset( $header_top_bg['enable-overlay'] );
		$header_top_bg_overlay_color = online_estore_ifset( $header_top_bg['background-overlay-color'] );
		if ( $header_top_bg_overlay_color && $header_top_enable_overlay ) {
			$header_top_overlay_css = '
					.header-top::before {
						position: absolute;
						top: 0;
						height: 100%;
						width: 100%;
						background:' . $header_top_bg_overlay_color . ';
						content: "";
					}';
		}
	}
}


//border options
$header_top_border = online_estore_get_theme_options( 'header-top-border-styling' );
$header_top_border = json_decode( $header_top_border, true );

//box shadow
$header_top_bx_shadow_css = online_estore_boxshadow_values_inline( online_estore_ifset( $header_top_border['box-shadow-css'] ), 'desktop' );
if ( strpos( $header_top_bx_shadow_css, 'px' ) !== false ) {
	$header_top_bxshadow_color = online_estore_ifset( $header_top_border['box-shadow-color'] );
	$header_top_bx_shadow      = $header_top_bx_shadow_css . ' ' . $header_top_bxshadow_color;
	$header_dynamic_style           .= '-webkit-box-shadow:' . $header_top_bx_shadow . ';';
	$header_dynamic_style           .= '-moz-box-shadow:' . $header_top_bx_shadow . ';';
	$header_dynamic_style           .= 'box-shadow:' . $header_top_bx_shadow . ';';
}
//border style
$header_top_border_style = online_estore_ifset( $header_top_border['border-style'] );
if ( 'none' !== $header_top_border_style ) {

	$header_dynamic_style .= 'border-style:' . $header_top_border_style . ';';
	//border width
	$header_top_border_width = online_estore_cssbox_values_inline( online_estore_ifset( $header_top_border['border-width'] ), 'desktop' );
	if ( strpos( $header_top_border_width, 'px' ) !== false ) {
		$header_dynamic_style .= 'border-width:' . $header_top_border_width . ';';
	}
	//border color
	$header_top_border_color = online_estore_ifset( $header_top_border['border-color'] );
	if ( $header_top_border_color ) {
		$header_dynamic_style .= 'border-color:' . $header_top_border_color . ';';
	}
}
//border radius
$header_top_border_tl_radius = online_estore_ifset( $header_top_border['border-radius']['desktop']['top'] );
if ( $header_top_border_tl_radius ) {
	$header_dynamic_style .= 'border-top-left-radius:' . $header_top_border_tl_radius . 'px;';
}
$header_top_border_tr_radius = online_estore_ifset( $header_top_border['border-radius']['desktop']['right'] );
if ( $header_top_border_tr_radius ) {
	$header_dynamic_style .= 'border-top-right-radius:' . $header_top_border_tr_radius . 'px;';
}
$header_top_border_br_radius = online_estore_ifset( $header_top_border['border-radius']['desktop']['bottom'] );
if ( $header_top_border_br_radius ) {
	$header_dynamic_style .= 'border-bottom-right-radius:' . $header_top_border_br_radius . 'px;';
}
$header_top_border_bl_radius = online_estore_ifset( $header_top_border['border-radius']['desktop']['left'] );
if ( $header_top_border_bl_radius ) {
	$header_dynamic_style .= 'border-bottom-left-radius:' . $header_top_border_br_radius . 'px;';
}

//margin
$header_margin = online_estore_get_theme_options( 'top-header-margin' );
$header_margin = json_decode( $header_margin, true );

// desktop margin
$header_margin_desktop = online_estore_cssbox_values_inline( $header_margin, 'desktop' );
if ( strpos( $header_margin_desktop, 'px' ) !== false ) {
	$header_dynamic_style .= 'margin:' . $header_margin_desktop . ';';
}
// tablet margin
$header_margin_desktop = online_estore_cssbox_values_inline( $header_margin, 'tablet' );
if ( strpos( $header_margin_desktop, 'px' ) !== false ) {
	$header_dynamic_tablet_style .= 'margin:' . $header_margin_desktop . ';';
}
// mobile margin
$header_margin_desktop = online_estore_cssbox_values_inline( $header_margin, 'mobile' );
if ( strpos( $header_margin_desktop, 'px' ) !== false ) {
	$header_dynamic_mobile_style .= 'margin:' . $header_margin_desktop . ';';
}


//padding
$header_margin = online_estore_get_theme_options( 'top-header-padding' );
$header_margin = json_decode( $header_margin, true );

// desktop padding
$header_margin_desktop = online_estore_cssbox_values_inline( $header_margin, 'desktop' );
if ( strpos( $header_margin_desktop, 'px' ) !== false ) {
	$header_dynamic_style .= 'padding:' . $header_margin_desktop . ';';
}

// tablet padding
$header_margin_desktop = online_estore_cssbox_values_inline( $header_margin, 'tablet' );
if ( strpos( $header_margin_desktop, 'px' ) !== false ) {
	$header_dynamic_tablet_style .= 'padding:' . $header_margin_desktop . ';';
}
// mobile padding
$header_margin_desktop = online_estore_cssbox_values_inline( $header_margin, 'mobile' );
if ( strpos( $header_margin_desktop, 'px' ) !== false ) {
	$header_dynamic_mobile_style .= 'padding:' . $header_margin_desktop . ';';
}

$header_dynamic_style = ".header-top { $header_dynamic_style }";
$header_dynamic_style .= $header_top_overlay_css;
$header_dynamic_tablet_style = ".header-top { $header_dynamic_tablet_style }";
$header_dynamic_mobile_style = ".header-top { $header_dynamic_mobile_style }";


/** 
 * main header row
 */
$header_style = $header_tablet_style =  $header_mobile_style = "";
$bg_type = online_estore_get_theme_options('online_estore_main_header_bg_type', 'color-bg');
$bg_effect = online_estore_get_theme_options('online_estore_main_header_parallax_effect', 'none');
$bg_color = online_estore_get_theme_options('online_estore_main_header_bg_color', '#fff');

if( $bg_type == 'image-bg'){
	if ( has_header_image() ) {
		$header_dynamic_style .= '.header-middle{ 
			background-image: url("' . esc_url( get_header_image() ) . '"); 
			background-repeat: no-repeat; 
			background-position: center center; 
			background-size: cover;
			background-color: '. $bg_color. ';
			}';
		$overlay_color = online_estore_get_theme_options('online_estore_main_header_overlay_color', 'rgba(255,255,255,0)');
		$header_dynamic_style .= ".header-middle:before{
			background-color: $overlay_color;
			content: '';
			position: absolute;
			top: 0;
			width: 100%;
			height: 100%;
			left:0; right:0;
		}";

		
		if( $bg_effect != 'none'){
			$header_dynamic_style .= '.header-middle{ 
				background-attachment: $bg_effect;
				}';
		}
	}
}else if( $bg_type == 'gradient-bg' ){
	$gd = online_estore_get_theme_options('online_estore_main_header_bg_gradient');
	if( $gd ) {
		$css[] = "$gd";
		$header_dynamic_style .= ".header-middle{" . implode(';', $css) . "}";
	}
}else{
	$header_dynamic_style .= '
	.header-middle{ 
		background-color: '. $bg_color. ';
	}';
}

//margin
$header_margin = online_estore_get_theme_options( 'header-main-margin' );
$header_margin = json_decode( $header_margin, true );

// desktop margin
$header_margin_desktop = online_estore_cssbox_values_inline( $header_margin, 'desktop' );
if ( strpos( $header_margin_desktop, 'px' ) !== false ) {
	$header_style .= 'margin:' . $header_margin_desktop . ';';
}
// tablet margin
$header_margin_desktop = online_estore_cssbox_values_inline( $header_margin, 'tablet' );
if ( strpos( $header_margin_desktop, 'px' ) !== false ) {
	$header_tablet_style .= 'margin:' . $header_margin_desktop . ';';
}
// mobile margin
$header_margin_desktop = online_estore_cssbox_values_inline( $header_margin, 'mobile' );
if ( strpos( $header_margin_desktop, 'px' ) !== false ) {
	$header_mobile_style .= 'margin:' . $header_margin_desktop . ';';
}


//padding
$header_margin = online_estore_get_theme_options( 'header-main-padding' );
$header_margin = json_decode( $header_margin, true );

// desktop padding
$header_margin_desktop = online_estore_cssbox_values_inline( $header_margin, 'desktop' );
if ( strpos( $header_margin_desktop, 'px' ) !== false ) {
	$header_style .= 'padding:' . $header_margin_desktop . ';';
}

// tablet padding
$header_margin_desktop = online_estore_cssbox_values_inline( $header_margin, 'tablet' );
if ( strpos( $header_margin_desktop, 'px' ) !== false ) {
	$header_tablet_style .= 'padding:' . $header_margin_desktop . ';';
}
// mobile padding
$header_margin_desktop = online_estore_cssbox_values_inline( $header_margin, 'mobile' );
if ( strpos( $header_margin_desktop, 'px' ) !== false ) {
	$header_mobile_style .= 'padding:' . $header_margin_desktop . ';';
}

//border options
$header_top_border = online_estore_get_theme_options( 'header-main-border-styling' );
$header_top_border = json_decode( $header_top_border, true );
//box shadow


$header_top_bx_shadow_css = online_estore_boxshadow_values_inline( ( $header_top_border['box-shadow-css'] ), 'desktop' );
if ( strpos( $header_top_bx_shadow_css, 'px' ) !== false ) {
	$header_top_bxshadow_color = ( $header_top_border['box-shadow-color'] );
	$header_top_bx_shadow      = $header_top_bx_shadow_css . ' ' . $header_top_bxshadow_color;
	$header_style           .= '-webkit-box-shadow:' . $header_top_bx_shadow . ';';
	$header_style           .= '-moz-box-shadow:' . $header_top_bx_shadow . ';';
	$header_style           .= 'box-shadow:' . $header_top_bx_shadow . ';';
}
//border style
$header_top_border_style = ( $header_top_border['border-style'] );
if ( 'none' !== $header_top_border_style ) {

	$header_style .= 'border-style:' . $header_top_border_style . ';';
	//border width
	$header_top_border_width = online_estore_cssbox_values_inline( ( $header_top_border['border-width'] ), 'desktop' );
	if ( strpos( $header_top_border_width, 'px' ) !== false ) {
		$header_style .= 'border-width:' . $header_top_border_width . ';';
	}
	//border color
	$header_top_border_color = ( $header_top_border['border-color'] );
	if ( $header_top_border_color ) {
		$header_style .= 'border-color:' . $header_top_border_color . ';';
	}
}
//border radius
$header_top_border_tl_radius = ( $header_top_border['border-radius']['desktop']['top'] );
if ( $header_top_border_tl_radius ) {
	$header_style .= 'border-top-left-radius:' . $header_top_border_tl_radius . 'px;';
}
$header_top_border_tr_radius = ( $header_top_border['border-radius']['desktop']['right'] );
if ( $header_top_border_tr_radius ) {
	$header_style .= 'border-top-right-radius:' . $header_top_border_tr_radius . 'px;';
}
$header_top_border_br_radius = ( $header_top_border['border-radius']['desktop']['bottom'] );
if ( $header_top_border_br_radius ) {
	$header_style .= 'border-bottom-right-radius:' . $header_top_border_br_radius . 'px;';
}
$header_top_border_bl_radius = ( $header_top_border['border-radius']['desktop']['left'] );
if ( $header_top_border_bl_radius ) {
	$header_style .= 'border-bottom-left-radius:' . $header_top_border_br_radius . 'px;';
}


$header_dynamic_style .= "
	.header-middle{
		$header_style
	}
	
";
$header_dynamic_tablet_style .="
	.header-middle{
		$header_tablet_style
	}
";
$header_dynamic_mobile_style .="
	.header-middle{
		$header_mobile_style
	}
";



/**header bottom row style */
$header_style = $header_tablet_style =  $header_mobile_style = "";
if( online_estore_get_theme_options('header-bottom-height-option', 'auto') == 'custom'){
	$height = online_estore_get_theme_options('bottom-header-height');
	if($height) $header_style = "height: {$height}px;";

	//tablet height
	$height = online_estore_get_theme_options('bottom-header-height_tablet');
	if($height) $header_tablet_style = "height: {$height}px;";

	//mobile height
	$height = online_estore_get_theme_options('bottom-header-height_mobile');
	if($height) $header_mobile_style = "height: {$height}px;";
}

$header_main_overlay_css = '';
//background options
$header_top_bg_options = online_estore_get_theme_options( 'header-bottom-bg-options' );
if ( 'custom' == $header_top_bg_options ) {
	//background
	$header_top_bg          = online_estore_get_theme_options( 'header-bottom-background-options' );
	$header_top_bg          = json_decode( $header_top_bg, true );
	
	//bg color
	$header_top_bg_color = $header_top_bg['background-color'];

	if ( $header_top_bg_color ) {
		$header_style .= 'background-color:' . $header_top_bg_color . ';';
	}

	//bg image
	$header_top_bg_image = ( $header_top_bg['background-image'] );
	if ( $header_top_bg_image ) {
		$header_style .= 'background-image:url(' . esc_url( $header_top_bg_image ) . ');';
		//bg size
		$header_top_bg_size = ( $header_top_bg['background-size'] );
		if ( $header_top_bg_size ) {
			$header_style .= 'background-size:' . $header_top_bg_size . ';';
			$header_style .= '-webkit-background-size:' . $header_top_bg_size . ';';
		}
		//bg position
		$header_top_bg_position = ( $header_top_bg['background-position'] );
		if ( $header_top_bg_position ) {
			$header_style .= 'background-position:' . str_replace( '_', ' ', $header_top_bg_position ) . ';';

		}
		//bg repeat
		$header_top_bg_repeat = ( $header_top_bg['background-repeat'] );
		if ( $header_top_bg_repeat ) {
			$header_style .= 'background-repeat:' . $header_top_bg_repeat . ';';
		}
		//bg attachment
		$header_top_bg_attachment = ( $header_top_bg['background-attachment'] );
		if ( $header_top_bg_attachment ) {
			$header_style .= 'background-attachment:' . $header_top_bg_attachment . ';';
		}

		//bg overlay color
		$header_main_enable_overlay   = ( $header_top_bg['enable-overlay'] );
		$header_top_bg_overlay_color = ( $header_top_bg['background-overlay-color'] );
		if ( $header_top_bg_overlay_color && $header_main_enable_overlay ) {
			$header_main_overlay_css .= 'background:' . $header_top_bg_overlay_color . ';';
		}
	}
}


//margin
$header_margin = online_estore_get_theme_options( 'header-bottom-margin' );
$header_margin = json_decode( $header_margin, true );

// desktop margin
$header_margin_desktop = online_estore_cssbox_values_inline( $header_margin, 'desktop' );
if ( strpos( $header_margin_desktop, 'px' ) !== false ) {
	$header_style .= 'margin:' . $header_margin_desktop . ';';
}
// tablet margin
$header_margin_desktop = online_estore_cssbox_values_inline( $header_margin, 'tablet' );
if ( strpos( $header_margin_desktop, 'px' ) !== false ) {
	$header_tablet_style .= 'margin:' . $header_margin_desktop . ';';
}
// mobile margin
$header_margin_desktop = online_estore_cssbox_values_inline( $header_margin, 'mobile' );
if ( strpos( $header_margin_desktop, 'px' ) !== false ) {
	$header_mobile_style .= 'margin:' . $header_margin_desktop . ';';
}


//padding
$header_margin = online_estore_get_theme_options( 'header-bottom-padding' );
$header_margin = json_decode( $header_margin, true );

// desktop padding
$header_margin_desktop = online_estore_cssbox_values_inline( $header_margin, 'desktop' );
if ( strpos( $header_margin_desktop, 'px' ) !== false ) {
	$header_style .= 'padding:' . $header_margin_desktop . ';';
}

// tablet padding
$header_margin_desktop = online_estore_cssbox_values_inline( $header_margin, 'tablet' );
if ( strpos( $header_margin_desktop, 'px' ) !== false ) {
	$header_tablet_style .= 'padding:' . $header_margin_desktop . ';';
}
// mobile padding
$header_margin_desktop = online_estore_cssbox_values_inline( $header_margin, 'mobile' );
if ( strpos( $header_margin_desktop, 'px' ) !== false ) {
	$header_mobile_style .= 'padding:' . $header_margin_desktop . ';';
}


//border options
$header_top_border = online_estore_get_theme_options( 'header-bottom-border-styling' );
$header_top_border = json_decode( $header_top_border, true );
//box shadow
$header_top_bx_shadow_css = online_estore_boxshadow_values_inline( ( $header_top_border['box-shadow-css'] ), 'desktop' );
if ( strpos( $header_top_bx_shadow_css, 'px' ) !== false ) {
	$header_top_bxshadow_color = ( $header_top_border['box-shadow-color'] );
	$header_top_bx_shadow      = $header_top_bx_shadow_css . ' ' . $header_top_bxshadow_color;
	$header_style           .= '-webkit-box-shadow:' . $header_top_bx_shadow . ';';
	$header_style           .= '-moz-box-shadow:' . $header_top_bx_shadow . ';';
	$header_style           .= 'box-shadow:' . $header_top_bx_shadow . ';';
}
//border style
$header_top_border_style = ( $header_top_border['border-style'] );
if ( 'none' !== $header_top_border_style ) {

	$header_style .= 'border-style:' . $header_top_border_style . ';';
	//border width
	$header_top_border_width = online_estore_cssbox_values_inline( ( $header_top_border['border-width'] ), 'desktop' );
	if ( strpos( $header_top_border_width, 'px' ) !== false ) {
		$header_style .= 'border-width:' . $header_top_border_width . ';';
	}
	//border color
	$header_top_border_color = ( $header_top_border['border-color'] );
	if ( $header_top_border_color ) {
		$header_style .= 'border-color:' . $header_top_border_color . ';';
	}
}
//border radius
$header_top_border_tl_radius = ( $header_top_border['border-radius']['desktop']['top'] );
if ( $header_top_border_tl_radius ) {
	$header_style .= 'border-top-left-radius:' . $header_top_border_tl_radius . 'px;';
}
$header_top_border_tr_radius = ( $header_top_border['border-radius']['desktop']['right'] );
if ( $header_top_border_tr_radius ) {
	$header_style .= 'border-top-right-radius:' . $header_top_border_tr_radius . 'px;';
}
$header_top_border_br_radius = ( $header_top_border['border-radius']['desktop']['bottom'] );
if ( $header_top_border_br_radius ) {
	$header_style .= 'border-bottom-right-radius:' . $header_top_border_br_radius . 'px;';
}
$header_top_border_bl_radius = ( $header_top_border['border-radius']['desktop']['left'] );
if ( $header_top_border_bl_radius ) {
	$header_style .= 'border-bottom-left-radius:' . $header_top_border_br_radius . 'px;';
}


$header_dynamic_style .= "
	.header-container .sp-bottom-header{
		$header_style
	}
	.header-container .sp-bottom-header:before{
		$header_main_overlay_css
	}
";
$header_dynamic_tablet_style .="
	.header-container .sp-bottom-header{
		$header_tablet_style
	}
";
$header_dynamic_mobile_style .="
	.header-container .sp-bottom-header{
		$header_mobile_style
	}
";

// quick contact color
$quick_contact_color = get_theme_mod( 'o_s_quick_color' );
$header_dynamic_style .= "
	.online-estore-quick-contact li a, .online-estore-quick-contact li span {
		color: $quick_contact_color;
	}
";

// social icon color
$social_icon_color = get_theme_mod( 'o_s_social_media_color' );
$header_dynamic_style .= "
	.onlineestore_socialmeida_link li a {
		color: $social_icon_color;
	}
";

//account text color
$account_text_color = get_theme_mod( 'account-icon-color' );
$header_dynamic_style .= "
	.online_myaccount span {
		color: $account_text_color;
	} 
";

// search button color
$search_button_color = get_theme_mod( 'online_estore_search_icon_color', '#fff' );
$header_dynamic_style .= "
	.block-search .btn-submit span {
		color: $search_button_color;
	}
";

// search button background color
$search_button_background_color = get_theme_mod( 'online_estore_search_icon_background_color', '#000' );
$header_dynamic_style .= "
	.block-search .btn-submit {
		background-color: $search_button_background_color;
	}
";

// search button icon size
$search_icon_size = get_theme_mod( 'online_estore_search_icon_size' ) . 'px'; 
$header_dynamic_style .= "
	.block-search .btn-submit .fa.fa-search {
		font-size: $search_icon_size;
	}
";

$search_margin_desktop = $search_margin_tablet = $search_margin_mobile = '';
// icon margin
$search_margin = online_estore_get_theme_options( 'online_estore_search_icon_margin' );
$search_margin = json_decode( $search_margin, true );

// desktop search margin
$search_margin_values = online_estore_cssbox_values_inline( $search_margin, 'desktop' );
if ( strpos( $search_margin_values, 'px' ) !== false ) {
	$search_margin_desktop .= 'margin:' . $search_margin_values . ';';
}
// tablet search margin
$search_margin_values = online_estore_cssbox_values_inline( $search_margin, 'tablet' );
if ( strpos( $search_margin_values, 'px' ) !== false ) {
	$search_margin_tablet .= 'margin:' . $search_margin_values . ';';
}
// mobile search margin
$search_margin_values = online_estore_cssbox_values_inline( $search_margin, 'mobile' );
if ( strpos( $search_margin_values, 'px' ) !== false ) {
	$search_margin_mobile .= 'margin:' . $search_margin_values . ';';
}

$search_padding_desktop = $search_padding_tablet = $search_padding_mobile = "";
//padding
$search_padding = online_estore_get_theme_options( 'online_estore_search_icon_padding' );
$search_padding = json_decode( $search_padding, true );

// desktop search padding
$search_padding_values = online_estore_cssbox_values_inline( $search_padding, 'desktop' );
if ( strpos( $search_padding_values, 'px' ) !== false ) {
	$search_padding_desktop .= 'padding:' . $search_padding_values . ';';
}

// tablet search padding
$search_padding_values = online_estore_cssbox_values_inline( $search_padding, 'tablet' );
if ( strpos( $search_padding_values, 'px' ) !== false ) {
	$search_padding_tablet .= 'padding:' . $search_padding_values . ';';
}
// mobile search padding
$search_padding_values = online_estore_cssbox_values_inline( $search_padding, 'mobile' );
if ( strpos( $search_padding_values, 'px' ) !== false ) {
	$search_padding_mobile .= 'padding:' . $search_padding_values . ';';
}

// cart padding
$cart_padding = online_estore_get_theme_options( 'cart-icon-padding' );
$cart_padding = json_decode( $cart_padding, true );
$cart_padding_desktop = $cart_padding_tablet = $cart_padding_mobile = '';
// desktop search padding
$cart_padding_values = online_estore_cssbox_values_inline( $cart_padding, 'desktop' );
if ( strpos( $cart_padding_values, 'px' ) !== false ) {
	$cart_padding_desktop .= 'padding:' . $cart_padding_values . ';';
}

// tablet search padding
$cart_padding_values = online_estore_cssbox_values_inline( $cart_padding, 'tablet' );
if ( strpos( $cart_padding_values, 'px' ) !== false ) {
	$cart_padding_tablet .= 'padding:' . $cart_padding_values . ';';
}
// mobile search padding
$cart_padding_values = online_estore_cssbox_values_inline( $cart_padding, 'mobile' );
if ( strpos( $cart_padding_values, 'px' ) !== false ) {
	$cart_padding_mobile .= 'padding:' . $cart_padding_values . ';';
}


// cart margin
$cart_margin = online_estore_get_theme_options( 'cart-icon-margin' );
$cart_margin = json_decode( $cart_margin, true );
$cart_margin_desktop = $cart_margin_tablet = $cart_margin_mobile = "";
// desktop search margin
$cart_margin_values = online_estore_cssbox_values_inline( $cart_margin, 'desktop' );
if ( strpos( $cart_margin_values, 'px' ) !== false ) {
	$cart_margin_desktop .= 'margin:' . $cart_margin_values . ';';
}
// tablet search margin
$cart_margin_values = online_estore_cssbox_values_inline( $cart_margin, 'tablet' );
if ( strpos( $cart_margin_values, 'px' ) !== false ) {
	$cart_margin_tablet .= 'margin:' . $cart_margin_values . ';';
}
// mobile search margin
$cart_margin_values = online_estore_cssbox_values_inline( $cart_margin, 'mobile' );
if ( strpos( $cart_margin_values, 'px' ) !== false ) {
	$cart_margin_mobile .= 'margin:' . $cart_margin_values . ';';
}

// cart count margin
$cart_count_margin = online_estore_get_theme_options( 'cart-count-margin' );
$cart_count_margin = json_decode( $cart_count_margin, true );
$cart_count_margin_desktop = $cart_count_margin_tablet = $cart_count_margin_mobile = "";
// desktop search margin
$cart_count_margin_values = online_estore_cssbox_values_inline( $cart_count_margin, 'desktop' );
if ( strpos( $cart_count_margin_values, 'px' ) !== false ) {
	$cart_count_margin_desktop .= 'margin:' . $cart_count_margin_values . ';';
}
// tablet search margin
$cart_count_margin_values = online_estore_cssbox_values_inline( $cart_count_margin, 'tablet' );
if ( strpos( $cart_count_margin_values, 'px' ) !== false ) {
	$cart_count_margin_tablet .= 'margin:' . $cart_count_margin_values . ';';
}
// mobile search margin
$cart_count_margin_values = online_estore_cssbox_values_inline( $cart_count_margin, 'mobile' );
if ( strpos( $cart_count_margin_values, 'px' ) !== false ) {
	$cart_count_margin_mobile .= 'margin:' . $cart_count_margin_values . ';';
}

$cart_attr = $icon_font_size = $cart_count_attr = $vertical_title_attr = $vertical_menu_item_attr = $cart_font_size_final = $vertical_menu_item_hover_attr = $primary_menu_bg_color_final = $primary_menu_items_color_final = $primary_menu_item_active_hover_bg_color_final = $primary_menu_item_active_hover_color_final = $button_one_border_color_final = $button_one_text_color_final = $button_one_hover_bg_color_final = $button_one_hover_border_color_final = "";
$p_m_sub_menu_bg_color_final = $p_m_sub_menu_text_color_final = $p_m_sub_menu_hover_active_bg_color_final = $p_m_sub_menu_hover_active_text_color_final = $button_one_bg_color_final = $button_one_hover_text_color_final = $secondary_menu_bg_color_final = $secondary_menu_item_color_final = $s_m_item_active_hover_bg_color_final = $s_m_item_hover_active_color_final = $secondary_menu_sub_menu_bg_color_final = $secondary_menu_sub_menu_item_color_final = $s_m_hover_active_sub_menu_item_bg_color_final = $s_m_sub_menu_item_color_final = $secondary_menu_sub_menu_bg_color_final =  "";
$p_m_sub_menu_hover_active_attr = $button_one_attr = $button_one_hover_attr = '';
// cart background options
$cart_bg_options 		  = online_estore_get_theme_options( 'cart-options' );
if ( !is_array( $cart_bg_options ) ) {
	$cart_bg_options          = json_decode( $cart_bg_options, true );
	//cart bg color
	$cart_bg_color = online_estore_ifset( $cart_bg_options['background-color'] );
	if ( $cart_bg_color ) {
		$header_dynamic_style .= ".block-minicart { background-color: $cart_bg_color; }";
		// $cart_bg_color_final .= 'background-color: $cart_bg_color;';
	}
	//cart text color
	$cart_text_color = online_estore_ifset( $cart_bg_options['text-color'] );
	if ( $cart_text_color ) {
		$cart_attr .= "color: $cart_text_color" . ";";
		// $cart_attr .= 'color:' . $cart_text_color . ';';
	}
	//cart text size
	$cart_font_size = online_estore_ifset( $cart_bg_options['text-font-size'] );
	if ( $cart_font_size ) {
		$cart_attr .= "font-size: $cart_font_size" . ";";
		// $cart_text_attr .= 'font-size:' . $cart_font_size . ';';
	}
	if ( $cart_attr ) {
		$header_dynamic_style .= ".site-header-cart .cart-contents span.carttext{ $cart_attr }";
	}
	//icon size
	$icon_font_size = online_estore_ifset( $cart_bg_options['icon-font-size'] );
	if ( $icon_font_size ) {
		$header_dynamic_style .= ".site-header-cart .cart-contents span.fa-shopping-cart::before { font-size: $icon_font_size }";
	}

	//cart count bg color
	$cart_count_bg_color = online_estore_ifset( $cart_bg_options['count-bg-color'] );
	if ( $cart_count_bg_color ) {
		$cart_count_attr .= 'background-color:' . $cart_count_bg_color . ';';
	}

	//cart count color
	$cart_count_color = online_estore_ifset( $cart_bg_options['count-text-color'] );
	if ( $cart_count_color ) {
		$cart_count_attr .= 'color:' . $cart_count_color . ';';
	}

	if ( $cart_count_attr ) {
		$header_dynamic_style .= ".site-header-cart .cart-contents span.count { $cart_count_attr }";
	}
}

//vertical menu title background color
$vertical_title_background_color = get_theme_mod( 'online_estore__vertical_menu_title_bg_color' );
if ( $vertical_title_background_color ) {
	$vertical_title_attr .= 'background-color:' . $vertical_title_background_color . ';';
}

//vertical menu title color
$vertical_title_color = get_theme_mod( 'online_estore__vertical_menu_title_text_color' );
if ( $vertical_title_color ) {
	$vertical_title_attr .= 'color:' . $vertical_title_color . ';';
}

if ( $vertical_title_attr ) {
	$header_dynamic_style .= ".block-nav-category .block-title { $vertical_title_attr }";
}

//vertical menu item background color
$vertical_menu_item_background_color = get_theme_mod( 'online_estore__vertical_menu_bg_color' );
if ( $vertical_menu_item_background_color ) {
	$vertical_menu_item_attr .= 'background-color:' . $vertical_menu_item_background_color . ';';
}

//vertical menu item color
$vertical_menu_item_color = get_theme_mod( 'online_estore__vertical_menu_item_text_color' );
if ( $vertical_menu_item_color ) {
	$vertical_menu_item_attr .= 'color:' . $vertical_menu_item_color . ';';
}

if ( $vertical_menu_item_attr ) {
	$header_dynamic_style .= ".block-nav-category .vertical-menu li>a { $vertical_menu_item_attr }";
}

//vertical menu item hover background color
$vertical_menu_item_hover_bg_color = get_theme_mod( 'online_estore__vertical_menu_item_hover_bg_color' );
if ( $vertical_menu_item_hover_bg_color ) {
	$vertical_menu_item_hover_attr .= 'background-color:' . $vertical_menu_item_hover_bg_color . ';';
}

//vertical menu item hover color
$vertical_menu_item_hover_color = get_theme_mod( 'online_estore__vertical_menu_item_hover_color' );
if ( $vertical_menu_item_hover_color ) {
	$vertical_menu_item_hover_attr .= 'color:' . $vertical_menu_item_hover_color . ';';
}

if ( $vertical_menu_item_hover_attr ) {
	$header_dynamic_style .= ".block-nav-category .vertical-menu li>a:hover { $vertical_menu_item_hover_attr }";
}

//primary menu background color
$primary_menu_bg_color = get_theme_mod( 'online_estore__main_menu_bg_color' );
if ( $primary_menu_bg_color ) {
	$header_dynamic_style .= ".primary-menu { background-color: $primary_menu_bg_color; }";
}

//primary menu items color
$primary_menu_items_color = get_theme_mod( 'online_estore__main_menu_item_color' );
if ( $primary_menu_items_color ) {
	$header_dynamic_style .= ".box-header-nav .main-menu>.menu-item>a { color: $primary_menu_items_color; }";
}

//primary menu hover background color
$primary_menu_item_active_hover_bg_color = get_theme_mod( 'online_estore__main_menu_active_bg_color' );
if ( $primary_menu_item_active_hover_bg_color ) {
	$primary_menu_item_active_hover_bg_color_final = 'background-color:' . $primary_menu_item_active_hover_bg_color . ';';
}

if ( $primary_menu_item_active_hover_bg_color_final ) {
	$header_dynamic_style .= ".box-header-nav .main-menu .menu-item.current_page_item>a, .box-header-nav .main-menu .menu-item a:hover { $primary_menu_item_active_hover_bg_color_final }";
}

//primary menu active color
$primary_menu_item_active_hover_color = get_theme_mod( 'online_estore__main_menu_active_item_color' );
if ( $primary_menu_item_active_hover_color ) {
	$primary_menu_item_active_hover_color_final = 'color:' . $primary_menu_item_active_hover_color . ';';
}

if ( $primary_menu_item_active_hover_color_final ) {
	$header_dynamic_style .= ".box-header-nav .main-menu .menu-item.current_page_item>a, .box-header-nav .main-menu .menu-item a:hover { $primary_menu_item_active_hover_color_final }";
}

//primary menu sub menu background color
$p_m_sub_menu_bg_color = get_theme_mod( 'online_estore_main_sub_menu_bg_color' );
if ( $p_m_sub_menu_bg_color ) {
	$header_dynamic_style .= ".box-header-nav .main-menu .sub-menu { background-color: $p_m_sub_menu_bg_color }";
}

//primary menu sub menu text color
$p_m_sub_menu_text_color = get_theme_mod( 'online_estore_main_sub_menu_text_color' );
if ( $p_m_sub_menu_text_color ) {
	$header_dynamic_style .= ".box-header-nav .main-menu .sub-menu>.menu-item>a { color: $p_m_sub_menu_text_color }";
}

//primary menu sub menu item hover active background color
$p_m_sub_menu_hover_active_bg_color = get_theme_mod( 'online_estore_main_sub_menu_hover_bg_color' );
if ( $p_m_sub_menu_hover_active_bg_color ) {
	$p_m_sub_menu_hover_active_attr .= 'background-color:' . $p_m_sub_menu_hover_active_bg_color . ';';
}

//primary menu sub menu item hover active color
$p_m_sub_menu_hover_active_text_color = get_theme_mod( 'online_estore_main_sub_menu_hover_text_color' );
if ( $p_m_sub_menu_hover_active_text_color ) {
	$p_m_sub_menu_hover_active_attr .= 'color:' . $p_m_sub_menu_hover_active_text_color . ';';
}

if ( $p_m_sub_menu_hover_active_attr ) {
	$header_dynamic_style .= ".box-header-nav .main-menu .sub-menu>.menu-item:hover>a { $p_m_sub_menu_hover_active_attr }";
}

// button one background color
$button_one_bg_color = online_estore_get_theme_options( 'button-one_bg_color' );
if ( $button_one_bg_color ) {
	$button_one_attr .= 'background-color:' . $button_one_bg_color . ';';
}

//button one border color
$button_one_border_color = online_estore_get_theme_options( 'button-one_border_color' );
if ( $button_one_border_color ) {
	$button_one_attr .= 'border:' . '1px solid ' . $button_one_border_color . ';';
}

// button one text color
$button_one_text_color = online_estore_get_theme_options( 'button-one_text_color' );
if ( $button_one_text_color ) {
	$button_one_attr .= 'color:' . $button_one_text_color . ';';
}

if ( $button_one_attr ) {
	$header_dynamic_style .= ".button_one_holder a { $button_one_attr }";
}

// button one hover background color
$button_one_hover_bg_color = online_estore_get_theme_options( 'button-one_bg_hov_color' );
if ( $button_one_hover_bg_color ) {
	$button_one_hover_attr .= 'background-color:' . $button_one_hover_bg_color . ';';
}

// button one hover border color
$button_one_hover_border_color = online_estore_get_theme_options( 'button-one_border_hov_color' );
if ( $button_one_hover_border_color ) {
	$button_one_hover_attr .= 'border:' . '1px solid ' . $button_one_hover_border_color . ';';
}

// button one hover text color
$button_one_hover_text_color = online_estore_get_theme_options( 'button-one_text_hov_color' );
if ( $button_one_hover_text_color ) {
	$button_one_hover_attr .= 'color:' . $button_one_hover_text_color . ';';
}

if ( $button_one_hover_attr ) {
	$header_dynamic_style .= ".button_one_holder a:hover { $button_one_hover_attr }";
}

// secondary menu background color
$secondary_menu_bg_color = online_estore_get_theme_options( 'online_estore__second_menu_bg_color' );
if ( $secondary_menu_bg_color ) {
	$header_dynamic_style .= ".box-header-nav .secondary-menu>.menu-item>a { background-color: $secondary_menu_bg_color }";
}

// secondary menu items color
$secondary_menu_item_color = online_estore_get_theme_options( 'online_estore__second_menu_item_color' );
if ( $secondary_menu_item_color ) {
	$header_dynamic_style .= ".box-header-nav .secondary-menu>.menu-item>a { color: $secondary_menu_item_color }";
}

// secondary menu item background active/hover color
$s_m_item_active_hover_bg_color = online_estore_get_theme_options( 'online_estore__second_menu_active_bg_color' );
if ( $s_m_item_active_hover_bg_color ) {
	$header_dynamic_style .= ".box-header-nav .secondary-menu .menu-item.current_page_item>a, .box-header-nav .secondary-menu .menu-item a:hover { background-color: $s_m_item_active_hover_bg_color }";
}

// secondary menu item active/hover color
$s_m_item_hover_active_color = get_theme_mod( 'online_estore__second_menu_active_item_color' );
if ( $s_m_item_hover_active_color ) {
	$header_dynamic_style .= ".box-header-nav .secondary-menu .menu-item.current_page_item>a, .box-header-nav .secondary-menu .menu-item a:hover { color: $s_m_item_hover_active_color }";
}

// secondary menu sub menu background color
$secondary_menu_sub_menu_bg_color = get_theme_mod( 'online_estore_second_sub_menu_bg_color' );
if ( $secondary_menu_sub_menu_bg_color ) {
	$header_dynamic_style .= ".box-header-nav .secondary-menu .sub-menu { background-color: $secondary_menu_sub_menu_bg_color }";
}

// secondary menu sub menu item color
$secondary_menu_sub_menu_item_color = get_theme_mod( 'online_estore_second_sub_menu_text_color' );
if ( $secondary_menu_sub_menu_item_color ) {
	$header_dynamic_style .= ".box-header-nav .secondary-menu .sub-menu .menu-item a { color: $secondary_menu_sub_menu_item_color }";
}

// secondary menu sub menu item hover background color
$s_m_hover_active_sub_menu_item_bg_color = get_theme_mod( 'online_estore_second_sub_menu_hover_bg_color' );
if ( $s_m_hover_active_sub_menu_item_bg_color ) {
	$header_dynamic_style .= ".box-header-nav .secondary-menu .sub-menu .menu-item:hover a { background-color: $s_m_hover_active_sub_menu_item_bg_color }";
}

// secondary menu sub menu item hover color
$s_m_sub_menu_item_color = get_theme_mod( 'online_estore_second_sub_menu_hover_text_color' );
if ( $s_m_sub_menu_item_color ) {
	$header_dynamic_style .= ".box-header-nav .secondary-menu .sub-menu .menu-item:hover a { color: $s_m_sub_menu_item_color }";
}

// open menu background color
$o_m_bg_color = get_theme_mod( 'online_estore_primary_theme_color_options', '#FF7D0E' );
if( $o_m_bg_color ) {
	$header_dynamic_style .= ".mobile-nav-toggle { background-color: $o_m_bg_color }";
}

// open menu text color
$o_m_icon_color = get_theme_mod( 'menu-open-icon-color', '#fff' );
if( $o_m_icon_color ) {
	$header_dynamic_style .= ".mobile-nav-toggle .toggle-inner { color: $o_m_icon_color }";
}


$header_dynamic_style 			.= ".block-search {  $search_padding_desktop $search_margin_desktop }";
$header_dynamic_tablet_style 	.= ".block-search { $search_padding_tablet $search_margin_tablet }";
$header_dynamic_mobile_style 	.= ".block-search { $search_padding_mobile $search_margin_mobile }";

$header_dynamic_style 			.= ".block-minicart {  $cart_padding_desktop $cart_margin_desktop }";
$header_dynamic_tablet_style 	.= ".block-minicart { $cart_padding_tablet $cart_margin_tablet }";
$header_dynamic_mobile_style 	.= ".block-minicart { $cart_padding_mobile $cart_margin_mobile }";

$header_dynamic_style 			.= ".site-header-cart .cart-contents .countitems {  $cart_count_margin_desktop }";
$header_dynamic_tablet_style 	.= ".site-header-cart .cart-contents .countitems { $cart_count_margin_tablet }";
$header_dynamic_mobile_style 	.= ".site-header-cart .cart-contents .countitems { $cart_count_margin_mobile }";

$header_dynamic_style .= "@media screen and (max-width:768px){{$header_dynamic_tablet_style}}";
$header_dynamic_style .= "@media screen and (max-width:480px){{$header_dynamic_mobile_style}}";