<?php

namespace App\Modules\Taxonomy\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Modules\Institute\Models\Institute;
use App\Modules\Taxonomy\Models\Category;
use Illuminate\View\View;

class TaxonomyPublicController extends Controller
{
    public function category(Category $category): View
    {
        $institutes = Institute::published()
            ->where('primary_category_id', $category->id)
            ->orWhereHas('categories', fn ($q) => $q->where('category_id', $category->id))
            ->with(['type', 'district'])
            ->latest('published_at')
            ->paginate(20);

        return view('public.taxonomies.category', compact('category', 'institutes'));
    }
}
