<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\MassDestroyTermsConditionRequest;
use App\Http\Requests\StoreTermsConditionRequest;
use App\Http\Requests\UpdateTermsConditionRequest;
use App\Models\TermsCondition;
use Gate;
use Illuminate\Http\Request;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class TermsConditionsController extends Controller
{
    use MediaUploadingTrait;

    public function index(Request $request)
    {
        abort_if(Gate::denies('terms_condition_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = TermsCondition::query()->select(sprintf('%s.*', (new TermsCondition)->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate      = 'terms_condition_show';
                $editGate      = 'terms_condition_edit';
                $deleteGate    = 'terms_condition_delete';
                $crudRoutePart = 'terms-conditions';

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
            $table->editColumn('title', function ($row) {
                return $row->title ? $row->title : '';
            });

            $table->rawColumns(['actions', 'placeholder']);

            return $table->make(true);
        }

        return view('admin.termsConditions.index');
    }

    public function create()
    {
        abort_if(Gate::denies('terms_condition_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.termsConditions.create');
    }

    public function store(StoreTermsConditionRequest $request)
    {
        $termsCondition = TermsCondition::create($request->all());

        if ($media = $request->input('ck-media', false)) {
            Media::whereIn('id', $media)->update(['model_id' => $termsCondition->id]);
        }

        return redirect()->route('admin.terms-conditions.index');
    }

    public function edit(TermsCondition $termsCondition)
    {
        abort_if(Gate::denies('terms_condition_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.termsConditions.edit', compact('termsCondition'));
    }

    public function update(UpdateTermsConditionRequest $request, TermsCondition $termsCondition)
    {
        $termsCondition->update($request->all());

        return redirect()->route('admin.terms-conditions.index');
    }

    public function show(TermsCondition $termsCondition)
    {
        abort_if(Gate::denies('terms_condition_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.termsConditions.show', compact('termsCondition'));
    }

    public function destroy(TermsCondition $termsCondition)
    {
        abort_if(Gate::denies('terms_condition_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $termsCondition->delete();

        return back();
    }

    public function massDestroy(MassDestroyTermsConditionRequest $request)
    {
        $termsConditions = TermsCondition::find(request('ids'));

        foreach ($termsConditions as $termsCondition) {
            $termsCondition->delete();
        }

        return response(null, Response::HTTP_NO_CONTENT);
    }

    public function storeCKEditorImages(Request $request)
    {
        abort_if(Gate::denies('terms_condition_create') && Gate::denies('terms_condition_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $model         = new TermsCondition();
        $model->id     = $request->input('crud_id', 0);
        $model->exists = true;
        $media         = $model->addMediaFromRequest('upload')->toMediaCollection('ck-media');

        return response()->json(['id' => $media->id, 'url' => $media->getUrl()], Response::HTTP_CREATED);
    }
}
