/**
 * @function getCoords
 * @description Координаты элемента
 *
 * @param {HTMLElement} elem - проверяемый элемент
 */
function getCoords(elem) {

    let box = elem.getBoundingClientRect();
    return {
        top:box.top + window.scrollY,
        right:box.right + window.scrollX,
        bottom:box.bottom + window.scrollY,
        left:box.left + window.scrollX,
        height:box.height,
    };
}

/**
 * @function isOnScreen
 * @description Эта функция проверяет, находится ли заданный элемент в данный момент в видимой области окна веб-страницы.
 *
 * @param {HTMLElement} elem - проверяемый элемент
 * @param {number|null} coefficientDesktop - Число, которое регулирует точку срабатывания функции на настольных устройствах. Чем выше значение, тем дальше от области просмотра будет считаться, что элемент "на экране".
 * @param {number|null} coefficientMobile - Число, которое регулирует точку срабатывания функции на мобильных устройствах. Чем выше значение, тем дальше от области просмотра будет считаться, что элемент "на экране".
 *
 */
function isOnScreen(elem, coefficientDesktop = null, coefficientMobile = null) {
    // Если коэффициенты не предоставлены, используем значения по умолчанию
    if (coefficientDesktop === null && coefficientMobile === null) {
        let coefficient;
        // Используем более высокий коэффициент (0.75) для мобильных устройств
        window.innerWidth <= 768 ? coefficient = 0.75 : coefficient = 0.3;
        return window.scrollY > (getCoords(elem).top - window.innerHeight / coefficient);
    } else {
        // Используем предоставленные коэффициенты
        if (window.innerWidth <= 768) {
            return window.scrollY > (getCoords(elem).top - window.innerHeight / coefficientMobile);
        } else {
            return window.scrollY > (getCoords(elem).top - window.innerHeight / coefficientDesktop);
        }
    }
}

/**
 * @function isMobile
 * @description Проверка ширины устройства (мобильный или десктоп)
 */
function isMobile() {

    return window.outerWidth <= 768;
}

/**
 * @function isExist
 * @description Проверка наличия элемента на странице
 *
 * @param {string} selector - проверяемый элемент
 */
function isExist(selector) {

    return document.querySelector( selector );
}

/**
 * @function isHome
 * @description Проверка, является ли текущая страница главной
 */
function isHome() {

    return isExist( '.home' );
}
