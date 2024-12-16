<?php

namespace App\Livewire\Subject;

use App\Models\Department;
use App\Models\School;
use App\Models\Subject;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;
use Livewire\Attributes\On;
use Livewire\Component;
use Livewire\WithPagination;

class SubjectTable extends Component
{
    use WithPagination;

    public $school_id;
    public $schools;
    public $school;
    public $department_id;
    public $departments;
    public $department;
    public $per_page = 10;

    public $filters = [
        'school_id' => "",
        'department_id' => ""
    ];

    public function mount(): void
    {
        $user = Auth::user();
        $this->schools = Collect();
        $this->departments = Collect();

        if ($user->hasRole('super admin')) {
            $this->schools = School::all();
        } elseif ($user->hasRole('school admin')) {
            $this->school_id = $user->school_id;
            $this->departments = Department::where('school_id', $this->school_id)->get();
        } elseif ($user->hasRole('department admin')) {
            $this->department_id = $user->department_id;
        }
    }

    public function updatedFilters(): void
    {
        $this->dispatch('refresh-subjects');
    }

    public function removeFilter($filter): void
    {
        if ($filter == 'school') {
            $this->filters['school_id'] = "";
        } elseif ($filter == 'department') {
            $this->filters['department_id'] = "";
        }
    }

    public function resetFilters(): void
    {
        $this->filters = [
            'school_id' => "",
            'department_id' => ""
        ];
    }

    #[On('refresh-subjects')]
    public function refreshSubjects(): void
    {
        $this->resetPage();
    }

    #[On('confirmed-delete')]
    public function delete($subject_id): void
    {
        $subject = Subject::find($subject_id);
        $subject->delete();
    }

    public function render(): View
    {
        $query = Subject::query();

        if ($this->school_id) {
            $query->whereHas('department', function ($query) {
                $query->where('school_id', $this->school_id);
            });
        }

        if ($this->department_id) {
            $query->where('department_id', $this->department_id);
        }

        if ($this->filters['school_id']) {
            $query->whereHas('department', function ($query) {
                $query->where('school_id', $this->filters['school_id']);
            });
            $this->departments = Department::where('school_id', $this->filters['school_id'])->get();
            $this->school = School::find($this->filters['school_id']);
        }

        if ($this->filters['department_id']) {
            $query->where('department_id', $this->filters['department_id']);
            $this->department = Department::find($this->filters['department_id']);
        }

        return view('livewire.subject.subject-table', [
            'subjects' => $query->paginate($this->per_page)
        ]);
    }
}
