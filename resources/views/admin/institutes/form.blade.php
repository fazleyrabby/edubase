@extends('layouts.admin')

@section('title', $institute ? 'Edit Institute' : 'New Institute')

@section('content')
<div class="mb-8">
    <h1 class="text-2xl font-bold text-gray-900">{{ $institute ? 'Edit Institute' : 'New Institute' }}</h1>
    <p class="text-sm text-gray-500 mt-1">{{ $institute ? 'Update institute information' : 'Create a new educational institute' }}</p>
</div>

<form method="POST" action="{{ $institute ? route('admin.institutes.update', $institute) : route('admin.institutes.store') }}">
    @csrf
    @if($institute) @method('PUT') @endif

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        <div class="lg:col-span-2 space-y-6">
            <div class="bg-white rounded-xl border border-gray-200 p-6">
                <h2 class="text-lg font-semibold text-gray-900 mb-4">Basic Information</h2>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div class="md:col-span-2">
                        <label class="block text-sm font-medium text-gray-700 mb-1">Institute Name *</label>
                        <input type="text" name="name" value="{{ old('name', $institute?->name) }}" required
                            class="w-full rounded-lg border-gray-300 text-sm">
                        @error('name') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Slug *</label>
                        <input type="text" name="slug" value="{{ old('slug', $institute?->slug) }}" required
                            class="w-full rounded-lg border-gray-300 text-sm">
                        @error('slug') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Short Name</label>
                        <input type="text" name="short_name" value="{{ old('short_name', $institute?->short_name) }}"
                            class="w-full rounded-lg border-gray-300 text-sm">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Institute Type *</label>
                        <select name="institute_type_id" required class="w-full rounded-lg border-gray-300 text-sm">
                            <option value="">Select type</option>
                            @foreach($types as $type)
                                <option value="{{ $type->id }}" @selected(old('institute_type_id', $institute?->institute_type_id) == $type->id)>{{ $type->name }}</option>
                            @endforeach
                        </select>
                        @error('institute_type_id') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Institute Code (EIIN)</label>
                        <input type="text" name="institute_code" value="{{ old('institute_code', $institute?->institute_code) }}"
                            class="w-full rounded-lg border-gray-300 text-sm">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Established Year</label>
                        <input type="number" name="established_year" value="{{ old('established_year', $institute?->established_year) }}"
                            class="w-full rounded-lg border-gray-300 text-sm">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Gender *</label>
                        <select name="gender" required class="w-full rounded-lg border-gray-300 text-sm">
                            <option value="co_education" @selected(old('gender', $institute?->gender) === 'co_education')>Co-Education</option>
                            <option value="boys" @selected(old('gender', $institute?->gender) === 'boys')>Boys Only</option>
                            <option value="girls" @selected(old('gender', $institute?->gender) === 'girls')>Girls Only</option>
                        </select>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Primary Category</label>
                        <select name="primary_category_id" class="w-full rounded-lg border-gray-300 text-sm">
                            <option value="">None</option>
                            @foreach($categories as $cat)
                                <option value="{{ $cat->id }}" @selected(old('primary_category_id', $institute?->primary_category_id) == $cat->id)>{{ $cat->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Religious Orientation</label>
                        <select name="religious_orientation" class="w-full rounded-lg border-gray-300 text-sm">
                            <option value="not_applicable">Not Applicable</option>
                            <option value="islamic">Islamic</option>
                            <option value="mixed">Mixed</option>
                            <option value="non_islamic">Non-Islamic</option>
                        </select>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Methodology</label>
                        <input type="text" name="methodology" value="{{ old('methodology', $institute?->methodology) }}"
                            class="w-full rounded-lg border-gray-300 text-sm">
                    </div>
                    <div class="md:col-span-2">
                        <label class="block text-sm font-medium text-gray-700 mb-1">Description</label>
                        <textarea name="description" rows="3" class="w-full rounded-lg border-gray-300 text-sm">{{ old('description', $institute?->description) }}</textarea>
                    </div>
                    <div class="md:col-span-2">
                        <label class="block text-sm font-medium text-gray-700 mb-1">Motto</label>
                        <input type="text" name="motto" value="{{ old('motto', $institute?->motto) }}"
                            class="w-full rounded-lg border-gray-300 text-sm">
                    </div>
                </div>
            </div>

            <div class="bg-white rounded-xl border border-gray-200 p-6">
                <h2 class="text-lg font-semibold text-gray-900 mb-4">Location</h2>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Division *</label>
                        <select name="division_id" id="division_id" required class="w-full rounded-lg border-gray-300 text-sm"
                            onchange="fetchDistricts(this.value)">
                            <option value="">Select division</option>
                            @foreach($divisions as $div)
                                <option value="{{ $div->id }}" @selected(old('division_id', $institute?->division_id) == $div->id)>{{ $div->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">District *</label>
                        <select name="district_id" id="district_id" required class="w-full rounded-lg border-gray-300 text-sm"
                            onchange="fetchUpazilas(this.value)">
                            <option value="">Select district</option>
                            @foreach($districts as $dist)
                                <option value="{{ $dist->id }}" @selected(old('district_id', $institute?->district_id) == $dist->id)>{{ $dist->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Upazila *</label>
                        <select name="upazila_id" id="upazila_id" required class="w-full rounded-lg border-gray-300 text-sm"
                            onchange="fetchAreas(this.value)">
                            <option value="">Select upazila</option>
                            @foreach($upazilas as $upa)
                                <option value="{{ $upa->id }}" @selected(old('upazila_id', $institute?->upazila_id) == $upa->id)>{{ $upa->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Area *</label>
                        <select name="area_id" id="area_id" required class="w-full rounded-lg border-gray-300 text-sm">
                            <option value="">Select area</option>
                            @foreach($areas as $area)
                                <option value="{{ $area->id }}" @selected(old('area_id', $institute?->area_id) == $area->id)>{{ $area->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="md:col-span-2">
                        <label class="block text-sm font-medium text-gray-700 mb-1">Full Address</label>
                        <textarea name="full_address" rows="2" class="w-full rounded-lg border-gray-300 text-sm">{{ old('full_address', $institute?->full_address) }}</textarea>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Postal Code</label>
                        <input type="text" name="postal_code" value="{{ old('postal_code', $institute?->postal_code) }}"
                            class="w-full rounded-lg border-gray-300 text-sm">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Google Maps URL</label>
                        <input type="url" name="google_maps_url" value="{{ old('google_maps_url', $institute?->google_maps_url) }}"
                            class="w-full rounded-lg border-gray-300 text-sm">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Latitude</label>
                        <input type="text" name="latitude" value="{{ old('latitude', $institute?->latitude) }}"
                            class="w-full rounded-lg border-gray-300 text-sm">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Longitude</label>
                        <input type="text" name="longitude" value="{{ old('longitude', $institute?->longitude) }}"
                            class="w-full rounded-lg border-gray-300 text-sm">
                    </div>
                </div>
            </div>

            <div class="bg-white rounded-xl border border-gray-200 p-6">
                <h2 class="text-lg font-semibold text-gray-900 mb-4">Taxonomies</h2>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Categories</label>
                        <select name="category_ids[]" multiple class="w-full rounded-lg border-gray-300 text-sm" size="4">
                            @foreach($categories as $cat)
                                <option value="{{ $cat->id }}"
                                    @selected($institute && $institute->categories->contains($cat->id))>
                                    {{ $cat->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Curriculums</label>
                        <select name="curriculum_ids[]" multiple class="w-full rounded-lg border-gray-300 text-sm" size="4">
                            @foreach($curriculums as $c)
                                <option value="{{ $c->id }}"
                                    @selected($institute && $institute->curriculums->contains($c->id))>
                                    {{ $c->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Boards</label>
                        <select name="board_ids[]" multiple class="w-full rounded-lg border-gray-300 text-sm" size="4">
                            @foreach($boards as $b)
                                <option value="{{ $b->id }}"
                                    @selected($institute && $institute->boards->contains($b->id))>
                                    {{ $b->short_name ?? $b->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Programs</label>
                        <select name="program_ids[]" multiple class="w-full rounded-lg border-gray-300 text-sm" size="4">
                            @foreach($programs as $p)
                                <option value="{{ $p->id }}"
                                    @selected($institute && $institute->programs->contains($p->id))>
                                    {{ $p->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Facilities</label>
                        <select name="facility_ids[]" multiple class="w-full rounded-lg border-gray-300 text-sm" size="4">
                            @foreach($facilities as $f)
                                <option value="{{ $f->id }}"
                                    @selected($institute && $institute->facilities->contains($f->id))>
                                    {{ $f->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Languages</label>
                        <select name="language_ids[]" multiple class="w-full rounded-lg border-gray-300 text-sm" size="4">
                            @foreach($languages as $l)
                                <option value="{{ $l->id }}"
                                    @selected($institute && $institute->languages->contains($l->id))>
                                    {{ $l->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>
        </div>

        <div class="space-y-6">
            <div class="bg-white rounded-xl border border-gray-200 p-6">
                <h2 class="text-lg font-semibold text-gray-900 mb-4">Status</h2>
                <p class="text-sm text-gray-500 mb-4">
                    @if($institute)
                        Current: <span class="font-medium text-gray-900">{{ ucfirst($institute->status) }}</span>
                    @else
                        New institutes start as Draft
                    @endif
                </p>
                <div class="flex gap-2">
                    <button type="submit" class="flex-1 bg-indigo-600 text-white py-2 px-4 rounded-lg text-sm font-medium hover:bg-indigo-700">
                        {{ $institute ? 'Update' : 'Create' }}
                    </button>
                    <a href="{{ route('admin.institutes.index') }}" class="px-4 py-2 text-sm text-gray-600 hover:text-gray-800">Cancel</a>
                </div>
            </div>
        </div>
    </div>
</form>

<script>
function fetchDistricts(divisionId) {
    if (!divisionId) return;
    fetch(`/api/locations/divisions/${divisionId}/districts`)
        .then(r => r.json())
        .then(data => {
            const sel = document.getElementById('district_id');
            sel.innerHTML = '<option value="">Select district</option>' +
                data.map(d => `<option value="${d.id}">${d.name}</option>`).join('');
        });
}

function fetchUpazilas(districtId) {
    if (!districtId) return;
    fetch(`/api/locations/districts/${districtId}/upazilas`)
        .then(r => r.json())
        .then(data => {
            const sel = document.getElementById('upazila_id');
            sel.innerHTML = '<option value="">Select upazila</option>' +
                data.map(u => `<option value="${u.id}">${u.name}</option>`).join('');
        });
}

function fetchAreas(upazilaId) {
    if (!upazilaId) return;
    fetch(`/api/locations/upazilas/${upazilaId}/areas`)
        .then(r => r.json())
        .then(data => {
            const sel = document.getElementById('area_id');
            sel.innerHTML = '<option value="">Select area</option>' +
                data.map(a => `<option value="${a.id}">${a.name}</option>`).join('');
        });
}
</script>
@endsection
