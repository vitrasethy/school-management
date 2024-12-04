<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\OptionRequest;
use App\Http\Resources\OptionResource;
use App\Models\Option;

class OptionController extends BaseController
{
    public function index()
    {
        $responses = Option::all();

        $data = OptionResource::collection($responses);

        return $this->successResponse($data);
    }

    public function store(OptionRequest $request)
    {
        $validated = $request->validated();

        $response = Option::create($validated);

        $data = new OptionResource($response);

        return $this->successResponse($data);
    }

    public function show(Option $response)
    {
        $data = new OptionResource($response);

        return $this->successResponse($data);
    }

    public function update(OptionRequest $request, Option $response)
    {
        $validated = $request->validated();

        $response->update($validated);

        return $this->successResponse($response);
    }

    public function destroy(Option $response)
    {
        $response->delete();

        return $this->successResponse([]);
    }
}
