<?php

/* Template name: Контакты */
get_header(); ?>
<section class="contacts">
    <div class="container">
		<?php
		get_template_part( 'parts/go-home', '', [ 'link' => '', ] ); ?>
        <h1 class="main-title">контакты</h1>
        <div class="contacts__inner">
            <div class="contacts__item">
                <span class="contacts__subtitle">Адрес офиса</span>
                <p><?php
					the_field( 'address', 'option' ); ?></p>
            </div>
            <div class="contacts__item">
                <span class="contacts__subtitle">Телефон</span>
                <a href="tel:+<?php
				echo clearPhone( get_field( 'phone_hr' ) ); ?>">
					<?php
					the_field( 'phone_hr' ); ?>
                </a>
            </div>
            <div class="contacts__item">
                <span class="contacts__subtitle">Email</span>
                <div class="contacts__row email-red">
                    <div>
                        <a href="mailto:<?php the_field( 'email', 'option' ); ?>" rel="nofollow noopener"
                           target="_blank">
							<?php the_field( 'email', 'option' ); ?></a>
                        <span>Почта компании</span>
                    </div>
                    <div>
                        <a href="mailto:<?php the_field( 'email_hr' ); ?>" rel="nofollow noopener" target="_blank">
							<?php the_field( 'email_hr' ); ?></a>
                        <span>Отдел кадров</span>
                    </div>
                </div>
            </div>
            <div class="contacts__item">
                <span class="contacts__subtitle">Добавочные номера</span>
                <div class="contacts__row">
					<?php
					if ( have_rows( 'dobavochnye_nomera' ) ) : ?>
						<?php
						while ( have_rows( 'dobavochnye_nomera' ) ) : the_row(); ?>
                            <div>
                                <p><?php
									the_sub_field( 'number' ); ?></p>
                                <span><?php
									the_sub_field( 'department' ); ?></span>
                            </div>
						<?php
						endwhile; ?>
					<?php
					else : ?>
						<?php
						// No rows found ?>
					<?php
					endif; ?>
                </div>
            </div>
            <div class="contacts__item contacts__item--last">
                <span class="contacts__subtitle">Отдел кадров</span>
                <div class="contacts__row">
					<?php
					if ( have_rows( 'blok_otdel_kadrov' ) ) : ?>
						<?php
						while ( have_rows( 'blok_otdel_kadrov' ) ) : the_row(); ?>
                            <div>
								<?php if ( get_sub_field( 'nomer_telefona' ) ) : ?>
                                    <a href="tel:+<?php
									echo clearPhone( get_sub_field( 'nomer_telefona' ) ); ?>">
										<?php the_sub_field( 'nomer_telefona' ); ?>
                                    </a>
								<?php endif; ?>
                                <span><?php
									the_sub_field( 'fio' ); ?></span>
								<?php if ( get_sub_field( 'email' ) ) : ?>
                                    <a href="mailto:<?php the_sub_field( 'email' ); ?>"><?php the_sub_field( 'email' ); ?></a>
								<?php endif; ?>
                            </div>
						<?php
						endwhile; ?>
					<?php
					else : ?>
						<?php
						// No rows found ?>
					<?php
					endif; ?>
                </div>
            </div>
            <div class="contacts__item contacts__item--last">
                <span class="contacts__subtitle">Бухгалтерия</span>
                <div class="contacts__row">
					<?php
					if ( have_rows( 'block_bookkeeping' ) ) : ?>
						<?php
						while ( have_rows( 'block_bookkeeping' ) ) : the_row(); ?>
                            <div>
								<?php if ( get_sub_field( 'nomer_telefona' ) ) : ?>
                                    <a href="tel:+<?php
									echo clearPhone( get_sub_field( 'nomer_telefona' ) ); ?>">
										<?php the_sub_field( 'nomer_telefona' ); ?>
                                    </a>
								<?php endif; ?>
                                <span><?php
									the_sub_field( 'fio' ); ?></span>
								<?php if ( get_sub_field( 'email' ) ) : ?>
                                    <a href="mailto:<?php the_sub_field( 'email' ); ?>"><?php the_sub_field( 'email' ); ?></a>
								<?php endif; ?>
                            </div>
						<?php
						endwhile; ?>
					<?php
					else : ?>
						<?php
						// No rows found ?>
					<?php
					endif; ?>
                </div>
            </div>

        </div>
    </div>
    <div class="contacts__image">
		<?php
		if ( get_field( 'contacts_img_desk' ) ) : ?>
            <img class="mobile-hidden" src="<?php
			the_field( 'contacts_img_desk' ); ?>" alt="контакты"/>
		<?php
		endif ?>
		<?php
		if ( get_field( 'contacts_img_mobile' ) ) : ?>
            <img class="desktop-hidden" src="<?php
			the_field( 'contacts_img_mobile' ); ?>" alt="контакты"/>
		<?php
		endif ?>
    </div>
</section>
<?php
get_footer(); ?>
