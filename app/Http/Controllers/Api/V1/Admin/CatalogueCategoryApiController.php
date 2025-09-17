<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreCatalogueCategoryRequest;
use App\Http\Requests\UpdateCatalogueCategoryRequest;
use App\Http\Resources\Admin\CatalogueCategoryResource;
use App\Models\CatalogueCategory;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CatalogueCategoryApiController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('catalogue_category_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new CatalogueCategoryResource(CatalogueCategory::all());
    }

    public function store(StoreCatalogueCategoryRequest $request)
    {
        $catalogueCategory = CatalogueCategory::create($request->all());

        return (new CatalogueCategoryResource($catalogueCategory))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(CatalogueCategory $catalogueCategory)
    {
        abort_if(Gate::denies('catalogue_category_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new CatalogueCategoryResource($catalogueCategory);
    }

    public function update(UpdateCatalogueCategoryRequest $request, CatalogueCategory $catalogueCategory)
    {
        $catalogueCategory->update($request->all());

        return (new CatalogueCategoryResource($catalogueCategory))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(CatalogueCategory $catalogueCategory)
    {
        abort_if(Gate::denies('catalogue_category_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $catalogueCategory->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
