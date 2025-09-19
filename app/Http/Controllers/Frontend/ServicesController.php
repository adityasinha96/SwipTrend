<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\CoreService;

class ServicesController extends Controller
{
    public function index()
    {
        
        $services = CoreService::with('media')
            ->latest('id')
            ->get();

        return view('services', compact('services'));
    }
}
