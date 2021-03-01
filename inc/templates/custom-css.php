<h1>Edit Theme Css</h1>

<br>
<?php settings_errors(); ?>
<br>

<form action="options.php" method="POST">
    <?php

        settings_fields('custom-css-group');

        do_settings_sections('modexy_css');

        submit_button();

    ?>
</form>