<x-admin.layouts.app :title="'Дати за ' . $play->title">

    <x-admin.parts.page.heading-back>Дати за {{ $play->title }}</x-admin.parts.page.heading-back>
    <form action="{{ route('admin.date.store', $play) }}" method="POST">
        @csrf
        @error('dates')
            <x-admin.parts.form.error class="mb-2">{{ $message }}</x-admin.parts.form.error>
        @enderror
        @error('times')
            <x-admin.parts.form.error class="mb-2">{{ $message }}</x-admin.parts.form.error>
        @enderror
        <div class="flex flex-wrap items-center gap-5" x-data="{
            count: 1,
            addDatepicker() {
                this.count++;
                this.$nextTick(() => {
                    initFlowbite();
                });
            },
        }">
            <template x-for="(element, index) in count" :key="index">
                <div x-key="index"
                    class="flex gap-2.5 items-center border border-dashed p-2 rounded-md border-gray-400 dark:border-gray-700">
                    <x-admin.parts.form.datepicker name="dates[]" required />
                    <x-admin.parts.form.timepicker name="times[]" required />
                </div>
            </template>

            <x-admin.parts.form.button type='button' class="cursor-pointer" x-on:click="addDatepicker()">
                <svg class="size-6" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                    fill="currentColor" viewBox="0 0 24 24">
                    <path fill-rule="evenodd"
                        d="M18 5.05h1a2 2 0 0 1 2 2v2H3v-2a2 2 0 0 1 2-2h1v-1a1 1 0 1 1 2 0v1h3v-1a1 1 0 1 1 2 0v1h3v-1a1 1 0 1 1 2 0v1Zm-15 6v8a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-8H3ZM11 18a1 1 0 1 0 2 0v-1h1a1 1 0 1 0 0-2h-1v-1a1 1 0 1 0-2 0v1h-1a1 1 0 1 0 0 2h1v1Z"
                        clip-rule="evenodd" />
                </svg>
            </x-admin.parts.form.button>
            <x-admin.parts.form.button>Зачувај</x-admin.parts.form.button>
        </div>
    </form>

</x-admin.layouts.app>
