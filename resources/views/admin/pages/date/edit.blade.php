<x-admin.layouts.app title='Измени дата'>

    <x-admin.parts.page.heading-back>Измени дата</x-admin.parts.page.heading-back>

    <form action="{{ route('admin.date.update', $date) }}" method="post" x-data="{ selectedDate: '{{ $date->getDate('Y-m-d') }}' }" x-init="() => {
        const el = document.getElementById('datepicker-inline');
        const instance = el.__datepicker;

        if (instance) {
            selectedDate = instance.getDate().toISOString().split('T')[0];
        }

        el.addEventListener('changeDate', (event) => {
            const newDate = event.detail.date;
            selectedDate = newDate.toISOString().split('T')[0];
        });
    }">
        @csrf
        @method('PATCH')

        <!-- Hidden input bound to Alpine -->
        <input type="hidden" name="date" x-bind:value="selectedDate">

        <div class="flex gap-2.5">
            <!-- Flowbite inline datepicker -->
            <div id="datepicker-inline" inline-datepicker data-date="{{ $date->getDate('m/d/Y') }}"></div>

            <!-- Timepicker component -->
            <x-admin.parts.form.timepicker name='time' :value="$date->getTime()" />
        </div>

        <x-admin.parts.form.button class="mt-6">Зачувај</x-admin.parts.form.button>
    </form>

</x-admin.layouts.app>
