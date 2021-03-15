<?php

$ver = wp_get_theme()->get('Version');


add_action('admin_enqueue_scripts', function ($hook) use ($ver) {

    if($hook == 'toplevel_page_modexy_admin') {

        wp_register_script('modexy-admin', AURI . 'assets/js/modexy.admin.js', array(), $ver, true);
        wp_register_style('modexy-admin', AURI . 'assets/css/modexy-admin.css', array(), $ver);

        wp_enqueue_script('modexy-admin');
        wp_enqueue_style('modexy-admin');
        wp_enqueue_media();
    }

    if($hook == 'modexy_page_modexy_css') {

        wp_register_script('ace', AURI . 'assets/js/ace/src-noconflict/ace.js', array(), '1.4.12', true);
        wp_register_script('modexy-custom-css', AURI . 'assets/js/custom.css.js', array('ace'), $ver, true);
        wp_register_style('modexy-custom-css', AURI . 'assets/css/custom-css.css', array(), $ver, 'all');

        wp_enqueue_script('ace');
        wp_enqueue_script('modexy-custom-css');
        wp_enqueue_style('modexy-custom-css');
    }

    if($hook == 'modexy_page_modexy_settings') {

        wp_register_style('modexy-settings', AURI . 'assets/css/modexy-settings.css', array(), $ver, 'all');
        wp_register_script('modexy-settings', AURI . 'assets/js/modexy.settings.js', array(), $ver, true);

        wp_enqueue_style('modexy-settings');
        wp_enqueue_media();
        wp_enqueue_script('modexy-settings');
    }

});



add_action('wp_enqueue_scripts', function() use ($ver) {

    wp_deregister_script('wp-embed');
    wp_deregister_style('wp-block-library');

    wp_register_style('modexy-styles', AURI . 'assets/css/modexy-styles.css', array(), $ver);
    wp_register_style('added-styles', AURI . 'assets/css/added-styles.css', array(), $ver);
    wp_register_script('main', AURI . 'assets/js/main.js', array(), $ver, true);

    wp_enqueue_style('modexy-styles');
    wp_enqueue_style('added-styles');
    wp_enqueue_script('main');


    $nonce = wp_create_nonce();
    wp_localize_script('main', 'base', array(
        'gallery_delay' => 3000,
        'ajax_url' => admin_url( 'admin-ajax.php' ),
        // 'ajax_url' => '/wp-admin/admin-ajax.php', 
        'nonce' => $nonce,
        'contact_us' => 'contact_msg_action',
    ));

});