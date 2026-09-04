<section>

<div class="flex flex-wrap items-center justify-between gap-3 mb-6">
    <x-admin.parts.form.search name="search" class="flex-1" />

    <button wire:click="toggleSort"
        class="inline-flex items-center gap-2 px-4 py-2 rounded-radius bg-surface text-on-surface 
               dark:bg-surface-dark dark:text-on-surface-dark
               border border-outline/50 dark:border-outline-dark/50
               transition hover:bg-surface/70 dark:hover:bg-surface-dark/70 
               focus-visible:outline-primary focus-visible:outline-2 focus-visible:outline-offset-2">

        @if ($sort === 'asc')
            <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 opacity-80" fill="none" viewBox="0 0 24 24"
                stroke="currentColor" stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round"
                    d="M8 7V17M8 7L4 11M8 7L12 11M16 17V7M16 17L20 13M16 17L12 13" />
            </svg>
            <span>Подреди: А–Ж</span>
        @else
            <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 opacity-80" fill="none" viewBox="0 0 24 24"
                stroke="currentColor" stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round"
                    d="M8 17V7M8 17L4 13M8 17L12 13M16 7V17M16 7L20 11M16 7L12 11" />
            </svg>
            <span>Подреди: Ж–А</span>
        @endif
    </button>
</div>
    <div class="grid grid-cols-3 mt-4 gap-5">
        @forelse ($employees as $employee)
            <x-admin.parts.employee.card :$employee />
        @empty
            <div class="col-span-full">
                <x-admin.parts.form.error class="text-center">Нема Вработени</x-admin.parts.form.error>
            </div>
        @endforelse
    </div>

    <div class="mt-6">
        {{ $employees->links() }}
    </div>

</section>
