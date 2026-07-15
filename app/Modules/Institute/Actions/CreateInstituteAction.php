<?php

namespace App\Modules\Institute\Actions;

use App\Modules\Institute\DTOs\InstituteData;
use App\Modules\Institute\Events\InstituteCreated;
use App\Modules\Institute\Models\Institute;
use Illuminate\Support\Str;

class CreateInstituteAction
{
    public function execute(InstituteData $data): Institute
    {
        $institute = Institute::create([
            'uuid' => (string) Str::uuid(),
            'name' => $data->name,
            'short_name' => $data->shortName,
            'slug' => $data->slug,
            'institute_code' => $data->instituteCode,
            'established_year' => $data->establishedYear,
            'description' => $data->description,
            'institute_type_id' => $data->instituteTypeId,
            'primary_category_id' => $data->primaryCategoryId,
            'religious_orientation' => $data->religiousOrientation ?? 'not_applicable',
            'methodology' => $data->methodology,
            'gender' => $data->gender,
            'country_id' => $data->countryId,
            'division_id' => $data->divisionId,
            'district_id' => $data->districtId,
            'upazila_id' => $data->upazilaId,
            'area_id' => $data->areaId,
            'full_address' => $data->fullAddress,
            'postal_code' => $data->postalCode,
            'latitude' => $data->latitude,
            'longitude' => $data->longitude,
            'google_maps_url' => $data->googleMapsUrl,
            'nearby_landmark' => $data->nearbyLandmark,
            'status' => $data->status,
        ]);

        if (! empty($data->categoryIds)) {
            $institute->categories()->sync($data->categoryIds);
        }

        if (! empty($data->curriculumIds)) {
            $institute->curriculums()->sync($data->curriculumIds);
        }

        if (! empty($data->boardIds)) {
            $institute->boards()->sync($data->boardIds);
        }

        if (! empty($data->programIds)) {
            $institute->programs()->sync($data->programIds);
        }

        if (! empty($data->facilityIds)) {
            $institute->facilities()->sync($data->facilityIds);
        }

        if (! empty($data->languageIds)) {
            $institute->languages()->sync($data->languageIds);
        }

        event(new InstituteCreated($institute));

        return $institute;
    }
}
