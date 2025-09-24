<x-admin.layouts.app title="Додади Слики">
    <x-admin.parts.page.heading-back>Додади Слики</x-admin.parts.page.heading-back>

    <form action="{{ route('admin.image.store', $play) }}" method="POST" enctype="multipart/form-data"
        x-data="{
            previews: [],
            previewImages(event) {
                this.previews = [];
                const files = event.target.files;
                Array.from(files).forEach(file => {
                    if (file.type.startsWith('image/')) {
                        const reader = new FileReader();
                        reader.onload = e => this.previews.push(e.target.result);
                        reader.readAsDataURL(file);
                    }
                });
            }
        }">
        @csrf

        <x-admin.parts.form.file name="images[]" label="Слики" multiple accept=".png, .jpg, .jpeg, .webp"
            x-on:change="previewImages" />

        <!-- Image Previews -->
        <div class="mt-4 grid grid-cols-2 md:grid-cols-4 gap-4">
            <template x-for="(image, index) in previews" :key="index">
                <div class="rounded overflow-hidden shadow-md">
                    <img :src="image" class="w-full max-w-xl" />
                </div>
            </template>
        </div>

        <x-admin.parts.form.button class="mt-6">Зачувај</x-admin.parts.form.button>
    </form>
</x-admin.layouts.app>
