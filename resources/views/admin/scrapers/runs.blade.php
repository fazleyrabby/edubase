@extends('layouts.admin')

@section('title', 'Scraper Runs')

@section('content')
<div class="flex items-center justify-between mb-6">
    <h1 class="text-2xl font-bold text-gray-900">Scraper Runs</h1>
</div>

<div class="bg-white rounded-lg shadow-sm overflow-hidden">
    <table class="w-full">
        <thead>
            <tr class="bg-gray-50 text-left text-sm font-medium text-gray-500">
                <th class="p-3">Source</th>
                <th class="p-3">Status</th>
                <th class="p-3">Processed</th>
                <th class="p-3">Changed</th>
                <th class="p-3">Started</th>
                <th class="p-3">Duration</th>
                <th class="p-3"></th>
            </tr>
        </thead>
        <tbody>
            @forelse($runs as $run)
                <tr class="border-t border-gray-100 text-sm">
                    <td class="p-3 font-medium">{{ $run->source?->name ?? 'Deleted' }}</td>
                    <td class="p-3">
                        @php
                            $colors = ['pending' => 'bg-yellow-100 text-yellow-700', 'running' => 'bg-blue-100 text-blue-700', 'completed' => 'bg-green-100 text-green-700', 'failed' => 'bg-red-100 text-red-700', 'partial' => 'bg-orange-100 text-orange-700'];
                            $color = $colors[$run->status] ?? 'bg-gray-100 text-gray-700';
                        @endphp
                        <span class="px-2 py-0.5 rounded-full text-xs {{ $color }}">{{ $run->status }}</span>
                    </td>
                    <td class="p-3">{{ $run->items_processed }}</td>
                    <td class="p-3">{{ $run->items_changed }}</td>
                    <td class="p-3 text-gray-500">{{ $run->started_at?->diffForHumans() ?? '-' }}</td>
                    <td class="p-3 text-gray-500">
                        @if($run->started_at && $run->finished_at)
                            {{ $run->started_at->diffInSeconds($run->finished_at) }}s
                        @else
                            -
                        @endif
                    </td>
                    <td class="p-3">
                        <a href="{{ route('admin.scrapers.runs.show', $run) }}" class="text-indigo-600 hover:text-indigo-800 text-sm">View</a>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="7" class="p-8 text-center text-gray-500">No runs yet.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>

<div class="mt-6">{{ $runs->links() }}</div>
@endsection
