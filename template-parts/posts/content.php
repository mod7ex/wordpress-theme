<article class="post-item">
    <?php require('post-header.php'); ?>

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