<?php get_header(); ?>

<div id="front-page" class="page">

    <?php get_sidebar(); ?>

    <div class="main-content">
        <?php if(have_posts()): ?>

        <?php while(have_posts()): the_post(); ?>

        <?php the_content(); ?>

        <?php endwhile; ?>

        <?php endif; ?>
    </div>

</div>

<?php get_footer(); ?>