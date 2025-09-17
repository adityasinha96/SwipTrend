<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\StoreCataloguDataRequest;
use App\Http\Requests\UpdateCataloguDataRequest;
use App\Http\Resources\Admin\CataloguDataResource;
use App\Models\CataloguData;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CataloguDataApiController extends Controller
{
    use MediaUploadingTrait;

    public function index()
    {
        abort_if(Gate::denies('catalogu_data_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new CataloguDataResource(CataloguData::with(['catalogue_category'])->get());
    }

    public function store(StoreCataloguDataRequest $request)
    {
        $cataloguData = CataloguData::create($request->all());

        if ($request->input('upload_brochure', false)) {
            $cataloguData->addMedia(storage_path('tmp/uploads/' . basename($request->input('upload_brochure'))))->toMediaCollection('upload_brochure');
        }

        if ($request->input('image', false)) {
            $cataloguData->addMedia(storage_path('tmp/uploads/' . basename($request->input('image'))))->toMediaCollection('image');
        }

        return (new CataloguDataResource($cataloguData))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(CataloguData $cataloguData)
    {
        abort_if(Gate::denies('catalogu_data_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new CataloguDataResource($cataloguData->load(['catalogue_category']));
    }

    public function update(UpdateCataloguDataRequest $request, CataloguData $cataloguData)
    {
        $cataloguData->update($request->all());

        if ($request->input('upload_brochure', false)) {
            if (! $cataloguData->upload_brochure || $request->input('upload_brochure') !== $cataloguData->upload_brochure->file_name) {
                if ($cataloguData->upload_brochure) {
                    $cataloguData->upload_brochure->delete();
                }
                $cataloguData->addMedia(storage_path('tmp/uploads/' . basename($request->input('upload_brochure'))))->toMediaCollection('upload_brochure');
            }
        } elseif ($cataloguData->upload_brochure) {
            $cataloguData->upload_brochure->delete();
        }

        if ($request->input('image', false)) {
            if (! $cataloguData->image || $request->input('image') !== $cataloguData->image->file_name) {
                if ($cataloguData->image) {
                    $cataloguData->image->delete();
                }
                $cataloguData->addMedia(storage_path('tmp/uploads/' . basename($request->input('image'))))->toMediaCollection('image');
            }
        } elseif ($cataloguData->image) {
            $cataloguData->image->delete();
        }

        return (new CataloguDataResource($cataloguData))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(CataloguData $cataloguData)
    {
        abort_if(Gate::denies('catalogu_data_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $cataloguData->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
