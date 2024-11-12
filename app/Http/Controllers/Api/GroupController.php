<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\GroupRequest;
use App\Http\Resources\GroupResource;
use App\Models\Group;
use Auth;

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

    public function findByUser()
    {
        $groups = Group::whereRelation('users', 'id', '=', Auth::id())->get();

        return GroupResource::collection($groups);
    }
}
