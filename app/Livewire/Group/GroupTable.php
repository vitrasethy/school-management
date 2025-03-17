<?php

namespace App\Livewire\Group;

use App\Models\Department;
use App\Models\Faculty;
use App\Models\Group;
use App\Models\SchoolYear;
use App\Models\Year;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;
use Livewire\Attributes\On;
use Livewire\Component;
use Livewire\WithPagination;

class GroupTable extends Component
{
    use WithPagination;

    public $faculty_id;

    public $faculties;

    public $faculty;

    public $department_id;

    public $departments;

    public $department;

    public $year;

    public $school_year;

    public $perPage = 10;

    public $filters = [
        'faculty_id' => '',
        'department_id' => '',
        'year_id' => '',
        'school_year_id' => '',
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
            $this->department_id = $user->userAffiliations()->first()->department_id;
        }
    }

    public function updatedFilters(): void
    {
        $this->dispatch('refresh-users');
    }

    public function removeFilter($filter): void
    {
        if ($filter == 'faculty') {
            $this->filters['faculty_id'] = '';
        } elseif ($filter == 'department') {
            $this->filters['department_id'] = '';
        } elseif ($filter == 'year_id') {
            $this->filters['year_id'] = '';
        } elseif ($filter == 'school_year_id') {
            $this->filters['school_year_id'] = '';
        }
    }

    public function resetFilters(): void
    {
        $this->filters = [
            'faculty_id' => '',
            'department_id' => '',
            'year_id' => '',
            'school_year_id' => '',
        ];
    }

    #[On('refresh-groups')]
    public function refreshgroups(): void
    {
        $this->resetPage();
    }

    #[On('confirmed-delete')]
    public function delete($group_id): void
    {
        $group = Group::find($group_id);
        $group->delete();
    }

    public function render(): View
    {
        $query = Group::query();

        if ($this->department_id) {
            $query->where('department_id', $this->department_id);
        }

        if ($this->faculty_id) {
            $query->whereHas('department', function ($query) {
                return $query->where('faculty_id', $this->faculty_id);
            });
        }

        if ($this->filters['faculty_id']) {
            $query->whereHas('department', function ($query) {
                return $query->where('faculty_id', $this->filters['faculty_id']);
            });
            $this->departments = Department::where('faculty_id', $this->filters['faculty_id'])->get();
            $this->faculty = Faculty::find($this->filters['faculty_id']);
        }

        if ($this->filters['department_id']) {
            $query->where('department_id', $this->filters['department_id']);
            $this->department = Department::find($this->filters['department_id']);
        }

        if ($this->filters['year_id']) {
            $query->where('year_id', $this->filters['year_id']);
            $this->year = Year::find($this->filters['year_id']);
        }

        if ($this->filters['school_year_id']) {
            $query->where('school_year_id', $this->filters['school_year_id']);
            $this->school_year = SchoolYear::find($this->filters['school_year_id']);
        }

        return view('livewire.group.group-table', [
            'groups' => $query->paginate($this->perPage),
            'years' => Year::all(),
            'school_years' => SchoolYear::all()
        ]);
    }
}
