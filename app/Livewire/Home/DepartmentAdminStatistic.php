<?php

namespace App\Livewire\Home;

use App\Models\Group;
use App\Models\Subject;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;
use Livewire\Component;

class DepartmentAdminStatistic extends Component
{
    public $subject_count;
    public $group_count;
    public $teacher_count;
    public $student_count;

    public function mount(): void
    {
        $user = Auth::user();
        $this->subject_count = Subject::where('department_id', $user->department_id)->count();
        $this->group_count = Group::where('department_id', $user->department_id)->count();
        $this->teacher_count = User::role('teacher')->where('department_id', $user->department_id)->count();
        $this->student_count = User::role('student')->where('department_id', $user->department_id)->count();
    }

    public function render(): View
    {
        return view('livewire.home.department-admin-statistic');
    }
}
