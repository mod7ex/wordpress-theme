<?php get_header(); ?>

<div class="page">
    <?php if(have_posts()): ?>
    <?php while(have_posts()): the_post(); ?>

    <?php the_title(); ?>
    <?php modexy_increase_post_views(get_the_ID()); ?>
    <hr>
    <?php the_content(); ?>


    <?php endwhile; ?>
    <?php endif; ?>
</div>

<?php get_footer(); ?>