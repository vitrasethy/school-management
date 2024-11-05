<?php

namespace App\Livewire\Pages\Department;

use App\Models\Department;
use Livewire\Component;

class DepartmentIndex extends Component
{
    public Department $department;

    public function render()
    {
        return view('livewire.pages.department.department-index');
    }
}
