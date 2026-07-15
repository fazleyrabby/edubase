<?php

namespace App\Modules\Institute\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateInstituteRequest extends FormRequest
{
    public function authorize(): bool
    {
        return $this->user()->can('update', $this->route('institute'));
    }

    public function rules(): array
    {
        $institute = $this->route('institute');

        return [
            'name' => ['required', 'string', 'max:500'],
            'slug' => ['required', 'string', 'max:500', Rule::unique('institutes', 'slug')->ignore($institute->id)],
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
            'institute_code' => ['nullable', 'string', 'max:100', Rule::unique('institutes', 'institute_code')->ignore($institute->id)],
            'description' => ['nullable', 'string'],
            'full_address' => ['nullable', 'string', 'max:1000'],
            'latitude' => ['nullable', 'numeric', 'between:-90,90'],
            'longitude' => ['nullable', 'numeric', 'between:-180,180'],
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
