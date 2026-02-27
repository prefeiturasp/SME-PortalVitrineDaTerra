<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Online eStore
 */

?>
<!doctype html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="https://gmpg.org/xfn/11">
	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?> data-scrolling-animations="true">

<?php wp_body_open(); ?>

<div id="page" class="site">

<a class="skip-link screen-reader-text" href="#content"><?php esc_html_e( 'Skip to content', 'online-estore' ); ?></a>


<?php
/**
 * online_estore_action_header hook
 *
 * @hooked online_estore_header - 10
 */
do_action( 'online_estore_action_header' );

?>

<?php

	if (!is_front_page() ) {
        /**
		 * online_estore_breadcrumb_header hook
		 *
		 * @since 1.0.0
		 */
		do_action( 'online_estore_breadcrumb_header' );
    }
?>

<?php 

	$slider_on_off = get_theme_mod( 'online_estore_main_slider_enable_disable', 'off' );

	if( is_front_page() ):

		$slider_layout = get_theme_mod( 'online_estore_slider_layout_options', 'sliderverticalmenu');
		
		$vertical_menu = get_theme_mod( 'online_estore_vertical_menu_options', 'on');
		$allbanners = get_theme_mod('online_estore_banner_slider_options');
		if( !empty($allbanners) && $slider_on_off == 'on' ):
		?>
			<div  class="sliderwrapper <?php echo esc_attr( $slider_layout ); ?> vertical_menu_<?php if ( class_exists( 'WooCommerce' ) ) { echo esc_attr( $vertical_menu ); } else{ echo esc_attr( 'off' ); } ?>">
				<?php 
					if( !empty( $slider_layout ) && $slider_layout == 'sliderverticalmenu' ){

						do_action( 'online_estore_slider_vertical_menu' );

					}else{

						do_action( 'online_estore_full_width_slider' );

					}
				?>
			</div>
		<?php
		endif;
	endif;
?>


<div id="content" class="site-content">
	
	<?php

	if( is_front_page() ){ 

		/**
		 * Home Page Services Area
		 *
		 * @since 1.0.0
		*/
		do_action( 'online_estore_services_area' );
	}