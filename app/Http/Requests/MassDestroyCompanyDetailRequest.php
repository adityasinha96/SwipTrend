<?php

namespace App\Http\Requests;

use App\Models\CompanyDetail;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class MassDestroyCompanyDetailRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('company_detail_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;
    }

    public function rules()
    {
        return [
            'ids'   => 'required|array',
            'ids.*' => 'exists:company_details,id',
        ];
    }
}
