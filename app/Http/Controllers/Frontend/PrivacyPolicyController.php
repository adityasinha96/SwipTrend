<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\PrivacyPolicy;

class PrivacyPolicyController extends Controller
{
    public function show()
    {
        // You only allow one record in admin, so grab the latest (or null if none)
        $policy = PrivacyPolicy::query()->latest('updated_at')->first();

        return view('privacy_policy', compact('policy'));
    }
}
