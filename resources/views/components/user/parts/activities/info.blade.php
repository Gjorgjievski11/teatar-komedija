<div id="play-data" class="w-full bg-black/90 py-6 flex flex-col md:flex-row items-start px-8 md:px-0 md:items-center justify-center gap-x-12 text-white">
    <div class="flex items-center justify-center text-white text-lg gap-x-4">
        <img src="{{ asset('./images/play-icons/Location_icon.png') }}" class='scale-75 md:scale-100' alt="">
        <p>Бистро Комедија</p>
    </div>
    <p class='hidden md:block'>|</p>
    <div class="flex items-center justify-center text-white text-lg gap-x-4">
        <img src="{{ asset('./images/play-icons/Clock_icon.png') }}" class='scale-75 md:scale-100' alt="">
        <p>{{ $activity->getTime() }}</p>
    </div>
    <p class='hidden md:block'>|</p>
    <div class="flex items-center justify-center text-white text-lg gap-x-4">
        <img src="{{ asset('./images/play-icons/Calendar_icon.png') }}" class='scale-75 md:scale-100' alt="">
        <p>{{ $activity->getDate() }}</p>
    </div>
</div>
