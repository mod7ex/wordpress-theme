<?php 

/* Template Name: Login Page */ 

if(is_user_logged_in()) {
    wp_redirect(home_url());
    die;
}


if(isset($_POST['submit'])){
    if(wp_verify_nonce($_POST['_login_nonce'], '_login_nonce_action')){
        if(isset($_POST['login']['remember'])) {
            $_POST['login']['remember'] = true;
        }

        $user = wp_signon($_POST['login'], false );

        if (is_wp_error( $user )) {
            $error = $user->get_error_message();
        }else{
            wp_redirect(home_url());
        }
    }
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

    <div id="login">
        <?php // var_dump(is_user_logged_in()); ?>

        <h1>Login</h1>

        <form action="" method="post">

            <div class="form-field error">
                <h3><?php echo $error; ?></h3>
            </div>

            <input type="hidden" name="_login_nonce" value="<?= wp_create_nonce('_login_nonce_action') ?>">

            <div class="form-field">
                <label for="user_login">Username or E-mail</label>
                <input type="text" class="input-field" name="login[user_login]" id="user_login"
                    value="<?php isset($_POST['login']['user_login']) ? $_POST['login']['user_login'] : '' ?>">
            </div>

            <div class="form-field">
                <label for="user_password">Password</label>
                <input type="password" class="input-field" name="login[user_password]" id="user_password"
                    value="<?php isset($_POST['login']['user_password']) ? $_POST['login']['user_password'] : '' ?>">
            </div>

            <div class="form-field">
                <input type="checkbox" class="" name="login[remember]" id="remember" checked>
                <label for="remember">Remeber me</label>
            </div>

            <div class="form-field">
                <input name="submit" type="submit" class="btn submit" value="Login">
            </div>
        </form>
    </div>

    <?php wp_footer(); ?>

</body>

</html>