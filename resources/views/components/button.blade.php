@props(['variant' => 'primary', 'type' => 'submit'])

@php
    $classes = match($variant) {
        'primary' => 'inline-flex items-center justify-center px-4 py-2 bg-indigo-600 text-white rounded-lg text-sm font-semibold hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition-colors duration-150',
        'secondary' => 'inline-flex items-center justify-center px-4 py-2 bg-white text-gray-700 border border-gray-300 rounded-lg text-sm font-medium hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition-colors duration-150',
        'danger' => 'inline-flex items-center justify-center px-4 py-2 bg-red-600 text-white rounded-lg text-sm font-semibold hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-offset-2 transition-colors duration-150',
        'ghost' => 'inline-flex items-center justify-center px-4 py-2 bg-transparent text-gray-600 rounded-lg text-sm font-medium hover:bg-gray-100 transition-colors duration-150',
    };
@endphp

<button type="{{ $type }}" {{ $attributes->merge(['class' => $classes]) }}>
    {{ $slot }}
</button>
