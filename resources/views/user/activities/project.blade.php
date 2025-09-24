<x-user.layouts.base>
    {{-- <x-user.layouts.carousel class="h-[80vh]" /> --}}

    <x-user.parts.activities.activity-hero :$activity />
    <x-user.parts.activities.info :$activity />
    <x-user.parts.activities.project.info :$activity />
    <x-user.parts.activities.image-slider :$activity />
</x-user.layouts.base>
