<?php
/**
 * WooCommerce Compatibility File
 *
 * @link https://woocommerce.com/
 *
 * @package Online-eStore
 */

/**
 * WooCommerce setup function.
 *
 * @link https://docs.woocommerce.com/document/third-party-custom-theme-compatibility/
 * @link https://github.com/woocommerce/woocommerce/wiki/Enabling-product-gallery-features-(zoom,-swipe,-lightbox)-in-3.0.0
 *
 * @return void
 */
function online_estore_woocommerce_setup() {

	add_theme_support( 'woocommerce' );
	add_theme_support( 'wc-product-gallery-zoom' );
	add_theme_support( 'wc-product-gallery-lightbox' );
	add_theme_support( 'wc-product-gallery-slider' );
}
add_action( 'after_setup_theme', 'online_estore_woocommerce_setup' );

/**
 * WooCommerce specific scripts & stylesheets.
 *
 * @return void
 */
function online_estore_woocommerce_scripts() {
	wp_enqueue_style( 'onlineestore-woocommerce-style', get_template_directory_uri() . '/woocommerce.css' );

	$font_path   = WC()->plugin_url() . '/assets/fonts/';
	$inline_font = '@font-face {
			font-family: "star";
			src: url("' . $font_path . 'star.eot");
			src: url("' . $font_path . 'star.eot?#iefix") format("embedded-opentype"),
				url("' . $font_path . 'star.woff") format("woff"),
				url("' . $font_path . 'star.ttf") format("truetype"),
				url("' . $font_path . 'star.svg#star") format("svg");
			font-weight: normal;
			font-style: normal;
		}';

	wp_add_inline_style( 'onlineestore-woocommerce-style', $inline_font );
}
//add_action( 'wp_enqueue_scripts', 'online_estore_woocommerce_scripts' );

/**
 * Disable the default WooCommerce stylesheet.
 *
 * Removing the default WooCommerce stylesheet and enqueing your own will
 * protect you during WooCommerce core updates.
 *
 * @link https://docs.woocommerce.com/document/disable-the-default-stylesheet/
 */
//add_filter( 'woocommerce_enqueue_styles', '__return_empty_array' );

/**
 * Add 'woocommerce-active' class to the body tag.
 *
 * @param  array $classes CSS classes applied to the body tag.
 * @return array $classes modified to include 'woocommerce-active' class.
 */
function online_estore_woocommerce_active_body_class( $classes ) {

	$classes[] = 'woocommerce-active';

	return $classes;
}
add_filter( 'body_class', 'online_estore_woocommerce_active_body_class' );

/**
 * Products per page.
 *
 * @return integer number of products.
 */
function online_estore_woocommerce_products_per_page() {

	return get_theme_mod( 'online_estore_display_number_products', 12 );
}
add_filter( 'loop_shop_per_page', 'online_estore_woocommerce_products_per_page' );

/**
 * Default loop columns on product archives.
 *
 * @return integer products per row.
 */
function online_estore_woocommerce_loop_columns() {

	return get_theme_mod( 'online_estore_enter_display_number_columns', 3 );

}
add_filter( 'loop_shop_columns', 'online_estore_woocommerce_loop_columns' );


/**
 * Product gallery thumnbail columns.
 *
 * @return integer number of columns.
 */
function online_estore_woocommerce_thumbnail_columns() {
	return 4;
}
add_filter( 'woocommerce_product_thumbnails_columns', 'online_estore_woocommerce_thumbnail_columns' );

/**
 * Related Products Args.
 *
 * @param array $args related products args.
 * @return array $args related products args.
 */

// Change Related Products Text
function online_estore_related_text_strings( $translated_text, $text, $domain ) {

    switch ( $translated_text ) {

        case 'Related products' :

            $translated_text = get_theme_mod( 'online_estore_single_related_product_title','Related products' );

            break;
    }

    return $translated_text;
}
add_filter( 'gettext', 'online_estore_related_text_strings', 20, 3 );


