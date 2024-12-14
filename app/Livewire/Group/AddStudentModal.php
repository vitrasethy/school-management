<?php

namespace App\Livewire\Group;

use Illuminate\View\View;
use Livewire\Component;

class AddStudentModal extends Component
{
    public function render(): View
    {
        return view('livewire.group.add-student-modal');
    }
}
