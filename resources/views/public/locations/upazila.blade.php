@extends('layouts.public')

@section('title', "$upazila->name — EduBase")

@section('content')
<div class="max-w-7xl mx-auto px-4 py-8">
    <div class="mb-8">
        @if($upazila->district_id && $upazila->district)
            <a href="{{ route('locations.district', $upazila->district->slug) }}" class="text-sm text-indigo-600 hover:text-indigo-800">&larr; {{ $upazila->district->name }} District</a>
        @else
            <a href="{{ route('institutes.index') }}" class="text-sm text-indigo-600 hover:text-indigo-800">&larr; All Institutes</a>
        @endif
    </div>

    <h1 class="text-3xl font-bold text-gray-900 mb-2">{{ $upazila->name }}</h1>
    <p class="text-gray-500 mb-8">{{ $institutes->total() }} institutes in this area</p>

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        @foreach($institutes as $institute)
            <a href="{{ route('institutes.show', $institute->uuid) }}" class="block bg-white rounded-xl border border-gray-200 p-6 hover:shadow-md transition-shadow">
                <h3 class="font-semibold text-gray-900">{{ $institute->name }}</h3>
                <p class="text-sm text-gray-500 mt-1">{{ $institute->type?->name }}</p>
            </a>
        @endforeach
    </div>

    <div class="mt-8">{{ $institutes->links() }}</div>
</div>
@endsection
