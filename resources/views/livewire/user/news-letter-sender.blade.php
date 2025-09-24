<div id="subscribe-to-email" class="flex flex-col gap-y-8 w-full md:w-1/2">
    <h1>ДОБИВАЈ НАЈНОВИ ИЗВЕСТУВАЊА!</h1>
    <div>
        <div class="flex gap-x-3.5">
            <input type="email" class="rounded-lg bg-white text-black placeholder:text-gray-400 px-8 py-2 w-[60%]"
                placeholder="E-mail" wire:model.live.debounce.250ms='email'>
            <button class="bg-red-700 px-4 py-2 rounded-lg cursor-pointer hover:bg-red-600" wire:click='store'>ПРЕТПЛАТИ
                СЕ</button>
        </div>
        @error('email')
            <p class="mt-2 text-red-600 font-semibold">{{ $message }}</p>
        @enderror
        @if (!$errors->all() && $message)
            <p class="mt-2 text-green-600 font-semibold">{{ $message }}</p>
        @endif
    </div>
</div>
