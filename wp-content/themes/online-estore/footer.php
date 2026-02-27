<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Online eStore
 */

$footerarea = get_theme_mod( 'online_estore_footer_widget_area_option','on' );
$payment_logo = get_theme_mod( 'online_estore_footer_widget_payment_image' );

$footer_menu_class  = '';
if ( has_nav_menu( 'menu-4' ) || !empty( $payment_logo ) ) { 
	$footer_menu_class = 'activemenu';
}

?>

</div><!-- #content -->

	<footer id="page-footer" class="site-footer <?php echo esc_attr( $footerarea ); ?>">
	    <?php
			if( !empty( $footerarea ) && $footerarea == 'on' ){
		?>
			<div class="footer-widgets">
				<div class="container">
					<div class="middle-footer-inner">
						<?php if ( is_active_sidebar( 'footer-1' ) ) { ?>
							<div class="footerwrap wow fadeInLeft">
								<?php dynamic_sidebar( 'footer-1' ); ?>
							</div>
						<?php } ?>

						<?php if ( is_active_sidebar( 'footer-2' ) ) { ?>
							<div class="footerwrap wow fadeInUp">
								<?php dynamic_sidebar( 'footer-2' ); ?>
							</div>
						<?php } ?>

						<?php if ( is_active_sidebar( 'footer-3' ) ) { ?>
							<div class="footerwrap wow fadeInUp">
								<?php dynamic_sidebar( 'footer-3' ); ?>
							</div>
						<?php } ?>

						<?php if ( is_active_sidebar( 'footer-4' ) ) { ?>
							<div class="footerwrap wow fadeInRight">
								<?php dynamic_sidebar( 'footer-4' ); ?>
							</div>
						<?php } ?>
					</div>
				</div>
			</div>
		<?php } ?>

		<div class="footer-socials wow fadeInUp">
	    	<div class="container">
				<div class="socialicon">
					<?php
						online_estore_social_links();
					?>
				</div>
			</div>
	    </div><!-- .footer-socials -->


	    <div class="footer-copyright">
	        <div class="container">
				<div class="row">
					<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 <?php echo esc_attr( $footer_menu_class ); ?>">
						<?php 
							if( !empty( $payment_logo ) ){
						?>
							<div class="onlineestore_payment_wrap">
								<img src="<?php echo esc_url( $payment_logo ); ?>" />
							</div>
						<?php } ?>
						
						<?php
							if ( has_nav_menu( 'menu-4' ) ) {
						?>	
				            <div class="onlineestore_footer_menu">
				                <?php wp_nav_menu( array( 'theme_location' => 'menu-4', 'depth' => 1 ) ); ?>
				            </div><!-- Copyright -->
						<?php } ?> 

			            <div class="onlineestore_copyright wow fadeInUp">
			                <?php apply_filters( 'online_estore_copyright', 5 ); ?> <?php the_privacy_policy_link(); ?>
			            </div><!-- Copyright -->
					</div>
		        </div>
	        </div>
	    </div><!-- .footer-copyright -->

	</footer><!-- #colophon -->

</div><!-- #page -->

<a href="#" id="back-to-top" class="progress" data-tooltip="Back To Top">
	<div class="arrow-top"></div>
	<div class="arrow-top-line"></div>
	<svg class="progress-circle svg-content" width="100%" height="100%" viewBox="0 0 100 100" preserveAspectRatio="xMinYMin meet"> <path d="M50,1 a49,49 0 0,1 0,98 a49,49 0 0,1 0,-98"/></svg> 
</a>

<?php wp_footer(); ?>

</body>
</html>