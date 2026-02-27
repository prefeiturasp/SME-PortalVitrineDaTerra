jQuery(document).ready(function ($) {
    $('#meu-plugin-form').on('submit', function (e) {
        e.preventDefault();

        var form = $(this);
        var formData = new FormData(form[0]);

        $.ajax({
            url: meu_plugin_ajax_obj.ajax_url,
            type: 'POST',
            data: formData,
            processData: false,
            contentType: false,
            beforeSend: function (xhr) {
                xhr.setRequestHeader('X-WP-Nonce', meu_plugin_ajax_obj.nonce);
            },
            success: function (response) {
                if (response.success) {
                    $('#meu-plugin-result').text(response.message);
                } else {
                    $('#meu-plugin-result').text('Erro ao enviar o formulário.');
                }
            },
            error: function () {
                $('#meu-plugin-result').text('Erro ao enviar o formulário.');
            }
        });
    });
});
