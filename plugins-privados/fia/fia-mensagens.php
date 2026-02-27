<?php

function fia_mensagens_produto()
{
    ?>

    <ul class="order_notes">
        <?php

        $args = array(
            'type' => 'product_note',
            'post_id' => get_the_ID()
        );
        $notes = get_comments($args);



        if ($notes) {
            foreach ($notes as $note) {


                $css_class = array('note');
                ?>
                <li rel="<?php echo absint($note->comment_ID); ?>" class="<?php echo esc_attr(implode(' ', $css_class)); ?>">
                    <div class="note_content">
                        <?php echo wpautop(wptexturize(wp_kses_post($note->comment_content))); // @codingStandardsIgnoreLine ?>
                    </div>
                    <p class="meta">
                        <abbr class="exact-date"
                            title="<?php echo esc_attr(date_format(date_create($note->comment_date), "Y-m-d H:i:s")); ?>">
                            <?php
                            echo esc_html(date_format(date_create($note->comment_date), "d/m/Y H:i"));
                            ?>
                        </abbr>
                    </p>
                </li>
                <?php
            }
        } else {
            ?>
            <li class="no-items">Nenhuma mensagem cadastrada</li>
            <?php
        }
        ?>
    </ul>
    <?php

    $user = wp_get_current_user();
    $allowed_roles = array('sme', 'administrator');

    if (array_intersect($allowed_roles, $user->roles)) {

        ?>
        <div class="add_note">
            <p>
                <label for="add_order_note">Adicionar mensagem</label>
                <textarea type="text" name="order_note" id="add_order_note" class="input-text" cols="20" rows="5"></textarea>
            </p>
            <p>
                <button type="button" class="add_note button">Cadastrar mensagem</button>
            </p>
        </div>
        <?php
    }
}

function fia_add_product_note()
{

    if (!isset($_POST['fia_add_product_note_nonce']) || !wp_verify_nonce($_POST['fia_add_product_note_nonce'], 'add_product_note_nonce')) {
        wp_send_json_error('Nonce inválido! Ação não autorizada.');
        wp_die();
    }


    $user = wp_get_current_user();
    $allowed_roles = array('sme', 'administrator');

    if (!array_intersect($allowed_roles, $user->roles) || !isset($_POST['post_id'], $_POST['note'])) {

        echo "<li>Sem permissão</li>";
        wp_die();

    }


    $post_id = absint($_POST['post_id']);
    $note = wp_kses_post(trim(wp_unslash($_POST['note']))); // phpcs:ignore WordPress.Security.ValidatedSanitizedInput.InputNotSanitized

    //$is_customer_note = ('customer' === $note_type) ? 1 : 0;

    if ($post_id > 0) {
        //$order = wc_get_order($post_id);
        //$comment_id = $order->add_order_note($note, $is_customer_note, true);
        $comment_id = fia_insert_note($post_id, $note);
        //$note = wc_get_order_note($comment_id);
        if ($comment_id > 0) {
            $note_classes = array('note');
            //$note_classes[] = $is_customer_note ? 'customer-note' : '';
            $note_classes = apply_filters('woocommerce_order_note_class', array_filter($note_classes), $note);
            ?>
            <li rel="<?php echo absint($comment_id); ?>" class="<?php echo esc_attr(implode(' ', $note_classes)); ?>">
                <div class="note_content">
                    <?php echo wp_kses_post(wpautop(wptexturize(make_clickable($note)))); ?>
                </div>
                <p class="meta">
                    <abbr class="exact-date" title="<?php echo date('y-m-d H:i:s'); ?>">
                        <?php
                        echo date('d/m/Y H:i');
                        ?>
                    </abbr>
                </p>
            </li>
            <?php
        } else {
            ?>
            <li>Ocorreu um erro, tente novamente</li>
            <?php
        }
    }

    wp_die();

}
function fia_insert_note($post_id, $note)
{

    $user = get_user_by('id', get_current_user_id());
    $comment_author = $user->display_name;
    $comment_author_email = $user->user_email;

    $commentdata = array(
        'comment_post_ID' => $post_id,
        'comment_author' => $comment_author,
        'comment_author_email' => $comment_author_email,
        'comment_author_url' => '',
        'comment_content' => $note,
        'comment_agent' => 'WooCommerce',
        'comment_type' => 'product_note',
        'comment_parent' => 0,
        'comment_approved' => 1,
    );


    $comment_id = wp_insert_comment($commentdata);


    if ($comment_id > 0) {

        fia_envia_email_cooperativa_nova_mensagem_produto($post_id, $comment_id, $note);

    }
    return $comment_id;
}

function fia_envia_email_cooperativa_nova_mensagem_produto($post_id, $comment_id, $note)
{

    $vendor = get_the_terms($post_id, "wcpv_product_vendors")[0];

    $vendor_data = get_term_meta($vendor->term_id, 'vendor_data', true);
    $email = filter_var($vendor_data["email"], FILTER_VALIDATE_EMAIL);

    if ($email) {

        $produto = get_post($post_id);

        $post_title = $produto->post_title;


        $mensagem = "O produto " . esc_html($post_title) . " recebeu uma mensagem da SME: \n";
        $mensagem .= esc_html($note) . "\n\n";
        $mensagem .= "Código da mensagem: " . $comment_id;

        wp_mail($email, "Vitrine da Terra - Mensagem de produto", $mensagem);

    }

}

function fia_add_product_note_ajax()
{
    add_action('wp_ajax_fia_add_product_note', 'fia_add_product_note');
    //add_action('wp_ajax_nopriv_fia_add_product_note', 'fia_add_product_note'); // Permite que usuários não autenticados acessem a chamada AJAX
}
add_action('init', 'fia_add_product_note_ajax');



add_action('transition_post_status', 'fia_envia_email_cooperativa_produto_publicado', 10, 3);

function fia_envia_email_cooperativa_produto_publicado($new_status, $old_status, $post)
{

    if ($post->post_type === 'product' && $old_status !== 'publish' && $new_status === 'publish') {

        $vendor = get_the_terms($post->ID, "wcpv_product_vendors")[0];
   
		

    $vendor_data = get_term_meta($vendor->term_id, 'vendor_data', true);
    $email = filter_var($vendor_data["email"], FILTER_VALIDATE_EMAIL);

    if ($email) {

        $post_title = $post->post_title;

        $mensagem = "O produto " . esc_html($post_title) . " foi publicado na Vitrine da Terra \n";

        wp_mail($email, "Vitrine da Terra - Mensagem de produto", $mensagem);

    }
	}

}

