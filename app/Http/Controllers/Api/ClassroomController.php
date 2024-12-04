<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\ClassroomRequest;
use App\Http\Resources\ClassroomResource;
use App\Models\Classroom;

class ClassroomController extends BaseController
{
    public function index()
    {
        $classrooms = Classroom::all();

        $data = ClassroomResource::collection($classrooms);

        return $this->successResponse($data);
    }

    public function store(ClassroomRequest $request)
    {
        $validated = $request->validated();

        $classroom = Classroom::create($validated);

        $data = new ClassroomResource($classroom);

        return $this->successResponse($data);
    }

    public function show(Classroom $classroom)
    {
        $data = new ClassroomResource($classroom);

        return $this->successResponse($data);
    }

    public function update(ClassroomRequest $request, Classroom $classroom)
    {
        $classroom->update($request->validated());

        $data = new ClassroomResource($classroom);

        return $this->successResponse($data);
    }

    public function destroy(Classroom $classroom)
    {
        $classroom->delete();

        return $this->noContentResponse();
    }
}
