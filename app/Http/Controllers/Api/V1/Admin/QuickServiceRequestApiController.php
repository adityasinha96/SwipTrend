<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreQuickServiceRequestRequest;
use App\Http\Requests\UpdateQuickServiceRequestRequest;
use App\Http\Resources\Admin\QuickServiceRequestResource;
use App\Models\QuickServiceRequest;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class QuickServiceRequestApiController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('quick_service_request_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new QuickServiceRequestResource(QuickServiceRequest::all());
    }

    public function store(StoreQuickServiceRequestRequest $request)
    {
        $quickServiceRequest = QuickServiceRequest::create($request->all());

        return (new QuickServiceRequestResource($quickServiceRequest))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(QuickServiceRequest $quickServiceRequest)
    {
        abort_if(Gate::denies('quick_service_request_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new QuickServiceRequestResource($quickServiceRequest);
    }

    public function update(UpdateQuickServiceRequestRequest $request, QuickServiceRequest $quickServiceRequest)
    {
        $quickServiceRequest->update($request->all());

        return (new QuickServiceRequestResource($quickServiceRequest))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(QuickServiceRequest $quickServiceRequest)
    {
        abort_if(Gate::denies('quick_service_request_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $quickServiceRequest->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
