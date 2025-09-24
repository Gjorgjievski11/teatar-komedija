export default function initAwardFreemodeCarousel() {
    const carousels = document.querySelectorAll('.award-carousel');
    
    if (!carousels.length) return;
    
    carousels.forEach((carouselEl, index) => {
        const uniqueClass = `play-crew-carousel-${index}`;
        carouselEl.classList.add(uniqueClass);
        
        new Swiper(`.${uniqueClass}`, {
            slidesPerView: 1.2,    // default for smallest screens
            spaceBetween: 16,
            freeMode: true,
            grabCursor: true,
            breakpoints: {
                640: {
                    slidesPerView: 2.5,
                },
                1024: {
                    slidesPerView: 3.8,  // original value on desktop
                }
            }
        });
    });
}
