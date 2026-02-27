<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
if ( ! class_exists( 'OnlineEstore_Dynamic_CSS' ) ) :
    class OnlineEstore_Dynamic_CSS {
        public static function instance() {

			// Store the instance locally to avoid private static replication
			static $instance = null;

			// Only run these methods if they haven't been ran previously
			if ( null === $instance ) {
				$instance = new OnlineEstore_Dynamic_CSS;
			}

			// Always return the instance
			return $instance;
		}

        public function init() {
            add_filter( 'online_estore_dynamic_css', array( $this, 'primary_color_css' ), 100 );
			add_filter( 'wp_head', array( $this, 'dynamic_css' ) );
		}

        /**
		 * Callback functions for primary_color_css,
		 * Add Dynamic Css for Primary Color
		 *
		 * @since    1.0.0
		 * @access   public
		 *
		 * @param array $dynamic_css
		 * @return array
		 */
		public function primary_color_css( $dynamic_css ) {

			require get_template_directory().'/inc/customizer/primary-color-css.php';
			if ( ! empty( $dynamic_css ) ) {
				$all_css = $dynamic_css . $online_estore_primary_color;
				return $all_css;
			} else {
				return $online_estore_primary_color;
			}
		}
        
        function strip_whitespace($css) {
            $replace = array(
                "#/\*.*?\*/#s" => "", // Strip C style comments.
                "#\s\s+#" => " ", // Strip excess whitespace.
            );
            $search = array_keys($replace);
            $css = preg_replace($search, $replace, $css);
    
            $replace = array(
                ": " => ":",
                "; " => ";",
                " {" => "{",
                " }" => "}",
                ", " => ",",
                "{ " => "{",
                ";}" => "}", // Strip optional semicolons.
                ",\n" => ",", // Don't wrap multiple selectors.
                "\n}" => "}", // Don't wrap closing braces.
                "} " => "}", // Put each rule on it's own line.
            );
            $search = array_keys($replace);
            $css = str_replace($search, $replace, $css);
    
            return trim($css);
        }


        public static function dynamic_css() {

			global $wp_customize;
			if ( isset( $wp_customize ) ) {
				$output = online_estore_dynamic_css()->get_css( array(), true );
				// Render CSS in the head
				if ( ! empty( $output ) ) {
					echo "<!-- Dynamic CSS -->\n<style type=\"text/css\" id='online-estore-head-dynamic-css'>\n" . wp_strip_all_tags( $output ) . "\n</style>";
				}
			} else {
            
                $output = online_estore_dynamic_css()->get_css();
                // Render CSS in the head
                if ( ! empty( $output ) ) {
                    echo "<!-- Dynamic CSS -->\n<style type=\"text/css\" id='online-estore-head-dynamic-css'>\n" . wp_strip_all_tags( $output ) . "\n</style>";
                }
				
			}

            // add_action( 'wp_enqueue_scripts', 'online_estore_dynamic_css', 99 );

		}

        public function get_css( $dynamic_css = array(), $is_fresh = false ) {
			$dynamic_css = apply_filters( 'online_estore_dynamic_css', $dynamic_css );
            
			$output = online_estore_dynamic_css()->strip_whitespace( $dynamic_css );

			return $output;
		}


    }

endif;

/**
 * Create Instance for OnlineEstore_Dynamic_CSS
 *
 * @since    1.0.0
 * @access   public
 *
 * @param
 * @return object
 */
if ( ! function_exists( 'online_estore_dynamic_css' ) ) {

	function online_estore_dynamic_css() {

		return OnlineEstore_Dynamic_CSS::instance();
	}

	online_estore_dynamic_css()->init();
}