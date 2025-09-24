export default function initActorsFreemodeCarousel() {
    new Swiper('.actors-carousel', {
        slidesPerView: 6.5,
        spaceBetween: 10,
        freeMode: true,
        grabCursor: true,
        breakpoints: {
            // when window width is >= 320px (mobile)
            320: {
                slidesPerView: 1.8,
                spaceBetween: 5,
            },
            // when window width is >= 640px (tablet)
            640: {
                slidesPerView: 2.5,
                spaceBetween: 5,
            },
            // when window width is >= 1024px (desktop)
            1024: {
                slidesPerView: 4.5,
                spaceBetween: 5,
            },
            // when window width is >= 1280px (large screens)
            1280: {
                slidesPerView: 6.5,
                spaceBetween: 5,
            }
        }
      });
};
