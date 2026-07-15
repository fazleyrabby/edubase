<?php

namespace App\Modules\Location\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Modules\Location\Models\Area;
use App\Modules\Location\Models\District;
use App\Modules\Location\Models\Upazila;

class LocationApiController extends Controller
{
    public function districts(int $divisionId)
    {
        return District::where('division_id', $divisionId)
            ->orderBy('name')
            ->get(['id', 'name']);
    }

    public function upazilas(int $districtId)
    {
        return Upazila::where('district_id', $districtId)
            ->orderBy('name')
            ->get(['id', 'name']);
    }

    public function areas(int $upazilaId)
    {
        return Area::where('upazila_id', $upazilaId)
            ->orderBy('name')
            ->get(['id', 'name']);
    }
}
