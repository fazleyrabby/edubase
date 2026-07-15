@extends('layouts.admin')

@section('title', 'Institutes — ILMATLAS Admin')

@section('content')
<div class="mb-8 flex items-center justify-between">
    <div>
        <h1 class="text-2xl font-bold text-gray-900">Institutes</h1>
        <p class="text-sm text-gray-500 mt-1">Manage educational institutions</p>
    </div>
    <a href="{{ route('admin.institutes.create') }}" class="bg-indigo-600 text-white px-4 py-2 rounded-lg text-sm font-medium hover:bg-indigo-700">
        + New Institute
    </a>
</div>

<div class="bg-white rounded-xl border border-gray-200">
    <div class="p-4 border-b border-gray-200">
        <form method="GET" class="flex gap-4">
            <input type="text" name="search" value="{{ request('search') }}" placeholder="Search institutes..."
                class="rounded-lg border-gray-300 text-sm flex-1">
            <select name="status" class="rounded-lg border-gray-300 text-sm">
                <option value="">All Status</option>
                <option value="draft" @selected(request('status') === 'draft')>Draft</option>
                <option value="published" @selected(request('status') === 'published')>Published</option>
                <option value="archived" @selected(request('status') === 'archived')>Archived</option>
            </select>
            <select name="type" class="rounded-lg border-gray-300 text-sm">
                <option value="">All Types</option>
                @foreach($types as $type)
                    <option value="{{ $type->id }}" @selected(request('type') == $type->id)>{{ $type->name }}</option>
                @endforeach
            </select>
            <button type="submit" class="bg-gray-100 text-gray-700 px-4 py-2 rounded-lg text-sm hover:bg-gray-200">Filter</button>
        </form>
    </div>
    <table class="w-full text-sm">
        <thead>
            <tr class="border-b border-gray-200 text-left text-gray-500">
                <th class="p-4 font-medium">Name</th>
                <th class="p-4 font-medium">Type</th>
                <th class="p-4 font-medium">District</th>
                <th class="p-4 font-medium">Status</th>
                <th class="p-4 font-medium">Fee</th>
                <th class="p-4 font-medium">Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($institutes as $institute)
                <tr class="border-b border-gray-100 hover:bg-gray-50">
                    <td class="p-4">
                        <div class="font-medium text-gray-900">{{ $institute->name }}</div>
                        <div class="text-xs text-gray-500">{{ $institute->slug }}</div>
                    </td>
                    <td class="p-4">{{ $institute->type?->name }}</td>
                    <td class="p-4">{{ $institute->district?->name }}</td>
                    <td class="p-4">
                        <span class="px-2 py-1 rounded-full text-xs font-medium
                            @if($institute->status === 'published') bg-green-100 text-green-700
                            @elseif($institute->status === 'draft') bg-yellow-100 text-yellow-700
                            @elseif($institute->status === 'archived') bg-gray-100 text-gray-700
                            @endif">
                            {{ ucfirst($institute->status) }}
                        </span>
                    </td>
                    <td class="p-4">{{ number_format($institute->estimated_monthly_fee, 0) }} BDT</td>
                    <td class="p-4">
                        <div class="flex gap-2">
                            <a href="{{ route('admin.institutes.edit', $institute) }}" class="text-indigo-600 hover:text-indigo-800">Edit</a>
                            @if($institute->status !== 'published')
                                <form method="POST" action="{{ route('admin.institutes.publish', $institute) }}" class="inline">
                                    @csrf
                                    <button type="submit" class="text-green-600 hover:text-green-800">Publish</button>
                                </form>
                            @endif
                            @if($institute->status !== 'archived')
                                <form method="POST" action="{{ route('admin.institutes.archive', $institute) }}" class="inline">
                                    @csrf
                                    <button type="submit" class="text-red-600 hover:text-red-800">Archive</button>
                                </form>
                            @endif
                        </div>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    <div class="p-4 border-t border-gray-200">
        {{ $institutes->links() }}
    </div>
</div>
@endsection
