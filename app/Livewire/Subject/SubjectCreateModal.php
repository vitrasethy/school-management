<?php

namespace App\Livewire\Subject;

use App\Livewire\Forms\SubjectForm;
use App\Models\Department;
use App\Models\Faculty;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;
use Livewire\Component;

class SubjectCreateModal extends Component
{
    public SubjectForm $form;

    public $faculty_id;
    public $faculties;
    public $departments;

    public function mount(): void
    {
        $this->departments = collect();
        $user = Auth::user();

        if ($user->hasRole('super admin')) {
            $this->faculties = Faculty::all();
        } elseif ($user->hasRole('school admin')) {
            $this->departments = Department::where('faculty_id', $user->userAffiliations()->first()->faculty_id)->get();
        } elseif ($user->hasRole('department admin')) {
            $this->form->department_id = $user->userAffiliations()->first()->department_id;
        }
    }

    public function updatedFacultyId(): void
    {
        $this->departments = Department::where('faculty_id', $this->faculty_id)->get();
    }

    public function save(): void
    {
        $this->form->create();
        $this->dispatch('refresh-subjects');
    }

    public function render(): View
    {
        return view('livewire.subject.subject-create-modal');
    }
}
