@extends('layouts.admin')

@section('title', $source->exists ? 'Edit Source' : 'Add Source')

@section('content')
<div class="max-w-2xl mx-auto">
    <h1 class="text-2xl font-bold text-gray-900 mb-6">{{ $source->exists ? 'Edit Source' : 'Add Source' }}</h1>

    <form method="POST" action="{{ $source->exists ? route('admin.scrapers.sources.update', $source) : route('admin.scrapers.sources.store') }}" class="bg-white rounded-lg shadow-sm p-6 space-y-4">
        @csrf
        @if($source->exists) @method('PUT') @endif

        <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">Name</label>
            <input type="text" name="name" value="{{ old('name', $source->name) }}" required class="w-full rounded-lg border-gray-300 text-sm">
            @error('name') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
        </div>

        <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">Institute</label>
            <select name="institute_id" class="w-full rounded-lg border-gray-300 text-sm">
                <option value="">No institute (general source)</option>
                @foreach($institutes as $inst)
                    <option value="{{ $inst->id }}" @selected(old('institute_id', $source->institute_id) == $inst->id)>{{ $inst->name }}</option>
                @endforeach
            </select>
        </div>

        <div class="grid grid-cols-2 gap-4">
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Source Type</label>
                <select name="source_type" class="w-full rounded-lg border-gray-300 text-sm">
                    @foreach(['website', 'pdf', 'rss', 'api', 'manual'] as $t)
                        <option value="{{ $t }}" @selected(old('source_type', $source->source_type) === $t)>{{ ucfirst($t) }}</option>
                    @endforeach
                </select>
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Schedule Frequency</label>
                <select name="schedule_frequency" class="w-full rounded-lg border-gray-300 text-sm">
                    @foreach(['hourly', 'daily', 'weekly', 'monthly', 'manual'] as $f)
                        <option value="{{ $f }}" @selected(old('schedule_frequency', $source->schedule_frequency) === $f)>{{ ucfirst($f) }}</option>
                    @endforeach
                </select>
            </div>
        </div>

        <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">Base URL</label>
            <input type="url" name="base_url" value="{{ old('base_url', $source->base_url) }}" required class="w-full rounded-lg border-gray-300 text-sm">
            @error('base_url') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
        </div>

        <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">Adapter Class</label>
            <input type="text" name="adapter_class" value="{{ old('adapter_class', $source->adapter_class ?? 'App\\Modules\\Scraper\\Services\\HtmlAdapter') }}" required class="w-full rounded-lg border-gray-300 text-sm font-mono text-xs">
            @error('adapter_class') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
        </div>

        <div class="grid grid-cols-2 gap-4">
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Trust Level</label>
                <select name="trust_level" class="w-full rounded-lg border-gray-300 text-sm">
                    @foreach(['trusted', 'review_required', 'untrusted'] as $l)
                        <option value="{{ $l }}" @selected(old('trust_level', $source->trust_level) === $l)>{{ ucfirst(str_replace('_', ' ', $l)) }}</option>
                    @endforeach
                </select>
            </div>
            <div class="flex items-center pt-6">
                <label class="flex items-center gap-2">
                    <input type="checkbox" name="is_active" value="1" @checked(old('is_active', $source->is_active ?? true)) class="rounded border-gray-300">
                    <span class="text-sm text-gray-700">Active</span>
                </label>
            </div>
        </div>

        <div class="flex items-center gap-3 pt-4">
            <button type="submit" class="px-4 py-2 bg-indigo-600 text-white rounded-lg hover:bg-indigo-700 text-sm">
                {{ $source->exists ? 'Update' : 'Create' }}
            </button>
            <a href="{{ route('admin.scrapers.sources.index') }}" class="text-sm text-gray-500 hover:text-gray-700">Cancel</a>
        </div>
    </form>
</div>
@endsection
