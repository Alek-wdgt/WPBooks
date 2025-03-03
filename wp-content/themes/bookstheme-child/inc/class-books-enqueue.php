<?php

class Books_Enqueue {

    public function __construct() {
        add_action('wp_enqueue_scripts', array($this, 'enqueue_scripts'));
    }

    public function enqueue_scripts() {
        wp_enqueue_script('axios', 'https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js', [], null, true);
        wp_enqueue_script('books-filter', get_stylesheet_directory_uri() . '/js/books-filter.js', ['axios'], null, true);
        wp_localize_script('books-filter', 'booksFilter', [
            'rest_url' => esc_url(rest_url('books/v1/list')),
        ]);
    }
}
