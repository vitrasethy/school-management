<?php

namespace App\Http\Controllers\Api;

use App\Actions\CreateSchool;
use App\Http\Controllers\Controller;
use App\Http\Requests\SchoolRequest;
use App\Http\Resources\SchoolResource;
use App\Models\School;

class SchoolController extends Controller
{
    public function index()
    {
        return SchoolResource::collection(School::all());
    }

    public function store(SchoolRequest $request, CreateSchool $action)
    {
        $validated = $request->validated();

        $school = $action->execute($validated);

        return new SchoolResource($school);
    }

    public function show(School $school)
    {
        return new SchoolResource($school);
    }

    public function update(SchoolRequest $request, School $school)
    {
        $validated = $request->validated();

        $school->update($validated);

        return new SchoolResource($school);
    }

    public function destroy(School $school)
    {
        $school->delete();

        return response()->noContent();
    }
}
