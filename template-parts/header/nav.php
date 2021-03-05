<nav>
    <?php
        wp_nav_menu(array(
            'theme_location'     => 'primary',
            'container'          => false,
            'menu_class'         => '',
            'menu_id'            => 'primary-menu',
            'walker' => new Primary_Nav_Walker(),
        ));
    ?>
</nav>