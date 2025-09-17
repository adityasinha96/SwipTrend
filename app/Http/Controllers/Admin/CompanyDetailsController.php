<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyCompanyDetailRequest;
use App\Http\Requests\StoreCompanyDetailRequest;
use App\Http\Requests\UpdateCompanyDetailRequest;
use App\Models\CompanyDetail;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class CompanyDetailsController extends Controller
{
    public function index(Request $request)
    {
        abort_if(Gate::denies('company_detail_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = CompanyDetail::query()->select(sprintf('%s.*', (new CompanyDetail)->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate      = 'company_detail_show';
                $editGate      = 'company_detail_edit';
                $deleteGate    = 'company_detail_delete';
                $crudRoutePart = 'company-details';

                return view('partials.datatablesActions', compact(
                    'viewGate',
                    'editGate',
                    'deleteGate',
                    'crudRoutePart',
                    'row'
                ));
            });

            $table->editColumn('id', function ($row) {
                return $row->id ? $row->id : '';
            });
            $table->editColumn('company_name', function ($row) {
                return $row->company_name ? $row->company_name : '';
            });
            $table->editColumn('gst_number', function ($row) {
                return $row->gst_number ? $row->gst_number : '';
            });
            $table->editColumn('company_phone_number', function ($row) {
                return $row->company_phone_number ? $row->company_phone_number : '';
            });
            $table->editColumn('other_phone_number', function ($row) {
                return $row->other_phone_number ? $row->other_phone_number : '';
            });
            $table->editColumn('google_map_link', function ($row) {
                return $row->google_map_link ? $row->google_map_link : '';
            });
            $table->editColumn('email', function ($row) {
                return $row->email ? $row->email : '';
            });
            $table->editColumn('other_email', function ($row) {
                return $row->other_email ? $row->other_email : '';
            });
            $table->editColumn('office_address', function ($row) {
                return $row->office_address ? $row->office_address : '';
            });
            $table->editColumn('company_facebook_link', function ($row) {
                return $row->company_facebook_link ? $row->company_facebook_link : '';
            });
            $table->editColumn('comapnay_instagram_link', function ($row) {
                return $row->comapnay_instagram_link ? $row->comapnay_instagram_link : '';
            });
            $table->editColumn('company_linkedin_link', function ($row) {
                return $row->company_linkedin_link ? $row->company_linkedin_link : '';
            });
            $table->editColumn('company_youtube_link', function ($row) {
                return $row->company_youtube_link ? $row->company_youtube_link : '';
            });
            $table->editColumn('company_x_link', function ($row) {
                return $row->company_x_link ? $row->company_x_link : '';
            });

            $table->rawColumns(['actions', 'placeholder']);

            return $table->make(true);
        }

        return view('admin.companyDetails.index');
    }

    public function create()
    {
        abort_if(Gate::denies('company_detail_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.companyDetails.create');
    }

    public function store(StoreCompanyDetailRequest $request)
    {
        $companyDetail = CompanyDetail::create($request->all());

        return redirect()->route('admin.company-details.index');
    }

    public function edit(CompanyDetail $companyDetail)
    {
        abort_if(Gate::denies('company_detail_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.companyDetails.edit', compact('companyDetail'));
    }

    public function update(UpdateCompanyDetailRequest $request, CompanyDetail $companyDetail)
    {
        $companyDetail->update($request->all());

        return redirect()->route('admin.company-details.index');
    }

    public function show(CompanyDetail $companyDetail)
    {
        abort_if(Gate::denies('company_detail_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.companyDetails.show', compact('companyDetail'));
    }

    public function destroy(CompanyDetail $companyDetail)
    {
        abort_if(Gate::denies('company_detail_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $companyDetail->delete();

        return back();
    }

    public function massDestroy(MassDestroyCompanyDetailRequest $request)
    {
        $companyDetails = CompanyDetail::find(request('ids'));

        foreach ($companyDetails as $companyDetail) {
            $companyDetail->delete();
        }

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
