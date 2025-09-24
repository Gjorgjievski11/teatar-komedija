<x-admin.layouts.app title='Активности'>
    <x-admin.parts.page.heading-button :href="route('admin.activity.create')">
        <x-slot:heading>Активности</x-slot:heading>
        <x-slot:button>
            <svg aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none"
                viewBox="0 0 24 24">
                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M5 12h14m-7 7V5" />
            </svg>
            Додади активност</x-slot:button>
    </x-admin.parts.page.heading-button>

    <livewire:activities-display />
</x-admin.layouts.app>
