<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\StoreSubjectRequest;
use App\Http\Requests\UpdateSubjectRequest;
use App\Http\Resources\SubjectResource;
use App\Models\Subject;

class SubjectController extends BaseController
{
    public function index()
    {
        $data = SubjectResource::collection(
            Subject::with(['groups', 'department'])->get()
        );

        return $this->successResponse($data);
    }

    public function store(StoreSubjectRequest $request)
    {
        $data = new SubjectResource(Subject::create($request->validated()));

        return $this->successResponse($data, 201);
    }

    public function show(Subject $faculty)
    {
        $data = new SubjectResource($faculty);

        return $this->successResponse(
            $data->load(['groups', 'department'])
        );
    }

    public function update(UpdateSubjectRequest $request, Subject $faculty)
    {
        $faculty->update($request->validated());

        $data = new SubjectResource($faculty);

        return $this->successResponse($data);
    }

    public function destroy(Subject $faculty)
    {
        $faculty->delete();

        return $this->successResponse([]);
    }
}
