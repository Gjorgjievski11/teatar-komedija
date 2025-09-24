@props(['name', 'label', 'value' => null, 'required' => false])
<div>
    <label for="{{ $name }}"
        class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">{{ $required ? '* ' : '' }}{{ $label }}</label>
    <textarea id="{{ $name }}" name="{{ $name }}" {{ $attributes(['rows' => 4]) }}
        class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">{{ old($name, $value)    }}</textarea>
    @error($name)
        <x-admin.parts.form.error class="mt-2">{{ $message }}</x-admin.parts.form.error>
    @enderror
</div>
