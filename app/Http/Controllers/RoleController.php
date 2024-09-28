<?php

namespace App\Http\Controllers;

use App\Http\Requests\RoleRequest;
use App\Http\Resources\RoleResource;
use App\Models\Role;
use Illuminate\Support\Facades\Gate;

class RoleController extends Controller
{
    public function __construct() {
        Gate::authorize('admin', Role::class);
    }

    public function index()
    {
        return RoleResource::collection(Role::all());
    }

    public function store(RoleRequest $request)
    {
        return new RoleResource(Role::create($request->validated()));
    }

    public function show(Role $role)
    {
        return new RoleResource($role);
    }

    public function update(RoleRequest $request, Role $role)
    {
        $role->update($request->validated());

        return new RoleResource($role);
    }

    public function destroy(Role $role)
    {
        $role->delete();

        return response()->noContent();
    }
}
