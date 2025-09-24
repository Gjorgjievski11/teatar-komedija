<div class="relative">
    <div class="flex justify-between items-end">
        <x-admin.parts.form.search name='search' />
        <div>
            {{ $addon ?? '' }}
        </div>
    </div>
    <div class="overflow-x-auto rounded-lg shadow-md mt-4">
        <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
            <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                <tr>
                    {{ $thead }}
                </tr>
            </thead>
            <tbody>
                {{ $tbody }}
            </tbody>
        </table>
    </div>
</div>
