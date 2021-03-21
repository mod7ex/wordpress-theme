<?php


function modexy_post_meta(){

    $created_at = human_time_diff(get_the_time('U'), current_time('timestamp')); # php date formating
    $author = '<a href="' . get_author_posts_url(get_the_author_meta('ID')) . '">' . get_the_author() . '</a>';
    $categories_output = '';
    
    if(has_category()){
        $categories = get_the_category();
        foreach ($categories as $category) {

            $categories_output .= '<a class="post-cat" href="' . esc_url(get_category_link($category->term_id)) . '" >' . $category->name . '</a>';
        }
    }

    echo '<div class="post-meta">
            <small class="author"><strong>By</strong>: ' . $author . '</small>
            <small class="created_at"><strong>Published</strong> ' . $created_at . ' ago</small>
            <small class="categories">' . $categories_output . '</small>
        </div>';
}

function modexy_post_attachement($n = 1){
    $output = null;

    if(has_post_thumbnail() && $n == 1){
        $output = wp_get_attachment_url(get_post_thumbnail_id(get_the_ID()));
    }else{
        $attachments = get_posts(array(
            'post_parent'       => get_the_ID(),
            'post_type'         => 'attachment',
            'posts_per_page'    => $n,
            'post_mime_type' => 'image'
        ));


        // $attachments = get_children(array(
        //     'post_parent'       => get_the_ID(),
        //     'post_type'         => 'attachment',
        //     'posts_per_page'    => $n,
        //     'post_mime_type' => 'image'
        // ));

        // $attachments = get_attached_media('image', get_the_ID());

        if(!empty($attachments)){
            $output = ($n == 1) ? wp_get_attachment_url($attachments[0]->ID) : $attachments ;
        }

        wp_reset_postdata();
    }

    return $output;
}

function modexy_post_footer(){
    $output_tags = '';
    
    if(has_tag()){
        $output_tags .= '<svg xmlns="http://www.w3.org/2000/svg" width="17" height="17" viewBox="0 0 24 24">
                            <path d="M9.776 2l11.395 11.395-7.78 7.777-11.391-11.391v-7.781h7.776zm.829-2h-10.605v10.609l13.391 13.391 10.609-10.604-13.395-13.396zm-3.191 7.414c-.781.782-2.046.782-2.829.001-.781-.783-.781-2.048 0-2.829.782-.782 2.048-.781 2.829-.001.782.783.781 2.047 0 2.829z" />
                        </svg><span>';
        
        $tags = get_the_tags();
        foreach ($tags as $tag) {
            $output_tags .= '<a class="post-tag" href="' . esc_url(get_tag_link($tag->term_id)) . '">' . $tag->name . '</a>';
        }

        $output_tags .= '</span>';
    }
    
    
    echo '<small class="post-tags">' . $output_tags . '</small>

        <small class="post-comments">
            <svg xmlns="http://www.w3.org/2000/svg" width="17" height="17" viewBox="0 0 24 24"><path d="M20 9.352c0-4.852-4.75-8.352-10-8.352-5.281 0-10 3.527-10 8.352 0 1.71.615 3.39 1.705 4.695.047 1.527-.85 3.719-1.66 5.312 2.168-.391 5.252-1.258 6.648-2.115 7.698 1.877 13.307-2.842 13.307-7.892zm-14.5 1.381c-.689 0-1.25-.56-1.25-1.25s.561-1.25 1.25-1.25 1.25.56 1.25 1.25-.561 1.25-1.25 1.25zm4.5 0c-.689 0-1.25-.56-1.25-1.25s.561-1.25 1.25-1.25 1.25.56 1.25 1.25-.561 1.25-1.25 1.25zm4.5 0c-.689 0-1.25-.56-1.25-1.25s.561-1.25 1.25-1.25 1.25.56 1.25 1.25-.561 1.25-1.25 1.25zm7.036 1.441c-.161.488-.361.961-.601 1.416 1.677 1.262 2.257 3.226.464 5.365-.021.745-.049 1.049.138 1.865-.892-.307-.979-.392-1.665-.813-2.127.519-4.265.696-6.089-.855-.562.159-1.145.278-1.74.364 1.513 1.877 4.298 2.897 7.577 2.1.914.561 2.933 1.127 4.352 1.385-.53-1.045-1.117-2.479-1.088-3.479 1.755-2.098 1.543-5.436-1.348-7.348z"/></svg>
            <a href="' . get_the_permalink() . '#comments">' . get_comments_number_text() . '</a>
        </small>';
}


function modexy_get_embeded_media($types = array('iframe')){
    $content = do_shortcode(apply_filters('the_content', get_the_content()));

    $medias = get_media_embedded_in_content($content, $types);

    if(!empty($medias)){
        echo $medias[0];
    }
}

/*
function get_all_embeded_media() {
    $content = apply_filters('the_content', get_the_content());

    $arr = preg_match_all("/<img[^>]* src=\"([^\"]*)\"[^>]*>/", $content, $matches);

    return $arr ? $matches[1] : array();
}
*/


function modexy_get_embedded_links() {
    $content = apply_filters('the_content', get_the_content());

    $arr = preg_match_all('/<a[^>]*>([^<]+)<\/a>/', $content, $matches);

    return $arr ? $matches : array();
}


// Post Views
function modexy_get_the_views($post_id) {
    global $post_views;

    return get_post_meta($post_id, $post_views, true);
}

function modexy_increase_post_views($post_id) {
    global $post_views;

    $views = get_post_meta($post_id, $post_views, true);

    update_post_meta($post_id, $post_views, ++$views);
}