@props(['active'])
<li>
    <a wire:navigate {{ $attributes }} @class([
        'flex items-center p-2 text-base font-medium text-gray-900 rounded-lg dark:text-white hover:bg-gray-200 dark:hover:bg-gray-700 group',
        'bg-gray-300 dark:bg-gray-900' => $active,
    ])>
        <div @class([
            'size-6 text-gray-500 dark:text-gray-400 group-hover:text-gray-900 dark:group-hover:text-white',
            'text-gray-800 dark:text-white' => $active,
        ])>
            {{ $icon }}
        </div>
        <span class="ml-3">{{ $slot }}</span>
    </a>
</li>
