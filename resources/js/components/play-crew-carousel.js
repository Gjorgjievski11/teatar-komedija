export default function initPlayCrewFreemodeCarousel() {
    new Swiper('.play-crew-carousel', {
        slidesPerView: 6.5,
        spaceBetween: 16,
        freeMode: true,
        grabCursor: true,
        breakpoints: {
            // when window width is >= 320px (mobile)
            320: {
                slidesPerView: 1.1,
                spaceBetween: 12,
            },
            // when window width is >= 640px (tablet)
            640: {
                slidesPerView: 2.5,
                spaceBetween: 14,
            },
            // when window width is >= 1024px (desktop)
            1024: {
                slidesPerView: 4.5,
                spaceBetween: 16,
            },
            // when window width is >= 1280px (large screens)
            1280: {
                slidesPerView: 6.5,
                spaceBetween: 16,
            }
        }
    });
}
