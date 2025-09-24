<div>
<div id="selector" class="text-center flex flex-col md:flex-row text-xl w-3/4 mx-auto border-b my-12 max-sm:text-3xl">
    <button x-on:click="$wire.category = 'projects'; $wire.setCategory('projects')" class="pb-2 w-full md:w-1/3"
        x-bind:class="$wire.category === 'projects' && 'border-b-4 border-orange-500 font-bold'">Проекти</button>
    <button x-on:click="$wire.category = 'guests'; $wire.setCategory('guests')" class="pb-2 w-full md:w-1/3"
        x-bind:class="$wire.category === 'guests' && 'border-b-4 border-orange-500 font-bold'">Гостувања</button>
    <button x-on:click="$wire.category = 'promotions'; $wire.setCategory('promotions')" class="pb-2 w-full md:w-1/3"
        x-bind:class="$wire.category === 'promotions' && 'border-b-4 border-orange-500 font-bold'">Промоции</button>
    <button x-on:click="$wire.category = 'publishers'; $wire.setCategory('publishers')" class="pb-2 w-full md:w-1/3"
        x-bind:class="$wire.category === 'publishers' && 'border-b-4 border-orange-500 font-bold'">Издавачка
        дејност</button>
</div>



    <div id="activities" class="my-12 flex flex-col gap-12">
        @forelse ($activities as $activity)
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
                        <a href="{{ route('user.activity', ['id' => $activity->id,'category'=>$activity->getCategoryName()]) }}"
                            class="border border-[#B40101] px-4 py-2 rounded hover:opacity-50 w-1/2 flex justify-center items-center text-[#B40101]">
                            ПОВЕЌЕ
                        </a>
                    </div>
                </div>
            </div>
        @empty
            <p class="text-center text-red-700 font-bold text-3xl">НЕМА АКТИВНОСТИ</p>
        @endforelse
    </div>
</div>
