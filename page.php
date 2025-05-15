<?php
get_header();
?>
    <section class="page-default">
        <div class="container">
			<?php get_template_part( 'parts/go-home', '', [ 'link' => '', ] ); ?>
            <h1 class="main-title">
				<?php the_title(); ?>
            </h1>
        </div>
    </section>
    <section class="content">
        <div class="container">
            <div class="content__inner">
				<?php the_content(); ?>
            </div>
        </div>
    </section>
<?php
get_footer();
