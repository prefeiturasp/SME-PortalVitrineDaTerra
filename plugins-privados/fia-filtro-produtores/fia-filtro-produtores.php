<?php
/**
 * Plugin Name: FIA - Vitrine SME - Filtro de produtores
 * Description: Adiciona shortcode para filtrar produtores
 * Version: 1.1
 */


function fia_filtro_produtores_shortcode()
{

    // Obter a string de consulta atual
    $queryString = $_SERVER['QUERY_STRING'];

    // $protocol = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off' || $_SERVER['SERVER_PORT'] == 443) ? "https://" : "http://";
    // $host = $_SERVER['HTTP_HOST'];
    // $uri = $_SERVER['REQUEST_URI'];
    // $current_url = $protocol . $host . $uri;



    $area_atendimento = @$_GET["vendor_area_atendimento"];

    $areas = array(
        'norte' => "Zona Norte",
        'sul' => "Zona Sul",
        'leste' => "Zona Leste",
        'oeste' => "Zona Oeste",
        'centro' => "Centro"
    );

    //$selected = isset($_GET["area_atendimento"]) ? esc_attr($_GET["area_atendimento"]) : '';

    $form = '
    <div class="widget">
    <h2 class="widget-title ">Filtrar produtor</h2>
    <form id="vendor-filter-form">
    <ul class="wpc-filters-ul-list wpc-filters-checkboxes ">';
    foreach ($areas as $key => $value) {

        $checked = "";
        $link = "";
        $queryStringItem = $queryString;
        if (isset($area_atendimento) && in_array($key, $area_atendimento)) {
            //$link = "area_atendimento[]=" . $key;
            // removo da string
            $checked = " checked ";

            $queryStringItem = removerValorQueryString($queryString, "vendor_area_atendimento", $key);
        } else {

            $link = "vendor_area_atendimento[]=" . $key;
        }

        if ($queryStringItem) {
            if ($link != "") {
                $link = $queryStringItem . "&" . $link;
            } else {
                $link = $queryStringItem;
            }
        }

        $linkCompleto = '?' . $link;

        $form .= '
        <li 
            class="wpc-checkbox-item wpc-term-item">
                <div class="wpc-term-item-content-wrapper wpc-filter-content">
                    <input 
                    value="' . $key . '"
                    name="vendor_area_atendimento[]"
                    type="checkbox"  
                    ' . $checked . ' 
                    >
                    <label>
                        <a href="' . $linkCompleto . '">' . $value . '</a>
                    </label>
                </div>
        </li>
        ';
        // $form .= '<input type="checkbox" name="area_atendimento[]" value="' . $area[0] . '" ' . $selected_attr . '>' . $area[1] . '</input>';
    }
    $form .= '</ul></form></div>
    ';


    return $form;
}


add_shortcode('fia_filtro_produtores', 'fia_filtro_produtores_shortcode');



function vendor_list_shortcode_filtro($atts)
{

    wp_enqueue_script('scripts_fia_filtro_produtores', plugins_url('assets/js/scripts-fia-filtro-produtores.js', __FILE__), array('jquery'), '1.0', true);
    wp_register_style('css_fia_filtro_produtores', plugins_url('assets/css/fia-filtro-produtores.css', __FILE__), false, '1.0');
    wp_enqueue_style('css_fia_filtro_produtores');


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

    $selected_areas = isset($_GET['vendor_area_atendimento']) ? $_GET['vendor_area_atendimento'] : array();
    $selected_areas = array_map('sanitize_text_field', (array) $selected_areas);

    if (!empty($selected_areas)) {
        $meta_query = array('relation' => 'OR');
        foreach ($selected_areas as $area) {
            $meta_query[] = array(
                'key' => 'area_atendimento',
                'value' => $area,
                'compare' => 'LIKE',
            );
        }
        $args['meta_query'] = $meta_query;
    }


    $vendors = get_terms(WC_PRODUCT_VENDORS_TAXONOMY, apply_filters('wcpv_vendor_list_args', $args));

    shuffle($vendors);
    $vendors = array_slice($vendors, 0, 6);

    $template_data = array(
        'vendors' => $vendors,
        'atts' => $atts,
    );
    ob_start();

    ?>
    <div class="vendors">
        <ul class="grid-grid grid-grid-3">
            <?php if (!empty($vendors)):
                foreach ($vendors as $vendor) {
                    $vendor_data = get_term_meta($vendor->term_id, 'vendor_data', true);


                    $profile = strip_tags($vendor_data["profile"]);
                    $profile = explode(' ', $profile);

                    $profile_resumido = array_slice($profile, 0, 15);
                    $profile_resumido = implode(' ', $profile_resumido);


                    if (count($profile) > 15) {
                        $profile_resumido .= "...";
                    }


                    if (isset($vendor_data['logo'])) {
                        $vendor_logo = wp_get_attachment_image(absint($vendor_data['logo']), 'full');
                    } else {
                        $vendor_logo = "<img src='https://placehold.co/200x200'>";
                    }

                    ?>
                    <li>
                        <div class="vendor-logo">
                            <a href="<?php echo esc_url(get_term_link($vendor->term_id, WC_PRODUCT_VENDORS_TAXONOMY)); ?>"
                                class="wcpv-vendor-logo"><?php echo $vendor_logo; ?></a>
                        </div>
                        <ul class="vendor-info">
                            <li class="vendor-title">
                                <a href="<?php echo esc_url(get_term_link($vendor->term_id, WC_PRODUCT_VENDORS_TAXONOMY)); ?>"
                                    class="wcpv-vendor-name"><?php echo esc_html($vendor->name); ?></a>
                            </li>
                            <li class="vendor-description">
                                <?php echo esc_html($profile_resumido); ?>
                            </li>
                        </ul>
                    </li>
                    <?php
                }
                ?>
            <?php endif; ?>
        </ul>
    </div>
    <?php

    return ob_get_clean();

    //return wc_get_template_html('shortcode-vendor-list.php', $template_data, 'woocommerce-product-vendors', WC_PRODUCT_VENDORS_TEMPLATES_PATH);
}

add_shortcode("wcpv_vendor_list_filtro", "vendor_list_shortcode_filtro");
