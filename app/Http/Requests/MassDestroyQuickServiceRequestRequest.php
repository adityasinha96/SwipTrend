<?php

namespace App\Http\Requests;

use App\Models\QuickServiceRequest;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class MassDestroyQuickServiceRequestRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('quick_service_request_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;
    }

    public function rules()
    {
        return [
            'ids'   => 'required|array',
            'ids.*' => 'exists:quick_service_requests,id',
        ];
    }
}
