<?php

namespace App\Livewire\Subject;

use App\Livewire\Forms\SubjectForm;
use App\Models\Department;
use App\Models\Faculty;
use App\Models\Subject;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;
use Livewire\Component;

class SubjectEditModal extends Component
{
    public SubjectForm $form;
    public Subject $subject;
    public $faculty_id;
    public $faculties;
    public $departments;

    public function mount(Subject $subject): void
    {
        $this->subject = $subject;
        $this->form->setForm($subject);

        $user = Auth::user();

        if ($user->hasRole('super admin')) {
            $this->faculties = Faculty::all();
            $this->faculty_id = $subject->department->faculty_id;
            $this->departments = Department::where('faculty_id', $this->faculty_id)->get();
        } elseif ($user->hasRole('school admin')) {
            $this->departments = Department::where('faculty_id', $user->userAffiliations()->first()->faculty_id)->get();
        } elseif ($user->hasRole('department admin')) {
            $this->form->department_id = $user->department_id;
        }
    }

    public function updatedFacultyId(): void
    {
        $this->departments = Department::where('faculty_id', $this->faculty_id)->get();
    }

    public function save(): void
    {
        $this->form->update();
        $this->dispatch('refresh-subjects');
    }

    public function render(): View
    {
        return view('livewire.subject.subject-edit-modal');
    }
}
