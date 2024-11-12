<?php

namespace App\Http\Controllers\Api;

use App\Actions\CreateSchool;
use App\Http\Requests\SchoolRequest;
use App\Http\Resources\SchoolResource;
use App\Models\School;

class SchoolController extends BaseController
{
    public function index()
    {
        return $this->successResponse(SchoolResource::collection(School::all()));
    }

    public function store(SchoolRequest $request, CreateSchool $action)
    {
        $validated = $request->validated();

        $school = $action->execute($validated);

        return $this->successResponse(new SchoolResource($school), 201);
    }

    public function show(School $school)
    {
        return $this->successResponse(new SchoolResource($school));
    }

    public function update(SchoolRequest $request, School $school)
    {
        $validated = $request->validated();

        $school->update($validated);

        return $this->successResponse(new SchoolResource($school));
    }

    public function destroy(School $school)
    {
        $school->delete();

        return $this->noContentResponse();
    }
}
