<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\CatalogueCategory;

class CatalogueController extends Controller
{
    public function index()
    {
        // Eager load catalogue items + media so the view is fast
        $categories = CatalogueCategory::with(['cataloguDatas.media'])
            ->orderBy('category_name')
            ->get();

        // Optional flat list if you need it for search, etc.
        $allItems = $categories->flatMap->cataloguDatas;

        return view('catalogue', compact('categories', 'allItems'));
    }
}
