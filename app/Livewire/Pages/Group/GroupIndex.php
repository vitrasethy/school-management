<?php

namespace App\Livewire\Pages\Group;

use App\Models\Group;
use Livewire\Component;

class GroupIndex extends Component
{
    public Group $group;

    public function render()
    {
        return view('livewire.pages.group.group-index');
    }
}
