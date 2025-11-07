@props(['play'])

@php
use Illuminate\Support\Carbon;

$now = Carbon::now();
$nextMonth = $now->copy()->addMonth();

// Filter all future dates using classic closure
$futureDates = $play->dates->filter(function($date) {
    return Carbon::parse($date->played_at)->isFuture();
});

// Get the earliest date (premiere)
$premiereDate = $play->dates->sortBy('played_at')->first();
$premiereDateCarbon = $premiereDate ? Carbon::parse($premiereDate->played_at) : null;

// Check if premiere is upcoming in current or next month
$isPremiereUpcomingThisOrNextMonth = $premiereDateCarbon
    ? $premiereDateCarbon->isFuture() &&
      ($premiereDateCarbon->month === Carbon::now()->month || $premiereDateCarbon->month === $nextMonth->month)
    : false;

// All future dates in next month
$nextMonthDates = $futureDates->filter(function($date) use ($nextMonth) {
    $playedAt = Carbon::parse($date->played_at);
    return $playedAt->month === $nextMonth->month && $playedAt->year === $nextMonth->year;
});
@endphp

<div class="flex flex-col sm:flex-row gap-6 sm:gap-16" wire:key='{{ $play->id }}'>
    <div class="w-full sm:w-[45%] h-64 sm:h-72 overflow-hidden rounded-xl flex-shrink-0 flex items-center justify-center">
        <img src="{{ $play->poster }}" class="w-full h-auto object-cover" />
    </div>

    <div class="flex-1 flex flex-col justify-around gap-4">
        <div>
            <h1 class="text-xl sm:text-2xl font-bold mb-2">{{ $play->title }}</h1>

            <div class="mb-4 flex flex-wrap items-center gap-x-4 text-sm text-gray-800">
                @if($isPremiereUpcomingThisOrNextMonth)
                    <p class="text-red-800 font-bold">ПРЕМИЕРА</p>
                    <span>|</span>
                    <p>{{ $premiereDate->getDate('Y.m.d') }}</p>
                    <span>|</span>
                    <p>{{ $premiereDate->getTime() }}</p>
                @elseif($nextMonthDates->isNotEmpty())
                    @foreach($nextMonthDates as $date)
                        <p>{{ $date->getDate('Y.m.d') }} | {{ $date->getTime() }}</p>
                    @endforeach
                @elseif($futureDates->isNotEmpty())
                    {{-- Show the next upcoming date if no dates in next month --}}
                    @php $nextDate = $futureDates->sortBy('played_at')->first(); @endphp
                    <p>{{ $nextDate->getDate('Y.m.d') }} | {{ $nextDate->getTime() }}</p>
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
