<?php

namespace App\Http\Requests;

use App\Models\CataloguData;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreCataloguDataRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('catalogu_data_create');
    }

    public function rules()
    {
        return [
            'catalogue_category_id' => [
                'required',
                'integer',
            ],
            'name' => [
                'string',
                'required',
            ],
            'description' => [
                'required',
            ],
            'upload_brochure' => [
                'required',
            ],
            'image' => [
                'required',
            ],
        ];
    }
}
