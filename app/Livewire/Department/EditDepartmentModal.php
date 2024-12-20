<?php

namespace App\Livewire\Department;

use App\Livewire\Forms\DepartmentForm;
use App\Models\Department;
use App\Models\School;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;
use Livewire\Component;

class EditDepartmentModal extends Component
{
    public DepartmentForm $form;
    public Department $department;

    public $schools;
    public $user;

    public function mount(Department $department): void
    {
        $this->department = $department;
        $this->form->setForm($department);
        $this->user = Auth::user();

        if ($this->user->getRoleNames()->contains('super admin')) {
            $this->schools = School::all();
        } elseif ($this->user->getRoleNames()->contains('school admin')) {
            $this->form->school_id = $this->user->school_id;
        }
    }

    public function save(): void
    {
        $this->form->update();
        $this->dispatch('refresh-departments');
    }

    public function render(): View
    {
        return view('livewire.department.edit-department-modal');
    }
}
