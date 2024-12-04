<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\RoleRequest;
use App\Http\Resources\RoleResource;
use App\Models\Role;
use Illuminate\Support\Facades\Gate;

class RoleController extends BaseController
{
    public function __construct() {
        Gate::authorize('admin', Role::class);
    }

    public function index()
    {
        $roles = Role::all();

        $data = RoleResource::collection($roles);

        return $this->successResponse($data);
    }

    public function store(RoleRequest $request)
    {
        $validated = $request->validated();

        $role = Role::create($validated);

        $data = new RoleResource($role);

        return $this->successResponse($data, 201);
    }

    public function show(Role $role)
    {
        $data = new RoleResource($role);

        return $this->successResponse($data);
    }

    public function update(RoleRequest $request, Role $role)
    {
        $validated = $request->validated();

        $role->update($validated);

        $data = new RoleResource($role);

        return $this->successResponse($data);
    }

    public function destroy(Role $role)
    {
        $role->delete();

        return $this->noContentResponse();
    }
}
