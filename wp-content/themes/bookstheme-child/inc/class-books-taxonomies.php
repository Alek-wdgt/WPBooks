<?php

class Books_Taxonomies {

    public function __construct() {
        add_action('init', array($this, 'create_books_taxonomies'));
    }

    public function create_books_taxonomies() {

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
}
