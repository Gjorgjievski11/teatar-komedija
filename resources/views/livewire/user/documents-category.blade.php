<div>
<div id="selector" class="text-center flex flex-col md:flex-row text-3xl md:text-xl w-4/5 mx-auto border-b mt-12 gap-4">
    <button x-on:click="$wire.category = 'announcements'; $wire.setCategory('announcements')" 
        class="pb-2 w-full md:w-1/4"
        x-bind:class="$wire.category === 'announcements' && 'border-b-4 border-[#DDB109] font-bold'">
        Огласи
    </button>
    <button x-on:click="$wire.category = 'regulations'; $wire.setCategory('regulations')" 
        class="pb-2 w-full md:w-1/3"
        x-bind:class="$wire.category === 'regulations' && 'border-b-4 border-[#DDB109] font-bold'">
        Правилници
    </button>
    <button x-on:click="$wire.category = 'final-account'; $wire.setCategory('final-account')" 
        class="pb-2 w-full md:w-1/3"
        x-bind:class="$wire.category === 'final-account' && 'border-b-4 border-[#DDB109] font-bold'">
        Завршна сметка
    </button>
    <button x-on:click="$wire.category = 'public-procurement'; $wire.setCategory('public-procurement')" 
        class="pb-2 w-full md:w-1/3"
        x-bind:class="$wire.category === 'public-procurement' && 'border-b-4 border-[#DDB109] font-bold'">
        Јавни набавки
    </button>
</div>


    <div class="space-y-12 mx-30 mt-12 pb-12">
        @forelse ($groupedDocuments as $name => $documents)
            <section>
                <h2 class="text-red-600 font-semibold text-2xl">{{ $name }}</h2>
                <div class="flex flex-wrap gap-5 mt-5 items-center">
                    @foreach ($documents as $document)
                        <a href="{{ $document->url }}" target="_blank" class="p-8 pe-6 rounded-2xl max-w-sm flex items-center border border-gray-200"
                            style="box-shadow: 1px 3px 8px 0 #0000001A, 6px 13px 14px 0 #00000017;">
                            <p class="text-sm max-h-30 overflow-auto pe-2">{{ $document->description }}</p>
                        </a>
                    @endforeach
                </div>
            </section>
        @empty
            <p class="text-center text-red-700 font-bold text-3xl min-h-[50vh]">НЕМА ДОКУМЕНТИ</p>
        @endforelse
    </div>
</div>
