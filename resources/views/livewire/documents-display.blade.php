<section>

    <x-admin.parts.form.search name="search" />
    <div class="grid grid-cols-3 gap-5 mt-6">
        @forelse ($documents as $document)
            <x-admin.parts.card.holder class="p-6 flex flex-col h-full" wire:key='document-{{ $document->id }}'>
                <div class="flex justify-between items-center mb-4">
                    <div class="text-gray-500 text-sm flex flex-col">
                        <span>
                            {{ $document->category_name }}
                        </span>
                        <span class="text-xs">
                            {{ $document->sub_category_name }}
                        </span>
                    </div>
                    <span class="text-gray-500 dark:text-white">
                        <svg class="size-6" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24"
                            height="24" fill="currentColor" viewBox="0 0 24 24">
                            <path
                                d="M6 16v-3h.375a.626.626 0 0 1 .625.626v1.749a.626.626 0 0 1-.626.625H6Zm6-2.5a.5.5 0 1 1 1 0v2a.5.5 0 0 1-1 0v-2Z" />
                            <path fill-rule="evenodd"
                                d="M11 7V2h7a2 2 0 0 1 2 2v5h1a1 1 0 0 1 1 1v9a1 1 0 0 1-1 1h-1a2 2 0 0 1-2 2H6a2 2 0 0 1-2-2H3a1 1 0 0 1-1-1v-9a1 1 0 0 1 1-1h6a2 2 0 0 0 2-2Zm7.683 6.006 1.335-.024-.037-2-1.327.024a2.647 2.647 0 0 0-2.636 2.647v1.706a2.647 2.647 0 0 0 2.647 2.647H20v-2h-1.335a.647.647 0 0 1-.647-.647v-1.706a.647.647 0 0 1 .647-.647h.018ZM5 11a1 1 0 0 0-1 1v5a1 1 0 0 0 1 1h1.376A2.626 2.626 0 0 0 9 15.375v-1.75A2.626 2.626 0 0 0 6.375 11H5Zm7.5 0a2.5 2.5 0 0 0-2.5 2.5v2a2.5 2.5 0 0 0 5 0v-2a2.5 2.5 0 0 0-2.5-2.5Z"
                                clip-rule="evenodd" />
                            <path d="M9 7V2.221a2 2 0 0 0-.5.365L4.586 6.5a2 2 0 0 0-.365.5H9Z" />
                        </svg>
                    </span>
                </div>

                <p class="max-h-48 overflow-auto mb-4">{{ $document->description }}</p>

                <!-- Button section pinned to bottom -->
                <div class="flex justify-between items-center mt-auto">
                    <x-admin.parts.form.button type='link' :href="route('admin.document.edit', $document)">
                        Измени
                    </x-admin.parts.form.button>
                    <a href="{{ $document->url }}" target="_blank" class="text-blue-500 font-semibold flex gap-1">
                        Документ
                        <svg class="size-6" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24"
                            height="24" fill="none" viewBox="0 0 24 24">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M19 12H5m14 0-4 4m4-4-4-4" />
                        </svg>
                    </a>
                </div>
            </x-admin.parts.card.holder>
        @empty
            <div class="col-span-full text-center">
                <x-admin.parts.form.error>Нема документи</x-admin.parts.form.error>
            </div>
        @endforelse
    </div>

    <div class="mt-6">
        {{ $documents->links() }}
    </div>
</section>
