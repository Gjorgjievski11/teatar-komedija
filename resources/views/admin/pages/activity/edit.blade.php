<x-admin.layouts.app title="Измени активнсот">
    <div class="flex justify-between">
        <x-admin.parts.page.heading-back>Измени активнсот</x-admin.parts.page.heading-back>

        <form action="{{ route('admin.activity.destroy', $activity) }}" method="POST">
            @csrf
            @method('DELETE')
            <x-admin.parts.form.button color='red'>Избриши</x-admin.parts.form.button>
        </form>
    </div>
    <form action="{{ route('admin.activity.update', $activity) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PATCH')
        <div class="grid grid-cols-2 gap-5">
            <div class="space-y-5">
                <div class="flex gap-5">
                    <div class="w-full">
                        <x-admin.parts.form.input name="title" label="Наслов"
                            placeholder="Театарски викенд на отворено" :value="old('title', $activity->title)" />
                    </div>

                    <div class="w-full">
                        <x-admin.parts.form.select name="category_id" label="Категорија">
                            <option value="1" @selected((old('category_id') || $activity->category_id) == 1)>Проекти</option>
                            <option value="2" @selected((old('category_id') || $activity->category_id) == 2)>Гостувања</option>
                            <option value="3" @selected((old('category_id') || $activity->category_id) == 3)>Промоции</option>
                            <option value="4" @selected((old('category_id') || $activity->category_id) == 4)>Издавачка дејност</option>
                        </x-admin.parts.form.select>
                    </div>
                </div>
                <x-admin.parts.form.textarea name="short_description" label="Краток опис"
                    placeholder="Lorem ipsum dolor sit amet consectetur adipiscing elit quisque faucibus ex sapien."
                    :value="old('short_description', $activity->short_description)" />
                <x-admin.parts.form.textarea name="description" label="Опис" :value="old('description', $activity->description)"
                    placeholder="Lorem ipsum dolor sit amet consectetur adipiscing elit quisque faucibus ex sapien vitae pellentesque sem placerat in id cursus mi pretium tellus duis convallis." />

                <div class="flex gap-5">
                    <div class="w-full" x-data="{ selectedDate: '{{ $activity->date->format('Y-m-d') }}' }" x-init="() => {
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
                        <x-admin.parts.form.datepicker name="date" :value="old('date') ?? $activity->date->format('m/d/Y')" type='inline' label="Дата" />
                        <input type="hidden" name="date" x-bind:value="selectedDate">
                    </div>

                    <div class="w-full">
                        <x-admin.parts.form.timepicker name="time" :value="old('time', $activity->date->format('H:i'))" label="Време" />
                    </div>
                </div>

            </div>

            <div class="space-y-5">

                <div class="space-y-5" x-data="{
                    imagePreview: '{{ $activity->image }}'
                }">
                    <div>
                        <x-admin.parts.form.file name="image" label="Слика" accept=".png, .jpg, .jpeg, .webp"
                            x-on:change="
                        const file = $event.target.files[0];
                        if (file) {
                            const reader = new FileReader();
                            reader.onload = e => imagePreview = e.target.result;
                            reader.readAsDataURL(file);
                        } else {
                            imagePreview = '{{ $activity->image }}';
                        }
                    " />
                        <p class="text-sm text-gray-500">Ако додадете слика старата ќе биде избришана.</p>
                    </div>

                    <template x-if="imagePreview">
                        <img :src="imagePreview" alt="Image Preview" class="w-full h-auto rounded-lg shadow" />
                    </template>

                </div>


            </div>
        </div>
        <div class="mt-6">
            <x-admin.parts.form.button>Измени</x-admin.parts.form.button>
        </div>
    </form>

</x-admin.layouts.app>
