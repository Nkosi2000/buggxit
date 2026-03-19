@props(['href' => '#'])

@php
$classes = 'block w-full px-4 py-2 text-left text-sm leading-5 text-gray-300 hover:bg-gray-800 hover:text-yellow-500 focus:outline-none focus:bg-gray-800 focus:text-yellow-500 transition duration-150 ease-in-out';
@endphp

<a {{ $attributes->merge(['href' => $href, 'class' => $classes]) }}>
    {{ $slot }}
</a>