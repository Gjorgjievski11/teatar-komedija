<x-admin.layouts.app title="Измени известување">

    <x-admin.parts.page.heading-back>Измени известување</x-admin.parts.page.heading-back>

    <form action="{{ route('admin.announcements.update', $announcement) }}" method="post" class="space-y-6">
        @csrf
        @method('PATCH')

        <div class="grid grid-cols-2 gap-5 items-start">

            <div class="grid grid-cols-2 gap-5 sticky top-0">

                <!-- Title -->
                <x-admin.parts.form.input 
                    :value="old('title', $announcement->title)" 
                    name="title" 
                    label="Наслов" 
                    placeholder="Наслов на известување" 
                    required 
                    class="dark:bg-gray-800 dark:text-gray-200 dark:border-gray-700"/>

                <!-- Body -->
                <div class="col-span-full">
                    <x-admin.parts.form.textarea 
                        :value="old('body', $announcement->body)" 
                        name="body" 
                        label="Опис" 
                        placeholder="Подетален опис..." 
                        required
                        class="w-full dark:bg-gray-800 dark:text-gray-200 dark:border-gray-700"/>
                </div>

                <!-- Start datetime -->
                <x-admin.parts.form.input 
                    :value="old('starts_at', $announcement->starts_at?->format('Y-m-d\TH:i'))" 
                    type="datetime-local" 
                    name="starts_at" 
                    label="Почеток" 
                    class="dark:bg-gray-800 dark:text-gray-200 dark:border-gray-700"/>

                <!-- End datetime -->
                <x-admin.parts.form.input 
                    :value="old('ends_at', $announcement->ends_at?->format('Y-m-d\TH:i'))" 
                    type="datetime-local" 
                    name="ends_at" 
                    label="Крај" 
                    required
                    class="dark:bg-gray-800 dark:text-gray-200 dark:border-gray-700"/>

                <!-- Active select -->
                <x-admin.parts.form.select 
                    name="is_active" 
                    label="Активно" 
                    required 
                    class="dark:bg-gray-800 dark:text-gray-200 dark:border-gray-700">
                    <option value="1" {{ old('is_active', $announcement->is_active) ? 'selected' : '' }}>Да</option>
                    <option value="0" {{ !old('is_active', $announcement->is_active) ? 'selected' : '' }}>Не</option>
                </x-admin.parts.form.select>

            </div>
        </div>

        <x-admin.parts.form.button class="mt-6">Зачувај промени</x-admin.parts.form.button>
    </form>

</x-admin.layouts.app>
