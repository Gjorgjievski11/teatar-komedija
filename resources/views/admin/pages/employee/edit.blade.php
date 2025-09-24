<x-admin.layouts.app :title="$employee->getFullName()">
    <div class="flex justify-between">
        <x-admin.parts.page.heading-back>{{ $employee->getFullName() }}</x-admin.parts.page.heading-back>

        <form action="{{ route('admin.employee.destroy', $employee) }}" method="post">
            @csrf
            @method('DELETE')
            <x-admin.parts.form.button color="red">Избриши</x-admin.parts.form.button>
        </form>
    </div>

    <form action="{{ route('admin.employee.update', $employee) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PATCH')
        <div class="grid grid-cols-2 gap-5">
            <div>
                {{ old('surname', $employee->surname) }}
                <div class="grid md:grid-cols-2 gap-5">
                    <x-admin.parts.form.input :value="$employee->name" name='name' label='Име' placeholder="John"
                        required />

                    <x-admin.parts.form.input :value="$employee->surname" name='surname' label='Презиме' placeholder='Doe'
                        required />

                    <div class="col-span-full">
                        <x-admin.parts.form.select name='job_position_id' label='Позиција' required>
                            @foreach ($positions as $position)
                                <option value="{{ $position->id }}" @selected(old('job_position_id', $employee->job_position_id) == $position->id)>
                                    {{ $position->name }}
                                </option>
                            @endforeach
                        </x-admin.parts.form.select>
                    </div>

                    <div class="col-span-full">
                        <x-admin.parts.form.textarea :value="$employee->description" name='description' label='Опис'
                            placeholder='Lorem Ipsum is simply dummy text of the printing and typesetting industry.' />
                    </div>
                </div>
            </div>

            @php
                $images = [];
                foreach ($employee->images as $image) {
                    $images[] = [
                        'name' => basename($image->path),
                        'url' => $image->path, // Already a full ImageKit URL
                    ];
                }
            @endphp

            <div x-data="{
                previews: @js($images),
                previewFiles(event) {
                    this.previews = [];
                    const files = event.target.files;

                    for (let file of files) {
                        if (file.type.startsWith('image/')) {
                            const reader = new FileReader();
                            reader.onload = (e) => {
                                this.previews.push({
                                    name: file.name,
                                    url: e.target.result
                                });
                            };
                            reader.readAsDataURL(file);
                        }
                    }
                }
            }" class="space-y-4">
                <x-admin.parts.form.file name="images[]" label="Слики" @change="previewFiles($event)" multiple
                    accept='.png, .jpg, .jpeg, .webp' />

                <div class="flex flex-wrap gap-5 items-start max-h-[50vh] overflow-auto">
                    <template x-for="image in previews" :key="image.name">
                        <div class="max-w-70 rounded-xl overflow-hidden border border-dashed dark:border-gray-700">
                            <img :src="image.url" class="object-cover w-full h-auto" />
                        </div>
                    </template>
                </div>
            </div>
        </div>

        <x-admin.parts.form.button class="mt-6">Зачувај</x-admin.parts.form.button>
    </form>
</x-admin.layouts.app>
