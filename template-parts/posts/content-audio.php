<article class="post-item post-audio">
    <header>
        <h1 class="post-title">
            <a href="<?php the_permalink(); ?>">
                <?php the_title(); ?>
            </a>
        </h1>

        <?php modexy_post_meta(); ?>
    </header>

    <div class="post-content">
        <?php modexy_get_embeded_media(array('audio', 'iframe')); ?>
    </div>

    <footer>
        <?php modexy_post_footer(); ?>
    </footer>
</article>