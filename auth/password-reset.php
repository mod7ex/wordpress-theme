<?php  /* Template Name: Reset Password Page */ 

if(is_user_logged_in()) {
    wp_redirect(home_url());
    exit;
}

$error = '';

$bool = (isset($_POST['action']) && $_POST['action'] == 'rp') && (isset($_POST['key'])) && (isset($_POST['login']));
if($bool){
    $user = check_password_reset_key($_POST['key'], $_POST['login']);

    if(is_wp_error($user)) {
        $error = __('Something Went Wrong');
    }else{
        
    }
}

if(isset($_POST['submit'])) {
    if(wp_verify_nonce($_POST['_reset_password'], '_reset_password_action')){

    }
}

if(isset($_POST['signup'])) {
    $password = isset($_POST['password']) ? $_POST['password'] : '';
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

        <form action="" method="post">

            <input type="hidden" name="_reset_password" value="<?= wp_create_nonce('_reset_password_action') ?>">

            <div class="form-field">
                <label for="password">Password</label>
                <input type="password" class="input-field" name="password" id="password"
                    value="<?php echo $password; ?>">
            </div>

            <div class="form-field">
                <input name="submit" type="submit" class="btn submit" value="Submit">
            </div>
        </form>

    </div>

    <?php wp_footer(); ?>

</body>

</html>

<?php