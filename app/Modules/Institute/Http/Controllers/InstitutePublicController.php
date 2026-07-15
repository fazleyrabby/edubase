<?php

namespace App\Modules\Institute\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Modules\Institute\Models\Institute;
use App\Modules\Taxonomy\Models\Category;
use App\Modules\Taxonomy\Models\Curriculum;
use App\Modules\Taxonomy\Models\InstituteType;
use App\Modules\Location\Models\District;
use App\Modules\SEO\Services\SeoService;
use Illuminate\Http\Request;
use Illuminate\View\View;

class InstitutePublicController extends Controller
{
    public function index(Request $request): View
    {
        $query = Institute::published()
            ->with(['type', 'district', 'upazila', 'primaryCategory'])
            ->when($request->type, fn ($q, $t) => $q->whereHas('type', fn ($sq) => $sq->where('slug', $t)))
            ->when($request->district, fn ($q, $d) => $q->where('district_id', $d))
            ->when($request->category, fn ($q, $c) => $q->whereHas('categories', fn ($sq) => $sq->where('slug', $c)))
            ->when($request->curriculum, fn ($q, $c) => $q->whereHas('curriculums', fn ($sq) => $sq->where('slug', $c)))
            ->when($request->gender, fn ($q, $g) => $q->where('gender', $g));

        $institutes = $query->latest('published_at')->paginate(20);

        return view('public.institutes.index', [
            'institutes' => $institutes,
            'types' => InstituteType::all(),
            'categories' => Category::where('is_active', true)->get(),
            'curriculums' => Curriculum::where('is_active', true)->get(),
        ]);
    }

    public function byType(InstituteType $type, Request $request, SeoService $seo): View
    {
        $institutes = Institute::published()
            ->where('institute_type_id', $type->id)
            ->with(['type', 'district', 'upazila', 'primaryCategory'])
            ->latest('published_at')
            ->paginate(20);

        $meta = $seo->forLocation('Institute', $type->name, $institutes->total(), "{$type->name}s");

        return view('public.institutes.index', [
            'institutes' => $institutes,
            'types' => InstituteType::all(),
            'categories' => Category::where('is_active', true)->get(),
            'curriculums' => Curriculum::where('is_active', true)->get(),
            'seo' => $meta,
            'currentType' => $type,
        ]);
    }

    public function byDistrict(District $district, Request $request, SeoService $seo): View
    {
        $institutes = Institute::published()
            ->where('district_id', $district->id)
            ->with(['type', 'district', 'upazila', 'primaryCategory'])
            ->latest('published_at')
            ->paginate(20);

        $meta = $seo->forLocation('Institute', $district->name, $institutes->total(), "institutes in {$district->name}");

        return view('public.institutes.index', [
            'institutes' => $institutes,
            'types' => InstituteType::all(),
            'categories' => Category::where('is_active', true)->get(),
            'curriculums' => Curriculum::where('is_active', true)->get(),
            'seo' => $meta,
            'currentDistrict' => $district,
        ]);
    }

    public function byTypeAndDistrict(InstituteType $type, District $district, Request $request, SeoService $seo): View
    {
        $institutes = Institute::published()
            ->where('institute_type_id', $type->id)
            ->where('district_id', $district->id)
            ->with(['type', 'district', 'upazila', 'primaryCategory'])
            ->latest('published_at')
            ->paginate(20);

        $meta = $seo->forPSEO($district->name, $type->slug, "{$type->name}s", $institutes->total());

        return view('public.institutes.index', [
            'institutes' => $institutes,
            'types' => InstituteType::all(),
            'categories' => Category::where('is_active', true)->get(),
            'curriculums' => Curriculum::where('is_active', true)->get(),
            'seo' => $meta,
            'currentType' => $type,
            'currentDistrict' => $district,
        ]);
    }

    public function show(Institute $institute, SeoService $seo): View
    {
        abort_unless($institute->status === 'published', 404);

        $institute->load([
            'type', 'primaryCategory', 'country', 'division', 'district', 'upazila', 'area',
            'categories', 'curriculums', 'boards', 'programs', 'subjects',
            'facilities.group', 'languages', 'contacts', 'socialLinks',
            'media', 'shifts',
            'fees' => fn ($q) => $q->where('moderation_status', 'approved')->where('is_published', true),
            'admissionCirculars' => fn ($q) => $q->where('is_published', true),
        ]);

        $institute->increment('view_count');

        $meta = $seo->forInstitute($institute);

        return view('public.institutes.show', [
            'institute' => $institute,
            'seo' => $meta,
        ]);
    }
}
