<?php
/**
 * Define custom fields for widgets
 * 
 * @package Sparkle Themes
 *
 * @subpackage Online eStore
 *
 * @since 1.0.0
 */

function online_estore_widgets_show_widget_field( $instance = '', $widget_field = '', $online_estore_widget_field_value = '' ) {
    
    extract( $widget_field );

    switch ( $online_estore_widgets_field_type ) {

        /**
         * Text field
         */
        case 'text' :
        ?>
            <p>
                <span class="field-label"><label for="<?php echo esc_attr( $instance->get_field_id( $online_estore_widgets_name ) ); ?>"><?php echo esc_html( $online_estore_widgets_title ); ?></label></span>
                <input class="widefat" id="<?php echo esc_attr( $instance->get_field_id( $online_estore_widgets_name ) ); ?>" name="<?php echo esc_attr( $instance->get_field_name( $online_estore_widgets_name ) ); ?>" type="text" value="<?php echo esc_attr( $online_estore_widget_field_value ); ?>" />

                <?php if ( isset( $online_estore_widgets_description ) ) { ?>
                    <br />
                    <em><?php echo wp_kses_post( $online_estore_widgets_description ); ?></em>
                <?php } ?>
            </p>
        <?php
            break;

        /**
         * URL field
         */
        case 'url' :
        ?>
            <p>
                <span class="field-label"><label for="<?php echo esc_attr( $instance->get_field_id( $online_estore_widgets_name ) ); ?>"><?php echo esc_html( $online_estore_widgets_title ); ?></label></span>
                <input class="widefat" id="<?php echo esc_attr( $instance->get_field_id( $online_estore_widgets_name ) ); ?>" name="<?php echo esc_attr( $instance->get_field_name( $online_estore_widgets_name ) ); ?>" type="text" value="<?php echo esc_url( $online_estore_widget_field_value ); ?>" />

                <?php if ( isset( $online_estore_widgets_description ) ) { ?>
                    <br />
                    <em><?php echo wp_kses_post( $online_estore_widgets_description ); ?></em>
                <?php } ?>
            </p>
        <?php
            break;

        /**
         * Number field
         */
        case 'number' :
            if( empty( $online_estore_widget_field_value ) ) {
                $online_estore_widget_field_value = $online_estore_widgets_default;
            }
        ?>
            <p>
                <span class="field-label"><label for="<?php echo esc_attr( $instance->get_field_id( $online_estore_widgets_name ) ); ?>"><?php echo esc_html( $online_estore_widgets_title ); ?></label></span>
                <input name="<?php echo esc_attr( $instance->get_field_name( $online_estore_widgets_name ) ); ?>" type="number" step="1" min="1" id="<?php echo esc_attr( $instance->get_field_id( $online_estore_widgets_name ) ); ?>" value="<?php echo esc_attr( $online_estore_widget_field_value ); ?>" class="widefat" />

                <?php if ( isset( $online_estore_widgets_description ) ) { ?>
                    <br />
                    <em><?php echo wp_kses_post( $online_estore_widgets_description ); ?></em>
                <?php } ?>
            </p>
        <?php
            break;

        /**
         * Textarea field
         */
        case 'textarea' :
        ?>
            <p>
                <span class="field-label"><label for="<?php echo esc_attr( $instance->get_field_id( $online_estore_widgets_name ) ); ?>"><?php echo esc_html( $online_estore_widgets_title ); ?></label></span>
                <textarea class="widefat" rows="<?php echo absint( $online_estore_widgets_row ); ?>" id="<?php echo esc_attr( $instance->get_field_id( $online_estore_widgets_name ) ); ?>" name="<?php echo esc_attr( $instance->get_field_name( $online_estore_widgets_name ) ); ?>"><?php echo esc_textarea( $online_estore_widget_field_value ); ?></textarea>
            </p>
        <?php
            break;
        
        /**
         * Checkbox field
         */
        case 'checkbox' :
            ?>
            <p>
                <input id="<?php echo esc_attr( $instance->get_field_id( $online_estore_widgets_name ) ); ?>" name="<?php echo esc_attr( $instance->get_field_name( $online_estore_widgets_name ) ); ?>" type="checkbox" value="1" <?php checked( '1', $online_estore_widget_field_value ); ?>/>
                <label for="<?php echo esc_attr( $instance->get_field_id( $online_estore_widgets_name ) ); ?>"><?php echo esc_html( $online_estore_widgets_title ); ?></label>

                <?php if ( isset( $online_estore_widgets_description ) ) { ?>
                    <br />
                    <em><?php echo wp_kses_post( $online_estore_widgets_description ); ?></em>
                <?php } ?>
            </p>
            <?php
            break;

        /**
         * Select field
         */
        case 'select' :
            if( empty( $online_estore_widget_field_value ) ) {
                $online_estore_widget_field_value = $online_estore_widgets_default;
            }

        ?>
            <p>
                <span class="field-label"><label for="<?php echo esc_attr( $instance->get_field_id( $online_estore_widgets_name ) ); ?>"><?php echo esc_html( $online_estore_widgets_title ); ?></label></span> 
                <select name="<?php echo esc_attr( $instance->get_field_name( $online_estore_widgets_name ) ); ?>" id="<?php echo esc_attr( $instance->get_field_id( $online_estore_widgets_name ) ); ?>" class="widefat">
                    <?php foreach ( $online_estore_widgets_field_options as $athm_option_name => $athm_option_title ) { ?>
                        <option value="<?php echo esc_attr( $athm_option_name ); ?>" id="<?php echo esc_attr( $instance->get_field_id( $athm_option_name ) ); ?>" <?php selected( $athm_option_name, $online_estore_widget_field_value ); ?>><?php echo esc_html( $athm_option_title ); ?></option>
                    <?php } ?>
                </select>

                <?php if ( isset( $online_estore_widgets_description ) ) { ?>
                    <br />
                    <em><?php echo wp_kses_post( $online_estore_widgets_description ); ?></em>
                <?php } ?>
            </p>
        <?php
            break;

        /**
         * Multiple checkboxes field
         */
        case 'multicheckboxes': 
            $online_estore_widget_field_value = unserialize($online_estore_widget_field_value);
            ?>
            <p><span class="field-label"><label><?php echo esc_html( $online_estore_widgets_title ); ?></label></span></p>

            <div class="onlineestore-single-checkbox">
                <?php    
                    foreach ( $online_estore_widgets_field_options as $athm_option_name => $athm_option_title) {
                        
                        if( isset( $online_estore_widget_field_value[$athm_option_name] ) ) {

                            $online_estore_widget_field_value[$athm_option_name] = 1;

                        }else{
                            
                            $online_estore_widget_field_value[$athm_option_name] = 0;
                        }
                    
                ?>
                    
                    <p>
                        <input id="<?php echo esc_attr( $instance->get_field_id( $online_estore_widgets_name ) ); ?>" name="<?php echo esc_attr( $instance->get_field_name( $online_estore_widgets_name ).'['.esc_attr( $athm_option_name ).']' ); ?>" type="checkbox" value="1" <?php checked('1', $online_estore_widget_field_value[$athm_option_name]); ?>/>
                        <label for="<?php echo esc_attr( $instance->get_field_id( $online_estore_widgets_name ) ); ?>"><?php echo esc_html( $athm_option_title ); ?></label>
                    </p>
                    
                <?php } ?>
            </div><!-- .onlineestore-single-checkbox -->

            <?php
                if ( isset( $online_estore_widgets_description ) ) {
            ?>
                    <em><?php echo wp_kses_post( $online_estore_widgets_description ); ?></em>
            <?php }

        break;

        /**
         * Selector field
         */
        case 'selector':
            if( empty( $online_estore_widget_field_value ) ) {
                $online_estore_widget_field_value = $online_estore_widgets_default;
            }
        ?>
            <p><span class="field-label"><label class="field-title"><?php echo esc_html( $online_estore_widgets_title ); ?></label></span></p>
        <?php            
            echo '<div class="selector-labels">';
            foreach ( $online_estore_widgets_field_options as $option => $val ){
                $class = ( $online_estore_widget_field_value == $option ) ? 'selector-selected': '';
                echo '<label class="'. esc_attr( $class ).'" data-val="'.esc_attr( $option ).'">';
                echo '<img src="'.esc_url( $val ).'"/>';
                echo '</label>'; 
            }
            echo '</div>';
            echo '<input data-default="'.esc_attr( $online_estore_widget_field_value ).'" type="hidden" value="'.esc_attr( $online_estore_widget_field_value ).'" name="'.esc_attr( $instance->get_field_name( $online_estore_widgets_name ) ).'"/>';
            break;

        /**
         * Upload field
         */
        case 'upload':
            $image = $image_class = "";
            if( $online_estore_widget_field_value ){ 
                $image = '<img src="'.esc_url( $online_estore_widget_field_value ).'" style="max-width:100%;"/>';    
                $image_class = ' hidden';
            }
        ?>
            <div class="attachment-media-view">

            <p><span class="field-label"><label for="<?php echo esc_attr( $instance->get_field_id( $online_estore_widgets_name ) ); ?>"><?php echo esc_html( $online_estore_widgets_title ); ?>:</label></span></p>
            
                <div class="placeholder<?php echo esc_attr( $image_class ); ?>">
                    <?php esc_html_e( 'No image selected', 'online-estore' ); ?>
                </div>
                <div class="thumbnail thumbnail-image">
                    <?php echo wp_kses_post ( $image ); ?>
                </div>

                <div class="actions onlineestore-clearfix">
                    <button type="button" class="button onlineestore-delete-button align-left"><?php esc_html_e( 'Remove', 'online-estore' ); ?></button>
                    <button type="button" class="button onlineestore-upload-button alignright"><?php esc_html_e( 'Select Image', 'online-estore' ); ?></button>
                    
                    <input name="<?php echo esc_attr( $instance->get_field_name( $online_estore_widgets_name ) ); ?>" id="<?php echo esc_attr( $instance->get_field_id( $online_estore_widgets_name ) ); ?>" class="upload-id" type="hidden" value="<?php echo esc_url( $online_estore_widget_field_value ) ?>"/>
                </div>

            <?php if ( isset( $online_estore_widgets_description ) ) { ?>
                <br />
                <em><?php echo wp_kses_post( $online_estore_widgets_description ); ?></em>
            <?php } ?>

            </div><!-- .attachment-media-view -->
        <?php
            break;
    }
}

