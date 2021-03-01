<h1>Theme Admin Infos</h1>

<br>
<?php settings_errors(); ?>
<br>


<?php

    $imgurl = wp_get_attachment_image_url(get_option('profile_img'));

    $full_name = get_option('first_name') . ' ' . get_option('last_name');
    $description = get_option('description');
    $twitter = get_option('twitter');
    $facebook = get_option('facebook');

?>

<div id="main-content">
    <div id="admin-profile">
        <div id="profile-img" style="background-image: url(<?php echo $imgurl; ?>);">
        </div>

        <div id="profile-infos">
            <div id="full_name">
                <h1><?php echo $full_name; ?></h1>
            </div>

            <div id="description"><?php echo $description; ?></div>

            <div id="social">
                <a href="<?= $facebook ?>" target="_blank">
                    <span class="dashicons dashicons-facebook-alt"></span>
                </a>

                <a href="https://twitter.com/<?= $twitter ?>" target="_blank">
                    <span class="dashicons dashicons-twitter-alt"></span>
                </a>
            </div>
        </div>
    </div>

    <form action="options.php" method="POST">
        <?php

            settings_fields('admin-settings-group');

            do_settings_sections('modexy_admin');

            echo '<hr>';

            submit_button();

        ?>
    </form>
</div>