<?php
  /**
   * Headaer Search
   */
  if(!function_exists('online_estore_header_search')){
    function online_estore_header_search(){ 
      $search_icon_only = get_theme_mod('online_estore__search_icon_only', false);
      $search_icon_alignment = get_theme_mod('online_estore__search_icon_alignment', 'swp-flex-align-left');
      $online_estore_search_option = get_theme_mod('online_estore_search_type_options');
      ?>
      <div class="sparkle-column flex-center <?php echo esc_attr($search_icon_alignment); ?>">
        <?php if( $search_icon_only ): ?>
        <button class="toggle-searchicon">
                  <i class="icofont-search"></i>
        </button>
  
        <div class="header-control toggle-search">
          <?php
            /**
             * Advance & Normal Search
             */
            do_action( 'online_estore_woocommerce_product_search' );
          ?>
        </div>
  
        <?php
          else: 
          /**
           * Advance & Normal Search
           */
          do_action( 'online_estore_woocommerce_product_search' );
          endif; 
        ?>
      </div>
      <?php
    }
    add_action('online_estore_header_search', 'online_estore_header_search');
  }

  if(!function_exists ('online_estore_advance_product_search_form')){
    /**
    * Advance Search
    *
    * @since 1.0.0
    */
    function online_estore_advance_product_search_form(){   

        $searchplaceholder = get_theme_mod('online_estore_search_placeholder_text','I&#39;m searching for...' ); 
        
        $searchtype = get_theme_mod( 'online_estore_search_type_options', 'advancesearch' );

        $search_layout_type = get_theme_mod( 'online_estore_search_layout_type', 'style-one' );

        $selected = '';
        
        if ( isset( $_GET['product_cat'] ) && sanitize_text_field( wp_unslash( $_GET['product_cat'] ) ) ) {

                $selected = sanitize_text_field( wp_unslash( $_GET['product_cat'] ) );

        }
          $args = array(
              'show_option_none'  => esc_html__( 'All Categories', 'online-estore' ),
              'taxonomy'          => 'product_cat',
              'class'             => 'category-search-option',
              'hide_empty'        => 1,
              'orderby'           => 'name',
              'order'             => "ASC",
              'tab_index'         => true,
              'hierarchical'      => true,
              'id'                => rand(),
              'name'              => 'product_cat',
              'value_field'       => 'slug',
              'selected'          => $selected,
              'option_none_value' => '0',
          );

          $search_align = get_theme_mod( 'online_estore_search_icon_alignment', 'swp-flex-align-left' );
      ?>
        <div class="block-search spw-width-100 <?php echo esc_attr( $search_layout_type ); ?> <?php echo esc_attr( $search_align ); ?>">
            <form role="product-search" method="get" action="<?php echo esc_url( home_url( '/' ) ) ?>" class="form-search block-search <?php echo esc_attr( $searchtype ); ?>">
                <?php 
                    if( class_exists( 'WooCommerce' ) && !empty($searchtype) && $searchtype == 'advancesearch' ){
                ?>
                    <input type="hidden" name="post_type" value="product"/>
                    <input type="hidden" name="taxonomy" value="product_cat">
                    <div class="form-content search-box results-search">
                        <div class="inner">
                            <input autocomplete="off" type="text" class="input searchfield txt-livesearch" name="s" value="<?php echo esc_attr( get_search_query() ); ?>" placeholder="<?php echo esc_attr( $searchplaceholder ); ?>">
                        </div>
                    </div>
                    <div class="category">
                      <?php wp_dropdown_categories( $args ); ?>
                    </div>
                    <button type="submit" class="btn-submit">
                        <span class="fa fa-search" aria-hidden="true"></span>
                    </button>

                <?php }elseif(!empty($searchtype) && $searchtype == 'ajaxsearch' ){ ?>
        
                        <div class="form-content search-box results-search">
                            <div class="inner">
                                <input autocomplete="off" type="text" class="input searchfield txt-livesearch" name="s" value="<?php echo esc_attr( get_search_query() ); ?>" placeholder="<?php echo esc_attr( $searchplaceholder ); ?>">
                            </div>
                        </div>
                        <button type="submit" class="btn-submit">
                            <span class="fa fa-search" aria-hidden="true"></span>
                            <i class="fas fa-spinner form-ajax-preloader"></i>
                        </button>

                        <div id="datafetch" class="datafetch"><?php esc_html_e('Search results will appear here','online-estore'); ?></div>

                <?php } else{ ?>

                    <input type="hidden" name="post_type" value="post">
                    <div class="form-content search-box results-search">
                        <div class="inner">
                            <input autocomplete="off" type="text" class="input searchfield txt-livesearch" name="s" value="<?php echo esc_attr( get_search_query() ); ?>" placeholder="<?php echo esc_attr( $searchplaceholder ); ?>">
                        </div>
                    </div>
                    <button type="submit" class="btn-submit">
                        <span class="fa fa-search" aria-hidden="true"></span>
                    </button>

                <?php } ?>
            </form><!-- block search -->
        </div>
      <?php 
    }
}
add_action('online_estore_woocommerce_product_search','online_estore_advance_product_search_form', 90);

