<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreCompanyDetailRequest;
use App\Http\Requests\UpdateCompanyDetailRequest;
use App\Http\Resources\Admin\CompanyDetailResource;
use App\Models\CompanyDetail;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CompanyDetailsApiController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('company_detail_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new CompanyDetailResource(CompanyDetail::all());
    }

    public function store(StoreCompanyDetailRequest $request)
    {
        $companyDetail = CompanyDetail::create($request->all());

        return (new CompanyDetailResource($companyDetail))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(CompanyDetail $companyDetail)
    {
        abort_if(Gate::denies('company_detail_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new CompanyDetailResource($companyDetail);
    }

    public function update(UpdateCompanyDetailRequest $request, CompanyDetail $companyDetail)
    {
        $companyDetail->update($request->all());

        return (new CompanyDetailResource($companyDetail))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(CompanyDetail $companyDetail)
    {
        abort_if(Gate::denies('company_detail_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $companyDetail->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
