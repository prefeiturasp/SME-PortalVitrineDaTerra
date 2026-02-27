<?php
/**
 * The sidebar containing the main widget area.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Online eStore
 */

if( is_singular() ){

	$product_sidebar =  esc_attr( get_theme_mod( 'online_estore_woo_single_settings_section','rightsidebar' ) );

}else{

	$product_sidebar =  esc_attr( get_theme_mod( 'online_estore_woo_category_settings_section','rightsidebar' ) );
}

if( $product_sidebar == 'rightsidebar' && is_active_sidebar('sidebar-1')){ ?>

		<aside id="secondaryleft" class="widget-area col-lg-4 col-md-4 col-sm-12 col-xs-12" role="complementary" itemscope="itemscope" itemtype="http://schema.org/WPSideBar">
			
			<div class="sidebar-area">

				<?php dynamic_sidebar( 'sidebar-1' ); ?>

			</div>

		</aside><!-- #secondary -->

	<?php
}

if( $product_sidebar == 'leftsidebar' && is_active_sidebar('sidebar-2')){ ?>

		<aside id="secondaryleft" class="widget-area col-lg-4 col-md-4 col-sm-12 col-xs-12" role="complementary" itemscope="itemscope" itemtype="http://schema.org/WPSideBar">
			
			<div class="sidebar-area">

				<?php dynamic_sidebar( 'sidebar-2' ); ?>
				
			</div>

		</aside><!-- #secondary -->

	<?php
}