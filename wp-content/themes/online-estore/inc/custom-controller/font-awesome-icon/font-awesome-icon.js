
(function ($) {
    jQuery(document).ready(function ($) {
        var delay = (function () {
            var timer = 0;
            return function (callback, ms) {
                clearTimeout(timer);
                timer = setTimeout(callback, ms);
            };
        })();
        
        // FontAwesome Icon Control JS
        $('body').on('click', '.online-estore-customizer-icon-box .online-estore-icon-list li', function () {
            var icon_class = $(this).find('i').attr('class');
            $(this).closest('.online-estore-icon-box').find('.online-estore-icon-list li').removeClass('icon-active');
            $(this).addClass('icon-active');
            $(this).closest('.online-estore-icon-box').prev('.online-estore-selected-icon').children('i').attr('class', '').addClass(icon_class);
            $(this).closest('.online-estore-icon-box').next('input').val(icon_class).trigger('change');
            $(this).closest('.online-estore-icon-box').slideUp();
        });
    
        $('body').on('click', '.online-estore-customizer-icon-box .online-estore-selected-icon', function () {
            $(this).next().slideToggle();
        });
    
        $('body').on('change', '.online-estore-customizer-icon-box .online-estore-icon-search select', function () {
            var selected = $(this).val();
            $(this).closest('.online-estore-icon-box').find('.online-estore-icon-search-input').val('');
            $(this).closest('.online-estore-icon-box').find('.online-estore-icon-list li').show();
            $(this).closest('.online-estore-icon-box').find('.online-estore-icon-list').hide().removeClass('active');
            $(this).closest('.online-estore-icon-box').find('.' + selected).fadeIn().addClass('active');
        });
    
        $('body').on('keyup', '.online-estore-customizer-icon-box .online-estore-icon-search input', function (e) {
            var $input = $(this);
            var keyword = $input.val().toLowerCase();
            search_criteria = $input.closest('.online-estore-icon-box').find('.online-estore-icon-list.active i');
    
            delay(function () {
                $(search_criteria).each(function () {
                    if ($(this).attr('class').indexOf(keyword) > -1) {
                        $(this).parent().show();
                    } else {
                        $(this).parent().hide();
                    }
                });
            }, 500);
        });

    });
})(jQuery);
