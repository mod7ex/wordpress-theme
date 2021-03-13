<form role="search" action="<?php esc_url(home_url()); ?>" method="get" class="search-form">
    <div class="fields">
        <input type="search" name="s" value="<?php the_search_query(); ?>" autocomplete="off" placeholder="Search..." />
        <button role="submit">&#9740;</button>
    </div>
</form>