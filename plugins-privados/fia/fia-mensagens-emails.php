<?php

// Adicionar uma nova página de configurações ao menu de administração
add_action('admin_menu', 'fia_add_admin_menu');

function fia_add_admin_menu()
{
    add_menu_page(
        'Mensagens E-mail',
        'Mensagens E-mail',
        'manage_options',
        'fia',
        'fia_settings_page',
        'dashicons-email'
    );
}

// Renderizar a página de configurações
function fia_settings_page()
{
    ?>
    <div class="wrap">
        <h1>Mensagens de email padrão</h1>
        <form method="post" action="options.php">
            <?php
            settings_fields('fia_settings_group');
            do_settings_sections('fia');
            submit_button();
            ?>
        </form>
    </div>
    <?php
}


add_action('admin_init', 'fia_settings_init');

function fia_settings_init()
{
    register_setting('fia_settings_group', 'fia_settings');

    add_settings_section(
        'fia_settings_section',
        'Configurações de E-mail',
        'fia_settings_section_callback',
        'fia'
    );

    add_settings_field(
        'confirmacao_cadastro',
        'Confirmação de Cadastro',
        'fia_confirmacao_cadastro_render',
        'fia',
        'fia_settings_section'
    );

    add_settings_field(
        'aprovacao_cooperativa',
        'Aprovação de Cooperativa',
        'fia_aprovacao_cooperativa_render',
        'fia',
        'fia_settings_section'
    );
}

function fia_settings_section_callback()
{
    echo 'Atualize as mensagens padrão de email das cooperativas:';
}

function fia_confirmacao_cadastro_render()
{
    $options = get_option('fia_settings');
    $content = isset($options['confirmacao_cadastro']) ? $options['confirmacao_cadastro'] : '';
    $editor_id = 'confirmacao_cadastro';
    $settings = array(
        'textarea_name' => 'fia_settings[confirmacao_cadastro]',
        'media_buttons' => false,
        'textarea_rows' => 10,
        'tinymce' => array(
            'toolbar1' => 'bold italic underline | bullist numlist | undo redo',
            'toolbar2' => ''
        ),
    );
    wp_editor($content, $editor_id, $settings);
}

function fia_aprovacao_cooperativa_render()
{
    $options = get_option('fia_settings');
    $content = isset($options['aprovacao_cooperativa']) ? $options['aprovacao_cooperativa'] : '';
    $editor_id = 'aprovacao_cooperativa';
    $settings = array(
        'textarea_name' => 'fia_settings[aprovacao_cooperativa]',
        'media_buttons' => false,
        'textarea_rows' => 10,
        'tinymce' => array(
            'toolbar1' => 'bold italic underline | bullist numlist | undo redo',
            'toolbar2' => ''
        ),
    );
    wp_editor($content, $editor_id, $settings);
}
