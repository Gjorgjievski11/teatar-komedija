<div id="play-data" class="w-screen bg-black/90 py-6 md:flex grid grid-cols-2 space-y-4 md:space-y-0 md:scale-100 md:items-center md:justify-center md:content-center md:gap-x-12 text-white">

    <div class="flex items-center justify-center text-white text-sm md:text-lg gap-x-4">
        <img src="{{ asset('./images/play-icons/Location_icon.png') }}" alt="">
        <p>Театар Комедија</p>
    </div>
    <p class='hidden md:block'>|</p>
    <div class="flex items-center justify-center text-white text-sm md:text-lg gap-x-4">
        <img src="{{ asset('./images/play-icons/Clock_icon.png') }}" alt="">
        <p>{{ $play->getDuration() }}</p>
    </div>
    <p class='hidden md:block'>|</p>
    <div class="flex items-center justify-center text-white text-sm md:text-lg gap-x-4">
        <img src="{{ asset('./images/play-icons/Calendar_icon.png') }}" alt="">
        <p>{{ $play->getFormattedDateRange() }}</p>
    </div>
    <p class='hidden md:block'>|</p>
    <div class="flex items-center justify-center text-white text-sm md:text-lg gap-x-4">
        <img src="{{ asset('./images/play-icons/mynaui_ticket-solid.png') }}" alt="">
        <p>{{ $play->getPrice() }}</p>
    </div>
</div>
