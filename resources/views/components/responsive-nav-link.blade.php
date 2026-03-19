@props(['active'])

@php
$classes = ($active ?? false)
            ? 'block pl-3 pr-4 py-2 border-l-4 border-yellow-500 text-base font-medium text-yellow-500 bg-yellow-500/10 focus:outline-none focus:text-yellow-600 focus:bg-yellow-500/20 focus:border-yellow-600 transition duration-150 ease-in-out'
            : 'block pl-3 pr-4 py-2 border-l-4 border-transparent text-base font-medium text-gray-300 hover:text-gray-100 hover:bg-gray-800 hover:border-gray-700 focus:outline-none focus:text-gray-100 focus:bg-gray-800 focus:border-gray-700 transition duration-150 ease-in-out';
@endphp

<a {{ $attributes->merge(['class' => $classes]) }}>
    {{ $slot }}
</a>