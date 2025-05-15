<?php get_header(); ?>
    <section class="vacancy-top">
        <div class="container">
			<?php get_template_part( 'parts/go-home', '', [ 'link' => 'vacancies', ] ); ?>
            <h1 class="main-title" id='vacancies-title'>
				<?php the_title(); ?>
            </h1>
        </div>
    </section>
    <section class="vacancy">
        <div class="container">
            <div class="vacancy__inner">
                <ul class="vacancy__info">
                    <li>
                        <b>Размер оплаты:</b>
                        <p class="text"><?php the_field( 'vacancies_salary' ); ?></p>
                    </li>
                    <li>
                        <b>График работы:</b>
                        <p class="text">
							<?php the_field( 'vacancies_time' ); ?></p>
                    </li>
					<?php if ( get_field( 'vacancies_work' ) ) : ?>
                        <li>
                            <b>Трудоустройство:</b>
                            <p class="text"><?php the_field( 'vacancies_work' ); ?></p>
                        </li>
					<?php endif; ?>
					<?php if ( get_field( 'vacancies_location' ) ) : ?>
                        <li>
                            <b>Место работы:</b>
                            <p class="text"><?php the_field( 'vacancies_location' ); ?></p>
                        </li>
					<?php endif; ?>
                </ul>
				<?php the_content(); ?>
                <a href="" data-fancybox data-src="#callback-popup" class="vacancy__link btn">Отправить резюме</a>
				<?php if ( get_the_post_thumbnail() ) : ?>
                    <div class="vacancy__image">
						<?php the_post_thumbnail() ?>
                    </div>
				<?php endif; ?>
            </div>
        </div>
    </section>
<?php
get_footer(); ?>