<?php

namespace App\Http\Controllers\Api\V2;

use App\Http\Controllers\Api\BaseController;
use App\Models\Activity;
use App\Models\Group;
use App\Models\SchoolYear;
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
}
