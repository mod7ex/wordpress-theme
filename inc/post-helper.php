<?php

function modexy_post_meta(){

    $created_at = human_time_diff(get_the_time('U'), current_time('timestamp'));
    $author = get_the_author_link();
    $categories = get_categories();
    $i = 1;
    $categories_output = '';

    foreach ($categories as $key => $category) {
        if($i>1) $categories_output .= ', ';

        $categories_output .= '<a href="' . esc_url(get_category_link($category->term_id)) . '" >' . $category->name . '</a>';

        $i++;
    }
    echo '<div class="post-meta">
            <small class="author"><strong>By</strong>: ' . $author . '</small> /
            <small class="created_at"><strong>Published</strong> ' . $created_at . ' ago</small> /
            <small class="categories">' . $categories_output . '</small>
        </div>';
}

function modexy_post_attachement($n = 1){
    $output = null;

    if(has_post_thumbnail() && $n == 1){
        $output = wp_get_attachment_url(get_post_thumbnail_id(get_the_ID()));
    }else{
        $attachments = get_posts(array(
            'post_type'         => 'attachment',
            'posts_per_page'    => $n,
            'post_parent'       => get_the_ID()
        ));

        if(!empty($attachments)){
            $output = ($n == 1) ? wp_get_attachment_url($attachments[0]->ID) : $attachments ;
        }

        wp_reset_postdata();
    }

    return $output;
}

function modexy_post_comments(){

    comments_number();

    // 'No Comments', 'One Comment', 'A lot of comments', get_the_ID()
}