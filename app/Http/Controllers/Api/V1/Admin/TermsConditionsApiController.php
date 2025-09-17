<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\StoreTermsConditionRequest;
use App\Http\Requests\UpdateTermsConditionRequest;
use App\Http\Resources\Admin\TermsConditionResource;
use App\Models\TermsCondition;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class TermsConditionsApiController extends Controller
{
    use MediaUploadingTrait;

    public function index()
    {
        abort_if(Gate::denies('terms_condition_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new TermsConditionResource(TermsCondition::all());
    }

    public function store(StoreTermsConditionRequest $request)
    {
        $termsCondition = TermsCondition::create($request->all());

        return (new TermsConditionResource($termsCondition))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(TermsCondition $termsCondition)
    {
        abort_if(Gate::denies('terms_condition_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new TermsConditionResource($termsCondition);
    }

    public function update(UpdateTermsConditionRequest $request, TermsCondition $termsCondition)
    {
        $termsCondition->update($request->all());

        return (new TermsConditionResource($termsCondition))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(TermsCondition $termsCondition)
    {
        abort_if(Gate::denies('terms_condition_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $termsCondition->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
