<?php
/**
 * Register a custom post type called "book".
 *
 * @see get_post_type_labels() for label keys.
 */
function tca_custom_post_type_register() {
	$labels = array(
		'name'                  => _x( 'Reviews', 'Post type general name', 'textdomain' ),
		'singular_name'         => _x( 'Review', 'Post type singular name', 'textdomain' ),
		'menu_name'             => _x( 'Reviews', 'Admin Menu text', 'textdomain' ),
		'name_admin_bar'        => _x( 'Review', 'Add New on Toolbar', 'textdomain' ),
		'add_new'               => __( 'Add New', 'textdomain' ),
		'add_new_item'          => __( 'Add New Review', 'textdomain' ),
		'new_item'              => __( 'New Review', 'textdomain' ),
		'edit_item'             => __( 'Edit Review', 'textdomain' ),
		'view_item'             => __( 'View Review', 'textdomain' ),
		'all_items'             => __( 'All Reviews', 'textdomain' ),
		'search_items'          => __( 'Search Reviews', 'textdomain' ),
		'not_found'             => __( 'No Reviews found.', 'textdomain' ),
		'not_found_in_trash'    => __( 'No Reviews found in Trash.', 'textdomain' ),
		'filter_items_list'     => _x( 'Filter Reviews list', 'Filter Reviews list', 'textdomain' ),
		'items_list_navigation' => _x( 'Reviews list navigation', 'Reviews list navigation', 'textdomain' ),
		'items_list'            => _x( 'Reviews list', 'Reviews list', 'textdomain' ),
	);

	$args = array(
		'labels'             => $labels,
		'public'             => true,
		'publicly_queryable' => true,
		'show_ui'            => true,
		'show_in_menu'       => true,
		'query_var'          => true,
		'rewrite'            => array( 'slug' => 'review' ),
		'capability_type'    => 'post',
		'has_archive'        => true,
		'hierarchical'       => false,
		'menu_position'      => null,
		'supports'           => array( 'title', 'editor' ),
	);

    register_post_type( 'review', $args );
}

add_action( 'init', 'tca_custom_post_type_register' );