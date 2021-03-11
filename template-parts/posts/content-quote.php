<article class="post-item post-quote">
    <header>
        <h1 class="post-title">
            <a href="<?php the_permalink(); ?>">
                <?php the_title(); ?>
            </a>
        </h1>

        <?php modexy_post_meta(); ?>
    </header>

    <div class="post-content">
        <?php the_content(); ?>
    </div>

    <footer>
        <?php modexy_post_footer(); ?>
    </footer>
</article>