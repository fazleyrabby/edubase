@extends('layouts.public')

@section('title', $query ? "Search: $query — ILMATLAS" : 'Search — ILMATLAS')

@section('content')
<div class="max-w-4xl mx-auto px-4 py-8">
    <h1 class="text-3xl font-bold text-gray-900 mb-2">Search Institutes</h1>
    <form method="GET" action="{{ route('search') }}" class="mb-8">
        <div class="flex gap-3">
            <input type="text" name="q" value="{{ $query }}" placeholder="Search by name, location..." class="flex-1 rounded-lg border-gray-300" autofocus>
            <button type="submit" class="px-6 py-2 bg-indigo-600 text-white rounded-lg hover:bg-indigo-700">Search</button>
        </div>
    </form>

    @if($query)
        <p class="text-sm text-gray-500 mb-6">
            {{ $results->total() }} result(s) for "{{ $query }}"
        </p>
    @endif

    <div class="grid grid-cols-1 gap-4">
        @forelse($results as $institute)
            <a href="{{ route('institutes.show', $institute) }}" class="block bg-white rounded-xl border border-gray-200 p-5 hover:shadow-md transition-shadow">
                <div class="flex items-start gap-4">
                    <div class="w-10 h-10 rounded-lg bg-indigo-100 flex items-center justify-center text-indigo-600 font-bold flex-shrink-0">
                        {{ substr($institute->name, 0, 1) }}
                    </div>
                    <div class="flex-1 min-w-0">
                        <h2 class="font-semibold text-gray-900">{{ $institute->name }}</h2>
                        <p class="text-sm text-gray-500">{{ $institute->type?->name }} &middot; {{ $institute->district?->name }}, {{ $institute->upazila?->name }}</p>
                    </div>
                    <div class="text-right flex-shrink-0">
                        <p class="text-sm font-medium text-gray-900">{{ number_format($institute->estimated_monthly_fee) }} BDT</p>
                        <p class="text-xs text-gray-500">/month</p>
                    </div>
                </div>
            </a>
        @empty
            @if($query)
                <div class="text-center py-12 text-gray-500">
                    No institutes found matching your search. Try different keywords or browse by <a href="{{ route('institutes.index') }}" class="text-indigo-600 hover:underline">location</a>.
                </div>
            @endif
        @endforelse
    </div>

    @if(isset($results) && method_exists($results, 'links'))
        <div class="mt-8">{{ $results->links() }}</div>
    @endif
</div>
@endsection
