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

        $authUser = Auth::user();
        if ($authUser->role_id == 1) {
            $this->form->school_id = $authUser->school_id;
            $this->departments = Department::where('school_id', $authUser->school_id)->get();
            $this->groups = Group::whereHas('department', function ($query) use ($authUser) {
                $query->where('school_id', $authUser->school_id);
            })->get();
        } elseif ($authUser->role_id > 1) {
            $this->form->school_id = $authUser->school_id;
            $this->form->department_id = $authUser->departments->first()->id;
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
        $this->form->update();
        $this->dispatch('refresh-users');
    }

    public function render()
    {
        return view('livewire.user.user-edit-modal');
    }
}
