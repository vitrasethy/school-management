<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\ScheduleRequest;
use App\Http\Resources\ScheduleResource;
use App\Models\Schedule;

class ScheduleController extends BaseController
{
    public function index()
    {
        $schedules = Schedule::all();

        $data = ScheduleResource::collection($schedules);

        return $this->successResponse($data);
    }

    public function store(ScheduleRequest $request)
    {
        $validated = $request->validated();

        $schedule = Schedule::create($validated);

        $data = new ScheduleResource($schedule);

        return $this->successResponse($data, 201);
    }

    public function show(Schedule $schedule)
    {
        $data = new ScheduleResource($schedule);

        return $this->successResponse($data);
    }

    public function update(ScheduleRequest $request, Schedule $schedule)
    {
        $validated = $request->validated();

        $schedule->update($validated);

        $data = new ScheduleResource($schedule);

        return $this->successResponse($data);
    }

    public function destroy(Schedule $schedule)
    {
        $schedule->delete();

        return $this->successResponse([]);
    }
}
