<section>
    <div class="flex items-center gap-5">
        <x-admin.parts.form.search name="search" />
        <x-admin.parts.form.select name="category" wire:model.lazy="category">
            <option value="">Сите</option>
            <option value="1">Проекти</option>
            <option value="2">Гостувања</option>
            <option value="3">Промоции</option>
            <option value="4">Издавачка дејност</option>
        </x-admin.parts.form.select>
    </div>

    <div class="grid grid-cols-2 gap-5 mt-6">
        @forelse ($activities as $activity)
            <x-admin.parts.activity.card :$activity />
        @empty
            <div class="col-span-full text-center">
                <x-admin.parts.form.error>Нема активности</x-admin.parts.form.error>
            </div>
        @endforelse
    </div>
</section>
