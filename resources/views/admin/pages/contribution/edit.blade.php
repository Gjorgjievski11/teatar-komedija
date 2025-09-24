<x-admin.layouts.app :title="$contribution->name">
    <section class="flex justify-between">
        <x-admin.parts.page.heading-back :href="route('admin.contribution.index')">
            {{ $contribution->name }}
        </x-admin.parts.page.heading-back>

        <form action="{{ route('admin.contribution.destroy', $contribution) }}" method="POST">
            @csrf
            @method('DELETE')
            <x-admin.parts.form.button color='red'>Избриши</x-admin.parts.form.button>
        </form>
    </section>

    <form method="POST" action="{{ route('admin.contribution.update', $contribution) }}">
        @csrf
        @method('PATCH')
        <div class="max-w-sm">
            <x-admin.parts.form.input :value="old('name') ?? $contribution->name" name="name" label="Име на позицијата" />
        </div>

        <div class="flex justify-between mt-6">
            <x-admin.parts.form.button>Зачувај</x-admin.parts.form.button>
        </div>
    </form>
</x-admin.layouts.app>
