@extends('layouts.public')

@section('content')
<x-ui.hero :searchAction="route('search')" />

<div class="max-w-6xl mx-auto px-4 py-16">
    <h2 class="text-2xl font-bold text-gray-900 mb-8 text-center">Browse by Division</h2>
    <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
        @foreach(App\Modules\Location\Models\Division::all() as $division)
            <a href="{{ route('locations.division', $division) }}" class="block bg-white rounded-xl border border-gray-200 p-6 text-center hover:shadow-md transition-shadow">
                <h3 class="font-semibold text-gray-900">{{ $division->name }}</h3>
            </a>
        @endforeach
    </div>
</div>

<div class="bg-gray-50 py-16">
    <div class="max-w-6xl mx-auto px-4">
        <h2 class="text-2xl font-bold text-gray-900 mb-8 text-center">Browse by Category</h2>
        <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
            @foreach(App\Modules\Taxonomy\Models\Category::where('is_active', true)->take(8)->get() as $category)
                <a href="{{ route('categories.show', $category) }}" class="block bg-white rounded-xl border border-gray-200 p-6 text-center hover:shadow-md transition-shadow">
                    <h3 class="font-semibold text-gray-900">{{ $category->name }}</h3>
                </a>
            @endforeach
        </div>
    </div>
</div>
@endsection
