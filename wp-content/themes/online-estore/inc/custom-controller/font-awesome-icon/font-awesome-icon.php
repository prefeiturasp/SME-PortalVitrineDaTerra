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
if ( class_exists( 'WP_Customize_Control' ) && ! class_exists( 'OnlineEstore_Fontawesome_Icon_Chooser' ) ) :
    /**
     * Fontawesome Icon Select
     */
    class OnlineEstore_Fontawesome_Icon_Chooser extends WP_Customize_Control {

        public $type = 'icon';
        public $icon_array = array();

        public function __construct($manager, $id, $args = array()) {
            if (isset($args['icon_array'])) {
                $this->icon_array = $args['icon_array'];
            }
            parent::__construct($manager, $id, $args);
        }

        /**
		 * enqueue css and scrpts
		 *
		 * @since  1.0.0
		 */

		public function enqueue() {
            wp_enqueue_style('font-awesome-icon-control', get_template_directory_uri() . '/inc/custom-controller/font-awesome-icon/font-awesome-icon.css', array(), '1.0.0');
			wp_enqueue_script('font-awesome-icon-control', get_template_directory_uri().'/inc/custom-controller/font-awesome-icon/font-awesome-icon.js', array( 'jquery', 'jquery-ui-slider' ), '1.0.0', true);
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
                <div class="online-estore-customizer-icon-box">
                    <div class="online-estore-selected-icon">
                        <i class="<?php echo esc_attr($this->value()); ?>"></i>
                        <span class="dashicons dashicons-arrow-down-alt2"></span>
                    </div>

                    <div class="online-estore-icon-box">
                        <div class="online-estore-icon-search">
                            <input type="text" class="online-estore-icon-search-input" placeholder="<?php echo esc_attr__('Type to filter', 'online-estore'); ?>" />
                        </div>

                        <ul class="online-estore-icon-list clearfix active">
                            <?php
                            if (isset($this->icon_array) && !empty($this->icon_array)) {
                                $online_estore_font_awesome_icon_array = $this->icon_array;
                            } else {
                                $online_estore_font_awesome_icon_array = online_estore_font_awesome_icon_array();
                            }

                            foreach ($online_estore_font_awesome_icon_array as $online_estore_font_awesome_icon) {
                                $icon_class = $this->value() == $online_estore_font_awesome_icon ? 'icon-active' : '';
                                echo '<li class=' . esc_attr($icon_class) . '><i class="' . esc_attr($online_estore_font_awesome_icon) . '"></i></li>';
                            }
                            ?>
                        </ul>
                    </div>
                    <input type="hidden" value="<?php esc_attr($this->value()); ?>" <?php $this->link(); ?> />
                </div>
            </label>
            <?php
        }

    }
endif;