<?php

namespace App\Livewire\User;

use App\Livewire\Forms\UserForm;
use App\Models\Department;
use App\Models\Faculty;
use App\Models\Group;
use App\Models\Role;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;
use Livewire\Component;
use Livewire\WithFileUploads;

class Create extends Component
{
    use WithFileUploads;

    public UserForm $form;

    public $roles;
    public $faculties;
    public $departments;
    public $groups;
    public $user;

    public function mount(): void
    {
        $this->roles = Role::all();
        $this->faculties = Faculty::all();
        $this->user = Auth::user();

        if ($this->user->getRoleNames()->contains('faculty admin')) {
            $this->form->faculty_id = Auth::user()->userAffiliations()->first()->faculty_id;
            $this->departments = Department::where('faculty_id', Auth::user()->userAffiliations()->first()->faculty_id)->get();
            $this->groups = Group::where('department_id', $this->form->department_id)->get();
        } elseif ($this->user->getRoleNames()->contains('department admin')) {
            $this->form->faculty_id = Auth::user()->userAffiliations()->first()->faculty_id;
            $this->form->department_id = Auth::user()->userAffiliations()->first()->department_id;
            $this->groups = Group::where('department_id', $this->form->department_id)->get();
        }
    }

    public function updatedFormFacultyId(): void
    {
        $this->form->department_id = 0;
        $this->departments = Department::where('faculty_id', $this->form->faculty_id)->get();
    }

    public function updatedFormDepartmentId(): void
    {
        $this->form->group_id = 0;
        $this->groups = Group::where('department_id', $this->form->department_id)->get();
    }

    public function updatedFormRole(): void
    {
        if ($this->form->role == 'super admin') {
            $this->form->faculty_id = null;
            $this->form->department_id = null;
        } elseif ($this->form->role == 'faculty admin') {
            $this->form->department_id = null;
        }
    }

    public function save(): void
    {
        $this->form->create();
        $this->dispatch('refresh-users');
    }

    public function render(): View
    {
        return view('livewire.user.create');
    }
}
