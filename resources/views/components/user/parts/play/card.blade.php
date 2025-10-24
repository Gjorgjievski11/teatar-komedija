@props(['play'])

<div class="flex flex-col sm:flex-row gap-6 sm:gap-16" wire:key='{{ $play->id }}'>
    <div
        class="w-full sm:w-[45%] h-64 sm:h-72 overflow-hidden rounded-xl flex-shrink-0 flex items-center justify-center">
        <img src="{{ $play->poster }}" class="w-full h-auto object-cover" />
    </div>

    <div class="flex-1 flex flex-col justify-around gap-4">
        <div>
            <h1 class="text-xl sm:text-2xl font-bold mb-2">{{ $play->title }}</h1>
            @php
                $premiereDate = $play->dates->sortBy('played_at')->first();
                $isPremiereUpcoming = $premiereDate
                    ? \Illuminate\Support\Carbon::parse($premiereDate->played_at)->isFuture()
                    : false;
            @endphp

            <div class="mb-4 flex flex-wrap items-center gap-x-4 text-sm text-gray-800">
                @if ($premiereDate)
                    @if ($isPremiereUpcoming)
                        <p class="text-red-800 font-bold">ПРЕМИЕРА</p>
                        <span>|</span>
                    @endif

                    <p>{{ $premiereDate->getDate('Y.m.d') }}</p>
                    <span>|</span>
                    <p>{{ $premiereDate->getTime() }}</p>
                @else
                    <p class="text-gray-500 italic">НЕМА ОДРЕДЕНА ДАТА</p>
                @endif
            </div>

            @if ($play->short_description)
                <p class="text-sm sm:text-base">
                    {{ $play->short_description }}
                </p>
            @endif
        </div>

        <div class="flex flex-col sm:flex-row gap-4">
            <a href='{{ $play->ticket_url }}'
                class="bg-red-800 text-white px-4 py-2 rounded hover:bg-red-700 w-full sm:w-1/2 flex justify-center items-center text-center">
                КУПИ КАРТА
            </a>
            <a href="{{ route('user.play', ['id' => $play->id]) }}"
                class="border border-gray-500 px-4 py-2 rounded hover:opacity-50 w-full sm:w-1/2 flex justify-center items-center text-center">
                ПОВЕЌЕ
            </a>
        </div>
    </div>
</div>
