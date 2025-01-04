<?php

namespace App\Livewire\User;

use App\Models\Department;
use App\Models\Faculty;
use App\Models\Role;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;
use Livewire\Attributes\On;
use Livewire\Component;
use Livewire\WithPagination;

class UserTable extends Component
{
    use WithPagination;

    public $faculty_id;
    public $faculties;
    public $faculty;
    public $department_id;
    public $departments;
    public $department;
    public $roles;
    public $role;
    public $perPage = 10;

    public $filters = [
        'faculty_id' => "",
        'department_id' => "",
        'role_id' => ""
    ];

    public function mount(): void
    {
        $user = Auth::user();
        $this->faculties = Collect();
        $this->departments = Collect();
        $this->roles = Collect();

        if ($user->hasRole('super admin')) {
            $this->faculties = Faculty::all();
            $this->roles = Role::all();
        } elseif ($user->hasRole('faculty admin')) {
            $this->faculty_id = $user->userAffiliations()->first()->faculty_id;
            $this->departments = Department::where('faculty_id', $this->faculty_id)->get();
            $this->roles = Role::where('name', '!=', 'super admin')->get();
        } elseif ($user->hasRole('department admin')) {
            $this->department_id = $user->userAffiliations()->first()->department_id;
            $this->roles = Role::whereNotIn('name', ['super admin', 'faculty admin'])->get();
        }
    }

    public function updatedFilters(): void
    {
        $this->dispatch('refresh-users');
    }

    public function removeFilter($filter): void
    {
        if ($filter == 'faculty') {
            $this->filters['faculty_id'] = "";
        } elseif ($filter == 'department') {
            $this->filters['department_id'] = "";
        } elseif ($filter == 'role') {
            $this->filters['role_id'] = "";
        }
    }

    public function resetFilters(): void
    {
        $this->filters = [
            'faculty_id' => "",
            'department_id' => "",
            'role_id' => ""
        ];
    }

    #[On('refresh-users')]
    public function refreshUsers(): void
    {
        $page = $this->getPage();
        $this->setPage($page);
    }

    #[On('confirmed-delete')]
    public function delete($user_id): void
    {
        $user = User::find($user_id);
        $user->groups()->detach();
        $user->userAffiliations()->delete();
        $user->delete();
    }

    public function render(): View
    {
        $query = User::query();

        if ($this->faculty_id) {
            $query->whereHas('userAffiliations', function ($query) {
                $query->where('faculty_id', $this->faculty_id);
            })->get();
        }

        if ($this->department_id) {
            $query->whereHas('userAffiliations', function ($query) {
                $query->where('department_id', $this->department_id);
            })->get();
        }

        if ($this->filters['faculty_id']) {
            $query->whereHas('userAffiliations', function ($query) {
                $query->where('faculty_id', $this->filters['faculty_id']);
            })->get();
            $this->departments = Department::where('faculty_id', $this->filters['faculty_id'])->get();
            $this->faculty = Faculty::find($this->filters['faculty_id']);
        }

        if ($this->filters['department_id']) {
            $query->whereHas('userAffiliations', function ($query) {
                $query->where('department_id', $this->filters['department_id']);
            })->get();
            $this->department = Department::find($this->filters['department_id']);
        }

        if ($this->filters['role_id']) {
            $query->whereHas('roles', function ($query) {
                $query->where('id', $this->filters['role_id']);
            });
            $this->role = Role::find($this->filters['role_id']);
        }

        return view('livewire.user.user-table', [
            'users' => $query->withoutRole('super admin')->latest()->paginate($this->perPage)
        ]);
    }
}
