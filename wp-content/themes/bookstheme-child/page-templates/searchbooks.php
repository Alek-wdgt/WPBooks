<?php
/**
 * Template Name: SearchBooks
 */
get_header();
?>
<?php echo do_shortcode('[add_book_form]'); ?>
<div id="books-filter">
    <form role="search" method="get" id="searchform" action="<?php echo esc_url(home_url('/')); ?>">
        <input type="text" value="<?php echo isset($_GET['s']) ? esc_attr($_GET['s']) : ''; ?>" name="s" id="search-bar" placeholder="Search by title, author, or genre..." />
        <input type="hidden" name="post_type" value="books" />
        <input type="hidden" name="author" value="<?php echo isset($_GET['author']) ? esc_attr($_GET['author']) : ''; ?>" />
        <input type="hidden" name="genre" value="<?php echo isset($_GET['genre']) ? esc_attr($_GET['genre']) : ''; ?>" />
        <input type="submit" value="Search" />
    </form>


    <label for="genre-filter">Genre:</label>
    <select id="genre-filter">
        <option value="">All Genres</option>
        <?php
        $genres = get_terms(array(
            'taxonomy' => 'genre',
            'hide_empty' => false,
        ));
        foreach ($genres as $genre) {
            echo '<option value="' . $genre->slug . '">' . $genre->name . '</option>';
        }
        ?>
    </select>



    <label for="publisher-filter">Publisher:</label>
    <select id="publisher-filter">
        <option value="">All Publishers</option>
        <?php
        $publishers = get_terms(array(
            'taxonomy' => 'publisher',
            'hide_empty' => false,
        ));
        foreach ($publishers as $publisher) {
            echo '<option value="' . $publisher->slug . '">' . $publisher->name . '</option>';
        }
        ?>
    </select>
</div>

<div id="books-list">

</div>


<?php get_footer(); ?>
