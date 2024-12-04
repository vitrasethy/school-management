<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\QuestionRequest;
use App\Http\Resources\QuestionResource;
use App\Models\Question;

class QuestionController extends BaseController
{
    public function index()
    {
        $responses = Question::all();

        $data = QuestionResource::collection($responses);

        return $this->successResponse($data);
    }

    public function store(QuestionRequest $request)
    {
        $validated = $request->validated();

        $response = Question::create($validated);

        $data = new QuestionResource($response);

        return $this->successResponse($data);
    }

    public function show(Question $response)
    {
        $data = new QuestionResource($response);

        return $this->successResponse($data);
    }

    public function update(QuestionRequest $request, Question $response)
    {
        $validated = $request->validated();

        $response->update($validated);

        return $this->successResponse($response);
    }

    public function destroy(Question $response)
    {
        $response->delete();

        return $this->successResponse([]);
    }
}
