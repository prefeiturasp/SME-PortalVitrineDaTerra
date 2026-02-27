<?php
/**
 * Functions which enhance the theme by hooking into WordPress
 *
 * @package Sparkle Themes
 *
 * @subpackage online-eStore
 *
 * @since 1.0.0
 *
 */

if ( ! function_exists( 'online_estore_get_logo' ) ){
    /**
     * Logo function.
     *
     * @since 1.0.0
     */
    function online_estore_get_logo(){ 
        $site_identity_alignment = get_theme_mod( 'online_estore_title_tagline_alignment' );
        $site_identity_alignment = json_decode( $site_identity_alignment, true );
        $class = array();
        // desktop align.
        $align_desktop = online_estore_responsive_button_value( $site_identity_alignment, 'desktop' );
        $class[] = 'text-'.$align_desktop ? 'text-'.$align_desktop : 'text-center';
        // tablet align.
        $align_tablet = online_estore_responsive_button_value( $site_identity_alignment, 'tablet' );
        $class[] = 'text-'.$align_tablet ? 'text-'.$align_tablet : 'text-center';
        // mobile align.
        $align_mobile = online_estore_responsive_button_value( $site_identity_alignment, 'mobile' );
        $class[] = "text-".$align_mobile ? "text-".$align_mobile : 'text-center';
      ?>

        <div class="site-branding <?php echo esc_attr( implode(" ", $class) ); ?>">

            <?php the_custom_logo(); ?>

            <h1 class="site-title">
                <a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home">
                    <?php bloginfo( 'name' ); ?>
                </a>
            </h1>
            <?php 
                $online_estore_description = get_bloginfo( 'description', 'display' );
                if ( $online_estore_description || is_customize_preview() ) :?>
                    <p class="site-description"><?php echo esc_html( $online_estore_description ); /* WPCS: xss ok. */ ?></p>
            <?php endif; ?>                 
        </div> <!-- .site-branding -->
        <?php
    }
}
add_action( 'title_tagline', 'online_estore_get_logo' );

/**
 * Slider with Vertical Category Menu
*/
if ( ! function_exists( 'online_estore_slider_vertical_menu' ) ){
    function online_estore_slider_vertical_menu(){ ?>
        <div class="container">
            <div class="onlineestore_slider_wrap">
                <div class="onlineestore_wrap_blank"></div>
                <div class="onlineestore_banner_promo_wrap">
                    <?php
                        $allbanners = get_theme_mod('online_estore_banner_slider_options');
                        
                        if(!empty( $allbanners )) {
                    ?>  
                        <div class="onlineestore_banner_list">
                            <ul class="slides">
                                <?php
                                    $allbanners = json_decode( $allbanners );

                                    foreach($allbanners as $singlebanner){ 

                                        $page_id = $singlebanner->slider_page;

                                    if( !empty( $page_id ) ) {

                                    $slider = new WP_Query( 'page_id='.$page_id );

                                    if( $slider->have_posts() ) { while( $slider->have_posts() ) { $slider->the_post();
                                    
                                    $image_path = wp_get_attachment_image_src( get_post_thumbnail_id(), 'full', true );

                                ?>
                                    <li class="bg-dark" style="background-image: url('<?php echo esc_url($image_path[0]); ?>');">
                                        <div class="home-slider-overlay"></div>
                                        <div class="banner-caption">
                                            <div class="caption-content">
                                                <div class="banner-title"><?php the_title(); ?></div>
                                                <div class="banner-desc"><p><?php echo esc_html( wp_trim_words( get_the_content(), 25 ) ); ?></p></div>
                                                <?php if( !empty( $singlebanner->button_text ) || !empty( $singlebanner->button_url ) ){ ?>
                                                    <div class="onlineestore_slider_button">
                                                        <a href="<?php echo esc_url( $singlebanner->button_url ); ?>" class="btn btn-primary">
                                                            <?php echo esc_html( $singlebanner->button_text ); ?>
                                                        </a>
                                                    </div>
                                                <?php } ?>
                                            </div>
                                        </div>
                                    </li>
                                <?php } } wp_reset_postdata(); } }  ?>
                            </ul>
                        </div>
                    <?php } ?>
                </div>
            </div>
        </div>
        <?php 
    }
}
add_action( 'online_estore_slider_vertical_menu', 'online_estore_slider_vertical_menu' );

/**
 * Full Width Slider
*/
if ( ! function_exists( 'online_estore_full_width_slider' ) ){
    
    function online_estore_full_width_slider(){ 

        $allbanners = get_theme_mod('online_estore_banner_slider_options');
        if(!empty( $allbanners )) { ?>
        
            <div class="onlineestore_banner_promo_wrap">
                <div class="onlineestore_banner_list">
                    <ul class="slides">
                        <?php
                            $allbanners = json_decode( $allbanners );

                            foreach($allbanners as $singlebanner){ 

                                $page_id = $singlebanner->slider_page;

                            if( !empty( $page_id ) ) {

                            $slider = new WP_Query( 'page_id='.$page_id );

                            if( $slider->have_posts() ) { while( $slider->have_posts() ) { $slider->the_post();
                            
                            $image_path = wp_get_attachment_image_src( get_post_thumbnail_id(), 'full', true );

                        ?>
                            <li class="bg-dark" style="background-image: url('<?php echo esc_url($image_path[0]); ?>');">
                                <div class="home-slider-overlay"></div>
                                <div class="banner-caption">
                                    <div class="caption-content">
                                        <div class="banner-title"><?php the_title(); ?></div>
                                        <div class="banner-desc"><p><?php echo esc_html( wp_trim_words( get_the_content(), 30 ) ); ?></p></div>
                                        <?php if( !empty( $singlebanner->button_text ) || !empty( $singlebanner->button_url ) ){ ?>
                                            <div class="onlineestore_slider_button">
                                                <a href="<?php echo esc_url( $singlebanner->button_url ); ?>" class="btn btn-primary">
                                                    <?php echo esc_html( $singlebanner->button_text ); ?>
                                                </a>
                                            </div>
                                        <?php } ?>
                                    </div>
                                </div>
                            </li>
                        <?php } } wp_reset_postdata(); } }  ?>
                    </ul>
                </div>
            </div>

        <?php }
    }
}
add_action( 'online_estore_full_width_slider', 'online_estore_full_width_slider' );


if ( ! function_exists( 'online_estore_services_area' ) ){
  
    function online_estore_services_area(){

        $servicesoptions = get_theme_mod('online_estore_quick_services_options', 'off');
        
        $servicesarea    = get_theme_mod('online_estore_quick_services_settings_options');

        if( !empty( $servicesoptions ) && $servicesoptions == 'on' ){

            if(!empty( $servicesarea )) { ?>
            
                <div class="services_wrapper">
                    <div class="container">
                        <div class="services_area">
                            <?php
                                $servicesarea = json_decode( $servicesarea );
                                foreach($servicesarea as $services){ 
                            ?>
                                <div class="services_item">

                                    <?php if( !empty( $services->services_icon ) ){ ?>
                                        <div class="services_icon">
                                            <span class="<?php echo esc_attr( $services->services_icon ); ?>"></span>
                                        </div>
                                    <?php } ?>

                                    <div class="services_content">

                                        <?php if( !empty( $services->services_title ) ){ ?>

                                            <h3><?php echo esc_html( $services->services_title ); ?></h3>

                                        <?php } if( !empty( $services->services_subtitle ) ){ ?>

                                            <p><?php echo esc_html( $services->services_subtitle ); ?></p>

                                        <?php } ?>
                                    </div>
                                </div>
                            <?php } ?>
                        </div>
                    </div>
                </div>

            <?php
            } 
        }
    }
}
add_action( 'online_estore_services_area', 'online_estore_services_area' );

                 
if ( ! function_exists( 'online_estore_post_meta' ) ){
    /**
     * Post Meta Function
     *
     * @since 1.0.0
    */
    function online_estore_post_meta() { 
        
        $postdate = get_theme_mod( 'online_estore_post_date_options', 'on' );
        $postcomment = get_theme_mod( 'online_estore_post_comments_options', 'on' );
        $postauthor = get_theme_mod( 'online_estore_post_author_options', 'on' );

      ?>

        <div class="site-entry-meta metainfo">
            <?php
                if( !empty( $postdate ) && $postdate == 'on' ) { online_estore_posted_on(); }
                if( !empty( $postauthor ) && $postauthor == 'on' ) { online_estore_posted_by(); }
                if( !empty( $postcomment ) && $postcomment == 'on' ) { online_estore_comments(); }
            ?>
        </div><!-- .entry-meta -->
       <?php
    }
}
add_action( 'online_estore_post_meta', 'online_estore_post_meta' , 10 );



