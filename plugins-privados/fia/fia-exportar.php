<?php


function fia_add_page_exportar_produtos()
{
    add_menu_page(
        'Exportar Produtos',
        // Page Title
        'Exportar Produtos',
        // Menu Title
        'manage_options',
        // Capability
        'exportar-produtos',
        // Menu Slug
        'fia_exportar_produtos',
        // Callback function
        'dashicons-admin-generic' // Icon URL
    );
}

function fia_exportar_produtos()
{


    // Content for your custom page goes here
    echo '<h1>Exportar produtos</h1>';

    tabela_produtos();

}

add_action('admin_menu', 'fia_add_page_exportar_produtos');


function tabela_produtos()
{

    $args = array(
        'post_type' => 'product',
        'posts_per_page' => -1,
    );

    $products = new WP_Query($args);

    if ($products->have_posts()) {
        echo '<table id="fia-exportar-produto">';
        echo '<thead>';
        echo '<tr><th>Nome</th><th>Valor</th><th>Categoria</th><th>Vendedor</th></tr>';
        echo '</thead><tbody>';

        while ($products->have_posts()) {
            $products->the_post();
            $product = wc_get_product(get_the_ID());

            echo '<tr>';
            echo '<td>' . get_the_title() . '</td>';
            echo '<td>' . $product->get_price() . '</td>';
            echo '<td>';

            $categorias = get_the_terms(get_the_ID(), 'product_cat');

            if ($categorias && !is_wp_error($categorias)) {
                $vendor_names = array();
                foreach ($categorias as $vendor) {
                    $vendor_names[] = $vendor->name;
                }
                echo implode(', ', $vendor_names);
            }
            echo '</td>';

            echo '<td>';

            echo @get_the_terms(get_the_ID(), 'wcpv_product_vendors')[0]->name;


            echo '</td>';
            echo '</tr>';
        }
        echo '</tbody>';
        echo '</table>';
        echo "<script>
            jQuery(document).ready(function($) {
                $('#fia-exportar-produto').DataTable({
                    dom: 'Bfrtip',
                    buttons: [
                        'excelHtml5'
                    ]
                });
            });
        </script>";
    } else {
        echo 'Nenhum produto encontrado.';
    }

    wp_reset_postdata();
}

function enqueue_datatables_scripts()
{

}