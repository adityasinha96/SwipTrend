<?php

namespace App\Http\Requests;

use App\Models\QuickServiceRequest;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreQuickServiceRequestRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('quick_service_request_create');
    }

    public function rules()
    {
        return [
            'full_name' => [
                'string',
                'required',
            ],
            'phone_number' => [
                'string',
                'required',
            ],
            'city_area' => [
                'string',
                'required',
            ],
            'service_needed' => [
                'string',
                'required',
            ],
        ];
    }
}
