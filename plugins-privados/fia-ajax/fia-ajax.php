<?php
/*
Plugin Name: Meu Plugin AJAX
Description: Plugin para gerar shortcode de formulário de cadastro com envio de imagem através de AJAX.
Version: 1.0
Author: Seu Nome
*/

// Função para exibir o formulário com o shortcode
function meu_plugin_ajax_form_shortcode()
{
    ob_start();
    ?>
    <form id="meu-plugin-form" method="post" enctype="multipart/form-data">
        <label for="nome">Nome:</label>
        <input type="text" name="nome" id="nome" required>

        <label for="email">E-mail:</label>
        <input type="email" name="email" id="email" required>

        <label for="imagem">Imagem:</label>
        <input type="file" name="imagem" id="imagem" accept="image/*" required>

        <input type="submit" value="Enviar">
    </form>
    <div id="meu-plugin-result"></div>
    <?php
    return ob_get_clean();
}
add_shortcode('meu_plugin_form', 'meu_plugin_ajax_form_shortcode');

// Função para processar o formulário através de AJAX
function meu_plugin_ajax_form_handler()
{
    check_ajax_referer('meu_plugin_ajax_nonce', 'security');

    // Lógica para processar os dados do formulário e fazer o upload da imagem
    // (Você precisará adicionar a lógica para salvar os dados no banco de dados e manipular o upload da imagem aqui)

    // Simulando uma resposta bem-sucedida
    $response = array(
        'success' => true,
        'message' => 'Formulário enviado com sucesso!',
    );

    // Envia a resposta JSON
    wp_send_json_success($response);
}
add_action('wp_ajax_meu_plugin_submit_form', 'meu_plugin_ajax_form_handler');
add_action('wp_ajax_nopriv_meu_plugin_submit_form', 'meu_plugin_ajax_form_handler');

// Função para enfileirar scripts e estilos necessários
function meu_plugin_enqueue_scripts()
{
    wp_enqueue_script('meu-plugin-ajax-script', plugin_dir_url(__FILE__) . 'meu-plugin-ajax.js', array('jquery'), '1.0', true);
    wp_localize_script('meu-plugin-ajax-script', 'meu_plugin_ajax_obj', array(
        'ajax_url' => admin_url('admin-ajax.php'),
        'nonce' => wp_create_nonce('meu_plugin_ajax_nonce'),
    )
    );
}
add_action('wp_enqueue_scripts', 'meu_plugin_enqueue_scripts');