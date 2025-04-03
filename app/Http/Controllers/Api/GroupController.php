<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\StoreGroupRequest;
use App\Http\Requests\UpdateGroupRequest;
use App\Http\Resources\GroupResource;
use App\Models\Group;
use App\Models\Subject;
use App\Models\User;
use Auth;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;

class GroupController extends BaseController
{
    public function index()
    {
        $groups = Group::with(['subjects', 'department', 'users'])->get();

        $groups->map(function (Group $group) {
            $group->subjects->map(function ($subject) {
                // Get teacher_id from the pivot
                $teacherId = $subject->pivot->teacher_id;

                // Find the user by teacher_id
                $teacher = User::find($teacherId);

                // Add a new attribute to the subject model
                $subject->teacher = $teacher;

                return $subject;
            });

            return $group;
        });

        $data = GroupResource::collection(
            $groups
        );

        return $this->successResponse($data);
    }

    public function store(StoreGroupRequest $request)
    {
        $data = new GroupResource(Group::create($request->validated()));

        return $this->successResponse($data, 201);
    }

    public function show(Group $group)
    {
        $data = new GroupResource($group->load(['subjects', 'department', 'users']));

        return $this->successResponse($data);
    }

    public function update(UpdateGroupRequest $request, Group $group)
    {
        $group->update($request->validated());

        $data = new GroupResource($group);

        return $this->successResponse($data);
    }

    public function destroy(Group $group)
    {
        $group->delete();

        return $this->successResponse([]);
    }

    public function findByUser()
    {
        $data = GroupResource::collection(
            Auth::user()->groups->load(['subjects', 'department', 'users'])
        );

        return $this->successResponse($data);
    }

    public function indexByStudent()
    {
        $groups = Group::with('subjects')->whereRelation('users', 'id', auth()->id())->get();

        return $this->successResponse(
            GroupResource::collection($groups)
        );
    }

    public function indexByTeacher(Request $request)
    {
        $groups = Group::with(['subjects' => function ($query) {
            $query->where('group_subject.teacher_id', auth()->id());
        }])
            ->when($request->query('name'), function (Builder $subQuery, $name) {
                $subQuery->whereLike('name', '%'.$name.'%');
            })
            ->whereHas('subjects', function ($query) {
                $query->where('group_subject.teacher_id', auth()->id());
            })
            ->get();

        return $this->successResponse(
            GroupResource::collection($groups)
        );
    }

    public function storePassScore(Request $request)
    {
        $request->validate([
            'pass_score' => 'required|numeric',
            'group_id' => 'required|exists:groups,id',
            'subject_id' => 'required|exists:subjects,id',
        ]);

        Group::find($request->input('group_id'))
            ->subjects()
            ->sync([
                $request->input('subject_id') => [
                    'teacher_id' => Auth::id(),
                    'pass_score' => $request->input('pass_score'),
                ],
            ]);

        return $this->successResponse([]);
    }
}
