<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\StoreClassroomRequest;
use App\Http\Requests\UpdateClassroomRequest;
use App\Http\Resources\ClassroomResource;
use App\Models\Classroom;

class ClassroomController extends BaseController
{
    public function index()
    {
        $data = ClassroomResource::collection(Classroom::all());

        return $this->successResponse($data);
    }

    public function store(StoreClassroomRequest $request)
    {
        $data = new ClassroomResource(Classroom::create($request->validated()));

        return $this->successResponse($data, 201);
    }

    public function show(Classroom $faculty)
    {
        $data = new ClassroomResource($faculty);

        return $this->successResponse($data);
    }

    public function update(UpdateClassroomRequest $request, Classroom $faculty)
    {
        $faculty->update($request->validated());

        $data = new ClassroomResource($faculty);

        return $this->successResponse($data);
    }

    public function destroy(Classroom $faculty)
    {
        $faculty->delete();

        return $this->successResponse([]);
    }
}
