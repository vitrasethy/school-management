<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\ActivityRequest;
use App\Http\Resources\ActivityResource;
use App\Models\Activity;

class ActivityController extends BaseController
{
    public function index()
    {
        $activities = Activity::all();

        $data = ActivityResource::collection($activities);

        return $this->successResponse($data);
    }

    public function store(ActivityRequest $request)
    {
        $validated = $request->validated();

        $activity = Activity::create($validated);

        $data = new ActivityResource($activity);

        return $this->successResponse($data, 201);
    }

    public function show(Activity $activity)
    {
        $data = new ActivityResource($activity);

        return $this->successResponse($data);
    }

    public function update(ActivityRequest $request, Activity $activity)
    {
        $validated = $request->validated();

        $activity->update($validated);

        $data = new ActivityResource($activity);

        return $this->successResponse($data);
    }

    public function destroy(Activity $activity)
    {
        $activity->delete();

        return $this->successResponse([]);
    }
}
