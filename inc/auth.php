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