<?php

get_header(); ?>
<?php
if (is_post_type_archive('vacancies')) : ?>
    <section class="vacancies">
        <div class="container">
            <?php
            get_template_part('parts/go-home', '', ['link' => '',]); ?>
            <div class="vacancies__top">
                <h1 class="main-title">вакансии <span>:<?php
                        $post_count = wp_count_posts('vacancies');
                        echo $post_count->publish;
                        ?></span></h1>

                <div class="vacancies__contact">
                    <p>Email</p>
                    <a href="mailto:<?php
                    the_field('email_hr', '20'); ?>"><?php
                        the_field('email_hr', '20'); ?></a>
                    <span>Отдел кадров</span>
                </div>
            </div>
            <ul id="vacancies-ajax" class="vacancies-list">
                <?php
                if (have_posts()) : while (have_posts()) : the_post();
                    get_template_part('parts/vacancies-item'); ?>
                <?php
                endwhile;
                    $args = [
                        'mid_size'  => null,
                        'prev_text' => __('Предыдущая'),
                        'next_text' => __('Следующая'),
                    ];
                    the_posts_pagination($args);
                else : ?>
                    <h3>Записи отсутствуют</h3>
                <?php
                endif;
                ?>
            </ul>
        </div>
    </section>
<?php
endif; ?>

<?php
if (is_post_type_archive('news')) : ?>
    <section class="news">
        <div class="container">
            <?php
            get_template_part('parts/go-home', '', ['link' => '',]); ?>
            <h1 class="main-title">Новости предприятия</h1>
            <ul id="news-ajax" class="news-list">
                <?php
                if (have_posts()) : while (have_posts()) : the_post();
                    get_template_part('parts/news-item'); ?>
                <?php
                endwhile;
                    $args = [
                        'mid_size'  => null,
                        'prev_text' => __('Предыдущая'),
                        'next_text' => __('Следующая'),
                    ];
                    the_posts_pagination($args);
                else : ?>
                    <h3>Записи отсутствуют</h3>
                <?php
                endif;
                ?>
            </ul>
        </div>
    </section>
<?php
endif; ?>
<?php
get_footer(); ?>