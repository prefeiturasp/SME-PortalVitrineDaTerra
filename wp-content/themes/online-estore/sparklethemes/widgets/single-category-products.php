<?php
/**
 * Single Category Product  Display Block
 *
 * Widget display Single Category selected products different Layout.
 *
 * @package Sparkle Themes
 * @subpackage Online eStore
 * @since 1.0.0
 */

class Online_Estore_Single_Category_Products_Block extends WP_widget {

	/**
     * Register widget with WordPress.
     */
    public function __construct() {

        $widget_ops = array( 
            'classname' => 'online_estore_single_category_products_block clearfix',
            'description' => esc_html__( 'Displays single category products in list and slider display layouts.', 'online-estore' )
        );

        parent::__construct( 'online_estore_single_category_products_block', esc_html__( '&bull; Single Category Products', 'online-estore' ), $widget_ops );
    }

    /**
     * Helper function that holds widget fields
     * Array is used in update and form functions
     */
    private function widget_fields() {

        $title_style = array(
            'layout_one'  => esc_html__('Layout One', 'online-estore'),
            'layout_two'  => esc_html__('Layout Two', 'online-estore')
        );

        $single_products_categories = online_estore_products_categories_dropdown();
        
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

            'block_single_cat_id' => array(
                'online_estore_widgets_name'         => 'block_single_cat_id',
                'online_estore_widgets_title'        => esc_html__( 'Select Block Single Category', 'online-estore' ),
                'online_estore_widgets_default'      => 0,
                'online_estore_widgets_field_type'   => 'select',
                'online_estore_widgets_field_options' => $single_products_categories
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

            'block_number_products' => array(
                'online_estore_widgets_name'         => 'block_number_products',
                'online_estore_widgets_title'        => esc_html__( 'Enter Display Number of Products', 'online-estore' ),
                'online_estore_widgets_default'      => 5,
                'online_estore_widgets_field_type'   => 'number'
            ),

            'block_product_column' => array(
                'online_estore_widgets_name'         => 'block_product_column',
                'online_estore_widgets_title'        => esc_html__( 'Display Number Products Column', 'online-estore' ),
                'online_estore_widgets_default'      => 4,
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
        
        $title_layout       = empty( $instance['block_title_layout'] ) ? 'layout_one' : $instance['block_title_layout'];

        $block_desc         = apply_filters( 'widget_description', !empty( $instance['block_desc'] ) ? $instance['block_desc'] : '', $instance, $this->id_base );

        $block_cat_id       = empty( $instance['block_single_cat_id'] ) ? '' : $instance['block_single_cat_id'];
        
        $block_layout       = empty( $instance['block_display_layout'] ) ? 'layout1' : $instance['block_display_layout'];

        $product_number      = empty( $instance['block_number_products'] ) ? 5 : $instance['block_number_products'];

        $product_column     = empty( $instance['block_product_column'] ) ? 4 : $instance['block_product_column'];

        $padding_top    = empty( $instance['block_padding_top'] ) ? '' : $instance['block_padding_top'];
        
        $padding_bottom = empty( $instance['block_padding_bottom'] ) ? 35 : $instance['block_padding_bottom'];

        $product_args = array(
            'post_type' => 'product',
            'tax_query' => array(
                array(
                    'taxonomy'  => 'product_cat',
                    'field'     => 'term_id', 
                    'terms'     => $block_cat_id                                                                 
                )
            ),
            'posts_per_page' => $product_number
        );

        echo $before_widget;
    ?>
        <div class="onlineestore_single_category_product_type <?php echo esc_attr( $title_layout ); ?> <?php echo esc_attr( $block_layout  ); ?>" data-layout="<?php echo esc_attr( $block_layout  ); ?><?php echo intval($product_column); ?>" data-singlecolumn="<?php echo intval($product_column); ?>" <?php online_estore_widget_block_padding( $padding_top, $padding_bottom ); ?>>            
            <div class="container clearfix">      
                <div class="Productwrapper">
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
                    
                    <ul class="onlineestore_products_type wow fadeInUp grid-grid grid-grid-<?php echo intval($product_column); ?> <?php if( !empty( $block_layout ) && $block_layout == 'layout1' ){ echo esc_attr( 'xstorecatproductslider cS-hidden' ); } ?>">
                        <?php 
                            $query = new WP_Query( $product_args );

                            if($query->have_posts()) {  while($query->have_posts()) { $query->the_post();
                        ?>
                            <?php wc_get_template_part( 'content', 'product' ); ?>
                            
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