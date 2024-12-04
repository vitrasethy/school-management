<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\GroupRequest;
use App\Http\Resources\GroupResource;
use App\Models\Department;
use App\Models\Group;
use Auth;

class GroupController extends BaseController
{
    public function index()
    {
        $groups = Group::all();

        $data = GroupResource::collection($groups);

        return $this->successResponse($data);
    }

    public function store(GroupRequest $request)
    {
        $validated = $request->validated();

        $group = Group::create($validated);

        $data = new GroupResource($group);

        return $this->successResponse($data, 201);
    }

    public function show(Group $group)
    {
        $data = new GroupResource($group);

        return $this->successResponse($data);
    }

    public function update(GroupRequest $request, Group $group)
    {
        $validated = $request->validated();

        $group->update($validated);

        $data = new GroupResource($group);

        return $this->successResponse($data);
    }

    public function destroy(Group $group)
    {
        $group->delete();

        return $this->noContentResponse();
    }

    public function findByUser()
    {
        $groups = Group::whereRelation('users', 'id', '=', Auth::id())->get();

        $data = GroupResource::collection($groups);

        return $this->successResponse($data);
    }
}
