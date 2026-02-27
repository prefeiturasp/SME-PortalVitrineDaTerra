<?php
/**
 * About Us Information
 *
 * Widget show the personal information with social media icons.
 *
 * @package Sparkle Themes
 * @subpackage Online eStore
 * @since 1.0.0
 */

class Online_Estore_Aboutus_Info extends WP_widget {

	/**
     * Register widget with WordPress.
     */
    public function __construct() {
        $widget_ops = array( 
            'classname' => 'online_estore_aboutus',
            'description' => esc_html__( 'A widget shows personal information with social media icons.', 'online-estore' )
        );
        parent::__construct( 'online_estore_aboutus', esc_html__( '&bull; About Us Info', 'online-estore' ), $widget_ops );
    }

    /**
     * Helper function that holds widget fields
     * Array is used in update and form functions
     */
    private function widget_fields() {
        
        $fields = array(

            'block_title' => array(
                'online_estore_widgets_name'         => 'block_title',
                'online_estore_widgets_title'        => esc_html__( 'Block Title', 'online-estore' ),
                'online_estore_widgets_field_type'   => 'text'
            ),

            'block_image' => array(
                'online_estore_widgets_name'         => 'block_image',
                'online_estore_widgets_title'        => esc_html__( 'Upload About Us Image', 'online-estore' ),
                'online_estore_widgets_field_type'   => 'upload'
            ),

            'block_aboutus_title' => array(
                'online_estore_widgets_name'         => 'block_aboutus_title',
                'online_estore_widgets_title'        => esc_html__( 'About Us Title', 'online-estore' ),
                'online_estore_widgets_field_type'   => 'text'
            ),

            'block_textarea' => array(
                'online_estore_widgets_name'         => 'block_textarea',
                'online_estore_widgets_title'        => esc_html__( 'About Us Short Text', 'online-estore' ),
                'online_estore_widgets_field_type'   => 'textarea',
                'online_estore_widgets_row'          => 4
            ),

            'block_fb_url' => array(
                'online_estore_widgets_name'         => 'block_fb_url',
                'online_estore_widgets_title'        => esc_html__( 'Facebook URL', 'online-estore' ),
                'online_estore_widgets_field_type'   => 'url'
            ),

            'block_tw_url' => array(
                'online_estore_widgets_name'         => 'block_tw_url',
                'online_estore_widgets_title'        => esc_html__( 'Twitter URL', 'online-estore' ),
                'online_estore_widgets_field_type'   => 'url'
            ),

            'block_linkedin_url' => array(
                'online_estore_widgets_name'         => 'block_linkedin_url',
                'online_estore_widgets_title'        => esc_html__( 'Linkedin URL', 'online-estore' ),
                'online_estore_widgets_field_type'   => 'url'
            ),

            'block_youtube_url' => array(
                'online_estore_widgets_name'         => 'block_youtube_url',
                'online_estore_widgets_title'        => esc_html__( 'Youtube URL', 'online-estore' ),
                'online_estore_widgets_field_type'   => 'url'
            ),

            'block_instagram_url' => array(
                'online_estore_widgets_name'         => 'block_instagram_url',
                'online_estore_widgets_title'        => esc_html__( 'Instagram URL', 'online-estore' ),
                'online_estore_widgets_field_type'   => 'url'
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

        $online_estore_block_title      = apply_filters( 'widget_title', !empty( $instance['block_title'] ) ? $instance['block_title'] : '', $instance, $this->id_base );
        $online_estore_aboutus_title    = empty( $instance['block_aboutus_title'] ) ? '' : $instance['block_aboutus_title'];
        $online_estore_block_image      = empty( $instance['block_image'] ) ? '' : $instance['block_image'];
        $online_estore_block_text       = empty( $instance['block_textarea'] ) ? '' : $instance['block_textarea'];
        $online_estore_block_fb         = empty( $instance['block_fb_url'] ) ? '' : $instance['block_fb_url'];
        $online_estore_block_tw         = empty( $instance['block_tw_url'] ) ? '' : $instance['block_tw_url'];
        $online_estore_block_ins        = empty( $instance['block_instagram_url'] ) ? '' : $instance['block_instagram_url'];
        $online_estore_block_lin        = empty( $instance['block_linkedin_url'] ) ? '' : $instance['block_linkedin_url'];
        $online_estore_block_yut        = empty( $instance['block_youtube_url'] ) ? '' : $instance['block_youtube_url'];


        echo $before_widget;
    ?>

        <div class="aboutus-wrap">
            <?php
                if ( ! empty( $online_estore_block_title ) ) {

                    echo $args['before_title'] . esc_html( $online_estore_block_title ) . $args['after_title'];

                }
            ?>
            <div class="author_widget">
                <?php if( !empty( $online_estore_block_image ) ){ ?>
                    <div class="author_thumb">
                        <img src="<?php echo esc_url( $online_estore_block_image ); ?>" alt="<?php echo esc_attr( $online_estore_aboutus_title ); ?>">
                    </div>
                <?php } if( !empty( $online_estore_aboutus_title ) ){ ?>
                    <div class="author_name">
                        <h4><?php echo esc_html( $online_estore_aboutus_title ); ?></h4>
                    </div>
                <?php } if( !empty( $online_estore_block_text ) ){ ?>
                    <div class="author_desc">
                        <p><?php echo esc_html( $online_estore_block_text ); ?></p>
                    </div>
                <?php } ?>
            </div>

            <div class="sociallink">
                <?php
                    if( !empty( $online_estore_block_fb ) || !empty( $online_estore_block_tw ) ){
                        echo '<ul>';
                                    if( !empty( $online_estore_block_fb ) ){ echo '<li><a href="'. esc_url( $online_estore_block_fb ) .'" target="_blank"><i class="'. esc_attr( 'fa fa-facebook' ) .'"></i></a></li>'; }
                                    if( !empty( $online_estore_block_tw ) ){ echo '<li><a href="'. esc_url( $online_estore_block_tw ) .'" target="_blank"><i class="'. esc_attr( 'fa fa-twitter' ) .'"></i></a></li>'; }
                                    if( !empty( $online_estore_block_lin ) ){ echo '<li><a href="'. esc_url( $online_estore_block_lin ) .'" target="_blank"><i class="'. esc_attr( 'fa fa-linkedin' ) .'"></i></a></li>'; }
                                    if( !empty( $online_estore_block_yut ) ){ echo '<li><a href="'. esc_url( $online_estore_block_yut ) .'" target="_blank"><i class="'. esc_attr( 'fa fa-youtube' ) .'"></i></a></li>'; }
                                    if( !empty( $online_estore_block_ins ) ){ echo '<li><a href="'. esc_url( $online_estore_block_ins ) .'" target="_blank"><i class="'. esc_attr( 'fa fa-instagram' ) .'"></i></a></li>'; }
                        echo '</ul>';
                    }
                ?>
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
     * @uses    online_estore_widgets_updated_field_value()     defined in widget-fields.php
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
     * @uses    online_estore_widgets_show_widget_field()       defined in widget-fields.php
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