if ( ! function_exists( 'online_estore_widget_block_padding' ) ){
    /**
     * Widget Block Padding
     *
     * @since 1.0.0
     */
    function online_estore_widget_block_padding( $top, $bottom ) { ?>

            style="padding-top:<?php echo intval( $top ) . 'px' ?>; padding-bottom: <?php echo intval( $bottom ) .'px'; ?>"
       
       <?php
    }
}

if( ! function_exists( 'online_estore_post_format_media' ) ) :

    /**
     * Posts format declaration function.
     *
     * @since 1.0.0
     */
    function online_estore_post_format_media( $postformat ) {

        global $post;

        if( is_singular( ) ){

          $imagesize = 'post-thumbnail';

        }else{

            $imagesize = '';
        }

        if ($postformat == "gallery") {

            if (function_exists('has_block') && has_block('gallery', $post->post_content)) {

                $post_blocks = parse_blocks($post->post_content);

                $key = array_search('core/gallery', array_column($post_blocks, 'blockName'));
                
                $gallery_attachment_ids = $post_blocks[$key]['attrs']['ids'];

            }else {
                
                $gallery = get_post_gallery( $post->ID, false );

                $gallery_attachment_ids = array();

                if( count($gallery) and isset($gallery['ids'])) {

                    $gallery_attachment_ids = explode ( ",", $gallery['ids'] );

                }
            }
            if ( ! empty( $gallery_attachment_ids ) ){ ?>

                
                <div class="blog-post-thumbnail">
                    <div class="postgallery-carousel cS-hidden">

                        <?php foreach ( $gallery_attachment_ids as $gallery_attachment_id ) { ?>
                            
                            <img src="<?php echo wp_get_attachment_image_url($gallery_attachment_id, 'post-thumbnail'); ?>"/>
                            
                        <?php } ?>

                    </div>
                </div>
                
            <?php } else { ?>
                
                <div class="blog-post-thumbnail">
                    <a class="post-thumbnail" href="<?php the_permalink(); ?>" aria-hidden="true" tabindex="-1">
                        <?php
                          the_post_thumbnail( $imagesize );
                        ?>
                    </a>
                </div>

            <?php } } else if( $postformat == "video" ){
            
              $get_content  = apply_filters( 'the_content', get_the_content() );
              $get_video    = get_media_embedded_in_content( $get_content, array( 'video', 'object', 'embed', 'iframe' ) );

              if( !empty( $get_video ) ){ ?>
                  <div class="blog-post-thumbnail">
                      <div class="video">
                          <?php echo $get_video[0]; // WPCS xss ok. ?>
                      </div>
                  </div>

            <?php }else{ ?>

                  <div class="blog-post-thumbnail">
                      <a class="post-thumbnail" href="<?php the_permalink(); ?>" aria-hidden="true" tabindex="-1">
                          <?php
                            the_post_thumbnail( $imagesize );
                          ?>
                      </a>
                  </div>

            <?php  } }else if( $postformat == "audio" ){

              $get_content  = apply_filters( 'the_content', get_the_content() );
              $get_audio    = get_media_embedded_in_content( $get_content, array( 'audio', 'iframe' ) );

              if( !empty( $get_audio ) ){ ?>

                  <div class="blog-post-thumbnail">
                      <div class="audio">
                          <?php echo $get_audio[0]; // WPCS xss ok. ?>
                      </div>
                  </div>

            <?php }else{  ?>

                  <div class="blog-post-thumbnail">
                      <a class="post-thumbnail" href="<?php the_permalink(); ?>" aria-hidden="true" tabindex="-1">
                          <?php
                            the_post_thumbnail( $imagesize );
                          ?>
                      </a>
                  </div>

            <?php } }else if( $postformat == "quote" ) { ?>

                <div class="blog-post-thumbnail">
                    <div class="post-format-media-quote">
                    <?php
                        if (function_exists('has_block') && has_block('quote', $post->post_content)) {
                            $post_blocks = parse_blocks($post->post_content);
                            $key = array_search('core/quote', array_column($post_blocks, 'blockName'));
                            $wuote_content = $post_blocks[$key];
                            echo $wuote_content['innerContent'][0];
                        }
                    ?>
                    </div>
                </div>

            <?php }else{ ?>

                  <div class="blog-post-thumbnail">
                        <a class="post-thumbnail" href="<?php the_permalink(); ?>" aria-hidden="true" tabindex="-1">
                            <?php the_post_thumbnail( $imagesize ); ?>
                        </a>
                  </div>
            <?php 
        }

    }

endif;


if( ! function_exists( 'online_estore_breadcrumb_header_title' ) ) :

    /**
     *
     * function display page & post title with breadcrumb menu.
     *
     * @since 1.0.0
    */

    function online_estore_breadcrumb_header_title() { 

        $breadcrumb_options = get_theme_mod( 'online_estore_breadcrumb_options','on' );
        $breadcrumb_nav = get_theme_mod( 'online_estore_breadcrumb_menu_options','on' );
        $blayout = get_theme_mod( 'online_estore_breadcrumbs_layout_options','layoutone' );
        
        if( !empty( $breadcrumb_options ) && $breadcrumb_options == 'on' ){ 

            if( !empty( $blayout ) && $blayout == 'layouttwo' ){
        ?>
            <div class="custom-header">
                <div class="container">
                    <div class="breadcrumb-wrap">
                        <?php 
                            if( is_single() || is_page() ) {

                                the_title( '<h2 class="entry-title wow zoomIn">', '</h2>' );

                            } elseif( is_product() || is_shop() ) { ?>

                                <h2 class="page-title wow zoomIn"><?php woocommerce_page_title(); ?></h2>

                            <?php } elseif( is_archive() ) {

                                the_archive_title( '<h2 class="page-title">', '</h2>' );
                                the_archive_description( '<div class="taxonomy-description">', '</div>' );

                            } elseif( is_search() ) { ?>

                                <h2 class="page-title wow zoomIn">
                                    <?php printf( wp_kses( 'Search Results for: %s', 'online-estore' ), '<span>' . get_search_query() . '</span>' ); ?>
                                </h2>

                            <?php } elseif( is_404() ) {

                                echo '<h2 class="entry-title wow zoomIn">'. esc_html__( '404 Error', 'online-estore' ) .'</h2>';

                            } elseif( is_home() ) {

                                $page_for_posts_id = get_option( 'page_for_posts' );
                                $page_title = get_the_title( $page_for_posts_id );

                        ?>

                            <h2 class="entry-title wow zoomIn"><?php echo esc_html( $page_title ); ?></h2>

                        <?php } if( !empty( $breadcrumb_nav ) && $breadcrumb_nav == 'on' ){ ?>

                            <nav id="breadcrumb" class="onlineestore-breadcrumb wow zoomIn">
                                <?php
                                    breadcrumb_trail( array(
                                        'container'   => 'div',
                                        'show_browse' => false,
                                    ) );
                                ?>
                            </nav> 

                        <?php } ?>
                    </div>
                </div>
            </div>

        <?php }else{ ?>
            
            <div class="container">
                <div class="custom-header <?php echo esc_attr( $blayout ); ?>">
                    <?php 
                        if( is_single() || is_page() ) {

                            the_title( '<h2 class="entry-title">', '</h2>' );

                        } elseif( class_exists('WooCommerce') && ( is_product() || is_shop() ) ) { ?>

                            <h2 class="page-title"><?php woocommerce_page_title(); ?></h2>

                        <?php } elseif( is_archive() ) {

                            the_archive_title( '<h2 class="page-title">', '</h2>' );
                            the_archive_description( '<div class="taxonomy-description">', '</div>' );

                        } elseif( is_search() ) { ?>

                            <h2 class="page-title">
                                    <?php printf( wp_kses( 'Search Results for: %s', 'online-estore' ), '<span>' . get_search_query() . '</span>' ); ?>
                            </h2>

                        <?php } elseif( is_404() ) {

                            echo '<h2 class="entry-title">'. esc_html__( '404 Error', 'online-estore' ) .'</h2>';

                        } elseif( is_home() ) {

                            $page_for_posts_id = get_option( 'page_for_posts' );
                            $page_title = get_the_title( $page_for_posts_id );

                    ?>
                        <h2 class="entry-title"><?php echo esc_html( $page_title ); ?></h2>

                    <?php } if( !empty( $breadcrumb_nav ) && $breadcrumb_nav == 'on' ){ ?>

                        <nav id="breadcrumb" class="onlineestore-breadcrumb">
                            <?php
                                breadcrumb_trail( array(
                                    'container'   => 'div',
                                    'show_browse' => false,
                                ) );
                            ?>
                        </nav> 

                    <?php } ?>
                </div>
            </div>

        <?php } } } 

    endif;
    
