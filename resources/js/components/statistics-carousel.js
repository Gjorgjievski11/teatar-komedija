export default function initStatisticsFreemodeCarousel() {
    new Swiper('.statistics-carousel', {
        slidesPerView: 4.5,
        spaceBetween: 16,
        freeMode: true,
        grabCursor: true,
        breakpoints: {
            0: {
                slidesPerView: 1.2,
                spaceBetween: 12,
            },
            640: {
                slidesPerView: 2.5,
                spaceBetween: 14,
            },
            768: {
                slidesPerView: 3.5,
                spaceBetween: 16,
            },
            1024: {
                slidesPerView: 4.5,
                spaceBetween: 16,
            },
        },
    });
}
