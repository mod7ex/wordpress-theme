<h1>Theme Settings</h1>

<br>
<?php settings_errors(); ?>
<br>

<h3>Shortcodes</h3>

<ul>
    <li>* use <code>[contact_form]</code> shortcode to embed a contact form in any page you want.</li>
</ul>

<br>

<hr>

<form action="options.php" method="post">

    <?php
        settings_fields('modexy-settings-group');

        do_settings_sections('modexy_settings');

        submit_button();
    ?>

</form>