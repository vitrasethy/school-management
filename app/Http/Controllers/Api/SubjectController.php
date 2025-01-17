<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\StoreSubjectRequest;
use App\Http\Requests\UpdateSubjectRequest;
use App\Http\Resources\SubjectResource;
use App\Models\Group;
use App\Models\Subject;

use function auth;

class SubjectController extends BaseController
{
    public function index()
    {
        $data = SubjectResource::collection(
            Subject::with(['groups', 'department'])->get()
        );

        return $this->successResponse($data);
    }

    public function store(StoreSubjectRequest $request)
    {
        $data = new SubjectResource(Subject::create($request->validated()));

        return $this->successResponse($data, 201);
    }

    public function show(Subject $subject)
    {
        $data = new SubjectResource($subject->load(['groups', 'department']));

        return $this->successResponse($data);
    }

    public function update(UpdateSubjectRequest $request, Subject $subject)
    {
        $subject->update($request->validated());

        $data = new SubjectResource($subject);

        return $this->successResponse($data);
    }

    public function destroy(Subject $subject)
    {
        $subject->delete();

        return $this->successResponse([]);
    }

    public function showByGroup(Group $group, Subject $subject)
    {
        $filteredSubject = $subject->load([
            'posts' => function ($query) use ($group, $subject) {
                $query->where([
                    ['subject_id', $subject->id],
                    ['group_id', $group->id],
                ]);
            },
            'groups.users' => function ($query) use ($group) {
                $query->where('id', $group->id);
            },
        ]);

        return $this->successResponse(
            new SubjectResource($filteredSubject)
        );
    }

    //public function indexByTeacher()
    //{
    //    $subjects = Subject::whereHas('groups', function ($query) {
    //        $query->where('group_subject.teacher_id', auth()->id());
    //    })
    //        ->with('groups')
    //        ->get();
    //
    //    return $this->successResponse(
    //        SubjectResource::collection($subjects)
    //    );
    //}
}
