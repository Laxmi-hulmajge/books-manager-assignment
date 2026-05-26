<?php
get_header();

if (have_posts()) :

    while (have_posts()) : the_post();

        $author = get_post_meta(get_the_ID(), '_bm_author', true);
        $genre = get_post_meta(get_the_ID(), '_bm_genre', true);
        $published_date = get_post_meta(get_the_ID(), '_bm_published_date', true);
        $description = get_post_meta(get_the_ID(), '_bm_description', true);

        ?>

        <div style="max-width:800px; margin:50px auto; padding:20px;">

            <h1><?php the_title(); ?></h1>

            <p>
                <strong>Author:</strong>
                <?php echo esc_html($author); ?>
            </p>

            <p>
                <strong>Genre:</strong>
                <?php echo esc_html($genre); ?>
            </p>

            <p>
                <strong>Published Date:</strong>
                <?php echo esc_html($published_date); ?>
            </p>

            <p>
                <strong>Description:</strong><br>
                <?php echo esc_html($description); ?>
            </p>

        </div>

        <?php

    endwhile;

endif;

get_footer();
?>