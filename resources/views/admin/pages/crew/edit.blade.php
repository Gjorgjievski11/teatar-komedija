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
                    </div>

                    <div class="mt-3">
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Работел како</label>

                        <div id="contrib-list-{{ $playEmployee->id }}" class="space-y-2">
                            @php
                                $selectedIds = old(
                                    'contribution-' . $playEmployee->id,
                                    optional($playEmployee->contributions)->pluck('id')->toArray() ?: (isset($playEmployee->contribution_id) ? [$playEmployee->contribution_id] : [])
                                );
                            @endphp

                            @foreach ($selectedIds as $sid)
                                <div class="contrib-item flex items-center gap-2">
                                    <select name="contribution-{{ $playEmployee->id }}[]" class="mt-1 block w-full rounded-md border-gray-300 dark:border-gray-700 bg-white dark:bg-gray-800">
                                        <option value="">-- изберете --</option>
                                        @foreach ($contributions as $contribution)
                                            <option value="{{ $contribution->id }}" @selected((int)$contribution->id === (int)$sid)>{{ $contribution->name }}</option>
                                        @endforeach
                                    </select>

                                    <button type="button" class="remove-contribution inline-flex items-center px-3 py-1 border border-red-600 text-red-600 rounded hover:bg-red-50">Отстрани</button>
                                </div>
                            @endforeach
                        </div>

                        <template id="contrib-template-{{ $playEmployee->id }}">
                            <div class="contrib-item flex items-center gap-2">
                                <select name="contribution-{{ $playEmployee->id }}[]" class="mt-1 block w-full rounded-md border-gray-300 dark:border-gray-700 bg-white dark:bg-gray-800">
                                    <option value="">-- изберете --</option>
                                    @foreach ($contributions as $contribution)
                                        <option value="{{ $contribution->id }}">{{ $contribution->name }}</option>
                                    @endforeach
                                </select>

                                <button type="button" class="remove-contribution inline-flex items-center px-3 py-1 border border-red-600 text-red-600 rounded hover:bg-red-50">Отстрани</button>
                            </div>
                        </template>

                        <div class="mt-2">
                            <button type="button" onclick="addContribution({{ $playEmployee->id }})" class="inline-flex items-center px-3 py-1 bg-green-600 text-white rounded hover:bg-green-500">Додади улога</button>
                        </div>
                    </div>

                    <div class="mt-4">
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">Име во претставата</label>
                        <input
                            type="text"
                            name="role-{{ $playEmployee->id }}"
                            value="{{ old('role-' . $playEmployee->id, $playEmployee->role_name) }}"
                            placeholder="{{ fake()->name() }}"
                            class="mt-1 block w-full rounded-md border-gray-300 dark:border-gray-700 bg-white dark:bg-gray-800 px-3 py-2"
                        />
                    </div>
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
    <script>
        function addContribution(playEmployeeId) {
            const tpl = document.getElementById(`contrib-template-${playEmployeeId}`);
            if (!tpl) return;
            const clone = tpl.content.cloneNode(true);
            document.getElementById(`contrib-list-${playEmployeeId}`).appendChild(clone);
        }

        document.addEventListener('click', function (e) {
            if (e.target && e.target.classList.contains('remove-contribution')) {
                const item = e.target.closest('.contrib-item');
                if (item) item.remove();
            }
        });
    </script>
</x-admin.layouts.app>
