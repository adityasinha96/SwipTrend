<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\MassDestroyCataloguDataRequest;
use App\Http\Requests\StoreCataloguDataRequest;
use App\Http\Requests\UpdateCataloguDataRequest;
use App\Models\CataloguData;
use App\Models\CatalogueCategory;
use Gate;
use Illuminate\Http\Request;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class CataloguDataController extends Controller
{
    use MediaUploadingTrait;

    public function index(Request $request)
    {
        abort_if(Gate::denies('catalogu_data_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = CataloguData::with(['catalogue_category'])->select(sprintf('%s.*', (new CataloguData)->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate      = 'catalogu_data_show';
                $editGate      = 'catalogu_data_edit';
                $deleteGate    = 'catalogu_data_delete';
                $crudRoutePart = 'catalogu-datas';

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
            $table->addColumn('catalogue_category_category_name', function ($row) {
                return $row->catalogue_category ? $row->catalogue_category->category_name : '';
            });

            $table->editColumn('name', function ($row) {
                return $row->name ? $row->name : '';
            });
            $table->editColumn('upload_brochure', function ($row) {
                return $row->upload_brochure ? '<a href="' . $row->upload_brochure->getUrl() . '" target="_blank">' . trans('global.downloadFile') . '</a>' : '';
            });
            $table->editColumn('image', function ($row) {
                if ($photo = $row->image) {
                    return sprintf(
                        '<a href="%s" target="_blank"><img src="%s" width="50px" height="50px"></a>',
                        $photo->url,
                        $photo->thumbnail
                    );
                }

                return '';
            });

            $table->rawColumns(['actions', 'placeholder', 'catalogue_category', 'upload_brochure', 'image']);

            return $table->make(true);
        }

        return view('admin.cataloguDatas.index');
    }

    public function create()
    {
        abort_if(Gate::denies('catalogu_data_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $catalogue_categories = CatalogueCategory::pluck('category_name', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.cataloguDatas.create', compact('catalogue_categories'));
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

        if ($media = $request->input('ck-media', false)) {
            Media::whereIn('id', $media)->update(['model_id' => $cataloguData->id]);
        }

        return redirect()->route('admin.catalogu-datas.index');
    }

    public function edit(CataloguData $cataloguData)
    {
        abort_if(Gate::denies('catalogu_data_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $catalogue_categories = CatalogueCategory::pluck('category_name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $cataloguData->load('catalogue_category');

        return view('admin.cataloguDatas.edit', compact('cataloguData', 'catalogue_categories'));
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

        return redirect()->route('admin.catalogu-datas.index');
    }

    public function show(CataloguData $cataloguData)
    {
        abort_if(Gate::denies('catalogu_data_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $cataloguData->load('catalogue_category');

        return view('admin.cataloguDatas.show', compact('cataloguData'));
    }

    public function destroy(CataloguData $cataloguData)
    {
        abort_if(Gate::denies('catalogu_data_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $cataloguData->delete();

        return back();
    }

    public function massDestroy(MassDestroyCataloguDataRequest $request)
    {
        $cataloguDatas = CataloguData::find(request('ids'));

        foreach ($cataloguDatas as $cataloguData) {
            $cataloguData->delete();
        }

        return response(null, Response::HTTP_NO_CONTENT);
    }

    public function storeCKEditorImages(Request $request)
    {
        abort_if(Gate::denies('catalogu_data_create') && Gate::denies('catalogu_data_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $model         = new CataloguData();
        $model->id     = $request->input('crud_id', 0);
        $model->exists = true;
        $media         = $model->addMediaFromRequest('upload')->toMediaCollection('ck-media');

        return response()->json(['id' => $media->id, 'url' => $media->getUrl()], Response::HTTP_CREATED);
    }
}