add_action( 'online_estore_breadcrumb_header', 'online_estore_breadcrumb_header_title', 10 );



if ( ! function_exists( 'online_estore_social_links' ) ) :
    /**
     * Social Meida Link 
     *
     * @since 1.0.0
     */
    function online_estore_social_links() { 
        $social_media_layout  = get_theme_mod( 'o_s_social_media_layout', 'style-one' );
        $social_icon_text_display     = get_theme_mod( 'o_s_enable_social_icon_text', false );
        $social_media_alignment = get_theme_mod( 'o_s_social_media_alignment', 'text-right' );
      ?>

        <ul class="onlineestore_socialmeida_link <?php echo esc_attr( $social_media_layout ); echo " "; echo esc_attr( $social_media_alignment ); ?>  ">

            <?php if ( esc_url( get_theme_mod('online_estore_social_facebook') ) ) : ?>
                <li>
                    <a href="<?php echo esc_url( get_theme_mod( 'online_estore_social_facebook' ) ); ?>" target="_blank">
                       <span class="socialtext">
                       <i class="fa fa-facebook-square"></i>
                       <?php 
                        if ( $social_icon_text_display ) 
                          esc_html_e('facebook','online-estore');
                       ?>
                        </span>
                    </a>
                </li>
            <?php endif;?>

            <?php if ( esc_url( get_theme_mod( 'online_estore_social_twitter' ) ) ) : ?>
                <li>
                    <a href="<?php echo esc_url( get_theme_mod( 'online_estore_social_twitter' ) ); ?>" target="_blank">
                       <span class="socialtext">
                            <i class="fa fa-twitter" aria-hidden="true"></i>
                           <?php 
                            if ( $social_icon_text_display ) 
                              esc_html_e('twitter','online-estore'); 
                           ?>
                    </span>
                    </a>
                </li>
            <?php endif;?>

            <?php if ( esc_url( get_theme_mod( 'online_estore_social_instagram' ) ) ) : ?>
                <li>
                    <a href="<?php echo esc_url( get_theme_mod( 'online_estore_social_instagram' ) ) ;?>" target="_blank">
                        <span class="socialtext">
                            <i class="fa fa-instagram" aria-hidden="true"></i>
                            <?php 
                              if ( $social_icon_text_display )
                                esc_html_e('instagram','online-estore'); 
                            ?>
                        </span>
                    </a>
                </li>
            <?php endif;?>

            <?php if ( esc_url( get_theme_mod( 'online_estore_social_pinterest' ) ) ) : ?>
                <li>
                    <a href="<?php echo esc_url( get_theme_mod( 'online_estore_social_pinterest' ) ); ?>" target="_blank">
                        <span class="socialtext">
                            <i class="fa fa-pinterest" aria-hidden="true"></i>
                            <?php 
                            if ( $social_icon_text_display )
                              esc_html_e('pinterest','online-estore'); 
                            ?>
                    </span>
                    </a>
                </li>
            <?php endif;?>

            <?php if ( esc_url( get_theme_mod( 'online_estore_social_youtube' ) ) ) : ?>
                <li>
                    <a href="<?php echo esc_url( get_theme_mod( 'online_estore_social_youtube' ) ); ?>" target="_blank">
                        <span class="socialtext">
                            <i class="fa fa-youtube" aria-hidden="true"></i>
                            <?php 
                              if ( $social_icon_text_display )
                                esc_html_e('youtube','online-estore'); 
                            ?>
                        </span>
                    </a>
                </li>
            <?php endif;?>
        </ul>
    <?php
    }
endif;
add_action( 'online_estore_social_media_link', 'online_estore_social_links' );


if ( ! function_exists( 'online_estore_quick_contact' ) ) :
    /**
     * Quick Contact Information Section
     *
     * @since 1.0.0
     */
    function online_estore_quick_contact(){

            $map_address                  = get_theme_mod( 'online_estore_quick_map_address' );
            $quick_email                  = get_theme_mod( 'online_estore_quick_email' );
            $quick_wroking                = get_theme_mod( 'online_estore_quick_working_hour' );
            $quick_phone                  = get_theme_mod( 'online_estore_quick_phone' );
            $phonenumber                  = preg_replace("/[^0-9]/","",$quick_phone);
            $header_quick_contact_layout  = get_theme_mod( 'header_quick_contact_layout', 'style-one' );
            $header_quick_contact_align   = json_decode( get_theme_mod( 'quick-contact-align' ), true );  
            $class = array();
            // desktop align.
            $align_desktop = online_estore_responsive_button_value( $header_quick_contact_align, 'desktop' );
            $class[] = 'text-'.$align_desktop ? 'text-'.$align_desktop : 'text-center';
            // tablet align.
            $align_tablet = online_estore_responsive_button_value( $header_quick_contact_align, 'tablet' );
            if($align_tablet)
              $class[] = 'text-'.$align_tablet ? 'text-'.$align_tablet : 'text-center';
            // mobile align.
            $align_mobile = online_estore_responsive_button_value( $header_quick_contact_align, 'mobile' );
            if($align_mobile)
              $class[] = "text-".$align_mobile ? "text-".$align_mobile : 'text-center';                          
        ?>
            <ul class="online-estore-quick-contact <?php echo esc_attr( implode(" ", $class) ); ?> <?php echo esc_attr( $header_quick_contact_layout ); ?>">
                <?php if( !empty( $quick_phone ) ) { ?>
                    
                    <li>
                        
                        <span> <i class="fa fa-volume-control-phone" aria-hidden="true"></i><?php esc_html_e('Call Us Now :', 'online-estore');?> </span>
                        <a href="tel:<?php echo esc_attr( $phonenumber ); ?>"><?php echo esc_html( $quick_phone ); ?></a>
                    </li>
                <?php } if( !empty( $quick_email ) ) { ?>
                    <li>
                      
                        <span>   <i class="fa fa-envelope-open"></i><?php esc_html_e('Email :', 'online-estore'); ?> </span>
                        <a href="mailto:'<?php echo esc_attr( antispambot( $quick_email ) ); ?>"><?php echo esc_html( antispambot( $quick_email ) ); ?></a>
                    </li>
                <?php } if( !empty( $map_address ) ) { ?>
                    <li>
                      
                        <span>   <i class="fa fa-map-marker"></i> <?php esc_html_e('Address :', 'online-estore'); ?> </span>
                        <a target="_blank" href="https://www.google.com.np/maps/place/<?php echo esc_attr( $map_address ); ?>">
                            <?php echo esc_html( $map_address ); ?>
                        </a>
                    </li>
                <?php } if( !empty( $quick_wroking ) ) { ?>
                    <li>
                       
                        <span>  <i class="fa fa-clock-o" aria-hidden="true"></i><?php esc_html_e('We are open :', 'online-estore'); ?></span>
                        <?php echo esc_html( $quick_wroking ); ?>
                    </li>
                <?php } ?>
            </ul>
        <?php
    }
endif;
add_action( 'online_estore_header_quickinfo', 'online_estore_quick_contact' );


if ( ! function_exists( 'online_estore_footer_copyright' ) ){

    /**
     * Footer Copyright Information
     *
     * @since 1.0.0
     */
    function online_estore_footer_copyright() {

        $copyright = get_theme_mod( 'online_estore_footer_section_options' ); 

        if( !empty( $copyright ) ) { 

            echo esc_html( apply_filters( 'online_estore_copyright_text', $copyright ) ); 

        } else { 

            echo esc_html( apply_filters( 'online_estore_copyright_text', $content = esc_html__('Copyright  &copy; ','online-estore') . date( 'Y' ) . ' ' . get_bloginfo( 'name' ) .' - ' ) );
        }

         printf( ' WordPress Theme : by %1$s', '<a href=" ' . esc_url('https://sparklewp.com/') . ' " rel="designer" target="_blank">'.esc_html__('Sparkle WP','online-estore').'</a>' );
    }
}
add_action( 'online_estore_copyright', 'online_estore_footer_copyright', 5 );


