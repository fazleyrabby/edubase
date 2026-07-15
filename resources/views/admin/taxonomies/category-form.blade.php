@extends('layouts.admin')

@section('title', $category->exists ? 'Edit Category — ILMATLAS Admin' : 'New Category — ILMATLAS Admin')

@section('content')
<div class="mb-8">
    <a href="{{ route('admin.taxonomies.categories.index') }}" class="text-sm text-indigo-600 hover:text-indigo-800">&larr; Back to categories</a>
    <h1 class="text-2xl font-bold text-gray-900 mt-2">{{ $category->exists ? 'Edit Category' : 'New Category' }}</h1>
</div>

<form method="POST" action="{{ $category->exists ? route('admin.taxonomies.categories.update', $category) : route('admin.taxonomies.categories.store') }}" class="max-w-2xl bg-white rounded-xl border border-gray-200 p-6 space-y-4">
    @csrf
    @if($category->exists) @method('PUT') @endif

    <div>
        <label class="block text-sm font-medium text-gray-700 mb-1">Name</label>
        <input type="text" name="name" value="{{ old('name', $category->name) }}" class="w-full rounded-lg border-gray-300" required>
        @error('name') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
    </div>

    <div>
        <label class="block text-sm font-medium text-gray-700 mb-1">Slug</label>
        <input type="text" name="slug" value="{{ old('slug', $category->slug) }}" class="w-full rounded-lg border-gray-300" required>
        @error('slug') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
    </div>

    <div>
        <label class="block text-sm font-medium text-gray-700 mb-1">Description</label>
        <textarea name="description" rows="3" class="w-full rounded-lg border-gray-300">{{ old('description', $category->description) }}</textarea>
    </div>

    <div>
        <label class="block text-sm font-medium text-gray-700 mb-1">Parent Category</label>
        <select name="parent_id" class="w-full rounded-lg border-gray-300">
            <option value="">— None —</option>
            @foreach($parentCategories as $parent)
                <option value="{{ $parent->id }}" @selected(old('parent_id', $category->parent_id) == $parent->id)>{{ $parent->name }}</option>
            @endforeach
        </select>
    </div>

    <div class="flex items-center gap-2">
        <input type="checkbox" name="is_active" value="1" id="is_active" class="rounded border-gray-300" @checked(old('is_active', $category->is_active ?? true))>
        <label for="is_active" class="text-sm text-gray-700">Active</label>
    </div>

    <div class="flex justify-end">
        <button type="submit" class="px-6 py-2 bg-indigo-600 text-white rounded-lg hover:bg-indigo-700">
            {{ $category->exists ? 'Update' : 'Create' }}
        </button>
    </div>
</form>
@endsection
