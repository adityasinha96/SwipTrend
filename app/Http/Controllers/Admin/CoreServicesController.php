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
use Illuminate\Support\Facades\Log;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class CoreServicesController extends Controller
{
    use MediaUploadingTrait;

    public function index(Request $request)
    {
        abort_if(Gate::denies('core_service_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax() && $request->has('draw')) {
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

            $table->editColumn('id', fn ($row) => $row->id ?: '');
            $table->editColumn('service_name', fn ($row) => $row->service_name ?: '');

            // Image thumbnail column
            $table->addColumn('image', function ($row) {
                $img = $row->getMedia('image')->last();
                if ($img) {
                    $src = $img->getUrl('thumb');
                    return '<img src="'.$src.'" alt="img" width="50" height="50" class="rounded">';
                }
                return '';
            });

            // Brochure link column
            $table->editColumn('brochure', function ($row) {
                $file = $row->getMedia('brochure')->last();
                return $file
                    ? '<a href="'.$file->getUrl().'" target="_blank">'.trans('global.downloadFile').'</a>'
                    : '';
            });

            $table->rawColumns(['actions', 'placeholder', 'image', 'brochure']);

            return $table->make(true);
        }

        return view('admin.coreServices.index');
    }

    public function create()
    {
        abort_if(Gate::denies('core_service_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if (request()->ajax()) {
            $coreService = null;
            return view('admin.coreServices._form', compact('coreService'));
        }

        return view('admin.coreServices.create');
    }

    public function store(StoreCoreServiceRequest $request)
    {
        try {
            $coreService = CoreService::create($request->all());

            // Image
            if ($request->input('image', false)) {
                $coreService->addMedia(storage_path('tmp/uploads/' . basename($request->input('image'))))
                    ->toMediaCollection('image');
            }

            // Brochure
            if ($request->input('brochure', false)) {
                $coreService->addMedia(storage_path('tmp/uploads/' . basename($request->input('brochure'))))
                    ->toMediaCollection('brochure');
            }

            if ($media = $request->input('ck-media', false)) {
                Media::whereIn('id', $media)->update(['model_id' => $coreService->id]);
            }

            if ($request->ajax() || $request->wantsJson()) {
                return response()->json(['ok' => true, 'id' => $coreService->id], 200);
            }

            return redirect()->route('core-services.index');

        } catch (\Throwable $e) {
            Log::error('CoreService STORE failed', [
                'message' => $e->getMessage(),
                'line'    => $e->getLine(),
                'file'    => $e->getFile(),
                'trace'   => substr($e->getTraceAsString(), 0, 2000),
                'payload' => $request->all(),
            ]);

            if ($request->ajax() || $request->wantsJson()) {
                return response()->json([
                    'message' => 'Failed to create Core Service',
                    'error'   => $e->getMessage(),
                ], 500);
            }

            abort(500, 'Failed to create Core Service');
        }
    }

    public function edit(CoreService $coreService)
    {
        abort_if(Gate::denies('core_service_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if (request()->ajax()) {
            return view('admin.coreServices._form', compact('coreService'));
        }

        return view('admin.coreServices.edit', compact('coreService'));
    }

    public function update(UpdateCoreServiceRequest $request, CoreService $coreService)
    {
        try {
            $coreService->update($request->all());

            // Image
            if ($request->input('image', false)) {
                $existing = $coreService->getMedia('image')->last();
                if (! $existing || $request->input('image') !== $existing->file_name) {
                    if ($existing) {
                        $existing->delete();
                    }
                    $coreService->addMedia(storage_path('tmp/uploads/' . basename($request->input('image'))))
                        ->toMediaCollection('image');
                }
            } else {
                $existing = $coreService->getMedia('image')->last();
                if ($existing) {
                    $existing->delete();
                }
            }

            // Brochure
            if ($request->input('brochure', false)) {
                $existing = $coreService->getMedia('brochure')->last();
                if (! $existing || $request->input('brochure') !== $existing->file_name) {
                    if ($existing) {
                        $existing->delete();
                    }
                    $coreService->addMedia(storage_path('tmp/uploads/' . basename($request->input('brochure'))))
                        ->toMediaCollection('brochure');
                }
            } else {
                $existing = $coreService->getMedia('brochure')->last();
                if ($existing) {
                    $existing->delete();
                }
            }

            if ($request->ajax() || $request->wantsJson()) {
                return response()->json(['ok' => true, 'id' => $coreService->id], 200);
            }

            return redirect()->route('core-services.index');

        } catch (\Throwable $e) {
            Log::error('CoreService UPDATE failed', [
                'message' => $e->getMessage(),
                'line'    => $e->getLine(),
                'file'    => $e->getFile(),
                'trace'   => substr($e->getTraceAsString(), 0, 2000),
                'payload' => $request->all(),
                'id'      => $coreService->id,
            ]);

            if ($request->ajax() || $request->wantsJson()) {
                return response()->json([
                    'message' => 'Failed to update Core Service',
                    'error'   => $e->getMessage(),
                ], 500);
            }

            abort(500, 'Failed to update Core Service');
        }
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
