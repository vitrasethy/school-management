<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\ClassroomRequest;
use App\Http\Resources\ClassroomResource;
use App\Models\Classroom;

class ClassroomController extends Controller
{
    public function index()
    {
        return ClassroomResource::collection(Classroom::all());
    }

    public function store(ClassroomRequest $request)
    {
        return new ClassroomResource(Classroom::create($request->validated()));
    }

    public function show(Classroom $classroom)
    {
        return new ClassroomResource($classroom);
    }

    public function update(ClassroomRequest $request, Classroom $classroom)
    {
        $classroom->update($request->validated());

        return new ClassroomResource($classroom);
    }

    public function destroy(Classroom $classroom)
    {
        $classroom->delete();

        return response()->json();
    }
}
