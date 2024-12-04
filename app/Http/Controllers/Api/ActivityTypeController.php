<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\ActivityTypeRequest;
use App\Http\Resources\ActivityTypeResource;
use App\Models\ActivityType;

class ActivityTypeController extends BaseController
{
    public function index()
    {
        $activityTypes = ActivityType::all();

        $data = ActivityTypeResource::collection($activityTypes);

        return $this->successResponse($data);
    }

    public function store(ActivityTypeRequest $request)
    {
        $validated = $request->validated();

        $activityType = ActivityType::create($validated);

        $data = new ActivityTypeResource($activityType);

        return $this->successResponse($data, 201);
    }

    public function show(ActivityType $activityType)
    {
        $data = new ActivityTypeResource($activityType);

        return $this->successResponse($data);
    }

    public function update(ActivityTypeRequest $request, ActivityType $activityType)
    {
        $activityType->update($request->validated());

        $data = new ActivityTypeResource($activityType);

        return $this->successResponse($data);
    }

    public function destroy(ActivityType $activityType)
    {
        $activityType->delete();

        return $this->noContentResponse();
    }
}
