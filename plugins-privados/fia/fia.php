<?php
/**
 * Plugin Name: FIA - Vitrine SME
 * Description: Adiciona funcionalidades à Vitrine SME
 * Version: 1.1
 */

defined('ABSPATH') || exit;

add_action('wp_enqueue_scripts', 'enqueue_custom_scripts');
function enqueue_custom_scripts()
{
    wp_enqueue_style('bootstrap_css', '//cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css');
    wp_enqueue_script('scripts-fia', plugins_url('assets/js/scripts-fia.js', __FILE__), array('jquery'), '1.1', true);
    wp_register_style('css_fia', plugins_url('assets/css/fia.css', __FILE__), false, '1.7.0');
    wp_enqueue_style('css_fia');
}

add_action('admin_enqueue_scripts', 'enqueue_custom_admin_scripts');
function enqueue_custom_admin_scripts($hook)
{

    wp_register_style('css_admin_fia', plugins_url('assets/css/admin-fia.css', __FILE__), false);
    wp_enqueue_style('css_admin_fia');

    /*
    wp_enqueue_style('datatables-css', 'https://cdn.datatables.net/1.11.1/css/jquery.dataTables.min.css');
    wp_enqueue_style('datatables-buttons-css', 'https://cdn.datatables.net/buttons/2.0.0/css/buttons.dataTables.min.css');
    wp_enqueue_script('datatables-js', 'https://cdn.datatables.net/1.11.1/js/jquery.dataTables.min.js', array('jquery'), '', true);
    wp_enqueue_script('datatables-buttons-js', 'https://cdn.datatables.net/buttons/2.0.0/js/dataTables.buttons.min.js', array('jquery', 'datatables-js'), '', true);
    wp_enqueue_script('datatables-html5-js', 'https://cdn.datatables.net/buttons/2.0.0/js/buttons.html5.min.js', array('jquery', 'datatables-js', 'datatables-buttons-js'), '', true);
    */

    wp_enqueue_style('datatables-css', 'https://cdn.datatables.net/1.11.1/css/jquery.dataTables.min.css');
    wp_enqueue_style('datatables-buttons-css', 'https://cdn.datatables.net/buttons/2.0.0/css/buttons.dataTables.min.css');
    wp_enqueue_script('datatables-js', 'https://cdn.datatables.net/1.11.1/js/jquery.dataTables.min.js', array('jquery'), '', true);
    wp_enqueue_script('datatables-buttons-js', 'https://cdn.datatables.net/buttons/2.0.0/js/dataTables.buttons.min.js', array('jquery', 'datatables-js'), '', true);
    wp_enqueue_script('datatables-html5-js', 'https://cdn.datatables.net/buttons/2.0.0/js/buttons.html5.min.js', array('jquery', 'datatables-js', 'datatables-buttons-js'), '', true);
    wp_enqueue_script('datatables-jszip-js', 'https://cdnjs.cloudflare.com/ajax/libs/jszip/3.5.0/jszip.min.js', array('jquery'), '', true);
    wp_enqueue_script('datatables-file-saver-js', 'https://cdnjs.cloudflare.com/ajax/libs/FileSaver.js/2.0.5/FileSaver.min.js', array('jquery'), '', true);



    if ('post.php' != $hook) {
        return;
    }
    wp_enqueue_script('scripts_admin_fia', plugins_url('assets/js/scripts-admin-fia.js', __FILE__), array('jquery'), '1.2', true);

    wp_localize_script(
        'scripts_admin_fia',
        'scripts_admin_fia_ajax',
        array(
            'ajax_url' => admin_url('admin-ajax.php'),
            'fia_add_product_note_nonce' => wp_create_nonce('add_product_note_nonce')
        )
    );
}



add_filter('woocommerce_product_data_tabs', 'personaliza_tela_produtos');
function personaliza_tela_produtos($tabs)
{

    unset($tabs['inventory']);
    unset($tabs['shipping']);
    unset($tabs['linked_product']);
    unset($tabs['attribute']);
    unset($tabs['variations']);
    unset($tabs['advanced']);

    return ($tabs);
}


