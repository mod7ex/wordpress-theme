<?php if($wp_query->max_num_pages > 1): ?>

<nav id="posts-pagination" class="pagination-nav" role="navigation">
    <h3 class="pagination-title"><?php _e('Posts Navigation', DOMAIN) ?></h3>

    <?php
        the_posts_pagination(array());
    ?>

</nav>

<?php endif; ?>