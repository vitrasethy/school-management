<?php

namespace App\Livewire\Group;

use App\Livewire\Forms\GroupForm;
use App\Models\Department;
use App\Models\School;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class GroupCreateModal extends Component
{
    public GroupForm $form;

    public $school_id;
    public $user;
    public $schools;
    public $departments;

    public function mount()
    {
        $this->user = Auth::user();
        $this->departments = collect();
        if ($this->user->role_id == 1) {
            $this->schools = School::all();
        } elseif ($this->user->role_id == 2) {
            $this->departments = Department::where('school_id', $this->user->school_id)->get();
        } elseif ($this->user->role_id == 3) {
            $this->form->department_id = $this->user->department_id;
        }
    }

    public function updatedSchoolId()
    {
        $this->departments = Department::where('school_id', $this->school_id)->get();
    }

    public function save()
    {
        $this->form->create();
        $this->dispatch('refresh-groups');
    }

    public function render()
    {
        return view('livewire.group.group-create-modal');
    }
}
