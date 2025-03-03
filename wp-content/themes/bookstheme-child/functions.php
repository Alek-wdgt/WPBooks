<?php
// Exit if accessed directly.
if (!defined('ABSPATH')) {
    exit;
}

function bookstheme_child_enqueue_styles(): void
{
    wp_enqueue_style('parent-style', get_template_directory_uri() . '/style.css');
    wp_enqueue_style('child-style', get_stylesheet_directory_uri() . '/style.css', array('parent-style'));
}
add_action('wp_enqueue_scripts', 'bookstheme_child_enqueue_styles');

/*
* CPT Books Main Controller
*/
function cpt_books(): void
{
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
    );

    $args = array(
        'labels'             => $labels,
        'public'             => true,
        'show_ui'            => true,
        'show_in_menu'       => true,
        'query_var'          => true,
        'rewrite'            => array('slug' => 'books'),
        'capability_type'    => 'post',
        'has_archive'        => true,
        'hierarchical'       => false,
        'menu_position'      => 5,
        'supports'           => array('title', 'editor', 'thumbnail', 'excerpt', 'custom-fields'),
    );
    register_post_type('books', $args);
}
add_action('init', 'cpt_books');

function create_books_taxonomies(): void
{
    register_taxonomy('genre', 'books', array(
        'label'             => 'Genres',
        'rewrite'           => array('slug' => 'genre'),
        'hierarchical'      => true,
        'show_admin_column' => true,
    ));

    register_taxonomy('publisher', 'books', array(
        'label'             => 'Publishers',
        'rewrite'           => array('slug' => 'publisher'),
        'hierarchical'      => false,
        'show_admin_column' => true,
    ));
}
add_action('init', 'create_books_taxonomies');

if (function_exists('acf_add_local_field_group')) {
    acf_add_local_field_group(array(
        'key'      => 'group_books_fields',
        'title'    => 'Book Details',
        'fields'   => array(
            array(
                'key'   => 'field_author',
                'label' => 'Author',
                'name'  => 'author',
                'type'  => 'text',
            ),
            array(
                'key'   => 'field_price',
                'label' => 'Price',
                'name'  => 'price',
                'type'  => 'number',
            ),
            array(
                'key'   => 'field_release_date',
                'label' => 'Release Date',
                'name'  => 'release_date',
                'type'  => 'date_picker',
            ),
        ),
        'location' => array(
            array(
                array(
                    'param'    => 'post_type',
                    'operator' => '==',
                    'value'    => 'books',
                ),
            ),
        ),
    ));
}
