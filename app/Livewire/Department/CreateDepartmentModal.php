<?php

namespace App\Livewire\Department;

use App\Livewire\Forms\DepartmentForm;
use App\Models\School;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class CreateDepartmentModal extends Component
{
    public DepartmentForm $form;

    public $schools;

    public function mount()
    {
        $this->schools = School::all();
        $user = Auth::user();
        if ($user->role_id == 1) {
            $this->form->school_id = $user->school_id;
        }
    }

    public function save()
    {
        $this->form->create();
        $this->dispatch('refresh-departments');
    }

    public function render()
    {
        return view('livewire.department.create-department-modal');
    }
}