if ( ! function_exists( 'online_estore_dynamic_preloader' ) ) {

    /**
    * Preloader Frontend Section area
    */
    function online_estore_dynamic_preloader() {

        $preloader = get_theme_mod( 'online_estore_preloader', 'default' ); 

        if( isset( $preloader ) && $preloader != '' ) { ?>

            <style type='text/css'>
                .no-js #loader {
                    display: none; 
                }
                .js #loader { 
                    display: block;
                    position: absolute; 
                    left: 100px; 
                    top: 0; 
                }
                .preloader {
                    position: fixed;
                    left: 0px;
                    top: 0px;
                    width: 100%;
                    height: 100%;
                    z-index: 9999999;
                    background: url('<?php echo esc_url( get_template_directory_uri() )."/assets/images/preloader/".esc_attr( $preloader ).".gif"; ?>') center no-repeat #fff;
                }
            </style>

        <?php  }
    }

}
add_action( 'wp_head', 'online_estore_dynamic_preloader');


if( !function_exists('online_estore_preloader')){
    /**
     * Pre Loader Load on Front
    */
    function online_estore_preloader(){
        $preloader = esc_attr( get_theme_mod( 'online_estore_preloader_section_options', 'off' ) ); 
        if( $preloader == 'on' ) { 
    ?>

          <div class="preloader"></div>

    <?php }

    }
}
add_action('wp_head', 'online_estore_preloader', 25);



if( !function_exists( 'online_estore_categories_lists' ) ) :

    /**
     * Category list
     *
     * @return array();
     */

    function online_estore_categories_lists() {

        $online_estore_categories = get_categories( array( 'hide_empty' => 1 ) );

        $online_estore_categories_lists = array();

        foreach( $online_estore_categories as $category ) {

            $online_estore_categories_lists[$category->term_id] = $category->name;
        }

        return $online_estore_categories_lists;
    }
endif;

