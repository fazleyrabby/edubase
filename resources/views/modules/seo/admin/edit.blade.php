@extends('layouts.admin')

@section('title', 'Edit SEO — ' . ($entity->name ?? $entity->id) . ' — Admin')

@section('content')
<div class="p-6">
    <div class="max-w-3xl mx-auto">
        <a href="{{ url()->previous() }}" class="text-blue-600 hover:underline mb-4 inline-block">&larr; Back</a>
        <h1 class="text-2xl font-bold mb-6">SEO: {{ $entity->name ?? 'Entity #' . $entity->id }}</h1>

        @if ($errors->any())
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-6">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form method="POST" action="{{ route('admin.seo.update', ['entity_type' => $entityType, 'entity_id' => $entity->id]) }}" class="bg-white rounded-lg shadow p-6 space-y-6">
            @csrf
            @method('PUT')

            <div class="grid grid-cols-2 gap-4">
                <div>
                    <label class="block text-sm font-medium mb-1">Meta Title</label>
                    <input type="text" name="meta_title" value="{{ old('meta_title', $meta->meta_title) }}" class="w-full border rounded px-3 py-2">
                </div>
                <div>
                    <label class="block text-sm font-medium mb-1">Canonical URL</label>
                    <input type="url" name="canonical_url" value="{{ old('canonical_url', $meta->canonical_url) }}" class="w-full border rounded px-3 py-2">
                </div>
            </div>

            <div>
                <label class="block text-sm font-medium mb-1">Meta Description</label>
                <textarea name="meta_description" rows="3" class="w-full border rounded px-3 py-2">{{ old('meta_description', $meta->meta_description) }}</textarea>
            </div>

            <div>
                <label class="block text-sm font-medium mb-1">Meta Keywords</label>
                <input type="text" name="meta_keywords" value="{{ old('meta_keywords', $meta->meta_keywords) }}" class="w-full border rounded px-3 py-2" placeholder="keyword1, keyword2, keyword3">
            </div>

            <hr>

            <h3 class="font-semibold text-lg">Open Graph</h3>

            <div class="grid grid-cols-2 gap-4">
                <div>
                    <label class="block text-sm font-medium mb-1">OG Title</label>
                    <input type="text" name="og_title" value="{{ old('og_title', $meta->og_title) }}" class="w-full border rounded px-3 py-2">
                </div>
                <div>
                    <label class="block text-sm font-medium mb-1">OG Type</label>
                    <input type="text" name="og_type" value="{{ old('og_type', $meta->og_type ?? 'website') }}" class="w-full border rounded px-3 py-2">
                </div>
            </div>

            <div>
                <label class="block text-sm font-medium mb-1">OG Description</label>
                <textarea name="og_description" rows="2" class="w-full border rounded px-3 py-2">{{ old('og_description', $meta->og_description) }}</textarea>
            </div>

            <div>
                <label class="block text-sm font-medium mb-1">OG Image URL</label>
                <input type="url" name="og_image" value="{{ old('og_image', $meta->og_image) }}" class="w-full border rounded px-3 py-2">
            </div>

            <hr>

            <div class="flex items-center gap-4">
                <label class="flex items-center gap-2">
                    <input type="checkbox" name="noindex" value="1" @checked(old('noindex', $meta->noindex))>
                    <span class="text-sm font-medium">No Index (hide from search engines)</span>
                </label>
            </div>

            <div>
                <label class="block text-sm font-medium mb-1">Schema.org Type</label>
                <input type="text" name="schema_type" value="{{ old('schema_type', $meta->schema_type ?? 'WebPage') }}" class="w-full border rounded px-3 py-2">
            </div>

            <div>
                <button type="submit" class="bg-blue-600 text-white px-6 py-2 rounded hover:bg-blue-700">Save</button>
            </div>
        </form>
    </div>
</div>
@endsection
