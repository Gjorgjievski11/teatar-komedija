<section>

    <x-admin.parts.form.search name='search' />
    <div class="grid grid-cols-3 mt-4 gap-5">
        @forelse ($employees as $employee)
            <x-admin.parts.employee.card :$employee />
        @empty
            <div class="col-span-full">
                <x-admin.parts.form.error class="text-center">Нема Вработени</x-admin.parts.form.error>
            </div>
        @endforelse
    </div>

    <div class="mt-6">
        {{ $employees->links() }}
    </div>

</section>
