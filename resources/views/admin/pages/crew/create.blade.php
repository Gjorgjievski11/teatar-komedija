<x-admin.layouts.app title="Додади Crew">

    <x-admin.parts.page.heading-back class="line-clamp-1">
        Додади crew за {{ $play->title }}
    </x-admin.parts.page.heading-back>

    <form class="mt-12" method="POST" action="{{ route('admin.crew.create', $play) }}">

        @if ($errors->any())
            @foreach ($errors->all() as $error)
                <x-admin.parts.form.error class="mb-2">{{ $error }}</x-admin.parts.form.error>
            @endforeach
        @endif

        @csrf
        <livewire:crew-search :$play />
    </form>

</x-admin.layouts.app>
