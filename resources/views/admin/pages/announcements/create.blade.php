<x-admin.layouts.app title="Додади известување">

    <x-admin.parts.page.heading-back>Додади известување</x-admin.parts.page.heading-back>

    @if ($errors->any())
        <div class="mb-4 p-4 bg-red-100 dark:bg-red-800 text-red-700 dark:text-red-200 rounded-lg">
            <ul class="list-disc list-inside space-y-1">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('admin.announcements.store') }}" method="POST" class="space-y-6">
        @csrf

        <div class="grid grid-cols-2 gap-5">

            <!-- Title -->
            <div class="col-span-2">
                <label for="title" class="block mb-1 font-medium text-gray-200 dark:text-gray-300">Наслов</label>
                <input type="text" name="title" id="title" required
                    value="{{ old('title') }}"
                    placeholder="Наслов на известување"
                    class="w-full px-4 py-2 rounded-lg bg-gray-800 text-gray-200 border border-gray-700 focus:outline-none focus:ring-2 focus:ring-blue-500"/>
            </div>

            <!-- Body -->
            <div class="col-span-2">
                <label for="body" class="block mb-1 font-medium text-gray-200 dark:text-gray-300">Опис</label>
                <textarea name="body" id="body" rows="6"
                    placeholder="Подетален опис..."
                    class="w-full px-4 py-2 rounded-lg bg-gray-800 text-gray-200 border border-gray-700 focus:outline-none focus:ring-2 focus:ring-blue-500">{{ old('body') }}</textarea>
            </div>

            <!-- Starts At -->
            <div>
                <label for="starts_at" class="block mb-1 font-medium text-gray-200 dark:text-gray-300">Почеток</label>
                <input type="datetime-local" name="starts_at" id="starts_at" 
                    value="{{ old('starts_at') }}"
                    class="w-full px-4 py-2 rounded-lg bg-gray-800 text-gray-200 border border-gray-700 focus:outline-none focus:ring-2 focus:ring-blue-500"/>
            </div>

            <!-- Ends At -->
            <div>
                <label for="ends_at" class="block mb-1 font-medium text-gray-200 dark:text-gray-300">Крај</label>
                <input type="datetime-local" name="ends_at" id="ends_at" required
                    value="{{ old('ends_at') }}"
                    class="w-full px-4 py-2 rounded-lg bg-gray-800 text-gray-200 border border-gray-700 focus:outline-none focus:ring-2 focus:ring-blue-500"/>
            </div>

            <!-- Active -->
            <div class="col-span-2">
                <label for="is_active" class="block mb-1 font-medium text-gray-200 dark:text-gray-300">Активно</label>
                <select name="is_active" id="is_active" required
                    class="w-full px-4 py-2 rounded-lg bg-gray-800 text-gray-200 border border-gray-700 focus:outline-none focus:ring-2 focus:ring-blue-500">
                    <option value="1" {{ old('is_active') == 1 ? 'selected' : '' }}>Да</option>
                    <option value="0" {{ old('is_active') == 0 ? 'selected' : '' }}>Не</option>
                </select>
            </div>
        </div>

        <!-- Submit Button -->
        <div>
            <button type="submit"
                class="inline-flex gap-2.5 items-center font-medium rounded-lg text-sm px-5 py-2.5 text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                Зачувај известување
            </button>
        </div>
    </form>

</x-admin.layouts.app>
