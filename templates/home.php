<?php /* Template name: Главная */
get_header(); ?>

    <section class="first-screen">
        <div class="container">
            <h1 class="first-screen__title"><?php the_title() ?></h1>
			<?php the_content(); ?>
            <a class="btn first-screen__link" href="/vacancies">Актуальные вакансии</a>
        </div>
		<?php if ( get_field( 'desktop_image' ) ) : ?>
            <div class="first-screen__image mobile-hidden">
                <img src="<?php the_field( 'desktop_image' ); ?>" alt="Global mining"/>
            </div>
		<?php endif ?>
		<?php if ( get_field( 'desktop_image' ) ) : ?>
            <div class="first-screen__image desktop-hidden">
                <img src="<?php the_field( 'mobile_image' ); ?>" alt="Global mining"/>
            </div>
		<?php endif ?>
    </section>
    <section class="about">
        <div class="container">
            <div class="about__top">
                <h2 class="section-title">О компании</h2>
                <div class="about__info">
                    <strong>Кто мы такие?</strong>
                    <p class="about__description text">
						<?php the_field( 'about_company' ); ?>
                    </p>
                    <a class="about__link btn" href="/o-kompanii">Подробнее о компании</a>
                </div>
            </div>
            <ul class="about__stat">
                <li class="about__item">
                    <p class="about__num"><span>>7</span> млн тонн</p>
                    <p class="text">Ежегодно грузится и перевозится горной массы, в том числе золотосодержащих руд</p>
                </li>
                <li class="about__item">
                    <p class="about__num"><span>>50</span> ед</p>
                    <p class="text">Грузовой и специальной техники</p>
                </li>
                <li class="about__item">
                    <p class="about__num"><span>>190</span> чел</p>
                    <p class="text">В штате компании</p>
                </li>
            </ul>
        </div>
    </section>
    <section class="advantages">
        <div class="container">
            <h2 class="section-title">Преимущества работы</h2>
            <p class="advantages__text text">
				<?php the_field( 'advantages_text' ); ?></p>
            <ul class="advantages__list">
				<?php if ( have_rows( 'advantages_list' ) ) : ?>
					<?php while ( have_rows( 'advantages_list' ) ) : the_row(); ?>
                        <li class="advantages__item">
                            <div class="advantages__icon">
                                <img src="<?php the_sub_field( 'icon' ); ?>" alt="">
                            </div>
                            <h3><?php the_sub_field( 'title' ); ?></h3>
                            <p class="text"> <?php the_sub_field( 'description' ); ?></p>

							<?php if ( get_sub_field( 'advantages_doc' ) && get_sub_field( 'doc_title' ) ) : ?>
                                <a href="<?php the_sub_field( 'advantages_doc' ); ?>"
                                   download>
									<?php the_sub_field( 'doc_title' ); ?>
                                </a>
							<?php endif; ?>

                        </li>
					<?php endwhile; ?>
				<?php else : ?>
					<?php // No rows found ?>
				<?php endif; ?>
            </ul>
        </div>
    </section>
    <section class="gallery">
        <div class="swiper gallery-home">
            <h2 class="section-title">Галерея</h2>
            <div class="swiper-wrapper">
				<?php if ( have_rows( 'home_gallery' ) ) : ?>
					<?php while ( have_rows( 'home_gallery' ) ) : the_row(); ?>
						<?php if ( get_sub_field( 'slide' ) ) : ?>
                            <a href="<?php the_sub_field( 'slide' ) ?>" class=" swiper-slide"
                               data-width="1800"
                               data-fancybox="homeGallery">
                                <img src="<?php the_sub_field( 'slide' ); ?>" alt="слайд"/>
                            </a>
						<?php endif ?>
					<?php endwhile; ?>
				<?php else : ?>
					<?php // No rows found ?>
				<?php endif; ?>
            </div>
            <div class="swiper__buttons">
                <button class="gallery-home__button-prev swiper__button-prev">
                    <svg width="32" height="32" viewBox="0 0 32 32" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M5.33399 16L4.62688 15.2929L3.91977 16L4.62688 16.7071L5.33399 16ZM25.334 17C25.8863 17 26.334 16.5523 26.334 16C26.334 15.4477 25.8863 15 25.334 15L25.334 17ZM12.6269 7.29289L4.62688 15.2929L6.04109 16.7071L14.0411 8.70711L12.6269 7.29289ZM4.62688 16.7071L12.6269 24.7071L14.0411 23.2929L6.04109 15.2929L4.62688 16.7071ZM5.33399 17L25.334 17L25.334 15L5.33399 15L5.33399 17Z"
                              fill="#181818"/>
                    </svg>
                </button>
                <button class="gallery-home__button-next swiper__button-next">
                    <svg width="32" height="32" viewBox="0 0 32 32" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M26.666 16L27.3731 16.7071L28.0802 16L27.3731 15.2929L26.666 16ZM6.66601 15C6.11373 15 5.66601 15.4477 5.66601 16C5.66601 16.5523 6.11373 17 6.66601 17L6.66601 15ZM19.3731 24.7071L27.3731 16.7071L25.9589 15.2929L17.9589 23.2929L19.3731 24.7071ZM27.3731 15.2929L19.3731 7.29289L17.9589 8.70711L25.9589 16.7071L27.3731 15.2929ZM26.666 15L6.66601 15L6.66601 17L26.666 17L26.666 15Z"
                              fill="#181818"/>
                    </svg>
                </button>
            </div>
        </div>
    </section>
    <section class="vacancies">
        <div class="container">
            <div class="vacancies__top">
                <h2 class="section-title">Актуальные вакансии</h2>
                <a href="/vacancies" class="btn">Все вакансии</a>
            </div>

            <ul class="vacancies-list">
				<?php
				$args = array(
					'post_type'      => 'vacancies',
					'posts_per_page' => 6,
				);

				$query = new WP_Query( $args );
				if ( $query->have_posts() ) : ?>
					<?php while ( $query->have_posts() ) :
						$query->the_post(); ?>
						<?php get_template_part( 'parts/vacancies-item' ); ?>
					<?php endwhile ?>
				<?php endif;
				wp_reset_postdata(); ?>
            </ul>
        </div>
    </section>
    <section class="news">
        <div class="container">
            <div class="news__top">
                <h2 class="section-title">Новости предприятия</h2>
                <a href="/news" class="btn">Все новости</a>
            </div>

            <ul class="news-list">
				<?php
				$args = array(
					'post_type'      => 'news',
					'posts_per_page' => 3,
				);

				$query = new WP_Query( $args );
				if ( $query->have_posts() ) : ?>
					<?php while ( $query->have_posts() ) :
						$query->the_post(); ?>
						<?php get_template_part( 'parts/news-item' ); ?>
					<?php endwhile ?>
				<?php endif;
				wp_reset_postdata(); ?>
            </ul>
        </div>
    </section>
<?php get_footer(); ?>