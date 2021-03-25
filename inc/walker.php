<?php 


class Primary_Nav_Walker extends Walker_Nav_Menu
{
    public function start_lvl(&$output, $depth = 0, $args = \null)
    {
        $indent = str_repeat("\t", $depth);

        $submenu = ($depth > 0) ? 'sub-menu' : '';

        $output .= "\n$indent<ul class=\"dropdown-menu $submenu depth-$depth\" >\n";
    }

    public function start_el(&$output, $item, $depth = 0, $args = \null, $id = 0)
    {
        $indent = str_repeat("\t", $depth);

        $li_attributes = '';
        $values = '';

        // $classes = empty($item->classes) ? array() : (array) $item->classes;
        $classes = array();
        $classes[] = ($args->walker->has_children) ? 'dropdown' : '';
        $classes[] = ($item->current || $item->current_item_ancestor) ? 'active' : '';

        
        $class_names = join(' ', apply_filters('nav_menu_css_class', array_filter($classes), $item, $args, $depth));
        $class_names = ' class="' . esc_attr($class_names) . '" ';

        $id = apply_filters('nav_menu_item_id', 'menu_item-' . $item->ID, $item, $args);
        $id = ' id="' . esc_attr($id) . '" ';

        $output .= $indent . '<li' . $id . $values . $class_names . $li_attributes . '>';

        // making the a tag
        $attributes = !empty($item->attr_title) ? ' title="' . esc_attr($item->attr_title) . '" ' : '';
        $attributes .= !empty($item->target) ? ' target="' . esc_attr($item->target) . '" ' : '';
        $attributes .= !empty($item->xfn) ? ' rel="' . esc_attr($item->xfn) . '" ' : '';
        $attributes .= !empty($item->url) ? ' href="' . esc_attr($item->url) . '" ' : '';
        // $attributes .= ($args->walker->has_children) ? ' data-toggle="dropdown" ' : '';

        // $a_classes = array('nav-link pl-2');
        // $a_classes[] = ($args->walker->has_children) ? 'dropdown-toggle' : '';
        // $a_classes[] = $depth ? 'dropdown-item' : '';
        // $a_classes = join(' ', $a_classes);
        // $a_classes = ' class="' . esc_attr($a_classes) . '" '; // nav-item

        $menu_item = $args->before;
        $menu_item .= '<a' . $attributes . '>';
        $menu_item .= $args->link_before . apply_filters('the_title', $item->title, $item->ID) . $args->link_after;
        $menu_item .= '</a>';
        $menu_item .= $args->after;

        $output .= apply_filters('walker_nav_menu_start_el', $menu_item, $item, $depth, $args);
    }
}


class Modexy_Walker_Comment extends Walker_Comment
{
        protected function html5_comment( $comment, $depth, $args ) {
        $tag = ( 'div' === $args['style'] ) ? 'div' : 'li';
 
        $commenter          = wp_get_current_commenter();
        $show_pending_links = ! empty( $commenter['comment_author'] );
 
        if ( $commenter['comment_author_email'] ) {
            $moderation_note = __( 'Your comment is awaiting moderation.' );
        } else {
            $moderation_note = __( 'Your comment is awaiting moderation. This is a preview; your comment will be visible after it has been approved.' );
        }
        ?>
<<?php echo $tag; ?> id="comment-<?php comment_ID(); ?>"
    <?php comment_class( $this->has_children ? 'parent' : '', $comment ); ?>>
    <article id="div-comment-<?php comment_ID(); ?>" class="comment-body">
        <footer class="comment-meta">
            <div class="comment-author vcard">
                <?php
                        if ( 0 != $args['avatar_size'] ) {
                            echo get_avatar( $comment, $args['avatar_size'] );
                        }
                        ?>
                <?php
                        $comment_author = get_comment_author_link( $comment );
 
                        if ( '0' == $comment->comment_approved && ! $show_pending_links ) {
                            $comment_author = get_comment_author( $comment );
                        }
 
                        printf(
                            /* translators: %s: Comment author link. */
                            __( '%s <span class="says">says:</span>' ),
                            sprintf( '<b class="fn">%s</b>', $comment_author )
                        );
                        ?>
            </div><!-- .comment-author -->

            <div class="comment-metadata">
                <?php
                        $time = human_time_diff(strtotime(get_comment_time()), current_time('timestamp', 1));
                        
                        printf(
                            '<a href="%1$s"><time datetime="%1$s">%2$s ago</time></a>',
                            get_the_time(),
                            $time,
                        );
 
                        edit_comment_link( __( 'Edit' ), ' <span class="edit-link">', '</span>' );
                        ?>
            </div><!-- .comment-metadata -->

            <?php if ( '0' == $comment->comment_approved ) : ?>
            <em class="comment-awaiting-moderation"><?php echo $moderation_note; ?></em>
            <?php endif; ?>
        </footer><!-- .comment-meta -->

        <div class="comment-content">
            <?php comment_text(); ?>
        </div><!-- .comment-content -->

        <?php
                if ( '1' == $comment->comment_approved || $show_pending_links ) {
                    comment_reply_link(
                        array_merge(
                            $args,
                            array(
                                'add_below' => 'div-comment',
                                'depth'     => $depth,
                                'max_depth' => $args['max_depth'],
                                'before'    => '<div class="reply">',
                                'after'     => '</div>',
                            )
                        )
                    );
                }
                ?>
    </article><!-- .comment-body -->
    <?php
    }
}


add_filter('nav_manu_css_class', function($classes, $item, $args){

    if ( 'primary' === $args->theme_location ) {
        $classes[] = 'nav-item';
    }

    return $classes;
}, 1, 3);

add_filter('nav_manu_link_attributes', function($classes, $item, $args){

    if ( 'primary' === $args->theme_location ) {
        $classes['class'] = 'nav-link menu-link';
    }

    return $classes;
}, 1, 3);