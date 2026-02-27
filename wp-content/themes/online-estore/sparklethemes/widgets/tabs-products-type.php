<?php
/**
 * Tabs Products type Block
 *
 * Widget show the Products Category Tabs Different Layout.
 *
 * @package Sparkle Themes
 * @subpackage Online eStore
 * @since 1.0.0
 */

class Online_Estore_Tabs_Products_Type_Block extends WP_widget {

	/**
     * Register widget with WordPress.
     */
    public function __construct() {

        $widget_ops = array( 
            'classname' => 'online_estore_tabs_products_type_block clearfix',
            'description' => esc_html__( 'Displays ( Latest, Features, Onsale, Upsale ) products tabs layouts.', 'online-estore' )
        );

        parent::__construct( 'online_estore_tabs_products_type_block', esc_html__( '&bull; Tabs Products type', 'online-estore' ), $widget_ops );
    }

    /**
     * Helper function that holds widget fields
     * Array is used in update and form functions
     */
    private function widget_fields() {

        $tabs_style = array(
            'tabs_layout_one'  => esc_html__('Layout One', 'online-estore'),
            'tabs_layout_two'  => esc_html__('Layout Two', 'online-estore'),
            'tabs_layout_three'  => esc_html__('Layout Three', 'online-estore')
        );

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


            'block_tabs_layout' => array(
                'online_estore_widgets_name'         => 'block_tabs_layout',
                'online_estore_widgets_title'        => esc_html__( 'Select Block Tabs Style', 'online-estore' ),
                'online_estore_widgets_default'      => 'tabs_layout_one',
                'online_estore_widgets_field_type'   => 'select',
                'online_estore_widgets_field_options' => $tabs_style
            ),


            'block_latest_disable' => array(
                'online_estore_widgets_name' => 'block_latest_disable',
                'online_estore_widgets_title' => esc_html__('Checked To Disable Latest Products', 'online-estore'),
                'online_estore_widgets_field_type' => 'checkbox',
            ),

            'block_latest_products' => array(
                'online_estore_widgets_name'         => 'block_latest_products',
                'online_estore_widgets_title'        => esc_html__( 'Enter Latest Products Title', 'online-estore' ),
                'online_estore_widgets_description'  => esc_html__( '(Optional - Leave blank to display "Latet Products")', 'online-estore' ),
                'online_estore_widgets_field_type'   => 'text'
            ),

            'block_feature_disable' => array(
                'online_estore_widgets_name' => 'block_feature_disable',
                'online_estore_widgets_title' => esc_html__('Checked To Disable Feature Products', 'online-estore'),
                'online_estore_widgets_field_type' => 'checkbox',
            ),

            'block_feature_products' => array(
                'online_estore_widgets_name'         => 'block_feature_products',
                'online_estore_widgets_title'        => esc_html__( 'Enter Feature Products Title', 'online-estore' ),
                'online_estore_widgets_description'  => esc_html__( '(Optional - Leave blank to display "Feature Products")', 'online-estore' ),
                'online_estore_widgets_field_type'   => 'text'
            ),

            'block_on_disable' => array(
                'online_estore_widgets_name' => 'block_on_disable',
                'online_estore_widgets_title' => esc_html__('Checked To Disable On Sale Products', 'online-estore'),
                'online_estore_widgets_field_type' => 'checkbox',
            ),

            'block_on_sale_products' => array(
                'online_estore_widgets_name'         => 'block_on_sale_products',
                'online_estore_widgets_title'        => esc_html__( 'Enter On Sale Products Title', 'online-estore' ),
                'online_estore_widgets_description'  => esc_html__( '(Optional - Leave blank to display "On Sale Products")', 'online-estore' ),
                'online_estore_widgets_field_type'   => 'text'
            ),

            'block_up_disable' => array(
                'online_estore_widgets_name' => 'block_up_disable',
                'online_estore_widgets_title' => esc_html__('Checked To Disable UpSale Products', 'online-estore'),
                'online_estore_widgets_field_type' => 'checkbox',
            ),

            'block_up_sale_products' => array(
                'online_estore_widgets_name'         => 'block_up_sale_products',
                'online_estore_widgets_title'        => esc_html__( 'Enter UpSale Products Title', 'online-estore' ),
                'online_estore_widgets_description'  => esc_html__( '(Optional - Leave blank to display "UpSale Products")', 'online-estore' ),
                'online_estore_widgets_field_type'   => 'text'
            ),


            'block_display_layout' => array(
                'online_estore_widgets_name'           => 'block_display_layout',
                'online_estore_widgets_title'        => esc_html__( 'Product Display Layouts', 'online-estore' ),
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

        $title_layout   = empty( $instance['block_title_layout'] ) ? 'layout_one' : $instance['block_title_layout'];

        $block_title     = apply_filters( 'widget_title', !empty( $instance['block_title'] ) ? $instance['block_title'] : '', $instance, $this->id_base );
        
        $block_desc      = apply_filters( 'widget_description', !empty( $instance['block_desc'] ) ? $instance['block_desc'] : '', $instance, $this->id_base );

        $tabs_layout    = empty( $instance['block_tabs_layout'] ) ? 'layout_one' : $instance['block_tabs_layout'];
        
        $block_layout   = empty( $instance['block_display_layout'] ) ? 'layout1' : $instance['block_display_layout'];

        $product_number  = empty( $instance['block_number_products'] ) ? 5 : $instance['block_number_products'];
        
        $product_column = empty( $instance['block_product_column'] ) ? 4 : $instance['block_product_column'];

        $padding_top    = empty( $instance['block_padding_top'] ) ? '' : $instance['block_padding_top'];
        
        $padding_bottom = empty( $instance['block_padding_bottom'] ) ? 35 : $instance['block_padding_bottom'];


        $latest_disable   = empty( $instance['block_latest_disable'] ) ? '' : $instance['block_latest_disable'];
        $latest_products   = empty( $instance['block_latest_products'] ) ? 'Latest Products' : $instance['block_latest_products'];

        $feature_disable   = empty( $instance['block_feature_disable'] ) ? '' : $instance['block_feature_disable'];
        $feature_products   = empty( $instance['block_feature_products'] ) ? 'Features Products' : $instance['block_feature_products'];

        $on_disable   = empty( $instance['block_on_disable'] ) ? '' : $instance['block_on_disable'];
        $on_products   = empty( $instance['block_on_sale_products'] ) ? 'On Sale Products' : $instance['block_on_sale_products'];

        $up_disable   = empty( $instance['block_up_disable'] ) ? '' : $instance['block_up_disable'];
        $up_products   = empty( $instance['block_up_sale_products'] ) ? 'Up Sale Products' : $instance['block_up_sale_products'];

        global $product_label_custom;
        $product_label_custom = esc_html__('New', 'online-estore');

        $product_args = array(
            'post_type' => 'product',
            'posts_per_page' => $product_number
        );

        echo $before_widget;
    ?>
       <div class="onlineestore_tabs_products <?php echo esc_attr( $title_layout ); ?> <?php echo esc_attr( $tabs_layout  ); ?> <?php echo esc_attr( $block_layout  ); ?>" data-layout="<?php echo esc_attr( $block_layout  ); ?><?php echo intval($product_column); ?>" data-tabstypecolumn="<?php echo intval($product_column); ?>" <?php online_estore_widget_block_padding( $padding_top, $padding_bottom ); ?>>
            <div class="container clearfix">      
                <div class="row">
                    <?php if( !empty( $title_layout ) && $title_layout == 'layout_one' ){ ?>
                        <div class="blocktitlewrap  clearfix">
                            <div class="blocktitle">
                                <?php if( !empty( $block_title ) ) { ?><h2 class="wow zoomIn"><?php echo esc_html( $block_title ); ?></h2><?php } ?>
                                <?php if(!empty( $block_desc )) { ?><p class="wow zoomIn"><?php echo esc_html( $block_desc ); ?></p><?php } ?>
                            </div>
                        </div>
                    <?php } ?>

                    <div class="products_tabs clearfix">

                        <?php if( !empty( $title_layout ) && $title_layout == 'layout_two' ){ ?>
                            <div class="blocktitle">
                                <?php if( !empty( $block_title ) ) { ?><h2><?php echo esc_html( $block_title ); ?></h2><?php } ?>
                            </div>
                        <?php } ?>
                        
                        <ul class="products_tabslink clearfix wow zoomIn" data-id="<?php echo intval( $product_number ); ?>" data-layout="<?php echo esc_attr( $block_layout ); ?>" data-tabstypecolumn="<?php echo intval($product_column); ?>">
                            
                            <?php if($latest_disable != 1){ ?>

                                <li>
                                    <a href="latest_products" data-toggle="tab" aria-expanded="false">
                                        <?php echo esc_html( $latest_products ); ?>
                                    </a>
                                </li>

                            <?php } if($feature_disable != 1){ ?>

                                <li>
                                    <a href="feature_products" data-toggle="tab" aria-expanded="false">
                                        <?php echo esc_html( $feature_products ); ?>
                                    </a>
                                </li>

                            <?php } if($on_disable != 1){ ?>

                                <li>
                                    <a href="on_products" data-toggle="tab" aria-expanded="false">
                                        <?php echo esc_html( $on_products ); ?>
                                    </a>
                                </li>

                            <?php } if($up_disable != 1){ ?>

                                <li>
                                    <a href="up_products" data-toggle="tab" aria-expanded="false">
                                        <?php echo esc_html( $up_products ); ?>
                                    </a>
                                </li>

                            <?php } ?>
                            
                        </ul>

                        <div class="xstoreaction">
                            <div class="onlineestore-lSPrev"><i class="fa fa-angle-left"></i></div>
                            <div class="onlineestore-lSNext"><i class="fa fa-angle-right"></i></div>
                        </div>

                    </div>
                    
                    <div class="xstoretabsproductscontent">
                        
                        <div class="tabspreloader" style="display:none;">
                           <svg width="200px"  height="200px"  xmlns="" viewBox="0 0 100 100" preserveAspectRatio="xMidYMid" class="lds-eclipse" style="background: none;"><path ng-attr-d="{{config.pathCmd}}" ng-attr-fill="{{config.color}}" stroke="none" d="M10 50A40 40 0 0 0 90 50A40 42 0 0 1 10 50" fill="#e86785" transform="rotate(233.818 50 51)"><animateTransform attributeName="transform" type="rotate" calcMode="linear" values="0 50 51;360 50 51" keyTimes="0;1" dur="1s" begin="0s" repeatCount="indefinite"></animateTransform></path></svg>
                        </div>

                        <div class="xstoretabsproductswrap">
                           <div class="xstoretabsproductsarea" data-typecolumn="<?php echo intval($product_column); ?>">

                                <ul class="onlineestore_products_type  wow fadeInUp grid-grid grid-grid-<?php echo intval($product_column); ?> <?php if( !empty( $block_layout ) && $block_layout == 'layout1' ){ echo esc_attr( 'tabs_products xstorecatproductslider  cS-hidden' ); }  ?>">
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