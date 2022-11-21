@props(['value'])

<label {{ $attributes->merge(['class' => 'block mb-2 text-sm font-semibold']) }}>
    {{ $value }}
</label>