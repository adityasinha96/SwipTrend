<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\StoreCoreServiceRequest;
use App\Http\Requests\UpdateCoreServiceRequest;
use App\Http\Resources\Admin\CoreServiceResource;
use App\Models\CoreService;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CoreServicesApiController extends Controller
{
    use MediaUploadingTrait;

    public function index()
    {
        abort_if(Gate::denies('core_service_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new CoreServiceResource(CoreService::all());
    }

    public function store(StoreCoreServiceRequest $request)
    {
        $coreService = CoreService::create($request->all());

        if ($request->input('brochure', false)) {
            $coreService->addMedia(storage_path('tmp/uploads/' . basename($request->input('brochure'))))->toMediaCollection('brochure');
        }

        return (new CoreServiceResource($coreService))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(CoreService $coreService)
    {
        abort_if(Gate::denies('core_service_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new CoreServiceResource($coreService);
    }

    public function update(UpdateCoreServiceRequest $request, CoreService $coreService)
    {
        $coreService->update($request->all());

        if ($request->input('brochure', false)) {
            if (! $coreService->brochure || $request->input('brochure') !== $coreService->brochure->file_name) {
                if ($coreService->brochure) {
                    $coreService->brochure->delete();
                }
                $coreService->addMedia(storage_path('tmp/uploads/' . basename($request->input('brochure'))))->toMediaCollection('brochure');
            }
        } elseif ($coreService->brochure) {
            $coreService->brochure->delete();
        }

        return (new CoreServiceResource($coreService))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(CoreService $coreService)
    {
        abort_if(Gate::denies('core_service_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $coreService->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
