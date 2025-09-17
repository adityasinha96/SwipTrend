<?php

namespace App\Http\Requests;

use App\Models\Highlight;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class MassDestroyHighlightRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('highlight_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;
    }

    public function rules()
    {
        return [
            'ids'   => 'required|array',
            'ids.*' => 'exists:highlights,id',
        ];
    }
}
