<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\MassDestroyHighlightRequest;
use App\Http\Requests\StoreHighlightRequest;
use App\Http\Requests\UpdateHighlightRequest;
use App\Models\Highlight;
use Gate;
use Illuminate\Http\Request;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class HighlightsController extends Controller
{
    use MediaUploadingTrait;

    public function index(Request $request)
    {
        abort_if(Gate::denies('highlight_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = Highlight::query()->select(sprintf('%s.*', (new Highlight)->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate      = 'highlight_show';
                $editGate      = 'highlight_edit';
                $deleteGate    = 'highlight_delete';
                $crudRoutePart = 'highlights';

                return view('partials.datatablesActions', compact(
                    'viewGate', 'editGate', 'deleteGate', 'crudRoutePart', 'row'
                ));
            });

            $table->editColumn('id', fn($row) => $row->id ?: '');
            $table->editColumn('service_name', fn($row) => $row->service_name ?: '');
            $table->editColumn('service_description', fn($row) => $row->service_description ?: '');
            $table->editColumn('image', function ($row) {
                if ($photo = $row->image) {
                    return sprintf(
                        '<a href="%s" target="_blank"><img src="%s" width="50" height="50"></a>',
                        $photo->url, $photo->thumbnail
                    );
                }
                return '';
            });

            $table->rawColumns(['actions', 'placeholder', 'image']);

            return $table->make(true);
        }

        $currentCount = Highlight::count();
        return view('admin.highlights.index', compact('currentCount'));
    }


    public function create(Request $request)
    {
        abort_if(Gate::denies('highlight_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $highlight = new Highlight();
            return view('admin.highlights._form', [
                'highlight' => $highlight,
                'mode' => 'create'
            ]);
        }

        return view('admin.highlights.create'); // fallback (optional)
    }

    public function store(StoreHighlightRequest $request)
    {
        if (Highlight::count() >= 4) {
            $msg = 'You can only have up to 4 highlights.';
            if ($request->ajax()) {
                return response()->json(['message' => $msg], 422);
            }
            return back()->withErrors(['image' => $msg])->withInput();
        }

        $highlight = Highlight::create($request->all());

        if ($request->input('image', false)) {
            $highlight->addMedia(storage_path('tmp/uploads/' . basename($request->input('image'))))
                ->toMediaCollection('image');
        }

        if ($media = $request->input('ck-media', false)) {
            Media::whereIn('id', $media)->update(['model_id' => $highlight->id]);
        }

        if ($request->ajax()) {
            return response()->json(['message' => 'Created', 'id' => $highlight->id]);
        }

        return redirect()->route('admin.highlights.index');
    }

    public function edit(Request $request, Highlight $highlight)
    {
        abort_if(Gate::denies('highlight_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            return view('admin.highlights._form', [
                'highlight' => $highlight,
                'mode' => 'edit'
            ]);
        }

        return view('admin.highlights.edit', compact('highlight')); // fallback (optional)
    }

    public function update(UpdateHighlightRequest $request, Highlight $highlight)
    {
        $highlight->update($request->all());

        if ($request->input('image', false)) {
            if (!$highlight->image || $request->input('image') !== $highlight->image->file_name) {
                if ($highlight->image) {
                    $highlight->image->delete();
                }
                $highlight->addMedia(storage_path('tmp/uploads/' . basename($request->input('image'))))
                    ->toMediaCollection('image');
            }
        } elseif ($highlight->image) {
            $highlight->image->delete();
        }

        if ($request->ajax()) {
            return response()->json(['message' => 'Updated']);
        }

        return redirect()->route('admin.highlights.index');
    }

    public function show(Highlight $highlight)
    {
        abort_if(Gate::denies('highlight_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.highlights.show', compact('highlight'));
    }

    public function destroy(Highlight $highlight)
    {
        abort_if(Gate::denies('highlight_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $highlight->delete();

        return back();
    }

    public function massDestroy(MassDestroyHighlightRequest $request)
    {
        $highlights = Highlight::find(request('ids'));

        foreach ($highlights as $highlight) {
            $highlight->delete();
        }

        return response(null, Response::HTTP_NO_CONTENT);
    }

    public function storeCKEditorImages(Request $request)
    {
        abort_if(Gate::denies('highlight_create') && Gate::denies('highlight_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $model         = new Highlight();
        $model->id     = $request->input('crud_id', 0);
        $model->exists = true;
        $media         = $model->addMediaFromRequest('upload')->toMediaCollection('ck-media');

        return response()->json(['id' => $media->id, 'url' => $media->getUrl()], Response::HTTP_CREATED);
    }
}
