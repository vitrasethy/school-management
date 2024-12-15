<?php

namespace App\Livewire\Group;

use App\Models\Group;
use Illuminate\View\View;
use Livewire\Component;

class GroupUserTable extends Component
{
    public Group $group;

    public function mount(): void
    {

    }

    public function render(): View
    {
        return view('livewire.group.group-user-table');
    }
}
