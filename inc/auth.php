<?php

// add_action('wp_logout', function(){
//     wp_redirect(home_url('/login'));
// });


# admin_post_nopriv_{$action}
// add_action( 'admin_post_nopriv_modexy_login_action', function (){
//     if(wp_verify_nonce($_POST['_login_nonce'], '_login_nonce_action')){
//         if(isset($_POST['login']['remember'])) {
//             $_POST['login']['remember'] = true;
//         }
    
//         $user = wp_signon($_POST['login'], false );
    
//         if (is_wp_error( $user )) {
//             echo $user->get_error_message();
//         }else{
//             wp_redirect(home_url());
//         }
//     }
// });     


# admin_post_{$action}
add_action( 'admin_post_modexy_logout_action', function () {
    if(wp_verify_nonce($_POST['_logout_nonce'], '_logout_nonce_action')){
        wp_logout();
        wp_redirect(home_url('/login'));
    }
});


// add_action( "load-login.php", function(){
//     if(is_user_logged_in()) {
//         wp_redirect(home_url());
//         wp_die();
//     }
// });


function send_reset_email($user) {
    $user_login = $user->user_login;
    $user_email = $user->user_email;

    $allow = apply_filters('allow_password_reset', true, $user->ID);

    if ( !$allow || is_wp_error($allow)) {
        return false;
    }

    if(is_wp_error($key = get_password_reset_key( $user ))) return false;

    $message = sprintf(__('Username: %s'), $user_login) . "\r\n\r\n";
    $message .= __('To set your password, visit the following address:') . "\r\n\r\n";
    $message .= network_site_url("wp-login.php?action=rp&key=$key&login=" . rawurlencode($user_login), 'login') . "\r\n\r\n";
    $message .= 'http://wp.mourad/wp-login.php' . "\r\n";

    $blogname = wp_specialchars_decode(get_option('blogname'), ENT_QUOTES);

    $title = sprintf( __('[%s] Password Reset'), $blogname );

    $title = apply_filters('retrieve_password_title', $title);
    $message = apply_filters('retrieve_password_message', $message, $key);

    if ( $message && !wp_mail($user_email, $title, $message) )
        wp_die( __('The e-mail could not be sent.') . "<br />\n" . __('Possible reason: your host may have disabled the mail() function...') );

    return true;
}