if(!function_exists('online_estore_font_awesome_icon_array')){

    function online_estore_font_awesome_icon_array(){

        return array("fa fa-glass","fa fa-music","fa fa-search","fa fa-envelope-o","fa fa-heart","fa fa-star","fa fa-star-o","fa fa-user","fa fa-film","fa fa-th-large","fa fa-th","fa fa-th-list","fa fa-check","fa fa-remove","fa fa-close","fa fa-times","fa fa-search-plus","fa fa-search-minus","fa fa-power-off","fa fa-signal","fa fa-gear","fa fa-cog","fa fa-trash-o","fa fa-home","fa fa-file-o","fa fa-clock-o","fa fa-road","fa fa-download","fa fa-arrow-circle-o-down","fa fa-arrow-circle-o-up","fa fa-inbox","fa fa-play-circle-o","fa fa-rotate-right","fa fa-repeat","fa fa-refresh","fa fa-list-alt","fa fa-lock","fa fa-flag","fa fa-headphones","fa fa-volume-off","fa fa-volume-down","fa fa-volume-up","fa fa-qrcode","fa fa-barcode","fa fa-tag","fa fa-tags","fa fa-book","fa fa-bookmark","fa fa-print","fa fa-camera","fa fa-font","fa fa-bold","fa fa-italic","fa fa-text-height","fa fa-text-width","fa fa-align-left","fa fa-align-center","fa fa-align-right","fa fa-align-justify","fa fa-list","fa fa-dedent","fa fa-outdent","fa fa-indent","fa fa-video-camera","fa fa-photo","fa fa-image","fa fa-picture-o","fa fa-pencil","fa fa-map-marker","fa fa-adjust","fa fa-tint","fa fa-edit","fa fa-pencil-square-o","fa fa-share-square-o","fa fa-check-square-o","fa fa-arrows","fa fa-step-backward","fa fa-fast-backward","fa fa-backward","fa fa-play","fa fa-pause","fa fa-stop","fa fa-forward","fa fa-fast-forward","fa fa-step-forward","fa fa-eject","fa fa-chevron-left","fa fa-chevron-right","fa fa-plus-circle","fa fa-minus-circle","fa fa-times-circle","fa fa-check-circle","fa fa-question-circle","fa fa-info-circle","fa fa-crosshairs","fa fa-times-circle-o","fa fa-check-circle-o","fa fa-ban","fa fa-arrow-left","fa fa-arrow-right","fa fa-arrow-up","fa fa-arrow-down","fa fa-mail-forward","fa fa-share","fa fa-expand","fa fa-compress","fa fa-plus","fa fa-minus","fa fa-asterisk","fa fa-exclamation-circle","fa fa-gift","fa fa-leaf","fa fa-fire","fa fa-eye","fa fa-eye-slash","fa fa-warning","fa fa-exclamation-triangle","fa fa-plane","fa fa-calendar","fa fa-random","fa fa-comment","fa fa-magnet","fa fa-chevron-up","fa fa-chevron-down","fa fa-retweet","fa fa-shopping-cart","fa fa-folder","fa fa-folder-open","fa fa-arrows-v","fa fa-arrows-h","fa fa-bar-chart-o","fa fa-bar-chart","fa fa-twitter-square","fa fa-facebook-square","fa fa-camera-retro","fa fa-key","fa fa-gears","fa fa-cogs","fa fa-comments","fa fa-thumbs-o-up","fa fa-thumbs-o-down","fa fa-star-half","fa fa-heart-o","fa fa-sign-out","fa fa-linkedin-square","fa fa-thumb-tack","fa fa-external-link","fa fa-sign-in","fa fa-trophy","fa fa-github-square","fa fa-upload","fa fa-lemon-o","fa fa-phone","fa fa-square-o","fa fa-bookmark-o","fa fa-phone-square","fa fa-twitter","fa fa-facebook-f","fa fa-facebook","fa fa-github","fa fa-unlock","fa fa-credit-card","fa fa-feed","fa fa-rss","fa fa-hdd-o","fa fa-bullhorn","fa fa-bell","fa fa-certificate","fa fa-hand-o-right","fa fa-hand-o-left","fa fa-hand-o-up","fa fa-hand-o-down","fa fa-arrow-circle-left","fa fa-arrow-circle-right","fa fa-arrow-circle-up","fa fa-arrow-circle-down","fa fa-globe","fa fa-wrench","fa fa-tasks","fa fa-filter","fa fa-briefcase","fa fa-arrows-alt","fa fa-group","fa fa-users","fa fa-chain","fa fa-link","fa fa-cloud","fa fa-flask","fa fa-cut","fa fa-scissors","fa fa-copy","fa fa-files-o","fa fa-paperclip","fa fa-save","fa fa-floppy-o","fa fa-square","fa fa-navicon","fa fa-reorder","fa fa-bars","fa fa-list-ul","fa fa-list-ol","fa fa-strikethrough","fa fa-underline","fa fa-table","fa fa-magic","fa fa-truck","fa fa-pinterest","fa fa-pinterest-square","fa fa-google-plus-square","fa fa-google-plus","fa fa-money","fa fa-caret-down","fa fa-caret-up","fa fa-caret-left","fa fa-caret-right","fa fa-columns","fa fa-unsorted","fa fa-sort","fa fa-sort-down","fa fa-sort-desc","fa fa-sort-up","fa fa-sort-asc","fa fa-envelope","fa fa-linkedin","fa fa-rotate-left","fa fa-undo","fa fa-legal","fa fa-gavel","fa fa-dashboard","fa fa-tachometer","fa fa-comment-o","fa fa-comments-o","fa fa-flash","fa fa-bolt","fa fa-sitemap","fa fa-umbrella","fa fa-paste","fa fa-clipboard","fa fa-lightbulb-o","fa fa-exchange","fa fa-cloud-download","fa fa-cloud-upload","fa fa-user-md","fa fa-stethoscope","fa fa-suitcase","fa fa-bell-o","fa fa-coffee","fa fa-cutlery","fa fa-file-text-o","fa fa-building-o","fa fa-hospital-o","fa fa-ambulance","fa fa-medkit","fa fa-fighter-jet","fa fa-beer","fa fa-h-square","fa fa-plus-square","fa fa-angle-double-left","fa fa-angle-double-right","fa fa-angle-double-up","fa fa-angle-double-down","fa fa-angle-left","fa fa-angle-right","fa fa-angle-up","fa fa-angle-down","fa fa-desktop","fa fa-laptop","fa fa-tablet","fa fa-mobile-phone","fa fa-mobile","fa fa-circle-o","fa fa-quote-left","fa fa-quote-right","fa fa-spinner","fa fa-circle","fa fa-mail-reply","fa fa-reply","fa fa-github-alt","fa fa-folder-o","fa fa-folder-open-o","fa fa-smile-o","fa fa-frown-o","fa fa-meh-o","fa fa-gamepad","fa fa-keyboard-o","fa fa-flag-o","fa fa-flag-checkered","fa fa-terminal","fa fa-code","fa fa-mail-reply-all","fa fa-reply-all","fa fa-star-half-empty","fa fa-star-half-full","fa fa-star-half-o","fa fa-location-arrow","fa fa-crop","fa fa-code-fork","fa fa-unlink","fa fa-chain-broken","fa fa-question","fa fa-info","fa fa-exclamation","fa fa-superscript","fa fa-subscript","fa fa-eraser","fa fa-puzzle-piece","fa fa-microphone","fa fa-microphone-slash","fa fa-shield","fa fa-calendar-o","fa fa-fire-extinguisher","fa fa-rocket","fa fa-maxcdn","fa fa-chevron-circle-left","fa fa-chevron-circle-right","fa fa-chevron-circle-up","fa fa-chevron-circle-down","fa fa-html5","fa fa-css3","fa fa-anchor","fa fa-unlock-alt","fa fa-bullseye","fa fa-ellipsis-h","fa fa-ellipsis-v","fa fa-rss-square","fa fa-play-circle","fa fa-ticket","fa fa-minus-square","fa fa-minus-square-o","fa fa-level-up","fa fa-level-down","fa fa-check-square","fa fa-pencil-square","fa fa-external-link-square","fa fa-share-square","fa fa-compass","fa fa-toggle-down","fa fa-caret-square-o-down","fa fa-toggle-up","fa fa-caret-square-o-up","fa fa-toggle-right","fa fa-caret-square-o-right","fa fa-euro","fa fa-eur","fa fa-gbp","fa fa-dollar","fa fa-usd","fa fa-rupee","fa fa-inr","fa fa-cny","fa fa-rmb","fa fa-yen","fa fa-jpy","fa fa-ruble","fa fa-rouble","fa fa-rub","fa fa-won","fa fa-krw","fa fa-bitcoin","fa fa-btc","fa fa-file","fa fa-file-text","fa fa-sort-alpha-asc","fa fa-sort-alpha-desc","fa fa-sort-amount-asc","fa fa-sort-amount-desc","fa fa-sort-numeric-asc","fa fa-sort-numeric-desc","fa fa-thumbs-up","fa fa-thumbs-down","fa fa-youtube-square","fa fa-youtube","fa fa-xing","fa fa-xing-square","fa fa-youtube-play","fa fa-dropbox","fa fa-stack-overflow","fa fa-instagram","fa fa-flickr","fa fa-adn","fa fa-bitbucket","fa fa-bitbucket-square","fa fa-tumblr","fa fa-tumblr-square","fa fa-long-arrow-down","fa fa-long-arrow-up","fa fa-long-arrow-left","fa fa-long-arrow-right","fa fa-apple","fa fa-windows","fa fa-android","fa fa-linux","fa fa-dribbble","fa fa-skype","fa fa-foursquare","fa fa-trello","fa fa-female","fa fa-male","fa fa-gittip","fa fa-gratipay","fa fa-sun-o","fa fa-moon-o","fa fa-archive","fa fa-bug","fa fa-vk","fa fa-weibo","fa fa-renren","fa fa-pagelines","fa fa-stack-exchange","fa fa-arrow-circle-o-right","fa fa-arrow-circle-o-left","fa fa-toggle-left","fa fa-caret-square-o-left","fa fa-dot-circle-o","fa fa-wheelchair","fa fa-vimeo-square","fa fa-turkish-lira","fa fa-try","fa fa-plus-square-o","fa fa-space-shuttle","fa fa-slack","fa fa-envelope-square","fa fa-wordpress","fa fa-openid","fa fa-institution","fa fa-bank","fa fa-university","fa fa-mortar-board","fa fa-graduation-cap","fa fa-yahoo","fa fa-google","fa fa-reddit","fa fa-reddit-square","fa fa-stumbleupon-circle","fa fa-stumbleupon","fa fa-delicious","fa fa-digg","fa fa-pied-piper-pp","fa fa-pied-piper-alt","fa fa-drupal","fa fa-joomla","fa fa-language","fa fa-fax","fa fa-building","fa fa-child","fa fa-paw","fa fa-spoon","fa fa-cube","fa fa-cubes","fa fa-behance","fa fa-behance-square","fa fa-steam","fa fa-steam-square","fa fa-recycle","fa fa-automobile","fa fa-car","fa fa-cab","fa fa-taxi","fa fa-tree","fa fa-spotify","fa fa-deviantart","fa fa-soundcloud","fa fa-database","fa fa-file-pdf-o","fa fa-file-word-o","fa fa-file-excel-o","fa fa-file-powerpoint-o","fa fa-file-photo-o","fa fa-file-picture-o","fa fa-file-image-o","fa fa-file-zip-o","fa fa-file-archive-o","fa fa-file-sound-o","fa fa-file-audio-o","fa fa-file-movie-o","fa fa-file-video-o","fa fa-file-code-o","fa fa-vine","fa fa-codepen","fa fa-jsfiddle","fa fa-life-bouy","fa fa-life-buoy","fa fa-life-saver","fa fa-support","fa fa-life-ring","fa fa-circle-o-notch","fa fa-ra","fa fa-resistance","fa fa-rebel","fa fa-ge","fa fa-empire","fa fa-git-square","fa fa-git","fa fa-y-combinator-square","fa fa-yc-square","fa fa-hacker-news","fa fa-tencent-weibo","fa fa-qq","fa fa-wechat","fa fa-weixin","fa fa-send","fa fa-paper-plane","fa fa-send-o","fa fa-paper-plane-o","fa fa-history","fa fa-circle-thin","fa fa-header","fa fa-paragraph","fa fa-sliders","fa fa-share-alt","fa fa-share-alt-square","fa fa-bomb","fa fa-soccer-ball-o","fa fa-futbol-o","fa fa-tty","fa fa-binoculars","fa fa-plug","fa fa-slideshare","fa fa-twitch","fa fa-yelp","fa fa-newspaper-o","fa fa-wifi","fa fa-calculator","fa fa-paypal","fa fa-google-wallet","fa fa-cc-visa","fa fa-cc-mastercard","fa fa-cc-discover","fa fa-cc-amex","fa fa-cc-paypal","fa fa-cc-stripe","fa fa-bell-slash","fa fa-bell-slash-o","fa fa-trash","fa fa-copyright","fa fa-at","fa fa-eyedropper","fa fa-paint-brush","fa fa-birthday-cake","fa fa-area-chart","fa fa-pie-chart","fa fa-line-chart","fa fa-lastfm","fa fa-lastfm-square","fa fa-toggle-off","fa fa-toggle-on","fa fa-bicycle","fa fa-bus","fa fa-ioxhost","fa fa-angellist","fa fa-cc","fa fa-shekel","fa fa-sheqel","fa fa-ils","fa fa-meanpath","fa fa-buysellads","fa fa-connectdevelop","fa fa-dashcube","fa fa-forumbee","fa fa-leanpub","fa fa-sellsy","fa fa-shirtsinbulk","fa fa-simplybuilt","fa fa-skyatlas","fa fa-cart-plus","fa fa-cart-arrow-down","fa fa-diamond","fa fa-ship","fa fa-user-secret","fa fa-motorcycle","fa fa-street-view","fa fa-heartbeat","fa fa-venus","fa fa-mars","fa fa-mercury","fa fa-intersex","fa fa-transgender","fa fa-transgender-alt","fa fa-venus-double","fa fa-mars-double","fa fa-venus-mars","fa fa-mars-stroke","fa fa-mars-stroke-v","fa fa-mars-stroke-h","fa fa-neuter","fa fa-genderless","fa fa-facebook-official","fa fa-pinterest-p","fa fa-whatsapp","fa fa-server","fa fa-user-plus","fa fa-user-times","fa fa-hotel","fa fa-bed","fa fa-viacoin","fa fa-train","fa fa-subway","fa fa-medium","fa fa-yc","fa fa-y-combinator","fa fa-optin-monster","fa fa-opencart","fa fa-expeditedssl","fa fa-battery-4","fa fa-battery-full","fa fa-battery-3","fa fa-battery-three-quarters","fa fa-battery-2","fa fa-battery-half","fa fa-battery-1","fa fa-battery-quarter","fa fa-battery-0","fa fa-battery-empty","fa fa-mouse-pointer","fa fa-i-cursor","fa fa-object-group","fa fa-object-ungroup","fa fa-sticky-note","fa fa-sticky-note-o","fa fa-cc-jcb","fa fa-cc-diners-club","fa fa-clone","fa fa-balance-scale","fa fa-hourglass-o","fa fa-hourglass-1","fa fa-hourglass-start","fa fa-hourglass-2","fa fa-hourglass-half","fa fa-hourglass-3","fa fa-hourglass-end","fa fa-hourglass","fa fa-hand-grab-o","fa fa-hand-rock-o","fa fa-hand-stop-o","fa fa-hand-paper-o","fa fa-hand-scissors-o","fa fa-hand-lizard-o","fa fa-hand-spock-o","fa fa-hand-pointer-o","fa fa-hand-peace-o","fa fa-trademark","fa fa-registered","fa fa-creative-commons","fa fa-gg","fa fa-gg-circle","fa fa-tripadvisor","fa fa-odnoklassniki","fa fa-odnoklassniki-square","fa fa-get-pocket","fa fa-wikipedia-w","fa fa-safari","fa fa-chrome","fa fa-firefox","fa fa-opera","fa fa-internet-explorer","fa fa-tv","fa fa-television","fa fa-contao","fa fa-500px","fa fa-amazon","fa fa-calendar-plus-o","fa fa-calendar-minus-o","fa fa-calendar-times-o","fa fa-calendar-check-o","fa fa-industry","fa fa-map-pin","fa fa-map-signs","fa fa-map-o","fa fa-map","fa fa-commenting","fa fa-commenting-o","fa fa-houzz","fa fa-vimeo","fa fa-black-tie","fa fa-fonticons","fa fa-reddit-alien","fa fa-edge","fa fa-credit-card-alt","fa fa-codiepie","fa fa-modx","fa fa-fort-awesome","fa fa-usb","fa fa-product-hunt","fa fa-mixcloud","fa fa-scribd","fa fa-pause-circle","fa fa-pause-circle-o","fa fa-stop-circle","fa fa-stop-circle-o","fa fa-shopping-bag","fa fa-shopping-basket","fa fa-hashtag","fa fa-bluetooth","fa fa-bluetooth-b","fa fa-percent","fa fa-gitlab","fa fa-wpbeginner","fa fa-wpforms","fa fa-envira","fa fa-universal-access","fa fa-wheelchair-alt","fa fa-question-circle-o","fa fa-blind","fa fa-audio-description","fa fa-volume-control-phone","fa fa-braille","fa fa-assistive-listening-systems","fa fa-asl-interpreting","fa fa-american-sign-language-interpreting","fa fa-deafness","fa fa-hard-of-hearing","fa fa-deaf","fa fa-glide","fa fa-glide-g","fa fa-signing","fa fa-sign-language","fa fa-low-vision","fa fa-viadeo","fa fa-viadeo-square","fa fa-snapchat","fa fa-snapchat-ghost","fa fa-snapchat-square","fa fa-pied-piper","fa fa-first-order","fa fa-yoast","fa fa-themeisle","fa fa-google-plus-circle","fa fa-google-plus-official","fa fa-fa","fa fa-font-awesome");
    }
}



