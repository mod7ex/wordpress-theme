</main>

<footer id="footer">
    <div class="container">
        <div class="footer-block">
            <?php get_search_form(); ?>
        </div>

        <div class="footer-block">
            <?php dynamic_sidebar('sidebar-2'); ?>
        </div>

        <div class="footer-block">
            <a href="/"><strong>Modexy Website</strong></a> | All rights reserved &copy; <?= date("Y") ?>
        </div>
    </div>
</footer>

</div>
<?php wp_footer(); ?>

</body>

</html>