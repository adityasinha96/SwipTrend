<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyQuickServiceRequestRequest;
use App\Http\Requests\StoreQuickServiceRequestRequest;
use App\Http\Requests\UpdateQuickServiceRequestRequest;
use App\Models\QuickServiceRequest;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class QuickServiceRequestController extends Controller
{
    public function index(Request $request)
    {
        abort_if(Gate::denies('quick_service_request_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = QuickServiceRequest::query()->select(sprintf('%s.*', (new QuickServiceRequest)->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate      = 'quick_service_request_show';
                $editGate      = 'quick_service_request_edit';
                $deleteGate    = 'quick_service_request_delete';
                $crudRoutePart = 'quick-service-requests';

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
            $table->editColumn('full_name', function ($row) {
                return $row->full_name ? $row->full_name : '';
            });
            $table->editColumn('phone_number', function ($row) {
                return $row->phone_number ? $row->phone_number : '';
            });
            $table->editColumn('city_area', function ($row) {
                return $row->city_area ? $row->city_area : '';
            });
            $table->editColumn('service_needed', function ($row) {
                return $row->service_needed ? $row->service_needed : '';
            });
            $table->editColumn('message', function ($row) {
                return $row->message ? $row->message : '';
            });

            $table->rawColumns(['actions', 'placeholder']);

            return $table->make(true);
        }

        return view('admin.quickServiceRequests.index');
    }

    public function create()
    {
        abort_if(Gate::denies('quick_service_request_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.quickServiceRequests.create');
    }

    public function store(StoreQuickServiceRequestRequest $request)
    {
        $quickServiceRequest = QuickServiceRequest::create($request->all());

        return redirect()->route('admin.quick-service-requests.index');
    }

    public function edit(QuickServiceRequest $quickServiceRequest)
    {
        abort_if(Gate::denies('quick_service_request_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.quickServiceRequests.edit', compact('quickServiceRequest'));
    }

    public function update(UpdateQuickServiceRequestRequest $request, QuickServiceRequest $quickServiceRequest)
    {
        $quickServiceRequest->update($request->all());

        return redirect()->route('admin.quick-service-requests.index');
    }

    public function show(QuickServiceRequest $quickServiceRequest)
    {
        abort_if(Gate::denies('quick_service_request_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.quickServiceRequests.show', compact('quickServiceRequest'));
    }

    public function destroy(QuickServiceRequest $quickServiceRequest)
    {
        abort_if(Gate::denies('quick_service_request_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $quickServiceRequest->delete();

        return back();
    }

    public function massDestroy(MassDestroyQuickServiceRequestRequest $request)
    {
        $quickServiceRequests = QuickServiceRequest::find(request('ids'));

        foreach ($quickServiceRequests as $quickServiceRequest) {
            $quickServiceRequest->delete();
        }

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
