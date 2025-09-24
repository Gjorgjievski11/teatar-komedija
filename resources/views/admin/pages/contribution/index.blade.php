<x-admin.layouts.app title="Контрибуции">

    <x-admin.parts.page.heading-button :href="route('admin.contribution.create')">
        <x-slot:heading>Контрибуции</x-slot:heading>
        <x-slot:button>
            <svg aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none"
                viewBox="0 0 24 24">
                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M5 12h14m-7 7V5" />
            </svg>
            Додади контрибуција
        </x-slot:button>
    </x-admin.parts.page.heading-button>

    <section>
        <livewire:contributions-table />
    </section>
</x-admin.layouts.app>
