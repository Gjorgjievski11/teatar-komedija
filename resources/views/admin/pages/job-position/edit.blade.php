<x-admin.layouts.app :title="$position->name">
    <section class="flex justify-between">
        <x-admin.parts.page.heading-back :href="route('admin.job-position.index')">
            {{ $position->name }}
        </x-admin.parts.page.heading-back>

        <form action="{{ route('admin.job-position.destroy', $position) }}" method="POST">
            @csrf
            @method('DELETE')
            <x-admin.parts.form.button color='red'>Избриши</x-admin.parts.form.button>
        </form>
    </section>

    <form method="POST" action="{{ route('admin.job-position.update', $position) }}">
        @csrf
        @method('PATCH')
        <div class="max-w-sm">
            <x-admin.parts.form.input :value="old('name') ?? $position->name" name="name" label="Име на позицијата" />
        </div>

        <div class="flex justify-between mt-6">
            <x-admin.parts.form.button>Зачувај</x-admin.parts.form.button>
        </div>
    </form>
</x-admin.layouts.app>
