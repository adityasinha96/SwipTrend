<?php

namespace App\Http\Requests;

use App\Models\CatalogueCategory;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreCatalogueCategoryRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('catalogue_category_create');
    }

    public function rules()
    {
        return [
            'category_icon' => [
                'string',
                'required',
            ],
            'category_name' => [
                'string',
                'required',
            ],
        ];
    }
}
