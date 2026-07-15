@extends('layouts.admin')

@section('title', 'Taxonomies — EduBase Admin')

@section('content')
<div class="mb-8">
    <h1 class="text-2xl font-bold text-gray-900">Taxonomies</h1>
    <p class="text-sm text-gray-500 mt-1">Manage institute types, categories, and curriculums</p>
</div>

<div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
    <div class="bg-white rounded-xl border border-gray-200 p-6">
        <h2 class="text-lg font-semibold text-gray-900 mb-4">Institute Types</h2>
        <ul class="space-y-2 mb-4">
            @foreach($types as $type)
                <li class="flex items-center justify-between py-2 border-b border-gray-100 text-sm">
                    <span class="text-gray-900">{{ $type->name }}</span>
                    <form method="POST" action="{{ route('admin.taxonomies.types.destroy', $type) }}" onsubmit="return confirm('Delete this type?')">
                        @csrf @method('DELETE')
                        <button class="text-red-500 hover:text-red-700 text-xs">Delete</button>
                    </form>
                </li>
            @endforeach
        </ul>
        <form method="POST" action="{{ route('admin.taxonomies.types.store') }}" class="flex gap-2">
            @csrf
            <input type="text" name="name" placeholder="Type name" class="flex-1 rounded-lg border-gray-300 text-sm" required>
            <input type="text" name="slug" placeholder="slug" class="flex-1 rounded-lg border-gray-300 text-sm" required>
            <button type="submit" class="px-3 py-2 bg-indigo-600 text-white rounded-lg text-sm hover:bg-indigo-700">Add</button>
        </form>
        @error('name') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
        @error('slug') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
    </div>

    <div class="bg-white rounded-xl border border-gray-200 p-6">
        <h2 class="text-lg font-semibold text-gray-900 mb-4">
            <a href="{{ route('admin.taxonomies.categories.index') }}" class="text-indigo-600 hover:underline">Categories</a>
        </h2>
        <ul class="space-y-2">
            @foreach($categories->take(10) as $category)
                <li class="flex items-center justify-between py-2 border-b border-gray-100 text-sm">
                    <span class="text-gray-900">{{ $category->name }}</span>
                    <span class="text-gray-400 text-xs">{{ $category->institutes_count }} institutes</span>
                </li>
            @endforeach
        </ul>
        @if($categories->count() > 10)
            <a href="{{ route('admin.taxonomies.categories.index') }}" class="text-sm text-indigo-600 hover:underline mt-2 inline-block">View all {{ $categories->count() }} categories</a>
        @endif
    </div>

    <div class="bg-white rounded-xl border border-gray-200 p-6">
        <h2 class="text-lg font-semibold text-gray-900 mb-4">Curriculums</h2>
        <ul class="space-y-2">
            @foreach($curriculums as $curriculum)
                <li class="flex items-center justify-between py-2 border-b border-gray-100 text-sm">
                    <span class="text-gray-900">{{ $curriculum->name }}</span>
                    <span class="text-gray-400 text-xs">{{ $curriculum->institutes_count }} institutes</span>
                </li>
            @endforeach
        </ul>
    </div>
</div>
@endsection
