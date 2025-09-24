@props(['play'])

<div wire:key="play-{{ $play->id }}" x-data="{ selectedTab: 'overview' }"
    class="w-full bg-white border border-gray-200 rounded-lg overflow-hidden shadow-sm dark:bg-gray-800 dark:border-gray-700">
    <!-- Tab List -->
    <div x-on:keydown.right.prevent="$focus.wrap().next()" x-on:keydown.left.prevent="$focus.wrap().previous()"
        class="flex items-center flex-wrap text-sm font-medium text-center text-gray-500 border-b border-gray-200 rounded-t-lg bg-gray-50 dark:border-gray-700 dark:text-gray-400 dark:bg-gray-800"
        role="tablist">

        <!-- Overview Tab -->
        <button x-on:click="selectedTab = 'overview'" x-bind:aria-selected="selectedTab === 'overview'"
            x-bind:tabindex="selectedTab === 'overview' ? '0' : '-1'"
            x-bind:class="selectedTab === 'overview' ? 'text-blue-600 dark:text-blue-500 bg-gray-100 dark:bg-gray-700' :
                'hover:text-gray-600 hover:bg-gray-100 dark:hover:bg-gray-700 dark:hover:text-gray-300'"
            class="inline-block p-4 rounded-ss-lg" role="tab" aria-controls="play-{{ $play->id }}-overview">
            Преглед
        </button>

        <!-- Crew Tab -->
        <button x-on:click="selectedTab = 'crew'" x-bind:aria-selected="selectedTab === 'crew'"
            x-bind:tabindex="selectedTab === 'crew' ? '0' : '-1'"
            x-bind:class="selectedTab === 'crew' ? 'text-blue-600 dark:text-blue-500 bg-gray-100 dark:bg-gray-700' :
                'hover:text-gray-600 hover:bg-gray-100 dark:hover:bg-gray-700 dark:hover:text-gray-300'"
            class="inline-block p-4" role="tab" aria-controls="play-{{ $play->id }}-crew">
            Екипаж
        </button>

        <!-- Dates Tab -->
        <button x-on:click="selectedTab = 'dates'" x-bind:aria-selected="selectedTab === 'dates'"
            x-bind:tabindex="selectedTab === 'dates' ? '0' : '-1'"
            x-bind:class="selectedTab === 'dates' ? 'text-blue-600 dark:text-blue-500 bg-gray-100 dark:bg-gray-700' :
                'hover:text-gray-600 hover:bg-gray-100 dark:hover:bg-gray-700 dark:hover:text-gray-300'"
            class="inline-block p-4" role="tab" aria-controls="play-{{ $play->id }}-dates">
            Дати
        </button>

        <!-- Images Tab -->
        <button x-on:click="selectedTab = 'images'" x-bind:aria-selected="selectedTab === 'images'"
            x-bind:tabindex="selectedTab === 'images' ? '0' : '-1'"
            x-bind:class="selectedTab === 'images' ? 'text-blue-600 dark:text-blue-500 bg-gray-100 dark:bg-gray-700' :
                'hover:text-gray-600 hover:bg-gray-100 dark:hover:bg-gray-700 dark:hover:text-gray-300'"
            class="inline-block p-4" role="tab" aria-controls="play-{{ $play->id }}-images">
            Слики
        </button>

        <!-- Dropdown Menu (unchanged) -->
        <div class="ms-auto me-2 z-30">
            <button id="dropdownButton-{{ $play->id }}" data-dropdown-toggle="dropdown-{{ $play->id }}"
                class="inline-block text-gray-500 dark:text-gray-400 hover:bg-gray-100 dark:hover:bg-gray-700 focus:ring-4 focus:outline-none focus:ring-gray-200 dark:focus:ring-gray-700 rounded-lg text-sm p-1.5"
                type="button">
                <span class="sr-only">Open dropdown</span>
                <svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor"
                    viewBox="0 0 16 3">
                    <path
                        d="M2 0a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3Zm6.041 0a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM14 0a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3Z" />
                </svg>
            </button>

            <div id="dropdown-{{ $play->id }}"
                class="z-10 hidden text-base list-none bg-white divide-y divide-gray-100 rounded-lg shadow-sm w-44 dark:bg-gray-700">
                <ul class="py-2" aria-labelledby="dropdownButton-{{ $play->id }}">
                    <li>
                        <a href="{{ route('admin.play.edit', $play) }}" wire:navigate
                            class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 dark:hover:bg-gray-600 dark:text-gray-200 dark:hover:text-white">
                            Измени
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('admin.crew.create', $play) }}" wire:navigate
                            class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 dark:hover:bg-gray-600 dark:text-gray-200 dark:hover:text-white">
                            Додади екипаж
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('admin.crew.edit', $play) }}" wire:navigate
                            class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 dark:hover:bg-gray-600 dark:text-gray-200 dark:hover:text-white">
                            Имени го екипажот
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('admin.date.create', $play) }}" wire:navigate
                            class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 dark:hover:bg-gray-600 dark:text-gray-200 dark:hover:text-white">
                            Додади дати
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('admin.image.create', $play) }}" wire:navigate
                            class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 dark:hover:bg-gray-600 dark:text-gray-200 dark:hover:text-white">
                            Додади слики
                        </a>
                    </li>
                    <li>
                        <form action="{{ route('admin.play.destroy', $play) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button
                                class="w-full cursor-pointer px-4 py-2 text-sm text-red-700 hover:bg-gray-100 dark:hover:bg-gray-600 dark:text-red-500 font-bold dark:hover:text-white">
                                Избриши
                            </button>
                        </form>
                    </li>
                </ul>
            </div>
        </div>
    </div>

    <!-- Tab Panels -->
    <div class="h-[50vh] relative overflow-auto p-4 bg-white dark:bg-gray-800">
        <!-- Overview Tab Panel -->
        <div x-show="selectedTab === 'overview'" id="play-{{ $play->id }}-overview" role="tabpanel"
            aria-labelledby="play-{{ $play->id }}-overview-tab" x-cloak>
            <div class="absolute z-10 inset-0 bg-white/50 dark:bg-black/80"></div>
            <img src="{{ $play->poster }}" alt="{{ $play->title }}"
                class="absolute inset-0 w-full h-full object-cover object-center select-none">
            <div class="z-20 absolute left-1/2 -translate-x-1/2 bottom-4 w-[95%] py-2 px-4 rounded-xl backdrop-blur-xs">
                <h2 class="text-3xl font-extrabold tracking-tight text-gray-900 dark:text-white">
                    {{ $play->title }}
                </h2>
                <div
                    class="inline-flex flex-wrap text-sm text-gray-600 mt-1 dark:text-gray-500 divide-x divide-gray-300 dark:divide-gray-500 py-1 rounded-md bg-gray-200/50 dark:bg-gray-800/50">
                    @foreach ($play->categories->take(4) as $category)
                        <span class="px-2.5">{{ $category->name }}</span>
                    @endforeach
                </div>
                <p class="mt-2 text-gray-500 dark:text-gray-200 line-clamp-2">
                    {{ $play->short_description }}
                </p>
                <div class="flex items-center justify-between mt-3">
                    <a href="{{ $play->ticket_url }}" target="_blank"
                        class="flex items-center font-medium text-blue-600 hover:text-blue-800 dark:text-blue-500 dark:hover:text-blue-700">
                        Карта
                        <svg class="w-2.5 h-2.5 ms-2 rtl:rotate-180" xmlns="http://www.w3.org/2000/svg" fill="none"
                            viewBox="0 0 6 10">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="m1 9 4-4-4-4" />
                        </svg>
                    </a>
                    <div class="text-gray-700 text-sm flex gap-4.5">
                        <span class="flex items-center gap-1">
                            <!-- Duration Icon -->
                            <svg class="size-4" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 8v4l3 3m6-3a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                            </svg>
                            {{ $play->getDuration() }}
                        </span>
                        <span class="flex items-center gap-1">
                            <!-- Price Icon -->
                            <svg class="size-4.5" xmlns="http://www.w3.org/2000/svg" fill="none"
                                viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M16.5 6v.75m0 3v.75m0 3v.75m0 3V18m-9-5.25h5.25M7.5 15h3M3.375 5.25c-.621 0-1.125.504-1.125 1.125v3.026a3 3 0 0 1 0 5.198v3.026c0 .621.504 1.125 1.125 1.125h17.25c.621 0 1.125-.504 1.125-1.125v-3.026a3 3 0 0 1 0-5.198V6.375c0-.621-.504-1.125-1.125-1.125H3.375Z" />
                            </svg>
                            {{ $play->getPrice() }}
                        </span>
                    </div>
                </div>
            </div>
        </div>

        <!-- Crew Tab Panel -->
        <div x-show="selectedTab === 'crew'" id="play-{{ $play->id }}-crew" role="tabpanel"
            aria-labelledby="play-{{ $play->id }}-crew-tab" x-cloak>
            <div class="grid grid-cols-2 gap-2.5">
                @forelse ($play->crew as $playEmployee)
                    <div class="dark:bg-gray-700 rounded-lg px-2.5 py-4 flex justify-between items-center gap-3">
                        <div>
                            <h3>{{ $playEmployee->employee->getFullName() }}</h3>
                            <x-admin.parts.page.badge>{{ $playEmployee->employee->jobPosition->name }}</x-admin.parts.page.badge>
                            @if ($playEmployee->role_name)
                                <p class="text-sm">Игра како: <span
                                        class="font-medium">{{ $playEmployee->role_name }}</span></p>
                            @endif
                        </div>
                        <form action="{{ route('admin.crew.destroy', $playEmployee) }}" method="POST"
                            class="flex items-center">
                            @csrf
                            @method('DELETE')

                            <button class="text-red-600 hover:text-red-400 cursor-pointer">
                                <svg class="size-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                    width="24" height="24" fill="none" viewBox="0 0 24 24">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                        stroke-width="2"
                                        d="M5 7h14m-9 3v8m4-8v8M10 3h4a1 1 0 0 1 1 1v3H9V4a1 1 0 0 1 1-1ZM6 7h12v13a1 1 0 0 1-1 1H7a1 1 0 0 1-1-1V7Z" />
                                </svg>
                            </button>
                        </form>
                    </div>
                @empty
                    <x-admin.parts.form.error class="text-center col-span-full">Нема
                        екипаж</x-admin.parts.form.error>
                @endforelse
            </div>
        </div>

        <!-- Dates Tab Panel -->
        <div x-show="selectedTab === 'dates'" id="play-{{ $play->id }}-dates" role="tabpanel"
            aria-labelledby="play-{{ $play->id }}-dates-tab" x-cloak>
            <div class="grid grid-cols-2 gap-2.5">
                @php
                    $premiere = $play->getPremiere();
                @endphp
                @if ($premiere)
                    <div
                        class="font-semibold bg-gray-100 dark:bg-gray-700 rounded-lg px-2.5 py-4 flex justify-center items-center gap-3 col-span-full">
                        <svg class="size-5 text-yellow-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                            width="24" height="24" fill="currentColor" viewBox="0 0 24 24">
                            <path
                                d="M13.849 4.22c-.684-1.626-3.014-1.626-3.698 0L8.397 8.387l-4.552.361c-1.775.14-2.495 2.331-1.142 3.477l3.468 2.937-1.06 4.392c-.413 1.713 1.472 3.067 2.992 2.149L12 19.35l3.897 2.354c1.52.918 3.405-.436 2.992-2.15l-1.06-4.39 3.468-2.938c1.353-1.146.633-3.336-1.142-3.477l-4.552-.36-1.754-4.17Z" />
                        </svg>
                        <span>Премиера: {{ $premiere }}</span>
                    </div>
                @endif
                @forelse ($play->dates as $date)
                    <div
                        class="bg-gray-100 dark:bg-gray-700 rounded-lg px-2.5 py-4 flex justify-between items-center gap-3">
                        <span>{{ $date->getFullDate() }}</span>
                        <div class="flex gap-2.5 items-center">
                            <a href="{{ route('admin.date.edit', $date) }}" wire:navigate
                                class="text-blue-500 hover:text-blue-700 dark:text-blue-400 dark:hover:text-blue-500">
                                <svg class="size-4" fill="currentColor" viewBox="0 0 24 24">
                                    <path fill-rule="evenodd"
                                        d="M14 4.182A4.136 4.136 0 0 1 16.9 3c1.087 0 2.13.425 2.899 1.182A4.01 4.01 0 0 1 21 7.037c0 1.068-.43 2.092-1.194 2.849L18.5 11.214l-5.8-5.71 1.287-1.31Zm-2.717 2.763L6.186 12.13l2.175 2.141 5.063-5.218-2.141-2.108Zm-6.25 6.886-1.98 5.849a.992.992 0 0 0 .245 1.026 1.03 1.03 0 0 0 1.043.242L10.282 19l-5.25-5.168Zm6.954 4.01 5.096-5.186-2.218-2.183-5.063 5.218 2.185 2.15Z"
                                        clip-rule="evenodd" />
                                </svg>
                            </a>
                            <form action="{{ route('admin.date.destroy', $date) }}" method="POST"
                                class="flex items-center justify-center">
                                @csrf
                                @method('DELETE')
                                <button class="text-red-600 hover:text-red-400 cursor-pointer">
                                    <svg class="size-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                        width="24" height="24" fill="none" viewBox="0 0 24 24">
                                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                            stroke-width="2"
                                            d="M5 7h14m-9 3v8m4-8v8M10 3h4a1 1 0 0 1 1 1v3H9V4a1 1 0 0 1 1-1ZM6 7h12v13a1 1 0 0 1-1 1H7a1 1 0 0 1-1-1V7Z" />
                                    </svg>
                                </button>
                            </form>
                        </div>
                    </div>
                @empty
                    <x-admin.parts.form.error class="text-center col-span-full">Нема
                        дати</x-admin.parts.form.error>
                @endforelse
            </div>
        </div>

        <!-- Images Tab Panel -->
        <div x-show="selectedTab === 'images'" id="play-{{ $play->id }}-images" role="tabpanel"
            aria-labelledby="play-{{ $play->id }}-images-tab" x-cloak>
            <div class="grid grid-cols-2 md:grid-cols-3 gap-4">
                @forelse ($play->images as $image)
                    <div class="rounded overflow-hidden shadow-md relative">
                        <img src="{{ $image->path }}" alt="Image for {{ $play->title }}"
                            class="w-full h-48 object-cover">
                        <form action="{{ route('admin.image.destroy', $image) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button
                                class="text-red-600/80 absolute top-3 left-3 bg-white/50 p-1 rounded hover:text-white hover:bg-red-600 transition-all duration-300 cursor-pointer">
                                <svg class="w-6 h-6" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                    width="24" height="24" fill="currentColor" viewBox="0 0 24 24">
                                    <path fill-rule="evenodd"
                                        d="M8.586 2.586A2 2 0 0 1 10 2h4a2 2 0 0 1 2 2v2h3a1 1 0 1 1 0 2v12a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V8a1 1 0 0 1 0-2h3V4a2 2 0 0 1 .586-1.414ZM10 6h4V4h-4v2Zm1 4a1 1 0 1 0-2 0v8a1 1 0 1 0 2 0v-8Zm4 0a1 1 0 1 0-2 0v8a1 1 0 1 0 2 0v-8Z"
                                        clip-rule="evenodd" />
                                </svg>
                            </button>
                        </form>
                    </div>
                @empty
                    <x-admin.parts.form.error class="col-span-full text-center">Нема
                        слики</x-admin.parts.form.error>
                @endforelse
            </div>
        </div>
    </div>
</div>
