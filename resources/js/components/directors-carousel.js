export default function initDirectorsFreemodeCarousel() {
    new Swiper('.directors-carousel', {
        slidesPerView: 5.7,
        spaceBetween: 8,
        freeMode: true,
        grabCursor: true,
        breakpoints: {
            0: {
                slidesPerView: 1.4, 
                spaceBetween: 12,
            },
            640: {
                slidesPerView: 2.5,
                spaceBetween: 12,
            },
            768: {
                slidesPerView: 3.5,
                spaceBetween: 12,
            },
            1024: {
                slidesPerView: 5.7,
                spaceBetween: 8,
            },
        },
    });
}
