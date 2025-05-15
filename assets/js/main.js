(function ($) {
    document.addEventListener('DOMContentLoaded', function () {

        Fancybox.bind('[data-fancybox]', {
            // Your custom options
        });

        // Маска на телефон
        $("input[name*=-phone]").mask("+7 (999) 999-9999");

        // анимация лейблов форм
        if (isExist('.form-wrapper')) {
            const forms = document.querySelectorAll('.form-wrapper');

            forms.forEach((form) => {
                const inputs = form.querySelectorAll('input, textarea');
                inputs.forEach((input) => {
                    input.onfocus = function (e) {
                        const label = input.closest('label');
                        label.classList.add('active')
                    }
                    input.onblur = function (e) {
                        const label = input.closest('label');
                        label.classList.remove('active')
                    }
                });
            });
        }

        // Оборачиваем изображения в ссылки
        if (isExist('.container-text .wp-block-image')) {
            let wpImage = document.querySelectorAll('.container-text .wp-block-image');

            wpImage.forEach((image) => {
                const imgElement = image.querySelector('img'),
                    figcaptionElement = image.querySelector('figcaption'),
                    src = imgElement.src;

                if (!image.parentElement.classList.contains('wp-block-gallery')) {

                    if (imgElement && figcaptionElement) {
                        let org_html = image.innerHTML;

                        org_html = org_html.replace(/<figcaption\b[^>]*>.*?<\/figcaption>/i, '');

                        image.innerHTML = `<a href="${src}" data-fancybox>${org_html}</a>${figcaptionElement.outerHTML}`;
                    } else {
                        const org_html = image.innerHTML;
                        image.innerHTML = `<a href="${src}" data-fancybox>${org_html}</a>`;
                    }
                }
            });
        }

        // Галереи на дефолтной странице
        if (isExist('.container-text .wp-block-gallery')) {
            let wpGalleries = document.querySelectorAll('.container-text .wp-block-gallery');

            wpGalleries.forEach((gallery, index) => {
                let wpImages = gallery.querySelectorAll('.wp-block-image');
                let minHeight = Number.MAX_SAFE_INTEGER;

                wpImages.forEach((image) => {
                    const imgElement = image.querySelector('img'),
                        figcaptionElement = image.querySelector('figcaption'),
                        src = imgElement.src;

                    if (imgElement && figcaptionElement) {
                        let org_html = image.innerHTML;

                        org_html = org_html.replace(/<figcaption\b[^>]*>.*?<\/figcaption>/i, '');

                        image.innerHTML = `<a href="${src}" data-fancybox="gallery-${index}">${org_html}</a>${figcaptionElement.outerHTML}`;
                    } else {
                        const org_html = image.innerHTML;
                        image.innerHTML = `<a href="${src}" data-fancybox="gallery-${index}">${org_html}</a>`;
                    }

                    // Добавление проверки изображений на высоту и присваивания всем минимальной высоты
                    const height = image.offsetHeight;

                    if (height < minHeight) {
                        minHeight = height;
                    }
                });

                wpImages.forEach((img) => {
                    img.style.height = `${minHeight}px`;
                });
            });
        }


        // валидация форм
        let forms = document.querySelectorAll('.wpcf7');

        for (let form of forms) {
            form.addEventListener('wpcf7mailsent', function () {
                Fancybox.close();
                Fancybox.show([{src: '#success-popup', type: "inline"}]);
            });

            form.addEventListener('wpcf7mailfailed', function () {
                Fancybox.close();
                Fancybox.show([{src: '#failed-popup', type: "inline"}]);
            });
        }

        sal({
            threshold: .1,
        });

        //отправка названия вакансии в форме
        const vacanciesTitle = $('#vacancies-title');
        const callbackVacancies = $('input[name=callback-vacancies]');

        if (vacanciesTitle && vacanciesTitle.text().trim() !== '') {
            callbackVacancies.val(vacanciesTitle.text().trim());
        }

        //hamburger
        const body = $("body");
        const navigation = $('.header__nav');

        $(".header__hamburger").click(function () {
            if (body.css("overflow") === "hidden") {
                body.css("overflow", "");
            } else {
                body.css("overflow", "hidden");
            }
            $(this).toggleClass('_active');
            navigation.toggleClass('_active');
        });

        // галерея на главной
        Fancybox.bind('[data-fancybox="homeGallery"]', {
            Toolbar: {
                display: false,
            },
        });

        const galleryHome = new Swiper(".gallery-home", {
            slidesPerView: 1,
            spaceBetween: 10,
            loop: false,
            navigation: {
                nextEl: ".gallery-home__button-next",
                prevEl: ".gallery-home__button-prev",
            },
            breakpoints: {
                480: {
                    slidesPerView: "auto",
                    spaceBetween: 8,
                    centeredSlides: false,
                }
            }
        });


        //ajax подгрузка записей
        const newsList = document.getElementById('news-ajax');
        const newsItem = document.querySelectorAll('.news-list__item');

        if (newsList && newsItem.length > 0) {
            let ias = new InfiniteAjaxScroll(newsList, {
                item: '.news-list__item',
                next: '.next',
                pagination: '.nav-links'
            });
        }

        const vacanciesList = document.getElementById('vacancies-ajax');
        const vacanciesItem = document.querySelectorAll('.vacancies-list__item');

        if (vacanciesList && vacanciesItem.length > 0) {
            let ias = new InfiniteAjaxScroll(vacanciesList, {
                item: '.vacancies-list__item',
                next: '.next',
                pagination: '.nav-links'
            });
        }

        //cookie
        function setCookie(name, value, options = {}) {
            options = {
                path: '/',
                ...options
            };

            if (options.expires instanceof Date) {
                options.expires = options.expires.toUTCString();
            }

            let updatedCookie = encodeURIComponent(name) + "=" + encodeURIComponent(value);

            for (let optionKey in options) {
                updatedCookie += "; " + optionKey;
                let optionValue = options[optionKey];
                if (optionValue !== true) {
                    updatedCookie += "=" + optionValue;
                }
            }

            document.cookie = updatedCookie;
        }

        function getCookie(name) {
            let matches = document.cookie.match(new RegExp(
                "(?:^|; )" + name.replace(/([.$?*|{}()\[\]\\/\+^])/g, '\\$1') + "=([^;]*)"
            ));
            return matches ? decodeURIComponent(matches[1]) : undefined;
        }


        if (!getCookie("cookieConsent")) {
            setTimeout(() => {
                const popup = document.getElementById("cookie-consent");
                popup.classList.add("show");
            }, 4000);
        }
        document.getElementById("accept-cookies").addEventListener("click", function () {
            setCookie("cookieConsent", "true", {'max-age': 31536000});
            const popup = document.getElementById("cookie-consent");
            popup.classList.remove("show");
            setTimeout(() => popup.style.visibility = "hidden", 1000);
        });


        // воспроизведение видео
        const videoContainer = $('.wp-block-video');
        const videoElement = $('.wp-block-video video')

        videoContainer.prepend('<div class="wp-block-video__overlay"></div>')

        $('.wp-block-video__overlay').each(function (i) {
            $(this).on('click touch', function () {
                if (videoElement[i].paused) {
                    $(this).addClass('_playing');
                    videoElement[i].play();
                } else {
                    $(this).removeClass('_playing');
                    videoElement[i].pause();
                }
            });
        });

    });
})(jQuery);

