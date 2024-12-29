<?php

namespace App\Livewire\Group;

use App\Livewire\Forms\GroupForm;
use App\Models\Department;
use App\Models\Faculty;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;
use Livewire\Component;

class GroupCreateModal extends Component
{
    public GroupForm $form;

    public $faculty_id;

    public $user;

    public $faculties;

    public $departments;

    public function mount(): void
    {
        $this->user = Auth::user();
        $this->departments = collect();
        if ($this->user->hasRole('super admin')) {
            $this->faculties = Faculty::all();
        } elseif ($this->user->hasRole('school admin')) {
            $this->departments = Department::where('faculty_id', $this->user->userAffiliations()->first()->faculty_id)->get();
        } elseif ($this->user->hasRole('department admin')) {
            $this->form->department_id = $this->user->userAffiliations()->first()->department_id;
        }
    }

    public function updatedFacultyId(): void
    {
        $this->departments = Department::where('faculty_id', $this->faculty_id)->get();
    }

    public function save(): void
    {
        $this->form->create();
        $this->dispatch('refresh-groups');
    }

    public function render(): View
    {
        return view('livewire.group.group-create-modal');
    }
}
