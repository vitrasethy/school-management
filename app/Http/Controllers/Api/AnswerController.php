<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\AnswerRequest;
use App\Http\Requests\BulkStoreAnswerRequest;
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

    public function bulkStore(BulkStoreAnswerRequest $request)
    {
        $studentId = $request->input('user_id');

        foreach ($request->input('answers') as $answer) {
            Answer::create([
                'user_id' => $studentId,
                'question_id' => $answer['question_id'],
                'option_id' => $answer['option_id'],
                'text' => $answer['text'],
            ]);
        }

        return $this->successResponse([]);
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
