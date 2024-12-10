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
        if ($user->hasRole('school admin')) {
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
        $query = Department::query();

        if ($this->school_id) {
            $query->where('school_id', $this->school_id);
        }

        return view('livewire.department.show', [
            'departments' => $query->paginate($this->perPage)
        ]);
    }
}
