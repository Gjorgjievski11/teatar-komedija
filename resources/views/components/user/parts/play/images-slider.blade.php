<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/glightbox/dist/css/glightbox.min.css">
<script src="https://cdn.jsdelivr.net/npm/glightbox/dist/js/glightbox.min.js"></script>

<section id="actors-carousel" class="relative z-10 py-10 bg-[#282828] text-black">
    <div class="swiper actors-carousel w-full h-full px-2">
        <div class="swiper-wrapper h-full my-2 m-1">

            @foreach ($play->images as $image)
                <div class="swiper-slide flex justify-center items-center">
                    <a href="{{ $image->path }}"
                       class="glightbox"
                       data-gallery="actors">

                        <img
                            src="{{ $image->path }}"
                            alt=""
                            class="rounded-2xl object-cover w-[394px] h-60 mx-6 cursor-pointer"
                        />
                    </a>
                </div>
            @endforeach

        </div>
    </div>
</section>

<script>
    document.addEventListener('DOMContentLoaded', () => {
        GLightbox({
            selector: '.glightbox',
            touchNavigation: true,
            loop: true
        });
    });
</script>
