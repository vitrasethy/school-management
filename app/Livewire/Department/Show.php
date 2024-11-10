<?php

namespace App\Livewire\Department;

use App\Models\Department;
use App\Models\School;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\On;
use Livewire\Component;
use Livewire\WithPagination;

class Show extends Component
{
    use WithPagination;

    public $school_id;
    public $schools;
    public $perPage = 10;

    public function mount()
    {
        $user = Auth::user();
        if ($user->role_id == 1) {
            $this->school_id = $user->school_id;
        }
    }

    #[On('confirmed-delete')]
    public function delete($department_id)
    {
        $department = Department::find($department_id);
        $department->delete();
    }

    #[On('refresh-departments')]
    public function refreshDepartments()
    {
        $this->resetPage();
    }

    public function render()
    {
        return view('livewire.department.show', [
            'departments' => Department::when($this->school_id, function ($query, $school_id) {
                return $query->where('school_id', $school_id);
            })->paginate($this->perPage)
        ]);
    }
}
