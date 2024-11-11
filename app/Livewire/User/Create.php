<?php

namespace App\Livewire\User;

use App\Livewire\Forms\UserForm;
use App\Models\Department;
use App\Models\Group;
use App\Models\Role;
use App\Models\School;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Create extends Component
{
    public UserForm $form;

    public $roles;
    public $schools;
    public $departments;
    public $groups;
    public $user;

    public function mount()
    {
        $this->roles = Role::all();
        $this->schools = School::all();
        $this->user = Auth::user();
        if ($this->user->role_id == 1) {
            $this->form->school_id = Auth::user()->school_id;
            $this->departments = Department::where('school_id', Auth::user()->school_id)->get();
        } elseif ($this->user->role_id == 2) {
            $this->form->school_id = Auth::user()->school_id;
            $this->form->department_id = Auth::user()->departments->first()->id;
            $this->groups = Group::where('department_id', $this->form->department_id)->get();
        }
    }

    public function updatedFormSchoolId()
    {
        $this->form->department_id = 0;
        $this->departments = Department::where('school_id', $this->form->school_id)->get();
    }

    public function updatedFormDepartmentId()
    {
        $this->form->group_id = 0;
        $this->groups = Group::where('department_id', $this->form->department_id)->get();
    }

    public function save()
    {
        $this->form->create();
        $this->dispatch('refresh-users');
    }

    public function render()
    {
        return view('livewire.user.create');
    }
}