if( class_exists( 'WP_Customize_control' ) ) { 

    /**
     * Site Preloader Image
     *
     * @since 1.0.0
    */

    class Online_eStore_Customize_Preloader_Control extends WP_Customize_Control {

        public function render_content() {
            $preloaders = array( 'default', 'coffee', 'grid', 'list', 'rhombus', 'setting', 'square', 'text', 'rhombu' );
            if ( empty( $preloaders ) )
            return;
        ?>
            <label>
                <?php if ( ! empty( $this->label ) ) : ?>

                <span class="customize-control-title"><?php echo esc_html( $this->label ); ?></span>

                <?php endif;

                if ( ! empty( $this->description ) ) : ?>
                    <span class="description customize-control-description"><?php echo esc_html( $this->description ); ?></span>
                <?php endif; ?>

                  <div class="onlineestore-preloader-container">
                      <?php foreach($preloaders as $preloader) : ?>
                          <span class="onlineestore-preloader <?php if( $preloader == $this->value() ){ echo esc_attr( "active" ); } ?>" preloader="<?php echo esc_attr( $preloader ); ?>">
                              <img src="<?php echo esc_url( get_template_directory_uri() ).'/assets/images/preloader/'.esc_html( $preloader ).'.gif'; ?>" />
                          </span>
                      <?php endforeach; ?>
                  </div>
                  <input type="hidden" <?php $this->input_attrs(); ?> value="<?php echo esc_attr( $this->value() ); ?>" <?php $this->link(); ?> />
            </label>
        <?php
        }
    }

    /**
     * Repeater Custom Control Function
     *
     * @since 1.0.0
    */
    class Online_Estore_Repeater_Controler extends WP_Customize_Control {
        /**
        * The control type.
        *
        * @access public
        * @var string
        */
        public $type = 'repeater';

        public $online_estore_box_label = '';

        public $online_estore_box_add_control = '';

        private $cats = '';

        /**
        * The fields that each container row will contain.
        *
        * @access public
        * @var array
        */
        public $fields = array();

        /**
        * Repeater drag and drop controler
        *
        * @since  1.0.0
        */
        public function __construct( $manager, $id, $args = array(), $fields = array() ) {
            $this->fields = $fields;
            $this->online_estore_box_label = $args['online_estore_box_label'] ;
            $this->online_estore_box_add_control = $args['online_estore_box_add_control'];
            $this->cats = get_categories(array( 'hide_empty' => false ));
            parent::__construct( $manager, $id, $args );
        }

        public function render_content() {

            $values = json_decode($this->value());

            ?>

            <span class="customize-control-title"><?php echo esc_html( $this->label ); ?></span>
            
            <?php if($this->description){ ?>
                <span class="description customize-control-description">
                    <?php echo wp_kses_post($this->description); ?>
                </span>
            <?php } ?>

            <ul class="onlineestore-repeater-field-control-wrap">
                <?php $this->online_estore_get_fields(); ?>
            </ul>

            <input type="hidden" <?php esc_attr( $this->link() ); ?> class="onlineestore-repeater-collector" value="<?php echo esc_attr( $this->value() ); ?>" />
            <button type="button" class="button onlineestore-add-control-field"><?php echo esc_html( $this->online_estore_box_add_control ); ?></button>
            <?php
        }

        private function online_estore_get_fields(){
            $fields = $this->fields;
            $values = json_decode($this->value());
            if(is_array($values)){
            foreach($values as $value){  ?>
                <li class="onlineestore-repeater-field-control">
                    <h3 class="onlineestore-repeater-field-title accordion-section-title"><?php echo esc_html( $this->online_estore_box_label ); ?></h3>
                    <div class="onlineestore-repeater-fields">
                        <?php
                            foreach ($fields as $key => $field) {
                            $class = isset( $field['class'] ) ? $field['class'] : '';
                        ?>
                            <div class="onlineestore-fields onlineestore-type-<?php echo esc_attr( $field['type'] ).' '.esc_attr( $class ); ?>">
                                <?php

                                    $label = isset($field['label']) ? $field['label'] : '';

                                    $description = isset($field['description']) ? $field['description'] : '';

                                    if($field['type'] != 'checkbox'){ ?>
                                        <span class="customize-control-title"><?php echo esc_html( $label ); ?></span>
                                        <span class="description customize-control-description"><?php echo esc_html( $description ); ?></span>
                                <?php }

                                $new_value = isset($value->$key) ? $value->$key : '';

                                $default = isset($field['default']) ? $field['default'] : '';

                                switch ( $field['type'] ) {

                                    case 'text':
                                        echo '<input data-default="'.esc_attr($default).'" data-name="'.esc_attr($key).'" type="text" value="'.esc_attr($new_value).'"/>';
                                        break;

                                    case 'textarea':
                                        echo '<textarea data-default="'.esc_attr($default).'"  data-name="'.esc_attr($key).'">'.esc_textarea($new_value).'</textarea>';
                                        break;

                                    case 'select':
                                        $options = $field['options'];
                                        echo '<select  data-default="'.esc_attr($default).'"  data-name="'.esc_attr($key).'">';
                                              foreach ( $options as $option => $val )
                                              {
                                                  printf('<option value="%s" %s>%s</option>', esc_attr($option), selected($new_value, $option, false), esc_html($val));
                                              }
                                        echo '</select>';
                                        break;

                                    case 'upload':

                                        $image = $image_class= "";

                                        if($new_value){
                                            $image = '<img src="'.esc_url($new_value).'" style="max-width:100%;"/>';
                                            $image_class = ' hidden';
                                        }
                                        echo '<div class="onlineestore-fields-wrap">';
                                            echo '<div class="attachment-media-view">';
                                                echo '<div class="placeholder'.esc_attr( $image_class ).'">';
                                                    esc_html_e('No image selected', 'online-estore');
                                                echo '</div>';
                                                echo '<div class="thumbnail thumbnail-image">';
                                                    echo wp_kses( $image );
                                                echo '</div>';
                                                echo '<div class="actions clearfix">';
                                                    echo '<button type="button" class="button onlineestore-delete-button align-left">'.esc_html__('Remove', 'online-estore').'</button>';
                                                    echo '<button type="button" class="button onlineestore-upload-button alignright">'.esc_html__('Select Image', 'online-estore').'</button>';
                                                    echo '<input data-default="'.esc_attr($default).'" class="upload-id" data-name="'.esc_attr( $key ).'" type="hidden" value="'.esc_attr($new_value).'"/>';
                                                echo '</div>';
                                            echo '</div>';
                                        echo '</div>';
                                        break;

                                    case 'icon':
                                        echo '<div class="onlineestore-selected-icon">';
                                            echo '<i class="'.esc_html($new_value).'"></i>';
                                            echo '<span><i class="fa fa-angle-down"></i></span>';
                                        echo '</div>';
                                        echo '<ul class="onlineestore-icon-list clearfix">';
                                            $online_estore_font_awesome_icon_array = online_estore_font_awesome_icon_array();
                                            foreach ($online_estore_font_awesome_icon_array as $online_estore_font_awesome_icon) {
                                                $icon_class = $new_value == $online_estore_font_awesome_icon ? 'icon-active' : '';
                                                echo '<li class='.esc_attr( $icon_class ).'><i class="'.esc_attr( $online_estore_font_awesome_icon ).'"></i></li>';
                                            }
                                        echo '</ul>';
                                        echo '<input data-default="'.esc_attr($default).'" type="hidden" value="'.esc_attr($new_value).'" data-name="'.esc_attr($key).'"/>';
                                        break;

                                    default:

                                        break;
                                }
                              ?>
                            </div>

                        <?php } ?>

                        <div class="clearfix onlineestore-repeater-footer">
                            <div class="alignright">
                                <a class="onlineestore-repeater-field-remove" href="#remove"><?php esc_html_e('Delete', 'online-estore') ?></a> |
                                <a class="onlineestore-repeater-field-close" href="#close"><?php esc_html_e('Close', 'online-estore') ?></a>
                            </div>
                        </div>
                    </div>
                </li>
                <?php } 
            } 
        }
    }

   /**
     * Switch Controller ( Enable or Disable )
     *
     * @since 1.0.0
    */

    class Online_eStore_Switch_Control extends WP_Customize_Control{

        public $type = 'switch';

        public $on_off_label = array();

        public function __construct($manager, $id, $args = array() ){
            $this->on_off_label = $args['on_off_label'];
            parent::__construct( $manager, $id, $args );
        }

        public function render_content(){
        ?>
            <span class="customize-control-title">
                <?php echo esc_html( $this->label ); ?>
            </span>

            <?php if($this->description){ ?>
                <span class="description customize-control-description">
                	<?php echo wp_kses_post($this->description); ?>
                </span>
            <?php } ?>

            <?php
                $switch_class = ($this->value() == 'on') ? 'switch-on' : '';
                $on_off_label = $this->on_off_label;
            ?>
            <div class="onoffswitch <?php echo esc_attr( $switch_class ); ?>">
                <div class="onoffswitch-inner">
                    <div class="onoffswitch-active">
                        <div class="onoffswitch-switch"><?php echo esc_html($on_off_label['on']) ?></div>
                    </div>

                    <div class="onoffswitch-inactive">
                        <div class="onoffswitch-switch"><?php echo esc_html($on_off_label['off']) ?></div>
                    </div>
                </div>  
            </div>
            <input <?php $this->link(); ?> type="hidden" value="<?php echo esc_attr($this->value()); ?>"/>
            <?php
        }
    }

    /**
     * Select Single Category Controller
     *
     * @since 1.0.0
    */

    class Online_Estore_Customize_Dropdown_Taxonomies_Control extends WP_Customize_Control {

      public $type = 'dropdown-taxonomies';

      public $taxonomy = '';


        public function __construct( $manager, $id, $args = array() ) {

            $our_taxonomy = 'category';

            if ( isset( $args['taxonomy'] ) ) {

                $taxonomy_exist = taxonomy_exists( esc_attr( $args['taxonomy'] ) );

                if ( true === $taxonomy_exist ) {

                    $our_taxonomy = esc_attr( $args['taxonomy'] );

                }
            }

            $args['taxonomy'] = $our_taxonomy;

            $this->taxonomy = esc_attr( $our_taxonomy );

            parent::__construct( $manager, $id, $args );

        }

        public function render_content() {

        $tax_args = array(
          'hierarchical' => 0,
          'taxonomy'     => $this->taxonomy,
        );

        $all_taxonomies = get_categories( $tax_args );

        ?>
            <label>
              <span class="customize-control-title"><?php echo esc_html( $this->label ); ?></span>
                 <select <?php echo esc_url( $this->link() ); ?>>
                    <?php
                      printf('<option value="%1$s" %2$s>%3$s</option>', '', selected($this->value(), '', false), esc_html__('Select Single Category', 'online-estore') );
                    ?>
                    <?php if ( ! empty( $all_taxonomies ) ): ?>
                      <?php foreach ( $all_taxonomies as $key => $tax ): ?>
                        <?php
                          printf('<option value="%1$s" %2$s>%3$s</option>', esc_attr( $tax->term_id ), selected($this->value(), esc_attr( $tax->term_id ), false), esc_attr( $tax->name ) );
                         ?>
                      <?php endforeach ?>
                   <?php endif ?>
                 </select>

            </label>

        <?php }
    }

    /**
     * Multiple checkbox customize control class.
     *
     * @since  1.0.0
     * @access public
     */
    class Online_Estore_Customize_Control_Checkbox_Multiple extends WP_Customize_Control {

        /**
         * The type of customize control being rendered.
         *
         * @since  1.0.0
         * @access public
         * @var    string
         */
        public $type = 'checkbox-multiple';

        /**
         * Displays the control content.
         *
         * @since  1.0.0
         * @access public
         * @return void
         */
        public function render_content() {

            if ( empty( $this->choices ) )
                return; ?>

            <?php if ( !empty( $this->label ) ) : ?>
                <span class="customize-control-title"><?php echo esc_html( $this->label ); ?></span>
            <?php endif; ?>

            <?php if ( !empty( $this->description ) ) : ?>
                <span class="description customize-control-description"><?php echo esc_html( $this->description ); ?></span>
            <?php endif; ?>

            <?php $multi_values = !is_array( $this->value() ) ? explode( ',', $this->value() ) : $this->value(); ?>

            <ul>
                <?php foreach ( $this->choices as $value => $label ) : ?>

                    <li>
                        <label>
                            <input type="checkbox" value="<?php echo esc_attr( $value ); ?>" <?php checked( in_array( $value, $multi_values ) ); ?> />
                            <?php echo esc_html( $label ); ?>
                        </label>
                    </li>

                <?php endforeach; ?>
            </ul>

            <input type="hidden" <?php $this->link(); ?> value="<?php echo esc_attr( implode( ',', $multi_values ) ); ?>" />
        <?php }
    }

    /**
     * Page/Post Layout Controller
     *
     * @since 1.0.0
    */
    class Online_Estore_Customize_Control_Radio_Image extends WP_Customize_Control {
        /**
         * The type of customize control being rendered.
         *
         * @since  1.0.0
         * @access public
         * @var    string
         */
        public $type = 'radio-image';

        /**
         * Loads the jQuery UI Button script and custom scripts/styles.
         *
         * @since  1.0.0
         * @access public
         * @return void
         */
        public function enqueue() {
            wp_enqueue_script( 'jquery-ui-button' );
        }

        /**
         * Add custom JSON parameters to use in the JS template.
         *
         * @since  1.0.0
         * @access public
         * @return void
         */
        public function to_json() {
            parent::to_json();

            // We need to make sure we have the correct image URL.
            foreach ( $this->choices as $value => $args )
                $this->choices[ $value ]['url'] = esc_url( sprintf( $args['url'], get_template_directory_uri(), get_stylesheet_directory_uri() ) );

            $this->json['choices'] = $this->choices;
            $this->json['link']    = $this->get_link();
            $this->json['value']   = $this->value();
            $this->json['id']      = $this->id;
        }


        /**
         * Underscore JS template to handle the control's output.
         *
         * @since  1.0.0
         * @access public
         * @return void
         */

        public function content_template() { ?>
            <# if ( data.label ) { #>
                <span class="customize-control-title">{{ data.label }}</span>
            <# } #>

            <# if ( data.description ) { #>
                <span class="description customize-control-description">{{{ data.description }}}</span>
            <# } #>

            <div class="buttonset">

                <# for ( key in data.choices ) { #>

                    <input type="radio" value="{{ key }}" name="_customize-{{ data.type }}-{{ data.id }}" id="{{ data.id }}-{{ key }}" {{{ data.link }}} <# if ( key === data.value ) { #> checked="checked" <# } #> /> 

                    <label for="{{ data.id }}-{{ key }}">
                        <span class="screen-reader-text">{{ data.choices[ key ]['label'] }}</span>
                        <img src="{{ data.choices[ key ]['url'] }}" title="{{ data.choices[ key ]['label'] }}" alt="{{ data.choices[ key ]['label'] }}" />
                    </label>
                <# } #>

            </div><!-- .buttonset -->
        <?php }
    }

}

