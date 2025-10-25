export default function initPlayCrewFreemodeCarousel() {
    new Swiper('.play-crew-carousel', {
        slidesPerView: 6.5,
        spaceBetween: 16,
        freeMode: true,
        grabCursor: true,
        // Add padding to prevent bottom clipping
        wrapperClass: 'swiper-wrapper',
        slideClass: 'swiper-slide',
        // Add these to prevent clipping
        resistance: true,
        resistanceRatio: 0,
        // Add bottom padding
        on: {
            init: function (swiper) {
                // Add padding to wrapper to prevent bottom clipping
                swiper.wrapperEl.style.paddingBottom = '20px';
                swiper.wrapperEl.style.marginBottom = '-20px';
            },
        },
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