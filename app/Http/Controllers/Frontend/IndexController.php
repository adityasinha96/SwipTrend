<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Highlight;
use App\Models\CoreService;

class IndexController extends Controller
{
    public function index()
    {
        // Highlights (if you already show them on the homepage)
        $highlights = Highlight::with('media')->get();

        // Core services for the homepage section (limit to 6; tweak as needed)
        $services = CoreService::with('media')
            ->latest('id')
            ->take(6)
            ->get();

        return view('index', compact('highlights', 'services'));
    }
}
