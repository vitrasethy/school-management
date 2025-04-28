<?php

namespace App\Http\Controllers\Api\V2;

use App\Http\Controllers\Api\BaseController;
use App\Http\Resources\GroupResource;
use App\Models\Activity;
use App\Models\Group;
use App\Models\SchoolYear;
use App\Models\Subject;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;

use function now;
use function today;

class StudentController extends BaseController
{
    public function dashboard()
    {
        return $this->successResponse([
            'total_groups' => Group::whereHas('users', function ($query) {
                $query->where('id', Auth::id());
            })->count(),
            'current_semester' => SchoolYear::whereDate('started_at', '<=', today('Asia/Phnom_Penh'))
                ->whereDate('finished_at', '>=', today('Asia/Phnom_Penh'))
                ->first(),
            'future_activities' => Activity::whereHas('groups.users', function ($query) {
                $query->where('id', Auth::id());
            })->where('due_at', '>', now('Asia/Phnom_Penh'))->get(),
        ]);
    }

    public function indexByStudent(Request $request)
    {
        $groups = Group::with(['subjects'])
            ->whereHas('users', function ($query) {
                $query->where('id', Auth::id());
            })
            ->when($request->query('name'), function (Builder $subQuery, $name) {
                $subQuery->whereLike('name', '%'.$name.'%');
            })
            ->get();

        return $this->successResponse(
            GroupResource::collection($groups)
        );
    }

    public function getActivities(Request $request)
    {
        //$departmentId = $request->query('department');
        //$schoolYearId = $request->query('schoolYear');
        //$yearId = $request->query('year');
        //$groupName = $request->query('groupName');

        $activities = Activity::with(['form', 'subject', 'groups' => ['year', 'schoolYear', 'semester']])
            ->latest('due_at')
            ->get();

        $data = [];
        foreach ($activities as $activity) {
            $data[] = [
                'id' => $activity->id,
                'title' => $activity->form->title,
                'due_at' => $activity->due_at,
                'duration' => $activity->duration,
                'subject' => $activity->subject->name,
                'groups' => $activity->groups,
                'is_past_due' => Carbon::parse($activity->due_at, 'Asia/Phnom_Penh')->isPast(),
            ];
        }

        return $this->successResponse($data);
    }

    public function showActivity(Activity $activity)
    {
        return $this->successResponse([
            'id' => $activity->id,
            'form' => $activity->form->load('questions.options'),
            'subject' => $activity->subject,
            'full_score' => $activity->form->questions->sum('points'),
            'due_at' => $activity->due_at,
            'duration' => $activity->duration,
            'is_submitted' => $activity->form->questions()->whereHas('answers', function ($query) {
                $query->where('user_id', Auth::id());
            })->exists(),
        ]);
    }

    public function getSubjectsByGroup(Group $group)
    {
        return $this->successResponse($group->subjects);
    }

    public function getScores(Subject $subject, Group $group)
    {
        $activities = Activity::where('subject_id', $subject->id)
            ->whereRelation('groups', 'id', '=', $group->id)
            ->get();

        $actScores = [];
        foreach ($activities as $activity) {
            $actScores[] = [
                'name' => $activity->form->title,
                'scores' => $activity->form->questions()->withSum('answers', 'score')->get()->sum('answers_score_sum'),
            ];
        }

        return $this->successResponse($actScores);
    }

    public function getProfile() {}
}
