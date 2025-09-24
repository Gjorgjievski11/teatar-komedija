@props(['src', 'title'])
<div id="hero-container" class="-mt-24 relative h-[60vh]">
    <img src="{{ $src }}" alt="" class="w-full h-full absolute object-cover z-0">

    <!-- Top to transparent -->
    <div class="absolute top-0 left-0 w-full h-[30vh] bg-gradient-to-b from-black to-transparent z-10"></div>

    <!-- Bottom to transparent -->
    <div class="absolute bottom-0 left-0 w-full h-[30vh] bg-gradient-to-t from-black to-transparent z-10"></div>

    <p class="z-20 text-white text-5xl font-semibold absolute bottom-10 left-15">{{ $title }}</p>
</div>
