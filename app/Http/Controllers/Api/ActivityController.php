<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\ActivityRequest;
use App\Http\Requests\UpdateActivityRequest;
use App\Http\Resources\ActivityResource;
use App\Models\Activity;
use App\Models\Form;
use App\Models\Option;
use App\Models\Question;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ActivityController extends BaseController
{
    public function index(Request $request)
    {
        $activities = Activity::with('form');

        if ($request->input('groupId')) {
            $activities->whereRelation('group', 'id', $request->input('groupId'));
        }

        if ($request->input('activityTypeId')) {
            $activities->whereRelation('activityType', 'id', $request->input('activityTypeId'));
        }

        $data = ActivityResource::collection($activities->get());

        return $this->successResponse($data);
    }

    public function store(ActivityRequest $request)
    {
        $form = Form::create([
            'title' => $request->input('title'),
            'description' => $request->input('description'),
        ]);

        foreach ($request->input('questions') as $question) {
            $q = Question::create([
                'form_id' => $form->id,
                'name' => $question['name'],
                'type' => $question['type'],
                'is_required' => $question['is_require'],
                'correct_answer' => $question['correct_answer'],
                'points' => $question['points'],
            ]);

            if ($question['options']) {
                foreach ($question['options'] as $option) {
                    Option::create([
                        'question_id' => $q->id,
                        'name' => $option['name'],
                        'is_correct' => $option['is_correct'],
                    ]);
                }
            }
        }

        Activity::create([
            'subject_id' => $request->input('subject_id'),
            'activity_type_id' => $request->input('activity_type_id'),
            'duration' => $request->input('duration'),
            'due_at' => $request->input('due_at'),
            'teacher_id' => Auth::id(),
            'form_id' => $form->id,
        ])->groups()->attach($request->input('group_ids'));

        return $this->successResponse([], 201);
    }

    public function show(Activity $activity)
    {
        $data = new ActivityResource($activity->load(['form.questions.options']));

        return $this->successResponse($data);
    }

    public function update(UpdateActivityRequest $request, Activity $activity)
    {
        // update form
        $activity->form->update([
            'title' => $request->input('title'),
            'description' => $request->input('description'),
        ]);

        // update groups
        $activity->groups()->attach($request->input('group_ids'));

        // update question
        foreach ($request->input('questions') as $question) {

            if (! $question['id']) {
                $q = Question::create([
                    'form_id' => $activity->form_id,
                    'name' => $question['name'],
                    'type' => $question['type'],
                    'is_required' => $question['is_require'],
                    'correct_answer' => $question['correct_answer'],
                    'points' => $question['points'],
                ]);

                if ($question['options']) {
                    foreach ($question['options'] as $option) {
                        Option::create([
                            'question_id' => $q->id,
                            'name' => $option['name'],
                            'is_correct' => $option['is_correct'],
                        ]);
                    }
                }
            } else {

                $ques = Question::find($question['id']);

                $ques->update([
                    'name' => $question['name'],
                    'type' => $question['type'],
                    'is_required' => $question['is_require'],
                    'correct_answer' => $question['correct_answer'],
                    'points' => $question['points'],
                ]);
            }

            // update option if it has
            if ($question['options']) {
                foreach ($question['options'] as $option) {
                    $op = Option::find($option['id']);
                    $op->update([
                        'name' => $option['name'],
                        'is_correct' => $option['is_correct'],
                    ]);
                }
            }
        }

        // update activity
        $activity->update([
            'duration' => $request->input('duration'),
            'due_at' => $request->input('due_at'),
        ]);

        return $this->successResponse([]);
    }

    public function destroy(Activity $activity)
    {
        $activity->delete();

        return $this->successResponse([]);
    }
}
