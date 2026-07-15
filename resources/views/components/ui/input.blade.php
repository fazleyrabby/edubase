@props(['type' => 'text', 'id', 'name', 'value' => '', 'required' => false, 'placeholder' => ''])

<input type="{{ $type }}" id="{{ $id }}" name="{{ $name }}" value="{{ $value }}"
       {{ $required ? 'required' : '' }} placeholder="{{ $placeholder }}"
       {{ $attributes->merge(['class' => 'w-full px-3.5 py-2.5 rounded-lg border border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-1 focus:ring-indigo-500 text-sm placeholder-gray-400 bg-white transition duration-150']) }}>
