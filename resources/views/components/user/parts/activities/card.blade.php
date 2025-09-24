<div class="mx-auto w-[70%] flex gap-16" wire:key='{{ $activity->id }}'>
    <div class="w-[45%] h-72 overflow-hidden rounded-xl flex flex-shrink-0 items-center">
        <img src="{{ $activity->image }}" class="w-full h-auto" />
    </div>


    <div class="flex-1 flex flex-col justify-around gap-2">
        <div>
            <h1 class="text-2xl font-bold mb-2 text-gray-800">{{ $activity->title }}</h1>

            <div class="mb-4 flex flex-wrap items-center gap-x-4 text-xl text-gray-800 font-black">
                <p>{{ $activity->date->format('d.m.Y') }}</p>
                <span>|</span>
                <p>{{ $activity->date->format('H:i') }}</p>
            </div>
            @if ($activity->short_description)
                <p class="text-sm line-clamp-3">
                    {{ $activity->short_description }}
                </p>
            @endif
        </div>

        <div class="flex gap-4">
            <a href="{{ route('user.activity', ['id' => $activity->id, 'category' => $activity->getCategoryName()]) }}"
                class="border border-[#B40101] px-4 py-2 rounded hover:opacity-50 w-1/2 flex justify-center items-center text-[#B40101]">
                ПОВЕЌЕ
            </a>
        </div>
    </div>
</div>
