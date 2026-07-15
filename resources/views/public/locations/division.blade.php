@extends('layouts.public')

@section('title', "$division->name Division — EduBase")

@section('content')
<div class="max-w-7xl mx-auto px-4 py-8">
    <div class="mb-8">
        <a href="{{ route('institutes.index') }}" class="text-sm text-indigo-600 hover:text-indigo-800">&larr; All Institutes</a>
    </div>

    <h1 class="text-3xl font-bold text-gray-900 mb-2">{{ $division->name }} Division</h1>
    <p class="text-gray-500 mb-8">{{ $institutes->total() }} institutes in this division</p>

    @if($districts->isNotEmpty())
        <div class="mb-8">
            <h2 class="text-lg font-semibold text-gray-900 mb-3">Districts</h2>
            <div class="flex flex-wrap gap-2">
                @foreach($districts as $district)
                    <a href="{{ route('locations.district', $district->slug) }}" class="px-4 py-2 bg-gray-100 rounded-lg text-sm text-gray-700 hover:bg-indigo-100 hover:text-indigo-700">{{ $district->name }}</a>
                @endforeach
            </div>
        </div>
    @endif

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        @foreach($institutes as $institute)
            <a href="{{ route('institutes.show', $institute->uuid) }}" class="block bg-white rounded-xl border border-gray-200 p-6 hover:shadow-md transition-shadow">
                <h3 class="font-semibold text-gray-900">{{ $institute->name }}</h3>
                <p class="text-sm text-gray-500 mt-1">{{ $institute->type?->name }} &middot; {{ $institute->district?->name }}</p>
            </a>
        @endforeach
    </div>

    <div class="mt-8">{{ $institutes->links() }}</div>
</div>
@endsection
