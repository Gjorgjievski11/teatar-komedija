<x-admin.layouts.base :$title>
    <x-admin.parts.page.topbar />

    <x-admin.parts.page.sidebar />

    <main class="p-4 md:ml-64 h-auto pt-20">
        <x-admin.parts.page.alert />
        {{ $slot }}
    </main>

    <script src="https://cdn.jsdelivr.net/npm/flowbite@3.1.2/dist/flowbite.min.js"></script>
    <script>
        let hasNavigated = false;

        document.addEventListener('livewire:navigated', () => {
            if (hasNavigated) {
                initFlowbite();
            } else {
                hasNavigated = true;
            }
        });
    </script>


</x-admin.layouts.base>
