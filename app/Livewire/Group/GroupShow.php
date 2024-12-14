<?php

namespace App\Livewire\Group;

use App\Models\Group;
use Illuminate\Contracts\View\View;
use Livewire\Attributes\On;
use Livewire\Component;
use Livewire\WithPagination;

class GroupShow extends Component
{
    use WithPagination;

    public Group $group;
    public $group_id;

    public function mount(Group $group): void
    {
        $this->group_id = $group->id;
        $this->getGroup();
    }

    #[On('subject-updated')]
    public function getGroup(): void
    {
        $this->group = Group::find($this->group_id);
    }

    public function render(): View
    {
        return view('livewire.group.group-show');
    }
}
