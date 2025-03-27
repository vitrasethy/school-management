<?php

namespace App\Http\Controllers\Api\V2;

use App\Http\Controllers\Api\BaseController;
use App\Models\Group;
use App\Models\SchoolYear;
use App\Models\User;
use Illuminate\Database\Eloquent\Builder;

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
}
