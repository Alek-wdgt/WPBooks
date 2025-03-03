<?php

class Books_Post_Type {

    public function __construct() {
        add_action('init', array($this, 'register_post_type'));
        add_action('acf/init', array($this, 'register_acf_fields'));
    }

    public function register_post_type() {
        $labels = array(
            'name'               => 'Books',
            'singular_name'      => 'Book',
            'menu_name'          => 'Books',
            'name_admin_bar'     => 'Book',
            'add_new'            => 'Add New',
            'add_new_item'       => 'Add New Book',
            'new_item'           => 'New Book',
            'edit_item'          => 'Edit Book',
            'view_item'          => 'View Book',
            'all_items'          => 'All Books',
            'search_items'       => 'Search Books',
            'not_found'          => 'No books found.',
            'not_found_in_trash' => 'No books found in Trash.',
            'menu_icon'          => 'dashicons-book',
        );

        $args = array(
            'labels'             => $labels,
            'public'             => true,
            'show_ui'            => true,
            'show_in_menu'       => true,
            'query_var'          => true,
            'rewrite'            => array('slug' => 'book'),
            'capability_type'    => 'post',
            'has_archive'        => true,
            'hierarchical'       => false,
            'menu_position'      => 5,
            'supports'           => array('title', 'editor', 'thumbnail', 'excerpt', 'custom-fields'),
        );

        register_post_type('books', $args);
    }
    public function register_acf_fields() {
        if (!function_exists('acf_add_local_field_group')) return;

        acf_add_local_field_group([
            'key'    => 'group_books_fields',
            'title'  => 'Book Details',
            'fields' => [
                [
                    'key'   => 'field_author',
                    'label' => 'Author',
                    'name'  => 'author',
                    'type'  => 'text',
                ],
                [
                    'key'   => 'field_price',
                    'label' => 'Price',
                    'name'  => 'price',
                    'type'  => 'number',
                ],
                [
                    'key'   => 'field_release_date',
                    'label' => 'Release Date',
                    'name'  => 'release_date',
                    'type'  => 'date_picker',
                    'display_format' => 'F j, Y',
                    'return_format'  => 'Y-m-d',
                ],
            ],
            'location' => [[
                ['param' => 'post_type', 'operator' => '==', 'value' => 'books']
            ]],
        ]);
    }

}
