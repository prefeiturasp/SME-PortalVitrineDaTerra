<?php

function buscar_produtos_com_validade_expirada()
{
    $data_atual = date('Y-m-d');

    $args = array(
        'post_type' => 'product',
        'posts_per_page' => -1,
        'post_status' => 'publish',
        'meta_query' => array(
            array(
                'key' => 'validade',
                'value' => $data_atual,
                'compare' => '<',
                'type' => 'DATE'
            )
        )
    );
    $query = new WP_Query($args);


    if ($query->have_posts()) {
        while ($query->have_posts()) {
            $query->the_post();
            // Obtém o ID do post
            $post_id = get_the_ID();
            // Altera o status do post para "rascunho"
            $updated_post = array(
                'ID' => $post_id,
                'post_status' => 'draft'
            );
            wp_update_post($updated_post);

            $post_title = esc_html(get_the_title());

            // envia comunicado à cooperativa
            fia_envia_email_cooperativa_produto_expirado($post_id, $post_title);
        }
        wp_reset_postdata();
    }

}

add_action('init', 'agendar_funcao_produtos_expirados');
function agendar_funcao_produtos_expirados()
{
    if (!wp_next_scheduled('executar_busca_produtos_expirados')) {
        wp_schedule_event(time(), 'twicedaily', 'executar_busca_produtos_expirados');
    }
}

add_action('executar_busca_produtos_expirados', 'buscar_produtos_com_validade_expirada');


function fia_envia_email_cooperativa_produto_expirado($post_id, $post_title)
{

    $vendor = get_the_terms($post_id, "wcpv_product_vendors")[0];

    $vendor_data = get_term_meta($vendor->term_id, 'vendor_data', true);

    $email = filter_var($vendor_data["email"], FILTER_VALIDATE_EMAIL);

    if ($email) {

        $mensagem = "O produto " . $post_title . " expirou \n";

        wp_mail($email, "Vitrine da Terra - Mensagem de produto", $mensagem);

    }

}
