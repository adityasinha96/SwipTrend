<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\MassDestroyCoreServiceRequest;
use App\Http\Requests\StoreCoreServiceRequest;
use App\Http\Requests\UpdateCoreServiceRequest;
use App\Models\CoreService;
use Gate;
use Illuminate\Http\Request;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class CoreServicesController extends Controller
{
    use MediaUploadingTrait;

    public function index(Request $request)
    {
        abort_if(Gate::denies('core_service_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = CoreService::query()->select(sprintf('%s.*', (new CoreService)->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate      = 'core_service_show';
                $editGate      = 'core_service_edit';
                $deleteGate    = 'core_service_delete';
                $crudRoutePart = 'core-services';

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
            $table->editColumn('service_name', function ($row) {
                return $row->service_name ? $row->service_name : '';
            });
            $table->editColumn('brochure', function ($row) {
                return $row->brochure ? '<a href="' . $row->brochure->getUrl() . '" target="_blank">' . trans('global.downloadFile') . '</a>' : '';
            });

            $table->rawColumns(['actions', 'placeholder', 'brochure']);

            return $table->make(true);
        }

        return view('admin.coreServices.index');
    }

    public function create()
    {
        abort_if(Gate::denies('core_service_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.coreServices.create');
    }

    public function store(StoreCoreServiceRequest $request)
    {
        $coreService = CoreService::create($request->all());

        if ($request->input('brochure', false)) {
            $coreService->addMedia(storage_path('tmp/uploads/' . basename($request->input('brochure'))))->toMediaCollection('brochure');
        }

        if ($media = $request->input('ck-media', false)) {
            Media::whereIn('id', $media)->update(['model_id' => $coreService->id]);
        }

        return redirect()->route('admin.core-services.index');
    }

    public function edit(CoreService $coreService)
    {
        abort_if(Gate::denies('core_service_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.coreServices.edit', compact('coreService'));
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

        return redirect()->route('admin.core-services.index');
    }

    public function show(CoreService $coreService)
    {
        abort_if(Gate::denies('core_service_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.coreServices.show', compact('coreService'));
    }

    public function destroy(CoreService $coreService)
    {
        abort_if(Gate::denies('core_service_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $coreService->delete();

        return back();
    }

    public function massDestroy(MassDestroyCoreServiceRequest $request)
    {
        $coreServices = CoreService::find(request('ids'));

        foreach ($coreServices as $coreService) {
            $coreService->delete();
        }

        return response(null, Response::HTTP_NO_CONTENT);
    }

    public function storeCKEditorImages(Request $request)
    {
        abort_if(Gate::denies('core_service_create') && Gate::denies('core_service_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $model         = new CoreService();
        $model->id     = $request->input('crud_id', 0);
        $model->exists = true;
        $media         = $model->addMediaFromRequest('upload')->toMediaCollection('ck-media');

        return response()->json(['id' => $media->id, 'url' => $media->getUrl()], Response::HTTP_CREATED);
    }
}
