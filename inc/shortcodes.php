<?php



/**
 *  [contact_form]
 */
add_shortcode('contact_form', function($atts, $content = null) {

    // get the attributes.
    $atts = shortcode_atts(
        array(
            'title' => __('Contact US'),
        ),
        $atts,
        'contact_form'
    );

    $output = '<div id="contact-form">';
    $output .= '<h2 class="contact-form-title">' . $atts['title'] . '</h2>';

    ob_start();

    require('templates/contact-us-form.php');

    $output .= ob_get_clean();

    $output .= '</div>';

    return $output;

});