function online_estore_woocommerce_related_products_args( $args ) {

	$related_product_columns = get_theme_mod( 'online_estore_single_num_related_product_columns', 3 );
	$display_related_product = get_theme_mod( 'online_estore_single_num_related_product', 6 );

	$defaults = array(
		'posts_per_page' => $display_related_product,
		'columns'        => $related_product_columns,
	);

	$args = wp_parse_args( $defaults, $args );

	return $args;
}
add_filter( 'woocommerce_output_related_products_args', 'online_estore_woocommerce_related_products_args' );


/**
 * Output product up sells.
 *
 * @param int $posts_per_page (default: -1)
 * @param int $columns (default: 2)
 */
remove_action( 'woocommerce_after_single_product_summary', 'woocommerce_upsell_display', 15 );

if ( ! function_exists( 'online_estore_woocommerce_upsell_display' ) ) {

  	function online_estore_woocommerce_upsell_display() {

	    $posts_per_page   = get_theme_mod( 'online_estore_single_num_upsells_product', 6 );
	    
	    $upsells_product_columns   = get_theme_mod( 'online_estore_single_num_upsells_product_columns', 3 );
	    
    	woocommerce_upsell_display( $posts_per_page, $upsells_product_columns ); 

  	}
}
add_action( 'woocommerce_after_single_product_summary', 'online_estore_woocommerce_upsell_display', 15 );



if ( ! function_exists( 'online_estore_woocommerce_product_columns_wrapper' ) ) {
    /**
     * Product columns wrapper.
     *
     * @return  void
     */
    function online_estore_woocommerce_product_columns_wrapper() {

        $columns = online_estore_woocommerce_loop_columns();

        echo '<div class="columns-' . absint( $columns ) . '">';
    }
}
add_action( 'woocommerce_before_shop_loop', 'online_estore_woocommerce_product_columns_wrapper', 40 );

if ( ! function_exists( 'online_estore_woocommerce_product_columns_wrapper_close' ) ) {
    /**
     * Product columns wrapper close.
     *
     * @return  void
     */
    function online_estore_woocommerce_product_columns_wrapper_close() {

        echo '</div>';
    }
}
add_action( 'woocommerce_after_shop_loop', 'online_estore_woocommerce_product_columns_wrapper_close', 8 );

/**
 * Descriptions on Header Menu
 * @author Sparkle Themes
 * @param string $item_output , HTML outputp for the menu item
 * @param object $item , menu item object
 * @param int $depth , depth in menu structure
 * @param object $args , arguments passed to wp_nav_menu()
 * @return string $item_output
 */
function online_estore_header_menu_desc($item_output, $item, $depth, $args){

    if ('menu-1' == $args->theme_location && $item->description)

        $item_output = str_replace('</a>', '<span class="menu-description">' . $item->description . '</span></a>', $item_output);

    return $item_output;
}

add_filter('walker_nav_menu_start_el', 'online_estore_header_menu_desc', 10, 4);


remove_action( 'woocommerce_before_main_content','woocommerce_breadcrumb', 20 );
add_filter( 'woocommerce_show_page_title', '__return_false' );

remove_action( 'woocommerce_before_shop_loop_item', 'woocommerce_template_loop_product_link_open', 10 );
remove_action( 'woocommerce_after_shop_loop_item', 'woocommerce_template_loop_product_link_close', 5 );
remove_action( 'woocommerce_before_shop_loop_item_title', 'woocommerce_show_product_loop_sale_flash', 10 );
remove_action( 'woocommerce_before_shop_loop_item_title', 'woocommerce_template_loop_product_thumbnail', 10 );
remove_action( 'woocommerce_after_shop_loop_item', 'woocommerce_template_loop_add_to_cart');

