/**
 * File customizer.js.
 *
 * Theme Customizer enhancements for a better user experience.
 *
 * Contains handlers to make Theme Customizer preview reload changes asynchronously.
 */

( function( $ ) {

	// Site title and description.
	wp.customize( 'blogname', function( value ) {
		value.bind( function( to ) {
			$( '.site-title a' ).text( to );
		} );
	} );
	wp.customize( 'blogdescription', function( value ) {
		value.bind( function( to ) {
			$( '.site-description' ).text( to );
		} );
	} );

	// Header text color.
	wp.customize( 'header_textcolor', function( value ) {
		value.bind( function( to ) {
			if ( 'blank' === to ) {
				$( '.site-title, .site-description' ).css( {
					'clip': 'rect(1px, 1px, 1px, 1px)',
					'position': 'absolute'
				} );
			} else {
				$( '.site-title, .site-description' ).css( {
					'clip': 'auto',
					'position': 'relative'
				} );
				$( '.site-title a, .site-description' ).css( {
					'color': to
				} );
			}
		} );
	} );

	//hide show top header height
	wp.customize('header-top-height-option', function (setting) {
        var headerTopHeight = function (control) {
            var visibility = function () {
                if ('custom' === setting.get()) {
                    control.container.removeClass('customizer-hidden');
                } else {
					control.container.addClass('customizer-hidden');
                    
                }
            };
            visibility();
            setting.bind(visibility);
        };

        wp.customize.control('top-header-height', headerTopHeight);
    });

	// show/hide custom background options
	wp.customize('header-top-bg-options', function (setting) {
        var headerTopBgOptions = function (control) {
            var visibility = function () {
                if ('custom' === setting.get()) {
                    control.container.removeClass('customizer-hidden');
                } else {
					control.container.addClass('customizer-hidden');
                    
                }
            };
            visibility();
            setting.bind(visibility);
        };

        wp.customize.control('header-top-background-options', headerTopBgOptions);
    });

    // show/hide header bottom height control
	wp.customize('header-bottom-height-option', function (setting) {
        var headerBottomHeightOption = function (control) {
            var visibility = function () {
                if ('custom' === setting.get()) {
                    control.container.removeClass('customizer-hidden');
                } else {
					control.container.addClass('customizer-hidden');
                    
                }
            };
            visibility();
            setting.bind(visibility);
        };

        wp.customize.control('bottom-header-height', headerBottomHeightOption);
    });

	// show/hide header bottom background options
	wp.customize('header-bottom-bg-options', function (setting) {
        var headerBottomBgOptions = function (control) {
            var visibility = function () {
                if ('custom' === setting.get()) {
                    control.container.removeClass('customizer-hidden');
                } else {
					control.container.addClass('customizer-hidden');
                    
                }
            };
            visibility();
            setting.bind(visibility);
        };

        wp.customize.control('header-bottom-background-options', headerBottomBgOptions);
    });

    // show/hide main header background color
	wp.customize('online_estore_main_header_bg_type', function (setting) {
        
        var main_header_bg_type = function (control) {
            var visibility = function () {
                if ('color-bg' === setting.get()) {
                    control.container.removeClass('customizer-hidden');
                } else {
					control.container.addClass('customizer-hidden');
                }
            };
            visibility();
            setting.bind(visibility);
        };
        wp.customize.control('online_estore_main_header_bg_color', main_header_bg_type);

        var main_header_bg_type_2 = function (control) {
            var visibility_2 = function () {
                if ('gradient-bg' === setting.get()) {
                    control.container.removeClass('customizer-hidden');
                } else {
					control.container.addClass('customizer-hidden');
                }
            };
            visibility_2();
            setting.bind(visibility_2);
        };
        wp.customize.control('online_estore_main_header_bg_gradient', main_header_bg_type_2);

        var main_header_bg_type_3 = function (control) {
            var visibility_3 = function () {
                if ('image-bg' === setting.get()) {
                    control.container.removeClass('customizer-hidden');
                } else {
					control.container.addClass('customizer-hidden');
                }
            };
            visibility_3();
            setting.bind(visibility_3);
        };
        wp.customize.control('header_image', main_header_bg_type_3);

    });

    // show/hide main header background color
	wp.customize('cart-icon-options', function (setting) {
        var cartIconOptions = function (control) {
            var cart_text_visibility = function () {
                if ( ('text' === setting.get())  || ('both' === setting.get()) ) {
                    control.container.removeClass('customizer-hidden');
                } else {
					control.container.addClass('customizer-hidden');
                    
                }
            };
            cart_text_visibility();
            setting.bind(cart_text_visibility);
        };

        wp.customize.control('cart-text', cartIconOptions);
    });

	// show/hide menu open text
	wp.customize('menu-icon-open-icon-options', function (setting) {

        var openMenuOptions = function (control) {
            var menu_text_open_visibility = function () {
                if ( 'text' === setting.get() || 'both' === setting.get() ) {
                    control.container.removeClass('customizer-hidden');
                } else {
					control.container.addClass('customizer-hidden');
                    
                }
            };
            menu_text_open_visibility();
            setting.bind(menu_text_open_visibility);
        };
        wp.customize.control('menu-open-text', openMenuOptions);
        
        var openMenuOptions_3 = function (control) {
            var m_o_i_s_r_visibility = function () {
                if ( 'icon' === setting.get() || 'both' === setting.get() ) {
                    control.container.removeClass('customizer-hidden');
                } else {
					control.container.addClass('customizer-hidden');
                    
                }
            };
            m_o_i_s_r_visibility();
            setting.bind(m_o_i_s_r_visibility);
        };
        wp.customize.control('menu-open-icon-size-responsive', openMenuOptions_3);

    });

    // show/hide close menu text
	wp.customize('menu-icon-close-icon-options', function (setting) {
        var closeMenuOptions = function (control) {
            var menu_close_text_visibility = function () {
                if ( ('text' === setting.get()) || ('both' === setting.get()) ) {
                    control.container.removeClass('customizer-hidden');
                } else {
					control.container.addClass('customizer-hidden');
                    
                }
            };
            menu_close_text_visibility();
            setting.bind(menu_close_text_visibility);
        };
        wp.customize.control('menu-close-text', closeMenuOptions);

        var closeMenuOptions_2 = function (control) {
            var m_i_c_i_p_visibility = function () {
                if ('icon' === setting.get() || ('both' === setting.get()) ) {
                    control.container.removeClass('customizer-hidden');
                } else {
					control.container.addClass('customizer-hidden');
                    
                }
            };
            m_i_c_i_p_visibility();
            setting.bind(m_i_c_i_p_visibility);
        };

        wp.customize.control('menu-icon-close-icon-position', closeMenuOptions_2);

    });    

} )( jQuery );

// Extends our custom section.
(function (api) {
        
    api.sectionConstructor['online-estore-upgrade-section'] = api.Section.extend({

        // No events for this type of section.
        attachEvents: function () {},

        // Always make the section active.
        isContextuallyActive: function () {
            return true;
        }
    });

})(wp.customize);

( function( api ) {

	// Extends our custom "online estore" section.
	api.sectionConstructor['online-estore-pro'] = api.Section.extend( {

		// No events for this type of section.
		attachEvents: function () {},

		// Always make the section active.
		isContextuallyActive: function () {
			return true;
		}
	} );

} )( wp.customize );