<?php
$link = '';

if ( ! empty ( $args['link'] ) ) {
	$link = get_post_type_archive_link( $args['link'] );
	$word = 'Назад';
} else {
	$link = get_home_url();
	$word = 'На главную';
}
?>

<a class="go-home" href="<?php echo $link ?>">
    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
        <path d="M4 12L3.29289 11.2929L2.58579 12L3.29289 12.7071L4 12ZM19 13C19.5523 13 20 12.5523 20 12C20 11.4477 19.5523 11 19 11L19 13ZM9.29289 5.2929L3.29289 11.2929L4.70711 12.7071L10.7071 6.70711L9.29289 5.2929ZM3.29289 12.7071L9.2929 18.7071L10.7071 17.2929L4.70711 11.2929L3.29289 12.7071ZM4 13L19 13L19 11L4 11L4 13Z"
              fill="#181818"/>
    </svg>
	<?php echo $word ?>
</a>