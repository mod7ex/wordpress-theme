<h1>Edit Theme Css</h1>

<br>


<?php
    
if(isset($_GET['custom_css_suc'])){
    if($_GET['custom_css_suc'] == 'yes'){
        $class = 'updated';
        $message = 'Your Theme Css Has Been Updated';

    }elseif($_GET['custom_css_suc'] == 'no'){
        $class = 'notice-error';
        $message = 'Something Went Wrong';

    }
    ?>

<div class="<?php echo $class; ?> notice is-dismissible">
    <p>
        <?php echo $message; ?>
    </p>
</div>

<?php
}

    if(file_exists('assets/css/added-styles.css')){
        // ******** get the css in the file
        $css_file = fopen(AP . 'assets/css/added-styles.css',"r");
        $custom_css = fread($css_file, fstat($css_file)['size'] + 1);
        $custom_css = $custom_css ? $custom_css : '/* Edit Your Css Here */';
        fclose($css_file);
    }else{
        $custom_css = '/* Edit Your Css Here */';
    }


?>

<br>


<form id="custom_css_form" action="<?php echo esc_url( admin_url('admin-post.php') ); ?>" method="POST">

    <input type="hidden" name="action" value="register_custom_styles">
    <?php wp_nonce_field('custom_css_action', '_custom_css_nonce'); ?>

    <div id="editor-area">
        <h3>Add Css Here</h3>

        <div id="editor-container">
            <div id="css-editor"><?= $custom_css ?></div>
        </div>
    </div>

    <div id="theme_colors">
        <h3>Theme Colors</h3>

        <div id="theme_colors_palets">
            <div>
                <label for="primary_color">Primary Color</label>
                <input type="color" name="primary_color" id="primary_color">
            </div>

            <div>
                <label for="secondary_color">Secondary Color</label>
                <input type="color" name="secondary_color" id="secondary_color">
            </div>

            <div>
                <label for="third_color">Third Color</label>
                <input type="color" name="third_color" id="third_color">
            </div>
        </div>
    </div>

    <textarea name="custom_css" id="hidden-editor"><?= $custom_css ?></textarea>

    <?php submit_button('Save Style'); ?>

    <!-- the old way of get_option() -->

    <?php
        /*
            settings_fields('custom-css-group');

            do_settings_sections('modexy_css');

            submit_button();
        */
    ?>
</form>