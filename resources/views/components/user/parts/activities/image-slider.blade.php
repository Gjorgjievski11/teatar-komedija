<section id="actors-carousel" class="relative z-10 py-10 bg-[#282828] text-black">
    <div class="swiper actors-carousel w-full h-full px-2">
        <div class="swiper-wrapper h-full my-2 m-1">
            @foreach ($activity->images as $image)
            <div class="swiper-slide flex justify-center items-center">
                    <img class="rounded-2xl object-cover w-[394px] h-60 mx-6"
                        src="{{ $image->url }}" alt="">
                </div>
            @endforeach
        </div>
    </div>
</section>
