<article class="post-item">
    <header>
        <h1 class="post-title">
            <a href="<?php the_permalink(); ?>">
                <?php the_title(); ?>
            </a>
        </h1>

        <?php modexy_post_meta(); ?>
    </header>

    <div class="post-content">
        <div class="post-attachment" style="background-image: url(<?= esc_url(modexy_post_attachement()) ?>);">
            <a href="<?php the_permalink(); ?>">
                <div></div>
            </a>
        </div>

        <div class="post-excerpt">
            <?php the_excerpt(); ?>
            <a href="<?php the_permalink(); ?>">Read More</a>
        </div>
    </div>

    <footer>
        <?php modexy_post_footer(); ?>
    </footer>
</article>