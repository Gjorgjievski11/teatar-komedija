<section class="p-8 mx-auto w-[70%]">
    <div class="flex gap-2.5 border border-red-600 items-center px-4 rounded-md">
        <svg class="text-red-700 size-6" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24"
            fill="none" viewBox="0 0 24 24">
            <path stroke="currentColor" stroke-linecap="round" stroke-width="2"
                d="m21 21-3.5-3.5M17 10a7 7 0 1 1-14 0 7 7 0 0 1 14 0Z" />
        </svg>


        <input type="text" placeholder="Пребарувај..." wire:model.live.debounce.300ms='search'
            class="border-none focus:ring-0 focus:outline-0 focus:border-0 w-full">
    </div>

    <div class="space-y-14 mt-14">
        @forelse ($plays as $play)
            <x-user.parts.play.card :$play />
        @empty
            <svg class="size-30 mx-auto" viewBox="0 0 16.00 16.00" xmlns="http://www.w3.org/2000/svg" fill="#B91C1C"
                transform="matrix(-1, 0, 0, 1, 0, 0)" stroke="#B91C1C" stroke-width="0.00016">
                <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round" stroke="#CCCCCC"
                    stroke-width="0.288"></g>
                <g id="SVGRepo_iconCarrier">
                    <path fill-rule="evenodd" clip-rule="evenodd"
                        d="M5.738 3.318a4.5 4.5 0 0 0-.877 5.123A4.48 4.48 0 0 0 6.1 10a4.62 4.62 0 0 0-.1 1v.17c-.16-.11-.32-.22-.47-.34L1.75 14.5 1 13.84l3.8-3.69a5.5 5.5 0 1 1 9.62-3.65c0 .268-.02.535-.06.8a5.232 5.232 0 0 0-.94-.68V6.5a4.5 4.5 0 0 0-7.682-3.182zm3.04 4.356a4 4 0 1 1 4.444 6.652 4 4 0 0 1-4.444-6.652zm.1 5.447A3 3 0 0 0 11 14a3 3 0 0 0 1.74-.55L8.55 9.26A3 3 0 0 0 8 11a3 3 0 0 0 .879 2.121zm.382-4.57l4.19 4.189A3 3 0 0 0 14 11a3 3 0 0 0-3-3 3 3 0 0 0-1.74.55z">
                    </path>
                </g>
            </svg>
            <p class="text-center">Не се пронајдени резултати за <span class="font-bold">"{{ $search }}"</span>
            </p>
        @endforelse
    </div>

    <div class="mt-6">
        {{ $plays->links() }}
    </div>
</section>
