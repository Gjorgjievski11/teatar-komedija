export default function initFreemodeCarousel() {
    new Swiper(".freemode", {
        spaceBetween: 30,
        freeMode: true,
        grabCursor: true,
        pagination: {
            el: ".freemode .swiper-pagination",
            clickable: true,
        },
        breakpoints: {
            0: {
                slidesPerView: 1.2,
            },
            640: {
                slidesPerView: 1.7,
            },
            768: {
                slidesPerView: 2.5,
            },
            1024: {
                slidesPerView: 3.5,
            },
            1280: {
                slidesPerView: 4.7,
            }
        }
    });
}
