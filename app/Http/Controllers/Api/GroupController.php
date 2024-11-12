<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\GroupRequest;
use App\Http\Resources\GroupResource;
use App\Models\Group;
use Auth;

class GroupController extends BaseController
{
    public function index()
    {
        $group = Group::all();

        return $this->successResponse(GroupResource::collection($group));
    }

    public function store(GroupRequest $request)
    {
        $validated = $request->validated();

        $group = Group::create($validated);

        return $this->successResponse(new GroupResource($group), 201);
    }

    public function show(Group $group)
    {
        return $this->successResponse(new GroupResource($group));
    }

    public function update(GroupRequest $request, Group $group)
    {
        $validated = $request->validated();

        $group->update($validated);

        return $this->successResponse(new GroupResource($group));
    }

    public function destroy(Group $group)
    {
        $group->delete();

        return $this->noContentResponse();
    }

    public function findByUser()
    {
        $groups = Group::whereRelation('users', 'id', '=', Auth::id())->get();

        return $this->successResponse(GroupResource::collection($groups));
    }
}
