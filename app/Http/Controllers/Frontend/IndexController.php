<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Highlight;

class IndexController extends Controller
{
    public function index()
    {
        // Fetch highlights with their media
        $highlights = Highlight::with('media')->get();

        // You can fetch other homepage sections here too
        // e.g. $sliders = Slider::latest()->get();

        return view('index', compact('highlights'));
    }
}