if ( ! function_exists( 'online_estore_primary_menu' ) ) {
	/**
	 * Primary Menu
	 *
	 */
	function online_estore_primary_menu( ) {
        $align = get_theme_mod( 'primary-menu-align', 'swp-flex-align-left' );
      ?>
        <div class="header-nav primary-menu flex-center <?php echo esc_attr( $align ); ?>">
            <div class="header-nav-inner">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle menu-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="true" aria-controls="navbar">
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    </button>
                </div>

                <div class="box-header-nav main-menu-wapper">
                    <?php
                        wp_nav_menu( array(
                                'theme_location'  => 'menu-1',
                                'menu'            => 'primary-menu',
                                'container'       => '',
                                'container_class' => '',
                                'container_id'    => '',
                                'menu_class'      => 'main-menu',
                            )
                        );
                    ?>
                </div>
            </div>
        </div>
      <?php  
        
	}
}
add_action('online_estore_primary_menu', 'online_estore_primary_menu');

if ( ! function_exists( 'online_estore_secondary_menu' ) ) {
  /**
   * Primary Menu
   *
   */
  function online_estore_secondary_menu( ) {
        $align = get_theme_mod( 'secondary-menu-align' , 'swp-flex-align-left' );
      ?>
        <div class="header-nav secondary-menu-wrapper flex-center <?php echo esc_attr( $align ); ?>">
            <div class="container">
                <div class="header-nav-inner">
                    <div class="navbar-header">
                        <button type="button" class="navbar-toggle menu-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="true" aria-controls="navbar">
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        </button>
                    </div>

                    <div class="box-header-nav main-menu-wapper">
                        <?php
                            wp_nav_menu( array(
                                    'theme_location'  => 'menu-2',
                                    'container'       => '',
                                    'container_class' => '',
                                    'container_id'    => '',
                                    'menu_class'      => 'main-menu secondary-menu',
                                )
                            );
                        ?>
                    </div>
                </div>
            </div>
        </div>
      <?php  
        
  }
}
add_action('secondary_menu', 'online_estore_secondary_menu');


/**
 * Cart Heder user login register
 */
if(!function_exists('online_estore_login_register_link')){
    function online_estore_login_register_link(){ 
        $account_background_color = get_theme_mod( 'account-background-color' );
      ?>
        <div class='online_myaccount flex-center <?php echo esc_attr(get_theme_mod('account-icon-align', 'swp-flex-align-left')); ?>' style="background-color:<?php echo esc_attr( $account_background_color ); ?>">

            <a href="<?php echo esc_url( get_permalink( get_option( 'woocommerce_myaccount_page_id' ) ) ); ?>">                             
                <span class="fa fa-user-o"></span>
                <div class="myaccount_items">
                    <span><?php esc_html_e('Sign in / Join','online-estore'); ?></span>
                </div>
            </a>
        </div>
        <?php
    }
}
add_action('online_estore_login_register', 'online_estore_login_register_link');