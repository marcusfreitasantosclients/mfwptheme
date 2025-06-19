<?php 

function register_cpt_gallery() {
    $labels = array(
        'name'                  => 'Galleries',
        'singular_name'         => 'Galleries',
        'menu_name'             => 'Galleries',
        'name_admin_bar'        => 'Gallery',
        'add_new'               => 'Add new',
        'add_new_item'          => 'New gallery',
        'edit_item'             => 'Edit gallery',
        'new_item'              => 'New gallery',
        'view_item'             => 'View gallery',
        'view_items'            => 'View galleries',
        'search_items'          => 'Search galleries',
        'not_found'             => 'No gallery found',
        'not_found_in_trash'    => 'No gallery found on trash',
        'all_items'             => 'All galleries',
        'archives'              => 'Archives',
        'insert_into_item'      => 'Insert into gallery',
        'uploaded_to_this_item' => 'Uploaded',
        'filter_items_list'     => 'Filter galleries',
        'items_list_navigation' => 'Browse list of galleries',
        'items_list'            => 'Galleries list',
    );

    $args = array(
        'labels'                => $labels,
        'public'                => true,
        'publicly_queryable'    => true,
        'show_ui'               => true,
        'show_in_menu'          => true,
        'menu_position'         => 5,
        'menu_icon'             => 'dashicons-format-gallery',
        'capability_type'       => 'post',
        'hierarchical'          => false,
        'supports'              => array('title', 'thumbnail', 'editor', 'excerpt'), 
        'has_archive'           => true,
        'rewrite'               => array('slug' => 'galleries'),
        'show_in_rest'          => false,
    );

    register_post_type('gallery', $args);
}
add_action('init', 'register_cpt_gallery');