<?php

namespace App\Livewire\Department;

use App\Models\Department;
use App\Models\Faculty;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;
use Livewire\Attributes\On;
use Livewire\Component;
use Livewire\WithPagination;

class Show extends Component
{
    use WithPagination;

    public $faculty_id;

    public $faculties;

    public $perPage = 10;

    public Faculty $faculty;

    public function mount(): void
    {
        $this->faculties = Collect();
        $user = Auth::user();
        if ($user->hasRole('super admin')) {
            $this->faculties = Faculty::all();
        } elseif ($user->hasRole('school admin')) {
            $this->faculty_id = $user->userAffiliations()->first()->faculty_id;
        }
    }

    public function updatedSchool(): void
    {
        $this->dispatch('refresh-departments');
    }

    public function resetFilter(): void
    {
        $this->faculty_id = '';
    }

    #[On('confirmed-delete')]
    public function delete($department_id): void
    {
        $department = Department::find($department_id);
        if ($department) {
            $department->delete();
            $this->dispatch('delete-department-success');
        } else {
            $this->dispatch('delete-department-failure');
        }
    }

    #[On('refresh-departments')]
    public function refreshDepartments(): void
    {
        $this->resetPage();
    }

    public function render(): View
    {
        $query = Department::query();

        if ($this->faculty_id) {
            $query->where('faculty_id', $this->faculty_id);
        }

        if ($this->faculty_id) {
            $query->where('faculty_id', $this->faculty_id);
            $this->faculty = Faculty::find($this->faculty_id);
        }

        return view('livewire.department.show', [
            'departments' => $query->paginate($this->perPage),
        ]);
    }
}
