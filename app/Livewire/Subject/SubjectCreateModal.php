<?php

namespace App\Livewire\Subject;

use App\Livewire\Forms\SubjectForm;
use App\Models\Department;
use App\Models\School;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class SubjectCreateModal extends Component
{
    public SubjectForm $form;

    public $school_id;
    public $schools;
    public $departments;

    public function mount()
    {
        $this->departments = collect();
        $user = Auth::user();

        if ($user->role_id == 1) {
            $this->schools = School::all();
        } elseif ($user->role_id == 2) {
            $this->departments = Department::where('school_id', $user->school_id)->get();
        } elseif ($user->role_id == 3) {
            $this->form->department_id = $user->department_id;
        }
    }

    public function updatedSchoolId()
    {
        $this->departments = Department::where('school_id', $this->school_id)->get();
    }

    public function save()
    {
        $this->form->create();
        $this->dispatch('refresh-subjects');
    }

    public function render()
    {
        return view('livewire.subject.subject-create-modal');
    }
}
