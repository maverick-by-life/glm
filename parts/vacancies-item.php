<li class="vacancies-list__item">
    <a href="<?php the_permalink(); ?>" class="vacancies-list__wrapper"><h3><?php the_title() ?></h3></a>
    <p class="text"><?php the_field( 'vacancies_time' ); ?></p>
    <b><?php the_field( 'vacancies_salary' ); ?></b>
    <a href="<?php the_permalink(); ?>" class="vacancies-list__link btn">Подробнее</a>
</li>