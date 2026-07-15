@extends('layouts.public')

@section('title', "$category->name Institutes — ILMATLAS")

@section('content')
<div class="max-w-7xl mx-auto px-4 py-8">
    <div class="mb-8">
        <a href="{{ route('institutes.index') }}" class="text-sm text-indigo-600 hover:text-indigo-800">&larr; All Institutes</a>
    </div>

    <h1 class="text-3xl font-bold text-gray-900 mb-2">{{ $category->name }}</h1>
    @if($category->description)
        <p class="text-gray-500 mb-8">{{ $category->description }}</p>
    @endif

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        @forelse($institutes as $institute)
            <a href="{{ route('institutes.show', $institute) }}" class="block bg-white rounded-xl border border-gray-200 p-6 hover:shadow-md transition-shadow">
                <h3 class="font-semibold text-gray-900">{{ $institute->name }}</h3>
                <p class="text-sm text-gray-500 mt-1">{{ $institute->type?->name }} &middot; {{ $institute->district?->name }}</p>
            </a>
        @empty
            <div class="col-span-full text-center py-12 text-gray-500">
                No institutes found in this category.
            </div>
        @endforelse
    </div>

    <div class="mt-8">{{ $institutes->links() }}</div>
</div>
@endsection
