@props(['activity'])

<div wire:key='activity-{{ $activity->id }}' x-data="{ selectedTab: 'overview' }"
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
            class="inline-block p-4 rounded-ss-lg" role="tab" aria-controls="activity-{{ $activity->id }}-overview">
            Преглед
        </button>

        <!-- Images Tab -->
        <button x-on:click="selectedTab = 'images'" x-bind:aria-selected="selectedTab === 'images'"
            x-bind:tabindex="selectedTab === 'images' ? '0' : '-1'"
            x-bind:class="selectedTab === 'images' ? 'text-blue-600 dark:text-blue-500 bg-gray-100 dark:bg-gray-700' :
                'hover:text-gray-600 hover:bg-gray-100 dark:hover:bg-gray-700 dark:hover:text-gray-300'"
            class="inline-block p-4" role="tab" aria-controls="activity-{{ $activity->id }}-images">
            Слики
        </button>

        <!-- Description Tab -->
        <button x-on:click="selectedTab = 'description'" x-bind:aria-selected="selectedTab === 'description'"
            x-bind:tabindex="selectedTab === 'description' ? '0' : '-1'"
            x-bind:class="selectedTab === 'description' ? 'text-blue-600 dark:text-blue-500 bg-gray-100 dark:bg-gray-700' :
                'hover:text-gray-600 hover:bg-gray-100 dark:hover:bg-gray-700 dark:hover:text-gray-300'"
            class="inline-block p-4" role="tab" aria-controls="activity-{{ $activity->id }}-description">
            Описи
        </button>

        <!-- Dropdown Menu (unchanged) -->
        <div class="ms-auto me-2 z-30">
            <button id="dropdownButton-{{ $activity->id }}" data-dropdown-toggle="dropdown-{{ $activity->id }}"
                class="inline-block text-gray-500 dark:text-gray-400 hover:bg-gray-100 dark:hover:bg-gray-700 focus:ring-4 focus:outline-none focus:ring-gray-200 dark:focus:ring-gray-700 rounded-lg text-sm p-1.5"
                type="button">
                <span class="sr-only">Open dropdown</span>
                <svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor"
                    viewBox="0 0 16 3">
                    <path
                        d="M2 0a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3Zm6.041 0a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM14 0a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3Z" />
                </svg>
            </button>

            <div id="dropdown-{{ $activity->id }}"
                class="z-10 hidden text-base list-none bg-white divide-y divide-gray-100 rounded-lg shadow-sm w-44 dark:bg-gray-700">
                <ul class="py-2" aria-labelledby="dropdownButton-{{ $activity->id }}">
                    <li>
                        <a href="{{ route('admin.activity.edit', $activity) }}" wire:navigate
                            class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 dark:hover:bg-gray-600 dark:text-gray-200 dark:hover:text-white">
                            Измени
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('admin.activity.image.create', $activity) }}" wire:navigate
                            class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 dark:hover:bg-gray-600 dark:text-gray-200 dark:hover:text-white">
                            Додади слики
                        </a>
                    </li>
                    <li>
                        <form action="{{ route('admin.activity.destroy', $activity) }}" method="POST">
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
        <div x-show="selectedTab === 'overview'" id="activity-{{ $activity->id }}-overview" role="tabpanel"
            aria-labelledby="activity-{{ $activity->id }}-overview-tab" x-cloak>
            <div class="absolute z-10 inset-0 bg-white/50 dark:bg-black/80"></div>
            <img src="{{ $activity->image }}" alt="{{ $activity->title }}"
                class="absolute inset-0 w-full h-full object-cover object-center select-none">
            <div class="z-20 absolute left-1/2 -translate-x-1/2 bottom-4 w-[95%] py-2 px-4 rounded-xl backdrop-blur-xs">
                <h2 class="text-3xl font-extrabold tracking-tight text-gray-900 dark:text-white">
                    {{ $activity->title }}
                </h2>
                <div class="flex justify-between text-sm text-gray-600 dark:text-gray-500 mt-2">
                    <span class="px-2.5 py-1 rounded-md bg-gray-200/50 dark:bg-gray-800/50">
                        {{ $activity->getCategoryName() }}</span>
                    <span class="flex items-center gap-1 px-2.5 py-1 rounded-md bg-gray-200/50 dark:bg-gray-800/50">
                        <!-- Duration Icon -->
                        <svg class="size-4" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 8v4l3 3m6-3a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                        </svg>
                        {{ $activity->date->format('d/m/Y H:i') }}
                    </span>
                </div>
                <p class="mt-2 text-gray-500 dark:text-gray-200 line-clamp-2">
                    {{ $activity->short_description }}
                </p>
            </div>
        </div>

        <!-- Images Tab Panel -->
        <div x-show="selectedTab === 'images'" id="activity-{{ $activity->id }}-images" role="tabpanel"
            aria-labelledby="activity-{{ $activity->id }}-images-tab" x-cloak>
            <div class="grid grid-cols-2 md:grid-cols-3 gap-4">
                @forelse ($activity->images as $image)
                    <div class="rounded overflow-hidden shadow-md relative">
                        <img src="{{ $image->url }}" alt="Image for {{ $activity->title }}"
                            class="w-full h-48 object-cover">
                        <form action="{{ route('admin.activity.image.destroy', $image) }}" method="POST">
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


        <!-- Description Tab Panel -->
        <div x-show="selectedTab === 'description'" id="activity-{{ $activity->id }}-description" role="tabpanel"
            aria-labelledby="activity-{{ $activity->id }}-description-tab" x-cloak>
            <span class="text-sm font-semibold">Краток опис:</span>
            <p>{{ $activity->short_description }}</p>
            <hr class="my-4 border border-gray-200 dark:border-gray-700">
            <span class="text-sm font-semibold">Опис:</span>
            <p>{{ $activity->description }}</p>
        </div>
    </div>
</div>
