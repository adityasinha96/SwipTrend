<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\MassDestroyPrivacyPolicyRequest;
use App\Http\Requests\StorePrivacyPolicyRequest;
use App\Http\Requests\UpdatePrivacyPolicyRequest;
use App\Models\PrivacyPolicy;
use Gate;
use Illuminate\Http\Request;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class PrivacyPolicyController extends Controller
{
    use MediaUploadingTrait;

    public function index(Request $request)
    {
        abort_if(Gate::denies('privacy_policy_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = PrivacyPolicy::query()->select(sprintf('%s.*', (new PrivacyPolicy)->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate      = 'privacy_policy_show';
                $editGate      = 'privacy_policy_edit';
                $deleteGate    = 'privacy_policy_delete';
                $crudRoutePart = 'privacy-policies';

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

        return view('admin.privacyPolicies.index');
    }

    public function create()
    {
        abort_if(Gate::denies('privacy_policy_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.privacyPolicies.create');
    }

    public function store(StorePrivacyPolicyRequest $request)
    {
        $privacyPolicy = PrivacyPolicy::create($request->all());

        if ($media = $request->input('ck-media', false)) {
            Media::whereIn('id', $media)->update(['model_id' => $privacyPolicy->id]);
        }

        return redirect()->route('admin.privacy-policies.index');
    }

    public function edit(PrivacyPolicy $privacyPolicy)
    {
        abort_if(Gate::denies('privacy_policy_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.privacyPolicies.edit', compact('privacyPolicy'));
    }

    public function update(UpdatePrivacyPolicyRequest $request, PrivacyPolicy $privacyPolicy)
    {
        $privacyPolicy->update($request->all());

        return redirect()->route('admin.privacy-policies.index');
    }

    public function show(PrivacyPolicy $privacyPolicy)
    {
        abort_if(Gate::denies('privacy_policy_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.privacyPolicies.show', compact('privacyPolicy'));
    }

    public function destroy(PrivacyPolicy $privacyPolicy)
    {
        abort_if(Gate::denies('privacy_policy_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $privacyPolicy->delete();

        return back();
    }

    public function massDestroy(MassDestroyPrivacyPolicyRequest $request)
    {
        $privacyPolicies = PrivacyPolicy::find(request('ids'));

        foreach ($privacyPolicies as $privacyPolicy) {
            $privacyPolicy->delete();
        }

        return response(null, Response::HTTP_NO_CONTENT);
    }

    public function storeCKEditorImages(Request $request)
    {
        abort_if(Gate::denies('privacy_policy_create') && Gate::denies('privacy_policy_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $model         = new PrivacyPolicy();
        $model->id     = $request->input('crud_id', 0);
        $model->exists = true;
        $media         = $model->addMediaFromRequest('upload')->toMediaCollection('ck-media');

        return response()->json(['id' => $media->id, 'url' => $media->getUrl()], Response::HTTP_CREATED);
    }
}
