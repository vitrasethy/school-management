<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\AnswerRequest;
use App\Http\Requests\BulkStoreAnswerRequest;
use App\Http\Resources\AnswerResource;
use App\Models\Answer;
use App\Models\Question;

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
            $question = Question::find($answer['question_id']);

            if ($question->type === 'single_choice') {
                $options = $question
                    ->options()
                    ->where('id', $answer['option_ids'][0])
                    ->first();

                if ($options->is_correct) {
                    $score = $question->points;
                } else {
                    $score = 0;
                }
            } elseif ($question->type === 'multiple_choice') {
                $optionCorrectCount = $question
                    ->options()
                    ->where('is_correct', true)
                    ->count();

                $answerCorrectCount = $question
                    ->options()
                    ->whereIn('id', $answer['option_ids'])
                    ->where('is_correct', true)
                    ->count();

                $score = ($answerCorrectCount * $question->points) / $optionCorrectCount;
            } else {
                $score = null;
            }

            Answer::create([
                'user_id' => $studentId,
                'question_id' => $answer['question_id'],
                'option_id' => $answer['option_id'],
                'text' => $answer['text'],
                'score' => $score,
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
