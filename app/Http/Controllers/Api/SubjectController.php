<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\SubjectRequest;
use App\Http\Resources\SubjectResource;
use App\Models\Group;
use App\Models\Subject;

class SubjectController extends Controller
{
    public function index(Group $group)
    {
        $subjects = Subject::whereRelation('groups', 'id', '=', $group->id)->get();

        return SubjectResource::collection($subjects);
    }

    public function store(SubjectRequest $request, Group $group)
    {
        $validated = $request->validated();

        $subject = Subject::create($validated);

        $subject->groups()->attach($group->id);

        return new SubjectResource($subject);
    }

    public function show(Subject $subject)
    {
        return new SubjectResource($subject);
    }

    public function update(SubjectRequest $request, Subject $subject)
    {
        $subject->update($request->validated());

        return new SubjectResource($subject);
    }

    public function destroy(Subject $subject)
    {
        $subject->delete();

        return response()->json();
    }
}
