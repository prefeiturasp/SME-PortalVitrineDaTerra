<?php

if ( class_exists( 'WP_Customize_Control' ) ) {

    if ( !class_exists( 'Online_Estore_Upgrade_Text') ) {

        class Online_Estore_Upgrade_Text extends WP_Customize_Control {

            public $type = 'online-estore-upgrade-text';

            public function render_content() {
                ?>
                <label>
                    <span class="dashicons dashicons-info"></span>

                    <?php if ($this->label) { ?>
                        <span>
                            <?php echo wp_kses_post($this->label); ?>
                        </span>
                    <?php } ?>

                    <a href="<?php echo esc_url('https://sparklewpthemes.com/wordpress-themes/online-estore-pro-multipurpose-woocommerce-theme/'); ?>" target="_blank"> <strong><?php echo esc_html__('Upgrade to PRO', 'online-estore'); ?></strong></a>
                </label>

                <?php if ($this->description) { ?>
                    <span class="description customize-control-description">
                        <?php echo wp_kses_post($this->description); ?>
                    </span>
                    <?php
                }

                $choices = $this->choices;
                if ($choices) {
                    echo '<ul>';
                    foreach ($choices as $choice) {
                        echo '<li>' . esc_html($choice) . '</li>';
                    }
                    echo '</ul>';
                }
            }
        }
    } 

}

if ( class_exists( 'WP_Customize_Section' ) ) {
	
	if ( !class_exists( 'Online_Estore_Customize_Upgrade_Section' ) ) {

		class Online_Estore_Customize_Upgrade_Section extends WP_Customize_Section {

	        /**
	         * The type of customize section being rendered.
	         *
	         * @since  1.0.0
	         * @access public
	         * @var    string
	         */
	        public $type = 'online-estore-upgrade-section';

	        /**
	         * Custom button text to output.
	         *
	         * @since  1.0.0
	         * @access public
	         * @var    string
	         */
	        public $text = '';
	        public $options = array();

	        /**
	         * Add custom parameters to pass to the JS via JSON.
	         *
	         * @since  1.0.0
	         * @access public
	         * @return void
	         */
	        public function json() {
	            $json = parent::json();

	            $json['text'] = $this->text;
	            $json['options'] = $this->options;

	            return $json;
	        }

	        /**
	         * Outputs the Underscore.js template.
	         *
	         * @since  1.0.0
	         * @access public
	         * @return void
	         */
	        protected function render_template() {
	            ?>
	            <li id="accordion-section-{{ data.id }}" class="accordion-section control-section control-section-{{ data.type }} cannot-expand">
	                <label>
	                    <# if ( data.title ) { #>
	                    {{ data.title }}
	                    <# } #>
	                </label>

	                <# if ( data.text ) { #>
	                {{ data.text }}
	                <# } #>

	                <# _.each( data.options, function(key, value) { #>
	                {{ key }}<br/>
	                <# }) #>

	                <a href="<?php echo esc_url('https://sparklewpthemes.com/wordpress-themes/online-estore-pro-multipurpose-woocommerce-theme/'); ?>" class="button button-primary" target="_blank"><?php echo esc_html__('Upgrade to Pro', 'online-estore'); ?></a>
	            </li>
	            <?php
	        }
	    }

	}

}

if( class_exists( 'WP_Customize_Section' ) ) {

	if( !class_exists( 'Online_Estore_Customize_Section_Pro' ) ) {

		class Online_Estore_Customize_Section_Pro extends WP_Customize_Section {

			/**
			 * The type of customize section being rendered.
			 *
			 * @since  1.0.0
			 * @access public
			 * @var    string
			 */
			public $type = 'online-estore-pro';
		
			/**
			 * Custom button text to output.
			 *
			 * @since  1.0.0
			 * @access public
			 * @var    string
			 */
			public $pro_text = '';
		
			/**
			 * Custom pro button URL.
			 *
			 * @since  1.0.0
			 * @access public
			 * @var    string
			 */
			public $pro_url = '';
		
			/**
			 * Add custom parameters to pass to the JS via JSON.
			 *
			 * @since  1.0.0
			 * @access public
			 * @return void
			 */
			public function json() {
				$json = parent::json();
		
				$json['pro_text'] = $this->pro_text;
				$json['pro_url']  = esc_url( $this->pro_url );
		
				return $json;
			}
		
			/**
			 * Outputs the Underscore.js template.
			 *
			 * @since  1.0.0
			 * @access public
			 * @return void
			 */
			protected function render_template() { ?>
		
				<li id="accordion-section-{{ data.id }}" class="accordion-section control-section control-section-{{ data.type }} cannot-expand">
		
					<h3 class="accordion-section-title">
						{{ data.title }}
		
						<# if ( data.pro_text && data.pro_url ) { #>
							<a href="{{ data.pro_url }}" class="button button-primary" target="_blank">{{ data.pro_text }}</a>
						<# } #>
					</h3>
				</li>
			<?php }
		}

	}

}