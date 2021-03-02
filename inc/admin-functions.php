<?php

// pages markup
function modexy_general_page_markup(){
    require_once(AP . 'inc/templates/modexy-admin.php');
}

function custom_css_page_markup(){
    require_once(AP . 'inc/templates/custom-css.php');
}


// fields markup
function profile_img_markup(){
    $profile_img = get_option('profile_img');

    echo '<input type="hidden" name="profile_img" id="profile_img" value"' . $profile_img . '">';

    if(!empty($profile_img)){
        echo '<button class="browser button button-hero" id="profile_img_uploader">Change Profile</button>';
        echo '<button class="" id="profile_img_remover">Remove Profile</button>';
    }else {
        echo '<button class="browser button button-hero" id="profile_img_uploader">Upload Profile</button>';
        echo '<button class="hidden" id="profile_img_remover">Remove Profile</button>';
    }

    echo '<p id="profile_img_msg" class="hidden">Dont\'t forget to save changes</p>';
}

function first_name_markup(){
    $first_name = get_option('first_name');

    echo '<input type="text" class="regular-text" name="first_name" placeholder="first name" value="' . $first_name . '" >';
}

function last_name_markup(){
    $last_name = get_option('last_name');

    echo '<input type="text" class="regular-text" name="last_name" placeholder="last name" value="' . $last_name . '" >';
}

function description_markup(){
    $description = get_option('description');

    echo '<textarea class="regular-text" name="description" rows="5" placeholder="description ..." >' . $description . '</textarea>';
}

function twitter_markup(){
    $twitter = get_option('twitter');

    echo '<input type="text" class="regular-text" name="twitter" placeholder="twitter username" value="' . $twitter . '" >';
    echo '<br><small>Don\'t write @ symbole</small>';
}

function facebook_markup(){
    $facebook = get_option('facebook');

    echo '<input type="text" class="regular-text" name="facebook" placeholder="facebook" value="' . $facebook . '" >';
}


function custom_css_markup(){
    $custom_css = empty(get_option('custom_css')) ? '/* Edit Your Css Here */' : get_option('custom_css');

    echo '<div id="editor-container"><div id="css-editor">' . $custom_css . '</div></div>';
    echo '<textarea name="custom_css" id="hidden-editor">' . $custom_css . '</textarea>';
}





// sanitize input
function sanitize_twitter_username($t_username){
    return str_replace('@', '', sanitize_text_field($t_username));
}

function sanitize_custom_css($css){
    return esc_textarea($css);
}


add_action('admin_menu', function(){

    add_menu_page(
        'Modexy Theme Settings',
        'Modexy',
        'manage_options',
        'modexy_admin',
        '',
        'dashicons-image-filter',
        110
    );

    add_submenu_page(
        'modexy_admin',
        'Theme Admin Details',
        'Admin',
        'manage_options',
        'modexy_admin',
        'modexy_general_page_markup'
    );

    add_submenu_page(
        'modexy_admin',
        'Theme Custom Css',
        'Theme Css',
        'manage_options',
        'modexy_css',
        'custom_css_page_markup'
    );

    add_action('admin_init', function(){

        // admin settings group
        register_setting('admin-settings-group', 'profile_img');
        register_setting('admin-settings-group', 'first_name');
        register_setting('admin-settings-group', 'last_name');
        register_setting('admin-settings-group', 'description');
        register_setting('admin-settings-group', 'twitter', 'sanitize_twitter_username');
        register_setting('admin-settings-group', 'facebook');

        add_settings_section('theme-admin-details', 'Admin details', function(){}, 'modexy_admin');

        add_settings_field('profile_img', 'Profile Image', 'profile_img_markup', 'modexy_admin', 'theme-admin-details');
        add_settings_field('first_name', 'First Name', 'first_name_markup', 'modexy_admin', 'theme-admin-details');
        add_settings_field('last_name', 'Last Name', 'last_name_markup', 'modexy_admin', 'theme-admin-details');
        add_settings_field('description', 'Description', 'description_markup', 'modexy_admin', 'theme-admin-details');
        add_settings_field('twitter', 'Twitter Username', 'twitter_markup', 'modexy_admin', 'theme-admin-details');
        add_settings_field('facebook', 'Facebook', 'facebook_markup', 'modexy_admin', 'theme-admin-details');


        // admin custom css
        register_setting('custom-css-group', 'custom_css', 'sanitize_custom_css');

        add_settings_section('theme-custom-css', 'Theme Custom Css', function(){}, 'modexy_css');

        add_settings_field('custom-css-field', 'Customize your css', 'custom_css_markup', 'modexy_css', 'theme-custom-css');

    });

});