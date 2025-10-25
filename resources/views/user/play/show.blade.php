<x-user.layouts.base>
    <livewire:user.carousel />
    <x-user.parts.play.info :$play/>
    <x-user.parts.play.crew-carousel :$contributors />

    <div class="relative flex flex-col lg:flex-row md:gap-8 md:p-8 bg-white mx-15">
        <div class="whitespace-pre-line lg:w-2/3 w-full text-justify text-sm text-gray-800 leading-relaxed">
            <p>
                {{ $play->description }}
            </p>
        </div>
        <div class="lg:w-1/3 w-full space-y-4 lg:sticky  lg:top-8 h-fit">
            @foreach ($play->dates as $dates)
                <div class="flex md:flex-row flex-col md:items-center md:justify-between px-4 py-3 rounded-2xl shadow-2xl space-y-2 md:space-y-0 bg-white ">
                    <span class="hidden md:block text-sm font-bold text-gray-800">{{ $dates->played_at }}</span>
                    <span class="md:hidden text-sm font-bold text-gray-800">{{ $dates->getDate() }}</span>
                    <span class="md:hidden text-sm font-bold text-gray-800">{{ $dates->getTime() }}</span>

                    <a href='{{ $play->ticket_url }}'
                        class="bg-red-600 text-white text-sm px-4 py-2 rounded-md hover:bg-red-700">
                        КУПИ КАРТА
                    </a>
                </div>
            @endforeach
        </div>
    </div>
    <x-user.parts.play.actor-carousel :$actors />
    <x-user.parts.play.images-slider :$play/>

</x-user.layouts.base>
