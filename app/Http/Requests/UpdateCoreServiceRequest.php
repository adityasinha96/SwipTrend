<?php

namespace App\Http\Requests;

use App\Models\CoreService;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdateCoreServiceRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('core_service_edit');
    }

    public function rules()
    {
        return [
            'service_name' => [
                'string',
                'required',
            ],
            'description' => [
                'required',
            ],
        ];
    }
}
