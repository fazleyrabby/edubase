@extends('layouts.admin')

@section('title', 'Run #'.$run->id)

@section('content')
<div class="max-w-4xl mx-auto">
    <a href="{{ route('admin.scrapers.runs.index') }}" class="text-sm text-indigo-600 hover:text-indigo-800">&larr; Back to runs</a>

    <h1 class="text-2xl font-bold text-gray-900 mt-4 mb-6">Run #{{ $run->id }}</h1>

    <div class="grid grid-cols-2 md:grid-cols-4 gap-4 mb-6">
        <div class="bg-white rounded-lg shadow-sm p-4">
            <p class="text-xs text-gray-500 uppercase">Source</p>
            <p class="font-medium">{{ $run->source?->name }}</p>
        </div>
        <div class="bg-white rounded-lg shadow-sm p-4">
            <p class="text-xs text-gray-500 uppercase">Status</p>
            <p class="font-medium">{{ $run->status }}</p>
        </div>
        <div class="bg-white rounded-lg shadow-sm p-4">
            <p class="text-xs text-gray-500 uppercase">Processed</p>
            <p class="font-medium">{{ $run->items_processed }}</p>
        </div>
        <div class="bg-white rounded-lg shadow-sm p-4">
            <p class="text-xs text-gray-500 uppercase">Changed</p>
            <p class="font-medium">{{ $run->items_changed }}</p>
        </div>
    </div>

    @if($run->error_message)
        <div class="bg-red-50 border border-red-200 rounded-lg p-4 mb-6">
            <p class="text-sm font-medium text-red-800">Error</p>
            <pre class="text-sm text-red-600 mt-1 whitespace-pre-wrap">{{ $run->error_message }}</pre>
        </div>
    @endif

    <div class="bg-white rounded-lg shadow-sm p-6 mb-6">
        <div class="flex items-center justify-between mb-4">
            <h2 class="text-lg font-semibold">Logs</h2>
            <a href="{{ route('admin.scrapers.runs.logs', $run) }}" class="text-sm text-indigo-600 hover:text-indigo-800">View all &rarr;</a>
        </div>

        <div class="space-y-2 max-h-96 overflow-y-auto">
            @forelse($run->logs->take(50) as $log)
                <div class="flex items-start gap-3 text-sm">
                    <span class="text-xs font-mono text-gray-400 whitespace-nowrap">{{ $log->created_at?->format('H:i:s') }}</span>
                    @php
                        $colors = ['debug' => 'text-gray-400', 'info' => 'text-blue-600', 'warning' => 'text-yellow-600', 'error' => 'text-red-600', 'critical' => 'text-red-800 font-bold'];
                    @endphp
                    <span class="text-xs uppercase {{ $colors[$log->log_level] ?? 'text-gray-500' }}">{{ $log->log_level }}</span>
                    <span class="text-gray-700">{{ $log->message }}</span>
                </div>
            @empty
                <p class="text-gray-500 text-sm">No logs.</p>
            @endforelse
        </div>
    </div>
</div>
@endsection
