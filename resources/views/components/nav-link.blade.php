@props(['active'])

@php
$classes = ($active ?? false)
? 'inline-flex items-center px-3 py-2 border-2 border-indigo-400 bg-blue-500 text-white rounded-[3px] text-sm
font-medium leading-5
focus:outline-none focus:border-indigo-700 transition duration-150 ease-in-out'
: 'inline-flex items-center px-3 py-2 border-2 border-transparent text-sm font-medium leading-5 text-gray-500
rounded-[3px]
hover:bg-gray-100 hover:text-gray-700 hover:border-gray-100 focus:outline-none focus:text-gray-700 focus:border-gray-100
transition
duration-150 ease-in-out';
@endphp

<a {{ $attributes->merge(['class' => $classes]) }}>
    {{ $slot }}
</a>