add_action('admin_menu', 'configura_menu_cooperativa');
function configura_menu_cooperativa()
{

    remove_menu_page('upload.php');
    remove_menu_page('profile.php');

    add_menu_page(
        'Tour de cadastro de produtos',
        'Tour de cadastro de produtos',
        'wc_product_vendors_admin_vendor',
        admin_url('/post-new.php?post_type=product&wat_start_tour=1'),
        '',
        'dashicons-editor-help',
        '500'
    );
    add_menu_page(
        'Tour de edição de dados da cooperativa',
        'Tour de edição de dados da cooperativa',
        'wc_product_vendors_admin_vendor',
        admin_url('/admin.php?page=wcpv-vendor-settings&wat_start_tour=1'),
        '',
        'dashicons-editor-help',
        '510'
    );

}

add_action('admin_menu', 'configura_menu_sme', 100);
function configura_menu_sme()
{
    $user = wp_get_current_user();
    if (in_array('sme', (array) $user->roles)) {
        limpa_dashboard();
    }

}

function limpa_dashboard()
{
    remove_menu_page('index.php');
    remove_menu_page('upload.php');
    remove_menu_page('profile.php');
    remove_menu_page('edit.php');
    remove_menu_page('edit.php?post_type=page');
    remove_menu_page('admin.php?page=onlineestore-welcome');
    remove_menu_page('woocommerce');
    remove_menu_page('woocommerce-analytics');
    remove_menu_page('woocommerce-marketing');
    remove_menu_page('onlineestore-welcome');
    remove_menu_page('edit-comments.php');
    remove_menu_page('wcpv-commissions');
    remove_menu_page('edit.php?post_type=acf-field-group');
    remove_menu_page('wp-mail-smtp');
    remove_menu_page('wp_admin_ui_customize');
    remove_menu_page('loco');
    remove_menu_page('options-general.php');
    remove_menu_page('tools.php');
    remove_menu_page('plugins.php');
    remove_menu_page('themes.php');
    remove_menu_page('admin.php?page=yith_wc_catalog_mode_panel');

    remove_menu_page('wcpscwc-about');
    remove_menu_page('yith_plugin_panel');

}


add_action('woocommerce_single_product_summary', 'alerta_preco', 15);
function alerta_preco()
{
    echo '<div class="alert alert-info">Preço válido para retirada no local. Entre em contato para mais informações sobre condições de entrega, quantidade e frete</div>';
}


add_action('woocommerce_single_product_summary', 'campos_personalizados_produto', 50);

function campos_personalizados_produto()
{

    global $product;

    $oferta = "";
    if ($product->is_on_sale()) {

        $oferta = get_post_meta($product->get_id(), '_sale_price_dates_to', true);

    }

    $sazonalidade = get_field("disponibilidade_anual");
    $capacidade_mensal = get_field("capacidade_de_producao_mensal");
    $logistica = get_field("possui_logistica_ponto-a-ponto");
    $embalagem = get_field("embalagem");
    $validade = get_field("validade");
    $quantidade_minima_para_entrega = get_field("quantidade_minima_para_entrega");


    if (isset($sazonalidade)) {
        echo "<div>";
        echo "<strong>Disponibilidade no ano:</strong> " . implode(", ", $sazonalidade);
        echo "</div>";
    }
    if ($capacidade_mensal != "") {
        echo "<div>";
        echo "<strong>Capacidade mensal:</strong> " . $capacidade_mensal;
        echo "</div>";
    }
    if ($logistica != "") {
        echo "<div>";
        echo "<strong>Logística ponto-a-ponto?</strong> " . $logistica;
        echo "</div>";
    }
    if ($embalagem != "") {
        echo "<div>";
        echo "<strong>Embalagem:</strong> " . $embalagem;
        echo "</div>";
    }
    if ($quantidade_minima_para_entrega != "") {
        echo "<div>";
        echo "<strong>Quantidade mínima para entrega:</strong> " . $quantidade_minima_para_entrega;
        echo "</div>";
    }

    if ($validade != "") {
        echo "<div>";
        echo "<strong>Anúncio válido até:</strong> " . $validade;
        echo "</div>";
    }
    if ($oferta != "") {
        echo "<div>";
        echo "<strong>Preço promocional válido até:</strong> " . date_i18n("d/m/Y", $oferta);
        echo "</div>";
    }

}



