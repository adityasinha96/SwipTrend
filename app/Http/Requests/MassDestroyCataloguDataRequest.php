<?php

namespace App\Http\Requests;

use App\Models\CataloguData;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class MassDestroyCataloguDataRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('catalogu_data_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;
    }

    public function rules()
    {
        return [
            'ids'   => 'required|array',
            'ids.*' => 'exists:catalogu_datas,id',
        ];
    }
}
