<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\StorePrivacyPolicyRequest;
use App\Http\Requests\UpdatePrivacyPolicyRequest;
use App\Http\Resources\Admin\PrivacyPolicyResource;
use App\Models\PrivacyPolicy;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class PrivacyPolicyApiController extends Controller
{
    use MediaUploadingTrait;

    public function index()
    {
        abort_if(Gate::denies('privacy_policy_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new PrivacyPolicyResource(PrivacyPolicy::all());
    }

    public function store(StorePrivacyPolicyRequest $request)
    {
        $privacyPolicy = PrivacyPolicy::create($request->all());

        return (new PrivacyPolicyResource($privacyPolicy))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(PrivacyPolicy $privacyPolicy)
    {
        abort_if(Gate::denies('privacy_policy_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new PrivacyPolicyResource($privacyPolicy);
    }

    public function update(UpdatePrivacyPolicyRequest $request, PrivacyPolicy $privacyPolicy)
    {
        $privacyPolicy->update($request->all());

        return (new PrivacyPolicyResource($privacyPolicy))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(PrivacyPolicy $privacyPolicy)
    {
        abort_if(Gate::denies('privacy_policy_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $privacyPolicy->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
