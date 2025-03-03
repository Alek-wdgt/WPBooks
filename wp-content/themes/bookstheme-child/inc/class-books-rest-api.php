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
            'args' => array(
                'genre' => array(
                    'required' => false,
                    'validate_callback' => function($param) {
                        return is_string($param);
                    }
                ),
                'publisher' => array(
                    'required' => false,
                    'validate_callback' => function($param) {
                        return is_string($param);
                    }
                ),
                'page' => array(
                    'required' => false,
                    'default' => 1,
                    'validate_callback' => function($param) {
                        return is_numeric($param) && $param > 0;
                    }
                ),
                'per_page' => array(
                    'required' => false,
                    'default' => 10,
                    'validate_callback' => function($param) {
                        return is_numeric($param) && $param > 0;
                    }
                ),
            )
        ));
    }

    public function get_filtered_books(WP_REST_Request $request) {
        $genre     = $request->get_param('genre');
        $publisher = $request->get_param('publisher');
        $page      = max(1, intval($request->get_param('page')));
        $per_page  = max(1, intval($request->get_param('per_page')));

        $args = array(
            'post_type'      => 'books',
            'posts_per_page' => $per_page,
            'paged'          => $page,
            'orderby'        => 'meta_value',
            'meta_key'       => 'release_date',
            'order'          => 'DESC'
        );

        // Handle Taxonomy Filters
        $tax_query = array('relation' => 'AND');
        if (!empty($genre)) {
            $tax_query[] = array(
                'taxonomy' => 'genre',
                'field'    => 'slug',
                'terms'    => explode(',', $genre),
            );
        }
        if (!empty($publisher)) {
            $tax_query[] = array(
                'taxonomy' => 'publisher',
                'field'    => 'slug',
                'terms'    => explode(',', $publisher),
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

        $response = array(
            'books'       => $books,
            'total_pages' => $query->max_num_pages,
            'current_page' => $page
        );

        return rest_ensure_response($response);
    }
}

new Books_REST_API();
