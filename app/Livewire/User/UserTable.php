<?php

namespace App\Livewire\User;

use App\Models\Department;
use App\Models\Role;
use App\Models\School;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;
use Livewire\Attributes\On;
use Livewire\Component;
use Livewire\WithPagination;

class UserTable extends Component
{
    use WithPagination;

    public $school_id;
    public $schools;
    public $school;
    public $department_id;
    public $departments;
    public $department;
    public $roles;
    public $role;
    public $perPage = 10;

    public $filters = [
        'school_id' => "",
        'department_id' => "",
        'role_id' => ""
    ];

    public function mount(): void
    {
        $user = Auth::user();
        $this->schools = Collect();
        $this->departments = Collect();
        $this->roles = Collect();

        if ($user->hasRole('super admin')) {
            $this->schools = School::all();
            $this->roles = Role::all();
        } elseif ($user->hasRole('school admin')) {
            $this->school_id = $user->school_id;
            $this->departments = Department::where('school_id', $this->school_id)->get();
            $this->roles = Role::where('name', '!=', 'super admin')->get();
        } elseif ($user->hasRole('department admin')) {
            $this->department_id = $user->department_id;
            $this->roles = Role::whereNotIn('name', ['super admin', 'school admin'])->get();
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
        } elseif ($filter == 'role') {
            $this->filters['role_id'] = "";
        }
    }

    public function resetFilters(): void
    {
        $this->filters = [
            'school_id' => "",
            'department_id' => "",
            'role_id' => ""
        ];
    }

    #[On('refresh-users')]
    public function refreshUsers(): void
    {
        $this->resetPage();
    }

    #[On('confirmed-delete')]
    public function delete($user_id): void
    {
        $user = User::find($user_id);
        $user->groups()->detach();
        $user->delete();
    }

    public function render(): View
    {
        $query = User::query();

        if ($this->school_id) {
            $query->where('school_id', $this->school_id);
        }

        if ($this->department_id) {
            $query->where('department_id', $this->department_id);
        }

        if ($this->filters['school_id']) {
            $query->where('school_id', $this->filters['school_id']);
            $this->departments = Department::where('school_id', $this->filters['school_id'])->get();
            $this->school = School::find($this->filters['school_id']);
        }

        if ($this->filters['department_id']) {
            $query->where('department_id', $this->filters['department_id']);
            $this->department = Department::find($this->filters['department_id']);
        }

        if ($this->filters['role_id']) {
            $query->whereHas('roles', function ($query) {
                $query->where('id', $this->filters['role_id']);
            });
            $this->role = Role::find($this->filters['role_id']);
        }

        return view('livewire.user.user-table', [
            'users' => $query->withoutRole('super admin')->paginate($this->perPage)
        ]);
    }
}
