<x-admin.layouts.app :title="$play->title">

    <x-admin.parts.page.heading-back>{{ $play->title }}</x-admin.parts.page.heading-back>

    <form action="{{ route('admin.play.update', $play) }}" method="post" enctype="multipart/form-data">
        @csrf
        @method('PATCH')
        <div class="grid grid-cols-2 gap-5 items-start">
            <div class="grid grid-cols-2 gap-5 sticky top-0">
                <x-admin.parts.form.input :value="old('title', $play->title)" name='title' label='Наслов' placeholder='Пар Распар' />
                <x-admin.parts.form.input-group :value="old('duration', $play->duration)" name='duration' label='Времетраење' type='number'
                    min='0' step='10' placeholder='120'>мин.</x-admin.parts.form.input-group>

                <div class="col-span-full">
                    <div class="col-span-full">
                        <x-admin.parts.form.multi-select placeholder='Изберете категории' name='categories[]'
                            :selected="$play->categories->pluck('id')->toArray()" id='categories' label='Категории' required>
                            @foreach ($categories as $category)
                                <option value="{{ $category->id }}">{{ $category->name }}</option>
                            @endforeach
                        </x-admin.parts.form.multi-select>
                        @if ($categories->isEmpty())
                            <x-admin.parts.form.error>Нема категории, кликнете <a
                                    href="{{ route('admin.category.create') }}"
                                    class="text-blue-500 hover:underline">тука</a> за да
                                додадете</x-admin.parts.form.error>
                        @endif
                    </div>
                </div>

                <div class="col-span-full">
                    <x-admin.parts.form.textarea :value="old('short_description', $play->short_description)" name='short_description' label='Краток опис'
                        placeholder='Lorem ipsum dolor sit amet consectetur adipiscing elit.' />
                </div>
                <div class="col-span-full">
                    <x-admin.parts.form.textarea :value="old('description', $play->description)" name='description' label='Опис'
                        placeholder='Lorem ipsum dolor sit amet consectetur adipiscing elit. Sit amet consectetur adipiscing elit quisque faucibus ex. Adipiscing elit quisque faucibus ex sapien vitae pellentesque.' />
                </div>

                <x-admin.parts.form.input-group :value="old('price', $play->price)" type='number' label='Цена за билет' name='price'
                    placeholder='300'>ден.</x-admin.parts.form.input-group>
                <x-admin.parts.form.input-group :value="old('ticket_url', $play->ticket_url)" label='Линк до тикетот' name='ticket_url'
                    placeholder='https://example.com'>URL</x-admin.parts.form.input-group>
            </div>

            <div x-data="{
                imageUrl: '{{ $play->poster }}',
                updatePreview(event) {
                    const file = event.target.files[0];
                    if (file) {
                        this.imageUrl = URL.createObjectURL(file);
                    }
                }
            }" class="flex flex-col gap-5">
                <!-- File input -->
                <div>
                    <x-admin.parts.form.file name="poster" label='Слика' accept=".png, .jpg, .jpeg, .webp"
                        x-on:change="updatePreview" />
                    <p class="text-sm text-gray-500">Ако додадете слика старата ќе биде избришана.</p>
                </div>

                <!-- Image preview -->
                <template x-if="imageUrl">
                    <img :src="imageUrl" alt="Image Preview" class="w-full h-auto rounded-lg shadow" />
                </template>

            </div>
        </div>

        <x-admin.parts.form.button class="mt-6">Измени</x-admin.parts.form.button>
    </form>

</x-admin.layouts.app>
