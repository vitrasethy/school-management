<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\SubjectRequest;
use App\Http\Resources\SubjectResource;
use App\Models\Department;
use App\Models\Group;
use App\Models\Subject;

class SubjectController extends BaseController
{
    public function index()
    {
        $subjects = Subject::all();

        $data = SubjectResource::collection($subjects);

        return $this->successResponse($data);
    }

    public function store(SubjectRequest $request)
    {
        $validated = $request->validated();

        $subject = Subject::create($validated);

        $data = new SubjectResource($subject);

        return $this->successResponse($data, 201);
    }

    public function show(Subject $subject)
    {
        $data = new SubjectResource($subject);

        return $this->successResponse($data);
    }

    public function update(SubjectRequest $request, Subject $subject)
    {
        $validated = $request->validated();

        $subject->update($validated);

        $data = new SubjectResource($subject);

        return $this->successResponse($data);
    }

    public function destroy(Subject $subject)
    {
        $subject->delete();

        return $this->noContentResponse();
    }
}
