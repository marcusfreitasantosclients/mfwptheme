<?php 

function register_cpt_popup() {
    $labels = array(
        'name'                  => 'Popups',
        'singular_name'         => 'Popups',
        'menu_name'             => 'Popups',
        'name_admin_bar'        => 'Popup',
        'add_new'               => 'Add new',
        'add_new_item'          => 'New Popup',
        'edit_item'             => 'Edit Popup',
        'new_item'              => 'New Popup',
        'view_item'             => 'View Popup',
        'view_items'            => 'View Popups',
        'search_items'          => 'Search Popups',
        'not_found'             => 'No Popup found',
        'not_found_in_trash'    => 'No Popup found on trash',
        'all_items'             => 'All Popups',
        'archives'              => 'Archives',
        'insert_into_item'      => 'Insert into Popup',
        'uploaded_to_this_item' => 'Uploaded',
        'filter_items_list'     => 'Filter Popups',
        'items_list_navigation' => 'Browse list of Popups',
        'items_list'            => 'Popups list',
    );

    $args = array(
        'labels'                => $labels,
        'public'                => false,
        'publicly_queryable'    => false,
        'show_ui'               => true,
        'show_in_menu'          => true,
        'menu_position'         => 5,
        'menu_icon'             => 'dashicons-cover-image',
        'capability_type'       => 'post',
        'hierarchical'          => false,
        'supports'              => array('title'), 
        'has_archive'           => false,
        'rewrite'               => array('slug' => 'popups'),
        'show_in_rest'          => false,
    );

    register_post_type('popup', $args);
}
add_action('init', 'register_cpt_popup');