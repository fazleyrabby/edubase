<?php

namespace App\Modules\Search\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Modules\Search\Services\SearchService;
use Illuminate\Http\Request;
use Illuminate\View\View;

class SearchController extends Controller
{
    public function __construct(
        private SearchService $searchService,
    ) {}

    public function __invoke(Request $request): View
    {
        $query = $request->get('q');
        $type = $request->get('type');
        $district = $request->get('district');
        $gender = $request->get('gender');

        $results = collect();

        if ($query) {
            $filters = array_filter(compact('type', 'district', 'gender'));
            $builder = $this->searchService->search($query, $filters, 20);
            $results = $builder->paginate(20);
        }

        return view('public.search', [
            'query' => $query,
            'results' => $results,
        ]);
    }

    public function autocomplete(Request $request): array
    {
        $query = $request->get('q', '');

        if (strlen($query) < 2) {
            return [];
        }

        return $this->searchService->autocomplete($query);
    }
}
