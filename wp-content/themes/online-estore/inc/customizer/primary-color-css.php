<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Primary Color
 */

$online_estore_primary_color = "";

$primary_color    = get_theme_mod('online_estore_primary_theme_color_options','#f33c3c');
 // Theme Primary Background Colors.
 $online_estore_primary_color .= "
    .articlesListing .article .btns .btn,
    .btn-primary,
    .btn-border:hover,
    .post-format-media-quote,
    .bannerwrap .slider-content a,
    .widget_product_search a.button, 
    .widget_product_search button, 
    .widget_product_search input[type='submit'], 
    .widget_search .search-submit,
    .page-numbers,
    .reply .comment-reply-link,
    a.button, button, input[type='submit'],
    .wpcf7 input[type='submit'], 
    .wpcf7 input[type='button'],
    .calendar_wrap caption,
    .posts-tag ul li,
    .arrow-top-line{
    
    background-color: $primary_color;
    
    }\n";



/**
* WooCommerce
*/

$online_estore_primary_color .= "
    body.woocommerce-active .woocommerce ul.products li.product .woocommerce-loop-category__title,
    body.woocommerce-active .woocommerce a.added_to_cart, 
    body.woocommerce-active .woocommerce a.button.add_to_cart_button, 
    body.woocommerce-active .woocommerce a.button.product_type_grouped, 
    body.woocommerce-active .woocommerce a.button.product_type_external, 
    body.woocommerce-active .woocommerce a.button.product_type_variable,
    body.woocommerce-active .woocommerce a.added_to_cart:before, 
    body.woocommerce-active .woocommerce a.button.add_to_cart_button:before, 
    body.woocommerce-active .woocommerce a.button.product_type_grouped:before, 
    body.woocommerce-active .woocommerce a.button.product_type_external:before, 
    body.woocommerce-active .woocommerce a.button.product_type_variable:before,
    body.woocommerce-active .woocommerce nav.woocommerce-pagination ul li a:focus, 
    body.woocommerce-active .woocommerce nav.woocommerce-pagination ul li a:hover, 
    body.woocommerce-active .woocommerce nav.woocommerce-pagination ul li span.current,
    body.woocommerce-active .woocommerce #respond input#submit, 
    body.woocommerce-active .woocommerce a.button, 
    body.woocommerce-active .woocommerce button.button, 
    body.woocommerce-active .woocommerce input.button,
    body.woocommerce-active .woocommerce #respond input#submit:hover, 
    body.woocommerce-active .woocommerce input.button:hover,
    body.woocommerce-active .woocommerce .widget_price_filter .price_slider_wrapper .ui-widget-content,
    body.woocommerce-active .woocommerce #respond input#submit.alt.disabled, 
    body.woocommerce-active .woocommerce #respond input#submit.alt.disabled:hover, 
    body.woocommerce-active .woocommerce #respond input#submit.alt:disabled, 
    body.woocommerce-active .woocommerce #respond input#submit.alt:disabled:hover, 
    body.woocommerce-active .woocommerce #respond input#submit.alt:disabled[disabled], 
    body.woocommerce-active .woocommerce #respond input#submit.alt:disabled[disabled]:hover, 
    body.woocommerce-active .woocommerce a.button.alt.disabled, 
    body.woocommerce-active .woocommerce a.button.alt.disabled:hover, 
    body.woocommerce-active .woocommerce a.button.alt:disabled, 
    body.woocommerce-active .woocommerce a.button.alt:disabled:hover, 
    body.woocommerce-active .woocommerce a.button.alt:disabled[disabled], 
    body.woocommerce-active .woocommerce a.button.alt:disabled[disabled]:hover, 
    body.woocommerce-active .woocommerce button.button.alt.disabled, 
    body.woocommerce-active .woocommerce button.button.alt.disabled:hover, 
    body.woocommerce-active .woocommerce button.button.alt:disabled, 
    body.woocommerce-active .woocommerce button.button.alt:disabled:hover, 
    body.woocommerce-active .woocommerce button.button.alt:disabled[disabled], 
    body.woocommerce-active .woocommerce button.button.alt:disabled[disabled]:hover, 
    body.woocommerce-active .woocommerce input.button.alt.disabled, 
    body.woocommerce-active .woocommerce input.button.alt.disabled:hover, 
    body.woocommerce-active .woocommerce input.button.alt:disabled, 
    body.woocommerce-active .woocommerce input.button.alt:disabled:hover, 
    body.woocommerce-active .woocommerce input.button.alt:disabled[disabled], 
    body.woocommerce-active .woocommerce input.button.alt:disabled[disabled]:hover,
    body.woocommerce-active .woocommerce #respond input#submit.alt, 
    body.woocommerce-active .woocommerce a.button.alt, 
    body.woocommerce-active .woocommerce button.button.alt, 
    body.woocommerce-active .woocommerce input.button.alt,
    body.woocommerce-active .woocommerce #respond input#submit.alt:hover, 
    body.woocommerce-active .woocommerce button.button.alt:hover, 
    body.woocommerce-active .woocommerce input.button.alt:hover,
    body.woocommerce-active .woocommerce-MyAccount-navigation ul li a,
    .single-product div.product .entry-summary .single_add_to_cart_button,

    .promo_block_area .promo-banner-img-inner:hover .promo-img-info .promo-img-info-inner h3,
    .woocommerce .product .onlineestore_products_items_info li a:hover,
    .woocommerce .product .onlineestore_products_item_tip, .woocommerce .sparkle-tooltip-label, .woocommerce .product .onlineestore_products_items_info li a.added_to_cart, .woocommerce .product .add_to_wishlist span, .yith-wcwl-wishlistaddedbrowse a span, .yith-wcwl-wishlistexistsbrowse a span, .onlineestore_products_items_info li a .added_to_cart,
    .site-header-cart .cart-contents span.count,
    .flash > span,
    .block-nav-category .view-all-category a,
    .flash.new_sale > .onnew,
    .woocommerce .product .onlineestore_products_item_tip::after, .woocommerce .sparkle-tooltip-label::after, .woocommerce a.added_to_cart::after, .yith-wcwl-wishlistaddedbrowse a span::after, .yith-wcwl-wishlistexistsbrowse a span::after,
    .block-nav-category .vertical-menu .page_item.current_page_item > a, .block-nav-category .vertical-menu li:hover > a, .block-nav-category .view-all-category a:hover
    {
        background-color: $primary_color;

    }\n";

