<x-admin.layouts.app title="Измени документ">
    <div class="flex justify-between items-center">
        <x-admin.parts.page.heading-back>Измени документ</x-admin.parts.page.heading-back>
        <form action="{{ route('admin.document.destroy', $document) }}" method="POST">
            @csrf
            @method('DELETE')
            <x-admin.parts.form.button color='red'>Избриши</x-admin.parts.form.button>
        </form>
    </div>

    <form action="{{ route('admin.document.update', $document) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PATCH')
        <div class="grid grid-cols-2 gap-5">
            <div class="space-y-5">
                <div class="grid grid-cols-2 gap-5" x-data="{
                    category: '{{ (string) old('category_id', $document->category_id) }}',
                    subCategory: '',
                    subCategoriesMap: {
                        '1': [{ id: '1', name: 'Јавни Огласи' }, { id: '2', name: 'Одлуки' }, { id: '3', name: 'Архива' }],
                        '2': [{ id: '4', name: 'Правилници' }, { id: '5', name: 'Правилник на албански јазик' }],
                        '3': [{ id: '6', name: 'Завршни сметки' }],
                        '4': [{ id: '7', name: 'Јавни набавки' }, { id: '8', name: 'Одлуки' }],
                    },
                    get subCategories() {
                        return this.subCategoriesMap[this.category] || [];
                    },
                    init() {
                        this.$nextTick(() => {
                            this.subCategory = '{{ (string) old('sub_category_id', $document->sub_category_id) }}';
                            console.log('Initialized subCategory after nextTick:', this.subCategory);
                        });
                    }
                }" x-init="init()">
                    <!-- Category Select -->
                    <x-admin.parts.form.select name="category_id" label="Категорија" x-model="category">
                        <option value="1">Огласи</option>
                        <option value="2">Правилници</option>
                        <option value="3">Завршна сметка</option>
                        <option value="4">Јавни набавки</option>
                    </x-admin.parts.form.select>

                    <!-- Subcategory Select -->
                    <x-admin.parts.form.select name="sub_category_id" label="Подкатегорија" x-model="subCategory">
                        <template x-for="sub in subCategories" :key="sub.id">
                            <option :value="sub.id" x-text="sub.name"></option>
                        </template>
                    </x-admin.parts.form.select>
                </div>

                <x-admin.parts.form.textarea name='description' label="Опис" :value="old('description', $document->description)"
                    placeholder='Јавен оглас...' />
            </div>

            <div>
                <x-admin.parts.form.file name="file" label='Документ' />
            </div>
        </div>
        <x-admin.parts.form.button class="mt-6">Измени</x-admin.parts.form.button>
    </form>
</x-admin.layouts.app>
