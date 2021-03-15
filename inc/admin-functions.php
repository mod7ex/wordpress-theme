<?php

// pages markup
function modexy_general_page_markup(){
    require_once(AP . 'inc/templates/modexy-admin.php');
}

function custom_css_page_markup(){
    require_once(AP . 'inc/templates/custom-css.php');
}

function settings_page_markup(){
    require_once(AP . 'inc/templates/modexy-settings.php');
}


// fields markup
function profile_img_markup(){
    $profile_img = get_option('profile_img');

    echo '<input type="hidden" name="profile_img" id="profile_img" value="' . $profile_img . '">';

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

function github_markup(){
    $github = get_option('github');

    echo '<input type="text" class="regular-text" name="github" placeholder="github" value="' . $github . '" >';
}


// function custom_css_markup(){
//     $custom_css = empty(get_option('custom_css')) ? '/* Edit Your Css Here */' : get_option('custom_css');

//     echo '<div id="editor-container"><div id="css-editor">' . $custom_css . '</div></div>';
//     echo '<textarea name="custom_css" id="hidden-editor">' . $custom_css . '</textarea>';
// }


function post_formats_markup(){
    $formats = array( 'aside', 'chat', 'gallery', 'link', 'image', 'quote', 'status', 'video', 'audio');

    $post_formats = get_option('post_formats');
    
    foreach($formats as $key => $format){
        $checked = (is_array($post_formats) && array_key_exists($format, $post_formats)) ? 'checked' : '';

        $margin = $key != 0 ? 'margin: 20px;' : '';
        echo '<label style="display: inline-block; ' . $margin . '" for="' . $format . '-format" >';
        echo '<input type="checkbox" name="post_formats[' . $format . ']" value="1" id="' . $format . '-format" ' . $checked . ' >' . $format . '</label>';
    }
}


function custom_header_markup(){
    $custom_header = get_option('custom_header');

    $checked = empty($custom_header) ? '' : 'checked';
    echo '<label for="custom_header" ><input type="checkbox" id="custom_header" name="custom_header" ' . $checked . '>Custom Header</label>';
}


function custom_background_markup(){
    $custom_background = get_option('custom_background');

    $checked = empty($custom_background) ? '' : 'checked';
    echo '<label for="custom_background" ><input type="checkbox" id="custom_background" name="custom_background" ' . $checked . '>Custom Background</label>';
}


function contact_form_markup(){
    $contact_form = get_option('contact_form');

    $checked = empty($contact_form) ? '' : 'checked';
    echo '<label for="contact_form" ><input type="checkbox" id="contact_form" name="contact_form" ' . $checked . '>Contact Form</label>';
}


function sidebars_markup(){
    $sidebars = get_option('sidebars');

    echo '<div id="sidebars-area">';

    for ($i=0; $i < 3; $i++) {
        
        $sidebar = !empty($sidebars[$i]) ? $sidebars[$i] : null;

        echo '<label type="text" class="sidebar-input">Sidebar ' . ($i + 1) . '<input name="sidebars[]" value="' . $sidebar . '" placeholder="sidebar name"></label>';
    }
    
    echo '</div>';
    
}

function excerpt_lenght_markup(){
    $excerpt_lenght = get_option('excerpt_lenght');

    echo '<input type="number" name="excerpt_lenght" class="regular-text" value="' . $excerpt_lenght . '">';
    echo '<p>The excerpt length is between 30 and 50</p>';
}

function notfound_image_markup(){
    $notfound_image = get_option('notfound_image');

    echo '<input type="hidden" name="notfound_image" id="notfound_image" value="' . $notfound_image . '">';

    if(!empty($notfound_image)){
        echo '<button class="browser button button-hero" id="notfound_image_uploader">Change 404 Page Image</button>';
        echo '<button id="notfound_image_remover">Remove 404 Page Image</button>';
    }else {
        echo '<button class="browser button button-hero" id="notfound_image_uploader">Upload 404 Page Image</button>';
        echo '<button class="hidden" id="notfound_image_remover">Remove 404 Page Image</button>';
    }

    echo '<p id="notfound_image_msg" class="hidden">Dont\'t forget to save changes</p>';

    echo '<div id="notfound-view" style="background-image: url(' . esc_url(wp_get_attachment_image_url($notfound_image)) . ');"></div>';
}


// sanitize input
function sanitize_twitter_username($t_username){
    return str_replace('@', '', sanitize_text_field($t_username));
}

// function sanitize_custom_css($css){
//     return esc_textarea($css);
// }

function sanitize_sidebars($sidebars){

    foreach ($sidebars as $key => $value) {
        $sidebars[$key] = esc_attr($value);
    }

    if(empty($sidebars[0])){
        $sidebars[0] = 'Primary Sidebar';
    }

    return $sidebars;
}

function sanitize_excerpt_lenght($number){
    if(is_numeric($number) && $number > 0){
        return $number;
    }
    return 10;
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

    add_submenu_page(
        'modexy_admin',
        'Theme Settings',
        'Settings',
        'manage_options',
        'modexy_settings',
        'settings_page_markup'
    );

    add_action('admin_init', function(){

        // admin settings group
        register_setting('admin-settings-group', 'profile_img');
        register_setting('admin-settings-group', 'first_name');
        register_setting('admin-settings-group', 'last_name');
        register_setting('admin-settings-group', 'description');
        register_setting('admin-settings-group', 'twitter', 'sanitize_twitter_username');
        register_setting('admin-settings-group', 'facebook');
        register_setting('admin-settings-group', 'github');

        add_settings_section('theme-admin-details', 'Admin details', function(){}, 'modexy_admin');

        add_settings_field('profile_img', 'Profile Image', 'profile_img_markup', 'modexy_admin', 'theme-admin-details');
        add_settings_field('first_name', 'First Name', 'first_name_markup', 'modexy_admin', 'theme-admin-details');
        add_settings_field('last_name', 'Last Name', 'last_name_markup', 'modexy_admin', 'theme-admin-details');
        add_settings_field('description', 'Description', 'description_markup', 'modexy_admin', 'theme-admin-details');
        add_settings_field('twitter', 'Twitter Username', 'twitter_markup', 'modexy_admin', 'theme-admin-details');
        add_settings_field('facebook', 'Facebook', 'facebook_markup', 'modexy_admin', 'theme-admin-details');
        add_settings_field('github', 'Github Username', 'github_markup', 'modexy_admin', 'theme-admin-details');

        // // admin custom css
        // register_setting('custom-css-group', 'custom_css', 'sanitize_custom_css');

        // add_settings_section('theme-custom-css', 'Theme Custom Css', function(){}, 'modexy_css');

        // add_settings_field('custom-css-field', 'Customize your css', 'custom_css_markup', 'modexy_css', 'theme-custom-css');


        // Theme Settings
        register_setting('modexy-settings-group', 'post_formats');
        register_setting('modexy-settings-group', 'custom_header');
        register_setting('modexy-settings-group', 'custom_background');
        register_setting('modexy-settings-group', 'contact_form');
        register_setting('modexy-settings-group', 'sidebars', 'sanitize_sidebars');
        register_setting('modexy-settings-group', 'excerpt_lenght', 'sanitize_excerpt_lenght');
        register_setting('modexy-settings-group', 'notfound_image');

        add_settings_section('general-settings-section', 'General Settings', function(){}, 'modexy_settings');

        add_settings_field('post-formats-field', 'Post Formats', 'post_formats_markup', 'modexy_settings', 'general-settings-section');
        add_settings_field('custom-header-field', 'Custom Header', 'custom_header_markup', 'modexy_settings', 'general-settings-section');
        add_settings_field('custom-background-field', 'Custom Background', 'custom_background_markup', 'modexy_settings', 'general-settings-section');
        add_settings_field('contact-form-field', 'Contact Form', 'contact_form_markup', 'modexy_settings', 'general-settings-section');
        add_settings_field('sidebars-field', 'Manage Sidebars Names', 'sidebars_markup', 'modexy_settings', 'general-settings-section');
        add_settings_field('excerpt-lenght-field', 'Theme Excerpt Length', 'excerpt_lenght_markup', 'modexy_settings', 'general-settings-section');
        add_settings_field('notfound-image-field', '404 Page Image', 'notfound_image_markup', 'modexy_settings', 'general-settings-section');
    });

});