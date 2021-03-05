<?php



add_action( 'admin_post_register_custom_styles', function () {
    
    /*
        wp_verify_nonce($_POST['_custom_css_nonce'], 'custom_css_action');
        better to use check_admin_referer for more formal way of displaying messages
    */
    check_admin_referer('custom_css_action', '_custom_css_nonce');

    $css_file = fopen(AP . 'assets/css/added-styles.css',"w");

    if($css_file && fwrite($css_file, trim(esc_textarea($_POST['custom_css']))) && fclose($css_file)){
        $success = 'yes';
    }else{
        $success = 'no';
    }
    
    wp_safe_redirect(wp_get_referer() . "&custom_css_suc=$success");
});