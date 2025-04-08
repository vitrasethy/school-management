<?php

namespace App\Http\Controllers\Api\V2;

use App\Http\Controllers\Api\BaseController;
use App\Http\Resources\GroupResource;
use App\Models\Activity;
use App\Models\Group;
use App\Models\SchoolYear;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
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
        $departmentId = $request->query('department');
        $schoolYearId = $request->query('schoolYear');
        $yearId = $request->query('year');
        $groupName = $request->query('groupName');

        $activities = Activity::with(['form', 'subject', 'groups' => ['year', 'schoolYear', 'semester']])
            ->where('due_at', '>=', now('Asia/Phnom_Penh'))
            ->whereHas('groups', function (Builder $query) use ($groupName, $schoolYearId, $yearId, $departmentId) {
                $query->whereHas('users', function ($query) {
                    $query->where('id', Auth::id());
                });

                if ($departmentId) {
                    $query->where('department_id', $departmentId);
                }
                if ($schoolYearId) {
                    $query->where('school_year_id', $schoolYearId);
                }
                if ($yearId) {
                    $query->where('year_id', $yearId);
                }
                if ($groupName) {
                    $query->where('name', 'ILIKE', "%$groupName%");
                }
            })->get();

        $data = [];
        foreach ($activities as $activity) {
            $data[] = [
                'id' => $activity->id,
                'title' => $activity->form->title,
                'due_at' => $activity->due_at,
                'duration' => $activity->duration,
                'subject' => $activity->subject->name,
                'groups' => $activity->groups,
            ];
        }

        return $this->successResponse($data);
    }
}
