<?php
/**
 * Multiple Category Product  Display Block
 *
 * Widget display multiple Category selected products different Layout.
 *
 * @package Sparkle Themes
 * @subpackage Online eStore
 * @since 1.0.0
 */

class online_estore_Multiple_Category_Products_Block extends WP_widget {

	/**
     * Register widget with WordPress.
     */
    public function __construct() {

        $widget_ops = array( 
            'classname' => 'online_estore_multiple_category_products_block clearfix',
            'description' => esc_html__( 'Display a grid & slide view of products from your selected categories.', 'online-estore' )
        );

        parent::__construct( 'online_estore_multiple_category_products_block', esc_html__( '&#9733; Products By Category', 'online-estore' ), $widget_ops );
    }

    /**
     * Helper function that holds widget fields
     * Array is used in update and form functions
     */
    private function widget_fields() {

        $multiple_products_categories = online_estore_products_categories_lists();
        
        $fields = array(

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

            'block_number_products' => array(
                'online_estore_widgets_name'         => 'block_number_products',
                'online_estore_widgets_title'        => esc_html__( 'Number of Products Displayed in Each Category', 'online-estore' ),
                'online_estore_widgets_default'      => 10,
                'online_estore_widgets_field_type'   => 'number'
            ),

            'block_product_column' => array(
                'online_estore_widgets_name'         => 'block_product_column',
                'online_estore_widgets_title'        => esc_html__( 'Display Product Number Column', 'online-estore' ),
                'online_estore_widgets_default'      => 3,
                'online_estore_widgets_field_type'   => 'select',
                'online_estore_widgets_field_options' => array(
                    '1' => __( 'One', 'online-estore' ),
                    '2' => __( 'Two', 'online-estore' ),
                    '3' => __( 'Three', 'online-estore' ),
                    '4' => __( 'Four', 'online-estore' ),
                    '5' => __( 'Five', 'online-estore' ),
                    '6' => __( 'Six', 'online-estore' ),
                    '7' => __( 'Seven', 'online-estore' ),
                    '8' => __( 'Eight', 'online-estore' ),
                    '9' => __( 'Nine', 'online-estore' ),
                )
            ),

            'block_category_column' => array(
                'online_estore_widgets_name'         => 'block_category_column',
                'online_estore_widgets_title'        => esc_html__( 'Display Category Number Column', 'online-estore' ),
                'online_estore_widgets_default'      => 3,
                'online_estore_widgets_field_type'   => 'select',
                'online_estore_widgets_field_options' => array(
                    '1' => __( 'One', 'online-estore' ),
                    '2' => __( 'Two', 'online-estore' ),
                    '3' => __( 'Three', 'online-estore' ),
                )
            ),

            'block_product_promo_title' => array(
                'online_estore_widgets_name'         => 'block_product_promo_title',
                'online_estore_widgets_title'        => esc_html__( 'Enter Promo Title', 'online-estore' ),
                'online_estore_widgets_description'  => esc_html__( 'Enter your promo title. (Optional - Leave blank to hide the title.)', 'online-estore' ),
                'online_estore_widgets_field_type'   => 'text'
            ),

            'block_product_promo_image' => array(
                'online_estore_widgets_name'         => 'block_product_promo_image',
                'online_estore_widgets_title'        => esc_html__( 'Upload Promo Image', 'online-estore' ),
                'online_estore_widgets_default'      => 5,
                'online_estore_widgets_field_type'   => 'upload'
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

        $block_title    = apply_filters( 'widget_title', !empty( $instance['block_title'] ) ? $instance['block_title'] : '', $instance, $this->id_base );
        
        $block_desc     = apply_filters( 'widget_description', !empty( $instance['block_desc'] ) ? $instance['block_desc'] : '', $instance, $this->id_base );

        $block_cat_id   = empty( $instance['block_product_cat_id'] ) ? '' : $instance['block_product_cat_id'];
        
        $block_cat_id   = unserialize($block_cat_id);
        $block_layout   = empty( $instance['block_display_layout'] ) ? 'layout1' : $instance['block_display_layout'];

        $product_promo_title = empty( $instance['block_product_promo_title'] ) ? '' : $instance['block_product_promo_title'];

        $product_promo_image = empty( $instance['block_product_promo_image'] ) ? '' : $instance['block_product_promo_image'];

        $product_number = empty( $instance['block_number_products'] ) ? 10 : $instance['block_number_products'];

        $product_column = empty( $instance['block_product_column'] ) ? 5 : $instance['block_product_column'];

        $category_column = empty( $instance['block_category_column'] ) ? 5 : $instance['block_category_column'];

        $padding_top    = empty( $instance['block_padding_top'] ) ? '' : $instance['block_padding_top'];
        
        $padding_bottom = empty( $instance['block_padding_bottom'] ) ? 35 : $instance['block_padding_bottom'];

        if( !empty( $block_cat_id ) ) {
            $checked_cats = array();
            foreach( $block_cat_id as $cat_key => $cat_value ){            
                $checked_cats[] = $cat_key;
            }
        } else {
            return;
        }

        $product_category = implode( ",", $checked_cats );
        $product_category = explode( ',', $product_category );

        echo $before_widget;
    ?>
        
        <div class="onlineestore_category_product_type <?php echo esc_attr( $block_layout  ); ?> column<?php echo intval($product_column); ?>" data-layout="<?php echo esc_attr( $block_layout  ); ?><?php echo intval($product_column); ?>" data-mulcolumn="<?php echo intval($product_column); ?>" <?php online_estore_widget_block_padding( $padding_top, $padding_bottom ); ?>>            
            <div class="container">      
                <div class="productwrapper">
                    <?php if( !empty( $block_title ) ) { ?>
                        <div class="blocktitlewrap">
                            <div class="blocktitle">
                                <h2><?php echo esc_html( $block_title ); ?></h2>
                                <?php if(!empty( $block_desc )) { ?><p><?php echo esc_html( $block_desc ); ?></p><?php } ?>
                            </div>
                        </div>
                    <?php } ?>
                    
                    <div class="products-by-category-wrap" data-typecolumn="<?php echo intval($category_column);?>">
                        <div class="products-by-category-promo">
                            <h4><?php echo esc_html( $product_promo_title ); ?></h4>
                            <img src="<?php echo esc_url( $product_promo_image ); ?>" alt="" class="products-by-category-promo-img">
                        </div>
                        <div class="products-by-category grid-grid grid-grid-<?php echo intval($category_column);?> <?php if( !empty( $block_layout ) && $block_layout == 'layout1' ){ echo esc_attr( 'xstorecatproductslider cS-hidden' ); }  ?>">
                        <?php
                            foreach( $product_category as $product_cat_id ) {
                                if( !intval( $product_cat_id ) ) continue;
                                $product_args = array(
                                    'post_type' => 'product',
                                    'tax_query' => array(
                                        array(
                                            'taxonomy'  => 'product_cat',
                                            'field'     => 'term_id', 
                                            'terms'     => $product_cat_id                                                                 
                                        )
                                    ),
                                    'posts_per_page' => $product_number
                                );

                                ?>

                                <div class="products-by-single-category">
                                <?php 
                                $term = get_term_by( 'id', $product_cat_id, 'product_cat' );
                                if ( $term ) { ?>
                                    <h3><?php echo esc_html( $term->name ); ?></h3>
                                <?php } ?>
                                
                                <ul class="onlineestore_products_type wow fadeInUp grid-grid grid-grid-<?php echo intval($product_column); ?>">
                                    <?php 
                                        $query = new WP_Query( $product_args );

                                        if($query->have_posts()) {  while($query->have_posts()) { $query->the_post();
                                    ?>
                                        <?php wc_get_template_part( 'content', 'product' ); ?>
                                        
                                    <?php } } wp_reset_postdata(); ?>                    
                                </ul> 
                            </div>

                        <?php }
                                
                        ?>
                            
                        </div>

                    </div>


                    
                </div>
            </div>
        </div>

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