if ( !function_exists( 'online_estore_top_header_notice_bar' ) ) : 
  function online_estore_top_header_notice_bar() { ?>
    <div class="online_estore_top_header_notice_bar">
      <?php 
        $o_s_header_notice_title  = get_theme_mod( 'o_s_header_notice_title' );
        $o_s_header_notice_desc   = get_theme_mod( 'o_s_header_notice_desc' );
        if ( $o_s_header_notice_title ) { ?>
          <h3><?php echo esc_html( $o_s_header_notice_title ); ?></h3>
        <?php } 
        if ( $o_s_header_notice_desc ) { ?>
          <p><?php echo esc_textarea( $o_s_header_notice_desc ); ?></p>
        <?php } ?>
    </div>
  <?php }
endif;
add_action( 'o_s_header_notice', 'online_estore_top_header_notice_bar' );

if ( !function_exists( 'online_estore_header_html' ) ) :
  function online_estore_header_html() { ?>
    <div class="online_estore_header_html">
      <p><?php echo esc_textarea( get_theme_mod( 'o_s_header_html' ) ); ?></p>
    </div>
  <?php }
endif;
add_action( 'online_estore_header_html', 'online_estore_header_html' );
  

if ( !function_exists( 'online_store_button_one' ) ) :
  function online_store_button_one() { ?>
    <div class="button_one_holder">
      <?php 
        $button_one_text = get_theme_mod( 'button-one-text' );
        $button_one_icon_position = get_theme_mod( 'button-one-icon-position' );
        $button_one_url = get_theme_mod( 'button-one-url' );
        $button_one_link_target = get_theme_mod( 'button-one-open-link-new-tab' );
        $button_one_classes = get_theme_mod( 'button-one-class-name' );
        $button_one_alignment = get_theme_mod( 'button-one-align' );
        $button_one_alignment = json_decode( $button_one_alignment, true );
        $class = array();
        // desktop align.
        $align_desktop = online_estore_responsive_button_value( $button_one_alignment, 'desktop' );
        $class[] = 'text-'.$align_desktop ? 'text-'.$align_desktop : 'text-center';
        // tablet align.
        $align_tablet = online_estore_responsive_button_value( $button_one_alignment, 'tablet' );
        if ( $align_tablet ) 
          $class[] = 'text-'.$align_tablet ? 'text-'.$align_tablet : 'text-center';
        // mobile align.
        $align_mobile = online_estore_responsive_button_value( $button_one_alignment, 'mobile' );
        if ( $align_mobile )
        $class[] = "text-".$align_mobile ? "text-".$align_mobile : 'text-center';  


        if ( $button_one_icon_position == 'before' ) { ?>
          <i class="fas fa-bars"></i>
        <?php } ?>
          <a href="<?php echo esc_url( $button_one_url ); ?>" class="<?php echo esc_attr( $button_one_classes ); ?> <?php echo esc_attr( implode(" ", $class) ); ?>" target="<?php if ( $button_one_link_target == 1 ) { echo "_blank"; } ?>"><?php echo esc_html( $button_one_text ); ?></a>
        <?php if ( $button_one_icon_position == 'after' ) { ?>
          <i class="fas fa-bars"></i>
        <?php } ?>
    </div>
  <?php }
