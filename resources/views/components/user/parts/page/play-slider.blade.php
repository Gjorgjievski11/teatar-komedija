@props(['plays'])
<section id="freemode-carousel" class="relative z-10 py-10 bg-white text-black h-[480px] mt-12 mx-12 mb-32">
    <p class="text-center text-4xl md:text-[40px] md:leading-[48px] font-semibold mb-8 md:mb-12 px-4">
        НЕДЕЛЕН РЕПЕРТОАР
    </p>

    <div class="swiper freemode w-full h-full">
        <div class="swiper-wrapper">
            @forelse($plays as $play)
                <div class="swiper-slide py-4 px-2">
                    <div class="group relative w-full h-full rounded-3xl shadow-lg overflow-hidden">
                        <div class="relative w-full h-full flex text-xl font-semibold bg-white">
                            <img src="{{ $play->poster }}"
                                class="w-full h-full object-cover absolute inset-0 transition-opacity duration-300 group-hover:opacity-0" />
                            <div
                                class="absolute inset-0 opacity-0 group-hover:opacity-100 transition-opacity duration-300 flex flex-col p-4 bg-white">
                                <div class="flex flex-col gap-y-4">
                                    <h1 class="text-black text-2xl break-words">{{ $play->title }}</h1>
                                    @php($firstDate = $play->dates->first())
                                    @if($firstDate)
                                        <h2 class="text-red-500 text-xl">{{ $firstDate->getDate() }} | {{ $firstDate->getTime() }}</h2>
                                    @endif
                                </div>

                                <div class="flex-1 overflow-y-auto overflow-x-hidden my-2 break-words">
                                    <p class="text-sm font-light break-words">
                                        {{ $play->short_description }}
                                    </p>
                                </div>

                                <div class="flex justify-center gap-x-5 text-xs pt-2">
                                    <a href="{{ $play->ticket_url }}"
                                        class="text-white bg-red-800 py-2 px-2 rounded hover:bg-red-700 transition-colors duration-200">КУПИ
                                        КАРТА</a>
                                    <a href="{{ route('user.play', ['id' => $play->id]) }}"
                                        class="text-red-800 bg-white border-2 border-red-800 py-2 px-2 rounded hover:bg-red-50 transition-colors duration-200">ПОВЕЌЕ</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @empty
                <p class="mx-auto text-center text-red-700 font-bold text-xl sm:text-3xl">НЕМА ПРЕТСТАВИ</p>
            @endforelse
        </div>
    </div>
</section>