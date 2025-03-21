<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\ActivityRequest;
use App\Http\Resources\ActivityResource;
use App\Models\Activity;
use App\Models\Form;
use App\Models\Option;
use App\Models\Question;
use Illuminate\Http\Request;

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
        $activity = Activity::create([
            'subject_id' => $request->input('subject_id'),
            'activity_type_id' => $request->input('activity_type_id'),
            'group_id' => $request->input('group_id'),
        ]);

        $form = Form::create([
            'title' => $request->input('title'),
            'description' => $request->input('description'),
            'activity_id' => $activity->id,
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

        $data = new ActivityResource($activity);

        return $this->successResponse($data, 201);
    }

    public function show(Activity $activity)
    {
        $data = new ActivityResource($activity->load(['form.questions.options']));

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
