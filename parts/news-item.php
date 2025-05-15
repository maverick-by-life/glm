<li class="news-list__item">
    <div class="news-list__image">
		<?php the_post_thumbnail( 'large' ) ?>
    </div>
    <span><?php the_time( 'd.m.Y' ) ?> г.</span>
    <a href="<?php the_permalink(); ?>" class="news-list__wrapper">
        <h3><?php the_field( 'news_title' ); ?></h3></a>
    <p class="text">
		<?php
		$description         = get_field( 'news_description' );
		$limited_description = mb_substr( $description, 0, 200 );
		if ( mb_strlen( $description ) > 200 ) {
			$limited_description .= '...';
		}
		echo $limited_description;
		?>
    </p>
    <a href="<?php the_permalink(); ?>" class="news-list__link btn">Подробнее</a>
</li>