function online_estore_woocommerce_template_loop_product_thumbnail(){ ?>

    <div class="store_products_item">
        <div class="store_products_item_body">
			<?php
		        global $post, $product, $product_label_custom; 

		        $sale_class = '';
		        if( $product->is_on_sale() == 1 ){
					$sale_class = 'new_sale';
				}
			?>
			<div class="flash <?php echo esc_attr( $sale_class ); ?>">

				<?php online_estore_sale_percentage_loop(); ?>

				<?php 
		            if ($product_label_custom != ''){

						echo '<span class="onnew"><span class="text">'.esc_html__('New','online-estore').'</span></span>';
					}

		            if ( $product->is_on_sale() ) :

		             	echo apply_filters( 'woocommerce_sale_flash', '<span class="onlineestore_sale_label"><span class="text">' . esc_html__( 'Sale!', 'online-estore' ) . '</span></span>', $post, $product );
		            
					endif;
	            ?>
			</div>

            <a href="<?php the_permalink(); ?>" class="store_product_item_link">
				<?php the_post_thumbnail('woocommerce_thumbnail'); #Products Thumbnail ?>
            </a>
			<ul class="onlineestore_products_items_info">
				<?php if(function_exists( 'online_estore_quickview' )) { ?>
					<li>
						<?php online_estore_quickview(); ?>
					</li>
				<?php } ?>

				<?php if(function_exists( 'online_estore_add_compare_link' )) { ?>
					<li>
						<?php online_estore_add_compare_link(); ?>
					</li>
				<?php } ?>

				<?php if(function_exists( 'online_estore_wishlist_products' )) { ?>
					<li>
						<?php online_estore_wishlist_products(); ?>
					</li>
				<?php } ?>
				<li class="products_item_info">
					
				<?php
				/**
				* woocommerce_template_loop_add_to_cart
				*/
				woocommerce_template_loop_add_to_cart();
				?>
				</li>
			</ul>
        </div>
    </div>    
  	<?php 
}
add_action( 'woocommerce_before_shop_loop_item_title', 'online_estore_woocommerce_template_loop_product_thumbnail', 10 );

remove_action( 'woocommerce_shop_loop_item_title', 'woocommerce_template_loop_product_title', 10 );

if ( !function_exists('online_estore_woocommerce_shop_loop_item_title') ) {

    function online_estore_woocommerce_shop_loop_item_title(){ ?>

        <div class="store_products_item_details">
        	<h3>
	          	<a class="onlineestore_products_title" href="<?php the_permalink(); ?>">
	            	<?php the_title( ); ?>
	          	</a>
          	</h3>
      <?php 
    }
}
add_action( 'woocommerce_shop_loop_item_title', 'online_estore_woocommerce_shop_loop_item_title', 10 );


// remove_action('woocommerce_after_shop_loop_item_title', 'woocommerce_template_loop_rating', 5);
// remove_action('woocommerce_after_shop_loop_item_title', 'woocommerce_template_loop_price', 10);

// add_action('woocommerce_after_shop_loop_item_title', 'woocommerce_template_loop_price', 10);
// add_action('woocommerce_after_shop_loop_item_title', 'woocommerce_template_loop_rating', 11);

/**
 * Price & Rating Wrap
*/
if (!function_exists('online_estore_woocommerce_before_rating_loop_price')) {

    function online_estore_woocommerce_before_rating_loop_price(){ ?>

    	 <div class="price-rating-wrap"> 

      <?php 
    }
}
add_action( 'woocommerce_after_shop_loop_item_title', 'online_estore_woocommerce_before_rating_loop_price', 6);

if (!function_exists('online_estore_woocommerce_after_rating_loop_price')) {

    function online_estore_woocommerce_after_rating_loop_price(){ ?>

    	</div>

      <?php 
    }
}
add_action( 'woocommerce_after_shop_loop_item_title', 'online_estore_woocommerce_after_rating_loop_price', 12 );

if (!function_exists('online_estore_woocommerce_product_item_details_close')) {

    function online_estore_woocommerce_product_item_details_close(){ ?>

    	</div>

      <?php 
    }
}
add_action( 'woocommerce_template_loop_price', 'online_estore_woocommerce_product_item_details_close', 9 );

/**
 * Result Count & Pagination Wrap
*/
if (!function_exists('online_estore_woocommerce_before_catalog_ordering')) {

    function online_estore_woocommerce_before_catalog_ordering(){ ?>

    	<div class="shop-before-control">

      <?php 
    }
}
//add_action( 'woocommerce_before_shop_loop', 'online_estore_woocommerce_before_catalog_ordering', 9);



if (!function_exists('online_estore_woocommerce_after_catalog_ordering')) {

    function online_estore_woocommerce_after_catalog_ordering(){ ?>

    	</div>

      <?php 
    }
}
//add_action( 'woocommerce_before_shop_loop', 'online_estore_woocommerce_after_catalog_ordering', 31 );


/**
 * Remove default WooCommerce wrapper.
 */
