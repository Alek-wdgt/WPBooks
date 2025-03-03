<?php

class Books_REST_API {

    public function __construct() {
        add_action('rest_api_init', array($this, 'register_rest_routes'));
    }

    public function register_rest_routes() {
        register_rest_route('books/v1', '/list', array(
            'methods'  => 'GET',
            'callback' => array($this, 'get_filtered_books'),
            'permission_callback' => '__return_true',
        ));
    }

    public function get_filtered_books(WP_REST_Request $request) {

        $genre = $request->get_param('genre');
        $publisher = $request->get_param('publisher');

        $args = array(
            'post_type'      => 'books',
            'posts_per_page' => 10,
            'orderby'        => 'meta_value',
            'meta_key'       => 'release_date',
            'order'          => 'DESC'
        );


        $tax_query = array('relation' => 'AND');
        if (!empty($genre)) {
            $tax_query[] = array(
                'taxonomy' => 'genre',
                'field'    => 'slug',
                'terms'    => $genre,
            );
        }
        if (!empty($publisher)) {
            $tax_query[] = array(
                'taxonomy' => 'publisher',
                'field'    => 'slug',
                'terms'    => $publisher,
            );
        }

        if (count($tax_query) > 1) {
            $args['tax_query'] = $tax_query;
        }

        $query = new WP_Query($args);
        $books = [];

        if ($query->have_posts()) {
            while ($query->have_posts()) {
                $query->the_post();
                $genres = wp_get_post_terms(get_the_ID(), 'genre');
                $publishers = wp_get_post_terms(get_the_ID(), 'publisher');
                $genre_names = wp_list_pluck($genres, 'name');
                $publisher_names = wp_list_pluck($publishers, 'name');

                $books[] = array(
                    'title'        => get_the_title(),
                    'author'       => get_field('author'),
                    'price'        => get_field('price'),
                    'release_date' => get_field('release_date'),
                    'permalink'    => get_permalink(),
                    'genres'       => $genre_names,
                    'publishers'   => $publisher_names,
                );
            }
            wp_reset_postdata();
        }

        return rest_ensure_response($books);
    }
}
