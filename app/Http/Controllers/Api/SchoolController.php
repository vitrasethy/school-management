<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\SchoolRequest;
use App\Http\Resources\SchoolResource;
use App\Models\School;

class SchoolController extends BaseController
{
    public function index()
    {
        $schools = School::all();

        $data = SchoolResource::collection($schools);

        return $this->successResponse($data);
    }

    public function store(SchoolRequest $request)
    {
        $validated = $request->validated();

        $school = School::create($validated);

        $data = new SchoolResource($school);

        return $this->successResponse($data, 201);
    }

    public function show(School $school)
    {
        $data = new SchoolResource($school);

        return $this->successResponse($data);
    }

    public function update(SchoolRequest $request, School $school)
    {
        $validated = $request->validated();

        $school->update($validated);

        $data = new SchoolResource($school);

        return $this->successResponse($data);
    }

    public function destroy(School $school)
    {
        $school->delete();

        return $this->noContentResponse();
    }
}
