<?php
/**
 * Full Promotional Widget Display Block
 *
 * A Widget display promotional banner different Layout.
 *
 * @package Sparkle Themes
 * @subpackage Online eStore
 * @since 1.0.0
 */

class Online_Estore_Full_Promo_Type_Block extends WP_widget {

    /**
     * Register widget with WordPress.
     */
    public function __construct() {

        $widget_ops = array( 
            'classname' => 'online_estore_promotional_block clearfix',
            'description' => esc_html__( 'A widget that promote you busincess', 'online-estore' )
        );

        parent::__construct( 'online_estore_promotional_block', esc_html__( '&bull; Full Promo Widget Block', 'online-estore' ), $widget_ops );
    }

    /**
     * Helper function that holds widget fields
     * Array is used in update and form functions
     */
    private function widget_fields() {
        
        $onlineestore_pages = array();
        $onlineestore_pages_obj = get_pages();
        $onlineestore_pages[''] = esc_html__('Select Page','online-estore');
        foreach ($onlineestore_pages_obj as $page) {
            $onlineestore_pages[$page->ID] = $page->post_title;
        }

        $fields = array(

            'block_promo_page' => array(
                'online_estore_widgets_name'         => 'block_promo_page',
                'online_estore_widgets_title'        => esc_html__( 'Select Block Promo Page', 'online-estore' ),
                'online_estore_widgets_default'      => 'latest_product',
                'online_estore_widgets_field_type'   => 'select',
                'online_estore_widgets_field_options' => $onlineestore_pages
            ),

            'block_promo_button_title' => array(
                'online_estore_widgets_name'         => 'block_promo_button_title',
                'online_estore_widgets_title'        => esc_html__( 'Enter Promo Button One Title', 'online-estore' ),
                'online_estore_widgets_field_type'   => 'text'
            ),

            'block_promo_button_url' => array(
                'online_estore_widgets_name'         => 'block_promo_button_url',
                'online_estore_widgets_title'        => esc_html__( 'Enter Promo Button One URL', 'online-estore' ),
                'online_estore_widgets_field_type'   => 'url'
            ),


            'block_promo_button_one_title' => array(
                'online_estore_widgets_name'         => 'block_promo_button_one_title',
                'online_estore_widgets_title'        => esc_html__( 'Enter Promo Button Two Title', 'online-estore' ),
                'online_estore_widgets_field_type'   => 'text'
            ),

            'block_promo_button_one_url' => array(
                'online_estore_widgets_name'         => 'block_promo_button_one_url',
                'online_estore_widgets_title'        => esc_html__( 'Enter Promo Button Two URL', 'online-estore' ),
                'online_estore_widgets_field_type'   => 'url'
            ),

            'block_promo_layout' => array(
                'online_estore_widgets_name'         => 'block_promo_layout',
                'online_estore_widgets_title'        => esc_html__( 'Select Block Products Type', 'online-estore' ),
                'online_estore_widgets_default'      => 'latest_product',
                'online_estore_widgets_field_type'   => 'select',
                'online_estore_widgets_field_options' => array(
                        'fullbg'   => esc_html__('Full Width Background', 'online-estore'),
                        'boxedbg'   => esc_html__('Boxed Background', 'online-estore')
                    )
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

        $button_title           =  empty( $instance['block_promo_button_title'] ) ? '' : $instance['block_promo_button_title'];
        $button_url             =  empty( $instance['block_promo_button_url'] ) ? '' : $instance['block_promo_button_url'];
        $button_one_title       =  empty( $instance['block_promo_button_one_title'] ) ? '' : $instance['block_promo_button_one_title'];
        $button_one_url         =  empty( $instance['block_promo_button_one_url'] ) ? '' : $instance['block_promo_button_one_url'];
        $block_promo_id         =  empty( $instance['block_promo_page'] ) ? 2 : $instance['block_promo_page'];
        $block_promo_layout     = empty( $instance['block_promo_layout'] ) ? 'fullbg' : $instance['block_promo_layout'];

        echo $before_widget;
  
         if( !empty( $block_promo_id ) ) {

         $block_promo_page = new WP_Query( 'page_id='.$block_promo_id );

         if( $block_promo_page->have_posts() ) { while( $block_promo_page->have_posts() ) { $block_promo_page->the_post();
         
         $full_promo_image = wp_get_attachment_image_src( get_post_thumbnail_id() , 'full', true );         
    
         if( !empty( $block_promo_layout ) && $block_promo_layout == 'fullbg' ){
    ?>
        <div class="onlineestore_promo_wrapper" <?php if( !empty( $full_promo_image ) ){ ?> style="background-image:url(<?php echo esc_url( $full_promo_image[0] ); ?>);background-repeat:no-repeat;background-size:cover;background-attachment:fixed;background-position: center;"<?php }else{ ?>style="background-color: #ccc;"<?php } ?>>
            <div class="container">
                <div class="row">
                    <div class="onlineestore_full_widget_content">
                        <h2 class="wow zoomIn"><?php the_title(); ?></h2>
                        <div class="onlineestore_subtitle wow zoomIn"><?php the_excerpt(); ?></div>
                    </div>

                    <div class="onlineestore_button_wrap">
                        <?php if( !empty( $button_title ) || !empty( $button_url ) ){ ?>

                            <a href="<?php echo esc_url( $button_url ) ?>" class="btn btn-primary wow fadeInLeft">
                                <?php echo esc_html( $button_title ); ?>
                            </a>

                        <?php } if( !empty( $button_one_title ) || !empty( $button_one_url ) ){ ?>

                            <a href="<?php echo esc_url( $button_one_url ) ?>" class="btn btn-primary wow fadeInRight">
                                <?php echo esc_html( $button_one_title ); ?> 
                            </a>

                        <?php } ?>
                    </div>
                </div>
            </div>
        </div>

    <?php }else{ ?>
    
            <div class="container">
                <div class="row">
                    <div class="onlineestore_promo_wrapper" <?php if( !empty( $full_promo_image ) ){ ?> style="background-image:url(<?php echo esc_url( $full_promo_image[0] ); ?>);background-repeat:no-repeat;background-size:cover;background-attachment:fixed;background-position: center;"<?php }else{ ?>style="background-color: #ccc;"<?php } ?>>
                        <div class="onlineestore_full_widget_content">
                            <h2 class="wow zoomIn"><?php the_title(); ?></h2>
                            <div class="onlineestore_subtitle wow zoomIn"><?php the_excerpt(); ?></div>
                        </div>

                        <div class="onlineestore_button_wrap">
                            <?php if( !empty( $button_title ) || !empty( $button_url ) ){ ?>

                                <a href="<?php echo esc_url( $button_url ) ?>" class="btn btn-primary wow fadeInLeft">
                                    <?php echo esc_html( $button_title ); ?>
                                </a>

                            <?php } if( !empty( $button_one_title ) || !empty( $button_one_url ) ){ ?>

                                <a href="<?php echo esc_url( $button_one_url ) ?>" class="btn btn-primary wow fadeInRight">
                                    <?php echo esc_html( $button_one_title ); ?>
                                </a>

                            <?php } ?>
                        </div>
                    </div>
                </div>
            </div>

    <?php } } } wp_reset_postdata(); } 

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