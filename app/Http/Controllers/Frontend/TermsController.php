<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\TermsCondition;

class TermsController extends Controller
{
     public function show()
    {
        // You only allow one record in admin, so grab the latest (or null if none)
        $terms = TermsCondition::query()->latest('updated_at')->first();

        return view('terms', compact('terms'));
    }
}
