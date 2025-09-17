<?php

namespace App\Http\Requests;

use App\Models\TermsCondition;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdateTermsConditionRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('terms_condition_edit');
    }

    public function rules()
    {
        return [
            'title' => [
                'string',
                'required',
            ],
            'description' => [
                'required',
            ],
        ];
    }
}
