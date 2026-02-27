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
if ( class_exists( 'WP_Customize_Control' ) && ! class_exists( 'OnlineEstore_Sortable_Control' ) ) :
   
    /**
     * Sortable Control
     */
    class OnlineEstore_Sortable_Control extends WP_Customize_Control {

        /**
         * The control type.
         *
         * @access public
         * @var string
         */
        public $type = 'sortable';


        public function enqueue() {
            wp_enqueue_style('online-estore-sortable-control', get_template_directory_uri() . '/inc/custom-controller/sortable/sortable.css', array(), '1.0.0');
            wp_enqueue_script('online-estore-sortable-control', get_template_directory_uri().'/inc/custom-controller/sortable/sortable.js', array( 'jquery', 'jquery-ui-datepicker' ), '1.0.0', true);
        }

        /**
         * Refresh the parameters passed to the JavaScript via JSON.
         *
         * @see WP_Customize_Control::to_json()
         */
        public function to_json() {
            parent::to_json();

            $this->json['default'] = $this->setting->default;
            if (isset($this->default)) {
                $this->json['default'] = $this->default;
            }
            $this->json['value'] = maybe_unserialize($this->value());
            $this->json['choices'] = $this->choices;
            $this->json['link'] = $this->get_link();
            $this->json['id'] = $this->id;

            $this->json['inputAttrs'] = '';
            foreach ($this->input_attrs as $attr => $value) {
                $this->json['inputAttrs'] .= $attr . '="' . esc_attr($value) . '" ';
            }

            $this->json['inputAttrs'] = maybe_serialize($this->input_attrs());
        }

        /**
         * An Underscore (JS) template for this control's content (but not its container).
         *
         * Class variables for this control class are available in the `data` JS object;
         * export custom variables by overriding {@see WP_Customize_Control::to_json()}.
         *
         * @see WP_Customize_Control::print_template()
         *
         * @access protected
         */
        protected function content_template() {
            ?>
            <label class='online-estore-sortable'>
                <span class="customize-control-title">
                    {{{ data.label }}}
                </span>
                <# if ( data.description ) { #>
                <span class="description customize-control-description">{{{ data.description }}}</span>
                <# } #>

                <ul class="sortable">
                    <# _.each( data.value, function( choiceID ) { #>
                    <li {{{ data.inputAttrs }}} class='online-estore-sortable-item' data-value='{{ choiceID }}'>
                        <i class='dashicons dashicons-menu'></i>
                        <i class="dashicons dashicons-visibility visibility"></i>
                        {{{ data.choices[ choiceID ] }}}
                    </li>
                    <# }); #>
                    <# _.each( data.choices, function( choiceLabel, choiceID ) { #>
                    <# if ( -1 === data.value.indexOf( choiceID ) ) { #>
                    <li {{{ data.inputAttrs }}} class='online-estore-sortable-item invisible' data-value='{{ choiceID }}'>
                        <i class='dashicons dashicons-menu'></i>
                        <i class="dashicons dashicons-visibility visibility"></i>
                        {{{ data.choices[ choiceID ] }}}
                    </li>
                    <# } #>
                    <# }); #>
                </ul>
            </label>
            <?php
        }

    }
endif;

if( !function_exists('online_estore_sanitize_multi_choices')){
    function online_estore_sanitize_multi_choices($input, $setting) {
        // Get list of choices from the control associated with the setting.
        $choices = $setting->manager->get_control($setting->id)->choices;
        $input_keys = $input;
    
        foreach ($input_keys as $key => $value) {
            if (!array_key_exists($value, $choices)) {
                unset($input[$key]);
            }
        }
    
        // If the input is a valid key, return it;
        // otherwise, return the default.
        return ( is_array($input) ? $input : $setting->default );
    }
}