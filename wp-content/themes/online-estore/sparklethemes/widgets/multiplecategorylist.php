<?php
/**
 * Multiple Category Display Block
 *
 * Widget show the Category Different Layout.
 *
 * @package Sparkle Themes
 * @subpackage Online eStore
 * @since 1.0.0
 */

class Online_Estore_Multiple_Category_Collection_Block extends WP_widget {

	/**
     * Register widget with WordPress.
     */
    public function __construct() {

        $widget_ops = array( 
            'classname' => 'online_estore_multiple_category_block clearfix',
            'description' => esc_html__( 'Displays multiple selected category collection in list and slider display layouts.', 'online-estore' )
        );

        parent::__construct( 'online_estore_multiple_category_block', esc_html__( '&bull; Category Collection', 'online-estore' ), $widget_ops );
    }

    /**
     * Helper function that holds widget fields
     * Array is used in update and form functions
     */
    private function widget_fields() {

        $multiple_products_categories = online_estore_products_categories_lists();

        $title_style = array(
            'layout_one'  => esc_html__('Layout One', 'online-estore'),
            'layout_two'  => esc_html__('Layout Two', 'online-estore')
        );
        
        $fields = array(
            
            'block_title_layout' => array(
                'online_estore_widgets_name'         => 'block_title_layout',
                'online_estore_widgets_title'        => esc_html__( 'Select Block Title Style', 'online-estore' ),
                'online_estore_widgets_default'      => 'layout_one',
                'online_estore_widgets_field_type'   => 'select',
                'online_estore_widgets_field_options' => $title_style
            ),

            'block_title' => array(
                'online_estore_widgets_name'         => 'block_title',
                'online_estore_widgets_title'        => esc_html__( 'Enter Block Title', 'online-estore' ),
                'online_estore_widgets_description'  => esc_html__( 'Enter your block title. (Optional - Leave blank to hide the title.)', 'online-estore' ),
                'online_estore_widgets_field_type'   => 'text'
            ),


            'block_desc' => array(
                'online_estore_widgets_name'         => 'block_desc',
                'online_estore_widgets_title'        => esc_html__( 'Enter Block Short Description', 'online-estore' ),
                'online_estore_widgets_description'  => esc_html__( 'Enter your block description. (Optional - Leave blank to hide the description.)', 'online-estore' ),
                'online_estore_widgets_field_type'   => 'text'
            ),

            'block_product_cat_id' => array(
                'online_estore_widgets_name'         => 'block_product_cat_id',
                'online_estore_widgets_title'        => esc_html__( 'Select Products Category', 'online-estore' ),
                'online_estore_widgets_default'      => 0,
                'online_estore_widgets_field_type'   => 'multicheckboxes',
                'online_estore_widgets_field_options' => $multiple_products_categories
            ),

            'block_style' => array(
                'online_estore_widgets_name'          => 'block_style',
                'online_estore_widgets_title'         => esc_html__( 'Style', 'online-estore' ),
                'online_estore_widgets_default'       => 'style-one',
                'online_estore_widgets_field_type'    => 'select',
                'online_estore_widgets_field_options' => array(
                    'style-one'        => esc_html__("Style One", 'online-estore'),
                    'style-two'        => esc_html__("Style Two", 'online-estore'),
                    'style-three'      => esc_html__("Style Three", 'online-estore')
                )
            ),

            'block_display_layout' => array(
                'online_estore_widgets_name'           => 'block_display_layout',
                'online_estore_widgets_title'        => esc_html__( 'Display Block Layouts', 'online-estore' ),
                'online_estore_widgets_default'      => 'layout1',
                'online_estore_widgets_field_type'   => 'selector',
                'online_estore_widgets_field_options' => array(
                    'layout1' => esc_url( get_template_directory_uri() . '/assets/images/boxpromoslider.png' ),
                    'layout2' => esc_url( get_template_directory_uri() . '/assets/images/boxpromosliderright.png' )
                )
            ),

            'block_product_column' => array(
                'online_estore_widgets_name'         => 'block_product_column',
                'online_estore_widgets_title'        => esc_html__( 'Display Number Products Column', 'online-estore' ),
                'online_estore_widgets_default'      => 6,
                'online_estore_widgets_field_type'   => 'number'
            ),

            'block_padding_top' => array(
                'online_estore_widgets_name'         => 'block_padding_top',
                'online_estore_widgets_title'        => esc_html__( 'Top Padding Default (0px)', 'online-estore' ),
                'online_estore_widgets_description'  => esc_html__( 'Enter Top Padding (exp : 40px) (Optional - Leave blank to Default (padding: 0px))', 'online-estore' ),
                'online_estore_widgets_field_type'   => 'text',
                'online_estore_widgets_default'      => 35,
            ),

            'block_padding_bottom' => array(
                'online_estore_widgets_name'         => 'block_padding_bottom',
                'online_estore_widgets_title'        => esc_html__( 'Bottom Padding Default (35px)', 'online-estore' ),
                'online_estore_widgets_description'  => esc_html__( 'Enter Bottom Padding (exp : 35px) (Optional - Leave blank to Default (padding: 35px))', 'online-estore' ),
                'online_estore_widgets_field_type'   => 'text',
                'online_estore_widgets_default'      => '',
            )

        );

        return $fields;
    }

