@props([
    'type' => 'success',
    'message'
])

@php
    $typeStyle = match($type) {
        'success' => 'border-green-700 text-green-700 bg-green-100',
        'danger' => 'border-red-700 text-red-7000 bg-red-100',
    };
@endphp

<div {{ $attributes->merge(["class" => "block max-w-[24rem] w-full rounded-lg text-sm px-4 py-2 my-4 border {$typeStyle}"]) }}>
    <!-- Because you are alive, everything is possible. - Thich Nhat Hanh -->
    {{ $message }}
</div>