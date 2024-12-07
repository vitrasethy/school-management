<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\DepartmentRequest;
use App\Http\Resources\DepartmentResource;
use App\Models\Department;
use Auth;

class DepartmentController extends BaseController
{
    public function index()
    {
        $departments = Department::all();

        $data = DepartmentResource::collection($departments);

        return $this->successResponse($data);
    }

    public function store(DepartmentRequest $request)
    {
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
        $data = new DepartmentResource($department);

        return $this->successResponse($data);
    }

    public function update(
        DepartmentRequest $request, Department $department
    ) {
        $validated = $request->validated();

        $department->update($validated);

        $data = new DepartmentResource($department);

        return $this->successResponse($data);
    }

    public function destroy(Department $department)
    {
        $department->delete();

        return $this->noContentResponse();
    }
}
