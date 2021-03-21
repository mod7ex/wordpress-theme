<?php

/*

    -> without providing capabilities we have:

	// Meta capabilities
	[edit_post]		 => "edit_{$capability_type}"
	[read_post]		 => "read_{$capability_type}"
	[delete_post]		 => "delete_{$capability_type}"

	// Primitive capabilities used outside of map_meta_cap():
	[edit_posts]		 => "edit_{$capability_type}s"
	[edit_others_posts]	 => "edit_others_{$capability_type}s"
	[publish_posts]		 => "publish_{$capability_type}s"
	[read_private_posts]	 => "read_private_{$capability_type}s"

	// Primitive capabilities used within map_meta_cap():
	[read]                   => "read",
	[delete_posts]           => "delete_{$capability_type}s"
	[delete_private_posts]   => "delete_private_{$capability_type}s"
	[delete_published_posts] => "delete_published_{$capability_type}s"
	[delete_others_posts]    => "delete_others_{$capability_type}s"
	[edit_private_posts]     => "edit_private_{$capability_type}s"
	[edit_published_posts]   => "edit_published_{$capability_type}s"
	[create_posts]           => "edit_{$capability_type}s"

*/

/**
 * Capabilities are assigned to roles.
 * 
 * Meta Capabilities: edit_post, delete_post, read_post ... ; they depend on the context 'Which post ?'
 * Primitive Capabilities: edit_posts, delete_posts, read_posts ... ; they don't depend on the context, 
 *                         they are intrinsic to the user 'He/She can edit any post'
 * 
 *      https://developer.wordpress.org/reference/functions/get_post_type_capabilities/
 * 
 *      https://developer.wordpress.org/reference/functions/register_post_type/#capability_type
 *      Note 3: If you use capabilities parameter, capability_type complete your capabilities.
 * 
 *      Note 4 : if you create a new role give him read capability
 */

add_action('init', function(){

    register_post_type('book', array(
        'labels' => array(
            'name'                     =>  __('Books'),
            'singular_name'            =>  __('Book'),
            'add_new'                  =>  __('Add New'),
            'add_new_item'             =>  __('Add New Book'),
            'edit_item'                =>  __('Book'),
            'new_item'                 =>  __('New Book'),
            'view_item'                =>  __('View Book'),
            'view_items'               =>  __('View Books'),
            'search_items'             =>  __('Search Books'),
            'not_found'                =>  __('No books found.'),
            'not_found_in_trash'       =>  __('No books found in Trash.'),
            'parent_item_colon'        =>  __('Parent Book:' ),
            'all_items'                =>  __('All Books'),
            'archives'                 =>  __('Book Archives'),
            'attributes'               =>  __('Book Attributes'),
            'insert_into_item'         =>  __('Insert into Book'),
            'uploaded_to_this_item'    =>  __('Uploaded to this Book'),
            'featured_image'           =>  __('Featured image'),
            'set_featured_image'       =>  __('Set featured image'),
            'remove_featured_image'    =>  __('Remove featured image'),
            'use_featured_image'       =>  __('Use as featured image'),
            'filter_items_list'        =>  __('Filter Books list'),
            'items_list_navigation'    =>  __('Books list navigation'),
            'items_list'               =>  __('Books list'),
            'item_published'           =>  __('Book published.'),
            'item_published_privately' =>  __('Book published privately.'),
            'item_reverted_to_draft'   =>  __('Book reverted to draft.'),
            'item_scheduled'           =>  __('Book scheduled.'),
            'item_updated'             =>  __('Book updated.'),
        ),
        'description'           => 'Book post format to contact admins.',
        'public'                => false,
        'hierarchical'          => false,
        'exclude_from_search'   => true,
        'publicly_queryable'    => false,
        'show_ui'               => true,
        'show_in_menu'          => true,
        'show_in_admin_bar'     => true,
        'show_in_nav_menus'     => true,
        'show_in_rest'          => false,
        'menu_position'         => 31,
        'has_archive'           => false,
        'supports'              => array('title', 'editor'),
        'rewrite'               => false,
        // 'taxonomies'            => array( 'category', 'post_tag' ),

        // capabilities
        'capability_type'       => 'book',
        'map_meta_cap'           => true,
        'capabilities' => array (
                // 3 meta capabilities. 
                'edit_post'                 => 'edit_book',
				'delete_post'               => 'delete_book',
				'read_post'                 => 'read_book',

                // 12 primitive capabilities
				'edit_posts'                => 'edit_books',
				'edit_others_posts'         => 'edit_others_books',
                'edit_published_posts'      => 'edit_published_books',
                'edit_private_posts'        => 'edit_private_books',
				'delete_posts'              => 'delete_books',
				'delete_others_posts'       => 'delete_others_books',
                'delete_private_posts'      => 'delete_private_books',
                'delete_published_posts'    => 'delete_published_books',
				'read_private_posts'        => 'read_private_books',
                'read'                      => 'read',
				'publish_posts'             => 'publish_books',
				'create_posts'              => 'create_books',
        ),
    ));
/*
    // create custom capabolity
    $roles = wp_roles();
    $role = $roles->role_objects['administrator'];
    $role->add_cap('test_custom_cap');

    // Or

    $role = get_role('administrator');
    $role->add_cap('test_custom_cap');
*/
});


// add_action( 'init', function () {
//     add_role(
//         'new_role',
//         'New Role',
//         array(
//             'read'                      => true,
//             'edit_posts'                => true,
//             'edit_published_posts'      => true,
//             'publish_posts'             => true,
//         ),
//     );
// }); 

// add_filter( 'map_meta_cap', 'my_map_meta_cap', 10, 4 );

// function my_map_meta_cap( $caps, $cap, $user_id, $args ) {

// 	/* If editing, deleting, or reading a movie, get the post and post type object. */
// 	if ( 'edit_movie' == $cap || 'delete_movie' == $cap || 'read_movie' == $cap ) {
// 		$post = get_post( $args[0] );
// 		$post_type = get_post_type_object( $post->post_type );

// 		/* Set an empty array for the caps. */
// 		$caps = array();
// 	}

// 	/* If editing a movie, assign the required capability. */
// 	if ( 'edit_movie' == $cap ) {
// 		if ( $user_id == $post->post_author )
// 			$caps[] = $post_type->cap->edit_posts;
// 		else
// 			$caps[] = $post_type->cap->edit_others_posts;
// 	}

// 	/* If deleting a movie, assign the required capability. */
// 	elseif ( 'delete_movie' == $cap ) {
// 		if ( $user_id == $post->post_author )
// 			$caps[] = $post_type->cap->delete_posts;
// 		else
// 			$caps[] = $post_type->cap->delete_others_posts;
// 	}

// 	/* If reading a private movie, assign the required capability. */
// 	elseif ( 'read_movie' == $cap ) {

// 		if ( 'private' != $post->post_status )
// 			$caps[] = 'read';
// 		elseif ( $user_id == $post->post_author )
// 			$caps[] = 'read';
// 		else
// 			$caps[] = $post_type->cap->read_private_posts;
// 	}

// 	/* Return the capabilities required by the user. */
// 	return $caps;
// }