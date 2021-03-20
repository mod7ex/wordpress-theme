<?php  /* Template Name: Sign Up Page */ 

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

if(is_user_logged_in()) {
    wp_redirect(home_url());
    // wp_die();
    exit;
}

$user = false;

if(isset($_POST['submit'])) {
    if(wp_verify_nonce($_POST['_signup_nonce'], '_signup_nonce_action')){

        $username = trim($_POST['signup']['username']);
        $password = 'password';
        $email = trim($_POST['signup']['email']);

        if (username_exists($username) == false && email_exists($email) == false) {

            // Create the new user
            $user_id = wp_create_user($username, $password, $email);

            if(is_wp_error($user_id)){
                $error = $user_id->get_error_message();
            }else{
                // Get current user object
                $user = get_user_by('id', $user_id);

                if($user){
                    // notify the admin
                    $admin_to = get_bloginfo('admin_email');

                    $admin_message = 'New user registration on your site my site:' . "\r\n\r\n";
                    $admin_message .= 'Username: ' . $user->user_login . "\r\n\r\n";
                    $admin_message .= 'Email: ' . $user->user_email;

                    $admin_subject = 'New Registration';

                    wp_mail($admin_to, $admin_subject, $admin_message);
                    
                    // Send reset password email
                    if( !send_reset_email($user)) {
                        $error =  __('Something went wrong ...');
                    }
                }
            }

            /*
                // Remove role
                $user->remove_role('subscriber');

                // Add role
                $user->add_role('administrator');
            */
        } else {
            $error = 'User already exists <a href="/login" >Login</a> !';
        }
    }
}

$username = '';
$email = '';

if(isset($_POST['signup'])) {
    $username = array_key_exists('username', $_POST['signup']) ? $_POST['signup']['username'] : '';
    $email = array_key_exists('email', $_POST['signup']) ? $_POST['signup']['email'] : '';
}

?>

<!DOCTYPE html>
<html <?php language_attributes(); ?>>

<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="description" content="<?php bloginfo('description'); ?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="profile" href="http://gmpg.org/xfn/11">

    <?php if(is_singular() && pings_open(get_queried_object())): ?>
    <link rel="pingback" href="<?php bloginfo('pingback_url'); ?>">
    <?php endif; ?>

    <title><?php bloginfo('title') . wp_title('||'); ?></title>
    <?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>

    <div id="signup">

        <?php if(!$user): ?>
        <h1>Sign Up</h1>

        <form action="" method="post">

            <div class="form-field error">
                <h3><?php  echo isset($error) ? $error : ''; ?></h3>
            </div>

            <input type="hidden" name="_signup_nonce" value="<?= wp_create_nonce('_signup_nonce_action') ?>">

            <div class="form-field">
                <label for="username">Username</label>
                <input type="text" class="input-field" name="signup[username]" id="username"
                    value="<?php echo $username; ?>">
            </div>

            <div class="form-field">
                <label for="email">E-mail</label>
                <input type="email" class="input-field" name="signup[email]" id="email" value="<?php echo $email; ?>">
            </div>

            <div class="form-field">
                <input name="submit" type="submit" class="btn submit" value="Sign Up">
            </div>
        </form>
        <?php else: ?>
        <div id="registered-msg">
            <h3>You have registered a new account check your email to confirm.</h3>
            <h5>Then visit <a href="/login">Login</a></h5>
        </div>
        <?php endif; ?>
    </div>

    <?php wp_footer(); ?>

</body>

</html>

<?php