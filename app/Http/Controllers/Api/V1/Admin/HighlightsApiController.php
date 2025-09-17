<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\StoreHighlightRequest;
use App\Http\Requests\UpdateHighlightRequest;
use App\Http\Resources\Admin\HighlightResource;
use App\Models\Highlight;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class HighlightsApiController extends Controller
{
    use MediaUploadingTrait;

    public function index()
    {
        abort_if(Gate::denies('highlight_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new HighlightResource(Highlight::all());
    }

    public function store(StoreHighlightRequest $request)
    {
        $highlight = Highlight::create($request->all());

        if ($request->input('image', false)) {
            $highlight->addMedia(storage_path('tmp/uploads/' . basename($request->input('image'))))->toMediaCollection('image');
        }

        return (new HighlightResource($highlight))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(Highlight $highlight)
    {
        abort_if(Gate::denies('highlight_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new HighlightResource($highlight);
    }

    public function update(UpdateHighlightRequest $request, Highlight $highlight)
    {
        $highlight->update($request->all());

        if ($request->input('image', false)) {
            if (! $highlight->image || $request->input('image') !== $highlight->image->file_name) {
                if ($highlight->image) {
                    $highlight->image->delete();
                }
                $highlight->addMedia(storage_path('tmp/uploads/' . basename($request->input('image'))))->toMediaCollection('image');
            }
        } elseif ($highlight->image) {
            $highlight->image->delete();
        }

        return (new HighlightResource($highlight))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(Highlight $highlight)
    {
        abort_if(Gate::denies('highlight_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $highlight->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
