@extends('layouts.admin')

@section('title', 'Run #'.$run->id.' Logs')

@section('content')
<div class="max-w-4xl mx-auto">
    <a href="{{ route('admin.scrapers.runs.show', $run) }}" class="text-sm text-indigo-600 hover:text-indigo-800">&larr; Back to run</a>

    <h1 class="text-2xl font-bold text-gray-900 mt-4 mb-6">Run #{{ $run->id }} — Logs</h1>

    <div class="bg-white rounded-lg shadow-sm overflow-hidden">
        <table class="w-full">
            <thead>
                <tr class="bg-gray-50 text-left text-sm font-medium text-gray-500">
                    <th class="p-3">Time</th>
                    <th class="p-3">Level</th>
                    <th class="p-3">Message</th>
                </tr>
            </thead>
            <tbody>
                @forelse($logs as $log)
                    <tr class="border-t border-gray-100 text-sm">
                        <td class="p-3 text-gray-400 font-mono text-xs">{{ $log->created_at?->format('Y-m-d H:i:s') }}</td>
                        <td class="p-3">
                            @php
                                $colors = ['debug' => 'text-gray-400', 'info' => 'text-blue-600', 'warning' => 'text-yellow-600', 'error' => 'text-red-600', 'critical' => 'text-red-800 font-bold'];
                            @endphp
                            <span class="{{ $colors[$log->log_level] ?? '' }}">{{ $log->log_level }}</span>
                        </td>
                        <td class="p-3 text-gray-700">{{ $log->message }}</td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="3" class="p-8 text-center text-gray-500">No logs.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="mt-6">{{ $logs->links() }}</div>
</div>
@endsection
