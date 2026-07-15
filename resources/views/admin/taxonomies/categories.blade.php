@extends('layouts.admin')

@section('title', 'Categories — ILMATLAS Admin')

@section('content')
<div class="mb-8 flex items-center justify-between">
    <div>
        <h1 class="text-2xl font-bold text-gray-900">Categories</h1>
        <p class="text-sm text-gray-500 mt-1">Manage educational categories</p>
    </div>
    <a href="{{ route('admin.taxonomies.categories.create') }}" class="px-4 py-2 bg-indigo-600 text-white rounded-lg text-sm hover:bg-indigo-700">New Category</a>
</div>

<div class="bg-white rounded-xl border border-gray-200 overflow-hidden">
    <table class="w-full">
        <thead>
            <tr class="bg-gray-50 text-left text-sm font-medium text-gray-500">
                <th class="px-6 py-3">Name</th>
                <th class="px-6 py-3">Slug</th>
                <th class="px-6 py-3">Parent</th>
                <th class="px-6 py-3">Institutes</th>
                <th class="px-6 py-3">Active</th>
                <th class="px-6 py-3">Actions</th>
            </tr>
        </thead>
        <tbody class="divide-y divide-gray-200">
            @foreach($categories as $category)
                <tr class="text-sm">
                    <td class="px-6 py-4 font-medium text-gray-900">{{ $category->name }}</td>
                    <td class="px-6 py-4 text-gray-500">{{ $category->slug }}</td>
                    <td class="px-6 py-4 text-gray-500">{{ $category->parent?->name ?? '—' }}</td>
                    <td class="px-6 py-4">{{ $category->institutes_count }}</td>
                    <td class="px-6 py-4">{{ $category->is_active ? 'Yes' : 'No' }}</td>
                    <td class="px-6 py-4 flex gap-2">
                        <a href="{{ route('admin.taxonomies.categories.edit', $category) }}" class="text-indigo-600 hover:text-indigo-900">Edit</a>
                        <form method="POST" action="{{ route('admin.taxonomies.categories.destroy', $category) }}" onsubmit="return confirm('Delete?')">
                            @csrf @method('DELETE')
                            <button class="text-red-500 hover:text-red-700">Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>

<div class="mt-6">{{ $categories->links() }}</div>
@endsection
