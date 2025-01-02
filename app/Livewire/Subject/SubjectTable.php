<?php

namespace App\Livewire\Subject;

use App\Models\Department;
use App\Models\Faculty;
use App\Models\Subject;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;
use Livewire\Attributes\On;
use Livewire\Component;
use Livewire\WithPagination;

class SubjectTable extends Component
{
    use WithPagination;

    public $faculty_id;

    public $faculties;

    public $faculty;

    public $department_id;

    public $departments;

    public $department;

    public $per_page = 10;

    public $filters = [
        'faculty_id' => '',
        'department_id' => '',
    ];

    public function mount(): void
    {
        $user = Auth::user();
        $this->faculties = Collect();
        $this->departments = Collect();

        if ($user->hasRole('super admin')) {
            $this->faculties = Faculty::all();
        } elseif ($user->hasRole('faculty admin')) {
            $this->faculty_id = $user->userAffiliations()->first()->faculty_id;
            $this->departments = Department::where('faculty_id', $this->faculty_id)->get();
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
        if ($filter == 'faculty') {
            $this->filters['faculty_id'] = '';
        } elseif ($filter == 'department') {
            $this->filters['department_id'] = '';
        }
    }

    public function resetFilters(): void
    {
        $this->filters = [
            'faculty_id' => '',
            'department_id' => '',
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

        if ($this->faculty_id) {
            $query->whereHas('department', function ($query) {
                $query->where('faculty_id', $this->faculty_id);
            });
        }

        if ($this->department_id) {
            $query->where('department_id', $this->department_id);
        }

        if ($this->filters['faculty_id']) {
            $query->whereHas('department', function ($query) {
                $query->where('faculty_id', $this->filters['faculty_id']);
            });
            $this->departments = Department::where('faculty_id', $this->filters['faculty_id'])->get();
            $this->faculty = Faculty::find($this->filters['faculty_id']);
        }

        if ($this->filters['department_id']) {
            $query->where('department_id', $this->filters['department_id']);
            $this->department = Department::find($this->filters['department_id']);
        }

        return view('livewire.subject.subject-table', [
            'subjects' => $query->paginate($this->per_page),
        ]);
    }
}
