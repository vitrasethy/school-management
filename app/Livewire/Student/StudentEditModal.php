<?php

namespace App\Livewire\Student;

use App\Livewire\Forms\UserForm;
use App\Models\Department;
use App\Models\Group;
use App\Models\Role;
use App\Models\School;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class StudentEditModal extends Component
{
    public UserForm $form;
    public User $student;

    public $roles;
    public $schools;
    public $departments;
    public $groups;

    public function mount(User $student)
    {
        $this->form->setForm($student);
        $this->roles = Role::all();
        $this->schools = School::all();
        $this->departments = collect();
        $this->groups = collect();

        $user = Auth::user();

        if ($user->role_id == 1) {
            $this->departments = Department::where('school_id', $this->form->school_id)->get();
            $this->groups = Group::where('department_id', $this->form->department_id)->get();
        } elseif ($user->role_id == 2) {
            $this->form->school_id = $user->school_id;
            $this->departments = Department::where('school_id', $user->school_id)->get();
            $this->groups = Group::where('department_id', $this->form->department_id)->get();
        } elseif ($user->role_id > 2) {
            $this->form->school_id = $user->school_id;
            $this->form->department_id = $user->department_id;
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

    public function updatedFormRoleId()
    {
        if ($this->form->role_id == 1) {
            $this->form->school_id = null;
            $this->form->department_id = null;
        } elseif ($this->form->role_id == 2) {
            $this->form->department_id = null;
        }
    }

    public function save()
    {
        $this->form->update();
        // $this->dispatch('refresh-users');
    }

    public function render()
    {
        return view('livewire.student.student-edit-modal');
    }
}
