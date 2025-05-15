if (document.querySelector('.swiper-acf-block-default') && !document.querySelector('.swiper-acf-block-default').closest('.acf-block-preview')) {

    let sliders = document.querySelectorAll('.swiper-acf-block-default');

    sliders.forEach((e, index) => {

        let swiperId = e.id;

        const swiperSlider = new Swiper('#' + swiperId, {
            slidesPerView: 1,
            spaceBetween: 10,
            loop: false,
            // autoHeight: true,
            pagination: {
                el: ".swiper-pagination",
                clickable: true
            },
            navigation: {
                nextEl: '.slider-btn.next',
                prevEl: '.slider-btn.prev',
            },
        });
    });
}