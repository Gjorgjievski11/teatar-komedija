<x-admin.layouts.app title='Известувања'>

    <x-admin.parts.page.heading-button :href="route('admin.announcements.create')">
        <x-slot:heading>Известувања</x-slot:heading>
        <x-slot:button>
            <svg class="size-6" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                fill="none" viewBox="0 0 24 24">
                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M5 12h14m-7 7V5" />
            </svg>
            Додади Известување
        </x-slot:button>
    </x-admin.parts.page.heading-button>

    <div class="bg-white dark:bg-gray-800 rounded-xl shadow-sm overflow-hidden mt-4">

        @if(session()->has('success'))
            <div class="px-4 py-3 text-green-600 dark:text-green-400 font-medium">
                {{ session('success') }}
            </div>
        @endif

        <table class="w-full text-sm text-gray-700 dark:text-gray-300">
            <thead class="bg-gray-50 dark:bg-gray-700 text-left text-gray-900 dark:text-gray-200">
                <tr>
                    <th class="px-4 py-3">Наслов</th>
                    <th class="px-4 py-3">Почеток</th>
                    <th class="px-4 py-3">Крај</th>
                    <th class="px-4 py-3">Активно</th>
                    <th class="px-4 py-3 text-right">Акции</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($announcements as $announcement)
                    <tr class="border-t border-gray-200 dark:border-gray-700">
                        <td class="px-4 py-3 font-medium">{{ $announcement->title }}</td>
                        <td class="px-4 py-3">{{ $announcement->starts_at?->format('d.m.Y') ?? '—' }}</td>
                        <td class="px-4 py-3">{{ $announcement->ends_at?->format('d.m.Y') ?? '—' }}</td>
                        <td class="px-4 py-3">
                            @if($announcement->is_active)
                                <span class="text-green-600 dark:text-green-400 font-medium">Да</span>
                            @else
                                <span class="text-gray-400 dark:text-gray-500">Не</span>
                            @endif
                        </td>
                        <td class="px-4 py-3 text-right space-x-2">
                            <a href="{{ route('admin.announcements.edit', $announcement) }}" class="text-blue-600 dark:text-blue-400 hover:underline">
                                Измени
                            </a>

                            <form action="{{ route('admin.announcements.destroy', $announcement) }}" method="POST" class="inline">
                                @csrf
                                @method('DELETE')
                                <button class="text-red-600 dark:text-red-400 hover:underline"
                                    onclick="return confirm('Сигурно?')">
                                    Избриши
                                </button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="px-4 py-6 text-center text-gray-500 dark:text-gray-400">
                            Нема известувања
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>

    </div>

</x-admin.layouts.app>
