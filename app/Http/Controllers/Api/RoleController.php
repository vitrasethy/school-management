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
        return $this->successResponse(RoleResource::collection(Role::all()));
    }

    public function store(RoleRequest $request)
    {
        return $this->successResponse(new RoleResource(Role::create($request->validated())), 201);
    }

    public function show(Role $role)
    {
        return $this->successResponse(new RoleResource($role));
    }

    public function update(RoleRequest $request, Role $role)
    {
        $role->update($request->validated());

        return $this->successResponse(new RoleResource($role));
    }

    public function destroy(Role $role)
    {
        $role->delete();

        return $this->noContentResponse();
    }
}
