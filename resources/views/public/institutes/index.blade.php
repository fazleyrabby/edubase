@extends('layouts.public')

@section('title', $seo['meta_title'] ?? 'Institutes — EduBase')
@section('meta_description', $seo['meta_description'] ?? 'Browse and compare schools, madrasas, and colleges across Bangladesh.')
@section('meta_keywords', $seo['meta_keywords'] ?? '')
@section('og_title', $seo['og_title'] ?? '')
@section('og_description', $seo['og_description'] ?? '')
@section('canonical_url', $seo['canonical_url'] ?? url()->current())
@if(isset($seo['noindex']) && $seo['noindex'])
    @section('robots', 'noindex, nofollow')
@endif

@section('content')
<div class="max-w-7xl mx-auto px-4 py-8">
    <x-schema-breadcrumb :items="array_merge(
        [['name' => 'Home', 'url' => url('/')]],
        isset($currentType) ? [['name' => 'Institutes', 'url' => route('institutes.index')], ['name' => $currentType->name]] : [],
        isset($currentDistrict) && !isset($currentType) ? [['name' => 'Institutes', 'url' => route('institutes.index')], ['name' => $currentDistrict->name]] : [],
        isset($currentType) && isset($currentDistrict) ? [['name' => 'Institutes', 'url' => route('institutes.index')], ['name' => $currentType->name], ['name' => $currentDistrict->name]] : [],
        !isset($currentType) && !isset($currentDistrict) ? [] : []
    )" />

    <h1 class="text-3xl font-bold text-gray-900 mb-2">
        @if(isset($currentType) && isset($currentDistrict))
            {{ $currentType->name }}s in {{ $currentDistrict->name }}
        @elseif(isset($currentType))
            {{ $currentType->name }}s
        @elseif(isset($currentDistrict))
            Institutes in {{ $currentDistrict->name }}
        @else
            Educational Institutes
        @endif
    </h1>
    <p class="text-gray-500 mb-8">
        @if(isset($currentType) && isset($currentDistrict))
            Browse {{ $currentType->name }}s in {{ $currentDistrict->name }}. Compare fees, curriculum, facilities, and admission.
        @else
            Browse and compare schools, madrasas, and colleges across Bangladesh.
        @endif
    </p>

    <div class="flex gap-4 mb-8 flex-wrap">
        <form method="GET" class="flex gap-4 flex-wrap items-center">
            <select name="type" class="rounded-lg border-gray-300 text-sm" onchange="this.form.submit()">
                <option value="">All Types</option>
                @foreach($types as $type)
                    <option value="{{ $type->slug }}" @selected(request('type') === $type->slug)>{{ $type->name }}</option>
                @endforeach
            </select>
            <select name="category" class="rounded-lg border-gray-300 text-sm" onchange="this.form.submit()">
                <option value="">All Categories</option>
                @foreach($categories as $cat)
                    <option value="{{ $cat->slug }}" @selected(request('category') === $cat->slug)>{{ $cat->name }}</option>
                @endforeach
            </select>
            <select name="curriculum" class="rounded-lg border-gray-300 text-sm" onchange="this.form.submit()">
                <option value="">All Curriculums</option>
                @foreach($curriculums as $c)
                    <option value="{{ $c->slug }}" @selected(request('curriculum') === $c->slug)>{{ $c->name }}</option>
                @endforeach
            </select>
        </form>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        @forelse($institutes as $institute)
            <div class="bg-white rounded-xl border border-gray-200 p-6 hover:shadow-md transition-shadow">
                <a href="{{ route('institutes.show', $institute) }}">
                    <div class="flex items-start gap-4">
                        <div class="w-12 h-12 rounded-lg bg-indigo-100 flex items-center justify-center text-indigo-600 font-bold text-lg flex-shrink-0">
                            {{ substr($institute->name, 0, 1) }}
                        </div>
                        <div class="flex-1 min-w-0">
                            <h2 class="font-semibold text-gray-900 truncate">{{ $institute->name }}</h2>
                            <p class="text-sm text-gray-500">{{ $institute->type?->name }} &middot; {{ $institute->district?->name }}</p>
                        </div>
                    </div>
                    <div class="mt-4 flex items-center justify-between text-sm">
                        <span class="text-gray-500">{{ $institute->upazila?->name }}</span>
                        <span class="font-medium text-gray-900">{{ number_format($institute->estimated_monthly_fee, 0) }} BDT</span>
                    </div>
                </a>
                <div class="mt-3 pt-3 border-t border-gray-100">
                    <button
                        onclick="event.preventDefault(); compareAdd('{{ $institute->uuid }}', '{{ $institute->slug }}', '{{ addslashes($institute->name) }}')"
                        class="w-full text-center text-sm text-indigo-600 hover:text-indigo-800 font-medium compare-btn"
                        data-uuid="{{ $institute->uuid }}"
                    >
                        + Add to Compare
                    </button>
                </div>
            </div>
        @empty
            <div class="col-span-full text-center py-12 text-gray-500">
                No institutes found matching your criteria.
            </div>
        @endforelse
    </div>

    <div class="mt-8">
        {{ $institutes->links() }}
    </div>

    @if(isset($currentType, $currentDistrict))
        <div class="mt-12 bg-gray-50 rounded-xl p-6">
            <h2 class="text-lg font-semibold mb-4">Browse Other Areas</h2>
            <div class="flex flex-wrap gap-2">
                @foreach(\App\Modules\Location\Models\District::inRandomOrder()->limit(10)->get() as $d)
                    <a href="{{ route('institutes.pseo', ['type' => $currentType->slug, 'district' => $d->slug]) }}"
                       class="px-3 py-1 bg-white border rounded-full text-sm hover:bg-indigo-50 hover:border-indigo-300 transition">
                        {{ $currentType->name }}s in {{ $d->name }}
                    </a>
                @endforeach
            </div>
        </div>
    @elseif(isset($currentType))
        <div class="mt-12 bg-gray-50 rounded-xl p-6">
            <h2 class="text-lg font-semibold mb-4">Browse by District</h2>
            <div class="flex flex-wrap gap-2">
                @foreach(\App\Modules\Location\Models\District::inRandomOrder()->limit(12)->get() as $d)
                    <a href="{{ route('institutes.by.district', $d->slug) }}"
                       class="px-3 py-1 bg-white border rounded-full text-sm hover:bg-indigo-50 hover:border-indigo-300 transition">
                        {{ $d->name }}
                    </a>
                @endforeach
            </div>
        </div>
    @elseif(isset($currentDistrict))
        <div class="mt-12 bg-gray-50 rounded-xl p-6">
            <h2 class="text-lg font-semibold mb-4">Browse by Type</h2>
            <div class="flex flex-wrap gap-2">
                @foreach(\App\Modules\Taxonomy\Models\InstituteType::all() as $t)
                    <a href="{{ route('institutes.by.type', $t->slug) }}"
                       class="px-3 py-1 bg-white border rounded-full text-sm hover:bg-indigo-50 hover:border-indigo-300 transition">
                        {{ $t->name }}s in {{ $currentDistrict->name }}
                    </a>
                @endforeach
            </div>
        </div>
    @else
        <div class="mt-12 grid grid-cols-1 md:grid-cols-2 gap-6">
            <div class="bg-gray-50 rounded-xl p-6">
                <h2 class="text-lg font-semibold mb-4">Browse by Type</h2>
                <div class="flex flex-wrap gap-2">
                    @foreach(\App\Modules\Taxonomy\Models\InstituteType::all() as $t)
                        <a href="{{ route('institutes.by.type', $t->slug) }}"
                           class="px-3 py-1 bg-white border rounded-full text-sm hover:bg-indigo-50 hover:border-indigo-300 transition">
                            {{ $t->name }}s
                        </a>
                    @endforeach
                </div>
            </div>
            <div class="bg-gray-50 rounded-xl p-6">
                <h2 class="text-lg font-semibold mb-4">Browse by District</h2>
                <div class="flex flex-wrap gap-2">
                    @foreach(\App\Modules\Location\Models\District::inRandomOrder()->limit(12)->get() as $d)
                        <a href="{{ route('institutes.by.district', $d->slug) }}"
                           class="px-3 py-1 bg-white border rounded-full text-sm hover:bg-indigo-50 hover:border-indigo-300 transition">
                            {{ $d->name }}
                        </a>
                    @endforeach
                </div>
            </div>
        </div>
    @endif
</div>
@endsection
