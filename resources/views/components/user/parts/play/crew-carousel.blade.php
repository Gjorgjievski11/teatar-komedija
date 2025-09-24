<section id="play-crew-carousel" class="relative z-10 py-10 bg-white text-black  mx-12">
    <div class="swiper play-crew-carousel w-full h-full">
        <div class="swiper-wrapper h-full -my-4 -mx-2">

            @foreach ($contributors as $employee)
                <div class="swiper-slide h-full py-4 px-2">
                    <div
                        class="flex flex-col items-center justify-center text-center bg-white rounded-3xl h-full px-6 py-10 shadow-lg shadow-black/40">
                        <div class="text-5xl text-red-800 mb-4">
                            <img src="{{ asset('./images/play-icons/Frame.png') }}" alt="">
                        </div>
                        <p class="text-sm text-gray-600">{{ $employee->employee->jobPosition->name }}</p>
                        <h3 class=" font-bold text-black mt-1">{{ $employee->employee->name }}</h3>
                    </div>
                </div>
            @endforeach

        </div>
    </div>
</section>
