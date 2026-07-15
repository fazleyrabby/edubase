<?php

namespace App\Modules\Institute\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Modules\Institute\Models\Institute;
use App\Modules\Taxonomy\Models\Category;
use App\Modules\Taxonomy\Models\Curriculum;
use App\Modules\Taxonomy\Models\InstituteType;
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

    public function show(Institute $institute): View
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

        return view('public.institutes.show', ['institute' => $institute]);
    }
}
