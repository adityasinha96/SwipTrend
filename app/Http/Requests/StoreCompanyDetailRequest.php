<?php

namespace App\Http\Requests;

use App\Models\CompanyDetail;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreCompanyDetailRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('company_detail_create');
    }

    public function rules()
    {
        return [
            'company_name' => [
                'required',
            ],
            'gst_number' => [
                'string',
                'required',
            ],
            'company_phone_number' => [
                'string',
                'required',
            ],
            'other_phone_number' => [
                'string',
                'nullable',
            ],
            'google_map_link' => [
                'required',
            ],
            'email' => [
                'required',
            ],
            'other_email' => [
                'string',
                'nullable',
            ],
            'office_address' => [
                'required',
            ],
            'company_x_link' => [
                'string',
                'nullable',
            ],
        ];
    }
}
