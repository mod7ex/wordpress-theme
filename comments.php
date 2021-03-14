<?php global $lock; ?>

<div id="comments">

    <?php if(have_comments()): ?>

    <h2 class="comments-title">
        <?php
            printf(
                esc_html(_nx(
                    'One comment on &ldquo;%2$s&rdquo;',
                    '%1$s comments on &ldquo;%2$s&rdquo;',
                    get_comments_number(),
                    'comments title',
                )),
                number_format_i18n(get_comments_number()),
                '<span>' . get_the_title() . '</span>'
            );
        ?>
    </h2>


    <ol class="comments-list">
        <?php
                $args = array(                      // default args
                    'walker'            => new Modexy_Walker_Comment(),
                    'max_depth'         => '',
                    'style'             => 'ul',
                    'callback'          => null,
                    'end-callback'      => null,
                    'type'              => 'all',
                    'page'              => '',
                    'per_page'          => '',
                    'avatar_size'       => 32,
                    'reverse_top_level' => null,
                    'reverse_children'  => '',
                    'format'            => 'html5', // or 'xhtml' if no 'HTML5' theme support
                    'short_ping'        => false,   // @since 3.6
                    'echo'              => true     // boolean, default is true
                );

                wp_list_comments($args);
            ?>
    </ol>

    <!-- comments navigation -->
    <?php if(get_comment_pages_count() > 1 && get_option('page_comments')): ?>
    <nav id="comment-nav-top" class="comments-nav" role="navigation">
        <h3><?php esc_html_e('Comment navigation', DOMAIN); ?></h3>

        <div>
            <?php previous_comments_link(esc_html__('Older Comments', DOMAIN)); ?>
            <?php next_comments_link(esc_html__('Next Comments', DOMAIN)); ?>
        </div>
    </nav>
    <?php endif; ?>
    <!-- comments navigation -->

    <?php endif; ?>


    <!-- No Comments Message -->
    <?php if(comments_open()): ?>

    <div id="comments-form">
        <?php require('template-parts/comment-form.php'); ?>
    </div>

    <!-- Start Comment Form -->
    <?php else: ?>

    <h5 class="no-comments"><?php esc_html_e('Comments are closed.', DOMAIN);echo $lock; ?></h5>

    <?php endif; ?>
    <!-- End Comment Form -->

</div>