@props(['label'])

<button {{ $attributes->merge(["class" => "block w-full rounded-lg p-2.5 text-sm font-bold text-white bg-slate-900 hover:bg-slate-800 transition duration-200"]) }}>
    {{ $label }}
</button>
@csrf