endif;
add_action( 'button_one', 'online_store_button_one' );

if ( !function_exists( 'onsale_products_layout_3' ) ) {
    function onsale_products_layout_3() { ?>
        <li class="onsale-products-layout-3">
            <?php
                /**
                 * Hook: woocommerce_before_shop_loop_item.
                 *
                 * @hooked woocommerce_template_loop_product_link_open - 10
                 */
                do_action( 'woocommerce_before_shop_loop_item' );
                /**
                 * Hook: woocommerce_before_shop_loop_item_title.
                 *
                 * @hooked woocommerce_show_product_loop_sale_flash - 10
                 * @hooked woocommerce_template_loop_product_thumbnail - 10
                 */
                do_action( 'woocommerce_before_shop_loop_item_title' );
                /**
                 * Hook: woocommerce_shop_loop_item_title.
                 *
                 * @hooked woocommerce_template_loop_product_title - 10
                 */
                do_action( 'woocommerce_shop_loop_item_title' );

                /**
                 * Hook: woocommerce_after_shop_loop_item_title.
                 *
                 * @hooked woocommerce_template_loop_rating - 5
                 * @hooked woocommerce_template_loop_price - 10
                 */
                do_action( 'woocommerce_after_shop_loop_item_title' );
                /**
                 * Hook: woocommerce_after_shop_loop_item.
                 *
                 * @hooked woocommerce_template_loop_product_link_close - 5
                 * @hooked woocommerce_template_loop_add_to_cart - 10
                 */
                do_action( 'woocommerce_after_shop_loop_item' );
            ?>
        </li>
    <?php }
}
add_action( 'onsale_products_layout_3', 'onsale_products_layout_3' );


if( !function_exists( 'online_estore_header_vertical' ) ) :

	function online_estore_header_vertical(){

		$enable_vertical_menu    = get_theme_mod( 'online_estore_vertical_menu_options','on' );
		$vertical_menu_title     = get_theme_mod( 'online_estore_vertical_menu_title','All Categories' );
		$vertical_all_menu       = get_theme_mod( 'online_estore_vertical_menu_show_all_menu','More Categories' );
		$vertical_all_close      = get_theme_mod( 'online_estore_vertical_menu_show_all_menu_close','Close' );
		$vertical_item_visible   = get_theme_mod( 'online_estore_vertical_menu_display_itmes', 10 );
		$vertical_menu_alignment = get_theme_mod( 'online_estore_vertical_menu_display_itmes', 'on' );


		if ( !empty( $enable_vertical_menu ) && $enable_vertical_menu == 'on' ):

			$block_vertical_class = array( 'vertical-wapper block-nav-category has-vertical-menu' );

			if ( is_front_page() || is_home() ) {
				
				$slider_layout = get_theme_mod( 'online_estore_slider_layout_options', 'sliderverticalmenu');
				$allbanners = get_theme_mod('online_estore_banner_slider_options');
				if( !empty( $slider_layout ) && $slider_layout == 'sliderverticalmenu' && !empty($allbanners)){

					$block_vertical_class[] = 'alway-open';
				}
			}
		?>
	        <div data-items="<?php echo esc_attr( $vertical_item_visible ); ?>" class="<?php echo esc_attr( implode( ' ', $block_vertical_class ) ); ?>">
	            
	            <div class="block-title">
	                <span class="text-title"><?php echo esc_html( $vertical_menu_title ); ?></span>
					<span class="block-icon">
						<span class="block-line"></span>
						<span class="block-line"></span>
						<span class="block-line"></span>
					</span>
	            </div>

	            <div class="block-content verticalmenu-content">
					<?php
						wp_nav_menu( array(
								'menu'            => 'vertical_menu',
								'theme_location'  => 'menu-3',
								'depth'           => 4,
								'container'       => '',
								'container_class' => '',
								'container_id'    => '',
								'menu_class'      => 'vertical-menu',
							)
						);
					?>
	                <div class="view-all-category">
	                    <a href="javascript:void(0);"
	                       data-closetext="<?php echo esc_attr( $vertical_all_close ); ?>"
	                       data-alltext="<?php echo esc_attr( $vertical_all_menu ) ?>"
	                       class="btn-view-all open-cate"><?php echo esc_html( $vertical_all_menu ) ?>
	                    </a>
	                </div>
	            </div>
	        </div><!-- block category -->
		<?php endif;
	}
endif;
add_action( 'online_estore_header_vertical', 'online_estore_header_vertical' );
add_action( 'online_estore_vertical_menu_section', 'online_estore_header_vertical' );