function change_defalut_vendor_slug()
{
    return "cooperativa";
}

add_filter('wcpv_vendor_slug', 'change_defalut_vendor_slug');

function remove_editor_text_mode($settings)
{
    $settings['quicktags'] = false;
    return $settings;
}

add_filter('wp_editor_settings', 'remove_editor_text_mode');



// Move TinyMCE Editor to the bottom
add_action('add_meta_boxes', 'action_add_meta_boxes', 0);
function action_add_meta_boxes()
{
    global $_wp_post_type_features;


    if (isset($_wp_post_type_features['product']['editor']) && $_wp_post_type_features['product']['editor']) {
        unset($_wp_post_type_features['product']['editor']);
        add_meta_box(
            'description_section',
            'Descrição completa do produto<br><div style="font-weight: normal;">Escreva aqui informações detalhadas do produto, como, por exemplo: especificações do produto (como peso unitário médio; peso líquido; grau de maturação; padrão de classificação; safra; validade; dimensões; quantidade mínima; tipo de embalagem primária; etc.); ingredientes do produto; advertências para alérgicos e descrição de componentes alérgicos (se contém glúten, lactose, etc.); se possui ou não adição de açúcar ; informações complementares como orientações para armazenamento ; peso ou volume total do produto em embalagens secundárias/terciárias; se o produto é orgânico ou de transição agroecológica</div>',
            'inner_custom_box',
            'product',
            'normal',
            'low'
        );
    }

    if (isset($_wp_post_type_features['post']['excerpt']) && $_wp_post_type_features['post']['excerpt']) {
        unset($_wp_post_type_features['post']['excerpt']);

    }
    add_action('admin_head', 'action_admin_head'); //white background
}

function action_admin_head()
{
    ?>
    <style type="text/css">
        .wp-editor-container {
            background-color: #fff;
        }
    </style>
    <?php
}

function inner_custom_box($post)
{
    echo '<div class="wp-editor-wrap">';
    wp_editor($post->post_content, 'content', array('tabindex' => 100));
    echo '</div>';
}

function remove_product_type_options($options)
{
    // remove "Virtual" checkbox
    if (isset($options['virtual'])) {
        unset($options['virtual']);
    }
    // remove "Downloadable" checkbox
    if (isset($options['downloadable'])) {
        unset($options['downloadable']);
    }
    return $options;
}
add_filter('product_type_options', 'remove_product_type_options');


// exibe o tour somente para os admin de loja
add_filter('wat_allowed_roles', function ($roles) {
    $roles = array('wc_product_vendors_admin_vendor');
    return $roles;
});



add_action('login_form_register', 'fia_rediciona_ficha_cadastro');
function fia_rediciona_ficha_cadastro()
{
    wp_redirect(home_url('/cadastre-se'));
    exit(); // always call `exit()` after `wp_redirect`
}

// function alterar_status_produto_edicao($post_id, $post, $update)
// {
//     // Verifica se o post é um produto
//     if ($post->post_type === 'product') {
//         // Verifica se o usuário logado tem a role específica (substitua 'role_especifica' pelo nome da role desejada)
//         $user = wp_get_current_user();
//         if (in_array('wc_product_vendors_admin_vendor', $user->roles)) {
//             // Altera o status do produto para "aguardando revisão"
//             wp_update_post(
//                 array(
//                     'ID' => $post_id,
//                     'post_status' => 'pending'
//                 )
//             );

//             add_filter('post_updated_messages', 'O produto foi enviado para nova revisão, por favor aguarde a aprovação');

//         }
//     }
// }
// add_action('save_post', 'alterar_status_produto_edicao', 10, 3);

//add_action('save_post_product', 'alterar_status_produto_edicao', 10);

