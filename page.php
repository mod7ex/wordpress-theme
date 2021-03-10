<?php get_header(); ?>

<div id="blog-posts">
    <?php if(have_posts()): ?>
    <?php while(have_posts()): the_post(); ?>

    <?php the_title(); ?>

    <?php endwhile; ?>
    <?php endif; ?>
</div>

<?php get_footer(); ?>