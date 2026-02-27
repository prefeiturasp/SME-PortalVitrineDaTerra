<?php

add_filter('wat_pointers', function ($pointers) {

    unset($pointers['edit-category']);

    $pointers['general'] = array(
        'screen_info' => array(
            'name' => 'Informações Iniciais',
            'url' => admin_url(),
        ),
        array(
            'id' => 'produtos',
            'tagget_element' => '#menu-posts-product',
            'title' => 'Adicionar produto',
            'content' => 'Clique aqui para criar um novo produto',
            'position' => array(
                'edge' => 'left',
                'align' => 'left',
            ),
            'url' => add_query_arg(
                array(
                    'post_type' => 'product',
                    'wat_start_tour' => '1',
                ),
                admin_url('post-new.php')
            ),
        ),
        array(
            'id' => 'cooperativa',
            'tagget_element' => '#toplevel_page_wcpv-vendor-settings',
            'title' => 'Configurar Cooperativa',
            'content' => 'Clique aqui para configuar sua cooperativa, adicionar logotipo, informações de contato e área de atendimento',
            'position' => array(
                'edge' => 'left',
                'align' => 'left',
            ),
            'url' => add_query_arg(
                array(
                    'page' => 'wcpv-vendor-settings',
                    'wat_start_tour' => '1',
                ),
                admin_url('admin.php')
            ),
        ),

    );

    $pointers['product'] = array(
        'screen_info' => array(
            'name' => 'Cadastrar produto',
            'url' => add_query_arg('post_type', 'product', admin_url('post-new.php')),

        ),
        array(
            'id' => 'title',
            'tagget_element' => '#title',
            'title' => 'Título do produto',
            'content' => 'Informe o título do produto',
            'position' => array(
                'edge' => 'top',
                'align' => 'edge',
            ),

        ),


        array(
            'id' => '_regular_price',
            'tagget_element' => '#_regular_price',
            'title' => 'Preço do produto',
            'content' => 'Informe o preço do produto',
            'position' => array(
                'edge' => 'top',
                'align' => 'left',
            ),

        ),

        array(
            'id' => '_sale_price',
            'tagget_element' => '#_sale_price',
            'title' => 'Preço promocional',
            'content' => 'Informe o preço promocional ( quando for o caso )',
            'position' => array(
                'edge' => 'top',
                'align' => 'edge',
            ),

        ),

        array(
            'id' => 'sale_schedule',
            'tagget_element' => '#sale_schedule',
            'title' => 'Data da promoção',
            'content' => 'Informe a data inicial e final do preço promocional',
            'position' => array(
                'edge' => 'top',
                'align' => 'edge',
            ),

        ),


        array(
            'id' => 'woo_expiry_date',
            'tagget_element' => '#woo_expiry_date',
            'title' => 'Data de expiração',
            'content' => 'Informe a data de expiração do anúncio',
            'position' => array(
                'edge' => 'top',
                'align' => 'left',
            ),

        ),
        array(
            'id' => '_woo_uom_input',
            'tagget_element' => '#_woo_uom_input',
            'title' => 'Unidade de Medida',
            'content' => 'Informe a unidade de medida. Exemplo: Kg, Peça, Metro, Cento',
            'position' => array(
                'edge' => 'top',
                'align' => 'left',
            ),

        ),
        array(
            'id' => 'wp-excerpt-wrap',
            'tagget_element' => '#wp-excerpt-wrap',
            'title' => 'Descrição resumida',
            'content' => 'Informe a descrição curta do produto',
            'position' => array(
                'edge' => 'bottom',
                'align' => 'left',
            ),

        ),
        array(
            'id' => 'wp-content-wrap',
            'tagget_element' => '#wp-content-wrap',
            'title' => 'Descrição completa',
            'content' => 'Informe a descrição completa do produto',
            'position' => array(
                'edge' => 'bottom',
                'align' => 'left',
            ),

        ),


        array(
            'id' => 'postimagediv',
            'tagget_element' => '#postimagediv',
            'title' => 'Foto principal',
            'content' => 'Adicione a foto principal do produto',
            'position' => array(
                'edge' => 'right',
                'align' => 'left',
            ),

        ),

        array(
            'id' => 'woocommerce-product-images',
            'tagget_element' => '#woocommerce-product-images',
            'title' => 'Galeria de fotos',
            'content' => 'Adicione outras fotos do produto',
            'position' => array(
                'edge' => 'right',
                'align' => 'left',
            ),

        ),

        array(
            'id' => 'product_catdiv',
            'tagget_element' => '#product_catdiv',
            'title' => 'Categoria',
            'content' => 'Marque a categoria dos produtos',
            'position' => array(
                'edge' => 'right',
                'align' => 'left',
            ),

        ),
        array(
            'id' => 'tagsdiv-product_tag',
            'tagget_element' => '#tagsdiv-product_tag',
            'title' => 'Tags do produto',
            'content' => 'Adicione palavras chave para facilitar a localização do produto',
            'position' => array(
                'edge' => 'right',
                'align' => 'left',
            ),

        ),

        array(
            'id' => 'save-post',
            'tagget_element' => '#save-post',
            'title' => 'Salvar Rascunho',
            'content' => 'Você pode salvar o rascunho do produto atual e continuar a edição em outro momento, para isso, clique em Salvar como rascunho',
            'position' => array(
                'edge' => 'right',
                'align' => 'left',
            ),

        ),
        array(
            'id' => 'publish',
            'tagget_element' => '#publish',
            'title' => 'Enviar para revisão',
            'content' => 'Quando tudo estiver pronto, clique aqui para enviar o produto para revisão',
            'position' => array(
                'edge' => 'right',
                'align' => 'left',
            ),

        ),

    );

    $pointers['toplevel_page_wcpv-vendor-settings'] = array(
        'screen_info' => array(
            'name' => 'Editar dados da cooperativa',
            'url' => add_query_arg(
                array(
                    'page' => 'wcpv-vendor-settings',
                ),
                admin_url('admin.php')
            ),
        ),
        array(
            'id' => 'wcpv-upload-logo',
            'tagget_element' => '.wcpv-upload-logo',
            'title' => 'Logotipo',
            'content' => 'Clique aqui para fazer o uplod do logotipo da cooperativa',
            'position' => array(
                'edge' => 'top',
                'align' => 'left',
            ),

        ),
        array(
            'id' => 'wp-wcpv_vendor_info-wrap',
            'tagget_element' => '#wp-wcpv_vendor_info-wrap',
            'title' => 'Descrição da cooperativa',
            'content' => 'Descreva sua cooperativa, essa informação será exibida aos interessados em seus produtos',
            'position' => array(
                'edge' => 'bottom',
                'align' => 'left',
            ),

        ),


        array(
            'id' => 'vendor_email',
            'tagget_element' => 'input[name="vendor_data[email]"]',
            'title' => 'E-mail',
            'content' => 'Informe o e-mail da cooperativa',
            'position' => array(
                'edge' => 'top',
                'align' => 'left',
            ),

        ),


        array(
            'id' => 'wcpv-vendor-telefone',
            'tagget_element' => '#wcpv-vendor-telefone',
            'title' => 'Telefone',
            'content' => 'Informe o telefone da cooperativa',
            'position' => array(
                'edge' => 'top',
                'align' => 'left',
            ),

        ),



        array(
            'id' => 'wcpv-vendor-site',
            'tagget_element' => '#wcpv-vendor-site',
            'title' => 'Site',
            'content' => 'Informe o site da cooperativa ( endereço completo, contendo https:// )',
            'position' => array(
                'edge' => 'top',
                'align' => 'left',
            ),

        ),


        array(
            'id' => 'wcpv-vendor-instagram',
            'tagget_element' => '#wcpv-vendor-instagram',
            'title' => 'Instagram',
            'content' => 'Informe o Instagram caso possua',
            'position' => array(
                'edge' => 'top',
                'align' => 'left',
            ),

        ),

        array(
            'id' => 'wcpv-vendor-youtube',
            'tagget_element' => '#wcpv-vendor-youtube',
            'title' => 'Youtube',
            'content' => 'Informe o Youtube caso possua',
            'position' => array(
                'edge' => 'top',
                'align' => 'left',
            ),

        ),

        array(
            'id' => 'wcpv-vendor-tiktok',
            'tagget_element' => '#wcpv-vendor-tiktok',
            'title' => 'TikTok',
            'content' => 'Informe o TikTok caso possua',
            'position' => array(
                'edge' => 'top',
                'align' => 'left',
            ),

        ),
        array(
            'id' => 'wcpv-vendor-twitter',
            'tagget_element' => '#wcpv-vendor-twitter',
            'title' => 'Twitter',
            'content' => 'Informe o Twitter caso possua',
            'position' => array(
                'edge' => 'top',
                'align' => 'left',
            ),

        ),
        array(
            'id' => 'area_atendimento',
            'tagget_element' => '#area_atendimento',
            'title' => 'Áreas de atendimento',
            'content' => 'Marque as áreas de atendimento da cooperativa',
            'position' => array(
                'edge' => 'bottom',
                'align' => 'left',
            ),

        ),

        array(
            'id' => 'submit',
            'tagget_element' => '#submit',
            'title' => 'Atualizar',
            'content' => 'Clique nesse botão para atualizar',
            'position' => array(
                'edge' => 'bottom',
                'align' => 'left',
            ),

        ),
    );

    return $pointers;
});