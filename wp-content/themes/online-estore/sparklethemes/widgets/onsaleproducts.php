<?php
/**
 * Products Type Display Block
 *
 * Widget display products type different Layout.
 *
 * @package Sparkle Themes
 * @subpackage Online eStore
 * @since 1.0.0
 */

class Online_Estore_Onsale_Selling_Products_Block extends WP_widget {

	/**
     * Register widget with WordPress.
     */
    public function __construct() {

        $widget_ops = array( 
            'classname' => 'online_estore_onsale_selling_products_block clearfix',
            'description' => esc_html__( 'Display a grid & slider view of your on sale products.', 'online-estore' )
        );

        parent::__construct( 'online_estore_onsale_selling_products_block', esc_html__( '&#9733; On Sale Products', 'online-estore' ), $widget_ops );
    }

    /**
     * Helper function that holds widget fields
     * Array is used in update and form functions
     */
    private function widget_fields() {
        
        $fields = array(

            'block_title' => array(
                'online_estore_widgets_name'         => 'block_title',
                'online_estore_widgets_title'        => esc_html__( 'Enter Block Title', 'online-estore' ),
                'online_estore_widgets_description'  => esc_html__( 'Enter your block title. (Optional - Leave blank to hide the title.)', 'online-estore' ),
                'online_estore_widgets_field_type'   => 'text'
            ),

            'block_subtitle' => array(
                'online_estore_widgets_name'         => 'block_subtitle',
                'online_estore_widgets_title'        => esc_html__( 'Enter Block Sub Title', 'online-estore' ),
                'online_estore_widgets_description'  => esc_html__( 'Enter block sub-title. ( Optional - Leave blank to hide the sub-title )', 'online-estore' ),
                'online_estore_widgets_field_type'   => 'text'
            ),

            'block_desc' => array(
                'online_estore_widgets_name'         => 'block_desc',
                'online_estore_widgets_title'        => esc_html__( 'Enter Block Short Description', 'online-estore' ),
                'online_estore_widgets_description'  => esc_html__( 'Enter your block description. (Optional - Leave blank to hide the description.)', 'online-estore' ),
                'online_estore_widgets_field_type'   => 'textarea'
            ),

            'block_bg_image' => array(
                'online_estore_widgets_name'         => 'block_bg_image',
                'online_estore_widgets_title'        => esc_html__( 'Upload Background Image', 'online-estore' ),
                'online_estore_widgets_description'  => esc_html__( 'Upload block background image. ( Optional - Neglect Upload to Show block Without Background Image )', 'online-estore' ),
                'online_estore_widgets_field_type'   => 'upload'
            ),

            'block_button_text' => array(
                'online_estore_widgets_name'        => 'block_button_text',
                'online_estore_widgets_title'       => esc_html__( 'Enter Block Button Text', 'online-estore' ),
                'online_estore_widgets_description' => esc_html__( 'Enter block button text. ( Optional - Leave blank to hide the button )', 'online-estore' ),
                'online_estore_widgets_field_type'  => 'text'
            ),

            'block_button_url' => array(
                'online_estore_widgets_name'        => 'block_button_url',
                'online_estore_widgets_title'       => esc_html__( 'Enter Block Button Url', 'online-estore' ),
                'online_estore_widgets_description' => esc_html__( 'Custom Link', 'online-estore' ),
                'online_estore_widgets_field_type'  => 'text'
            ),

            'block_display_layout' => array(
                'online_estore_widgets_name'           => 'block_display_layout',
                'online_estore_widgets_title'        => esc_html__( 'Display Block Layouts', 'online-estore' ),
                'online_estore_widgets_default'      => 'layout1',
                'online_estore_widgets_field_type'   => 'selector',
                'online_estore_widgets_field_options' => array(
                    'layout1' => esc_url( get_template_directory_uri() . '/assets/images/boxpromoslider.png' ),
                    'layout2' => esc_url( get_template_directory_uri() . '/assets/images/boxpromosliderright.png' ),
                    'layout3' => esc_url( get_template_directory_uri() . '/assets/images/gridlayout.png' )
                )
            ),

            'block_number_products' => array(
                'online_estore_widgets_name'         => 'block_number_products',
                'online_estore_widgets_title'        => esc_html__( 'Number of Products', 'online-estore' ),
                'online_estore_widgets_default'      => 10,
                'online_estore_widgets_field_type'   => 'number'
            ),

            'block_product_column' => array(
                'online_estore_widgets_name'         => 'block_product_column',
                'online_estore_widgets_title'        => esc_html__( 'Number of Column', 'online-estore' ),
                'online_estore_widgets_default'      => 5,
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

        $block_title        = apply_filters( 'widget_title', !empty( $instance['block_title'] ) ? $instance['block_title'] : '', $instance, $this->id_base );
        
        $block_subtitle     = !empty( $instance['block_subtitle'] ) ? $instance['block_subtitle'] : ''; 

        $block_desc         = !empty( $instance['block_desc'] ) ? $instance['block_desc'] : '';

        $block_bg_image     = !empty( $instance['block_bg_image'] ) ? $instance['block_bg_image'] : '';

        $block_button_text  = !empty( $instance['block_button_text'] ) ? $instance['block_button_text'] : '';

        $block_button_url   = !empty( $instance['block_button_url'] ) ? $instance['block_button_url'] : '';

        $block_layout       = empty( $instance['block_display_layout'] ) ? 'layout1' : $instance['block_display_layout'];

        $product_number     = empty( $instance['block_number_products'] ) ? 10 : $instance['block_number_products'];

        $product_column     = empty( $instance['block_product_column'] ) ? 5 : $instance['block_product_column'];

        $padding_top        = empty( $instance['block_padding_top'] ) ? '' : $instance['block_padding_top'];
        
        $padding_bottom     = empty( $instance['block_padding_bottom'] ) ? 35 : $instance['block_padding_bottom'];

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
            )
        );

        echo $before_widget;
    ?>
        
        <div class="onlineestore_category_product_type <?php echo esc_attr( $block_layout  ); ?>" data-layout="<?php echo esc_attr( $block_layout  ); ?><?php echo intval($product_column); ?>" data-typecolumn="<?php echo intval($product_column); ?>" style="background-image: url( <?php echo esc_url( $block_bg_image ); ?> ); padding-top: <?php echo esc_attr( $padding_top ) ?>; padding-bottom: <?php echo esc_attr( $padding_bottom ); ?>">            
            <div class="container">      
                <div class="productwrapper" data-typecolumn="<?php echo intval($product_column); ?>">

                    <?php if( !empty( $block_title ) ) { ?>
                        <div class="blocktitlewrap text-on-left">
                            <div class="blocktitle">
                                <span class="subtitle"><?php echo esc_html( $block_title ); ?></span>
                                <h2><?php echo esc_html( $block_subtitle ); ?></h2>
                                <?php if(!empty( $block_desc )) { ?><p><?php echo esc_textarea( $block_desc ); ?></p><?php } ?>
                                <?php 
                                    if( $block_button_text ) { ?>
                                        <a href="<?php echo esc_url( $block_button_url ) ?>" class="btn-black"><?php echo esc_html( $block_button_text ) ?></a>
                                <?php }
                                ?>
                            </div>
                        </div>
                    <?php } ?>
                    
                    <ul class="onlineestore_products_type wow fadeInUp grid-grid grid-grid-<?php echo intval($product_column); ?> <?php if( !empty( $block_layout ) && $block_layout == 'layout1' ){ echo esc_attr( 'xstorecatproductslider cS-hidden' ); }  ?>">
                        <?php 
                            $query = new WP_Query( $product_args );

                            if($query->have_posts()) {  while($query->have_posts()) { $query->the_post();
                        ?>
                            <?php 
                                if( $block_layout == 'layout1' || $block_layout == 'layout2' )
                                    wc_get_template_part( 'content', 'product' ); 
                                if ( $block_layout == 'layout3' ) : 
                                    do_action( 'onsale_products_layout_3' );
                                endif;
                            ?>
                            
                        <?php } } wp_reset_postdata(); ?>                    
                    </ul> 
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