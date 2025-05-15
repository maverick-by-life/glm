<?php
get_header();
?>

    <section class="single-default">
        <div class="container">
            <div class="container-text">
                <h1><?php the_title() ?></h1>
                <?php the_content(); ?>
            </div>
        </div>
    </section>

<?php
get_footer();
