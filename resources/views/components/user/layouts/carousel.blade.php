@props(['images'])
<section id="carousel" {{ $attributes(['class' => '-mt-24 relative z-10']) }}>
    <div class="swiper mySwiper w-full h-full mx-auto">
        <div class="swiper-wrapper z-20 bg-black">
            <div class="swiper-slide relative w-full h-full">
                <img src="{{ asset('images/carousel-images/slide1.jpeg') }}" class="absolute inset-0 w-full h-full object-cover z-0" alt="Slide 1">

                <div class="absolute inset-0 z-10 bg-gradient-to-b from-black via-transparent to-black"></div>

                <div class="absolute bottom-10 left-10 z-20 text-white">
                    <h2 class="text-4xl font-bold">ПАР РАСПАР</h2>
                    <div class="flex gap-4 mt-2 items-center text-lg">
                        <span class="text-yellow-400 font-semibold">ПРЕМИЕРА</span>
                        <span>01.03.2025</span>
                    </div>
                    <p class="text-sm mt-1">РЕПЕРТОАР 2025</p>
                </div>
                <a href='https://online.teatarkomedija.mk/'
                    class="absolute bottom-10 right-10 z-20 bg-red-800 hover:bg-red-600 text-white px-6 py-2 rounded">
                    КУПИ КАРТА
                </a>
            </div>

        </div>
        <div class="swiper-button-next"></div>
        <div class="swiper-button-prev"></div>
        <div class="swiper-pagination custom-pagination"></div>
    </div>
</section>
