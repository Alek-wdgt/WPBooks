<?php

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

class Shortcode_Add_Book {


    public function __construct() {
        add_shortcode('add_book_form', array($this, 'display_add_book_form'));
    }


    public function display_add_book_form() {
        if (!current_user_can('editor') && !current_user_can('administrator')) {
            return '<p>You do not have permission to add books.</p>';
        }


        if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['add_book_nonce']) && wp_verify_nonce($_POST['add_book_nonce'], 'add_book_action')) {
            return $this->handle_form_submission();
        }


        return $this->get_form();
    }


    private function handle_form_submission() {

        $title = sanitize_text_field($_POST['title']);
        $genre = sanitize_text_field($_POST['genre']);
        $publisher = sanitize_text_field($_POST['publisher']);
        $author = sanitize_text_field($_POST['author']);
        $price = floatval($_POST['price']);
        $release_date = sanitize_text_field($_POST['release_date']);


        $existing_book = get_posts(array(
            'post_type'  => 'books',
            'post_title' => $title,
            'post_status' => 'any',
            'numberposts' => 1,
        ));

        if ($existing_book) {
            return '<p>A book with this title already exists. Please choose a different title.</p>';
        }


        $post_data = array(
            'post_title'   => $title,
            'post_type'    => 'books',
            'post_status'  => 'publish',
            'post_author'  => get_current_user_id(),
        );

        $post_id = wp_insert_post($post_data);


        if ($post_id) {
            update_post_meta($post_id, 'genre', $genre);
            update_post_meta($post_id, 'publisher', $publisher);
            update_post_meta($post_id, 'author', $author);
            update_post_meta($post_id, 'price', $price);
            update_post_meta($post_id, 'release_date', $release_date);
            return '<p>Book added successfully. It will be reviewed and published soon.</p>';
        } else {
            return '<p>There was an error adding the book. Please try again.</p>';
        }
    }


    private function get_form() {
        ob_start();
        ?>
        <form method="POST" action="">
            <?php wp_nonce_field('add_book_action', 'add_book_nonce'); ?>

            <p>
                <label for="title">Title:</label>
                <input type="text" id="title" name="title" required />
            </p>

            <p>
                <label for="genre">Genre:</label>
                <input type="text" id="genre" name="genre" required />
            </p>

            <p>
                <label for="publisher">Publisher:</label>
                <input type="text" id="publisher" name="publisher" required />
            </p>

            <p>
                <label for="author">Author:</label>
                <input type="text" id="author" name="author" required />
            </p>

            <p>
                <label for="price">Price:</label>
                <input type="number" id="price" name="price" step="0.01" required />
            </p>

            <p>
                <label for="release_date">Release Date:</label>
                <input type="date" id="release_date" name="release_date" required />
            </p>

            <p>
                <input type="submit" value="Add Book" />
            </p>
        </form>
        <?php
        return ob_get_clean();
    }

}

new Shortcode_Add_Book();
