<?php

namespace App\Livewire\Home;

use App\Models\Department;
use App\Models\Group;
use App\Models\Subject;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;
use Livewire\Component;

class SchoolAdminStatistic extends Component
{
    public $department_count;
    public $subject_count;
    public $group_count;
    public $user_count;

    public function mount(): void
    {
        $user = Auth::user();
        $this->department_count = Department::where('school_id', $user->school_id)->count();
        $this->subject_count = Subject::whereHas('department', function ($query) use ($user) {
            $query->where('school_id', $user->school_id);
        })->count();
        $this->group_count = Group::whereHas('department', function ($query) use ($user) {
            $query->where('school_id', $user->school_id);
        })->count();
        $this->user_count = User::where('school_id', $user->school_id)->count();
    }

    public function render(): View
    {
        return view('livewire.home.school-admin-statistic');
    }
}