//add_action('woocommerce_update_product', 'productPublished');
//add_action('woocommerce_new_product', 'productPublished');

add_action('woocommerce_update_product', 'alterar_status_produto_edicao', 10, 2);
add_action('woocommerce_new_product', 'alterar_status_produto_edicao', 10, 2);


function alterar_status_produto_edicao($post_id, $post)
{

    $current_user = wp_get_current_user();

    // verifica se a edição é feita por um vendedor
    if (in_array('wc_product_vendors_admin_vendor', $current_user->roles)) {


        if (!is_object($post)) {
            return;
        }

        if ($post->status == 'publish') {

            if (empty($post_id)) {
                return;
            }

            if ($post->status == 'revision') {
                return;
            }

            $produto = array(
                'ID' => $post_id,
                'post_status' => 'pending',
            );

            remove_action('save_post', 'alterar_status_produto_edicao', 10, 2);
            wp_update_post($produto);
            add_action('save_post', 'alterar_status_produto_edicao', 10, 2);

        }
    }
}

add_filter('post_updated_messages', 'fia_post_updated_messages', 100);

function fia_post_updated_messages($messages)
{


    $messages['product'][1] = ('Produto atualizado');

    $current_user = wp_get_current_user();

    if (in_array('wc_product_vendors_admin_vendor', $current_user->roles)) {

        $messages['product'][1] = ('Produto atualizado, aguarde a aprovação da SME');
        $messages['product'][4] = ('Produto atualizado, aguarde a aprovação da SME');
        $messages['product'][8] = ('Produto atualizado, aguarde a aprovação da SME');
    }
    return $messages;
}

add_shortcode("mapa_atendimento", "mapa_atendimento");

function mapa_atendimento($atts)
{

    $atts = shortcode_atts(
        array(
            'vendor_id' => 0
        ),
        $atts,
        'mapa_atendimento'
    );

    $vendor_id = $atts["vendor_id"];
    $area_atendimento = get_term_meta($vendor_id, 'area_atendimento', true);

    $zonas = array();
    $mapa = "";

    $areas = array(
        'norte' => "Zona Norte",
        'sul' => "Zona Sul",
        'leste' => "Zona Leste",
        'oeste' => "Zona Oeste",
        'centro' => "Centro"
    );

    $mapa .= '<div class="mapa-container">';
    $mapa .= '<img class="imagem-1" src="' . plugins_url('assets/images/mapa_sp.png"', __FILE__) . '">';
    foreach ($areas as $key => $value) {
        if (is_array(@$area_atendimento)) {
            if (in_array($key, $area_atendimento)) {
                $mapa .= '<img class="imagem-2" src="' . plugins_url('assets/images/mapa_sp_zona_' . $key . '.png', __FILE__) . '">';
                $zonas[] = $value;
            }
        }
    }

    $mapa .= '</div>';

    $mapa = "<p class='card-text'><strong>Área de atendimento em São Paulo:</strong></p><div>" . implode("<br>", $zonas) . "</div>" . $mapa;

    return $mapa;
}



function change_pending_review_text($translated_text, $text, $domain)
{
    if ($text === 'Pending review' || $text === "Revisão pendente") {
        $translated_text = 'Aguardando aprovação da SME';
    }
    return $translated_text;
}
add_filter('gettext', 'change_pending_review_text', 10, 3);

function change_save_post_button_value($translation, $text, $domain)
{
    if ($text === 'Save as Pending') {
        $translation = 'Devolver para revisão';
    }

    return $translation;
}

add_filter('gettext', 'change_save_post_button_value', 10, 3);


