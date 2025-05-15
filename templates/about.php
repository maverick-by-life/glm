<?php

/* Template name: О компании */
get_header(); ?>
<section class="info">
    <div class="container">
		<?php
		get_template_part( 'parts/go-home', '', [ 'link' => '', ] ); ?>
        <h1 class="main-title">о компании</h1>
        <div class="info__inner">
            <div class="info__image">
				<?php
				the_post_thumbnail() ?>
            </div>
            <div class="info__description">
				<?php
				the_content(); ?>
            </div>
        </div>
    </div>
</section>
<section class="building">
    <div class="container">
        <h2 class="section-title">Офисное здание в центре Хабаровска</h2>
        <p class="text"><?php
			the_field( 'building_desc' ); ?></p>
        <div class="building__image">
            <img src="<?php
			the_field( 'building_image' ); ?>" alt="Офисное здание в центре Хабаровска"/>
        </div>
    </div>
</section>
<section class="partner">
    <div class="container">
        <h2 class="section-title">партнерство</h2>
        <p class="text"><?php
			the_field( 'partner_desc' ); ?></p>
    </div>
</section>
<section class="team">
    <div class="container">
        <div class="team__top">
        <h2 class="section-title">коллектив</h2>
            <p class="text">
				<?php the_field( 'team_desc' ); ?>
            </p>
        </div>
        <ul class="team__list">
			<?php
			if ( have_rows( 'team_list' ) ) : ?>
				<?php
				while ( have_rows( 'team_list' ) ) : the_row(); ?>
                    <li class="team__item">
                        <div class="team__image">
                            <img src="<?php
							the_sub_field( 'team_image' ); ?>"
                                 alt=" <?php
							     the_sub_field( 'team_name' ); ?>">
                        </div>
                        <h3> <?php
							the_sub_field( 'team_name' ); ?></h3>
                        <p class="text"><?php
							the_sub_field( 'team_position' ); ?></p>
                    </li>
				<?php
				endwhile; ?>
			<?php
			else : ?>
				<?php
				// No rows found ?>
			<?php
			endif; ?>


        </ul>
    </div>
</section>

<?php
get_footer(); ?>
