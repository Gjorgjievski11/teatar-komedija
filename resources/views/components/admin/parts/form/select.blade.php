@props(['name', 'label' => null, 'required' => false, 'placeholder' => 'Одберете опција'])
<div>
    @if ($label)
        <label for="{{ $name }}"
            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">{{ $required ? '* ' : '' }}{{ $label }}</label>
    @endif
    <select id="{{ $name }}" name="{{ $name }}" @required($required) {{ $attributes }}
        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
        <option value="" hidden>{{ $placeholder }}</option>
        {{ $slot }}
    </select>
    @error($name)
        <x-admin.parts.form.error class="mt-2">{{ $message }}</x-admin.parts.form.error>
    @enderror
</div>
