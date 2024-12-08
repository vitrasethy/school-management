<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\DepartmentRequest;
use App\Http\Resources\DepartmentResource;
use App\Models\Department;
use Auth;
use Illuminate\Support\Facades\Gate;

class DepartmentController extends BaseController
{
    public function index()
    {
        Gate::authorize('viewAny', Department::class);

        $departments = Department::all();

        $data = DepartmentResource::collection($departments);

        return $this->successResponse($data);
    }

    public function store(DepartmentRequest $request)
    {
        Gate::authorize('create', Department::class);

        $validated = $request->validated();

        $department = Department::create($validated);

        Auth::user()->update([
            'school_id' => $department->school_id,
            'department_id' => $department->id,
        ]);

        Auth::user()->assignRole('department admin');

        $data = new DepartmentResource($department);

        return $this->successResponse($data, 201);
    }

    public function show(Department $department)
    {
        Gate::authorize('view', $department);

        $data = new DepartmentResource($department);

        return $this->successResponse($data);
    }

    public function update(DepartmentRequest $request, Department $department)
    {
        Gate::authorize('update', $department);

        $validated = $request->validated();

        $department->update($validated);

        $data = new DepartmentResource($department);

        return $this->successResponse($data);
    }

    public function destroy(Department $department)
    {
        Gate::authorize('delete', Department::class);

        $department->delete();

        return $this->noContentResponse();
    }
}
