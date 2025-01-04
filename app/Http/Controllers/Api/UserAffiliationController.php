<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\StoreUserAffiliationRequest;
use App\Http\Requests\UpdateUserAffiliationRequest;
use App\Http\Resources\UserAffiliationResource;
use App\Models\UserAffiliation;

class UserAffiliationController extends BaseController
{
    public function index()
    {
        $data = UserAffiliationResource::collection(
            UserAffiliation::with(['user', 'faculty', 'department'])->get()
        );

        return $this->successResponse($data);
    }

    public function store(StoreUserAffiliationRequest $request)
    {
        $data = new UserAffiliationResource(UserAffiliation::create($request->validated()));

        return $this->successResponse($data, 201);
    }

    public function show(UserAffiliation $faculty)
    {
        $data = new UserAffiliationResource($faculty);

        return $this->successResponse(
            $data->load(['user', 'faculty', 'department'])
        );
    }

    public function update(UpdateUserAffiliationRequest $request, UserAffiliation $faculty)
    {
        $faculty->update($request->validated());

        $data = new UserAffiliationResource($faculty);

        return $this->successResponse($data);
    }

    public function destroy(UserAffiliation $faculty)
    {
        $faculty->delete();

        return $this->successResponse([]);
    }
}
