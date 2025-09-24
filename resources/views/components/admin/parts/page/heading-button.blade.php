@props(['href'])
<div {{ $attributes(['class' => 'flex justify-between items-center mb-12']) }}>
    <x-admin.parts.page.heading>{{ $heading }}</x-admin.parts.page.heading>

    <x-admin.parts.form.button :$href type='link'>{{ $button }}</x-admin.parts.form.button>
</div>
