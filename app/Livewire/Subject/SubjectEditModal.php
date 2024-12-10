<?php

namespace App\Livewire\Subject;

use App\Livewire\Forms\SubjectForm;
use App\Models\Department;
use App\Models\School;
use App\Models\Subject;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class SubjectEditModal extends Component
{
    public SubjectForm $form;
    public Subject $subject;
    public $school_id;
    public $schools;
    public $departments;

    public function mount(Subject $subject)
    {
        $this->subject = $subject;
        $this->form->setForm($subject);

        $user = Auth::user();

        if ($user->hasRole('super admin')) {
            $this->schools = School::all();
            $this->school_id = $subject->department->school_id;
            $this->departments = Department::where('school_id', $this->school_id)->get();
        } elseif ($user->hasRole('school admin')) {
            $this->departments = Department::where('school_id', $user->school_id)->get();
        } elseif ($user->hasRole('department admin')) {
            $this->form->department_id = $user->department_id;
        }
    }

    public function updatedSchoolId()
    {
        $this->departments = Department::where('school_id', $this->school_id)->get();
    }

    public function save()
    {
        $this->form->update();
        $this->dispatch('refresh-subjects');
    }

    public function render()
    {
        return view('livewire.subject.subject-edit-modal');
    }
}
