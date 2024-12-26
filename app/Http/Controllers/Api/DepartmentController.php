<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\StoreDepartmentRequest;
use App\Http\Requests\UpdateDepartmentRequest;
use App\Http\Resources\DepartmentResource;
use App\Models\Department;

class DepartmentController extends BaseController
{
    public function index()
    {
        $data = DepartmentResource::collection(Department::all());

        return $this->successResponse($data);
    }

    public function store(StoreDepartmentRequest $request)
    {
        $data = new DepartmentResource(Department::create($request->validated()));

        return $this->successResponse($data, 201);
    }

    public function show(Department $department)
    {
        $data = new DepartmentResource($department);

        return $this->successResponse($data);
    }

    public function update(UpdateDepartmentRequest $request, Department $department)
    {
        $department->update($request->validated());

        $data = new DepartmentResource($department);

        return $this->successResponse($data);
    }

    public function destroy(Department $department)
    {
        $department->delete();

        return $this->successResponse([]);
    }
}