$online_estore_primary_color .= "
    body.woocommerce-active a.added_to_cart:hover, 
    body.woocommerce-active .woocommerce a.button.add_to_cart_button:hover, 
    body.woocommerce-active .woocommerce a.button.product_type_grouped:hover, 
    body.woocommerce-active .woocommerce a.button.product_type_external:hover, 
    body.woocommerce-active .woocommerce a.button.product_type_variable:hover,
    body.woocommerce-active nav.woocommerce-pagination ul li,
    body.woocommerce-active .woocommerce a.added_to_cart, 
    body.woocommerce-active .woocommerce a.button.add_to_cart_button, 
    body.woocommerce-active .woocommerce a.button.product_type_grouped, 
    body.woocommerce-active .woocommerce a.button.product_type_external, 
    body.woocommerce-active .woocommerce a.button.product_type_variable,
    body.woocommerce-active .woocommerce nav.woocommerce-pagination ul li,
    body.woocommerce-active .woocommerce-message, 
    body.woocommerce-active .woocommerce-info,
    body.woocommerce-active .woocommerce-MyAccount-navigation ul li a:hover,

    .cross-sells h2, .cart_totals h2, .up-sells h2:not(.woocommerce-loop-product__title), .related h2:not(.woocommerce-loop-product__title), .woocommerce-billing-fields h3, .woocommerce-shipping-fields h3, .woocommerce-additional-fields h3, #order_review_heading, .woocommerce-order-details h2, .woocommerce-column--billing-address h2, .woocommerce-column--shipping-address h2, .woocommerce-Address-title h3, .woocommerce-MyAccount-content h3, .wishlist-title h2, .woocommerce-account .woocommerce h2, .widget-area .widget .widget-title, .comments-area .comments-title,
    .page-numbers,
    .page-numbers:hover,
    .btn-primary,
    .footer-widgets .widget h2.widget-title::before,
    .footer-widgets .widget .sociallink ul li,
    .woocommerce #respond input#submit, .woocommerce a.button, .woocommerce button.button, .woocommerce input.button,
    .single-product div.product .entry-summary .single_add_to_cart_button,
    .btn-primary.focus-visible, .btn-primary:focus, .btn-primary:hover,
    .onlineestore_banner_list .caption-content .btn.btn-primary:hover
    {

        border-color: $primary_color;

    }
    
    .store_products_item .flash > span.onnew::after{
        border-top-color: $primary_color;
    }
    \n";

