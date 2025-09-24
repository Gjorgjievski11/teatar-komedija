<section class="mt-12">


    <x-admin.parts.table>
        <x-slot:addon>
            <div class="flex items-end gap-5">
                <x-admin.parts.form.select name="format" wire:model.lazy='format' label="Формат">
                    <option value="xlsx">XLSX</option>
                    <option value="csv">CSV</option>
                </x-admin.parts.form.select>
                <x-admin.parts.form.button wire:click='download'>Превземете</x-admin.parts.form.button>
            </div>
        </x-slot:addon>
        <x-slot:thead>
            <x-admin.parts.table.th>Email</x-admin.parts.table.th>
            <x-admin.parts.table.th class="text-end">Пријавени на</x-admin.parts.table.th>
        </x-slot:thead>
        <x-slot:tbody>
            @forelse ($newsletters as $newsletter)
                <x-admin.parts.table.tr>
                    <x-admin.parts.table.td>{{ $newsletter->email }}</x-admin.parts.table.td>
                    <x-admin.parts.table.td class="text-end">{{ $newsletter->created_at }}</x-admin.parts.table.tdc>
                </x-admin.parts.table.tr>
            @empty
                <x-admin.parts.table.tr>
                    <x-admin.parts.table.td colspan='100%' class="text-center">
                        <x-admin.parts.form.error>Нема пријавени корисници</x-admin.parts.form.error>
                    </x-admin.parts.table.td>
                </x-admin.parts.table.tr>
            @endforelse
        </x-slot:tbody>
    </x-admin.parts.table>

    <div class="mt-t">
        {{ $newsletters->links() }}
    </div>
</section>
