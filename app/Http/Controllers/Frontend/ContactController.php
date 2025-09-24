<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\CompanyDetail;

class ContactController extends Controller
{
    public function show()
    {
        $company = CompanyDetail::first();

        $mapLink   = null;
        $mapEmbed  = null;

        if ($company) {
            $mapRaw   = $company->google_map_link;
            $address  = $company->office_address;

            if ($mapRaw) {
                $mapLink  = $mapRaw;
                $mapEmbed = str_contains($mapRaw, 'embed')
                    ? $mapRaw
                    : 'https://www.google.com/maps?q=' . urlencode($mapRaw) . '&output=embed';
            } elseif ($address) {
                $mapLink  = 'https://maps.google.com/?q=' . urlencode($address);
                $mapEmbed = 'https://www.google.com/maps?q=' . urlencode($address) . '&output=embed';
            }
        }

        return view('contact', compact('company', 'mapLink', 'mapEmbed'));
    }
}
