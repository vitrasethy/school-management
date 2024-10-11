<?php

namespace App\Http\Controllers;

use App\Http\Requests\GroupRequest;
use App\Http\Resources\GroupResource;
use App\Models\Group;

class GroupController extends Controller
{
    public function index()
    {
        $group = Group::all();

        return GroupResource::collection($group);
    }

    public function store(GroupRequest $request)
    {
        $validated = $request->validated();

        $group = Group::create($validated);

        return new GroupResource($group);
    }

    public function show(Group $group)
    {
        return new GroupResource($group);
    }

    public function update(GroupRequest $request, Group $group)
    {
        $validated = $request->validated();

        $group->update($validated);

        return new GroupResource($group);
    }

    public function destroy(Group $group)
    {
        $group->delete();

        return response()->noContent();
    }
}
