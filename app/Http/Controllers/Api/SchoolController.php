<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\SchoolRequest;
use App\Http\Resources\SchoolResource;
use App\Models\School;
use Auth;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Gate;

class SchoolController extends BaseController
{
    public function index(): JsonResponse
    {
        Gate::authorize('viewAny', School::class);

        $schools = School::all();

        $data = SchoolResource::collection($schools);

        return $this->successResponse($data);
    }

    public function store(SchoolRequest $request): JsonResponse
    {
        $validated = $request->validated();

        $school = School::create($validated);

        $school->update(['code' => $school->id]);

        $data = new SchoolResource($school);

        Auth::user()->update(['school_id' => $school->id]);

        Auth::user()->assignRole('school admin');

        return $this->successResponse($data, 201);
    }

    public function show(School $school)
    {
        Gate::authorize('view', $school);

        $data = new SchoolResource($school);

        return $this->successResponse($data);
    }

    public function update(SchoolRequest $request, School $school)
    {
        Gate::authorize('update', $school);

        $validated = $request->validated();

        $school->update($validated);

        $data = new SchoolResource($school);

        return $this->successResponse($data);
    }

    public function destroy(School $school)
    {
        Gate::authorize('delete', $school);

        $school->delete();

        return $this->noContentResponse();
    }
}
