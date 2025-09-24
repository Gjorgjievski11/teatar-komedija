<x-admin.layouts.app title='Додади контрибуција'>
    <section>
        <x-admin.parts.page.heading-back>Додади контрибуција</x-admin.parts.page.heading-back>
    </section>

    <form method="POST" action="{{ route('admin.contribution.store') }}">
        @csrf
        <div class="max-w-sm">
            <x-admin.parts.form.input name="name" label='Име' placeholder='Актер' required />
        </div>

        <x-admin.parts.form.button class="mt-6">Додади</x-admin.parts.form.button>
    </form>
</x-admin.layouts.app>
