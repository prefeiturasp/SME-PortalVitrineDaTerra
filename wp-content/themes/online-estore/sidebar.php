<?php
/**
 * The sidebar containing the main widget area
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Online eStore
 */

if( is_home() || is_page() ){
		
	$post_sidebar = get_theme_mod( 'online_estore_default_page_sidebar','rightsidebar' );

}elseif( is_category() || is_tag() || is_attachment() || is_author() || is_archive() ){

	$post_sidebar = get_theme_mod( 'online_estore_archive_sidebar','rightsidebar' );

}elseif( is_search() ){

	$post_sidebar = get_theme_mod( 'online_estore_search_sidebar','rightsidebar' );

}else{

	$post_sidebar = get_theme_mod( 'online_estore_default_page_sidebar','rightsidebar' );

	if(!$post_sidebar){

		$post_sidebar = 'rightsidebar';
	}
}

if ( $post_sidebar ==  'nosidebar' ) {
	return;
}

if( $post_sidebar == 'rightsidebar' && is_active_sidebar('sidebar-1')){ ?>
		
		<aside id="secondary" class="widget-area right" role="complementary">

			<?php dynamic_sidebar( 'sidebar-1' ); ?>

		</aside><!-- #secondary -->
	<?php
}

if( $post_sidebar == 'leftsidebar' && is_active_sidebar('sidebar-2')){ ?>

		<aside id="secondary" class="widget-area left" role="complementary">

			<?php dynamic_sidebar( 'sidebar-2' ); ?>

		</aside><!-- #secondary -->
	<?php
}