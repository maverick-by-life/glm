<?php

get_header(); ?>
    <section class="news-top">
        <div class="container">
            <?php
            get_template_part('parts/go-home', '', ['link' => 'news',]); ?>
            <div class="news-top__date">
                <?php
                $publication_num = get_the_date('j');
                $publication_month = get_the_date('F');
                $publication_year = get_the_date('Y');

                $months_genitive = [
                    'Январь'   => 'января',
                    'Февраль'  => 'февраля',
                    'Март'     => 'марта',
                    'Апрель'   => 'апреля',
                    'Май'      => 'мая',
                    'Июнь'     => 'июня',
                    'Июль'     => 'июля',
                    'Август'   => 'августа',
                    'Сентябрь' => 'сентября',
                    'Октябрь'  => 'октября',
                    'Ноябрь'   => 'ноября',
                    'Декабрь'  => 'декабря',
                ];
                echo "<span class='news-top__num'>$publication_num</span><p>$months_genitive[$publication_month],</p><p>{$publication_year}г.</p>" ?>
            </div>
            <h1 class="main-title">
                <?php
                the_title(); ?>
            </h1>
        </div>
    </section>
    <section class="news-content">
        <div class="container">
            <div class="news-content__inner">
                <?php
                the_content(); ?>
            </div>
        </div>
    </section>
    <section class="news-block">
        <div class="container">
            <div class="news-block__row">
                <h2 class="section-title">Новости предприятия</h2>
                <a href="/news" class="btn">Все новости</a>
            </div>
            <ul class="news-list">
                <?php
                $current_id = get_the_ID();

                $args = [
                    'post_type'      => 'news',
                    'posts_per_page' => 3,
                    'post__not_in'   => [$current_id],
                ];

                $query = new WP_Query($args);
                if ($query->have_posts()) : ?>
                    <?php
                    while ($query->have_posts()) :
                        $query->the_post(); ?>
                        <?php
                        get_template_part('parts/news-item'); ?>
                    <?php
                    endwhile ?>
                <?php
                endif;
                wp_reset_postdata(); ?>
            </ul>
        </div>
    </section>


<?php
get_footer(); ?>