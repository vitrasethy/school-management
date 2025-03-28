<?php

namespace App\Http\Controllers\Api\V2;

use App\Http\Controllers\Api\BaseController;
use App\Models\Activity;
use App\Models\Group;
use App\Models\SchoolYear;
use App\Models\User;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use function today;

class TeacherController extends BaseController
{
    public function dashboard()
    {
        $teacherGroups = Group::with([
            'teacher',
            'department',
            'users',
            'year',
            'schoolYear',
            'semester',
            'subjects',
        ])
            ->whereHas('schoolYear', function (Builder $query) {
                $query
                    ->whereDate('started_at', '<=', today('Asia/Phnom_Penh'))
                    ->whereDate('finished_at', '>=', today('Asia/Phnom_Penh'));
            })
            ->latest()
            ->get();

        $teacherGroupIds = $teacherGroups->pluck('id');

        $totalGroups = $teacherGroups->count();

        $totalStudents = User::whereHas('groups', function (Builder $query) use ($teacherGroupIds) {
            $query
                ->whereKey($teacherGroupIds)
                ->whereHas('schoolYear', function (Builder $subQuery) {
                    $subQuery->whereDate('started_at', '<=', today('Asia/Phnom_Penh'))
                        ->whereDate('finished_at', '>=', today('Asia/Phnom_Penh'));
                });
        })->count();

        $currentSemester = SchoolYear::whereDate('started_at', '<=', today('Asia/Phnom_Penh'))
            ->whereDate('finished_at', '>=', today('Asia/Phnom_Penh'))
            ->first();

        $groupData = [];
        for ($i = 0; $i < $teacherGroups->count() && $i < 3; $i++) {
            $groupData[] = [
                'id' => $teacherGroups[$i]['id'],
                'name' => $teacherGroups[$i]['name'],
                'year' => $teacherGroups[$i]['year']['name'],
                'school_year' => $teacherGroups[$i]['schoolYear']['name'],
                'semester' => $teacherGroups[$i]['semester']['name'],
                'subject' => $teacherGroups[$i]['subjects'][0]['name'],
                'department' => $teacherGroups[$i]['department']['name'],
                'total_students' => $teacherGroups[$i]['users']->count(),
            ];
        }

        return $this->successResponse([
            'total_groups' => $totalGroups,
            'total_students' => $totalStudents,
            'current_semester' => $currentSemester,
            'groups' => $groupData,
        ]);
    }

    public function getGroups()
    {
        $groups = Group::with(['teacher', 'users', 'year'])->get();

        $data = [];

        foreach ($groups as $group) {
            $data[] = [
                'id' => $group->id,
                'name' => $group->name,
                'total_students' => $group->users->count(),
                'year' => $group->year->name,
                'semester' => $group->semester->name,
                'school_year' => $group->schoolYear->name,
            ];
        }

        return $this->successResponse($data);
    }

    public function getActivities(Request $request)
    {
        $departmentId = $request->query('department');
        $schoolYearId = $request->query('schoolYear');
        $yearId = $request->query('year');
        $groupName = $request->query('groupName');

        $activities = Activity::with(['form', 'subject', 'group' => ['year', 'schoolYear', 'semester']])
            ->where('teacher_id', Auth::id())
            ->whereHas('group', function (Builder $query) use ($groupName, $schoolYearId, $yearId, $departmentId) {
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
                'group' => $activity->group->name,
                'year' => $activity->group->year->name,
                'semester' => $activity->group->semester->name,
                'school_year' => $activity->group->schoolYear->name,
            ];
        }

        return $this->successResponse($data);
    }
}
