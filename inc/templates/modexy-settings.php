<h1>Theme Settings</h1>

<br>
<?php settings_errors(); ?>
<br>

<form action="options.php" method="post">

    <?php
        settings_fields('modexy-settings-group');

        do_settings_sections('modexy_settings');

        submit_button();
    ?>

</form>