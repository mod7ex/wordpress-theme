<?php


require_once(get_template_directory() . '/inc/config.php');

require_once(AP . 'inc/enqueue.php');

require_once(AP . 'inc/admin-functions.php');

require_once(AP . 'inc/theme-support.php');

require_once(AP . 'inc/custom-post-type.php');

require_once(AP . 'inc/clean.php');

require_once(AP . 'inc/form-handler.php');

require_once(AP . 'inc/walker.php');

require_once(AP . 'inc/post-helper.php');

require_once(AP . 'inc/widgets.php');

require_once(AP . 'inc/ajax.php');

require_once(AP . 'inc/shortcodes.php');


function next_item($i, $n) {
	return ($i + 1) % $n;
}

function prev_item($i, $n) {
	return ($i + 1 + $n) % $n;
}

// register_activation_hook( __FILE__, function () {
//     flush_rewrite_rules();
// });