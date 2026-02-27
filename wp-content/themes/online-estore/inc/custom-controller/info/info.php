<?php
/**
 * Customizer Control: sparklewp-checkbox
 *
 * @subpackage  Controls
 * @since       1.0
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
if ( class_exists( 'WP_Customize_Control' ) && ! class_exists( 'OnlineEstore_Info_Text' ) ) :
    /**
     * Info Text Control
     */
    class OnlineEstore_Info_Text extends WP_Customize_Control {

        public function render_content() {
            ?>
            <span class="customize-control-title">
                <?php echo esc_html($this->label); ?>
            </span>

            <?php if ($this->description) { ?>
                <span class="customize-control-description">
                    <?php echo wp_kses_post($this->description); ?>
                </span>
                <?php
            }
        }

    }

    if ( class_exists( 'WP_Customize_Section' ) && ! class_exists( 'OnlineEstore_Customize_Section_H3' ) ) :
        class OnlineEstore_Customize_Section_H3 extends WP_Customize_Section {
    
            public $section;
            public $type = 'online_estore_section_h3';
    
            protected function render_template() {
                ?>
                <li id="accordion-section-{{ data.id }}" class="accordion-section control-section sparklewp-section-separator cannot-expand control-section-{{ data.type }}">
                    <h3 class="accordion-section-title accordion-section-h3" tabindex="0">
                        {{ data.title }}
                    </h3>
                </li>
                <?php
            }
    
        }
    endif;
    
endif;