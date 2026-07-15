<?php

namespace App\Modules\Institute\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreInstituteRequest extends FormRequest
{
    public function authorize(): bool
    {
        return $this->user()->can('create', Institute::class);
    }

    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'max:500'],
            'slug' => ['required', 'string', 'max:500', 'unique:institutes,slug'],
            'institute_type_id' => ['required', 'exists:institute_types,id'],
            'country_id' => ['required', 'exists:countries,id'],
            'division_id' => ['required', 'exists:divisions,id'],
            'district_id' => ['required', 'exists:districts,id'],
            'upazila_id' => ['required', 'exists:upazilas,id'],
            'area_id' => ['required', 'exists:areas,id'],
            'gender' => ['required', 'string', 'in:boys,girls,co_education'],
            'established_year' => ['nullable', 'integer', 'min:1800', 'max:2099'],
            'primary_category_id' => ['nullable', 'exists:categories,id'],
            'short_name' => ['nullable', 'string', 'max:200'],
            'institute_code' => ['nullable', 'string', 'max:100', 'unique:institutes,institute_code'],
            'description' => ['nullable', 'string'],
            'religious_orientation' => ['nullable', 'string', 'max:50'],
            'methodology' => ['nullable', 'string', 'max:100'],
            'full_address' => ['nullable', 'string', 'max:1000'],
            'postal_code' => ['nullable', 'string', 'max:10'],
            'latitude' => ['nullable', 'numeric', 'between:-90,90'],
            'longitude' => ['nullable', 'numeric', 'between:-180,180'],
            'google_maps_url' => ['nullable', 'url', 'max:1000'],
            'category_ids' => ['nullable', 'array'],
            'category_ids.*' => ['exists:categories,id'],
            'curriculum_ids' => ['nullable', 'array'],
            'curriculum_ids.*' => ['exists:curriculums,id'],
            'board_ids' => ['nullable', 'array'],
            'board_ids.*' => ['exists:education_boards,id'],
            'program_ids' => ['nullable', 'array'],
            'program_ids.*' => ['exists:programs,id'],
            'facility_ids' => ['nullable', 'array'],
            'facility_ids.*' => ['exists:facilities,id'],
            'language_ids' => ['nullable', 'array'],
            'language_ids.*' => ['exists:languages,id'],
        ];
    }
}
