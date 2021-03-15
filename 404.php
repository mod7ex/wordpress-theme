<?php get_header(); ?>

<div class="not-found-area">
    <span class="title">Oops! Page Not Found</span>


    <div class="image"
        style="background-image: url(<?= esc_url(wp_get_attachment_image_url(get_option('notfound_image'))) ?>);">
    </div>
</div>

<?php get_footer(); ?>