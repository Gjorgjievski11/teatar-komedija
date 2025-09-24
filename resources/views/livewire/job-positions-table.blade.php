@php
    // Get the max number of employees across all positions
    $maxEmployees = $positions->map(fn($p) => $p->employees->count())->max();
@endphp

<section>
    <x-admin.parts.table name='search'>
        <x-slot:thead>
            @forelse ($positions as $position)
                <x-admin.parts.table.th wire:key="position-{{ $position->id }}">
                    <div class="flex gap-2.5 items-center justify-center text-nowrap">
                        {{ $position->name }}
                        <a href="{{ route('admin.job-position.edit', $position) }}"
                            class="text-blue-500 hover:text-blue-700 dark:text-blue-300 dark:hover:text-blue-400">
                            <!-- Edit Icon -->
                            <svg class="size-4" aria-hidden="true" fill="currentColor" viewBox="0 0 24 24">
                                <path fill-rule="evenodd"
                                    d="M14 4.182A4.136 4.136 0 0 1 16.9 3c1.087 0 2.13.425 2.899 1.182A4.01 4.01 0 0 1 21 7.037c0 1.068-.43 2.092-1.194 2.849L18.5 11.214l-5.8-5.71 1.287-1.31.012-.012Zm-2.717 2.763L6.186 12.13l2.175 2.141 5.063-5.218-2.141-2.108Zm-6.25 6.886-1.98 5.849a.992.992 0 0 0 .245 1.026 1.03 1.03 0 0 0 1.043.242L10.282 19l-5.25-5.168Zm6.954 4.01 5.096-5.186-2.218-2.183-5.063 5.218 2.185 2.15Z"
                                    clip-rule="evenodd" />
                            </svg>
                        </a>
                    </div>
                </x-admin.parts.table.th>
            @empty
                <x-admin.parts.table.th class="text-center" colspan="100%">
                    <x-admin.parts.form.error>Нема работни позиции</x-admin.parts.form.error>
                </x-admin.parts.table.th>
            @endforelse
        </x-slot:thead>

        <x-slot:tbody>
            @for ($i = 0; $i < $maxEmployees; $i++)
                <x-admin.parts.table.tr>
                    @foreach ($positions as $position)
                        <x-admin.parts.table.td class="text-center"
                            wire:key="position-{{ $position->id }}-{{ uniqid() }}">
                            @php
                                $employee = $position->employees[$i] ?? null;
                            @endphp
                            {{ $employee ? $employee->getFullName() : '—' }}
                        </x-admin.parts.table.td>
                    @endforeach
                </x-admin.parts.table.tr>
            @endfor
        </x-slot:tbody>
    </x-admin.parts.table>

    <div class="mt-6">
        {{ $positions->links() }}
    </div>
</section>
