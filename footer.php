</main>

<footer id="footer">
    <div class="container">
        <div class="footer-block">
            <a href="/"><strong>Modexy Website</strong></a> | All rights reserved &copy; <?= date("Y") ?>
        </div>

        <div class="footer-block">
            <?php dynamic_sidebar('sidebar-2'); ?>
        </div>

        <div class="footer-block">
            <?php
                wp_nav_menu(array(
                    'theme_location'     => 'footer',
                    'container'          => false,
                    'menu_class'         => '',
                    'menu_id'            => 'footer-menu',
                    'walker' => new Primary_Nav_Walker(),
                ));
            ?>
        </div>

        <div class="footer-block">
            <?php get_search_form(); ?>
        </div>
    </div>
</footer>

<!-- 
<div class="alert success">
    <h4>Contact Form Message Here</h4>
    <span class="close">&#10006;</span>
</div> -->

</div>
<?php wp_footer(); ?>

</body>

</html>