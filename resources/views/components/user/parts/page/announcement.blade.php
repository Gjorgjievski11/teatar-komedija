@foreach($announcements as $announcement)
    <div x-data="{ open: true }" x-show="open" 
         class="fixed inset-0 flex items-center justify-center z-50">
        <div class="absolute inset-0 bg-black/50" @click="open = false"></div>

        <div class="bg-white dark:bg-gray-900 text-gray-900 dark:text-gray-100 rounded-xl shadow-xl max-w-lg w-full p-6 mx-4">
            <div class="flex justify-between items-start mb-4">
                <h2 class="text-2xl font-bold">{{ $announcement->title }}</h2>
                <button @click="open = false" class="text-gray-400 hover:text-gray-700 dark:hover:text-gray-300">&times;</button>
            </div>

            <div class="leading-relaxed whitespace-pre-line">
                {{ $announcement->body }}
            </div>

            <div class="mt-6 text-right">
                <button @click="open = false"
                        class="px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white rounded-lg">
                    Затвори
                </button>
            </div>
        </div>
    </div>
@endforeach
