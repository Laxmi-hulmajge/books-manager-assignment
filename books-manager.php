<?php
/**
 * Plugin Name: Books Manager
 * Description: Books management system using custom post type
 * Version: 1.0
 * Author: Laxmi Wadikar
 */

if (!defined('ABSPATH')) {
    exit;
}

 // Register Books Custom Post Type

function bm_books_cpt() {

    $args = array(
        'label' => 'Books',
        'public' => true,
        'menu_icon' => 'dashicons-book',
        'supports' => array('title'),
        'has_archive' => true,
        'rewrite' => array('slug' => 'books'),
        'show_in_rest' => true,
    );

    register_post_type('books', $args);
}

add_action('init', 'bm_books_cpt');


// Add Meta Box

function bm_add_book_meta_boxes() {

    add_meta_box(
        'bm_book_details',
        'Book Details',
        'bm_book_details_callback',
        'books',
        'normal',
        'default'
    );
}

add_action('add_meta_boxes', 'bm_add_book_meta_boxes');



function bm_book_details_callback($post) {

    $author = get_post_meta($post->ID, '_bm_author', true);
    $genre = get_post_meta($post->ID, '_bm_genre', true);
    $published_date = get_post_meta($post->ID, '_bm_published_date', true);
    $description = get_post_meta($post->ID, '_bm_description', true);

    ?>

    <p>
        <label><strong>Author</strong></label><br>
        <input type="text" name="bm_author" value="<?php echo esc_attr($author); ?>" style="width:100%;">
    </p>

    <p>
        <label><strong>Genre</strong></label><br>

        <select name="bm_genre" style="width:100%;">

            <option value="">Select Genre</option>

            <option value="Fiction" <?php selected($genre, 'Fiction'); ?>>
                Fiction
            </option>

            <option value="Non-Fiction" <?php selected($genre, 'Non-Fiction'); ?>>
                Non-Fiction
            </option>

            <option value="Sci-Fi" <?php selected($genre, 'Sci-Fi'); ?>>
                Sci-Fi
            </option>

            <option value="Biography" <?php selected($genre, 'Biography'); ?>>
                Biography
            </option>

        </select>
    </p>

    <p>
        <label><strong>Published Date</strong></label><br>

        <input type="date" name="bm_published_date"
            value="<?php echo esc_attr($published_date); ?>"
            style="width:100%;">
    </p>

    <p>
        <label><strong>Description</strong></label><br>

        <textarea name="bm_description"
            rows="5"
            style="width:100%;"><?php echo esc_textarea($description); ?></textarea>
    </p>

    <?php
}

 // Save Meta Box Data

function bm_save_book_meta_data($post_id) {

    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
        return;
    }

    if (isset($_POST['bm_author'])) {
        update_post_meta(
            $post_id,
            '_bm_author',
            sanitize_text_field($_POST['bm_author'])
        );
    }

    if (isset($_POST['bm_genre'])) {
        update_post_meta(
            $post_id,
            '_bm_genre',
            sanitize_text_field($_POST['bm_genre'])
        );
    }

    if (isset($_POST['bm_published_date'])) {
        update_post_meta(
            $post_id,
            '_bm_published_date',
            sanitize_text_field($_POST['bm_published_date'])
        );
    }

    if (isset($_POST['bm_description'])) {
        update_post_meta(
            $post_id,
            '_bm_description',
            sanitize_textarea_field($_POST['bm_description'])
        );
    }
}

add_action('save_post', 'bm_save_book_meta_data');


  // Restrict Books Access to Logged-in Users

function bm_books_access() {

    if (is_singular('books') && !is_user_logged_in()) {

        wp_redirect(wp_login_url());
        exit;
    }


    if (is_post_type_archive('books') && !is_user_logged_in()) {

        wp_redirect(wp_login_url());
        exit;
    }
}

add_action('template_redirect', 'bm_books_access');

// Books Listing Shortcode
 
function bm_books_list_shortcode() {

    if (!is_user_logged_in()) {

        return '<p>You must be logged in to view this content.</p>';
    }

    $paged = (get_query_var('paged')) ? get_query_var('paged') : 1;

    $selected_genre = isset($_GET['genre'])
        ? sanitize_text_field($_GET['genre'])
        : '';

    $args = array(
        'post_type'      => 'books',
        'posts_per_page' => 5,
        'paged'          => $paged
    );


    if (!empty($selected_genre)) {

        $args['meta_query'] = array(
            array(
                'key'     => '_bm_genre',
                'value'   => $selected_genre,
                'compare' => '='
            )
        );
    }

    $books_query = new WP_Query($args);

    ob_start();

    ?>

    <form method="GET" style="margin-bottom:20px;">

        <select name="genre">

            <option value="">All Genres</option>

            <option value="Fiction" <?php selected($selected_genre, 'Fiction'); ?>>
                Fiction
            </option>

            <option value="Non-Fiction" <?php selected($selected_genre, 'Non-Fiction'); ?>>
                Non-Fiction
            </option>

            <option value="Sci-Fi" <?php selected($selected_genre, 'Sci-Fi'); ?>>
                Sci-Fi
            </option>

            <option value="Biography" <?php selected($selected_genre, 'Biography'); ?>>
                Biography
            </option>

        </select>

        <button type="submit">Filter</button>

    </form>

    <?php

    if ($books_query->have_posts()) :

        echo '<div class="books-list">';

        while ($books_query->have_posts()) :
            $books_query->the_post();

            $author = get_post_meta(get_the_ID(), '_bm_author', true);
            $genre = get_post_meta(get_the_ID(), '_bm_genre', true);

            ?>

            <div class="book-card">

                <h2>
                    <a href="<?php the_permalink(); ?>">
                        <?php the_title(); ?>
                    </a>
                </h2>

                <p>
                    <strong>Author:</strong>
                    <?php echo esc_html($author); ?>
                </p>

                <p>
                    <strong>Genre:</strong>
                    <?php echo esc_html($genre); ?>
                </p>

            </div>

            <?php

        endwhile;

        echo '</div>';

        // Pagination
        echo paginate_links(array(
            'total' => $books_query->max_num_pages
        ));

    else :

        echo '<p>No books found.</p>';

    endif;

    wp_reset_postdata();

    return ob_get_clean();
}

add_shortcode('books_list', 'bm_books_list_shortcode');


// Enqueue Styles
 
function bm_enqueue_styles() {

    wp_enqueue_style(
        'bm-style',
        plugin_dir_url(__FILE__) . 'assets/css/style.css'
    );
}

add_action('wp_enqueue_scripts', 'bm_enqueue_styles');