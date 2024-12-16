<?php

namespace App\Livewire\User;

use App\Livewire\Forms\UserForm;
use App\Models\Department;
use App\Models\Group;
use App\Models\Role;
use App\Models\School;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;
use Livewire\Component;
use Livewire\WithFileUploads;

class Create extends Component
{
    use WithFileUploads;

    public UserForm $form;

    public $roles;
    public $schools;
    public $departments;
    public $groups;
    public $user;

    public function mount(): void
    {
        $this->roles = Role::all();
        $this->schools = School::all();
        $this->user = Auth::user();

        if ($this->user->getRoleNames()->contains('school admin')) {
            $this->form->school_id = Auth::user()->school_id;
            $this->departments = Department::where('school_id', Auth::user()->school_id)->get();
            $this->groups = Group::where('department_id', $this->form->department_id)->get();
        } elseif ($this->user->getRoleNames()->contains('department admin')) {
            $this->form->school_id = Auth::user()->school_id;
            $this->form->department_id = Auth::user()->department_id;
            $this->groups = Group::where('department_id', $this->form->department_id)->get();
        }
    }

    public function updatedFormSchoolId(): void
    {
        $this->form->department_id = 0;
        $this->departments = Department::where('school_id', $this->form->school_id)->get();
    }

    public function updatedFormDepartmentId(): void
    {
        $this->form->group_id = 0;
        $this->groups = Group::where('department_id', $this->form->department_id)->get();
    }

    public function updatedFormRole(): void
    {
        if ($this->form->role == 'super admin') {
            $this->form->school_id = null;
            $this->form->department_id = null;
        } elseif ($this->form->role == 'school admin') {
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
