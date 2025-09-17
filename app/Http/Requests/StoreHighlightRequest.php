<?php

namespace App\Http\Requests;

use App\Models\Highlight;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreHighlightRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('highlight_create');
    }

    public function rules()
    {
        return [
            'service_name' => [
                'string',
                'required',
            ],
            'service_description' => [
                'string',
                'required',
            ],
            'image' => [
                'required',
            ],
        ];
    }
}
