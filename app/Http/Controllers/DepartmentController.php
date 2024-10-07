<?php

namespace App\Http\Controllers;

use App\Http\Requests\DepartmentRequest;
use App\Http\Resources\DepartmentResource;
use App\Models\Department;
use App\Models\School;

class DepartmentController extends Controller
{
    public function index(School $school)
    {
        $department = Department::where('school_id', $school->id)->get();

        return DepartmentResource::collection($department);
    }

    public function store(DepartmentRequest $request, School $school)
    {
        $validated = $request->validated();

        $department = Department::create([
            ...$validated,
            'school_id' => $school->id,
        ]);

        return new DepartmentResource($department);
    }

    public function show(Department $department)
    {
        return new DepartmentResource($department);
    }

    public function update(DepartmentRequest $request, Department $department)
    {
        $validated = $request->validated();

        $department->update($validated);

        return new DepartmentResource($department);
    }

    public function destroy(Department $department)
    {
        $department->delete();

        return response()->noContent();
    }
}
