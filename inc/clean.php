<?php


function remove_wp_ver($src) {
    global $wp_version;

    parse_str(parse_url($src, PHP_URL_QUERY), $query);

    if(!empty($query['ver']) && $query['ver'] === $wp_version) {
        $src = remove_query_arg('ver', $src);
    }

    return $src;
}

add_filter('script_loader_src', 'remove_wp_ver');
add_filter('style_loader_src', 'remove_wp_ver');
add_filter('the_generator', function(){
    return '';
});


// remove url query
add_filter('removable_query_args', function($args) {
    array_push($args, 'custom_css_suc');
    return $args;
});