remove_action( 'woocommerce_before_main_content', 'woocommerce_output_content_wrapper', 10 );
remove_action( 'woocommerce_after_main_content', 'woocommerce_output_content_wrapper_end', 10 );

if ( ! function_exists( 'online_estore_woocommerce_wrapper_before' ) ) {
	/**
	 * Before Content.
	 *
	 * Wraps all WooCommerce content in wrappers which match the theme markup.
	 *
	 * @return void
	 */
	function online_estore_woocommerce_wrapper_before() {
		
		$product_sidebar =  get_theme_mod( 'online_estore_woo_category_settings_section','rightsidebar' );

		?>
		<div class="container">

			<div class="site-wrapper">

				<div id="primary" class="content-area <?php echo esc_attr( $product_sidebar ); ?>">
					<main id="main" class="site-main" role="main">
				<?php
	}
}
add_action( 'woocommerce_before_main_content', 'online_estore_woocommerce_wrapper_before' );

if ( ! function_exists( 'online_estore_woocommerce_wrapper_after' ) ) {
	/**
	 * After Content.
	 *
	 * Closes the wrapping divs.
	 *
	 * @return void
	 */
	function online_estore_woocommerce_wrapper_after() {
			?>
					</main><!-- #main -->
				</div><!-- #primary -->

				<?php get_sidebar(); ?>
				
			</div>

		</div>

		<?php
	}
}
add_action( 'woocommerce_after_main_content', 'online_estore_woocommerce_wrapper_after' );

remove_action('woocommerce_sidebar', 'woocommerce_get_sidebar', 10 );


/**
 * Single Product Page Wrapper
*/
if (!function_exists('online_estore_woocommerce_before_single_product_summary')) {

    function online_estore_woocommerce_before_single_product_summary(){ ?>

    	<div class="product-summary-wrapper clearfix wow fadeInUp">

      <?php 
    }
}
add_action( 'woocommerce_before_single_product_summary', 'online_estore_woocommerce_before_single_product_summary', 9);



if (!function_exists('online_estore_woocommerce_after_single_product_summary')) {

    function online_estore_woocommerce_after_single_product_summary(){ ?>

    	</div>

      <?php 
    }
}
add_action( 'woocommerce_after_single_product_summary', 'online_estore_woocommerce_after_single_product_summary', 9 );


/* 
 * Product Single Page
*/
remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_rating', 10 );
remove_action( 'woocommerce_before_single_product_summary', 'woocommerce_show_product_sale_flash', 10 );

function online_estore_group_flash(){

    global $post, $product; ?>

	<div class="flash">
		<?php 

			online_estore_sale_percentage_loop(); 

		    $newness_days = 7;
		    
		    $created = strtotime( $product->get_date_created() );
		    if ( ( time() - ( 60 * 60 * 24 * $newness_days ) ) > $created ) {
		        echo '<span class="onnew"><span class="text">' . esc_html__( 'New!', 'online-estore' ) . '</span></span>';
		    }

            if ( $product->is_on_sale() ) :

             	echo apply_filters( 'woocommerce_sale_flash', '<span class="onlineestore_sale_label"><span class="text">' . esc_html__( 'Sale!', 'online-estore' ) . '</span></span>', $post, $product );
            
			endif;
        ?>
	</div>

	<?php 
}
add_action( 'woocommerce_single_product_summary','online_estore_group_flash', 10 );


function online_estore_custom_ratting_single_product(){
	global $product;
	if ( get_option( 'woocommerce_enable_review_rating' ) === 'no' ) {
		return;
	}
	$rating_count = $product->get_rating_count();
	$average      = $product->get_average_rating();
	if ( $rating_count > 0 ) : ?>
        <div class="woocommerce-product-rating">
            <span class="star-rating">
                <span style="width:<?php echo( ( intval($average) / 5 ) * 100 ); ?>%">
                    <?php printf(
						wp_kses( '%1$s out of %2$s', 'online-estore' ),
						'<strong class="rating">' . esc_html( $average ) . '</strong>',
						'<span>5</span>'
					); ?>
                </span>
            </span>

            <span>
                <?php printf(
					wp_kses( 'based on %s rating', 'Based on %s ratings', $rating_count, 'online-estore' ),
					'<span class="rating">' . esc_html( $rating_count ) . '</span>'
				); ?>
            </span>

			<?php if ( comments_open() ) : ?>
                <a href="#reviews" class="woocommerce-review-link" rel="nofollow">
                    <i class="fa fa-pencil" aria-hidden="true"></i>
					<?php echo esc_html__( 'write a preview', 'online-estore' ) ?>
                </a>
			<?php endif ?>
        </div>
	<?php endif;
}
add_action( 'woocommerce_single_product_summary', 'online_estore_custom_ratting_single_product', 5 );


