<?php

namespace App\Livewire\Group;

use App\Models\Department;
use App\Models\Group;
use App\Models\School;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;
use Livewire\Attributes\On;
use Livewire\Component;
use Livewire\WithPagination;

class GroupTable extends Component
{
    use WithPagination;

    public $school_id;
    public $schools;
    public $school;
    public $department_id;
    public $departments;
    public $department;
    public $perPage = 10;

    public $filters = [
        'school_id' => "",
        'department_id' => "",
        'year' => "",
        'academic_year' => ""
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
        $this->dispatch('refresh-users');
    }

    public function removeFilter($filter): void
    {
        if ($filter == 'school') {
            $this->filters['school_id'] = "";
        } elseif ($filter == 'department') {
            $this->filters['department_id'] = "";
        } elseif ($filter == 'year') {
            $this->filters['role_id'] = "";
        } elseif ($filter == 'academic_year') {
            $this->filters['academic_year'] = "";
        }
    }

    public function resetFilters(): void
    {
        $this->filters = [
            'school_id' => "",
            'department_id' => "",
            'year' => "",
            'academic_year' => ""
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

        if ($this->school_id) {
            $query->whereHas('department', function ($query) {
                return $query->where('school_id', $this->school_id);
            });
        }

        if ($this->filters['school_id']) {
            $query->whereHas('department', function ($query) {
                return $query->where('school_id', $this->filters['school_id']);
            });
            $this->departments = Department::where('school_id', $this->filters['school_id'])->get();
            $this->school = School::find($this->filters['school_id']);
        }

        if ($this->filters['department_id']) {
            $query->where('department_id', $this->filters['department_id']);
            $this->department = Department::find($this->filters['department_id']);
        }

        if ($this->filters['year']) {
            $query->where('year', $this->filters['year']);
        }

        if ($this->filters['academic_year']) {
            $query->where('school_year', $this->filters['academic_year']);
        }

        return view('livewire.group.group-table', [
            'groups' => $query->paginate($this->perPage)
        ]);
    }
}
