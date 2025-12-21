<section id="carousel" class="h-[80vh] -mt-24 relative z-10'">
    <div class="swiper mySwiper w-full h-full mx-auto">
        <div class="swiper-wrapper z-20 bg-black">
            @forelse ($plays as $play)
            <div class="swiper-slide relative w-full h-full">
                <img src="{{ $play->poster }}" class="absolute inset-0 w-full h-full object-cover z-0" alt="{{ $play->title }}">

                <div class="absolute inset-0 z-10 bg-gradient-to-b from-black via-transparent to-black"></div>

                @php
                    $premiereDate = $play->dates->first(); // uses eager-loaded, already filtered dates
                    $isPremiere = $premiereDate ? \Carbon\Carbon::parse($premiereDate->played_at)->isFuture() : false;
                @endphp
                @endphp
                <div class="absolute bottom-10 left-10 z-20 text-white">
                    <h2 class="text-4xl font-bold">{{ $play->title }}</h2>
                    <div class="flex gap-4 mt-2 items-center text-lg">
                        @if($isPremiere)
                            <span class="text-yellow-400 font-semibold">ПРЕМИЕРА</span>
                        @endif
                        <span>{{ $premiereDate->getDate('d.m.Y') }}</span>
                    </div>
                    <p class="text-sm mt-1">РЕПЕРТОАР 2025</p>
                </div>
                <a href='{{ $play->ticket_url }}'
                    class="absolute bottom-10 right-10 z-20 bg-red-800 hover:bg-red-600 text-white px-6 py-2 rounded">
                    КУПИ КАРТА
                </a>
            </div>

            @empty
                <div class='swiper-slide relative w-full h-full text-4xl text-red-600 text-center content-center'>Нема Претстави</div>
            @endforelse
        </div>
        <div class="swiper-button-next"></div>
        <div class="swiper-button-prev"></div>
        <div class="swiper-pagination custom-pagination"></div>
    </div>
</section>
