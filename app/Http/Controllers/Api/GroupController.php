<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\GroupRequest;
use App\Http\Resources\GroupResource;
use App\Models\Department;
use App\Models\Group;
use Auth;
use Illuminate\Support\Facades\Gate;

class GroupController extends BaseController
{
    public function index()
    {
        Gate::authorize('viewAny', Group::class);

        $groups = Group::all();

        $data = GroupResource::collection($groups);

        return $this->successResponse($data);
    }

    public function indexByDepartment(Department $department)
    {
        Gate::authorize('viewByDepartment', [Group::class, $department]);

        $data = GroupResource::collection(
            Group::whereDepartmentId($department->id)->get()
        );

        return $this->successResponse($data);
    }

    public function store(GroupRequest $request)
    {
        Gate::authorize('create', Group::class);

        $validated = $request->validated();

        $group = Group::create($validated);

        $data = new GroupResource($group);

        return $this->successResponse($data, 201);
    }

    public function show(Group $group)
    {
        Gate::authorize('view', Group::class);

        $data = new GroupResource($group);

        return $this->successResponse($data);
    }

    public function update(GroupRequest $request, Group $group)
    {
        Gate::authorize('update', $group);

        $validated = $request->validated();

        $group->update($validated);

        $data = new GroupResource($group);

        return $this->successResponse($data);
    }

    public function destroy(Group $group)
    {
        Gate::authorize('delete', $group);

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
