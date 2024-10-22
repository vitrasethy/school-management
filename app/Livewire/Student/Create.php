<?php

namespace App\Livewire\Student;

use App\Models\Group;
use Livewire\Component;

class Create extends Component
{
    public Group $group;

    public function render()
    {
        return view('livewire.student.create');
    }
}
