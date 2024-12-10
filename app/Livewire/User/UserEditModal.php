<?php

namespace App\Livewire\User;

use App\Livewire\Forms\UserForm;
use App\Models\Department;
use App\Models\Group;
use App\Models\Role;
use App\Models\School;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class UserEditModal extends Component
{
    public UserForm $form;
    public User $user;

    public $roles;
    public $schools;
    public $departments;
    public $groups;

    public function mount(User $user)
    {
        $this->form->setForm($user);
        $this->roles = Role::all();
        $this->schools = School::all();
        $this->departments = collect();
        $this->groups = collect();

        $current_user = Auth::user();

        if ($current_user->hasRole('super admin')) {
            $this->departments = Department::where('school_id', $this->form->school_id)->get();
            $this->groups = Group::where('department_id', $this->form->department_id)->get();
        } elseif ($current_user->hasRole('school admin')) {
            $this->form->school_id = $current_user->school_id;
            $this->departments = Department::where('school_id', $current_user->school_id)->get();
            $this->groups = Group::where('department_id', $this->form->department_id)->get();
        } elseif ($current_user->hasRole('department admin')) {
            $this->form->school_id = $current_user->school_id;
            $this->form->department_id = $current_user->department_id;
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

    public function updatedFormRole()
    {
        if ($this->form->role == 'super admin') {
            $this->form->school_id = null;
            $this->form->department_id = null;
        } elseif ($this->form->role == 'school admin') {
            $this->form->department_id = null;
        }
    }

    public function save()
    {
        $this->form->update();
        $this->dispatch('refresh-users');
    }

    public function render()
    {
        return view('livewire.user.user-edit-modal');
    }
}
