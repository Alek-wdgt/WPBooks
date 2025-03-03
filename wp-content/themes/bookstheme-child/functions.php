<?php
// Exit if accessed directly.
if (!defined('ABSPATH')) {
    exit;
}

require get_stylesheet_directory() . '/inc/class-books-post-type.php';
require get_stylesheet_directory() . '/inc/class-books-taxonomies.php';
require get_stylesheet_directory() . '/inc/class-books-rest-api.php';
require get_stylesheet_directory() . '/inc/class-books-enqueue.php';

function bookstheme_child_init_classes(): void
{
    wp_enqueue_style('parent-style', get_template_directory_uri() . '/style.css');
    wp_enqueue_style('child-style', get_stylesheet_directory_uri() . '/style.css', array('parent-style'));

    new Books_Post_Type();
    new Books_Taxonomies();
    new Books_REST_API();
    new Books_Enqueue();

}
add_action('after_setup_theme', 'bookstheme_child_init_classes');







