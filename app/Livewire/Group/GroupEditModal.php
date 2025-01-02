<?php

namespace App\Livewire\Group;

use App\Livewire\Forms\GroupForm;
use App\Models\Department;
use App\Models\Faculty;
use App\Models\Group;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;
use Livewire\Component;

class GroupEditModal extends Component
{
    public GroupForm $form;

    public Group $group;

    public $faculty_id;
    public $user;
    public $faculties;
    public $departments;

    public function mount(Group $group): void
    {
        $this->form->setForm($group);
        $this->faculty_id = $group->department->faculty_id;
        $this->departments = collect();
        $this->user = Auth::user();
        if ($this->user->hasRole('super admin')) {
            $this->faculties = Faculty::all();
            $this->departments = Department::where('faculty_id', $this->faculty_id)->get();
        } elseif ($this->user->hasRole('faculty admin')) {
            $this->departments = Department::where('faculty_id', $this->user->userAffiliations()->first()->faculty_id)->get();
        } elseif ($this->user->hasRole('department admin')) {
            $this->form->department_id = $this->user->userAffiliations()->first()->department_id;
        }
    }

    public function updatedSchoolId(): void
    {
        $this->departments = Department::where('faculty_id', $this->faculty_id)->get();
    }

    public function save(): void
    {
        $this->form->update();
        $this->dispatch('refresh-groups');
    }

    public function render(): View
    {
        return view('livewire.group.group-edit-modal');
    }
}
