@extends('layouts.admin')

@section('title', 'Scraper Sources')

@section('content')
<div class="flex items-center justify-between mb-6">
    <h1 class="text-2xl font-bold text-gray-900">Scraper Sources</h1>
    <a href="{{ route('admin.scrapers.sources.create') }}" class="px-4 py-2 bg-indigo-600 text-white rounded-lg hover:bg-indigo-700 text-sm">Add Source</a>
</div>

<div class="bg-white rounded-lg shadow-sm overflow-hidden">
    <table class="w-full">
        <thead>
            <tr class="bg-gray-50 text-left text-sm font-medium text-gray-500">
                <th class="p-3">Name</th>
                <th class="p-3">Type</th>
                <th class="p-3">Institute</th>
                <th class="p-3">Schedule</th>
                <th class="p-3">Status</th>
                <th class="p-3">Last Run</th>
                <th class="p-3"></th>
            </tr>
        </thead>
        <tbody>
            @forelse($sources as $source)
                <tr class="border-t border-gray-100 text-sm">
                    <td class="p-3">
                        <a href="{{ route('admin.scrapers.sources.edit', $source) }}" class="text-indigo-600 hover:text-indigo-800 font-medium">{{ $source->name }}</a>
                        <p class="text-gray-400 text-xs mt-0.5 truncate max-w-xs">{{ $source->base_url }}</p>
                    </td>
                    <td class="p-3">{{ $source->source_type }}</td>
                    <td class="p-3">{{ $source->institute?->name ?? '-' }}</td>
                    <td class="p-3">{{ $source->schedule_frequency }}</td>
                    <td class="p-3">
                        @if($source->is_active)
                            <span class="px-2 py-0.5 bg-green-100 text-green-700 rounded-full text-xs">Active</span>
                        @else
                            <span class="px-2 py-0.5 bg-gray-100 text-gray-500 rounded-full text-xs">Inactive</span>
                        @endif
                    </td>
                    <td class="p-3 text-gray-500">{{ $source->last_successful_run_at?->diffForHumans() ?? 'Never' }}</td>
                    <td class="p-3">
                        <form action="{{ route('admin.scrapers.sources.toggle', $source) }}" method="POST" class="inline">
                            @csrf
                            <button type="submit" class="text-sm text-gray-500 hover:text-gray-700">
                                {{ $source->is_active ? 'Deactivate' : 'Activate' }}
                            </button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="7" class="p-8 text-center text-gray-500">No scraper sources configured.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>

<div class="mt-6">{{ $sources->links() }}</div>
@endsection
