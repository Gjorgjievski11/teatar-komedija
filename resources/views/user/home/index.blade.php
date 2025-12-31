<x-user.layouts.base>
    <livewire:user.carousel />
    <x-user.parts.calendar.years/> 
    <x-user.parts.calendar />    
    <x-user.parts.page.sponsors />

    @if($announcements && $announcements->count())
        <x-user.parts.page.announcement :announcements="$announcements" />
    @endif
</x-user.layouts.base>
