@props(['employee'])
<x-admin.parts.card.holder>

    <div wire:key="employee-{{ $employee->id }}" x-data="{
        images: @js($employee->images),
        currentSlideIndex: 1,
        previous() {
            if (this.currentSlideIndex > 1) {
                this.currentSlideIndex = this.currentSlideIndex - 1
            } else {
                // If it's the first image, go to the last image
                this.currentSlideIndex = this.images.length
            }
        },
        next() {
            if (this.currentSlideIndex < this.images.length) {
                this.currentSlideIndex = this.currentSlideIndex + 1
            } else {
                // If it's the last image, go to the first image
                this.currentSlideIndex = 1
            }
        },
    }" class="relative w-full overflow-hidden">

        <template x-if="images.length > 1">
            <!-- previous button -->
            <button type="button"
                class="absolute left-5 top-1/2 z-20 flex rounded-full -translate-y-1/2 items-center justify-center bg-surface/40 p-2 text-on-surface transition hover:bg-surface/60 focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-primary active:outline-offset-0 dark:bg-surface-dark/40 dark:text-on-surface-dark dark:hover:bg-surface-dark/60 dark:focus-visible:outline-primary-dark"
                aria-label="previous image" x-on:click="previous()">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" stroke="currentColor" fill="none"
                    stroke-width="3" class="size-5 md:size-6 pr-0.5" aria-hidden="true">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 19.5 8.25 12l7.5-7.5" />
                </svg>
            </button>
        </template>

        <template x-if="images.length > 1">
            <!-- next button -->
            <button type="button"
                class="absolute right-5 top-1/2 z-20 flex rounded-full -translate-y-1/2 items-center justify-center bg-surface/40 p-2 text-on-surface transition hover:bg-surface/60 focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-primary active:outline-offset-0 dark:bg-surface-dark/40 dark:text-on-surface-dark dark:hover:bg-surface-dark/60 dark:focus-visible:outline-primary-dark"
                aria-label="next image" x-on:click="next()">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" stroke="currentColor" fill="none"
                    stroke-width="3" class="size-5 md:size-6 pl-0.5" aria-hidden="true">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M8.25 4.5l7.5 7.5-7.5 7.5" />
                </svg>
            </button>
        </template>
        <!-- images -->
        <!-- Change min-h-[50svh] to your preferred height size -->
        <div class="relative min-h-[30svh] w-full">
            <template x-for="(image, index) in images">
                <div x-show="currentSlideIndex == index + 1" class="absolute inset-0"
                    x-transition.opacity.duration.1000ms>
                    <img class="absolute w-full h-full inset-0 object-cover text-on-surface dark:text-on-surface-dark"
                        x-bind:src="image.path" x-bind:alt="'Image-' + image.id" />
                </div>
            </template>
        </div>

        <!-- indicators -->
        <div class="absolute rounded-radius bottom-3 md:bottom-5 left-1/2 z-20 flex -translate-x-1/2 gap-4 md:gap-3 bg-surface/75 px-1.5 py-1 md:px-2 dark:bg-surface-dark/75"
            role="group" aria-label="images">
            <template x-for="(image, index) in images">
                <button class="size-2 rounded-full transition bg-on-surface dark:bg-on-surface-dark"
                    x-on:click="currentSlideIndex = index + 1"
                    x-bind:class="[currentSlideIndex === index + 1 ? 'bg-on-surface dark:bg-on-surface-dark' :
                        'bg-on-surface/50 dark:bg-on-surface-dark/50'
                    ]"
                    x-bind:aria-label="'image ' + (index + 1)"></button>
            </template>
        </div>
    </div>
    <div class="p-5">
        <div class="flex justify-between items-center flex-wrap gap-x-1">
            <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white">
                {{ $employee->getFullName() }}
            </h5>
            <x-admin.parts.page.badge color='blue'>{{ $employee->jobPosition->name }}</x-admin.parts.page.badge>
        </div>
        <p class="mb-3 font-normal text-gray-700 dark:text-gray-400">{{ $employee->description }}</p>
        <x-admin.parts.form.button type='link' href="{{ route('admin.employee.edit', $employee) }}">
            Измени
        </x-admin.parts.form.button>
    </div>
</x-admin.parts.card.holder>
