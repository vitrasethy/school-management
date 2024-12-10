<?php

namespace App\Livewire\Group;

use App\Livewire\Forms\GroupForm;
use App\Models\Department;
use App\Models\Group;
use App\Models\School;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class GroupEditModal extends Component
{
    public GroupForm $form;

    public Group $group;

    public $school_id;
    public $user;
    public $schools;
    public $departments;

    public function mount(Group $group)
    {
        $this->form->setForm($group);
        $this->school_id = $group->department->school->id;
        $this->departments = collect();
        $this->user = Auth::user();
        if ($this->user->hasRole('super admin')) {
            $this->schools = School::all();
            $this->departments = Department::where('school_id', $this->school_id)->get();
        } elseif ($this->user->hasRole('school admin')) {
            $this->departments = Department::where('school_id', $this->user->school_id)->get();
        } elseif ($this->user->hasRole('department admin')) {
            $this->form->department_id = $this->user->department_id;
        }
    }

    public function updatedSchoolId()
    {
        $this->departments = Department::where('school_id', $this->school_id)->get();
    }

    public function save()
    {
        $this->form->update();
        $this->dispatch('refresh-groups');
    }

    public function render()
    {
        return view('livewire.group.group-edit-modal');
    }
}
