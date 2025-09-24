@props(['name', 'label', 'required' => false])

@php
    // Detect base name (e.g., 'images[]' becomes 'images')
    $baseName = str_replace('[]', '', $name);
@endphp

<div>
    <label for="{{ $name }}"
        class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">{{ $required ? '* ' : '' }}{{ $label }}</label>

    <input {{ $attributes }}
        class="block w-full text-sm mb-2 text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400"
        id="{{ $name }}" name="{{ $name }}" @required($required) type="file">

    {{-- General array error (like: images) --}}
    @error($baseName)
        <x-admin.parts.form.error>{{ $message }}</x-admin.parts.form.error>
    @enderror

    {{-- Individual file errors (like: images.0, images.1) --}}
    @foreach ($errors->get($baseName . '.*') as $messages)
        @foreach ($messages as $message)
            <x-admin.parts.form.error>{{ $message }}</x-admin.parts.form.error>
        @endforeach
    @endforeach
</div>
