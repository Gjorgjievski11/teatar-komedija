<div class="px-4">
    <div id="selector" class="flex flex-col sm:flex-row text-center text-base sm:text-xl w-full sm:w-3/4 mx-auto border-b my-8 sm:my-12">
        <button
            x-on:click="$wire.category = 'premieres'; $wire.setCategory('premieres')"
            class="pb-2 w-full sm:w-1/3 max-sm:text-3xl"
            x-bind:class="$wire.category === 'premieres' && 'border-b-4 border-orange-500 font-bold'"
        >
            Премиери
        </button>
        <button
            x-on:click="$wire.category = 'plays'; $wire.setCategory('plays')"
            class="pb-2 w-full sm:w-1/3 max-sm:text-3xl"
            x-bind:class="$wire.category === 'plays' && 'border-b-4 border-orange-500 font-bold'"
        >
            Претстави
        </button>
        <button
            x-on:click="$wire.category = 'naked-moon'; $wire.setCategory('naked-moon')"
            class="pb-2 w-full sm:w-1/3 max-sm:text-3xl"
            x-bind:class="$wire.category === 'naked-moon' && 'border-b-4 border-orange-500 font-bold'"
        >
            Гола Месечина
        </button>
    </div>
    <div id="premiere" class="my-8 sm:my-12 flex flex-col gap-8 sm:gap-12 w-full sm:w-[70%] mx-auto">
        @forelse ($plays as $play)
            <x-user.parts.play.card :play="$play" :category="$category" />
        @empty
            <p class="text-center text-red-700 font-bold text-xl sm:text-3xl">НЕМА ПРЕТСТАВИ</p>
        @endforelse
    </div>
</div>
