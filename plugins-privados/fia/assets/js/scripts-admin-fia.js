
jQuery(document).ready(function ($) {
    "use strict";

    $(document).on('click', 'hndle', function () {
        return false;
    });

    $("#description_section, #postexcerpt, #woocommerce-product-data, #submitdiv, #postimagediv,#woocommerce-product-images, #product_catdiv, #tagsdiv-product_tag").removeClass("closed");


    var fia_meta_boxes_product_notes = {
        init: function () {
            $('#fia-mensagens-produto')
                .on('click', 'button.add_note', this.add_order_note)
                .on('click', 'a.delete_note', this.delete_order_note);

        },

        add_order_note: function () {
            if (!$('textarea#add_order_note').val()) {
                return;
            }

            $('#fia-mensagens-produto').block({
                message: null,
                overlayCSS: {
                    background: '#fff',
                    opacity: 0.6
                }
            });

            var data = {
                action: 'fia_add_product_note',
                post_id: $('#post_ID').val(),
                fia_add_product_note_nonce: scripts_admin_fia_ajax.fia_add_product_note_nonce,
                note: $('textarea#add_order_note').val(),
            };

            $.post(scripts_admin_fia_ajax.ajax_url, data, function (response) {
                $('ul.order_notes .no-items').remove();
                $('ul.order_notes').prepend(response);
                $('#fia-mensagens-produto').unblock();
                $('#add_order_note').val('');
            });

            return false;
        },

        delete_order_note: function () {
            if (window.confirm(woocommerce_admin_meta_boxes.i18n_delete_note)) {
                var note = $(this).closest('li.note');

                $(note).block({
                    message: null,
                    overlayCSS: {
                        background: '#fff',
                        opacity: 0.6
                    }
                });

                var data = {
                    action: 'woocommerce_delete_order_note',
                    note_id: $(note).attr('rel'),
                    security: woocommerce_admin_meta_boxes.delete_order_note_nonce
                };

                $.post(woocommerce_admin_meta_boxes.ajax_url, data, function () {
                    $(note).remove();
                });
            }

            return false;
        }
    };
    fia_meta_boxes_product_notes.init();
});
