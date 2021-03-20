<?php

add_action('wp_ajax_contact_msg_action', 'modexy_save_contact_message');  #  wp_ajax_{$action}
add_action('wp_ajax_nopriv_contact_msg_action', 'modexy_save_contact_message');  #  wp_ajax_nopriv_{$action}


function modexy_save_contact_message() {
    check_ajax_referer(-1, '_nonce');

    $title = $_POST['name'];
    $email = $_POST['email'];
    $message = esc_html($_POST['message']);

    $post_id = wp_insert_post(array(
        'post_type' => 'message',
        'post_title' => $title,
        'post_content' => $message,
        'post_status' => 'publish',
        'meta_input' => array('_email_meta_key' => $email),
    ));

    $feed = array();

    if(is_int($post_id) && $post_id > 0){
        $feed['message'] = 'Message sent successfuly';
        $feed['bool'] = true;

        $to = get_bloginfo('admin_email');
        $subject = 'Modexy Contact Form ' . $title;
        $headers = array(
            'From: ' . get_bloginfo('name') . '<' . $to . '>',
            'Content-Type: text/html: charset=UTF-8',
            'Reply-To: ' . $title . '<' . $email . '>',
        );

        wp_mail($to, $subject, $message, $headers);
        
    }else{
        $feed['message'] = 'Oops somthing went wrong';
        $feed['bool'] = false;
    }

    echo json_encode($feed);

    die();
}