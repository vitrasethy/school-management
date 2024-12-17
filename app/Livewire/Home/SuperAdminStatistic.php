<?php

namespace App\Livewire\Home;

use App\Models\Department;
use App\Models\Group;
use App\Models\School;
use App\Models\User;
use Illuminate\View\View;
use Livewire\Component;

class SuperAdminStatistic extends Component
{
    public function render(): View
    {
        return view('livewire.home.super-admin-statistic',
            [
                'school_count' => School::count(),
                'department_count' => Department::count(),
                'group_count' => Group::count(),
                'user_count' => User::count()
            ]
        );
    }
}
