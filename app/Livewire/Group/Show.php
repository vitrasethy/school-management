<?php

namespace App\Livewire\Group;

use App\Models\Department;
use App\Models\Group;
use Illuminate\Database\Eloquent\Collection;
use Livewire\Attributes\On;
use Livewire\Component;

class Show extends Component
{
    public Department $department;
    public Collection $groups;

    public function mount()
    {
        $this->getGroup();
    }

    #[On('created-group')]
    public function getGroup()
    {
        $this->groups = Group::where('department_id', $this->department->id)->get();
    }

    public function render()
    {
        return view('livewire.group.show');
    }
}
