<?php



add_shortcode('contact_form', function($atts, $content = null) {

    ob_start();

    require('templates/contact-us-form.php');

    return ob_get_clean();

});