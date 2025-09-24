<div>
    {{-- Tab Buttons --}}
    <div id="selector" class="text-center flex flex-wrap justify-center text-xl w-full max-w-6xl mx-auto border-b my-12 gap-4">
        <button
            x-on:click="$wire.category = 'director'; $wire.setCategory('director')"
            class="py-2 px-4"
            :class="$wire.category === 'director' ? 'border-b-2 border-[#DDB109] font-bold text-black' : 'text-gray-600'"
        >Директор</button>
        <button
            x-on:click="$wire.category = 'art_sector'; $wire.setCategory('art_sector')"
            class="py-2 px-4"
            :class="$wire.category === 'art_sector' ? 'border-b-2 border-[#DDB109] font-bold text-black' : 'text-gray-600'"
        >Уметнички сектор</button>
        <button
            x-on:click="$wire.category = 'administration'; $wire.setCategory('administration')"
            class="py-2 px-4"
            :class="$wire.category === 'administration' ? 'border-b-2 border-[#DDB109] font-bold text-black' : 'text-gray-600'"
        >Администрација</button>
        <button
            x-on:click="$wire.category = 'technical_sector'; $wire.setCategory('technical_sector')"
            class="py-2 px-4"
            :class="$wire.category === 'technical_sector' ? 'border-b-2 border-[#DDB109] font-bold text-black' : 'text-gray-600'"
        >Технички сектор</button>
    </div>

    {{-- Tab Content --}}
    <div class="px-4 py-10 max-w-7xl mx-auto">
        @if ($category === 'director')
            <div class="flex flex-col items-center space-y-7">
                @forelse ($getData as $employee)
                    <div class="flex flex-col space-y-5 items-center w-full">
                        <img src="{{ $employee->images->first()->path ?? asset('/images/no_image.png') }}"
                             alt="{{ $employee->name }}"
                             class="w-[350px] h-[350px] object-cover mx-auto rounded-md">
                        <p class="text-center text-xl font-semibold uppercase">
                            {{ $employee->name }} {{ $employee->surname }}
                        </p>
                        <p class="text-center max-w-3xl">{{ $employee->description }}</p>
                    </div>
                @empty
                    <p class="text-center text-red-700 font-bold text-3xl min-h-[50vh]">НЕМА ПОДАТОЦИ</p>
                @endforelse
            </div>
        @elseif ($category === 'art_sector')
            <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-5 gap-y-8 gap-x-4">
                @forelse ($getData as $employee)
                    <div class="flex flex-col items-center mt-4 ">
                        <a href="" class="group">
                            <img src="{{ $employee->images->first()->path ?? asset('images/nav-icons/Profile_Icon.svg') }}"
                                 class="w-32 h-44 rounded-md object-cover mb-2 transition-transform duration-300 group-hover:scale-105 group-hover:shadow-xl"
                                 alt="{{ $employee->name }}">
                            <p class="text-center">{{ $employee->name }}</p>
                            <p class="text-center">{{ $employee->surname }}</p>
                        </a>
                    </div>
                @empty
                    <p class="text-center text-red-700 font-bold text-3xl col-span-full">НЕМА ПОДАТОЦИ</p>
                @endforelse
            </div>
        @else
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-5 gap-8">
                @forelse ($getData as $employee)
                    <div class="flex flex-col items-center bg-gray-50 rounded-2xl shadow-md hover:shadow-xl transition-shadow duration-300 border border-gray-200 p-6">
                        <img src="{{ $employee->images->first()->path ?? asset('/images/nav-icons/Profile_Icon.svg') }}"
                             class="w-20 h-20 rounded-full object-cover mb-3 border-2 border-gray-200 bg-white"
                             alt="{{ $employee->name }}">
                        <p class="text-center font-semibold text-base text-gray-900">{{ $employee->name }}</p>
                        <p class="text-center font-semibold text-base text-gray-900">{{ $employee->surname }}</p>
                        <p class="text-xs text-center font-semibold mt-2" style="color: #DDB109;">{{ $employee->jobPosition->name ?? '' }}</p>
                    </div>
                @empty
                    <p class="text-center text-red-700 font-bold text-3xl col-span-full min-h-[50vh]">НЕМА ПОДАТОЦИ</p>
                @endforelse
            </div>
        @endif
    </div>
</div>
