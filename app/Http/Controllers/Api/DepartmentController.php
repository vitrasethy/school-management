<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\DepartmentRequest;
use App\Http\Resources\DepartmentResource;
use App\Models\Department;
use App\Models\School;

class DepartmentController extends BaseController
{
    public function index(School $school)
    {
        $departments = Department::all();

        $data = DepartmentResource::collection($departments);

        return $this->successResponse($data);
    }

    public function store(DepartmentRequest $request)
    {
        $validated = $request->validated();

        $department = Department::create($validated);

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
