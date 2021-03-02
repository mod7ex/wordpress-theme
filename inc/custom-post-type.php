<?php



add_action('init', function(){

    register_post_type('message', array(
        'labels' => array(
            'name'                     =>  __('Messages'),
            'singular_name'            =>  __('Message'),
            'add_new'                  =>  __('Add New'),
            'add_new_item'             =>  __('Add New Message'),
            'edit_item'                =>  __('Edit Message'),
            'new_item'                 =>  __('New Message'),
            'view_item'                =>  __('View Message'),
            'view_items'               =>  __('View Messages'),
            'search_items'             =>  __('Search Messages'),
            'not_found'                =>  __('No Messages found.'),
            'not_found_in_trash'       =>  __('No Messages found in Trash.'),
            'parent_item_colon'        =>  __('Parent Message:' ),
            'all_items'                =>  __('All Messages'),
            'archives'                 =>  __('Message Archives'),
            'attributes'               =>  __('Message Attributes'),
            'insert_into_item'         =>  __('Insert into message'),
            'uploaded_to_this_item'    =>  __('Uploaded to this message'),
            'featured_image'           =>  __('Featured image'),
            'set_featured_image'       =>  __('Set featured image'),
            'remove_featured_image'    =>  __('Remove featured image'),
            'use_featured_image'       =>  __('Use as featured image'),
            'filter_items_list'        =>  __('Filter Messages list'),
            'items_list_navigation'    =>  __('Messages list navigation'),
            'items_list'               =>  __('Messages list'),
            'item_published'           =>  __('Message published.'),
            'item_published_privately' =>  __('Message published privately.'),
            'item_reverted_to_draft'   =>  __('Message reverted to draft.'),
            'item_scheduled'           =>  __('Message scheduled.'),
            'item_updated'             =>  __('Message updated.'),
        ),

        'description'           => 'Message post format to contact admins.',
        'public'                => false,
        'hierarchical'          => false,
        'exclude_from_search'   => true,
        'publicly_queryable'    => false,
        'show_ui'               => true,
        'show_in_menu'          => true,
        'show_in_admin_bar'     => false,
        'show_in_nav_menus'     => false,
        'show_in_rest'          => false,
        'menu_position'         => 30,
        'menu_icon'             => 'dashicons-buddicons-pm',
        // 'capability_type'       => 'post',
        'has_archive'           => false,
        'supports'              => array('title', 'editor', 'excerpt'),
        // 'taxonomies'            => array( 'category', 'post_tag' ),
        'rewrite'               => false
    ));


    // custom columns
    add_filter("manage_message_posts_columns", function($post_columns){ # manage_{$custom_post}_posts_columns
        $columns = array();

        $columns['title'] = 'Author';
        $columns['message'] = 'Message overview';
        $columns['email'] = 'E-mail';
        $columns['date'] = 'Sent At';

        return $columns;
    });


    # manage_{$post->post_type}_posts_custom_column"
    add_action("manage_message_posts_custom_column", function($column_name, $post_id) {
        switch ($column_name) {
            case 'message':
                the_excerpt();
                break;

            case 'email':
                echo 'email here';
                break;
        }
    }, 10, 2);


    /**
     * 
     * Contact meta box
     */
    add_action('add_meta_boxes', function(){

        add_meta_box(
            'email-box',
            'E-mail',
            function($post){
                wp_nonce_field('email_action', '_email_nonce');
                $email = get_post_meta($post->ID, '_email_meta_key', true);

                echo '<input type="email" value="' . $email . '" placeholder="E-mail" >';
            },
            'message',
            'side',
            'core'
        );
        
    });

});