function change_submitdiv_order($post_type, $context, $post)
{

    if ($post_type == 'product') {

        $post_type = $post->post_type;

        remove_meta_box('slugdiv', null, null);

        remove_meta_box('submitdiv', null, 'side');

        add_meta_box('submitdiv', 'Publicação', 'post_submit_meta_box', 'product', 'side', 'low');

        remove_meta_box('postexcerpt', 'product', 'normal');

        add_meta_box('postexcerpt', "Breve descrição sobre o produto <br><div style='font-weight: normal;'>Escreva de forma sucinta sobre o produto, de forma a chamar a atenção do
        comprador. Por ex.: descascado no pilão; empacotado a vácuo; produto direto da roça; etc.</div>", 'WC_Meta_Box_Product_Short_Description::output', 'product', 'normal');

        add_meta_box('fia-mensagens-produto', "Mensagens", 'fia_mensagens_produto', 'product', 'side', 'low');

    }

}
add_action('do_meta_boxes', 'change_submitdiv_order', 100, 3);



add_filter('woocommerce_customer_meta_fields', 'remove_profile_fields');
function remove_profile_fields($show_fields)
{
    unset($show_fields['shipping']);
    unset($show_fields['billing']);
    return $show_fields;
}

remove_action('admin_color_scheme_picker', 'admin_color_scheme_picker');

function custom_tinymce_settings($settings)
{
    // Remove a barra de ferramentas
    $settings['toolbar'] = false;

    return $settings;
}
add_filter('tiny_mce_before_init', 'custom_tinymce_settings');


function redirecionar_wpadmin_edit_product()
{

    global $pagenow;
    if (is_user_logged_in()) {

        $user = wp_get_current_user();

        if (in_array('wc_product_vendors_admin_vendor', $user->roles)) {

            if ($pagenow == "index.php") {
                wp_redirect(admin_url('edit.php?post_type=product'));
                exit;
            }
        }
    }
}
add_action('admin_init', 'redirecionar_wpadmin_edit_product');


// Remover guias de produtos no frontend do WooCommerce
add_filter('woocommerce_product_tabs', 'remove_product_tabs', 98);

function remove_product_tabs($tabs)
{
    unset($tabs['description']);      // Remove a aba de descrição
    unset($tabs['additional_information']); // Remove a aba de informações adicionais
    unset($tabs['reviews']);          // Remove a aba de avaliações
    return $tabs;
}

add_action('woocommerce_single_product_summary', 'add_full_product_description', 35);
function add_full_product_description()
{
    global $product;

    // Verifique se o produto possui uma descrição
    if ($product->get_description()) {
        echo '<div class="full-product-description">';
        echo '<div>' . $product->get_description() . '</div>';
        echo '</div>';
    }
}


// Altera o texto de rascunho para não publicado
add_filter('post_status_labels', 'custom_post_status_labels');
function custom_post_status_labels($labels)
{
    $labels['draft']['label'] = 'Não publicado';
    return $labels;
}

add_shortcode("wcpv_vendor_list_home", "vendor_list_shortcode_home");

function vendor_list_shortcode_home($atts)
{
    $atts = shortcode_atts(
        array(
            'show_name' => true,
            'show_logo' => true,
        ),
        $atts,
        'wcpv_vendor_list'
    );

    $args = array(
        'hierarchical' => false,

    );

    $vendors = get_terms(WC_PRODUCT_VENDORS_TAXONOMY, apply_filters('wcpv_vendor_list_args', $args));

    shuffle($vendors);
    $vendors = array_slice($vendors, 0, 6);

    $template_data = array(
        'vendors' => $vendors,
        'atts' => $atts,
    );
    return wc_get_template_html('shortcode-vendor-list.php', $template_data, 'woocommerce-product-vendors', WC_PRODUCT_VENDORS_TEMPLATES_PATH);
}



// personaliza o rodapé
function online_estore_footer_copyright()
{

    $copyright = get_theme_mod('online_estore_footer_section_options');

    if (!empty($copyright)) {

        echo esc_html(apply_filters('online_estore_copyright_text', $copyright));

    } else {

        echo esc_html(apply_filters('online_estore_copyright_text', $content = esc_html__('Copyright  &copy; ', 'online-estore') . date('Y') . ' ' . get_bloginfo('name') . ' - '));
    }

}


require "fia-expiracao.php";
require "fia-tours.php";
require "fia-mensagens.php";
require "fia-mensagens-emails.php";
require "fia-exportar.php";
require "fia-busca.php";