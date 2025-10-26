<section id="play-crew-carousel" class="relative z-10 py-10 bg-white text-black  mx-12">
    <div class="swiper play-crew-carousel w-full h-full">
        <div class="swiper-wrapper h-full -my-4 -mx-2">

            @foreach ($contributors as $contributor)
                @php
                    // primary: many-to-many relation (new pivot)
                    $contribs = $contributor->contributions ?? collect();

                    // fallback: legacy single contribution_id column (keep existing data)
                    if ($contribs->isEmpty() && isset($contributor->contribution_id)) {
                        $found = \App\Models\Contribution::find($contributor->contribution_id);
                        $contribs = $found ? collect([$found]) : collect();
                    }
                @endphp

                @foreach ($contribs as $contribution)
                    @php
                        $personName = optional($contributor->employee)->getFullName()
                            ?: optional($contributor->employee)->name
                            ?: '';
                    @endphp

                    <div class="swiper-slide h-full py-4 px-2">
                        <div
                            class="flex flex-col items-center justify-center text-center bg-white rounded-3xl h-full px-6 py-10 shadow-lg shadow-black/40">
                            <div class="text-5xl text-red-800 mb-4">
                                <img src="{{ asset('./images/play-icons/Frame.png') }}" alt="">
                            </div>

                            {{-- show contribution only (one contribution per slide) + person's name --}}
                            <h3 class="font-bold text-black mt-1">{{ $contribution->name }}</h3>
                            @if($personName)
                                <p class="text-sm text-gray-600 mt-1">{{ $personName }}</p>
                            @endif
                        </div>
                    </div>
                @endforeach
            @endforeach

        </div>
    </div>
</section>
