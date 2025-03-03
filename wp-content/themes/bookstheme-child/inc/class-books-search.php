<?php

// Exit if accessed directly.
if (!defined('ABSPATH')) {
    exit;
}

class Books_Search {

    public function __construct() {
        add_filter('posts_join', array($this, 'cf_search_join'));
        add_filter('posts_where', array($this, 'cf_search_where'));
        add_filter('posts_distinct', array($this, 'cf_search_distinct'));
        add_action('pre_get_posts', array($this, 'cf_filter_books_search'));
    }


    public function cf_search_join($join) {
        global $wpdb;

        if (is_search()) {
            $join .= ' LEFT JOIN ' . $wpdb->postmeta . ' ON ' . $wpdb->posts . '.ID = ' . $wpdb->postmeta . '.post_id ';
            $join .= ' LEFT JOIN ' . $wpdb->term_relationships . ' ON ' . $wpdb->posts . '.ID = ' . $wpdb->term_relationships . '.object_id ';
            $join .= ' LEFT JOIN ' . $wpdb->terms . ' ON ' . $wpdb->term_relationships . '.term_taxonomy_id = ' . $wpdb->terms . '.term_id ';
        }

        return $join;
    }


    public function cf_search_where($where) {
        global $wpdb;

        if (is_search()) {

            $where = preg_replace(
                "/\(\s*" . $wpdb->posts . ".post_title\s+LIKE\s*(\'[^\']+\')\s*\)/",
                "(" . $wpdb->posts . ".post_title LIKE $1) OR (" . $wpdb->postmeta . ".meta_value LIKE $1) OR (" . $wpdb->terms . ".name LIKE $1)",
                $where
            );
        }

        return $where;
    }


    public function cf_search_distinct($distinct) {
        if (is_search()) {
            return "DISTINCT";
        }

        return $distinct;
    }


    public function cf_filter_books_search($query) {
        if (is_search() && !is_admin() && $query->is_main_query()) {

            $query->set('post_type', 'books');


            if (!empty($_GET['genre'])) {
                $query->set('tax_query', array(
                    array(
                        'taxonomy' => 'genre',
                        'field'    => 'slug',
                        'terms'    => sanitize_text_field($_GET['genre']),
                        'operator' => 'IN',
                    ),
                ));
            }


            if (!empty($_GET['author'])) {
                $query->set('meta_query', array(
                    array(
                        'key'     => 'author',
                        'value'   => sanitize_text_field($_GET['author']),
                        'compare' => 'LIKE',
                    ),
                ));
            }
        }
    }
}
