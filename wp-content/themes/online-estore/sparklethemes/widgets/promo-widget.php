<?php
/**
 * Promo Widget Display Block
 *
 * A Widget display promotional banner different Layout.
 *
 * @package Sparkle Themes
 * @subpackage Online eStore
 * @since 1.0.0
 */

class Online_Estore_Promo_Widget_Block extends WP_widget {

    /**
     * Register widget with WordPress.
     */
    public function __construct() {

        $widget_ops = array( 
            'classname' => 'online_estore_promo_block clearfix',
            'description' => esc_html__( 'A widget that promote you busincess with different layout promo image', 'online-estore' )
        );

        parent::__construct( 'online_estore_promo_block', esc_html__( '&bull; Promo Widget Block', 'online-estore' ), $widget_ops );
    }

    /**
     * Helper function that holds widget fields
     * Array is used in update and form functions
     */
    private function widget_fields() {

        $fields = array(

            'block_promo_image_one' => array(
                'online_estore_widgets_name' => 'block_promo_image_one',
                'online_estore_widgets_title' => esc_html__('Upload Promo One Image', 'online-estore'),
                'online_estore_widgets_field_type' => 'upload',
            ),

            'block_promo_block_one_title' => array(
                'online_estore_widgets_name'         => 'block_promo_block_one_title',
                'online_estore_widgets_title'        => esc_html__( 'Enter Promo Block One Title', 'online-estore' ),
                'online_estore_widgets_field_type'   => 'text'
            ),

            'block_promo_block_one_url' => array(
                'online_estore_widgets_name'         => 'block_promo_block_one_url',
                'online_estore_widgets_title'        => esc_html__( 'Enter Promo Block One URL', 'online-estore' ),
                'online_estore_widgets_field_type'   => 'url'
            ),


            'block_promo_image_two' => array(
                'online_estore_widgets_name' => 'block_promo_image_two',
                'online_estore_widgets_title' => esc_html__('Upload Promo Two Image', 'online-estore'),
                'online_estore_widgets_field_type' => 'upload',
            ),

            'block_promo_block_two_title' => array(
                'online_estore_widgets_name'         => 'block_promo_block_two_title',
                'online_estore_widgets_title'        => esc_html__( 'Enter Promo Block Two Title', 'online-estore' ),
                'online_estore_widgets_field_type'   => 'text'
            ),

            'block_promo_block_two_url' => array(
                'online_estore_widgets_name'         => 'block_promo_block_two_url',
                'online_estore_widgets_title'        => esc_html__( 'Enter Promo Block Two URL', 'online-estore' ),
                'online_estore_widgets_field_type'   => 'url'
            ),


            'block_promo_image_three' => array(
                'online_estore_widgets_name' => 'block_promo_image_three',
                'online_estore_widgets_title' => esc_html__('Upload Promo Three Image', 'online-estore'),
                'online_estore_widgets_field_type' => 'upload',
            ),

            'block_promo_block_three_title' => array(
                'online_estore_widgets_name'         => 'block_promo_block_three_title',
                'online_estore_widgets_title'        => esc_html__( 'Enter Promo Block Three Title', 'online-estore' ),
                'online_estore_widgets_field_type'   => 'text'
            ),

            'block_promo_block_three_url' => array(
                'online_estore_widgets_name'         => 'block_promo_block_three_url',
                'online_estore_widgets_title'        => esc_html__( 'Enter Promo Block Three URL', 'online-estore' ),
                'online_estore_widgets_field_type'   => 'url'
            ),

            'block_promo_layout' => array(
                'online_estore_widgets_name'         => 'block_promo_layout',
                'online_estore_widgets_title'        => esc_html__( 'Select Promo Display Layout', 'online-estore' ),
                'online_estore_widgets_default'      => 'onetothree',
                'online_estore_widgets_field_type'   => 'select',
                'online_estore_widgets_field_options' => array(
                        'onetothree' => esc_html__('1:3 (Layout)','online-estore'),
                        'onetotwo'   => esc_html__('1:2 (Layout)','online-estore'),
                        'twotoone'   => esc_html__('2:1 (Layout)','online-estore'),
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
            ),

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

        $promo_one_img     =  empty( $instance['block_promo_image_one'] ) ? '' : $instance['block_promo_image_one'];
        $promo_one_title   =  empty( $instance['block_promo_block_one_title'] ) ? '' : $instance['block_promo_block_one_title'];
        $promo_one_url     =  empty( $instance['block_promo_block_one_url'] ) ? '' : $instance['block_promo_block_one_url'];
        
        $promo_two_img     =  empty( $instance['block_promo_image_two'] ) ? '' : $instance['block_promo_image_two'];
        $promo_two_title   =  empty( $instance['block_promo_block_two_title'] ) ? '' : $instance['block_promo_block_two_title'];
        $promo_two_url     =  empty( $instance['block_promo_block_two_url'] ) ? '' : $instance['block_promo_block_two_url'];

        $promo_three_img   =  empty( $instance['block_promo_image_three'] ) ? '' : $instance['block_promo_image_three'];
        $promo_three_title =  empty( $instance['block_promo_block_three_title'] ) ? '' : $instance['block_promo_block_three_title'];
        $promo_three_url   =  empty( $instance['block_promo_block_three_url'] ) ? '' : $instance['block_promo_block_three_url'];
        
        $promo_layout      = empty( $instance['block_promo_layout'] ) ? 'fullbg' : $instance['block_promo_layout'];
        
        $padding_top    = empty( $instance['block_padding_top'] ) ? '' : $instance['block_padding_top'];
        $padding_bottom = empty( $instance['block_padding_bottom'] ) ? 35 : $instance['block_padding_bottom'];


        echo $before_widget;
    ?>
        <div class="container" <?php online_estore_widget_block_padding( $padding_top, $padding_bottom ); ?>>
                <div class="promo_block_widget <?php echo esc_attr($promo_layout); ?> ">
                    <?php if( !empty( $promo_one_img ) ){ ?>
                        <div class="promo_block_area <?php if( $promo_layout == 'onetothree' || $promo_layout == 'onetotwo' ){ ?>col-lg-4 col-md-4<?php }elseif ( $promo_layout == 'twotoone'){ ?>col-lg-8 col-md-8<?php } ?>">
                            <a href="<?php echo esc_url( $promo_one_url ); ?>" class="promo-banner-img">
                                <div class="promo-banner-img-inner">
                                    <div class="promo-bg-image-inner" style="background-image:url(<?php echo esc_url( $promo_one_img ); ?>)"></div>

                                    <div class="promo-img-info">
                                        <div class="promo-img-info-inner">
                                            <?php if(!empty( $promo_one_title )){ ?><h3><?php echo esc_html( $promo_one_title ); ?></h3><?php } ?>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </div>
                    <?php } ?>

                    <?php if( !empty( $promo_two_img ) ){ ?>
                        <div class="promo_block_area <?php if( $promo_layout == 'onetothree' || $promo_layout == 'twotoone' ){ ?>col-lg-4 col-md-4<?php }elseif ( $promo_layout == 'onetotwo'){ ?>col-lg-8 col-md-8<?php } ?>">
                            <a href="<?php echo esc_url( $promo_two_url ); ?>" class="promo-banner-img">
                                <div class="promo-banner-img-inner">
                                    <div class="promo-bg-image-inner" style="background-image:url(<?php echo esc_url( $promo_two_img ); ?>)"></div>

                                    <div class="promo-img-info">
                                        <div class="promo-img-info-inner">
                                            <?php if(!empty( $promo_two_title )){ ?><h3><?php echo esc_html( $promo_two_title ); ?></h3><?php } ?>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </div>
                    <?php } ?>

                    <?php if( $promo_layout == 'onetothree' ){ if( !empty( $promo_three_img ) ){ ?>
                        <div class="promo_block_area col-lg-4 col-md-4">
                            <a href="<?php echo esc_url( $promo_three_url ); ?>" class="promo-banner-img">
                                <div class="promo-banner-img-inner">
                                    <div class="promo-bg-image-inner" style="background-image:url(<?php echo esc_url( $promo_three_img ); ?>)"></div>

                                    <div class="promo-img-info">
                                        <div class="promo-img-info-inner">
                                            <?php if(!empty( $promo_three_title )){ ?><h3><?php echo esc_html( $promo_three_title ); ?></h3><?php } ?>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </div>
                    <?php } } ?>
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