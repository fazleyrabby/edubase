@extends('layouts.admin')

@section('title', 'SEO Management — Admin')

@section('content')
<div class="p-6">
    <h1 class="text-2xl font-bold mb-6">SEO Management</h1>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
        <a href="{{ route('admin.institutes.index') }}" class="block p-6 bg-white rounded-lg shadow hover:shadow-md transition">
            <h3 class="font-semibold text-lg">Institutes</h3>
            <p class="text-gray-600 mt-1">Manage SEO metadata for institutes</p>
        </a>

        <a href="{{ route('admin.districts.index') }}" class="block p-6 bg-white rounded-lg shadow hover:shadow-md transition">
            <h3 class="font-semibold text-lg">Districts</h3>
            <p class="text-gray-600 mt-1">Manage SEO metadata for district pages</p>
        </a>

        <a href="{{ route('admin.seo.redirects') }}" class="block p-6 bg-white rounded-lg shadow hover:shadow-md transition">
            <h3 class="font-semibold text-lg">Redirects</h3>
            <p class="text-gray-600 mt-1">Manage 301/302 redirects</p>
        </a>
    </div>

    <div class="bg-white rounded-lg shadow p-6">
        <h2 class="text-lg font-semibold mb-4">Quick Actions</h2>
        <ul class="space-y-2">
            <li>
                <code class="text-sm bg-gray-100 px-2 py-1 rounded">php artisan sitemap:generate</code>
                — Regenerate sitemap files
            </li>
            <li>
                <code class="text-sm bg-gray-100 px-2 py-1 rounded">php artisan seo:generate-pseo</code>
                — Generate programmatic SEO pages
            </li>
        </ul>
    </div>
</div>
@endsection
