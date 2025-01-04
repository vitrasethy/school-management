<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\StoreFacultyRequest;
use App\Http\Requests\UpdateFacultyRequest;
use App\Http\Resources\FacultyResource;
use App\Models\Faculty;

class FacultyController extends BaseController
{
    public function index()
    {
        $data = FacultyResource::collection(
            Faculty::with(['userAffiliations', 'departments'])->get()
        );

        return $this->successResponse($data);
    }

    public function store(StoreFacultyRequest $request)
    {
        $data = new FacultyResource(Faculty::create($request->validated()));

        return $this->successResponse($data, 201);
    }

    public function show(Faculty $faculty)
    {
        $data = new FacultyResource($faculty);

        return $this->successResponse(
            $data->load(['userAffiliations', 'departments'])
        );
    }

    public function update(UpdateFacultyRequest $request, Faculty $faculty)
    {
        $faculty->update($request->validated());

        $data = new FacultyResource($faculty);

        return $this->successResponse($data);
    }

    public function destroy(Faculty $faculty)
    {
        $faculty->delete();

        return $this->successResponse([]);
    }
}