$online_estore_primary_color .= "
    body.woocommerce-active ul.products li.product .woocommerce-loop-product__title:hover, 
    body.woocommerce-active ul.products li.product .woocommerce-loop-category__title:hover,

    body.woocommerce-active a.added_to_cart:hover, 
    body.woocommerce-active .woocommerce a.button.add_to_cart_button:hover, 
    body.woocommerce-active .woocommerce a.button.product_type_grouped:hover, 
    body.woocommerce-active .woocommerce a.button.product_type_external:hover, 
    body.woocommerce-active .woocommerce a.button.product_type_variable:hover,
    body.woocommerce-active ul.products li.product .price, 
    body.woocommerce-active .woocommerce div.product p.price, 
    body.woocommerce-active .woocommerce div.product span.price,
    body.woocommerce-active nav.woocommerce-pagination ul li .page-numbers,
    body.woocommerce-active .product_list_widget .woocommerce-Price-amount,
    body.woocommerce-active .woocommerce-page .star-rating span,
    body.woocommerce-active .woocommerce-message::before, 
    body.woocommerce-active .woocommerce-info::before,
    body.woocommerce-active .woocommerce-MyAccount-navigation ul li a:hover,
    body.woocommerce-active .woocommerce-MyAccount-content a:not(.button),
    .appzend_products_item_details h3 a:hover,
    .appzend_products_item_details .price, 
    .comment-form-rating p.stars a,
    .woocommerce #respond input#submit.alt:hover, .woocommerce a.button.alt:hover, .woocommerce button.button.alt:hover, .woocommerce input.button.alt:hover,
    .woocommerce #respond input#submit:hover, .woocommerce a.button:hover, .woocommerce button.button:hover, .woocommerce input.button:hover,
    .single-product div.product .entry-summary .single_add_to_cart_button:focus, .single-product div.product .entry-summary .single_add_to_cart_button:hover,
    .articlesListing .article .btns .btn:hover,
    .page-numbers.current,
    .page-numbers:hover,
    .breadcrumbs .trail-items li a,
    .post-navigation a span,
    a:hover, a:focus, a:active,
    .onlineestore_tabs_products .products_tabs ul li.active a, .onlineestore_tabs_products .products_tabs ul li:hover a, .online_estore_multiple_category_tabs_block .xstoretabs ul li:hover a, .online_estore_multiple_category_tabs_block .xstoretabs ul li.active a,
    .footer-copyright .onlineestore_copyright a,
    .arrow-top,
    .footer-socials ul li a:hover,
    .services_item .services_icon{
        color: $primary_color;
    }\n";

    $online_estore_primary_color .= "#back-to-top svg.progress-circle path{stroke: $primary_color; }";