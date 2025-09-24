<section>
    <x-admin.parts.form.search name='search' />

    <div class="grid grid-cols-2 gap-5 mt-4">
        @forelse ($plays as $play)
            <x-admin.parts.play.card :$play />
        @empty
            <div class="col-span-full">
                <x-admin.parts.form.error class="text-center">Нема претстави</x-admin.parts.form.error>
            </div>
        @endforelse
    </div>

    <div class="mt-6">
        {{ $plays->links() }}
    </div>

</section>
