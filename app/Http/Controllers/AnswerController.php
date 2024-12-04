<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Api\BaseController;
use App\Http\Requests\AnswerRequest;
use App\Http\Resources\AnswerResource;
use App\Models\Answer;

class AnswerController extends BaseController
{
    public function index()
    {
        $responses = Answer::all();

        $data = AnswerResource::collection($responses);

        return $this->successResponse($data);
    }

    public function store(AnswerRequest $request)
    {
        $validated = $request->validated();

        $response = Answer::create($validated);

        $data = new AnswerResource($response);

        return $this->successResponse($data);
    }

    public function show(Answer $response)
    {
        $data = new AnswerResource($response);

        return $this->successResponse($data);
    }

    public function update(AnswerRequest $request, Answer $response)
    {
        $validated = $request->validated();

        $response->update($validated);

        return $this->successResponse($response);
    }

    public function destroy(Answer $response)
    {
        $response->delete();

        return $this->successResponse([]);
    }
}
