<?php

namespace App\Livewire\Department;

use App\Models\Department;
use App\Models\School;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;
use Livewire\Attributes\On;
use Livewire\Component;
use Livewire\WithPagination;

class Show extends Component
{
    use WithPagination;

    public $school_id;
    public $schools;
    public $perPage = 10;
    public School $school;

    public function mount(): void
    {
        $this->schools = Collect();
        $user = Auth::user();
        if ($user->hasRole('super admin')) {
            $this->schools = School::all();
        } elseif ($user->hasRole('school admin')) {
            $this->school_id = $user->school_id;
        }
    }

    public function updatedSchool(): void
    {
        $this->dispatch('refresh-departments');
    }

    public function resetFilter(): void
    {
        $this->school_id = "";
    }

    #[On('confirmed-delete')]
    public function delete($department_id): void
    {
        $department = Department::find($department_id);
        $department->delete();
    }

    #[On('refresh-departments')]
    public function refreshDepartments(): void
    {
        $this->resetPage();
    }

    public function render(): View
    {
        $query = Department::query();

        if ($this->school_id) {
            $query->where('school_id', $this->school_id);
        }

        if ($this->school_id) {
            $query->where('school_id', $this->school_id);
            $this->school = School::find($this->school_id);
        }

        return view('livewire.department.show', [
            'departments' => $query->paginate($this->perPage),
        ]);
    }
}
