document.addEventListener('DOMContentLoaded', function () {
    const heroCarouselElement = document.querySelector('.mySwiper');

    if (!heroCarouselElement) {
        return;
    }

    // Initialize Swiper
    const swiper = new Swiper(".mySwiper", {
        slidesPerView: 1,
        spaceBetween: 0,
        loop: true,
        effect: 'fade',
        fadeEffect: {
            crossFade: true
        },
        speed: 1000,
        autoplay: {
            delay: 10000,
            disableOnInteraction: false,
        },
        pagination: {
            el: ".swiper-pagination",
            clickable: true,
        },
        navigation: {
            nextEl: ".swiper-button-next",
            prevEl: ".swiper-button-prev",
        },
    });
});
