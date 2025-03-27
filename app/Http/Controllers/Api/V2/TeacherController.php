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
        $teacherGroups = Group::with('teacher')
            ->whereHas('schoolYear', function (Builder $query) {
                $query
                    ->whereDate('started_at', '<=', today('Asia/Phnom_Penh'))
                    ->whereDate('finished_at', '>=', today('Asia/Phnom_Penh'));
            })->get();

        $teacherGroupIds = $teacherGroups->pluck('id');

        $totalGroups = $teacherGroups->count();

        $totalStudents = User::whereHas('groups', function (Builder $query) use ($teacherGroupIds) {
            $query
                ->whereKey($teacherGroupIds)
                ->whereDate('started_at', '<=', today('Asia/Phnom_Penh'))
                ->whereDate('finished_at', '>=', today('Asia/Phnom_Penh'));
        })->count();

        $currentSemester = SchoolYear::whereDate('started_at', '<=', today('Asia/Phnom_Penh'))
            ->whereDate('finished_at', '>=', today('Asia/Phnom_Penh'))
            ->first();

        return $this->successResponse([
            'total_groups' => $totalGroups,
            'total_students' => $totalStudents,
            'current_semester' => $currentSemester,
            'groups' => $teacherGroups,
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