    /**
     * Front-end display of widget.
     *
     * @see WP_Widget::widget()
     *
     * @param array $args     Widget arguments.
     * @param array $instance Saved values from database.
     */
    public function widget( $args, $instance ) {

        extract( $args );
        if( empty( $instance ) ) {
            return ;
        }

        $block_padding      = empty( $instance['block_padding'] ) ? '' : $instance['block_padding'];

        $title_layout       = empty( $instance['block_title_layout'] ) ? 'layout_one' : $instance['block_title_layout'];

        $block_title        = apply_filters( 'widget_title', !empty( $instance['block_title'] ) ? $instance['block_title'] : '', $instance, $this->id_base );
        
        $block_desc         = apply_filters( 'widget_description', !empty( $instance['block_desc'] ) ? $instance['block_desc'] : '', $instance, $this->id_base );

        $block_cat_id       = empty( $instance['block_product_cat_id'] ) ? '' : $instance['block_product_cat_id'];
        $block_cat_id       = unserialize(  $block_cat_id );
        
        $block_layout       = empty( $instance['block_display_layout'] ) ? 'layout1' : $instance['block_display_layout'];

        $product_column     = empty( $instance['block_product_column'] ) ? 6 : $instance['block_product_column'];

        $padding_top        = empty( $instance['block_padding_top'] ) ? '' : $instance['block_padding_top'];
        
        $padding_bottom     = empty( $instance['block_padding_bottom'] ) ? 35 : $instance['block_padding_bottom'];

        $block_style        = empty( $instance['block_style'] ) ? 'style-one' : $instance['block_style'];

        echo $before_widget; ?>

        <?php

            if( $block_style === 'style-three' ) {
                global $cat_id_on_coll;
                $cat_id_on_coll = 0;
                ?>
                    <div class="container clearfix">         
                <div class="productwrapper">
                    <div class="blocktitlewrap clearfix">

                        <div class="blocktitle">
                            <?php if( !empty( $block_title ) ) { ?><h2 class="wow zoomIn"><?php echo esc_html( $block_title ); ?></h2><?php } ?>
                            <?php if( !empty( $title_layout ) && $title_layout != 'layout_two' ){ if(!empty( $block_desc )) { ?><p class="wow zoomIn"><?php echo esc_html( $block_desc ); ?></p><?php } } ?>
                        </div>

                         <div class="xstoreaction">
                            <div class="onlineestore-lSPrev"><i class="fa fa-angle-left"></i></div>
                            <div class="onlineestore-lSNext"><i class="fa fa-angle-right"></i></div>
                        </div>

                    </div>
                    <div class="categorycollection-wrap style-three">
                <?php
                foreach( $block_cat_id as $key => $single_cat_id ) {
                    $thumbnail_id = get_term_meta( $key, 'thumbnail_id', true );
                        $images = wp_get_attachment_url( $thumbnail_id );
                        $image  = wp_get_attachment_image_src( $thumbnail_id, 'online-estore-post-list', true );
                        $term   = get_term_by( 'id', $key, 'product_cat');
                    if ( $term && ! is_wp_error( $term ) ) {
                        $term_link = get_term_link($term);
                        $term_name = $term->name;
                        $sub_count =  apply_filters( 'woocommerce_subcategory_count_html', ' ' . esc_attr( $term->count ) . ' '.esc_html__('Products','online-estore').'', $term );
                    }else{
                        $term_link = '#';
                        $term_name = esc_html__('Category','online-estore');
                        $sub_count = '0 '.esc_html__('Products','online-estore');
                    }
                    $no_img = 'https://via.placeholder.com/285x370.png';
                    if( ( $cat_id_on_coll === 0 ) || ( $cat_id_on_coll%4 === 0 ) ) { ?>
                        <div class="singlecatbanner-wrap">
                            <a href="<?php echo esc_url( $term_link ); ?>">
                                <div class="image-wrap">
                                    <img src="<?php if( $images ) { echo esc_url( $image[0] ); } else { esc_url( $no_img ); } ?>" alt="">
                                </div>
                                <div class="onlineestore_category_area">
                                    <h5 class="onlineestore_category_name"><?php echo esc_html( $term_name ) ?></h5>
                                    <p class="onlineestore_category_count"><?php echo esc_html( $sub_count );  ?></p>
                                </div>
                            </a>
                        </div>
                    <?php } else if ( ( $cat_id_on_coll > 0 ) && ( $cat_id_on_coll%4 != 0 ) ) {
                            if( ( $cat_id_on_coll === 1 ) || ( $cat_id_on_coll%4 == 1 ) ) { ?>
                                <div class="multiplecatbanner-wrap">
                                    <div class="doublecat-wrap">
                        <?php } ?>     
                        <?php
                            if( ( $cat_id_on_coll > 0 && $cat_id_on_coll < 3  ) || ( $cat_id_on_coll%4 != 3 ) ) { ?>
                                <a href="<?php echo esc_url( $term_link ); ?>">
                                    <div class="image-wrap">
                                        <img src="<?php if( $images ) { echo esc_url( $image[0] ); } else { esc_url( $no_img ); } ?>" alt="">
                                    </div> 
                                    <div class="onlineestore_category_area">
                                        <h5 class="onlineestore_category_name"><?php echo esc_html( $term_name ); ?></h5>
                                        <p class="onlineestore_category_count"><?php echo esc_html( $sub_count );  ?></p>
                                    </div>
                                </a>
                        <?php }
                        ?>
                            <?php 
                                if( ( $cat_id_on_coll === 2 ) || ( $cat_id_on_coll%4 === 2 ) ) { ?>
                                    </div>
                            <?php }
                            ?>
                            <?php 
                                if( ( $cat_id_on_coll == 3 ) || ( $cat_id_on_coll%4 == 3 ) ) { ?>
                                    <div class="singlecat-wrap">
                                        <a class="<?php echo esc_url( $term_link ); ?>">
                                            <div class="image-wrap">
                                                <img src="<?php if( $images ) { echo esc_url( $image[0] ); } else { esc_url( $no_img ); } ?>" alt="">
                                            </div>
                                            <div class="onlineestore_category_area">
                                                <h5 class="onlineestore_category_name"><?php echo esc_html( $term_name ) ?></h5>
                                                <p class="onlineestore_category_count"><?php echo esc_html( $sub_count );  ?></p>
                                            </div>
                                        </a>
                                    </div>   
                                    </div>   
                            <?php }
                            ?>
                    <?php }
                    $cat_id_on_coll++;
                }
                ?>
                </div>
                </div></div>
            <?php
            } else if( ( $block_style === 'style-one' ) || ( $block_style === 'style-two' ) ) { ?>
                <div class="onlineestore_category_wrapper <?php echo esc_attr( $title_layout ); ?> <?php echo esc_attr( $block_layout  ); ?>" data-layout="<?php echo esc_attr( $block_layout  ); ?><?php echo intval($product_column); ?>" data-catcolumn="<?php echo intval($product_column); ?>" <?php online_estore_widget_block_padding( $padding_top, $padding_bottom ); ?>>           
            <div class="container clearfix">         
                <div class="productwrapper" data-typecolumn="<?php echo intval($product_column); ?>">
                    <div class="blocktitlewrap clearfix">

                        <div class="blocktitle">
                            <?php if( !empty( $block_title ) ) { ?><h2 class="wow zoomIn"><?php echo esc_html( $block_title ); ?></h2><?php } ?>
                            <?php if( !empty( $title_layout ) && $title_layout != 'layout_two' ){ if(!empty( $block_desc )) { ?><p class="wow zoomIn"><?php echo esc_html( $block_desc ); ?></p><?php } } ?>
                        </div>

                         <div class="xstoreaction">
                            <div class="onlineestore-lSPrev"><i class="fa fa-angle-left"></i></div>
                            <div class="onlineestore-lSNext"><i class="fa fa-angle-right"></i></div>
                        </div>

                    </div>

                    <ul class="onlineestore_category_wrap  wow fadeInUp grid-grid grid-grid-<?php echo intval($product_column); ?> <?php if( !empty( $block_layout ) && $block_layout == 'layout1' ){ echo esc_attr( 'xstorecatproductslider cS-hidden' ); }  ?> <?php echo esc_attr($block_style); ?>">
                        <?php
                            $count = 0; 

                            if(!empty( $block_cat_id ) ){
                                foreach ($block_cat_id as $key => $store_cat_id) {

                                    $thumbnail_id = get_term_meta( $key, 'thumbnail_id', true );

                                    $images = wp_get_attachment_url( $thumbnail_id );

                                    $image  = wp_get_attachment_image_src( $thumbnail_id, 'online-estore-post-list', true );

                                    $term   = get_term_by( 'id', $key, 'product_cat');

                                if ( $term && ! is_wp_error( $term ) ) {

                                    $term_link = get_term_link($term);
                                    $term_name = $term->name;
                                    $sub_count =  apply_filters( 'woocommerce_subcategory_count_html', ' ' . esc_attr( $term->count ) . ' '.esc_html__('Products','online-estore').'', $term );
                                
                                }else{
                                    $term_link = '#';
                                    $term_name = esc_html__('Category','online-estore');
                                    $sub_count = '0 '.esc_html__('Products','online-estore');
                                }
                                
                            $no_img = 'https://via.placeholder.com/285x370.png';
                        ?>
                            <li class="product">
                                <div class="onlineestore_category_itemimg">
                                    <a href="<?php echo esc_url($term_link); ?>">
                                        <?php  
                                            if ( $images ) {
                                                echo ' <div class="image-wrap"><img class="categoryimage" src="' . esc_url( $image[0] ) . '" /></div>';

                                            } else{

                                                echo '<div class="image-wrap"> <img class="categoryimage" src="' . esc_url( $no_img ) . '" /> </div>';
                                            }
                                        ?>
                                        <div class="onlineestore_category_area">
                                            <h5 class="onlineestore_category_name"><?php echo esc_html($term_name); ?></h5>
                                            <p class="onlineestore_category_count"><?php echo esc_html( $sub_count );  ?></p>
                                        </div>
                                    </a>            
                                </div>         
                            </li>
                        <?php } }  ?>
                    </ul>
                </div>
            </div>
        </div> 
            <?php }

        ?>

    <?php
        echo $after_widget;
    }

