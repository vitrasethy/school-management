<?php

namespace App\Livewire\User;

use App\Livewire\Forms\UserForm;
use App\Models\Department;
use App\Models\Faculty;
use App\Models\Group;
use App\Models\Role;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;
use Livewire\Component;
use Livewire\WithFileUploads;

class UserEditModal extends Component
{
    use WithFileUploads;

    public UserForm $form;

    public User $user;

    public $roles;

    public $faculties;

    public $departments;

    public $groups;

    public function mount(User $user): void
    {
        $this->form->setForm($user);
        $this->roles = Role::all();
        $this->faculties = Faculty::all();
        $this->departments = collect();
        $this->groups = collect();

        $current_user = Auth::user();

        if ($current_user->hasRole('super admin')) {
            $this->departments = Department::where('faculty_id', $this->form->faculty_id)->get();
            $this->groups = Group::where('department_id', $this->form->department_id)->get();
        } elseif ($current_user->hasRole('faculty admin')) {
            $this->form->faculty_id = $current_user->userAffiliations()->first()->faculty_id;
            $this->departments = Department::where('faculty_id', $current_user->userAffiliations()->first()->faculty_id)->get();
            $this->groups = Group::where('department_id', $this->form->department_id)->get();
        } elseif ($current_user->hasRole('department admin')) {
            $this->form->faculty_id = $current_user->userAffiliations()->first()->faculty_id;
            $this->form->department_id = $current_user->userAffiliations()->first()->department_id;
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
        $this->form->update();
        $this->dispatch('refresh-users');
        $this->dispatch('close-modal', ['id' => $this->user->id]);
    }

    public function render(): View
    {
        return view('livewire.user.user-edit-modal');
    }
}