if ( ! function_exists( 'online_estore_woocommerce_cart_link_fragment' ) ) {
	/**
	 * Cart Fragments.
	 *
	 * Ensure cart contents update when products are added to the cart via AJAX.
	 *
	 * @param array $fragments Fragments to refresh via AJAX.
	 * @return array Fragments to refresh via AJAX.
	 */
	function online_estore_woocommerce_cart_link_fragment( $fragments ) {
		ob_start();
		online_estore_woocommerce_cart_link();
		$fragments['div.block-cart-link'] = ob_get_clean();

		return $fragments;
	}
}
add_filter( 'woocommerce_add_to_cart_fragments', 'online_estore_woocommerce_cart_link_fragment' );


if ( ! function_exists( 'online_estore_woocommerce_cart_link' ) ) {
	/**
	 * Cart Link.
	 *
	 * Displayed a link to the cart including the number of items present and the cart total.
	 *
	 * @return void
	 */
	function online_estore_woocommerce_cart_link() { global $woocommerce; ?>

		<div class="shopcart-dropdown block-cart-link">
            <a class="cart-contents" href="<?php echo esc_url( wc_get_cart_url() ); ?>" title="<?php esc_attr_e( 'View your shopping cart', 'online-estore' ); ?>">
				<span class="fa fa-shopping-cart"></span>
				<div class="countitems">
					<span class="count"><?php echo intval(WC()->cart->get_cart_contents_count()); ?></span>
					<span class="carttext"><?php esc_html_e( 'Cart', 'online-estore' ); ?></span>
				</div>
			</a>
        </div>
		<?php
	}
}


if ( ! function_exists( 'online_estore_woocommerce_header_cart' ) ) {
	/**
	 * Display Header Cart.
	 *
	 * @return void
	 */
	function online_estore_woocommerce_header_cart() { 
			$cart_align = get_theme_mod( 'cart-icon-align' ); 
		?>
		<div id="site-header-cart" class="site-header-cart block-minicart <?php echo esc_attr( $cart_align );  ?>">
			<?php online_estore_woocommerce_cart_link(); ?>
            <div class="shopcart-description">
				<?php the_widget( 'WC_Widget_Cart', 'title=' ); ?>
            </div>
        </div>
		<?php
	}
}
add_action( 'online_estore_woocommerce_header_cart', 'online_estore_woocommerce_header_cart' );
add_action( 'online_estore_cart', 'online_estore_woocommerce_header_cart' );



if( !function_exists ('online_estore_sale_percentage_loop') ){
	/**
     * Woocommerce Products Discount Show
     *
     * @since 1.0.0
    */
	function online_estore_sale_percentage_loop() {

		global $product;
		
		if ( $product->is_on_sale() ) {
			
			if ( ! $product->is_type( 'variable' ) and $product->get_regular_price() and $product->get_sale_price() ) {
				
				$max_percentage = ( ( $product->get_regular_price() - $product->get_sale_price() ) / $product->get_regular_price() ) * 100;
			
			} else {
				$max_percentage = 0;
				
				foreach ( $product->get_children() as $child_id ) {

					$variation = wc_get_product( $child_id );

					$price = $variation->get_regular_price();

					$sale = $variation->get_sale_price();

					$percentage = '';

					if ( $price != 0 && ! empty( $sale ) ) $percentage = ( $price - $sale ) / $price * 100;

						if ( $percentage > $max_percentage ) {
							$max_percentage = $percentage;
						}
				}
			
			}
			
			echo "<span class='on_sale'>" . esc_html( round( - $max_percentage ) ) . esc_html__("%", 'online-estore')."</span>";
		
		}

	}
}


