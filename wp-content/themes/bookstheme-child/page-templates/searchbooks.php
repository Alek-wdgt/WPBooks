<?php
/**
 * Template Name: SearchBooks
 */
get_header();
?>

<div id="books-filter">

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
