@props(['contributors'])

<section id="play-crew-carousel" class="relative z-10 py-10 bg-white text-black mx-12">
    <div class="swiper play-crew-carousel w-full overflow-visible !important"> {{-- Force overflow visible --}}
        <div class="swiper-wrapper items-stretch pb-8 -mb-8"> {{-- Add bottom padding and negative margin --}}
            @foreach ($contributors as $contributor)
                @php
                    $contribs = $contributor->contributions ?? collect();

                    if ($contribs->isEmpty() && isset($contributor->contribution_id)) {
                        $found = \App\Models\Contribution::find($contributor->contribution_id);
                        $contribs = $found ? collect([$found]) : collect();
                    }
                    
                    $personName = optional($contributor->employee)->getFullName()
                        ?: optional($contributor->employee)->name
                        ?: '';
                @endphp

                <div class="swiper-slide pb-8"> {{-- Add padding to each slide --}}
                    <div class="h-64 flex">
                        <div class="bg-white rounded-3xl shadow-lg p-6 text-center border border-gray-200 w-full flex flex-col justify-center">
                            {{-- Icon --}}
                            <div class="text-red-800 mb-4">
                                <img src="{{ asset('./images/play-icons/Frame.png') }}" alt="" class="w-12 h-12 mx-auto">
                            </div>

                            {{-- Person Name --}}
                            @if($personName)
                                <h3 class="font-bold text-lg text-gray-900 mb-3 line-clamp-2">
                                    {{ $personName }}
                                </h3>
                            @endif

                            {{-- Contributions --}}
                            <div class="space-y-2">
                                @foreach ($contribs as $contribution)
                                    <p class="text-gray-600 text-base font-medium">
                                        {{ $contribution->name }}
                                    </p>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</section>