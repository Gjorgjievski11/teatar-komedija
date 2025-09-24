@props(['name', 'label', 'required' => false, 'type' => 'text'])
<div>
    <label for="{{ $name }}"
        class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">{{ $required ? '* ' : '' }}{{ $label }}</label>
    <div class="flex">
        <input type="{{ $type }}" id="{{ $name }}" name="{{ $name }}" {{ $attributes }}
            @required($required)
            class="rounded-none rounded-s-lg bg-gray-50 border text-gray-900 focus:ring-blue-500 focus:border-blue-500 block flex-1 min-w-0 w-full text-sm border-gray-300 p-2.5  dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
        <div
            class="inline-flex items-center px-3 text-sm text-gray-900 bg-gray-200 border rounded-s-0 border-gray-300 border-s-0 rounded-e-md dark:bg-gray-600 dark:text-gray-400 dark:border-gray-600">
            {{ $slot }}
        </div>
    </div>
    @error($name)
        <x-admin.parts.form.error class="mt-2">{{ $message }}</x-admin.parts.form.error>
    @enderror
</div>
