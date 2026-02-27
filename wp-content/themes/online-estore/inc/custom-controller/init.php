<?php
/**
 * Includes all the custom controller classes
 *
 * @param string $file_path , path from the theme
 * @return string full path of file inside theme
 *
 */

require get_template_directory() . '/inc/custom-controller/font-icons.php';

/** tabs */
require get_template_directory() .'/inc/custom-controller/tab/class-tab-controller.php';
require get_template_directory() .'/inc/custom-controller/switch/class-switch.php';
require get_template_directory() .'/inc/custom-controller/page-editor/class-page-editor.php';
require get_template_directory() .'/inc/custom-controller/date/class-date.php';
require get_template_directory() .'/inc/custom-controller/font-awesome-icon/font-awesome-icon.php';
require get_template_directory() .'/inc/custom-controller/repeater/class-repeater.php';
require get_template_directory() .'/inc/custom-controller/range/class-range.php';
require get_template_directory() .'/inc/custom-controller/alpha-color/class-alpha-color.php';
require get_template_directory() .'/inc/custom-controller/heading/heading.php';
require get_template_directory() .'/inc/custom-controller/selector/class-selector.php';
require get_template_directory() .'/inc/custom-controller/info/info.php';
require get_template_directory() .'/inc/custom-controller/multi-checkbox/multi-checkbox.php';
require get_template_directory() .'/inc/custom-controller/image-select/image-select.php';
require get_template_directory() .'/inc/custom-controller/gradient/class-gradient.php';
require get_template_directory() .'/inc/custom-controller/background-control/background-control.php';
require get_template_directory() .'/inc/custom-controller/color-tab/color-tab.php';
require get_template_directory() .'/inc/custom-controller/range-slider/range-slider.php';
require get_template_directory() .'/inc/custom-controller/toggle-section/toggle-section.php';
require get_template_directory() .'/inc/custom-controller/seprator/class-seprator.php';


/*cssbox controller*/
require get_template_directory() .'/inc/custom-controller/cssbox/class-control-cssbox.php';

/*buttonset controller*/
require get_template_directory() .'/inc/custom-controller/buttonset/class-control-buttonset.php';
require get_template_directory() .'/inc/custom-controller/buttonset/class-control-responsive-buttonset.php';

/* group controller*/
require get_template_directory() .'/inc/custom-controller/group/class-control-group.php';




if ( ! function_exists( 'online_estore_save_menu_location' ) ) {
    /**
     * online_estore_save_menu_location
     * since 1.2.8
     * Save menu location for select menu on customizer
     * @return void
     */
    function online_estore_save_menu_location(){

        if( ! current_user_can( 'manage_options' )){
            return;
        }
        /*update menu location value*/
        if( is_customize_preview()){
            $nav_locations =  get_theme_mod( 'nav_menu_locations');
            if( isset($nav_locations['menu-1'] )){
                set_theme_mod( 'primary-menu-custom-menu', $nav_locations['menu-1'] );
            }
            if( isset($nav_locations['menu-2'] )){
                set_theme_mod( 'secondary-menu-custom-menu', $nav_locations['menu-2'] );
            }
            
        }
        /*just run once for previous*/
        if( get_theme_mod( 'primary_menu' ) !== 'lUpdated' ){
            $nav_locations =  get_theme_mod( 'nav_menu_locations');
            if( 'custom' == get_theme_mod( 'primary_menu' ) && get_theme_mod( 'primary-menu-custom-menu' ) ){
                $nav_locations['menu-1'] = get_theme_mod( 'primary-menu-custom-menu' );
            }
            if( get_theme_mod( 'secondary-menu-custom-menu' )){
                $nav_locations['menu-2'] = get_theme_mod( 'secondary-menu-custom-menu' );
            }
            
            /*Now we dont need this theme mode*/
            set_theme_mod( 'primary_menu', 'lUpdated' );
            if( is_array( $nav_locations )){
                set_theme_mod( 'nav_menu_locations', array_map( 'absint', $nav_locations ) );
            }
        }
    }
    add_action( 'after_setup_theme', 'online_estore_save_menu_location' );
}