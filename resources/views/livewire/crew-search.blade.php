<div x-data>
    <div>
        <div class="flex gap-5 items-center">
            <x-admin.parts.form.search name='search' />
            <x-admin.parts.form.select name='postions' wire:model.change='searchFor'>
                <option value="">Сите</option>
                @foreach ($positions as $position)
                    <option value="{{ $position->id }}">{{ $position->name }}</option>
                @endforeach
            </x-admin.parts.form.select>
        </div>
        <div class="grid grid-cols-7 gap-x-2.5 gap-y-8 mt-6">
            @forelse ($employees as $employee)
                <div class="space-y-1">
                    <x-admin.parts.form.checkbox name="crew" wire:model='crew' :value="$employee->id" :id="$employee->id"
                        :label="$employee->getFullName()" />
                    <x-admin.parts.page.badge>{{ $employee->jobPosition->name }}</x-admin.parts.page.badge>
                </div>
            @empty
            @endforelse
        </div>
        <div class="mt-6">
            {{ $employees->links() }}
        </div>
    </div>
    <div class="mt-6">
        <x-admin.parts.form.button>Следен чекор</x-admin.parts.form.button>
    </div>
    <template x-for="id in $wire.crew" :key="id">
        <input type="hidden" name="crew[]" :value="id">
    </template>
</div>
