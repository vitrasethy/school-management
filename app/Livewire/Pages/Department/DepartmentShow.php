<?php

namespace App\Livewire\Pages\Department;

use App\Models\Department;
use Livewire\Component;
use Livewire\WithPagination;

class DepartmentShow extends Component
{
    use WithPagination;

    public $perPage = 10;

    public function render()
    {
        return view(
            'livewire.pages.department.department-show',
            [
                'departments' => Department::with('school')->paginate($this->perPage)
            ]
        );
    }
}
