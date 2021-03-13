<article class="post-item post-gallery">
    <?php require('post-header.php'); ?>

    <div class="post-content">
        <?php
            $images = modexy_post_attachement(100);
            $n = count($images);
        ?>

        <?php foreach($images as $key => $img): ?>
        <div class="post-attachment hidden"
            style="background-image: url(<?= esc_url(wp_get_attachment_url($img->ID)) ?>);">
        </div>
        <?php endforeach; ?>

        <div class="gallery-overlay">
            <span class="gallery-nav-left">
                <small class="gallery-nav-btn">&#10094;</small>
                <small class="thumnail"
                    style="background-image: url(<?= esc_url(wp_get_attachment_url($images[prev_item(0, $n)]->ID)) ?>);">
                </small>
            </span>

            <span class="gallery-nav-right">
                <small class="thumnail"
                    style="background-image: url(<?= esc_url(wp_get_attachment_url($images[next_item(0, $n)]->ID)) ?>);">
                </small>
                <small class="gallery-nav-btn">&#10095;</small>
            </span>
        </div>
    </div>

    <footer>
        <?php modexy_post_footer(); ?>
    </footer>
</article>