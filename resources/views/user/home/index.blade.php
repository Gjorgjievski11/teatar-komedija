<x-user.layouts.base>
    <livewire:user.carousel />
    <div class="text-white text-center pt-  6 bg-black/90">
        <p id="calendar-title" class='text-[40px]/[48px] font-[600]'>КАЛЕНДАР {{ date('Y') }}</p>
    </div>    
    <x-user.parts.calendar />    
    <x-user.parts.page.sponsors />
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            function updateCalendarTitle(year) {
                const titleElement = document.getElementById('calendar-title');
                if (titleElement) {
                    titleElement.textContent = `КАЛЕНДАР ${year}`;
                }
            }            
            window.addEventListener('year-changed', (e) => {
                updateCalendarTitle(e.detail.year);
            });
            window.updateCalendarTitle = updateCalendarTitle;
        });
    </script>
</x-user.layouts.base>