function online_estore_widgets_updated_field_value( $widget_field, $new_field_value ) {

    extract( $widget_field );

    if ( $online_estore_widgets_field_type == 'number') {

        return absint( $new_field_value );

    } elseif ( $online_estore_widgets_field_type == 'textarea' ) {

        //return esc_textarea( $new_field_value );

        if (!isset($online_estore_widgets_allowed_tags)) {
            $online_estore_widgets_allowed_tags = '<span><br><p><strong><em><a>';
        }

        return wp_kses_data($new_field_value, $online_estore_widgets_allowed_tags);


    } elseif ( $online_estore_widgets_field_type == 'url' ) {

        return esc_url( $new_field_value );

    }elseif ($online_estore_widgets_field_type == 'title') {
        
        return wp_kses_post($new_field_value);

    }elseif( $online_estore_widgets_field_type == 'multicheckboxes' ) {

        return serialize($new_field_value);

    } else {

        return wp_kses_data( $new_field_value );

    }
}


/**
 * Register different widgets
 *
 * @since 1.0.0
 */
function online_estore_register_widgets() {

    /**
     * Promo Widget Block
    */
    register_widget( 'online_estore_Promo_Widget_Block' );

    /**
     * Full Promo Display Block
    */
    register_widget( 'online_estore_Full_Promo_Type_Block' );

    /**
     * Blog Posts Display Block
    */
    register_widget( 'online_estore_Blog_Posts_Block' );

    /**
     * About Us Info Display Block
    */
    register_widget( 'online_estore_Aboutus_Info' );


    if ( class_exists( 'WooCommerce' ) ) {

        /**
         * Multiple Category Collection Display Block
        */
        register_widget( 'online_estore_Multiple_Category_Collection_Block' );

        /**
         * Multiple Category Products Display Block
        */
        register_widget( 'online_estore_Multiple_Category_Products_Block' );

        /**
         * Multiple Category Tabs Display Block
        */
        register_widget( 'online_estore_Multiple_Category_Tabs_Block' );

        /**
         * Tabs Products Type Display Block
        */
        register_widget( 'online_estore_Tabs_Products_Type_Block' );

        /**
         * Single Category Products Display Block
        */
        register_widget( 'online_estore_Single_Category_Products_Block' );

        /**
         * Products Type Display Block
        */
        register_widget( 'online_estore_Products_Type_Block' );

        /**
         * Best Selling Products Block
        */
        register_widget( 'online_estore_Best_Selling_Products_Block' );

        /**
         * On Sale Products Block
        */
        register_widget( 'online_estore_onsale_selling_products_block' );

        /**
         * Top Rated Products Block
        */
        register_widget( 'online_estore_Top_Rated_Selling_Products_Block' );

        /**
         * Category Products Type Display Block
        */
        register_widget( 'online_estore_Category_Products_Type_Block' );
    }

}
add_action( 'widgets_init', 'online_estore_register_widgets' );