    /**
     * Sanitize widget form values as they are saved.
     *
     * @see WP_Widget::update()
     *
     * @param   array   $new_instance   Values just sent to be saved.
     * @param   array   $old_instance   Previously saved values from database.
     *
     * @uses    online_estore_widgets_updated_field_value()     defined in onlineestore-widget-fields.php
     *
     * @return  array Updated safe values to be saved.
     */
    public function update( $new_instance, $old_instance ) {
        $instance = $old_instance;

        $widget_fields = $this->widget_fields();

        // Loop through fields
        foreach ( $widget_fields as $widget_field ) {

            extract( $widget_field );

            // Use helper function to get updated field values
            $instance[$online_estore_widgets_name] = online_estore_widgets_updated_field_value( $widget_field, $new_instance[$online_estore_widgets_name] );
        }

        return $instance;
    }

    /**
     * Back-end widget form.
     *
     * @see WP_Widget::form()
     *
     * @param   array $instance Previously saved values from database.
     *
     * @uses    online_estore_widgets_show_widget_field()       defined in onlineestore-widget-fields.php
     */
    public function form( $instance ) {
        $widget_fields = $this->widget_fields();

        // Loop through fields
        foreach ( $widget_fields as $widget_field ) {

            // Make array elements available as variables
            extract( $widget_field );
            $online_estore_widgets_field_value = !empty( $instance[$online_estore_widgets_name] ) ? wp_kses_post( $instance[$online_estore_widgets_name] ) : '';
            online_estore_widgets_show_widget_field( $this, $widget_field, $online_estore_widgets_field_value );
        }
    }
}