<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\StoreGroupRequest;
use App\Http\Requests\UpdateGroupRequest;
use App\Http\Resources\GroupResource;
use App\Models\Group;
use Auth;

class GroupController extends BaseController
{
    public function index()
    {
        $data = GroupResource::collection(
            Group::with(['subjects', 'department', 'users'])->get()
        );

        return $this->successResponse($data);
    }

    public function store(StoreGroupRequest $request)
    {
        $data = new GroupResource(Group::create($request->validated()));

        return $this->successResponse($data, 201);
    }

    public function show(Group $group)
    {
        $data = new GroupResource($group);

        return $this->successResponse(
            $data->load(['subjects', 'department', 'users'])
        );
    }

    public function update(UpdateGroupRequest $request, Group $group)
    {
        $group->update($request->validated());

        $data = new GroupResource($group);

        return $this->successResponse($data);
    }

    public function destroy(Group $group)
    {
        $group->delete();

        return $this->successResponse([]);
    }

    public function findByUser()
    {
        $data = GroupResource::collection(Auth::user()->groups);

        return $this->successResponse($data);
    }
}
