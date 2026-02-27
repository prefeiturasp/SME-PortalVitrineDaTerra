<?php
function custom_filter_area_atendimento_on_search($query)
{
    if ($query->is_main_query()) {


        if (isset($_GET["area_atendimento"])) {


            global $wpdb;

            $meta_key = 'area_atendimento';
            $search_value = $_GET["area_atendimento"];

            foreach ($search_value as $search) {
                $search = filter_var($search, FILTER_UNSAFE_RAW);
                $whereSQL[] = "  meta_value like '%" . $search . "%'";
            }
            $whereSQL = implode(" OR ", $whereSQL);

            $table_name = $wpdb->prefix . 'term_taxonomy';

            $q = "SELECT term_id FROM $table_name 
            WHERE term_id IN (SELECT term_id FROM $wpdb->termmeta WHERE meta_key = '$meta_key' AND (" . $whereSQL . " ) )";

            $term_ids = $wpdb->get_col($q);
            $tax_query = array(
                array(
                    'taxonomy' => 'wcpv_product_vendors',
                    'field' => 'term_id',
                    'terms' => $term_ids,

                ),
            );
            $query->set('tax_query', $tax_query);
        }

    }

}
add_action('pre_get_posts', 'custom_filter_area_atendimento_on_search');

function custom_filter_area_atendimento_on_search_form()
{

    // Obter a string de consulta atual
    $queryString = $_SERVER['QUERY_STRING'];


    // parse_str($queryString, $queryArray);

    // print_r($queryArray);

    // die();
    $area_atendimento = @$_GET["area_atendimento"];

    $areas = array(
        'norte' => "Zona Norte",
        'sul' => "Zona Sul",
        'leste' => "Zona Leste",
        'oeste' => "Zona Oeste",
        'centro' => "Centro"
    );

    //$selected = isset($_GET["area_atendimento"]) ? esc_attr($_GET["area_atendimento"]) : '';

    $form = '<ul class="wpc-filters-ul-list wpc-filters-checkboxes ">';
    foreach ($areas as $key => $value) {

        $checked = "";
        $link = "";
        $queryStringItem = $queryString;
        if (isset($area_atendimento) && in_array($key, $area_atendimento)) {
            //$link = "area_atendimento[]=" . $key;
            // removo da string
            $checked = " checked ";

            $queryStringItem = removerValorQueryString($queryString, "area_atendimento", $key);
        } else {

            $link = "area_atendimento[]=" . $key;
        }

        if ($queryStringItem) {
            if ($link != "") {
                $link = $queryStringItem . "&" . $link;
            } else {
                $link = $queryStringItem;
            }
        }


        $linkCompleto = site_url('/loja/?' . $link);


        $form .= '
        <li 
            class="wpc-checkbox-item wpc-term-item">
                <div class="wpc-term-item-content-wrapper wpc-filter-content">
                    <input 
                    type="checkbox"  
                    ' . $checked . ' 
                    data-wpc-link="' . $linkCompleto . '">
                    <label>
                        <a href="' . $linkCompleto . '">' . $value . '</a>
                    </label>
                </div>
        </li>
        ';
        // $form .= '<input type="checkbox" name="area_atendimento[]" value="' . $area[0] . '" ' . $selected_attr . '>' . $area[1] . '</input>';
    }
    $form .= '</ul>';
    return $form;
}


add_shortcode('busca_regiao', 'custom_filter_area_atendimento_on_search_form');

function removerValorQueryString($queryString, $key, $value)
{
    // Transformar a string de consulta em um array associativo
    parse_str($queryString, $queryArray);

    // Remover o valor do array 'area_atendimento'
    $queryArray[$key] = array_diff($queryArray[$key], [$value]);

    // Construir a nova string de consulta
    $novaQueryString = http_build_query($queryArray);

    return $novaQueryString;
}

