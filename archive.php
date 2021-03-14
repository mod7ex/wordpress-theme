<?php get_header(); ?>

<div id="blog-posts">
    <div class="archive-area">
        <h1 class="archive-title"><b>&para;</b> <?php the_archive_title(); ?></h1>
        <div class="archive-description">
            <?php the_archive_description(); ?>
        </div>
    </div>

    <?php if(have_posts()): ?>
    <?php while(have_posts()): the_post(); ?>

    <?php get_template_part('template-parts/posts/content', get_post_format()); ?>

    <?php endwhile; ?>
    <?php endif; ?>
</div>


<?php get_template_part('template-parts/pagination'); ?>

<?php get_footer(); ?>