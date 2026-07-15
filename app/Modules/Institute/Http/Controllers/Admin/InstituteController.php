<?php

namespace App\Modules\Institute\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Modules\Institute\DTOs\InstituteData;
use App\Modules\Institute\Http\Requests\StoreInstituteRequest;
use App\Modules\Institute\Http\Requests\UpdateInstituteRequest;
use App\Modules\Institute\Models\Institute;
use App\Modules\Institute\Services\InstituteService;
use App\Modules\Location\Models\Area;
use App\Modules\Location\Models\District;
use App\Modules\Location\Models\Division;
use App\Modules\Location\Models\Upazila;
use App\Modules\Taxonomy\Models\Category;
use App\Modules\Taxonomy\Models\Curriculum;
use App\Modules\Taxonomy\Models\EducationBoard;
use App\Modules\Taxonomy\Models\Facility;
use App\Modules\Taxonomy\Models\InstituteType;
use App\Modules\Taxonomy\Models\Language;
use App\Modules\Taxonomy\Models\Program;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class InstituteController extends Controller
{
    public function __construct(
        private InstituteService $instituteService,
    ) {}

    public function index(Request $request): View
    {
        $query = Institute::with(['type', 'district', 'upazila'])
            ->when($request->search, fn ($q, $s) => $q->where('name', 'like', "%{$s}%"))
            ->when($request->status, fn ($q, $s) => $q->where('status', $s))
            ->when($request->type, fn ($q, $t) => $q->where('institute_type_id', $t))
            ->when($request->district, fn ($q, $d) => $q->where('district_id', $d));

        $institutes = $query->latest()->paginate(20);

        return view('admin.institutes.index', [
            'institutes' => $institutes,
            'types' => InstituteType::all(),
            'districts' => District::all(),
        ]);
    }

    public function create(): View
    {
        return view('admin.institutes.form', [
            'institute' => null,
            'types' => InstituteType::all(),
            'categories' => Category::all(),
            'curriculums' => Curriculum::all(),
            'boards' => EducationBoard::all(),
            'programs' => Program::all(),
            'facilities' => Facility::all(),
            'languages' => Language::all(),
            'divisions' => Division::all(),
            'districts' => collect(),
            'upazilas' => collect(),
            'areas' => collect(),
        ]);
    }

    public function store(StoreInstituteRequest $request): RedirectResponse
    {
        $data = new InstituteData(
            name: $request->name,
            shortName: $request->short_name,
            slug: $request->slug,
            instituteTypeId: $request->institute_type_id,
            countryId: $request->country_id ?? 1,
            divisionId: $request->division_id,
            districtId: $request->district_id,
            upazilaId: $request->upazila_id,
            areaId: $request->area_id,
            establishedYear: $request->established_year,
            description: $request->description,
            instituteCode: $request->institute_code,
            primaryCategoryId: $request->primary_category_id,
            religiousOrientation: $request->religious_orientation,
            methodology: $request->methodology,
            gender: $request->gender,
            fullAddress: $request->full_address,
            postalCode: $request->postal_code,
            latitude: $request->latitude,
            longitude: $request->longitude,
            googleMapsUrl: $request->google_maps_url,
            nearbyLandmark: $request->nearby_landmark,
            status: 'draft',
            categoryIds: $request->category_ids ?? [],
            curriculumIds: $request->curriculum_ids ?? [],
            boardIds: $request->board_ids ?? [],
            programIds: $request->program_ids ?? [],
            facilityIds: $request->facility_ids ?? [],
            languageIds: $request->language_ids ?? [],
        );

        $this->instituteService->create($data);

        return redirect()->route('admin.institutes.index')
            ->with('success', 'Institute created successfully.');
    }

    public function edit(Institute $institute): View
    {
        $institute->load([
            'categories', 'curriculums', 'boards', 'programs',
            'facilities', 'languages',
        ]);

        return view('admin.institutes.form', [
            'institute' => $institute,
            'types' => InstituteType::all(),
            'categories' => Category::all(),
            'curriculums' => Curriculum::all(),
            'boards' => EducationBoard::all(),
            'programs' => Program::all(),
            'facilities' => Facility::all(),
            'languages' => Language::all(),
            'divisions' => Division::all(),
            'districts' => District::where('division_id', $institute->division_id)->get(),
            'upazilas' => Upazila::where('district_id', $institute->district_id)->get(),
            'areas' => Area::where('upazila_id', $institute->upazila_id)->get(),
        ]);
    }

    public function update(UpdateInstituteRequest $request, Institute $institute): RedirectResponse
    {
        $data = new InstituteData(
            name: $request->name,
            shortName: $request->short_name,
            slug: $request->slug,
            instituteTypeId: $request->institute_type_id,
            countryId: $request->country_id ?? 1,
            divisionId: $request->division_id,
            districtId: $request->district_id,
            upazilaId: $request->upazila_id,
            areaId: $request->area_id,
            establishedYear: $request->established_year,
            description: $request->description,
            instituteCode: $request->institute_code,
            primaryCategoryId: $request->primary_category_id,
            religiousOrientation: $request->religious_orientation,
            methodology: $request->methodology,
            gender: $request->gender,
            fullAddress: $request->full_address,
            postalCode: $request->postal_code,
            latitude: $request->latitude,
            longitude: $request->longitude,
            googleMapsUrl: $request->google_maps_url,
            nearbyLandmark: $request->nearby_landmark,
            status: $institute->status,
            categoryIds: $request->category_ids ?? [],
            curriculumIds: $request->curriculum_ids ?? [],
            boardIds: $request->board_ids ?? [],
            programIds: $request->program_ids ?? [],
            facilityIds: $request->facility_ids ?? [],
            languageIds: $request->language_ids ?? [],
        );

        $this->instituteService->update($institute, $data);

        return redirect()->route('admin.institutes.index')
            ->with('success', 'Institute updated successfully.');
    }

    public function publish(Institute $institute): RedirectResponse
    {
        $this->authorize('publish', $institute);
        $this->instituteService->publish($institute);

        return redirect()->route('admin.institutes.index')
            ->with('success', 'Institute published successfully.');
    }

    public function archive(Institute $institute): RedirectResponse
    {
        $this->authorize('archive', $institute);
        $this->instituteService->archive($institute);

        return redirect()->route('admin.institutes.index')
            ->with('success', 'Institute archived successfully.');
    }

    public function bulkPublish(Request $request): RedirectResponse
    {
        $request->validate(['ids' => ['required', 'array', 'min:1', 'max:100'], 'ids.*' => 'exists:institutes,id']);

        Institute::whereIn('id', $request->ids)->each(fn ($i) => $this->instituteService->publish($i));

        return redirect()->route('admin.institutes.index')
            ->with('success', count($request->ids).' institutes published.');
    }

    public function bulkArchive(Request $request): RedirectResponse
    {
        $request->validate(['ids' => ['required', 'array', 'min:1', 'max:100'], 'ids.*' => 'exists:institutes,id']);

        Institute::whereIn('id', $request->ids)->each(fn ($i) => $this->instituteService->archive($i));

        return redirect()->route('admin.institutes.index')
            ->with('success', count($request->ids).' institutes archived.');
    }
}
