<x-admin.layouts.app title="Измени го екипажот">
    <x-admin.parts.page.heading-back>Измени го екипажот</x-admin.parts.page.heading-back>

    <form action="{{ route('admin.crew.update', $play) }}" method="POST">
        @csrf
        @method('PATCH')
        <div class="grid grid-cols-3 gap-5">
            @forelse ($crew as $playEmployee)
                <div
                    class="p-4 border-2 border-gray-400 dark:border-gray-700 border-dashed bg-gray-100 dark:bg-gray-800 rounded-xl">
                    <div class="flex items-center justify-between">
                        <div>
                            <h3 class="font-semibold">{{ $playEmployee->employee->getFullName() }}</h3>
                            <x-admin.parts.page.badge>{{ $playEmployee->employee->jobPosition->name }}</x-admin.parts.page.badge>
                        </div>
                        <x-admin.parts.form.select label='Работел како' name='contribution-{{ $playEmployee->id }}'>
                            @foreach ($contributions as $contribution)
                                <option value="{{ $contribution->id }}" @selected(old('contribution-' . $playEmployee->id, $playEmployee->contribution_id) == $contribution->id)>
                                    {{ $contribution->name }}
                                </option>
                            @endforeach
                        </x-admin.parts.form.select>
                    </div>
                    <x-admin.parts.form.input name="role-{{ $playEmployee->id }}" label='Име во претставата'
                        value="{{ old('role-' . $playEmployee->id, $playEmployee->role_name) }}"
                        placeholder="{{ fake()->name() }}" />
                </div>
            @empty
                <x-admin.parts.form.error class="col-span-full text-center">Оваа претстава нема екипаж клики <a
                        href="{{ route('admin.crew.create', $play) }}" class="text-blue-400 hover:underline"
                        wire:navigate>тука</a> за
                    да доадеш</x-admin.parts.form.error>
            @endforelse
        </div>
        <div class="mt-6">
            {{ $crew->links() }}
        </div>
        <div class="mt-6">
            <x-admin.parts.form.button>Зачувај</x-admin.parts.form.button>
        </div>
    </form>
</x-admin.layouts.app>
