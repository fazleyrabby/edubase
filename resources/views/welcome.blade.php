@extends('layouts.public')

@section('content')
<div class="bg-gradient-to-br from-indigo-600 to-purple-700 text-white">
    <div class="max-w-4xl mx-auto px-4 py-24 text-center">
        <h1 class="text-5xl font-bold mb-4">Discover Education in Bangladesh</h1>
        <p class="text-xl text-indigo-100 mb-8">Comprehensive database of schools, madrasas, and colleges — compare fees, facilities, and admission information.</p>
        <div class="max-w-xl mx-auto">
            <form method="GET" action="{{ route('search') }}" class="flex gap-3">
                <input type="text" name="q" placeholder="Search by name, location..." class="flex-1 rounded-lg px-4 py-3 text-gray-900" autofocus>
                <button type="submit" class="px-6 py-3 bg-white text-indigo-700 rounded-lg font-semibold hover:bg-indigo-50">Search</button>
            </form>
        </div>
    </div>
</div>

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
