<?php
$forms = array(
	'callback' => array(
		'title' => 'Станьте частью компании «Глобал Майнинг»',
		'text'  => 'Заполните форму и наш специалист свяжется с вами в ближайшее время, чтобы обсудить подробности',
		'form'  => 'callback',
		'id'    => 'c21c744'
	),
);

foreach ( $forms as $form ) {
	?>
    <div class="popup popup-default <?= $form['form'] ?>-popup" id="<?= $form['form'] ?>-popup" style="display: none">
        <div class="popup__title">
            <h3><?= $form['title'] ?></h3>
            <p><?= $form['text'] ?></p>
        </div>
        <div class="popup__content">
            <div class="form">
				<?= do_shortcode( '[contact-form-7 id="' . $form['id'] . '"]' ); ?>
            </div>
        </div>
    </div>
	<?php
}
?>

<?php //попап успешной отправки ?>
<div class="popup popup-default result success-popup" id="success-popup" style="display: none">
    <svg width="80" height="80" viewBox="0 0 80 80" fill="none" xmlns="http://www.w3.org/2000/svg">
        <g clip-path="url(#clip0_190_7164)">
            <path d="M0 5C0 2.23858 2.23858 0 5 0H75C77.7614 0 80 2.23858 80 5V75C80 77.7614 77.7614 80 75 80H5C2.23858 80 0 77.7614 0 75V5Z"
                  fill="#31C60C"/>
            <path d="M28.3333 43.3333L35 48.3333L50 30" stroke="white" stroke-width="2"/>
        </g>
        <defs>
            <clipPath id="clip0_190_7164">
                <rect width="80" height="80" rx="5" fill="white"/>
            </clipPath>
        </defs>
    </svg>

    <div class="popup__title">
        <h3>заявка успешно отправлена!</h3>
        <p>В ближайшее время с вами свяжется наш специалист.</p>
    </div>
</div>

<?php //попап не успешной отправки ?>
<div class="popup popup-default result failed-popup" id="failed-popup" style="display: none">
    <svg width="80" height="80" viewBox="0 0 80 80" fill="none" xmlns="http://www.w3.org/2000/svg">
        <g clip-path="url(#clip0_190_7313)">
            <path d="M0 5C0 2.23858 2.23858 0 5 0H75C77.7614 0 80 2.23858 80 5V75C80 77.7614 77.7614 80 75 80H5C2.23858 80 0 77.7614 0 75V5Z"
                  fill="#E40E20"/>
            <path d="M47.0703 32.9292L32.9282 47.0713" stroke="white" stroke-width="2" stroke-linecap="square"/>
            <path d="M47.0703 47.0708L32.9282 32.9287" stroke="white" stroke-width="2" stroke-linecap="square"/>
        </g>
        <defs>
            <clipPath id="clip0_190_7313">
                <rect width="80" height="80" rx="5" fill="white"/>
            </clipPath>
        </defs>
    </svg>
    <div class="popup__title">
        <h3>ошибка отправки формы!</h3>
        <p>К сожалению, произошла ошибка отправки резюме. Попробуйте снова через некоторое время или свяжитесь с
            нами.</p>
    </div>
    <div class="popup__contacts">
        <a href="tel:+<?php echo clearPhone( get_field( 'phone',
			'option' ) ); ?>">
            <svg width="40" height="40" viewBox="0 0 40 40" fill="none" xmlns="http://www.w3.org/2000/svg">
                <rect width="40" height="40" rx="3" fill="#F1F1F3"/>
                <path d="M14.6796 12.0572L15.0297 11.7071C15.4203 11.3166 16.0534 11.3166 16.4439 11.7071L18.8192 14.0824C19.2097 14.4729 19.2097 15.1061 18.8192 15.4966L17.1584 17.1574C16.8752 17.4406 16.805 17.8732 16.9841 18.2313C18.0193 20.3018 19.6982 21.9807 21.7687 23.0159C22.1268 23.195 22.5594 23.1248 22.8426 22.8416L24.5034 21.1808C24.8939 20.7903 25.5271 20.7903 25.9176 21.1808L28.2929 23.5561C28.6834 23.9466 28.6834 24.5797 28.2929 24.9703L27.9428 25.3204C25.8314 27.4317 22.4889 27.6693 20.1001 25.8777L19.3128 25.2872C17.5693 23.9796 16.0204 22.4307 14.7128 20.6872L14.1223 19.8999C12.3307 17.5111 12.5683 14.1686 14.6796 12.0572Z"
                      fill="#E40E20"/>
            </svg>
			<?php the_field( 'phone', 'option' ); ?>
        </a>
        <a href="mailto:<?php the_field( 'email', 'option' ); ?>">
            <svg width="40" height="40" viewBox="0 0 40 40" fill="none" xmlns="http://www.w3.org/2000/svg">
                <rect width="40" height="40" rx="3" fill="#F1F1F3"/>
                <rect x="11.332" y="13.5" width="17.3333" height="13" rx="2" stroke="#E40E20"/>
                <path d="M19.9987 21.0833L11.332 16.75V24.5C11.332 25.6046 12.2275 26.5 13.332 26.5H26.6654C27.7699 26.5 28.6654 25.6046 28.6654 24.5V16.75L19.9987 21.0833Z"
                      fill="#E40E20"/>
            </svg>
			<?php the_field( 'email', 'option' ); ?></a>
    </div>
</div>