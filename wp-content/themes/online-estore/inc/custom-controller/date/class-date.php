<?php
/**
 * Customizer Control: onlineestore-switch
 *
 * @subpackage  Controls
 * @since       1.0
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( class_exists( 'WP_Customize_Control' ) && ! class_exists( 'OnlineEstore_Custom_Date_Control' ) ) :
    /**
     * Date Control
     */
    class OnlineEstore_Custom_Date_Control extends WP_Customize_Control {

        public $type = 'date_picker';
        
        public function enqueue() {
            wp_enqueue_style('online-estore-date-control', get_template_directory_uri() . '/inc/custom-controller/date/date.css', array(), '1.0.0');
            wp_enqueue_script('online-estore-date-control', get_template_directory_uri().'/inc/custom-controller/date/date.js', array( 'jquery', 'jquery-ui-datepicker' ), '1.0.0', true);
        }

        
        public function render_content() {
            ?>
            <label>
                <span class="customize-control-title">
                    <?php echo esc_html($this->label); ?>
                </span>

                <?php if ($this->description) { ?>
                    <span class="description customize-control-description">
                        <?php echo wp_kses_post($this->description); ?>
                    </span>
                <?php } ?>

                <input class="cl-datepicker-control" type="text" autocomplete="off" value="<?php echo esc_attr($this->value()); ?>" <?php $this->link(); ?>>
            </label>
            <?php
        }


        
    }
endif;