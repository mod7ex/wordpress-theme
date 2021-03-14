<?php
    $fields = array(
        'author'    => '<div class="form-field">
                            <label for="author">' . __('Name', DOMAIN) . '<span class="required"> *</span></label>
                            <input class="form-input" id="author" name="author" type="text" value="' . esc_attr($commenter['comment_author']) . '" maxlength="245" required="required">
                        </div>',

        'email'     => '<div class="form-field">
                            <label for="email">' . __('Email', DOMAIN) . '<span class="required"> *</span></label>
                            <input class="form-input" id="email" name="email" type="email" value="' . esc_attr($commenter['comment_author_email']) . '" maxlength="255" required="required">
                        </div>',
        
        'url'       => '<div class="form-field">
                            <label for="url">' . __('Website', DOMAIN) . '</label>
                            <input class="form-input" id="url" name="url" type="text" value="' . esc_attr($commenter['comment_author_url']) . '">
                        </div>',
        
        'cookies'   => '<div class="form-field">
                            <input type="checkbox" id="comment_cookie" name="wp-comment-cookies-consent">
                            <label for="comment_cookie">' . __('Save my name, email, and website in this browser for the next time I comment.', DOMAIN) . '</label>
                        </div>',
                    
    );

    comment_form(array(
        'title_reply_before'    => '<h3 id="reply-title" class="comment-reply-title">',
        'title_reply_after'     => '</h3>',
        'title_reply'           => 'Leave a comment',
        'class_submit'          => 'btn',
        'label_submit'          => __('Submit Comment'),
        'comment_field'         => '<div class="form-field">
                                    <label for="comment">' . _x('Comment', 'noun') . '</label>
                                    <textarea class="form-input" id="comment" name="comment" required="required" rows="5">' . esc_attr($commenter['comment_author_url']) . '</textarea>
                                </div>',
        'fields'                => apply_filters('comment_form_default_fields', $fields),
    ));