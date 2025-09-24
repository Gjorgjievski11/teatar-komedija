<x-admin.layouts.app title='Додади вработен'>
    <x-admin.parts.page.heading-back>Додади вработен</x-admin.parts.page.heading-back>

    <form action="{{ route('admin.employee.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="grid grid-cols-2 gap-5">
            <div>
                <div class="grid md:grid-cols-2 gap-5">
                    <x-admin.parts.form.input name='name' value="{{ old('name') }}" label='Име' placeholder="John"
                        required />
                    <x-admin.parts.form.input name='surname' value="{{ old('surname') }}" label='Презиме'
                        placeholder='Doe' required />
                    <div class="col-span-full">
                        <x-admin.parts.form.select name='job_position_id' label='Позиција' required>
                            @foreach ($positions as $position)
                                <option value="{{ $position->id }}" @selected(old('job_position_id') == $position->id)>{{ $position->name }}
                                </option>
                            @endforeach
                        </x-admin.parts.form.select>
                        @empty($positions)
                            <span class="text-sm">
                                Моментално немате внесено позиции. Кликнете
                                <a wire:navigate class="text-blue-700 dark:text-blue-500 hover:underline"
                                    href="{{ route('admin.job-position.create') }}">тука</a>
                                за да додадете.</span>
                        @endempty

                    </div>

                    <div class="col-span-full">
                        <x-admin.parts.form.textarea name='description' label='Опис'
                            placeholder='Lorem Ipsum is simply dummy text of the printing and typesetting industry.' />
                    </div>
                </div>
            </div>

            <div x-data="filePreview()" class="space-y-4">
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
        <x-admin.parts.form.button class="mt-6">Додади</x-admin.parts.form.button>
    </form>

    <script>
        function filePreview() {
            return {
                previews: [],
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
            };
        }
    </script>
</x-admin.layouts.app>
