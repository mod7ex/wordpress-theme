<?php get_header(); ?>

<div class="single-post">
    <?php if(have_posts()): ?>
    <?php while(have_posts()): the_post(); ?>
    <?php modexy_increase_post_views(get_the_ID()); ?>

    <!-- Post Header -->
    <header class="single-post-header">
        <h1 class="post-title">
            <span>
                <?php the_title(); ?>
            </span>
        </h1>

        <?php modexy_post_meta(); ?>
    </header>

    <div class="content-area">
        <?php the_content(); ?>
    </div>

    <footer class="single-post-footer">
        <?php modexy_post_footer(); ?>
    </footer>

    <?php comments_template(); ?>

    <?php endwhile; ?>
    <?php endif; ?>
</div>

<?php get_footer(); ?>