if( defined( 'YITH_WCQV' ) ) :
	/**
     * Online eStore Add the Link to Quick View Function
     *
     * @return array();
     */
	function online_estore_quickview(){

		global $product;

		$quick_view = YITH_WCQV_Frontend();

		remove_action( 'woocommerce_after_shop_loop_item', array( $quick_view, 'yith_add_quick_view_button' ), 15 );
		
		$label = esc_html( get_option( 'yith-wcqv-button-label' ) ); ?>
		
		<a href="javascript:void(0)" class="link-quickview yith-wcqv-button" data-product_id="<?php echo esc_attr( $product->get_id() ) ?>">

			<span aria-hidden="true" class="fa fa-eye"></span>

			<div class="onlineestore_products_item_tip">
				<?php echo esc_html( $label ); ?>
			</div>

		</a>
	<?php
	}
endif;

if( defined( 'YITH_WOOCOMPARE' ) ) : 
	/**
     * Online eStore Add the Link to Compare Function
     *
     * @return array();
     */
	function online_estore_add_compare_link( $product_id = false, $args = array() ) {

		extract( $args );

		if ( ! $product_id ) {
			global $product;
			$productid = $product->get_id();

			$product_id = intval(isset( $productid ) ? $productid : 0 );
		}

		$is_button = ! isset( $button_or_link ) || ! $button_or_link ? get_option( 'yith_woocompare_is_button' ) : $button_or_link;

		if ( ! isset( $button_text ) || $button_text == 'default' ) {
			$button_text = get_option( 'yith_woocompare_button_text', esc_html__( 'Compare', 'online-estore' ) );
			yit_wpml_register_string( 'Plugins', 'plugin_yit_compare_button_text', $button_text );
			$button_text = yit_wpml_string_translate( 'Plugins', 'plugin_yit_compare_button_text', $button_text );
		}

		printf('<a href="%s" class="%s" data-product_id="%d" rel="nofollow">%s</a>', '#', 'compare link-compare', intval( $product_id ), '<span class="sparkle-tooltip-label">'.esc_html( $button_text ).'</span>' );
	}

	remove_action( 'woocommerce_after_shop_loop_item',  array( 'YITH_Woocompare_Frontend', 'add_compare_link' ), 20 );

endif;

if (defined('YITH_WCWL')) {

	if ( ! function_exists( 'online_estore_products_wishlist' ) ) {

		/**
		 * Wishlist Header Count Ajax Function
		 *
		 * @since 1.0.0
		*/
		function online_estore_products_wishlist() {

			if ( function_exists( 'YITH_WCWL' ) ) { 

				$wishlist_url = YITH_WCWL()->get_wishlist_url(); ?>

				<div class="top-wishlist">                
					<a href="<?php echo esc_url( $wishlist_url ); ?>" title="Wishlist" data-toggle="tooltip">
						<div class="count">
							<div class="bigcounter">
								<span class="count_number"><?php echo intval( yith_wcwl_count_products() ); ?></span>
								<span class="fa fa-heart"></span>
								<span class="ewishlist"><?php esc_html_e('Wish List','online-estore'); ?></span>
							</div>
						</div>
					</a>
				</div>
			<?php
			}
		}	
	}
	add_action( 'wp_ajax_yith_wcwl_update_single_product_list', 'online_estore_products_wishlist' );
	add_action( 'wp_ajax_nopriv_yith_wcwl_update_single_product_list', 'online_estore_products_wishlist' );
    

    function online_estore_wishlist_products() {

        echo do_shortcode( '[yith_wcwl_add_to_wishlist]' );

    }

    /**
     * define the yith-wcwl-browse-wishlist-label callback
    */
    function online_estore_filter_yith_wcwl_browse_wishlist_label( $var ) { 

        return '<span class="site-tooltip-label">'.$var.'</span>';

    }; 
    add_filter( 'yith-wcwl-browse-wishlist-label', 'online_estore_filter_yith_wcwl_browse_wishlist_label', 10, 1 );

}


