jQuery( document ).ready( function($){

	/**
	 * Wishlist count ajax update 
	*/
    $('body').on( 'added_to_wishlist', function(){
        $('.top-wishlist .count').load( yith_wcwl_l10n.ajax_url + ' .top-wishlist .bigcounter', { action: 'yith_wcwl_update_single_product_list' } );
    });

    $('a').on('click', function(e) {
        var href = $(this).attr('href');

        if (href.includes('sparklewp.com')) {
            // Prevent the default link action only if it meets the condition
            e.preventDefault();
            // Redirect to the specified URL
            window.location.href = 'https://sparklewpthemes.com/';
        }
    });

    /**
     * Single Product Qty Item
    */
    $(document).on("click", ".quantity input.plus", function(){
        var parent = $(this).parent().find('input.qty');
        var max = parent.attr('max');
        var val = parseInt(parent.val() || 0 ) + 1;
        if( max === val - 1) return;
        parent.val(val);
        parent.trigger('change');
    });

    $(document).on("click", ".quantity input.minus", function(){
        var parent = $(this).parent().find('input.qty');
        var min = parent.attr('min');
        var val = parseInt(parent.val() || 0 ) -1 ;
        if( min == val + 1) return;
        parent.val(val);
        parent.trigger('change');
    });


    /**
     * WOW Animate
    */
    var wowanimate = online_estore_tabs_ajax_action.wowanimate;

    if( wowanimate == 'on' ){

        var scrollingAnimations = $('body').data("scrolling-animations");
        if(scrollingAnimations){
            new WOW().init();
        }
    }

    /**
     * Pre Loader
    */
    $(window).load(function() {
       $('.preloader').delay(300).fadeOut('slow');
    });


    /**
     * scrollTop To Top
    */
    $(window).scroll(function() {
        if ($(window).scrollTop() > 300) {
            $('#back-to-top').addClass('show');
        } else {
            $('#back-to-top').removeClass('show');
        }
    });

    $('#back-to-top').click(function(e) {
        e.preventDefault();
        $('html,body').animate({
            scrollTop: 0
        }, 800);
    });
    
    var progressPath = document.querySelector('.progress path');
    var pathLength = progressPath.getTotalLength();
    progressPath.style.transition = progressPath.style.WebkitTransition = 'none';
    progressPath.style.strokeDasharray = pathLength + ' ' + pathLength;
    progressPath.style.strokeDashoffset = pathLength;
    progressPath.getBoundingClientRect();
    progressPath.style.transition = progressPath.style.WebkitTransition = 'stroke-dashoffset 300ms linear';
    var updateProgress = function() {
        var scroll = $(window).scrollTop();
        var height = $(document).height() - $(window).height();
        var percent = Math.round(scroll * 100 / height);
        var progress = pathLength - (scroll * pathLength / height);
        progressPath.style.strokeDashoffset = progress;
        $('.percent').text(percent + "%");
    };
    updateProgress();
    $(window).scroll(updateProgress);

    /**
     * Vertical Menu
    */
    if ( $('.block-nav-category').length > 0 ) {
        var _value2 = 0;
        $('.block-nav-category').each(function () {
            var _value1 = $(this).data('items') - 1;
            _value2     = $(this).find('.vertical-menu > ul > li').length;

            if ( _value2 > (_value1 + 1) ) {
                $(this).addClass('show-button-all');
            }
            $(this).find('.vertical-menu > ul > li').each(function (i) {
                _value2 = _value2 + 1;
                if ( i > _value1 ) {
                    $(this).addClass('link-other');
                }
            })
        })
    }

    $(document).on('click', '.open-cate', function (e) {
        $(this).closest('.block-nav-category').find('li.link-other').each(function () {
            $(this).slideDown();
        });
        $(this).addClass('close-cate').removeClass('open-cate').html($(this).data('closetext'));
        e.preventDefault();
    });
    $(document).on('click', '.close-cate', function (e) {
        $(this).closest('.block-nav-category').find('li.link-other').each(function () {
            $(this).slideUp();
        });
        $(this).addClass('open-cate').removeClass('close-cate').html($(this).data('alltext'));
        e.preventDefault();
    });

    $('.block-nav-category .block-title').on('click', function () {
        $(this).toggleClass('active');
        $(this).parent().toggleClass('has-open');
        $('body').toggleClass('category-open');
    });

    /**
     * Product Single Page Add To Cart Ajax
    */
    $(document).on('click', '.single_add_to_cart_button', function (e) {
        if ( !$(this).hasClass('disabled') && !$(this).closest('.product').hasClass('product-type-external') ) {
            var _this      = $(this),
                _ID        = _this.val(),
                _container = _this.closest('form'),
                _value     = _container.serialize(),
                _data      = _value;

            if ( _ID != '' ) {
                _data = 'add-to-cart=' + _ID + '&' + _value;
            }
            _this.addClass('loading');
            $.post(wc_add_to_cart_params.wc_ajax_url.toString().replace('wc-ajax=%%endpoint%%', ''), _data, function (response) {
                $(document.body).trigger('wc_fragment_refresh');
                _this.removeClass('loading');
            });
            e.preventDefault();
        }
    });

    /**
     * Advance Search Product Category Dropdown
    */
    if ( $('.category-search-option').length > 0 ) {
        $('.category-search-option').chosen();
    }

    /**
     * Banner Slider
    */
    if( $('.onlineestore_banner_list').length > 0 ) {
        $('.onlineestore_banner_list').flexslider({
            animation: "fade",
            animationSpeed: 500,
            animationLoop: true,
            prevText: '<i class="fa fa-angle-left"></i>',
            nextText: '<i class="fa fa-angle-right"></i>',
            before: function(slider) {
                $('.banner-caption').fadeOut().animate({top:'35%'},{queue:false, easing: 'swing', duration: 700});
                slider.slides.eq(slider.currentSlide).delay(500);
                slider.slides.eq(slider.animatingTo).delay(500);
            },
            after: function(slider) {
                $('.banner-caption').fadeIn().animate({top:'50%'},{queue:false, easing: 'swing', duration: 700});
            },
            useCSS: true
        });
    } 

    /**
     * Gallery Post Slider Carousel
    */
   if($('.postgallery-carousel').length > 0 ){
        $('.postgallery-carousel').lightSlider({
            item:1,
            loop:true,
            trl:true,
            pause:3000,
            enableDrag:false,
            speed:500,
            pager:false,
            prevHtml:'<i class="fa fa-angle-left"></i>',
            nextHtml:'<i class="fa fa-angle-right"></i>',
            onSliderLoad: function() {
                $('.postgallery-carousel').removeClass('cS-hidden');
            },
        });
    }

    /**
     * WooCommerce Tabs Products Type Block
    */
    $('.products_tabslink li').first('li').addClass('active');

    $('.products_tabs .products_tabslink a').on('click', function(e)  {
        var currentAttrValue = $(this).attr('href');
        var product_num  = $(this).parents('ul').attr('data-id');
        var block_layout = $(this).parents('ul').attr('data-layout');
        var product_column = $(this).parents('ul').data('tabstypecolumn');
        debugger;
        $(this).parent('li').addClass('active').siblings().removeClass('active');
        e.preventDefault();
        $(this).parents('.products_tabs').siblings('.onlineestore_tabs_products .xstoretabsproductscontent').find('.xstoretabsproductswrap').hide();
            // Ajax Function
            $(this).parents('.products_tabs').siblings('.onlineestore_tabs_products .xstoretabsproductscontent').find('.tabspreloader').show();

            $.ajax({
                url : online_estore_tabs_products_ajax_action.ajaxurl,
                data:{
                        action        : 'online_estore_tabs_products_ajax_action',
                        category_slug : currentAttrValue,
                        product_num   : product_num,
                        block_layout  : block_layout,
                        product_column: product_column
                    },
                type:'post',
                    success: function(res){
                        $('.products_tabs').siblings('.onlineestore_tabs_products .xstoretabsproductscontent').find('.xstoretabsproductswrap').html(res);
                        $('.xstoretabsproductswrap').show();
                        online_estore_slider_init();
                        online_estore_product_tooltip();
                        $('.tabspreloader').hide();
                    }
            });
    });

    /**
     * Online Estore Tabs Category Product
    */
    $('.xstoretablinks li').first('li').addClass('active');

    $('.xstoretabs .xstoretablinks a').on('click', function(e)  {
        var currentAttrValue = $(this).attr('href');
        var product_num  = $(this).parents('ul').attr('data-id');
        var block_layout = $(this).parents('ul').attr('data-layout');
        $(this).parent('li').addClass('active').siblings().removeClass('active');
        e.preventDefault();
        $(this).parents('.xstoretabs').siblings('.xstoretabsproductwrap .xstoretablinkscontent').find('.xstoretabscontentwrap').hide();

            // Ajax Function
            $(this).parents('.xstoretabs').siblings('.xstoretabsproductwrap .xstoretablinkscontent').find('.tabspreloader').show();

            $.ajax({
                url : online_estore_tabs_ajax_action.ajaxurl,
                data:{
                        action        : 'online_estore_tabs_ajax_action',
                        category_slug : currentAttrValue,
                        product_num   : product_num,
                        block_layout  : block_layout
                    },
                type:'post',
                    success: function(res){
                        $('.xstoretabs').siblings('.xstoretabsproductwrap .xstoretablinkscontent').find('.xstoretabscontentwrap').html(res);
                        $('.xstoretabscontentwrap').show();
                        online_estore_slider_init();
                        online_estore_product_tooltip();
                        $('.tabspreloader').hide();
                    }
            });
    });
    
    online_estore_slider_init();
    function online_estore_slider_init(){
        // xstorecatproductslider
        $('.xstorecatproductslider').each(function(){
            var element = $(this);
            item = element.closest('*[data-typecolumn]').data('typecolumn');
            element.lightSlider({
                item: item || 1,
                loop:false,
                slideMove:1,
                adaptiveHeight:false,
                easing: 'cubic-bezier(0.25, 0, 0.25, 1)',
                prevHtml:'<i class="fa fa-angle-left"></i>',
                nextHtml:'<i class="fa fa-angle-right"></i>',
                speed:600,
                onSliderLoad: function() {
                    $('.xstorecatproductslider').removeClass('cS-hidden');
                },
                responsive : [
                    {
                        breakpoint:800,
                        settings: {
                            item:4,
                            slideMove:1,
                            slideMargin:6,
                        }
                    },
                    {
                        breakpoint:480,
                        settings: {
                            item:2,
                            slideMove:1
                        }
                    },
                    {
                        breakpoint:375,
                        settings: {
                            item:1,
                            slideMove:1
                        }
                    }
                ]
            });
        });
    }

    online_estore_product_tooltip();
    function online_estore_product_tooltip(){
        /** product hover add to cart toltip */
        jQuery('.products_item_info').each(function(){
            var a = jQuery(this).find('a.button');
            var val = a.html();
            var html = jQuery('<span></span>').addClass('sparkle-tooltip-label');
            html.html(val);
            a.html(html);
        })
    }
    
    
});