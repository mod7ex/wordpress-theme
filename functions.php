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

require_once(AP . 'inc/auth.php');

require_once(AP . 'inc/users.php');

function next_item($i, $n) {
	return ($i + 1) % $n;
}

function prev_item($i, $n) {
	return ($i + 1 + $n) % $n;
}

add_action('phpmailer_init', function ($phpmailer) {
  $phpmailer->isSMTP();
  $phpmailer->Host = 'smtp.mailtrap.io';
  $phpmailer->SMTPAuth = true;
  $phpmailer->Port = 2525;
  $phpmailer->Username = '6697185fabfbda';
  $phpmailer->Password = 'c7b12164297e6d';
});