if( !function_exists( 'online_estore_products_categories_lists' ) ) :

    /**
     * Product Category list
     *
     * @return array();
     */
   
    function online_estore_products_categories_lists() {

        $args = array(
            'taxonomy'     => 'product_cat',
            'orderby'      => 'name',
            'show_count'   => 0,
            'pad_counts'   => 0,
            'hierarchical' => 1,
            'title_li'     => '',
            'hide_empty'   => 0
        );

        $online_estore_products_categories = get_categories( $args );

        $online_estore_products_categories_lists = array();

        foreach( $online_estore_products_categories as $category ) {

            $online_estore_products_categories_lists[$category->term_id] = $category->name;
        }

        return $online_estore_products_categories_lists;
    }
endif;


if( !function_exists( 'online_estore_products_categories_dropdown' ) ) :

    /**
     * Widget Single Products Category dropdown
     *
     * @return array();
     */
    function online_estore_products_categories_dropdown() {

    	$args = array(
            'taxonomy'     => 'product_cat',
            'orderby'      => 'name',
            'show_count'   => 0,
            'pad_counts'   => 0,
            'hierarchical' => 1,
            'title_li'     => '',
            'hide_empty'   => 0
        );

		$online_estore_categories = get_categories( $args );

		$online_estore_categories_dropdown = array();

		$online_estore_categories_dropdown['0'] = esc_html__( 'Select Block Single Category ', 'online-estore' );

		foreach( $online_estore_categories as $category ) {

			$online_estore_categories_dropdown[esc_attr( $category->term_id )] = esc_html( $category->name );

		}

		return $online_estore_categories_dropdown;
    }

endif;

if ( !function_exists('online_estore_tabs_ajax_action') ) :
	/**
     * Online eStore Category Products Ajax Function for Tabs
     *
     * @return array();
     */
    function online_estore_tabs_ajax_action() {

    	if ( isset( $_POST['category_slug'] ) ) {
       		$cat_slug = sanitize_text_field( wp_unslash( $_POST['category_slug'] ) );
       	}

       	if ( isset( $_POST['product_num'] ) ) {
       		$product_number = sanitize_text_field( wp_unslash( $_POST['product_num'] ) );
       	}

       	if ( isset( $_POST['block_layout'] ) ) {
       		$block_layout = sanitize_text_field( wp_unslash( $_POST['block_layout'] ) );
       	}

        ob_start(); ?>

        <div class="xstoretabproductarea">

            <ul class="onlineestore_products_type <?php if( !empty( $block_layout ) && $block_layout == 'layout1' ){ echo esc_attr( 'xstoretabsproduct cS-hidden' ); }else{ echo esc_attr( 'xstorecatproductlist' ); }  ?>">
                <?php
                    $product_args = array(
                        'post_type' => 'product',
                        'tax_query' => array(
                            array(
                                'taxonomy' => 'product_cat',
                                'field'    => 'slug',
                                'terms'    => $cat_slug
                            )),
                        'posts_per_page' => $product_number
                    );

                    $query = new WP_Query($product_args);

                    if ( $query->have_posts() ) { while ( $query->have_posts() ) { $query->the_post();

                           wc_get_template_part('content', 'product');
                           
                        }
                    }

                    wp_reset_postdata();
                ?>
            </ul>

        </div>

    	<?php
            $xstorehtml = ob_get_contents();

            ob_get_clean();

            echo wp_kses_post ( $xstorehtml );

            die();
    }

endif;

add_action('wp_ajax_online_estore_tabs_ajax_action', 'online_estore_tabs_ajax_action');
add_action('wp_ajax_nopriv_online_estore_tabs_ajax_action', 'online_estore_tabs_ajax_action');



