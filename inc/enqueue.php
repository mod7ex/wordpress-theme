<?php

$ver = wp_get_theme()->get('Version');


add_action('admin_enqueue_scripts', function ($hook) use ($ver) {

    if($hook == 'toplevel_page_modexy_admin') {

        wp_register_script('modexy-admin', AURI . 'assets/js/modexy.admin.js', array(), $ver, true);
        wp_register_style('modexy-admin', AURI . 'assets/css/modexy.admin.css', array(), $ver);

        wp_enqueue_script('modexy-admin');
        wp_enqueue_style('modexy-admin');
        wp_enqueue_media();
    }
    
});