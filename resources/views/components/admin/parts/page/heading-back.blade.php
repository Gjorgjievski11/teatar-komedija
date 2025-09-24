@props(['href' => null])
<div {{ $attributes(['class' => 'flex gap-2.5 items-center mb-12']) }}>
    <a href="{{ $href ?? url()->previous() }}" wire:navigate>
        <svg class="size-8" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none"
            viewBox="0 0 24 24">
            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                d="M5 12h14M5 12l4-4m-4 4 4 4" />
        </svg>
    </a>
    <x-admin.parts.page.heading>{{ $slot }}</x-admin.parts.page.heading>
</div>