if ( !function_exists('online_estore_tabs_products_ajax_action') ) :
	/**
     * Online eStore Category Products Ajax Function for Tabs
     *
     * @return array();
     */
    function online_estore_tabs_products_ajax_action() {

    	if ( isset( $_POST['category_slug'] ) ) {
       		$product_type = sanitize_text_field( wp_unslash( $_POST['category_slug'] ) );
       	}

       	if ( isset( $_POST['product_num'] ) ) {
       		$product_number = sanitize_text_field( wp_unslash( $_POST['product_num'] ) );
       	}

       	if ( isset( $_POST['block_layout'] ) ) {
       		$block_layout = sanitize_text_field( wp_unslash( $_POST['block_layout'] ) );
       	}

		if ( isset( $_POST['product_column'] ) ) {
			$product_column = sanitize_text_field( wp_unslash( $_POST['product_column'] ) );
		}

        ob_start(); ?>

        <div class="xstoretabsproductsarea" data-typecolumn="<?php echo intval($product_column); ?>">

            <ul class="onlineestore_products_type <?php if( !empty( $block_layout ) && $block_layout == 'layout1' ){ echo esc_attr( 'xstorecatproductslider cS-hidden' ); }else{ echo esc_attr( 'xstorecatproductlist' ); }  ?>">
                <?php
                    $product_args       =   '';
			        global $product_label_custom;

			        if($product_type == 'latest_products'){

			            $product_label_custom = esc_html__('New', 'online-estore');

			            $product_args = array(
				            'post_type' => 'product',
				            'posts_per_page' => $product_number
				        );
			        }

			        elseif($product_type == 'up_products'){
			            $product_args = array(
			                'post_type'         => 'product',
			                'meta_key'          => 'total_sales',
			                'orderby'           => 'meta_value_num',
			                'posts_per_page'    => $product_number
			            );
			        }

			        elseif($product_type == 'feature_products'){
			            $product_args = array(
                            'post_type'        => 'product',  
                            'tax_query' => array(
                                    'relation' => 'AND',      
                                    array(
                                        'taxonomy' => 'product_visibility',
                                        'field'    => 'name',
                                        'terms'    => 'featured',
                                        'operator' => 'IN'
                                    )
                            ), 
                            'posts_per_page'   => $product_number   
                        );
			        }

			        elseif($product_type == 'on_products'){
			            $product_args = array(
			            'post_type'      => 'product',
			            'posts_per_page'   => $product_number,
			            'meta_query'     => array(
			                'relation' => 'OR',
			                array( // Simple products type
			                    'key'           => '_sale_price',
			                    'value'         => 0,
			                    'compare'       => '>',
			                    'type'          => 'numeric'
			                ),
			                array( // Variable products type
			                    'key'           => '_min_variation_sale_price',
			                    'value'         => 0,
			                    'compare'       => '>',
			                    'type'          => 'numeric'
			                )
			            ));
			        }

                    $query = new WP_Query($product_args);

                    if ( $query->have_posts() ) { while ( $query->have_posts() ) { $query->the_post();

                           wc_get_template_part('content', 'product');
                           
                        }
                    }

                    wp_reset_postdata();
                ?>
            </ul>

        </div>

    	<?php
            $xstorehtml = ob_get_contents();

            ob_get_clean();

            echo wp_kses_post ( $xstorehtml );

            die();
    }

endif;

add_action('wp_ajax_online_estore_tabs_products_ajax_action', 'online_estore_tabs_products_ajax_action');
add_action('wp_ajax_nopriv_online_estore_tabs_products_ajax_action', 'online_estore_tabs_products_ajax_action');


if ( ! function_exists( 'online_estore_ecommerce_items' ) ) :
    /**
     * eCommerce Items
     *
     * @since 1.0.0
     */
    function online_estore_ecommerce_items() { ?>

        <ul class="onlineestore_ecommerce_items">
            
            <?php if (is_user_logged_in()) { ?>

                <li>
                    <a href="<?php echo esc_url( get_permalink( get_option( 'woocommerce_myaccount_page_id' ) ) ); ?>"><i class="fa fa-opencart"></i><?php esc_html_e('My Account','online-estore'); ?></a>
                </li>

                <li>
                    <a href="<?php echo esc_url( wp_logout_url( home_url() ) ); ?>"><i class="fa fa-sign-out"></i><?php esc_html_e('Logout','online-estore'); ?></a>
                </li> 

            <?php } else{ ?>

                <li>
                    <a href="<?php echo esc_url( get_permalink( get_option( 'woocommerce_myaccount_page_id' ) ) ); ?>"><i class="fa fa-sign-in"></i><?php esc_html_e('Login','online-estore'); ?></a>
                </li>

                <li>
                    <a href="<?php echo esc_url( get_permalink( get_option( 'woocommerce_myaccount_page_id' ) ) ); ?>"><i class="fa fa-user-circle"></i><?php esc_html_e('Create Your Account','online-estore'); ?></a>
                </li>

            <?php } ?>
        </ul>
    <?php
    }
endif;